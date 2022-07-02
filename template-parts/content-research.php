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

	// if archive list, add appropriate class and animation
	if ( !is_singular() ) {

		post_class('is__research-archive-entry') ; ?>
		data-aos="fade-in"  data-aos-anchor-placement="top-bottom" <?php

		// delay aos on .is__research-archive-entry on the right
		if ( $count_for_aos % 2 == 0 && !is_singular() ) { ?>

			data-aos-delay="400" <?php

		}
	}
	// singular so add appropriate class
	else ; {

		post_class( 'is__single-research' ) ;

	} ?> ><!-- #post-<?php the_ID(); ?> --><?php

	// Check if archive list then for post thumbnail and set up hero markup
	if ( ! is_singular() ) {
		if ( has_post_thumbnail() ) : ?>

			<div class="research__thumbnail-wrap"> <?php
				the_post_thumbnail('full', array('class' => 'research__thumbnail')); ?>
			</div> <?php

		// No thumbnail so use random from hompage heros
		else :

				slow_atoms_get_random_hero('research__thumbnail-wrap' ,'research__thumbnail');

		endif ;
	}

	// If archive list, wrap all copy with href pointing to single post
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

	if ( has_excerpt() && ! is_singular() ) : ?>

	<div class="research__project-excerpt-wrap">
		<p class="research__project-excerpt"><?php
			echo  get_the_excerpt() ; ?>
		</p>
	</div><!-- .research__project-excerpt --><?php

	endif ;

	if ( !is_singular() ) { ?>

	</div></a> <!-- .research__project-link --><?php

	} ?>

	<div class="entry-content"> <?php

	if ( is_singular() ) :

		the_content( );

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
