<!-- partial:partials/_navbar.html -->
<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row vbd-user-self-view">
    <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="<?php echo EngineBuild::getAppTemplateUrl(); ?>/vbd-admin">
            <img c src="<?php echo EngineBuild::getAppTemplateUrl(); ?>/app_lib/img/brand/logo.svg" alt="logo" /> </a>
        <a class="navbar-brand brand-logo-mini" href="<?php echo EngineBuild::getAppTemplateUrl(); ?>/vbd-admin">
            <img src="<?php echo EngineBuild::getAppTemplateUrl(); ?>/app_lib/img/brand/logo.svg" alt="logo" /> </a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center">


        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link count-indicator" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-bell-outline"></i>
                    <span class="count">7</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="messageDropdown">
                    <a class="dropdown-item py-2 py-3">
                        <p class="mb-0 font-weight-medium float-left">You have 7 unread mails </p>
                        <span class="badge badge-pill badge-primary float-right">View all</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item py-2 preview-item">
                        <div class="preview-thumbnail">
                            <img src="<?php echo EngineBuild::getAppTemplateUrl(); ?>/vbd-admin/assets/images/faces/face10.jpg" alt="image" class="img-sm profile-pic"> </div>
                        <div class="preview-item-content flex-grow py-2">
                            <p class="preview-subject ellipsis font-weight-medium text-dark">Marian Garner </p>
                            <p class="font-weight-light small-text"> The meeting is cancelled </p>
                        </div>
                    </a>
                    <a class="dropdown-item py-2 preview-item">
                        <div class="preview-thumbnail">
                            <img src="<?php echo EngineBuild::getAppTemplateUrl(); ?>/vbd-admin/assets/images/faces/face12.jpg" alt="image" class="img-sm profile-pic"> </div>
                        <div class="preview-item-content flex-grow py-2">
                            <p class="preview-subject ellipsis font-weight-medium text-dark">David Grey </p>
                            <p class="font-weight-light small-text"> The meeting is cancelled </p>
                        </div>
                    </a>
                    <a class="dropdown-item py-2 preview-item">
                        <div class="preview-thumbnail">
                            <img src="<?php echo EngineBuild::getAppTemplateUrl(); ?>/vbd-admin/assets/images/faces/face1.jpg" alt="image" class="img-sm profile-pic"> </div>
                        <div class="preview-item-content flex-grow py-2">
                            <p class="preview-subject ellipsis font-weight-medium text-dark">Travis Jenkins </p>
                            <p class="font-weight-light small-text"> The meeting is cancelled </p>
                        </div>
                    </a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link count-indicator" id="notificationDropdown" href="#" data-toggle="dropdown">
                    <i class="mdi mdi-email-outline"></i>
                    <span class="count bg-success">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="notificationDropdown">
                    <a class="dropdown-item py-2 py-3 border-bottom">
                        <p class="mb-0 font-weight-medium float-left">You have 4 new notifications </p>
                        <span class="badge badge-pill badge-primary float-right">View all</span>
                    </a>
                    <a class="dropdown-item py-2 preview-item py-3">
                        <div class="preview-thumbnail">
                            <i class="mdi mdi-alert m-auto text-primary"></i>
                        </div>
                        <div class="preview-item-content">
                            <h6 class="preview-subject font-weight-normal text-dark mb-1">Application Error</h6>
                            <p class="font-weight-light small-text mb-0"> Just now </p>
                        </div>
                    </a>
                    <a class="dropdown-item py-2 preview-item py-3">
                        <div class="preview-thumbnail">
                            <i class="mdi mdi-settings m-auto text-primary"></i>
                        </div>
                        <div class="preview-item-content">
                            <h6 class="preview-subject font-weight-normal text-dark mb-1">Settings</h6>
                            <p class="font-weight-light small-text mb-0"> Private message </p>
                        </div>
                    </a>
                    <a class="dropdown-item py-2 preview-item py-3">
                        <div class="preview-thumbnail">
                            <i class="mdi mdi-airballoon m-auto text-primary"></i>
                        </div>
                        <div class="preview-item-content">
                            <h6 class="preview-subject font-weight-normal text-dark mb-1">New user registration</h6>
                            <p class="font-weight-light small-text mb-0"> 2 days ago </p>
                        </div>
                    </a>
                </div>
            </li>
            <li class="nav-item dropdown d-nonex d-inline-block d-xl-inline-blockx user-dropdown">
                <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                    <img class="img-xs rounded-circle  vbd-avatar-img vbd-user-data"  style="     background-image: url('<?php echo EngineBuild::getAppTemplateUrl(); ?>/<?php echo EngineBuild::getVbdApp(); ?>/lib/img/basic/shape_square.png');

                            " src="<?php echo EngineBuild::getAppTemplateUrl(); ?>/<?php echo EngineBuild::getVbdApp(); ?>/lib/img/shape_square.png" alt="profile photo"/>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    <div class="dropdown-header text-center">
                        <img class="img-xs rounded-circle  vbd-avatar-img vbd-user-data"  style="     background-image: url('<?php echo EngineBuild::getAppTemplateUrl(); ?>/<?php echo EngineBuild::getVbdApp(); ?>/lib/img/basic/shape_square.png');

                                " src="<?php echo EngineBuild::getAppTemplateUrl(); ?>/<?php echo EngineBuild::getVbdApp(); ?>/lib/img/shape_square.png" alt="profile photo"/>
