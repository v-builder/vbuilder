<?php

//define("VBD_W_WP",true);

include_once "vappbase.php";
include_once "securityControl.php";


define('VBD_PG_TITLE',VBD_USER_DATA['user_rn']. " | Update");

EngineBuild::vbd_header("header.php");

define("USER_PORS","self");

?>


<div class="container-scroller">

    <?php
    EngineBuild::BuildBindingProcessorScope( "template-parts/nav.php");
    ?>

    <div class="main-panel">
        <div class="content-wrapper">

    <!-- partial -->

            <section class="container my-4">
                <div class="row">

                    <div class="col-12 mx-auto">

                        <h3 class="form-title-item mb-4">Edit my account</h3>


                        <div uk-grid>
                            <div class="uk-width-small@m">

                                <ul class="uk-nav uk-nav-default" uk-switcher="connect: #component-nav; animation: uk-animation-fade">
                                    <li><a href="#">Basic Data</a></li>
                                    <li><a href="#">Personal Data</a></li>
                                    <li><a href="#">Change Password</a></li>
                                </ul>

                            </div>
                            <div class="uk-width-expand@m">

                                <ul id="component-nav" class="uk-switcher">

                                    <li>

                                        <div class="row">
                                            <div class="col-10 col-md-8 col-lg-6 mx-auto">

                                                <?php
                                                EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."/view/vbd_user/form-basic.php");
                                                ?>

                                            </div>
                                        </div>

                                    </li>

                                    <li>
                                        <div class="row">
                                            <div class="col-10 col-md-8 mx-auto">

                                                <?php
                                                EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."/view/vbd_user/update-pdata.php");
                                                ?>
                                            </div>
                                        </div>
                                    </li>

                                    <li>


                                        <div class="row">
                                            <div class="col-10 col-md-8 col-lg-6 mx-auto">

                                            <?php
                                        EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."/view/vbd_user/form-password.php");
                                        ?>
                                            </div>
                                        </div>
                                    </li>

                                </ul>

                            </div>
                        </div>



                    </div>
                </div>
            </section>




        </div>
    </div>
</div>



<?php


EngineBuild::BuildBindingProcessorScope( "template-parts/js_include.php");
?>

<script type="text/javascript" src="<?php echo EngineBuild::getVbdTemplateUrl(); ?>/view/vbd_user_pdata/self.controller.js"></script>

<script type="text/javascript">
    runSelfUpdateTrigger(false);
    getPhoneData();

    $(document).on('click', "a[data-toggle='tab']", function (e) {

        e.preventDefault();

        // $().addClass('active');
        // $($(this).attr('href')+"").tab('show');
        // var tabTg=;
        $($(this).attr('href')+" .tab-pane").show();
        $($(this).attr('href')).addClass('active;');

    });
</script>

<!-- Custom js for this page-->
<!--<script src="--><?php //echo EngineBuild::getAppTemplateUrl(); ?><!--/vbd-admin/assets/js/demo_1/dashboard.js"></script>-->

<!-- End custom js for this page-->
<?php

EngineBuild::vbd_footer("footer.php");

?>
