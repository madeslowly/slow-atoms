<?php

/**
 *
 * Enable Google Analytics
 * https://developers.google.com/analytics
 * 
 * @package slow_atoms
 *
 */ 

add_action('slow_atoms_head_top', 'slow_atoms_gtag') ;

function slow_atoms_gtag() {
	// TODO: Markup needs testing on live server
	$gtag = get_theme_mod('slow_atoms_gtag_setting'); 

	if ($gtag) :

		$gtag_script  = '<script async src="' . 'https://www.googletagmanager.com/gtag/js?id=' . $gtag . '"></script>' ;
		$gtag_script .= '<script>' ;
			$gtag_script .= 'window.dataLayer = window.dataLayer || [];' ;
			$gtag_script .= 'function gtag(){dataLayer.push(arguments);}' ;
			$gtag_script .= 'gtag("js", new Date()); gtag("config", "' . $gtag . '");' ;
		$gtag_script .=	'</script>';

		echo $gtag_script ;

	endif ;
}

// Add noscript Google Tag code after opening body tag.
add_action( 'wp_body_open', 'slow_atoms_gtag_nonscript' );

function slow_atoms_gtag_nonscript() {
	
	$gtag = get_theme_mod( 'slow_atoms_gtag_setting'); 

	if ($gtag) :

		$gtag_noscript = '<!-- Google Tag Manager (noscript) --><noscript><iframe src="https://www.googletagmanager.com/ns.html?id=' . $gtag . '; height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript><!-- End Google Tag Manager (noscript) -->';
		
		echo $gtag_noscript ;

	endif ;
}