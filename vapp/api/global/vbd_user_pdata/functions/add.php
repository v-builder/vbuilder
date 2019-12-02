<?php
/**
* Created by VBuilder 
* Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Date: 17/09/2019, Tuesday
* Time: 12:35 PM
* Project/Module: Personal Data*/


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
$JSON['rq_fields']=EngineBuild:: RequiredFields ($METHOD,['vbd_at_id','usp_label_value','usp_type_value','user_bdate','phone_code','phone_number','phone_number_alt','phone_shown','gender','about','bio'] );

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




            $vbd_at_id=EngineBuild::GetField ($METHOD,'vbd_at_id');
            $usp_label_value=EngineBuild::GetField ($METHOD,'usp_label_value');
            $usp_type_value=EngineBuild::GetField ($METHOD,'usp_type_value');
            $user_bdate=EngineBuild::GetField ($METHOD,'user_bdate');
            $phone_code=EngineBuild::GetField ($METHOD,'phone_code');
            $phone_number=EngineBuild::GetField ($METHOD,'phone_number');
            $phone_number_alt=EngineBuild::GetField ($METHOD,'phone_number_alt');
            $phone_shown=EngineBuild::GetField ($METHOD,'phone_shown');
            $gender=EngineBuild::GetField ($METHOD,'gender');
            $about=EngineBuild::GetField ($METHOD,'about');
            $bio=EngineBuild::GetField ($METHOD,'bio');


$Vbd_user_pdataModel = new Vbd_user_pdataModel() ;

    $result= $Vbd_user_pdataModel->add(['vbd_at_id'=> $vbd_at_id,'usp_label_value'=> $usp_label_value,'usp_type_value'=> $usp_type_value,'user_bdate'=> $user_bdate,'phone_code'=> $phone_code,'phone_number'=> $phone_number,'phone_number_alt'=> $phone_number_alt,'phone_shown'=> $phone_shown,'gender'=> $gender,'about'=> $about,'bio'=> $bio]);

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