<?php
/**
 * Custom email sent out to new users confirming their account
 * 
 * This function is triggered by wp_new_user_notification_email
 * 
 * @param $fields	(array)
 *	wp_new_user_notification_email
 *	user
 *	blogname 
 * 
 * @return $wp_new_user_notification_email
 * 
 */


function slow_atoms_new_user_notification_email( $wp_new_user_notification_email, $user, $blogname ) {
	
    $key            = get_password_reset_key( $user ) ;
	$pwd_reset_url  = network_site_url( "wp-login.php?action=rp&key=$key&login=" . rawurlencode( $user -> user_login ), 'login' ) ;
	$domain         = parse_url( get_site_url() , PHP_URL_HOST ) ;
	
	$headers        = array(
		'Content-Type: text/html; charset=UTF-8',
		'From:' . get_bloginfo('name') . '<no-reply@' . $domain . '>',
		'Reply-To: Site Admin<' . get_bloginfo('admin_email') . '>',
	);

	$subject        = 'Welcome to ' . $domain ;

	// Check if user is a group member
	if ( get_user_meta( $user -> ID , 'ms_user_status', true ) == 'group_member' ) :
		
        $lab_wiki_url			= network_site_url( "labwiki" ) ;
		$user_public_profile	= network_site_url( "people/" . rawurlencode( $user -> user_nicename ) ) ;
		$user_private_profile	= network_site_url( "wp-admin/user-edit.php?user_id=" . rawurlencode( $user -> ID) ) ;

		$greeting 				= $user -> first_name ;
		$profile_edits			= 'After you create your password you can access your <a href="' . $user_public_profile . '">public</a> and <a href="' . $user_private_profile . '">private</a> profile pages.<br>' ;
		$profile_edits		   .= 'Please add some information to your <a href="' . $user_public_profile . '">public profile page</a>.<br><br>' ;
	
	else :
		$greeting 				= $user -> login_name ;
		$profile_edits			= '';

	endif ;

	$message  = 'Hello ' . $greeting . ',<br><br>' ;
	$message .= 'To complete your registration create your password, <a href="' . $pwd_reset_url . '">here</a>' ;
	$message .= '<br><br>' ;
	$message .= $profile_edits ;
	$message .= 'You will also be able to view our <a href="' . $lab_wiki_url . '">lab wiki</a>. If you would like to contribute to our lab wiki send an email to ' . get_bloginfo('admin_email') ;
	$message .= '<br><br>' ;

	$wp_new_user_notification_email[ 'headers' ] = $headers ;
	$wp_new_user_notification_email[ 'subject' ] = $subject ;
	$wp_new_user_notification_email[ 'message' ] = $message ;
	
    return $wp_new_user_notification_email ;

}

add_filter( 'wp_new_user_notification_email', 'slow_atoms_new_user_notification_email', 10, 3 ) ;