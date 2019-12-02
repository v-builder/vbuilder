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
$JSON['rq_fields']=EngineBuild:: RequiredFields ($METHOD,['user_id','ulevel_id','user_rn','user_idate','user_name','user_email','user_password','user_state'] );


// VALIDATE THE FIELDS
$JSON['validate']= EngineBuild:: ValidateFields ($METHOD,
// Define if you want validation activated
    false,
    [
// select the fields and requests
        'email'=>['type'=>"email"],
        'name'=>['min'=>3,"max"=>10, "type"=>"nospace" ],
        "phone"=>['length'=>9]
    ] );

if(
    $JSON['rq_fields']['missing']['count']>0
    || !$JSON['validate']['state']
){

    echo json_encode($JSON);
} else {

    $user_id=EngineBuild::GetField ($METHOD,'user_id');
    $ulevel_id=EngineBuild::GetField ($METHOD,'ulevel_id');
    $user_rn=EngineBuild::GetField ($METHOD,'user_rn');
    $user_idate=EngineBuild::GetField ($METHOD,'user_idate');
    $user_name=EngineBuild::GetField ($METHOD,'user_name');
    $user_email=EngineBuild::GetField ($METHOD,'user_email');
    $user_password=EngineBuild::GetField ($METHOD,'user_password');
    $user_state=EngineBuild::GetField ($METHOD,'user_state');

    $Vbd_userModel = new Vbd_userModel() ;

    $result= $Vbd_userModel->modelControl(['user_id'=> $user_id,'ulevel_id'=> $ulevel_id,'user_rn'=> $user_rn,'user_idate'=> $user_idate,'user_name'=> $user_name,'user_email'=> $user_email,'user_password'=> $user_password,'user_state'=> $user_state]);
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