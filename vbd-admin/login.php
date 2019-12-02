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

$allowUserPage=false;
if($VSecurity['response']['state']==1 ){

    $allowUserPage=true;

    if(VBD_USER_DATA['ulevel_id']>VBD_MAXL_ADMIN){
        $allowUserPage=false;
    }

}

if($allowUserPage){

    EngineBuild::redirectPage(VBD_ROOT."/vbd-admin/");
}

?>


<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
            <div class="row w-100">
                <div class="col-lg-4 mx-auto">

                    <div class="row">
                        <div class="col-6">
                            <img src="" class="img-fluid"/>
                        </div>
                    </div>

                    <div class="auto-form-wrapper">

                        <form name="vbd_user-vbd-login-form" action="#">
                            <div class="form-group">
                                <label class="label">Username/email</label>
                                <div class="input-group">
                                    <input type="text" name="user_credential" class="form-control" placeholder="Username/email">
                                    <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="label">Password</label>
                                <div class="input-group">
                                    <input type="password" name="user_password" class="form-control" placeholder="*********">
                                    <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary submit-btn btn-block">Login</button>
                            </div>
                            <div class="form-group d-flex justify-content-between">

                                <a href="#" class="text-small forgot-password text-black">Forgot Password</a>
                            </div>



                        </form>

                    </div>
                    <ul class="auth-footer">
                        <li>
                            <a href="#">Conditions</a>
                        </li>
                        <li>
                            <a href="#">Help</a>
                        </li>
                        <li>
                            <a href="#">Terms</a>
                        </li>
                    </ul>
                    <p class="footer-text text-center">copyright © 2019 VBuilder Inc.</p>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>


<?php


EngineBuild::BuildBindingProcessorScope( "template-parts/js_include.php");



EngineBuild::vbd_footer("footer.php");

?>
