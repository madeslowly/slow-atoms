<?php
/**
 * 
 * Get random image from homepage ACF image fields
 *
 * @package slow_atoms
 * @since 0.0.0
 * 
 */

 function slow_atoms_get_random_hero( $wrapper_class , $image_class ) {
	
	$home_page_ID		=	get_option( 'page_on_front' ) ;
	$home_page_fields	=	get_fields( $home_page_ID , true ) ;

	// Count the number of populated fields
	// Number of fields set in inc/custom-fields/acf-hero-images.php
	$possible_fields	=	count( $home_page_fields ) ;
	// Number of user populated fields
	$populated_feilds	=	1 ;

	while( $populated_feilds <= $possible_fields ) : 
		// Odly doesnt work with image_key
		$image_name = 'ms_acf_hero_image_' . $populated_feilds  ;
		
		if ( empty( $home_page_fields[ $image_name ] ) ) :
			// Break as soon as we get an empty field and reduce populated_feilds by one.
			$populated_feilds = $populated_feilds - 1  ;
			break ;

		else :
			$populated_feilds++ ;
		endif ;
	endwhile;

	$image_key			=	'ms_acf_hero_images_field_' . rand( 1 , $populated_feilds ) ;

	if ( get_field( $image_key , $home_page_ID ) ) :

		$image_ID		=	get_field( $image_key , $home_page_ID , false ) ;
		$image_srcset	=	wp_get_attachment_image_srcset( $image_ID , 'full' );
		$image_url		=	wp_get_attachment_image_src( $image_ID )[ 0 ] ;

		$image_markup = 
		'<div class="' . $wrapper_class . '">
			<img class="' . $image_class . '" loading="lazy" src="' . $image_url . '" srcset="' . esc_attr( $image_srcset ) . '" />
		</div><!-- .' . $wrapper_class . '-->' ;
	else :

		$image_markup = 
		'<span style="display:flex;width:100vw;">
			No image found. Edit home page and select images under "Hero Images"
		</span>';
	endif ;

	echo $image_markup ;

}