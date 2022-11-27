<?php
/**
 * Template part for displaying wiki content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package slow_atoms
 */


?>


<?php if ( is_singular() ) :

	echo '<section class="wiki__content">' ;
	get_template_part( 'template-parts/sidebar', get_post_type() ); 
endif ; ?>

<article id="post-<?php the_ID(); ?>" class="wiki-entry <?php

	if ( is_singular() ) : ?>
	 is__single-wiki <?php
	endif ; 
	
	if ( is_archive() ) : ?>
		is__wiki-archive-entry <?php
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

	endif ;
	
	slow_atoms_edit_post_link() ; ?>

</article>
<?php if ( is_singular() ) :
echo "</section>" ;

endif ; ?>