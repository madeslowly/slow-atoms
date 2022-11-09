<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package slow_atoms
 */

 if ( !is_user_logged_in() ) {
     auth_redirect();
 }

 get_header('' , array( 'append_site-header_class' => 'is__light-background' ));

 ?>

 	<main id="primary" class="">

 		<?php
 		while ( have_posts() ) :
 			the_post();

 			get_template_part( 'template-parts/content', get_post_type() );

 		endwhile; // End of the loop.
 		?>

 	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
