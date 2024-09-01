<?php
/**
 * The template for displaying teaching archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package slow_atoms
 */

get_header() ; 

?>

<main id="primary" class="site-main is__teaching-archive">

	<section class="slow-atoms__page-hero">

		<header class="page-header is__theme-background-transparent"> 
			<h1 style="word-wrap: normal" class="page-title">
				<?php echo the_archive_title(); ?>
			</h1>
			<h2 class="page-description" data-aos="fade-in" data-aos-duration="600">
                <?php echo 'at the department of ' . get_bloginfo( 'description', 'display' ); ?>
            </h2>
		</header><!-- .page-header --> 
		
		<?php
		if ( get_theme_mod('slow_atoms_theme_teaching_hero') ) :

			$image_url		= get_theme_mod('slow_atoms_theme_teaching_hero') ;
			$image_ID       = attachment_url_to_postid( $image_url );
			$image_srcset   = wp_get_attachment_image_srcset( $image_ID, 'full' );

			?>
			<div class="post-thumbnail">
				<img class="attachment-post-thumbnail size-post-thumbnail wp-post-image"
				src="<?php echo $image_url ; ?>" srcset="<?php echo esc_attr( $image_srcset ); ?>" />
			</div><!-- .post-thumbnail -->
			<?php

		else :

			slow_atoms_get_random_hero('post-thumbnail' ,'attachment-post-thumbnail size-post-thumbnail wp-post-image');

		endif ;
		?>

	</section><!-- .slow-atoms__page-hero -->

	<section class="teaching__content">
		
		<?php
		if (get_theme_mod('slow_atoms_archives_teaching')) :
			$blurb	= '<div class="sa__archive-blurb-wrap"><h4 class="sa__archive-blurb-text blurb-accent">';
			$blurb .= get_theme_mod('slow_atoms_archives_teaching');
			$blurb .= '</h4></div>';
			
			echo $blurb ;
		endif ;
		?>

		<ul class="teaching__courses-list">
			<?php
			$cat_terms = get_terms(
				// Get teaching taxonomies
				array('ms_taxonomy_teaching'),
				array(
					'hide_empty'    => false,
					'orderby'       => 'name',
					'order'         => 'ASC',
					'number'        => 'all' 
				)
			) ;

			if( $cat_terms ) :
				foreach( $cat_terms as $term ) :
					// Dont include cats with a parent
					if( !  $term -> parent ) :
						$term_url = get_term_link( $term );
						echo '<li class="teaching_courses-item"><a href="' . $term_url . '" class="teaching_courses-item-link">' . $term -> name . '</a></li>';
					endif ;
					wp_reset_postdata() ; // Restore original Post Data
				endforeach ;
			endif;
			?>
		</ul>

	</section><!-- .teaching__list -->
</main><!-- #main -->

<?php

get_footer();
