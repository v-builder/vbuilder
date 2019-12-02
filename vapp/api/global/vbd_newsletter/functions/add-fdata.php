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

EngineBuild::BuildBindingProcessorScope( PATH_TO_VBD."config/Email.php");

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

exit;

} else {


//$user_id= 0;
$user_id= VBD_USER_DATA['user_id'];




            $ns_date=date('Y-m-d H:i:s');
            $ns_subject=EngineBuild::GetField ($METHOD,'ns_subject');
            $ns_body=EngineBuild::GetField ($METHOD,'ns_body');
            $ns_altbody=EngineBuild::GetField ($METHOD,'ns_altbody');
            $ns_cleanbody=EngineBuild::GetField ($METHOD,'ns_cleanbody');


    $Vbd_newsletterModel = new Vbd_newsletterModel() ;


//    start off send ns_attach ----------------------------------
//    $Vbd_nsemailModel = new Vbd_nsemailModel() ;
//    $resultEMAILSDATA= $Vbd_nsemailModel->read(["by"=>"false"]);
//    $resultEMAILSDATA_Final=[];


        // file ns_attach ----------------------------------------------------------------

        $UPLOAD_RS_NS_ATTACH=upd_ns_attach($user_id);

        $jsonUP['count_files']=$UPLOAD_RS_NS_ATTACH['count_files'];
        $jsonUP['count_success']=$UPLOAD_RS_NS_ATTACH['count_success'];
        $upd_resultS=$UPLOAD_RS_NS_ATTACH['results'];
        $upd_result=$UPLOAD_RS_NS_ATTACH['result'];

        // endof file ----------------------------------------------------------------
        
        // file ns_cover ----------------------------------------------------------------

        $UPLOAD_RS_NS_COVER=upd_ns_cover($user_id);

        $jsonUP['count_files']=$UPLOAD_RS_NS_COVER['count_files'];
        $jsonUP['count_success']=$UPLOAD_RS_NS_COVER['count_success'];
        $upd_resultS=$UPLOAD_RS_NS_COVER['results'];
        $upd_result=$UPLOAD_RS_NS_COVER['result'];

        // endof file ----------------------------------------------------------------
        
        // file ns_pdf ----------------------------------------------------------------

        $UPLOAD_RS_NS_PDF=upd_ns_pdf($user_id);

        $jsonUP['count_files']=$UPLOAD_RS_NS_PDF['count_files'];
        $jsonUP['count_success']=$UPLOAD_RS_NS_PDF['count_success'];
        $upd_resultS=$UPLOAD_RS_NS_PDF['results'];
        $upd_result=$UPLOAD_RS_NS_PDF['result'];

        // endof file ----------------------------------------------------------------



if($jsonUP['count_files']==$jsonUP['count_success']){



$result= $Vbd_newsletterModel->add(['ns_date'=> $ns_date,'ns_subject'=> $ns_subject,'ns_body'=> $ns_body,'ns_altbody'=> $ns_altbody,'ns_cleanbody'=> $ns_cleanbody,'ns_attach'=> $UPLOAD_RS_NS_ATTACH['result']['data'],'user_id'=> $user_id,'ns_cover'=> $UPLOAD_RS_NS_COVER['result']['data'],'ns_pdf'=> $UPLOAD_RS_NS_PDF['result']['data']]);


if($result['result']){
$JSON['response']['state']=1;
// send emails --------------------------------------------------
//    {}
// endof send emails --------------------------------------------

} else{
$JSON['response']['state']=0;

}
$JSON['response']['result']=$upd_result;
$JSON['response']['results']=$upd_resultS;

}




    echo json_encode($JSON);


exit;

}



exit;