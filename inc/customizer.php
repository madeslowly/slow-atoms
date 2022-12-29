<?php
/**
 * Slow Atoms Theme Customizer
 *
 * @package slow_atoms
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function slow_atoms_blog_customize_register( $wp_customize ) {

	$wp_customize	-> get_setting( 'blogname' )		->transport	= 'postMessage';
	$wp_customize	-> get_setting( 'blogdescription' )	->transport	= 'postMessage';
	$wp_customize	-> get_setting( 'header_textcolor' )->transport	= 'postMessage';

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
		$wp_customize->selective_refresh->add_partial( 'slow_atoms_front_page_blurb', array(
			'selector' => '.sa__collage--card-blurb p',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector' => '.is__front-page > section > header > h1',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector' => '.page-description',
		) );
		$wp_customize->selective_refresh->add_partial( 'slow_atoms_front_page_desc', array(
			'selector' => '.sa__collage--research-desc p',
		) );
		$wp_customize->selective_refresh->add_partial( 'slow_atoms_archives_research', array(
			'selector' => '.sa__archive-blurb-text',
		) );
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
	wp_enqueue_script( 'slow-atoms-customizer', get_template_directory_uri() . '/inc/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'slow_atoms_customize_preview_js' );



function slow_atoms_theme_colors( $wp_customize ) {
	/**
 	* **************		COLORS		**************
 	*/
	$obj = new slow_atoms_Color_Scheme();

	$options = array(
		'slow_atoms_primary_theme_color'			=> __( 'Primary', 'slow_atoms' ),
		'slow_atoms_secondary_theme_color' 		=> __( 'Secondary', 'slow_atoms' ),
		'slow_atoms_navbar_link_color' => __( 'Menu Links', 'slow_atoms' ),
		'slow_atoms_accent_color' => __( 'Accent', 'slow_atoms' ),
		'footer_bg_color'	 	=> __( 'Footer background color', 'slow_atoms' ),
		'highlight_color' 		=> __( 'Hightlight color', 'slow_atoms' ),
	);
	
	foreach ( $options as $key => $label ) {
		$wp_customize	-> add_setting( $key, array(
			'sanitize_callback'	=> 'sanitize_hex_color',
		) );
		$wp_customize	->	add_control( new WP_Customize_Color_Control( $wp_customize, $key, array(
			'label' 			=> $label,
			'section' 			=> 'slow_atoms_colors',
		) ) );
	}
	/****************		Section		**************/
	$wp_customize	-> add_section( 'slow_atoms_colors', array(
		'title'		=> __( 'Colors', 'slow_atoms' ),
		'priority'	=> '1',
	) );
	/****************		Setting		**************/
	$wp_customize	-> add_setting( 'color_scheme', array(
		'default'	=> 'classic',
	) );
	
	$color_schemes = $obj -> get_color_schemes();
	$choices = array();
	foreach ( $color_schemes as $color_scheme => $value ) {
		$choices[$color_scheme] = $value['label'];
	}
	$wp_customize	-> add_control( 'color_scheme', array(
		'label'   	=> __( 'Palettes', 'slow_atoms' ),
		'section'	=> 'slow_atoms_colors',
		'type'    	=> 'select',
		'choices' 	=> $choices,
		'priority'	=> 1,
	) );
}

add_action('customize_register', 'slow_atoms_theme_colors');

