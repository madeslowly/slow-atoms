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
		<h2 style="word-wrap: normal" class="page-title"><?php echo term_description(); ?></h2>
			<!--<?php the_archive_title( '<h1 class="page-title">', '</h1>' );	?> -->
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
		
		<h2 class="teaching__content-title ">Teaching Material for <code><?php echo get_queried_object()->name; ?></code></h2>
		
		<!-- <div class="teaching__content-row">

			<ul class="teaching__content-list">
			
				<li class='teaching-list-item teaching__content-overview'>

					<nav class='teaching-list-nav'>
						TODO: Remove theme mod
						<?php $teaching_guide_url =  get_theme_mod( 'slow_atoms_theme_pdf_upload_settings'); ?>
						<a href='<?php echo $teaching_guide_url ?>?action=purge' class='teaching-link teaching-link-url'>Course Guide</a>
						<a href='<?php echo $teaching_guide_url ?>?action=purge' class='teaching-link teaching-link-download' download><i class='fa fa-download' aria-hidden='true'></i></a>
					</nav>
				</li>
			</ul>
		</div> -->
	
	
		<?php

		if ( have_posts() ) :
			$count_for_aos = 0 ;
			/* Start the Loop */
			while ( have_posts() ) :
				
				// var_dump($custom_query);
				$count_for_aos ++ ;
				global $count_for_aos ;

				the_post();

				if ( get_field('ms_acf_teach_slides_name_ms_acf_teach_title_name', $post->ID) ) :
					// User has given a unique name so use it.
					$lecture_name =  get_field('ms_acf_teach_slides_name_ms_acf_teach_title_name', $post->ID) ;
					
				else :
					// No unique name so get post title and append with "Notes"
					$lecture_name =  the_title( '' , ' Slides' , false );

				endif ;

				if ( get_field('ms_acf_teach_type_key' ) == false ) :
					?>
					<div class="teaching__content-row">
						<ul class="teaching__content-list">
							<li class='teaching-list-item teaching__content-overview'>
								<nav class='teaching-list-nav'>
									<?php $teaching_guide_url =  get_field('ms_acf_teach_slides_name_ms_acf_teach_slide_URL_name', $post->ID); ?>
									<a href='<?php echo $teaching_guide_url ?>?action=purge' class='teaching-link teaching-link-url'>Course Guide</a>
									<a href='<?php echo $teaching_guide_url ?>?action=purge' class='teaching-link teaching-link-download' download><i class='fa fa-download' aria-hidden='true'></i></a>
								</nav>
							</li>
						</ul>
					</div>
					<?php
				
				else :
					
					if ( get_field('ms_acf_teach_sup_name_ms_acf_teach_sup_title_name', $post->ID) ) :
						// User has given a unique name so use it.
						$sup_name =  get_field('ms_acf_teach_sup_name_ms_acf_teach_sup_title_name', $post->ID) ;
						
					else :
						// No unique name so get post title and append with "Notes"
						$sup_name =  the_title( '' , ' Supplementary Slides' , false ) ;

					endif ;
				
					// TODO: The logic here is a bit messy. We need a better way to show/hide solutions according to the hide status.
					// get URLs for teaching material
					// Get sub field directly get_field('[GROUP_FIELD]_[NAME_SUB]_[FIELD_NAME]');
					$ms_acf_teach_slide_URL_name	= get_field('ms_acf_teach_slides_name_ms_acf_teach_slide_URL_name', $post->ID);
					$ms_acf_teach_sup_URL_name		= get_field('ms_acf_teach_sup_name_ms_acf_teach_sup_URL_name', $post->ID);
					

					if ( get_field('ms_acf_teach_prob_group_name_ms_acf_teach_phide_name') == 1 ) :
						// Hide problems
						$problems_url = [] ;
					else :
						$problems_url		= get_field('ms_acf_teach_prob_group_name_ms_acf_teach_prob_name', $post->ID);
					endif ;

					
					if ( get_field('ms_acf_teach_prob_group_name_ms_acf_teach_shide_name') == 1 ) :
						// Hide solutions
						$solutions_url = [] ;
					else :
						$solutions_url		= get_field('ms_acf_teach_prob_group_name_ms_acf_teach_sol_name', $post->ID);
					endif ;
				
					// Array of urls to loop through
					$urls = array( $ms_acf_teach_slide_URL_name , $ms_acf_teach_sup_URL_name , $problems_url , $solutions_url ) ; 
					
					// Array of file names
					$names = array( $lecture_name , $sup_name , the_title( '' , ' Problems' , false ) , the_title( '' , ' Solutions' , false ) ) ;
									
					?>

					<div class="teaching__content-row">
						<ul class="teaching__content-list"><?php
							for ( $i = 0; $i < count($urls); $i ++) {
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
					</div>
					<?php
				 	$wp_query->current_post ;
				endif ;
			 endwhile;

			 the_posts_navigation();

			 wp_reset_postdata(); // Reset post data after custom query

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif ; ?>
	</section><!-- .teaching__list -->
</main><!-- #main -->

<?php

get_footer();
