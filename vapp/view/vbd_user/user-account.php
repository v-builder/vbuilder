<section class="container-fluid">
    <div class="row">

        <div class="col-10 offset-1 mx-sm-auto col-md-4 offset-md-0 col-lg-3 vbd-users-list-w d-none d-md-block d-lg-block d-xl-block">


            <div class="row">
                <div class="col-12 vbd-users-list-w-header">
                    <h3 class="vbd-users-list-w-heading"> Meet some people your may connect with</h3>
                </div>
            </div>
            <ul class="vbd-users-list public-loading row ">



            </ul>

        </div>
        <div class="col-12 col-md-8 offset-md-4 col-lg-6 d-small">

            <?php
            EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."/view/vbd_user/self-view-complete.php");
            ?>

            <div class="row d-none" id="vbd-user-p-view-error">

                <div class="col-12">
                    <br/>
                    <br/>
                    <br/>
                    <div class="alert-danger alert p-2 mt-2">
                        <p class="mb-0 ">User account not found.</p>
                    </div>
                </div>

            </div>

        </div>


        <div class="col-10 offset-1 mx-sm-auto col-md-4 offset-md-0 col-lg-3 vbd-users-list-w d-md-none d-lg-none d-xl-none">


            <div class="row">
                <div class="col-12 vbd-users-list-w-header">
                    <h3 class="vbd-users-list-w-heading"> Meet some people your may connect with</h3>
                </div>
            </div>
            <ul class="vbd-users-list public-loading row ">



            </ul>

        </div>


    </div>
</section>
