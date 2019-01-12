<?php
	/**
	 * Created by PhpStorm.
	 * User: denmedia
	 * Date: 17.11.2017
	 * Time: 18:52
	 */


	class hiweb_soft_search{


		static private $query_search;


		/**
		 * @return \hiweb_soft_search\query_search
		 */
		static function search_query(){
			if( !self::$query_search instanceof \hiweb_soft_search\query_search ){
				global $wp_query;
				self::$query_search = new \hiweb_soft_search\query_search( $wp_query );
			}
			return self::$query_search;
		}


		/**
		 * @param $postOrID
		 * @return \hiweb_soft_search\post
		 */
		static function post( $postOrID ){
			return new \hiweb_soft_search\post( $postOrID );
		}


	}