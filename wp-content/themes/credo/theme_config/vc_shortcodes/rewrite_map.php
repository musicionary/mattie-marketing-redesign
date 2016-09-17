<?php

$vc_is_wp_version_3_6_more = version_compare( preg_replace( '/^([\d\.]+)(\-.*$)/', '$1', get_bloginfo( 'version' ) ), '3.6' ) >= 0;

$colors_arr = array (
	__( 'Blue', 'js_composer' ) => 'blue',
	__( 'Turquoise', 'js_composer' ) => 'turquoise',
	__( 'Pink', 'js_composer' ) => 'pink',
	__( 'Violet', 'js_composer' ) => 'violet',
	__( 'Peacoc', 'js_composer' ) => 'peacoc',
	__( 'Chino', 'js_composer' ) => 'chino',
	__( 'Mulled Wine', 'js_composer' ) => 'mulled_wine',
	__( 'Vista Blue', 'js_composer' ) => 'vista_blue',
	__( 'Black', 'js_composer' ) => 'black',
	__( 'Orange', 'js_composer' ) => 'orange',
	__( 'Sky', 'js_composer' ) => 'sky',
	__( 'Green', 'js_composer' ) => 'green',
	__( 'Juicy pink', 'js_composer' ) => 'juicy_pink',
	__( 'Sandy brown', 'js_composer' ) => 'sandy_brown',
	__( 'Purple', 'js_composer' ) => 'purple',
	__( 'White', 'js_composer' ) => 'white',
);

$size_arr = array (
	__( 'Mini', 'js_composer' ) => 'xs',
	__( 'Small', 'js_composer' ) => 'sm',
	__( 'Normal', 'js_composer' ) => 'md',
	__( 'Large', 'js_composer' ) => 'lg'
);


function tt_icons() {
	$icons = array(
			array(
				'type' => 'dropdown',
				'heading' => __( 'Icon library', 'js_composer' ),
				'value' => array(
					__( 'Font Awesome', 'js_composer' ) => 'fontawesome',
					__( 'Open Iconic', 'js_composer' ) => 'openiconic',
					__( 'Typicons', 'js_composer' ) => 'typicons',
					__( 'Entypo', 'js_composer' ) => 'entypo',
					__( 'Linecons', 'js_composer' ) => 'linecons',
					__( 'Tesla Icons', 'js_composer' ) => 'icomoon'
				),
				'admin_label' => true,
				'param_name' => 'type',
				'description' => __( 'Select icon library.', 'js_composer' ),
			),

			array(
				'type' => 'dropdown',
				'heading' => __( 'Icon library', 'js_composer' ),
				'value' => array(
					__( 'Font Awesome', 'js_composer' ) => 'fontawesome',
					__( 'Open Iconic', 'js_composer' ) => 'openiconic',
					__( 'Typicons', 'js_composer' ) => 'typicons',
					__( 'Entypo', 'js_composer' ) => 'entypo',
					__( 'Linecons', 'js_composer' ) => 'linecons',
					__( 'Tesla Icons', 'js_composer' ) => 'icomoon'
				),
				'admin_label' => true,
				'param_name' => 'type',
				'description' => __( 'Select icon library.', 'js_composer' ),
				'dependency' => array(
					'element' => 'add_icon',
					'value' => 'true',
				),
			),
			array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon', 'js_composer' ),
				'param_name' => 'icon_fontawesome',
				'value' => 'fa fa-adjust', // default value to backend editor admin_label
				'settings' => array(
					'emptyIcon' => false,
					// default true, display an "EMPTY" icon?
					'iconsPerPage' => 4000,
					// default 100, how many icons per/page to display, we use (big number) to display all icons in single page
				),
				'dependency' => array(
					'element' => 'type',
					'value' => 'fontawesome',
				),
				'description' => __( 'Select icon from library.', 'js_composer' ),
			),
			array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon', 'js_composer' ),
				'param_name' => 'icon_openiconic',
				'value' => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
				'settings' => array(
					'emptyIcon' => false, // default true, display an "EMPTY" icon?
					'type' => 'openiconic',
					'iconsPerPage' => 4000, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'type',
					'value' => 'openiconic',
				),
				'description' => __( 'Select icon from library.', 'js_composer' ),
			),
			array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon', 'js_composer' ),
				'param_name' => 'icon_typicons',
				'value' => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
				'settings' => array(
					'emptyIcon' => false, // default true, display an "EMPTY" icon?
					'type' => 'typicons',
					'iconsPerPage' => 4000, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'type',
					'value' => 'typicons',
				),
				'description' => __( 'Select icon from library.', 'js_composer' ),
			),
			array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon', 'js_composer' ),
				'param_name' => 'icon_entypo',
				'value' => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
				'settings' => array(
					'emptyIcon' => false, // default true, display an "EMPTY" icon?
					'type' => 'entypo',
					'iconsPerPage' => 4000, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'type',
					'value' => 'entypo',
				),
			),
			array(
				'type' => 'iconpicker',
				'heading' => __( 'Icon', 'js_composer' ),
				'param_name' => 'icon_linecons',
				'value' => 'vc_li vc_li-heart', // default value to backend editor admin_label
				'settings' => array(
					'emptyIcon' => false, // default true, display an "EMPTY" icon?
					'type' => 'linecons',
					'iconsPerPage' => 4000, // default 100, how many icons per/page to display
				),
				'dependency' => array(
					'element' => 'type',
					'value' => 'linecons',
				),
				'description' => __( 'Select icon from library.', 'js_composer' ),
			));
	return $icons;
}
$tt_icons = tt_icons();

