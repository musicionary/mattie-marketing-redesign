<?php
/** @var $this WPBakeryShortCode_VC_Tab */
$output = $title = $tab_id = $tab_icon = '';
extract(shortcode_atts($this->predefined_atts, $atts));

echo sprintf('<li><div>%s</div></li>', ($content=='' || $content==' ') ? __("Empty tab. Edit page to add content here.", "js_composer") : "\n\t\t\t\t" . wpb_js_remove_wpautop($content));