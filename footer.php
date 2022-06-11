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

<footer class="sa__footer">

	<div class="footer__naviagtion">
		<div class="useful-links">
			<h3>Useful Links</h3>
			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'useful-links',
						'container_class' => 'footer__menu--highlight'
					)
				);
			?>
		</div>

	</div>

	<div class="site-info">
		<p>&copy; <?php echo get_bloginfo( 'name' ); ?> <?php echo date("Y"); ?> </p>

		<p><?php printf( esc_html__( '%1$s by %2$s.', 'slow-atoms' ), '<a href="https://github.com/madeslowly/slow-atoms">Slow Atoms Theme</a>', '<a href="http://madeslowly.co.uk">Me</a>' ); ?>
		</p>

	</div><!-- .site-info -->
</footer><!-- .sa__footer -->


<?php wp_footer(); ?>


<script>

	AOS.init({
	duration: 600,
	easing: 'ease-in-out-cubic',
	disable: 'mobile'
	});

</script>

</body>
</html>
