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

  <section class="slow-atoms__page-hero">

    <!--
    <header class="page-header is__theme-background-transparent">
      <?php
      the_title( '<h1 class="page-title">', '</h1>' );
      ?>
    </header>

    --><!-- .page-header -->
    <!--
    <div class="post-thumbnail">
      <?php if ( has_post_thumbnail() ) :

      			the_post_thumbnail('full', array());

      		else :

      			// Grab random image from front page
      			$rand_img = 'image_' . rand( 1 , 5 ) ;
      			$pageID = get_option('page_on_front'); ?>
      			<!-- Needs improving so we get the same markup as the_post_thumbnail(); -->
      			<img class="attachment-post-thumbnail size-post-thumbnail wp-post-image" src="<?php the_field($rand_img, $pageID); ?> "/>

      		<?php	endif; ?>
    </div>
      --><!-- .post-thumbnail -->

  </section><!-- .slow-atoms__page-hero -->

  <section class="slow-atoms__page-content">

    <div class="page-content__contact-form">
      <h3 class="contact-form__header">Contact Us</h3>
  		<?php $cf7_shortcode = get_theme_mod( 'slow_atoms_contact_form_shortcode') ;
      echo do_shortcode($cf7_shortcode) ; ?>

    </div>

    <div class="page-content__contact-details">

      <h3 class="contact-form__header">Not a Form Fan?</h3>

      <ul class="contact-details__options">

        <li class="contact-details__options-science">
          <i class="fas fa-microscope"></i>
          <span>
            <p class="contact-details__options-header">
              Scientific enquiries
            </p>
            <a href="mailto:roel.dullens@ru.nl">Roel Dullens</a>
          </span>
        </li>

        <li class="contact-details__options-administrive">
          <i class="fas fa-info"></i>
          <span>
            <p class="contact-details__options-header">
              General enquiries
            </p>
            <a href="mailto:m.speijers@ru.nl">Magda Speijers</a>
          </span>
        </li>

        <li class="contact-details__options-website">
          <i class="fas fa-globe"></i>
          <span>
            <p class="contact-details__options-header">
              Website issues
            </p>
            <a href="mailto:arran.curran@ru.nl">Arran Curran</a>
          </span>
        </li>

      </ul><!-- .contact-details__options -->

      <ul class="contact-details__address">

        <li class="contact-details__address-department">
          <p class="contact-details__address-entry">
            <?php echo get_bloginfo( 'description', 'display' ); ?>
          </p>
        </li>

        <li class="contact-details__address-building">
          <p class="contact-details__address-entry">
            <?php echo get_theme_mod( 'slow_atoms_contact_building_name') ; ?>
          </p>
        </li>
        <li class="contact-details__address-street">
          <p class="contact-details__address-entry">
            <?php echo get_theme_mod( 'slow_atoms_contact_street_name') . ' ' . get_theme_mod( 'slow_atoms_contact_street_number') ; ?>
          </p>
        </li>
        <li class="contact-details__address-postcode">
          <p class="contact-details__address-entry">
            <?php echo get_theme_mod( 'slow_atoms_contact_postcode') . ' ' . get_theme_mod( 'slow_atoms_contact_city') ; ?>
          </p>
        </li>
        <li class="contact-details__address-country">
          <p class="contact-details__address-entry">
            <?php echo get_theme_mod( 'slow_atoms_contact_country'); ?>
          </p>
        </li>

      </ul>
    </div>

  </section><!-- .slow-atoms__page-content -->

</main><!-- .is__contact-page -->

<?php
get_sidebar();
get_footer();