function slow_atoms_customize_register( $wp_customize ) {
	/**
 	* **************  Google Analytics  **************
 	*/
	/****************		Section		**************/
	$wp_customize	-> add_section('slow_atoms_gtag_section', array(
		'title' 			=> __('Google Analytics', 'slow-atoms'),
		'priority' 			=> 4,
	) ) ;
	/****************		Setting		**************/
	$wp_customize	-> add_setting( 'slow_atoms_gtag_setting', array(
		'default'      		=> __( '', 'slow-atoms' ),
		'sanitize_callback' => 'sanitize_text',
	) ) ;
	/****************		Control		**************/
	$wp_customize	-> add_control( new WP_Customize_Control( $wp_customize , 'slow_atoms_gtag_control', array(
		'label'    			=> __( 'Google Tag', 'slow-atoms' ),
		'description' 		=> __( 'Set up Google Analytics for your website. ' ),
		'section' 			=> 'slow_atoms_gtag_section',
		'settings' 			=> 'slow_atoms_gtag_setting',
		'type'     			=> 'text'
	) ) );
	/**
 	* **************  	Twitter API	  	**************
 	*/
	/****************	Sections		**************/
	$wp_customize	-> add_section('slow_atoms_twitter_section', array(
		'title' 			=> __('Twitter API', 'slow-atoms'),
		'description'		=> 'Integrate Twitter with your website. Create a Twitter app at developer.twitter.com to get your Keys and Access Tokens.',
		'priority' 			=> 4,
	) ) ;
	/****************	Settings		**************/
	$wp_customize->add_setting( 'slow_atoms_twitter_enable_setting', array(
		'default' => false,
		//'sanitize_callback' => 'themeslug_customizer_sanitize_radio',
	  ) );
	$wp_customize	-> add_setting( 'slow_atoms_twitter_consumerKey_setting', array(
		'default'      		=> __( '', 'slow-atoms' ),
		'sanitize_callback' => 'sanitize_text',
	) ) ;
	$wp_customize	-> add_setting( 'slow_atoms_twitter_consumerSecret_setting', array(
		'default'      		=> __( '', 'slow-atoms' ),
		'sanitize_callback' => 'sanitize_text',
	) ) ;
	$wp_customize	-> add_setting( 'slow_atoms_twitter_token_setting', array(
		'default'      		=> __( '', 'slow-atoms' ),
		'sanitize_callback' => 'sanitize_text',
	) ) ;
	$wp_customize	-> add_setting( 'slow_atoms_twitter_tokenSecret_setting', array(
		'default'      		=> __( '', 'slow-atoms' ),
		'sanitize_callback' => 'sanitize_text',
	) ) ;
	/****************	Controls		**************/
	$wp_customize	-> add_control( new WP_Customize_Control( $wp_customize , 'slow_atoms_twitter_enable_control', array(
		'label'    			=> __( 'Enable Twitter API', 'slow-atoms' ),
		'section' 			=> 'slow_atoms_twitter_section',
		'settings' 			=> 'slow_atoms_twitter_enable_setting',
		'type'     			=> 'checkbox',
		'choices' => array(
			false => __( 'No' ),
			true => __( 'Yes' ),
		)
			
	) ) );
	$wp_customize	-> add_control( new WP_Customize_Control( $wp_customize , 'slow_atoms_twitter_consumerKey_control', array(
		'label'    			=> __( 'Consumer Key (API Key)', 'slow-atoms' ),
		'section' 			=> 'slow_atoms_twitter_section',
		'settings' 			=> 'slow_atoms_twitter_consumerKey_setting',
		'type'     			=> 'text'
	) ) );
	$wp_customize	-> add_control( new WP_Customize_Control( $wp_customize , 'slow_atoms_twitter_consumerSecret_control', array(
		'label'    			=> __( 'Consumer Secret (API Secret)', 'slow-atoms' ),
		'section' 			=> 'slow_atoms_twitter_section',
		'settings' 			=> 'slow_atoms_twitter_consumerSecret_setting',
		'type'     			=> 'text'
	) ) );
	$wp_customize	-> add_control( new WP_Customize_Control( $wp_customize , 'slow_atoms_twitter_token_control', array(
		'label'    			=> __( 'Access Token', 'slow-atoms' ),
		'section' 			=> 'slow_atoms_twitter_section',
		'settings' 			=> 'slow_atoms_twitter_token_setting',
		'type'     			=> 'text'
	) ) );
	$wp_customize	-> add_control( new WP_Customize_Control( $wp_customize , 'slow_atoms_twitter_tokenSecret_control', array(
		'label'    			=> __( 'Access Token Secret', 'slow-atoms' ),
		'section' 			=> 'slow_atoms_twitter_section',
		'settings' 			=> 'slow_atoms_twitter_tokenSecret_setting',
		'type'     			=> 'text'
	) ) );
	/**
 	* **************	FRONT PAGE		**************
 	*/
	/****************		Section		**************/
	$wp_customize	-> add_section('slow_atoms_theme_front_page', array(
		'title' 			=> __('Front Page', 'slow-atoms'),
		'priority' 			=> 2,
	) ) ;
	/****************	Setting Strap	**************/
	$wp_customize	-> add_setting( 'slow_atoms_front_page_title', array(
		'default'      		=> __( 'Snappy strapline.', 'slow-atoms' ),
		'sanitize_callback' => 'sanitize_text',
		'transport' 		=> 'postMessage',
	) ) ;
	/****************	Control	Strap	**************/
	$wp_customize	-> add_control( new WP_Customize_Control( $wp_customize , 'slow_atoms_front_page_title_control', array(
		'label'    			=> __( 'Homepage Title', 'slow-atoms' ),
		'description' 		=> __( 'Title above the homepage content. Site title and tagline are found under "Site Identity"' ),
		'section' 			=> 'slow_atoms_theme_front_page',
		'settings' 			=> 'slow_atoms_front_page_title',
		'type'     			=> 'text'
	) ) );
	/****************	Setting	Blurb	**************/
	$wp_customize	-> add_setting( 'slow_atoms_front_page_blurb', array(
		//'default'      		=> __( 'Overview of the research .', 'slow-atoms' ),
		'sanitize_callback' => 'sanitize_text',
		'transport' 		=> 'postMessage',
	) ) ;
	/****************	Control	Blurb	**************/
	$wp_customize	-> add_control( new WP_Customize_Control( $wp_customize , 'slow_atoms_front_page_blurb_control', array(
		'label'    			=> __( 'Research Overview', 'slow-atoms' ),
		'description' 		=> __( 'Short overview of your research.' ),
		'section' 			=> 'slow_atoms_theme_front_page',
		'settings' 			=> 'slow_atoms_front_page_blurb',
		'type'     			=> 'textarea'
	) ) );
	/****************	Setting	Desc	**************/
	$wp_customize	-> add_setting( 'slow_atoms_front_page_desc', array(
		//'default'      		=> __( 'Overview of the research .', 'slow-atoms' ),
		'sanitize_callback' => 'sanitize_text',
		'transport' 		=> 'postMessage',
	) ) ;
	/****************	Control Desc		**************/
	$wp_customize	-> add_control( new WP_Customize_Control( $wp_customize , 'slow_atoms_front_page_desc_control', array(
		'label'    			=> __( 'Research Description', 'slow-atoms' ),
		'description' 		=> __( 'Short description of your research.' ),
		'section' 			=> 'slow_atoms_theme_front_page',
		'settings' 			=> 'slow_atoms_front_page_desc',
		'type'     			=> 'textarea'
	) ) );
	/**
 	* **************		ARCHIVES	**************
 	*/
	/****************		Section		**************/
	$wp_customize	-> add_section('slow_atoms_theme_archives', array(
		'title' 			=> __('Archive Pages', 'slow-atoms'),
		'priority' 			=> 3,
	) ) ;
	/**************** Setting Research	**************/
	$wp_customize	-> add_setting( 'slow_atoms_archives_research', array(
		'default'      		=> __( '', 'slow-atoms' ),
		'sanitize_callback' => 'sanitize_text',
		'transport' 		=> 'postMessage',
	) ) ;
	/**************** Control Research	**************/
	$wp_customize	-> add_control( new WP_Customize_Control( $wp_customize , 'slow_atoms_archives_research_control', array(
		'label'    			=> __( 'Research Description', 'slow-atoms' ),
		'description' 		=> __( 'A more technical description of your research.' ),
		'section' 			=> 'slow_atoms_theme_archives',
		'settings' 			=> 'slow_atoms_archives_research',
		'type'     			=> 'textarea'
	) ) );
	/**
 	* **************	TEACHING GUIDE	**************
 	*/
	/****************		Section		**************/
	$wp_customize 		-> add_section('slow_atoms_theme_teaching_material', array(
		'title' 				=> __('Teaching Guide', 'slow-atoms'),
		'priority' 			=> 5,
	) ) ;
	/****************		Setting		**************/
	$wp_customize		-> add_setting( 'slow_atoms_theme_pdf_upload_settings', array(
        'transport'         => 'refresh'
    ));
	/****************		Control		**************/
	$wp_customize		-> add_control( new WP_Customize_Upload_Control( $wp_customize, 'slow_atoms_theme_pdf_upload_settings', array(
        'label'             => __('PDF Upload', 'name-theme'),
        'section'           => 'slow_atoms_theme_teaching_material',
        'settings'          => 'slow_atoms_theme_pdf_upload_settings',    
    )));
	// Sanitize text
	function sanitize_text( $text ) {
			return sanitize_text_field( $text );
	}
}

add_action('customize_register', 'slow_atoms_customize_register');

/**
 * Hide some of the sections
 */
function hide_customizer_sections( $wp_customize ) {
    //$wp_customize->remove_section( 'title_tagline' ); // Site identity
    //$wp_customize->remove_section( 'static_front_page' ); // Homepage settings
    $wp_customize->remove_section( 'colors' ); // Colors
    //$wp_customize->remove_panel( 'nav_menus'); // Menus
    $wp_customize->remove_panel( 'widgets' ); // Widgets
    $wp_customize->remove_section( 'header_image' ); // Header imagen
    $wp_customize->remove_section( 'background_image' ); // Background image
    //$wp_customize->remove_section( 'themes' ); // Themes
    $wp_customize->remove_control( 'custom_css' ); // Custom CSS 
}
add_action( 'customize_register', 'hide_customizer_sections', 30);
