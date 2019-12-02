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
$JSON['rq_fields']=EngineBuild:: RequiredFields ($METHOD,['rp_id','rp_email','user_id','rp_code','rp_date','rp_date_exp','rp_state'] );

// VALIDATE THE FIELDS
$JSON['validate']= EngineBuild:: ValidateFields ($METHOD,
//        Define if you want validation activated
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




            $rp_id=EngineBuild::GetField ($METHOD,'rp_id');
            $rp_email=EngineBuild::GetField ($METHOD,'rp_email');
            $user_id=EngineBuild::GetField ($METHOD,'user_id');
            $rp_code=EngineBuild::GetField ($METHOD,'rp_code');
            $rp_date=EngineBuild::GetField ($METHOD,'rp_date');
            $rp_date_exp=EngineBuild::GetField ($METHOD,'rp_date_exp');
            $rp_state=EngineBuild::GetField ($METHOD,'rp_state');


$Vbd_rpModel = new Vbd_rpModel() ;

    $result= $Vbd_rpModel->update(['rp_id'=> $rp_id,'rp_email'=> $rp_email,'user_id'=> $user_id,'rp_code'=> $rp_code,'rp_date'=> $rp_date,'rp_date_exp'=> $rp_date_exp,'rp_state'=> $rp_state]);

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



}


exit;

