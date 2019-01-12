<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KameleoonDocumentation
 */

get_header(); ?>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/faq.css">
<!-- <div class="tabs">
        <div class="container">
            <ul class="nav nav-tabs">
                <li class="col-md-6 active"><a><?php echo get_cat_name(get_cat_ID( 'FAQ' ));?></a></li>
                <li class="col-md-6"><a href="<?php echo get_category_link(get_cat_ID( 'Tools' )); ?>"><?php echo get_cat_name(get_cat_ID( 'Tools' ));?></a></li>
            </ul>
        </div>
    </div>     -->    
<div class="linksContainer">
        <div class="tab-content">
          <div id="menu1" class="tab-pane fade in active">
              <div class="row firstRow">
                  <div class="container">
                    <h2 class="nameTheme"><?php $idObj = get_category_by_slug('frequently-asked-questions '); $id = $idObj->term_id; echo get_cat_name($id) ?></h2>
                    <?php $idObj = get_category_by_slug('frequently-asked-questions '); query_posts( array( 'category__and' => array($idObj->term_id) ) ); 
                     while (have_posts()) : the_post();?>
                        <div class = "articleName"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></div>
                       <?php endwhile;
                          wp_reset_query(); ?>
                </div>
              </div>
              <div class="row secondRow">
                  <div class="container">
                      <h2 class="nameTheme"><?php $idObj = get_category_by_slug('technical'); $id = $idObj->term_id; echo get_cat_name($id) ?></h2>
                      <?php $idObj = get_category_by_slug('technical'); query_posts( array( 'category__and' => array($idObj->term_id) ) ); 
                       while (have_posts()) : the_post();?>
                          <div class = "articleName"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></div>
                         <?php endwhile;
                            wp_reset_query(); ?>
                  </div>
            </div>
            <div class="row thirdRow">
                <div class="container">
                    <h2 class="nameTheme"><?php $idObj = get_category_by_slug('troubleshooting'); $id = $idObj->term_id; echo get_cat_name($id) ?></h2>
                    <?php $idObj = get_category_by_slug('troubleshooting'); query_posts( array( 'category__and' => array($idObj->term_id) ) ); 
                     while (have_posts()) : the_post();?>
                        <div class = "articleName"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></div>
                       <?php endwhile;
                          wp_reset_query(); ?>
                </div>
            </div>
          </div>


          <!-- <div id="menu2" class="tab-pane fade">
             <div class="row rowFirst">
                <div class="container">
                    <h2 class="nameTheme">Theme 1</h2>
                    <div class="col-md-6 tabLeft">
                        <h3 style="color:#14c5e5" >premiers pas</h3>
                        <h3>analyse des resultats</h3>
                        <h3>ciblage et deviation</h3>
                    </div>
                    <div class="col-md-6 tabRight">
                        <h3>test a/b en detail</h3>
                        <h3>mon compte kameleoon</h3>
                        <h3>b.a.-ba du test ab</h3>
                    </div>
                  </div>
              </div>
              <div class="row rowSecond">
                  <div class="container">
                    <h2 class="nameTheme">Theme 2</h2>
                     <div class="col-md-6 tabLeft">
                        <h3 style="color:#14c5e5" >premiers pas</h3>
                        <h3>analyse des resultats</h3>
                        <h3>ciblage et deviation</h3>
                    </div>
                    <div class="col-md-6 tabRight">
                        <h3>test a/b en detail</h3>
                        <h3>mon compte kameleoon</h3>
                        <h3>b.a.-ba du test ab</h3>
                    </div>
                  </div>
            </div>
            <div class="row rowThird">
                <div class="container">
                  <h2 class="nameTheme">Theme 3</h2>
                     <div class="col-md-6 tabLeft">
                        <h3 style="color:#14c5e5" >premiers pas</h3>
                        <h3>analyse des resultats</h3>
                        <h3>ciblage et deviation</h3>
                    </div>
                    <div class="col-md-6 tabRight">
                        <h3>test a/b en detail</h3>
                        <h3>mon compte kameleoon</h3>
                        <h3>b.a.-ba du test ab</h3>
                    </div>
                </div>
            </div>
          </div>
           -->
        </div>
    <img id="message" src="<?php bloginfo('template_directory'); ?>/img/message.png" alt="">
</div>
<?php
/*get_sidebar();*/
get_footer(); ?>