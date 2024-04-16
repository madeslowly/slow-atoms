<?php
/**
 * News archive page
 * 
 * 
 *
 * This is the blog post index page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package slow_atoms
 */

 get_header('' , array( 'append_site-header_class' => 'is__light-background' )); 

?>

	<main id="primary" class="news">

		<?php
		if ( have_posts() ) :

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', get_post_type() );

		endif;
		?>

	</main><!-- #main -->

<?php

get_footer();
