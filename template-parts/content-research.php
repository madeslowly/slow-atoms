<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package slow_atoms
 */
global $count_for_aos ;
?>

<article id="post-<?php the_ID(); ?>" <?php


	if ( !is_singular() ) :

		post_class('is__research-archive-entry') ; ?>

		data-aos="fade-in"  data-aos-anchor-placement="top-bottom" <?php

	endif ;

	if ( $count_for_aos % 2 == 0 && !is_singular() ) : ?>

		data-aos-delay="400" <?php

	endif ;

	if ( is_singular() ) : ?>

		post_class('is__single-research'); <?php

	endif; ?> > <?php

	if ( has_post_thumbnail() ) : ?>

		<div class="research__thumbnail-wrap"> <?php
			the_post_thumbnail('full', array('class' => 'research__thumbnail')); ?>
		</div> <?php

	else :

			slow_atoms_get_random_hero('research__thumbnail-wrap' ,'research__thumbnail');

	endif ;

	if ( !is_singular() ) : ?>

		<a class="research__project-link" href="<?php the_permalink() ; ?>" rel="bookmark">
			<div class="research__project-copy-wrap"> <?php

	endif ; ?>

	<header class="research__project-header"> <?php

	if ( is_singular() ) :

		the_title( '<h1 class="research__project-title">', '</h1>' );

	else :


		the_title( '<h2 class="research__project-title">', '</h2>' );

	endif ; ?>

</header><!-- .research__project-header --><?php

if ( has_excerpt() ) : ?>

	<div class="research__project-excerpt-wrap">
		<p class="research__project-excerpt"><?php

			echo  get_the_excerpt() ; ?>

		</p>

	</div><!-- .research__project-excerpt --><?php

endif ;

if ( !is_singular() ) : ?>

</div></a> <?php

endif ; ?>

	<div class="entry-content"> <?php

	if ( is_singular() ) :

		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'slow-atoms' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'slow-atoms' ),
				'after'  => '</div>',
			)
		);

	endif ; ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php slow_atoms_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
