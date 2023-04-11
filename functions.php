<?php
/**
 * 
 * Slow Atoms functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package slow_atoms
 * @since 0.0.0
 * 
 */

if ( ! defined( 'ABSPATH' ) ) {	exit; }

/**
 * Define Constants
 */
define( 'SLOW_ATOMS_THEME_VERSION', '0.1.0' );
define( 'SLOW_ATOMS_THEME_DIR',	trailingslashit( get_template_directory() ) );
define( 'SLOW_ATOMS_THEME_URI',	trailingslashit( esc_url( get_template_directory_uri() ) ) );
define( 'SLOW_ATOMS_FUNC_DIR', SLOW_ATOMS_THEME_DIR . '/inc/functions/' );
define( 'SLOW_ATOMS_ACTIVATION_DIR', SLOW_ATOMS_FUNC_DIR . '/activation/' );
define( 'SLOW_ATOMS_SETUP_DIR',	SLOW_ATOMS_FUNC_DIR	. '/setup/' );
define( 'SLOW_ATOMS_CALLBACKS_DIR',	SLOW_ATOMS_FUNC_DIR	. '/callbacks/' );
define( 'SLOW_ATOMS_VENDOR_DIR', SLOW_ATOMS_FUNC_DIR	. '/vendor/' );


require_once SLOW_ATOMS_FUNC_DIR . 'wp-cleanup.php' ;

/**
 * **************		ACTIVATION		**************
 */
require_once SLOW_ATOMS_ACTIVATION_DIR . 'create-taxonomies.php';

/**
 * **************		HOOKS		**************
 */
require_once SLOW_ATOMS_FUNC_DIR . 'theme-hooks.php' ;

/**
 * **************		CALLBACKS		**************
 */
require_once SLOW_ATOMS_CALLBACKS_DIR . 'og-meta.php' ;

require_once SLOW_ATOMS_CALLBACKS_DIR . 'color-functions.php' ;

require_once SLOW_ATOMS_CALLBACKS_DIR . 'customise-colors.php' ;

require_once SLOW_ATOMS_CALLBACKS_DIR . 'structured-data.php' ;

require_once SLOW_ATOMS_CALLBACKS_DIR . 'twitter-meta.php' ;

require_once SLOW_ATOMS_CALLBACKS_DIR . 'create-wp-user-for-ms_people.php' ; 

require_once SLOW_ATOMS_CALLBACKS_DIR . 'new-post-for-new-person.php' ;

require_once SLOW_ATOMS_CALLBACKS_DIR . 'randomise-hero-images.php' ;

require_once SLOW_ATOMS_CALLBACKS_DIR . 'post-navigation.php' ; 

/**
 * **************		SETUP			**************
 */
require_once SLOW_ATOMS_SETUP_DIR . 'default-menu.php' ;

require_once SLOW_ATOMS_SETUP_DIR . 'enqueue-scripts-and-styles.php' ;

require_once SLOW_ATOMS_SETUP_DIR . 'general-setup.php' ;

require_once SLOW_ATOMS_SETUP_DIR . 'ms-custom-posts.php' ;

require_once SLOW_ATOMS_SETUP_DIR . 'ms-custom-fields.php' ;

require_once SLOW_ATOMS_SETUP_DIR . 'setup-new-group-member.php' ;

require_once SLOW_ATOMS_SETUP_DIR . 'validate-email-domains.php' ;

require_once SLOW_ATOMS_SETUP_DIR . 'class-slow-atoms-submenu-wrap.php' ;


/**
 * **************		VENDOR			**************
 */
require_once SLOW_ATOMS_VENDOR_DIR . 'twitter-auto-post.php' ;

require_once SLOW_ATOMS_VENDOR_DIR . 'google-analytics.php' ;

/**
 * Implement the Custom Header.
 */
require_once SLOW_ATOMS_THEME_DIR . '/inc/custom-header.php';

/**
 * Customizer additions.
 */
require_once SLOW_ATOMS_THEME_DIR . '/inc/customizer.php';


require_once SLOW_ATOMS_THEME_DIR . '/inc/template-functions.php';

require_once SLOW_ATOMS_THEME_DIR . '/inc/template-tags.php';


