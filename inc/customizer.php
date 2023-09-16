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
		$wp_customize->selective_refresh->add_partial( 'slow_atoms_front_page_featured', array(
			'selector' => '.sa__collage--card-person',
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
	wp_enqueue_script( 'slow-atoms-customizer', get_template_directory_uri() . '/inc/js/customizer.js', array( 'customize-preview' ), SLOW_ATOMS_THEME_VERSION, true );
}
add_action( 'customize_preview_init', 'slow_atoms_customize_preview_js' );



function slow_atoms_theme_colors( $wp_customize ) {
	/**
	 * **************		COLORS		**************
	 * 
	 * Register Slow Atoms colour schemes with $wp_customize
	 * 
	 * Added to wp section, colors
	 * 
	 * See color-scheme.php
	 * 
	 * TODO: read thru this, color-scheme.php, inc/js/color-scheme.js and inc/js/color-scheme-preview.js.
	 * it all needs cleaning up
	 */
	$obj = new slow_atoms_Color_Scheme();

	// Array of colours within the palette
	$options = array(
		'slow_atoms_primary_theme_color'	=> __( 'Primary', 'slow_atoms' ),
		'slow_atoms_secondary_theme_color' 	=> __( 'Secondary', 'slow_atoms' ),
		'slow_atoms_navbar_link_color'		=> __( 'Menu Links', 'slow_atoms' ),
		'slow_atoms_accent_color'			=> __( 'Accent', 'slow_atoms' ),
		'footer_bg_color'					=> __( 'Footer background color', 'slow_atoms' ),
		'highlight_color'					=> __( 'Hightlight color', 'slow_atoms' ),
	);
	// Controls and settings for each colour
	foreach ( $options as $key => $label ) {
		$wp_customize	-> add_setting( $key, array(
			'sanitize_callback'	=> 'sanitize_hex_color',
		) );
		$wp_customize	->	add_control( new WP_Customize_Color_Control( $wp_customize, $key, array(
			'label' 			=> $label,
			'section' 			=> 'colors',
		) ) );
	}
	
	// Control and setting for the palette

	/****************		Setting		**************/
	$wp_customize	-> add_setting( 'color_scheme', array( 'default'	=> 'classic', ) ) ;

	$color_schemes	= $obj -> get_color_schemes() ; $choices = array( ) ;
	
	foreach ( $color_schemes as $color_scheme => $value ) {
		$choices[$color_scheme] = $value['label'];
	}
	$wp_customize	-> add_control( 'color_scheme', array(
		'label'   	=> __( 'Palettes', 'slow_atoms' ),
		'section'	=> 'colors',
		'type'    	=> 'select',
		'choices' 	=> $choices,
		'priority'	=> 1,
	) );
}

add_action('customize_register', 'slow_atoms_theme_colors');

function slow_atoms_customize_register( $wp_customize ) {
	/**
 	* **************  Registered Domains **************
 	*/
	/****************		Section		**************/
	$wp_customize	-> add_section('slow_atoms_authdomains_section', array(
		'title' 			=> __('Authorized Domains', 'slow-atoms'),
		//'priority' 			=> 4,
	) ) ;
	/****************		Setting		**************/
	$wp_customize	-> add_setting( 'slow_atoms_authdomains_setting', array(
		'default'      		=> __( '', 'slow-atoms' ),
		'sanitize_callback' => 'sanitize_text',
	) ) ;
	/****************		Control		**************/
	$wp_customize	-> add_control( new WP_Customize_Control( $wp_customize , 'slow_atoms_authdomains_control', array(
		'label'    			=> __( 'Authorized Domains', 'slow-atoms' ),
		'description' 		=> __( 'If this website is set to allow anyone to register (<b>General Settings -> Membership</b>) then you can also limit the allowed emails by domain. Add comma seperated domains, e.g. <i>gmail.com, gmail.co.uk<i>. Note that subdomain emails will also be allowed. If the authorised domain is <i>gmail.com</i> then any email ending with that domain will be accepted. e.g. myemail@subdomain.gmail.com and myemail@gmail.com would both be accepted.' ),
		'section' 			=> 'slow_atoms_authdomains_section',
		'settings' 			=> 'slow_atoms_authdomains_setting',
		'type'     			=> 'text'
	) ) );
	/**
 	* **************  Google Analytics  **************
 	*/
	/****************		Section		**************/
	$wp_customize	-> add_section('slow_atoms_gtag_section', array(
		'title' 			=> __('Google Analytics', 'slow-atoms'),
		//'priority' 			=> 4,
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
		//'priority' 			=> 4,
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
	
	// Added to wp section, static_front_page

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
		'section' 			=> 'static_front_page',
		'settings' 			=> 'slow_atoms_front_page_title',
		'type'     			=> 'text'
	) ) );
	/****************	Setting	Blurb	**************/
	$wp_customize	-> add_setting( 'slow_atoms_front_page_blurb', array(
		//'default'      		=> __( 'Overview of the research .', 'slow-atoms' ),
		'sanitize_callback' => 'wp_kses_post',
		'transport' 		=> 'postMessage',
	) ) ;
	/****************	Control	Blurb	**************/
	$wp_customize	-> add_control( new WP_Customize_Control( $wp_customize , 'slow_atoms_front_page_blurb_control', array(
		'label'    			=> __( 'Research Overview', 'slow-atoms' ),
		'description' 		=> __( 'Overview of your research. This is prominently displayed on your homepage.' ),
		'section' 			=> 'static_front_page',
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
		'description' 		=> __( 'Short description of your research. This is displayed when a user hovers over the hompage research panel.' ),
		'section' 			=> 'static_front_page',
		'settings' 			=> 'slow_atoms_front_page_desc',
		'type'     			=> 'textarea'
	) ) );
	/****************	Setting Fetured		**************/
	$choices = array();
	$args = array(
		'post_type'		=> 'ms_people',
		'numberposts'	=> -1,
	);
	$people = get_posts( $args );
	foreach( $people as $person ) {
		$choices[ $person -> ID ] = $person -> post_title ;
	}
	$wp_customize	-> add_setting( 'slow_atoms_front_page_featured', array(
		'transport'			=> 'postMessage',
	) ) ;
	/****************	Control Fetured		**************/
	$wp_customize	-> add_control( 'slow_atoms_front_page_featured_control', array(
		'label'    			=> __( 'Featured Person', 'slow_atoms' ),
		'type'     			=> 'select',
		'section'  			=> 'static_front_page',
		'settings' 			=> 'slow_atoms_front_page_featured',
		'priority' 			=> 4,
		'choices'  			=> $choices,
	));
	/**
 	* **************		ARCHIVES	**************
 	*/
	/****************		Section		**************/
	$wp_customize	-> add_section('slow_atoms_theme_archives', array(
		'title' 			=> __('Archive Pages', 'slow-atoms'),
		'priority' 			=> 121, // After Homepage Settings
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
		'description' 		=> __( 'A technical description of your research. This will be displayed at the top of the research page.' ),
		'section' 			=> 'slow_atoms_theme_archives',
		'settings' 			=> 'slow_atoms_archives_research',
		'type'     			=> 'textarea'
	) ) );
	/**
 	* **************	TEACHING GUIDE	**************
 	*/
	/****************		Section		**************/
	// Added to archive pages section
	/****************		Setting		**************/
	$wp_customize		-> add_setting( 'slow_atoms_theme_pdf_upload_settings', array(
        'transport'         => 'refresh'
    ));
	/****************		Control		**************/
	$wp_customize		-> add_control( new WP_Customize_Upload_Control( $wp_customize, 'slow_atoms_theme_pdf_upload_settings', array(
        'label'             => __('Teaching Guide', 'name-theme'),
		'description' 		=> __('Optional pdf upload of an overview of the teaching found on the Teaching Archive page.'),
        'section'           => 'slow_atoms_theme_archives',
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
    //$wp_customize->remove_section( 'colors' ); // Colors
    //$wp_customize->remove_panel( 'nav_menus'); // Menus
    $wp_customize->remove_panel( 'widgets' ); // Widgets
    $wp_customize->remove_section( 'header_image' ); // Header imagen
    $wp_customize->remove_section( 'background_image' ); // Background image
    //$wp_customize->remove_section( 'themes' ); // Themes
    $wp_customize->remove_control( 'custom_css' ); // Custom CSS 
}
add_action( 'customize_register', 'hide_customizer_sections', 30);



// Load custom image gallery selector

// function affiliate_image_gallery_customize_register( $wp_customize ) {
 
//     if ( ! class_exists( 'CustomizeImageGalleryControl\Control' ) ) {
//         return;
//     }
 
//     $wp_customize	-> add_section( 'affiliate_image_gallery_section', array(
//         'title'     => __( 'Footer Affiliates' ),
//         'priority'  => 25,
//     ) );
//     $wp_customize	-> add_setting( 'affiliate_image_gallery', array(
//         'default'	=> array(),
//         'sanitize_callback' => 'wp_parse_id_list',
//     ) );
//     $wp_customize	-> add_control( new CustomizeImageGalleryControl\Control(
//         $wp_customize,
//         'affiliate_image_gallery',
//         array(
//             'label'    => __( 'Image Gallery of Affiliates' ),
//             'section'  => 'affiliate_image_gallery_section',
//             'settings' => 'affiliate_image_gallery',
//             'type'     => 'image_gallery',
//         )
//     ) );
// }
// add_action( 'customize_register', 'affiliate_image_gallery_customize_register' );
