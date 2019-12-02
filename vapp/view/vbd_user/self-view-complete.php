<div id="vbd-user-<?php echo USER_PORS; ?>-view" class="container vbd-user-complete-view">
    <div class="row">
        <div class="col-12 user-intro-section">


            <div class="row  mb-1">

                <div class="col-7 mx-auto col-md-5  col-lg-4">

                    <a href="javascript:;" class="vbd-avatar-img-trigger">
                        <img class="vbd-avatar-img  w-100 vbd-user-data<?php if(USER_PORS==='p') {
                            echo "-p";
                        }?>" style="    background-image: url('<?php echo EngineBuild::getAppTemplateUrl(); ?>/<?php echo EngineBuild::getVbdApp(); ?>/lib/img/avatar-sample.png');

                                " src="<?php echo EngineBuild::getAppTemplateUrl(); ?>/<?php echo EngineBuild::getVbdApp(); ?>/lib/img/shape_square.png" alt="profile photo"/>
                    </a>


                </div>

                <div class="col-12 col-md-7 col-lg-8">

                <div class="vbd-y-center">
                    <div class="vbd-y-center-c">
                        <h3  class='style-user-rn'>  <span class='user_rn vbd_user-<?php echo USER_PORS; ?>-holder'></span>  </h3>
                        <p  class='style-user-name'> @<span class='user_name vbd_user-<?php echo USER_PORS; ?>-holder'></span> </p>
                    </div>
                </div>


                <div class="vbd-y-center vbd-y-b">
                    <div class="vbd-y-center-c">
                        <p  class='style-user-professional user-ocupation-typo-<?php echo USER_PORS; ?>-holder'>

                      <strong class='vbd_pd_usp_label_value pdata-<?php echo USER_PORS; ?>-holder'> </strong>
                            <strong class='vbd_pd_usp_type_value pdata-<?php echo USER_PORS; ?>-holder'></strong>

                        </p>


                    </div>
                </div>


                </div>
                <div class="col-12 p-sm-0">
                    <?php
                    if(USER_PORS==='p') {
                        ?>

                        <span  class="d-none btn btn-sm btn-primary  btn-fw  cr-trigger cr-add-success p-holder" data-user-id="0">
                            connected <span class="fa fa-check"></span>
                        </span>
                        <a href="javascript:;" class="d-none btn btn-sm btn-primary  btn-fw  cr-trigger cr-add-it p-holder" data-user-id="0">
                            connect <span class="fa fa-link"></span>
                        </a>

                        <a href="javascript:;" class="d-none btn btn-sm btn-outline-blue cr-trigger cr-remove-it p-holder" data-user-id="0">
                           Disconnect
                        </a>



                        <?php
                    }
                    ?>
                    <!--                loading img-->
                    <div class="vbd-submition-loader cr-trigger-loader">
                        <div class="vbd-submition-loader-in">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <?php
//                    var_dump(VBD_USER_DATA);
                    ?>
                    <p class="vbd_pd_about pdata-<?php echo USER_PORS; ?>-holder user-<?php echo USER_PORS; ?>-about"> </p>
                </div>
            </div>

        </div>
        <div class="col-12">



            <table  class="user-d-table" border="0">
                <tbody>

                <tr class="user-d-row">
                    <td class="user-d-heading">
                        <span class="item-heading">Name</span>
                    </td>
                    <td class="user-d-body"> <span class="item-c">
                        <span class='user_rn vbd_user-<?php echo USER_PORS; ?>-holder'></span>
                        </span>
                    </td>
                </tr>

                <tr class="user-d-row">
                    <td class="user-d-heading">
                        <span class="item-heading">Username</span>
                    </td>
                    <td class="user-d-body"> <span class="item-c">
                       @<span class='user_name vbd_user-<?php echo USER_PORS; ?>-holder'></span>
                        </span>
                    </td>
                </tr>

                <tr class="user-d-row">
                    <td class="user-d-heading">
                        <span class="item-heading">Email</span>
                    </td>
                    <td class="user-d-body"> <span class="item-c">
                        <span class='user_email vbd_user-<?php echo USER_PORS; ?>-holder'></span>
                        </span>
                    </td>
                </tr>

                <?php
                if(USER_PORS==='self') {
                    ?>

                    <tr class="user-d-row">
                        <td class="user-d-heading">
                            <span class="item-heading">Email Confirmation</span>
                        </td>
                        <td class="user-d-body"> <span class="item-c">
                        <span class='user_email_conf vbd_user-<?php echo USER_PORS; ?>-holder'></span>
                        </span>
                        </td>
                    </tr>

                    <?php
                }
                ?>


                <tr class="user-d-row  vbd_pd_usp_catg">
                    <td class="user-d-heading">
                        <span class="item-heading vbd_pd_usp_label_value_lbl">Company</span>
                    </td>
                    <td class="user-d-body"> <span class="item-c">
                        <span class='vbd_pd_usp_label_value pdata-<?php echo USER_PORS; ?>-holder'></span>
                        </span>
                    </td>
                </tr>

                <tr class="user-d-row">
                    <td class="user-d-heading">
                        <span class="item-heading vbd_pd_usp_type_value_lbl">Ocupation</span>
                    </td>
                    <td class="user-d-body"> <span class="item-c">
                        <span class='vbd_pd_usp_type_value pdata-<?php echo USER_PORS; ?>-holder'></span>
                        </span>
                    </td>
                </tr>

                </tbody>
            </table>



            <div class="user-d-row">

                <p  class='user-d-heading item-heading'>
                    Bio
                </p>

                <p class='user-d-body item-c'> <span class='vbd_pd_usp_bio pdata-<?php echo USER_PORS; ?>-holder'></span> </p>

            </div>

            <!--            <p  class='mt-3 item-heading mb-0'><strong>Level: </strong></p> <p class='item-value mt-0'> <span class='ulevel_id vbd_user-self-holder'></span> </p>-->
            <!--            <p  class='mt-3 item-heading mb-0'><strong>Creation Date: </strong></p> <p class='item-value mt-0'> <span class='user_idate vbd_user-self-holder'></span> </p>-->
            <!-- <p  class='mt-3 item-heading mb-0'><strong>State: </strong></p> <p class='item-value mt-0'> <span class='user_state vbd_user-self-holder'></span> </p>-->

        </div>
    </div>
</div>
