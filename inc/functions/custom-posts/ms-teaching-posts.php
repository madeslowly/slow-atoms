<?php
/**
 * slow atoms custom posts and taxonomies
 *
 * @link https://developer.wordpress.org/themes/basics/categories-tags-custom-taxonomies/
 *
 * @package slow_atoms
 */

/**
 * Teaching
 */
add_action( 'init' , 'slow_atoms_teaching_post_type');

function slow_atoms_teaching_post_type() {

 $labels = array(
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

	$args = array(
		'hierarchical'	=>	true,
		'labels'				=>	$labels,
		'menu_icon'			=>	'dashicons-welcome-learn-more',
    'menu_position' =>  28,
		'public'				=>	true,
		'has_archive'		=>	true,
		'supports'			=>	array('title'),
		'show_in_rest'  =>  true,
    'rewrite'       =>  array( 'slug' =>  'teaching' ),
	);
	register_post_type('ms_teaching', $args );
}

add_action( 'init' , 'slow_atoms_teaching_taxonomy');

function slow_atoms_teaching_taxonomy() {

 $labels = array(
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

	$args	=	array(
		'labels'				=>	$labels,
		'public'				=>	true,
		'hierarchical'	=>	true,
		'show_admin_column'	=> true,
    'show_in_rest'  => true,
    'rewrire'       =>  array( 'slug' =>  'teaching-subjects')
	);
	register_taxonomy('ms_taxonomy_teaching', array('ms_teaching'), $args);
  //register_taxonomy_for_object_type('ms_taxonomy_teaching' , 'ms_teaching' ) ;
}

?>
