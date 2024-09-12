<?php
/**
 * 
 * Booking form that reads and writes to db
 * See; 
 * inc/functions/activation/register-sabk-tables.php for tables
 * inc/functions/hooks/process-booking.php for booking records
 * 
 *
 * @package slow_atoms
 * @since 0.0.0
 * 
 */

 function slow_atoms_equipment_booking_form( $service_post, $current_user ) {

	global $wpdb ;

	$booking_period	= 84 ; // 3 months
	// Get service id and name based on post id
	$service_id		= $service_post -> ID ;
	$service_name	= $service_post -> post_title ;
	// Get user email and name
	$current_user_email = $current_user -> user_email ;
	$current_user_name = $current_user ? $current_user->first_name . ' ' . $current_user->last_name : '';

	// Fallback if user hasn't set first_name and last_name
	if ( ! $current_user_name ) { 
		$current_user_name = $current_user -> user_login ; 
	}
	// Get current time and time at midnight
	$current_datetime   = current_datetime();
	$current_time       = $current_datetime -> getTimestamp() ;
	$time_at_midnight   = $current_time - ( $current_time % 86400 ) - $current_datetime -> getOffset() ;
	
	/**
	 * sa_booked_dates table Queries
	 */
	
	// Get all existing bookings for this service_id from both tables
	$sql_query = $wpdb -> prepare(
		"SELECT sa_booked_dates.*, sa_bookings.email
		FROM sa_booked_dates
		INNER JOIN sa_bookings 
		ON sa_booked_dates.booking_id = sa_bookings.booking_id
		WHERE sa_bookings.service_id = %d", $service_id );

	$sa_booked_dates = $wpdb -> get_results( $sql_query ) ;

	$sql_query  = $wpdb -> prepare( 
		"SELECT *
		FROM sa_bookings
		WHERE `service_id` = %d", $service_id) ;

	$sa_bookings = $wpdb -> get_results( $sql_query ) ;

	// Check for booked dates that are in the past and delete them
	foreach ( $sa_booked_dates as $booking ) {
		if ( $time_at_midnight > $booking -> booked_date ) {
			$wpdb->delete( 'sa_booked_dates', array( 'booked_date' => $booking -> booked_date, 'service_id' => $service_id ) );
	} }

	// For each booking check if there are still dates in the sa_booked_dates table
	foreach( $sa_bookings as $booking ) {
		$booking_id_exists = false ;
		foreach ( $sa_booked_dates as $date ) {
			if ( $date -> booking_id === $booking -> booking_id ) {
				$booking_id_exists = true ;
				// The booking has a date so break
				break ;
		} }
		// Delete the booking if it has no dates
		if ( ! $booking_id_exists ) {
			$wpdb -> delete( 'sa_bookings', array( 'booking_id' => $booking -> booking_id ) );
		} }
	
	// Format current booked dates for flatpickr. Array -> string "time", "time2" etc
	$flatpickr_booked_dates = "";
	foreach ( $sa_booked_dates as $booking ) {
		$flatpickr_booked_dates .= '"' . $booking -> booked_date . '", ';
	}
	$flatpickr_booked_dates = rtrim($flatpickr_booked_dates, ', ');
	
	// Get all booking IDs for the current user
	$users_bookings = array();
	foreach ($sa_bookings as $booking) {
		if ($booking->email === $current_user_email) {
			$users_bookings[] = $booking->booking_id;
	} }
	
	?>
	
	<h2>Bookings for <?php echo $service_name ; ?></h2>

	<?php
	if ( ! empty( $sa_booked_dates ) ) {
		$markup = '<h4>Booked Dates</h4>' ;
		$markup .= '<div class="table-container">' ;
		$markup .= '<table><tr><th>Date</th><th>User</th></tr>';
				
		// Sort the result array by booked_date in ascending order
		usort($sa_booked_dates, function($a, $b) {
			return $a->booked_date - $b->booked_date;
		});

		// Output data of each row
		foreach ( $sa_booked_dates as $row ) {
			$date		= date("D d M", esc_html( $row -> booked_date + ( get_option( 'gmt_offset' ) * 3600 ) ) ) ;
			$email		= esc_html( $row -> email ) ;
			$user		= get_user_by( 'email', $email ) ;
			$full_name	= $user ? $user->first_name . ' ' . $user->last_name : '';
			
			$markup .= "<tr><td>$date</td><td><a href='mailto:$email?subject=Your $service_name Booking - $date'>$full_name</a></td></tr>";
		}				
		$markup .= '</table></div>' ;

		echo $markup ;
	}
	?>

	<!-- New Booking Form -->
	<form class="sa__form" id="booking_form" name="form" method="POST" action="<?php echo admin_url( 'admin-post.php' ); ?>" >
	
		<h4>New Booking</h4>

		<p>Hi <?php echo $current_user_name ?>, select the date(s) you want to book.</p>
		<p class="small">Greyed out dates are booked or fall outside of the maximum booking period. If another user books your chosen date before you finish, you will be returned here with an updated list of available dates.</p>

		<input type="hidden" name="action" value="process_booking" />

		<input type="hidden" name="sabk-service-id" value="<?php echo $service_id ; ?>" />

		<input type="hidden" name="sabk-service-name" value="<?php echo $service_name ; ?>" />

		<input type="hidden" id="email" name="sabk-email" pattern=".+@ru\.nl" value="<?php echo $current_user_email ?>" required>

		<input type="text" id="sabk-dates" name="sabk-dates" placeholder="Select dates" required>

		<input type="submit" value="Submit" class="slow-atoms__button">

	</form>

	<script>
		flatpickr("#sabk-dates", {
			minDate: "today",
			maxDate: new Date().fp_incr(<?php echo $booking_period ; ?>),
			mode: "multiple",
			enableTime: false,
			altInput: true,
			altFormat: "D j F, Y",
			dateFormat: "U",
			theme: "default",
			disable: [<?php echo $flatpickr_booked_dates ; ?>],
		});
		// Check if dates are selected before submitting the form
		document.getElementById('booking_form').addEventListener('submit', function(event) {
			var datesField = document.getElementById('sabk-dates');
			if (!datesField.value) {
				event.preventDefault();
			alert('Please select at least one date before submitting the form.');
		}});
	</script>

	<?php
	if ( $users_bookings ) {
		$current_bookings_title	= 'Your Current Bookings' ;
		$current_bookings_inst	= 'Your bookings are listed below. You can select an existing booking and add or remove dates for that booking then click "Update" to complete the change.' ;
		echo '<h4>' . $current_bookings_title . '</h4>' ;
		echo '<p>' . $current_bookings_inst . '</p>' ;
		foreach ( $users_bookings as $sabk_id ) {

			// Get dates of current booking
			$dbquery     = $wpdb -> prepare( "SELECT `booked_date` FROM `sa_booked_dates` WHERE `booking_id` = %d AND `service_id` = %d", $sabk_id, $service_id ) ;
			$sabk_booked = $wpdb -> get_col( $dbquery ) ;
			
			$sabk_booked = '"' . implode ( '", "', $sabk_booked ) . '"' ;
			
			$sabk_bk_other = str_replace($sabk_booked , "",  $flatpickr_booked_dates);
			?>
			<div class="booking_accordion" value="<?php echo $sabk_id ?>" >
				<p><?php echo $service_name . ' booking #' . $sabk_id ; ?></p>
			</div>
			<div class="booking_wrap" id="div-<?php echo $sabk_id ?>" >
				<form class="sa__form booking_update" name="form-<?php echo $sabk_id ?>" method="POST" action="<?php echo admin_url( 'admin-post.php' ); ?>">
					<input type="hidden" name="action" value="process_booking" />
					<input hidden type="number" name="sabk-service-id" value="<?php echo $service_id ; ?>" />
					<input hidden type="text" name="sabk-service-name" value="<?php echo $service_name ; ?>" />
					<input hidden type="number" name="sabk-booking-id" value="<?php echo $sabk_id ?>" />
					<input hidden type="email" id="email<?php echo $sabk_id ?>" name="sabk-email" pattern=".+@ru\.nl" size="30" required value="<?php echo $current_user_email ?>">
					<input type="text" id="sabk-dates-<?php echo $sabk_id ?>" name="sabk-dates" >
					<input type="submit" value="Update" class="slow-atoms__button">
				</form>
			</div>
			<script>
				flatpickr("#sabk-dates-<?php echo $sabk_id ?>", {
					minDate: "today",
					maxDate: new Date().fp_incr(84),
					mode: "multiple",
					enableTime: false,
					inline: true,
					altInput: true,
					altFormat: "D j F, Y",
					dateFormat: "U",
					theme: "dark",
					disable: [<?php echo $sabk_bk_other ?>],
					defaultDate: [<?php echo $sabk_booked ?>]
				});
			</script>
		<?php
		}
		?>
		<script>
			var acc = document.getElementsByClassName( "booking_accordion" ) ;
			var i ;

			for ( i = 0; i < acc.length; i++ ) {
				acc[ i ].addEventListener( "click", function() {
					/* Toggle between adding and removing the "active" class,
					to highlight the button that controls the panel */
					
					this.classList.toggle("active");

					var divs = document.getElementsByClassName('booking_wrap');
					for(var i=0; i < divs.length; i++) { 
					divs[i].style.maxHeight = '0';
					}
					/* Toggle between hiding and showing the active panel */
					var booking_wrap = this.nextElementSibling;
					if ( booking_wrap.style.maxHeight === "1000px" ) {
						booking_wrap.style.maxHeight = "0";
					} else {
						booking_wrap.style.maxHeight = "1000px";
					}
				});
			}
		</script>

	<?php
	}

	// Notification popup
	if (isset($_GET['notif']) && !empty($_GET['notif'])) {
		$notif = $_GET['notif'] ;
		$notif_popup = '
		<input id="modal-toggle" type="checkbox">
		<div class="notif__screen">
			<div class="notif__wrap">
				<h4 class="notif__text">' . $notif . '</h4>
				<label class="modal-content-btn" for="modal-toggle">OK</label>
			</div>
		</div>' ;
		echo $notif_popup ;
	}

}