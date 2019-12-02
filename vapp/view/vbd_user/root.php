
        <div class="col-12 text-center">
            <h3 class="text-center my-4 display-4">  Users </h3>

        </div>
        <button class="btn btn-sm btn-primary  btn-fw mb-2" id="vbd_user-add-trigger"  type="button" data-toggle="modal" data-target="#vbd_user-modal-add">ADD <span class="fa fa-plus" ></span></button>


        <?php            EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."view/vbd_user/list.php");
            ?>







<!-- start of modal -->

<!-- Modal -->
<div class="modal fade" id="vbd_user-modal-add" tabindex="-1" role="dialog" aria-labelledby="vbd_user-modal-add" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="exampleModalLongTitle"> ADD VBD USER</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <?php                EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."view/vbd_user/add.php");
                ?>            <br/>
            </div>

        </div>
    </div>
</div>

<!-- end of modal -->


<!-- start of modal -->

<!-- Modal -->
<div class="modal fade" id="vbd_user-modal-update" tabindex="-1" role="dialog" aria-labelledby="vbd_user-modal-update" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="exampleModalLongTitle"> UPDATE VBD USER</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <?php                EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."view/vbd_user/update.php");
                ?>            <br/>
            </div>

        </div>
    </div>
</div>

<!-- end of modal -->


<!-- start of modal -->

<!-- Modal -->
<div class="modal fade" id="vbd_user-modal-view" tabindex="-1" role="dialog" aria-labelledby="vbd_user-modal-view" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="exampleModalLongTitle"> VBD USER</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div  id="vbd_user-item-view" class="modal-body">

                <?php                           EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."view/vbd_user/view.php");
                ?>
                <br/>
            </div>

        </div>
    </div>
</div>

<!-- end of modal -->



<!-- start of modal -->

<!-- Modal -->
<div class="modal fade" id="vbd_user-modal-delete" tabindex="-1" role="dialog" aria-labelledby="vbd_user-modal-view" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="exampleModalLongTitle"> DETETE VBD USER</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div  id="vbd_user-item-delete" class="modal-body">

                <?php                           EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."view/vbd_user/delete.php");
                ?>
                <br/>
            </div>

        </div>
    </div>
</div>

<!-- end of modal -->
