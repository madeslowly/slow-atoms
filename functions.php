<?php
/**
 * slow atoms functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package slow_atoms
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '2.0.0' );
}

$ms_theme_dir = get_template_directory() ;

$ms_functions_dir = $ms_theme_dir . '/inc/functions/';

/**
 * **************		ACTIVATION		**************
 */
//require_once $ms_functions_dir . 'activation/register-db-tables.php';

//add_action('after_switch_theme', 'slow_atoms_lreg_table_creation');

/**
 * **************		SETUP		**************
 * 
 * Sets up theme defaults, registers support for various WordPress features and enques scripts and styles.
 */
function slow_atoms_setup() {

	// Load files from /inc/functions/setup/
	global $ms_theme_dir ;

	global $ms_functions_dir ;

	$ms_setup_files = glob( $ms_functions_dir . 'setup/*' );

	foreach ( $ms_setup_files as $ms_setup_file ) {
		// Ignore sub dirs
		if ( is_file( $ms_setup_file ) ) {
			require_once $ms_setup_file ; 
		}
	}
	
	// Make theme available for translation.
	// Translations can be filed in the /languages/ directory.
	load_theme_textdomain( 'slow-atoms', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	// @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in two location.
	register_nav_menus(
		array(
			'priary-menu' => esc_html__( 'Primary', 'slow-atoms' ),
			'useful-links' => esc_html__( 'Useful Links', 'slow-atoms' ),
		) 
	) ;

	// Switch default core markup for search form, comment form, and comments to output valid HTML5.
	add_theme_support( 'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script', 
		)
	) ;

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background',
		apply_filters(
			'slow_atoms_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '', ) ) ) ;

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );


	 // Add support for core custom logo.
	 // @link https://codex.wordpress.org/Theme_Logo
	add_theme_support( 'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true, 
		)
	) ;

}
add_action( 'after_setup_theme', 'slow_atoms_setup' );

/**
 * **************		CALLBACKS		**************
 * 
 * Register functions that are called from various theme files 
 */
function slow_atoms_callbacks() {

	global $ms_theme_dir ;
	global $ms_functions_dir ;

	$ms_callback_files = glob( $ms_functions_dir . 'callbacks/*' );

	foreach ( $ms_callback_files as $ms_callback_file ) {
		// ignore sub dirs
		if ( is_file( $ms_callback_file ) ) {
			//echo '$ms_function_file';
			require_once $ms_callback_file ; } }

}
add_action( 'init', 'slow_atoms_callbacks' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function slow_atoms_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'slow_atoms_content_width', 640 );
}
add_action( 'after_setup_theme', 'slow_atoms_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function slow_atoms_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'slow-atoms' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'slow-atoms' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'slow_atoms_widgets_init' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// Wrap a container round sub menus for css reasons

class submenu_wrap extends Walker_Nav_Menu {
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<div class='sub-menu-wrap'><ul class='sub-menu'>\n";
    }
    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul></div>\n";
    }
}

/*
 * Change 'Posts' to 'News'
 *
 */
function change_post_menu_label() {
	global $menu;
	global $submenu;
	$menu[5][0] = 'News';
	$submenu['edit.php'][5][0] = 'All news';
	$submenu['edit.php'][10][0] = 'Add news item';
	echo '';
}

add_action( 'admin_menu', 'change_post_menu_label' );


function slow_atoms_archive_title( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    }

    return $title;
}

add_filter( 'get_the_archive_title', 'slow_atoms_archive_title' );

// Allow Registration Only from @ru.nl and @science.ru.nl email addresses
function is_valid_email_domain($login, $email, $errors ){
	$valid_email_domains = array("ru.nl","science.ru.nl");// allowed domains
	$valid = false; // sets default validation to false
	foreach( $valid_email_domains as $d ){
		$d_length = strlen( $d );
		$current_email_domain = strtolower( substr( $email, -($d_length), $d_length));

		if( $current_email_domain == strtolower($d) ){
			$valid = true;
			break;
		}
 }
 // Return error message for invalid domains
 if( $valid === false ){

$errors->add('domain_whitelist_error',__('<strong>Error</strong>: Registration is only allowed from approved domains. If you think you are seeing this in error, please contact the <a href="mailto:arran.curran@ru.nl?subject=Dullenslab Registration Error">system administrator</a>.' ));
 }
}
add_action('register_post', 'is_valid_email_domain',10,3 );

/*
 * Get random image from homepage ACF hero image fields
 * - Count number of possible fields then loop until field is empty. Then use this to generate a random selctor.
 * 
 */

