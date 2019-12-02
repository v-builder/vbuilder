<?php
/**
* Created by VBuilder 
* Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Date: 11/09/2019, Wednesday
* Time: 01:01 PM
* Project/Module: Account Type*/


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
$JSON['rq_fields']=EngineBuild:: RequiredFields ($METHOD,['vbd_at_id'] );


if(
    $JSON['rq_fields']['missing']['count']>0
){

    echo json_encode($JSON);


} else {




$vbd_at_id=trim(EngineBuild:: GetField ($METHOD,'vbd_at_id'));


$Vbd_atModel = new Vbd_atModel() ;


$result= $Vbd_atModel->read(['id'=>$vbd_at_id, "by"=>"false"]);

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