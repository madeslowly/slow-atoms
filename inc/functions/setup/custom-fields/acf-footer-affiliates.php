<?php

/**
 * 
 * Register ACF for footer affiliates
 * 
 * We will use this to allow the user to select the logos of their affiliated groups when editing the home page.
 * TODO: This needs to be more centralised and nopt attached to any page, but i dont know how
 */
// Set up instruction field
$ms_acf_affiliates_instructions	=	array(
	'key'				=>	'ms_acf_affiliates_instructions',
	'label'				=>	'Instruction',
	'name'				=>	'instruction',
	'type'				=>	'message',
	'instructions'		=>	'',
	'required'			=>	0,
	'conditional_logic'	=>	0,
	'wrapper'			=>	array(
		'width'	=>	'100',
		'class'	=>	'',
		'id'	=>	'',
	),
	'message'			=>	'Select images of affiliated groups and organisations to display on your websites footer. Avoid images of people or collages.',
	'new_lines'			=>	'',
	'esc_html'			=>	0,
);

// Generate list of arrays for image fields

$ms_acf_pub_max_affiliates = 20 ;

for ( $i = 1 ; $i <= $ms_acf_pub_max_affiliates ; $i++ ) {

    if ( $i != 1 ) :

        $required = 0 ;

        $callback_i = $i - 1 ;

        $conditional_logic = array( array( array(
            'field'     => 'ms_acf_affiliate_list_' . $callback_i . '_add_key',
            'operator'  => '==',
            'value'     => '1',
        ) , ) , ) ;
    
    else : 

        $required = 1 ;

        $conditional_logic = 0 ;
    
    endif ;

    if ( $i != $ms_acf_pub_max_auhtors ) :

        $add_affiliate = array(
            'key'           => 'ms_acf_affiliate_list_' . $i . '_add_key',
            'label'         => 'Add Another',
            'name'          => 'ms_acf_affiliate_list_add',
            'type'          => 'true_false',
            'instructions'  => '',
            'required'      => 0,
            'conditional_logic' => 0,
            'wrapper'       => array(
                'width' => '',
                'class' => '',
                'id'    => '',
            ) ,
            'message'       => '',
            'default_value' => 0,
            'ui'            => 1,
            'ui_on_text'    => '',
            'ui_off_text'   => '',
        ) ;

        else :

            $add_affiliate = NULL ;

        endif ;

	$ms_acf_affiliates_images[] =	array(
        'key'               => 'ms_acf_affiliates_list_' . $i . '_key',
        'label'             => 'Affiliate ' . $i ,
        'name'              => 'affiliate_' . $i ,
        'type'              => 'group',
        'instructions'      => '',
        'required'          => 0,
        'conditional_logic' => $conditional_logic,
        'wrapper'           => array(
            'width' => '50',
            'class' => '',
            'id'    => '',
        ) ,
        'layout' => 'block',
        'sub_fields' => 
        array(
            array(
                'key'				=>	'ms_acf_affiliate_image_key',
                'label'				=>	'Logo',
                'name'				=>	'ms_acf_affiliate_image_name',
                'type'				=>	'image',
                'instructions'		=>	'',
                'required'			=>	0,
                'conditional_logic'	=>	0,
                'wrapper'			=> array(
                    'width'	=>	'',
                    'class'	=>	'',
                    'id'	=>	'',
                ),
                'return_format'		=>	'id',
                'preview_size'		=>	'thumbnail',
                'library'			=>	'all',
                'min_width'			=>	'',
                'min_height'		=>	'',
                'min_size'			=>	'',
                'max_width'			=>	'',
                'max_height'		=>	'',
                'max_size'			=>	'',
                'mime_types'		=>	'',
            ), 
            array(
                'key'               => 'ms_acf_affiliates_url_key',
                'label'             => 'Website URL',
                'name'              => 'ms_acf_affiliates_url_name',
                'type'              => 'text',
                'instructions'      => '',
                'required'          => 0,
                'conditional_logic' => 0,
                'wrapper'           => array(
                    'width' => '',
                    'class' => '',
                    'id'    => '',
                ) ,
                'default_value'         => '',
                'placeholder'           => 'www.example.com',
                'prepend'               => 'https://',
                'append'                => '',
                'maxlength'             => '',
                ), 
            
            $add_affiliate
        )
    ) ;
}

// Insert instruction field at front
// NOTE: is this any different to array_merge($ms_acf_affiliates_instructions , $ms_acf_affiliates_fields)
array_unshift( $ms_acf_affiliates_images , $ms_acf_affiliates_instructions ) ;

acf_add_local_field_group( array(
	'key'		=> 'ms_acf_affiliates_group',
	'title'		=> 'Affiliates Images',
	'fields'	=> $ms_acf_affiliates_images,
	'location'	=> array(
		array(
			array(
				'param'		=>	'post_type',
				'operator'	=>	'==',
				'value'		=>	'page',
			),
		),
	),
	'menu_order'			=>	999, // Always the last
	'position'				=>	'normal',
	'style'					=>	'seamless',
	'label_placement'		=>	'top',
	'instruction_placement'	=>	'label',
	'hide_on_screen'		=>	'',
	'active'				=>	true,
	'description'			=>	'Select images to be randomly displayed on the homepage.',
	'show_in_rest'			=>	1,
));