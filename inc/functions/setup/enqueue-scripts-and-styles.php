<?php

/**
 * slow atoms scripts and styles
 *
 * @link https://developer.wordpress.org/themes/basics/including-css-javascript/
 *
 * @package slow_atoms
 */
add_action( 'wp_enqueue_scripts', 'slow_atoms_stylesheets' );

add_action( 'wp_enqueue_scripts', 'slow_atoms_scripts' );

// NOTE: eventually we should remove wp styling and replace with our own
//add_action( 'wp_enqueue_scripts', 'remove_global_styles' );

// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

function slow_atoms_stylesheets() {

	wp_enqueue_style( 'michalsnik-aos', get_template_directory_uri() . '/inc/vendor/aos/aos.css', array(), _S_VERSION ); 

	wp_enqueue_style( 'fontawesome-free-5.15.3', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css' ) ;

	wp_enqueue_style( 'DM-font', 'https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap' );

	wp_enqueue_style( 'slow-atoms-style', get_stylesheet_uri(), array(), _S_VERSION );

	wp_style_add_data( 'slow-atoms-style-', 'rtl', 'replace' );
}

function slow_atoms_scripts() {

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' ) ; }
	
	//wp_enqueue_script( 'polyfill', 'https://polyfill.io/v3/polyfill.min.js?features=es6', array(), '', true);
	//wp_enqueue_script( 'mathjax', 'https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js', array('polyfill'), '', true);

	wp_enqueue_script( 'michalsnik-aos', get_template_directory_uri() . '/inc/vendor/aos/aos.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'slow-atoms-navigation', get_template_directory_uri() . '/inc/js/navigation.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'slow-atoms-nav-scrolled', get_template_directory_uri() . '/inc/js/navBarScroll.js', array(), _S_VERSION, true);

}

function remove_global_styles(){
	// Remove global-styles-inline
	wp_dequeue_style( 'global-styles' );
	// Remove wp-block-library-css
	wp_dequeue_style( 'wp-block-library' );
	// Remove classic-theme-styles
	wp_dequeue_style( 'classic-theme-styles' );
    //wp_dequeue_style( 'wc-block-style' );
}

