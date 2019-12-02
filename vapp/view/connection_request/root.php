


<section class="container">
    <div class="row">

        <div class="col-12 text-center">
            <h3 class="text-center my-4"> Connection Action </h3>
        </div>
        <div class="col-12 col-md-10 mx-auto">
            <button class="btn btn-sm btn-primary  btn-fw" id="connection_request-add-trigger"  type="button" data-toggle="modal" data-target="#connection_request-modal-add">ADD <span class="fa fa-plus" ></span></button>
        </div>
        <div class="col-12 col-md-10 mx-auto"  id="connection_request-section">


            <?php            EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."view/connection_request/list.php");
            ?>


        </div>
    </div>
</section>





<!-- start of modal -->

<!-- Modal -->
<div class="modal fade" id="connection_request-modal-add" tabindex="-1" role="dialog" aria-labelledby="connection_request-modal-add" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="exampleModalLongTitle"> Add Connection Action</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <?php                EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."view/connection_request/add.php");
                ?>            <br/>
            </div>

        </div>
    </div>
</div>

<!-- end of modal -->


<!-- start of modal -->

<!-- Modal -->
<div class="modal fade" id="connection_request-modal-update" tabindex="-1" role="dialog" aria-labelledby="connection_request-modal-update" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="exampleModalLongTitle"> Update Connection Action</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <?php                EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."view/connection_request/update.php");
                ?>            <br/>
            </div>

        </div>
    </div>
</div>

<!-- end of modal -->


<!-- start of modal -->

<!-- Modal -->
<div class="modal fade" id="connection_request-modal-view" tabindex="-1" role="dialog" aria-labelledby="connection_request-modal-view" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="exampleModalLongTitle"> Connection Action</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div  id="connection_request-item-view" class="modal-body">

                           <?php                           EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."view/connection_request/view.php");
                           ?>
            <br/>
            </div>

        </div>
    </div>
</div>

<!-- end of modal -->



<!-- start of modal -->

<!-- Modal -->
<div class="modal fade" id="connection_request-modal-delete" tabindex="-1" role="dialog" aria-labelledby="connection_request-modal-view" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="exampleModalLongTitle">Delete Connection Action</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div  id="connection_request-item-delete" class="modal-body">

                           <?php                           EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."view/connection_request/delete.php");
                           ?>
            <br/>
            </div>

        </div>
    </div>
</div>

<!-- end of modal -->
