<?php
define('IMAGES', get_template_directory_uri() . '/img/');

/***********************************************************************************************/
/*  Tesla Framework */
/***********************************************************************************************/
require_once(get_template_directory() . '/tesla_framework/tesla.php');

if ( is_admin() && current_user_can( 'install_themes' ) ) {
    require_once( get_template_directory() . '/plugins/tgm-plugin-activation/register-plugins.php' );
}


/***********************************************************************************************/
/* Load JS and CSS Files - done with TT_ENQUEUE */
/***********************************************************************************************/

/***********************************************************************************************/
/* Google fonts + Fonts changer */
/***********************************************************************************************/
TT_ENQUEUE::$gfont_changer = array(
        _go('logo_text_font'),
        _go('main_content_text_font'),
        _go('sidebar_text_font'),
        _go('menu_text_font')
    );


/***********************************************************************************************/
/* Custom CSS */
/***********************************************************************************************/
add_action('wp_enqueue_scripts', 'tesla_custom_css', 99);
function tesla_custom_css() {
    $custom_css = _go('custom_css') ? _go('custom_css') : '';
    wp_add_inline_style('tt-main-style', $custom_css);
}

/***********************************************************************************************/
/* Custom JS */
/***********************************************************************************************/
add_action('wp_footer', 'tesla_custom_js', 99);
function tesla_custom_js() {
    ?>
    <script type="text/javascript"><?php echo esc_js(_eo('custom_js')) ?></script>
    <?php
}

TT_ENQUEUE::add_js(array('http://maps.googleapis.com/maps/api/js'));

/***********************************************************************************************/
/* Add Theme Support */
/***********************************************************************************************/

add_theme_support('post-formats', array('quote', 'gallery', 'video', 'audio', 'image'));

function tt_theme_slug_setup() {
   add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'tt_theme_slug_setup' );

function tt_theme_favicon() {
    if( function_exists( 'wp_site_icon' ) && has_site_icon() ) {
        wp_site_icon();
    } else if(_go( 'favicon_link')){
        echo "\r\n" . sprintf( '<link rel="shortcut icon" href="%s">', _go( 'favicon_link') ) . "\r\n";
    }
}

add_action( 'wp_head', 'tt_theme_favicon');

/***********************************************************************************************/
/* Add Menus */
/***********************************************************************************************/

function tt_register_menus($return = false){
    $tt_menus = array(
            'main_menu'    => _x('Main menu', 'dashboard','credo'),
        );
    if($return)
        return $tt_menus;
    register_nav_menus($tt_menus);
}
add_action('init', 'tt_register_menus');


/***********************************************************************************************/
/* Custom Functions */
/***********************************************************************************************/

function tt_excerpt( $id, $length ) {
    $length = !empty($length) ? $length : 55;
    $content = apply_filters( 'the_content', get_post_field('post_content', $id));
    $content = strip_shortcodes($content);
    $content = str_replace(']]>', ']]&gt;', $content);
    $content = strip_tags($content);
    $content = substr($content, 0, $length);
    print $content;
}

function tt_get_first_embed_media($post_id) {
    $post = get_post($post_id);
    $content = do_shortcode( apply_filters( 'the_content', $post->post_content ) );
    $embeds = get_media_embedded_in_content( $content );

    if( !empty($embeds) ) {
        return $embeds[0];

    } else {
        return false;
    }

}

