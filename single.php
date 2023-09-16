<?php
/**
 * The template for displaying all single posts
 * 
 * unlike archives, this has to serve for posts and custom posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package slow_atoms
 */


 if ( is_singular( array( 'post' ) ) ) :

	// Wordpress system post

	get_header(); 
	
	?>

	<main id="primary" class="site-main single">

		<?php
	
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			the_post_navigation(
				array(
					'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'slow-atoms' ) . '</span> <span class="nav-title">%title</span>',
					'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'slow-atoms' ) . '</span> <span class="nav-title">%title</span>',
				)
			);

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php

get_footer();

	

else : //redirect known singles else

	get_template_part( 'ms-custom-singles/single', get_post_type() );

endif ;