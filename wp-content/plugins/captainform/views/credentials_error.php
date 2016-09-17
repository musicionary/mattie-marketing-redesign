<?php
defined('ABSPATH') or die('No direct access!');

function captainform_draw_credentials_error()
{
	wp_enqueue_style('captainform_credentials_error', plugins_url('/includes/css/credentials_error.css', plugin_dir_path(__FILE__)), false, $captainform_plugin_version);
	$url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	?>
	<div id='captainform_credentials_error_wrapper'>
		<div class="captainform_credentials_error_text">
		<strong>Hey there! Looks like you have duplicated your site or moved its location. Do you plan to use CaptainForm at the old location anymore?</strong>
		
		<p>
			If you choose Yes, this new website will become a new instance of your CaptainForm account.
			<br />
			If you choose No, then your old URL will be overwritten by this new one.
		</p>
		</div>
		
		
		<div>
			<form action='//<?=$url?>' method='POST'>
				<input type='hidden' id='captainform_reset_keys' name='captainform_reset_keys' value=2 />
				<button class="button button-primary" onclick="document.getElementById('captainform_reset_keys').value=1;">Yes</button>
				<button class="button button-white" onclick="document.getElementById('captainform_reset_keys').value=0; if (!confirm('Attention! If you are moving your primary website (the one where you first activated a paid license key) or a duplicate of it, CaptainForm will not work at the primary website URL anymore. The website you are currently on will become your new primary website.')) return false;">No</button>
			</form>
		</div>
	</div>
	<?php
}