function tt_breadcrumbs() {
    global $post;

    $links = array();

    if(is_home()) {
        $page_id = get_option( 'page_for_posts' );
        $links[] = get_the_title($page_id);

    } else if(is_singular('post')) {
        $page_id = get_option( 'page_for_posts' );
        ($page_id !== '0') ? $links[get_permalink($page_id)] = get_the_title($page_id) : '';
        $links[] = get_the_title();
    } else if(is_singular('portfolio')) {
        $page_id = get_option( 'page_for_portfolio' );
        ($page_id !== '0') ? $links[get_permalink($page_id)] = get_the_title($page_id) : '';
        $links[] = get_the_title();
    } else if(is_tag()) {
        $page_id = get_option( 'page_for_posts' );
        ($page_id !== '0') ? $links[get_permalink($page_id)] = get_the_title($page_id) : '';
        $links[] = single_tag_title('', false);
    } else if(is_category()) {
        $page_id = get_option( 'page_for_posts' );
        ($page_id !== '0') ? $links[get_permalink($page_id)] = get_the_title($page_id) : '';
        $links[] = single_cat_title("", false);
    } else if(is_archive()) {
        $page_id = get_option( 'page_for_posts' );
        ($page_id !== '0') ? $links[get_permalink($page_id)] = get_the_title($page_id) : '';
        $links[] = get_the_archive_title();
    } else if(is_search()) {
        $page_id = get_option( 'page_for_posts' );
        $links[] = __('Search', 'credo');
    } else if(is_page()) {

        if($post->post_parent > 0) {
            $page_id = $post->post_parent;
            if($page_id !== (int) get_option('page_on_front')) {
                $links[get_permalink($page_id)] = get_the_title($page_id);
            }
        }
        $links[] = get_the_title();
    }

    ob_start(); ?>
        <ul class="breadcrumbs-ul">
            <li>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php _e('Home', 'credo'); ?></a>
            </li>
            <?php foreach ($links as $key => $link) {
                if(is_string($key)) {
                    echo sprintf('<li><a href="%s">%s</a></li>', esc_url($key), esc_html($link));
                } else {
                    echo sprintf('<li>%s</li>', esc_html($link));
                }
            } ?>
        </ul>
    <?php return ob_get_clean();
}

add_action( 'init', 'tt_include_composer' , 12);

function tt_include_composer() {
    if(class_exists('Vc_Manager')) {
        vc_set_shortcodes_templates_dir(TEMPLATEPATH . '/theme_config/vc_shortcodes');
        include_once(TEMPLATEPATH . '/theme_config/vc_shortcodes/rewrite_map.php');

        if(class_exists('TeslaFrameworkPL') || class_exists('TeslaFramework')) {
            require_once(TEMPLATEPATH . '/theme_config/theme_shortcodes.php');
        }
    }
}


/***********************************************************************************************/
/* AJAX Functions */
/***********************************************************************************************/

add_action('wp_ajax_post_likes', 'tt_post_likes');
add_action('wp_ajax_nopriv_post_likes', 'tt_post_likes');

function tt_post_likes(){
    if(!empty($_POST['postid'])){
        $post_id = $_POST['postid'];
        $likes = get_post_meta($post_id, 'post_likes', true);
            if( isset($_COOKIE['post_likes_'. $post_id]) )
                die(false);
                if(!$likes)
                    $likes = 0;
                    $likes++;
                    if(update_post_meta($post_id, 'post_likes', $likes)){
                        setcookie('post_likes_'. $post_id, $post_id, time()*20, '/');
                        die(true);
                    }
                    else{
                        die('error');
                    }
                }
            die();
}


add_action('wp_ajax_events_load', 'tt_events_load');
add_action('wp_ajax_nopriv_events_load', 'tt_events_load');

