<?php
/**
 * 
 * Wrap submenu in markup for css
 *
 * @package slow_atoms
 * @since 0.0.0
 * 
 */

class Sub_Menu_Wrap extends Walker_Nav_Menu {
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= "\n<div class='sub-menu-wrap'>\n<ul class='sub-menu'>\n";
    }
    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= "</ul>\n</div>\n";
    }
}