<?php
if(!function_exists('tesla_has_woocommerce')){
    function tesla_has_woocommerce() {
        static $flag = NULL;
        if ($flag === NULL) {
            if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))){
                $flag = TRUE;
            }elseif(is_multisite()){
                include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
                if(is_plugin_active_for_network('woocommerce/woocommerce.php'))
                    $flag = TRUE;
            }else{
                $flag = FALSE;
            }
        }
        return $flag;
    }
}

if(!function_exists('_gstyle_changer')){
    function _gstyle_changer($id,$units = 'px'){
        $color = (_go($id."_color"))? "color:"._go($id."_color").";":'';
        $font = (_go($id."_font"))? "font-family:"._go($id."_font").";":'';
        $size = (_go($id."_size"))? "font-size:"._go($id."_size")."$units;":'';
        return array('color'=>$color,'font'=>$font,'size'=>$size);
    }
}

if(!function_exists('_estyle_changer')){
    function _estyle_changer($id,$units = 'px'){
        $color = (_go($id."_color"))? "color:"._go($id."_color").";":'';
        $font = (_go($id."_font"))? "font-family:"._go($id."_font").";":'';
        $size = (_go($id."_size"))? "font-size:"._go($id."_size")."$units;":'';
        print $color.$font.$size;
    }
}

//==========Form Builder functions=============
//Gets one form from contact builder  by id
if(!function_exists('tt_get_form')){
    function tt_get_form($id){
        return FALSE;
    }
}

//Displays one form from contact builder  by id
if(!function_exists('tt_form')){
    function tt_form($id){
        return NULL;
    }
}

//gets all the forms by location
if(!function_exists('tt_form_location')){
    function tt_form_location($location){
        return FALSE;
    }
}

if(!function_exists('tt_get_page_id')){
    function tt_get_page_id($shop=false){
        global $wp_query;
        if(is_archive())
            return false;
        if(get_query_var('page_id'))
            $page_id = get_query_var('page_id');
        elseif(!empty($wp_query->queried_object) && !empty($wp_query->queried_object->ID))
            $page_id = $wp_query->queried_object->ID;
        elseif($shop)
            $page_id = get_option( 'woocommerce_shop_page_id' );
        else
            $page_id = false;
        return $page_id;
    }
}

if(!function_exists('tt_get_plugin_version')){
    function tt_get_plugin_version($plugin_folder){
        $file_path = glob( TT_THEME_DIR . "/plugins/$plugin_folder/*.zip");
        try{
            if(empty($file_path[0]))
                throw new Exception("==========Plugin $plugin_folder file not found.=========");
            $filename = basename($file_path[0]);
            preg_match('@_([0-9.]+).zip@is', $filename, $file_version);
            if(empty($file_version[1]))
                throw new Exception("======Plugin $plugin_folder file name does not contain the version.======");
            return $file_version[1];
        }catch (Exception $e) {
            print $e->getMessage();
        }
    }
}

if(!function_exists('tt_register_sc')){
    function tt_register_sc($tag,$func){
        return '';
    }
}