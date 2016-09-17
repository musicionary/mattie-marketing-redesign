<?php
defined('ABSPATH') or die('No direct access!');

function captainform_generate_installation_id()
{
	// we generate an installationId with maximum length of 58, because the space in DB is 60
	// and we prepend -- for the email
	$alphanum = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";

	$admin_email = get_site_option("admin_email");
	$timestamp = dechex(time());

	$neededChars = 13 - strlen($timestamp);
	$rand = substr(str_shuffle($alphanum), 0, $neededChars);

	$computedId = $timestamp . $rand . "." . $admin_email;

	if (strlen($computedId) >= 58)
		$computedId = substr($computedId, -58);
	return $computedId;
}

function captainform_generate_installation_key()
{
	$alphanum = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
	$installation_key = md5(substr(str_shuffle($alphanum), 0, 15));
	return $installation_key;
}

function captainform_update_website_url(){
	update_site_option($GLOBALS['captainform_option3'], get_site_option("siteurl"));
}

function captainform_generate_new_credentials()
{
	$installation_id = captainform_generate_installation_id();
	update_site_option($GLOBALS['captainform_option1'], $installation_id);

	$installation_key = captainform_generate_installation_key();
	update_site_option($GLOBALS['captainform_option2'], $installation_key);

	captainform_update_website_url();
}

function captainform_get_site_type()
{
	return is_multisite();
}

function captainform_get_ref_param()
{
	$plugin_referer = '';
	$myref = (__DIR__) . '/referer.php';
	if (file_exists($myref)) {
		require_once($myref);
		$plugin_referer = '&plugin_referer=' . $captainform_referer;
	}
	return $plugin_referer;
}

function check_credentials_error(){
	$site_url = get_site_option($GLOBALS['captainform_option3']);
	$site = get_site_option("siteurl");
	
	if(!empty($site_url) && $site_url != $site)
	{
		if(isset($_POST['captainform_reset_keys']))
		{
			if(intval($_POST['captainform_reset_keys']) == 1)
				captainform_generate_new_credentials();
			else
			{
				captainform_update_website_url();
				return $site;
			}
			return true;
		}
		captainform_draw_credentials_error();
		return false;
	}
	return true;
}

function captainform_page_handler()
{
	global $captainform_plugin_version;
	
	$credentials_check = check_credentials_error();
	if (!$credentials_check) return false;
	
	$installation_id = get_site_option($GLOBALS['captainform_option1']);
	$installation_key = get_site_option($GLOBALS['captainform_option2']);
	$site = get_site_option("siteurl");
	$site_real = get_option("siteurl");

	$current_user = wp_get_current_user();
	$display_name = $current_user->data->display_name;
	$page = $_GET['page'];
	$wp_protocol = parse_url(site_url(), 0);
	$wp_subid = "wp-" . str_replace('.' . get_site_option("admin_email"), "", $installation_id);
	$wp_subid = explode('.', $wp_subid);
	$wp_subid = $wp_subid[0];
	
	$wp_seturl = $wp_protocol . "://" . $wp_subid . "." . $GLOBALS['captainform_servicedomain'];

	$wp_seturl = strtolower($wp_seturl);
	$url = $wp_seturl . "/fh-connect.php?inst=" . captainform_wpp_encrypt($installation_id) . 
	"&key=" . captainform_wpp_encrypt($installation_key) . 
	"&site=" . captainform_wpp_encrypt($site) . 
	"&site_real=" . captainform_wpp_encrypt($site_real) . 
	"&display_name=" . captainform_wpp_encrypt($display_name) . 
	"&page=" . $page . 
	"&is_multisite=" . var_export(captainform_get_site_type(), true) . 
	captainform_get_ref_param() . 
	"&wp_version=" . captainform_wpp_encrypt($captainform_plugin_version) . 
	"&wp_php=" . captainform_wpp_encrypt(phpversion());
	
	if(gettype($credentials_check) == 'string')
		$url .= '&wp_url_changed=true';
	
	switch ($page) {
		case "CaptainForm":
		case 'CaptainForm-NewForm':
		case 'CaptainForm-MyAccount':
		case 'CaptainForm-ChangePlan':
		case 'CaptainForm-Support':
			if (isset($_GET['cf_form_id'])) {
				ob_end_clean();
				captainform_preview_form();
			}
			captainform_draw_main_iframe($url, array($wp_subid . "." . $GLOBALS['captainform_servicedomain'], $wp_protocol, $wp_seturl));
			break;
		case "Captainform-Preview":
			break;
		case "CaptainFormOptions":
			captainform_options_page();
			break;
		default:
			break;
	}
}

