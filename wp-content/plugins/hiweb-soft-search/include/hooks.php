<?php

	namespace hiweb_soft_search\hooks {


		\add_action( 'wp_insert_post', 'hiweb_soft_search\\hooks\\wp_insert_post', 1 );
		//\add_action( 'pre_get_posts', 'hiweb_soft_search\\hooks\\pre_get_posts', 20 );
		\add_action( 'pre_get_posts', 'hiweb_soft_search\\hooks\\query_inject', 9999 ); //Инъекция запроса в поиске
		add_action( 'wp_ajax_hiweb_search', 'hiweb_soft_search\\hooks\\ajax_generate' ); //AJAX

		use hiweb_soft_search\post;
		use hiweb_soft_search\query_search;


		function wp_insert_post( $post_id ){
			if( wp_is_post_autosave( $post_id ) ) return;
			if( wp_is_post_revision( $post_id ) ) return;
			///
			global $hiweb_search_disallow_post_type;
			$disallow_post_type = array_flip( $hiweb_search_disallow_post_type );
			if( isset( $disallow_post_type[ $post->post_type ] ) ) return;
			///
			\hiweb_soft_search::post( $post_id )->update_meta();
		}

		/**
		 * @param \WP_Query $query
		 */
		function pre_get_posts( \WP_Query $query ){
			global $wp_query;
			/*if( HIWEB_SEARCH_QUERY_INJECT && !is_admin() && $query->is_main_query() && $query->is_search && is_array( $query->query_vars ) ){
				$this->search_query = $query->get( 's' );
				$query->set( 's', '' );

				switch( HIWEB_SEARCH_QUERY_INJECT_METHOD ){
					case 1:
						$metaQuery = $this->get_queryMeta_bySearchStr( $this->search_query );
						$query->set( 'meta_query', $metaQuery );
						break;
					case 2:
						$ids = $this->get_posts( $this->search_query, $query->query_vars, true );
						if( !is_array( $ids ) || count( $ids ) == 0 ) $query->set( 's', $this->search_query ); else {
							$query->set( 'post__in', $ids );
							$query->set( 'orderby', 'post__in' );
						}
						break;
				}
			}*/
		}

		function query_inject(){
			global $wp_query;
			if( HIWEB_SEARCH_QUERY_INJECT && $wp_query->is_search ){
				$wp_query = \hiweb_soft_search::search_query()->get_query_search();
			}
		}

		function ajax_generate(){
			if( isset( $_POST['do'] ) ){
				///
				if( $_POST['do'] == 'regenerate' ){
					$post = get_post( $_POST['id'] );
					if( $post instanceof \WP_Post ){
						$result = \hiweb_soft_search::post( $post )->update_meta();
						if( $result ){
							wp_send_json_success( $post->ID );
						} else {
							wp_send_json_error( 'update_post_meta id:' . $post->ID . ' error' );
						}
					} else {
						wp_send_json_error( 'не найден пост id:' . $_POST['id'] );
					}
				} elseif( $_POST['do'] == 'regenerate_select_pt' ) {
					$posts = get_posts( [
						'posts_per_page' => - 1,
						'post_status' => 'any',
						'post_type' => $_POST['post_types']
					] );
					$R = [];
					foreach( $posts as $post ){
						$R[] = $post->ID;
					}
					wp_send_json_success( $R );
				} else {
					wp_send_json_error( 'не известный параметр DO' );
				}
				///
			} else {
				wp_send_json_error( 'не передан параметр DO' );
			}
			wp_send_json_error( 'не известная оишбка' );
		}
	}