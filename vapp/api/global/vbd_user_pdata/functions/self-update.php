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
$VSecurity=VSecurity::appSecurity
(
    [
        'ajax'=>true ,
        'security'=>
            [
                'enable'=>true,
                'user'=>[
                    'user_level'=>[
//                        'allowed'=>[1,2]
                        //,
                        //'denied'=>[1,2,3,4,5]
                    ]
                ]
            ]
    ]
);

$METHOD="post";

$JSON['response']['state']=0;
$METHOD= strtolower($METHOD);
$METHOD=trim($METHOD);
//CHECK FOR REQUIRED FIELDS
$JSON['rq_fields']=EngineBuild:: RequiredFields ($METHOD,[] );

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

    $usp_id=null;

    $vbd_at_id=(int)EngineBuild::GetFieldNl ($METHOD,'vbd_at_id');
    $usp_label_value=ucfirst(EngineBuild::GetFieldNl ($METHOD,'usp_label_value'));
    $usp_type_value=ucfirst(EngineBuild::GetFieldNl ($METHOD,'usp_type_value'));
    $user_bdate=EngineBuild::GetFieldNl ($METHOD,'user_bdate');
    $phone_code=EngineBuild::GetFieldNl ($METHOD,'phone_code');
    $phone_number=EngineBuild::GetFieldNl ($METHOD,'phone_number');
    $phone_number_alt=EngineBuild::GetFieldNl ($METHOD,'phone_number_alt');
    $phone_shown=EngineBuild::GetFieldNl ($METHOD,'phone_shown');
    $gender=EngineBuild::GetFieldNl ($METHOD,'gender');
    $about=EngineBuild::GetFieldNl ($METHOD,'about');
    $bio=EngineBuild::GetFieldNl ($METHOD,'bio');


    $Vbd_user_pdataModel = new Vbd_user_pdataModel() ;


    $resultX= $Vbd_user_pdataModel->read(['user_id'=>VBD_USER_DATA['user_id'], "by"=>"false"]);

    if($resultX['rows']>0){
        $usp_id= $resultX['data'][0]->getUsp_id();
    }


    if($usp_id!=null){

    $result= $Vbd_user_pdataModel->update(['usp_id'=> $usp_id,'vbd_at_id'=> $vbd_at_id,'usp_label_value'=> $usp_label_value,'usp_type_value'=> $usp_type_value,'user_bdate'=> $user_bdate,'phone_code'=> $phone_code,'phone_number'=> $phone_number,'phone_number_alt'=> $phone_number_alt,'phone_shown'=> $phone_shown,'gender'=> $gender,'about'=> $about,'bio'=> $bio]);

//    echo json_encode($result);

    if(isset($result['result'])){

        if($result['result']){
            $JSON['response']['state']=1;
        } else{
            $JSON['response']['state']=0;

        }
        $JSON['response']['result']=$result;

    }


    }

    echo json_encode($JSON);



}


exit;

