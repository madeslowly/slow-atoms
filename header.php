<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package slow_atoms
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }


/**
 * Get any classes that may be being passed from template with 
 * get_header('' , array( 'append_site-header_class' => array('new-class','new-class-2) ));
 * 
 * OR
 * 
 * get_header('' , array( 'append_site-header_class' => 'new-class' ));
 */

 $new_classes = '' ;

 // If we have passed an argument to have the class modified
if ( $args ) {

	$new_classes_args = $args['append_site-header_class'];

	// Add space to start of string
	$new_classes = ' ' ;

	if( is_array( $new_classes_args ) ) {
	
		foreach ( $new_classes_args as $class ) {
			$new_classes .= $class . ' ' ;
		}
	} else {
		$new_classes .= $new_classes_args ;
	} ;
};

$nav_menu = wp_nav_menu( array(
	'menu'			=> '4',
	'menu_id'       => 'primary-menu',
	'menu_class'	=> 'navbar--list' . $new_classes,
	'walker'		=> new Sub_Menu_Wrap(),
	'echo'			=> false,
	'fallback_cb'	=> 'slow_atoms_default_menu',
) ) ; 
			
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> >

<head>
<?php slow_atoms_head_top(); ?>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">
<?php wp_head(); ?>
<?php slow_atoms_head_bottom(); ?>
<!-- Disable AOS if JS is disabled -->
<!-- TODO: Move this to a function -->
<noscript><style>[data-aos] { opacity: 1 !important; transform: none !important; }</style></noscript>

</head>

<body <?php body_class(); ?> >
<?php wp_body_open(); ?>
<div id="page" class="site">
<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'slow-atoms'); ?></a>

<header id="masthead" class="site-header no-anim <?php echo $new_classes ; ?>">

<div class="site-branding">	<?php the_custom_logo(); ?>	</div><!-- .site-branding -->

<nav id="site-navigation" class="main-navigation">
<?php echo $nav_menu ; ?>

<div class="burger"><div class="burger-line-1"></div><div class="burger-line-2"></div><div class="burger-line-3"></div></div>

</nav><!-- #site-navigation -->
</header><!-- #masthead -->

<?php