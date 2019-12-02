<?php
/**
* Created by VBuilder 
* Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Date: 07/09/2019, Saturday
* Time: 02:59 AM
* Project/Module: Password Reset*/


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
$JSON['rq_fields']=EngineBuild:: RequiredFields ($METHOD,['rp_id'] );


if(
    $JSON['rq_fields']['missing']['count']>0
){

    echo json_encode($JSON);

exit;

} else {




$rp_id=trim(EngineBuild:: GetField ($METHOD,'rp_id'));


$Vbd_rpModel = new Vbd_rpModel() ;


$result= $Vbd_rpModel->deleteBase($rp_id);

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