var iframe_height = 0;
var dialog_message_return = false;
function create_popup() {
	htm = '';
	htm += '<div id="captainform_popup" class="captainform_popup_bg">';
	htm += '<div class="captainform_popup_box">';
	htm += '<div class="captainform_popup_title">';
	htm += 'Popup title';
	htm += '<div id="xclose" class="captainform_popup_close" onclick="close_popup()"></div>';
	htm += '</div>';
	htm += '<div class="captainform_popup_body"><a></a></div>';
	htm += '</div>';
	htm += '</div>';
	jQuery('#captainform_iframe').after(htm);
	jQuery('#captainform_popup').show();
}

function close_popup() {
	if(dialog_message_return){
		msgdialog = {dialog_response:dialog_message_return};
		element.contentWindow.postMessage(msgdialog, chostp);
		dialog_message_return = false;
	}
	jQuery('#captainform_popup').remove();
}

function create_popup_dialog(msg){
	jQuery('#captainform_popup').remove();
	title = msg.popup_title;
	message = msg.popup_message;
	dialog_type = msg.dialog_type;
	dialog_message_return = msg.response_on_close;
	w = msg.popup_w;
	class_type = '';
	if(dialog_type=='success'){
		class_type = 'dialog dialog_success';
		class_close = 'close_success';
	}
	if(dialog_type=='warning'){
		class_type = 'dialog dialog_warning';
		class_close = 'close_warning';
	}
	if(dialog_type=='error'){
		class_type = 'dialog dialog_error';
		class_close = 'close_error';
	}
	//class_type='';
	// calculate buttons
	buttons_html = '';
	buttons = msg.buttons_list;
	buttons_action = msg.buttons_action;
	if (buttons !== null && typeof buttons === 'object') {
		buttons_html += '<div id="popup_footer" class="captainform_popup_footer">';
		Object.getOwnPropertyNames(buttons).forEach(function (val, idx, array) {
			//btn = val + ' -> ' + buttons[val];
			btn_title = buttons[val];
			btn_action = buttons_action[val];
			btn_action_type = btn_action.action_type;
			btn_action_name = btn_action.action_name;
			onclick = '';
			lockurl = chostp;
			if (btn_action_type == 'message') {
				msg_return = btn_action_name;
				vonclick = " onclick=\"element.contentWindow.postMessage('" + msg_return + "','" + lockurl + "')\"";
			}
			if (btn_action_type == 'callback') {
				msg_return = btn_action_name;
				vonclick = " onclick=\"" + btn_action_name + "\"";
			}
			buttons_html += '<div class="btn ' + val + '"' + vonclick + '>' + btn_title + '</div>';
		});
		buttons_html += '</div>';
	}
	htm = '';
	htm += '<div id="captainform_popup" class="captainform_popup_bg">';
	htm += '<div id="cfloader" class="captainform_loader"></div>';
	htm += '<div id="popup_box" class="captainform_popup_box">';
	htm += '<div id="popup_header" class="captainform_popup_title '+class_type+'">';
	htm += decodeURIComponent(title);
	htm += '<div id="xclose" class="captainform_popup_close '+class_close+'" onclick="close_popup()"></div>';
	htm += '</div>';
	htm += '<div id="popup_body" class="captainform_popup_body">';
	htm += '<div class="icontent">'+decodeURIComponent(message)+'</div>';
	htm += '</div>';
	htm += buttons_html;
	htm += '</div>';
	htm += '</div>';
	//ppi = document.getElementById('ppiframe');
	jQuery('#captainform_iframe').after(htm);
	jQuery('#popup_box').width(w);
	jQuery('#cfloader').remove();
	jQuery('#captainform_popup').show();
	popup_box_height = jQuery('#popup_body').height()+95;	
	jQuery('#popup_box').height(popup_box_height);
	jQuery('#popup_box').css('border','solid 1px #838383');
}

