<?php
/**
 *
 * @package  slow_atoms
 * @author Theme Hook Alliance
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 */

/**
 * Themes and Plugins can check for slow_atoms_hooks using current_theme_supports( 'slow_atoms_hooks', $hook )
 * to determine whether a theme declares itself to support this specific hook type.
 *
 * Example:
 * <code>
 * 		// Declare support for all hook types
 * 		add_theme_support( 'slow_atoms_hooks', array( 'all' ) );
 *
 * 		// Declare support for certain hook types only
 * 		add_theme_support( 'slow_atoms_hooks', array( 'header', 'content', 'footer' ) );
 * </code>
 */
add_theme_support( 'slow_atoms_hooks', array(

	/**
	 * As a Theme developer, use the 'all' parameter, to declare support for all
	 * hook types.
	 * Please make sure you then actually reference all the hooks in this file,
	 * Plugin developers depend on it!
	 */
	//'all',

	/**
	 * Themes can also choose to only support certain hook types.
	 * Please make sure you then actually reference all the hooks in this type
	 * family.
	 *
	 * When the 'all' parameter was set, specific hook types do not need to be
	 * added explicitly.
	 */
	'html',
	'body',
	'head',
	'header',
	'content',
	'entry',
	//'comments',
	'sidebars',
	'sidebar',
	'footer',

) );

/**
 * Determines, whether the specific hook type is actually supported.
 *
 * Plugin developers should always check for the support of a <strong>specific</strong>
 * hook type before hooking a callback function to a hook of this type.
 *
 * Example:
 * <code>
 * 		if ( current_theme_supports( 'slow_atoms_hooks', 'header' ) )
 * 	  		add_action( 'slow_atoms_head_top', 'prefix_header_top' );
 * </code>
 *
 * @param bool $bool true
 * @param array $args The hook type being checked
 * @param array $registered All registered hook types
 *
 * @return bool
 */
function slow_atoms_current_theme_supports( $bool, $args, $registered ) {
	return in_array( $args[0], $registered[0] ) || in_array( 'all', $registered[0] );
}
add_filter( 'current_theme_supports-slow_atoms_hooks', 'slow_atoms_current_theme_supports', 10, 3 );

/**
 * HTML <html> hook
 * Special case, useful for <DOCTYPE>, etc.
 * $slow_atoms_supports[] = 'html;
 */
function slow_atoms_html_before() {
	do_action( 'slow_atoms_html_before' );
}
/**
 * HTML <body> hooks
 * $slow_atoms_supports[] = 'body';
 */
function slow_atoms_body_top() {
	do_action( 'slow_atoms_body_top' );
}

function slow_atoms_body_bottom() {
	do_action( 'slow_atoms_body_bottom' );
}

/**
 * HTML <head> hooks
 *
 * $slow_atoms_supports[] = 'head';
 */
function slow_atoms_head_top() {
	do_action( 'slow_atoms_head_top' );
}

function slow_atoms_head_bottom() {
	do_action( 'slow_atoms_head_bottom' );
}

/**
 * Semantic <header> hooks
 *
 * $slow_atoms_supports[] = 'header';
 */
function slow_atoms_header_before() {
	do_action( 'slow_atoms_header_before' );
}

function slow_atoms_header_after() {
	do_action( 'slow_atoms_header_after' );
}

function slow_atoms_header_top() {
	do_action( 'slow_atoms_header_top' );
}

function slow_atoms_header_bottom() {
	do_action( 'slow_atoms_header_bottom' );
}

/**
 * Semantic <content> hooks
 *
 * $slow_atoms_supports[] = 'content';
 */
function slow_atoms_content_before() {
	do_action( 'slow_atoms_content_before' );
}

function slow_atoms_content_after() {
	do_action( 'slow_atoms_content_after' );
}

function slow_atoms_content_top() {
	do_action( 'slow_atoms_content_top' );
}

function slow_atoms_content_bottom() {
	do_action( 'slow_atoms_content_bottom' );
}

function slow_atoms_content_while_before() {
	do_action( 'slow_atoms_content_while_before' );
}

function slow_atoms_content_while_after() {
	do_action( 'slow_atoms_content_while_after' );
}

/**
 * Semantic <entry> hooks
 *
 * $slow_atoms_supports[] = 'entry';
 */
function slow_atoms_entry_before() {
	do_action( 'slow_atoms_entry_before' );
}

function slow_atoms_entry_after() {
	do_action( 'slow_atoms_entry_after' );
}

function slow_atoms_entry_content_before() {
	do_action( 'slow_atoms_entry_content_before' );
}

function slow_atoms_entry_content_after() {
	do_action( 'slow_atoms_entry_content_after' );
}

function slow_atoms_entry_top() {
	do_action( 'slow_atoms_entry_top' );
}

function slow_atoms_entry_bottom() {
	do_action( 'slow_atoms_entry_bottom' );
}

/**
 * Semantic <sidebar> hooks
 *
 * $slow_atoms_supports[] = 'sidebar';
 */
function slow_atoms_sidebars_before() {
	do_action( 'slow_atoms_sidebars_before' );
}

function slow_atoms_sidebars_after() {
	do_action( 'slow_atoms_sidebars_after' );
}

function slow_atoms_sidebar_top() {
	do_action( 'slow_atoms_sidebar_top' );
}

function slow_atoms_sidebar_bottom() {
	do_action( 'slow_atoms_sidebar_bottom' );
}

/**
 * Semantic <footer> hooks
 *
 * $slow_atoms_supports[] = 'footer';
 */
function slow_atoms_footer_before() {
	do_action( 'slow_atoms_footer_before' );
}

function slow_atoms_footer_after() {
	do_action( 'slow_atoms_footer_after' );
}

function slow_atoms_footer_top() {
	do_action( 'slow_atoms_footer_top' );
}

function slow_atoms_footer_bottom() {
	do_action( 'slow_atoms_footer_bottom' );
}