function tt_events_load(){
    $post_date = !empty($_POST['e_date']) ? $_POST['e_date'] : '';
    $page = !empty($_POST['offset']) ? $_POST['offset'] : '';

    if(!empty($post_date)) {
        $args = array(
            'post_type' => 'events',
            'orderby' => 'meta_value_num',
            'meta_key' => THEME_NAME . '_event_start',
            'order' => 'ASC',
            'posts_per_page' => -1,
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => THEME_NAME .'_event_start',
                    'value' => strtotime($post_date.' 00:00:00'),
                    'compare' => '>',
                ),
                array(
                    'key' => THEME_NAME .'_event_start',
                    'value' => strtotime($post_date.' 23:59:59'),
                    'compare' => '<',
                )
            )
        );
    } else {
        $args = array(
            'post_type' => 'events',
            'orderby' => 'meta_value_num',
            'meta_key' => THEME_NAME . '_event_start',
            'order' => 'ASC',
            'showposts' => 5,
            'offset' => $page,
        );
    }

    $event_query = new WP_Query($args);

    if ( $event_query->have_posts() ) : while ( $event_query->have_posts() ) : $event_query->the_post();
        $postid = get_the_ID();
        $options = get_post_meta($postid, 'slide_options', true); ?>
        <div class="event-big-box">
            <div class="row">
                <div class="col-md-7">
                    <div class="event-big-image">
                        <img src="<?php echo wp_get_attachment_url($options['event_cover']); ?>" alt="<?php _e('events','credo');?>" />
                    </div>
                </div>
                <div class="col-md-5">
                    <h2><?php echo get_the_title($postid); ?></h2>
                    <?php the_content();?>
                    <div class="event-big-location">
                        <div class="date"><?php echo date_i18n(!empty($post_date) ? 'd M'.' '.get_option('time_format') : get_option('date_format').' '.get_option('time_format'), get_post_meta($postid, THEME_NAME . '_event_start', true));?></div>
                        <ul class="location">
                            <li><b><?php _e('Location:','credo');?></b></li>
                        <?php $locations = explode(',', $options['event_location']);
                        foreach($locations as $loc)
                           echo '<li>'.esc_html($loc).'</li>';
                        ?>
                        </ul>
                    </div>
                    <?php $coordinates = !empty($options['event_coordinates']) ? explode(',', $options['event_coordinates']) : ''; ?>
                    <div class="map" data-lat="<?php if(!empty($coordinates[0])) echo esc_attr($coordinates[0]); ?>" data-long="<?php if(!empty($coordinates[1])) echo esc_attr($coordinates[1]); ?>" data-icon="<?php echo !empty($options['event_pin']) ? wp_get_attachment_url($options['event_pin']) : esc_url(get_template_directory_uri().'/images/icons/credo-marker.png');?>"></div>
                </div>
            </div>
        </div>
    <?php endwhile; else: ?>
        <h3><?php _e('No events to display', 'credo'); ?></h3>
    <?php endif; wp_reset_postdata();
   die();
}

add_action('wp_ajax_sermons_load', 'tt_sermons_load');
add_action('wp_ajax_nopriv_sermons_load', 'tt_sermons_load');

function tt_sermons_load(){
    $page = !empty($_POST['offset']) ? $_POST['offset'] : '';
    $category = !empty($_POST['category']) ? $_POST['category'] : '';
    $columns = !empty($_POST['columns']) ? $_POST['columns'] : '3';

    $sermons_query = new WP_Query(array(
        'post_type' => 'sermons',
        'sermons_tax' => $category,
        'showposts' => 8,
        'offset' => $page,
    ));

    if ( $sermons_query->have_posts() ) : while ( $sermons_query->have_posts() ) : $sermons_query->the_post();
        $post_id = get_the_ID();
        $options = get_post_meta($post_id, 'slide_options', true);
        $formats = get_post_format($post_id);

        switch($formats) {
            case 'quote': $format = 'commenting'; break;
            case 'gallery': $format = 'camera'; break;
            case 'video': $format = 'play-circle'; break;
            case 'audio': $format = 'music'; break;
            case 'photo': $format = 'commenting'; break;
            default: $format = 'file-text-o';
        }
    ?>
    <div class="col-md-<?php echo esc_attr($columns);?>">
        <div class="sermon-box">
            <ul class="sermon-icons">
                <li><i class="fa fa-<?php echo esc_attr($format);?>"></i></li>
            </ul>
            <div class="sermon-img">
                <img src="<?php echo wp_get_attachment_url($options['sermon_thumb']);?>" alt="<?php _e('sermon','credo');?>" />
            </div>
            <h5><a href="<?php the_permalink();?>"><?php the_title();?></a></h5>
            <p class="sermon-excerp"><?php print $options['sermon_speaker'];?><span><?php echo get_the_time(get_option('date_format'), $post_id);?></span></p>
        </div>
    </div>
    <?php endwhile; else: ?>
        <h3><?php _e('No sermons to display', 'credo'); ?></h3>
    <?php endif; wp_reset_postdata();
   die();
}

/***********************************************************************************************/
/* Custom Colors */
/***********************************************************************************************/
add_action('wp_enqueue_scripts', 'theme_custom_css', 99);

