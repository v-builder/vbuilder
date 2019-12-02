<?php
/**
* Created by VBuilder 
* Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Date: 27/10/2019, Sunday
* Time: 01:43 PM
* Project/Module: Newsletter Message*/


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
$JSON['rq_fields']=EngineBuild:: RequiredFields ($METHOD,['nsmail_id'] );


if(
    $JSON['rq_fields']['missing']['count']>0
){

    echo json_encode($JSON);


} else {




$nsmail_id=trim(EngineBuild:: GetField ($METHOD,'nsmail_id'));


$Vbd_ns_mailModel = new Vbd_ns_mailModel() ;


$result= $Vbd_ns_mailModel->read(['id'=>$nsmail_id, "by"=>"false"]);

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