<?php
if ( ! defined( 'ABSPATH' ) ) {	exit; }
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 * 
 * REMOVED DEC 2022
 * 
 * Call from template with get_sidebar()	
 */
// function slow_atoms_widgets_init() {
// 	register_sidebar(
// 		array(
// 			'name'          => esc_html__( 'Sidebar 1', 'slow-atoms' ),
// 			'id'            => 'sidebar-1',
// 			'description'   => esc_html__( 'Add widgets here.', 'slow-atoms' ),
// 			'before_widget' => '<section id="%1$s" class="widget %2$s">',
// 			'after_widget'  => '</section>',
// 			'before_title'  => '<h2 class="widget-title">',
// 			'after_title'   => '</h2>',
// 			)
// 	);
// 	register_sidebar(
// 		array(
// 			'name'          => esc_html__( 'Sidebar 2', 'slow-atoms' ),
// 			'id'            => 'sidebar-2',
// 			'description'   => esc_html__( 'Add widgets here.', 'slow-atoms' ),
// 			'before_widget' => '<section id="%1$s" class="widget %2$s">',
// 			'after_widget'  => '</section>',
// 			'before_title'  => '<h2 class="widget-title">',
// 			'after_title'   => '</h2>',
// 			)
// 	);
// }
// add_action( 'widgets_init', 'slow_atoms_widgets_init' );

// Set up the WordPress core custom background feature.
// add_theme_support( 'custom-background',
// 	apply_filters(
// 		'slow_atoms_custom_background_args',
// 		array(
// 			'default-color' => 'ffffff',
// 			'default-image' => '', ) ) ) ;

// Add theme support for selective refresh for widgets.
// add_theme_support( 'customize-selective-refresh-widgets' );

/**
 * Load Jetpack compatibility file.
 */
// if ( defined( 'JETPACK__VERSION' ) ) {
// 	require get_template_directory() . '/inc/jetpack.php';
// }

/**
 * Custom template tags for this theme.
 */
// require get_template_directory() . '/inc/template-tags.php';
/**
 * Functions which enhance the theme by hooking into WordPress.
 */
//require get_template_directory() . '/inc/template-functions.php';