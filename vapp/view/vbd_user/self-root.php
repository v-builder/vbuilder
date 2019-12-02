<?php
if(defined('VBD_USER_DATA')) {
    ?>

    <!--
    <section class="container">
        <div class="row">

            <div class="col-12 text-center">
                <h3 class="text-center my-4"> VBD USER </h3>

            </div>
            <div class="col-12 col-md-10 mx-auto">
                <button class="btn btn-sm btn-primary  btn-fw" id="vbd_user-self-add-trigger"  type="button" data-toggle="modal" data-target="#vbd_user-modal-add">ADD <span class="fa fa-plus" ></span></button>
            </div>


        </div>
    </section>

    -->


    <!-- start of modal -->

    <!-- Modal -->
    <div class="modal fade" id="vbd_user-modal-self-add" tabindex="-1" role="dialog"
         aria-labelledby="vbd_user-modal-self-add" aria-hidden="true">
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
                    EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot() . "/view/vbd_user/self-add.php");
                    ?> <br/>
                </div>

            </div>
        </div>
    </div>

    <!-- end of modal -->


    <!-- start of modal -->
    <?php
    if (!defined('VBD_EDIT_ACCOUNT_PG')) {
        ?>

        <!-- Modal -->
        <div class="modal fade" id="vbd_user-modal-self-update" tabindex="-1" role="dialog"
             aria-labelledby="vbd_user-modal-self-update" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-uppercase" id="exampleModalLongTitle"> Update Account</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot() . "/view/vbd_user/self-update.php");
                        ?> <br/>
                    </div>

                </div>
            </div>
        </div>

        <!-- end of modal -->

        <?php
    }
    ?>


    <!-- start of modal -->

    <!-- Modal -->
    <div class="modal fade" id="vbd_user-modal-self-view" tabindex="-1" role="dialog"
         aria-labelledby="vbd_user-modal-self-view" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase" id="exampleModalLongTitle"> Account Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div id="vbd_user-item-view" class="modal-body">

                    <?php EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot() . "/view/vbd_user/self-view.php");
                    ?>
                    <br/>
                </div>

            </div>
        </div>
    </div>

    <!-- end of modal -->

    <?php
}
?>


<!-- start of modal -->

<!-- Modal -->
<div class="modal fade vbd_user-modal-self-view-photo" id="vbd_user-modal-self-view-photo" tabindex="-1" role="dialog" aria-labelledby="vbd_user-modal-self-view-photo" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="exampleModalLongTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div  id="vbd_user-item-view" class="modal-body p-0">

              <img class="vbd-user-holder" src="<?php echo  EngineBuild::getAppTemplateUrl()."/".EngineBuild::getVbdApp()."/lib/img/avatar-sample.png";  ?>" alt="avatar">

                <br/>
            </div>

        </div>
    </div>
</div>

<!-- end of modal -->

