<?php

/**
 * Slow Atoms scripts and styles
 *
 * @link https://developer.wordpress.org/themes/basics/including-css-javascript/
 *
 * @package slow_atoms
 */

add_action( 'wp_enqueue_scripts', 'slow_atoms_stylesheets' );

add_action( 'wp_enqueue_scripts', 'slow_atoms_enqueue_inline_styles' );

add_action( 'wp_enqueue_scripts', 'slow_atoms_scripts' );

function slow_atoms_enqueue_inline_styles() {

	wp_add_inline_style( 'slow-atoms-style', slow_atoms_customise_colors() ) ;

}

function slow_atoms_stylesheets() {

	wp_enqueue_style( 'michalsnik-aos', get_template_directory_uri() . '/inc/vendor/aos/aos.css', array(), SLOW_ATOMS_THEME_VERSION ); 

	wp_enqueue_style( 'fontawesome-free-5.15.3', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css' ) ;

	wp_enqueue_style( 'DM-font', 'https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap' );

	wp_enqueue_style( 'slow-atoms-style', get_stylesheet_uri(), array(), SLOW_ATOMS_THEME_VERSION );

	wp_style_add_data( 'slow-atoms-style-', 'rtl', 'replace' );
}	

function slow_atoms_scripts() {

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' ) ; 
	}
	
	//wp_enqueue_script( 'polyfill', 'https://polyfill.io/v3/polyfill.min.js?features=es6', array(), '', true);
	//wp_enqueue_script( 'mathjax', 'https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js', array('polyfill'), '', true);

	wp_enqueue_script( 'michalsnik-aos', get_template_directory_uri() . '/inc/vendor/aos/aos.js', array(), SLOW_ATOMS_THEME_VERSION, true );

	wp_enqueue_script( 'slow-atoms-navigation', get_template_directory_uri() . '/inc/js/navigation.js', array(), SLOW_ATOMS_THEME_VERSION, true );

	wp_enqueue_script( 'slow-atoms-nav-scrolled', get_template_directory_uri() . '/inc/js/navBarScroll.js', array(), SLOW_ATOMS_THEME_VERSION, true);

	// TODO: do we need this wp_enqueue_script( 'slow-atoms-color-scheme-preview', get_template_directory_uri() . '/inc/js/color-scheme-preview.js', array( 'customize-preview' ), '', true );

}

add_action( 'wp_enqueue_scripts', 'slow_atoms_enqueue_inline_scripts' );

function slow_atoms_enqueue_inline_scripts(){

	$pre_load_scrolled = 'function windowOnload(){ navBarScroll(); } window.onload = windowOnload;';

	$aos_script_init = 'AOS.init({ duration: 700, easing: "ease-out-back", disable: "mobile"});';

	$css_anim_after_load = 'setTimeout(function(){document.querySelector("#masthead").classList.remove("no-anim");},600 );';

	wp_add_inline_script( 'slow-atoms-nav-scrolled', $pre_load_scrolled, 'after' );

	wp_add_inline_script( 'michalsnik-aos', $aos_script_init, 'after' );

	wp_add_inline_script( 'slow-atoms-nav-scrolled', $css_anim_after_load, 'after' );
}
