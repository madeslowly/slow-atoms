<?php
/**
 * Slow Atoms Publications post and taxonomy
 *
 * @link https://developer.wordpress.org/themes/basics/categories-tags-custom-taxonomies/
 *
 * @package slow_atoms
 * 
 * NOTE: We dont set up  publication taxonomies here, instead use the research taxonomies.
 * 
 */

 $post_labels = array(
  'name'              => _x( 'Publications', 'Post type general name', 'textdomain' ),
  'singular_name'     => _x( 'Publication', 'Post type singular name', 'textdomain' ),
  'search_items'      => __( 'Search Publications', 'textdomain' ),
  'all_items'         => __( 'All Publications', 'textdomain' ),
  'edit_item'         => __( 'Edit Publication', 'textdomain' ),
  'update_item'       => __( 'Update Publication', 'textdomain' ),
  'add_new_item'      => __( 'Add New Publication', 'textdomain' ),
  'new_item_name'     => __( 'New Publication Name', 'textdomain' ),
  'menu_name'         => __( 'Publications', 'textdomain' ),
);

$post_args = array(
  'hierarchical'	=>	true,
  'labels'				=>	$post_labels,
  'menu_icon'			=>	'dashicons-text-page',
  'menu_position' =>  26,
  'public'				=>	true,
  'has_archive'		=>	true,
  'supports'			=>	array('title'),
  'show_in_rest'  =>  true,
  'rewrite'       =>  array( 'slug' =>  'publications'),
);

register_post_type('ms_publications', $post_args );
