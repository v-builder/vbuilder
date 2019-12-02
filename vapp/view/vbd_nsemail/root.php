            <h3 class="text-center my-4"> Newsletter Email </h3>
            <button class="btn btn-sm btn-primary  btn-fw" id="vbd_nsemail-add-trigger"  type="button" data-toggle="modal" data-target="#vbd_nsemail-modal-add">ADD <span class="fa fa-plus" ></span></button>
            <?php            EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."view/vbd_nsemail/list.php");
            ?>





<!-- start of modal -->

<!-- Modal -->
<div class="modal fade" id="vbd_nsemail-modal-add" tabindex="-1" role="dialog" aria-labelledby="vbd_nsemail-modal-add" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="exampleModalLongTitle"> Add Newsletter Email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <?php                EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."view/vbd_nsemail/add.php");
                ?>            <br/>
            </div>

        </div>
    </div>
</div>

<!-- end of modal -->


<!-- start of modal -->

<!-- Modal -->
<div class="modal fade" id="vbd_nsemail-modal-update" tabindex="-1" role="dialog" aria-labelledby="vbd_nsemail-modal-update" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="exampleModalLongTitle"> Update Newsletter Email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <?php                EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."view/vbd_nsemail/update.php");
                ?>            <br/>
            </div>

        </div>
    </div>
</div>

<!-- end of modal -->


<!-- start of modal -->

<!-- Modal -->
<div class="modal fade" id="vbd_nsemail-modal-view" tabindex="-1" role="dialog" aria-labelledby="vbd_nsemail-modal-view" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="exampleModalLongTitle"> Newsletter Email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div  id="vbd_nsemail-item-view" class="modal-body">

                           <?php                           EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."view/vbd_nsemail/view.php");
                           ?>
            <br/>
            </div>

        </div>
    </div>
</div>

<!-- end of modal -->



<!-- start of modal -->

<!-- Modal -->
<div class="modal fade" id="vbd_nsemail-modal-delete" tabindex="-1" role="dialog" aria-labelledby="vbd_nsemail-modal-view" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="exampleModalLongTitle">Delete Newsletter Email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div  id="vbd_nsemail-item-delete" class="modal-body">

                           <?php                           EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."view/vbd_nsemail/delete.php");
                           ?>
            <br/>
            </div>

        </div>
    </div>
</div>

<!-- end of modal -->
