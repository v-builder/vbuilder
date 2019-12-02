
            <h3 class="text-center my-4"> Newsletter </h3>
            <button class="btn btn-sm btn-primary  btn-fw" id="vbd_newsletter-add-trigger"  type="button" data-toggle="modal" data-target="#vbd_newsletter-modal-add">ADD <span class="fa fa-plus" ></span></button>


            <?php            EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."view/vbd_newsletter/list.php");
            ?>





    <?php    EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."view/vbd_upload_helper/delete-modal.php");
    ?>
<!-- start of modal -->

<!-- Modal -->
<div class="modal fade" id="vbd_newsletter-modal-add" tabindex="-1" role="dialog" aria-labelledby="vbd_newsletter-modal-add" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="exampleModalLongTitle"> Add Newsletter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <?php                EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."view/vbd_newsletter/add.php");
                ?>            <br/>
            </div>

        </div>
    </div>
</div>

<!-- end of modal -->


<!-- start of modal -->

<!-- Modal -->
<div class="modal fade" id="vbd_newsletter-modal-update" tabindex="-1" role="dialog" aria-labelledby="vbd_newsletter-modal-update" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="exampleModalLongTitle"> Update Newsletter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <?php                EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."view/vbd_newsletter/update.php");
                ?>            <br/>
            </div>

        </div>
    </div>
</div>

<!-- end of modal -->


<!-- start of modal -->

<!-- Modal -->
<div class="modal fade" id="vbd_newsletter-modal-view" tabindex="-1" role="dialog" aria-labelledby="vbd_newsletter-modal-view" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="exampleModalLongTitle"> Newsletter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div  id="vbd_newsletter-item-view" class="modal-body">

                           <?php                           EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."view/vbd_newsletter/view.php");
                           ?>
            <br/>
            </div>

        </div>
    </div>
</div>

<!-- end of modal -->

<!-- start of modal -->

<!-- Modal -->
<div class="modal fade" id="vbd_newsletter-modal-view-c" tabindex="-1" role="dialog" aria-labelledby="vbd_newsletter-modal-view-c" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase nsTitle" id="exampleModalLongTitle"> <strong>Newsletter</strong> <span class="ns_subject"></span> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div  id="vbd_newsletter-item-view-c" class="modal-body">

<div class="container">



    <div id="vbd-vue-b-data" class="row">


        <div class="col-md-12 grid-margin">

            <div class="row">


                <!--                    start of row-->
                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h3 class="mb-0 font-weight-semibold"> <span class="sentNsTotal"></span></h3>
                            </div>
                            <div class="d-flex">
                                <div class="wrapper">

                                    <h5 class="mb-0 mt-1 font-weight-medium text-default">Total</h5>
                                    <!--                                                <p class="mb-0 text-muted">Active</p>-->
                                    <!--                            </div>-->
                                    <!--                            <div class="wrapper my-auto ml-auto ml-lg-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>-->
                                    <!--                                <canvas height="50" width="100" id="stats-line-graph-1" class="chartjs-render-monitor" style="display: block;"></canvas>-->
                                    <!--                            </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--                    end of row-->



                <!--                    start of row-->
                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h3 class="mb-0 font-weight-semibold text-blue"> <span class="sentNs"></span></h3>
                                <h4 class="font-weight-semibold text-muted mb-0"><i class="fa fa-send"></i></h4>
                            </div>
                            <div class="d-flex">
                                <div class="wrapper">

                                    <h5 class="mb-0 mt-1 font-weight-medium text-default">Sent</h5>
                                    <!--                                                <p class="mb-0 text-muted">Active</p>-->
                                    <!--                            </div>-->
                                    <!--                            <div class="wrapper my-auto ml-auto ml-lg-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>-->
                                    <!--                                <canvas height="50" width="100" id="stats-line-graph-1" class="chartjs-render-monitor" style="display: block;"></canvas>-->
                                    <!--                            </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--                    end of row-->

                <!--                    start of row-->
                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h3 class="mb-0 font-weight-semibold text-danger"> <span class="sentNsError"></span></h3>
                                <h4 class="font-weight-semibold text-muted mb-0"><i class="fa fa-send-o"></i></h4>
                            </div>
                            <div class="d-flex">
                                <div class="wrapper">

                                    <h5 class="mb-0  font-weight-medium text-default">Not Sent</h5>
                                    <!--                                                <p class="mb-0 text-muted "></p>-->
                                    <!--                            </div>-->
                                    <!--                            <div class="wrapper my-auto ml-auto ml-lg-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>-->
                                    <!--                                <canvas height="50" width="100" id="stats-line-graph-1" class="chartjs-render-monitor" style="display: block;"></canvas>-->
                                    <!--                            </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--                    end of row-->


            </div>


        </div>

    </div>


    <?php                           EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."view/vbd_ns_mail/list.php");
    ?>



</div>



            <br/>
            </div>

        </div>
    </div>
</div>

<!-- end of modal -->



<!-- start of modal -->

<!-- Modal -->
<div class="modal fade" id="vbd_newsletter-modal-delete" tabindex="-1" role="dialog" aria-labelledby="vbd_newsletter-modal-view" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="exampleModalLongTitle">Delete Newsletter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div  id="vbd_newsletter-item-delete" class="modal-body">

                           <?php                           EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."view/vbd_newsletter/delete.php");
                           ?>
            <br/>
            </div>

        </div>
    </div>
</div>

<!-- end of modal -->
