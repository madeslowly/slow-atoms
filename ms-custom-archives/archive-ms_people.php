<?php
/**
* The template for displaying people archive pages
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package slow_atoms
*/

get_header() ; ?>

<main id="primary" class="site-main is__people-archive">

	<section class="slow-atoms__page-hero">

		<header class="page-header is__theme-background-transparent">
			<!-- Needs moving to theme control -->
			<h1 class="page-title">Meet the Group</h1>
		</header><!-- .page-header --> <?php

		if ( get_theme_mod('slow_atoms_theme_people_hero') ) :

				$image_url		= get_theme_mod('slow_atoms_theme_people_hero') ;
				$image_ID       = attachment_url_to_postid( $image_url );
				$image_srcset   = wp_get_attachment_image_srcset( $image_ID, 'full' );
				//$image_url      = wp_get_attachment_image_src($image_ID)[0];
				?>

				<div class="post-thumbnail">
					<img class="attachment-post-thumbnail size-post-thumbnail wp-post-image" src="<?php echo $image_url ; ?>" srcset="<?php echo esc_attr( $image_srcset ); ?>" />
				</div><!-- .post-thumbnail --> <?php

			else :

					slow_atoms_get_random_hero('post-thumbnail' ,'attachment-post-thumbnail size-post-thumbnail wp-post-image');

			endif ; ?>

	</section><!-- .slow-atoms__page-hero -->

	<section class="people__list"> <?php
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

		endif ; ?>
	</section><!-- .people__list -->
</main><!-- #main -->

<?php
get_sidebar();
get_footer();
