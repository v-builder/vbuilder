<?php
/**
* Created by VBuilder 
* Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Date: 27/10/2019, Sunday
* Time: 01:43 PM
* Project/Module: Newsletter Message*/


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
$JSON['rq_fields']=EngineBuild:: RequiredFields ($METHOD,['nsmail_date','ns_id','nsemail_id','ns_state'] );

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

exit;

} else {




            $nsmail_date=EngineBuild::GetField ($METHOD,'nsmail_date');
            $ns_id=EngineBuild::GetField ($METHOD,'ns_id');
            $nsemail_id=EngineBuild::GetField ($METHOD,'nsemail_id');
            $ns_state=EngineBuild::GetField ($METHOD,'ns_state');


$Vbd_ns_mailModel = new Vbd_ns_mailModel() ;

    $result= $Vbd_ns_mailModel->add(['nsmail_date'=> $nsmail_date,'ns_id'=> $ns_id,'nsemail_id'=> $nsemail_id,'ns_state'=> $ns_state]);

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


exit;

}



exit;