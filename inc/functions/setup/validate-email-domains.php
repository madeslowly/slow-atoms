<?php
/**
 *
 * Allow Registration only from $valid_domain
 * 
 * @param   $errors                 A WP_Error object containing any errors encountered during registration.
 * @param   $sanitized_user_login   (str) User's username after it has been sanitized.
 * @param   $old_status             (str) User's email.
 * 
 * @return  $errors   
 * 
 * LOGIC:
 * 1/	if $email contains $valid_domain get the index of the starting position, $valid_domain_pos
 * 		if $valid_domain_pos is anything but false then $email contains the exact match but could contain extra characters
 * 		i.e. gmail.comXYZ
 * 
 * 2/	so substr of $user_email at the index $valid_domain_pos and compare $extracted_domain_len with $valid_domain_len
 * 		if $user_email = email@gmail.comX, $extracted_domain returns mail.comX
 * 		then strlen() return int > $valid_domain_len
 * 		if $email = email@subdomain.gmail.com we get a valid response but not for email@subdomain.comxyz
 * 
 * NOTE: strpos() may return Boolean false, but may also return a non-Boolean value which evaluates to false.
 * So in the event strpos() returns int 0 (weird email address!) then our comparision needs to be !== false and NOT != false. which would pass since int 0 can be evaluated to bool false.
 * 
 */ 

function slow_atoms_validate_email_domains( $errors, $sanitized_user_login, $user_email ) {

	$valid				= false ;
	
	$valid_domain		= get_theme_mod('slow_atoms_authdomains_setting') ;

	$valid_domain_len	= strlen( $valid_domain ) ;

	$valid_domain_pos	= strpos( $user_email, $valid_domain ) ;
	
	if( $valid_domain_pos !== false ) :
		
		$extracted_domain		= substr( $user_email, $valid_domain_pos ) ;		
		$extracted_domain_len	= strlen( $extracted_domain ) ;
		
		if( $extracted_domain_len === $valid_domain_len ) { $valid = true ; }

	endif ;

 	if( $valid === false ) {
		$errors -> add( 'domain_whitelist_error', __('<strong>Invalid Domain</strong>: Registration is only allowed from approved domains.') ) ;
 	}
	
	return $errors ;
}

if ( get_option('users_can_register') == 1 && get_theme_mod('slow_atoms_authdomains_setting') ) :

	add_action('registration_errors', 'slow_atoms_validate_email_domains', 10 , 3 ) ;

endif ;