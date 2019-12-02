<h3 class="text-center my-4 mb-2"> Newsletter Message </h3>
            <button class="btn btn-sm btn-primary  btn-fw" id="vbd_ns_mail-add-trigger"  type="button" data-toggle="modal" data-target="#vbd_ns_mail-modal-add">ADD <span class="fa fa-plus" ></span></button>


            <?php            EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."view/vbd_ns_mail/list.php");
            ?>






<!-- start of modal -->

<!-- Modal -->
<div class="modal fade" id="vbd_ns_mail-modal-add" tabindex="-1" role="dialog" aria-labelledby="vbd_ns_mail-modal-add" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="exampleModalLongTitle"> Add Newsletter Message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <?php                EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."view/vbd_ns_mail/add.php");
                ?>            <br/>
            </div>

        </div>
    </div>
</div>

<!-- end of modal -->


<!-- start of modal -->

<!-- Modal -->
<div class="modal fade" id="vbd_ns_mail-modal-update" tabindex="-1" role="dialog" aria-labelledby="vbd_ns_mail-modal-update" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="exampleModalLongTitle"> Update Newsletter Message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <?php                EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."view/vbd_ns_mail/update.php");
                ?>            <br/>
            </div>

        </div>
    </div>
</div>

<!-- end of modal -->


<!-- start of modal -->

<!-- Modal -->
<div class="modal fade" id="vbd_ns_mail-modal-view" tabindex="-1" role="dialog" aria-labelledby="vbd_ns_mail-modal-view" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="exampleModalLongTitle"> Newsletter Message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div  id="vbd_ns_mail-item-view" class="modal-body">

                           <?php                           EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."view/vbd_ns_mail/view.php");
                           ?>
            <br/>
            </div>

        </div>
    </div>
</div>

<!-- end of modal -->



<!-- start of modal -->

<!-- Modal -->
<div class="modal fade" id="vbd_ns_mail-modal-delete" tabindex="-1" role="dialog" aria-labelledby="vbd_ns_mail-modal-view" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="exampleModalLongTitle">Delete Newsletter Message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div  id="vbd_ns_mail-item-delete" class="modal-body">

                           <?php                           EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."view/vbd_ns_mail/delete.php");
                           ?>
            <br/>
            </div>

        </div>
    </div>
</div>

<!-- end of modal -->
