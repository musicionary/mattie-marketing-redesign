<?php
defined('ABSPATH') or die('No direct access!');
if (!class_exists('CaptainFormWidget')) {

	class CaptainFormWidget extends WP_Widget
	{
		private $publish_type = 'widget';
		private static $widget_count = 0;

		function __construct()
		{
			parent::__construct(
				false,
				// name of the widget
				__('CaptainForm', 'captainform'),
				// widget options
				array(
					'description' => __('Add a form to the sidebar', 'captainform')
				)
			);
			if (is_admin()) {
				add_action('admin_print_scripts-widgets.php', 'captainform_widget_css');
				add_action('admin_print_scripts-widgets.php', 'captainform_widget_js');
			}
		}

		function form($instance)
		{
			$embeded_form = isset($instance['captainform_form_id']) ? esc_attr($instance['captainform_form_id']) : '';
			$response = captainform_get_forms($this->publish_type, ++self::$widget_count);

			$captainform_display_as_lightbox_name = $this->get_field_name('captainform_display_as_lightbox');
			$captainform_trigger_option_name = $this->get_field_name('captainform_selected_trigger');
			$captainform_lightbox_publish_code_name = $this->get_field_name('captainform_lightbox_publish_code');

			//Text
			$captainform_trigger_0_name = $this->get_field_name('captainform_trigger_0_text');
			$captainform_trigger_0_text = (isset($instance['captainform_trigger_0_text']) ? esc_attr($instance['captainform_trigger_0_text']) : "Contact us");

			//click on image 
			$captainform_trigger_1_name = $this->get_field_name('captainform_trigger_1_url');
			$captainform_trigger_1_url = isset($instance['captainform_trigger_1_url']) ? esc_attr($instance['captainform_trigger_1_url']) : '';
			if ($captainform_trigger_1_url == "")
				$captainform_trigger_1_url = plugins_url('/includes/images/publish_lighbox_default_image_v2.png', dirname(__FILE__));

			//floating button
			$captainform_trigger_2_text_name = $this->get_field_name('captainform_trigger_2_text');
			$captainform_trigger_2_text = (isset($instance['captainform_trigger_2_text']) ? esc_attr($instance['captainform_trigger_2_text']) : "Contact us");
			$captainform_trigger_2_position_name = $this->get_field_name('captainform_trigger_2_position');
			$captainform_trigger_2_position = (isset($instance['captainform_trigger_2_position']) ? ($instance['captainform_trigger_2_position'] != '' ? esc_attr($instance['captainform_trigger_2_position']) : 1) : 1);
			$captainform_trigger_2_background_name = $this->get_field_name('captainform_trigger_2_background');
			$captainform_trigger_2_background = (isset($instance['captainform_trigger_2_background']) ? esc_attr($instance['captainform_trigger_2_background']) : '');
			if ($captainform_trigger_2_background == '')
				$captainform_trigger_2_background = "FF0000";
			$captainform_trigger_2_color_name = $this->get_field_name('captainform_trigger_2_color');
			$captainform_trigger_2_color = (isset($instance['captainform_trigger_2_color']) ? esc_attr($instance['captainform_trigger_2_color']) : '');
			if ($captainform_trigger_2_color == '')
				$captainform_trigger_2_color = "FFFFFF";

			//Auto popup
			$captainform_trigger_3_after_name = $this->get_field_name('captainform_trigger_3_after');
			$captainform_trigger_3_after = (isset($instance['captainform_trigger_3_after']) ? esc_attr($instance['captainform_trigger_3_after']) : 5);

			$captainform_publish_code_value = isset($instance['captainform_lightbox_publish_code']) ? esc_attr($instance['captainform_lightbox_publish_code']) : '';
			$display_as_lightbox = (isset($instance['captainform_display_as_lightbox']) ? esc_attr($instance['captainform_display_as_lightbox']) : 3);
			$captainform_selected_trigger = (isset($instance['captainform_selected_trigger']) && $display_as_lightbox == 1 ? esc_attr($instance['captainform_selected_trigger']) : 3);

			if ($response->status == 'ok') {
				// markup for form 
				?>
				<div class="captainform_widget_container">
					<p>
						<label for="<?php echo $this->get_field_id('captainform_form_id'); ?>">
							Select the form you want to embed:
						</label>
					</p>
					<div>
						<select name="<?php echo $this->get_field_name('captainform_form_id'); ?>"
						        class="captainform_widget_select"
						        id="<?php echo $this->get_field_id('captainform_form_id'); ?>">
							<?php foreach ($response->forms as $form): ?>
								<option
									value="<?php echo $form->f_id; ?>" <?php echo ($form->f_id == $embeded_form) ? 'selected' : '' ?> >
									<?php echo $form->f_name; ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>
					<?php
					require(plugin_dir_path(dirname(__FILE__)) . 'views/publish_lightbox.php');
					?>
					<input type="hidden" name="<?php echo $captainform_lightbox_publish_code_name; ?>"
					       class='cf_generated_code' value="<?php echo $captainform_publish_code_value; ?>"/>
				</div>
				<?php
			} else {
				?>
				<div class="error_message_container">
					<?php
					if ($response->error_message) {
						if (isset($response->error_code) && $response->error_code == 2) {
							echo sprintf("%sCreate a form%s and return here to publish it in your sidebar.", '<a href="admin.php?page=CaptainForm-NewForm">', "</a>");
						} elseif (isset($response->error_code) && $response->error_code == 1) {
							echo sprintf("Please activate your account first! Go to the CaptainForm tab and enter your license key or activate your free account. %sCreate a form%s and return here to publish it.", '<a href="admin.php?page=CaptainForm-NewForm">', "</a>");
						} else
							echo $response->error_message;
					} else
						echo 'Fatal error - ' . $response->status;
					?>
				</div>
				<?php
			}
		}

		function update($new_instance, $old_instance)
		{
			$instance = $old_instance;
			$instance['captainform_form_id'] = intval($new_instance['captainform_form_id']);
			$display_as_lightbox = intval($new_instance['captainform_display_as_lightbox']);
			$instance['captainform_display_as_lightbox'] = $display_as_lightbox;
			$instance['captainform_selected_trigger'] = ($display_as_lightbox == 1 ? intval($new_instance['captainform_selected_trigger']) : 0);
			$instance['captainform_trigger_0_text'] = ($display_as_lightbox == 1 ? $new_instance['captainform_trigger_0_text'] : '');
			$instance['captainform_trigger_1_url'] = ($display_as_lightbox == 1 ? $new_instance['captainform_trigger_1_url'] : '');
			$instance['captainform_trigger_2_text'] = ($display_as_lightbox == 1 ? $new_instance['captainform_trigger_2_text'] : '');
			$instance['captainform_trigger_2_position'] = ($display_as_lightbox == 1 ? $new_instance['captainform_trigger_2_position'] : '');
			$instance['captainform_trigger_2_background'] = ($display_as_lightbox == 1 ? $new_instance['captainform_trigger_2_background'] : '');
			$instance['captainform_trigger_2_color'] = ($display_as_lightbox == 1 ? $new_instance['captainform_trigger_2_color'] : '');
			$instance['captainform_trigger_3_after'] = ($display_as_lightbox == 1 ? (intval($new_instance['captainform_trigger_3_after']) > 0 ? intval($new_instance['captainform_trigger_3_after']) : 3) : 3);
			$instance['captainform_lightbox_publish_code'] = $new_instance['captainform_lightbox_publish_code'];
			return $instance;
		}

		function widget($args, $instance)
		{
			extract($args);
			global $post;
			$shortcode = '[captainform i' . $instance['captainform_form_id'] . ']';
			if (isset($instance['captainform_lightbox_publish_code']) && $instance['captainform_lightbox_publish_code'] != '')
				$shortcode = $instance['captainform_lightbox_publish_code'];

			$is_lightbox_pattern = '/\[[^\[]*captain-?form.*lightbox=[\',"]{1}([a-zA-Z0-9\/\-_\.\s]+)[\',"]{1}[^\]]*\]/';
			$is_lighbox = preg_match($is_lightbox_pattern, $shortcode) ? true : false;

			$type_pattern = '/\[[^\[]*captain-?form.*type=[\',"]{1}([a-zA-Z0-9\/\-_\.\s]+)[\',"]{1}[^\]]*\]/';
			preg_match($type_pattern, $shortcode, $matches_type);
			$shortcode_option_type = isset($matches_type[1]) ? $matches_type[1] : null;

			$show_widget_area = ($is_lighbox && in_array($shortcode_option_type, array('floating-button', 'auto-popup'))) ? false : true;

			if ($show_widget_area) {
				echo $before_widget;
				echo $before_title . $after_title;
			}

			echo captainform_widget_text_filter($shortcode);

			wp_reset_query();

			if ($show_widget_area)
				echo $after_widget;
		}

	}

}

