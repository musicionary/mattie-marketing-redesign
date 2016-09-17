<?php

// 'size'=>'half_last',
// 'id'=>'logo_text',
// 'type'=>'text',
// 'note' => "Type the logo text here, then select a color, set a size and font",
// 'color_changer'=>true,
// 'font_changer'=>true,
// 'font_size_changer'=>array(1,10, 'em'),
// 'font_preview'=>array(true, true)

function make_input($size = null, $id = null, $type = null, $note = null, $values = null, $placeholder = null, $class= null) {
        $input_settings = array();
        $f = new ReflectionFunction('make_input');

        foreach ($f->getParameters() as $key => $value) {
               if(!empty($value->name))
                        $input_settings[$value->name] = ${$value->name};
        }

        return $input_settings;
}


return array(
        'favico' => array(
                'dir' => '/theme_config/icons/favicon.png'
        ),
        'tabs' => array(
                array(
                    'title' => 'General Options',
                    'icon' => 1,
                    'boxes' => array(

                            'Layout' => array(
                                    'icon' => 'customization',
                                    'size' => 'half',
                                    'columns' => true,
                                    'description' => '',
                                    'class' => 'layout-style',
                                    'input_fields' => array(
                                            'Layout Style' => make_input('half', 'layout_style', 'radio', 'Set your layout style. This setting will be applied for all pages. Pay attention, only with "Boxed" layout you will be abile to view "Main Background" image or color.', array('Wide', 'Boxed'), ''),
                                    ),      
                            ),

                            'Favicon' => array(
                                    'icon' => 'customization',
                                    'size' => 'half_last',
                                    'columns' => true,
                                    'description' => '',
                                    'class' => '',
                                    'input_fields' => array(
                                            'Favicon image' => make_input('half', 'favicon_link', 'image_upload', 'Here you can upload the favicon icon.' )
                                    ),      
                            ),

                            'Background Settings' => array(
                                    'icon' => 'customization',
                                    'size' => 'full',
                                    'columns' => true,
                                    'description' => '',
                                    'class' => '',
                                    'input_fields' => array(
                                            'Main background' => make_input('half', 'body_background', 'image_upload', 'Here you can upload a background image' ),
                                            'Background Color' => make_input('half', 'body_color', 'colorpicker', 'Here you can set a color for body background' ),
                                            'Canvas Color' => make_input('half', 'canvas_color', 'colorpicker', 'Here you can set a color for site canvas' ),
                                            'Background Repeat' => make_input('half', 'body_background_repeat', 'radio', '', array('Repeat', 'No-repeat', 'Repeat-X', 'Repeat-Y') ),
                                            'Background Position' => make_input('half', 'body_background_position', 'radio', '', array('Scroll', 'Fixed') ),
                                    ),      
                            ),
                            
                            'Page Settings'=>array(
                                    'icon'=>'customization',
                                    'description'=>'',
                                    'size'=>'full',
                                    'columns' => true,
                                    'class' => '',
                                    'input_fields'=>array(
                                            'Hide Related Posts? ' => array(
                                                'id'    => 'hide_related',
                                                'type'  => 'checkbox',
                                                'size' => 'half',
                                                'label' => 'Yes! please',
                                            ),

                                            'Hide Related Sermons? ' => array(
                                                'id'    => 'hide_related_s',
                                                'type'  => 'checkbox',
                                                'size' => 'half',
                                                'label' => 'Yes! please',
                                            ),

                                             'Related Posts Settings' => array(
                                                'id'    => 'related_settings',
                                                'type'  => 'text',
                                                'placeholder' => 'Related Posts|2' ,
                                                'size' => 'half',
                                                'note' => 'Insert here related posts title and nr. of related posts to show, Use this format "Related Posts|2"'
                                            ),

                                            'Related Sermons Settings' => array(
                                                'id'    => 'related_settings_s',
                                                'type'  => 'text',
                                                'placeholder' => 'Similear Sermons|4' ,
                                                'size' => 'half',
                                                'note' => 'Insert here related sermons title and nr. of related sermons to show, Use this format "Similear Sermons|4"'
                                            ),


                                            'Hide Breadcrumbs? ' => array(
                                                'id'    => 'hide_breadcrumbs',
                                                'type'  => 'checkbox',
                                                'size' => 'half',
                                                'label' => 'Yes! please',
                                            ),
                                    )
                            ),

                            'Social Settings'=>array(
                                    'icon'=>'social',
                                    'description'=>'',
                                    'size'=>'full',
                                    'columns' => true,
                                    'class' => '',
                                    'input_fields'=>array(
                                            'Social Platforms' => array(
                                                    'id'=>'social_platforms',
                                                    'size'=>'half',
                                                    'type'=>'social_platforms',
                                                    'note'=>'Insert the link to the social share page.',
                                                    'platforms'=>array('facebook','twitter','linkedin','rss','dribbble','google','pinterest','instagram','youtube')
                                            ),

                                            'ShareThis feature' => array(
                                                    'type'  => 'select',
                                                    'id'    => 'share_this',
                                                    'label' => 'Facebook',
                                                    'class' => 'social_search',
                                                    'size' => 'half_last',
                                                    'note' => 'To use this service please select your favorite social networks' ,
                                                    'multiple' => true,
                                                    'options'=>array('Google'=>'googleplus','Facebook'=>'facebook','Twitter'=>'twitter','Pinterest'=>'pinterest',"Linkedin"=>'linkedin')
                                            )
                                    )
                            ),
                    )
                ),
                array(
                    'title' => 'Typography',
                    'icon' => 3,
                    'boxes' => array(
                        'Global Typography' => array(
                            'icon' => 'customization',
                            'size' => 'half',
                            'columns' => true,
                            'description' => '',
                            'class' => '',
                            'input_fields' => array(
                                'Global Typography'=>array(
                                        'size'=>'half',
                                        'id'=>'global_typo',
                                        'type'=>'text',
                                        'note' => "Here you can change global font color, font family and font size",
                                        'color_changer'=>true,
                                        'font_changer'=>true,
                                        'font_size_changer'=>array(1,300, 'px'),
                                        'font_preview'=>array(false, false),
                                        'hide_input'=>true,
                                ),
                            ),      
                        ),
                        'Links style' => array(
                            'icon' => 'customization',
                            'size' => 'half',
                            'columns' => true,
                            'description' => '',
                            'class' => '',
                            'input_fields' => array(
                                'Links options'=>array(
                                        'size'=>'half',
                                        'id'=>'links_settings',
                                        'type'=>'text',
                                        'note' => "Here you can change link's font color, font family and font size",
                                        'color_changer'=>true,
                                        'font_changer'=>true,
                                        'font_size_changer'=>array(1,300, 'px'),
                                        'font_preview'=>array(false, false),
                                        'hide_input'=>true,
                                ),
                            ),      
                        ),
                        'Headings style' => array(
                            'icon' => 'customization',
                            'size' => 'full',
                            'columns' => true,
                            'description' => '',
                            'class' => '',
                            'input_fields' => array(
                                'Headings options'=>array(
                                        'size'=>'full',
                                        'id'=>'headings_settings',
                                        'type'=>'text',
                                        'note' => "Here you can change color and font family for headings. Also bellow you can adjust heading font size.",
                                        'color_changer'=>true,
                                        'font_changer'=>true,
                                        'font_size_changer'=> false,
                                        'font_preview'=>array(false, false),
                                        'hide_input'=>true,
                                ),
                                'Headings 1'=>array(
                                        'size'=>'1_3',
                                        'id'=>'headings_one_settings',
                                        'type'=>'text',
                                        'note' => "",
                                        'color_changer'=>false,
                                        'font_changer'=>false,
                                        'font_size_changer'=>array(1,300, 'px'),
                                        'font_preview'=>array(false, false),
                                        'hide_input'=>true,
                                ),
                                'Headings 2'=>array(
                                        'size'=>'1_3',
                                        'id'=>'headings_two_settings',
                                        'type'=>'text',
                                        'note' => "",
                                        'color_changer'=>false,
                                        'font_changer'=>false,
                                        'font_size_changer'=>array(1,300, 'px'),
                                        'font_preview'=>array(false, false),
                                        'hide_input'=>true,
                                ),
                                'Headings 3'=>array(
                                        'size'=>'1_3_last',
                                        'id'=>'headings_three_settings',
                                        'type'=>'text',
                                        'note' => "",
                                        'color_changer'=>false,
                                        'font_changer'=>false,
                                        'font_size_changer'=>array(1,300, 'px'),
                                        'font_preview'=>array(false, false),
                                        'hide_input'=>true,
                                ),
                                'Headings 4'=>array(
                                        'size'=>'1_3',
                                        'id'=>'headings_four_settings',
                                        'type'=>'text',
                                        'note' => "",
                                        'color_changer'=>false,
                                        'font_changer'=>false,
                                        'font_size_changer'=>array(1,300, 'px'),
                                        'font_preview'=>array(false, false),
                                        'hide_input'=>true,
                                ),
                                'Headings 5'=>array(
                                        'size'=>'1_3',
                                        'id'=>'headings_five_settings',
                                        'type'=>'text',
                                        'note' => "",
                                        'color_changer'=>false,
                                        'font_changer'=>false,
                                        'font_size_changer'=>array(1,300, 'px'),
                                        'font_preview'=>array(false, false),
                                        'hide_input'=>true,
                                ),
                                'Headings 6'=>array(
                                        'size'=>'1_3_last',
                                        'id'=>'headings_six_settings',
                                        'type'=>'text',
                                        'note' => "",
                                        'color_changer'=>false,
                                        'font_changer'=>false,
                                        'font_size_changer'=>array(1,300, 'px'),
                                        'font_preview'=>array(false, false),
                                        'hide_input'=>true,
                                ),
                            ),      
                        ),
                    )
                ),
                array(
                    'title' => 'Customize defaults',
                    'icon' => 1,
                    'boxes' => array(
                            
                            'Main background colors' => array(
                                    'icon' => 'customization',
                                    'size' => 'full',
                                    'columns' => true,
                                    'description' => 'Overwrite default colors.',
                                    'class' => '',
                                    'input_fields' => array(
                                            'Primary' => make_input('1_3', 'primary_color', 'colorpicker', 'Choose primary color for your website. This will affect only specific elements.
To return to default color , open colorpicker and click the Clear button.' ),
                                            'Secondary' => make_input('1_3', 'secondary_color', 'colorpicker', 'Choose secondary color for your website. This will affect only specific elements.
To return to default color , open colorpicker and click the Clear button.' ),
                                            'Tertiary' => make_input('1_3_last', 'tertiary_color', 'colorpicker', 'Choose tertiary color for your website. This will affect only specific elements.
To return to default color , open colorpicker and click the Clear button.' )
                                    ),      
                            ),
                    ),
                ),
                array(
                    'title' => 'Header',
                    'icon' => 8,
                    'boxes' => array(
                        'Header Settings' => array(
                            'icon' => 'customization',
                            'size' => 'full',
                            'columns' => true,
                            'description' => '',
                            'class' => '',
                            'input_fields' => array(
                                'Logo position' => make_input('1_3', 'logo_position', 'radio', '', array('left', 'center', 'right')),
                                'Navigation position' => make_input('1_3', 'nav_position', 'radio', '', array('left', 'center', 'right')),
                                'Navigation background' => make_input('half', 'navigation_color', 'colorpicker', 'Here you can change background color for navigation bar.' ),
                                'Navigation color' => make_input('half', 'navigation_text_color', 'colorpicker', 'Here you can change text color for navigation bar.' ),
                                'Header background image' => make_input('half', 'head_background_image', 'image_upload', 'Here you can change background image for header.' ),
                                'Header background color' => make_input('half_last', 'head_background_color', 'colorpicker', 'Here you can change background color for header.' ),
                            ),      
                        ),
                        'Identity Settings' => array(
                            'icon' => 'customization',
                            'size' => 'full',
                            'columns' => true,
                            'description' => '',
                            'class' => 'identity-helper',
                            'input_fields' => array(
                                    'Logo' => make_input('half', 'logo_image', 'image_upload', 'Here you can insert your link to a image logo or upload a new logo image.' ),
                                    'Logo As Text'=>array(
                                                    'size'=>'half',
                                                    'id'=>'logo_text',
                                                    'type'=>'text',
                                                    'note' => "Type the logo text here, then select a color, set a size and font.",
                                                    'color_changer'=>true,
                                                    'font_changer'=>true,
                                                    'font_size_changer'=>array(1,300, 'px'),
                                                    'font_preview'=>array(true, true)
                                            )
                            ),      
                        )
                    )
                ),
                array(
                        'title' => 'Footer',
                        'icon' => 8,
                        'boxes' => array(
                                'Footer Settings' => array(
                                        'icon' => 'customization',
                                        'size' => 'full',
                                        'columns' => true,
                                        'description' => '',
                                        'class' => '',
                                        'input_fields' => array(
                                            'Footer copyright' => make_input('half', 'footer_info', 'textarea', 'Insert copyright info', '', 'your content'),
                                            'Footer contact' => make_input('half', 'footer_email', 'text', 'Insert contact email', '', 'Email'),
                                             '' => make_input('half', 'footer_phone', 'text', 'Insert contact phone number', '', 'Phone'),
                                            'Footer background' => make_input('half', 'footer_background', 'colorpicker', 'Here you can change background color for footer.' ),
                                            'Footer Color' => make_input('half', 'footer_color', 'colorpicker', 'Here you can change text color for footer.' ),
                                            'Display subscribe box? ' => array(
                                                'id'    => 'display_subscribe',
                                                'type'  => 'checkbox',
                                                'size' => '1',
                                                'label' => 'Yes! please',
                                                'action' => array('show',array('subscribe_title'))
                                            ),

                                            'Subscribe title' => array(
                                                'id'    => 'subscribe_title',
                                                'type'  => 'text',
                                                'note' => 'Insert here subscribe box title' ,
                                                'size' => 'half',
                                            ),
                                        ),      
                                ),
                    ),
                ),
                array(
                        'title' => '404 error',
                        'icon' => 8,
                        'boxes' => array(
                                '404 content page error' => array(
                                        'icon'=>'',
                                        'size'=>'full',
                                        'columns'=>true,
                                        'description'=>'Here you can drop your "404 error" page content',
                                            'input_fields' => array(
                                                'Page title' => make_input('1_3', 'error_title', 'text', '' ),
                                                'Page subtitle' => make_input('1_3', 'error_subtitle', 'text', '' ),
                                                'Button Title' => make_input('1_3_last', 'error_button', 'text', '' ),
                                                'Error emblem' => make_input('half', 'error_emblem', 'image_upload', '' ),
                                                'Page background' => make_input('half_last', 'error_background', 'image_upload', '' ),
                                            )
                                ),
                            )
                ),
                array(
                        'title' => 'Developer',
                        'icon' => 6,
                        'boxes' => array(
                                'Custom CSS' => array(
                                        'icon'=>'css',
                                        'size'=>'half',
                                        'description'=>'Here you can write your personal CSS for customizing the classes you choose to modify.',
                                            'input_fields' => array(
                                                    make_input('half', 'custom_css', 'textarea', '' )
                                            )
                                ),
                                'Custom js' => array(
                                        'icon'=>'css',
                                        'size'=>'half',
                                        'description'=>'Here you can write your personal JS for customizing the classes you choose to modify.',
                                            'input_fields' => array(
                                                    make_input('half', 'custom_js', 'textarea', '' )
                                            )
                                ),

                                'Twitter Settings'=>array(
                                        'icon' => 'customization',
                                        'description'=>"Used by the Twitter widget. Visit <a href='https://dev.twitter.com/apps/new' target='_blank'>Twitter Apps</a> , create your App , press 'Generate Access token at the bottom', insert the following from the 'Oauth' tab.",
                                        'size'=>'half',
                                        'columns'=>false,
                                        'input_fields' =>array(
                                                'Consumer Key' => array(
                                                        'id'    => 'twitter_consumerkey',
                                                        'type'  => 'text',
                                                        'size' => '1'
                                                ),
                                                'Consumer Secret' => array(
                                                        'id'    => 'twitter_consumersecret',
                                                        'type'  => 'text',
                                                        'size' => '1',
                                                ),
                                                'Access Token' => array(
                                                        'id'    => 'twitter_accesstoken',
                                                        'type'  => 'text',
                                                        'size' => '1',
                                                ),
                                                'Access Token Secret' => array(
                                                        'id'    => 'twitter_accesstokensecret',
                                                        'type'  => 'text',
                                                        'size' => '1',
                                                )
                                        )
                                ),
                            ),
                ),
                array(
                        'title' => 'Subscribers',
                        'icon' => 3,
                        'boxes' => array(
                            
                                'Subscribers'=>array(
                                        'icon' => 'social',
                                        'description'=>'First 20 subscribers are listed here. To get the full list export files using buttons below:',
                                        'size'=>'full',
                                        'input_fields' => array(
                                                array(
                                                        'type'=>'subscription',
                                                        'id'=>'subscribe-form'
                                                )
                                        )
                                )
                            ),
                ),
        ),
        'option_saved_text' => 'Options successfully saved',
        'styles' => array( array('wp-color-picker'),'style','select2' ),
        'scripts' => array( array( 'jquery', 'jquery-ui-core','jquery-ui-datepicker','wp-color-picker' ), 'select2.min','jquery.cookie','tt_options', 'admin_js' )
);