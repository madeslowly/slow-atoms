<?php
/**
 * Process _POST from equipment bookings
 * 
 * This function is triggered by form submissions from booking forms on equipment-booking-form.php
 * 
 * @param 
 * 
 * @return 
 * 
 */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
} 

add_action( 'admin_post_process_booking', 'process_equipment_booking' );

//this next action version allows users not logged in to submit requests
//if you want to have both logged in and not logged in users submitting, you have to add both actions!
// add_action( 'admin_post_nopriv_process_booking', 'process_equipment_booking' );

$notif = '' ;

function process_equipment_booking() {

  global $notif ;

  $email        = $_REQUEST['sabk-email'] ;
  $booked_dates = $_REQUEST['sabk-dates'] ;
  $service_id   = $_REQUEST['sabk-service-id'] ;
  $service_name = $_REQUEST['sabk-service-name'] ;
  $booking_id   = $_REQUEST['sabk-booking-id'] ;

  // Check if email is empty and if so return with error message
  if ( ! $email ) { 
    // Get admin user data
    $admin_email = get_option('admin_email');
    $admin_user = get_user_by('email', $admin_email);
    $admin_name = $admin_user->display_name;

    // Debug: Output admin name and email
    error_log('Admin Name: ' . $admin_name);
    error_log('Admin Email: ' . $admin_email);
    // Update notification message
    $notif = 'Error: No email address was found. Contact ' . $admin_name . ' for assistance.';
    
    $refer  = wp_get_referer() ;
    $refer  = strtok( $refer, '?' ) ;
    if ( $refer ) {
      wp_safe_redirect( $refer . '?notif='.$notif  );
    } else {
      wp_safe_redirect( get_home_url() );
    }
    return ; 
 }

  global $wpdb ;

  // SQL tables
  $sa_bookings  = 'sa_bookings' ;
  $sa_dates     = 'sa_booked_dates' ;

  $dates_arr    = preg_split( "/\, /", $booked_dates ) ;

  if ( $booking_id ) {

    // A booking ID already exists so we are updating an existing booking

    // Get currently booked dates for given booking ID
    $dbquery      = $wpdb -> prepare( "SELECT `booked_date` FROM `sa_booked_dates` WHERE `booking_id` = %d ", $booking_id ) ;
		$sabk_booked  = $wpdb -> get_col( $dbquery ) ;

    $removals     = array_diff( $sabk_booked, $dates_arr ) ;
    // A date has been added so we need to reverse the array_diff args
    $additions    = array_diff( $dates_arr, $sabk_booked, [""] ) ;
    // var_dump( ($additions));
    foreach ( $removals as $date ) {
      $wpdb -> delete( $sa_dates, array( 'booking_id' => $booking_id, 'booked_date' => $date ) );
    }

    if ( count( $additions ) >= 1 ) {
      foreach ( $additions as $date ) {
        $wpdb -> insert( $sa_dates, array( 'booking_id' => $booking_id, 'service_id' => $service_id, 'service_name' => $service_name, 'booked_date' => $date ) ) ;
      }
    }

    $notif = 'Your Booking Has Been Updated' ;

    // All dates removed and no new ones added so delete the actual booking entry
    if ( $removals == $sabk_booked && count( $additions ) == 0 ) {
      $wpdb -> delete( $sa_bookings, array( 'booking_id' => $booking_id ) );

      $notif = 'Your Booking Has Been Removed' ;
    }

  } else {
    
    // Its a new booking

    // Get all currently booked dates
    $query_booked       = $wpdb -> prepare( "SELECT booked_date FROM sa_booked_dates WHERE service_id = %d", $service_id  ) ;
    $sa_booked_dates    = $wpdb -> get_col( $query_booked ) ; // Array of booked times in unix format

    if ( array_intersect( $dates_arr, $sa_booked_dates ) ) {
      // One or more of the requested dates has been booked since the booking form first loaded at the user end
      $notif = 'Some selected dates are no longer available. Please try again.' ;

    } else {

      $wpdb -> insert( $sa_bookings, array( 'booking_id' => NULL, 'service_id' => $service_id, 'service_name' => $service_name, 'email' => $email ) ) ;

      $lastid = $wpdb -> insert_id ;

      foreach ( $dates_arr as $date ) {

        $wpdb -> insert( $sa_dates, array( 'booking_id' => $lastid, 'service_id' => $service_id, 'service_name' => $service_name, 'booked_date' => $date ) ) ;

      }

      $notif = 'Your Booking Has Been Created' ;

    }
   
  } ;

  $refer  = wp_get_referer() ;
  $refer  = strtok( $refer, '?' ) ;
  if ( $refer ) {
    wp_safe_redirect( $refer . '?notif='.$notif  );
  } else {
    wp_safe_redirect( get_home_url() );
  }


}
