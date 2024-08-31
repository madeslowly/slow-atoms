<?php
/**
 * Slow Atoms Teaching post and taxonomy
 *
 * @link https://developer.wordpress.org/themes/basics/categories-tags-custom-taxonomies/
 *
 * @package slow_atoms
 * 
 */

// Register Custom Taxonomy BEFORE Custom Post Type so we can have urls like /teaching/subject-name

$tax_labels = array(
  'name'              => _x( 'Subjects', 'Taxonomy general name', 'textdomain' ),
  'singular_name'     => _x( 'Subject', 'Taxonomy singular name', 'textdomain' ),
  'search_items'      => __( 'Search Subjects', 'textdomain' ),
  'all_items'         => __( 'All Teaching Subjects', 'textdomain' ),
  'parent_item'       => __( 'Parent Subject', 'textdomain' ),
  'parent_item_colon' => __( 'Parent Subject', 'textdomain' ),
  'edit_item'         => __( 'Edit Subject', 'textdomain' ),
  'update_item'       => __( 'Update Subject', 'textdomain' ),
  'add_new_item'      => __( 'Add New Teaching Subject', 'textdomain' ),
  'new_item_name'     => __( 'New Teaching Subject', 'textdomain' ),
  'menu_name'         => __( 'Subject', 'textdomain' ),
);

$tax_args	=	array(
  'labels'				=>	$tax_labels,
  'public'				=>	true,
  'hierarchical'	=>	true,
  'show_admin_column'	=> true,
  'show_in_rest'  =>  true,
  'rewrite'       =>  array( 'slug' =>  'teaching' ),
);

register_taxonomy('ms_taxonomy_teaching', array('ms_teaching'), $tax_args);

$post_labels = array(
  'name'              => _x( 'Teaching', 'Post type general name', 'textdomain' ),
  'singular_name'     => _x( 'Teaching', 'Post type singular name', 'textdomain' ),
  'search_items'      => __( 'Search Teaching', 'textdomain' ),
  'all_items'         => __( 'All Teaching Material', 'textdomain' ),
  'edit_item'         => __( 'Edit Teaching', 'textdomain' ),
  'update_item'       => __( 'Update Teaching', 'textdomain' ),
  'add_new_item'      => __( 'Add New Teaching Entry', 'textdomain' ),
  'new_item_name'     => __( 'New Teaching Name', 'textdomain' ),
  'menu_name'         => __( 'Teaching', 'textdomain' ),
);

$post_args = array(
  'hierarchical'	=>	true,
  'labels'				=>	$post_labels,
  'menu_icon'			=>	'dashicons-welcome-learn-more',
  'menu_position' =>  28,
  'public'				=>	true,
  'has_archive'		=>	true,
  'supports'			=>	array('title'),
  'show_in_rest'  =>  true,
  'rewrite'       =>  array( 'slug' =>  'teaching' ),
  'taxonomies'		=>	array('ms_taxonomy_teaching'),
);

register_post_type('ms_teaching', $post_args );