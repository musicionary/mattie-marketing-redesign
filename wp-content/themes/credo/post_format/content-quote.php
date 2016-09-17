<?php $post_id = get_the_ID(); ?>

<div <?php post_class('blog-post');?>>
    <div class="post-header">
        <div class="post-cover">
            <?php 
                $block ="/<blockquote>(.*?)<\/blockquote>/";
                preg_match($block, get_the_content(), $text);
                if(!empty($text)) 
                    print '<div class="blockquote">'.$text[1].'</div>';
                else if(has_post_thumbnail()):?>
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