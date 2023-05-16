<?php

/**
 * Register slow atoms theme colors
 */

function slow_atoms_customise_colors() {

	// Primary theme color
	$slow_atoms_primary_theme_color		= get_theme_mod('slow_atoms_primary_theme_color')	;
	// Secondary theme color
	$slow_atoms_secondary_theme_color	= get_theme_mod('slow_atoms_secondary_theme_color')	;
	// Navbar Link color
	$slow_atoms_navbar_link_color		= get_theme_mod('slow_atoms_navbar_link_color')	;
	// Accent color
	$slow_atoms_accent_color			= get_theme_mod('slow_atoms_accent_color')	;

	// Secondary theme color
	//$hashless_theme_color = str_replace( "#" , "" , $slow_atoms_primary_theme_color ) ;

	//$theme_color_hsl_rot = slow_atoms_180_hue_rot($hashless_theme_color);

	//$slow_atoms_secondary_theme_color = "hsl(" . $theme_color_hsl_rot[0] . "," . $theme_color_hsl_rot[1] . "%," . $theme_color_hsl_rot[2] . "%)";

	$slow_atoms_theme_color_lighter = colourBrightness( $slow_atoms_primary_theme_color, .8);

	$slow_atoms_theme_color_darker = colourBrightness( $slow_atoms_primary_theme_color, -.3);

	$alphas = array(0.1,0.2,0.3,0.4,0.5,0.6,0.7,0.8,0.9,0.95) ;

	$css_root_colors_alphas = '';

	foreach ( $alphas as $alpha ) {
		$primary_alpha		= hex2rgba( $slow_atoms_primary_theme_color		, $alpha ) ;
		$secondary_alpha	= hex2rgba( $slow_atoms_secondary_theme_color	, $alpha ) ;
		$alpha_str			= str_replace('.', '',sprintf("%' .2f", $alpha) );
		$css_root_colors_alphas .= '--theme-color-primary-alpha-' 		. $alpha_str . ' : ' . $primary_alpha . ' ;' . "\r\n";
		$css_root_colors_alphas .= '--theme-color-secondary-alpha-' 	. $alpha_str . ' : ' . $secondary_alpha . ' ;' . "\r\n";
		$i ++ ;
	}

	$css_root_colors = ':root {' . "\r\n"	.
	'--theme-color-primary:'	.	$slow_atoms_primary_theme_color		.	';' . "\r\n" .
	'--theme-color-secondary:'	. 	$slow_atoms_secondary_theme_color	.	';' . "\r\n" .
	'--theme-color-nav-links:'	. 	$slow_atoms_navbar_link_color		.	';' . "\r\n" .
	'--theme-color-accent:'		. 	$slow_atoms_accent_color			.	';'	. "\r\n" .
	'--theme-color-light:'		. 	$slow_atoms_theme_color_lighter		.	';'	. "\r\n" .
		
	$css_root_colors_alphas . '}';


	return $css_root_colors ;

}
