<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package slow_atoms
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('default-page'); ?>>

	<section class="slow-atoms__page-hero">

		<header class="page-header is__theme-background-transparent">

			<?php the_title( '<h1 class="page-title">', '</h1>' );?>
			<h2 class="page-description">
			<?php echo get_bloginfo( 'description', 'display' ); ?>
		 </h2>

		</header><!-- .page-header -->


		<div class="post-thumbnail">

			<?php if ( has_post_thumbnail() ) :

				the_post_thumbnail();

			else :

				// Grab random image from front page
				$rand_img = 'image_' . rand( 1 , 5 ) ;
				$pageID = get_option('page_on_front'); ?>
				<!-- Needs improving so we get the same markup as the_post_thumbnail(); -->
				<img class="person__thumbnail" src="<?php the_field($rand_img, $pageID); ?> "/>

			<?php	endif; ?>

		</div>


	</section>

	<div class="entry-content">
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
