<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mise
 */

?>

	</div><!-- #content -->



	<!-- <?php $showSearchButton = mise_options('_search_button', '1');
	if ($showSearchButton) : ?>
		Start: Search Form
		<div class="opacityBoxSearch"></div>
		<div class="search-container">
			<?php get_search_form(); ?>
		</div>
		End: Search Form
	<?php endif; ?> -->

	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/media.css">

	<div class="footer">
	<div class="container">
		<ul class="insta">
			<li>
				<p class="rsociaux">
					<a href="https://www.linkedin.com/company/kameleoon"><img src="https://www.kameleoon.com//img/footer_linkedin.png" alt="linkedin"></a>
					<a href="https://fr-fr.facebook.com/kameleoonrocks"><img src="https://www.kameleoon.com//img/footer_facebook.png" alt="facebook"></a>
					<a href="https://twitter.com/kameleoonrocks"><img src="https://www.kameleoon.com//img/footer_twitter.png" alt="twitter"></a>
					<a href="https://www.instagram.com/kameleoonrocks"><img src="https://www.kameleoon.com//img/footer_instagram.png" alt="instagram"></a>
				</p>
			</li>
		</ul>
		<?php wp_nav_menu('menu=Footer&container='); ?>   
		<!-- <img id="message" src="<?php bloginfo('template_directory'); ?>/img/message.png" alt=""> -->
	</div>
</div>
    
</div><!-- #page -->
<?php $scrollToTopMobile = mise_options('_scroll_top', ''); ?>
<a href="#top" id="toTop" class="<?php echo $scrollToTopMobile ? 'scrolltop_on' : 'scrolltop_off' ?>"><i class="fa fa-angle-up fa-lg"></i></a>
<?php wp_footer(); ?>
<script src="<?php bloginfo('template_directory'); ?>/my.js"></script>






</body>
</html>
