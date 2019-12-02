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
$JSON['rq_fields']=EngineBuild:: RequiredFields ($METHOD,['cr_id'] );


if(
    $JSON['rq_fields']['missing']['count']>0
){

    echo json_encode($JSON);

exit;

} else {




$cr_id=trim(EngineBuild:: GetField ($METHOD,'cr_id'));


$Connection_requestModel = new Connection_requestModel() ;


$result= $Connection_requestModel->deleteControl(['cr_id'=>$cr_id, "condition"=>"true"]);

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