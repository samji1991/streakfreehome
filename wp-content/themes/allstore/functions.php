<?php
/**
 * AllStore functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 */

// Custom Fields & Theme Options
require_once( trailingslashit( get_template_directory() ) . 'inc/acf-fields.php');

// Include the class (unless you are using the script as a plugin)
require_once( trailingslashit( get_template_directory() ) . 'inc/less/wp-less.php' );

if ( ! function_exists( 'allstore_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function allstore_setup() {

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Loads the theme's translated strings.
	 */
	load_theme_textdomain( 'allstore', get_template_directory() . '/languages' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	// Declare WooCommerce support
	add_theme_support( 'woocommerce' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	//set_post_thumbnail_size( 200, 200 );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'allstore' ),
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

	// Editor custom stylesheet - for user
	add_editor_style('css/editor-style.css');

	// Add Image Sizes
	add_image_size( 'allstore-200x200', '200', '200' ); // Carousel Products
	add_image_size( 'allstore-420x600', '420', '600' );
	add_image_size( 'allstore-1140x1140', '1140', '1140' );
	add_image_size( 'allstore-360x280-c', '360', '280', array('center', 'center') ); // Team

	//add_image_size( 'shop_catalog_image_size', '260', '260' );
	//add_image_size( 'shop_single_image_size', '500', '600' );
	//add_image_size( 'shop_thumbnail_image_size', '120', '120' );
}
endif;
add_action( 'after_setup_theme', 'allstore_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function allstore_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'allstore_content_width', 1270 );
}
add_action( 'after_setup_theme', 'allstore_content_width', 0 );

/**
 * Register widget area.
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function allstore_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Shop Sidebar', 'allstore' ),
		'id'            => 'allstore-sb-1',
		'description'   => esc_html__( 'Add widgets here.', 'allstore' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'allstore' ),
		'id'            => 'allstore-sb-blog',
		'description'   => esc_html__( 'Add widgets here.', 'allstore' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Post Sidebar', 'allstore' ),
		'id'            => 'allstore-sb-post',
		'description'   => esc_html__( 'Add widgets here.', 'allstore' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'allstore_widgets_init' );


/*
Register Fonts
*/
function allstore_fonts_url() {
	$font_url = '';

	/*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
	if ( 'off' !== _x( 'on', 'Google font: on or off', 'allstore' ) ) {
		$font_url = add_query_arg( 'family', urlencode( 'PT+Serif:400,400i,700,700i|Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;subset=cyrillic' ), "//fonts.googleapis.com/css" );

	}
	return $font_url;
}


/**
 * Enqueue scripts and styles.
 */
function allstore_styles_scripts() {

	// Enqueue a .less style sheet
	wp_enqueue_style( 'allstore-fonts', allstore_fonts_url(), array() );
	wp_enqueue_style( 'allstore-less', get_template_directory_uri(). '/css/styles.less' );

	// Enqueue a styles
	wp_enqueue_style( 'allstore-style', get_stylesheet_uri() );

	// Enqueue scripts
	wp_enqueue_script( 'allstore-all-plugins', get_template_directory_uri().'/js/all_jquery_plugins.js', array( 'jquery' ), null, true);
	//wp_enqueue_script( 'chosen-drop-down', get_template_directory_uri().'/js/chosen.jquery.min.js', array( 'jquery' ), null, true);
	wp_enqueue_script( 'allstore-plugins', get_template_directory_uri().'/js/plugins.js', array( 'jquery' ), null, true);
	wp_enqueue_script( 'allstore-main', get_template_directory_uri().'/js/main.js', array( 'jquery' ), null, true);
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_dequeue_style( 'yith-wcwl-font-awesome' );
	wp_dequeue_style( 'jquery-selectBox' );
}
add_action( 'wp_enqueue_scripts', 'allstore_styles_scripts' );

// Kirki (Theme Options)
if ( class_exists( 'Kirki' ) ) {
	// Load the Kirki Fallback class
	require get_parent_theme_file_path( '/inc/kirki-fallback.php' );
	// Customizer additions.
	require get_parent_theme_file_path( '/inc/customizer.php' );
}

// Theme Functions
get_template_part( 'inc/functions/theme-functions' );
get_template_part( 'inc/functions/options' );
get_template_part( 'inc/functions/woocommerce' );

// VC Shortcodes
if ( function_exists( 'vc_is_as_theme' ) ) {
	require get_parent_theme_file_path( '/inc/shortcodes.php' );
}

// Demo Import
require_once( trailingslashit( get_template_directory() ) . 'framework-customizations/theme/hooks.php' );

// TGM Plugins
require_once( trailingslashit( get_template_directory() ) . 'inc/tgm.php' );




/**
 * Set list of post types where VC editor is enabled.
 */
function allstore_detect_plugin_activation(  $plugin, $network_activation ) {
	if ($plugin == 'js_composer/js_composer.php') {
		if (function_exists( 'vc_is_as_theme' )) {
			$vc_editor_post_types = vc_editor_post_types();
			if (!in_array('product', $vc_editor_post_types)) {
				$vc_editor_post_types[] = 'product';
				vc_editor_set_post_types( $vc_editor_post_types );
			}
		}
	}
	if ($plugin == 'woocommerce/woocommerce.php') {
		if (function_exists( 'vc_is_as_theme' )) {
			$vc_editor_post_types = vc_editor_post_types();
			if (!in_array('product', $vc_editor_post_types)) {
				$vc_editor_post_types[] = 'product';
				vc_editor_set_post_types( $vc_editor_post_types );
			}
		}
	}
}
add_action( 'activated_plugin', 'allstore_detect_plugin_activation', 10, 2 );



// Load More Ajax
add_action('wp_ajax_nopriv_allstore_load_more', 'allstore_load_more');
add_action('wp_ajax_allstore_load_more', 'allstore_load_more');
function allstore_load_more () {
	if (isset($_POST['file'])) {
		include( trailingslashit( get_template_directory() ) . $_POST['file'] );
	}
	die();
}



function allstore_megamenu_scripts_styles() {
	$screen = get_current_screen();
	if ($screen->base == 'nav-menus') {
		return;
	}

	wp_deregister_script('wp-color-picker-alpha');
	wp_deregister_script('clever-mega-menu-admin');
	wp_register_script('clever-mega-menu-admin', get_template_directory_uri() . '/js/clever-mega-menu-admin.min.js', array(), false, true );
}
add_action( 'admin_enqueue_scripts', 'allstore_megamenu_scripts_styles', 200 );
