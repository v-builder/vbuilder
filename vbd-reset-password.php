<?php

//define("VBD_W_WP",true);

include_once "vappbase.php";


define('VBD_PG_TITLE',"Password Recovery | VBuilder");
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

<section class="container">
    <div class="row">

        <div class="col-12 col-md-8 mx-auto mt-4">

            <?php
            EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."/view/vbd_rp/self-root.php");
            ?>


        </div>
    </div>
</section>

<?php


EngineBuild::BuildBindingProcessorScope( "template-parts/js_include.php");
?>

    <script type="text/javascript" src="<?php echo EngineBuild::getVbdTemplateUrl(); ?>/view/vbd_rp/self.controller.js"></script>

<?php


EngineBuild::vbd_footer("footer.php");
