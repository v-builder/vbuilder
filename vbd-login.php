<?php

//define("VBD_W_WP",true);

include_once "vappbase.php";


define('VBD_PG_TITLE',"Login | VBuilder");

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
//            'toast_msg'=>'You don\'t have permissions to perform actions in this page. Please log in with an authorized account <a class="vbd-security-error-msg-link" href="'.VBD_ROOT.'"> Home page</a>'
        ]

    ]
);

if($VSecurity['response']['state']==1){


EngineBuild::redirectPage(VBD_ROOT);

}


EngineBuild::BuildBindingProcessorScope( "template-parts/nav.php");

?>
<div class="modal fade" id="vbd_user-modal-login" tabindex="-1" role="dialog" aria-labelledby="vbd_user-modal-login" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="exampleModalLongTitle"> Sign in</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <?php                EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."view/vbd_user/login.php");
                ?>            <br/>
            </div>

        </div>
    </div>
</div>

<section class="container my-4">
    <div class="row">

        <div class="col-12 col-md-4 mx-auto">

            <button class="btn btn-sm btn-primary my-3 d-none"  type="button" data-toggle="modal" data-target="#vbd_user-modal-login">Log in <span class="fa fa-sign-in" ></span></button>

            <?php
            EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."view/vbd_user/login.php");
            ?>


        </div>
    </div>
</section>

<?php


EngineBuild::BuildBindingProcessorScope( "template-parts/js_include.php");



EngineBuild::vbd_footer("footer.php");

?>
