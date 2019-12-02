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
$JSON['rq_fields']=EngineBuild:: RequiredFields ($METHOD,['cr_id','from_user_id','to_user_id','cr_date','cr_date_response','cr_state','cr_response'] );

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




            $cr_id=EngineBuild::GetField ($METHOD,'cr_id');
            $from_user_id=EngineBuild::GetField ($METHOD,'from_user_id');
            $to_user_id=EngineBuild::GetField ($METHOD,'to_user_id');
            $cr_date=EngineBuild::GetField ($METHOD,'cr_date');
            $cr_date_response=EngineBuild::GetField ($METHOD,'cr_date_response');
            $cr_state=EngineBuild::GetField ($METHOD,'cr_state');
            $cr_response=EngineBuild::GetField ($METHOD,'cr_response');


$Connection_requestModel = new Connection_requestModel() ;

    $result= $Connection_requestModel->update(['cr_id'=> $cr_id,'from_user_id'=> $from_user_id,'to_user_id'=> $to_user_id,'cr_date'=> $cr_date,'cr_date_response'=> $cr_date_response,'cr_state'=> $cr_state,'cr_response'=> $cr_response]);

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

