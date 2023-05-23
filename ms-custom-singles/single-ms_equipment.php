<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package slow_atoms
 */

if ( !is_user_logged_in() ) { auth_redirect(); }

get_header('' , array( 'append_site-header_class' => 'is__light-background' ));

?>

<main id="primary" class="is__booking-page">

	<?php

	if ( have_posts() ) :
	/* Start the Loop */

		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

		endwhile; // End of the loop.

		the_posts_navigation();

      else :

        get_template_part( 'template-parts/content', 'none' );

      endif;
	?>

</main><!-- #main -->

<?php

get_footer();
