<?php get_header(); ?>  

<?php
/**
 * Search Results Page
 */
$page_id = get_option( 'page_for_posts');
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
                            <?php _e('Results for: ','credo'); ?>'<?php echo get_search_query(); ?>'
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