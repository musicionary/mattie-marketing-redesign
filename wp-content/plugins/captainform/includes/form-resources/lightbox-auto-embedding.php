<script type="text/javascript">
	var customVarsMF = '{{CUSTOMVARS}}';
	var captainform_theme_style = '{{STYLE}}';
	setTimeout(function(){
		if (typeof captainform_create_form_popup == 'function') 
			captainform_create_form_popup({url: cfJsHost + captainform_servicedomain + '/form-{{ID}}/?' + customVarsMF + captainform_theme_style, popup_w: 1000});
	}, {{MILISECONDS}} );
</script>