<?php
$output = $title = $interval = $el_class = $tab_style = $spaces = '';
extract( shortcode_atts( array(
	'title' => '',
	'interval' => 0,
	'tab_style' => '',
	'el_class' => '',
	'spaces' => 'air-nav'
), $atts ) );

// Extract tab titles
preg_match_all( '/vc_tab([^\]]+)/i', $content, $matches, PREG_OFFSET_CAPTURE );
$tab_titles = array();

/**
 * vc_tabs
 *
 */
if ( isset( $matches[1] ) ) {
	$tab_titles = $matches[1];
}

$element = 'wpb_tabs';
if ( 'vc_tour' == $this->shortcode ) $element = 'wpb_tour';

$el_class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, trim( $element . ' wpb_content_element ' . $el_class ), $this->settings['base'], $atts );

if(empty($tab_style) || $tab_style === 'default'):

$tab_id = rand(1, 9999);

echo !empty($title) ? sprintf('<h5>%s</h5>', $title) : '';

?>
	<div class="tabs-box <?php echo esc_attr($css_class); ?>">
        <div class="row">
            <div class="col-md-<?php echo ('vc_tour' == $this->shortcode) ? 2 :12; ?>">
                <div id="tab-<?php echo esc_attr($tab_id);  ?>" class="tabs-nav <?php echo esc_attr($spaces); ?>">
                	<?php if(!empty($tab_titles)): ?>
                    <ul class="inline-list">
                    	<?php foreach($tab_titles as $id=>$tab): $tab_atts = shortcode_parse_atts($tab[0]); ?>
                        	<li <?php echo ('vc_tour' == $this->shortcode) ? 'class="make-full"' : ''; ?>><a href="#" class="button-md bg-light-grey text-black" data-target="<?php echo esc_attr($id+1); ?>"><?php echo balanceTags($tab_atts['title']); ?></a></li>
                    	<?php endforeach; ?>                        
                    </ul>
                <?php endif; ?>
                </div>
            </div>

            <div class="col-md-<?php echo ('vc_tour' == $this->shortcode) ? 10 :12; ?>">
                <div class="tabs-content" data-sudo-slider='{"slideCount":1, "moveCount":1, "customLink":"#tab-<?php echo esc_attr($tab_id); ?> a", "continuous":false, "updateBefore":false}'>
                    <ul class="clean-list">
                       <?php echo wpb_js_remove_wpautop( $content ); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

<?php

elseif($tab_style === 'big'):
	$tab_nav = '<div id="big-tabs-nav" class="slide-navigation align-center"><ul class="inline-list">
					<li><a href="#" class="bg-white" data-target="prev"><i class="icon-110"></i></a></li>
					<li><a href="#" class="bg-white" data-target="next"><i class="icon-111"></i></a></li>
				</ul></div>';

	$tab_title_pat = '<li %s data-target="%s"><div class="tab-item uppercase text-center">
							<div class="shape-square bg-white"><i class="icon-%s font-6x"></i></div>
							<h6 class="font-alpha"><small>%s</small></h6>
						</div></li>';


	$tabs_title = '<div class="big-tabs" 
					data-sudo-slider=\'{"slideCount":5, "moveCount":1, "customLink":"#big-tabs-nav a, .big-tabs li", "continuous":true}\'>
					<ul class="clean-list">';

	$tabs_content = '<div class="big-tabs-content %s" data-sudo-slider=\'{"customLink":"#big-tabs-nav a, .big-tabs li", "continuous":true}\'>
					<ul class="inline-list">%s</ul></div>';

	$first_tabs = '';

	foreach ($tab_titles as $key => $tab) {
		$tab_atts = shortcode_parse_atts($tab[0]);
		if(isset($tab_atts['title'])) {
			if($key < 3) {
				$first_tabs .= sprintf($tab_title_pat, ($key === 0) ? 'class="active-big-tab"' : '' , $key+1, isset($tab_atts['tab_icon']) ? $tab_atts['tab_icon'] : '', $tab_atts['title']);
			} else {
				$tabs_title .= sprintf($tab_title_pat, ($key === 0) ? 'class="active-big-tab"' : '' , $key+1, isset($tab_atts['tab_icon']) ? $tab_atts['tab_icon'] : '', $tab_atts['title']);
				
			}
		}
	}

	$tabs_title .= $first_tabs;
	$tabs_title .= '</ul></div>';

	echo balanceTags($tab_nav);
	echo balanceTags($tabs_title);
	echo sprintf($tabs_content, $css_class, wpb_js_remove_wpautop( $content ));

endif;