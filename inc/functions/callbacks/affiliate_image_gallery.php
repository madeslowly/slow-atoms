<?php

function affiliate_image_gallery( $atts = array( ) ) {

    $setting_id = 'affiliate_image_gallery';
    $ids_array = get_theme_mod( $setting_id );
    
    if ( is_array( $ids_array ) && ! empty( $ids_array ) ) {

        foreach( $ids_array as $id ) {

            echo wp_get_attachment_image( $id, array(), "", array( "class" => "affiliate_image gallery-item", "size" => "full" ) ) ;
        }

        // var_dump( ($ids_array) ) ;
        // $atts[ 'ids' ] = implode( ',', $ids_array ) ;
        // echo gallery_shortcode( $atts );
    }
}
