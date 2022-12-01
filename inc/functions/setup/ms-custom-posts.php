<?php

/**
 * 
 * Load all custom posts and taxonomies from custom-posts dir
 * 
 * This file is then loaded from functions.php
 * 
 */

$ms_custom_posts_dir = $ms_theme_dir . "/inc/functions/setup/custom-posts/*";

// glob the dir for files
// https://www.php.net/manual/en/function.glob.php

$ms_custom_posts_files = glob( $ms_custom_posts_dir );

foreach ( $ms_custom_posts_files as $ms_custom_posts_file ) {
	if ( is_file( $ms_custom_posts_file ) ) {
		require_once $ms_custom_posts_file ;
	}
	
}

add_action( 'init' , 'slow_atoms_wiki_post_type');

add_action( 'init' , 'slow_atoms_wiki_taxonomy');

add_action( 'init' , 'slow_atoms_people_post_type');

add_action( 'init' , 'slow_atoms_people_taxonomy');

add_action( 'init' , 'slow_atoms_publications_post_type');

add_action( 'init' , 'slow_atoms_research_post_type');

add_action( 'init' , 'slow_atoms_research_taxonomy');

add_action( 'init' , 'slow_atoms_teaching_post_type');

add_action( 'init' , 'slow_atoms_teaching_taxonomy');