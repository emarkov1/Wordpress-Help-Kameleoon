<?php
	/**
	 * Created by PhpStorm.
	 * User: hiweb
	 * Date: 09.08.2016
	 * Time: 11:27
	 */

	add_action('admin_enqueue_scripts','_hw_search_wp_enqueue_scripts');
	////
	function _hw_search_wp_enqueue_scripts(){
		wp_register_style('hw-search-backend', HIWEB_SEARCH_URL_CSS . '/backend.css');
		wp_enqueue_style('hw-search-backend');
		wp_register_script('hw-search-tool', HIWEB_SEARCH_URL_JS . '/hw-search-tool.js');
		wp_enqueue_script('hw-search-tool');
	}
