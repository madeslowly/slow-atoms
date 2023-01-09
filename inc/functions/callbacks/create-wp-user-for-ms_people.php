<?php

function create_wp_user_for_ms_people( $fields ) {
    /**
     * Create user account for new member
     */
    $user_email		= $fields[ 'ms_acf_people_email_name' ] ;
    $display_name 	= $fields['ms_people_name'] ;
    $user_names		= explode( ' ' , trim( $display_name ) ) ;
    $user_fname		= $user_names[ 0 ] ;
    $user_lname		= end( $user_names ) ;
    $user_login		= $user_fname . $user_lname ;
    $user_nicename	= $user_login ;
    $user_nickname	= $user_fname . ' ' . $user_lname ;
    

    $userdata = array(
        //'ID' 					=> 0, 	//(int) User ID. If supplied, the user will be updated.
        //'user_pass'			=> '', 	//(string) The plain-text user password.
        'user_login' 			=> $user_login, 	//(string) The user's login username.
        'user_nicename' 		=> $user_nicename, 	//(string) The URL-friendly user name.
        //'user_url' 			=> '', 	//(string) The user URL.
        'user_email' 			=> $user_email, 	//(string) The user email address.
        'display_name' 			=> $display_name, 	//(string) The user's display name. Default is the user's username.
        'nickname' 				=> $user_nickname, 	//(string) The user's nickname. Default is the user's username.
        'first_name' 			=> $user_fname, 	//(string) The user's first name. For new users, will be used to build the first part of the user's display name if $display_name is not specified.
        'last_name' 			=> $user_lname, 	//(string) The user's last name. For new users, will be used to build the second part of the user's display name if $display_name is not specified.
        //'description' 		=> '', 	//(string) The user's biographical description.
        //'rich_editing' 		=> '', 	//(string|bool) Whether to enable the rich-editor for the user. False if not empty.
        //'syntax_highlighting' => '', 	//(string|bool) Whether to enable the rich code editor for the user. False if not empty.
        //'comment_shortcuts' 	=> '', 	//(string|bool) Whether to enable comment moderation keyboard shortcuts for the user. Default false.
        //'admin_color' 		=> '', 	//(string) Admin color scheme for the user. Default 'fresh'.
        //'use_ssl' 			=> '', 	//(bool) Whether the user should always access the admin over https. Default false.
        //'user_registered' 	=> '', 	//(string) Date the user registered. Format is 'Y-m-d H:i:s'.
        //'show_admin_bar_front'=> '', 	//(string|bool) Whether to display the Admin Bar for the user on the site's front end. Default true.
        'role' 					=> 'author', 	//(string) User's role.
        //'locale' 				=> '', 	//(string) User's locale. Default empty.
        'meta_input'			=> array( 'ms_user_status' => 'group_member' ) ,
    ) ;

    $wp_user_id = wp_insert_user( $userdata ) ;

    wp_new_user_notification( $wp_user_id, null, 'user' ) ;

    return $wp_user_id ;
}