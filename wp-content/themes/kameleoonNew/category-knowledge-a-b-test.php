<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package mise
 */




get_header(); ?>


<style>
    .searchBox{
      background-image: url("<?php bloginfo('template_directory'); ?>/img/hp-bg.png");
      height: 260px;
    }
 </style>


 <div class="searchBox">
  <div class="search container">
    <img id="searchMain" src="<?php bloginfo('template_directory'); ?>/img/searchMain.png" alt="searchMain">
    <img id="closeMain" src="<?php bloginfo('template_directory'); ?>/img/close.png" alt="closeMain">
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("mainSearch Sidebar") ) : ?>
    <?php endif; ?>
  </div>
</div>
<div class="tabs">
	<div class="container">
		<ul class="nav nav-tabs">
            <li class="col-xs-4 active"><a data-toggle="tab" href="#menu1"><?php $idObj = get_category_by_slug('knowledge-a-b-test'); $id = $idObj->term_id; echo get_cat_name($id) ?></a></li>
            <li class="col-xs-4"><a data-toggle="tab" href="#menu2"><?php $idObj = get_category_by_slug('knowledge-personnalisation'); $id = $idObj->term_id; echo get_cat_name($id) ?></a></li>
            <li class="col-xs-4"><a data-toggle="tab" href="#menu3"><?php $idObj = get_category_by_slug('knowledge-audiences'); $id = $idObj->term_id; echo get_cat_name($id) ?></a></li>
        </ul>
	</div>
</div>
<div class="linksContainer">
      <div class="categoryForMobile"><h2></h2></div>
		  <div class="tab-content">
            <div id="menu1" class="tab-pane fade in active">
              <div class="row rowFirst"> 
                  <div class="container">
                        <?php

                            $idObj = get_category_by_slug('knowledge-a-b-test');
                            $cat = $idObj->term_id;
                            $children_category = get_categories('child_of=' . $cat . '&hide_empty=0');
                            foreach ($children_category as $child_category) :
                                  if ($cat == $child_category->category_parent) :
                                      $temp .= "\t" . '<div class ="categoryLink"><a href="' .
                                          get_category_link($child_category->cat_ID) . '" title="' .
                                          $child_category->category_description . '">';
                                      $temp .= $child_category->cat_name . '</a>';
                                      $temp .= '</div>' . "\n";
                                      $i = $i+1;
                                  endif;
                            endforeach;   
                            print $temp;
                            $temp = '';
                        ?>
                  </div>
              </div> 
            </div>
            <div id="menu2" class="tab-pane fade">
              <div class="row rowFirst"> 
                  <div class="container">
                      <?php
                            $idObj = get_category_by_slug('knowledge-personnalisation');
                            $cat = $idObj->term_id;
                            $children_category = get_categories('child_of=' . $cat . '&hide_empty=0');
                            foreach ($children_category as $child_category) :
                                  if ($cat == $child_category->category_parent) :
                                      $temp .= "\t" . '<div class ="categoryLink"><a href="' .
                                          get_category_link($child_category->cat_ID) . '" title="' .
                                          $child_category->category_description . '">';
                                      $temp .= $child_category->cat_name . '</a>';
                                      $temp .= '</div>' . "\n";
                                      $i = $i+1;
                                  endif;
                            endforeach;   
                            print $temp;
                            $temp = '';
                        ?>
                  </div>
              </div> 
            </div>
            <div id="menu3" class="tab-pane fade">
                <div class="row rowFirst"> 
                  <div class="container">
                      <?php
                            $idObj = get_category_by_slug('knowledge-audiences');
                            $cat = $idObj->term_id;
                            $children_category = get_categories('child_of=' . $cat . '&hide_empty=0');
                            foreach ($children_category as $child_category) :
                                  if ($cat == $child_category->category_parent) :
                                      $temp .= "\t" . '<div class ="categoryLink"><a href="' .
                                          get_category_link($child_category->cat_ID) . '" title="' .
                                          $child_category->category_description . '">';
                                      $temp .= $child_category->cat_name . '</a>';
                                      $temp .= '</div>' . "\n";
                                      $i = $i+1;
                                  endif;
                            endforeach;   
                            print $temp;
                            $temp = '';
                        ?>
                  </div>
              </div> 
          </div>
	  </div>
</div>

<?php
/*get_sidebar();
get_sidebar('push');*/
get_footer();