function create_popup_iframe(msg) {
	jQuery('#captainform_popup').remove();
	url = msg.popup_url + msg.popup_url_query;
	url = url.replace('/app.captainform.com/', '/' + chost + '/');
	title = msg.popup_title;
	dialog_message_return = msg.response_on_close;
	w = msg.popup_w;
	h = msg.popup_h;
	// calculate buttons
	buttons_html = '';
	buttons = msg.buttons_list;
	buttons_action = msg.buttons_action;
	if (buttons !== null && typeof buttons === 'object') {
		buttons_html += '<div id="popup_footer" class="captainform_popup_footer">';
		Object.getOwnPropertyNames(buttons).forEach(function (val, idx, array) {
			//btn = val + ' -> ' + buttons[val];
			btn_title = buttons[val];
			btn_action = buttons_action[val];
			btn_action_type = btn_action.action_type;
			btn_action_name = btn_action.action_name;
			onclick = '';
			lockurl = chostp;
			if (btn_action_type == 'message') {
				msg_return = btn_action_name;
				vonclick = " onclick=\"element1.contentWindow.postMessage('" + msg_return + "','" + lockurl + "')\"";
			}
			if (btn_action_type == 'callback') {
				msg_return = btn_action_name;
				vonclick = " onclick=\"" + btn_action_name + "\"";
			}
			buttons_html += '<div class="btn ' + val + '"' + vonclick + '>' + btn_title + '</div>';
		});
		buttons_html += '</div>';
	}
	htm = '';
	htm += '<div id="captainform_popup" class="captainform_popup_bg">';
	htm += '<div id="cfloader" class="captainform_loader"></div>';
	htm += '<div id="popup_box" class="captainform_popup_box">';
	htm += '<div id="popup_header" class="captainform_popup_title">';
	htm += title;
	htm += '<div id="xclose" class="captainform_popup_close" onclick="close_popup()"></div>';
	htm += '</div>';
	htm += '<div id="popup_body" class="captainform_popup_body"><iframe id="ppiframe" src="' + url + '" class="popup_iframe" scrolling="no">';
	htm += '</iframe></div>';
	htm += buttons_html;
	htm += '</div>';
	htm += '</div>';
	ppi = document.getElementById('ppiframe');
	jQuery('#captainform_iframe').after(htm);
	jQuery('#popup_box').width(w);
	jQuery('#popup_box').height(0);
	jQuery('#captainform_popup').show();


	element1 = document.getElementById('ppiframe');

	var isOldIE = (navigator.userAgent.indexOf("MSIE") !== -1); // Detect IE10 and below

	iFrameResize({
		log: false,
		scrolling: false,
		enablePublicMethods: true,
		checkOrigin: false,
		//heightCalculationMethod: isOldIE ? 'max' : 'bodyOffset', // old wy max e obligatoriu pt ie8
		//heightCalculationMethod: 'max',
		heightCalculationMethod: isOldIE ? 'max' : 'documentElementOffset', // old wy max e obligatoriu pt ie8
		resizedCallback: function (messageData) {
			hh = messageData.height;
			hhf = parseInt(hh) + 100;
			iframe_height = hhf;
			jQuery('#popup_box').height(hhf);
			jQuery('#popup_box').css('border','solid 1px #838383');
			resize_popup_iframe();
			jQuery('#cfloader').remove();
		},
		scrollCallback: function () {
			//console.log('scroll');				
		},
		messageCallback: function (messageData) { // Callback fn when message is received
			//console.log(messageData.message)
		}
	}, element1);

}

/**
 * Add Settings Save Button and bar  in page. It will be displayed when only when "Save" button from settings is not visible.
 */
function show_settings_save_button()
{
	if (typeof window.is_demo_account != 'undefined' && window.is_demo_account == true)
		return;
	html = '<div id="cf_settings_save_button_container">';
	html += '	<div id="cf_settings_save_button" onclick="settings_click_save()">Save changes</div>';
	html += '</div>';
	if (document.getElementById('cf_settings_save_button_container') == null)
	{
		jQuery('body').prepend(html);
	}
	init_settings_save_menu_bar();
}
/**
 * Init position and height of the Settings Save Bar
 */
