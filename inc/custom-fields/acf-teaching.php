<?php

/**
 * 
 * Register ACF fields for our teaching custom posts registered with inc/functions/custom-posts/ms-teaching-posts.php.
 * 
 */

/**
 * Re defiend nomenclecture Nov 2022
 * 
 * group_63592d6120fad      ->  ms_acf_teach_group
 * field_635a53d9a9a8f      ->  ms_acf_teach_slides_key
 * lecture_notes            ->  ms_acf_teach_slides_name
 * field_63592d6136c9c      ->  ms_acf_teach_slide_URL_key
 * lecture_notes_url        ->  ms_acf_teach_slide_URL_name
 * field_635a5416a9a90      ->  ms_acf_teach_title_key
 * lecture_name             ->  ms_acf_teach_title_name
 * 
 * field_635a683b882ec      ->  ms_acf_teach_prob_group
 * problems_and_solutions   ->  ms_acf_teach_prob_group_name
 * 
 * field_63594108aca97      ->  ms_acf_teach_prob_key
 * problems                 ->  ms_acf_teach_prob_name
 * 
 * field_635aaa290116a      ->  ms_acf_teach_phide_key
 * hide_problem_sheet       ->  ms_acf_teach_phide_name
 * 
 * field_63594122aca98      ->  ms_acf_teach_sol_key
 * solutions                ->  ms_acf_teach_sol_name
 * 
 * field_635aaaf889fb5      ->  ms_acf_teach_shide_key
 * hide_solutions           ->  ms_acf_teach_shide_name
 * 
 */

if( function_exists( 'acf_add_local_field_group' ) ) :

    acf_add_local_field_group(
        array(
            'key'       => 'ms_acf_teach_group',
            'title'     => 'Teaching Material',
            'fields'    => array(
                array(
                    'key'           => 'ms_acf_teach_slides_key',
                    'label'         => 'Lecture Slides',
                    'name'          => 'ms_acf_teach_slides_name',
                    'aria-label'    => '',
                    'type'          => 'group',
                    'instructions'  => 'PDF files only. Displayed title defaults to "[Post Title] Slides". For a unique title add it in the above "Lecture Title" field.',
                    'required'      => 0,
                    'conditional_logic' => 0,
                    'wrapper'       => array(
                        'width' => '100',
                        'class' => '',
                        'id'    => '',
                    ),
                    'layout'        => 'block',
                    'sub_fields'    => array(
                        array(
                            'key'           => 'ms_acf_teach_slide_URL_key',
                            'label'         => 'PDF file',
                            'name'          => 'ms_acf_teach_slide_URL_name',
                            'aria-label'    => '',
                            'type'          => 'file',
                            'instructions'  => '',
                            'required'      => 0,
                            'conditional_logic' => 0,
                            'wrapper'       => array(
                                'width' => '',
                                'class' => '',
                                'id'    => '',
                            ),
                            'return_format' => 'url',
                            'library'       => 'all',
                            'min_size'      => '',
                            'max_size'      => '',
                            'mime_types'    => 'pdf',
                        ),
                        array(
                            'key'           => 'ms_acf_teach_title_key',
                            'label'         => 'Lecture Title',
                            'name'          => 'ms_acf_teach_title_name',
                            'aria-label'    => '',
                            'type'          => 'text',
                            'instructions'  => 'Defaults to "[Post Title] Slides"',
                            'required'      => 0,
                            'conditional_logic' => 0,
                            'wrapper'       => array(
                                'width' => '',
                                'class' => '',
                                'id'    => '',
                            ),
                            'default_value' => '',
                            'maxlength'     => '',
                            'placeholder'   => 'Unique title for slides',
                            'prepend'       => '',
                            'append'        => '',
                        ),
                    ),
                ),
                array(
                    'key'               => 'ms_acf_teach_prob_group',
                    'label'             => 'Problems and Solutions',
                    'name'              => 'ms_acf_teach_prob_group_name',
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
                    'layout'            => 'table',
                    'sub_fields'        => array(
                        array(
                            'key'               => 'ms_acf_teach_prob_key',
                            'label'             => 'Problems',
                            'name'              => 'ms_acf_teach_prob_name',
                            'aria-label'        => '',
                            'type'              => 'file',
                            'instructions'      => '',
                            'required'          => 0,
                            'conditional_logic' => 0,
                            'wrapper'           => array(
                                'width' => '',
                                'class' => '',
                                'id'    => '',
                            ),
                            'return_format'     => 'url',
                            'library'           => 'all',
                            'min_size'          => '',
                            'max_size'          => '',
                            'mime_types'        => 'pdf',
                        ),
                        array(
                            'key'               => 'ms_acf_teach_phide_key',
                            'label'             => 'Hide Problem Sheet',
                            'name'              => 'ms_acf_teach_phide_name',
                            'aria-label'        => '',
                            'type'              => 'true_false',
                            'instructions'      => '',
                            'required'          => 0,
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field'     => 'ms_acf_teach_prob_key',
                                        'operator'  => '!=empty',
                                    ),
                                ),
                            ),
                            'wrapper'           => array(
                                'width' => '',
                                'class' => '',
                                'id'    => '',
                            ),
                            'message'           => '',
                            'default_value'     => 0,
                            'ui'                => 0,
                            'ui_on_text'        => '',
                            'ui_off_text'       => '',
                        ),
                        array(
                            'key'               => 'ms_acf_teach_sol_key',
                            'label'             => 'Solutions',
                            'name'              => 'ms_acf_teach_sol_name',
                            'aria-label'        => '',
                            'type'              => 'file',
                            'instructions'      => '',
                            'required'          => 0,
                            'conditional_logic' => 0,
                            'wrapper'           => array(
                                'width' => '',
                                'class' => '',
                                'id'    => '',
                            ),
                            'return_format'     => 'url',
                            'library'           => 'all',
                            'min_size'          => '',
                            'max_size'          => '',
                            'mime_types'        => 'pdf',
                        ),
                        array(
                            'key'               => 'ms_acf_teach_shide_key',
                            'label'             => 'Hide Solutions',
                            'name'              => 'ms_acf_teach_shide_name',
                            'aria-label'        => '',
                            'type'              => 'true_false',
                            'instructions'      => '',
                            'required'          => 0,
                            'conditional_logic' => array(
                                array(
                                    array(
                                        'field'     => 'ms_acf_teach_sol_key',
                                        'operator'  => '!=empty',
                                    ),
                                ),
                            ),
                            'wrapper'           => array(
                                'width' => '',
                                'class' => '',
                                'id'    => '',
                            ),
                            'message'           => '',
                            'default_value'     => 0,
                            'ui'                => 0,
                            'ui_on_text'        => '',
                            'ui_off_text'       => '',
                        ),
                    ),
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param'     => 'post_type',
                        'operator'  => '==',
                        'value'     => 'ms_teaching',
                    ),
                ),
            ),
            'menu_order'            => 0,
            'position'              => 'normal',
            'style'                 => 'seamless',
            'label_placement'       => 'top',
            'instruction_placement' => 'field',
            'hide_on_screen'        => '',
            'active'                => true,
            'description'           => '',
            'show_in_rest'          => 0,
        ));
    
    endif;		

?>