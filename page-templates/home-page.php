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

      <?php slow_atoms_get_random_hero('post-thumbnail' , ''); ?>

    </section>

    <div class="slow-atoms__page-content">

      <h2 class="front__page-title" data-aos="fade-in" data-aos-anchor-placement="top-bottom" data-aos-duration="600" data-aos-delay="650">
        <?php	echo get_theme_mod( 'slow_atoms_front_page_title'); ?>
      </h2>

  		<?php the_content(); ?>

  	</div><!-- .slow-atoms__page-content -->

  	<?php if ( get_edit_post_link() ) : ?>

    <footer class="page-footer">
      <?php
        edit_post_link(
          sprintf( wp_kses(
            /* translators: %s: Name of current post. Only visible to screen readers */
            __( 'Edit <span class="screen-reader-text">%s</span>', 'slow-atoms' ),
            array( 'span' => array( 'class' => array(), ), )
          ),
          wp_kses_post( get_the_title() )
        ), '<span class="edit-link">','</span>' );
  		?>
    </footer><!-- .page-footer -->

    <?php endif; ?>

  </article><!-- #post-<?php the_ID(); ?> -->

</main><!-- #main -->

<?php get_footer();
