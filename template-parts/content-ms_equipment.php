<?php
/**
 * Template part for displaying lab equipment content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package slow_atoms
 */


$ms_acf_equip_images =  get_field('ms_acf_equip_images') ;
$ms_acf_equip_desc	 =  get_field('ms_acf_equip_description_key') ;

for ( $i = 1 ; $i <= 4 ; $i++ ) {

	$image = 'image_' . $i ;

	if ( empty( $ms_acf_equip_images[ $image ] ) ) :
		// if we have reached the last image, break
		break ;
	else :
		$image_URL		= $ms_acf_equip_images[ $image ] ;
		$image_ID		= attachment_url_to_postid( $image_URL ) ;
		$image_srcset	= wp_get_attachment_image_srcset( $image_ID , 'full' );

		$image_markup  .= 
		'<div class="' . $wrapper_class . '">
			<img class="' . $image_class . '" loading="lazy" src="' . $image_URL . '" srcset="' . esc_attr( $image_srcset ) . '" />
		</div><!-- .' . $wrapper_class . '-->' ;
		
	endif ;

}

$post_id = $post -> ID ;
$service_post = $post ;

if ( is_singular() ) :

	echo '<section class="slow-atoms__page-content">' ;

endif ; 

?>

<article id="post-<?php echo $post_id ; ?>" class="wiki-entry <?php

	if ( is_singular() ) : ?>
	 is__single-wiki <?php
	endif ; 
	
	if ( is_archive() ) : ?>
		is__wiki-archive-entry <?php
	endif ; ?>
	

	 ">
	<?php

	if ( is_singular() ) :

		the_title( '<h2 class="contact-form__header">', '</h2>' ) ;

		echo $image_markup ;

		echo '<p>' . $ms_acf_equip_desc . '</p>';

		if ( is_user_logged_in( ) ) {
			slow_atoms_equipment_booking_form( $service_post, wp_get_current_user(), ''  ) ;
		};

	else :

		the_title( sprintf( '<h4 class="wiki-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );

	endif ;
	
	slow_atoms_edit_post_link() ; ?>

</article>
<?php if ( is_singular() ) :
echo "</section>" ;

endif ; 



