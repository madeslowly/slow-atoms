<?php
/**
 * 
 * Template for front page
 * 
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package slow_wheels
 * 
 */

 ?>

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

    $person_id = get_theme_mod( 'slow_atoms_front_page_featured') ;

    $tel	= get_field('ms_acf_people_tel_name', $person_id) ;
    $email	= get_field('ms_acf_people_email_name', $person_id);
    $name	= get_the_title( $person_id ) ;
    $url	= get_permalink( $person_id ) ;

    $pub_meta = '<p class="sa__collage--popup sa--hover-up">';
    $pub_meta .= the_title( sprintf('<span class="sa__collage--publication-name"><a class="sa__link link_on_dark sa__collage--publication-link" href="%s" rel="bookmark">' , esc_url( get_permalink() ) ), '</a></span>' , false) ;
    $pub_meta .= '</p>' ;
    ?>
    
    <div class="sa__collage">
        <?php

        $person_html = '<div class="sa__collage--card sa__collage--card-person">' ;
            $person_html .= '<div class="sa__collage-background-img" style="background-image: url(' . get_the_post_thumbnail_url( $person_id, 'full') . ') "></div>' ; 
                $person_html .= '<h5 class="sa__collage-header sa__collage--person-title">Group Lead</h5>';
                $person_html .= '<div class="sa__collage--popup sa--hover-left"><a class="sa__link link_on_dark" href="'. $url . '" rel="bookmark"><h5 class="sa__collage--person-name">' . $name . '</h5></a>' ; 
                $person_html .= '<a class="sa__link link_on_dark" href="mailto:' . $email . '"><i class="fas fa-envelope"></i> ' . $email . '</a>' ;
                $person_html .= '<a class="sa__link link_on_dark" href="tel:+31' .	$tel . '"><i class="fas fa-phone-square"></i> +31(0)' .	$tel . '</a>';
            $person_html .= '</div>'; 
        $person_html .= '</div>'; 

        echo $person_html ;		

        $blurb_html = '<div class="sa__collage--card sa__collage--card-blurb">';
            $front_page_title =	'';//get_theme_mod( 'slow_atoms_front_page_title');
            if ( $front_page_title ) {
                $blurb_html .= '<h5 class="sa__collage-header sa__collage--blurb-title">' . $front_page_title . '</h5>' ;
            }
            $blurb = ( get_theme_mod( 'slow_atoms_front_page_blurb') ) ;

            $blurb_html .= '<p class="sa__collage--blurb-text" data-aos="fade-up">' . $blurb . '</p>';
        $blurb_html .= '</div>';
        
        echo $blurb_html ;
 
        $args = array(
            'post_type'			=> 'ms_research',
            'orderby'			=> 'rand',
            'posts_per_page'	=> '1',
        );
        $query = new WP_Query( $args );
        $query -> the_post( ); 

        $research_html = '<div class="sa__collage--card sa__collage--card-research">';
            $research_html .= '<div class="sa__collage-background-img" style="background-image: url(' . get_the_post_thumbnail_url($query -> ID, 'medium') . ') "></div>';
                $research_html .= '<h5 class="sa__collage-header sa__collage--research-title"	data-aos="fade-up" data-aos-delay="0">Our Research</h5>';
                $research_html .= '<div class="sa__collage--popup sa--hover-up sa__collage--research-desc"><p>' . get_theme_mod( 'slow_atoms_front_page_desc') . '</p>' ;
                $research_html .= '<a class="sa__link link_on_dark" href="' . get_post_type_archive_link('ms_research') . '">Active Projects <i class="fas fa-arrow-right"></i></a>';
            $research_html .= '</div>';
        $research_html .= '</div>';

        wp_reset_postdata();

        echo $research_html ;

        $args = array(
            'post_type'			=> 'ms_publications',
            'orderby'			=> 'date',
            'posts_per_page'	=> '1',);

        $query = new WP_Query( $args ); 
        $query -> the_post( );

        $ms_acf_pub_alist   =	get_field('ms_acf_pub_alist', $query -> ID) ;
        $first_author_lname =	$ms_acf_pub_alist[ 'author_1' ]['ms_acf_alist_lname'] ;

        $pub_meta = '<p class="sa__collage--popup sa--hover-up">';
            $pub_meta .= the_title( sprintf('<span class="sa__collage--publication-name"><a class="sa__link link_on_dark sa__collage--publication-link" href="%s" rel="bookmark">' , esc_url( get_permalink() ) ), '</a></span>' , false) ;
        $pub_meta .= '</p>' ;
        
        $pub_thumb = get_field( 'ms_acf_pub_thumb_name', $query -> ID ) ;

        $publication_html = '<div class="sa__collage--card sa__collage--card-publication" >' ;
            $publication_html .= '<div class="sa__collage-background-img" style="background-image: url(' . wp_get_attachment_image_url( $pub_thumb ) . ') "></div>';
            $publication_html .= '<h5 class="sa__collage-header sa__collage--publication-title" data-aos="fade-up" data-aos-delay="200">New Paper</h5>';
            $publication_html .= $pub_meta ;
        $publication_html .= '</div>' ;

        wp_reset_postdata();

        echo $publication_html ;
    
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
            $output_html .= '<h5 class="sa__collage-header sa__collage--news-title" data-aos="fade-up" data-aos-delay="400">Latest News</h5>';
            $output_html .= '<p class="sa__collage--popup sa--hover-up">';
            $output_html .= the_title( sprintf('<span class="sa__collage--news-name"><a class="sa__link link_on_dark sa__collage--news-link" href="%s" rel="bookmark">' , esc_url( get_permalink() ) ), '</a></span>' , false) ;
            $output_html .= '</p>' ;
        $output_html .= '</div>' ;
    
        wp_reset_postdata();

        echo $output_html ;
        
        ?>
    </div>

    <?php slow_atoms_edit_post_link() ; ?>

</article><!-- #post-<?php the_ID(); ?> -->
<?php