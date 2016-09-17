<?php
define('THEME_NAME', 'credo');
define('THEME_PRETTY_NAME', 'Credo');

//Load Textdomain
add_action('after_setup_theme', 'tt_theme_textdomain_setup');
function tt_theme_textdomain_setup(){
	if(load_theme_textdomain('credo', get_template_directory() . '/languages'))
		define('TT_TEXTDOMAIN_LOADED',true);
}

//content width
if (!isset($content_width))
    $content_width = 1170;

//============Theme support=======
//post-thumbnails
add_theme_support('post-thumbnails');
//add feed support
add_theme_support('automatic-feed-links');