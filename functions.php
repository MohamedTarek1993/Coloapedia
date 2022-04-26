<?php
/**
 * Coloapedia functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Coloapedia
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
if (!function_exists('theme_for_blog_setup')) {

function theme_for_blog_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Coloapedia, use a find and replace
		* to change 'theme-for-blog' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'theme-for-blog', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.


	register_nav_menus(
		array(
			'top-menu'    => 'Top Menu',
			'main-menu'   => 'Main Menu',
		)
	);
	require get_template_directory(  ) . '/inc/walkers/walkers.php';

	add_theme_support( 'menus' );

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'theme_for_blog_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 100,
			'width'       => 300,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
}
add_action( 'after_setup_theme', 'theme_for_blog_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function theme_for_blog_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'theme_for_blog_content_width', 640 );
}
add_action( 'after_setup_theme', 'theme_for_blog_content_width', 0 );

/**
 * Register widget area.
 * Register side bar . 
 */
require get_template_directory() . '/inc/widgets/widgets.php' ;

/**
 * Enqueue scripts and styles.
 */
$base = get_template_directory_uri() . '/';


function theme_for_blog_scripts() {
	wp_enqueue_style( 'theme-for-blog-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'theme-for-blog-style', 'rtl', 'replace' );

    global $base;
    wp_enqueue_style('bootstrap', $base . 'assets/css/bootstrap.css', [], null);
    wp_enqueue_style('fontsawesome', $base . 'assets/css/font-awesome.min.css', ['bootstrap'], null);
    wp_enqueue_style('template-style', $base . 'assets/style.css', [], null);
    wp_enqueue_style('template-responsive', $base . 'assets/css/responsive.css', [], null);
    wp_enqueue_style('template-colors', $base . 'assets/css/colors.css', [], null);
	wp_enqueue_style('template-theme-style', $base . 'style.css', [], rand(1,100000));


    wp_enqueue_script('jq-script', $base . 'assets/js/jquery.min.js', [], null, true);
    wp_enqueue_script('tether-script', $base . 'assets/js/tether.min.js', [], null, true);
    wp_enqueue_script('bootstrap-script', $base . 'assets/js/bootstrap.min.js', [], null, true);
	wp_enqueue_script('masonry-script', $base . 'assets/js/masonry.js', [], null, true);
    wp_enqueue_script('custom-script', $base . 'assets/js/custom.js', [], null, true);

	


	wp_enqueue_script( 'theme-for-blog-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'theme_for_blog_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

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
 * remove block editor from widgets
 */
remove_theme_support('widgets-block-editor');

