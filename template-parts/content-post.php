<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package slow_atoms
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('is__news-content-entry'); ?> >

	<div class="news-thumbnail">
		<?php 
		
			if ( has_post_thumbnail() ) :
				
				the_post_thumbnail();

			else :
			
				slow_atoms_get_random_hero('post-thumbnail' , 'attachment-post-thumbnail size-post-thumbnail wp-post-image'); 
				
			endif ;
		?>
	</div>
	
	<div class="news-body">
		<header class="news-header">
			<?php the_title( '<h2 class="news-title">', '</h2>' ) ; ?>
		</header><!--  -->

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
		<!-- <div class="blur"></div> -->
	</div><!-- .news-body -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			// edit_post_link(
			// 	sprintf(
			// 		wp_kses(
			// 			/* translators: %s: Name of current post. Only visible to screen readers */
			// 			__( 'Edit <span class="screen-reader-text">%s</span>', 'slow-atoms' ),
			// 			array(
			// 				'span' => array(
			// 					'class' => array(),
			// 				),
			// 			)
			// 		),
			// 		wp_kses_post( get_the_title() )
			// 	),
			// 	'<span class="edit-link">',
			// 	'</span>'
			// );
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
