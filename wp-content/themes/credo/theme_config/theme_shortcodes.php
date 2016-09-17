<?php

tt_register_sc('tt_event_countdown', 'tt_event_countdown');

function tt_event_countdown($atts, $content = null) {
	$defaults = shortcode_atts(array(
		'event_post' 	=> '',
		'page_url' 	=> '',
		'el_class' 		=> ''
	), $atts);

	$event_date = get_post_meta($defaults['event_post'], THEME_NAME . '_event_start', true);
	$url = !empty($defaults['page_url']) ? '<a href="'.$defaults['page_url'].'?date='.date_i18n('m/d/Y', $event_date).'#post-'.$defaults['event_post'].'">'.get_the_title($defaults['event_post']).'</a>' : get_the_title($defaults['event_post']);
	ob_start(); ?>
	<div class="event-counter">
        <h2 class="site-title"><?php print $url;?></h2>
        <ul id="the-countdown" data-duedate="<?php echo date('m/d/Y H:i',$event_date);?>">
            <li class="count">
                <div id="days">00</div><span><?php _e('days','credo');?></span></li>
            <li class="count">
                <div id="hours">00</div><span><?php _e('hours','credo');?></span></li>
            <li class="count">
                <div id="minutes">00</div><span><?php _e('min','credo');?></span></li>
            <li class="count">
                <div id="seconds">00</div><span><?php _e('sec','credo');?></span></li>
        </ul>
    </div>
	<?php return ob_get_clean();
}

tt_register_sc('tt_tesla_map', 'tt_tesla_map');

function tt_tesla_map($atts, $content = null) {
	$defaults = shortcode_atts(array(
		'contact_pins' 		=> ''
	), $atts);

	$contact_items = (array) vc_param_group_parse_atts( $defaults['contact_pins'] );
	$maps['locations'] = NULL;
		foreach ($contact_items as $key => $item):
			$maps['locations'][$key]['latitude'] = $item['info_latitude'];
			$maps['locations'][$key]['longitude'] = $item['info_longitude'];
			$maps['locations'][$key]['pin'] = !empty($item['info_icon']) ? wp_get_attachment_url($item['info_icon']) : '';
		endforeach;

	ob_start();?> 
		<div class="map-canvas" data-pin='<?php print json_encode($maps);?>'></div>
	<?php return ob_get_clean();
}

tt_register_sc('tt_breadcrumb_list', 'tt_breadcrumb_list');

function tt_breadcrumb_list($atts, $content = null) {
	$defaults = shortcode_atts(array(
		'el_class' 		=> ''
	), $atts);

	ob_start(); print balanceTags('<div class="breadcrumbs '.$defaults['el_class'].'">'.tt_breadcrumbs().'</div>'); return ob_get_clean();
}


tt_register_sc('tt_contact_item', 'tt_contact_item');

function tt_contact_item($atts, $content = null) {
	$defaults = shortcode_atts(array(
		'item_title' 		=> '',
		'item_image' 		=> '',
		'item_location' 		=> '',
		'item_additional' 		=> '',
		'item_form_id' 		=> '',
		'el_class' 		=> '',
		'item_content' => '',
		'css' => '',
	), $atts);

	$class = $defaults['el_class'].vc_shortcode_custom_css_class( $defaults['css'], ' ' );

	ob_start(); ?>
	<div class="location-form <?php echo esc_attr($class);?>">
        <h3><?php print $defaults['item_title'];?></h3>
        <div class="location-form-img">
            <img src="<?php echo wp_get_attachment_url($defaults['item_image']);?>" alt="images">
        </div>
        <p class="loc-form-details"><?php print $defaults['item_location'];?></p>
        <p class="loc-form-details additional">
           <?php print $defaults['item_additional'];?>
        </p>
        <?php echo do_shortcode('[tesla_form id="'.$defaults['item_form_id'].'"]');?>
    </div>
	<?php return ob_get_clean();
}

tt_register_sc('tt_member', 'tt_member');

