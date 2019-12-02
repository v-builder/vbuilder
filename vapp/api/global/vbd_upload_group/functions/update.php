<?php
/**
* Created by VBuilder 
* Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Date: 19/10/2019, Saturday
* Time: 10:54 AM
* Project/Module: VB Upload Group*/


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
$JSON['rq_fields']=EngineBuild:: RequiredFields ($METHOD,['upg_id','user_id','upg_date','upg_desc'] );

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




            $upg_id=EngineBuild::GetField ($METHOD,'upg_id');
            $user_id=EngineBuild::GetField ($METHOD,'user_id');
            $upg_date=EngineBuild::GetField ($METHOD,'upg_date');
            $upg_desc=EngineBuild::GetField ($METHOD,'upg_desc');


$Vbd_upload_groupModel = new Vbd_upload_groupModel() ;

    $result= $Vbd_upload_groupModel->update(['upg_id'=> $upg_id,'user_id'=> $user_id,'upg_date'=> $upg_date,'upg_desc'=> $upg_desc]);

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

