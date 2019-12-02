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
    EngineBuild::BuildBindingProcessorScope( "template-parts/head-meta-tags.php");
    ?>


    <!-- Font Awesome and Glyphs -->
    <link rel="stylesheet" href="<?php echo EngineBuild::getAppTemplateUrl(); ?>/vendors/css/static/vbd-icons.css">
    <!-- Bootstrap core CSS & Libraries -->

    <link href="<?php echo EngineBuild::getAppTemplateUrl(); ?>/vendors/css/static/bootstrap.min.css" rel="stylesheet">
    <!-- AOS core CSS -->
    <link href="<?php echo EngineBuild::getAppTemplateUrl(); ?>/vendors/css/static/aos.css" rel="stylesheet">


      <link href="<?php echo EngineBuild::getAppTemplateUrl(); ?>/vendors/css/static/toastr.min.css" rel="stylesheet">

    <link href="<?php echo EngineBuild::getAppTemplateUrl(); ?>/vendors/css/static/pro/mdb.min.css" rel="stylesheet">

    <link href="<?php echo EngineBuild::getAppTemplateUrl(); ?>/vendors/css/static/slick.css" rel="stylesheet">
    <link href="<?php echo EngineBuild::getAppTemplateUrl(); ?>/vendors/css/static/rangeslider.css" rel="stylesheet">
    <link href="<?php echo EngineBuild::getAppTemplateUrl(); ?>/vendors/css/static/vbuilder.helper.css" rel="stylesheet">

    <!-- DYNAMIC STYLES -->
    <link href="<?php echo EngineBuild::getAppTemplateUrl(); ?>/vendors/css/external.css" rel="stylesheet">
    <link href="<?php echo EngineBuild::getAppTemplateUrl(); ?>/vendors/css/style.css" rel="stylesheet">
    <link href="<?php echo EngineBuild::getAppTemplateUrl(); ?>/vendors/css/media.css" rel="stylesheet">
    <link href="<?php echo EngineBuild::getAppTemplateUrl(); ?>/vendors/css/media.large.css" rel="stylesheet">
    <link href="<?php echo EngineBuild::getAppTemplateUrl(); ?>/vendors/css/media.mobile.css" rel="stylesheet">

    <style type="text/css">
        .vbd-submition-loader-in{
            background-image: url("<?php echo EngineBuild::getAppTemplateUrl(); ?>/app_lib/img/basic/preloader.gif");
        }
    </style>


</head>

<body id="top" data-root="<?php echo EngineBuild::getAppUrl(); ?>" data-app-root="<?php echo EngineBuild::getAppTemplateUrl(); ?>/<?php echo EngineBuild::getVbdApp(); ?>" data-login="<?php echo VBD_LOGIN_URL; ?>" data-users-url="<?php echo VBD_USERS_URL; ?>" class="" >
<div style="
        background: url('<?php echo EngineBuild::getAppTemplateUrl(); ?>/app_lib/img/basic/preloader.gif') center no-repeat #fff;" class="se-pre-con"></div>
