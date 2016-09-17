<?php
/**
 * Plugin Name: Tesla Framework
 * Plugin URI: http://teslathemes.com/framework-tour/
 * Description: Tesla Framework
 * Version: 1.2.3
 * Author: TeslaThemes
 * Author URI: http://teslathemes.com/
 * License: GPL2
 */

define ( 'TT_FW_PL', plugin_dir_path( __FILE__ ) );
define ( 'TT_FW_PL_URI', plugin_dir_url( __FILE__ ) );

if( file_exists(get_template_directory() . '/theme_config/theme-details.php') && !file_exists(get_template_directory() . '/tesla_framework/core/tesla_admin.php') ){	//if Tesla Theme with stripped version of FW
	//Load framework constants
	if( file_exists( TT_FW_PL . 'config/constants.php' ) )
		require_once TT_FW_PL . 'config/constants.php';

	//Load theme details
	require_once TT_THEME_DIR . '/theme_config/theme-details.php';

	if(!defined('THEME_OPTIONS'))
		define('THEME_OPTIONS', THEME_NAME . '_options');

	//Load main framework classes
	require_once TT_FW_PL . 'core/teslaframework.php';
	require_once TT_FW_PL . 'core/tesla_admin.php';
	require_once TT_FW_PL . 'core/tt_load.php';
	if(file_exists(TT_FW_PL . 'core/tt_security.php'))
		require_once TT_FW_PL . 'core/tt_security.php';
	else
		exit();
	//TT ENQUEUE
	require_once TT_FW_PL . 'core/tt_enqueue.php';
	
	//Admin load
	$TTA = new Tesla_admin;

	//Custom posts
	if(file_exists(TT_THEME_DIR . '/theme_config/slider-options.php')){
		require_once TT_FW_PL . 'core/tesla_slider.php';
		add_action('after_setup_theme','tt_custom_posts_plugin');
		if(!function_exists('tt_custom_posts_plugin')){
			function tt_custom_posts_plugin(){
				Tesla_slider::init();
			}
		}
	}

	//Contact Form Builder
	if(file_exists(TT_FW_PL . 'core/tt_contact_form.php') && file_exists(TT_THEME_DIR . '/theme_config/contact-form-config.php')){
		require_once TT_FW_PL . 'core/tt_contact_form.php';
		TT_Contact_Form_Builder::init_builder();
	}

	//Subscription
	if(file_exists(TT_THEME_DIR . '/theme_config/subscription.php')) {
		require_once TT_FW_PL . 'core/tt_subscription.php';
		TT_Subscription::subscription_init();
	}

	//action for theme to safelly hook -- prezent in full theme fw also
	add_action( 'init' , 'tt_do_fw_init' );
	function tt_do_fw_init(){
		do_action( 'tt_fw_init' );
	}
}