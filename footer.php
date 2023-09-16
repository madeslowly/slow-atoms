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
if ( ! defined( 'ABSPATH' ) ) {	exit; }

?>

<footer class="slow-atoms__footer">

	<div class="footer__body">

		<div class="footer__useful-links">
			<h5 class="footer__title">Useful Links</h5>

			<div class="footer__links">
			
				<?php // TODO: Check if it exists first
					wp_nav_menu( array(
						'theme_location'	=> 'useful-links',
						'menu_class'		=> 'footer--list',
					) );
				?>

			</div><!-- .footer__links -->

		</div><!-- .footer__useful-links -->

		<div class="affiliate_image_gallery">
	<?php
						
// Get authors from ACF

//$ms_acf_affiliate_list =  get_field('ms_acf_affiliate_list') ;

$cnt = 1 ;

$ms_acf_affiliate_list_array = array() ;
$home_page_ID		=	get_option( 'page_on_front' ) ;

while( $cnt <= 999 ):

	$affiliate = 'ms_acf_affiliates_list_' . $cnt . '_key';

	$affiliate_image_ID = get_field( $affiliate, $home_page_ID )['ms_acf_affiliate_image_name'] ;
	$affiliate_url = get_field( $affiliate, $home_page_ID )['ms_acf_affiliates_url_name'] ;

	if ( empty( $affiliate_url ) ) :

		// if we have reached the last author, break
		
		break ;

	else :

		$image_class = 'affiliate_image affiliate_' .$cnt ;
		$affiliate_image_srcset	=	wp_get_attachment_image_srcset( $affiliate_image_ID , 'full' );
		$affiliate_image_url		=	wp_get_attachment_image_src( $affiliate_image_ID )[ 0 ] ;


		// echo $affiliate_url ;
		// echo $affiliate_logo ;

		$markup = '<a href="https://' . $affiliate_url . '" target="blank"><img class="' . $image_class . '" loading="lazy" src="' . $affiliate_image_url . '" srcset="' . esc_attr( $affiliate_image_srcset ) . '" /></a>' ;

		echo $markup ;

		$cnt++;

	endif ;

endwhile;



?>

		</div>

	</div><!-- .footer__body -->

	<div class="site-info">

		<?php
		$site_info =	'<p>&copy; ' . get_bloginfo( 'name' ) . ' ' . date("Y") . '</p>' ;

		if ( WPCF7_RECAPTCHA::get_instance() -> is_active() ) {
			$site_info .= '<p>Protected by <a href="https://www.google.com/recaptcha/intro/v3.html?ref=techmoon">reCAPTCHA v3</a>.</p>'; 
		}
		
		$my_theme		= wp_get_theme( ) ;
		$my_theme_URL	= $my_theme -> get( 'ThemeURI' ) ;
		$site_info .=	'<p><a href="' . $my_theme_URL . '">' . wp_get_theme() . '</a></p>' ;

		echo $site_info ;
		?>
	
	</div><!-- .site-info -->

</footer><!-- .slow-atoms__footer -->

</div><!-- #page .site -->

<?php wp_footer(); ?>

</body>
</html>
