<div class="container">
    <div class="row">
        <div class="col-12 mb-2 d-none">
            <p class="form-title-item">Update Basics</p>
        </div>


        <div class="col-12">

            <div class="row">
                <div class="col-8 col-md-7 mb-3 mt-1 mx-auto">

                    <a href="javascript:;" class="vbd-avatar-img-trigger">
                        <img class="vbd-avatar-img  w-100 vbd-user-data mb-1 " style="    background-image: url('<?php echo EngineBuild::getAppTemplateUrl(); ?>/<?php echo EngineBuild::getVbdApp(); ?>/lib/img/avatar-sample.png');
                            " src="<?php echo EngineBuild::getAppTemplateUrl(); ?>/<?php echo EngineBuild::getVbdApp(); ?>/lib/img/shape_square.png" alt="profile photo"/>
                    </a>



                    <div class="row">

                        <div class="col-12 text-center">
                            <div class="w-100 dropdown mt-3">

                                <div class="dropdown-menu self-update-photo dropdown-menu-right dropdown-default"
                                     aria-labelledby="navbarDropdownMenuLink-333">
                                    <a href="javascript:;" class="dropdown-item vbd-self-update-photo-file-label-in vbd-avatar-img-trigger-call"><span class="fa fa-eye"></span> View </a>
                                    <div class="dropdown-divider"></div>

                                    <div class="dropdown-item">
                                        <form name="vbd-user-self-update-photo" action="javascript:;" class="text-centerx ">

                                            <label for="vbd-self-update-photo-file" class="vbd-self-update-photo-file-label-in text-center hover-pointer txt-blue-darker"> <span class="fa fa-upload"></span> Upload </label>

                                            <input id="vbd-self-update-photo-file" type="file" name="vbd-self-update-photo-file" class="vbd-self-update-photo-file" accept="image/*"  required >

                                        </form>
                                    </div>
                                    <div class="dropdown-divider"></div>
                                    <a href="javascript:;" class="dropdown-item vbd-self-update-photo-file-labelx vbd-self-update-remove-photo"><span class="fa fa-remove"></span> Remove </a>

                                </div>

                                <a class="dropdown-toggle vbd-self-update-photo-file-label" id="navbarDropdownMenuLink-333" href="javascript:;" data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false">
                                    <span class="fa fa-edit"></span> Edit profile photo
                                </a>


                            </div>

                            <progress id="progressBarVbdUp" value="0" max="100" style="width:100%;"></progress>
                        </div>


                    </div>


                </div>
            </div>

        </div>
    </div>
</div>

<form id="vbd_user-vbd-self-update-form" name="vbd_user-vbd-self-update-form"  action="#!" method="post" >
    <div class="container">



        <div class="row">


            <div class="col-12  mt-3">
                <div class="md-form vbd-md-form ">

                    <label for="user_rn">Name</label>

                    <input style="text-transform: capitalize;" placeholder="Insert the name" id="self_user_rn" name="user_rn" type="text" class="validate form-control" required="">

                </div>
            </div>
            <div class="col-12  mt-3">
                <div class="md-form vbd-md-form ">

                    <label for="user_name">Username</label>

                    <input style="text-transform: lowercase;" placeholder="Insert the Username " id="self_user_name" name="user_name" type="text" class="validate form-control" required="">

                </div>
            </div>  <div class="col-12  mt-3">
                <div class="md-form vbd-md-form ">

                    <label for="user_email">Email</label>

                    <input style="text-transform: lowercase;" placeholder="Insert the email " id="self_user_email" name="user_email" type="email" class="validate form-control" required="">

                </div>
            </div>

            <div class="col-12  mt-3">
                <div class="md-form vbd-md-form ">

                    <label for="user_password" class="active">Current Password</label>

                    <input minlength="6" placeholder="Insert your password " id="xrself_user_password" name="user_password" type="password" class="validate form-control" required="">

                </div>
            </div>

            <div class="col-12">
                <button class="vbd-btn-submit btn-md btn btn-primary  btn-fw  mt-2 ml-0">Update</button>
                <div class="vbd-submition-loader">
                    <div class="vbd-submition-loader-in">
                    </div>
                </div>
            </div>


        </div>




    </div>

</form>