function slow_atoms_get_random_hero( $wrapper_class , $image_class ) {
	
	$home_page_ID		=	get_option( 'page_on_front' ) ;
	$home_page_fields	=	get_fields( $home_page_ID , true ) ;

	// Count the number of populated fields
	// Number of fields set in inc/custom-fields/acf-hero-images.php
	$possible_fields	=	count( $home_page_fields ) ;
	// Number of user populated fields
	$populated_feilds	=	1 ;

	while( $populated_feilds <= $possible_fields ) : 
		// Odly doesnt work with image_key
		$image_name = 'ms_acf_hero_image_' . $populated_feilds  ;
		
		if ( empty( $home_page_fields[ $image_name ] ) ) :
			// Break as sson as we get an empty field and reduce populated_feilds by one.
			$populated_feilds = $populated_feilds - 1  ;
			break ;

		else :
			$populated_feilds++ ;
		endif ;
	endwhile;

	$image_key			=	'ms_acf_hero_images_field_' . rand( 1 , $populated_feilds ) ;

	if ( get_field( $image_key , $home_page_ID ) ) :

		$image_ID		=	get_field( $image_key , $home_page_ID , false ) ;
		$image_srcset	=	wp_get_attachment_image_srcset( $image_ID , 'full' );
		$image_url		=	wp_get_attachment_image_src( $image_ID )[ 0 ] ;

		$image_markup = 
		'<div class="' . $wrapper_class . '">
			<img class="' . $image_class . '"src="' . $image_url . '" srcset="' . esc_attr( $image_srcset ) . '" />
		</div><!-- .' . $wrapper_class . '-->' ;
	else :

		$image_markup = 
		'<span style="display:flex;width:100vw;">
			No image found. Edit home page and select images under "Hero Images"
		</span>';
	endif ;

	echo $image_markup ;	

	// return to caller
	return;

}


// Using Thumbnails with Previous and Next Post Links

function slow_atoms_posts_nav( $archive_name , $show_thumb , $show_title ) {
	
	$next_post = get_next_post() ;
	$prev_post = get_previous_post() ;
	
	if ( $next_post || $prev_post ) : ?>
	
		<div class="slow-atoms-posts-nav">
			<h2 class="screen-reader-text">Post navigation</h2>
			<div> <?php

				if ( ! empty( $prev_post ) ) : ?>

				<a href="<?php echo get_permalink( $prev_post ); ?>"> <?php

					if ( $show_thumb == 'true' ) : ?>

					<div>
						<div class="slow-atoms-posts-nav__thumbnail slow-atoms-posts-nav__prev">
							<?php echo get_the_post_thumbnail( $prev_post, [ 100, 100 ] ); ?>
						</div>
					</div> <?php

					endif ; ?>


					<div>
						<strong>
							<i class="fas fa-arrow-circle-left"></i>
							<?php _e( 'Previous ' . $archive_name , 'textdomain' ) ?>
						</strong> <?php

						if( $show_title == 'true' ) : ?>

						<h4><?php echo get_the_title( $prev_post ); ?></h4> <?php

						endif ; ?>
					</div>

      			</a> <?php

				endif; ?>
    		</div>

    		<div> <?php

				if ( ! empty( $next_post ) ) : ?>

				<a href="<?php echo get_permalink( $next_post ); ?>">
					<div>
						<strong>
							<?php _e( 'Next ' . $archive_name , 'textdomain' ) ?>
							<i class="fas fa-arrow-circle-right"></i>
						</strong><?php

						if( $show_title == 'true' ) : ?>

						<h4><?php echo get_the_title( $next_post ); ?></h4> <?php

						endif ; ?>

					</div>

					<div>
						<div class="slow-atoms-posts-nav__thumbnail slow-atoms-posts-nav__next">
							<?php echo get_the_post_thumbnail( $next_post, [ 100, 100 ] ); ?>
						</div>
					</div>
   				</a> <?php

				endif; ?>
  			</div>
		</div> <!-- .slow-atoms-posts-nav --> <?php

	endif ; }

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
 * NOTE: it would be better to have a func we can call from the archive tem[plate instead of a hard coded func here
 */

add_action( 'pre_get_posts', 'slow_atoms_change_sort_order'); 

function slow_atoms_change_sort_order( $query ) {
	if( is_post_type_archive( $post_types = ['ms_labwiki', 'ms_research', 'ms_people'])):
		//If you wanted it for the archive of a custom post type use: is_post_type_archive( $post_type )
		//Set the order ASC or DESC
		$query->set( 'order', 'ASC' );
		//Set the orderby
		$query->set( 'orderby', 'date' );
	endif;    
};	



function slow_atoms_login_styles() { ?>

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
<?php }

add_action( 'login_enqueue_scripts', 'slow_atoms_login_styles' );