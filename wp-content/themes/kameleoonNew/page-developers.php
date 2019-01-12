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
  iframe{
    margin-top: 90px;
    width: 100%;
    border: none;
    position: absolute;
    height: 100%;
  }
  #search{
    display: block;
  }
</style>

<!-- <div id="primary" class="content-area">
    <main id="main" class="site-main"> -->

<iframe src="http://andustar.kameleoon.net/docs/" >
    Your browser does not support iframes!
</iframe>

<!-- </main>#main
  </div>#primary -->

<?php
/*get_sidebar();*/
/*get_sidebar('push');*/
get_footer();
