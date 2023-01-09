<?php

/**
 * 
 * Load all acf from custom-fields dir
 * 
 * This file is then loaded by functions.php
 * 
 */

if( function_exists('acf_add_local_field_group') ):

	require_once SLOW_ATOMS_SETUP_DIR . 'custom-fields/acf-contacts.php' ;

	require_once SLOW_ATOMS_SETUP_DIR . 'custom-fields/acf-hero-images.php' ;

	require_once SLOW_ATOMS_SETUP_DIR . 'custom-fields/acf-members.php' ;

	require_once SLOW_ATOMS_SETUP_DIR . 'custom-fields/acf-publications.php' ;

	require_once SLOW_ATOMS_SETUP_DIR . 'custom-fields/acf-teaching.php' ;

endif ;