global $vc_add_css_animation;

$vc_add_css_animation = array(
	'type' => 'dropdown',
	'heading' => __( 'CSS Animation', 'js_composer' ),
	'param_name' => 'css_animation',
	'admin_label' => true,
	'value' => array(
		__( 'No', 'js_composer' ) => '',
		__( 'Top to bottom', 'js_composer' ) => 'top-to-bottom',
		__( 'Bottom to top', 'js_composer' ) => 'bottom-to-top',
		__( 'Left to right', 'js_composer' ) => 'left-to-right',
		__( 'Right to left', 'js_composer' ) => 'right-to-left',
		__( 'Appear from center', 'js_composer' ) => 'appear'
	),
	'description' => __( 'Select type of animation for element to be animated when it "enters" the browsers viewport (Note: works only in modern browsers).', 'js_composer' )
);

global $vc_column_width_list;
$vc_column_width_list = array(
	__('1 column - 1/12', 'js_composer') => '1/12',
	__('2 columns - 1/6', 'js_composer') => '1/6',
	__('3 columns - 1/4', 'js_composer') => '1/4',
	__('4 columns - 1/3', 'js_composer') => '1/3',
	__('5 columns - 5/12', 'js_composer') => '5/12',
	__('6 columns - 1/2', 'js_composer') => '1/2',
	__('7 columns - 7/12', 'js_composer') => '7/12',
	__('8 columns - 2/3', 'js_composer') => '2/3',
	__('9 columns - 3/4', 'js_composer') => '3/4',
	__('10 columns - 5/6', 'js_composer') => '5/6',
	__('11 columns - 11/12', 'js_composer') => '11/12',
	__('12 columns - 1/1', 'js_composer') => '1/1'
);

