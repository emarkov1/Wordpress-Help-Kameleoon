<?php

	namespace hiweb_soft_search;


	abstract class prepare{

		/**
		 * Возвращает массив альтернатив слова
		 * @param string $wordStr
		 * @param array $swapSymbols
		 * @return array
		 */
		public function get_wordAlternatives( $wordStr = '', $swapSymbols = [] ){
			global $hiweb_search_alternative_symbols;
			$R = [];
			$wordStr = mb_strtolower( $wordStr, 'utf8' );
			if( mb_strlen( $wordStr ) > HIWEB_SEARCH_KEY_LENGTH_MAX ) return [ $wordStr ];
			$R[] = $wordStr;
			///ALTERNATIVES
			if( is_array( $hiweb_search_alternative_symbols ) ) foreach( $hiweb_search_alternative_symbols as $key => $items ){
				$substr_count = mb_substr_count( $wordStr, $key );
				$lastPos = 0;
				if( $substr_count > 0 ) for( $n = 0; $n < $substr_count; $n ++ ){
					$start = mb_strpos( $wordStr, $key, $lastPos );
					if( isset( $swapSymbols[ $start ] ) ) continue;
					$end = $start + mb_strlen( $key );
					$lastPos = $start + 1;
					if( is_array( $items ) ) foreach( $items as $item ){
						$word = mb_substr( $wordStr, 0, $start ) . $item . mb_substr( $wordStr, $end );
						$swapSymbols[ $start ][ $key ][] = $item;
						$R = array_merge( $R, $this->get_wordAlternatives( $word, $swapSymbols ) );
					} else {
						$word = mb_substr( $wordStr, 0, $start ) . $items . mb_substr( $wordStr, $end );
						$swapSymbols[ $start ][ $key ][] = $items;
						$R = array_merge( $R, $this->get_wordAlternatives( $word, $swapSymbols ) );
					}
				}
			}
			$R = array_unique( $R );
			return $R;
		}


		/**
		 * Extract search data from string
		 * @param string $string
		 * @return array
		 */
		public function prepare_source_string( $string ){
			$R = [];
			$items = preg_split( '/[^\w^\d]/iu', mb_strtolower( $string, 'utf8' ) );
			if( !is_array( $items ) || count( $items ) == 0 ) return [];
			foreach( $items as $item ){
				if( trim( $item ) == '' ) continue;
				$item = $this->get_wordAlternatives( $item );
				if( is_array( $item ) ) foreach( $item as $alternative ){
					$R[] = $alternative;
				}
			}
			$R = array_unique( $R );
			return $R;
		}
	}