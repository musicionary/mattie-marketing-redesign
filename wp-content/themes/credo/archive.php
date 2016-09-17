<?php get_header(); ?>  

<?php
/**
 * Archive Page
 */
$page_id = get_option( 'page_for_posts');
if(is_archive())
$sidebar = get_post_meta( $page_id, THEME_NAME . '_sidebar_position', true );
else
$sidebar = get_post_meta( get_the_ID(), THEME_NAME . '_sidebar_position', true );
$sidebar = $sidebar ? $sidebar : 'right';
?>
    <section class="blog-section">
        <div class="container">
                <?php if($sidebar !== "full_width"): ?>
                    <div class="row">
                <?php endif; ?>

                <?php if($sidebar == "left"): ?>
                    <!-- Sidebar -->
                    <div class="col-md-4">
                        <div class="main-sidebar">
                            <?php get_sidebar();?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if($sidebar !== "full_width"): ?>
                    <!-- Main content -->               
                    <div class="col-md-8">
                <?php endif; ?>

                <div class="main-blog-content">
                    <?php echo tt_breadcrumbs(); ?>

                         <h3 class="archive-title">
                            <?php if (is_category()) { ?> <?php _e('Category Archives:', 'credo'); ?> <strong><?php single_cat_title(); ?></strong>
                            <?php } elseif( is_tag() ) { ?><?php _e('Post Tagged with:', 'credo'); ?> <strong>"<?php single_tag_title(); ?>"</strong>
                            <?php } elseif (is_day()) { ?><?php _e('Archive for', 'credo'); ?> <strong><?php the_time('F jS, Y'); ?></strong>
                            <?php } elseif (is_month()) { ?><?php _e('Archive for', 'credo'); ?> <strong><?php the_time('F, Y'); ?></strong>
                            <?php } elseif (is_year()) { ?><?php _e('Archive for', 'credo'); ?> <strong><?php the_time('Y'); ?></strong>
                            <?php } elseif (is_author()) { ?><?php _e('Author Archives: ', 'credo'); echo '<strong>'.get_the_author().'</strong>'; ?>  
                            <?php } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?><?php _e('Archives', 'credo'); } ?>
                        </h3>

                        <?php if (have_posts()): ?>               
                            <?php while(have_posts()): the_post(); 
                                get_template_part('post_format/content',get_post_format( ));
                            endwhile; ?>
                        <?php get_template_part('nav','main'); ?>
                    <?php endif; ?>
                </div>

                <?php if($sidebar !== "full_width"): ?>
                    </div>
                <?php endif; ?>   

                <?php if($sidebar == "right"): ?>
                    <!-- Sidebar -->
                    <div class="col-md-4">
                        <div class="main-sidebar">
                            <?php get_sidebar();?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if($sidebar !== "full_width"): ?>
                    </div>
                <?php endif; ?>
        </div>
    </section>
<?php get_footer(); ?>