function theme_custom_css() {

        // Main styles switches
        $custom_css  = ( _go( 'layout_style' ) == 'Boxed' ) ? '#page {max-width: 1300px; margin: 0 auto;} ' : '';
        $custom_css .= ( _go( 'body_background' ) || ( _go( 'body_color' ) || _go( 'body_background_repeat' ) || _go( 'body_background_position' ))) ? 'body {' : '';
        $custom_css .= ( _go( 'body_background')) ? 'background-image: url('._go('body_background').'); ' : '';
        $custom_css .= ( _go( 'body_color')) ? 'background-color: '._go('body_color').'; ' : '';
        $custom_css .= ( _go( 'body_background') && _go('body_background_repeat')) ? 'background-repeat: '.strtolower(_go('body_background_repeat')).'; ' : '';
        $custom_css .= ( _go( 'body_background') && _go('body_background_position')) ? 'background-attachment: '.strtolower(_go('body_background_position')).'; ' : '';
        $custom_css .= ( _go( 'body_background') || (_go('body_color') || _go('body_background_repeat') || _go('body_background_position'))) ? '}' : '';
        $custom_css .= (_go('navigation_color')) ? ' header .header-bar { background: '._go('navigation_color').' !important;}' : '';
        $custom_css .= (_go('navigation_text_color')) ? ' header .header-bar ul li a { color: '._go('navigation_text_color').';}' : '';
        if(_go('head_background_image')):
            $url = _go('head_background_image');
            $custom_css .= ' header { background: url('.$url.') no-repeat top center; background-size: cover; }';
        elseif(_go('head_background_color')):
            $custom_css .= ' header { background: '._go('head_background_color').'; }';
        else:
            $custom_css .= '';
        endif;
        $custom_css .= (_go('footer_background')) ? ' footer { background: '._go('footer_background').' !important;}' : '';
        $custom_css .= (_go('footer_color')) ? '
            footer .footer-bar ul li span { color: '._go('footer_color').';}
            footer .footer-copyright p, footer .footer-bar ul li a, footer .footer-bar ul li, footer .inside h4 { color: '.adjustBrightness(_go('footer_color'), 40).';}
            footer .footer-copyright .socials li a {
                color: '.adjustBrightness(_go('footer_color'), -45).';
                background: '.adjustBrightness(_go('footer_color'), -20).';
            }

            footer .subscribe-form input[type="submit"], footer .subscribe-form input[type="text"] {
               background: '.adjustBrightness(_go('footer_color'), -30).';
            }

            footer .subscribe-form input[type="text"]:focus {
                background: '.adjustBrightness(_go('footer_color'), -50).';
            }
        ' : '';

        $custom_css .= ( _go('primary_color' ) ) ? '
            header .main-nav .responsive-menu:hover i, .gallery-section .gallery-item .gallery-hover .hover-zoom:hover ,
            #calendar .ui-datepicker-calendar tbody tr td a:hover,
            #calendar .ui-datepicker-calendar tbody tr td.ui-datepicker-current-day ,
            #calendar .ui-datepicker-calendar tbody tr td.ui-datepicker-current-day a ,
            #calendar .ui-datepicker-calendar tbody tr td.ui-datepicker-current-day:before,
            .sermon-box h5 a:hover , footer .footer-bar ul li svg ,
            #calendar .ui-datepicker-calendar thead tr th.ui-datepicker-week-end, #calendar .ui-datepicker-header .ui-datepicker-prev:hover,
            #calendar .ui-datepicker-header .ui-datepicker-next:hover, .events-section .event-box .event-hover h3 a:hover, .event-counter h2 a:hover ,  .news-box .news-info ul li a:hover,.news-box .news-info ul .like-heart .liked, .news-box .news-content .news-title a:hover , .comments-area-ul .comment-li #cancel-comment-reply-link:hover , .comments-area-ul .comment-li .comment-reply-link:hover,
            .blog-post.blog-post-quote .post-content .quote-icon, .blog-post .post-details .tags a:hover, .blog-post .post-details .share-this li a:hover , .blog-post .post-footer ul .like-heart .liked ,
            .blog-post .post-header h2 a:hover, .blog-post .post-header h6, .blog-post .post-header .post-cover .blockquote:before,
            .blog-post.sticky:before, .widget.widget-twitter .twitter li a:hover, table tfoot a:hover, table a:hover,
            .widget .widget-news h3 a:hover, .gallery-section .gallery-item .gallery-hover .hover-zoom:hover { color: '._go('primary_color').';}


           footer .footer-copyright .socials li a:hover , .event-big-box .event-big-location .date, .comment-form input[type="submit"]:hover, .main-sidebar, .main-sidebar:after { background-color: '._go('primary_color').';}

           .comment-form textarea:focus,
           .comment-form input[type="text"]:focus {
                border-color:  '._go('primary_color').';
           }
           ' : '';


        $custom_css .= ( _go('canvas_color' ) ) ? sprintf('#page { background: %s;}', _go('canvas_color')) : '';
        $custom_css .= ( _go('global_typo_color' ) ) ? sprintf('body {color: %s;}', _go('global_typo_color')) : '';
        $custom_css .= ( _go('global_typo_size' ) ) ? sprintf('body {font-size: %spx;}', _go('global_typo_size')) : '';
        $custom_css .= ( _go('global_typo_font' ) ) ? sprintf('body {font-family: %s;}', _go('global_typo_font')) : '';
        $custom_css .= ( _go('links_settings_color' ) ) ? sprintf('a {color: %s;}', _go('links_settings_color')) : '';
        $custom_css .= ( _go('links_settings_size' ) ) ? sprintf('a {font-size: %spx;}', _go('links_settings_size')) : '';
        $custom_css .= ( _go('links_settings_font' ) ) ? sprintf('a {font-family: %s;}', _go('links_settings_font')) : '';
        $custom_css .= ( _go('headings_settings_color' ) ) ? sprintf('h1, h2, h3, h4, h5, h6 {color: %s;}', _go('headings_settings_color')) : '';
        $custom_css .= ( _go('headings_settings_font' ) ) ? sprintf('h1, h2, h3, h4, h5, h6 {font-family: %s;}', _go('headings_settings_font')) : '';
        $custom_css .= ( _go('headings_one_settings_size' ) ) ? sprintf( 'h1 {font-size: %spx;}', _go( 'headings_one_settings_size' ) ) : '';
        $custom_css .= ( _go('headings_two_settings_size' ) ) ? sprintf( 'h2 {font-size: %spx;}', _go( 'headings_two_settings_size' ) ) : '';
        $custom_css .= ( _go('headings_three_settings_size' ) ) ? sprintf( 'h3 {font-size: %spx;}', _go( 'headings_three_settings_size' ) ) : '';
        $custom_css .= ( _go('headings_four_settings_size' ) ) ? sprintf( 'h4 {font-size: %spx;}', _go( 'headings_four_settings_size' ) ) : '';
        $custom_css .= ( _go('headings_five_settings_size' ) ) ? sprintf( 'h5 {font-size: %spx;}', _go( 'headings_five_settings_size' ) ) : '';
        $custom_css .= ( _go('headings_six_settings_size' ) ) ? sprintf( 'h6 {font-size: %spx;}', _go(' headings_six_settings_size' ) ) : '';

        $custom_css .= ( _go('custom_css' ) ) ? _go( 'custom_css' ) : '';

        wp_add_inline_style( 'tt-main-style', $custom_css );
}


