<?php

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_62a36bfc3417b',
	'title' => 'Member Details',
	'fields' => array(
		array(
			'key' => 'field_62a5ae721f69e',
			'label' => 'Status',
			'name' => 'status',
			'type' => 'true_false',
			'instructions' => 'Is this person a new addition to the group or are they leaving the group? If the person is leaving the group and becoming a visitor, select \'Alumni\' and add them the \'Visitor\' category.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '60',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 1,
			'ui' => 1,
			'ui_on_text' => 'New',
			'ui_off_text' => 'Alumni',
		),
		array(
			'key' => 'field_62a89cf0bd825',
			'label' => 'Bio',
			'name' => 'bio',
			'type' => 'textarea',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => 6,
			'new_lines' => '',
		),
		array(
			'key' => 'field_62a36c0afe664',
			'label' => 'Email Address',
			'name' => 'email_address',
			'type' => 'email',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_62a5ae721f69e',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => 'your.name@ru.nl',
			'prepend' => '',
			'append' => '',
		),
		array(
			'key' => 'field_62a36c64fe665',
			'label' => 'Phone Number',
			'name' => 'phone_number',
			'type' => 'number',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_62a5ae721f69e',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '24 365 3323',
			'prepend' => '+31',
			'append' => '',
			'min' => '',
			'max' => '',
			'step' => '',
		),
		array(
			'key' => 'field_62a36ca0fe666',
			'label' => 'Office',
			'name' => 'office',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_62a5ae721f69e',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array(
			'key' => 'field_62a5aa9a8a4f9',
			'label' => 'Internal Postcode',
			'name' => 'internal_postcode',
			'type' => 'number',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_62a5ae721f69e',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array(
				'width' => '50',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'min' => 1,
			'max' => 99,
			'step' => 1,
		),
		array(
			'key' => 'field_62a82bb7b3e30',
			'label' => 'Online Profiles',
			'name' => '',
			'type' => 'group',
			'instructions' => '',
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
					'key' => 'field_62a36cbbfe667',
					'label' => 'Twitter',
					'name' => 'twitter',
					'type' => 'url',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '50',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
				),
				array(
					'key' => 'field_62a36cd6fe668',
					'label' => 'LinkedIn',
					'name' => 'LinkedIn',
					'type' => 'url',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '50',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
				),
				array(
					'key' => 'field_62a82ace8e8e2',
					'label' => 'Google Scholar',
					'name' => 'google_scholar',
					'type' => 'url',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '50',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
				),
				array(
					'key' => 'field_62a5a6bcbc099',
					'label' => 'Personal Website',
					'name' => 'personal_website',
					'type' => 'url',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '50',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
				),
			),
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'people',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'seamless',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_rest' => 1,
));

endif;


?>
