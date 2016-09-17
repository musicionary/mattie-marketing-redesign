<?php
defined('ABSPATH') or die('No direct access!');
global $captainform_plugin_name,
       $captainform_plugin_version,
       $captainform_formcode_pattern,
       $captainform_replace_patterns,
       $captainform_servicedomain,
       $captainform_option1,
       $captainform_option2,
       $captainform_option3,
       $captainform_widget_text_filter;

$captainform_plugin_name = 'captainform';
$captainform_plugin_version = "1.5.7";

//plugin options key name
$captainform_option1 = $captainform_plugin_name . '_installation_id';
$captainform_option2 = $captainform_plugin_name . '_installation_key';
$captainform_option3 = $captainform_plugin_name . '_site_url';

//plugin directory
$captainform_plugin_dir = plugin_dir_url(dirname(__FILE__));

//service domain for handler of form code
$captainform_servicedomain = 'app.captainform.com';

$params = array(
	'captainform_servicedomain' => $captainform_servicedomain,
	'captainform_plugin_dir' => $captainform_plugin_dir,
);

//Global Resources -- used for every type of embedding
$captainform_common_js_vars = captainform_getFormResources('global-vars', $params);
//TinyBox Resources
$captainform_tinybox_resources = captainform_getFormResources('tinybox-resources', $params);
//Normal Embedding
$captainform_formcode_pattern = $captainform_common_js_vars . captainform_getFormResources('normal-embedding', $params);
//LightBox Embedding [text/image/floating button]
$captainform_formcode_pattern_lightbox = $captainform_common_js_vars . $captainform_tinybox_resources . captainform_getFormResources('lightbox-embedding', $params);
//LightBox Embedding [auto-popup]
$captainform_formcode_pattern_lightbox_auto = $captainform_common_js_vars . $captainform_tinybox_resources . captainform_getFormResources('lightbox-auto-embedding', $params);

/**
 * Loads form resources
 * @param string - resource file
 * @param array - array of variables to replace in resource files
 * @return string
 **/
function captainform_getFormResources($resource, $params = array())
{
	if (count($params))
		foreach ($params as $key => $val)
			$$key = $val;

	ob_start();
	include_once("form-resources/$resource.php");
	return ob_get_clean();
}

/**
 * captainform_get_forms validates users based on wordpress app instalattion id and key
 **/
function captainform_get_forms($publish_method, $count = 2)
{
	$url = 'http://' . $GLOBALS['captainform_servicedomain'] . '/wp_dispatcher.php?app_id='
		. urlencode(get_site_option($GLOBALS['captainform_option1']))
		. '&app_key=' . urlencode(get_site_option($GLOBALS['captainform_option2']));

	if ($publish_method && $count == 2)
		$url .= '&publish_method=' . $publish_method;

	$res = wp_remote_fopen($url);
	if ($res === false)
		return false;

	return json_decode($res);
}

/**
 * replace patterns into strings that have patterns
 * @param string
 * @param array - associate array - key is pattern, value is string for replace pattern
 * @return string
 **/
function captainform_replace_patterns($str, $data = null)
{
	if ($data)
		if (is_array($data)) {
			foreach ($data as $k => $v)
				if ($k)
					$str = str_replace('{{' . strtoupper($k) . '}}', $v, $str);
		}
	return $str;
}
