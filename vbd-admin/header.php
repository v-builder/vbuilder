<!DOCTYPE html>
<?php
require_once PATH_TO_VBD."../cores/globals_func.php";
//require_once "cores/bs4navwalker.php";

require_once "vappbase.php";

?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>
        <?php
        vbd_title();
        ?>
    </title>

    <?php
//    EngineBuild::BuildBindingProcessorScope( "template-parts/head-meta-tags.php");
    ?>

    <!-- Font Awesome and Glyphs -->
    <link rel="stylesheet" href="<?php echo EngineBuild::getAppTemplateUrl(); ?>/vendors/css/static/vbd-icons.css">
    <!-- Bootstrap core CSS & Libraries -->
    <!-- UIKIT core CSS -->
    <link href="<?php echo EngineBuild::getAppTemplateUrl(); ?>/vendors/css/static/uikit.min.css" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <!--<link href="<?php /*//echo EngineBuild::getAppTemplateUrl(); */?>/vendors/css/static/bootstrap.min.css" rel="stylesheet">-->
    <!-- AOS core CSS -->
    <link href="<?php echo EngineBuild::getAppTemplateUrl(); ?>/vendors/css/static/aos.css" rel="stylesheet">

    <!-- TOASTR & Libraries -->

    <!-- MDB & Libraries -->
<!--      <link href="--><?php //echo EngineBuild::getAppTemplateUrl(); ?><!--/vendors/css/static/mdb.min.css" rel="stylesheet">-->
    <!--
    <link href="<?php echo EngineBuild::getAppTemplateUrl(); ?>/vendors/css/static/pro/mdb.min.css" rel="stylesheet">
    -->
<!--    <link href="--><?php //echo EngineBuild::getAppTemplateUrl(); ?><!--/vendors/css/static/slick.css" rel="stylesheet">-->
    <link href="<?php echo EngineBuild::getAppTemplateUrl(); ?>/vendors/css/static/rangeslider.css" rel="stylesheet">


    <!-- DYNAMIC STYLES -->

<!--    admin template items   admin template items    admin template items   admin template items-->
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?php echo EngineBuild::getAppTemplateUrl(); ?>/vbd-admin/assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?php echo EngineBuild::getAppTemplateUrl(); ?>/vbd-admin/assets/vendors/iconfonts/ionicons/css/ionicons.css">
    <link rel="stylesheet" href="<?php echo EngineBuild::getAppTemplateUrl(); ?>/vbd-admin/assets/vendors/iconfonts/typicons/src/font/typicons.css">
    <link rel="stylesheet" href="<?php echo EngineBuild::getAppTemplateUrl(); ?>/vbd-admin/assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?php echo EngineBuild::getAppTemplateUrl(); ?>/vbd-admin/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?php echo EngineBuild::getAppTemplateUrl(); ?>/vbd-admin/assets/vendors/css/vendor.bundle.addons.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?php echo EngineBuild::getAppTemplateUrl(); ?>/vbd-admin/assets/css/shared/style.css">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?php echo EngineBuild::getAppTemplateUrl(); ?>/vbd-admin/assets/css/demo_1/style.css">

    <!--    end of admin template items   admin template items    admin template items   admin template items-->


    <link href="<?php echo EngineBuild::getAppTemplateUrl(); ?>/vendors/css/static/toastr.min.css" rel="stylesheet">

    <link href="<?php echo EngineBuild::getAppTemplateUrl(); ?>/vendors/css/static/vbuilder.helper.css" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo EngineBuild::getAppTemplateUrl(); ?>/vbd-admin/assets/css/dynamic.css">

    <style type="text/css">
        .vbd-submition-loader-in{
            background-image: url("<?php echo EngineBuild::getAppTemplateUrl(); ?>/vbd-admin/app_lib/img/basic/preloader.gif");
        }
    </style>
    <?php

    //    get_template_part( 'template-parts/header-meta', get_post_format() );
    function wtbString($str){
        echo $str;
    }
    ?>
    <style type="text/css">
        .auth.auth-bg-1 {
            background: url('<?php echo EngineBuild::getAppTemplateUrl(); ?>/vbd-admin/assets/images/auth/login_1.jpg');
            background-size: cover;
        }

    </style>

</head>

<body data-root="<?php echo EngineBuild::getAppUrl(); ?>/vbd-admin" data-app-root="<?php echo EngineBuild::getAppTemplateUrl(); ?>/<?php echo EngineBuild::getVbdApp(); ?>" data-login="<?php echo EngineBuild::getAppUrl(); ?>/vbd-admin" data-users-url="<?php echo VBD_USERS_URL; ?>" class="" >
<!--<div style="
        background: url('<?php /*echo EngineBuild::getAppTemplateUrl(); */?>/app_lib/img/basic/preloader.gif') center no-repeat #fff;" class="se-pre-con"></div>-->



<?php


EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."view/vbd_user/self-root.php");


?>