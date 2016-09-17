        <footer>
            <div class="container">
                <div class="footer-bar">
                    <ul>
                        <?php if(_go('footer_phone')) {
                            print '<li><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 32 32" height="32px" id="Layer_1" version="1.1" viewBox="0 0 32 32" width="32px" xml:space="preserve"><g id="iphone"><path d="M24,0L8,0C6.342,0,5,1.343,5,3v26c0,1.658,1.343,3,3,3h16c1.656,0,3-1.344,3-3V3C27,1.342,25.656,0,24,0z    M25,29c0,0.551-0.449,1-1,1H8c-0.552,0-1-0.447-1-1v-2.004h18V29z M25,25.996H7V6L25,6V25.996z M25,5L7,5V3c0-0.552,0.448-1,1-1   L24,2c0.551,0,1,0.448,1,1V5z" fill="#f2522e"></path><path d="M18,3.5C18,3.776,17.775,4,17.5,4h-3C14.223,4,14,3.776,14,3.5l0,0C14,3.223,14.223,3,14.5,3h3   C17.775,3,18,3.223,18,3.5L18,3.5z" fill="#f2522e"></path><path d="M17,28.496c0,0.275-0.225,0.5-0.5,0.5h-1c-0.276,0-0.5-0.225-0.5-0.5l0,0c0-0.277,0.224-0.5,0.5-0.5h1   C16.775,27.996,17,28.219,17,28.496L17,28.496z" fill="#f2522e"></path></g></svg><span>'.__('Phone','credo').'</span><a href="tel:'._go('footer_phone').'">'._go('footer_phone').'</a></li>';
                        }

                        if(_go('footer_email')) {
                            print '<li><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 32 32" height="32px" id="Layer_1" version="1.1" viewBox="0 0 32 32" width="32px" xml:space="preserve"><path d="M28,5H4C1.791,5,0,6.792,0,9v13c0,2.209,1.791,4,4,4h24c2.209,0,4-1.791,4-4V9  C32,6.792,30.209,5,28,5z M2,10.25l6.999,5.25L2,20.75V10.25z M30,22c0,1.104-0.898,2-2,2H4c-1.103,0-2-0.896-2-2l7.832-5.875  l4.368,3.277c0.533,0.398,1.166,0.6,1.8,0.6c0.633,0,1.266-0.201,1.799-0.6l4.369-3.277L30,22L30,22z M30,20.75l-7-5.25l7-5.25  V20.75z M17.199,18.602c-0.349,0.262-0.763,0.4-1.199,0.4c-0.436,0-0.851-0.139-1.2-0.4L10.665,15.5l-0.833-0.625L2,9.001V9  c0-1.103,0.897-2,2-2h24c1.102,0,2,0.897,2,2L17.199,18.602z" fill="#f2522e" id="mail"></path></svg><span>'.__('Mail','credo').'</span><a href="mailto:'._go('footer_email').'">'._go('footer_email').'</a></li>';
                        }

                        ;?>
                    </ul>
                </div>
                <div class="inside">
                    <?php if(_go('display_subscribe')): ?>
                    <h4><?php _eo('subscribe_title');?></h4>
                
                    <form class="subscribe-form" id="newsletter" method="post" data-tt-subscription>
                        <div class="row">
                            <div class="col-md-5">
                                <input type="text" name="name" placeholder="<?php _e('Enter your name','credo');?>" data-tt-subscription-type="name">
                            </div>
                            <div class="col-md-5">
                                <input type="text" name="email" placeholder="<?php _e('Enter your e-mail address','credo');?>" data-tt-subscription-required data-tt-subscription-type="email">
                            </div>
                            <div class="result_container"></div>
                            <div class="col-md-2">
                                <input type="submit" value="<?php _e('Subscribe','credo');?>">
                            </div>
                        </div>
                    </form>
                    

                    <?php endif;?>
                    <div class="footer-copyright">
                        <?php if(_go('footer_info')): ?>
                            <p class="float-right"><?php _eo('footer_info'); ?></p>
                        <?php endif; ?>
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
                    </div>
                </div>
            </div>
        </footer>

        <?php wp_footer(); ?>
        <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    </div>
</body>
</html>