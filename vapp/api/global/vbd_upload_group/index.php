<?php
/**
* Created by VBuilder 
* Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Date: 19/10/2019, Saturday
* Time: 10:54 AM
* Project/Module: VB Upload Group*/




header('Content-Type: application/json');

require_once "../base.php";


EngineBuild::Database();
EngineBuild::BuildProcessor("Vbd_upload_group");

EngineBuild::BuildSelfFunctions(true ,'post', ['add'=>'add'] );
EngineBuild::BuildSelfFunctions(true ,'post', ['update'=>'update'] );
EngineBuild::BuildSelfFunctions(true ,'post', ['delete'=>'delete'] );
EngineBuild::BuildSelfFunctions(true ,'post', ['read'=>'read'] );
EngineBuild::BuildSelfFunctions(true ,'post', ['readcontrol'=>'readcontrol'] );
EngineBuild::BuildSelfFunctions(true ,'post', ['deletebase'=>'deletebase'] );
EngineBuild::BuildSelfFunctions(true ,'post', ['modelcontrol'=>'modelcontrol'] );


