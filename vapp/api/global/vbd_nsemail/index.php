<?php
/**
* Created by VBuilder 
* Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Date: 27/10/2019, Sunday
* Time: 12:05 PM
* Project/Module: Newsletter Email*/




header('Content-Type: application/json');

require_once "../base.php";


EngineBuild::Database();
EngineBuild::BuildProcessor("Vbd_nsemail");


        
        
        EngineBuild::BuildSelfFunctions(true ,'post', ['add-public'=>'add-public'] );

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
// var_dump($VSecurity);

EngineBuild::BuildSelfFunctions(true ,'post', ['add'=>'add'] );
//EngineBuild::BuildSelfFunctions(true ,'post', ['update'=>'update'] );
EngineBuild::BuildSelfFunctions(true ,'post', ['delete'=>'delete'] );
EngineBuild::BuildSelfFunctions(true ,'post', ['read'=>'read'] );
EngineBuild::BuildSelfFunctions(true ,'post', ['readcontrol'=>'readcontrol'] );
EngineBuild::BuildSelfFunctions(true ,'post', ['deletebase'=>'deletebase'] );
EngineBuild::BuildSelfFunctions(true ,'post', ['modelcontrol'=>'modelcontrol'] );


