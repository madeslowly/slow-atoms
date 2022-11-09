<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package slow_atoms
 */

 if ( !is_user_logged_in() ) {
     auth_redirect();
 }

 get_header('' , array( 'append_site-header_class' => 'is__light-background' )); ?>


<main id="primary" class="site-main is__wiki-archive">

 <!--
  <section class="slow-atoms__page-hero">
    <header class="page-header is__theme-background-transparent">  
      <h1 class="page-title">Lab Wiki</h1>
    </header>
    <?php //slow_atoms_get_random_hero('post-thumbnail' ,'attachment-post-thumbnail size-post-thumbnail wp-post-image'); ?>
  </section> --> <!-- .slow-atoms__page-hero -->

  <section class="wiki__content">
    
  <?php get_template_part( 'template-parts/sidebar', get_post_type() ); ?>
    
    <section class="wiki__list"><?php


      if ( have_posts() ) :
      /* Start the Loop */

        while ( have_posts() ) :
          the_post();
            /*
            * Include the Post-Type-specific template for the content.
            * If you want to override this in a child theme, then include a file
            * called content-___.php (where ___ is the Post Type name) and that will be used instead.
            */
          get_template_part( 'template-parts/content', get_post_type() );
          
        endwhile;

        the_posts_navigation();

      else :

        get_template_part( 'template-parts/content', 'none' );

      endif; ?>


  </section>
</section>
</main><!-- #main -->


<?php
get_sidebar();
get_footer();
