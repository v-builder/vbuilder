<?php

//define("VBD_W_WP",true);

include_once "vappbase.php";


$VSecurity=VSecurity::appSecurity
(
    [

        'ajax'=>false ,
        'security'=>
            [
                'enable'=>true,
                'user'=>[
                    'user_level'=>[
//                        'allowed'=>[1,5]
//                        ,
//                        'denied'=>[1,2,3,4,5]
                    ]

                ]

            ],

        // if is not ajax
        'on_deny'=> [
            'redirect'=>VBD_ROOT,
            'toast_msg'=>'You don\'t have permissions to perform actions in this page. Please log in with an authorized account <a class="vbd-security-error-msg-link" href="'.VBD_ROOT.'"> Home page</a>'
        ]

    ]
);

define('VBD_PG_TITLE',VBD_USER_DATA['user_rn']. " | Profile");

EngineBuild::vbd_header("header.php");

define("USER_PORS","self");


EngineBuild::BuildBindingProcessorScope( "template-parts/nav.php");

?>





            <?php
            EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."/view/vbd_user/my-account.php");
            ?>


<?php


EngineBuild::BuildBindingProcessorScope( "template-parts/js_include.php");



EngineBuild::vbd_footer("footer.php");

?>
