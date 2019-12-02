<?php
/**
* Created by VBuilder 
* Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Date: 27/10/2019, Sunday
* Time: 01:41 PM
* Project/Module: Newsletter*/




header('Content-Type: application/json');

require_once "../base.php";


EngineBuild::Database();
EngineBuild::BuildProcessor("Vbd_newsletter");
EngineBuild::BuildProcessor("Vbd_nsemail");
EngineBuild::BuildProcessor("Vbd_ns_mail");
    EngineBuild::BuildProcessor("Vbd_upload");
    // check user
    $VSecurity=VSecurity::appSecurity
    (
    [

    'ajax'=>true ,
    'security'=>
    [
    'enable'=>true,
    'user'=>[
    'user_level'=>[
    //                        'allowed'=>[1,5]
    //                        ,
    //                        'denied'=>[1,2,3,4,5]
    ]

    ]

    ],
    
    // if is not ajax
    'on_deny'=> [
    //            'redirect'=>VBD_ROOT,
    //            'toast_msg'=>'You don\'t have permissions to perform actions in this page. Please log in with an authorized account  Home page'
    ]

    ]
    );

    
        
        
        
        
        EngineBuild::BuildSelfFunctions(true ,'post', ['add-fdata'=>'upd_ns_attach'] );
        EngineBuild::BuildSelfFunctions(true ,'post', ['send'=>'send'] );

        
        EngineBuild::BuildSelfFunctions(true ,'post', ['add-fdata'=>'upd_ns_cover'] );
            
        EngineBuild::BuildSelfFunctions(true ,'post', ['add-fdata'=>'upd_ns_pdf'] );
            
        EngineBuild::BuildSelfFunctions(true ,'post', ['add-fdata'=>'add-fdata'] );
    EngineBuild::BuildSelfFunctions(true ,'post', ['add'=>'add'] );
EngineBuild::BuildSelfFunctions(true ,'post', ['update'=>'update'] );
EngineBuild::BuildSelfFunctions(true ,'post', ['delete'=>'delete'] );
EngineBuild::BuildSelfFunctions(true ,'post', ['read'=>'read'] );
EngineBuild::BuildSelfFunctions(true ,'post', ['readcontrol'=>'readcontrol'] );
EngineBuild::BuildSelfFunctions(true ,'post', ['deletebase'=>'deletebase'] );
EngineBuild::BuildSelfFunctions(true ,'post', ['modelcontrol'=>'modelcontrol'] );


