<?php
/**
 * Create a news post ($post) whenever a new group member is added ($ms_people)
 * 
 * @param $fields array(
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
 * @return $news_post_id	(int)
 * 
 */
function new_post_for_new_person( $fields ) {

	// Create the title for the news post
	if ( $fields['ms_people_role'] )  :
		$title = 'New ' . $fields['ms_people_role'] . ' - ' . $fields['ms_people_name'] ;
	else :
		$title = 'New Group Member - ' . $fields['ms_people_name'] ;
	endif ;
	
	// Check to see if new member has a thumbnail
	if ( $fields['ms_people_thumb'] != 0 ) :
		$thumb_id =  $fields['ms_people_thumb'] ;
	endif ;
	
	$content	 =	'<p class="sa__new-member">' . $fields[ 'ms_acf_people_assignment_name' ] . '</p>' ;
	$content	.=	'<p class="sa__new-member">' . $fields[ 'ms_acf_people_office_name' ] . ' can be found in ' . $person_office  . '</p>' ;
	$content	.=	'<p class="sa__new-member"> <a href="' . $fields[ 'ms_people_url' ] . '">More details</a></p>' ;

	// Note we set post_status to draft, so we can add the thumb before switching to publish
	$args = array(
		'post_title'		=> $title,
		'post_content'		=> $content,
		'post_status'		=> 'draft',
		'comment_status'	=> 'closed',
        'ping_status'		=> 'closed',
		'post_category' 	=> array( get_category_by_slug('new-member') -> term_id ),
	);
	$news_post_id = wp_insert_post( $args );
	
	// Add the person thumbnail if it exists.
	if ( $thumb_id ) :
		set_post_thumbnail( $news_post_id, $thumb_id );
	endif ;
	
	// Publish the post which will also trigger twitter_auto_post() 
	$news_post_id = wp_publish_post( $news_post_id ) ;

	return $news_post_id ;

}


