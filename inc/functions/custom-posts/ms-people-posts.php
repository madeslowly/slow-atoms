<?php
/**
 * slow atoms custom posts and taxonomies
 *
 * @link https://developer.wordpress.org/themes/basics/categories-tags-custom-taxonomies/
 *
 * @package slow_atoms
 */

/**
 * People
 */

add_action( 'init' , 'slow_atoms_people_post_type');

function slow_atoms_people_post_type() {

  $labels = array(
        'name'              => _x( 'People', 'Post type general name', 'textdomain' ),
        'singular_name'     => _x( 'Person', 'Post type singular name', 'textdomain' ),
        'search_items'      => __( 'Search People', 'textdomain' ),
        'all_items'         => __( 'All People', 'textdomain' ),
        'edit_item'         => __( 'Edit Person', 'textdomain' ),
        'update_item'       => __( 'Update Person', 'textdomain' ),
        'add_new_item'      => __( 'Add New Person', 'textdomain' ),
        'new_item_name'     => __( 'New Person Name', 'textdomain' ),
        'menu_name'         => __( 'People', 'textdomain' ),
    );

	$args = array(
		'hierarchical'	=>	true,
		'labels'				=>	$labels,
		'menu_icon'			=>	'dashicons-groups',
    'menu_position' =>  29,
		'public'				=>	true,
		'has_archive'		=>	true,
		'supports'			=>	array('title' , 'thumbnail'),
		'show_in_rest'  => true,
    'rewrite'       => array('slug' => 'people'),
	);
	register_post_type('ms_people', $args );
}


add_action( 'init' , 'slow_atoms_people_taxonomy');

function slow_atoms_people_taxonomy() {

  $labels = array(
        'name'              => _x( 'Team Roles', 'Taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Team Role', 'Taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Roles', 'textdomain' ),
        'all_items'         => __( 'All Roles', 'textdomain' ),
        'parent_item'       => __( 'Parent Team Role', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Team Role', 'textdomain' ),
        'edit_item'         => __( 'Edit Role', 'textdomain' ),
        'update_item'       => __( 'Update Role', 'textdomain' ),
        'add_new_item'      => __( 'Add New Team Role', 'textdomain' ),
        'new_item_name'     => __( 'New Team Role', 'textdomain' ),
        'menu_name'         => __( 'Roles', 'textdomain' ),
    );

	$args	=	array(
		'labels'				=>	$labels,
		'public'				=>	true,
		'hierarchical'	=>	true,
		'show_admin_column'	=> true,
    'show_in_rest'  =>  true,
    'rewrite'       =>  array( 'slug' =>  'team-roles'),
	);
	register_taxonomy('ms_taxonomy_people', array('ms_people'), $args);
}

?>
