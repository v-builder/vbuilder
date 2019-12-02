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

// 1011 check password
// 1012 user name exists
// 1013 user email exists

$METHOD="post";
$JSON['response']['state']=0;
$METHOD= strtolower($METHOD);
$METHOD=trim($METHOD);
//CHECK FOR REQUIRED FIELDS
$JSON['rq_fields']=EngineBuild:: RequiredFields ($METHOD,['user_password_c','user_rn','ulevel_id','user_name','user_email','user_password'] );


// VALIDATE THE FIELDS
$JSON['validate']= EngineBuild:: ValidateFields ($METHOD,
// Define if you want validation activated
    true,
    [
// select the fields and requests
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
    exit;
} else {

    $cur_date_time= date("d/m/Y").", ".date("l")." ".date("h:i")." ".strtoupper(date('a'));
    $ulevel_id=EngineBuild::GetField ($METHOD,'ulevel_id');
    $user_rn=ucwords(strtolower(ltrim(rtrim(EngineBuild::GetField ($METHOD,'user_rn')))));
    $user_idate=$cur_date_time;
    $user_name=strtolower(trim(EngineBuild::GetField ($METHOD,'user_name')));
    $user_email=strtolower(trim(EngineBuild::GetField ($METHOD,'user_email')));
    $user_password=EngineBuild::GetField ($METHOD,'user_password');
    $user_password_c=EngineBuild::GetField ($METHOD,'user_password_c');
    $user_state='1';

    $user_password=ltrim(rtrim($user_password));
    $user_password_c=ltrim(rtrim($user_password_c));

    // check password
    if($user_password!=$user_password_c)
    {
        $JSON['response']['state']=1011;
        echo json_encode($JSON);
        exit;

    }


    $Vbd_userModel = new Vbd_userModel() ;
    //    $resultUser= $Vbd_userModel->read(["by"=>"false"])['data'];
    $resultUser= $Vbd_userModel->read([])['data'];
    // check username and email existence
    foreach ($resultUser as $kx => $vx){
//        $Vbd_user= new Vbd_user();

       if($vx->getUser_name()==$user_name){
           $JSON['response']['state']=1012;
           echo json_encode($JSON);
           exit;
       }
       if($vx->getUser_email()==$user_email){
           $JSON['response']['state']=1013;
           echo json_encode($JSON);
           exit;
       }

    }


    $user_password=jwtEncode($user_password);



    $result= $Vbd_userModel->add(['ulevel_id'=> $ulevel_id,'usp_id'=>null,'user_rid'=>randomString(11), 'user_rn'=> $user_rn,'user_idate'=> $user_idate,'user_name'=> $user_name,'user_email'=> $user_email,'user_password'=> $user_password,'user_state'=> $user_state]);

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