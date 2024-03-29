<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package slow_atoms
 */

get_header('' , array( 'append_site-header_class' => 'is__light-background' ));

?>

	<main id="primary" class="site-main">

		<?php

		while ( have_posts() ) :

			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			slow_atoms_posts_nav('project' , 'true' , 'true');

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php

get_footer();
