<?php
/**
 * Slow Atoms Particle Library post and taxonomy
 *
 * @link https://developer.wordpress.org/themes/basics/categories-tags-custom-taxonomies/
 *
 * @package slow_atoms
 * 
 */

$post_labels = array(
  'name'              => _x( 'Particle Library', 'Post type general name', 'textdomain' ),
  'singular_name'     => _x( 'Particle Library', 'Post type singular name', 'textdomain' ),
  'search_items'      => __( 'Search Particle Library', 'textdomain' ),
  'all_items'         => __( 'All Particles', 'textdomain' ),
  'parent_item'       => __( 'Parent Particle', 'textdomain' ),
  'parent_item_colon' => __( 'Parent Particle', 'textdomain' ),
  'edit_item'         => __( 'Edit Particle Details', 'textdomain' ),
  'update_item'       => __( 'Update Particle Details', 'textdomain' ),
  'add_new_item'      => __( 'Add New Particle', 'textdomain' ),
  'new_item_name'     => __( 'New Particle Name', 'textdomain' ),
  'menu_name'         => __( 'Particle Library', 'textdomain' ),
);

$post_args = array(
  'hierarchical'	=>	true,
  'labels'				=>	$post_labels,
  'menu_icon'			=>	'dashicons-lightbulb',
  'menu_position' =>  27,
  'public'				=>	true,
  'has_archive'		=>	true,
  'supports'			=>	array('title' , 'revisions', 'trackbacks' , 'page-attributes', 'thumbnail', 'custom-fields', 'post-formats'),
  'show_in_rest'  =>  true,
  'rewrite'       =>  array( 'slug' =>  'particle-lib'),
);

register_post_type('ms_particles', $post_args );

// $tax_labels = array(
//   'name'              => _x( 'Research Areas', 'Taxonomy general name', 'textdomain' ),
//   'singular_name'     => _x( 'Research Area', 'Taxonomy singular name', 'textdomain' ),
//   'search_items'      => __( 'Search Research Areas', 'textdomain' ),
//   'all_items'         => __( 'All Research Areas', 'textdomain' ),
//   'parent_item'       => __( 'Parent Research Area', 'textdomain' ),
//   'parent_item_colon' => __( 'Parent Research Area:', 'textdomain' ),
//   'edit_item'         => __( 'Edit Research Area', 'textdomain' ),
//   'update_item'       => __( 'Update Research Area', 'textdomain' ),
//   'add_new_item'      => __( 'Add New Research Area', 'textdomain' ),
//   'new_item_name'     => __( 'New Research Area', 'textdomain' ),
//   'menu_name'         => __( 'Categories', 'textdomain' ),
// );

// $tax_args	=	array(
//   'labels'				=>	$tax_labels,
//   'public'				=>	true,
//   'hierarchical'	=>	true,
//   'show_admin_column'	=> true,
//   'show_in_rest'  => true,
//   'rewrite'       =>  array( 'slug' => 'research-areas')
// );

// NOTE: we register this taxonomy with the Research and Publictaion posts
// register_taxonomy('ms_taxonomy_research', array('ms_research', 'ms_publications'), $tax_args);

