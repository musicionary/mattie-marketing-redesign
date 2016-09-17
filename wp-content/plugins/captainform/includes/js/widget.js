window.captainform_is_widget_page = true;
jQuery(document).ready(function ($) {
	captainform_bind_widget();
});

function captainform_bind_widget(widget_id_to_bind)
{
	var prefix = '';
	if (typeof widget_id_to_bind != 'undefined' && widget_id_to_bind != '' && widget_id_to_bind != null)
		prefix = "#" + widget_id_to_bind + " ";

	bind_searchable(prefix);
	bind_lightbox_publish(prefix);
	if (typeof jscolor != 'undefined')
		jscolor.init();
}

function bind_lightbox_publish(prefix)
{
	jQuery(prefix + '.cf_lightbox_cotainer').each(function () {
		if (jQuery(this).find(".cf_display_as_lightbox").is(':checked'))
		{
			jQuery(this).find('.cf_triggers_container').show();
			if (jQuery(this).find('.cf_trigger:checked').val() == 1)
			{
				image_obj = jQuery(this).find('.cf_trigger_1_url');
				captainform_test_valid_image(image_obj.val(), image_obj)
			}
		}
		else if (!jQuery(this).find(".cf_display_as_lightbox").is(':checked'))
		{
			jQuery(this).find('.cf_triggers_container').hide();
		}
	});

	jQuery(prefix + '.cf_display_as_lightbox').on('click', function () {
		if (jQuery(this).is(':checked'))
			jQuery(this).closest('.cf_lightbox_cotainer').find('.cf_triggers_container').show();
		else
			jQuery(this).closest('.cf_lightbox_cotainer').find('.cf_triggers_container').hide();
	});

	jQuery(prefix + '.cf_trigger').on('click', function () {
		var value = jQuery(this).val();
		var options_container = jQuery(this).closest('.cf_triggers_container');
		jQuery(options_container).find('.cf_trigger_selected_option_container').hide();
		jQuery(options_container).find('.cf_trigger_selected_option_cotainter_' + value).show();

	});

	jQuery(prefix + '.cf_trigger').each(function () {
		var value = jQuery(this).val();
		if (jQuery(this).is(':checked'))
		{
			var options_container = jQuery(this).closest('.cf_triggers_container');
			jQuery(options_container).find('.cf_trigger_selected_option_container').hide();
			jQuery(options_container).find('.cf_trigger_selected_option_cotainter_' + value).show();
		}
	});

	jQuery(prefix + '.cf_display_as_lightbox').on('change', function () {
		if (!jQuery(this).is(':checked'))
		{
			var formid = jQuery(this).closest('.captainform_widget_container').find('.captainform_widget_select').val();
			var code = '[captainform i' + formid + ']';
			jQuery(this).closest('.captainform_widget_container').find('.cf_generated_code').val(code);
		}
	});

	jQuery(prefix + '.cf_trigger_1_url').on('change keyup', function () {
		captainform_test_valid_image(jQuery(this).val(), jQuery(this));
	})

	jQuery(prefix + '.cf_triggers_container input , ' + prefix + ' .cf_display_as_lightbox' + ',' + prefix + ' .captainform_widget_select,' + prefix + ' .captainform_form_toembed').on('change keyup', function () {
		if (window.captainform_is_widget_page == true)
			var formid = jQuery(this).closest('.captainform_widget_container').find('.captainform_widget_select').val();
		else
			var formid = document.getElementById('captainform_form_toembed').options[document.getElementById('captainform_form_toembed').selectedIndex].value;
		var display_as_lightbox = jQuery(this).closest('.captainform_widget_container').find('.cf_display_as_lightbox').is(':checked');
		var code = '[captainform i' + formid;
		if (display_as_lightbox == true)
		{
			code += ' lightbox="1" ';
			var selected_trigger = jQuery(this).closest('.captainform_widget_container').find('.cf_trigger:checked').val();
			switch (selected_trigger)
			{
				case '0' : //text
					var text_selected = jQuery(this).closest('.captainform_widget_container').find('.cf_trigger_0_text').val();
					code += 'content="' + encodeURIComponent(text_selected) + '" type="text"';
					break;
				case '1': //image
					var image_obj = jQuery(this).closest('.captainform_widget_container').find('.cf_trigger_1_url');
					var image_url = image_obj.val();
					code += 'url="' + encodeURI(image_url) + '" type="image"';
					break;
				case '2': //floating button
					var text = jQuery(this).closest('.captainform_widget_container').find('.cf_trigger_2_text').val();
					var position = jQuery(this).closest('.captainform_widget_container').find('.cf_trigger_2_position:checked').val();
					var background_color = jQuery(this).closest('.captainform_widget_container').find('.cf_trigger_2_background_color').val();
					var text_color = jQuery(this).closest('.captainform_widget_container').find('.cf_trigger_2_color').val();

					code += 'content="' + encodeURIComponent(text) + '" ';
					code += 'bg_color="' + background_color + '" ';
					code += 'text_color="' + text_color + '" ';
					
					switch (position)
					{
						case '1':
							code += 'position="left" ';
							break;
						case '2':
							code += 'position="right" ';
							break;
						case '3':
							code += 'position="bottom" ';
							break;
						default:
							code += 'position="left" ';
					}
					code += 'type="floating-button"';
					break;
				case '3': //Auto popup
					var after = jQuery(this).closest('.captainform_widget_container').find('.cf_trigger_2_time').val() * 1000;
					if(after <= 0)
						after = 3000;
					if (after != '')
						code += 'miliseconds="' + after + '" ';
					else
						code += 'miliseconds="' + 3000 + '" ';
					code += 'type="auto-popup"';
					break;
			}
		}
			code += ']';

			if (window.captainform_is_widget_page == true)
				jQuery(this).closest('.captainform_widget_container').find('.cf_generated_code').val(code);
			else
				jQuery('.cf_generated_code').val(code);

	});
}

