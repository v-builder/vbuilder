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
$JSON['rq_fields']=EngineBuild:: RequiredFields ($METHOD,['ns_subject','ns_body','ns_altbody','ns_cleanbody'] );

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




            $ns_id=EngineBuild::GetField ($METHOD,'ns_id');
            $ns_subject=EngineBuild::GetField ($METHOD,'ns_subject');
            $ns_body=EngineBuild::GetField ($METHOD,'ns_body');
            $ns_altbody=EngineBuild::GetField ($METHOD,'ns_altbody');
            $ns_cleanbody=EngineBuild::GetField ($METHOD,'ns_cleanbody');


$Vbd_newsletterModel = new Vbd_newsletterModel();

    $result= $Vbd_newsletterModel->modelControl(['ns_id'=> $ns_id,'ns_subject'=> $ns_subject,'ns_body'=> $ns_body,'ns_altbody'=> $ns_altbody,'ns_cleanbody'=> $ns_cleanbody]);

//    echo json_encode($result);

    if(isset($result['result'])){

        if($result['result']){
            $JSON['response']['state']=1;
    //if isset upload file> ns_attach 
    $keySearchTmp='ns_attach';

    if(is_uploaded_file($_FILES[$keySearchTmp]["tmp_name"][0])){
     $resultTmp= $Vbd_newsletterModel->read(['id'=>$ns_id, "by"=>"false"]);
    
    // $arrTmp['key'=>'key_name', 'upg_id'=> 0 , 'user_id'=>0 ]
    $updVbdResult= vbdUploadHelper(['key'=>$keySearchTmp, 'upg_id'=> $resultTmp['data'][0]->getNs_attach(), 'user_id'=>VBD_USER_DATA['user_id'] ]);
    
    if($updVbdResult['state']!=1){
    // error uploading
    $JSON['response']['state']=0;
    }

    }
    //endof if isset upload file
    //if isset upload file> ns_cover 
    $keySearchTmp='ns_cover';

    if(is_uploaded_file($_FILES[$keySearchTmp]["tmp_name"][0])){
     $resultTmp= $Vbd_newsletterModel->read(['id'=>$ns_id, "by"=>"false"]);
    
    // $arrTmp['key'=>'key_name', 'upg_id'=> 0 , 'user_id'=>0 ]
    $updVbdResult= vbdUploadHelper(['key'=>$keySearchTmp, 'upg_id'=> $resultTmp['data'][0]->getNs_cover(), 'user_id'=>VBD_USER_DATA['user_id'] ]);
    
    if($updVbdResult['state']!=1){
    // error uploading
    $JSON['response']['state']=0;
    }

    }
    //endof if isset upload file
    //if isset upload file> ns_pdf 
    $keySearchTmp='ns_pdf';

    if(is_uploaded_file($_FILES[$keySearchTmp]["tmp_name"][0])){
     $resultTmp= $Vbd_newsletterModel->read(['id'=>$ns_id, "by"=>"false"]);
    
    // $arrTmp['key'=>'key_name', 'upg_id'=> 0 , 'user_id'=>0 ]
    $updVbdResult= vbdUploadHelper(['key'=>$keySearchTmp, 'upg_id'=> $resultTmp['data'][0]->getNs_pdf(), 'user_id'=>VBD_USER_DATA['user_id'] ]);

    var_dump($updVbdResult);
    if($updVbdResult['state']!=1){
    // error uploading
    $JSON['response']['state']=0;
    }

    }
    //endof if isset upload file

        } else{
            $JSON['response']['state']=0;

        }
        $JSON['response']['result']=$result;

    }


    echo json_encode($JSON);



}


exit;

