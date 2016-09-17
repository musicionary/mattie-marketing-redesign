<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
     <!-- Pingbacks -->
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php echo "<script type='text/javascript'>var TemplateDir='".TT_THEME_URI."'</script>" ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class('home-counter');?>>

    <!-- Page Wrapper -->
    <div id="page">
    
        <?php 
            $logo_position = _go('logo_position') ? 'align-'._go('logo_position') : 'align-center';
            $nav_position = _go('nav_position') ? 'text-'._go('nav_position') : 'text-left';
        ;?>

        <header>
            <div class="container">
                <div class="inside">
                   <div class="logo <?php echo balanceTags($logo_position);?>">
                       <a href="<?php echo home_url('/'); ?>" style="<?php _estyle_changer('logo_text') ?>" >
                            <?php if(_go('logo_image')): ?>
                                <img src="<?php _eo('logo_image') ?>" alt="<?php echo THEME_PRETTY_NAME ?>"> 
                            <?php elseif(_go('logo_text')): ?>
                                <?php _eo('logo_text') ?>
                            <?php else: ?>
                                <img class="aligncenter" src="<?php echo get_template_directory_uri().'/images/logo.png';?>" alt="<?php echo THEME_PRETTY_NAME ?>">
                            <?php endif; ?>
                        </a>
                    </div>
                </div>
                <div class="header-bar">
                    <ul class="socials">
                       <?php 
                            $social_platforms = array(
                                'facebook',
                                'twitter',
                                'dribbble',
                                'youtube',
                                'rss',
                                'google',
                                'linkedin',
                                'pinterest',
                                'instagram'
                            );

                            foreach($social_platforms as $platform): 
                                if (_go('social_platforms_' . $platform)):?>
                                    <li>
                                        <a href="<?php echo esc_url(_go('social_platforms_' . $platform)); ?>"><i class="fa fa-<?php echo esc_attr($platform); ?>" title="<?php echo esc_attr($platform); ?>"></i></a>
                                    </li>
                                <?php endif;
                            endforeach; 
                        ?>
                    </ul>
                    <!-- navigation -->
                    <nav class="main-nav <?php echo esc_attr($nav_position);?>">
                        <div class="responsive-menu"><i class="fa fa-bars"></i></div>
                        <ul>
                           <?php wp_nav_menu( array( 
                                'title_li'=>'',
                                'theme_location' => 'main_menu',
                                'container' => false,
                                'items_wrap' => '%3$s',
                                'fallback_cb' => 'wp_list_pages'
                                ));
                            ?>
                        </ul>
                    </nav>
                    <!-- navigation -->
                </div>
            </div>
        </header>