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
$JSON['rq_fields']=EngineBuild:: RequiredFields ($METHOD,['stepA','stepB','stepC','stepD'] );



if(
    $JSON['rq_fields']['missing']['count']>0
){
    echo json_encode($JSON);
} else {

    $user_id=cryptThisVbuilder(EngineBuild::GetField ($METHOD,'stepA'))['d'];
    $user_email=cryptThisVbuilder(EngineBuild::GetField ($METHOD,'stepB'))['d'];
    $user_level_id=cryptThisVbuilder(EngineBuild::GetField ($METHOD,'stepC'))['d'];
    $userRID=cryptThisVbuilder(EngineBuild::GetField ($METHOD,'stepD'))['d'];

    $Vbd_userModel = new Vbd_userModel() ;

    $result= $Vbd_userModel->read(['id'=>$user_id, "by"=>"false"]);

    if(isset($result['result'])){

        if($result['result']){

            $resultX= $result['data'][0];
            $ulevel_idX=$resultX->getUlevel_id();
            $user_rid=$resultX->getUser_rid();
            $emailX=$resultX->getUser_email();
            $email_confX=$resultX->getUser_email_conf();

            if($email_confX=='true'){
              // account has already been verified
              $JSON['response']['state']=11;
          } else{


              if($user_email==$emailX && $user_level_id==$ulevel_idX && $user_rid==$userRID){

                  $resultB= $Vbd_userModel->modelControl(['user_id'=> $user_id,'user_rid'=>randomString(11),'user_email_conf'=> 'true']);
// echo json_encode($result);
                  if(isset($resultB['result'])){

                      if($resultB['result']){
                          $JSON['response']['state']=1;
                      } else{
                          $JSON['response']['state']=0;

                      }

                  }

              }
          }

    } else{
            $JSON['response']['state']=0;
        }

        unset($result['data']);
        $JSON['response']['result']=$result;

    }

    echo json_encode($JSON);
}



exit;