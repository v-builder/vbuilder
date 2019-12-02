<p  class='mb-2 mt-3 item-heading mb-0'><strong><span class='text-capitalize user_rn vbd_user-holder'></span> </strong></p>

<div class="controled-tab-w align-content-center">
    <ul class="nav nav-tabs controled-tab mb-4" role="tablist">
        <li class="nav-item">
            <a class="nav-link active"  data-toggle="tab" href="#self-up-basics" role="tab" aria-controls=""
               aria-selected="true">Basics</a>
        </li>


        <li class="nav-item">
            <a class="nav-link "  data-toggle="tab" href="#self-up-pdata" role="tab" aria-controls=""
               aria-selected="true">Personal Data</a>
        </li>

        <li class="nav-item">
            <a class="nav-link"  data-toggle="tab" href="#self-up-password" role="tab" aria-controls=""
               aria-selected="true">Password</a>
        </li>

    </ul>
</div>
<br/>

<div class="row">
<div class="col-12">

        <section id="vbd-tab-content" class="tab-content vbd_user-modal-self-update-w">



            <!--                        START OF ITEM-->

            <article class="tab-pane active" id="self-up-basics" role="tabpanel" aria-labelledby="home-tab">

                <div class="row">
                    <div class=" col-md-6 col-lg-5 mx-auto">



                        <?php
                        EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."/view/vbd_user/form-basic.php");
                        ?>


                    </div>
                </div>


            </article>



            <!--                        START OF ITEM-->
            <article class="tab-pane fade" id="self-up-password" role="tabpanel" aria-labelledby="home-tab">
                <div class="row">
                    <div class=" col-md-6 col-lg-5 mx-auto">
                        <?php
                        EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."/view/vbd_user/form-password.php");
                        ?>


                    </div>
                </div>

            </article>



            <!--                  START OF ITEM                 -->
            <article class="tab-pane fade" id="self-up-pdata" role="tabpanel" aria-labelledby="home-tab">
                <div class="row">
                    <div class=" col-md-10  mx-auto">


                <?php
                EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."/view/vbd_user/update-pdata.php");
                ?>
                    </div>
                </div>

            </article>


        </section>


</div>
</div>