function captainform_preview_form($redirect = true)
{
	$special_captainform_code = "[captainform i{cf_form_id}]";
	$post_type = "captainform_post";
	$post_exists = false;
	$post_arr = array();
	$post_content = null;
	$post_id = null;
	if (isset($_GET['cf_form_id']))
		$form_id = (int)$_GET['cf_form_id'];
	else
		$form_id = 726633;

	if (isset($_GET['captainform_theme_style'])) {
		$captainform_theme_style = $_GET['captainform_theme_style'];
	}
	if (isset($_GET['captainform_preview_as_lightbox'])) {
		$captainform_preview_as_lightbox = $_GET['captainform_preview_as_lightbox'];
	}

	//search for the post
	$args = "post_type=" . $post_type;
	$query1 = new WP_Query($args);

	if ($query1->have_posts())
		while ($query1->have_posts()) {
			$post_arr = $query1->the_post();
			$post_id = $query1->post->ID;
			$post_content = get_the_content();
			$post_exists = true;
			break;
		}
	wp_reset_postdata();

	//Create the post if not exists
	if ($post_exists == false) {
		$post = array(
			'post_content' => $special_captainform_code, // The full text of the post.
			'post_name' => "CaptainForm_form_preview", // The name (slug) for your post
			'post_title' => "CaptainForm Preview", // The title of your post.
			'post_status' => 'draft',
			'post_type' => $post_type,
			'post_excerpt' => $special_captainform_code, // For all your post excerpt needs.
		);
		$post_id = wp_insert_post($post);
	} else if ($post_exists == true && strpos($post_content, $special_captainform_code) === false && $post_id != null) {
		$my_post = array();
		$my_post['ID'] = $post_id;
		$my_post['post_content'] = $post_content . $special_captainform_code;
		wp_update_post($my_post);
	}

	$url = add_query_arg('cf_form_id', $form_id, (get_permalink($post_id)));
	if (isset($_GET['captainform_theme_style']))
		$url = add_query_arg('captainform_theme_style', $captainform_theme_style, $url);
	if (isset($_GET['captainform_preview_as_lightbox']))
		$url = add_query_arg('captainform_preview_as_lightbox', $captainform_preview_as_lightbox, $url);

	if ($redirect === true) {
		wp_redirect($url);
		exit();
	} else
		return $url;
}

function captainform_remove_menu_items()
{
	remove_menu_page('edit.php?post_type=' . 'captainform_post');
}

add_action('admin_menu', 'captainform_remove_menu_items');

function captainform_add_options_link()
{
	if (current_user_can('manage_options')) {
		add_menu_page('CaptainForm', 'CaptainForm', 'manage_options', 'CaptainForm', 'captainform_page_handler', plugins_url('/images/captainform-18.png', __FILE__), '6.000000000000000000123123123123123123123');
		add_submenu_page('CaptainForm', 'CaptainForm', 'My Forms', 'manage_options', 'CaptainForm', 'captainform_page_handler');
		add_submenu_page('CaptainForm', 'NewForm', 'New Form', 'manage_options', 'CaptainForm-NewForm', 'captainform_page_handler');
		add_submenu_page('CaptainForm', 'MyAccount', 'My Account', 'manage_options', 'CaptainForm-MyAccount', 'captainform_page_handler');
		add_submenu_page('CaptainForm', 'ChangePlan', 'Change Plan', 'manage_options', 'CaptainForm-ChangePlan', 'captainform_page_handler');
		add_submenu_page('CaptainForm', 'Support', 'Support', 'manage_options', 'CaptainForm-Support', 'captainform_page_handler');

		//Wordpress Settings->CaptainForm
		add_options_page('CaptainForm Options', 'CaptainForm', 'manage_options', 'CaptainFormOptions', 'captainform_page_handler');
	}
}

add_action('admin_menu', 'captainform_add_options_link');

