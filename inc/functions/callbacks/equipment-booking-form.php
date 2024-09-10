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

	$booking_period	= 84 ; // 3 months
	
	$service_id		= $service_post -> ID ;
	$service_name	= $service_post -> post_title ;

	global $wpdb ;
	
	$all_bookings_sql = $wpdb -> prepare(
		"SELECT booked_date, email 
		FROM sa_booked_dates 
		JOIN sa_bookings ON sa_booked_dates.booking_id = sa_bookings.booking_id
		WHERE sa_bookings.service_id = $service_id");
	$all_bookings = $wpdb -> get_results( $all_bookings_sql ) ;
	
	// Get user email and name
	$current_user_email = $current_user -> user_email ;
	$current_user_name  = get_user_meta( $current_user -> ID, 'first_name', true ) ;

	// Fallback if user hasn't set first_name
	if ( ! $current_user_name ) { 
		$current_user_name = $current_user -> user_login ; 
	}

	$current_datetime   = current_datetime();
	$current_time       = $current_datetime -> getTimestamp() ;
	$time_at_midnight   = $current_time - ( $current_time % 86400 ) - $current_datetime -> getOffset() ;
	
	// Get booked dates
	$query_booked       = $wpdb -> prepare( "SELECT booked_date FROM sa_booked_dates" ) ;
	$sa_booked_dates    = $wpdb -> get_col( $query_booked ) ; // Array of booked times in unix format
	
	/**
	 * 
	 * Check for old bookings and cleanup db
	 * 
	 */

	// Check if date is in the past and delete that db entry if it is
	foreach ( $sa_booked_dates as $booked_date ) {
		if ( $time_at_midnight > $booked_date ) {
			$wpdb -> delete( 'sa_booked_dates', array( 'booked_date' => $booked_date ) );
			echo $booked_date ;
		}
	}

	$query_booked_id    = $wpdb -> prepare( "SELECT booking_id FROM sa_booked_dates" ) ;
	$sa_booked_dates_id	= $wpdb -> get_col( $query_booked_id ) ;

	$query_bookings_id  = $wpdb -> prepare( "SELECT booking_id FROM sa_bookings" ) ;
	$sa_bookings_id		= $wpdb -> get_col( $query_bookings_id ) ;

	foreach( $sa_bookings_id as $id ) {

		$booking_id_exits = array_search( $id, $sa_booked_dates_id ) ;

		if ( $booking_id_exits === false ) {
			$wpdb -> delete( 'sa_bookings', array( 'booking_id' => $id ) );
		}
		
	}

	// Format for flatpickr. Array -> string "time", "time2" etc
	$sa_booked_dates        = '"' . implode ( '", "', $sa_booked_dates ) . '"' ;

	// Get all bookings from current user
	$dbquery            = $wpdb -> prepare( "SELECT * FROM `sa_bookings` WHERE `email` = %s ", $current_user_email ) ;
	$sabk_user_bk_ids   = $wpdb -> get_col( $dbquery ) ;
	
	?>
	
	<form class="sa__form" id="booking_form" name="form" method="POST" action="<?php echo admin_url( 'admin-post.php' ); ?>" >
	
		<h2>Bookings for <?php echo $service_name ; ?></h2>

		<?php
		if (!empty($all_bookings)) {
		
			$markup = '<h4>Booked Dates</h4>';
			$markup .= '<div class="table-container">' ;
			$markup .= '<table><tr><th>Date</th><th>User</th></tr>';

			echo $markup ;
					
			// Sort the result array by booked_date in ascending order
			usort($all_bookings, function($a, $b) {
				return $a->booked_date - $b->booked_date;
			});

			// Output data of each row
			foreach ($all_bookings as $row) {
				$date = date("D d-M", esc_html($row->booked_date));
				$email = esc_html($row->email);
				$user = get_user_by('email', $email);
				$full_name = $user ? $user->first_name . ' ' . $user->last_name : '';
				echo "<tr><td>$date</td><td><a href='mailto:$email?subject=Your $service_name Booking - $date'>$full_name</a></td></tr>";
			}
					
			echo '</table></div>' ;
		}
		?>
		<h4>New Booking</h4>

		<p>Hi <?php echo $current_user_name ?>, select the date(s) you want to book.</p>
		<p class="small">Greyed out dates are already booked or fall outside of the maximum booking period (<?php echo $booking_period ; ?> days from today). If another user books your chosen date before you finish, you will be returned here with an updated list of available dates.</p>

		<input type="hidden" name="action" value="process_booking" />

		<input type="hidden" name="sabk-service-id" value="<?php echo $service_id ; ?>" />

		<input type="hidden" name="sabk-service-name" value="<?php echo $service_name ; ?>" />

		<input type="hidden" id="email" name="sabk-email" pattern=".+@ru\.nl" value="<?php echo $current_user_email ?>" required>

		<input type="text" id="sabk-dates" name="sabk-dates" placeholder="Select dates">

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
			disable: [<?php echo $sa_booked_dates ; ?>],
			// onChange: function( selectedDates, dateStr, instance ) {
			//     console.log( dateStr ) ;
			// },
		});
	</script>

	<?php
	if ( $sabk_user_bk_ids ) {
		$current_bookings_title	= 'Your Current Bookings' ;
		$current_bookings_inst	= 'Your bookings are listed below. You can select an existing booking and add or remove dates for that booking then click "Update" to complete the change.' ;
		echo '<h4>' . $current_bookings_title . '</h4>' ;
		echo '<p>' . $current_bookings_inst . '</p>' ;
		foreach ( $sabk_user_bk_ids as $sabk_id ) {

			// Get dates of current booking
			$dbquery     = $wpdb -> prepare( "SELECT `booked_date` FROM `sa_booked_dates` WHERE `booking_id` = %d ", $sabk_id ) ;
			$sabk_booked = $wpdb -> get_col( $dbquery ) ;
			
			$sabk_booked = '"' . implode ( '", "', $sabk_booked ) . '"' ;
			
			$sabk_bk_other = str_replace($sabk_booked , "",  $sa_booked_dates);
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

	// $notif = $_GET['notif'] ;

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