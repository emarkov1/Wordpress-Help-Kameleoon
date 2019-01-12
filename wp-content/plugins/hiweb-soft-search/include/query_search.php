<?php

	namespace hiweb_soft_search;


	class query_search{

		private $search;
		private $search_prepare = [];
		private $wp_query;
		private $wp_query_source;


		/**
		 * query constructor.
		 * @param \WP_Query $wp_query
		 */
		public function __construct( \WP_Query $wp_query ){
			$this->search = $wp_query->query_vars['s'];
			$this->wp_query = $wp_query;
			$this->wp_query_source = clone $wp_query;
			$this->prepare_search();
			$this->prepare_query();
			hiweb()->console( $this->wp_query ); //todo-
		}


		private function prepare_search(){
			$this->search_prepare = preg_split( '/[^\w^\d]/iu', mb_strtolower( $this->search, 'utf8' ) );
			foreach( $this->search_prepare as $variant ){
				if( mb_strlen( $variant ) > 4 ){
					$this->search_prepare[] = mb_substr( mb_strtolower( $variant ), 0, floor( mb_strlen( $variant ) * 0.8 ) );
				}
			}
			$this->search_prepare = array_unique( $this->search_prepare );
		}


		private function prepare_query(){
			$meta_query = [];
			if( is_array( $this->search_prepare ) ){
				foreach( $this->search_prepare as $variant ){
					$meta_query[] = [
						'key' => HIWEB_SEARCH_META_NAME,
						'value' => $variant,
						'compare' => 'LIKE'
					];
				}
				$meta_query['relation'] = 'OR';
			}
			if( count( $meta_query ) > 0 ){
				$this->wp_query->set( 'meta_query', $meta_query );
				//$this->wp_query->meta_query->relation = 'OR';
				$this->wp_query->query['s'] = '';
				$this->wp_query->set( 's', '' );
			}
		}


		/**
		 * @return \WP_Query
		 */
		public function get_query_search(){
			$this->prepare_query();
			return $this->wp_query;
		}

	}