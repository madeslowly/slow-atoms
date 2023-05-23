<?php

/**
 * Slow Atoms custom posts and taxonomies
 *
 * @link https://developer.wordpress.org/themes/basics/categories-tags-custom-taxonomies/
 *
 * @package slow_atoms
 * 
 */

add_action('init' , 'slow_atoms_custom_posts');

function slow_atoms_custom_posts(){

	require_once SLOW_ATOMS_SETUP_DIR . 'custom-posts/ms-labwiki-posts.php' ;

	require_once SLOW_ATOMS_SETUP_DIR . 'custom-posts/ms-people-posts.php' ;

	require_once SLOW_ATOMS_SETUP_DIR . 'custom-posts/ms-publications-posts.php' ;

	require_once SLOW_ATOMS_SETUP_DIR . 'custom-posts/ms-research-posts.php' ;

	require_once SLOW_ATOMS_SETUP_DIR . 'custom-posts/ms-teaching-posts.php' ;

	require_once SLOW_ATOMS_SETUP_DIR . 'custom-posts/ms-equipment-posts.php' ;
	
}