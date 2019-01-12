<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package mise
 */

?>
<div class="container">
	<section class="no-results not-found">
		<header class="page-header">
			<h1 class="page-title"><?php nothingFoundTitle() ; ?></h1>
		</header><!-- .page-header -->
	
		
		<?php nothingFoundContent() ?>

		<!-- <div class="page-content">
			<?php
			if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
		
				<p>
				<?php
				/* translators: %1$s: create new post link */
				printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'mise' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) );
				?>
				</p>
		
			<?php elseif ( is_search() ) : ?>
		
				<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'mise' ); ?></p>
				<?php
					get_search_form();
		
			else : ?>
		
				<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'mise' ); ?></p>
				<?php
					get_search_form();
		
			endif; ?>
		</div> -->
		<!-- .page-content -->

		

	</section><!-- .no-results -->
</div>

<style>
	    .searchBox{
	      background-image: url("<?php bloginfo('template_directory'); ?>/img/hp-bg.png");
	      height: 260px;
	      margin-top: 20px
	    }
	    .articleContainer {
		    padding: 0;
	    	width: 100%;
	   	}
	   	.site-main > .entry{
	   		display:none;
	   	}
	   	.no-results .search-live{
	   		display:none
	   	}
	   	.footer{
	   		position:static;
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