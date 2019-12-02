<?php

/**
 * Created by VBuilder
 * Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/
 * Date: 28/08/2019, Wednesday
 * Time: 02:32 PM
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
$JSON['rq_fields']=EngineBuild:: RequiredFields ($METHOD,[] );


if(
    $JSON['rq_fields']['missing']['count']>0
){

    echo json_encode($JSON);
} else {


    $Vbd_userModel = new Vbd_userModel() ;

    $result= $Vbd_userModel->read(["by"=>"false"]);
// $result= $Vbd_userModel->read(["by"=>"true"]);
// $result= $Vbd_userModel->read([]);

// echo json_encode($result);
    if(isset($result['result'])){

        if($result['result']){
            $JSON['response']['state']=1;


        } else{
            $JSON['response']['state']=0;

        }


        unset($result['data']);
        $JSON['response']['result']=$result;




        if($result['result']){
            // add VBD USER LEVEL LIST

            EngineBuild::BuildProcessor("Vbd_user_level");
            $Vbd_user_levelModel = new Vbd_user_levelModel() ;

            $result= $Vbd_user_levelModel->read(["by"=>"false"]);

            $JSON['response']['result']['user-level-data']=$result['data-json'];

            // end user list
        }



    }
    echo json_encode($JSON);
}



exit;