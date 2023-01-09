<?php

/**
 * 
 * Register ACF for our people custom posts, registered with inc/functions/custom-posts/ms-people-posts.php.
 * 
 */

// Build array for 'fields' arg

$ms_acf_pub_abstract_args   =   array(
    
    'key'                   => 'ms_acf_pub_abstract_key',
    'label'                 => 'Abstract',
    'name'                  => 'ms_acf_pub_abstract_name',
    'type'                  => 'textarea',
    'instructions'          => '',
    'required'              => 1,
    'conditional_logic'     => 0,
    'wrapper'               => array(
        'width' => '',
        'class' => '',
        'id'    => '',
    ) ,
    'default_value'         => '',
    'placeholder'           => '',
    'maxlength'             => '',
    'rows'                  => 6,
    'new_lines'             => '',
) ;

$ms_acf_pub_journal_args    =   array(
    'key'                   => 'ms_acf_pub_journal_key',
    'label'                 => 'Journal',
    'name'                  => 'ms_acf_pub_journal_name',
    'type'                  => 'text',
    'instructions'          => '',
    'required'              => 1,
    'conditional_logic'     => 0,
    'wrapper'               => array(
        'width' => '40',
        'class' => '',
        'id'    => '',
    ) ,
    'default_value'         => '',
    'placeholder'           => '',
    'prepend'               => '',
    'append'                => '',
    'maxlength'             => '',
) ;

$ms_acf_pub_year_args       =   array(
    'key'                   => 'ms_acf_pub_year_key',
    'label'                 => 'Year',
    'name'                  => 'ms_acf_pub_year_name',
    'type'                  => 'number',
    'instructions'          => '',
    'required'              => 1,
    'conditional_logic'     => 0,
    'wrapper'               => array(
        'width' => '20',
        'class' => '',
        'id'    => '',
    ) ,
    'default_value'         => '',
    'placeholder'           => '',
    'prepend'               => '',
    'append'                => '',
    'min'                   => '',
    'max'                   => '',
    'step'                  => '',
) ;

$ms_acf_pub_vol_args        =   array(
    'key'                   => 'ms_acf_pub_vol_key',
    'label'                 => 'Volume',
    'name'                  => 'ms_acf_pub_vol_name',
    'type'                  => 'number',
    'instructions'          => '',
    'required'              => 1,
    'conditional_logic'     => 0,
    'wrapper'               => array(
        'width' => '20',
        'class' => '',
        'id'    => '',
    ) ,
    'default_value'         => '',
    'placeholder'           => '',
    'prepend'               => '',
    'append'                => '',
    'min'                   => '',
    'max'                   => '',
    'step'                  => '',
) ;

$ms_acf_pub_page_args       =   array(
    'key'                   => 'ms_acf_pub_page_key',
    'label'                 => 'Page Number',
    'name'                  => 'ms_acf_pub_page_name',
    'type'                  => 'number',
    'instructions'          => '',
    'required'              => 1,
    'conditional_logic'     => 0,
    'wrapper'               => array(
        'width' => '20',
        'class' => '',
        'id'    => '',
    ) ,
    'default_value'         => '',
    'placeholder'           => '',
    'prepend'               => '',
    'append'                => '',
    'min'                   => '',
    'max'                   => '',
    'step'                  => '',
) ;

$ms_acf_pub_doi_args        =   array(
    'key'                   => 'ms_acf_pub_doi_key',
    'label'                 => 'doi',
    'name'                  => 'ms_acf_pub_doi_name',
    'type'                  => 'text',
    'instructions'          => '',
    'required'              => 1,
    'conditional_logic'     => 0,
    'wrapper'               => array(
        'width' => '',
        'class' => '',
        'id'    => '',
    ) ,
    'default_value'         => '',
    'placeholder'           => '',
    'prepend'               => 'doi.org/',
    'append'                => '',
    'maxlength'             => '',
) ;

$ms_acf_pub_max_auhtors = 20 ;

