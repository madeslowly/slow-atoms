<?php
/**
 * The template for displaying the sidebar on lab wiki pages
 *
 * @package slow_atoms
 */

echo '<section class="wiki__sidebar">' ;

$cat_terms = get_terms(
  // Wiki taxonomy
  array(
    'ms_taxonomy_labwiki'),
  array(
    'hide_empty'    => false,
    'orderby'       => 'name',
    'order'         => 'ASC',
    'number'        => 6 )
) ;

if( $cat_terms ) :

  foreach( $cat_terms as $term ) :

    $term_url = get_term_link( $term );

    // Wiki subject header and link
    echo '<h5 class="wiki__sidebar-header"><a href="' . $term_url . '" class="wiki__sidebar-link">' . $term -> name . '</a></h5>';

    $args = array(
    
      // Wiki post type 
      'post_type'             => 'ms_labwiki',
      'posts_per_page'        => 10,
      'post_status'           => 'publish',
      'orderby'               => 'title' ,
      'order'                 => 'DESC' ,
      'tax_query'             =>  array(
                                    array(
                                      'taxonomy'            => 'ms_taxonomy_labwiki',
                                      'field'               => 'slug',
                                      'terms'               => $term -> slug, 
                                    ), 
                                  ),
      'ignore_sticky_posts' => true //caller_get_posts is deprecated since 3.1
    );

    $_posts = new WP_Query( $args );
    //var_dump($_posts);
    if( $_posts -> have_posts( ) ) :

      echo '<nav class="wiki-subject-list">';
      
      while( $_posts -> have_posts( ) ) : 
        $_posts -> the_post( );
        echo '<h5>'. get_the_title() .'</h5>';

      endwhile;
    
      echo '</nav>' ;
    
    endif;

    wp_reset_postdata(); // Restore original Post Data

  endforeach;

endif;
?>
</section>
