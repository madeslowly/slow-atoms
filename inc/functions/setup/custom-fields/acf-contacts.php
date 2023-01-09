<?php

/**
 * 
 * Register ACF contact details used to build the Contact Page.
 * 
 */

acf_add_local_field_group(array(
	'key'		=> 'ms_acf_contact_group',
	'title'		=> 'Contact Details',
	'fields'	=> array(
		array(
			'key'			=> 'ms_acf_contact_add_group_key',
			'label' 		=> 'Address',
			'name' 			=> 'ms_acf_contact_add_group_name',
			'aria-label' 	=> '',
			'type' 			=> 'group',
			'instructions' 	=> '',
			'required' 		=> 0,
			'conditional_logic' => 0,
			'wrapper' 		=> array(
				'width'	=> '',
				'class'	=> '',
				'id'	=> '',
			),

			'layout'		=> 'block',
			'sub_fields'	=> array(
				array(
					'key'			=> 'ms_acf_contact_department_key',
					'label'			=> 'Department or Group Name',
					'name' 			=> 'ms_acf_contact_department_name',
					'aria-label'	=> '',
					'type' 			=> 'text',
					'instructions' 	=> 'Defaults to site tagline if left blank.',
					'required' 		=> 0,
					'conditional_logic' => 0,
					'wrapper' 		=> array(
						'width' => '',
						'class' => '',
						'id' 	=> '',
					),

					'default_value'	=> '',
					'maxlength'		=> '',
					'placeholder'	=> '',
					'prepend'		=> '',
					'append'		=> '',
				),

				array(
					'key' => 'ms_acf_contact_building_key',
					'label' => 'Building or Department Name',
					'name' => 'ms_acf_contact_building_name',
					'aria-label' => '',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'maxlength' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
				),
				array(
					'key' => 'ms_acf_contact_street_key',
					'label' => 'Street',
					'name' => 'ms_acf_contact_street_name',
					'aria-label' => '',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '80%',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'maxlength' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
				),
				array(
					'key' => 'ms_acf_contact_street_number_key',
					'label' => 'Number',
					'name' => 'ms_acf_contact_street_number_name',
					'aria-label' => '',
					'type' => 'number',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '20%',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'min' => '',
					'max' => '',
					'placeholder' => '',
					'step' => '',
					'prepend' => '',
					'append' => '',
				),
				array(
					'key' => 'ms_acf_contact_postcode_key',
					'label' => 'Postal Code',
					'name' => 'ms_acf_contact_postcode_name',
					'aria-label' => '',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '40%',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'maxlength' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
				),
				array(
					'key' => 'ms_acf_contact_city_key',
					'label' => 'City',
					'name' => 'ms_acf_contact_city_name',
					'aria-label' => '',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '60%',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'maxlength' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
				),
				array(
					'key' => 'ms_acf_contact_country_key',
					'label' => 'Country',
					'name' => 'ms_acf_contact_country_name',
					'aria-label' => '',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'maxlength' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
				),
			),
		),
		array(
			'key' => 'ms_acf_contact_directs_group_key',
			'label' => 'Direct Contacts',
			'name' => 'ms_acf_contact_directs_group_name',
			'aria-label' => '',
			'type' => 'group',
			'instructions' => 'Each direct contact will be displayed with a title and icon. Blank fields will be ignored.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'block',
			'sub_fields' => array(
                array(
					'key' => 'ms_acf_contact_directs_sciname_key',
					'label' => 'Scientific Contact Name',
					'name' => 'ms_acf_contact_directs_sciname_name',
					'aria-label' => '',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '50%',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'maxlength' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
				),
				array(
					'key' => 'ms_acf_contact_directs_sciemail_key',
					'label' => 'Email',
					'name' => 'ms_acf_contact_directs_sciemail_name',
					'aria-label' => '',
					'type' => 'email',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '50%',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
				),
                array(
					'key' => 'ms_acf_contact_directs_genname_key',
					'label' => 'General Contact Name',
					'name' => 'ms_acf_contact_directs_genname_name',
					'aria-label' => '',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '50%',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'maxlength' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
				),
				array(
					'key' => 'ms_acf_contact_directs_genemail_key',
					'label' => 'Email',
					'name' => 'ms_acf_contact_directs_genemail_name',
					'aria-label' => '',
					'type' => 'email',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '50%',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
				),
                array(
					'key' => 'ms_acf_contact_directs_webname_key',
					'label' => 'Website Contact Name',
					'name' => 'ms_acf_contact_directs_webname_name',
					'aria-label' => '',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '50%',
						'class' => '',
						'id' => '',
					),
					'default_value' => 'Made Slowly',
					'maxlength' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
				),
				array(
					'key' => 'ms_acf_contact_directs_webemail_key',
					'label' => 'Email',
					'name' => 'ms_acf_contact_directs_webemail_name',
					'aria-label' => '',
					'type' => 'email',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '50%',
						'class' => '',
						'id' => '',
					),
					'default_value' => 'arran@madeslowly.co.uk',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
				),
			),
		),
		array(
			'key' => 'ms_acf_contact_shortcode_key',
			'label' => 'Contact Form Shortcode',
			'name' => 'ms_acf_contact_shortcode_name',
			'aria-label' => '',
			'type' => 'text',
			'instructions' => 'Include a shortcode from your form plugin to have it displayed on this page.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'maxlength' => '',
			'placeholder' => '[SHORTCODE]',
			'prepend' => '',
			'append' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'page_template',
				'operator' => '==',
				'value' => 'page-templates/contact-page.php',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'acf_after_title',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => array(
		0 => 'the_content',
		1 => 'excerpt',
		2 => 'discussion',
		3 => 'comments',
		4 => 'revisions',
		5 => 'author',
		6 => 'categories',
		7 => 'tags',
        8 => 'slug',
        9 => 'featured_image',
	),
	'active' => true,
	'description' => '',
	'show_in_rest' => 0,
));