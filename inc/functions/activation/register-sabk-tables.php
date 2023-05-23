<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit ; // Exit if accessed directly.
}

add_action("after_switch_theme", "slow_atoms_sabk_table_creation");

function slow_atoms_sabk_table_creation( ){

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php');
    
    global $wpdb ;
    
    $charset_collate = $wpdb -> get_charset_collate() ;

    $sa_bookings = "CREATE TABLE sa_bookings (
    booking_id int NOT NULL AUTO_INCREMENT,
    service_id int NOT NULL,
    service_name VARCHAR(256) NOT NULL,
    email VARCHAR(256) NOT NULL,
    PRIMARY KEY  (booking_id)
    ) $charset_collate;";

    $sa_booked_dates = "CREATE TABLE sa_booked_dates (
    booking_id int NOT NULL,
    service_id int NOT NULL,
    service_name VARCHAR(256) NOT NULL,
    booked_date int NOT NULL
    ) $charset_collate;";
        
    dbDelta( $sa_bookings ) ;
    dbDelta( $sa_booked_dates ) ;
}