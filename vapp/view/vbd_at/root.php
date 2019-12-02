
<div class="col-12 text-center">
    <h3 class="text-center my-4 display-4"> Account Type </h3>
</div>
<button class="btn btn-sm btn-primary  btn-fw mb-2" id="vbd_at-add-trigger"  type="button" data-toggle="modal" data-target="#vbd_at-modal-add">ADD <span class="fa fa-plus" ></span></button>


    <?php            EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."view/vbd_at/list.php");
    ?>



<!-- start of modal -->

<!-- Modal -->
<div class="modal fade" id="vbd_at-modal-add" tabindex="-1" role="dialog" aria-labelledby="vbd_at-modal-add" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="exampleModalLongTitle"> Add Account Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <?php                EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."view/vbd_at/add.php");
                ?>            <br/>
            </div>

        </div>
    </div>
</div>

<!-- end of modal -->


<!-- start of modal -->

<!-- Modal -->
<div class="modal fade" id="vbd_at-modal-update" tabindex="-1" role="dialog" aria-labelledby="vbd_at-modal-update" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="exampleModalLongTitle"> Update Account Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <?php                EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."view/vbd_at/update.php");
                ?>            <br/>
            </div>

        </div>
    </div>
</div>

<!-- end of modal -->


<!-- start of modal -->

<!-- Modal -->
<div class="modal fade" id="vbd_at-modal-view" tabindex="-1" role="dialog" aria-labelledby="vbd_at-modal-view" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="exampleModalLongTitle"> Account Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div  id="vbd_at-item-view" class="modal-body">

                           <?php                           EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."view/vbd_at/view.php");
                           ?>
            <br/>
            </div>

        </div>
    </div>
</div>

<!-- end of modal -->



<!-- start of modal -->

<!-- Modal -->
<div class="modal fade" id="vbd_at-modal-delete" tabindex="-1" role="dialog" aria-labelledby="vbd_at-modal-view" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="exampleModalLongTitle">Delete Account Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div  id="vbd_at-item-delete" class="modal-body">

                           <?php                           EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."view/vbd_at/delete.php");
                           ?>
            <br/>
            </div>

        </div>
    </div>
</div>

<!-- end of modal -->