function captainform_register_forms_widget()
{
	register_widget('CaptainFormWidget');
}

$php_version = phpversion();
if ($php_version >= 5.3) {
	add_action('widgets_init', 'captainform_register_forms_widget');
} else if ($php_version >= 5.2) {
	add_action('widgets_init',
		create_function('', 'return register_widget("CaptainFormWidget");')
	);
}

function captainform_widget_text_filter($content)
{
	$content = captainform_text_filter($content);
	return $content;
}

add_filter('widget_text', 'captainform_widget_text_filter', 1);

/* resources */

function captainform_widget_css()
{
	wp_enqueue_style('cf-widget-css', plugins_url('/css/widget.css', __FILE__), false, false);
	wp_enqueue_style('cf-chosen-css', plugins_url('/css/chosen/chosen.css', __FILE__), false, false);
}

function captainform_widget_js()
{
	wp_register_script('cf_color_picker_js', plugins_url('/js/jscolor/jscolor.js', __FILE__), array('jquery'), false, true);
	wp_register_script('cf_widget_js', plugins_url('/js/widget.js', __FILE__), array('cf_color_picker_js'), false, true);
	wp_register_script('cf_chosen_js', plugins_url('/js/chosen.jquery.js', __FILE__), array('cf_widget_js'), false, false);
	wp_enqueue_script('jquery');
	wp_enqueue_script('cf_color_picker_js');
	wp_enqueue_script('cf_chosen_js');
	wp_enqueue_script('cf_widget_js');
}
