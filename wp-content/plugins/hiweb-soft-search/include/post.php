<?php

	namespace hiweb_soft_search;


	class post extends prepare{

		public $post_id;
		public $wp_post;


		public function __construct( $post_id ){
			$this->wp_post = get_post( $post_id );
			if( $this->wp_post instanceof \WP_Post ) $this->post_id = $this->wp_post->ID;
		}


		/**
		 * Получить массив данных поста
		 */
		public function get_data_source(){
			$R = [];
			if( $this->wp_post instanceof \WP_Post ){
				$post = $this->wp_post;
				global $hiweb_search_post_allow_keys;
				if( is_array( $hiweb_search_post_allow_keys ) ) foreach( $hiweb_search_post_allow_keys as $key ){
					if( array_key_exists( $key, (array)$this->wp_post ) ){
						$value = strip_tags( $this->wp_post->{$key} );
						$R[] = $this->prepare_source_string( $value );
					}
				}
				///Metas
				if( HIWEB_SEARCH_USE_META ){
					global $hiweb_search_meta_disallow_keys;
					$meta_disallow = array_flip( $hiweb_search_meta_disallow_keys );
					$meta = get_post_meta( $this->wp_post->ID );
					if( is_array( $meta ) ) foreach( $meta as $key => $item ){
						if( ( strpos( $key, '_' ) !== 0 || HIWEB_SEARCH_META_NAME_ALLOW_SPACE ) && $key != HIWEB_SEARCH_META_NAME && !array_key_exists( $key, $meta_disallow ) ){
							$value = strip_tags( reset( $item ) );
							if( strlen( $value ) >= HIWEB_SEARCH_KEY_LENGTH_MIN && strlen( $value ) <= HIWEB_SEARCH_KEY_LENGTH_MAX ){
								$R[] = $this->prepare_source_string( $value );
							}
						}
					}
				}
				///Taxonomies
				if( HIWEB_SEARCH_USE_TAXONOMY ){
					$taxonomies = get_object_taxonomies( $this->wp_post->post_type, 'objects' );
					if( is_array( $taxonomies ) ) foreach( $taxonomies as $taxonomyName => $taxonomy ){
						$terms = wp_get_post_terms( $this->wp_post->ID, $taxonomyName );
						if( is_array( $terms ) ) foreach( $terms as $term ){
							$value = $term->name;
							if( strlen( $value ) >= HIWEB_SEARCH_KEY_LENGTH_MIN && strlen( $value ) <= HIWEB_SEARCH_KEY_LENGTH_MAX ){
								$R[] = $this->prepare_source_string( $value );
							}
						}
					}
				}
				///Author
				if( HIWEB_SEARCH_USE_AUTHOR ){
					$author = get_user_by( 'id', $post->post_author );
					if( $author instanceof \WP_User ){
						$R[] = $this->prepare_source_string( $author->data->display_name );
						$R[] = $this->prepare_source_string( $author->data->user_nicename );
					}
				}
				///Date
				if( HIWEB_SEARCH_USE_DATE ){
					$R[] = $this->prepare_source_string( get_the_date( 'Y', $post ) );
					$R[] = $this->prepare_source_string( get_the_date( 'j', $post ) );
					$R[] = $this->prepare_source_string( get_the_date( 'n', $post ) );
					$R[] = $this->prepare_source_string( strtolower( get_the_date( 'F', $post ) ) );
					$R[] = $this->prepare_source_string( strtolower( get_the_date( 'M', $post ) ) );
					switch( (int)get_the_date( 'n', $post ) ){
						case 1:
							$R[] = [ 'января', 'январь', 'янв' ];
							break;
						case 2:
							$R[] = [ 'февраля', 'февраль', 'фев' ];
							break;
						case 3:
							$R[] = [ 'марта', 'март', 'мар' ];
							break;
						case 4:
							$R[] = [ 'апреля', 'апрель', 'апр' ];
							break;
						case 5:
							$R[] = [ 'мая', 'май' ];
							break;
						case 6:
							$R[] = [ 'июня', 'июнь', 'июн' ];
							break;
						case 7:
							$R[] = [ 'июля', 'июль', 'июл' ];
							break;
						case 8:
							$R[] = [ 'августа', 'август', 'авг' ];
							break;
						case 9:
							$R[] = [ 'сентября', 'сентябрь', 'сен' ];
							break;
						case 10:
							$R[] = [ 'октября', 'октябрь', 'окт' ];
							break;
						case 11:
							$R[] = [ 'ноября', 'ноябрь', 'ноя' ];
							break;
						case 12:
							$R[] = [ 'декабря', 'декабрь', 'дек' ];
							break;
					}
				}
			}
			//$R[0] = array_unique($R[0]);
			return $R;
		}


		/**
		 * @return array
		 */
		public function get_data_index(){
			//global $hiweb_soft_search_priority;
			$data_source = $this->get_data_source();
			$R = [];
			if( is_array( $data_source ) ) foreach( $data_source as $priority => $data ){
				if( is_array( $data ) ) foreach( $data as $item ){
					$R[] = $item;
				} else $R[] = $data;
			}
			return implode( HIWEB_SEARCH_META_DELIMITER, array_unique( $R ) );
		}


		/**
		 * Generate and update meta index data
		 * @return bool|int
		 */
		public function update_meta(){
			return update_post_meta( $this->post_id, HIWEB_SEARCH_META_NAME, $this->get_data_index(), false );
		}

	}