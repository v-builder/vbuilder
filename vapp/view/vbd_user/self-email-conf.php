<?php
/**
 * Created by Vayile Fumo.
 * User: Vayile Fumo
 * Date: 2019-09-08
 * Time: 23:13
 */


EngineBuild::Database();
EngineBuild::BuildProcessor("Vbd_user");

$validLink=false;
$alertType='danger';

$alertMsg='Error verifying your email. Please request the verification link and run it again.';

if(isset($_GET['stepA']) && isset($_GET['stepB']) && isset($_GET['stepC'])){
    $validLink=true;
}


if($validLink){




}?>


<div id="vbd-user-self-email-conf" class="container">
    <div class="row">


        <div class="col-12">
            <h3 class="vbd-heading-guide" >Email password confirmation process.</h3>
            <!--                loading img-->
            <div class="vbd-submition-loader" style="display: block">
                <div class="vbd-submition-loader-in">
                </div>
            </div>
            <div class="alert p-2 mt-2">

                <p class="mb-0 "></p>
            </div>
        </div>
    </div>
</div>

