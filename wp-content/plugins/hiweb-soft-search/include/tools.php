<?php
	/**
	 * Created by PhpStorm.
	 * User: hiweb
	 * Date: 22.08.2016
	 * Time: 11:39
	 */

	namespace hiweb_soft_search\tools {


		add_action( 'admin_menu', 'hiweb_soft_search\\tools\\admin_menu' );

		function admin_menu(){
			add_submenu_page( 'tools.php', 'hiWeb Soft Search Tool', 'hiWeb Soft Search', 'edit_posts', 'hw-search-simple', 'hiweb_soft_search\\tools\\tools_page' );
		}

		function tools_page(){
			wp_register_script( 'hw-search-tool', HIWEB_SEARCH_URL_JS . '/admin.js', [ 'jquery' ], true );
			wp_enqueue_script( 'hw-search-tool' );
			wp_register_style( 'hw-search-backend', HIWEB_SEARCH_URL_CSS . '/admin.css' );
			wp_enqueue_style( 'hw-search-backend' );
			include HIWEB_SEARCH_DIR_TEMPLATE . '/tools_page.php';
		}
	}

