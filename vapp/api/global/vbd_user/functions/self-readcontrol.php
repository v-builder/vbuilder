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



if(
    $JSON['rq_fields']['missing']['count']>0
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

    $result= $Vbd_userModel->read(['id'=>$user_id, "by"=>"false"]);

// echo json_encode($result);
    if(isset($result['result'])){

        if($result['result']){
            $JSON['response']['state']=1;
        } else{
            $JSON['response']['state']=0;

        }
        unset($result['data']);
        $JSON['response']['result']=$result;


        if($result['result']){
            // add VBD USER LEVEL LIST

            EngineBuild::BuildProcessor("Vbd_user_level");
            $Vbd_user_levelModel = new Vbd_user_levelModel() ;

            $result= $Vbd_user_levelModel->read(["by"=>"false"]);


            // USP DATA
            $Vbd_user_pdataModel = new Vbd_user_pdataModel() ;

            $resultXY= $Vbd_user_pdataModel->read(['user_id'=>VBD_USER_DATA['user_id'], "by"=>"false"]);


            if($resultXY['rows']>0){
                $JSON['response']['result']['p_data']=$resultXY['data-json'][0];
            }

//            end usp data
            $JSON['response']['result']['user-level-data']=$result['data-json'];

            // end user list
        }

    }
    echo json_encode($JSON);
}



exit;