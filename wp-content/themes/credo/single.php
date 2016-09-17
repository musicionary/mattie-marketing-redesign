<?php get_header(); ?>	

<?php
/**
 * Single post page
 */
$page_id = tt_get_page_id();
$blog_page_id = get_option( 'page_for_posts' );
$sidebar_option = get_post_meta( $page_id, THEME_NAME . '_sidebar_position', true );

switch ($sidebar_option) {
	case 'as_blog':
		$s_id = $blog_page_id;	
		break;
	case 'full_width':
		$s_id = $page_id;
		break;
	case 'right':
		$s_id = $page_id;
		break;
	case 'left':
		$s_id = $page_id;
}

if(!empty($s_id))
	$sidebar = get_post_meta( $s_id, THEME_NAME . '_sidebar_position', true );
	$sidebar = empty($sidebar) ? 'right' : $sidebar;
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
				if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<?php get_template_part('content','single');
					  tt_set_post_views(get_the_ID()); 
				endwhile; ?>
				<?php else: ?>
					<h2><?php _e('No posts to display','credo'); ?></h2>
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