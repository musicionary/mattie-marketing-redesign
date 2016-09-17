<?php $post_id = get_the_ID(); ?>

<div class="post-header">
    <div class="post-cover">
       	<?php if(has_post_thumbnail()):?>
        <a href="<?php the_permalink();?>">
            <?php the_post_thumbnail( 'large' );?>
        </a>
        <?php endif;?>
    </div>
    <h6><?php the_category(', ');?></h6>
    <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
</div>
