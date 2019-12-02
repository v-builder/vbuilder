<!-- Defual vbuilder modal | start of modal -->

<!-- Modal -->
<div class="modal fade" id="vbd_upload-modal-delete-helper" tabindex="4" role="dialog" aria-labelledby="vbd_upload-modal-view-helper" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="exampleModalLongTitle">Delete Upload File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div  id="vbd_upload-item-delete" class="modal-body">

                <?php                           EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."view/vbd_upload_helper/delete.php");
                ?>
                <br/>
            </div>

        </div>
    </div>
</div>

<!-- end of modal -->