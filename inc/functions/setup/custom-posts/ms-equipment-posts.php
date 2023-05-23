<?php
/**
 * Slow Atoms booking systems
 *
 * @link https://developer.wordpress.org/themes/basics/categories-tags-custom-taxonomies/
 *
 * @package slow_atoms
 * 
 */

$post_labels = array(
  'name'                => _x( 'Equipment', 'Post type general name', 'textdomain' ),
  'singular_name'       => _x( 'Equipment', 'Post type singular name', 'textdomain' ),
  'search_items'        => __( 'Search Equipment', 'textdomain' ),
  'all_items'           => __( 'All Equipment Entries', 'textdomain' ),
  'edit_item'           => __( 'Edit Equipment', 'textdomain' ),
  'update_item'         => __( 'Update Equipment', 'textdomain' ),
  'add_new_item'        => __( 'Add New Equipment Entry', 'textdomain' ),
  'new_item_name'       => __( 'New Equipment Name', 'textdomain' ),
  'menu_name'           => __( 'Lab Equipment', 'textdomain' ),
);

$post_args = array(
  'hierarchical'        =>	true,
  'labels'				      =>	$post_labels,
  'menu_icon'			      =>	'dashicons-video-alt',
  'menu_position'       =>  30,
  'public'				      =>	true,
  'has_archive'		      =>	true,
  'supports'			      =>	array('title' , 'revisions', 'author'),
  'show_in_rest'        =>  true,
  'rewrite'             =>  array( 'slug' =>  'equipment'),
);

register_post_type('ms_equipment', $post_args );