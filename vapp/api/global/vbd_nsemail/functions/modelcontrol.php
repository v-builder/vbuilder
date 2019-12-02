<?php
/**
* Created by VBuilder 
* Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Date: 27/10/2019, Sunday
* Time: 12:05 PM
* Project/Module: Newsletter Email*/


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
$JSON['rq_fields']=EngineBuild:: RequiredFields ($METHOD,['nsemail_id','nsemail_name','nsemail_email','nsemail_date'] );

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




            $nsemail_id=EngineBuild::GetField ($METHOD,'nsemail_id');
            $nsemail_name=EngineBuild::GetField ($METHOD,'nsemail_name');
            $nsemail_email=EngineBuild::GetField ($METHOD,'nsemail_email');
            $nsemail_date=EngineBuild::GetField ($METHOD,'nsemail_date');


$Vbd_nsemailModel = new Vbd_nsemailModel() ;

    $result= $Vbd_nsemailModel->modelControl(['nsemail_id'=> $nsemail_id,'nsemail_name'=> $nsemail_name,'nsemail_email'=> $nsemail_email,'nsemail_date'=> $nsemail_date]);

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