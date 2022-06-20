<?php
/**
 * slow atoms Theme Customizer
 *
 * @package slow_atoms
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function slow_atoms_blog_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'slow_atoms_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'slow_atoms_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'slow_atoms_blog_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function slow_atoms_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function slow_atoms_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function slow_atoms_customize_preview_js() {
	wp_enqueue_script( 'slow-atoms-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'slow_atoms_customize_preview_js' );


function slow_atoms_customize_register( $wp_customize ) {

	/**************************** PANELS ****************************/


	// Theme Settings Panel
	$wp_customize 		-> add_panel( 'slow_atoms_theme_panel' , array(
		'title'					=> __('Theme Settings', 'slow-atoms'),
		'priority' 			=> 1,
		'capability'    => 'edit_theme_options',
		'description'   => __('Several settings pertaining to Slow Atoms theme', 'slow-atoms'),
	));

	/**************************** SECTIONS ****************************/

	// Theme wide colors
	$wp_customize 		-> add_section( 'slow_atoms_theme_colors', array(
		'title' 				=> __('Theme Colors', 'slow-atoms'),
		'priority' 			=> 2,
		'panel' 				=> 'slow_atoms_theme_panel',
	));
	// Homepage strapline
	$wp_customize 		-> add_section('slow_atoms_theme_front_page', array(
		'title' 				=> __('Homepage Settings', 'slow-atoms'),
		'priority' 			=> 1,
		'panel' 				=> 'slow_atoms_theme_panel',
	) ) ;
	// Featured images !front-page
	$wp_customize 		-> add_section('slow_atoms_theme_archive_page_heros', array(
		'title' 				=> __('Featured Images', 'slow-atoms'),
		'priority' 			=> 3,
		'panel' 				=> 'slow_atoms_theme_panel',
	) ) ;
	// Contact page details
	$wp_customize 		-> add_section('slow_atoms_theme_contact_page_details', array(
		'title' 				=> __('Contact Details', 'slow-atoms'),
		'priority' 			=> 3,
		'panel' 				=> 'slow_atoms_theme_panel',
	) ) ;
	/**************************** SETTINGS ****************************/

	// Primary color
	$wp_customize 		-> add_setting( 'slow_atoms_primary_theme_color' , array(
		'default' 			=> '#730E04',
		'transport' 		=> 'refresh',
	));
	// Homepage strapline
	$wp_customize 		-> add_setting( 'slow_atoms_front_page_title', array(
		'default'       => __( 'Snappy strapline saying how awesome everything is', 'slow-atoms' ),
		'sanitize_callback' => 'sanitize_text',
		'transport' 		=> 'refresh',
	) ) ;
	// Research featured image
	$wp_customize			-> add_setting( 'slow_atoms_theme_research_hero', array(
		'default'				=> get_theme_file_uri('assets/image/logo.jpg'), // Add Default Image URL
    'sanitize_callback' => 'esc_url_raw',
		'transport' 		=> 'refresh',
	));
	// People featured image
	$wp_customize			-> add_setting( 'slow_atoms_theme_people_hero', array(
		'default'				=> get_theme_file_uri('assets/image/logo.jpg'), // Add Default Image URL
    'sanitize_callback' => 'esc_url_raw',
		'transport' 		=> 'refresh',
	));
	// Contact form shortcode
	$wp_customize 		-> add_setting( 'slow_atoms_contact_form_shortcode', array(
		'default'       => __( '[contact-form-7 id="" title=""]', 'slow-atoms' ),
		'sanitize_callback' => 'sanitize_text',
		'transport' 		=> 'refresh',
	) ) ;
	// Contact form building
	$wp_customize 		-> add_setting( 'slow_atoms_contact_building_name', array(
		'default'       => __( 'Building', 'slow-atoms' ),
		'sanitize_callback' => 'sanitize_text',
		'transport' 		=> 'refresh',
	) ) ;
	// Contact form street
	$wp_customize 		-> add_setting( 'slow_atoms_contact_street_name', array(
		'default'       => __( 'Street', 'slow-atoms' ),
		'sanitize_callback' => 'sanitize_text',
		'transport' 		=> 'refresh',
	) ) ;
	// Contact form street number
	$wp_customize 		-> add_setting( 'slow_atoms_contact_street_number', array(
		'default'       => __( '123', 'slow-atoms' ),
		'sanitize_callback' => 'sanitize_text',
		'transport' 		=> 'refresh',
	) ) ;
	// Contact form postcode
	$wp_customize 		-> add_setting( 'slow_atoms_contact_postcode', array(
		'default'       => __( '1234AB', 'slow-atoms' ),
		'sanitize_callback' => 'sanitize_text',
		'transport' 		=> 'refresh',
	) ) ;
	// Contact form city
	$wp_customize 		-> add_setting( 'slow_atoms_contact_city', array(
		'default'       => __( 'City', 'slow-atoms' ),
		'sanitize_callback' => 'sanitize_text',
		'transport' 		=> 'refresh',
	) ) ;
	// Contact form country
	$wp_customize 		-> add_setting( 'slow_atoms_contact_country', array(
		'default'       => __( 'Country', 'slow-atoms' ),
		'sanitize_callback' => 'sanitize_text',
		'transport' 		=> 'refresh',
	) ) ;
	/**************************** CONTROLS ****************************/

	// Primary color
	$wp_customize 		-> add_control( new WP_Customize_Color_Control( $wp_customize, 'slow_atoms_link_color_control',array(
		'label' 				=> __('Primary Theme Color' , 'slow-atoms'),
		'section' 			=> 'slow_atoms_theme_colors',
		'settings' 			=> 'slow_atoms_primary_theme_color',
	)));
	// Homepage strapline
	$wp_customize 		-> add_control( new WP_Customize_Control( $wp_customize , 'slow_atoms_front_page_title_control', array(
		'label'    			=> __( 'Homepage Title', 'slow-atoms' ),
		'description' 	=> __( 'Title above the homepage content. Site title and strapline are found under "Site Identity"' ),
		'section' 			=> 'slow_atoms_theme_front_page',
		'settings' 			=> 'slow_atoms_front_page_title',
		'type'     			=> 'text'
	) ) );
	// Research archive hero image
  $wp_customize			-> add_control( new WP_Customize_Image_Control( $wp_customize, 'slow_atoms_featured_image_research_control', array(
		'label' 				=> 'Research Page Image',
    'priority' 			=> 1,
    'section' 			=> 'slow_atoms_theme_archive_page_heros',
    'settings' 			=> 'slow_atoms_theme_research_hero',
    'button_labels' => array(// All These labels are optional
			'select' => 'Select Image',
      'remove' => 'Remove Image',
      'change' => 'Change Image',
    ) ) ) );
	// People archive hero image
	$wp_customize			-> add_control( new WP_Customize_Image_Control( $wp_customize, 'slow_atoms_featured_image_people_control', array(
		'label' 				=> 'People Page Image',
    'priority' 			=> 2,
    'section' 			=> 'slow_atoms_theme_archive_page_heros',
    'settings' 			=> 'slow_atoms_theme_people_hero',
    'button_labels' => array(// All These labels are optional
			'select' => 'Select Image',
      'remove' => 'Remove Image',
      'change' => 'Change Image',
    ) ) ) );
	// Contact form shortcode
	$wp_customize 		-> add_control( new WP_Customize_Control( $wp_customize , 'slow_atoms_contact_form_shortcode_control', array(
		'label'    			=> __( 'Contact Form 7 Shortcode', 'slow-atoms' ),
		'description' 	=> __( 'Shortcode to your contact form.' ),
		'priority' 			=> 1,
		'section' 			=> 'slow_atoms_theme_contact_page_details',
		'settings' 			=> 'slow_atoms_contact_form_shortcode',
		'type'     			=> 'text'
	) ) );
	// Contact form shortcode
	$wp_customize 		-> add_control( new WP_Customize_Control( $wp_customize , 'slow_atoms_contact_building_name_control', array(
		'label'    			=> __( 'Building Name', 'slow-atoms' ),
		'priority' 			=> 2,
		'section' 			=> 'slow_atoms_theme_contact_page_details',
		'settings' 			=> 'slow_atoms_contact_building_name',
		'type'     			=> 'text'
	) ) );
	// Contact form shortcode
	$wp_customize 		-> add_control( new WP_Customize_Control( $wp_customize , 'slow_atoms_contact_street_name_control', array(
		'label'    			=> __( 'Street Name', 'slow-atoms' ),
		'priority' 			=> 3,
		'section' 			=> 'slow_atoms_theme_contact_page_details',
		'settings' 			=> 'slow_atoms_contact_street_name',
		'type'     			=> 'text'
	) ) );
	// Contact form shortcode
	$wp_customize 		-> add_control( new WP_Customize_Control( $wp_customize , 'slow_atoms_contact_street_number_control', array(
		'label'    			=> __( 'Street Number', 'slow-atoms' ),
		'priority' 			=> 4,
		'section' 			=> 'slow_atoms_theme_contact_page_details',
		'settings' 			=> 'slow_atoms_contact_street_number',
		'type'     			=> 'text'
	) ) );
	// Contact form shortcode
	$wp_customize 		-> add_control( new WP_Customize_Control( $wp_customize , 'slow_atoms_contact_postcode_control', array(
		'label'    			=> __( 'Postcode', 'slow-atoms' ),
		'priority' 			=> 4,
		'section' 			=> 'slow_atoms_theme_contact_page_details',
		'settings' 			=> 'slow_atoms_contact_postcode',
		'type'     			=> 'text'
	) ) );
	// Contact form shortcode
	$wp_customize 		-> add_control( new WP_Customize_Control( $wp_customize , 'slow_atoms_contact_city_control', array(
		'label'    			=> __( 'City', 'slow-atoms' ),
		'priority' 			=> 5,
		'section' 			=> 'slow_atoms_theme_contact_page_details',
		'settings' 			=> 'slow_atoms_contact_city',
		'type'     			=> 'text'
	) ) );
	// Contact form shortcode
	$wp_customize 		-> add_control( new WP_Customize_Control( $wp_customize , 'slow_atoms_contact_country_control', array(
		'label'    			=> __( 'Country', 'slow-atoms' ),
		'priority' 			=> 6,
		'section' 			=> 'slow_atoms_theme_contact_page_details',
		'settings' 			=> 'slow_atoms_contact_country',
		'type'     			=> 'text'
	) ) );

	// Sanitize text
	function sanitize_text( $text ) {
			return sanitize_text_field( $text );
	}
}

add_action('customize_register', 'slow_atoms_customize_register');
