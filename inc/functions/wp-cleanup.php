<?php
/**
 * WordPress Cleanup
 *
 * @package      slow_atoms
 * 
**/

/**
 * Singular body class
 */
function ea_singular_body_class( $classes ) {
	if( is_singular() )
		$classes[] = 'singular';
	return $classes;
}
//add_filter( 'body_class', 'ea_singular_body_class' );

/**
 * Remove excess classes for {post}-template
 * 
 * e.g. .page-template-{dir} and .page-template-{dir}{file}
 *
 * This theme has one page template directory at page-templates so remove all classes with '{post}-template-page-templates'
 */
function slow_atoms_remove_template_classes( $classes ) {

	if ( is_page_template() ) {
		$count = 0 ;
		foreach ( $classes as $class ) {
			if ( strpos( $class, '-template-page-templates' ) !== false ){
				array_splice( $classes, $count, 1 ) ;
			} else {
				$count ++ ;
			}
		}
	}
	
	return $classes ;
}

add_filter( 'body_class', 'slow_atoms_remove_template_classes', 20 );

/**
 * Clean Nav Menu Classes
 *
 */
function ea_clean_nav_menu_classes( $classes ) {
	if( ! is_array( $classes ) )
		return $classes;

	foreach( $classes as $i => $class ) {

		// Remove class with menu item id
		$id = strtok( $class, 'menu-item-' );
		if( 0 < intval( $id ) )
			unset( $classes[ $i ] );

		// Remove menu-item-type-*
		if( false !== strpos( $class, 'menu-item-type-' ) )
			unset( $classes[ $i ] );

		// Remove menu-item-object-*
		if( false !== strpos( $class, 'menu-item-object-' ) )
			unset( $classes[ $i ] );

		// Change page ancestor to menu ancestor
		if( 'current-page-ancestor' == $class ) {
			$classes[] = 'current-menu-ancestor';
			unset( $classes[ $i ] );
		}
	}

	// Remove submenu class if depth is limited
	if( isset( $args->depth ) && 1 === $args->depth ) {
		$classes = array_diff( $classes, array( 'menu-item-has-children' ) );
	}

	return $classes;
}

add_filter( 'nav_menu_css_class', 'ea_clean_nav_menu_classes', 5 );

/**
 * Remove prefix to titles
 * 
 */

function slow_atoms_archive_title( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false ) ;
    
	} elseif ( is_tag() ) {
        $title = single_tag_title( '', false ) ;
    
	} elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>' ;
    
	} elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false ) ;
    
	} elseif ( is_tax() ) {
        $title = single_term_title( '', false ) ;
    }
    return $title ;
}

add_filter( 'get_the_archive_title', 'slow_atoms_archive_title' );

/**
 * 
 * Remove bloat
 * 
 * TODO: eventually we should remove wp styling and replace with our own
 *  
 */

// add_action( 'wp_enqueue_scripts', 'remove_global_styles' );

// function remove_global_styles(){
// 	// Remove global-styles-inline
// 	wp_dequeue_style( 'global-styles' );
// 	// Remove wp-block-library-css
// 	wp_dequeue_style( 'wp-block-library' );
// 	// Remove classic-theme-styles
// 	wp_dequeue_style( 'classic-theme-styles' );
//     //wp_dequeue_style( 'wc-block-style' );
// }

// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
// Remove inline CSS for emoji
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );

remove_action( 'admin_print_styles', 'print_emoji_styles' );

remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );

/**
 * Remove commenting site wide
 */
add_action('admin_init', 'slow_atoms_no_comments');

function slow_atoms_no_comments() {
    
	// Redirect any user trying to access comments page
    global $pagenow;
     
    if ( $pagenow === 'edit-comments.php') {
        wp_safe_redirect(admin_url());
        exit;
    }
 
    // Remove comments from dashboard
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
 
    // Disable support for comments and trackbacks in post types
    foreach ( get_post_types() as $post_type ) {
        if ( post_type_supports( $post_type, 'comments') ) {
            remove_post_type_support( $post_type, 'comments');
            remove_post_type_support( $post_type, 'trackbacks');
        }
    }
};
 
// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);
 
// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);
 
// Remove comments page in menu
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
});
 
// Remove comments links from admin bar
add_action( 'admin_bar_menu', 'clean_admin_bar', 999 );
function clean_admin_bar( $wp_admin_bar ) {
    $wp_admin_bar->remove_node( 'comments' );
}