/* Custom Heading element
----------------------------------------------------------- */
vc_map( array(
	'name' => __( 'Custom Heading', 'js_composer' ),
	'base' => 'vc_custom_heading',
	'icon' => 'icon-wpb-ui-custom_heading',
	'show_settings_on_create' => true,
	'category' => __( 'Content', 'js_composer' ),
	'description' => __( 'Text with Google fonts', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => __( 'Text source', 'js_composer' ),
			'param_name' => 'source',
			'value' => array(
				__( 'Custom text', 'js_composer' ) => '',
				__( 'Post or Page Title', 'js_composer' ) => 'post_title'
			),
			'std' => '',
			'description' => __( 'Select text source.', 'js_composer' )
		),
		array(
			'type' => 'textarea',
			'heading' => __( 'Text', 'js_composer' ),
			'param_name' => 'text',
			'admin_label' => true,
			'value' => __( 'This is custom heading element', 'js_composer' ),
			'description' => __( 'If you are using non-latin characters be sure to activate them under Settings/Visual Composer/General Settings.', 'js_composer' ),					'description' => __( 'Note: If you are using non-latin characters be sure to activate them under Settings/Visual Composer/General Settings.', 'js_composer' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Make uppercase', 'js_composer' ),
			'param_name' => 'make_uppercase',
			'value' => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
			'description' => __( 'Transform text to uppercase', 'js_composer' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'No margin top', 'js_composer' ),
			'param_name' => 'no_top',
			'value' => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
			'description' => __( 'Best for section titles, remove top space.', 'js_composer' ),
		),
		array(
			'type' => 'vc_link',
			'heading' => __( 'URL (Link)', 'js_composer' ),
			'param_name' => 'link',
			'description' => __( 'Add link to custom heading.', 'js_composer' ),
			// compatible with btn2 and converted from href{btn1}
		),
		array(
			'type' => 'font_container',
			'param_name' => 'font_container',
			'value' => '',
			'settings' => array(
				'fields' => array(
					'tag' => 'h2', // default value h2
					'text_align',
					'font_size',
					'line_height',
					'color',
					//'font_style_italic'
					//'font_style_bold'
					//'font_family'

					'tag_description' => __( 'Select element tag.', 'js_composer' ),
					'text_align_description' => __( 'Select text alignment.', 'js_composer' ),
					'font_size_description' => __( 'Enter font size.', 'js_composer' ),
					'line_height_description' => __( 'Enter line height.', 'js_composer' ),
					'color_description' => __( 'Select color for your element.', 'js_composer' ),
					//'font_style_description' => __('Put your description here','js_composer'),
					//'font_family_description' => __('Put your description here','js_composer'),
				),
			),
			// 'description' => __( '', 'js_composer' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Use theme default font family?', 'js_composer' ),
			'param_name' => 'use_theme_fonts',
			'value' => array( __( 'Yes', 'js_composer' ) => 'yes' ),
			'description' => __( 'Use font family from the theme.', 'js_composer' ),
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Select font weight', 'js_composer' ),
			'param_name' => 'fnt_weight',
			'value' => array(
				'300',
				'400',
				'500',
				'700'
			),
			'std' => '300',
			'dependency' => array(
				'element' => 'use_theme_fonts',
				'value' => 'yes',
			),
		),


		array(
			'type' => 'google_fonts',
			'param_name' => 'google_fonts',
			'value' => 'font_family:Lato|font_style:400%20regular%3A400%3Anormal', // default
			//'font_family:'.rawurlencode('Abril Fatface:400').'|font_style:'.rawurlencode('400 regular:400:normal')
			// this will override 'settings'. 'font_family:'.rawurlencode('Exo:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic').'|font_style:'.rawurlencode('900 bold italic:900:italic'),
			'settings' => array(
				//'no_font_style' // Method 1: To disable font style
				//'no_font_style'=>true, // Method 2: To disable font style
				'fields' => array(
					//'font_family' => 'Abril Fatface:regular',
					//'Exo:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic',// Default font family and all available styles to fetch
					//'font_style' => '400 regular:400:normal',
					// Default font style. Name:weight:style, example: "800 bold regular:800:normal"
					'font_family_description' => __( 'Select font family.', 'js_composer' ),
					'font_style_description' => __( 'Select font styling.', 'js_composer' )
				)
			),
			'dependency' => array(
				'element' => 'use_theme_fonts',
				'value_not_equal_to' => 'yes',
			),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
		),
		array(
			'type' => 'css_editor',
			'heading' => __( 'CSS box', 'js_composer' ),
			'param_name' => 'css',
			// 'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
			'group' => __( 'Design Options', 'js_composer' )
		)
	),
) );


