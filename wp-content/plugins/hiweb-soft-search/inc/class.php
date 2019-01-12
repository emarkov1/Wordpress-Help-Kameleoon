<?php
	/**
	 * Created by PhpStorm.
	 * User: hiweb
	 * Date: 21.08.2016
	 * Time: 9:00
	 */


	if (!function_exists('hiweb_search')) :
		function hiweb_search() {
			static $class;
			include_once 'define.php';
			if (is_null($class)) $class = new hiweb_search();
			return $class;
		}
	endif;


	if (!class_exists('hiweb_search')) :

		class hiweb_search {


			public $search_query;


/////HOOKS FUNCTIONS

			public function add_action_save_post($post_id, $post = null) {
				if (wp_is_post_autosave($post_id)) return;
				if (wp_is_post_revision($post_id)) return;
				$post = get_post($post_id);
				if (!$post instanceof WP_Post) return;
				///
				global $hiweb_search_disallow_post_type;
				$disallow_post_type = array_flip($hiweb_search_disallow_post_type);
				if (isset($disallow_post_type[$post->post_type])) return;
				///
				update_post_meta($post_id, HIWEB_SEARCH_META_NAME, $this->do_generatePostTags($post_id));
			}

			/**
			 * @param WP_Query $query
			 */
			public function add_action_pre_get_posts($query) {
				if (HIWEB_SEARCH_QUERY_INJECT && !is_admin() && $query->is_main_query() && $query->is_search && is_array($query->query_vars)) {
					$this->search_query = $query->get('s');
					$query->set('s', '');

					switch (HIWEB_SEARCH_QUERY_INJECT_METHOD) {
						case 1:
							$metaQuery = $this->get_queryMeta_bySearchStr($this->search_query);
							$query->set('meta_query', $metaQuery);
							break;
						case 2:
							$ids = $this->get_posts($this->search_query, $query->query_vars, true);
							if(!is_array($ids) || count($ids) == 0) $query->set('s', $this->search_query);
							else {
								$query->set('post__in', $ids);
								$query->set('orderby', 'post__in');
							}
							break;
					}
				}
			}


			public function add_action_wp() {
				if (HIWEB_SEARCH_QUERY_INJECT) {
					global $wp_query;
					$wp_query->set('s', $this->search_query);
				}
			}


			public function ajax() {
				if (isset($_POST['do'])) {
					///
					if ($_POST['do'] == 'regenerate') {
						$post = get_post($_POST['id']);
						if ($post instanceof WP_Post) {
							$metaIndex = $this->do_generatePostTags($post);
							update_post_meta($post->ID, HIWEB_SEARCH_META_NAME, '');
							$result = update_post_meta($post->ID, HIWEB_SEARCH_META_NAME, $metaIndex);
							if ($result) {
								echo json_encode($metaIndex);
							} else {
								echo json_encode(array('update_post_meta id:' . $post->ID . ' error', $result, $metaIndex));
							}

						} else {
							echo json_encode(array('result' => false, 'message' => 'не найден пост id=' . $_POST['id'], 'post' => $_POST));
						}
					}
					elseif($_POST['do'] == 'regenerate_select_pt'){
						$posts = get_posts(array(
							'posts_per_page' => -1,
							'post_status' => 'any',
							'post_type' => $_POST['post_types']
						));
						$R = array();
						foreach ($posts as $post){
							$R[] = $post->ID;
						}
						echo json_encode($R);
					}
					else {
						echo json_encode(array('result' => false, 'message' => 'не известный параметр DO'));
					}
					///
				} else {
					echo json_encode(array('result' => false, 'message' => 'не передан параметр DO'));
				}
				die;
			}

///////////////////////

			/**
			 * Возвращает массив вариаций поискового запроса
			 * @param $searchQueryStr
			 * @return array
			 */
			public function get_searchArr($searchQueryStr) {
				$searchExplode = explode(' ', mb_strtolower($searchQueryStr, 'utf8'));
				$searchExplode = $this->getArr_variants($searchExplode, 10, false, ' ');
				///Translite
				global $hiweb_search_trans_symbols;
				if (is_array($hiweb_search_trans_symbols)) {
					global $hiweb_search_trans_symbols_back;
					$hiweb_search_trans_symbols = array_merge($hiweb_search_trans_symbols, array_flip($hiweb_search_trans_symbols), $hiweb_search_trans_symbols_back);
					foreach ($searchExplode as $key => $item) {
						$newItem = strtr($item, $hiweb_search_trans_symbols);
						if ($item != $newItem) $searchExplode[] = $newItem;
					}
				}
				$searchExplode = array_unique($searchExplode);
				return $searchExplode;
			}

			/**
			 * Возвращает массив комбинаций, учитывая лимит
			 * @param array $items - элементы для перебора
			 * @param int $limit - лимит элементов в результатах комбинаций
			 * @param bool $repeatItems - использовать один элемент несколько раз в одной комбинации
			 * @param bool $arrayOrDelimiter - TRUE - если нужно вернуть массивы комбинаций в общем массиве, либо делимитер для элементов в строке
			 * @return array
			 */
			public function getArr_variants($items = array(), $limit = 5, $repeatItems = false, $arrayOrDelimiter = false) {
				static $excludeItems = array();
				$R = array();
				if (!is_array($items)) return array();
				if (!$repeatItems && count($items) < $limit) $limit = count($items);
				///
				foreach ($items as $item) {
					if (isset($excludeItems[$item])) continue;
					if (!$repeatItems) $excludeItems[$item] = '';
					$R[] = $arrayOrDelimiter === true ? array($item) : $item;
					///
					if (strlen($item) > 3) {
						$itemShort = mb_substr($item, 0, mb_strlen($item) - 1);
						$R[] = $arrayOrDelimiter === true ? array($itemShort) : $itemShort;
					}
					///
					if ($limit > 1) {
						foreach ($this->getArr_variants($items, $limit - 1, $repeatItems, $arrayOrDelimiter) as $subItem) {
							$R[] = $arrayOrDelimiter === true ? array_merge(array($item), $subItem) : $item . $arrayOrDelimiter . $subItem;
						}
					}
					unset($excludeItems[$item]);
				}
				///
				return $R;
			}

			/**
			 * Возращает массив Meta Query
			 * @param string $searchStr
			 * @return array
			 */
			public function get_queryMeta_bySearchStr($searchStr = '') {
				$R = array();
				foreach ($this->get_searchArr($searchStr) as $item) {
					$R[] = array(
						'key' => HIWEB_SEARCH_META_NAME,
						'value' => $item,
						'compare' => 'LIKE'
					);
				}
				if (count($R) > 1) {
					$R['relation'] = 'OR';
				}
				return $R;
			}


			public function array_sort_length($a, $b) {
				return mb_strlen($b) - mb_strlen($a);
			}


			/**
			 * Возвращает релативные посты, либо ID постов, сортируя по схожести с запросом
			 * @param string $searchStr
			 * @param array $query
			 * @param bool $returnOnlyIds
			 * @return array
			 */
			public function get_posts($searchStr = '', $query = array(), $returnOnlyIds = false) {
				$searchStr = mb_strtolower($searchStr, 'utf8');
				$query = new WP_Query($query);
				$postsByRelative = array();
				$query->set('meta_query', $this->get_queryMeta_bySearchStr($searchStr));
				$posts = $query->get_posts();
				$searchAlternatives = $this->get_searchArr($searchStr);
				usort($searchAlternatives, array($this, 'array_sort_length'));
				array_unshift($searchAlternatives, $searchStr);
				if (is_array($posts)) foreach ($posts as $post) {
					$relative = $this->get_relativeBetween($searchAlternatives, $post);
					if ($relative >= HIWEB_SEARCH_RELATIVE_MIN) $postsByRelative[$relative][] = $returnOnlyIds ? $post->ID : $post;
				}
				ksort($postsByRelative);
				if (strtolower($query->get('order')) == 'desc') $postsByRelative = array_reverse($postsByRelative);
				$R = array();
				foreach ($postsByRelative as $posts) {
					$R = array_merge($R, $posts);
				}
				return $R;
			}


			/**
			 * Устанавливает балл схожести поста с запросом
			 * @param array $searchAlternatives
			 * @param null $postOrId
			 * @return bool|int
			 */
			private function get_relativeBetween($searchAlternatives = array(), $postOrId = null) {
				$R = 0;
				$post = get_post($postOrId);
				if (!$post instanceof WP_Post) return false;
				$meta = get_post_meta($post->ID, HIWEB_SEARCH_META_NAME, true);
				$metaExplode = explode(HIWEB_SEARCH_META_DELIMITER, $meta);
				$k = 1;
				$kStep = 1 / count($searchAlternatives);
				foreach ($searchAlternatives as $word) {
					if (strpos($meta, $word) !== false) $R += $k;
					foreach ($metaExplode as $subMeta) {
						$math = false;
						if($word == $subMeta) {
							$R +=  $k / 2;
							$math = true;
						}
						elseif (strpos($word, $subMeta) !== false) {
							$R +=  $k / 4;
							$math = true;
						}
						else if (strpos($subMeta, $word) !== false) {
							$R +=  $k / 8;
							$math = true;
						}
						if($math) break;
					}
					$k -= $kStep;
				}
				//todo
				hiweb()->console( $post->post_title.' → '.$R );
				return $R;
			}


			/**
			 * Генерация мета индекса в посте
			 * @param $postOrId
			 * @return bool|string
			 */
			public function do_generatePostTags($postOrId) {
				$tags = $this->get_generatedMetaIndex_fromPost($postOrId);
				if (!is_array($tags)) return false;
				///Alternative Symbols Make
				foreach ($tags[0] as $key => $item) {
					$tags[0] = array_merge($tags[0], $this->get_wordAlternatives($item));
				}
				///Translite
//				global $hiweb_search_trans_symbols;
//				if (is_array($hiweb_search_trans_symbols)) {
//					global $hiweb_search_trans_symbols_back;
//					$hiweb_search_trans_symbols = array_merge($hiweb_search_trans_symbols, array_flip($hiweb_search_trans_symbols), $hiweb_search_trans_symbols_back);
//					foreach ($tags[0] as $key => $item) {
//						$newItem = strtr($item, $hiweb_search_trans_symbols);
//						if ($item != $newItem) $tags[0][] = $newItem;
//					}
//				}
				$tags[0] = array_unique($tags[0]);
				////
				return implode(HIWEB_SEARCH_META_DELIMITER, $tags[0]);
			}


			/**
			 * Возвращает массив альтернатив слова
			 * @param string $wordStr
			 * @param array $swapSymbols
			 * @return array
			 */
			public function get_wordAlternatives($wordStr = '', $swapSymbols = array()) {
				global $hiweb_search_alternative_symbols;
				$R = array();
				$wordStr = mb_strtolower($wordStr, 'utf8');
				if(mb_strlen($wordStr) > HIWEB_SEARCH_KEY_LENGTH_MAX) return array($wordStr);
				$R[] = $wordStr;
				///ALTERNATIVES
				if (is_array($hiweb_search_alternative_symbols)) foreach ($hiweb_search_alternative_symbols as $key => $items) {
					$substr_count = mb_substr_count($wordStr, $key);
					$lastPos = 0;
					if ($substr_count > 0) for ($n = 0; $n < $substr_count; $n++) {
						$start = mb_strpos($wordStr, $key, $lastPos);
						if (isset($swapSymbols[$start])) continue;
						$end = $start + mb_strlen($key);
						$lastPos = $start + 1;
						if (is_array($items)) foreach ($items as $item) {
							$word = mb_substr($wordStr, 0, $start) . $item . mb_substr($wordStr, $end);
							$swapSymbols[$start][$key][] = $item;
							$R = array_merge($R, $this->get_wordAlternatives($word, $swapSymbols));
						} else {
							$word = mb_substr($wordStr, 0, $start) . $items . mb_substr($wordStr, $end);
							$swapSymbols[$start][$key][] = $items;
							$R = array_merge($R, $this->get_wordAlternatives($word, $swapSymbols));
						}
					}
				}
				$R = array_unique($R);
				return $R;
			}


			/**
			 * Получение массива данных из поста либо FALSE, если ошибка чтения поста
			 * @param $postOrId
			 * @return array|bool
			 */
			public function get_generatedMetaIndex_fromPost($postOrId) {
				$R = array(0 => array());
				$post = get_post($postOrId);
				if (!$post instanceof WP_Post) {
					return false;
				} else {

					global $hiweb_search_post_allow_keys;
					if (is_array($hiweb_search_post_allow_keys)) foreach ($hiweb_search_post_allow_keys as $key) {
						if (array_key_exists($key, (array)$post)) {
							$value = strip_tags($post->{$key});
							if (strlen($value) >= HIWEB_SEARCH_KEY_LENGTH_MIN && strlen($value) <= HIWEB_SEARCH_KEY_LENGTH_MAX) {
								$value = mb_strtolower($value, 'utf8');
								$R['post'][$key] = $value;
								$R[0][] = $value;
							}

						}
					}
					///Metas
					if (HIWEB_SEARCH_USE_META) {
						global $hiweb_search_meta_disallow_keys;
						$meta_disallow = array_flip($hiweb_search_meta_disallow_keys);
						$R['meta'] = array();
						$meta = get_post_meta($post->ID);
						if (is_array($meta)) foreach ($meta as $key => $item) {
							if ((strpos($key, '_') !== 0 || HIWEB_SEARCH_META_NAME_ALLOW_SPACE) && $key != HIWEB_SEARCH_META_NAME && !array_key_exists($key, $meta_disallow)) {
								$value = strip_tags(reset($item));
								if (strlen($value) >= HIWEB_SEARCH_KEY_LENGTH_MIN && strlen($value) <= HIWEB_SEARCH_KEY_LENGTH_MAX) {
									$R['meta'][$key] = mb_strtolower($value, 'utf8');
								}
							}
						}
						$R[0] = array_merge($R[0], $R['meta']);
					}
					///Taxonomies
					if (HIWEB_SEARCH_USE_TAXONOMY) {
						$R['taxonomy'] = array();
						$taxonomies = get_object_taxonomies($post->post_type, 'objects');
						if (is_array($taxonomies)) foreach ($taxonomies as $taxonomyName => $taxonomy) {
							$terms = wp_get_post_terms($post->ID, $taxonomyName);
							if (is_array($terms)) foreach ($terms as $term) {
								$value = $term->name;
								if (strlen($value) >= HIWEB_SEARCH_KEY_LENGTH_MIN && strlen($value) <= HIWEB_SEARCH_KEY_LENGTH_MAX) {
									$R['taxonomy'][$taxonomyName . ':' . $term->slug] = mb_strtolower($value, 'utf8');
								}
							}
						}
						$R[0] = array_merge($R[0], $R['taxonomy']);
					}
					///Author
					if (HIWEB_SEARCH_USE_AUTHOR) {
						$author = get_user_by('id', $post->post_author);
						if ($author instanceof WP_User) {
							$R['author'][] = $author->data->display_name;
							$R['author'][] = $author->data->user_nicename;
							$R[0] = array_merge($R[0], $R['author']);
						}
					}
					///Date
					if (HIWEB_SEARCH_USE_DATE) {
						$R['date'][] = get_the_date('Y', $post);
						$R['date'][] = get_the_date('j', $post);
						$R['date'][] = get_the_date('n', $post);
						$R['date'][] = strtolower(get_the_date('F', $post));
						$R['date'][] = strtolower(get_the_date('M', $post));
						$m = array();
						switch ((int)get_the_date('n', $post)) {
							case 1:
								$m = array('января', 'январь', 'янв');
								break;
							case 2:
								$m = array('февраля', 'февраль', 'фев');
								break;
							case 3:
								$m = array('марта', 'март', 'мар');
								break;
							case 4:
								$m = array('апреля', 'апрель', 'апр');
								break;
							case 5:
								$m = array('мая', 'май');
								break;
							case 6:
								$m = array('июня', 'июнь', 'июн');
								break;
							case 7:
								$m = array('июля', 'июль', 'июл');
								break;
							case 8:
								$m = array('августа', 'август', 'авг');
								break;
							case 9:
								$m = array('сентября', 'сентябрь', 'сен');
								break;
							case 10:
								$m = array('октября', 'октябрь', 'окт');
								break;
							case 11:
								$m = array('ноября', 'ноябрь', 'ноя');
								break;
							case 12:
								$m = array('декабря', 'декабрь', 'дек');
								break;
						}
						$R['date'] = array_merge($R['date'], $m);
						$R[0] = array_merge($R[0], $R['date']);
					}

				}
				//$R[0] = array_unique($R[0]);
				return $R;
			}

		}

	endif;