<!--                        Name -->
                        <p class="mb-1 mt-3 font-weight-semibold user_rn vbd_user-self-holder"> </p>
<!--                        email-->
                        <p class="font-weight-light text-muted mb-0 user_email vbd_user-self-holder"> </p>
                    </div>
                    <div class="dropdown-divider"></div>

                    <a href="account<?php echo  VBD_FILE_EXT; ?>" class="dropdown-item py-2">My Account <i class="dropdown-item py-2-icon ti-dashboard"></i></a>
                    <div class="dropdown-divider"></div>

                    <a href="account-update<?php echo  VBD_FILE_EXT; ?>" class="dropdown-item py-2">Update Account</a>
                    <div class="dropdown-divider"></div>
                    <?php
                    if(VBD_USER_DATA['user_email_conf']!='true'){
                        ?>
                        <a class="dropdown-item py-2  vbd-confirm-user-email">Confirm your email  <i class="dropdown-item py-2-icon ti-dashboard"></i></a>
                        <div class="dropdown-divider"></div>
                        <?php
                    }

                    ?>
<!--                    <a class="dropdown-item py-2">Messages<i class="dropdown-item py-2-icon ti-comment-alt"></i></a>-->
<!--                    <div class="dropdown-divider"></div>-->
<!--                    <a class="dropdown-item py-2">Activity<i class="dropdown-item py-2-icon ti-location-arrow"></i></a>-->
<!--                    <div class="dropdown-divider"></div>-->
<!--                    <a class="dropdown-item py-2">FAQ<i class="dropdown-item py-2-icon ti-help-alt"></i></a>-->
<!--                    <div class="dropdown-divider"></div>-->
                    <a class="dropdown-item py-2 vbd-logout-trigger">Sign Out<i class="dropdown-item py-2-icon ti-power-off"></i></a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
<!-- partial -->
<div class="container-fluid page-body-wrapper vbd-user-self-view">
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item nav-profile">
                <a href="#" class="nav-link">
                    <div class="profile-image">

                        <img class="img-xs rounded-circle  vbd-avatar-img vbd-user-data"  style="     background-image: url('<?php echo EngineBuild::getAppTemplateUrl(); ?>/<?php echo EngineBuild::getVbdApp(); ?>/lib/img/basic/shape_square.png');

                                " src="<?php echo EngineBuild::getAppTemplateUrl(); ?>/<?php echo EngineBuild::getVbdApp(); ?>/lib/img/shape_square.png" alt="profile photo"/>

                        <div class="dot-indicator bg-success"></div>
                    </div>
                    <div class="text-wrapper">
<!--                        user name-->
                        <p class="profile-name user_rn vbd_user-self-holder"> </p>
<!--                        charge-->
                        <p class="designation ulevel_id vbd_user-self-holder"></p>
                    </div>
                </a>
            </li>
            <li class="nav-item nav-category">Main Menu</li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo EngineBuild::getAppTemplateUrl(); ?>/vbd-admin">
                    <i class="menu-icon typcn typcn-document-text"></i>
                    <span class="menu-title">Home</span>
                </a>
            </li>

            <?php

            if( VBD_USER_DATA['ulevel_id'] <= VBD_MAXL_ADMIN ) {

            ?>


            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#users-basicv" aria-expanded="false" aria-controls="ui-basic">
                    <i class="menu-icon typcn typcn-coffee"></i>
                    <span class="menu-title">Users</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="users-basicv">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="user<?php echo  VBD_FILE_EXT; ?>">User </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="user-level<?php echo  VBD_FILE_EXT; ?>">User Level</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="account-type<?php echo  VBD_FILE_EXT; ?>">Account Type</a>
                        </li>
                    </ul>
                </div>
            </li>
                <?php

            }
            ?>

            <?php

            if( VBD_USER_DATA['ulevel_id'] <= VBD_MAXL_ADMIN ) {

                ?>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#nl-basicv" aria-expanded="false"
                       aria-controls="ui-basic">
                        <i class="menu-icon typcn typcn-coffee"></i>
                        <span class="menu-title">Newsletter</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="nl-basicv">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="ns-email<?php echo VBD_FILE_EXT; ?>">Email List</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="newsletter<?php echo VBD_FILE_EXT; ?>">Newsletters</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="ns-mail<?php echo VBD_FILE_EXT; ?>">Sent Emails</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <?php
            }
            ?>

        </ul>
    </nav>