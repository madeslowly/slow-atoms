<?php

/**
 * 
 * Load all acf custom fields from custom-fields dir
 * 
 * This file is then loaded from functions.php
 * 
 */

$ms_custom_fields_dir = $ms_theme_dir . "/inc/functions/setup/custom-fields/*";

// glob the dir for files
// https://www.php.net/manual/en/function.glob.php

$ms_custom_fileds_files = glob( $ms_custom_fields_dir );

foreach ( $ms_custom_fileds_files as $ms_custom_fileds_file ) {
	if ( is_file( $ms_custom_fileds_file ) ) {
		require_once $ms_custom_fileds_file ;
	}
	
}
