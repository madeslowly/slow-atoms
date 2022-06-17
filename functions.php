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
	define( '_S_VERSION', '1.0.0' );
}

$slow_atom_func_dir = get_stylesheet_directory() . '/inc/functions/';
$roots_includes = array(
  '/inc/functions/custom-posts.php',
	'/inc/functions/enqueue-scripts-and-styles.php',
	'/inc/functions/acf-members.php',
	'/inc/functions/acf-publications.php',
	'/inc/functions/acf-hero-images.php',
	'/inc/functions/slow-atoms-customise-colors.php',

);

foreach( $roots_includes as $file ){
  if( ! $filepath = locate_template( $file ) ) {
    trigger_error("Error locating `$file` for inclusion!", E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function slow_atoms_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		*/
	load_theme_textdomain( 'slow-atoms', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );


	// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'priary-menu' => esc_html__( 'Primary', 'slow-atoms' ),
				'useful-links' => __( 'Useful Links' )
			)
		);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'slow_atoms_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'slow_atoms_setup' );

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


//* Function to convert Hex colors to RGBA
function hex2rgba( $color, $opacity = false ) {

    $defaultColor = 'rgb(0,0,0)';

    // Return default color if no color provided
    if ( empty( $color ) ) {
        return $defaultColor;
    }

    // Ignore "#" if provided
    if ( $color[0] == '#' ) {
        $color = substr( $color, 1 );
    }

    // Check if color has 6 or 3 characters, get values
    if ( strlen($color) == 6 ) {
        $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    } elseif ( strlen( $color ) == 3 ) {
        $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
    } else {
        return $default;
    }

    // Convert hex values to rgb values
    $rgb =  array_map( 'hexdec', $hex );

    // Check if opacity is set(rgba or rgb)
    if ( $opacity ) {
        if( abs( $opacity ) > 1 ) {
            $opacity = 1.0;
        }
        $output = 'rgba(' . implode( ",", $rgb ) . ',' . $opacity . ')';
    } else {
        $output = 'rgb(' . implode( ",", $rgb ) . ')';
    }

    // Return rgb(a) color string
    return $output;

}

/*
 * Example Usage:
 * $mycolor = '#ff0000';
 * $rgb = hex2rgba($mycolor);
 * $rgba = hex2rgba($mycolor, 0.5);
 */

 function colourBrightness($hex, $percent)
 {
     // Work out if hash given
     $hash = '';
     if (stristr($hex, '#')) {
         $hex = str_replace('#', '', $hex);
         $hash = '#';
     }
     /// HEX TO RGB
     $rgb = [hexdec(substr($hex, 0, 2)), hexdec(substr($hex, 2, 2)), hexdec(substr($hex, 4, 2))];
     //// CALCULATE
     for ($i = 0; $i < 3; $i++) {
         // See if brighter or darker
         if ($percent > 0) {
             // Lighter
             $rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1 - $percent));
         } else {
             // Darker
             $positivePercent = $percent - ($percent * 2);
             $rgb[$i] = round($rgb[$i] * (1 - $positivePercent)); // round($rgb[$i] * (1-$positivePercent));
         }
         // In case rounding up causes us to go to 256
         if ($rgb[$i] > 255) {
             $rgb[$i] = 255;
         }
     }
     //// RBG to Hex
     $hex = '';
     for ($i = 0; $i < 3; $i++) {
         // Convert the decimal digit to hex
         $hexDigit = dechex($rgb[$i]);
         // Add a leading zero if necessary
         if (strlen($hexDigit) == 1) {
             $hexDigit = "0" . $hexDigit;
         }
         // Append to the hex string
         $hex .= $hexDigit;
     }
     return $hash . $hex;
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
 *
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
 // Return error messlow_atomsge for invalid domains
 if( $valid === false ){

$errors->add('domain_whitelist_error',__('<strong>ERROR</strong>: Registration is only allowed from approved domains. If you think you are seeing this in error, please contact the system administrator.' ));
 }
}
add_action('register_post', 'is_valid_email_domain',10,3 );

// Convert hex to hsl and rotate by 180
function slow_atoms_180_hue_rot( $hex ) {

    $red		= hexdec( substr( $hex, 0, 2 ) ) / 255;
    $green	= hexdec( substr( $hex, 2, 2 ) ) / 255;
    $blue		= hexdec( substr( $hex, 4, 2 ) ) / 255;

    $cmin = min($red, $green, $blue);
    $cmax = max($red, $green, $blue);
    $delta = $cmax - $cmin;

    if ($delta === 0) {
        $hue = 0;
    } elseif ($cmax === $red) {
        $hue = (($green - $blue) / $delta) % 6;
    } elseif ($cmax === $green) {
        $hue = ($blue - $red) / $delta + 2;
    } else {
        $hue = ($red - $green) / $delta + 4;
    }

		$hue = round($hue * 60);

		if ($hue < 0) {
        $hue += 360;
    }
		$hue += 180 ;

		if ( $hue > 360 ){
			$hue -= 360;
		}

    $lightness = (($cmax + $cmin) / 2);
    $saturation = $delta === 0 ? 0 : ($delta / (1 - abs(2 * $lightness - 1)));
    if ($saturation < 0) {
        $saturation += 1;
    }

    $lightness = round($lightness  * 100);
    $saturation = round($saturation  * 100);

    return array( $hue, $saturation, $lightness );
}
