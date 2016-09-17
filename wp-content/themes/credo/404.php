<?php get_header(); 
$background = _go('error_background') ? 'background: url('._go('error_background').') no-repeat center center / cover' : '';
?>
<section class="error-section" style="<?php echo esc_attr($background);?>">
    <div class="container">
        <h2><?php _eo('error_title');?></h2>
        <h6><?php _eo('error_subtitle');?></h6>
        <img src="<?php _eo('error_emblem');?>" alt="<?php _e('404 logo','credo');?>">
        <br>
        <a href="<?php echo home_url('/');?>"><i class="fa fa-angle-left"></i><?php _eo('error_button');?></a>
    </div>
</section>
<?php get_footer(); ?>