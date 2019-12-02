
    <?php
    if(defined('VBD_USER_DATA')){
        ?>

        <li class="nav-item dropdown">
            <div class="dropdown-menu dropdown-menu-right dropdown-default"
                 aria-labelledby="navbarDropdownMenuLink-333">
                <?php
                if(VBD_USER_DATA['user_email_conf']!='true'){
                ?>
                    <a class="dropdown-item vbd-confirm-user-email" href="javascript:;">Confirm your email <span class="badge badge-danger">!</span></a>
                    <div class="dropdown-divider"></div>
                <?php
                }

                ?>
<!--                Remove the class .disabled-self-action to view as modal-->
                <a class="dropdown-item vbd-action-self-view disabled-self-action" href="<?php echo EngineBuild::getAppUrl(); ?>/vbd-my-account.php">View Profile</a>

                <div class="dropdown-divider"></div>
                <!--                Remove the class .disabled-self-action to edit as modal-->
                <a class="dropdown-item vbd-user-update-trigger disabled-self-action" href="<?php echo EngineBuild::getAppUrl(); ?>/vbd-edit-my-account.php">Edit Profile</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item vbd-logout-trigger" href="javascript:;">Log out</a>
            </div>
            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" href="javascript:;" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <!--                        <i class="fa fa-user"></i>-->
                <img class="vbd-avatar-img vbd-user-data" style=" background-image: url('<?php
                // user photo
                $user_photo_url=EngineBuild::getAppTemplateUrl()."/".EngineBuild::getVbdApp()."/lib/img/avatar-sample.png";
                EngineBuild::BuildProcessor("Vbd_upload");

                $Vbd_uploadModel = new Vbd_uploadModel() ;

                if(strlen("".VBD_USER_DATA['user_photo'])>0){

                    $result= $Vbd_uploadModel->read(['id'=>VBD_USER_DATA['user_photo'], "by"=>"false"]);
                    $photo_path=$result['data'][0]->getFile_path();
                    if(isset($result['result'])){
                        $user_photo_url= EngineBuild::getAppTemplateUrl()."/".EngineBuild::getVbdApp()."/".$photo_path;
                    }

                }

                echo $user_photo_url;
                ?>');" src="<?php echo EngineBuild::getAppTemplateUrl(); ?>/<?php echo EngineBuild::getVbdApp(); ?>/lib/img/shape_square.png" alt="profile photo"/>

                <span class="user_rn vbd_user-self-holder">
                        <?php echo  VBD_USER_DATA['user_rn']; ?>
                        </span>
            </a>
        </li>
        <?php
    } else {
        ?>

        <li class="nav-item d-none user-log-in-out-links account-title">
            <span class="nav-link waves-effect waves-light ">
                 Account
            </span>
        </li>

        <li class="nav-item user-log-in-out-links">
            <a href="<?php echo VBD_REGISTER_URL; ?>" class="nav-link waves-effect waves-light mr-2">
                Create Account
            </a>
        </li>
        <li class="nav-item user-log-in-out-links">
            <a href="<?php echo VBD_LOGIN_URL; ?>" class="nav-link waves-effect waves-light ">
                Log in <i class="fa fa-sign-in"></i>
            </a>
        </li>
        <?php
    }
    ?>
