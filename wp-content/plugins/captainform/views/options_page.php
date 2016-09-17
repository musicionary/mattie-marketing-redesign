<?php
defined('ABSPATH') or die('No direct access!');

function captainform_options_page()
{
	if(isset($_GET['reset']) && $_GET['reset'] == 'true'){
		captainform_generate_new_credentials();
		?>
			<script>window.location.href = 'options-general.php?page=CaptainFormOptions'</script>
		<?php
	}
	$installation_id = get_site_option($GLOBALS['captainform_option1']);
	$installation_key = get_site_option($GLOBALS['captainform_option2']);
	$site_url = get_site_option($GLOBALS['captainform_option3']);
	ob_start();
	?>
	<div class="wrap">
		<h1>CaptainForm Settings</h1>
		<h2>Generate New Keys</h2>
		<div>
			<div>
				<p>If you generate new keys, your website will be disconnected from its associated CaptainForm account. You will need to activate a new CaptainForm account.</p>
				<p>Normally, you should not need to generate new keys. Please do this only when our Support Team asks you to do so.</p>
			</div>
			<table class="form-table">
				<tr valign="top">
					<td>Installation ID</td>
					<td><code><?php echo $installation_id ?></code></td>
				</tr>
				<tr valign="top">
					<td>Installation Key</td>
					<td><code><?php echo $installation_key ?></code></td>
				</tr>
				<tr valign="top">
					<td>Site URL</td>
					<td><code><?php echo $site_url ?></code></td>
				</tr>
				<tr valign="top">
					<td></td>
					<td>
						<a onclick="if(!confirm('Are you sure you want to do this? Please hit OK only after talking with our Support team (support@captainform.com).')) return false;" href="options-general.php?page=CaptainFormOptions&reset=true">
							<button class="button button-primary">Generate New Keys</button>
						</a>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<?php
	echo ob_get_clean();
}
