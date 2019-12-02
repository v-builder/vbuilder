<?php

//define("VBD_W_WP",true);

include_once "vappbase.php";

define('VBD_PG_TITLE',"Create Account | VBuilder");
EngineBuild::vbd_header("header.php");


EngineBuild::BuildBindingProcessorScope( "template-parts/nav.php");

?>


<div class="modal fade" id="vbd_user-modal-self-add" tabindex="-1" role="dialog" aria-labelledby="vbd_user-modal-self-add" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="exampleModalLongTitle"> Create Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."/view/vbd_user/self-add.php");
                ?>            <br/>
            </div>

        </div>
    </div>
</div>


<section class="container my-4">
    <div class="row">

        <div class="col-12 col-md-5 mx-auto">

            <button class="btn btn-sm btn-primary my-3 d-none"  type="button" data-toggle="modal" data-target="#vbd_user-modal-self-add">Create account <span class="fa fa-sign-in" ></span></button>

<?php
EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."/view/vbd_user/self-add.php");
?>

        </div>
    </div>
</section>
<?php


EngineBuild::BuildBindingProcessorScope( "template-parts/js_include.php");



EngineBuild::vbd_footer("footer.php");

?>