function tt_member($atts, $content = null) {
	$defaults = shortcode_atts(array(
		'member_name' 	=> '',
		'member_job' 	=> '',
		'member_intro' 	=> '',
		'member_image' 	=> '',
		'member_url' 	=> '',
		'member_social' => '',
		'el_class' 		=> ''
	), $atts);

	$m_image = !empty($defaults['member_image']) ? wp_get_attachment_url($defaults['member_image']) : '';

	$output = '<div class="team-member"><div class="member-img">';
	$output .= !empty($defaults['member_url']) ? '<a href="'.$defaults['member_url'].'"><img src="'.$m_image.'" alt="member"></a></div><h5><a href="'.$defaults['member_url'].'">'.$defaults['member_name'].'</a></h5>' : '<img src="'.$m_image.'" alt="member"></div><h5>'.$defaults['member_name'].'</h5>';
	$output .= '<h6>'.$defaults['member_job'].'</h6>';
	$output .= !empty($defaults['member_intro']) ? '<p>'.$defaults['member_intro'].'</p>' : '';
	if(!empty($defaults['member_social'])) {
		$output .= '<ul class="socials">';
		$features = explode(',', $defaults['member_social']);
		foreach ($features as $key => $item) {
			$socials = explode('|', $item);
			$output .= '<li><a href="'.$socials[1].'"><i class="fa fa-'.$socials[0].'"></i></a></li>';
		}
		$output .= '</ul>';
	}
	$output .= '</div>';
	ob_start(); print balanceTags($output); return ob_get_clean();
}

tt_register_sc('tt_section_header', 'tt_section_header');

function tt_section_header($atts, $content = null) {
	$defaults = shortcode_atts(array(
		'text' 	=> '',
		'subtext' 	=> '',
		'dots' 	=> '',
		'font_container' 	=> '',
		'css' => '',
		'el_class' 	=> '',
	), $atts);

	$class = $defaults['el_class'].vc_shortcode_custom_css_class( $defaults['css'], ' ' );

	$pieces = explode("|", $defaults['font_container']);
	$tag = explode(":", $pieces[0]);
	$style = str_replace(array('_', '%23', $pieces[0].'|', '|'), array('-', '#', '', ';'), $defaults['font_container']);

	$output = '<div class="section-header '.$class.'">';
	$output .= '<'.$tag[1].' style="'.$style.'">'.$defaults['text'].'</'.$tag[1].'>';
	$output .= '<p>'.$defaults['subtext'].'</p>';

	$output .= '</div>';

	ob_start();  print balanceTags($output);  return ob_get_clean();
}


tt_register_sc('tt_blogposts', 'tt_blogposts');

function tt_blogposts($atts, $content = null) {
	$defaults = shortcode_atts(array(
		'category' => '',
		'posts_nr' => '',
		'el_class' => ''
	), $atts);

	$query = new WP_Query(array(
        'post_type' => 'post',
      	'showposts' => !empty($defaults['posts_nr']) ? $defaults['posts_nr'] : -1,
      	'cat' => $defaults['category']
    ));

	ob_start(); ?>
	<div class="news-section" data-tesla-plugin="carousel" data-tesla-container=".tesla-carousel-items" data-tesla-item="&gt;div" data-tesla-rotate="false" data-tesla-autoplay="false" data-tesla-hide-effect="false">
        <div class="container">
            <ul class="tesla-carousel-arrows">
                <li class="prev disabled"><img src="<?php echo get_template_directory_uri();?>/images/icons/arrow-left.svg" alt="left" /></li>
                <li class="next"><img src="<?php echo get_template_directory_uri();?>/images/icons/arrow-right.svg" alt="right" /></li>
            </ul>
            <div class="row tesla-carousel-items">
            	<?php while ( $query->have_posts() ) : $query->the_post();
            		$rel_id = get_the_ID();
            	?>
                <div class="col-md-3">
                    <div class="news-box">
                        <div class="news-date"><?php the_time('d');?> <span><?php the_time('M');?></span></div>
                        <div class="news-img">
                            <a href="<?php the_permalink();?>">
                                <?php the_post_thumbnail( 'medium' );?>
                            </a>
                        </div>
                        <div class="news-content">
                             <h4 class="news-title"<?php print !has_post_thumbnail() ? 'style="padding-left: 55px"' : '';?>><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                             <p><?php print tt_excerpt($rel_id,80);?></p>
                        </div>
                        <div class="news-info">
                            <ul>
                                <li><a href="<?php the_permalink();?>"><?php _e('View','credo');?></a></li>
                                <li><i class="fa fa-commenting-o"></i><?php echo get_comments_number( '0', '1', '%' ) ?></li>
                                <li class="like-heart" data-id="<?php echo esc_attr($rel_id);?>"><i class="fa <?php print isset($_COOKIE['post_likes_'. $rel_id]) ? 'fa-heart liked' : 'fa-heart-o'; ?>"></i><span><?php print get_post_meta($rel_id, 'post_likes', true) ? get_post_meta($rel_id, 'post_likes', true) : '0' ;?></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            	<?php endwhile;?>
            </div>
        </div>
    </div>
	<?php return ob_get_clean();
}