function slow_atoms_edit_post_link() {

	if ( get_edit_post_link() ) :

		echo  '<footer class="page-footer">' ;

		edit_post_link(
			sprintf( wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Edit <span class="screen-reader-text">%s</span>', 'slow-atoms' ),
				
				array( 'span' => array( 'class' => array(), ), ) ),

			wp_kses_post( get_the_title() )	), '<span class="edit-link">','</span>' );

		echo ' </footer><!-- .page-footer -->' ;

	endif ;
}

/**
 * 
 * Order selected archives alphabetically
 * NOTE: it would be better to have a func we can call from the archive template instead of a hard coded func here
 */

//add_action( 'pre_get_posts', 'slow_atoms_change_sort_order'); 

function slow_atoms_change_sort_order( $query ) {
	if( is_post_type_archive( $post_types = ['ms_labwiki', 'ms_research', 'ms_people'])):
		//If you wanted it for the archive of a custom post type use: is_post_type_archive( $post_type )
		//Set the order ASC or DESC
		$query->set( 'order', 'ASC' );
		//Set the orderby
		$query->set( 'orderby', 'date' );
	endif;    
};

function slow_atoms_login_styles() { 
	
	?>

	<style type="text/css">
		.login {
			background: rgba(40, 100, 160, 1);
		}
		.login > * {
			color: rgb( 240, 240, 240) ;
		}
		#login h1 a {
			display: none ;
			visibility: hidden ;
		}
		#login #nav a, #login #backtoblog a {
			color: rgb( 240, 240, 240) ;
		}
		#login h1::before {
			content:"<?php echo get_bloginfo() ; ?> Login";
		}
		#login form {
			border: none ;
		}
		#login * {
			background: none ;
		}
		#login input {
			border: solid 1px white
		}
		#login p.message.register {
			display: none
		}
		#login_error {
			color: black ;
		}
		#language-switcher {
			display: none
		}
		.wp-pwd .dashicons.dashicons-visibility {
			color: rgb( 240, 240, 240) 
		}
	</style>
	
	<?php 
}

add_action( 'login_enqueue_scripts', 'slow_atoms_login_styles' );

require get_template_directory() . '/color-scheme.php';

/**
 * Templates and Page IDs without editor
 *
 */
function slow_atoms_disable_editor( $id = false ) {

	$excluded_templates = array(
		'page-templates/contact-page.php'
	);

	$excluded_ids = array(
		// get_option( 'page_on_front' )
	);

	if( empty( $id ) )
		return false;

	$id = intval( $id );
	$template = get_page_template_slug( $id );

	return in_array( $id, $excluded_ids ) || in_array( $template, $excluded_templates );
}

/**
 * Disable Gutenberg by template
 *
 */
function slow_atoms_disable_gutenberg( $can_edit, $post_type ) {

	if( ! ( is_admin() && !empty( $_GET['post'] ) ) )
		return $can_edit;

	if( slow_atoms_disable_editor( $_GET['post'] ) )
		$can_edit = false;

	return $can_edit;

}
add_filter( 'gutenberg_can_edit_post_type', 'slow_atoms_disable_gutenberg', 10, 2 );
add_filter( 'use_block_editor_for_post_type', 'slow_atoms_disable_gutenberg', 10, 2 );

/**
 * Disable Classic Editor by template
 *
 */
function slow_atoms_disable_classic_editor() {

	$screen = get_current_screen();
	if( 'page' !== $screen->id || ! isset( $_GET['post']) )
		return;

	if( slow_atoms_disable_editor( $_GET['post'] ) ) {
		remove_post_type_support( 'page', 'editor' );
	}

}
add_action( 'admin_head', 'slow_atoms_disable_classic_editor' );



add_filter( 'wp_new_user_notification_email', 'custom_wp_new_user_notification_email', 10, 3 );

function custom_wp_new_user_notification_email( $wp_new_user_notification_email, $user, $blogname ) {
	$key = get_password_reset_key( $user );
	$pwd_reset_url	= network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user->user_login), 'login');
	$domain = parse_url( get_site_url() , PHP_URL_HOST ) ;
	
	$headers = array(
		'Content-Type: text/html; charset=UTF-8',
		'From:' . get_bloginfo('name') . '<no-reply@' . $domain . '>',
		'Reply-To: Site Admin<' . get_bloginfo('admin_email') . '>',
	);

	$subject  = 'Welcome to ' . $domain ;

	// Check if user is a group member
	if ( get_user_meta( $user -> ID , 'ms_user_status' , true ) == 'group_member' ) :
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
	
    return $wp_new_user_notification_email;
}