function captainform_register_settings()
{
	// creates our settings in the options table
	register_setting('cf_wpp_settings_group', 'cf_wpp_settings');
}

add_action('admin_init', 'captainform_register_settings');
add_action('init', 'add_ob_start');

function add_ob_start()
{
	ob_start();
}

add_action('init', 'captainform_new_post_type');

function captainform_new_post_type()
{
	register_post_type('captainform_post', array(
		'public' => true,
		'show_in_nav_menus' => false,
		'exclude_from_search' => true,
		'show_ui' => false,
	));
}

add_filter('mce_external_plugins', 'captainform_register_external_plugins');

function captainform_register_external_plugins($plugin_array)
{
	$plugin_path = plugin_dir_url(plugin_dir_path(__FILE__));

	$plugin_array['captainform'] = $plugin_path . 'dialog/editor_plugin.js';
	$plugin_array['captainform_chosen'] = $plugin_path . 'includes/js/chosen.jquery.js';
	$plugin_array['captainform_jscolor'] = $plugin_path . 'includes/js/jscolor/jscolor.js';
	$plugin_array['captainform_widget_js'] = $plugin_path . 'includes/js/widget.js';
	return $plugin_array;
}

add_action('wp_ajax_captainform_insert_dialog', 'captainform_insert_dialog');

function captainform_insert_dialog()
{
	$response = captainform_get_forms('page_or_post');
	if ($response->status == 'ok') {
		$captainform_publish_code_value = "";
		?>
		<div class="captainform_widget_container">
			<b>Select the form you want to embed:</b>
			<br>
			<select name="<?php echo $GLOBALS['captainform_plugin_name']; ?>_form_toembed"
			        id="<?php echo $GLOBALS['captainform_plugin_name']; ?>_form_toembed"
			        class="captainform_widget_select">
				<?php
				$first_form_id = null;
				foreach ($response->forms as $form) {
					if ($captainform_publish_code_value == "")
						$captainform_publish_code_value = "[captainform i" . $form->f_id . "]";
					?>
					<option value="<?php echo $form->f_id; ?>"><?php echo $form->f_name; ?></option>
					<?php
				}
				?>
			</select>
			<div id="captainform_publish_lightbox_main_container">
				<?php
				$captainform_display_as_lightbox_name = "cf_display_as_lightbox_name";
				$captainform_trigger_option_name = "cf_trigger_option_name";
				$captainform_selected_trigger = 0;
				$captainform_trigger_0_name = "cf_trigger_0_name";
				$captainform_trigger_0_text = "Contact Us";
				$captainform_trigger_1_name = "cf_trigger_1_name";
				$captainform_trigger_1_url = plugins_url('/includes/images/publish_lighbox_default_image_v2.png', dirname(__FILE__));
				$captainform_trigger_2_text_name = "cf_trigger_2_text_name";
				$captainform_trigger_2_text = "Contact us";
				$captainform_trigger_2_position_name = "cf_trigger_2_position_name";
				$captainform_trigger_2_position = 1;
				$captainform_trigger_2_background_name = "cf_trigger_2_background_name";
				$captainform_trigger_2_background = "FF0000";
				$captainform_trigger_2_color_name = "cf_trigger_2_color_name";
				$captainform_trigger_2_color = "FFFFFF";
				$captainform_trigger_3_after_name = "cf_trigger_3_after_name";
				$captainform_trigger_3_after = 3;
				require(plugin_dir_path(dirname(__FILE__)) . 'views/publish_lightbox.php');
				?>
				<br/>
				<input type="hidden" id="captainform_publish_code"
				       name="<?php if (isset($captainform_lightbox_publish_code_name)) echo $captainform_lightbox_publish_code_name; ?>"
				       class="cf_generated_code" value="<?php echo $captainform_publish_code_value; ?>"/>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
		<?php
	} else {
		if ($response->error_message) {
			if (isset($response->error_code) && $response->error_code == 2) {
				echo "Create a form and return here to publish it";
			} elseif (isset($response->error_code) && $response->error_code == 1) {
				echo "Please activate your account first! Go to the CaptainForm tab and enter your license key or activate your free account. Create a form and return here to publish it.";
			} else
				echo $response->error_message;
		} else
			echo 'Fatal error - ' . $response->status;
	}
	exit();
}
