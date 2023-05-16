<?php

add_action('after_switch_theme', 'slow_atoms_create_taxonomies');

function slow_atoms_create_taxonomies( ){

	//
	// Create theme taxonomies
	//

    // Theme tax for news
	// tax:	new-member
	// used to mark posts that are auto generated when a new person is added to the websites people section.
	// Check if 'New Member' catagory already exists
	$post_cats = get_categories( array( 'hide_empty' => false ) ) ;

	foreach ( $post_cats as $cat) {
		if ( $cat -> slug == 'new-member' ) :
			// if it exists grab the term_id and break
			$cat_id = $cat -> term_id ;
			break ;
		endif ;
	}
	// If it doesn't exist, create it
	if ( ! $cat_id ) :
		$new_cat	= wp_insert_term('New Member', 'category', array( 'slug' => 'new-member' ) ) ;
		$cat_id		= isset( $new_cat['term_id'] ) ? $new_cat['term_id'] : 0;
	endif ;
	// NOTE: if user later renames this cat then we will fail to attach it to new members posts in create_post_for_new_person()

	//
	// Create tax for members posts


	//
	// Members taxonomy
	// We use these theme taxonomies to order the people on the people page

	$people_cats	= get_terms( array( 'ms_taxonomy_people' ), array( 'hide_empty'    => false ) ) ;
	
	$theme_cats 	= array(
		'academic',
		'support',
		'postdoc',
		'student',
		'visitor',
		'alumni',
	) ;

	foreach ( $people_cats as $cat ) { $existing_cats[] = $cat -> slug ; }
	
	$missing_cats = array_diff( $theme_cats, $existing_cats ) ;

	foreach ( $missing_cats as $cat ) {

		$new_cat	= wp_insert_term( ucfirst( $cat ), 'ms_taxonomy_people', array( 'slug' => $cat ) ) ;

	}


}
