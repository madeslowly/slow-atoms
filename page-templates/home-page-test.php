<?php
/**
 * 
 * Template Name: Home Page Test
 * 
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package slow_wheels
 * 
 */

get_header();

?>

<main id="primary" class="site-main">
	
	<article id="post-<?php the_ID(); ?>" <?php post_class('is__front-page'); ?> >
	
		<section class="slow-atoms__page-hero">
			<header class="page-header is__theme-background-transparent">
				<h1 class="page-title"><?php bloginfo( 'name' ); ?></h1>
				<h2 class="page-description" data-aos="fade-in" data-aos-duration="600">
					<?php echo get_bloginfo( 'description', 'display' ); ?>
				</h2>
			</header><!-- .page-header .is__theme-background-transparent -->
			<?php slow_atoms_get_random_hero('post-thumbnail' , 'attachment-post-thumbnail size-post-thumbnail wp-post-image'); ?>
		</section>
		
		<div class="sa__collage">
			<?php
			$output_html = '<div class="sa__collage--card sa__collage--card-blurb">';
				$front_page_title =	'';//get_theme_mod( 'slow_atoms_front_page_title');
				if ( $front_page_title ) {
					$output_html .= '<h5 class="sa__collage-header sa__collage--blurb-title">' . $front_page_title . '</h5>' ;
				}
				$output_html .= '<p class="sa__collage--blurb-text" data-aos="fade-up">' . get_theme_mod( 'slow_atoms_front_page_blurb') . '</p>';
			$output_html .= '</div>';
			
			echo $output_html ;
			
			$output_html = '';
			
			$post_id = get_theme_mod( 'slow_atoms_front_page_featured') ;
			$args = array(
				'post_type'	=> 'ms_people',
				'ID'		=>	$post_id,
			);
			$query	=	new WP_Query( $args );
			$query	->	the_post( );
			$tel	=	get_field('ms_acf_people_tel_name', $query->ID) ;
			$email	=	get_field('ms_acf_people_email_name', $query->ID);
			
			$output_html = '<div class="sa__collage--card sa__collage--card-person">' ;
				$output_html .= '<div class="sa__collage-background-img" style="background-image: url(' . get_the_post_thumbnail_url($post_id, 'full') . ') "></div>' ; 
					$output_html .= '<h5 class="sa__collage-header sa__collage--person-title">Group Lead</h5>';
					$output_html .= the_title( sprintf( '<div class="sa__collage--popup sa--hover-left"><a class="sa__link" href="%s" rel="bookmark"><h5 class="sa__collage--person-name">', esc_url( get_permalink() ) ), '</h5></a>' , false ) ; 
					$output_html .= '<a class="sa__link" href="mailto:' . $email . '"><i class="fas fa-envelope"></i> ' . $email . '</a>' ;
					$output_html .= '<a class="sa__link" href="tel:+31' .	$tel . '"><i class="fas fa-phone-square"></i> +31(0)' .	$tel . '</a>';
					$output_html .= '</div>'; 
			$output_html .= '</div>'; 

			wp_reset_postdata();
			unset($post_id);

			echo $output_html ;		
			
			$output_html = '';
			
			$args = array(
				'post_type'			=> 'ms_research',
				'orderby'			=> 'rand',
				'posts_per_page'	=> '1',
			);
			$query = new WP_Query( $args );
			$query -> the_post( ); 

			$output_html = '<div class="sa__collage--card sa__collage--card-research">';
				$output_html .= '<div class="sa__collage-background-img" style="background-image: url(' . get_the_post_thumbnail_url($post_id, 'medium') . ') "></div>';
					$output_html .= '<h5 class="sa__collage-header sa__collage--research-title"	data-aos="fade-up" data-aos-delay="0">Our Research</h5>';
					$output_html .= '<div class="sa__collage--popup sa--hover-up sa__collage--research-desc"><p>' . get_theme_mod( 'slow_atoms_front_page_desc') . '</p>' ;
					$output_html .= '<a class="sa__link" href="' . get_post_type_archive_link('ms_research') . '">Active Projects <i class="fas fa-arrow-right"></i></a>';
				$output_html .= '</div>';
			$output_html .= '</div>';

			wp_reset_postdata();

			echo $output_html ;

			$output_html = '';
			$args = array(
				'post_type'			=> 'ms_publications',
				'orderby'			=> 'date',
				'posts_per_page'	=> '1',);

			$query = new WP_Query( $args ); 
			$query -> the_post( );

			$ms_acf_pub_alist =	get_field('ms_acf_pub_alist', $query -> ID) ;
			$first_author_lname =	$ms_acf_pub_alist[ 'author_1' ]['ms_acf_alist_lname'] ;

			$pub_meta = '<p class="sa__collage--popup sa--hover-up">';
				$pub_meta .= the_title( sprintf('<span class="sa__collage--publication-name"><a class="sa__link sa__collage--publication-link" href="%s" rel="bookmark">' , esc_url( get_permalink() ) ), '</a></span>' , false) ;
			$pub_meta .= '</p>' ;
			
			$pub_thumb = get_field( 'ms_acf_pub_thumb_name', $query -> ID ) ;

			$output_html = '<div class="sa__collage--card sa__collage--card-publication" >' ;
				$output_html .= '<div class="sa__collage-background-img" style="background-image: url(' . wp_get_attachment_image_url( $pub_thumb ) . ') "></div>';
				$output_html .= '<h5 class="sa__collage-header sa__collage--publication-title" data-aos="fade-up" data-aos-delay="350">New Paper</h5>';
				$output_html .= $pub_meta ;
			$output_html .= '</div>' ;

			wp_reset_postdata();

			echo $output_html ;
		
			$output_html = '';
			// TODO: Add other posts types and related markup for a more dynamic front page
			$post_types = array('post') ;
			$args = array(
				'post_type'			=> $post_types,
				'orderby'			=> 'date',
				'posts_per_page'	=> '1',
			);
		
			$query = new WP_Query( $args ); 
			$query -> the_post( );

			if ( get_the_post_thumbnail_url() ) :
				$thumb_url = 'background-image: url(' . get_the_post_thumbnail_url() . ')' ;
			else :
				$thumb_url = 'background: linear-gradient(140deg, var(--theme-color-primary) 0%, var(--theme-color-secondary) 100%);';
			endif ;

			$output_html = '<div class="sa__collage--card sa__collage--card-news" >' ;
				$output_html .= '<div class="sa__collage-background-img" style="' . $thumb_url . '"></div>';
				$output_html .= '<h5 class="sa__collage-header sa__collage--news-title" data-aos="fade-up" data-aos-delay="700">Latest News</h5>';
				$output_html .= '<p class="sa__collage--popup sa--hover-up">';
					$output_html .= the_title( sprintf('<span class="sa__collage--news-name"><a class="sa__link sa__collage--news-link" href="%s" rel="bookmark">' , esc_url( get_permalink() ) ), '</a></span>' , false) ;
				$output_html .= '</p>' ;
			$output_html .= '</div>' ;
		
			wp_reset_postdata();

			echo $output_html ;
			
			?>
		</div>

		<?php slow_atoms_edit_post_link() ; ?>

	</article><!-- #post-<?php the_ID(); ?> -->

</main><!-- #main -->

<?php 

get_footer();