<?php get_header(); ?>	

<?php
/**
 * Blog Page
 */
$page_id = tt_get_page_id();
$sidebar = get_post_meta( tt_get_page_id(), THEME_NAME . '_sidebar_position', true );
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
					<?php echo tt_breadcrumbs();
						if (have_posts()): ?>				
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