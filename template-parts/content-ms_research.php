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
		// if post is archive (NOT single) and post is on the right (not even) then delay aos
		if ( $count_for_aos % 2 != 0 && !is_singular() ) { ?>

			data-aos-delay="300" <?php

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

	 <?php

	if ( is_singular() ) :
		echo '<div class="entry-content">';
		the_content( );

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'slow-atoms' ),
				'after'  => '</div>',
			)
		);
		echo '</div><!-- .entry-content -->';

	endif ; ?>

	

	<footer class="footer-edit-link">
		<?php slow_atoms_entry_footer(); ?>
	</footer><!-- .entry-footer -->

	
</article><!-- #post-<?php the_ID(); ?> -->


<?php

if ( is_singular() ) :
// Get post type by post.
$post_type = $post->post_type;

// Get post type taxonomies.
$taxonomies = get_object_taxonomies( $post_type, 'objects' );

$term_IDs = array();

$related_publications = '' ;

// Loop each type of taxonomy
foreach ( $taxonomies as $taxonomy_slug => $taxonomy ){
	// Get the terms related to post
	$terms = get_the_terms( $post->ID, $taxonomy_slug );

	if ( ! empty( $terms ) ) {
		// Loop over cataegories of current taxonomy add collect related post IDs
		foreach ( $terms as $term ) {		
			$term_IDs[] = $term -> term_id ;
		}

	}
}

$args = array(
	'post_type' => 'ms_publications',
	'tax_query' => array(
		array(
		'taxonomy' => 'ms_taxonomy_research',
		'field' => 'term_id',
		'terms' => $term_IDs 
		)
	)
	);

$query = new WP_Query( $args );

if( $query -> have_posts( ) ) :
	$related_publications .= '<section class="related_publications">' ;
	$related_publications .= '<h3 class="related_publications-header">Related Publications</h3>' ;
	$related_publications .= '<ul class"related_publications-list">' ;
	while( $query -> have_posts( ) ) :
		$query -> the_post( );

		
		$related_publications .= '<li class="related_publications-entry" data-aos="fade-up">' ;
		$related_publications .= the_title( sprintf( '<h5 class="related_publication-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' , false ) ; 
		//echo $publication_entry ;

		$related_publications .= '</li>';



	endwhile;
	$related_publications .= '</ul>';
	$related_publications .= '</section>' ;
	echo $related_publications ;
endif;

wp_reset_postdata(); // Restore original Post Data
endif;

?>