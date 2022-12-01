<?php

/**
 * Provides a default menu featuring the custom post types of this theme, if no other menu has been provided.
 */
function slow_atoms_default_menu() {

	global $ms_theme_dir ;

	$default_menu = '<div class="menu-navbar-container">';
		$default_menu .= '<ul id="primary-menu" class="navbar--list">';

			$ms_custom_posts_dir = $ms_theme_dir . "/inc/functions/setup/custom-posts/*";
			$ms_custom_posts_files = glob( $ms_custom_posts_dir );

			foreach ( $ms_custom_posts_files as $ms_custom_posts_file ) {
				if ( is_file( $ms_custom_posts_file ) ) {
					$ms_custom_posts_filename = basename( $ms_custom_posts_file , '.php' ) ;
					$pieces	= explode( '-' , $ms_custom_posts_filename ) ;
					$display = ucfirst( $pieces[1] );
					$key	= $pieces[0] . '_' . $pieces[1] ;

					$default_menu .= '<li class="menu-item menu-item-type-post_type menu-item-object-page">';
						$default_menu .= '<a href="' . esc_url( get_post_type_archive_link( $key ) ) . '" title="' . __( $display, 'slow_atoms' ) . '">';
							$default_menu .= __( $display, 'slow_atoms' );
						$default_menu .= '</a>';
					$default_menu .= '</li>';
				}
				
			} ;

		$default_menu .= '</ul>' ;

	$default_menu .= '</div>' ;

	echo $default_menu ;

} // end slow_atoms_default_menu

?>