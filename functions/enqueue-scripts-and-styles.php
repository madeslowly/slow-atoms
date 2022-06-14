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

/**
 * Enqueue scripts and styles.
 */
function slow_atoms_scripts() {

	wp_enqueue_style( 'animate-on-scroll', 'https://unpkg.com/aos@next/dist/aos.css' );

	wp_enqueue_script( 'aos-script', 'https://unpkg.com/aos@next/dist/aos.js', array(), '', true);

	wp_enqueue_style( 'slow-atoms-style', get_stylesheet_uri(), array(), _S_VERSION );

	wp_style_add_data( 'slow-atoms-style', 'rtl', 'replace' );

	wp_enqueue_style( 'fontawesome-free-5.15.3', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css' ) ;

	wp_enqueue_style( 'DM-font', 'https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap' );

	wp_enqueue_script( 'slow-atoms-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'nav-scrolled', get_template_directory_uri() . '/js/navBarScroll.js', array(), _S_VERSION, true);


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'slow_atoms_scripts' );

?>
