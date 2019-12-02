<section class="container">
    <div class="row">

        <div class="col-12 text-centerx">

            <div class="controled-tab-w align-content-center d-none">
                <ul class="nav nav-tabs controled-tab mb-4" role="tablist">
                    <li class="nav-item" >
                        <a class="nav-link active"  data-toggle="tab" href="#self-rp-request" role="tab" aria-controls=""
                           aria-selected="true"><span class="badge badge-dark">1</span> Request</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link "  data-toggle="tab" href="#self-rp-verify" role="tab" aria-controls=""
                           aria-selected="true"><span class="badge badge-dark">2</span> Verify Code</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link "  data-toggle="tab" href="#self-rp-reset" role="tab" aria-controls=""
                           aria-selected="true"><span class="badge badge-dark">3</span> Reset Password</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-12 col-lg-6 mx-auto" >


            <h3 class="text-centerx my-4"> Password Reset </h3>

            <section id="vbd-rp-tab-content" class="tab-content vbd-rp-tab-content">

                <!--                        START OF ITEM-->
                <article class="tab-pane active" id="self-rp-request" role="tabpanel" aria-labelledby="home-tab">
                    <?php                EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."view/vbd_rp/self-add.php");
                    ?>
                </article>

                <!--                        START OF ITEM-->
                <article class="tab-pane fade" id="self-rp-verify" role="tabpanel" aria-labelledby="home-tab">
                    <?php                EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."view/vbd_rp/self-verify.php");
                    ?>
                </article>

                <!--                        START OF ITEM-->
                <article class="tab-pane fade" id="self-rp-reset" role="tabpanel" aria-labelledby="home-tab">
                    <?php                EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."view/vbd_rp/self-reset.php");
                    ?>
                </article>

            </section>


        </div>
    </div>
</section>
