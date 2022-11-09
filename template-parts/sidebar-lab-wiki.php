<section class="wiki__sidebar">
      <?php
        $cat_terms = get_terms(
          array('wiki-subjects'),
          array(
            'hide_empty'    => false,
            'orderby'       => 'name',
            'order'         => 'ASC',
            'number'        => 6 //specify yours
          )
        );
        
        if( $cat_terms ) :
          foreach( $cat_terms as $term ) :
            $term_url = get_term_link( $term );
            //var_dump( $term );
            echo '<h5 class="wiki__sidebar-header"><a href="' .  $term_url . '" class="wiki__sidebar-link">'. $term -> name .'</a></h5>';
            
            $args = array(
              'post_type'             => 'lab-wiki',
              'posts_per_page'        => 10, //specify yours
              'post_status'           => 'publish',
              'tax_query'             => array(
                                          array(
                                            'taxonomy' => 'wiki-subjects',
                                            'field'    => 'slug',
                                            'terms'    => $term -> slug, ), ),
                                        'ignore_sticky_posts'   => true //caller_get_posts is deprecated since 3.1
            );
            
            $_posts = new WP_Query( $args );
            
            if( $_posts -> have_posts( ) ) :

              echo '<nav class="wiki-subject-list">';
              while( $_posts -> have_posts( ) ) : 
                $_posts -> the_post( );
                echo '<h5>'. get_the_title() .'</h5>';
              endwhile;
              echo '</nav>' ;
            endif;
            
            wp_reset_postdata(); //important
          
          endforeach;
        endif;
      ?>
    </section>
