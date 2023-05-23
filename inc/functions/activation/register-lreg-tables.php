<?php

//add_action("after_switch_theme", "mytheme_create_extra_table");

function slow_atoms_lreg_table_creation( ){
    
    global $wpdb;
    
    $charset_collate = $wpdb -> get_charset_collate() ;
    
    //$table_name = $wpdb->prefix . 'lso';

    $table_name = 'ls_lreg' ;

    $sql = "CREATE TABLE " . $table_name . " (
    id int(11) NOT NULL AUTO_INCREMENT,
    lreg_number tinytext NOT NULL,
    email VARCHAR(100) NOT NULL,
    age int(2) NULL,
    ip_address varchar(15),
    PRIMARY KEY  (id),
    KEY ip_address (ip_address)
    ) $charset_collate;";
    
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    
    dbDelta($sql);
}