<?php get_header(); ?>

<?php
	if ( have_posts() ) :
		while ( have_posts() ) : the_post();
			if(has_shortcode( get_the_content(), 'vc_row' ) && class_exists('Vc_Manager')):
				the_content();
			else: 
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
								<?php echo tt_breadcrumbs();?>
								<div class="blog-post">
									<div class="post-header page">
									    <h2><?php the_title();?></h2>
									</div>
									<div class="post-content"><?php the_content(); ?></div>
									<?php get_template_part('nav','main'); ?>
									<div class="inner-area-post"><?php comments_template();	?></div>
								</div>
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
			<?php endif;
		endwhile;
	endif; ?>

<?php get_footer(); ?>