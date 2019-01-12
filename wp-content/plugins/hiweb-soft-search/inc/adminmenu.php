<?php
	/**
	 * Created by PhpStorm.
	 * User: hiweb
	 * Date: 22.08.2016
	 * Time: 11:39
	 */


	add_action('admin_menu', '_hw_search_admin_menu');


	function _hw_search_admin_menu() {
		add_submenu_page('tools.php', 'hiWeb Search Simple Tool', 'hiWeb Search Simple', 'edit_posts', 'hw-search-simple', '_hw_search_tool');
	}


	function _hw_search_tool(){
		include HIWEB_SEARCH_DIR_TEMPLATE.'/_hw_search_tool.php';
	}