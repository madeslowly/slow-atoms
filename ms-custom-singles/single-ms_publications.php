<?php
/**
 * The template for displaying all single publications
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package slow_atoms
 */

get_header('' , array( 'append_site-header_class' => 'is__light-background' )) ; ?>

<main id="primary" class="site-main">

	<?php
	while ( have_posts() ) :
		the_post();
		$current_post_ID = get_the_ID();
		
		get_template_part( 'template-parts/content', get_post_type() );

		//slow_atoms_posts_nav('' , 'true' , '' );
					
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
			$related_publications .= '<h3 class="related_publications-header">Similar Articles</h3>' ;
			$related_publications .= '<ul class"related_publications-list">' ;
			while( $query -> have_posts( ) ) :
				$query -> the_post( );

				if( $current_post_ID != get_the_ID() ) :
					$related_publications .= '<li class="related_publications-entry" data-aos="fade-up">' ;
					$related_publications .= the_title( sprintf( '<h5 class="related_publication-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' , false ) ; 
					//echo $publication_entry ;

					$related_publications .= '</li>';

				endif ;

			endwhile;
			$related_publications .= '</ul>';
			$related_publications .= '</section>' ;
			echo $related_publications ;
		endif;

		wp_reset_postdata(); // Restore original Post Data

	endwhile; // End of the loop.

	// Get post by post ID.
	if ( ! $post = get_post() ) {
		return '';
	}

	?>

</main><!-- #main -->
<?php


get_footer();
