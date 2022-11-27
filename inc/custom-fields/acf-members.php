<?php

/**
 * 
 * Register ACF fields for our people custom posts registered with inc/functions/custom-posts/ms-people-posts.php.
 * 
 */

 /**
	 * group_62a36bfc3417b	->	ms_acf_people_group
	 * field_62a5ae721f69e	->	ms_acf_people_status_key
	 * status				->	ms_acf_people_status_name
	 * field_62a89cf0bd825	->	ms_acf_people_bio_key
	 * bio					->	ms_acf_people_bio_name
	 * field_62a36c0afe664	->	ms_acf_people_email_key
	 * email_address		->	ms_acf_people_email_name
	 * field_62a36c64fe665	->	ms_acf_people_tel_key
	 * phone_number			->	ms_acf_people_tel_name
	 * field_62a36ca0fe666	->	ms_acf_people_office_key
	 * office				->	ms_acf_people_office_name
	 * field_62a5aa9a8a4f9	->	ms_acf_people_postcode_key
	 * internal_postcode	->	ms_acf_people_postcode_name
	 * field_62a82bb7b3e30	->	ms_acf_people_socials_group
	 * field_62a36cbbfe667	->	ms_acf_people_socials_twitter_key
	 * twitter				->	ms_acf_people_socials_twitter_name
	 * field_62a36cd6fe668	->	ms_acf_people_socials_linkedin_key
	 * LinkedIn				->	ms_acf_people_socials_linkedin_name
	 * field_62a82ace8e8e2	->	ms_acf_people_socials_scholar_key
	 * google_scholar		->	ms_acf_people_socials_scholar_name
	 * field_62a5a6bcbc099	->	ms_acf_people_socials_www_key
	 * personal_website		->	ms_acf_people_socials_www_name
	 * 
	 */


if( function_exists( 'acf_add_local_field_group' ) ) :

	acf_add_local_field_group( 
		array(
			'key' => 'ms_acf_people_group',
			'title' => 'Member Details',
			'fields' => array(
				array(
					'key' => 'ms_acf_people_status_key',
					'label' => 'Status',
					'name' => 'ms_acf_people_status_name',
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
					'key' => 'ms_acf_people_bio_key',
					'label' => 'Bio',
					'name' => 'ms_acf_people_bio_name',
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
					'key' => 'ms_acf_people_email_key',
					'label' => 'Email Address',
					'name' => 'ms_acf_people_email_name',
					'type' => 'email',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => array(
						array(
							array(
								'field' => 'ms_acf_people_status_key',
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
					'key' => 'ms_acf_people_tel_key',
					'label' => 'Phone Number',
					'name' => 'ms_acf_people_tel_name',
					'type' => 'number',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => array(
						array(
							array(
								'field' => 'ms_acf_people_status_key',
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
					'key' => 'ms_acf_people_office_key',
					'label' => 'Office',
					'name' => 'ms_acf_people_office_name',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => array(
						array(
							array(
								'field' => 'ms_acf_people_status_key',
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
					'key' => 'ms_acf_people_postcode_key',
					'label' => 'Internal Postcode',
					'name' => 'ms_acf_people_postcode_name',
					'type' => 'number',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => array(
						array(
							array(
								'field' => 'ms_acf_people_status_key',
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
					'key' => 'ms_acf_people_socials_group_key',
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
							'key' => 'ms_acf_people_socials_linkedin_key',
							'label' => 'LinkedIn',
							'name' => 'ms_acf_people_socials_linkedin_name',
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
							'key' => 'ms_acf_people_socials_scholar_key',
							'label' => 'Google Scholar',
							'name' => 'ms_acf_people_socials_scholar_name',
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
							'key' => 'ms_acf_people_socials_www_key',
							'label' => 'Personal Website',
							'name' => 'ms_acf_people_socials_www_name',
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
						'value' => 'ms_people',
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
