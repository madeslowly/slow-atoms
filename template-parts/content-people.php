<?php
/**
 * Template part for displaying people
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package slow_atoms
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('is__single-person'); ?>>

	<?php
	if ( is_singular() ) :
		// single post
	?>
	<header class="entry-header"><?php
		the_title( '<h1 class="page-title">', '</h1>' ); ?>
	</header><!-- .entry-header --> <?php

	else :
		// archive page so wrap each entry in href
		?>
		<a href="<?php the_permalink() ; ?>" rel="bookmark">
		<header class="entry-header"><?php
		the_title( '<h3 class="entry-title">', '</h3>' ); ?>
		</header><!-- .entry-header --><?php

	endif; ?>


	<?php
	if ( has_post_thumbnail() ) :
		the_post_thumbnail();

	else :
		$rand_img = 'image_' . rand(1,5); ?>
		<img class="attachment-post-thumbnail size-post-thumbnail wp-post-image" src="<?php the_field($rand_img , 2 ); ?>" />
		<?php
	endif; ?>

	<div class="entry-content">
		<?php
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
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php slow_atoms_entry_footer(); ?>
	</footer><!-- .entry-footer -->

	<?php
	if ( ! is_singular() ) : ?>
		</a><?php
	endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
