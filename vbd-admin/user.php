<?php

//define("VBD_W_WP",true);

include_once "vappbase.php";
include_once "securityControl.php";


define('VBD_PG_TITLE',"User Management");

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

            <div class="col-lg-12c grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <?php

                        EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."view/vbd_user/root.php");
                        ?>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>



<?php


EngineBuild::BuildBindingProcessorScope( "template-parts/js_include.php");
?>

<script type="text/javascript" src="<?php echo EngineBuild::getVbdTemplateUrl(); ?>/view/vbd_user/controller.js"></script>

<!-- Custom js for this page-->
<script src="<?php echo EngineBuild::getAppTemplateUrl(); ?>/vbd-admin/assets/js/demo_1/dashboard.js"></script>
<!-- End custom js for this page-->
<?php

EngineBuild::vbd_footer("footer.php");

?>
