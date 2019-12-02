<?php
/**
* Created by VBuilder 
* Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Date: 18/09/2019, Wednesday
* Time: 08:35 PM
* Project/Module: Connection Action*/


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
$JSON['rq_fields']=EngineBuild:: RequiredFields ($METHOD,['vbd_key'] );


if(
    $JSON['rq_fields']['missing']['count']>0
){

    echo json_encode($JSON);

exit;

} else {



$from_user_id=VBD_USER_DATA['user_id'];

    $to_user_id=EngineBuild::GetField ($METHOD,'to_user_id');

$cr_id=0;



// check this connection


    $vTemp=[];

    $Connection_requestModel = new Connection_requestModel() ;
    $resultY= $Connection_requestModel->read(["by"=>"false"]);

    $vTemp['found_cr']='false';
    foreach ($resultY['data'] as $k2=>$v2){
        if($from_user_id==$v2->getFrom_user_id() || $to_user_id==$v2->getTo_user_id()){
            $vTemp['found_cr']='true';
            $vTemp['cr_data']=json_encode($v2);
            $cr_id=$v2->getCr_id();
            break;
        }
        // and foreach one
    }

// Enf of: check this connection
if($vTemp['found_cr']=='false'){

    $JSON['response']['state']=2;
    echo json_encode($JSON);
    exit;

}











$Connection_requestModel = new Connection_requestModel() ;


$result= $Connection_requestModel->deleteBase($cr_id);

//    echo json_encode($result);

    if(isset($result['result'])){

        if($result['result']){
            $JSON['response']['state']=1;
        } else{
            $JSON['response']['state']=0;

        }
        $JSON['response']['result']=$result;

    }


    echo json_encode($JSON);

exit;

}




exit;