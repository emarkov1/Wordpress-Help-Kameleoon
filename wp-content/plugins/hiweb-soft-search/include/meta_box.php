<?php
	/**
	 * Created by PhpStorm.
	 * User: hiweb
	 * Date: 22.08.2016
	 * Time: 18:38
	 */

	namespace hiweb_soft_search\meta_box;


	add_action( 'add_meta_boxes', 'hiweb_soft_search\\meta_box\\add' );

	function add(){
		if( !HIWEB_SEARCH_META_BOX ) return;
		///
		global $hiweb_search_disallow_post_type;
		$post_types_disallow = array_flip( $hiweb_search_disallow_post_type );
		foreach( get_post_types() as $post_type ){
			if( isset( $post_types_disallow[ $post_type ] ) ) continue;
			wp_register_style( 'hw-search-backend', HIWEB_SEARCH_URL_CSS . '/admin.css' );
			wp_enqueue_style( 'hw-search-backend' );
			add_meta_box( 'hiweb_search_meta_index', 'hiWeb Search index data', 'hiweb_soft_search\\meta_box\\template', $post_type );
		}
	}

	function template( $post ){
		include HIWEB_SEARCH_DIR_TEMPLATE . '/meta_box.php';
	}