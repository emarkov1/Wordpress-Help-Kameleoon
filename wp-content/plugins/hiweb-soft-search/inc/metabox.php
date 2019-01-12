<?php
	/**
	 * Created by PhpStorm.
	 * User: hiweb
	 * Date: 22.08.2016
	 * Time: 18:38
	 */
	
	function _hiweb_search_add_meta_boxes() {
		if(!HIWEB_SEARCH_META_BOX) return;
		///
		global $hiweb_search_disallow_post_type;
		$post_types_disallow = array_flip($hiweb_search_disallow_post_type);
		foreach (get_post_types() as $post_type) {
			if (isset($post_types_disallow[$post_type])) continue;
			add_meta_box( 'hiweb_search_meta_index', 'hiWeb Search index data', '_hiweb_search_add_meta_boxes_echo', $post_type );
		}
	}
	add_action('add_meta_boxes', '_hiweb_search_add_meta_boxes');

	function _hiweb_search_add_meta_boxes_echo($post){
		include HIWEB_SEARCH_DIR_TEMPLATE.'/_hiweb_search_add_meta_boxes_echo.php';
	}