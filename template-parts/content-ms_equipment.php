<?php
/**
 * Template part for displaying lab equipment content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package slow_atoms
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit ; // Exit if accessed directly.
}

$post_id = $post -> ID ;

$service_post = $post ;


if ( is_singular() ) :

	echo '<section class="slow-atoms__page-content">' ;

	get_template_part( 'template-parts/sidebar', get_post_type() );

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



