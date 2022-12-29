<?php

/**
 *
 * Tweet new posts to Twitter. This uses the Codebird library:
 * https://github.com/jublonet/codebird-php/tree/release/3.2.0
 * 
 * @param       $post_id    (int)
 * @param       $post       (obj)
 * @param       $old_status (str)
 *
 */ 

add_action( 'publish_post', 'twitter_auto_post', 10, 3 );

function twitter_auto_post( $post_id, $post, $old_status ) {

    $user_enabled   = get_theme_mod('slow_atoms_twitter_enable_setting') ;
    $new_status     = get_post_status( $post_id ) ;
    $tweet_status   = get_post_meta( $post_id, 'twitter_response', true ) -> httpstatus  ;
    
    // Don't do anyhting unless twitter api is enabled by user
    // Don't do anyhting if new status is the same as old status
    // Don't do anything if the posts has tweet_status == 200
    $conditions = array(
        $user_enabled   => false,
        $new_status     => $old_status,
        $tweet_status   => 200,
    );

    foreach ( $conditions as $key => $value ) { if ( $key == $value ) return ; }
    
    // Get our twitter api keys
    $consumer_key			= get_theme_mod( 'slow_atoms_twitter_consumerKey_setting') ;
    $consumer_secret		= get_theme_mod( 'slow_atoms_twitter_consumerSecret_setting') ;
    $access_token			= get_theme_mod( 'slow_atoms_twitter_token_setting') ;
    $access_token_secret	= get_theme_mod( 'slow_atoms_twitter_tokenSecret_setting') ;

    // Check we have all the neccessary keys etc
    $conditions = array( 
        'Consumer Key'          => $consumer_key, 
        'Consumer Secret'       => $consumer_secret, 
        'Access Token'          => $access_token, 
        'Access Token Secret'   => $access_token_secret ) ;

    foreach ( $conditions as $key => $value ) { if ( !$value ) return ; }
    // TODO: notify user that a key is missing

    // Load the Codebird library
    require_once get_template_directory() . '/inc/vendor/codebird/src/codebird.php';

    \Codebird\Codebird::setConsumerKey( $consumer_key, $consumer_secret ) ;

    $twitter_app    =   \Codebird\Codebird::getInstance( ) ;
    $twitter_app	->  setToken( $access_token, $access_token_secret ) ;

    // Compose a $tweet using the gathered data:
    $post_title	= get_the_title( $post_id ) ;
    // TODO: better way to handle testing enviroemnts and production
    $post_image = str_replace( 'clients.local', 'com' , get_the_post_thumbnail_url( $post_id , 'full' )) ;

    $tweet = $post_title ;

    // Prepare for image upload
    $media_ids = array();
    if ( $post_image ) :
     	$media_files = array( $post_image ) ;
    
      	foreach ( $media_files as $file ) {
      		$twitter_response = $twitter_app -> media_upload( array (
      			'media' => $file
      		) ) ;
      		$media_ids[] = $twitter_response -> media_id_string;
      	}
    endif ;
    $media_ids = implode(',', $media_ids);
    
    // Send Tweet
    $twitter_response = $twitter_app -> statuses_update( array (
        'status'	=> $tweet,
        'media_ids' => $media_ids
    ));

    // Add database entry showing returned status, 200 = success
    // https://developer.twitter.com/en/support/twitter-api/error-troubleshooting
    add_post_meta( $post_id, 'twitter_response', $twitter_response, true ) ;

}