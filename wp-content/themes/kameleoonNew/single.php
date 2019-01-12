<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package mise
 */

get_header(); ?>

	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/single.css">

<div class="container containerArticle">
	<div id="primary" class="content-area">

		<main id="main" class="site-main">
		
		<?php
		while ( have_posts() ) : the_post();
		endwhile; // End of the loop.
		?>
		<div class="infoBlock">
			<div class="tree">
				<?php $categories = get_the_category();?>
				<?php if($categories){
					foreach($categories as $category) {
					$category_id = $category->term_id;
					$cat_parents = get_category_parents($category_id, true, ' > ');
					}
				echo trim($cat_parents, ', ');
				}?>
			</div>
			<?php the_title('<h2 class = mainTitle>', '</h2>'); ?>
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
		</div>
			<div class="innerArticle">
				<?php if ( has_post_thumbnail()) {the_post_thumbnail(array(auto, 170),array("class"=>"alignleft post_thumbnail"));} ?>
				<div class="container contentArticle">
					<?php the_content(); ?>
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->
</div>

<?php
/*get_sidebar();
get_sidebar('push');*/
get_sidebar('tags');
get_footer();
