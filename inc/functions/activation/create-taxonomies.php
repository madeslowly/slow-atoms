<?php

add_action('after_switch_theme', 'slow_atoms_create_taxonomies');

function slow_atoms_create_taxonomies( ){

    // First check to see if 'New Member' catogory exists
	$post_cats = get_categories( array( 'hide_empty' => false ) ) ;

	foreach ( $post_cats as $cat) {
		if ( $cat -> slug == 'new-member' ) :
			// if it exists grab the term_id and break
			$cat_id = $cat -> term_id ;
			break ;
		endif ;
	}
	// If it doesnt exist, create it
	if ( ! $cat_id ) :
		$new_cat	= wp_insert_term('New Member', 'category', array( 'slug' => 'new-member' ) ) ;
		$cat_id		= isset( $new_cat['term_id'] ) ? $new_cat['term_id'] : 0;
	endif ;
// NOTE: if user later renames this cat then we will fail to attach it to new members posts in create_post_for_new_person()
}