<?php

/**
 * Created by VBuilder
 * Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/
 * Date: 05/09/2019, Thursday
 * Time: 01:27 AM
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
$JSON['rq_fields']=EngineBuild:: RequiredFields ($METHOD,['upload_id','upload_date','upload_privacy','file_type','file_path','file_name','file_ext','file_size','user_id'] );


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
    exit;
} else {

    $upload_id=EngineBuild::GetField ($METHOD,'upload_id');
    $upload_date=EngineBuild::GetField ($METHOD,'upload_date');
    $upload_privacy=EngineBuild::GetField ($METHOD,'upload_privacy');
    $file_type=EngineBuild::GetField ($METHOD,'file_type');
    $file_path=EngineBuild::GetField ($METHOD,'file_path');
    $file_name=EngineBuild::GetField ($METHOD,'file_name');
    $file_ext=EngineBuild::GetField ($METHOD,'file_ext');
    $file_size=EngineBuild::GetField ($METHOD,'file_size');
    $user_id=EngineBuild::GetField ($METHOD,'user_id');

    $Vbd_uploadModel = new Vbd_uploadModel() ;

    $result= $Vbd_uploadModel->modelControl(['upload_id'=> $upload_id,'upload_date'=> $upload_date,'upload_privacy'=> $upload_privacy,'file_type'=> $file_type,'file_path'=> $file_path,'file_name'=> $file_name,'file_ext'=> $file_ext,'file_size'=> $file_size,'user_id'=> $user_id]);

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
    exit;
}


exit;