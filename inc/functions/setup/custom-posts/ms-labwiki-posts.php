<?php
/**
 * Slow Atoms Lab Wiki post and taxonomy
 *
 * @link https://developer.wordpress.org/themes/basics/categories-tags-custom-taxonomies/
 *
 * @package slow_atoms
 * 
 */

$post_labels = array(
  'name'              => _x( 'Wiki', 'Post type general name', 'textdomain' ),
  'singular_name'     => _x( 'Wiki', 'Post type singular name', 'textdomain' ),
  'search_items'      => __( 'Search Wiki', 'textdomain' ),
  'all_items'         => __( 'All Wiki Entries', 'textdomain' ),
  'edit_item'         => __( 'Edit Wiki', 'textdomain' ),
  'update_item'       => __( 'Update Wiki', 'textdomain' ),
  'add_new_item'      => __( 'Add New Wiki Entry', 'textdomain' ),
  'new_item_name'     => __( 'New Wiki Name', 'textdomain' ),
  'menu_name'         => __( 'Lab Wiki', 'textdomain' ),
);

$post_args = array(
  'hierarchical'	=>	true,
  'labels'				=>	$post_labels,
  'menu_icon'			=>	'dashicons-info',
  'menu_position' =>  30,
  'public'				=>	true,
  'has_archive'		=>	true,
  'supports'			=>	array('title' , 'editor', 'revisions', 'author', 'thumbnail'),
  'show_in_rest'  =>  true,
  'rewrite'       =>  array( 'slug' =>  'labwiki'),
);

register_post_type('ms_labwiki', $post_args );

$tax_labels = array(
  'name'              => _x( 'Wiki Subjects', 'Taxonomy general name', 'textdomain' ),
  'singular_name'     => _x( 'Wiki Subject', 'Taxonomy singular name', 'textdomain' ),
  'search_items'      => __( 'Search Subjects', 'textdomain' ),
  'all_items'         => __( 'All Wiki Subjects', 'textdomain' ),
  'parent_item'       => __( 'Parent Subject', 'textdomain' ),
  'parent_item_colon' => __( 'Parent Subject', 'textdomain' ),
  'edit_item'         => __( 'Edit Subject', 'textdomain' ),
  'update_item'       => __( 'Update Subject', 'textdomain' ),
  'add_new_item'      => __( 'Add New Wiki Subject', 'textdomain' ),
  'new_item_name'     => __( 'New Wiki Subject', 'textdomain' ),
  'menu_name'         => __( 'Subject', 'textdomain' ),
);

$tax_args	=	array(
  'labels'				=>	$tax_labels,
  'public'				=>	true,
  'hierarchical'	=>	true,
  'show_admin_column'	=> true,
  'show_in_rest'  => true,
  'rewrite'       =>  array( 'slug' =>  'labwiki-subject'),
);

register_taxonomy('ms_taxonomy_labwiki', array('ms_labwiki'), $tax_args);