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
$JSON['rq_fields']=EngineBuild:: RequiredFields ($METHOD,['upload_id','vbd_key'] );


if(
    $JSON['rq_fields']['missing']['count']>0
){

    echo json_encode($JSON);
} else {
    // run it

    // run it
    $VSecurity=VSecurity::appSecurity
    (
        [

            'ajax'=>true ,
            'security'=>
                [
                    'enable'=>true,
                    'user'=>[
                        'user_level'=>[
//                        'allowed'=>[1,5]
//                        ,
//                        'denied'=>[1,2,3,4,5]
                        ]

                    ]

                ],

            // if is not ajax
            'on_deny'=> [
//            'redirect'=>VBD_ROOT,
//            'toast_msg'=>'You don\'t have permissions to perform actions in this page. Please log in with an authorized account <a class="vbd-security-error-msg-link" href="'.VBD_ROOT.'"> Home page</a>'
            ]

        ]
    );


    $user_id= VBD_USER_DATA['user_id'];

    $upload_id=trim(EngineBuild:: GetField ($METHOD,'upload_id'));
    $Vbd_uploadModel = new Vbd_uploadModel() ;

    $result= $Vbd_uploadModel->read(['id'=>$upload_id, "by"=>"false"]);



// echo json_encode($result);
    if(isset($result['result'])){

        if($result['result']){

            if($user_id!=$result['data'][0]->getUser_id()){

                $JSON['response']['state']=1920;

            } else{

                $JSON['response']['state']=1;
            }

        } else{
            $JSON['response']['state']=0;

        }

        unset($result['data']);
        $JSON['response']['result']=$result;

    }
    echo json_encode($JSON);
}


exit;