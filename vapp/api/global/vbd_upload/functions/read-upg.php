<?php

/**
 * Created by VBuilder
 * Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/
 * Date: 05/09/2019, Thursday
 * Time: 01:27 AM
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
$JSON['rq_fields']=EngineBuild:: RequiredFields ($METHOD,['upg_id'] );


if(
    $JSON['rq_fields']['missing']['count']>0
){

    echo json_encode($JSON);
} else {


    $Vbd_uploadModel = new Vbd_uploadModel() ;

    $upg_id=trim(EngineBuild:: GetField ($METHOD,'upg_id'));

    $result= $Vbd_uploadModel->read(["upg_id"=>$upg_id]);
// $result= $Vbd_uploadModel->read(["by"=>"true"]);
// $result= $Vbd_uploadModel->read([]);

// echo json_encode($result);
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