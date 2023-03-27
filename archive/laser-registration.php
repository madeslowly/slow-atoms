<?php
/**
 * Template Name: Laser Registration
 */
get_header();


?>

<form action="#" method="POST" class="">
	<?php wp_nonce_field( 'donate', 'kitty-check' ); ?>

	<div>
		<label for="don"><?php _e( 'Amount donation' ); ?></label>
		<input id="don" type="number" name="don" value="5" />
	</div>

	<input id="submit" type="submit" name="pot-donation-sending" id="submit" class="submit" value="<?php esc_attr_e( 'Submit', 'msk' ); ?>" />
</form>

<?php get_footer();