<div class="sermons-grid <?php echo esc_attr($shortcode['el_class']);?>">
    <div class="row">
        <div class="sermons-container" data-tesla-plugin="masonry">
            <?php $nr_s = !empty($shortcode['nr']) ? $shortcode['nr'] : 12;
                foreach($slides as $slide_nr => $slide): if($slide_nr >= $nr_s) break; 
                $formats = get_post_format($slide['post']->ID);

                switch($formats) {
                    case 'quote': $format = 'commenting'; break;
                    case 'gallery': $format = 'camera'; break;
                    case 'video': $format = 'play-circle'; break;
                    case 'audio': $format = 'music'; break;
                    case 'photo': $format = 'commenting'; break;
                    default: $format = 'file-text-o';
                }
            ?>
            <div class="col-md-<?php echo esc_attr($shortcode['columns']);?>">
                <div class="sermon-box">
                    <ul class="sermon-icons">
                        <li><i class="fa fa-<?php echo esc_attr($format);?>"></i></li>
                    </ul>
                    <div class="sermon-img">
                        <img src="<?php echo esc_attr($slide['options']['sermon_thumb']);?>" alt="<?php _e('sermont','credo');?>" />
                    </div>
                    <h5><a href="<?php echo get_the_permalink($slide['post']->ID);?>"><?php echo strlen(get_the_title($slide['post']->ID)) > 50 ? substr(get_the_title($slide['post']->ID), 0, 50).'...' : get_the_title($slide['post']->ID);?></a></h5>
                    <p class="sermon-excerp"><?php print $slide['options']['sermon_speaker'];?> <span><?php echo get_the_time(get_option('date_format'), $slide['post']->ID);?></span></p>
                </div>
            </div>
            <?php endforeach;?>
        </div>
    </div>

    <div class="load-sermons button align-center <?php if(!empty($shortcode['nr']) || count($slides) < 12) print 'hidden';?>" data-offset="12" data-count="<?php print count($slides);?>" data-columns="<?php echo esc_attr($shortcode['columns']);?>" data-category="<?php echo esc_attr($shortcode['category']);?>"><?php _e('Load More','credo');?></div>
</div>