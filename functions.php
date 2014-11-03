<?php
/**
 * iamtapps functions and definitions
 *
 * @package iamtapps
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'iamtapps_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function iamtapps_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on iamtapps, use a find and replace
	 * to change 'iamtapps' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'iamtapps', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'iamtapps' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'iamtapps_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // iamtapps_setup
add_action( 'after_setup_theme', 'iamtapps_setup' );


/**
 * Enqueue scripts and styles.
 */
function iamtapps_scripts() {
	wp_enqueue_style( 'google-fonts', 'http://fonts.googleapis.com/css?family=News+Cycle:400,700|Love+Ya+Like+A+Sister', '1.2.3', 'all' );
	wp_enqueue_style( 'gridism', get_template_directory_uri() . '/css/gridism.css','1.0.0', 'all' );
	wp_enqueue_style( 'iamtapps-style', get_stylesheet_uri() );

	wp_enqueue_script( 'iamtapps-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'iamtapps-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	wp_enqueue_script( 'iconic', get_template_directory_uri() . '/js/iconic.min.js', array(), '0.4.0', false );
	wp_enqueue_script( 'blast', get_template_directory_uri() . '/js/jquery.blast.min.js', array( 'jquery' ), '1.1.0', false );
	wp_enqueue_script( 'sticky', get_template_directory_uri() . '/js/jquery.sticky.js', array( 'jquery' ), '1.0.0', false );
	wp_enqueue_script( 'velocity', get_template_directory_uri() . '/js/velocity.min.js', array(), '1.1.0', false );
	wp_enqueue_script( 'skrollr', get_template_directory_uri() . '/js/skrollr.min.js', array(), '0.6.27', true );
	wp_enqueue_script( 'classie', get_template_directory_uri() . '/js/classie.js', array(), '1.0.0', true );
	wp_enqueue_script( 'iamtapps-global', get_template_directory_uri() . '/js/global.js', array(), '1.2.3', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'iamtapps_scripts' );

/**
 * Custom functions for iamtapps
 */
require get_template_directory() . '/inc/iamtapps-functions.php';

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
require get_template_directory() . '/inc/jetpack.php';
