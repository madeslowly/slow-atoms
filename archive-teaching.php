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

		<header class="page-header is__theme-background-transparent"> 
		<h2 style="word-wrap: normal" class="page-title">This website obeys the laws of thermodynamics</h2>
			<!--<?php the_archive_title( '<h1 class="page-title">', '</h1>' );	?> -->
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

	<section class="teaching__content"> 
		
		<div class="teaching__content-row">

			<ul class="teaching__content-list">
			
				<li class='teaching-list-item teaching__content-overview'>

					<nav class='teaching-list-nav'>
						<?php $teaching_guide_url =  get_theme_mod( 'slow_atoms_theme_pdf_upload_settings'); ?>
						<a href='<?php echo $teaching_guide_url ?>?action=purge' class='teaching-link teaching-link-url'>Course Guide</a>
						<a href='<?php echo $teaching_guide_url ?>?action=purge' class='teaching-link teaching-link-download' download><i class='fa fa-download' aria-hidden='true'></i></a>
					</nav>
				</li>
			</ul>
		</div>
	
	
		<?php
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
					// No unique name so get post title and append with "Notes"
					$lecture_name =  the_title( '' , ' Notes' , false );

				endif ;
				
				// get URLs for teaching material
				// Get sub field directly get_field('GROUP FIELD NAME_SUB FIELD NAME');
				$lecture_notes_url	= get_field('lecture_notes_lecture_notes_url', $post->ID);
				$problems_url		= get_field('problems_and_solutions_problems', $post->ID);
				$solutions_url		= get_field('problems_and_solutions_solutions', $post->ID); 
				
				// Array of urls to loop through
				$urls = array($lecture_notes_url , $problems_url , $solutions_url); 
				
				// Array of file names
				$names = array( $lecture_name , the_title( '' , ' Problems' , false ) , the_title( '' , ' Solutions' , false ) )?>

				<div class="teaching__content-row">
				
					<ul class="teaching__content-list"><?php
						
						for ( $i = 0; $i <= count($urls); $i ++) {

							if( $urls[ $i ] ) :
						
							echo "
							<li class='teaching-list-item'>

								<nav class='teaching-list-nav'>
									<a href='" . $urls[ $i ] . "?action=purge' class='teaching-link teaching-link-url'>" . $names[ $i ] . "</a> 
									<a href='" . $urls[ $i ] . "?action=purge' class='teaching-link teaching-link-download' download><i class='fa fa-download' aria-hidden='true'></i></a>
								</nav>
							</li>
							" ;

							endif ;
						} ?>
						
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
