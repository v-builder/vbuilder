<p  class='mb-2 mt-3 item-heading mb-0'><strong>User: </strong><span class='user_name vbd_user-holder'></span> </p>

<div class="controled-tab-w align-content-center">
    <ul class="nav nav-tabs controled-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active"  data-toggle="tab" href="#up-basics" role="tab" aria-controls=""
               aria-selected="true">Basics</a>
        </li>
        <li class="nav-item">
            <a class="nav-link "  data-toggle="tab" href="#up-role" role="tab" aria-controls=""
               aria-selected="true">Role</a>
        </li>
        <li class="nav-item">
            <a class="nav-link "  data-toggle="tab" href="#up-password" role="tab" aria-controls=""
               aria-selected="true">Password</a>
        </li>
        <li class="nav-item">
            <a class="nav-link "  data-toggle="tab" href="#up-password-r" role="tab" aria-controls=""
               aria-selected="true">Password Reset</a>
        </li>
    </ul>
</div>


<section id="vbd-tab-content" class="tab-content">

    <!--                        START OF ITEM-->
    <article class="tab-pane active" id="up-basics" role="tabpanel" aria-labelledby="home-tab">



        <form id="vbd_user-vbd-update-form" name="vbd_user-vbd-update-form"  action="#!" method="post" >
            <div class="container">


                <div class="row">
                    <div class="col-12 mb-2">
                        <p class="form-title-item">Update Basics</p>
                    </div>


                    <div class="col-12  mt-3">
                        <div class="md-form vbd-md-form ">

                            <label for="user_rn">Name</label>

                            <input style="text-transform: capitalize;" placeholder="Insert the name" id="user_rn" name="user_rn" type="text" class="validate form-control" required="">

                        </div>
                    </div>
                    <div class="col-12  mt-3">
                        <div class="md-form vbd-md-form ">

                            <label for="user_name">Username</label>

                            <input style="text-transform: lowercase;" placeholder="Insert the Username " id="user_name" name="user_name" type="text" class="validate form-control" required="">

                        </div>
                    </div>  <div class="col-12  mt-3">
                        <div class="md-form vbd-md-form ">

                            <label for="user_email">Email</label>

                            <input style="text-transform: lowercase;" placeholder="Insert the email " id="user_email" name="user_email" type="email" class="validate form-control" required="">

                        </div>
                    </div>
                    <div class="col-12">
                        <button class="vbd-btn-submit btn-md btn btn-primary  btn-fw mt-2 ml-0">Update</button>
                <div class="vbd-submition-loader">
                    <div class="vbd-submition-loader-in">
                    </div>
                </div>
                    </div>
                </div>




            </div>

        </form>



    </article>

    <!--                        START OF ITEM-->
    <article class="tab-pane fade" id="up-role" role="tabpanel" aria-labelledby="home-tab">


        <form id="vbd_user-vbd-update-role-form" name="vbd_user-vbd-update-role-form"  action="#!" method="post" >
            <div class="container">

                <div class="row">
                    <div class="col-12 mb-2">
                        <p class="form-title-item">Update Role</p>
                    </div>

                    <div class='col-12  mt-3'>
                        <div class='md-formx vbd-md-form '>

                            <label for='ulevel_id'>User Level</label>

                            <select class="form-control d-block" id='ulevel_id' name='ulevel_id' required>
                                <option value="1">XDS</option>
                            </select>

                        </div>
                    </div>


                    <div class="col-12">
                        <button class="vbd-btn-submit btn-md btn btn-primary  btn-fw mt-2 ml-0">Update</button>
                <div class="vbd-submition-loader">
                    <div class="vbd-submition-loader-in">
                    </div>
                </div>
                    </div>
                </div>

            </div>

        </form>



    </article>

    <!--                        START OF ITEM-->
    <article class="tab-pane fade" id="up-password" role="tabpanel" aria-labelledby="home-tab">


        <form id="vbd_user-vbd-update-password-form" name="vbd_user-vbd-update-password-form"  action="#!" method="post" >
            <div class="container">


                <div class="row">
                    <div class="col-12 mb-2">
                        <p class="form-title-item">Update Password</p>
                    </div>

                    <div class="col-12  mt-3">
                        <div class="md-form vbd-md-form ">

                            <label for="user_password">Present Password</label>

                            <input minlength="6" placeholder="Insert the password " id="resetf_user_password" name="user_password" type="password" class="validate form-control" required="">

                        </div>
                    </div>

                    <div class="col-12  mt-3">
                        <div class="md-form vbd-md-form ">

                            <label for="user_password">New Password</label>

                            <input minlength="6" placeholder="Insert the password " id="resetf_user_password_n" name="user_password_n" type="password" class="validate form-control" required="">

                        </div>
                    </div>

                    <div class="col-12  mt-3">
                        <div class="md-form vbd-md-form ">

                            <label for="user_password">Confirm New Password</label>

                            <input minlength="6" placeholder="Insert the password " id="resetf_user_password_n_c" name="user_password_n_c" type="password" class="validate form-control" required="">

                        </div>
                    </div>

                    <div class="col-12">
                        <button class="vbd-btn-submit btn-md btn btn-primary  btn-fw mt-2 ml-0">Update</button>
                <div class="vbd-submition-loader">
                    <div class="vbd-submition-loader-in">
                    </div>
                </div>
                    </div>
                </div>




            </div>

        </form>



    </article>

    <!--                        START OF ITEM-->
    <article class="tab-pane fade" id="up-password-r" role="tabpanel" aria-labelledby="home-tab">


        <form id="vbd_user-vbd-update-passwordr-form" name="vbd_user-vbd-update-passwordr-form"  action="#!" method="post" >
            <div class="container">


                <div class="row">
                    <div class="col-12 mb-2">
                        <p class="form-title-item">Reset Password</p>
                    </div>


                    <div class="col-12  mt-3">
                        <div class="md-form vbd-md-form ">

                            <label for="user_password">New Password</label>

                            <input minlength="6" placeholder="Insert the password " id="vresetf_user_password_n" name="user_password_n" type="password" class="validate form-control" required="">

                        </div>
                    </div>

                    <div class="col-12  mt-3">
                        <div class="md-form vbd-md-form ">

                            <label for="user_password">Confirm New Password</label>

                            <input minlength="6" placeholder="Insert the password " id="vresetf_user_password_n_c" name="user_password_n_c" type="password" class="validate form-control" required="">

                        </div>
                    </div>

                    <div class="col-12">
                        <button class="vbd-btn-submit btn-md btn btn-primary  btn-fw mt-2 ml-0">Update</button>
                <div class="vbd-submition-loader">
                    <div class="vbd-submition-loader-in">
                    </div>
                </div>
                    </div>
                </div>




            </div>

        </form>



    </article>

</section>



