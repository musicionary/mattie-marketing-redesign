<?php

function captainform_shortcode_handler($shortcode)
{
	$custom_options = array(
		'form_id' => $shortcode[0],
		'lightbox' => (isset($shortcode['lightbox'])) ? $shortcode['lightbox'] : false,
		'type' => (isset($shortcode['type'])) ? $shortcode['type'] : null,
		'content' => (isset($shortcode['content'])) ? $shortcode['content'] : null,
		'url' => (isset($shortcode['url'])) ? $shortcode['url'] : null,
		'miliseconds' => (isset($shortcode['miliseconds'])) ? $shortcode['miliseconds'] : null,
		'text_color' => (isset($shortcode['text_color'])) ? $shortcode['text_color'] : null,
		'bg_color' => (isset($shortcode['bg_color'])) ? $shortcode['bg_color'] : null,
		'position' => (isset($shortcode['position'])) ? $shortcode['position'] : null,
	);

	$shortcode_final = '[captainform ' . $shortcode[0];
	$shortcode_final .= (isset($shortcode['lightbox'])) ? " lightbox='{$shortcode['lightbox']}'" : '';
	$shortcode_final .= (isset($shortcode['type'])) ? " type='{$shortcode['type']}'" : '';
	$shortcode_final .= (isset($shortcode['url'])) ? " url='{$shortcode['url']}'" : '';
	$shortcode_final .= (isset($shortcode['content'])) ? " content='{$shortcode['content']}'" : '';
	$shortcode_final .= (isset($shortcode['miliseconds'])) ? " miliseconds='{$shortcode['miliseconds']}'" : '';
	$shortcode_final .= (isset($shortcode['text_color'])) ? " text_color='{$shortcode['text_color']}'" : '';
	$shortcode_final .= (isset($shortcode['bg_color'])) ? " bg_color='{$shortcode['bg_color']}'" : '';
	$shortcode_final .= (isset($shortcode['position'])) ? " position='{$shortcode['position']}'" : '';

	$shortcode_final .= ']';

	$content = captainform_widget_text_filter($shortcode_final, NULL, $custom_options);
	return $content;
}

add_shortcode('captainform', 'captainform_shortcode_handler');
add_shortcode('captain-form', 'captainform_shortcode_handler');