<?php
/**
* Created by VBuilder 
* Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Date: 11/09/2019, Wednesday
* Time: 08:24 PM
* Project/Module: Personal Data*/


    //define("VBD_W_WP",true);

    include_once "vappbase.php";

    define('VBD_PG_TITLE',"Personal Data");

    EngineBuild::vbd_header("header.php");

    $VSecurity=VSecurity::appSecurity
    (
    [

    'ajax'=>false ,
    'security'=>
    [
    'enable'=>false,
    'user'=>[
    'user_level'=>[
    //'allowed'=>[1,5]
    //,
    //'denied'=>[1,2,3,4,5]
    ]
    ]
    ],
    // if is not ajax
    'on_deny'=> [
               'redirect'=>VBD_ROOT,
'toast_msg'=>'You don\'t have permissions to perform actions in this page. Please log in with an authorized account  Home page']

    ]
    );


    EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."view/vbd_user_pdata/root.php");

    if($VSecurity['response']['state']==1){
    }

    EngineBuild::BuildBindingProcessorScope( "template-parts/js_include.php");

    ?>
<script type="text/javascript" src="<?php echo EngineBuild::getVbdTemplateUrl(); ?>/view/vbd_user_pdata/controller.js"></script>

<?php

EngineBuild::vbd_footer("footer.php");