/***********************************************************************************************/
/* Comments */
/***********************************************************************************************/

function tt_custom_comments( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    if ( 'div' == $args['style'] ) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li';
        $add_below = 'div-comment';
    }
    ?>

    <<?php print $tag ?> id="comment-<?php comment_ID() ?>" class="comment-li">
        <?php if ( 'div' != $args['style'] ) : ?>
            <div id="div-comment-<?php comment_ID() ?>" <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?>>
        <?php endif; ?>
        <div class="comment-li-avatar">
            <?php if ($args['avatar_size'] != 0)
                echo get_avatar( $comment, $args['avatar_size'], false,'avatar image' ); ?>
        </div>

        <?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'],'reply_text'=> __('Reply','credo') ))) ?>

        <h6><?php echo get_comment_author_link() ?><span><?php echo get_comment_time(get_option('date_format')) ?></span></h6>

        <p><?php echo get_comment_text() ?></p>


        <?php if ( 'div' != $args['style'] ) : ?>
            </div>
        <?php endif;

}

function tt_custom_comments_closed( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    if ( 'div' == $args['style'] ) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li';
        $add_below = 'div-comment';
    }

    if($comment->comment_type == 'pingback' || $comment->comment_type == 'trackback'):?>
        <<?php print $tag ?> id="comment-<?php comment_ID() ?>">
        <?php if ( 'div' != $args['style'] ) : ?>
            <div id="div-comment-<?php comment_ID() ?>" <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?>>
        <?php endif; ?>
        <span class="comment-image">
            <?php if ($args['avatar_size'] != 0)
                echo get_avatar( $comment, $args['avatar_size'], false,'avatar image' ); ?>
        </span>
        <?php if ($comment->comment_approved == '0') : ?>
            <em class="comment-awaiting-moderation">
                <?php _e('Your comment is awaiting moderation.','credo') ?>
            </em>
            <br />
        <?php endif; ?>

        <span class="comment-info">
            <?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'],'reply_text'=> __('Reply','credo') ))) ?>
            <?php echo get_comment_author_link() ?>
            <?php edit_comment_link(__('(Edit)','credo'),'  ','' );?>
        </span>
        <?php comment_text() ?>
        <span class="comment-date"><?php echo get_comment_time(get_option('date_format')) ?></span>
        <?php if ( 'div' != $args['style'] ) : ?>
            </div>
        <?php endif;
    endif;

}


