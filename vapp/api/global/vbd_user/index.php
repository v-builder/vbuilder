<?php

/**
 * Created by VBuilder
 * Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/
 * Date: 28/08/2019, Wednesday
 * Time: 02:32 PM
 */


header('Content-Type: application/json');

require_once "../base.php";

EngineBuild::Database();
EngineBuild::BuildProcessor("Vbd_user");
EngineBuild::BuildProcessor("Vbd_user_pdata");
EngineBuild::BuildProcessor("Connection_request");



// non-protected functions
EngineBuild::BuildSelfFunctions(true ,'post', ['read-public'=>'read-public'] );
EngineBuild::BuildSelfFunctions(true ,'post', ['self-readcontrol'=>'self-readcontrol'] );
EngineBuild::BuildSelfFunctions(true ,'post', ['p-readcontrol'=>'p-readcontrol'] );
EngineBuild::BuildSelfFunctions(true ,'post', ['self-add'=>'self-add'] );
EngineBuild::BuildSelfFunctions(true ,'post', ['self-update'=>'self-update'] );
EngineBuild::BuildSelfFunctions(true ,'post', ['self-update-photo-mb'=>'self-update-photo-mb'] );
EngineBuild::BuildSelfFunctions(true ,'post', ['self-update-password'=>'self-update-password'] );
EngineBuild::BuildSelfFunctions(true ,'post', ['self-update-photo'=>'self-update-photo'] );
EngineBuild::BuildSelfFunctions(true ,'post', ['self-update-rphoto'=>'self-update-rphoto'] );
EngineBuild::BuildSelfFunctions(true ,'post', ['self-email-conf'=>'self-email-conf'] );
EngineBuild::BuildSelfFunctions(true ,'post', ['self-email-conf-run'=>'self-email-conf-run'] );



EngineBuild::BuildSelfFunctions(true ,'post', ['read'=>'read'] );
EngineBuild::BuildSelfFunctions(true ,'post', ['readcontrol'=>'readcontrol'] );

// Secure all functions bellow
$VSecurity=VSecurity::appSecurity
(
    [
        'ajax'=>true ,
        'security'=>
            [
                'enable'=>true,
                'user'=>[
                    'user_level'=>[
                        'allowed'=>[1,2]
                        //,
                        //'denied'=>[1,2,3,4,5]
                    ]
                ]
            ]
    ]
);

// protected functions
EngineBuild::BuildSelfFunctions(true ,'post', ['add'=>'add'] );
EngineBuild::BuildSelfFunctions(true ,'post', ['update'=>'update'] );
EngineBuild::BuildSelfFunctions(true ,'post', ['update-role'=>'update-role'] );
EngineBuild::BuildSelfFunctions(true ,'post', ['update-password'=>'update-password'] );
EngineBuild::BuildSelfFunctions(true ,'post', ['update-password-reset'=>'update-password-reset'] );
EngineBuild::BuildSelfFunctions(true ,'post', ['delete'=>'delete'] );
EngineBuild::BuildSelfFunctions(true ,'post', ['deletebase'=>'deletebase'] );
EngineBuild::BuildSelfFunctions(true ,'post', ['modelcontrol'=>'modelcontrol'] );

