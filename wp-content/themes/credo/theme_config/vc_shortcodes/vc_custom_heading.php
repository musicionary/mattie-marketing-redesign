<?php
/**
 * @var $this WPBakeryShortCode_VC_Custom_heading
 */
$link = '';
extract( $this->getAttributes( $atts ) );
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

extract( $this->getStyles( $el_class, $css, $google_fonts_data, $font_container_data, $atts ) );
$settings = get_option( 'wpb_js_google_fonts_subsets' );
$subsets = '';
$uppercase = !empty($atts['make_uppercase']) ? 'uppercase' : '';
$no_top = !empty($atts['no_top']) ? 'no-top' : '';

if ( is_array( $settings ) && ! empty( $settings ) ) {
	$subsets = '&subset=' . implode( ',', $settings );
}
if ( ! empty( $google_fonts_data ) && isset( $google_fonts_data['values']['font_family'] ) ) {
	wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $google_fonts_data['values']['font_family'] ), '//fonts.googleapis.com/css?family=' . $google_fonts_data['values']['font_family'] . $subsets );
}
$output .= '<div class="' . esc_attr( $css_class ) . ' '. $uppercase . ' ' . $no_top . '" >';
$style = '';
if ( ! empty( $styles ) ) {
	$style = esc_attr( implode( ';', $styles ) );
}

$weight = !empty($atts['use_theme_fonts']) ? ' font-weight: '.$atts['fnt_weight'].'; ' : '';

$output .= '<' . $font_container_data['values']['tag'] . ' style="' . $weight .  $style . '" >';
$output .= $text;
$output .= '</' . $font_container_data['values']['tag'] . '>';
$output .= '</div>';

echo balanceTags($output);