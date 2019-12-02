<?php
header('Content-Type: application/json');

/* >> ON VALIDATION

>> VALIDATED
0 ERROR
1 SUCCESS
2 DATA INSERTED ALREADY PRESENT
*/

require_once "../base.php";

EngineBuild::Database();
EngineBuild::BuildProcessor("Vbd_user");
EngineBuild::BuildProcessor("Vbd_log_track");

vbdIncludeJWT();

$gatheredData=array();
$log_track_mng=array();
$user_data_all=[];
$app_userModel = new Vbd_userModel() ;
$dataapp_user= $app_userModel->read(['by'=>'false']);

rsort($dataapp_user['data']);


$METHOD="post";
$JSON['response']['state']=0;
$METHOD= strtolower($METHOD);
$METHOD=trim($METHOD);
//CHECK FOR REQUIRED FIELDS

$JSON['rq_fields']=EngineBuild:: RequiredFields ($METHOD,['vbd_key'] );


// VALIDATE THE FIELDS
$JSON['validate']= EngineBuild:: ValidateFields ($METHOD,
// Define if you want validation activated
    true,
    [
// select the fields and requests
        'vbd_key'=>[ 'min'=>20],
        'user_email'=>['type'=>"email", 'min'=>2,"max"=>50 ],
        'user_name'=>['min'=>3,"max"=>20],
        'password'=>['min'=>6]
    ] );

if(
    $JSON['rq_fields']['missing']['count']>0
    || !$JSON['validate']['state']
){

    echo json_encode($JSON);
} else {


    // CHECK KEY

    /*vbd_key_state
    401 Token/vbd_key is invalid
402 Token/vbd_key expired
403 An error have ocurred
4040 Warning Token/vbd_key Token is not allowed
404 Error Token/vbd_key Token is not allowed
701 User doesnt exist
702 User Rn is incorrect
703 Wrong Agent Data provided
704 Wrong Random Data provided

705 Log Id error [ not found/wrong user id]
706 Log Id error [ vbd_key doesn't match] */


    $vbd_key=EngineBuild::GetField ($METHOD,'vbd_key');

    $allowed_process=false;
    $allow_token=false;

    if(is_valid_vbd_key($vbd_key)){
        $allowed_process=true;
    } else{

        //
        $JSON['response']['state']=0;
        $vbd_key_response['vbd_key_state']=401;
    }

    if($allowed_process){


        $app_log_trackModel= new Vbd_log_trackModel();
        $dataapp_log_track=$app_log_trackModel->read(["by"=>"false"]);
        rsort($dataapp_log_track['data']);


        $keyEncryptionData=JWT::jsonDecode($vbd_key);
        $keyEncryptionGuide=vbd_key_app_retrieveGuide($keyEncryptionData);

        if($keyEncryptionGuide['result']){
            $vbd_key_retrieve=vbd_key_retrieve($keyEncryptionData,JWT::jsonDecode($keyEncryptionGuide['data']));

            if($vbd_key_retrieve['allowed']){


                $gatheredData=$vbd_key_retrieve['data'];
                $itemsAllowed=$vbd_key_retrieve['allowed'];

                $log_track_mng['found']=false;
                foreach($dataapp_log_track['data'] as $vbdK=>$vbdV) {
                    if ($vbdV->getDeleted() == 1 || $vbdV->getDeleted() == 'true') {
                        continue;
                    }
                    if($vbdV->getLog_id()==$gatheredData['log_id']){

                        $log_track_mng['log_id']= $gatheredData['log_id'];
                        $log_track_mng['key']= $vbdV->getLog_key();
                        $log_track_mng['user_id']= $vbdV->getUser_id();
                        $log_track_mng['device']= $vbdV->getDevice_name();
                        $log_track_mng['guide']= $vbdV->getLog_guide();
                        $log_track_mng['extra']= $vbdV->getLog_extra();
                        $log_track_mng['date']=$vbdV->getLog_date();
                        $log_track_mng['date_exp']=$vbdV->getLog_date_exp();
                        $log_track_mng['state']=$vbdV->getLog_state();
                        $log_track_mng['found']=true;


                        break;
                    }

                }


                if($log_track_mng['state']!=1){
                    $log_track_mng['found']=false;
                }

                if($log_track_mng['found']){
                    $allow_token=true;
//                    echo "allowed";
                } else{
                    $vbd_key_response['vbd_key_error']="Key log not found";
                    $vbd_key_response['vbd_key_state']=705;
                    $allow_token=false;
                }



            } else{
                $vbd_key_response['vbd_key_state']=404;
            }

        } else{
            $vbd_key_response['vbd_key_state']=4040;
        }



    }


    if($allow_token){
        $exist=false;
        foreach($dataapp_user['data'] as $vbdK=>$vbdV) {
            if ($vbdV->getDeleted() == 1 || $vbdV->getDeleted() == 'true') {
                continue;
            }
            if($vbdV->getUser_id()==$gatheredData['user_id']){
                $exist=true;
                $user_data_all=['user_id'=>$vbdV->getUser_id(),
                    'ulevel_id'=>$vbdV->getUlevel_id(),
                    'user_rn'=>$vbdV->getUser_rn(),
                    'user_idate'=>$vbdV->getUser_idate(),
                    'user_name'=>$vbdV->getUser_name(),
                    'user_email'=>$vbdV->getUser_email(),
                    'user_state'=>$vbdV->getUser_state(),
                    'deleted'=>$vbdV->getDeleted(),
                ];


                break;
            }

        }


        if(!$exist){
            $allow_token=false;
            $vbd_key_response['vbd_key_state']=701;
        }

        if($exist){


            if(!agentDataConfirm($gatheredData)){
                $vbd_key_response['vbd_key_state']=703;
                $allow_token=false;
                $vbd_key_response['vbd_key_error']="Wrong data provided";
            }

            if(!randomDataConfirm($gatheredData)){
                $vbd_key_response['vbd_key_state']=704;
                $vbd_key_response['vbd_key_error']="Wrong data provided";
                $allow_token=false;
            }

        }

    }


    if($allow_token){

        $disabled=false;

        $app_log_trackModel= new Vbd_log_trackModel();
        $dataapp_log_track=$app_log_trackModel->read(["by"=>"false"]);

        foreach($dataapp_log_track['data'] as $vbdK=>$vbdV){
            if( $log_track_mng['log_id'] == $vbdV->getLog_id() ){

$disabled=$app_log_trackModel->modelControl(['log_id'=> $vbdV->getLog_id(),'log_state'=> '0','deleted'=>'true'])['result'];
                break;
            }
        }

        //force disable, all log id with this user_id
        rsort($dataapp_log_track['data']);

        foreach($dataapp_log_track['data'] as $vbdK=>$vbdV){
            if( $log_track_mng['user_id'] == $vbdV->getUser_id() ){
                $disabled=$app_log_trackModel->modelControl(['log_id'=> $vbdV->getLog_id(),'log_state'=> '0','deleted'=>'true'])['result'];
            }
        }

        if(!$disabled){
            $vbd_key_response['vbd_key_state']=401;
        } else{

            $JSON['response']['state']=1;
            $vbd_key_response['vbd_key_state']=200;
        }

    }

    $JSON['response']['vbd_key']['vbd_key_state']=$vbd_key_response['vbd_key_state'];



}

echo json_encode($JSON);
exit;
