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
$JSON['rq_fields']=EngineBuild:: RequiredFields ($METHOD,['ulevel_id','user_id'] );

// VALIDATE THE FIELDS
$JSON['validate']= EngineBuild:: ValidateFields ($METHOD,
// Define if you want validation activated
    true,
    [
// select the fields and requests
        'user_id'=>['min'=>1,"max"=>20 ],
        'ulevel_id'=>['min'=>1,"max"=>20 ],
        'user_email'=>['type'=>"email", 'min'=>2,"max"=>50 ],
        'user_rn'=>['min'=>2,"max"=>50],
        'user_name'=>['min'=>3,"max"=>20, "type"=>"nospace"],
        'password'=>['min'=>6]
    ] );

if(
    $JSON['rq_fields']['missing']['count']>0
    || !$JSON['validate']['state']
){

    echo json_encode($JSON);
} else {

    $user_id=EngineBuild::GetField ($METHOD,'user_id');
    $ulevel_id=EngineBuild::GetField ($METHOD,'ulevel_id');
//    $user_rn=ucwords(strtolower(ltrim(rtrim(EngineBuild::GetField ($METHOD,'user_rn')))));
    //    $user_idate=EngineBuild::GetField ($METHOD,'user_idate');
//    $user_name=strtolower(trim(EngineBuild::GetField ($METHOD,'user_name')));
//    $user_email=strtolower(trim(EngineBuild::GetField ($METHOD,'user_email')));
    /* $user_password=EngineBuild::GetField ($METHOD,'user_password');
      $user_state=EngineBuild::GetField ($METHOD,'user_state');*/



    $Vbd_userModel = new Vbd_userModel() ;

    $resultX= $Vbd_userModel->read(['id'=>$user_id, "by"=>"false"])['data'][0];
    $ulevel_idX=$resultX->getUlevel_id();
    if(VBD_USER_DATA['ulevel_id']>=$ulevel_idX){
        // can not edit a userin the same or higher level
        $JSON['response']['state']=1616;
    } else{
    $result= $Vbd_userModel->modelControl(['user_id'=> $user_id,'ulevel_id'=> $ulevel_id]);
// echo json_encode($result);
    if(isset($result['result'])){

        if($result['result']){
            $JSON['response']['state']=1;
        } else{
            $JSON['response']['state']=0;

        }
        $JSON['response']['result']=$result;

    }
    }
    echo json_encode($JSON);
}


exit;