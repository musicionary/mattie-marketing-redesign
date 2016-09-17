<?php
function captainform_session_start()
{
	session_start(array('cookie_lifetime' => 86400));
}

//BugFix for WP4.4.2 + Twenty Ten Theme
function captainform_add_jquery()
{
	wp_enqueue_script('jquery');
}

function check_captainform_settings(){
	if (get_site_option($GLOBALS['captainform_option1']) == '') {
		add_site_option($GLOBALS['captainform_option1'], captainform_generate_installation_id());
	}

	if (get_site_option($GLOBALS['captainform_option2']) == '') {
		add_site_option($GLOBALS['captainform_option2'], captainform_generate_installation_key());
	}

	if (get_site_option($GLOBALS['captainform_option3']) == '') {
		add_site_option($GLOBALS['captainform_option3'], get_site_option("siteurl"));
	}
}

if (!session_id())
	add_action('init', 'captainform_session_start');
add_action('init', 'captainform_add_jquery');
add_action('init', 'check_captainform_settings');