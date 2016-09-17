<?php

if($shortcode['shortcode_type'] == '1'):

	$post_date = !empty($_GET['date']) ? $_GET['date'] : '';
	$posts_nr = !empty($post_date) ? -1 : 10;

	$event_query = new WP_Query(array(
	    'post_type' => 'events',
	    'orderby' => 'meta_value_num',
	    'meta_key' => THEME_NAME . '_event_start',
	    'order' => 'ASC',
	    'showposts' => $posts_nr,
	    'meta_query' => array(
	        'relation' => 'AND',
	        array(
	            'key' => THEME_NAME .'_event_start',
	            'value' => !empty($post_date) ? strtotime($post_date.' 00:00:00') : '0',
	            'compare' => '>',
	        ),
	        array(
	            'key' => THEME_NAME .'_event_start',
	            'value' => !empty($post_date) ? strtotime($post_date.' 23:59:59') :  '9999999999999',
	            'compare' => '<',
	        )
	    )
	));

	?>

	<?php if($shortcode['show_calendar'] == 'yes' && $shortcode['shortcode_type'] == '1'):?>
	<div class="calendar-section">
	    <div class="container">
	        <div id="calendar"></div>
	    </div>
	</div>
	<?php endif;?>

	<div class="big-events-section <?php echo esc_attr($shortcode['el_class']);?>">
	    <div class="container">
	    	<div class="main-loader">
				<div class="spinner">
					<div class="spinner-container container1">
						<div class="circle1"></div>
						<div class="circle2"></div>
						<div class="circle3"></div>
						<div class="circle4"></div>
					</div>
					<div class="spinner-container container2">
						<div class="circle1"></div>
						<div class="circle2"></div>
						<div class="circle3"></div>
						<div class="circle4"></div>
					</div>
					<div class="spinner-container container3">
						<div class="circle1"></div>
						<div class="circle2"></div>
						<div class="circle3"></div>
						<div class="circle4"></div>
					</div>
				</div>
			</div>
	        <h2 class="site-title black-title event-sel-date"><?php print !empty($post_date) ? date_i18n(get_option('date_format'), strtotime($post_date)) : __('All Events','credo');?></h2>
	        <div class="events-container">
				<?php if ( $event_query->have_posts() ) : while ( $event_query->have_posts() ) : $event_query->the_post();
				    $postid = get_the_ID();
				    $options = get_post_meta($postid, 'slide_options', true); ?>
			    <div class="event-big-box" id="post-<?php echo esc_attr($postid);?>">
			        <div class="row">
			            <div class="col-md-6">
			                <div class="event-big-image">
			                    <img src="<?php echo wp_get_attachment_url($options['event_cover']); ?>" alt="<?php _e('events','credo');?>" />
			                </div>
			            </div>
			            <div class="col-md-5 col-md-offset-1">
			                <h2><?php echo get_the_title($postid); ?></h2>
			                <?php the_content();?>
			                <div class="event-big-location">
			                    <div class="date"><?php echo date_i18n(!empty($post_date) ? 'd M'.' '.get_option('time_format') : get_option('date_format').' '.get_option('time_format'), get_post_meta($postid, THEME_NAME . '_event_start', true));?></div>
			                    <ul class="location">
			                        <li><b><?php _e('Location:','credo');?></b></li>
			                    <?php $locations = explode(',', $options['event_location']);
			                    foreach($locations as $loc)
			                        print '<li>'.$loc.'</li>';
			                    ?>
			                    </ul>
			                </div>

			            </div>
			        </div>
			    </div>
				<?php endwhile; else: ?>
				    <h3><?php _e('No events to display', 'credo'); ?></h3>
				<?php endif; wp_reset_postdata(); ?>
			</div>
			<?php if(empty($post_date) && $event_query->have_posts()):?>
				<div class="load-events button align-center <?php if($event_query->found_posts <= 10) print 'hidden';?>" data-offset="10" data-count="<?php print $event_query->found_posts;?>"><?php _e('Load More','credo');?></div>
			<?php endif; ?>
	    </div>
	</div>
<?php else: ?>
	<div class="events-section <?php echo esc_attr($shortcode['el_class']);?>">
		<div class="row row-fit">
			<?php
				$event_query = new WP_Query(array(
		            'post_type' => 'events',
		            'orderby' => 'meta_value_num',
		            'meta_key' => THEME_NAME . '_event_start',
		            'events_tax' => $shortcode['category'],
		            'order' => 'ASC',
		            'showposts' => !empty($shortcode['nr']) ? $shortcode['nr'] : '',
		        ));

			while ( $event_query->have_posts() ) : $event_query->the_post();
				$post_id = get_the_ID();
				$event_date = get_post_meta($post_id, THEME_NAME . '_event_start', true);
				$options = get_post_meta($post_id, 'slide_options', true);
			?>
	        <div class="col-md-<?php echo esc_attr($shortcode['columns']);?>">
	            <div class="event-box">
	                <div class="event-hover">
	                    <div class="event-date"><?php echo date_i18n(get_option('date_format'), $event_date);?><span><?php echo date_i18n(get_option('time_format'), $event_date);?></span></div>
	                    <h3>
	                    	<?php print !empty($shortcode['page_url']) ? ' <a href="'.$shortcode['page_url'].'?date='.date_i18n('m/d/Y', $event_date).'#post-'.$post_id.'">'.get_the_title($post_id).'</a>' : get_the_title($post_id); ?>
	                   </h3>
	                </div>
	                <div class="event-img">
	                	<?php print !empty($shortcode['page_url']) ? ' <a href="'.$shortcode['page_url'].'?date='.date_i18n('m/d/Y', $event_date).'#post-'.$post_id.'"><img src="'.wp_get_attachment_url($options['event_cover']).'" alt="'.__('event cover','credo').'"></a>' : '<img src="'.wp_get_attachment_url($options['event_cover']).'" alt="'.__('event cover','credo').'">'; ?>
	                </div>
	            </div>
	        </div>
	        <?php endwhile; wp_reset_postdata(); ?>
	    </div>
    </div>
<?php endif;?>