function bind_searchable(prefix)
{
	try {
		jQuery(prefix + '.captainform_widget_select').chosen({search_contains: true, no_results_text: 'No results match'});
		jQuery(prefix + '.captainform_widget_container').find('.chosen-container.chosen-container-single').each(function () {
			if (jQuery(this).parent().find('.chosen-container.chosen-container-single').length > 1)
			{
				jQuery(this).parent().find('.chosen-container.chosen-container-single').last().remove();
			}
		});
	}
	catch (err)
	{
	}
}

jQuery(document).ajaxComplete(function (event, XMLHttpRequest, ajaxOptions) {
	var request = {}, pairs, i, split, widget;
	if(typeof ajaxOptions.data != 'undefined')
	{
		pairs = ajaxOptions.data.split('&');
	for (i in pairs) {
		split = pairs[i].split('=');
		request[decodeURIComponent(split[0])] = decodeURIComponent(split[1]);
		}
	}
	if ((request.action && (request.action === 'save-widget') && (typeof request['widget-id'] != 'undefined') && (request['widget-id'].indexOf('captainformwidget') != -1))|| (typeof request.wp_customize != 'undefined' && request.wp_customize == 'on')) {
		var my_widget_id = request['widget-id'];
		var widget_div_id = null;
		var bind_captainform_widgets = false;
		if(typeof request.wp_customize != 'undefined' && request.wp_customize == 'on'){
			bind_captainform_widgets = true;
		}
		else{
		jQuery('.widget').each(function () {
			if (jQuery(this).attr('id').match(new RegExp(my_widget_id))) {
				widget_div_id = jQuery(this).attr('id');
			}
		});
		if (widget_div_id != null)
				bind_captainform_widgets =true;
		}
		if(bind_captainform_widgets == true)
			captainform_bind_widget(widget_div_id);
	}
});

function captainform_test_valid_image(url, object, timeout) {
	timeout = timeout || 5000;
	var timedOut = false, timer;
	var img = new Image();
	img.onerror = img.onabort = function () {
		if (!timedOut) {
			clearTimeout(timer);
			jQuery(object).addClass('cf_red_border'); //error
		}
	};
	img.onload = function () {
		if (!timedOut) {
			clearTimeout(timer);
			jQuery(object).removeClass('cf_red_border'); //success
		}
	};
	img.src = url;
	timer = setTimeout(function () {
		timedOut = true;
		jQuery(object).addClass('cf_red_border'); //timeout
	}, timeout);
}