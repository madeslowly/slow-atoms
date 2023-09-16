<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package slow_atoms
 */

/**
 * 
 * redirect to template part for custom archives
 * 
 */

get_template_part( 'ms-custom-archives/archive', get_post_type() ) ;
