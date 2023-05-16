<?php

/**
 * 
 * Setup up new members with a wp_user account 
 * Post to news about them.
 * 
 * We cant use publish_post hook as acf fields are saved after this and therefore not availible yet
 * NOTE: acf/save_post only fires when a post with acf fields is saved/updated
 * 
 * @param $ms_people_id (int), id of the ms_people posts
 * 
 * $fields array(
 *	ms_people_role					(str)
 *	ms_people_name					(str)
 *	ms_people_url   				(str|false)
 *	ms_people_thumb					(int|false if post doesn't exist)
 *	ms_acf_people_status_name		(bool)
 *	ms_acf_people_bio_name			(str)
 *	ms_acf_people_assignment_name	(str)
 *	ms_acf_people_email_name		(str)
 *	ms_acf_people_tel_name			(int)
 *	ms_acf_people_office_name		(str)
 *	ms_acf_people_postcode_name		(int)
 *	wp_user_id						(int)
 * )
 * 
 * Calls
 *  create_wp_user_for_ms_people()
 *  new_post_for_new_person()
 * 
 */

add_action('acf/save_post' , 'setup_new_group_member' , 11 , 1 ) ;

function setup_new_group_member( $ms_people_id ) {

    $conditions = array(
        get_post_type( $ms_people_id )      => 'ms_people',
        get_post_status( $ms_people_id )    => 'publish',
        //get_the_time('U' , $ms_people_id )  => get_the_modified_time( 'U' , $ms_people_id )
    );

    foreach ( $conditions as $key => $label ) { if ( $key != $label ) return ; }

    $person_roles	= get_the_terms( $ms_people_id, 'ms_taxonomy_people' );

    // Get wp core fields from post
    $fields = array(
        'ms_people_role'    => $person_roles[0] -> name,
        'ms_people_name'    => the_title( '', '', false ),
        'ms_people_url'     => get_permalink( $ms_people_id ),
        'ms_people_thumb'   => get_post_thumbnail_id( $ms_people_id ),
    ) ;

    // Add in the ACF fields
    $fields += get_fields( $ms_people_id ) ;

    // Create a wp user account for the new user
    $wp_user_id = create_wp_user_for_ms_people( $fields ) ;

    // Change ms_people author to the newly created account, this means they can edit it
    wp_update_post( array('ID' => $ms_people_id, 'post_author' => $wp_user_id) ) ;
    // TODO: if this post is updated later on by an admin, the author changes to them and the lower ranked user can no longer edit their own page

    $fields += ['wp_user_id' => $wp_user_id ] ;

    // Create a news posts about the new group member
    $news_post_id = new_post_for_new_person( $fields ) ;

    //file_put_contents( "vardump-userID.txt" ,  json_encode($fields) );

}