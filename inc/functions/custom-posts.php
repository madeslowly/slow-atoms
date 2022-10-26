<?php


/**
 * slow atoms custom posts and taxonomies
 *
 * @link https://developer.wordpress.org/themes/basics/categories-tags-custom-taxonomies/
 *
 * @package slow_atoms
 */

/**
 * 
 * Register our custom posts and taxonomies that will apear in the wp-admin dashboard
 * 
 */


/**
 * Research
 */
add_action( 'init' , 'slow_atoms_research_post_type');

function slow_atoms_research_post_type() {

  $labels = array(
        'name'              => _x( 'Research Projects', 'Post type general name', 'textdomain' ),
        'singular_name'     => _x( 'Research Project', 'Post type singular name', 'textdomain' ),
        'search_items'      => __( 'Search Projects', 'textdomain' ),
        'all_items'         => __( 'All Projects', 'textdomain' ),
        'parent_item'       => __( 'Parent Project', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Project', 'textdomain' ),
        'edit_item'         => __( 'Edit Project', 'textdomain' ),
        'update_item'       => __( 'Update Project', 'textdomain' ),
        'add_new_item'      => __( 'Add New Project', 'textdomain' ),
        'new_item_name'     => __( 'New Project Name', 'textdomain' ),
        'menu_name'         => __( 'Research', 'textdomain' ),
    );

	$args = array(
		'hierarchical'	=>	true,
		'labels'				=>	$labels,
		'menu_icon'			=>	'dashicons-lightbulb',
    'menu_position' =>  4,
		'public'				=>	true,
		'has_archive'		=>	true,
		'supports'			=>	array('title' , 'editor', 'revisions', 'trackbacks', 'author', 'excerpt', 'page-attributes', 'thumbnail', 'custom-fields', 'post-formats'),
		'show_in_rest' => true,
	);
	register_post_type('research', $args );
}

add_action( 'init' , 'slow_atoms_research_taxonomy');

function slow_atoms_research_taxonomy() {

  $labels = array(
        'name'              => _x( 'Research Areas', 'Taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Research Area', 'Taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Research Areas', 'textdomain' ),
        'all_items'         => __( 'All Research Areas', 'textdomain' ),
        'parent_item'       => __( 'Parent Research Area', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Research Area:', 'textdomain' ),
        'edit_item'         => __( 'Edit Research Area', 'textdomain' ),
        'update_item'       => __( 'Update Research Area', 'textdomain' ),
        'add_new_item'      => __( 'Add New Research Area', 'textdomain' ),
        'new_item_name'     => __( 'New Research Area', 'textdomain' ),
        'menu_name'         => __( 'Categories', 'textdomain' ),
    );

	$args	=	array(
		'labels'				=>	$labels,
		'public'				=>	true,
		'hierarchical'	=>	true,
		'show_admin_column'	=> true,
    'show_in_rest'  => true,
	);
	register_taxonomy('research-areas', array('research', 'publications'), $args);
}

/**
 * Publications
 */
add_action( 'init' , 'slow_atoms_publications_post_type');

function slow_atoms_publications_post_type() {

 $labels = array(
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

	$args = array(
		'hierarchical'	=>	true,
		'labels'				=>	$labels,
		'menu_icon'			=>	'dashicons-text-page',
    'menu_position' =>  5,
		'public'				=>	true,
		'has_archive'		=>	true,
		'supports'			=>	array('title'),
		'show_in_rest' => true,
	);
	register_post_type('publications', $args );
}

/**
 * 
 * We dont set up custom publication taxonomies, instead use the research taxonomies. We can then easilly correlate publications and research.
 * 
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
    'menu_position' =>  6,
		'public'				=>	true,
		'has_archive'		=>	true,
		'supports'			=>	array('title'),
		'show_in_rest' => true,
	);
	register_post_type('teaching', $args );
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
	);
	register_taxonomy('teaching-subjects', array('teaching'), $args);
}

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
    'menu_position' =>  7,
		'public'				=>	true,
		'has_archive'		=>	true,
		'supports'			=>	array('title' , 'thumbnail'),
		'show_in_rest' => true,
	);
	register_post_type('people', $args );
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
    'show_in_rest'  => true,
	);
	register_taxonomy('roles', array('people'), $args);
}

/**
 * Lab-Wiki
 */
add_action( 'init' , 'slow_atoms_wiki_post_type');

function slow_atoms_wiki_post_type() {

 $labels = array(
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

	$args = array(
		'hierarchical'	=>	true,
		'labels'				=>	$labels,
		'menu_icon'			=>	'dashicons-info',
    'menu_position' =>  8,
		'public'				=>	true,
		'has_archive'		=>	true,
		'supports'			=>	array('title' , 'editor', 'revisions', 'author', 'thumbnail'),
		'show_in_rest' => true,
	);
	register_post_type('lab-wiki', $args );
}

add_action( 'init' , 'slow_atoms_wiki_taxonomy');

function slow_atoms_wiki_taxonomy() {

 $labels = array(
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

	$args	=	array(
		'labels'				=>	$labels,
		'public'				=>	true,
		'hierarchical'	=>	true,
		'show_admin_column'	=> true,
    'show_in_rest'  => true,
	);
	register_taxonomy('wiki-subjects', array('lab-wiki'), $args);
}

?>
