
function captainform_popup_default(){
	
	var popup_params={
		popup_url: '',
		popup_w: 500,
		popup_h: 250,
		popup_title: '',
		pupup_body: '',
		popup_buttons: [],
		action_name:'',
		action_params: []
	}
	return popup_params;
	
}

var element2;

function captainform_create_form_popup(msg) {
	jQuery('#captainform_popup_form').remove();
	url = msg.url;
	w = msg.popup_w;
	
	document.documentElement.style.overflow = 'hidden';  // firefox, chrome
	document.body.scroll = "no"; // ie only
	style_ios = '';
	if (captainform_is_ios())
	{
		style_ios = ' style="-webkit-overflow-scrolling: touch"';
	}

	htm = '';
	htm += '<div id="captainform_popup_form" onclick="close_popup_fx()" class="captainform_popup_bg_form">';
		htm += '<div id="cfloader" class="captainform_loader_form"></div>';
		htm += '<div id="popup_box_fx" class="captainform_popup_box_form">';
			htm += '<div class="close_cnt"><div id="xclose" class="captainform_popup_close_form" onclick="close_popup_fx()"></div></div>';
			htm += '<div id="popup_body_fx" class="captainform_popup_body_form"' + style_ios + '><iframe  id="ppiframefx" src="' + url + '" class="popup_iframe_form" scrolling="no"></iframe></div>';
		htm += '</div>';;
	htm += '</div>';
	ppi = document.getElementById('ppiframefx');

	jQuery('body').append(htm);
	jQuery('#popup_box_fx').width(w);
	jQuery('#popup_box_fx').height(0);
	jQuery('#captainform_popup_form').show();
	
	jQuery("#ppiframefx").on("load", function () {
		jQuery('#popup_box_fx').show();
		resize_popup_iframe_fx();
	});	
	jQuery("#popup_box_fx").on("click", function (e) {
		e.preventDefault();
		return false;
	});	

	element2 = document.getElementById('ppiframefx');

	var isOldIE = (navigator.userAgent.indexOf("MSIE") !== -1); // Detect IE10 and below

	iFrameResize({
		log: false,
		scrolling: false,
		enablePublicMethods: true,
		checkOrigin: false,
		heightCalculationMethod: isOldIE ? 'max' : 'documentElementOffset', // old wy max e obligatoriu pt ie8
		resizedCallback: function (messageData) {
			hh = messageData.height;
			hhf = parseInt(hh) - 0;
			iframe_height = hhf;
			jQuery('#popup_box_fx').height(hhf);
			resize_popup_iframe_fx();
			jQuery('#cfloader').remove();
		},
		scrollCallback: function () {
				
		},
		messageCallback: function (messageData) { // Callback fn when message is received

		}
	}, element2);

}

function resize_popup_iframe_fx() {
	if (jQuery('#ppiframefx').length == 0) {
		return false;
	}

	max_h = jQuery(window).height() - 50;
	jQuery('#popup_box_fx').css('max-height', max_h + 'px');
	max_w = jQuery(window).width() - 50;
	jQuery('#popup_box_fx').css('max-width', max_w + 'px');

	jQuery('#popup_body_fx').css('max-height', jQuery('#popup_box_fx').height() + 'px');
	diff = jQuery('#ppiframefx').outerHeight() - jQuery('#popup_box_fx').outerHeight();
 	jQuery('#popup_body_fx').delay(500).queue(function(next){
 	    next();
 	});
}

function captainform_is_ios() {
	var iDevices = [ 'iPad Simulator', 'iPhone Simulator', 'iPod Simulator', 'iPad', 'iPhone', 'iPod' ];
	if (!!navigator.platform) {
		while (iDevices.length) {
			if (navigator.platform === iDevices.pop()){ return true; }
		}
	}
	return false;
}
function close_popup_fx() {
	jQuery('#captainform_popup_form').remove();
	//jQuery("window").css("overflow", "auto");
    document.documentElement.style.overflow = 'auto';  // firefox, chrome
    document.body.scroll = "yes"; // ie only
}

function resize_payment_fx()
{
	alert('Is payment!');
}
window.onresize = function(event) {
    resize_popup_iframe_fx();
};
window.addEventListener('message', function(e){
	msg_pp = e.data;	
	w=parseInt(msg_pp.fwidth);
	if ( jQuery('#popup_box_fx').length && msg_pp.hasOwnProperty('fwidth') ) {
		jQuery('#popup_box_fx').css('width',w+'px');
		jQuery('#popup_body_fx').off('scrollTo').scrollTo(jQuery('#ppiframefx'), 300);			
	}
	if ( msg_pp.hasOwnProperty('msgpreviewpopup') ) {
		captainform_create_form_popup({url: 'https://app.captainform.com/form-'+ msg_pp.msgpreviewpopup +'/?style=preview_iframe:1', popup_w: 1000})
	}
});
jQuery.fn.scrollTo = function(elem, speed) {
    jQuery(this).animate({
        scrollTop:  jQuery(this).scrollTop() - jQuery(this).offset().top + jQuery(elem).offset().top
    }, speed == undefined ? 500 : speed);
    return this;
};
