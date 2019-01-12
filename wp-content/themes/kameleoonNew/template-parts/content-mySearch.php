<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package mise
 */

?>
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

