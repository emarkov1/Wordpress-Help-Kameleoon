<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package KameleoonDocumentation
 */

get_header(); ?>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/level3.css">


<style>
  .icons .complexity{
    float: right;
  }
</style>

 <?php function getCurrentCatID(){  
      global $wp_query;  
      if(is_category() || is_single()){  
    $cat_ID = get_query_var('cat');  
      }  
      return $cat_ID;  
     }  ?>
<div class="articleContainer container">
  <div class="tree">
    <?php
      $category = get_queried_object();
      $category->term_id;
    ?>
    <!-- all categories -->

    <div class="treeCategory"><?php echo get_category_parents( $category->term_id, true, ' > '); ?></div>

    <!-- current category -->
    <h2 class="currentCategory"><?php echo get_cat_name($category->term_id);?></h2>

    <!-- parrent category -->
    <h3 class="previusCategory"><?php echo get_cat_name($category->parent);?></h3> 
  </div>

  <?php query_posts( array( 'category__and' => array($category->term_id) ) ); 
 while (have_posts()) : the_post();?>
  <div class="col-md-6 article">
    <div class="innerArticle">   
      <!--  was before -->
      <!-- <div class="thumbnail"><a href="<?php echo get_permalink(); ?>"><?php echo get_the_post_thumbnail(); ?> </a></div> -->
      <div class="thumbnail"><a href="<?php echo get_permalink(); ?>"> <?php if (has_post_thumbnail() ) {  echo get_the_post_thumbnail(); } 
      else{ ?> <img src="<?php bloginfo('template_directory'); ?>/img/logo-kamNew.png" alt=""> <?php } ?>   </a></div>
      
      <div class="articleText">
        <h2><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>

        <div class="fullText" hidden><?php the_content(); ?></div>

        <div class="icons">
          <img class="smallClock" src="<?php bloginfo('template_directory'); ?>/img/smallClock.png" alt="">
          <p class="howLong">3</p>
          <p class="min"> min</p>
          <div class="quizBlock">
            <img class="quizLeft" src="<?php bloginfo('template_directory'); ?>/img/quizLeft.png" alt="">
            <img class="quizRight" src="<?php bloginfo('template_directory'); ?>/img/quizRight.png" alt="">
            <p class="quiz">quiz</p>
          </div>
          <img class="complexity" src="<?php bloginfo('template_directory'); ?>/img/level2.png" alt="">
        </div>
        <!-- insted of <?php the_excerpt(); ?> -->
        <p><?php echo wp_trim_words( get_the_content(), 20 ); ?></p>


        <!-- <?php the_excerpt(); // вывод текста записи
        
        ?> -->
        <!-- <a href="<?php echo get_permalink(); ?>"> Read more → </a> -->
      </div>
    </div>
  </div>
   <?php endwhile;
      wp_reset_query(); ?>
</div>
<!--здесь выводится миниатюра записи-->




<?php
/*get_sidebar();*/
get_footer(); ?>
