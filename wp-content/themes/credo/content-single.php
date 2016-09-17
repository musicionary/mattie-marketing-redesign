<?php
$post_id = get_the_ID();
$format = get_post_format() ? get_post_format() : 'standart';
?>

<div <?php post_class('blog-post blog-post-single');?> id="post-<?php the_ID(); ?>">
    <?php get_template_part('post_format/header','standart');?>

    <div class="post-content">
       <?php the_content() ?>
       <div class="post-navigation">
            <?php wp_link_pages(array(
                'next_or_number'   => 'number',
                'nextpagelink'     => __( 'Next page','credo' ),
                'previouspagelink' => __( 'Previous page','credo' ),
                'pagelink'         => '%',
                'echo' => 1
            )); ?>
        </div>
    </div>

    <div class="post-details">
        <div class="tags">
            <?php the_tags();?>
        </div>

        <ul class="share-this">
            <?php tt_share();?>
        </ul>
    </div>

    <div class="post-footer">
        <div class="post-date"><?php the_time(get_option('date_format')) ?></div>
        <ul>
            <li><i class="fa fa-commenting-o"></i><?php echo get_comments_number( '0', '1', '%' ) ?></li>
            <li class="like-heart" data-id="<?php echo esc_attr($post_id);?>"><i class="fa <?php echo isset($_COOKIE['post_likes_'. $post_id]) ? esc_attr('fa-heart liked') : esc_attr('fa-heart-o'); ?>"></i><span><?php print get_post_meta($post_id, 'post_likes', true) ? get_post_meta($post_id, 'post_likes', true) : '0' ;?></span></li>
        </ul>
    </div>

    <?php if(!_go('hide_related')):
        $settings = _go('related_settings') ? explode("|", _go('related_settings')) : '';
    ?>
    <div class="related-posts">
        <h2 class="site-title"><?php print !empty($settings[0]) ? $settings[0] : __('Related Posts','credo');?></h2>
        <div class="row">
            <?php 
                $query = new WP_Query( array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'post__not_in' => array($post_id),
                    'showposts' => !empty($settings[1]) ? $settings[1] : 2,
                ));
            ;?>

            <?php if($query -> have_posts()) : while($query -> have_posts()) : $query->the_post();
                $rel_id = get_the_ID();
             ?>
            <div class="col-md-6">
                <div class="news-box">
                    <div class="news-date"><?php the_time('d');?> <span><?php the_time('M');?></span></div>
                    <?php if(has_post_thumbnail()):?>
                    <div class="news-img">
                        <?php the_post_thumbnail( 'medium' );?>
                    </div>
                    <?php endif;?>
                    <div class="news-content">
                        <h4 class="news-title"<?php print !has_post_thumbnail() ? 'style="padding-left: 50px"' : '';?>><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                        <p><?php print tt_excerpt($rel_id,110);?></p>
                    </div>
                    <div class="news-info">
                        <ul>
                            <li><a href="<?php the_permalink();?>"><?php _e('View','credo');?></a></li>
                            <li><i class="fa fa-commenting-o"></i><?php echo get_comments_number( '0', '1', '%' ) ?></li>
                            <li class="like-heart" data-id="<?php echo esc_attr($rel_id);?>"><i class="fa <?php echo isset($_COOKIE['post_likes_'. $rel_id]) ? esc_attr('fa-heart liked') : esc_attr('fa-heart-o'); ?>"></i><span><?php print get_post_meta($rel_id, 'post_likes', true) ? get_post_meta($rel_id, 'post_likes', true) : '0' ;?></span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php endwhile;?>
            <?php else: ?>
                <h4><?php _e('No posts to display','credo');?></h4>
            <?php endif; wp_reset_postdata(); ?>
        </div>
    </div>
    <?php endif;?>
    <div class="inner-area-post">
        <?php comments_template();?>
    </div>
</div>