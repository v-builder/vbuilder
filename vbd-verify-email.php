<?php

//define("VBD_W_WP",true);

include_once "vappbase.php";


define('VBD_PG_TITLE',"Email Confirmation | VBuilder");
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

if($VSecurity['response']['state']==1 ){

    if(defined('VBD_USER_DATA')){
        if(VBD_USER_DATA['user_email_conf']=='true'){

//            EngineBuild::redirectPage(VBD_ROOT);
        }
    }

}

EngineBuild::BuildBindingProcessorScope( "template-parts/nav.php");

?>

    <section class="container">
        <div class="row">

            <div class="col-12 col-md-6 mx-auto my-5">

                <?php

                if(!isset($_GET['stepA']) || !isset($_GET['stepB']) || !isset($_GET['stepC'])){
               ?>
                    <div class="col-12">
                        <div class="alert-danger p-2 mt-2 mb-5">
                            <p class="mb-0 ">Error verifying your email. Please request a right verification link and run it again.</p>
                        </div>
                    </div>
                <?php
                } else{

                EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."/view/vbd_user/self-email-conf.php");


                }
                ?>


            </div>
        </div>
    </section>

<?php


EngineBuild::BuildBindingProcessorScope( "template-parts/js_include.php");

if(isset($_GET['stepA']) && isset($_GET['stepB']) && isset($_GET['stepC'])) {
    ?>
    <script type="text/javascript"
            src="<?php echo EngineBuild::getVbdTemplateUrl(); ?>/view/vbd_user/vbd.user.email.js"></script>

    <?php
}


EngineBuild::vbd_footer("footer.php");
