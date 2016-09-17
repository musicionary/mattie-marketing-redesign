<script type="text/javascript">
	var customVarsMF = '{{CUSTOMVARS}}';
	var captainform_theme_style = '{{STYLE}}';
	if(document.getElementById('captainform_easyxdmjs') == null)
	{
		document.write(unescape("%3Cscript id='captainform_easyxdmjs' src='" + cfJsHost + captainform_servicedomain + "/includes/easyXDM.min.js' type='text/javascript'%3E%3C/script%3E"));
	}
	if(document.getElementById('iframeresizer_embedding_system') == null)
	{
		document.write(unescape("%3Cscript id='iframeresizer_embedding_system' src='" + cfJsHost + captainform_servicedomain + "/modules/captainform/js/iframe_resizer/3.5/iframeResizer.min.js' type='text/javascript'%3E%3C/script%3E"));
	}
	document.write(unescape("%3Cscript src='" + cfJsHost + captainform_servicedomain + "/jsform-{{ID}}.js?" + customVarsMF + captainform_theme_style + "' type='text/javascript'%3E%3C/script%3E"));
</script>