for ( $i = 1 ; $i <= $ms_acf_pub_max_auhtors ; $i++ ) {

    if ( $i != 1 ) :

        $required = 0 ;

        $callback_i = $i - 1 ;

        $conditional_logic = array( array( array(
            'field'     => 'ms_acf_pub_alist_' . $callback_i . '_add_key',
            'operator'  => '==',
            'value'     => '1',
        ) , ) , ) ;
    
    else : 

        $required = 1 ;

        $conditional_logic = 0 ;
    
    endif ;

    if ( $i != $ms_acf_pub_max_auhtors ) :

        $add_author = array(
            'key'           => 'ms_acf_pub_alist_' . $i . '_add_key',
            'label'         => 'Add Another',
            'name'          => 'ms_acf_alist_add',
            'type'          => 'true_false',
            'instructions'  => '',
            'required'      => 0,
            'conditional_logic' => 0,
            'wrapper'       => array(
                'width' => '20',
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

            $add_author = NULL ;

        endif ;

    $ms_acf_pub_alist_sub_fields_args[] =  array(
        'key'               => 'ms_acf_pub_alist_' . $i . '_key',
        'label'             => 'Author ' . $i ,
        'name'              => 'author_' . $i ,
        'type'              => 'group',
        'instructions'      => '',
        'required'          => 0,
        'conditional_logic' => $conditional_logic,
        'wrapper'           => array(
            'width' => '',
            'class' => '',
            'id'    => '',
        ) ,
        'layout' => 'block',
        'sub_fields' => array(
            array(
                'key'           => 'ms_acf_pub_alist_' . $i . '_fname_key',
                'label'         => 'First Name',
                'name'          => 'ms_acf_alist_fname',
                'type'          => 'text',
                'instructions'  => '' ,
                'required'      => $required ,
                'conditional_logic' => 0 ,
                'wrapper'       => array(
                    'width' => '30',
                    'class' => '',
                    'id'    => '',
                ) ,
                'default_value' => '',
                'placeholder'   => '',
                'prepend'       => '',
                'append'        => '',
                'maxlength'     => '',
            ) ,
            array(
                'key'           => 'ms_acf_pub_alist_' . $i . '_initials_key',
                'label'         => 'Initials',
                'name'          => 'ms_acf_alist_initials',
                'type'          => 'text',
                'instructions'  => '',
                'required'      => 0,
                'conditional_logic' => 0,
                'wrapper'       => array(
                    'width' => '20',
                    'class' => '',
                    'id'    => '',
                ) ,
                'default_value' => '',
                'placeholder'   => '',
                'prepend'       => '',
                'append'        => '',
                'maxlength'     => '',
            ) ,
            array(
                'key'           => 'ms_acf_pub_alist_' . $i . '_lname_key',
                'label'         => 'Last Name',
                'name'          => 'ms_acf_alist_lname',
                'type'          => 'text',
                'instructions'  => '',
                'required'      => $required,
                'conditional_logic' => 0,
                'wrapper'       => array(
                    'width' => '30',
                    'class' => '',
                    'id'    => '',
                ) ,
                'default_value' => '',
                'placeholder'   => '',
                'prepend'       => '',
                'append'        => '',
                'maxlength'     => '',
            ) ,

            $add_author ,
        
        ) ,
    ) ;
}

acf_add_local_field_group(
    array(
        'key'       => 'ms_acf_pub_group',
        'title'     => 'Publication Details',
        'fields'    => array(
            $ms_acf_pub_abstract_args,
            $ms_acf_pub_journal_args,
            $ms_acf_pub_year_args,
            $ms_acf_pub_vol_args,
            $ms_acf_pub_page_args,
            $ms_acf_pub_doi_args,
            array(
                'key' => 'ms_acf_pub_alist_group',
                'label' => 'Authors',
                'name' => 'ms_acf_pub_alist',
                'type' => 'group',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ) ,
                'layout' => 'block',
                'sub_fields' => $ms_acf_pub_alist_sub_fields_args ,
            ) ,
            array(
                'key' => 'ms_acf_pub_thumb_key',
                'label' => 'Thumbnail',
                'name' => 'ms_acf_pub_thumb_name',
                'type' => 'image',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ) ,
                'return_format' => 'id',
                'preview_size' => 'medium',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
            ) ,
        ) ,
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'ms_publications',
                ) ,
            ) ,
        ) ,
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
));