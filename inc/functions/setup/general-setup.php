<?php

// Make theme available for translation. Translations can be filed in the /languages/ directory.
load_theme_textdomain( 'slow-atoms', get_template_directory() . '/languages' );

// Add default posts and comments RSS feed links to head.
add_theme_support( 'automatic-feed-links' );

// Let WordPress manage the document title.
add_theme_support( 'title-tag' );

// Enable support for Post Thumbnails on posts and pages.
// @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
add_theme_support( 'post-thumbnails' );

// This theme uses wp_nav_menu() in two location.
register_nav_menus(
	array(
		'priary-menu' => esc_html__( 'Primary', 'slow-atoms' ),
		'useful-links' => esc_html__( 'Useful Links', 'slow-atoms' ),
	) 
) ;

// Switch default core markup for search form, etc to output valid HTML5.
add_theme_support( 'html5',
	array(
		'search-form',
		'gallery',
		'caption',
		'style',
		'script', 
	)
) ;

// Add support for core custom logo.
// @link https://codex.wordpress.org/Theme_Logo
add_theme_support( 'custom-logo',
	array(
		'height'      => 250,
		'width'       => 250,
		'flex-width'  => true,
		'flex-height' => true, 
	)
) ;

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
add_action( 'after_setup_theme', 'slow_atoms_content_width', 0 );

function slow_atoms_content_width() {

	$GLOBALS['content_width'] = apply_filters( 'slow_atoms_content_width', 640 );
}

/*
 * Change dashboard Posts to News
 */
add_action( 'init', 'slow_atoms_change_post_object' );

function slow_atoms_change_post_object() {

    $post_obj = get_post_type_object('post');

    $labels = $post_obj -> labels;

	$labels -> name				= 'News';
	$labels -> singular_name	= 'News';
	$labels -> add_new			= 'Add News';
	$labels -> add_new_item		= 'Add News';
	$labels -> edit_item		= 'Edit News';
	$labels -> new_item			= 'News';
	$labels -> view_item		= 'View News';
	$labels -> search_items		= 'Search News';
	$labels -> not_found		= 'No News found';
	$labels -> not_found_in_trash = 'No News found in Trash';
	$labels -> all_items		= 'All News';
	$labels -> menu_name		= 'News';
	$labels -> name_admin_bar	= 'News';
}