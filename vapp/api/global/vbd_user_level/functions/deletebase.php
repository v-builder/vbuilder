<?php

/**
 * Created by VBuilder
 * Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/
 * Date: 28/08/2019, Wednesday
 * Time: 01:15 PM
 */



/* >> ON VALIDATION
0 ERROR
1 SUCCESS

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
$JSON['rq_fields']=EngineBuild:: RequiredFields ($METHOD,['ulevel_id'] );


if(
    $JSON['rq_fields']['missing']['count']>0
){

    echo json_encode($JSON);
} else {

    $ulevel_id=trim(EngineBuild:: GetField ($METHOD,'ulevel_id'));
    $Vbd_user_levelModel = new Vbd_user_levelModel() ;

    $result= $Vbd_user_levelModel->deleteBase($ulevel_id);

// echo json_encode($result);
    if(isset($result['result'])){

        if($result['result']){
            $JSON['response']['state']=1;
        } else{
            $JSON['response']['state']=0;

        }
        $JSON['response']['result']=$result;

    }
    echo json_encode($JSON);
}


exit;