<?php
/**
* Created by VBuilder 
* Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Date: 17/09/2019, Tuesday
* Time: 12:35 PM
* Project/Module: Personal Data*/


/*
>> ON VALIDATION
0  ERROR
1  SUCCESS


>> VALIDATED
0 ERROR
1 SUCCESS
2 DATA INSERTED ALREADY PRESENT


*/


$METHOD="post";

$JSON['response']['state']=0;
$METHOD= strtolower($METHOD);
$METHOD=trim($METHOD);
//CHECK FOR REQUIRED FIELDS
$JSON['rq_fields']=EngineBuild:: RequiredFields ($METHOD,[] );


if(
    $JSON['rq_fields']['missing']['count']>0
){

    echo json_encode($JSON);


} else {







$Vbd_user_pdataModel = new Vbd_user_pdataModel() ;


$result= $Vbd_user_pdataModel->read(["by"=>"false"]);
//     $result= $Vbd_user_pdataModel->read(["by"=>"true"]);
//     $result= $Vbd_user_pdataModel->read([]);

//    echo json_encode($result);

    if(isset($result['result'])){

        if($result['result']){
            $JSON['response']['state']=1;
        } else{
            $JSON['response']['state']=0;

        }

unset($result['data']);
        $JSON['response']['result']=$result;

    }


    echo json_encode($JSON);



}



exit;
