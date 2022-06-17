<?php


/**
 * slow atoms scripts and styles
 *
 * @link https://developer.wordpress.org/themes/basics/including-css-javascript/
 *
 * @package slow_atoms
 */

if ( ! defined( '_S_VERSION' ) ) {
// Replace the version number of the theme on each release.
define( '_S_VERSION', '1.0.0' );
}

/*
 * Load stylesheets
 */
add_action( 'wp_enqueue_scripts', 'slow_atoms_stylesheets' );

function slow_atoms_stylesheets() {

	wp_enqueue_style( 'aos-stylesheet', 'https://unpkg.com/aos@next/dist/aos.css' );

	wp_enqueue_style( 'slow-atoms-style', get_stylesheet_uri(), array(), _S_VERSION );

	wp_style_add_data( 'slow-atoms-style', 'rtl', 'replace' );

	wp_enqueue_style( 'fontawesome-free-5.15.3', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css' ) ;

	wp_enqueue_style( 'DM-font', 'https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

/*
 * Load Scripts
 */
add_action( 'wp_enqueue_scripts', 'slow_atoms_javascripts' );

function slow_atoms_javascripts() {

	wp_enqueue_script( 'aos-javascript', 'https://unpkg.com/aos@next/dist/aos.js', array(), '', true);

	wp_enqueue_script( 'slow-atoms-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'slow-atoms-nav-scrolled', get_template_directory_uri() . '/js/navBarScroll.js', array(), _S_VERSION, true);

}




add_action( 'wp_enqueue_scripts', 'remove_global_styles' );

function remove_global_styles(){
	wp_dequeue_style( 'global-styles' );
}

// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );


?>