/* TT Custom Heading
----------------------------------------------------------- */
vc_map( array(
	'name' => __( 'Tesla Section Header', 'js_composer' ),
	'base' => 'tt_section_header',
	'icon' => 'icon-wpb',
	'category' => __( 'Teslathemes', 'js_composer' ),
	'description' => __( 'TT custom section header', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textarea',
			'heading' => __( 'Text', 'js_composer' ),
			'param_name' => 'text',
			'admin_label' => true,
			'value' => __( 'This is custom heading element', 'js_composer' ),
		),
		array(
			'type' => 'textarea',
			'heading' => __( 'Heading description', 'js_composer' ),
			'param_name' => 'subtext',
			'admin_label' => true,
			'value' => __( 'This is a small heading description', 'js_composer' ),
			'description' => __( 'If you are using non-latin characters be sure to activate them under Settings/Visual Composer/General Settings.', 'js_composer' ),
			'description' => __( 'Note: If you are using non-latin characters be sure to activate them under Settings/Visual Composer/General Settings.', 'js_composer' ),
		),
	
		array(
			'type' => 'font_container',
			'param_name' => 'font_container',
			'value' => '',
			'settings' => array(
				'fields' => array(
					'tag' => 'h2', // default value h2
					'text_align',
					'font_size',
					'line_height',
					'color',
					'tag_description' => __( 'Select element tag.', 'js_composer' ),
					'text_align_description' => __( 'Select text alignment.', 'js_composer' ),
					'font_size_description' => __( 'Enter font size.', 'js_composer' ),
					'line_height_description' => __( 'Enter line height.', 'js_composer' ),
					'color_description' => __( 'Select color for your element.', 'js_composer' ),
				),
			),
		),
		
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'Style particular content element differently - add a existing class name (black, white) or another custom class from CSS.', 'js_composer' ),
		),

		array(
			'type' => 'css_editor',
			'heading' => __( 'Css', 'js_composer' ),
			'param_name' => 'css',
			'group' => __( 'Design options', 'js_composer' )
		)
	),
) );


/* TT Team member */
vc_map( array(
	'name' => __( 'Tesla Member', 'js_composer' ),
	'base' => 'tt_member',
	'icon' => 'icon-wpb',
	'category' => __( 'Teslathemes', 'js_composer' ),
	'description' => __( 'Team member', 'js_composer' ),
	"params" => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Member Name', 'js_composer' ),
			'param_name' => 'member_name',
			'description' => __( 'Provide a name for team member element', 'js_composer' ),
			'admin_label' => true
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Member job location/position', 'js_composer' ),
			'param_name' => 'member_job',
			'description' => __( 'Provide job position for this member', 'js_composer' ),
			'admin_label' => true
		),
		array(
			'type' => 'textarea',
			'heading' => __( 'Member intro text', 'js_composer' ),
			'param_name' => 'member_intro',
			'value' => __( '', 'js_composer' ),
			'description' => __( 'Memeber intro text shown on hover', 'js_composer' )
		),
		array(
			'type' => 'attach_image',
			'heading' => __( 'Member image', 'js_composer' ),
			'param_name' => 'member_image',
			'value' => '',
			'description' => __( 'Select image from media library.', 'js_composer' )
		),
		array(
			'type' => 'href',
			'heading' => __( 'URL (Link)', 'js_composer' ),
			'param_name' => 'member_url',
			'description' => __( 'Member link.', 'js_composer' )
		),
		array(
			'type' => 'exploded_textarea',
			'heading' => __( 'Social networks', 'js_composer' ),
			'param_name' => 'member_social',
			'description' => __( 'Please provide social icon name from <a href="https://fortawesome.github.io/Font-Awesome/icons/" target="_blank">fontawesome</a> and social link. Example facebook|http://facebook.com', 'js_composer' ),
			'value' => "facebook|http://facebook.com,twitter|http://twitter.com"
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	)
) );

