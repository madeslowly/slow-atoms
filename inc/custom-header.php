<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package slow_atoms
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses slow_atoms_header()
 */
function slow_atoms_custom_header_setup() {
	add_theme_support( 'custom-header',
		apply_filters( 'slow_atoms_custom_header_args', array(
			'default-image'      => '',
			'default-text-color' => 'FFFFFF',
			'width'              => 1000,
			'height'             => 250,
			'flex-height'        => true,
			//'wp-head-callback'   => 'slow_atoms_header',
			'header-text'         => false,
		) )
	);
}

add_action( 'after_setup_theme', 'slow_atoms_custom_header_setup' );