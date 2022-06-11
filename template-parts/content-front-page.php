<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package slow_atoms
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('is__front-page'); ?>>

	<header class="entry-header is__theme-background-transparent">

		<h1 class="entry-title"><?php bloginfo( 'name' ); ?></h1>
		<h2 class="entry-description">
		<?php $slow_atoms_description = get_bloginfo( 'description', 'display' );
		 echo $slow_atoms_description ?>
	 </h2>
	</header><!-- .entry-header -->


	<div class="post-thumbnail">
		<?php $rand_img = 'image_' . rand(1,5); ?>
		<img class="attachment-post-thumbnail size-post-thumbnail wp-post-image" src="<?php the_field($rand_img); ?>" />
	</div><!-- .post-thumbnail -->


	<div class="entry-content">

		<h2 class="front__page-title"><?php	echo get_theme_mod( 'slow_atoms_front_page_title'); ?></h2>

		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'slow-atoms' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'slow-atoms' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