function init_settings_save_menu_bar()
{
	if (document.getElementById('adminmenu') !== null && document.getElementById('cf_settings_save_button_container') !== null)
	{
		var window_width = jQuery(window).width();
		var wp_adminmenu_width = 0;
		if (jQuery('#adminmenu').is(':visible'))
			wp_adminmenu_width = jQuery('#adminmenu').width();
		var bar_width = window_width - wp_adminmenu_width;
		jQuery('#cf_settings_save_button_container').css('width', bar_width).css('right', 0);
	}
	var admin_bar_height = 0;
	var left_menu_z_index = 0;
	if (document.getElementById('wpadminbar') !== null)
	{
		if (jQuery('#wpadminbar').css('position') == 'fixed')
			admin_bar_height = jQuery('#wpadminbar').height();
	}
	jQuery('#cf_settings_save_button_container').css('top', admin_bar_height).show();
}
/**
 * Removes the Settings Save Bar  from the page.
 */
function remove_settings_save_button()
{
	if (document.getElementById('cf_settings_save_button_container') != null)
	{
		jQuery('#cf_settings_save_button_container').hide().remove();
	}
}
/**
 * Simulate click on the save button inside the child iframe . It's like clicking on the "Save" button.
 */
function settings_click_save()
{
	var iframe_obj = document.getElementById('captainform_iframe');
	iframe_obj.contentWindow.postMessage(JSON.stringify({msg_id: 'settings_click_save'}), '*');
}
function resize_popup_iframe() {
	if (jQuery('#ppiframe').length == 0) {
		return false;
	}

	max_h = jQuery(window).height() - 20;
	jQuery('#popup_box').css('max-height', max_h + 'px');
	max_w = jQuery(window).width() - 20;
	jQuery('#popup_box').css('max-width', max_w + 'px');

	popup_header_h = jQuery('#popup_header').height();
	popup_footer_h = jQuery('#popup_footer').height() + 10;
	//popup_body_max_h = jQuery( window ).height() - popup_header_h - popup_footer_h;
	popup_body_max_h = jQuery('#popup_box').height() - popup_header_h - popup_footer_h;
	jQuery('#popup_body').css('max-height', popup_body_max_h + 'px');
}

function init_editor_menu_pos()
{
	var top_scroll_pos = jQuery(document).scrollTop();
	var iframe_obj = document.getElementById('captainform_iframe');
	var iframe_offset_top = jQuery('#captainform_iframe').offset().top;
	window.editor_menu_top_pos = iframe_offset_top;
	if (typeof top_scroll_pos != 'undefined' && typeof iframe_offset_top != 'undefined')
		iframe_obj.contentWindow.postMessage(JSON.stringify({msg_id: 'scroll_on_parent', msg_val: top_scroll_pos, 'iframe_offset_top': iframe_offset_top}), '*');
}


function doerror() {
	jQuery('.btn_blue').hide();
	jQuery('#popup_header').addClass('doerror');
	jQuery('#xclose').addClass('doerrorclose');
}



jQuery(document).ready(function () {
	init_editor_menu_pos();

	jQuery(window).resize(function () {
		resize_popup_iframe();
		init_editor_menu_pos();
		init_settings_save_menu_bar();
	});

	jQuery(window).scroll(function (event) {
		clearTimeout(jQuery.data(this, 'scrollTimer'));
		jQuery.data(this, 'scrollTimer', setTimeout(function () {
			init_editor_menu_pos();
		}, 250));
	});
});
// resizer
element = document.getElementById('captainform_iframe');
iFrameResize({
	log: false,
	scrolling: false,
	enablePublicMethods: true,
	checkOrigin: false,
	resizedCallback: function (messageData) {

	},
	scrollCallback: function () {
	},
	messageCallback: function (messageData) { // Callback fn when message is received
		msgr = messageData.message;
		switch (msgr.msg_type)
		{
			case 'show_popup_iframe':
				create_popup_iframe(msgr);
				break;
			case 'show_popup_dialog':
				create_popup_dialog(msgr);
				break;
		}

	}
}, element);




