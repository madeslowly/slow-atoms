<?php
/**
 * The template for displaying teaching archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package slow_atoms
 */

get_header() ; ?>

<main id="primary" class="site-main is__teaching-archive">

	<section class="slow-atoms__page-hero">

		<header class="page-header is__theme-background-transparent"> <?php
			the_archive_title( '<h1 class="page-title">', '</h1>' );	?>
		</header><!-- .page-header --> <?php

		if ( get_theme_mod('slow_atoms_theme_teaching_hero') ) :

			$image_url		= get_theme_mod('slow_atoms_theme_teaching_hero') ;
			$image_ID       = attachment_url_to_postid( $image_url );
			$image_srcset   = wp_get_attachment_image_srcset( $image_ID, 'full' ); ?>

			<div class="post-thumbnail">
				<img class="attachment-post-thumbnail size-post-thumbnail wp-post-image"
				src="<?php echo $image_url ; ?>" srcset="<?php echo esc_attr( $image_srcset ); ?>" />
			</div><!-- .post-thumbnail --> <?php

		else :

			slow_atoms_get_random_hero('post-thumbnail' ,'attachment-post-thumbnail size-post-thumbnail wp-post-image');

		endif ; ?>

	</section><!-- .slow-atoms__page-hero -->

	<section class="teaching__content"> <?php
		if ( have_posts() ) :
			$count_for_aos = 0 ;
			/* Start the Loop */
			while ( have_posts() ) :
				
				$count_for_aos ++ ;
				global $count_for_aos ;

				the_post();
				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				
				/**
				 * get_template_part( 'template-parts/content', get_post_type() );
				 * dont bother getting the content or post title
				 */ 

				if ( get_field('lecture_notes_lecture_name', $post->ID) ) :
					// User has given a unique name so use it.
					$lecture_name =  get_field('lecture_notes_lecture_name', $post->ID) ;
					
				else :
					// No unique name so get post title and append with "lecture Notes"
					$lecture_name =  the_title( '' , ' Lecture Notes' , false );

				endif ;
				
				// get URLs for teaching material
				// Get sub field directly get_field('GROUP FIELD NAME_SUB FIELD NAME');
				$lecture_notes_url	= get_field('lecture_notes_lecture_notes_url', $post->ID);
				$problems_url		= get_field('problems', $post->ID);
				$solutions_url		= get_field('solutions', $post->ID); ?>

				<div class="teaching__content-block">
				
					<ul class="teaching__content-list"><?php
						echo "<li class='teaching-list-item'><a href='" . $lecture_notes_url . "' class='teaching__entry'>" . $lecture_name . "</a></li>" ;
						echo "<li class='teaching-list-item'><a href='" . $problems_url . "' class='teaching__entry'>Problems</a></li>" ;
						echo "<li class='teaching-list-item'><a href='" . $solutions_url . "' class='teaching__entry'>Solutions</a></li>" ; ?>
					</ul>
				</div><?php
				
				 $wp_query->current_post ;

			 endwhile;

			 the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif ; ?>
	</section><!-- .teaching__list -->
</main><!-- #main -->

<?php
get_sidebar();
get_footer();
