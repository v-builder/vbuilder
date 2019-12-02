<?php

//define("VBD_W_WP",true);

include_once "vappbase.php";
include_once "securityControl.php";


define('VBD_PG_TITLE',VBD_USER_DATA['user_rn']. " | Profile");

EngineBuild::vbd_header("header.php");

define("USER_PORS","self");

?>


<div class="container-scroller">

    <?php
    EngineBuild::BuildBindingProcessorScope( "template-parts/nav.php");
    ?>

    <div class="main-panel">
        <div class="content-wrapper">

    <!-- partial -->

            <?php
            EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."/view/vbd_user/my-account.php");
            ?>

        </div>
    </div>
</div>



<?php


EngineBuild::BuildBindingProcessorScope( "template-parts/js_include.php");
?>

<!-- Custom js for this page-->
<script src="<?php echo EngineBuild::getAppTemplateUrl(); ?>/vbd-admin/assets/js/demo_1/dashboard.js"></script>
<!-- End custom js for this page-->
<?php

EngineBuild::vbd_footer("footer.php");

?>