/***********************************************************************************************/
/* Add Sidebar Support */
/***********************************************************************************************/
function tt_register_sidebars(){
    if (function_exists('register_sidebar')) {
        register_sidebar(
            array(
                'name'           => __('Blog Sidebar', 'credo'),
                'id'             => 'blog',
                'description'    => __('Blog Sidebar Area', 'credo'),
                'before_widget'  => '<div class="widget %2$s">',
                'after_widget'   => '</div>',
                'before_title'   => '<h3 class="widget-title">',
                'after_title'    => '</h3>'
            )
        );
    }
}
add_action('widgets_init','tt_register_sidebars');


/***********************************************************************************************/
/* Share Function */
/***********************************************************************************************/

if(!function_exists('tt_share')){
    function tt_share(){
        $share_this = _go('share_this');
        if(isset($share_this) && is_array($share_this)): ?>
            <?php foreach($share_this as $val): ?>
                <?php if($val === 'googleplus') $val = 'google-plus'; ?>
                    <?php switch ($val) {

                        case 'facebook': ?>
                                <li>
                                    <a onClick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_the_permalink()); ?>','sharer','toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)"><i class="fa fa-<?php echo esc_attr($val );?>"></i></a>
                                </li>
                            <?php break; ?>
                        <?php case 'twitter': ?>
                                <li>
                                    <a onClick="window.open('http://twitter.com/intent/tweet?url=<?php echo urlencode(get_the_permalink()); ?>&text=<?php the_title(); ?>','sharer','toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)"><i class="fa fa-<?php echo esc_attr($val );?>"></i></a>
                                </li>
                            <?php break; ?>
                        <?php case 'google-plus': ?>
                                <li>
                                    <a onClick="window.open('https://plus.google.com/share?url=<?php echo urlencode(get_the_permalink()); ?>','sharer','toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)"><i class="fa fa-<?php echo esc_attr($val );?>"></i></a>
                                </li>
                            <?php break; ?>
                        <?php case 'pinterest': ?>
                            <li>
                                <a onClick="window.open('https://www.pinterest.com/pin/create/button/?url=<?php echo urlencode(get_the_permalink()); ?>','sharer','toolbar=0,status=0,width=748,height=325');" href="javascript: void(0)"><i class="fa fa-<?php echo esc_attr($val );?>"></i></a>
                            </li>
                        <?php break; ?>
                        <?php case 'linkedin': ?>
                                <li>
                                    <a onClick="window.open('http://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_the_permalink()); ?>','sharer','toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)"><i class="fa fa-<?php echo esc_attr($val );?>"></i></a>
                                </li>
                                <?php break; ?>
                        <?php default: ''; break;
                    } ?>
            <?php endforeach; ?>
        <?php endif;
    }
}


/***********************************************************************************************/
/* View count for single posts */
/***********************************************************************************************/
function tt_set_post_views($postID) {
    $count_key = 'tt_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

function tt_get_post_views($postID) {
    $count_key = 'tt_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}
