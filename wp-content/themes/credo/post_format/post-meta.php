    
    <?php $post_id = get_the_ID();?>
    
    <div class="post-content">
       <?php the_excerpt() ?>
    </div>
    <div class="post-footer">
        <a class="post-read" href="<?php the_permalink();?>"><?php _e('View','credo');?></a>
        <div class="post-date"><?php the_time(get_option('date_format')) ?></div>
        <ul>
            <li><i class="fa fa-commenting-o"></i><?php echo get_comments_number( '0', '1', '%' ) ?></li>
            <li class="like-heart" data-id="<?php echo esc_attr($post_id);?>"><i class="fa <?php echo isset($_COOKIE['post_likes_'. $post_id]) ? esc_attr('fa-heart liked') : esc_attr('fa-heart-o'); ?>"></i><span><?php print get_post_meta($post_id, 'post_likes', true) ? get_post_meta($post_id, 'post_likes', true) : '0' ;?></span></li>
        </ul>
    </div>