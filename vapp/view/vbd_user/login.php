




<form  name="vbd_user-vbd-login-form" class="vbd_user-vbd-login-form" action="#!" method="POST">
    <div class="container">

        <div class="row">
            <div class="col-12 mb-2">
                <h3 class="form-title-item text-center mt-4">Log in</h3>
            </div>


            <?php if(isset($_GET['account_created'])){
            ?>
            <div class="col-12">
                <div class="alert-success alert p-2 mt-2">
                    <p class="mb-0 ">Account successfully created. Now you can log in into your account</p>
                </div>
            </div>
                <?php
            } ?>

            <?php if(isset($_GET['account_reset'])){
            ?>
            <div class="col-12">
                <div class="alert-success alert p-2 mt-2">
                    <p class="mb-0 ">Password successfully updated. log in into your account</p>
                </div>
            </div>
                <?php
            } ?>

            <div class="col-12  mt-3">
                <div class="md-form vbd-md-form ">

                    <label for="user_credential">Username/Email</label>

                    <input style="text-transform: lowercase;" placeholder="Username/Email" minlength="4" name="user_credential" type="text" class="user_credential validate form-control" required="">

                </div>
            </div>
          <div class="col-12  mt-3">
                <div class="md-form vbd-md-form ">

                    <label for="log_user_password">Password</label>

                    <input minlength="4" maxlength="20"  placeholder="password" name="user_password" type="password" class="user_password validate form-control" required="">

                </div>
            </div>

            <div class="col-12">
                <button class="vbd-btn-submit btn-md btn btn-primary mt-2 ml-0 btn-block">LOG IN</button>
                <div class="vbd-submition-loader">
                    <div class="vbd-submition-loader-in">
                    </div>
                </div>
                <p class="mt-3 vbd-text-guide mt-4"> You don't have an account yet? <a href="<?php echo VBD_REGISTER_URL; ?>">Create account</a> </p>
                <p class="mt-3 vbd-text-guide"> Forgot password? <a href="<?php echo VBD_RESETP_URL; ?>"> Recover</a> </p>
            </div>
        </div>




    </div>

</form>
