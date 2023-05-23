<?php

/**
 * 
 * Register ACF equipment details used to build the equipment posts.
 * 
 */

// Build up array args

for ( $i = 1 ; $i <= 4 ; $i++ ) {

    $ms_acf_equip_images_args[] = array(
        'key'               => 'ms_acf_equip_image_' . $i . '_key',
        'label'             => 'Image ' . $i,
        'name'              => 'image_' . $i,
        'aria-label'        => '',
        'type'              => 'image',
        'instructions'      => '',
        'required'          => 0,
        'conditional_logic' => 0,
        'wrapper'           => array(
            'width' => '25',
            'class' => '',
            'id'    => '',
        ),
        'return_format'     => 'url',
        'library'           => 'all',
        'min_width'         => '',
        'min_height'        => '',
        'min_size'          => '',
        'max_width'         => '',
        'max_height'        => '',
        'max_size'          => '',
        'mime_types'        => '',
        'preview_size'      => 'medium',
    ) ;

    $ms_acf_equip_docs_args[] = array(
        'key'               => 'ms_acf_equip_doc_' . $i . '_key',
        'label'             => 'Doc ' . $i,
        'name'              => 'doc_' . $i,
        'aria-label'        => '',
        'type'              => 'file',
        'instructions'      => '',
        'required'          => 0,
        'conditional_logic' => 0,
        'wrapper'           => array(
            'width' => '25',
            'class' => '',
            'id'    => '',
        ),
        'return_format'     => 'url',
        'library'           => 'all',
        'min_size'          => '',
        'max_size'          => '',
        'mime_types'        => 'pdf',
    ) ;
}

acf_add_local_field_group( array(
    'key'                   => 'ms_acf_equip_group',
    'title'                 => 'Equipment',
    'fields'                => array(
        array(
            'key'               => 'ms_acf_equip_description_key',
            'label'             => 'Description',
            'name'              => 'ms_acf_equip_description_name',
            'aria-label'        => '',
            'type'              => 'textarea',
            'instructions'      => '',
            'required'          => 1,
            'conditional_logic' => 0,
            'wrapper'           => array(
                'width' => '',
                'class' => '',
                'id'    => '',
            ),
            'default_value'     => '',
            'maxlength'         => '',
            'rows'              => '',
            'placeholder'       => '',
            'new_lines'         => '',
        ),
        array(
            'key'               => 'ms_acf_equip_location_key',
            'label'             => 'Location',
            'name'              => 'ms_acf_equip_location_name',
            'aria-label'        => '',
            'type'              => 'text',
            'instructions'      => '',
            'required'          => 1,
            'conditional_logic' => 0,
            'wrapper'           => array(
                'width' => '30',
                'class' => '',
                'id'    => '',
            ),
            'default_value'     => '',
            'maxlength'         => '',
            'placeholder'       => '',
            'prepend'           => '',
            'append'            => '',
        ),
        array(
            'key'               => 'ms_acf_equip_wiki_key',
            'label'             => 'Lab Wiki',
            'name'              => 'ms_acf_equip_wiki_name',
            'aria-label'        => '',
            'type'              => 'url',
            'instructions'      => '',
            'required'          => 0,
            'conditional_logic' => 0,
            'wrapper'           => array(
                'width' => '70',
                'class' => '',
                'id'    => '',
            ),
            'default_value'     => '',
            'placeholder'       => '',
        ),
        array(
            'key'               => 'ms_acf_equip_images_group',
            'label'             => 'Equipment Images',
            'name'              => 'ms_acf_equip_images',
            'aria-label'        => '',
            'type'              => 'group',
            'instructions'      => '',
            'required'          => 0,
            'conditional_logic' => 0,
            'wrapper'           => array(
                'width' => '',
                'class' => '',
                'id'    => '',
            ),
            'layout'            => 'block',
            'sub_fields'        => $ms_acf_equip_images_args,
        ),
        array(
            'key'               => 'ms_acf_equip_docs_group',
            'label'             => 'Equipment Docs',
            'name'              => 'ms_acf_equip_docs',
            'aria-label'        => '',
            'type'              => 'group',
            'instructions'      => '',
            'required'          => 0,
            'conditional_logic' => 0,
            'wrapper'           => array(
                'width' => '',
                'class' => '',
                'id'    => '',
            ),
            'layout'            => 'block',
            'sub_fields'        => $ms_acf_equip_docs_args,
        ),
    ),
    'location' => array(
        array(
            array(
                'param'     => 'post_type',
                'operator'  => '==',
                'value'     => 'ms_equipment',
            ),
        ),
    ),
    'menu_order'            => 0,
    'position'              => 'normal',
    'style'                 => 'default',
    'label_placement'       => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen'        => '',
    'active'                => true,
    'description'           => '',
    'show_in_rest'          => 0,
) );

