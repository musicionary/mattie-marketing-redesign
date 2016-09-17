<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $full_width
 * @var $full_height
 * @var $content_placement
 * @var $parallax
 * @var $parallax_image
 * @var $css
 * @var $el_id
 * @var $video_bg
 * @var $video_bg_url
 * @var $video_bg_parallax
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row
 */
$output = $after_output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'wpb_composer_front_js' );

$wrapper_attributes = array();

$el_class = $this->getExtraClass( $el_class );

$full_height = !empty($full_height) ? 'full-height' : '';
$content_placement = !empty($full_height) && $content_placement === 'middle' ? 'middle-content' : '';

if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}

$has_video_bg = ( ! empty( $video_bg ) && ! empty( $video_bg_url ) && vc_extract_youtube_id( $video_bg_url ) );

$video_bg = '';
if ( $has_video_bg ) {
	$parallax = $video_bg_parallax;
	$parallax_image = $video_bg_url;
	$video_bg = 'vc_video-bg-container';
	wp_enqueue_script( 'vc_youtube_iframe_api_js' );
}

if ( ! empty( $parallax ) ) {
	wp_enqueue_script( 'vc_jquery_skrollr_js' );
	$wrapper_attributes[] = 'data-vc-parallax="1.5"'; // parallax speed
	$css_classes[] = 'vc_general vc_parallax vc_parallax-' . $parallax;
	if ( strpos( $parallax, 'fade' ) !== false ) {
		$css_classes[] = 'js-vc_parallax-o-fade';
		$wrapper_attributes[] = 'data-vc-parallax-o-fade="on"';
	} elseif ( strpos( $parallax, 'fixed' ) !== false ) {
		$css_classes[] = 'js-vc_parallax-o-fixed';
	}
}

$parallax_class = !empty( $parallax ) ? 'paralax-section' : '';

if ( ! empty ( $parallax_image ) ) {
	if ( $has_video_bg ) {
		$parallax_image_src = $parallax_image;
	} else {
		$parallax_image_id = preg_replace( '/[^\d]/', '', $parallax_image );
		$parallax_image_src = wp_get_attachment_image_src( $parallax_image_id, 'full' );
		if ( ! empty( $parallax_image_src[0] ) ) {
			$parallax_image_src = $parallax_image_src[0];
		}
	}
	$wrapper_attributes[] = 'data-vc-parallax-image="' . esc_attr( $parallax_image_src ) . '"';
}
if ( ! $parallax && $has_video_bg ) {
	$wrapper_attributes[] = 'data-vc-video-bg="' . esc_attr( $video_bg_url ) . '"';
}

$section_data = implode(' ', $wrapper_attributes);

$tt_css = array(
		'vc_section',
		vc_shortcode_custom_css_class( $css ),
		$video_bg,
		$full_height,
		$parallax_class,
		$content_placement,
		$el_class
	);

$tt_css = implode(' ', $tt_css);

switch ($full_width) {
	case 'stretch_row':
		printf('<section class="box %s" %s><div class="container"><div class="row">%s</div></div></section>', $tt_css, $section_data,wpb_js_remove_wpautop( $content ));
		break;

	case 'stretch_row_content':
		printf('<section class="%s" %s><div class="container-fluid clearfix ovh"><div class="row">%s</div></div></section>', $tt_css, $section_data, wpb_js_remove_wpautop( $content ));
		break;

	case 'stretch_row_content_no_spaces':
		printf('<section class="box-no-spaces ovh %s" %s><div class="row row-fit">%s</div></section>', $tt_css, $section_data, wpb_js_remove_wpautop( $content ));
		break;
	
	default:
		printf('<section class="box %s" %s><div class="row">%s</div></section>', $tt_css, $section_data, wpb_js_remove_wpautop( $content ));
		break;
}