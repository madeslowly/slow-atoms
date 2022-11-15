<?php
/**
* Template Name: Home Page
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package slow_wheels
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

    <div class="slow-atoms__page-content">

      <h2 class="front__page-title" data-aos="fade-in" data-aos-anchor-placement="top-bottom" data-aos-duration="600" data-aos-delay="650">
        <?php	echo get_theme_mod( 'slow_atoms_front_page_title'); ?>
      </h2>

  		<?php the_content(); ?>

  	</div><!-- .slow-atoms__page-content -->

     <?php slow_atoms_edit_post_link() ; ?>

  </article><!-- #post-<?php the_ID(); ?> -->

</main><!-- #main -->

<?php get_footer();
