




<form name="vbd_rp-vbd-self-reset-form" action="#!" method="post">

    <div class="row">
        <div class="col-12 mb-2">
            <p class="vbd-text-guide">Reset Password</p>
        </div>


        <div class="col-12  mt-3">
            <div class="md-form vbd-md-form ">

                <label for="user_password">New Password</label>

                <input minlength="6" placeholder="Insert the password " name="user_password_n" type="password" class="validate form-control" required="">

            </div>
        </div>

        <div class="col-12  mt-3">
            <div class="md-form vbd-md-form ">

                <label for="user_password">Confirm New Password</label>

                <input minlength="6" placeholder="Insert the password " name="user_password_n_c" type="password" class="validate form-control" required="">

            </div>
        </div>

        <div class="col-12">
            <button class="vbd-btn-submit btn-md btn btn-primary  btn-fw mt-2 ml-0">Update</button>
                <div class="vbd-submition-loader">
                    <div class="vbd-submition-loader-in">
                    </div>
                </div>
            <p class="vbd-text-guide mt-3"> Password reset not working? <a data-toggle="tab" href="#self-rp-verify" role="tab" aria-controls=""
                                                                           aria-selected="true">Enter other code</a> or <a data-toggle="tab" href="#self-rp-request" role="tab" aria-controls=""
                                                                  aria-selected="true">Request new code</a>  </p>
        </div>
    </div>




</form>
