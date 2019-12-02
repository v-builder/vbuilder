<?php


//define("VBD_W_WP",true);

include_once "vappbase.php";

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
//                        'allowed'=>[1,5]
//                        ,
//                        'denied'=>[1,2,3,4,5]
                    ]

                ]

            ],

        // if is not ajax
        'on_deny'=> [
//            'redirect'=>VBD_ROOT,
            'toast_msg'=>'You don\'t have permissions to perform actions in this page. Please login <a href="'.VBD_ROOT.'"> Home</a>'
        ]

    ]
);

if($VSecurity['response']['state']==1){


    EngineBuild::BuildBindingProcessorScope( "template-parts/nav.php");

}


EngineBuild::BuildBindingProcessorScope( "template-parts/js_include.php");



EngineBuild::vbd_footer("footer.php");
