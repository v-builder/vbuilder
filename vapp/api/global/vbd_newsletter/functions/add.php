<?php
/**
* Created by VBuilder 
* Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Date: 27/10/2019, Sunday
* Time: 01:41 PM
* Project/Module: Newsletter*/


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
$JSON['rq_fields']=EngineBuild:: RequiredFields ($METHOD,['ns_subject','ns_body','ns_altbody','ns_cleanbody','ns_attach','ns_cover','ns_pdf'] );

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




            $ns_date=date('Y-m-d H:i:s');
            $ns_subject=EngineBuild::GetField ($METHOD,'ns_subject');
            $ns_body=EngineBuild::GetField ($METHOD,'ns_body');
            $ns_altbody=EngineBuild::GetField ($METHOD,'ns_altbody');
            $ns_cleanbody=EngineBuild::GetField ($METHOD,'ns_cleanbody');
            $ns_attach=EngineBuild::GetField ($METHOD,'ns_attach');
            $user_id=VBD_USER_DATA['user_id'];
            $ns_cover=EngineBuild::GetField ($METHOD,'ns_cover');
            $ns_pdf=EngineBuild::GetField ($METHOD,'ns_pdf');


$Vbd_newsletterModel = new Vbd_newsletterModel() ;

    $result= $Vbd_newsletterModel->add(['ns_date'=> $ns_date,'ns_subject'=> $ns_subject,'ns_body'=> $ns_body,'ns_altbody'=> $ns_altbody,'ns_cleanbody'=> $ns_cleanbody,'ns_attach'=> $ns_attach,'user_id'=> $user_id,'ns_cover'=> $ns_cover,'ns_pdf'=> $ns_pdf]);

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