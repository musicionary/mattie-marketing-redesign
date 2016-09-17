<?php
if(!function_exists('_go')){
  function _go($option_key){ // get admin options by array id
    $tt_theme_options = get_option(THEME_OPTIONS);
    if (isset($tt_theme_options[$option_key]))
      return $tt_theme_options[$option_key];
    else
      return NULL;
  }
}

if(!function_exists('_eo')){
  function _eo($option_key){ // get admin options by array id
    $tt_theme_options = get_option(THEME_OPTIONS);
    if (isset($tt_theme_options[$option_key]))
      print $tt_theme_options[$option_key];
    else
      return NULL;
  }
}

if(!function_exists('_gall')){
  function _gall(){
    $tt_theme_options = get_option(THEME_OPTIONS);
    return $tt_theme_options;
  }
}

//Function that gets the correct array of repeated items from options by box key that contains the repeated box key
if(!function_exists('_go_repeated')){
  function _go_repeated($repeated_box_key){
    $admin_opt = include TT_THEME_DIR . '/theme_config/admin-options.php';
    $tt_theme_options = get_option(THEME_OPTIONS);
    $the_array = array();
    $repeated_box_fields = array();

    foreach ($admin_opt['tabs'] as $tab) {
      if (!empty($tab['boxes'][$repeated_box_key]['input_fields'])){
        $repeated_box_fields = $tab['boxes'][$repeated_box_key]['input_fields'];
        break;
      }
    }
    //print_r($repeated_box_fields);
    //var_dump( $tt_theme_options[  $repeated_box_fields [key($repeated_box_fields)]['id']  ] );
    $nr_items = count( $tt_theme_options[ $repeated_box_fields [key($repeated_box_fields)]['id'] ] ) ;
    if (!empty($repeated_box_fields)){
      for ($i = 0; $i < $nr_items ;$i++) {

        foreach ($repeated_box_fields as $repeated_input) {
          $new_row[$repeated_input['id']] = isset($tt_theme_options[$repeated_input['id']][$i]) ? $tt_theme_options[$repeated_input['id']][$i] : NULL;
        }
        $the_array[$i] = $new_row;
        
      }
      return $the_array;
    }
    return NULL;
  }
}
//Function to escape html tags if text is wrapped in " [ html ] "
if(!function_exists('escape_html')){
  function escape_html($html){
    if(preg_match("@\[([^\]]+)\]@is",$html,$match))
      if (isset($match[1])){
        $html = preg_replace("#\[([^\]]+)\]#is", htmlspecialchars($match[1]),$html);
      }
    return $html;
  }
}
//does the same as escape_html() only that it echoes the result
if(!function_exists('escape_htmle')){
  function escape_htmle($html){
    echo escape_html($html);
  }
}

//-------------------Function to render gmap--------------------------------
if(!function_exists('tt_gmap')){
  function tt_gmap($map_id,$container_id ,$container_class='',$scrollzoom = 'true',$echo=true){
      return "";
  }
}