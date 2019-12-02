<?php

/**
 * Created by VBuilder
 * Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/
 * Date: 26/08/2019, Monday
 * Time: 09:50 AM
 */

header('Content-Type: application/json');

require_once "../base.php";

EngineBuild::Database();
EngineBuild::BuildProcessor("Vbd_upload");


EngineBuild::BuildSelfFunctions(true ,'post', ['p-readcontrol'=>'p-readcontrol'] );
EngineBuild::BuildSelfFunctions(true ,'post', ['self-readcontrol'=>'self-readcontrol'] );
EngineBuild::BuildSelfFunctions(true ,'post', ['read-upg'=>'read-upg'] );

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
                        'allowed'=>[1,2,3]
                        //,
                        //'denied'=>[1,2,3,4,5]
                    ]
                ]
            ]
       ]
);

EngineBuild::BuildSelfFunctions(true ,'post', ['add'=>'add'] );
EngineBuild::BuildSelfFunctions(true ,'post', ['update'=>'update'] );
EngineBuild::BuildSelfFunctions(true ,'post', ['delete'=>'delete'] );
EngineBuild::BuildSelfFunctions(true ,'post', ['read'=>'read'] );
EngineBuild::BuildSelfFunctions(true ,'post', ['readcontrol'=>'readcontrol'] );
EngineBuild::BuildSelfFunctions(true ,'post', ['deletebase'=>'deletebase'] );
EngineBuild::BuildSelfFunctions(true ,'post', ['modelcontrol'=>'modelcontrol'] );
