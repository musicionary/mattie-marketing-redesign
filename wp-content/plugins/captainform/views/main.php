<?php
defined('ABSPATH') or die('No direct access!');

function captainform_draw_main_iframe($url, $hostinfo)
{
	global $captainform_wpp_options, $captainform_plugin_version;
	ob_start();
	$rev = uniqid();
	$chost = $hostinfo[0];
	$protocol = $hostinfo[1];
	$chostp = $hostinfo[2];
	?>
	<script>
		var version = '<?php echo $captainform_plugin_version; ?>';
		var chost = '<?php echo $chost; ?>';
		var chostp = '<?php echo $chostp; ?>';
		var parent_site_url = '<?php echo site_url(); ?>';
		var captainform_plugin_dir = '<?php echo plugins_url('', __DIR__); ?>';
	</script>
	<iframe id="captainform_iframe" src="<?php print $url; ?>"
	        style="width:99%; background: transparent; min-height: 700px;" scrolling="no"></iframe>
	<?php
	wp_register_script('captainform_iframe_resizer', plugins_url('/includes/js/iframeResizer.min.js', plugin_dir_path(__FILE__)), array(), '3.5', false);
	wp_register_script('captainform_main_js', plugins_url('/includes/js/main.js', plugin_dir_path(__FILE__)), array(), $captainform_plugin_version, false);
	wp_enqueue_script('captainform_iframe_resizer');
	wp_enqueue_script('captainform_main_js');
	wp_enqueue_style('captainform_iframe_popup', plugins_url('/includes/css/iframe_popup.css', plugin_dir_path(__FILE__)), false, $captainform_plugin_version);
	$user_agent = getenv("HTTP_USER_AGENT");
	if (strpos($user_agent, "Mac") !== FALSE) {
		wp_enqueue_style('captainform_iframe_popup', plugins_url('/includes/css/wp_captainform_os.css', plugin_dir_path(__FILE__)), false, $captainform_plugin_version);
	}
	ob_end_flush();
}
