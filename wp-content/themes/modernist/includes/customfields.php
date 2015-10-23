<?php
if(!get_option('acf_repeater_ac'))
{ 
	update_option('acf_repeater_ac', "QJF7-L4IX-UCNP-RF2W");
}
if(!get_option('acf_options_page_ac'))
{ 
	update_option('acf_options_page_ac', "OPN8-FA4J-Y2LW-81LS");
}
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => '50bdf2bbd9e01',
		'title' => 'About Fields',
		'fields' => 
		array (
			0 => 
			array (
				'key' => 'field_50b8bb04c6599',
				'label' => 'About Inner Title',
				'name' => 'about_inner_title',
				'type' => 'text',
				'instructions' => 'Enter the about box title',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'html',
				'order_no' => '0',
			),
			1 => 
			array (
				'key' => 'field_50b8bb04cda3e',
				'label' => 'Career Title',
				'name' => 'career_title',
				'type' => 'text',
				'instructions' => '',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'none',
				'order_no' => '1',
			),
			2 => 
			array (
				'key' => 'field_50b8bb04d9d6b',
				'label' => 'Career Content',
				'name' => 'career_content',
				'type' => 'wysiwyg',
				'instructions' => '',
				'required' => '0',
				'default_value' => '',
				'toolbar' => 'basic',
				'media_upload' => 'no',
				'the_content' => 'yes',
				'order_no' => '2',
			),
			3 => 
			array (
				'key' => 'field_50b8bb04ddeba',
				'label' => 'Apply Form',
				'name' => 'apply_form',
				'type' => 'file',
				'instructions' => '',
				'required' => '0',
				'save_format' => 'url',
				'order_no' => '3',
			),
			4 => 
			array (
				'key' => 'field_50b8bb04e1f6e',
				'label' => 'Testimonials',
				'name' => 'testimonials',
				'type' => 'repeater',
				'instructions' => 'Enter multiply testimonials here',
				'required' => '0',
				'sub_fields' => 
				array (
					0 => 
					array (
						'key' => 'field_50b8bb04e1f89',
						'label' => 'Testimonial Content',
						'name' => 'testimonial_content',
						'type' => 'textarea',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'br',
						'order_no' => '0',
					),
					1 => 
					array (
						'key' => 'field_50b8bb04e1f95',
						'label' => 'Person',
						'name' => 'person',
						'type' => 'text',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => '1',
					),
					2 => 
					array (
						'key' => 'field_50b8bb04e1f9e',
						'label' => 'Position',
						'name' => 'position',
						'type' => 'text',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'order_no' => '2',
					),
				),
				'row_min' => '1',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Row',
				'order_no' => '4',
			),
			5 => 
			array (
				'key' => 'field_50b8bb04e60d2',
				'label' => 'Staff',
				'name' => 'staff',
				'type' => 'repeater',
				'instructions' => 'Enter staff personnel, click add row for multiply persons.',
				'required' => '0',
				'sub_fields' => 
				array (
					0 => 
					array (
						'key' => 'field_50b8bb04e60ec',
						'label' => 'Name',
						'name' => 'name',
						'type' => 'text',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'none',
						'order_no' => '0',
					),
					1 => 
					array (
						'key' => 'field_50b8bb04e60f7',
						'label' => 'Position',
						'name' => 'position',
						'type' => 'text',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'none',
						'order_no' => '1',
					),
					2 => 
					array (
						'key' => 'field_50b8bb04e6100',
						'label' => 'Description',
						'name' => 'description',
						'type' => 'textarea',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'br',
						'order_no' => '2',
					),
					3 => 
					array (
						'key' => 'field_50b8bb04e6109',
						'label' => 'Facebook Profile',
						'name' => 'facebook_profile',
						'type' => 'text',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'none',
						'order_no' => '3',
					),
					4 => 
					array (
						'key' => 'field_50b8bb04e6111',
						'label' => 'Twitter Profile',
						'name' => 'twitter_profile',
						'type' => 'text',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'none',
						'order_no' => '4',
					),
					5 => 
					array (
						'key' => 'field_50b8bb04e6119',
						'label' => 'Linked In Profile',
						'name' => 'linked_in_profile',
						'type' => 'text',
						'instructions' => '',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'none',
						'order_no' => '5',
					),
					6 => 
					array (
						'label' => 'Image',
						'name' => 'image',
						'type' => 'image',
						'instructions' => '',
						'column_width' => '',
						'save_format' => 'object',
						'preview_size' => 'thumbnail',
						'key' => 'field_50b8bbe39a18e',
						'order_no' => '6',
					),
				),
				'row_min' => '1',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Row',
				'order_no' => '5',
			),
		),
		'location' => 
		array (
			'rules' => 
			array (
				0 => 
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template-about.php',
					'order_no' => '0',
				),
			),
			'allorany' => 'all',
		),
		'options' => 
		array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => 
			array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => '50bdf2bbdccf8',
		'title' => 'Background',
		'fields' => 
		array (
			0 => 
			array (
				'key' => 'field_50bb7fad4356f',
				'label' => 'Posts Background',
				'name' => 'posts_background',
				'type' => 'image',
				'instructions' => 'Chose the Background Image of posts',
				'required' => '0',
				'save_format' => 'object',
				'preview_size' => 'thumbnail',
				'order_no' => '0',
			),
			1 => 
			array (
				'key' => 'field_50bb7fad48728',
				'label' => 'Projects Background',
				'name' => 'projects_background',
				'type' => 'image',
				'instructions' => 'Chose a background image for project single page',
				'required' => '0',
				'save_format' => 'object',
				'preview_size' => 'thumbnail',
				'order_no' => '1',
			),
			2 => 
			array (
				'key' => 'field_50bb83f21e42c',
				'label' => 'No Image Color',
				'name' => 'no_image_color',
				'type' => 'color_picker',
				'instructions' => 'In case on any page\'s are not selected any background image, than chose a color to be displayed there.',
				'required' => '0',
				'default_value' => '#e3e3e3',
				'order_no' => '2',
			),
			3 => 
			array (
				'key' => 'field_50bb874190eb5',
				'label' => 'Grayscale Images',
				'name' => 'grayscale_images',
				'type' => 'true_false',
				'instructions' => 'Should all images become grayscale automatically.',
				'required' => '0',
				'message' => 'Grayscale',
				'order_no' => '3',
			),
		),
		'location' => 
		array (
			'rules' => 
			array (
				0 => 
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'options-background',
					'order_no' => '0',
				),
			),
			'allorany' => 'all',
		),
		'options' => 
		array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => 
			array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => '50bdf2bbddbc0',
		'title' => 'Background',
		'fields' => 
		array (
			0 => 
			array (
				'key' => 'field_50bb8002c2660',
				'label' => 'Background Image',
				'name' => 'background_image',
				'type' => 'image',
				'instructions' => 'Chose a background image for this page.',
				'required' => '0',
				'save_format' => 'object',
				'preview_size' => 'thumbnail',
				'order_no' => '0',
			),
		),
		'location' => 
		array (
			'rules' => 
			array (
				1 => 
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template-about.php',
					'order_no' => '1',
				),
				2 => 
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template-blog.php',
					'order_no' => '2',
				),
				3 => 
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template-contact.php',
					'order_no' => '3',
				),
				4 => 
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template-partners.php',
					'order_no' => '4',
				),
				5 => 
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template-projects.php',
					'order_no' => '5',
				),
				6 => 
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template-services.php',
					'order_no' => '6',
				),
				7 => 
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template-team.php',
					'order_no' => '7',
				)
			),
			'allorany' => 'any',
		),
		'options' => 
		array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => 
			array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => '50bdf2bbde10f',
		'title' => 'Background',
		'fields' => 
		array (
			0 => 
			array (
				'label' => 'Home Message Banner Link',
				'name' => 'home_message_banner_link',
				'type' => 'text',
				'instructions' => 'Place and URL where Home Message Banner would direct to.',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'html',
				'key' => 'field_50bb8f3505aa6',
				'order_no' => '0',
			),
			1 => 
			array (
				'key' => 'field_50bb80825aa83',
				'label' => 'Background Images',
				'name' => 'background_images',
				'type' => 'repeater',
				'instructions' => 'Chose background image\'s for the home slider,leave a single image to disable slider.',
				'required' => '0',
				'sub_fields' => 
				array (
					0 => 
					array (
						'key' => 'field_50bb80825aa97',
						'label' => 'Image',
						'name' => 'image',
						'type' => 'image',
						'instructions' => '',
						'column_width' => '',
						'save_format' => 'object',
						'preview_size' => 'thumbnail',
						'order_no' => '0',
					),
				),
				'row_min' => '1',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Row',
				'order_no' => '1',
			),
		),
		'location' => 
		array (
			'rules' => 
			array (
				0 => 
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template-home.php',
					'order_no' => '0',
				),
			),
			'allorany' => 'all',
		),
		'options' => 
		array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => 
			array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => '50bdf2bbde764',
		'title' => 'Blog Posts',
		'fields' => 
		array (
			0 => 
			array (
				'key' => 'field_50b65e3d55af1',
				'label' => 'Number of posts',
				'name' => 'number_of_posts',
				'type' => 'text',
				'instructions' => 'Place number of posts for each page. <em>Leave blank for default which is 8 or -1 for unlimited</em>',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'none',
				'order_no' => '0',
			),
		),
		'location' => 
		array (
			'rules' => 
			array (
				0 => 
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template-blog.php',
					'order_no' => '0',
				),
			),
			'allorany' => 'all',
		),
		'options' => 
		array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => 
			array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => '50bdf2bbdebc8',
		'title' => 'Branding',
		'fields' => 
		array (
			0 => 
			array (
				'label' => 'Site Logo',
				'name' => 'site_logo',
				'type' => 'image',
				'instructions' => '',
				'required' => '0',
				'save_format' => 'object',
				'preview_size' => 'thumbnail',
				'key' => 'field_50bdf07ddf0bd',
				'order_no' => '0',
			),
			1 => 
			array (
				'key' => 'field_50bcc2b83c440darkcolor',
				'label' => 'Brand Dark Color',
				'name' => 'brand_dark_color',
				'type' => 'color_picker',
				'instructions' => 'Leave blank for default color.',
				'required' => '0',
				'default_value' => '',
				'order_no' => '1',
			),
			2 => 
			array (
				'key' => 'field_50bcc2b83c440',
				'label' => 'Brand Color',
				'name' => 'brand_color',
				'type' => 'color_picker',
				'instructions' => 'Leave blank for default color.',
				'required' => '0',
				'default_value' => '',
				'order_no' => '1',
			),
			3 => 
			array (
				'key' => 'field_50bcf76bbb5c9',
				'label' => 'Font Color',
				'name' => 'font_color',
				'type' => 'color_picker',
				'instructions' => 'Leave blank for default.',
				'required' => '0',
				'default_value' => '',
				'order_no' => '2',
			),
			4 => 
			array (
				'choices' => 
				array (
					'Light' => 'Light',
					'Dark' => 'Dark',
				),
				'key' => 'field_50bcc334930ae',
				'label' => 'Skins',
				'name' => 'skins',
				'type' => 'select',
				'instructions' => 'Chose the skin.',
				'required' => '0',
				'default_value' => '',
				'allow_null' => '0',
				'multiple' => '0',
				'order_no' => '3',
			),
			5 => 
			array (
				'choices' => 
				array (
					'Robotto' => 'Robotto',
					'Gafata' => 'Gafata',
					'Open Sans' => 'Open Sans',
					'Text me one' => 'Text me one',
					'Rambla' => 'Rambla',
					'Anaheim' => 'Anaheim',
					'Share Tech' => 'Share Tech',
					'Strait' => 'Strait',
					'Exo' => 'Exo',
					'Titillium Web' => 'Titillium Web',
					'Offside' => 'Offside',
					'Montserrat' => 'Montserrat',
					'Archivo Narrow' => 'Archivo Narrow',
					'Average Sans' => 'Average Sans',
				),
				'key' => 'field_50bcc74adbf3a',
				'label' => 'Google Fonts',
				'name' => 'google_fonts',
				'type' => 'select',
				'instructions' => '',
				'required' => '0',
				'default_value' => '',
				'allow_null' => '0',
				'multiple' => '0',
				'order_no' => '4',
			),
			6 => 
			array (
				'label' => 'Favicon',
				'name' => 'favicon',
				'type' => 'image',
				'instructions' => '',
				'required' => '0',
				'save_format' => 'object',
				'preview_size' => 'thumbnail',
				'key' => 'field_50bdf07ddf0bdasd',
				'order_no' => '0',
			),
		),
		'location' => 
		array (
			'rules' => 
			array (
				0 => 
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'options-branding',
					'order_no' => '0',
				),
			),
			'allorany' => 'all',
		),
		'options' => 
		array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => 
			array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => '50bdf2bbdf9b0',
		'title' => 'Contact Builder',
		'fields' => 
		array (
			0 => 
			array (
				'key' => 'field_50b762cd5711a',
				'label' => 'Contact Form Text',
				'name' => 'contact_form_text',
				'type' => 'textarea',
				'instructions' => '',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'br',
				'order_no' => '0',
			),
			1 => 
			array (
				'key' => 'field_50b762cd5c53f',
				'label' => 'Receiving Emails',
				'name' => 'receiving_emails',
				'type' => 'text',
				'instructions' => 'Place the e-mail where you want to get emails from this form.',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'none',
				'order_no' => '1',
			),
			2 => 
			array (
				'key' => 'field_50b785cbdfcb6',
				'label' => 'Success Message',
				'name' => 'success_message',
				'type' => 'text',
				'instructions' => 'Enter a message here, which will appear when email is sent successfully from Contact Form.',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'html',
				'order_no' => '2',
			),
			3 => 
			array (
				'key' => 'field_50b762cd6275c',
				'label' => 'Contact Form Bottom Text',
				'name' => 'contact_form_bottom_text',
				'type' => 'textarea',
				'instructions' => 'Place the text which will appear on the bottom of contact page.',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'br',
				'order_no' => '3',
			),
			4 => 
			array (
				'key' => 'field_50b762cd688d1',
				'label' => 'Google Map Latitude',
				'name' => 'google_map_latitude',
				'type' => 'text',
				'instructions' => 'Place Google map Latitude.You can get them from <a href="http://itouchmap.com/latlong.html" target="_blank">here</a>.',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'none',
				'order_no' => '4',
			),
			5 => 
			array (
				'key' => 'field_50b762cd6ea6e',
				'label' => 'Google Map Longitude',
				'name' => 'google_map_longitude',
				'type' => 'text',
				'instructions' => 'Place Google map Longitude.You can get them from <a href="http://itouchmap.com/latlong.html" target="_blank">here</a>.',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'none',
				'order_no' => '5',
			),
			6 => 
			array (
				'key' => 'field_50b763e4ce9c6',
				'label' => 'Contact Info',
				'name' => 'contact_info_test',
				'type' => 'textarea',
				'instructions' => '',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'br',
				'order_no' => '6',
			),
			7 => 
			array (
				'key' => 'field_50b76347258d4',
				'label' => 'Address',
				'name' => 'address',
				'type' => 'textarea',
				'instructions' => '',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'br',
				'order_no' => '7',
			),
			8 => 
			array (
				'key' => 'field_50b763472b9f8',
				'label' => 'Phone Numbers',
				'name' => 'phone_numbers',
				'type' => 'textarea',
				'instructions' => '',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'br',
				'order_no' => '8',
			),
			9 => 
			array (
				'key' => 'field_50b7634731bfe',
				'label' => 'Email Addresses',
				'name' => 'email_addresses',
				'type' => 'textarea',
				'instructions' => '',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'br',
				'order_no' => '9',
			),
		),
		'location' => 
		array (
			'rules' => 
			array (
				0 => 
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template-contact.php',
					'order_no' => '0',
				),
			),
			'allorany' => 'all',
		),
		'options' => 
		array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => 
			array (
				0 => 'the_content',
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => '50bdf2bbe1259',
		'title' => 'Footer',
		'fields' => 
		array (
			0 => 
			array (
				'key' => 'field_50ae7db3ebef4',
				'label' => 'Footer Text',
				'name' => 'footer_text',
				'type' => 'wysiwyg',
				'instructions' => '',
				'required' => '0',
				'default_value' => '',
				'toolbar' => 'basic',
				'media_upload' => 'no',
				'the_content' => 'yes',
				'order_no' => '0',
			),
			1 => 
			array (
				'key' => 'field_50ae7db3f31ce',
				'label' => 'Footer Logo',
				'name' => 'footer_logo',
				'type' => 'image',
				'instructions' => '',
				'required' => '0',
				'save_format' => 'object',
				'preview_size' => 'thumbnail',
				'order_no' => '1',
			),
		),
		'location' => 
		array (
			'rules' => 
			array (
				0 => 
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'options-footer',
					'order_no' => '0',
				),
			),
			'allorany' => 'any',
		),
		'options' => 
		array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => 
			array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => '50bdf2bbe1ac7',
		'title' => 'Main',
		'fields' => 
		array (
			0 => 
			array (
				'key' => 'field_50bbbe4ab75d5',
				'label' => 'Google Analytics + Custom Javascript',
				'name' => 'google_analytics',
				'type' => 'textarea',
				'instructions' => 'Enter custom Javascript or Google analytics and don\'t forget to include script tags.',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'html',
				'order_no' => '0',
			),
			1 => 
			array (
				'key' => 'field_50bbbe4ac4bf0',
				'label' => 'Custom CSS',
				'name' => 'custom_css',
				'type' => 'textarea',
				'instructions' => 'Add css,without style tag.',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'html',
				'order_no' => '1',
			),
			2 => 
			array (
				'key' => 'field_50bbbe4acad70',
				'label' => 'Custom PHP',
				'name' => 'custom_php',
				'type' => 'textarea',
				'instructions' => 'Insert PHP code without php tags.',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'none',
				'order_no' => '2',
			),
			3 => 
			array (
				'key' => 'field_50bbb3bb91d64',
				'label' => 'Facebook Profile',
				'name' => 'facebook_profile',
				'type' => 'text',
				'instructions' => '',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'none',
				'order_no' => '3',
			),
			4 => 
			array (
				'key' => 'field_50bbb3bb97013',
				'label' => 'Twitter Profile',
				'name' => 'twitter_profile',
				'type' => 'text',
				'instructions' => '',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'none',
				'order_no' => '4',
			),
			5 => 
			array (
				'key' => 'field_50bbbeff16c3c',
				'label' => 'Enable Responsive',
				'name' => 'enable_responsive',
				'type' => 'true_false',
				'instructions' => 'Enable or Disable Responsive',
				'required' => '0',
				'message' => 'Responsive',
				'default_value' => '1',
				'order_no' => '5',
			),
			6 => 
			array (
				'key' => 'field_50bcf384816ff',
				'label' => 'Animation',
				'name' => 'animation',
				'type' => 'true_false',
				'instructions' => 'Enable Animation',
				'required' => '0',
				'message' => 'Enable Animation',
				'default_value' => '1',
				'order_no' => '6',
			),
		),
		'location' => 
		array (
			'rules' => 
			array (
				0 => 
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'options-main',
					'order_no' => '0',
				),
			),
			'allorany' => 'all',
		),
		'options' => 
		array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => 
			array (
			),
		),
		'menu_order' => 0,
	));
        register_field_group(array (
            'id' => '50bdf2bbe344e',
            'title' => 'Partners',
            'fields' => 
            array (
                0 => 
                array (
                    'key' => 'field_50b7516e860be',
                    'label' => 'Contact Page',
                    'name' => 'contact_page',
                    'type' => 'post_object',
                    'instructions' => 'Select from here the contact page.',
                    'required' => '0',
                    'post_type' => 
                    array (
                        0 => 'page',
                    ),
                    'taxonomy' => 
                    array (
                        0 => 'all',
                    ),
                    'allow_null' => '0',
                    'multiple' => '0',
                    'order_no' => '0',
                ),
                1 => 
                array (
                    'key' => 'field_50b665ef3a21d',
                    'label' => 'Partners',
                    'name' => 'partners',
                    'type' => 'repeater',
                    'instructions' => 'Place here each partner.',
                    'required' => '0',
                    'sub_fields' => 
                    array (
                        0 => 
                        array (
                            'key' => 'field_50b665ef3a232',
                            'label' => 'Partner Name',
                            'name' => 'partner_name',
                            'type' => 'text',
                            'instructions' => 'Enter the partner name',
                            'column_width' => '',
                            'default_value' => '',
                            'formatting' => 'none',
                            'order_no' => '0',
                        ),
                        1 => 
                        array (
                            'key' => 'field_50b665ef3a23c',
                            'label' => 'Partner Description',
                            'name' => 'partner_description',
                            'type' => 'textarea',
                            'instructions' => 'Enter some description about this partner',
                            'column_width' => '',
                            'default_value' => '',
                            'formatting' => 'br',
                            'order_no' => '1',
                        ),
                        2 => 
                        array (
                            'key' => 'field_50b665ef3a244',
                            'label' => 'Partner Logo',
                            'name' => 'partner_logo',
                            'type' => 'image',
                            'instructions' => 'Upload partner logo here.',
                            'column_width' => '',
                            'save_format' => 'object',
                            'preview_size' => 'thumbnail',
                            'order_no' => '2',
                        ),
                        3 => 
                        array (
                            'key' => 'field_50b665ef3a24d',
                            'label' => 'Partner Website',
                            'name' => 'partner_website',
                            'type' => 'text',
                            'instructions' => 'Enter this partner web site here.',
                            'column_width' => '',
                            'default_value' => '',
                            'formatting' => 'html',
                            'order_no' => '3',
                        ),
                    ),
                    'row_min' => '1',
                    'row_limit' => '',
                    'layout' => 'table',
                    'button_label' => 'Add Row',
                    'order_no' => '1',
                ),
            ),
            'location' => 
            array (
                'rules' => 
                array (
                    0 => 
                    array (
                        'param' => 'page_template',
                        'operator' => '==',
                        'value' => 'template-partners.php',
                        'order_no' => '0',
                    ),
                ),
                'allorany' => 'all',
            ),
            'options' => 
            array (
                'position' => 'normal',
                'layout' => 'default',
                'hide_on_screen' => 
                array (
                ),
            ),
            'menu_order' => 0,
        ));
        register_field_group(array (
            'id' => '50bdf2bbe455f',
            'title' => 'Team Fields',
            'fields' => 
            array (
                0 => 
                array (
                    'key' => 'field_50b7516e871cf',
                    'label' => 'Contact Page',
                    'name' => 'contact_page',
                    'type' => 'post_object',
                    'instructions' => 'Select from here the contact page.',
                    'required' => '0',
                    'post_type' => 
                    array (
                        0 => 'page',
                    ),
                    'taxonomy' => 
                    array (
                        0 => 'all',
                    ),
                    'allow_null' => '0',
                    'multiple' => '0',
                    'order_no' => '0',
                ),
                1 => 
                array (
                    'key' => 'field_50b665ef3b32e',
                    'label' => 'Team Partners',
                    'name' => 'team_partners',
                    'type' => 'repeater',
                    'instructions' => 'Place here each team partner.',
                    'required' => '0',
                    'sub_fields' => 
                    array (
                        0 => 
                        array (
                            'key' => 'field_50b665ef3b343',
                            'label' => 'Team Name',
                            'name' => 'team_partner_name',
                            'type' => 'text',
                            'instructions' => 'Enter the team partner name',
                            'column_width' => '',
                            'default_value' => '',
                            'formatting' => 'none',
                            'order_no' => '0',
                        ),
                        1 => 
                        array (
                            'key' => 'field_50b665ef3b34d',
                            'label' => 'Team Partner Description',
                            'name' => 'team_partner_description',
                            'type' => 'textarea',
                            'instructions' => 'Enter some description about this team partner',
                            'column_width' => '',
                            'default_value' => '',
                            'formatting' => 'br',
                            'order_no' => '1',
                        ),
                        2 => 
                        array (
                            'key' => 'field_50b665ef3b355',
                            'label' => 'Team Partner Logo',
                            'name' => 'team_partner_logo',
                            'type' => 'image',
                            'instructions' => 'Upload team partner logo here.',
                            'column_width' => '',
                            'save_format' => 'object',
                            'preview_size' => 'thumbnail',
                            'order_no' => '2',
                        ),
                        3 => 
                        array (
                            'key' => 'field_50b665ef3b35e',
                            'label' => 'Team Partner Website',
                            'name' => 'team_partner_website',
                            'type' => 'text',
                            'instructions' => 'Enter this team partner web site here.',
                            'column_width' => '',
                            'default_value' => '',
                            'formatting' => 'html',
                            'order_no' => '3',
                        ),
                    ),
                    'row_min' => '1',
                    'row_limit' => '',
                    'layout' => 'table',
                    'button_label' => 'Add Row',
                    'order_no' => '1',
                ),
            ),
            'location' => 
            array (
                'rules' => 
                array (
                    0 => 
                    array (
                        'param' => 'page_template',
                        'operator' => '==',
                        'value' => 'template-team.php',
                        'order_no' => '0',
                    ),
                ),
                'allorany' => 'all',
            ),
            'options' => 
            array (
                'position' => 'normal',
                'layout' => 'default',
                'hide_on_screen' => 
                array (
                ),
            ),
            'menu_order' => 0,
        ));
	register_field_group(array (
		'id' => '50bdf2bbe40f4',
		'title' => 'Services',
		'fields' => 
		array (
			0 => 
			array (
				'key' => 'field_50b6280804aa8',
				'label' => 'Bottom Text',
				'name' => 'bottom_text',
				'type' => 'wysiwyg',
				'instructions' => 'Place here the text which will appear on the bottom of this page.',
				'required' => '0',
				'default_value' => '',
				'toolbar' => 'basic',
				'media_upload' => 'no',
				'the_content' => 'yes',
				'order_no' => '0',
			),
			1 => 
			array (
				'key' => 'field_50b5f8d8b79f2',
				'label' => 'Display All Services',
				'name' => 'all_service_posts',
				'type' => 'true_false',
				'instructions' => 'Check this to put all newest services posts.',
				'required' => '0',
				'message' => '',
				'order_no' => '1',
			),
			2 => 
			array (
				'key' => 'field_50b5f8d8bcbc3',
				'label' => 'Number of posts',
				'name' => 'number_of_posts',
				'type' => 'text',
				'instructions' => 'Number of service posts to place on this page	:	<em>Note : Display All Services must be checked </em>',
				'required' => '0',
				'default_value' => '',
				'formatting' => 'none',
				'order_no' => '2',
			),
			3 => 
			array (
				'key' => 'field_50b5f9246042e',
				'label' => 'Service Posts',
				'name' => 'service_posts',
				'type' => 'relationship',
				'instructions' => 'Chose "Service" posts to get displayed on this page. <em>Note : This works only if Display All Services is off </em>',
				'required' => '0',
				'post_type' => 
				array (
					0 => 'service_post',
				),
				'taxonomy' => 
				array (
					0 => 'all',
				),
				'max' => '',
				'order_no' => '3',
			),
		),
		'location' => 
		array (
			'rules' => 
			array (
				0 => 
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'template-services.php',
					'order_no' => '0',
				),
			),
			'allorany' => 'all',
		),
		'options' => 
		array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => 
			array (
				0 => 'the_content',
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => '50bdf2bbe4d1f',
		'title' => 'Slider',
		'fields' => 
		array (
			0 => 
			array (
				'key' => 'field_50b37cb896f5a',
				'label' => 'Slider',
				'name' => 'slider',
				'type' => 'repeater',
				'instructions' => '',
				'required' => '0',
				'sub_fields' => 
				array (
					0 => 
					array (
						'key' => 'field_50b37cb896f73',
						'label' => 'Image',
						'name' => 'image',
						'type' => 'image',
						'instructions' => '',
						'column_width' => '',
						'save_format' => 'object',
						'preview_size' => 'thumbnail',
						'order_no' => '0',
					),
				),
				'row_min' => '1',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Row',
				'order_no' => '0',
			),
		),
		'location' => 
		array (
			'rules' => 
			array (
				0 => 
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'project_post',
					'order_no' => '0',
				),
			),
			'allorany' => 'all',
		),
		'options' => 
		array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => 
			array (
			),
		),
		'menu_order' => 0,
	));
    register_field_group(array (
        'id' => '50bdf2bbe5e20',
        'title' => 'Download Url',
        'fields' => 
        array (
            0 => 
            array (
                'key' => 'field_50bdf2bbe5e21',
                'label' => 'XY Apple Download Url',
                'name' => 'xy_apple_download_url',
                'type' => 'text',
                'instructions' => '输入苹果下载网址：',
                'column_width' => '',
                'default_value' => '',
                'formatting' => 'html',
                'order_no' => '0',
            ),
            1 => 
            array (
                'key' => 'field_50bdf2bbe5e22',
                'label' => 'Android Download Url',
                'name' => 'android_download_url',
                'type' => 'text',
                'instructions' => '输入安卓下载网址：',
                'column_width' => '',
                'default_value' => '',
                'formatting' => 'html',
                'order_no' => '0',
            )
        ),
        'location' => 
        array (
            'rules' => 
            array (
                0 => 
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'project_post',
                    'order_no' => '0',
                ),
            ),
            'allorany' => 'all',
        ),
        'options' => 
        array (
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => 
            array (
            ),
        ),
        'menu_order' => 0,
    ));
}

?>