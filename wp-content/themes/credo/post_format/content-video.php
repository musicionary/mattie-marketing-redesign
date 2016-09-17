<?php $post_id = get_the_ID(); 
	$is_format = in_array(get_post_format($post_id), array('audio', 'video')) ? true : false;
	$has_embed = tt_get_first_embed_media($post_id);
?>

<div <?php post_class('blog-post');?>>
    <div class="post-header">
        <div class="post-cover">
        	<?php if($is_format && $has_embed) {
        	 	print $has_embed;
        	}  else if(has_post_thumbnail()):?>
                   <a href="<?php the_permalink();?>">
                        <?php the_post_thumbnail( 'large' );?>
                    </a>
                <?php endif; 
            ?>
        </div>
        <h6><?php the_category(', ');?></h6>
        <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
    </div>
    <?php get_template_part('post_format/post' , 'meta') ?>
</div>
