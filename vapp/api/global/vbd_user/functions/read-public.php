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

    $vbd_key=strtolower(trim(EngineBuild::GetField ($METHOD,'vbd_key')));


    $Vbd_userModel = new Vbd_userModel() ;

    $result= $Vbd_userModel->readPublic();
// $result= $Vbd_userModel->read(["by"=>"true"]);
// $result= $Vbd_userModel->read([]);

     $finalUDATA=$result['data-json'];
// echo json_encode($result);
    if(isset($result['result'])){

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

            $Connection_requestModel = new Connection_requestModel() ;
            $resultY= $Connection_requestModel->read(["by"=>"false"]);

            if($VSecurity['response']['state']==1){
                $finalUDATA=[];

                $from_user_id=VBD_USER_DATA['user_id'];



                foreach ($result['data'] as $k=>$v){
                    $vTemp=$v;

                    $vTemp['found_cr']='false';
                foreach ($resultY['data'] as $k2=>$v2){
                    if($from_user_id==$v2->getFrom_user_id() && $v['user_id']==$v2->getTo_user_id()){
                        $vTemp['found_cr']='true';
                        $vTemp['cr_data']=json_encode($v2);

break;
                    }
                    // and foreach one
            }
                    $finalUDATA[]=json_encode($vTemp);
                    // and foreach two
            }

            } else {
                $finalUDATA=[];

                foreach ($result['data'] as $k=>$v){

                    $vTemp=$v;

                    $vTemp['found_cr']='false';
                    $vTemp['cr_data']=json_encode([]);

                    $finalUDATA[]=json_encode($vTemp);
                    // and foreach two
                }


            }

        }



        $JSON['response']['result']=$result;
        unset($result['data']);
        $JSON['response']['result']['data-json']=$finalUDATA;



        if($result['result']){
            // add VBD USER LEVEL LIST

            EngineBuild::BuildProcessor("Vbd_user_level");
            $Vbd_user_levelModel = new Vbd_user_levelModel() ;

            $result= $Vbd_user_levelModel->read(["by"=>"false"]);

            $JSON['response']['result']['user-level-data']=$result['data-json'];

            // end user list
        }



    }
    echo json_encode($JSON);
}



exit;