/* TT Contact Block */
vc_map( array(
	'name' => __( 'Tesla Contact Item', 'js_composer' ),
	'base' => 'tt_contact_item',
	'icon' => 'icon-wpb',
	'category' => __( 'Teslathemes', 'js_composer' ),
	'description' => __( 'Tesla Contac Item, used for building contact page', 'js_composer' ),
	"params" => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Title', 'js_composer' ),
			'param_name' => 'item_title',
			'description' => __( 'Provide a title for this element', 'js_composer' ),
			'admin_label' => true
		),

		array(
			'type' => 'attach_image',
			'heading' => __( 'Image', 'js_composer' ),
			'param_name' => 'item_image',
			'value' => '',
			'description' => __( 'Select image from media library.', 'js_composer' )
		),

		array(
			'type' => 'textarea',
			'heading' => __( 'Location', 'js_composer' ),
			'param_name' => 'item_location',
			'value' => __( '', 'js_composer' ),
			'description' => __( 'Insert here location', 'js_composer' )
		),

		array(
			'type' => 'textarea',
			'heading' => __( 'Additional details', 'js_composer' ),
			'param_name' => 'item_additional',
			'value' => __( '', 'js_composer' ),
			'description' => __( 'Insert here additional information, ex: phone, email', 'js_composer' )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Contact Form ID', 'js_composer' ),
			'param_name' => 'item_form_id',
			'description' => __( 'Insert here contact form ID, which you created with <a href="'.admin_url('admin.php?page=tt_contact_builder').'" target="_blank">Tesla Form Builder</a>', 'js_composer' ),
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		),

		array(
			'type' => 'css_editor',
			'heading' => __( 'Css', 'js_composer' ),
			'param_name' => 'css',
			// 'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
			'group' => __( 'Design options', 'js_composer' )
		)
	)
));

/* TT Contact Block */
vc_map( array(
	'name' => __( 'Tesla Google Map', 'js_composer' ),
	'base' => 'tt_tesla_map',
	'icon' => 'icon-wpb',
	'category' => __( 'Teslathemes', 'js_composer' ),
	'description' => __( 'Tesla Google Map', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'param_group',
			'heading' => __( 'Pins', 'js_composer' ),
			'param_name' => 'contact_pins',
			'description' => __( 'Insert here contact pins locations, click on " + " icon to add new pin. <br/><br/>
				Get the coordinates of a place you find on the map with your browser, like Chrome, Firefox, or Internet Explorer. <br/>
					1. Open <a href="https://maps.google.com/" target="_blank">Google Maps</a>. <br/>
					2. Right-click the place or area on the map. <br/>
					3. Select Whats here?  <br/>
					4. A card appears at the bottom of the screen with more info. <br/>', 'js_composer' ),
			'value' => urlencode( json_encode( array(
				array(
					'info_latitude' 	=> __( '51.225305', 'js_composer' ),
					'info_longitude' 	=> __( '10.225305', 'js_composer' ),

				),
			) ) ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => __( 'Latitude', 'js_composer' ),
					'param_name' => 'info_latitude',
					'description' => __( 'Insert here google map latitude', 'js_composer' ),
					'admin_label' => true,
				),
			
				array(
					'type' => 'textfield',
					'heading' => __( 'Longitude', 'js_composer' ),
					'param_name' => 'info_longitude',
					'description' => __( 'Insert here google map longidute', 'js_composer' ),
					'admin_label' => true,
				),

				array(
					'type' => 'attach_image',
					'heading' => __( 'Pin Icon', 'js_composer' ),
					'param_name' => 'info_icon',
					'description' => __( 'Select pin from media library', 'js_composer' ),
				),
			)
		)
	)
)
);


