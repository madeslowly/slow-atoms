<?php

/**
 * Register slow atoms theme colors
 */

function slow_atoms_customise_colors() {

	// Primary theme color
	$slow_atoms_theme_color = get_theme_mod('slow_atoms_primary_theme_color');

	// Secondary theme color
	$hashless_theme_color = str_replace( "#" , "" , $slow_atoms_theme_color ) ;

	$theme_color_hsl_rot = slow_atoms_180_hue_rot($hashless_theme_color);

	$slow_atoms_secondary_theme_color = "hsl(" . $theme_color_hsl_rot[0] . "," . $theme_color_hsl_rot[1] . "%," . $theme_color_hsl_rot[2] . "%)";

	$slow_atoms_theme_color_lighter = colourBrightness( $slow_atoms_theme_color, .8);

	$slow_atoms_theme_color_darker = colourBrightness( $slow_atoms_theme_color, -.3);

	$slow_atoms_theme_color_alpha_005 = hex2rgba( $slow_atoms_theme_color , .05) ;
	$slow_atoms_theme_color_alpha_010 = hex2rgba( $slow_atoms_theme_color , .1) ;
	$slow_atoms_theme_color_alpha_020 = hex2rgba( $slow_atoms_theme_color , .2) ;
	$slow_atoms_theme_color_alpha_030 = hex2rgba( $slow_atoms_theme_color , .3) ;
	$slow_atoms_theme_color_alpha_040 = hex2rgba( $slow_atoms_theme_color , .4) ;
	$slow_atoms_theme_color_alpha_060 = hex2rgba( $slow_atoms_theme_color , .6) ;
	$slow_atoms_theme_color_alpha_070 = hex2rgba( $slow_atoms_theme_color , .7) ;
	$slow_atoms_theme_color_alpha_080 = hex2rgba( $slow_atoms_theme_color , .8) ;
	$slow_atoms_theme_color_alpha_090 = hex2rgba( $slow_atoms_theme_color , .9) ;

	?>

	<style type="text/css">

		:root {
			--theme-color: 				<?php echo $slow_atoms_theme_color; 				?>;
			--theme-color-compliment: 	<?php echo $slow_atoms_secondary_theme_color; 		?>;
			--theme-color-dark: 		<?php echo $slow_atoms_theme_color_darker;	 		?>;
			--theme-color-light: 		<?php echo $slow_atoms_theme_color_lighter;	 		?>;
			--theme-color-alpha-005: 	<?php echo $slow_atoms_theme_color_alpha_005;	 	?>;
			--theme-color-alpha-010: 	<?php echo $slow_atoms_theme_color_alpha_010;	 	?>;
			--theme-color-alpha-020: 	<?php echo $slow_atoms_theme_color_alpha_020;	 	?>;
			--theme-color-alpha-030: 	<?php echo $slow_atoms_theme_color_alpha_030;	 	?>;
			--theme-color-alpha-040: 	<?php echo $slow_atoms_theme_color_alpha_040;	 	?>;
			--theme-color-alpha-050: 	<?php echo $slow_atoms_theme_color_alpha_050;	 	?>;
			--theme-color-alpha-060: 	<?php echo $slow_atoms_theme_color_alpha_060;	 	?>;
			--theme-color-alpha-070: 	<?php echo $slow_atoms_theme_color_alpha_070;	 	?>;
			--theme-color-alpha-080: 	<?php echo $slow_atoms_theme_color_alpha_080;	 	?>;
			--theme-color-alpha-090: 	<?php echo $slow_atoms_theme_color_alpha_090;	 	?>;

		}
	</style>

<?php }

add_action( 'wp_head' , 'slow_atoms_customise_colors');
