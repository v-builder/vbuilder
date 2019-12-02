<?php
/**
* Created by VBuilder 
* Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Date: 11/09/2019, Wednesday
* Time: 12:36 PM
* Project/Module: Account Type*/


    //define("VBD_W_WP",true);

    include_once "vappbase.php";

    define('VBD_PG_TITLE',"Account Type");

    EngineBuild::vbd_header("header.php");

$VSecurity=VSecurity::appSecurity
(

    [

        'ajax'=>false ,
        'security'=>
            [
                'enable'=>true,
                'user'=>[
                    'user_level'=>[
                        'allowed'=>[1,2]
                        //,
                        //'denied'=>[1,2,3,4,5]
                    ]
                ]
            ],
        // if is not ajax
        'on_deny'=> [
//            'redirect'=>VBD_ROOT,
            'toast_msg'=>'You don\'t have permissions to perform actions in this page. Please log in with an authorized account <a class="vbd-security-error-msg-link" href="'.VBD_ROOT.'"> Home page</a>'

        ]


    ]
);

    EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."view/vbd_at/root.php");

    if($VSecurity['response']['state']==1){
    }

    EngineBuild::BuildBindingProcessorScope( "template-parts/js_include.php");

    ?>
<script type="text/javascript" src="<?php echo EngineBuild::getVbdTemplateUrl(); ?>/view/vbd_at/controller.js"></script>

<?php

EngineBuild::vbd_footer("footer.php");