/* TT Gallery */
vc_map( array(
	'name' => __( 'Tesla Gallery', 'js_composer' ),
	'base' => 'tt_gallery',
	'icon' => 'icon-wpb',
	'category' => __( 'Teslathemes', 'js_composer' ),
	'description' => __( 'Tesla Gallery', 'js_composer' ),
	"params" => array(
		array(
			'type' => 'attach_images',
			'heading' => __( 'Images', 'js_composer' ),
			'param_name' => 'images',
			'value' => '',
			'description' => __( 'Select images from media library.', 'js_composer' ),
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Gallery Max-Width', 'js_composer' ),
			'param_name' => 'gallery_max',
			'value' => '',
			'description' => __( 'Please insert a maximum width in PX for gallery section. Default will be used "1600"', 'js_composer' )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		),

		array(
			'type' => 'css_editor',
			'heading' => __( 'Css', 'js_composer' ),
			'param_name' => 'css',
			// 'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
			'group' => __( 'Design options', 'js_composer' )
		)
	)
) );

/* TT Breadcrumbs */
vc_map( array(
	'name' => __( 'Tesla Breadcrumps', 'js_composer' ),
	'base' => 'tt_breadcrumb_list',
	'icon' => 'icon-wpb',
	'category' => __( 'Teslathemes', 'js_composer' ),
	'description' => __( 'Tesla Breadcrumbs', 'js_composer' ),
	"params" => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		),
	)
) );

/* TT Events */

$categories = get_terms( 'events_tax', array( 'hide_empty' => 0 ) );
$cats['All'] = '';

$post_categories = get_terms( 'category', array( 'hide_empty' => 0 ) );
$post_cats['All'] = '';

$sermon_categories = get_terms( 'sermons_tax', array( 'hide_empty' => 0 ) );
$sermon_cats['All'] = '';

if(!is_wp_error($categories)) {
	foreach($categories as $category) 
		$cats[$category->name] = $category->slug;
}

if(!is_wp_error($post_categories)) {
	foreach($post_categories as $category) 
		$post_cats[$category->name] = $category->term_id;
}

if(!is_wp_error($sermon_categories)) {
	foreach($sermon_categories as $category) 
		$sermon_cats[$category->name] = $category->slug;
}

vc_map( array(
	'name' => __( 'Tesla Events', 'js_composer' ),
	'base' => 'tt_events',
	'icon' => 'icon-wpb',
	'category' => __( 'Teslathemes', 'js_composer' ),
	'description' => __( 'Tesla Events', 'js_composer' ),
	"params" => array(
		array(
			'type' => 'dropdown',
			'heading' => __( 'Shortcode Style', 'js_composer' ),
			'value' => array(
				__( 'Single Column', 'js_composer' ) => '1',
				__( 'Multiple Columns', 'js_composer' ) => '2',
			),
			'admin_label' => true,
			'param_name' => 'shortcode_type',
			'description' => __( 'Select shortcode style to display.', 'js_composer' ),
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Columns', 'js_composer' ),
			'value' => array(
				__( '2 Columns', 'js_composer' ) => '6',
				__( '3 Columns', 'js_composer' ) => '4',
				__( '4 Columns', 'js_composer' ) => '3',
				__( '6 Columns', 'js_composer' ) => '2',
			),
			'std' => '3',
			'param_name' => 'columns',
			'description' => __( 'Select numbers of columns. Default "3 Columns"', 'js_composer' ),
			'dependency' => array(
				'element' => 'shortcode_type',
				'value' => '2',
			),
		),

		array(
			'type' => 'checkbox',
			'heading' => __( 'Show Calendar?', 'js_composer' ),
			'param_name' => 'show_calendar',
			'description' => __( 'Check this if you want calendar with events to appear.', 'js_composer' ),
			'value' => array( __( 'Yes, please', 'js_composer' ) => 'yes' ),
			'std' => 'yes',
			'dependency' => array(
				'element' => 'shortcode_type',
				'value' => '1',
			),
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Default Category', 'js_composer' ),
			'value' => $cats,
			'param_name' => 'category',
			'description' => __( 'Select which category you want to display.', 'js_composer' ),
			'dependency' => array(
				'element' => 'shortcode_type',
				'value' => '2',
			),
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Nr. of events to show', 'js_composer' ),
			'param_name' => 'nr',
			'value' => '',
			'description' => __( 'Please insert how much events you want to show. Default "All"', 'js_composer' ),
			'dependency' => array(
				'element' => 'shortcode_type',
				'value' => '2',
			),
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Page URL', 'js_composer' ),
			'param_name' => 'page_url',
			'value' => '',
			'description' => __( 'Please insert page URL, where is located the single column shortcode of events.', 'js_composer' ),
			'dependency' => array(
				'element' => 'shortcode_type',
				'value' => '2',
			),
		),


		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	)
) );

