<?php
/**
 * Facebook optimisation using og meta https://ogp.me/
 *
 * This template is added to our  <head> section using slow
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package slow_atoms
 */


function slow_atoms_og() {
    
    $site_title = get_bloginfo();
    $site_description = get_bloginfo('description');
    $site_url = get_site_url() ;
    $current_page_title = wp_title('&raquo;',FALSE) ;
    $post_ID = get_the_ID() ;

    // Get current url
    global $wp;
    $current_page_url = home_url( $wp->request ) ;
    
    // Get featured image url
    $post_thumb_url = get_the_post_thumbnail_url() ;
    $post_thumb_type = end( explode('.', $post_thumb_url ) );
    // Get featured image alt text
    $post_thumb_id = get_post_thumbnail_id();
    $post_thumb_alt = get_post_meta($post_thumb_id, '_wp_attachment_image_alt', true);
    
    if ( is_front_page() ) :
        $og_title = $site_title . ' &raquo; ' . $site_description ;
    else : 
        $og_title = $site_title .  $current_page_title ;
        
    endif ;

    if ( is_single() ) :

        $og_type = 'article' ;

        // Retrieve all taxonomy names for the given post.
        $post_taxonomies = get_post_taxonomies();

        $term_obj_list = get_the_terms( $post_ID, $post_taxonomies[0] );
        // All tags for current post 
        $terms_string = join(', ', wp_list_pluck($term_obj_list, 'name'));        

    else :
    
        $og_type = 'website' ;

    endif ;

    ?>

    <!-- *** OG *** https://ogp.me/ -->
    <meta property="og:title" content="<?php echo $og_title ?>" />

    <!-- Adds article properties if post -->

    <meta property="og:type" content="<?php echo $og_type ?>" />

    <meta property="article:publisher" content="<?php echo $site_url ?>" />
    
    <meta property="article:author" content="<?php echo $site_title ; ?>" />
    
    <meta property="article:section" content="<?php echo get_post_type() ; ?>" />
    
    <meta property="article:published_time" content="<?php echo get_the_date() ; ?>" />

    <meta property="article:tag" content="<?php echo $terms_string ; ?>" />

    <meta property="og:image" content="<?php echo $post_thumb_url ; ?>" />

    <meta property="og:image:type" content="image/<?php echo $post_thumb_type ?>" />

    <meta property="og:image:alt" content="<?php echo $post_thumb_alt ; ?>" />

    <meta property="og:url" content="<?php echo $current_page_url ; ?>" />

    <meta property="og:description" content="<?php echo $site_description ; ?>" />

    <meta property="og:locale" content="<?php language_attributes(); ?>" />

    <meta property="og:site_name" content="<?php echo $og_title ?>" />

    <!-- *** END OG *** -->
    <?php }