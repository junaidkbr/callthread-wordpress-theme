<?php
/**
 * create-ape-theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package create-ape-theme
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
function create_ape_theme_setup() {
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
			'primary' => esc_html__( 'Primary', 'create-ape-theme' ),
		)
	);

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
}
add_action( 'after_setup_theme', 'create_ape_theme_setup' );

/**
 * Enqueue scripts and styles.
 */
function create_ape_theme_scripts() {
	wp_enqueue_style( 'create-ape-theme-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'create-ape-theme-style', 'rtl', 'replace' );

	wp_enqueue_script( 'create-ape-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'create_ape_theme_scripts' );

/**
 * Removes Gutenberg Block Library CSS
 */
function create_ape_remove_wp_block_library_css(){
  wp_dequeue_style( 'wp-block-library' );
  wp_dequeue_style( 'wp-block-library-theme' );
  wp_dequeue_style( 'wc-blocks-style' );
 }
add_action( 'wp_enqueue_scripts', 'create_ape_remove_wp_block_library_css', 100 );

/**
 * Plugin dependency class
 */
require get_template_directory() . '/inc/class-tgm-plugin-activation.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function create_ape_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		array(
			'name'                => 'Advanced Custom Fields PRO',
			'slug'                => 'advanced-custom-fields-pro',
      'source'             => get_stylesheet_directory() . '/inc/plugins/advanced-custom-fields-pro.zip',
      'required'            => true,
			'force_activation'    => true
		),
	);

	$config = array(
		'id'           => 'fga',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'parent_slug'  => 'themes.php',
		'capability'   => 'edit_theme_options',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'create_ape_register_required_plugins' );

/**
 * Changes ACF Save-JSON directory
 *
 * @param  String $path Default ACF JSON directory
 * @return String Modified ACF JSON directory path
 */
function create_ape_acf_json_save_directory( $path ) {
	return get_stylesheet_directory() . '/acf-json';
}
add_filter( 'acf/settings/save_json', 'create_ape_acf_json_save_directory' );

/**
 * Changes ACF Load-JSON Directory
 *
 * @param Array $paths ACF JSON directory paths
 * @return String Modified ACF JSON directory paths
 */
function create_ape_acf_json_load_directory( $paths ) {
	unset( $paths[0] );
	$paths[] = get_stylesheet_directory() . '/acf-json';

	return $paths;
}
add_filter('acf/settings/load_json', 'create_ape_acf_json_load_directory');