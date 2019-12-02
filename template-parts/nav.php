<nav id="app-navegation-bar-w" class="navbar navbar-expand-lg navbar-light fixed-top">
    <div class="container">

        <a class="navbar-brand waves-effect"  href="<?php echo EngineBuild::getAppUrl(); ?>">
            <img src="<?php echo EngineBuild::getAppTemplateUrl(); ?>/app_lib/img/brand/logo.svg" alt="vbuilder" class="">
        </a>

        <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#app-navegation-bar"
                aria-controls="app-navegation-bar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <!--            User navegation for small view ports-->
        <ul class="navbar-nav nav-user-sm nav-flex-icons d-lg-none">
        <?php
        EngineBuild::BuildBindingProcessorScope( "template-parts/nav-user.php");
        ?>
        </ul>

        <div class="collapse navbar-collapse " id="app-navegation-bar">
            <ul class="navbar-nav mx-auto">

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo EngineBuild::getAppUrl() ?>/discover.php">Discover
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" target="_blank" href="https://vbuilder.wtb.co.mz/page-builder.php">Projects Builder
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" target="_blank" href="https://vbuilder.wtb.co.mz/docs">Documentation
                    </a>
                </li>

            </ul>

<!--            User navegation for high view ports-->
            <ul class="navbar-nav ml-auto nav-user-lg nav-flex-icons">

            <?php
            EngineBuild::BuildBindingProcessorScope( "template-parts/nav-user.php");
            ?>
            </ul>


        </div>

    </div>
</nav>

<?php


EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."view/vbd_user/self-root.php");


?>