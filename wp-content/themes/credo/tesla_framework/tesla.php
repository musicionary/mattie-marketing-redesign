<?php
if(!class_exists('TeslaFrameworkPL')){
	//define TeslaThemesFramework directory name
	if(!defined('TTF'))
		define('TTF', get_template_directory() . '/tesla_framework');
	//Load framework constants
	require_once TTF . '/config/constants.php';

	//Load theme details
	require_once TT_THEME_DIR . '/theme_config/theme-details.php';

	if(!defined('THEME_OPTIONS'))
		define('THEME_OPTIONS', THEME_NAME . '_options');

	//Load main framework classes
	require_once TTF . '/helpers/general.php';
	require_once TTF . '/helpers/admin.php';
	require_once TTF . '/helpers/twitter.php';
	require_once TTF . '/helpers/instagram.php';
	//TT ENQUEUE
	require_once TTF . '/core/tt_enqueue.php';
}