<?php

/**
 * 
 * Register ACF fields for images to be randomly displayed on the homepage.
 * 
 * NOTE: should this be replaced with a theme gallery mod?
 * 
 */

// Set up instruction field
$ms_acf_hero_images_instructions	=	array(
	'key'				=>	'ms_acf_hero_images_instructions',
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
	'message'			=>	'Select images to display on your homepage. Avoid images of people or collages. One image will be randomly selected to display on page load. Throughout this theme, these images will also be used when one is not provided.',
	'new_lines'			=>	'',
	'esc_html'			=>	0,
);

// Generate list of arrays for image fields

for ( $i = 1 ; $i <= 10 ; $i++ ) {
	$ms_acf_hero_images_fields[]	=	array(
		'key'				=>	'ms_acf_hero_images_field_' . $i,
		'label'				=>	'Image ' . $i,
		'name'				=>	'ms_acf_hero_image_' . $i,
		'type'				=>	'image',
		'instructions'		=>	'',
		'required'			=>	0,
		'conditional_logic'	=>	0,
		'wrapper'			=> array(
			'width'	=>	'20',
			'class'	=>	'',
			'id'	=>	'',
		),
		'return_format'		=>	'url',
		'preview_size'		=>	'thumbnail',
		'library'			=>	'all',
		'min_width'			=>	'',
		'min_height'		=>	'',
		'min_size'			=>	'',
		'max_width'			=>	'',
		'max_height'		=>	'',
		'max_size'			=>	'',
		'mime_types'		=>	'',
	);
}

// Insert instruction field at front
// NOTE: is this any different to array_merge($ms_acf_hero_images_instructions , $ms_acf_hero_images_fields)
array_unshift( $ms_acf_hero_images_fields , $ms_acf_hero_images_instructions ) ;

acf_add_local_field_group( array(
	'key'		=> 'ms_acf_hero_images_group',
	'title'		=> 'Hero Images',
	'fields'	=> $ms_acf_hero_images_fields,
	'location'	=> array(
		array(
			array(
				'param'		=>	'page_type',
				'operator'	=>	'==',
				'value'		=>	'front_page',
			),
		),
	),
	'menu_order'			=>	1,
	'position'				=>	'normal',
	'style'					=>	'seamless',
	'label_placement'		=>	'top',
	'instruction_placement'	=>	'label',
	'hide_on_screen'		=>	'',
	'active'				=>	true,
	'description'			=>	'Select images to be randomly displayed on the homepage.',
	'show_in_rest'			=>	1,
));