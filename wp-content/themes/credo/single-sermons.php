<?php
/**
 * Single Sermon Page
 */

get_header();
?>
	<?php while ( have_posts() ) : the_post();
		$options = get_post_meta(get_the_ID(), 'slide_options', true);
		$bg_url = !empty($options['sermon_cover']) ? 'background: url('.wp_get_attachment_url($options['sermon_cover']).') top center no-repeat;' : '';
		$post_id = get_the_ID();
	?>
	<section class="sermon-section" style="<?php echo esc_attr($bg_url);?>">
        <div class="container">
            <div class="sermon-header">
                <h2><?php the_title();?></h2>
                <h6><?php print $options['sermon_speaker'];?></h6>
            </div>
            <div class="sermon-content">
            	<?php the_content();?>
            </div>
        </div>
    </section>
    <?php endwhile; ?>

    <?php if(!_go('hide_related_s')):
        $settings = _go('related_settings_s') ? explode("|", _go('related_settings_s')) : '';
    ?>
    <section class="sermons-section">
        <div class="container">
            <h2 class="site-title black-title"><?php print !empty($settings[0]) ? $settings[0] : __('Similar Sermons','credo');?></h2>
            <div class="row">
            	<?php 
                	$query = new WP_Query( array(
	                    'post_type' => 'sermons',
	                    'post_status' => 'publish',
	                    'post__not_in' => array($post_id),
	                    'showposts' => !empty($settings[1]) ? $settings[1] : 4,
	                    'tax_query' => array(
						    array(
						      'taxonomy' => 'post_format',
						      'field' => 'slug',
						      'terms' => 'post-format-'.get_post_format( $post_id )
						    )
						)
	                ));
	            ;?>
	            <?php if($query -> have_posts()) : while($query -> have_posts()) : $query->the_post();
	                $options = get_post_meta(get_the_ID(), 'slide_options', true);
	                $formats = get_post_format(get_the_ID());

	            	switch($formats) {
	            		case 'quote': $format = 'commenting'; break;
	            		case 'gallery': $format = 'camera'; break;
	            		case 'video': $format = 'play-circle'; break;
	            		case 'audio': $format = 'music'; break;
	            		case 'photo': $format = 'commenting'; break;
	            		default: $format = 'file-text-o';
	            	}
	            ?>
                <div class="col-md-3">
                    <div class="sermon-box">
                        <ul class="sermon-icons">
                            <li><i class="fa fa-<?php echo esc_attr($format);?>"></i></li>
                        </ul>
                        <div class="sermon-img">
                            <img src="<?php echo wp_get_attachment_url($options['sermon_thumb']);?>" alt="<?php _e('sermon','credo');?>" />
                        </div>
                        <h5><a href="<?php the_permalink();?>"><?php the_title();?></a></h5>
                        <p class="sermon-excerp"><?php print $options['sermon_speaker'];?><span><?php echo get_the_time(get_option('date_format'));?></span></p>
                    </div>
                </div>
                <?php endwhile;?>
                <?php else: ?>
                    <h4><?php _e('No sermons to display','credo');?></h4>
                <?php endif; wp_reset_postdata(); ?>
	        </div>
        </div>
    </section>
    <?php endif;?>
<?php get_footer(); ?>