// reseponse to parent 2
window.onmessage = function (e) {

	msgresponse = e.data;	
	if(!msgresponse.hasOwnProperty('msg_id')){
		return false;
	}
	msg_id = msgresponse.msg_id;

	if (msgresponse.hasOwnProperty('msg_action')) {

		msg_action = msgresponse.msg_action;

		if (msg_action == 'response_resend') {
			element.contentWindow.postMessage(msgresponse, chostp);
			close_popup();
		}
		if (msg_action == 'response_reload') {
			jQuery('#captainform_iframe').attr('src', jQuery('#captainform_iframe').attr('src'));
			close_popup();
		}
		
		if (msg_action == 'response_error'){
			doerror();
			return;	
		}
		
		if(msg_action == 'response_alert'){

			create_popup_dialog(msgresponse);
			return;
		}

	} else {

		if (msg_id == 'added_new_group') {
			jQuery('#captainform_iframe').attr('src', jQuery('#captainform_iframe').attr('src'));
			top_scroll_pos = 0;
			if (typeof msgresponse.last_div_pos != 'undefined')
				top_scroll_pos = msgresponse.last_div_pos;
			window.scroll(0, top_scroll_pos);
			close_popup();
		}
		if (msg_id == 'renamed_group') {
			element.contentWindow.postMessage(msgresponse, chostp);
			close_popup();
		}
		if (msg_id == 'deleted_group') {
			element.contentWindow.postMessage(msgresponse, chostp);
			close_popup();
		}
		if (msg_id == 'group_settings_finish') {
			element.contentWindow.postMessage(msgresponse, chostp);
			close_popup();
		}
		if (msg_id == 'duplicated_group') {
			jQuery('#captainform_iframe').attr('src', jQuery('#captainform_iframe').attr('src'));
			close_popup();
		}

		if (msg_id == 'renamed_form') {
			element.contentWindow.postMessage(msgresponse, chostp);
			close_popup();
		}
		if (msg_id == 'duplicated_form') {
			element.contentWindow.postMessage(msgresponse, chostp);
			close_popup();
		}
		if (msg_id == 'deleted_form') {
			element.contentWindow.postMessage(msgresponse, chostp);
			close_popup();
		}
		if (msg_id == 'form_activity_finish') {
			element.contentWindow.postMessage(msgresponse, chostp);
			//jQuery('#captainform_iframe').attr('src', jQuery('#captainform_iframe').attr('src'));
			close_popup();
		}
		//multisite_url_submited
		if (msg_id == 'multisite_url_submited') {
			jQuery('#captainform_iframe').attr('src', jQuery('#captainform_iframe').attr('src'));
			close_popup();
		}
		if (msg_id == 'myaccount_edit_finish') {
			element.contentWindow.postMessage(msgresponse, chostp);
			//jQuery('#captainform_iframe').attr('src', jQuery('#captainform_iframe').attr('src'));
			close_popup();
		}
		if (msg_id == 'force_close_popup') {
			close_popup();
		}
		if (msg_id == "reload_parent123")
		{
			window.location.href = window.location.href;
		}
		if (msg_id == "scroll_to_top")
		{
			window.scrollTo(0, 0);
		}
		if (msg_id == 'show_settings_save_button')
		{
			var is_demo = msgresponse.is_demo;
			if (is_demo == false)
				show_settings_save_button();
		}
		if (msg_id == "remove_settings_save_button")
		{
			remove_settings_save_button();
		}
		if (msg_id == "preview_form")
		{
			var preview_tab = "_blank";
			var form_id = msgresponse.formid;
			var is_demo = msgresponse.demo;
			var protocol = window.location.protocol;
			var host = window.location.hostname;

			if (typeof captainform_plugin_dir != 'undefined')
				window.open(parent_site_url + "/wp-admin/admin.php?page=CaptainForm&cf_form_id=" + form_id, preview_tab);
			else //old preview method
				window.open(chostp + "/form-" + form_id + "/", preview_tab);
		}
		if (msg_id == 'evernote_matches_popup_save') {
			element.contentWindow.postMessage(msgresponse, chostp);
			close_popup();
		}
		if (msg_id == 'wordpress_matches_popup_save') {
			load_err = msgresponse.load_err;
			if (load_err == 1) {
				doerror();
				return;
			}
			element.contentWindow.postMessage(msgresponse, chostp);
			close_popup();
		}
	}


};