<?php
/**
 * Template part for displaying wikis
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package slow_atoms
 */

?>

<article id="post-<?php the_ID(); ?>" class="wiki-entry <?php

	if ( is_singular() ) : ?>
	 is__single-wiki <?php
	endif ; ?>

	 ">
	<?php

	if ( is_singular() ) :

		the_title( '<h2 class="wiki-title">' , '</h2>' )  ; ?>

		<div class="entry-content"> <?php

			the_content( sprintf( wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */

				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'slow-atoms' ),

				array(
					'span' => array('class' => array(),	),
				)
			),

			wp_kses_post( get_the_title() ) )	);

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'slow-atoms' ),
					'after'  => '</div>',
				)
			);
			?>
		</div><!-- .entry-content --><?php

	else :

		the_title( sprintf( '<h4 class="wiki-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );

	endif ;?>



</article>
