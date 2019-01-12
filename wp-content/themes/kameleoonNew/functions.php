<?php
/**
 * mise functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package mise
 */

if ( ! function_exists( 'mise_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function mise_setup() {
	/*
		 * Define the number of items in some onepage sections (real value plus 1)
		 */
		define( 'MISE_VALUE_FOR_SLIDER', '4' );
		define( 'MISE_VALUE_FOR_FEATURES', '5' );
		define( 'MISE_VALUE_FOR_SKILLS', '11' );
		define( 'MISE_VALUE_FOR_SERVICES', '7' ); 
		define( 'MISE_VALUE_FOR_TEAM', '7' );
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on mise, use a find and replace
	 * to change 'mise' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'mise', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	add_theme_support( 'custom-logo', array(
		'height'      => 60,
		'width'       => 250,
		'flex-width' => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'mise-the-post' , 1920, 99999);
	add_image_size( 'mise-little-post', 370, 260, true);

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'mise' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	
	/*
	 * Starter Content Support
	 */
	add_theme_support( 'starter-content', array(
		'posts' => array(
			'home' => array(
				'template' => 'template-onepage.php',
			),
			'blog',
		),
		'options' => array(
			'show_on_front'  => 'page',
			'page_on_front'  => '{{home}}',
			'page_for_posts' => '{{blog}}',
			'mise_theme_options[_onepage_section_slider]' => '1',
			'mise_theme_options[_onepage_image_1_slider]' => get_template_directory_uri().'/images/example/mise_slider_example_1.jpg',
			'mise_theme_options[_onepage_image_2_slider]' => get_template_directory_uri().'/images/example/mise_slider_example_2.jpg',
			'mise_theme_options[_onepage_text_1_slider]' => 'Welcome to Mise Theme',
			'mise_theme_options[_onepage_subtext_1_slider]' => 'Use the customizer to customize the onepage sections',
			'mise_theme_options[_onepage_text_2_slider]' => 'Read the documentation',
			'mise_theme_options[_onepage_subtext_2_slider]' => 'You can find the documentation in "Appearance-> About Mise-> Documentation"',
			'mise_theme_options[_onepage_section_skills]' => '1',
			'mise_theme_options[_onepage_skillname_1_skills]' => 'Design',
			'mise_theme_options[_onepage_skillvalue_1_skills]' => '84',
			'mise_theme_options[_onepage_skillname_2_skills]' => 'WordPress',
			'mise_theme_options[_onepage_skillvalue_2_skills]' => '93',
			'mise_theme_options[_onepage_skillname_3_skills]' => 'SEO',
			'mise_theme_options[_onepage_skillvalue_3_skills]' => '76',
			'mise_theme_options[_onepage_skillname_4_skills]' => 'Support',
			'mise_theme_options[_onepage_skillvalue_4_skills]' => '90',
			'mise_theme_options[_onepage_skillname_5_skills]' => 'Customization',
			'mise_theme_options[_onepage_skillvalue_5_skills]' => '89',
			'mise_theme_options[_onepage_skillname_6_skills]' => 'Updates',
			'mise_theme_options[_onepage_skillvalue_6_skills]' => '87',
			'mise_theme_options[_onepage_section_cta]' => '1',
			'mise_theme_options[_onepage_phrase_cta]' => 'Do you want more?',
			'mise_theme_options[_onepage_desc_cta]' => 'Take a look at Mise PRO version...',
			'mise_theme_options[_onepage_textbutton_cta]' => 'PRO Version',
			'mise_theme_options[_onepage_urlbutton_cta]' => 'https://crestaproject.com/demo/mise-pro/',
		),
		'nav_menus' => array(
			'primary' => array(
				'name' => __( 'Primary', 'mise' ),
				'items' => array(
					'link_home',
					'page_blog',
				),
			),
		),
	) );
}
endif;
add_action( 'after_setup_theme', 'mise_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function mise_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'mise_content_width', 765 );
}
add_action( 'after_setup_theme', 'mise_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function mise_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Classic Sidebar', 'mise' ),
		'id'            => 'sidebar-classic',
		'description'   => esc_html__( 'Add widgets here.', 'mise' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title"><h3><span>',
		'after_title'   => '</span></h3></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Push Sidebar', 'mise' ),
		'id'            => 'sidebar-push',
		'description'   => esc_html__( 'Add widgets here.', 'mise' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title"><h3><span>',
		'after_title'   => '</span></h3></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'mise' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here.', 'mise' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title"><h3><span>',
		'after_title'   => '</span></h3></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'mise' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Add widgets here.', 'mise' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title"><h3><span>',
		'after_title'   => '</span></h3></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'mise' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Add widgets here.', 'mise' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title"><h3><span>',
		'after_title'   => '</span></h3></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'New sidebar', 'mise' ),
		'id'            => 'new-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'mise' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title"><h3><span>',
		'after_title'   => '</span></h3></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Tags sidebar', 'mise' ),
		'id'            => 'tags-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'mise' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title"><h3><span>',
		'after_title'   => '</span></h3></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'mainSearch sidebar', 'mise' ),
		'id'            => 'mainSearch-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'mise' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title"><h3><span>',
		'after_title'   => '</span></h3></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'qTranslate sidebar', 'mise' ),
		'id'            => 'qTranslate-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'mise' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title"><h3><span>',
		'after_title'   => '</span></h3></div>',
	) );
}
add_action( 'widgets_init', 'mise_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function mise_scripts() {
	wp_enqueue_style( 'mise-style', get_stylesheet_uri() );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() .'/css/font-awesome.min.css');
	wp_enqueue_style( 'mise-ie', get_template_directory_uri() . '/css/ie.css', array(), '1.0', null );
	wp_style_add_data( 'mise-ie', 'conditional', 'IE' );
	$query_args = array(
		'family' => 'Roboto:400,700%7CMontserrat:400,700'
	);
	wp_enqueue_style( 'mise-googlefonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), null );

	/*wp_enqueue_script( 'mise-custom', get_template_directory_uri() . '/js/jquery.mise.js', array('jquery'), '1.0', true );*/
	if ( is_active_sidebar( 'sidebar-push' ) ) {
		wp_enqueue_script( 'mise-nanoScroll', get_template_directory_uri() . '/js/jquery.nanoscroller.min.js', array('jquery'), '1.0', true );
	}
	wp_enqueue_script( 'mise-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'mise-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	if (is_page_template('template-onepage.php') && mise_options('_onepage_section_slider', '1') == 1) {
		wp_enqueue_script( 'mise-flex-slider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array(), '20151215', true );
	}
	if (is_page_template('template-onepage.php')) {
		wp_enqueue_script( 'mise-waypoints', get_template_directory_uri() . '/js/jquery.waypoints.min.js', array('jquery'), '1.0', true );
	}
	if ( mise_options('_smooth_scroll', '1') == 1) {
		wp_enqueue_script( 'mise-smooth-scroll', get_template_directory_uri() . '/js/SmoothScroll.min.js', array('jquery'), '1.0', true );
	}
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	/* Dequeue default WooCommerce Layout */
	wp_dequeue_style ( 'woocommerce-layout' );
	wp_dequeue_style ( 'woocommerce-smallscreen' );
	wp_dequeue_style ( 'woocommerce-general' );
}
add_action( 'wp_enqueue_scripts', 'mise_scripts' );

/**
 * WooCommerce Support
 */
if ( ! function_exists( 'mise_woocommerce_support' ) ) :
	function mise_woocommerce_support() {
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-lightbox' );
	}
	add_action( 'after_setup_theme', 'mise_woocommerce_support' );
endif; // mise_woocommerce_support

/**
 * WooCommerce: Chenge default max number of related products to 3
 */
if ( function_exists( 'is_woocommerce' ) ) :
	if ( ! function_exists( 'mise_related_products_args' ) ) :
		add_filter( 'woocommerce_output_related_products_args', 'mise_related_products_args' );
		function mise_related_products_args( $args ) {
			$args['posts_per_page'] = 3;
			return $args;
		}
	endif;
	if ( ! function_exists( 'mise_wc_get_product_cat_class' ) ) :
		function mise_wc_get_product_cat_class($classes, $class, $category) {
			$classes[] = 'three-columns';
			return array_unique( array_filter( $classes ) );
		}
		add_filter( 'product_cat_class' , 'mise_wc_get_product_cat_class', 10, 3 );
	endif;
endif;

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load PRO Button in the customizer
 */
require_once( trailingslashit( get_template_directory() ) . 'inc/pro-button/class-customize.php' );

/* Calling in the admin area for the Welcome Page */
if ( is_admin() ) {
	require get_template_directory() . '/inc/admin/mise-admin-page.php';
}








/*parent category prototype*/

/*add_action('template_redirect', 'wpds_parent_category_template');
function wpds_parent_category_template(){
    if (!is_category()){
       return true;
    }
    $cat = get_category(get_query_var('cat'));
    while ($cat && !is_wp_error($cat)) {
    $template = TEMPLATEPATH . "/category-{$cat->slug}.php";
        if (file_exists($template)) {
            load_template($template);
            exit;
        }
        $cat = $cat->parent ? get_category($cat->parent) : false;
    }
}*/

	/*add_action('template_redirect', 'wpds_parent_category_template');
function wpds_parent_category_template(){
    if (!is_category()){
        return true;
    }
    if (cat_is_ancestor_of(3, 7)) {
    if (cat_is_ancestor_of(get_cat_id('knowledge-base'), get_query_var('cat'))) {
       $cat = $cat->parent ? get_category($cat->parent) : false;
        $template = TEMPLATEPATH . "/category-{$cat->slug}.php";
        if (file_exists($template)) {
            load_template($template);
           exit;
        }
    }
}
*/

	/*add_action('template_redirect', 'wpds_parent_category_template');
2
function wpds_parent_category_template()
3
{
4
    if (!is_category())
5
        return true;
6
 
7
    // Перезаписываем шаблон для определенной рубрики "design", чьей родительской рубрикой является "projects"
8
    if (is_category('design') && cat_is_ancestor_of(get_cat_id('projects'), get_query_var('cat'))) {
9
        $cat = $cat->parent ? get_category($cat->parent) : false;
10
        $template = TEMPLATEPATH . "/category-{$cat->slug}.php";
11
        // загружаем, если файл шаблона существует.
12
        if (file_exists($template)) {
13
            load_template($template);
14
            exit;
15
        }
16
    }
17
}*/

/*function new_excerpt_length($length) {
	return 10;
}
add_filter('excerpt_length', 'new_excerpt_length');

*/

function nothingFoundTitle() {
query_posts( 
	array( 'post_type' => 'post', 'post__in' => array( 317 ) ) 
);

$i = 1 ;
if (have_posts()) : while (have_posts()) :  the_post();  ?>

<h1><?php the_title(); ?></h1>
<?php endwhile; endif;
}


function nothingFoundContent() {
query_posts( 
	array( 'post_type' => 'post', 'post__in' => array( 317 ) ) 
);

$i = 1 ;
if (have_posts()) : while (have_posts()) :  the_post();  ?>

<p><?php the_content(); ?></p>
<?php endwhile; endif;
}




function faqPost($id) {
query_posts( 
	array( 'post_type' => 'post', 'post__in' => array( $id ) ) 
);

$i = 1 ;
if (have_posts()) : while (have_posts()) :  the_post();  ?>

<h3><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>

   

<?php endwhile; endif;
}




/*add class to submenu*/
function change_submenu_class($menu) {  
  $menu = preg_replace('/ class="sub-menu"/','/ class="nav-sub sub-menu" /',$menu);  
  return $menu;  
}  
add_filter('wp_nav_menu','change_submenu_class'); 

function randomPosts() {
query_posts('orderby=date&showposts=3');

$i = 1 ;
if (have_posts()) : while (have_posts()) :  the_post();  ?>
    <div id=<?php echo "article$i" ?> class="tab-pane fade">
		<div class="imgBlock"><?php echo get_the_post_thumbnail(); ?></div>
	    <div class="textBlock">  <?php $i = $i +1 ?>
		    <h3><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
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
		    <p class="textExcerpt"><?php the_excerpt(); ?></p>
		    <div class="fullText" hidden><?php the_content(); ?></div>
	  	</div>
	</div>

<?php endwhile; endif;
}

?>
