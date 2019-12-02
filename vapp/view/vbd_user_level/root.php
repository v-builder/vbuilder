



        <div class="col-12 text-center">
            <h3 class="text-center my-4 display-4"> User Level </h3>
        </div>

            <button class="btn btn-sm btn-primary  btn-fw mb-2" id="vbd_user_level-add-trigger"  type="button" data-toggle="modal" data-target="#vbd_user_level-modal-add">ADD <span class="fa fa-plus" ></span></button>

    <?php            EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."/view/vbd_user_level/list.php");
            ?>


<!-- start of modal -->

<!-- Modal -->
<div class="modal fade" id="vbd_user_level-modal-add" tabindex="-1" role="dialog" aria-labelledby="vbd_user_level-modal-add" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="exampleModalLongTitle"> ADD USER LEVEL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <?php                EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."/view/vbd_user_level/add.php");
                ?>            <br/>
            </div>

        </div>
    </div>
</div>

<!-- end of modal -->


<!-- start of modal -->

<!-- Modal -->
<div class="modal fade" id="vbd_user_level-modal-update" tabindex="-1" role="dialog" aria-labelledby="vbd_user_level-modal-update" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="exampleModalLongTitle"> UPDATE USER LEVEL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <?php                EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."/view/vbd_user_level/update.php");
                ?>            <br/>
            </div>

        </div>
    </div>
</div>

<!-- end of modal -->


<!-- start of modal -->

<!-- Modal -->
<div class="modal fade" id="vbd_user_level-modal-view" tabindex="-1" role="dialog" aria-labelledby="vbd_user_level-modal-view" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="exampleModalLongTitle"> USER LEVEL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div  id="vbd_user_level-item-view" class="modal-body">

                <?php                           EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."/view/vbd_user_level/view.php");
                ?>
                <br/>
            </div>

        </div>
    </div>
</div>

<!-- end of modal -->



<!-- start of modal -->

<!-- Modal -->
<div class="modal fade" id="vbd_user_level-modal-delete" tabindex="-1" role="dialog" aria-labelledby="vbd_user_level-modal-view" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="exampleModalLongTitle"> DETETE USER LEVEL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div  id="vbd_user_level-item-delete" class="modal-body">

                <?php                           EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."/view/vbd_user_level/delete.php");
                ?>
                <br/>
            </div>

        </div>
    </div>
</div>

<!-- end of modal -->
