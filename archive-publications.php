<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package slow_atoms
 */

get_header();
?>

	<main id="primary" class="site-main is__publication-archive	">

		<header class="page-header is__theme-background-transparent">
			<?php
			the_archive_title( '<h1 class="page-title">', '</h1>' );
			?>
		</header><!-- .page-header -->

		<div class="post-thumbnail">
			<img class="attachment-post-thumbnail size-post-thumbnail wp-post-image" src="<?php echo get_theme_mod('slow_atoms_theme_people_heros'); ?>" />
		</div><!-- .post-thumbnail -->

		<section class="entry-content">
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

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>
		</section>
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
