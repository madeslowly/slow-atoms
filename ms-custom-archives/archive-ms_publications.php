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

<main id="primary" class="site-main is__publication-archive">

	<section class="slow-atoms__page-hero">

		<header class="page-header is__theme-background-transparent"> 
			<?php the_archive_title( '<h1 class="page-title">', '</h1>' ) ; ?>
		</header><!-- .page-header -->
		
		<?php slow_atoms_get_random_hero('post-thumbnail' ,'attachment-post-thumbnail size-post-thumbnail wp-post-image'); ?>

	</section><!-- .slow-atoms__page-hero -->

	<section class="entry-content">

<?php

		$years = array();
		$year = '' ;

		if ( have_posts() ) :
			/* Start the Loop */
			while ( have_posts() ) :
				
				the_post();

				$previous_year = $year ;
				$year = get_the_date( 'Y' ) ;

				if ( $year != $previous_year ) :
					echo '<h2 class="publication__year-title">' .  $year . '</h2>' ;
				endif ;

				if ( ! isset( $years[ $year ] ) ) 
					$years[ $year ] = array();
					$years[ $year ][] = array( 'title' => get_the_title(), 'permalink' => get_the_permalink() );

				/*
					* Include the Post-Type-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Type name) and that will be used instead.
					*/
				get_template_part( 'template-parts/content', get_post_type() );


			endwhile;

			the_posts_navigation( array(
				'prev_text'	=> 'Older Publications',
				'next_text' => 'Newer Publications',
				'class'			=> 'slow-atoms-posts-nav'
			));

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
?>
	</section>
</main><!-- #main -->

<?php

get_footer();
