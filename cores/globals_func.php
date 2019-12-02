<?php
/**
 * Created by PhpStorm.
 * User: brandlovers
 * Date: 2019-03-19
 * Time: 08:54
 */


function vbd_title()
{

    if( defined('VBD_W_WP') ){

    if (is_category()) {
        echo 'Category Archive for &quot;';
        single_cat_title();
        echo '&quot; | ';
//        bloginfo('name');
    } elseif (is_tag()) {
        echo 'Tag Archive for &quot;';
        single_tag_title();
        echo '&quot; | ';
//        bloginfo('name');
    } elseif (is_archive()) {
        wp_title('');
//        echo ' Archive ';
//        bloginfo('name');
    } elseif (is_search()) {
        echo 'Search for &quot;' . wp_specialchars($s) . '&quot; | ';
        bloginfo('name');
    } elseif (is_home() || is_front_page()) {
//        bloginfo('name');
//        echo ' | ';
//        bloginfo('description');
        the_title();
    } elseif (is_404()) {
        echo 'Error 404 Not Found | ';
        bloginfo('name');
    } elseif (is_single()) {
        wp_title('');
    } else {
        echo wp_title('', false, right);
//        bloginfo('name');
    }


    } else{

        echo ((defined('VBD_PG_TITLE'))? VBD_PG_TITLE : "VBuilder");
    }
}

function vbd_highlight($str){

//    if(strpos($str,"[light]")){

        $str = str_ireplace("[light]","<span class='light'>",$str);
        $str = str_ireplace("[bold]","<strong>",$str);
        $str = str_ireplace("[alerttxt]","<span class='alert-txt'><strong>",$str);

//    }
//    if(strpos($str,"[lightc]")){

        $str= str_ireplace("[/light]","</span>",$str);
        $str= str_ireplace("[/bold]","</strong>",$str);
        $str= str_ireplace("[/alerttxt]","</strong></span>",$str);

//    }
    return $str;
}


function vbd_object_to_array($v){
    return get_object_vars($v);
}
