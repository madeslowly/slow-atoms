<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package slow_atoms
 */


/**
 * 
 * redirect known archives else, fallback template
 * 
 */

if ( is_post_type_archive( array ( 'ms_labwiki' , 'ms_people' , 'ms_research' , 'ms_teaching' , 'ms_publications', 'ms_equipment' ) ) ) :

	get_template_part( 'ms-custom-archives/archive', get_post_type() );

else : // Currently just wp native posts

	get_header(); ?>

	<main id="primary" class="site-main">

		<?php 
		
		if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
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

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

	</main><!-- #main -->

	<?php
	
	get_footer();

endif;
