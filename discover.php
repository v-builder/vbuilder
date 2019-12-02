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
//            'redirect'=>VBD_ROOT,
//            'toast_msg'=>'You don\'t have permissions to perform actions in this page. Please log in with an authorized account <a class="vbd-security-error-msg-link" href="'.VBD_ROOT.'"> Home page</a>'
        ]

    ]
);


define('VBD_PG_TITLE',"Discover Connections");

EngineBuild::vbd_header("header.php");
//user is public
define("USER_PORS","p");

EngineBuild::BuildBindingProcessorScope( "template-parts/nav.php");

?>

<?php
EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."/view/vbd_user/discover.php");
?>


<?php


EngineBuild::BuildBindingProcessorScope( "template-parts/js_include.php");

?>
<script type="text/javascript">
    vbdReadPublic();

    // executeSingleUser();


</script>
<?php
if($VSecurity['response']['state']==1){
    ?>
    <script type="text/javascript" src="<?php echo EngineBuild::getVbdTemplateUrl(); ?>/view/connection_request/self.controller.js"></script>

    <?php
}


EngineBuild::vbd_footer("footer.php");

?>
