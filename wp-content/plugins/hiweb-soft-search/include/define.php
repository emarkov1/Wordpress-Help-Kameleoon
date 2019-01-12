<?php
	/**
	 * Created by PhpStorm.
	 * User: hiweb
	 * Date: 21.08.2016
	 * Time: 9:38
	 */

	if( !defined( 'HIWEB_SEARCH_DIR' ) ) define( 'HIWEB_SEARCH_DIR', dirname( dirname( __FILE__ ) ) );
	if( !defined( 'HIWEB_SEARCH_DIR_TEMPLATE' ) ) define( 'HIWEB_SEARCH_DIR_TEMPLATE', HIWEB_SEARCH_DIR . '/template' );
	if( !defined( 'HIWEB_SEARCH_URL' ) ) define( 'HIWEB_SEARCH_URL', WP_PLUGIN_URL . '/' . basename( HIWEB_SEARCH_DIR ) );
	if( !defined( 'HIWEB_SEARCH_URL_CSS' ) ) define( 'HIWEB_SEARCH_URL_CSS', WP_PLUGIN_URL . '/' . basename( HIWEB_SEARCH_DIR ) . '/assets' );
	if( !defined( 'HIWEB_SEARCH_URL_JS' ) ) define( 'HIWEB_SEARCH_URL_JS', WP_PLUGIN_URL . '/' . basename( HIWEB_SEARCH_DIR ) . '/assets' );
	///Settings
	if( !defined( 'HIWEB_SEARCH_RELATIVE_MIN' ) ) define( 'HIWEB_SEARCH_RELATIVE_MIN', 0.2 ); //Минимальный предел схожести с запросом для вывода результата в функции hiweb_search()->get_posts();
	if( !defined( 'HIWEB_SEARCH_QUERY_INJECT' ) ) define( 'HIWEB_SEARCH_QUERY_INJECT', true ); //Встраиваться в QUERY поиска
	if( !defined( 'HIWEB_SEARCH_QUERY_INJECT_METHOD' ) ) define( 'HIWEB_SEARCH_QUERY_INJECT_METHOD', 2 ); //Методы встраивания в QUERY поиск: 1 - простой с заменой meta_query, 2 - поиск с анализом схожести (более медленный)
	if( !defined( 'HIWEB_SEARCH_META_NAME' ) ) define( 'HIWEB_SEARCH_META_NAME', 'hiweb_search_meta' );
	if( !defined( 'HIWEB_SEARCH_META_DELIMITER' ) ) define( 'HIWEB_SEARCH_META_DELIMITER', '|' );
	if( !defined( 'HIWEB_SEARCH_META_BOX' ) ) define( 'HIWEB_SEARCH_META_BOX', 1 ); //Показывать метабокс с индексными данными
	///
	if( !defined( 'HIWEB_SEARCH_KEY_LENGTH_MIN' ) ) define( 'HIWEB_SEARCH_KEY_LENGTH_MIN', 3 ); //Минимальное значение найденого ключа
	if( !defined( 'HIWEB_SEARCH_KEY_LENGTH_MAX' ) ) define( 'HIWEB_SEARCH_KEY_LENGTH_MAX', 96 ); //Максимальное значение найденого ключа
	if( !defined( 'HIWEB_SEARCH_USE_META' ) ) define( 'HIWEB_SEARCH_USE_META', false ); //Разрешать анализировать мета данные
	if( !defined( 'HIWEB_SEARCH_META_NAME_ALLOW_SPACE' ) ) define( 'HIWEB_SEARCH_META_NAME_ALLOW_SPACE', false ); //Разрешать анализировать мета данные, начинающиеся на символ "_"
	if( !defined( 'HIWEB_SEARCH_USE_TAXONOMY' ) ) define( 'HIWEB_SEARCH_USE_TAXONOMY', true ); //Разрешать анализировать таксономии
	if( !defined( 'HIWEB_SEARCH_USE_AUTHOR' ) ) define( 'HIWEB_SEARCH_USE_AUTHOR', true ); //Разрешать анализировать имя автора
	if( !defined( 'HIWEB_SEARCH_USE_DATE' ) ) define( 'HIWEB_SEARCH_USE_DATE', true ); //Разрешать анализировать дату

	if( !isset( $hiweb_search_disallow_post_type ) ){
		global $hiweb_search_disallow_post_type;
		$hiweb_search_disallow_post_type = [ 'attachment', 'revision', 'nav_menu_item' ];
	}

	if( !isset( $hiweb_search_post_allow_keys ) ){
		global $hiweb_search_post_allow_keys;
		$hiweb_search_post_allow_keys = [ 'post_title', 'post_content' ];
	}
	if( !isset( $hiweb_search_meta_disallow_keys ) ){
		global $hiweb_search_meta_disallow_keys;
		$hiweb_search_meta_disallow_keys = [ '_edit_last', '_edit_lock' ];
	}
	if( !isset( $hiweb_search_alternative_symbols ) ){
		global $hiweb_search_alternative_symbols;
		$hiweb_search_alternative_symbols = [
			'а' => 'о',
			'е' => [ 'ё', 'и' ],
			'и' => [ 'ы', 'а', 'е' ],
			'ш' => 'щ',
			'щ' => 'ш',
			'ы' => 'и',
			'о' => 'а',
			'ое' => 'ые'
		];
	}
	if( !isset( $hiweb_search_trans_symbols ) ){
		global $hiweb_search_trans_symbols;
		$hiweb_search_trans_symbols = [
			'а' => 'a',
			'б' => 'b',
			'в' => 'v',
			'г' => 'g',
			'д' => 'd',
			'е' => 'e',
			'ё' => 'e',
			'ж' => 'zh',
			'з' => 'z',
			'и' => 'i',
			'й' => 'y',
			'к' => 'k',
			'л' => 'l',
			'м' => 'm',
			'н' => 'n',
			'о' => 'o',
			'п' => 'p',
			'р' => 'r',
			'с' => 's',
			'т' => 't',
			'у' => 'u',
			'ф' => 'f',
			'х' => 'h',
			'ц' => 'c',
			'ч' => 'ch',
			'ш' => 'sh',
			'щ' => 'sch',
			'ь' => '\'',
			'ы' => 'y',
			'ъ' => '\'',
			'э' => 'e',
			'ю' => 'yu',
			'я' => 'ya'
		];
	}
	if( !isset( $hiweb_search_trans_symbols_back ) ){
		global $hiweb_search_trans_symbols_back;
		$hiweb_search_trans_symbols_back = [
			'c' => 'к',
			'y' => 'и',
			'e' => 'е'
		];
	}