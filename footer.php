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
wp_nav_menu( array(
	'theme_location'	=> 'useful-links',
	'menu_class'		=> 'footer--list',
) );
?>
</div><!-- .footer__links -->

</div><!-- .footer__useful-links -->

</div><!-- .footer__body -->

<div class="site-info">
<p>&copy; <?php echo get_bloginfo( 'name' ) . ' ' . date("Y"); ?></p>
<?php if ( WPCF7_RECAPTCHA::get_instance() -> is_active() ) {echo '<p>Protected by reCAPTCHA.</p>';} ?>
</div><!-- .site-info -->

</footer><!-- .slow-atoms__footer -->

</div><!-- #page .site -->

<?php wp_footer(); ?>

</body>
</html>
