<?php

namespace Valu\Kantapohja\Setup;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Valu\Kantapohja\Assets;

/**
 * Theme setup
 */
function setup() {
	// Enable features from Soil when plugin is activated
	// https://roots.io/plugins/soil/
	add_theme_support( 'soil-clean-up' );
	add_theme_support( 'soil-nav-walker' );
	add_theme_support( 'soil-nice-search' );
	add_theme_support( 'soil-jquery-cdn' );
	add_theme_support( 'soil-relative-urls' );
	add_theme_support( 'bootstrap-gallery' );     // Enable Bootstrap's thumbnails component on [gallery]

	// Make theme available for translation
	load_theme_textdomain( 'kantapohja', get_template_directory() . '/lang' );

	// Enable plugins to manage the document title
	// http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
	add_theme_support( 'title-tag' );

	register_nav_menus( [
		'top_navigation'           => __( 'Top Navigation', 'kantapohja' ),
		'primary_navigation'       => __( 'Primary Navigation', 'kantapohja' ),
		'footer_navigation'        => __( 'Footer Navigation', 'kantapohja' ),
		'target_groups_navigation' => __( 'Target groups', 'kantapohja' ),
	] );

	// Enable post thumbnails
	// http://codex.wordpress.org/Post_Thumbnails
	// http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
	// http://codex.wordpress.org/Function_Reference/add_image_size
	add_theme_support( 'post-thumbnails' );

	set_post_thumbnail_size( 320, 160, true );

	remove_image_size( 'post-thumbnail' );

	update_option( 'large_size_w', 681 );
	update_option( 'large_size_h', 681 );

	add_image_size( 'gallery', 1280, 1280, true );
	add_image_size( 'banner', 1600, 1080, true );
	add_image_size( 'frontpage-banner', 1600, 600, true );
	add_image_size( 'content-banner', 1600, 300, true );
	add_image_size( 'columnlift', 445, 220, true );

	add_image_size( 'imagelift', 715, 509, true );

	add_image_size( 'post-thumbnail-large', 681, 681, false );

	add_image_size( 'landing', 327, 218, true );
	add_image_size( 'sidebar-banner', 287, 163, true );

	// Enable post formats
	// http://codex.wordpress.org/Post_Formats
	add_theme_support( 'post-formats', [ 'aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio' ] );

	// Enable HTML5 markup support
	// http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
	add_theme_support( 'html5', [ 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ] );

	// Use main stylesheet for visual editor
	// To add custom styles edit /assets/styles/layouts/_tinymce.scss
	add_editor_style( Assets\asset_path( 'styles/main.css' ) );
}

add_action( 'after_setup_theme', __NAMESPACE__ . '\\setup' );

// over-ride image_size_names_choose
function add_image_insert_override( $size_names ) {

	$size_names = array(
		'thumbnail' => __( 'Thumbnail' ),
		'medium'    => __( 'Medium' ),
		'large'     => __( 'Large' ),
		'gallery'   => __( 'Gallery' ),
		'banner'    => __( 'Banner image', 'kantapohja' ),
	);

	return $size_names;
}

add_filter( 'image_size_names_choose', __NAMESPACE__ . '\\add_image_insert_override' );

/**
 * Register sidebars
 */
function widgets_init() {
	register_sidebars( 2, [
		'name'          => __( 'Footer %d', 'kantapohja' ),
		'id'            => 'sidebar-footer',
		'before_widget' => '<section class="widget %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	] );
}

add_action( 'widgets_init', __NAMESPACE__ . '\\widgets_init' );

/**
 * Determine which pages should NOT display the sidebar
 */
function display_sidebar() {
	static $display;

	isset( $display ) || $display = ! in_array( true, [
		// The sidebar will NOT be displayed if ANY of the following return true.
		// @link https://codex.wordpress.org/Conditional_Tags
		is_404(),
		is_front_page(),
		is_search(),
		is_page_template( 'template-valu_people.php' ),
	], true );

	return apply_filters( 'kantapohja_display_sidebar', $display );
}

function display_sidebar_left() {
	static $display;

	isset( $display ) || $display = ! in_array( true, [

		is_single(),
		//is_archive(),
		is_front_page(),
	], true );

	return apply_filters( 'kantapohja_display_sidebar_left', $display );
}

/**
 * Theme assets
 */
function assets() {

	wp_enqueue_style( 'kantapohja/css', Assets\asset_path( 'styles/main.css' ), false, 'nocache-' . filemtime( get_template_directory() . '/dist/styles/main.css' ) );

	if ( is_single() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'kantapohja/js', Assets\asset_path( 'scripts/main.js' ), [ 'jquery' ], null, true );
}

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100 );

