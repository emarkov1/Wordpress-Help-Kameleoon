<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mise
 */
 
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

 <!-- my -->
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/style.css">
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/bootstrap.min.css">
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/main.css">
<script src="<?php bloginfo('template_directory'); ?>/jquery-3.2.1.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/bootstrap.min1.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/device.js"></script>
<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<!-- <?php if(mise_options('_show_loader', '0') == 1 ) : ?>
	<div class="miseLoader">
		<?php mise_loadingPage(); ?>
	</div>
<?php endif; ?> -->
<div id="page" class="site">

	<!-- <?php if (is_singular(array( 'post', 'page' )) && '' != get_the_post_thumbnail() && !is_page_template('template-onepage.php') ) : ?>
		<?php while ( have_posts() ) : 
		the_post(); ?>
		<?php 
			$src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'mise-the-post');
			$firstLetterReverseColor = mise_options('_reverse_color', '1');
			$showScrollDownButton = mise_options('_scrolldown_button', '1');
			$zoomEffectFeatImage = mise_options('_zoomeffect_featimage', '1');
		?>
		<div class="miseBox">
			<div class="miseBigImage <?php echo $zoomEffectFeatImage ? 'withZoom' : 'noZoom' ?>" style="background-image: url(<?php echo esc_url($src[0]); ?>);">
				<div class="miseImageOp">
				</div>
			</div>
			<div class="miseBigText">
				<header class="entry-header <?php echo $firstLetterReverseColor ? 'reverse' : 'noReverse' ?>">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					<?php if ( 'post' === get_post_type() ) : ?>
					<div class="entry-meta">
						<?php mise_posted_on(); ?>
						<?php if ($showScrollDownButton) : ?>
							<div class="scrollDown"><span class="mouse-wheel"></span></div>
						<?php endif; ?>
					</div>.entry-meta
					<?php else: ?>
						<?php if ($showScrollDownButton) : ?>
							<div class="entry-meta">
								<div class="scrollDown"><span class="mouse-wheel"></span></div>
							</div>.entry-meta
						<?php endif; ?>
					<?php endif; ?>
				</header>.entry-header
			</div>
		</div>
		<?php endwhile; ?>
	<?php endif; ?>
	<?php if (is_page_template('template-onepage.php') && mise_options('_onepage_section_slider', '1') == 1) : ?>
		<?php get_template_part( 'sections/section', 'slider' ); ?>
	<?php endif; ?> -->
	
	<nav id="header">
	    <script>
	    if( !document.getElementById("home") ) {
	        document.getElementById("header").className += " scrolled";
	    }
	    </script>
	    <div class="container_left"> <?php the_custom_logo(); ?>
	        <div class="imgKameleoon"><a href="<?php echo get_home_url(); ?>"></a></div>
	        <hr>
	        <a href="<?php echo get_home_url(); ?>">Documentation</a>
	    </div>
		
	    <div class="container_right container">       
	        <?php wp_nav_menu('menu=main&container='); ?>   
	        <button class="navbar-toggle new-navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-collapse">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	        </button>
	    </div>
	    <div class="container-search-flags">
	        <img id="search" src="<?php bloginfo('template_directory'); ?>/img/search.png" alt="">
	        <div class="searchContainer">
	            <div class="searchBar ">
	                <!-- <input type="text" placeholder="Rechercher..."> -->
	                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("New Sidebar") ) : ?>
    				<?php endif; ?>
	                <img id="closeSmall" src="<?php bloginfo('template_directory'); ?>/img/close.png" alt="">
	            </div>
	        </div>
	        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("qTranslate Sidebar") ) : ?>
    		<?php endif; ?>
	        <!-- <ul class="menu flags">
	        	<li class="nav-sub_lang hasSub menu-item-has-children">
	                <a class="nav-sub-link"><img src="https://www.kameleoon.com/img/base/flags/en.png"></a>
	                <div class="nav-sub">
	                    <ul class="nav-sub_container">
	                        <li>
	                            <a href="<?= $dir; ?>en/<?= $url_parse[2]; ?><?php if( isset($url_parse[3]) ) echo '/' . $url_parse[3]; ?>"><span><img src="https://www.kameleoon.com/img/base/flags/en.png"></span> English</a>
	                        </li>
	                        <li>
	                            <a href="<?= $dir; ?>fr/<?= $url_parse[2]; ?><?php if( isset($url_parse[3]) ) echo '/' . $url_parse[3]; ?>"><span><img src="https://www.kameleoon.com/img/base/flags/fr.png"></span> Français</a>
	                        </li>
	                        <li>
	                            <a href="<?= $dir; ?>fr/<?= $url_parse[2]; ?><?php if( isset($url_parse[3]) ) echo '/' . $url_parse[3]; ?>"><span><img src="https://www.kameleoon.com/img/base/flags/de.png"></span> Deutsh</a>
	                        </li>
	                    </ul>
	                </div> 
	            </li>
	        </ul> -->
	    </div>
	</nav>

	<!-- <?php if ( is_active_sidebar( 'sidebar-push' ) ) : ?>
		<div class="hamburger">
			<span></span>
			<span></span>
			<span></span>
		</div>
	<?php endif; ?>
	<?php 
	$showInFloat = mise_options('_social_float', '1');
	if ($showInFloat == 1) {
		mise_show_social_network('float');
	} ?> -->

	<div id="content" class="site-content">
