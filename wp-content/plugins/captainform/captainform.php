<?php
defined('ABSPATH') or die('No direct access!');
/*
  Plugin Name: CaptainForm Plugin
  Plugin URI: http://captainform.com
  Description: CaptainForm is a fully-featured WordPress form plugin created for web designers, developers, and also for non-tech savvy users.
  Author: CaptainForm
  Author URI: https://profiles.wordpress.org/captainform
  Version: 1.5.7
 */

/* * ****************************
 * includes
 * **************************** */
require_once(plugin_dir_path(__FILE__) . 'includes/init.php'); // session initialization
require_once(plugin_dir_path(__FILE__) . 'includes/encryption.php'); //captainform encryption class
require_once(plugin_dir_path(__FILE__) . 'includes/settings.php'); // this contain plugin settings
require_once(plugin_dir_path(__FILE__) . 'includes/shortcodes.php'); // this contain plugin shortcodes
require_once(plugin_dir_path(__FILE__) . 'includes/hooks.php'); //register the hooks
require_once(plugin_dir_path(__FILE__) . 'includes/display-functions.php'); // display content functions
require_once(plugin_dir_path(__FILE__) . 'includes/CaptainFormWidget.php'); // widget
require_once(plugin_dir_path(__FILE__) . 'includes/admin-page.php'); // the plugin options page HTML and save functions
require_once(plugin_dir_path(__FILE__) . 'views/main.php'); // the plugin options page HTML and save functions
require_once(plugin_dir_path(__FILE__) . 'views/options_page.php');
require_once(plugin_dir_path(__FILE__) . 'views/credentials_error.php');
require_once(plugin_dir_path(__FILE__) . 'includes/integrations/wp-integrations-handler.php');
require_once(plugin_dir_path(__FILE__) . 'includes/integrations/wp-posts.php');
require_once(plugin_dir_path(__FILE__) . 'includes/integrations/wp-users.php');

/* * ****************************
 * register hooks
 * **************************** */
register_activation_hook(__FILE__, 'captainform_activate');
register_deactivation_hook(__FILE__, 'captainform_deactivate');
register_uninstall_hook(__FILE__, 'captainform_uninstall');