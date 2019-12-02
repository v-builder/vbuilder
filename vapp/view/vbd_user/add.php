




<form id="vbd_user-vbd-add-form" name="vbd_user-vbd-add-form" action="#!" method="POST">
    <div class="container">

        <div class="row">
            <div class="col-12 mb-2">
                <p class="form-title-item">ADD USER</p>
            </div>
            <div class='col-12  mt-3'>
                <div class='md-formx vbd-md-form '>

                    <label for='addf_ulevel_id'>User Level</label>

                    <select class="form-control d-block" id='addf_ulevel_id' name='ulevel_id' required>
                    <option value="1">XDS</option>
                    </select>

                </div>
            </div>

            <div class="col-12  mt-3">
                <div class="md-form vbd-md-form ">

                    <label for="addf_user_rn">Name</label>

                    <input style="text-transform: capitalize;" minlength="4" maxlength="50" placeholder="Insert the name" id="addf_user_rn" name="user_rn" type="text" class="validate form-control" required="">

                </div>
            </div>
            <div class="col-12  mt-3">
                <div class="md-form vbd-md-form ">

                    <label for="addf_user_name">Username</label>

                    <input style="text-transform: lowercase;" minlength="4" maxlength="20"  placeholder="Insert the Username " id="addf_user_name" name="user_name" type="text" class="validate form-control" required="">

                </div>
            </div>  <div class="col-12  mt-3">
                <div class="md-form vbd-md-form ">

                    <label for="addf_user_email">Email</label>

                    <input style="text-transform: lowercase;" minlength="4" maxlength="50" placeholder="Insert the email " id="addf_user_email" name="user_email" type="email" class="validate form-control" required="">

                </div>
            </div>  <div class="col-12  mt-3">
                <div class="md-form vbd-md-form ">

                    <label for="addf_user_password">Password</label>

                    <input minlength="6" maxlength="20"  placeholder="Insert the password " id="addf_user_password" name="user_password" type="password" class="validate form-control" required="">

                </div>
            </div>   <div class="col-12  mt-3">
                <div class="md-form vbd-md-form ">

                    <label for="addf_user_password_c">Password Confirmation</label>

                    <input minlength="6" maxlength="20"  placeholder="Insert the password again" id="addf_user_password_c" name="user_password_c" type="password" class="validate form-control" required="">

                </div>
            </div>
            <div class="col-12">
                <button class="vbd-btn-submit btn-md btn btn-primary  btn-fw mt-2 ml-0">Submit</button>
<!--                loading img-->
                <div class="vbd-submition-loader">
                    <div class="vbd-submition-loader-in">
                    </div>
                </div>

            </div>
        </div>




    </div>

</form>