vc_map( array(
	'name' => __( 'Tesla Sermons', 'js_composer' ),
	'base' => 'tt_sermons',
	'icon' => 'icon-wpb',
	'category' => __( 'Teslathemes', 'js_composer' ),
	'description' => __( 'Tesla Sermons', 'js_composer' ),
	"params" => array(

		array(
			'type' => 'dropdown',
			'heading' => __( 'Columns', 'js_composer' ),
			'value' => array(
				__( '2 Columns', 'js_composer' ) => '6',
				__( '3 Columns', 'js_composer' ) => '4',
				__( '4 Columns', 'js_composer' ) => '3',
				__( '6 Columns', 'js_composer' ) => '2',
			),
			'std' => '3',
			'param_name' => 'columns',
			'description' => __( 'Select numbers of columns. Default "4 Columns"', 'js_composer' ),

		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Default Category', 'js_composer' ),
			'value' => $sermon_cats,
			'param_name' => 'category',
			'description' => __( 'Select which category you want to display.', 'js_composer' ),
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Nr. of sermons to show', 'js_composer' ),
			'param_name' => 'nr',
			'value' => '',
			'description' => __( 'Please insert how much events you want to show. Default "All" with "Load More" button', 'js_composer' ),
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	)
) );


$query = new WP_Query(array(
	'post_type' => 'events',
));

$events_posts = array();

while($query->have_posts()) : $query->the_post();
	$events_posts[get_the_title().' - '.get_the_time(get_option('date_format').' '.get_option('time_format'), get_the_ID())] = get_the_ID();
endwhile;

vc_map( array(
	'name' => __( 'Tesla Event Countdown', 'js_composer' ),
	'base' => 'tt_event_countdown',
	'icon' => 'icon-wpb',
	'category' => __( 'Teslathemes', 'js_composer' ),
	'description' => __( 'Tesla Event Countdown', 'js_composer' ),
	"params" => array(

		array(
			'type' => 'dropdown',
			'heading' => __( 'Post', 'js_composer' ),
			'value' => $events_posts,
			'param_name' => 'event_post',
			'description' => __( 'Select for which post you want to display countdown', 'js_composer' ),

		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Page URL', 'js_composer' ),
			'param_name' => 'page_url',
			'value' => '',
			'description' => __( 'Please insert page URL, where is located the single column shortcode of events.', 'js_composer' ),
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	)
) );

vc_map( array(
	'name' => __( 'Tesla Blog Posts', 'js_composer' ),
	'base' => 'tt_blogposts',
	'icon' => 'icon-wpb',
	'category' => __( 'Teslathemes', 'js_composer' ),
	'description' => __( 'Tesla Blog Posts', 'js_composer' ),
	"params" => array(
		array(
			'type' => 'dropdown',
			'heading' => __( 'Default Category', 'js_composer' ),
			'value' => $post_cats,
			'param_name' => 'category',
			'description' => __( 'Select which category you want to display.', 'js_composer' ),
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Nr. of posts to show', 'js_composer' ),
			'param_name' => 'posts_nr',
			'value' => '',
			'description' => __( 'Please insert how much events you want to show. Default "All"', 'js_composer' ),
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		)
	)
) );

