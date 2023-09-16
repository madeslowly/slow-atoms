<?php
/**
 * The template for displaying the home page and generic pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package slow_atoms
 */

get_header() ;

if ( is_front_page() ) { $page = 'home' ; } else { $page = 'page' ; }

echo '<main id="primary" class="site-main page">' ;

get_template_part( 'template-parts/content', $page ) ;

echo '</main><!-- #main -->' ;

get_footer();
