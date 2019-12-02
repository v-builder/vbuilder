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
$JSON['rq_fields']=EngineBuild:: RequiredFields ($METHOD,[] );



if(
    $JSON['rq_fields']['missing']['count']>0
){
    echo json_encode($JSON);
} else {

    $user_name=strtolower(trim(EngineBuild::GetField ($METHOD,'user_name')));

    $vbd_key=strtolower(trim(EngineBuild::GetField ($METHOD,'vbd_key')));



    $Vbd_userModel = new Vbd_userModel() ;

    $result= $Vbd_userModel->read(['user_name'=>$user_name, "by"=>"false"]);
    $resultData= $result['data'];
    $userID=0;


    $finalUDATA=$result['data-json'];

// echo json_encode($result);
    if(isset($result['result'])&& $result['rows']>0){

        $userID=$result['data'][0]->getUser_id();

        if($result['result']){
            $JSON['response']['state']=1;
        } else{
            $JSON['response']['state']=0;

        }



        if($vbd_key!='null'){

            // run it
            $VSecurity=VSecurity::appSecurity
            (
                ['ajax'=>false ,
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
                    'on_deny'=> [ ]
                ]
            );

            if($VSecurity['response']['state']==1){

                $finalUDATA=[];
                $from_user_id=VBD_USER_DATA['user_id'];
                $Connection_requestModel = new Connection_requestModel() ;
                $resultY= $Connection_requestModel->read(["by"=>"false"]);

                foreach ($result['data'] as $k=>$v){
                    $vTemp=[
                        'user_id'=>$v->getUser_id(),
                        'ulevel_id'=>$v->getUlevel_id(),
                        'user_rn'=>$v->getUser_rn(),
                        'user_photo'=>$v->getUser_photo(),
                        'user_idate'=>$v->getUser_idate(),
                        'user_name'=>$v->getUser_name(),
                        'user_email'=>$v->getUser_email(),
                        'user_state'=>$v->getUser_state(),
                        'user_email_conf'=>$v->getUser_email_conf(),
                        'deleted'=>$v->getDeleted(),
                        ];

                    $vTemp['found_cr']='false';
                    foreach ($resultY['data'] as $k2=>$v2){
                        if($from_user_id==$v2->getFrom_user_id() && $v->getUser_id()==$v2->getTo_user_id()){
                            $vTemp['found_cr']='true';
                            $vTemp['cr_data']=json_encode($v2);

                            break;
                        }
                        // and foreach one
                    }
                    $finalUDATA[]=json_encode($vTemp);
                    // and foreach two
                }

            }

        }


        unset($result['data']);
        $JSON['response']['result']=$result;
        $JSON['response']['result']['data-json']=$finalUDATA;


        if($result['result']){
            // add VBD USER LEVEL LIST

            EngineBuild::BuildProcessor("Vbd_user_level");
            $Vbd_user_levelModel = new Vbd_user_levelModel() ;

            $result= $Vbd_user_levelModel->read(["by"=>"false"]);


            // USP DATA
            $Vbd_user_pdataModel = new Vbd_user_pdataModel() ;

            $resultXY= $Vbd_user_pdataModel->read(['user_id'=> $userID, "by"=>"false"]);


            $JSON['response']['result']['p_data']=$resultXY['data-json'][0];

//            end usp data
            $JSON['response']['result']['user-level-data']=$result['data-json'];

            // end user list
        }

    }
    echo json_encode($JSON);
}



exit;