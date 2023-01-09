<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package slow_atoms
 */

/**
 * 
 * redirect known singles else, fallback template
 * 
 */

 if ( is_singular( array ( 'ms_labwiki' , 'ms_people' , 'ms_research' , 'ms_teaching' , 'ms_publications' ) ) ) :

	get_template_part( 'ms-custom-singles/single', get_post_type() );

else : // Currently just wp native posts

	get_header(); ?>

	<main id="primary" class="site-main">

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

endif ;