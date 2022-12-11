<?php
/**
* The template for displaying the footer
*
* Contains the closing of the #content div and all content after.
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package slow-atoms
*/

?>

<footer class="slow-atoms__footer">

	<div class="footer__body">

		<div class="footer__useful-links">
			<h5 class="footer__title">Useful Links</h5>
			<div class="footer__links">

				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'useful-links'
						)
					);
				?>
			</div>
		</div>

	</div>

	<div class="site-info">
		<p>&copy; <?php echo get_bloginfo( 'name' ); ?> <?php echo date("Y"); ?>
		</p>
		<?php
			$recaptcha = WPCF7_RECAPTCHA::get_instance();
			if ($recaptcha->is_active()) :
				echo '<p>Protected by reCAPTCHA.</p>';
			endif ; ?>


	</div><!-- .site-info -->
</footer><!-- .slow-atoms__footer -->


<?php wp_footer(); ?>


<script>
	AOS.init({
	duration: 600,
	easing: 'ease-in-sine',
	disable: 'mobile'
	});
</script>

<script>
	setTimeout( function() {
		document.querySelector( '#masthead' ).classList.remove( 'no-anim' ) ;
	} , 600 ) ;
</script>

</body>
</html>
