<?php
/**
 * Template Name: Contact Page
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package slow_wheels
 */

 get_header('' , array( 'append_site-header_class' => 'is__light-background' ));
?>


<main id="primary" class="site-main is__contact-page">
  
  <section class="slow-atoms__page-content">

    <?php
    $contact_form_shorcode =  get_field('ms_acf_contact_shortcode_name' ) ; 
    if ( $contact_form_shorcode ) : ?>
      <div class="page-content__contact-form is__theme-background">
        <?php the_title( '<h3 class="">', '</h3>' ) ; echo do_shortcode($contact_form_shorcode) ; ?>
      </div>
    <?php endif ; ?>

    <div class="page-content__contact-details">
    <?php if ( ! $contact_form_shorcode ) : 
        the_title( '<h3 class="contact-form__header">', '</h3>' ) ; 
      else : ?>
      <h3 class="contact-form__header">Not a Form Fan?</h3>
      <?php endif ; ?>

      <ul class="contact-details__options">

        <?php
          $icons            = array( 'microscope', 'info', 'globe' );
          $class            = array( 'science', 'general', 'website' );
          $headers          = array( 'Scientific enquiries', 'General enquiries', ' Website issues') ;
          $output_list      = '' ;
          $cnt              = 0 ;
          $direct_contacts  = array() ;
          while( have_rows('ms_acf_contact_directs_group_name') ): the_row() ;
            $direct_contacts += [ get_sub_field('ms_acf_contact_directs_sciname_name') => get_sub_field('ms_acf_contact_directs_sciemail_name')  ] ;
            $direct_contacts += [ get_sub_field('ms_acf_contact_directs_genname_name') => get_sub_field('ms_acf_contact_directs_genemail_name')  ] ;
            $direct_contacts += [ get_sub_field('ms_acf_contact_directs_webname_name') => get_sub_field('ms_acf_contact_directs_webemail_name')  ] ;          
          endwhile ;
          // TODO: this doesnt work on theme install as the foreach only loops the default values, if updated
          foreach( $direct_contacts as $name => $email ) {
            if ( $email ) :
              $output_list .= '
              <li class="contact-details__options-' . $class[ $cnt ] . '">
                <i class="fas fa-' . $icons[ $cnt ] . '"></i>
                <span>
                  <p class="contact-details__options-header">' . $headers[ $cnt ] . '</p>
                  <a href="mailto:' . $email . '">' . $name . '</a>
                </span>
              </li>' ;
            endif ;
            $cnt++ ;
          }
          echo $output_list ; 

          if ( get_sub_field('ms_acf_contact_directs_sciemail_name') ) :
          echo 'hello' ;
          endif ;
        ?>

      </ul><!-- .contact-details__options -->

      <ul class="contact-details__address-list">

        <?php        
          $postal_address = array() ;
          while( have_rows('ms_acf_contact_add_group_name') ): the_row() ;
            $check = get_sub_field('ms_acf_contact_department_name') ;
            if ( $check ) :
              $postal_address += ['department'  => get_sub_field('ms_acf_contact_department_name')] ;
            else :
              $postal_address += ['department'  => get_bloginfo( 'description', 'display' ) ];
            endif ; 
            $postal_address += ['building'  => get_sub_field('ms_acf_contact_building_name')  ] ;
            $postal_address += ['street'    => get_sub_field('ms_acf_contact_street_name') . ' ' . get_sub_field('ms_acf_contact_street_number_name') ] ;
            $postal_address += ['city'      => get_sub_field('ms_acf_contact_postcode_name') . ' ' . get_sub_field('ms_acf_contact_city_name') ] ;
            $postal_address += ['country'   => get_sub_field('ms_acf_contact_country_name')   ] ;
          endwhile ;
          $output_list = '' ;
          foreach( $postal_address as $key => $value ) {
            if ( $value ) :
              $output_list .= '<li class="contact-details__address-' . $key . '"><p class="contact-details__address-entry">' . $value . '</p></li>' ;
            endif ;
          }
          echo $output_list ; 
        ?>

      </ul>
    </div>

  </section><!-- .slow-atoms__page-content -->

</main><!-- .is__contact-page -->

<?php
get_sidebar();
get_footer();
