<?php

//* Function to convert Hex colors to RGBA
function hex2rgba( $color, $opacity = false ) {

    $defaultColor = 'rgb(0,0,0)';

    // Return default color if no color provided
    if ( empty( $color ) ) {
        return $defaultColor;
    }

    // Ignore "#" if provided
    if ( $color[0] == '#' ) {
        $color = substr( $color, 1 );
    }

    // Check if color has 6 or 3 characters, get values
    if ( strlen($color) == 6 ) {
        $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    } elseif ( strlen( $color ) == 3 ) {
        $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
    } else {
        return $default;
    }

    // Convert hex values to rgb values
    $rgb =  array_map( 'hexdec', $hex );

    // Check if opacity is set(rgba or rgb)
    if ( $opacity ) {
        if( abs( $opacity ) > 1 ) {
            $opacity = 1.0;
        }
        $output = 'rgba(' . implode( ",", $rgb ) . ',' . $opacity . ')';
    } else {
        $output = 'rgb(' . implode( ",", $rgb ) . ')';
    }

    // Return rgb(a) color string
    return $output;

}

/*
 * Example Usage:
 * $mycolor = '#ff0000';
 * $rgb = hex2rgba($mycolor);
 * $rgba = hex2rgba($mycolor, 0.5);
 */

function colourBrightness($hex, $percent)
{
    // Work out if hash given
    $hash = '';
    if (stristr($hex, '#')) {
        $hex = str_replace('#', '', $hex);
        $hash = '#';
    }
    /// HEX TO RGB
    $rgb = [hexdec(substr($hex, 0, 2)), hexdec(substr($hex, 2, 2)), hexdec(substr($hex, 4, 2))];
    //// CALCULATE
    for ($i = 0; $i < 3; $i++) {
        // See if brighter or darker
        if ($percent > 0) {
            // Lighter
            $rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1 - $percent));
        } else {
            // Darker
            $positivePercent = $percent - ($percent * 2);
            $rgb[$i] = round($rgb[$i] * (1 - $positivePercent)); // round($rgb[$i] * (1-$positivePercent));
        }
        // In case rounding up causes us to go to 256
        if ($rgb[$i] > 255) {
            $rgb[$i] = 255;
        }
    }
    //// RBG to Hex
    $hex = '';
    for ($i = 0; $i < 3; $i++) {
        // Convert the decimal digit to hex
        $hexDigit = dechex($rgb[$i]);
        // Add a leading zero if necessary
        if (strlen($hexDigit) == 1) {
            $hexDigit = "0" . $hexDigit;
        }
        // Append to the hex string
        $hex .= $hexDigit;
    }
    return $hash . $hex;
}


// Convert hex to hsl and rotate by 180
function slow_atoms_180_hue_rot( $hex ) {

    $red    = hexdec( substr( $hex, 0, 2 ) ) / 255;
    $green  = hexdec( substr( $hex, 2, 2 ) ) / 255;
    $blue	= hexdec( substr( $hex, 4, 2 ) ) / 255;

    $cmin   = min($red, $green, $blue);
    $cmax   = max($red, $green, $blue);
    $delta  = $cmax - $cmin;

    if ( $delta === 0 ) {
        $hue = 0;
    } elseif ( $cmax === $red ) {
        $hue = ( ( $green - $blue ) / $delta ) % 6;
    } elseif ( $cmax === $green ) {
        $hue = ( $blue - $red ) / $delta + 2;
    } else {
        $hue = ( $red - $green ) / $delta + 4;
    }

		$hue = round( $hue * 60 );

		if ( $hue < 0 ) {
        $hue += 360;
    }
		$hue += 180 ;

		if ( $hue > 360 ){
			$hue -= 360;
		}

    $lightness = (($cmax + $cmin) / 2);
    $saturation = $delta === 0 ? 0 : ($delta / (1 - abs(2 * $lightness - 1)));
    if ($saturation < 0) {
        $saturation += 1;
    }

    $lightness = round($lightness  * 100);
    $saturation = round($saturation  * 100);

    return array( $hue, $saturation, $lightness );
}