tt_register_sc('tt_gallery', 'tt_gallery');

function tt_gallery($atts, $content = null) {
	$defaults = shortcode_atts(array(
		'images' 	=> '',
		'link'	=> '',
		'el_class' 	=> '',
		'gallery_max' => '1600',
		'css' 	=> '',
	), $atts);

	$url = vc_build_link( $defaults['link'] );
	$class = vc_shortcode_custom_css_class( $defaults['css'], ' ' ).$defaults['el_class'];

	function col_size($max_width, $att_width) {
		$col_s = $max_width / 12;
		if($att_width >= $col_s && $att_width < $col_s*2)
			$size = 1;
		else if ($att_width >= $col_s*2 && $att_width < $col_s * 3)
			$size = 2;
		else if ($att_width >= $col_s*3 && $att_width < $col_s * 4)
			$size = 3;
		else if ($att_width >= $col_s*4 && $att_width < $col_s * 5)
			$size = 4;
		else if ($att_width >= $col_s*5 && $att_width < $col_s * 6)
			$size = 5;
		else if ($att_width >= $col_s*6 && $att_width < $col_s * 7)
			$size = 6;
		else if ($att_width >= $col_s*7 && $att_width < $col_s * 8)
			$size = 7;
		else if ($att_width >= $col_s*8 && $att_width < $col_s * 9)
			$size = 8;
		else if ($att_width >= $col_s*9 && $att_width < $col_s * 10)
			$size = 9;
		else if ($att_width >= $col_s*10 && $att_width < $col_s * 11)
			$size = 10;
		else if ($att_width >= $col_s*11 && $att_width < $col_s * 12)
			$size = 11;
		else if ($att_width >= $col_s*12)
			$size = 12;

		return $size;
	}

	ob_start(); ?>
	<div class="gallery-section <?php echo esc_attr($class);?>" style="max-width: 1600px;">
		<div class="row" data-tesla-plugin="masonry">
			<?php if(!empty($defaults['images'])) {
				$images = explode(',', $defaults['images']);
				foreach($images as $id):
					$attachment = wp_get_attachment_metadata( $id );
					?>
					<div class="col-md-<?php echo col_size($defaults['gallery_max'], $attachment['width']);?>">
			            <div class="gallery-item">
			                <div class="gallery-hover">
			                    <a class="hover-zoom swipebox" href="<?php echo wp_get_attachment_url($id);?>"><i class="fa fa-search"></i></a>
			                    <h2><?php echo get_the_title($id);?></h2>
			                </div>
			                <img src="<?php echo wp_get_attachment_url($id);?>" alt="<?php echo get_the_title($id);?>" />
			            </div>
			        </div>
				<?php endforeach;

			} ?>
	    </div>
	</div>
	<?php return ob_get_clean();
}