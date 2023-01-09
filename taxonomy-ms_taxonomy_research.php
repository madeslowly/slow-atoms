<?php
/**
 * The template for displaying research archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package slow_atoms
 */

get_header() ; ?>

<main id="primary" class="site-main is__research-archive">

	<section class="slow-atoms__page-hero">

		<header class="page-header is__theme-background-transparent"> <?php
			the_archive_title( '<h1 class="page-title">', '</h1>' );	?>
		</header><!-- .page-header --> 
		
		<?php slow_atoms_get_random_hero('post-thumbnail' ,'attachment-post-thumbnail size-post-thumbnail wp-post-image'); ?>

	</section><!-- .slow-atoms__page-hero -->

	<section class="research__list"> <?php
		if ( have_posts() ) :
			$count_for_aos = 0 ;
			/* Start the Loop */
			while ( have_posts() ) :
				
				$count_for_aos ++ ;
				global $count_for_aos ;

				the_post();
				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				 get_template_part( 'template-parts/content', get_post_type() );

				 $wp_query->current_post 	;
				 echo $index_query ;

			 endwhile;

			 the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif ; ?>
	</section><!-- .research__list -->
</main><!-- #main -->

<?php

get_footer();
