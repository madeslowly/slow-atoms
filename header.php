<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package slow_atoms
 */

?>
<!doctype html>
	<html <?php language_attributes(); ?> >

		<head>
			<meta charset="<?php bloginfo('charset'); ?>">
			<meta name="viewport" content="width=device-width, initial-scale=1">

			<link rel="profile" href="https://gmpg.org/xfn/11">

			<?php wp_head(); ?>
		</head>

		<body <?php body_class(); ?> >

			<?php wp_body_open(); ?>

			<div id="page" class="site">

				<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'slow-atoms'); ?></a>

				<header id="masthead" class="site-header

				<?php
					/*
			     * If we pass a new class from a template with get_header('' , array( 'append_site-header_class' => 'new-class' )); check it exists then append to menu_class
			     */

					if ($args['append_site-header_class']) :
						$new_menu_class = ' ' . $args['append_site-header_class'];
						echo $new_menu_class ;
					endif;
				?>
				"

				<?php if ( is_user_logged_in() ) : ?>
					style="top:32px;"
				<?php endif ; ?>
				>
				<div class="site-branding">
					<?php the_custom_logo();

					if (is_front_page() && is_home()) : ?>

					<h1 class="site-title"><?php bloginfo('name'); ?></h1>
					<?php else : ?>
						<p class="site-title"><?php bloginfo('name'); ?></p>
					<?php endif ;

					$slow_atoms_description = get_bloginfo('description', 'display');

					if ($slow_atoms_description || is_customize_preview()) : ?>

					<p class="site-description"><?php echo $slow_atoms_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped?></p>
						<?php endif; ?>
					</div><!-- .site-branding -->

					<nav id="site-navigation" class="main-navigation">
						<?php

			            wp_nav_menu(
			                array(
			                    'menu'					=> '4',
			                    'menu_id'       => 'primary-menu',
			                    'menu_class'    => 'navbar--list' . $new_menu_class,
			                    'walker' => new submenu_wrap(),
			            )
			            ) ; ?>

						<div class="burger">
							<div class="burger-line-1"></div>
							<div class="burger-line-2"></div>
							<div class="burger-line-3"></div>
						</div>

					</nav><!-- #site-navigation -->
				</header><!-- #masthead -->
