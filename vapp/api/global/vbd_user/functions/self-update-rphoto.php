<?php

/**
 * Created by VBuilder
 * Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/
 * Date: 28/08/2019, Wednesday
 * Time: 02:32 PM
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
$JSON['rq_fields']=EngineBuild:: RequiredFields ($METHOD,['vbd_key'] );


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
} else {



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

    $Vbd_userModel = new Vbd_userModel() ;

    $result= $Vbd_userModel->modelControl(['user_id'=> $user_id,'user_photo'=> null]);
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
}



exit;