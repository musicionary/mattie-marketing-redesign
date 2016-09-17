<?php
add_action('init', 'captainform_popup_resorces');
function captainform_popup_resorces()
{
	global $captainform_plugin_version;
	wp_enqueue_style('captainform_form_popup_style', plugins_url('/css/form_popup.css', plugin_dir_path(__FILE__)), array(), $captainform_plugin_version);
	$user_agent = getenv("HTTP_USER_AGENT");
	if (strpos($user_agent, "Mac") !== FALSE)
	{
		//wp_enqueue_style('captainform_iframe_popup', plugins_url('/css/wp_captainform_os.css', plugin_dir_path(__FILE__)), array(), $captainform_plugin_version);
		}
	wp_register_script('captainform_ires35', plugins_url('/js/iframeResizer.min.js', __DIR__), array(), $captainform_plugin_version, false);
	wp_enqueue_script('captainform_ires35');
	wp_register_script('captainform_form_popup', plugins_url('/js/form_popup.js', __DIR__), array('jquery'), $captainform_plugin_version, true);
	wp_enqueue_script('captainform_form_popup');
}
