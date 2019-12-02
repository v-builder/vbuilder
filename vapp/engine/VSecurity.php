<?php

function checkVbKey($VBDOP){


    /* >> ON VALIDATION

    >> VALIDATED
    0 ERROR
    1 SUCCESS
    2 DATA INSERTED ALREADY PRESENT
    */

    EngineBuild::Database();
    EngineBuild::BuildProcessor("Vbd_user");
    EngineBuild::BuildProcessor("Vbd_log_track");
    EngineBuild::BuildProcessor("Vbd_user_pdata");


    vbdIncludeJWT();

    $allowP=false;
    $gatheredData=array();
    $log_track_mng=array();
    $user_data_all=[];
    $app_userModel = new Vbd_userModel() ;
    $dataapp_user= $app_userModel->read(['by'=>'false']);

    rsort($dataapp_user['data']);


    $METHOD="post";
    if($_GET){
        $METHOD="get";
    }


    $vbd_key="";
    $JSON['response']['state']=0;
    $METHOD= strtolower($METHOD);
    $METHOD=trim($METHOD);
//CHECK FOR REQUIRED FIELDS

    if($VBDOP['ajax']){


        $JSON['rq_fields']=EngineBuild:: RequiredFields ($METHOD,['vbd_key'] );
// VALIDATE THE FIELDS
        $JSON['validate']= EngineBuild:: ValidateFields ($METHOD,
// Define if you want validation activated
            true,
            [
// select the fields and requests
                'vbd_key'=>[ 'min'=>20],
            ] );

        if(
            $JSON['rq_fields']['missing']['count']>0
            || !$JSON['validate']['state']
        ){

            $JSON['response']['state']=0;
//        echo json_encode($JSON);
        } else{
            $allowP=true;
            $vbd_key=EngineBuild::GetField ($METHOD,'vbd_key');
        }

    }
    else {
// if is not ajax
        if(isset($_COOKIE['vbd_key'])){

            $vbd_key=$_COOKIE['vbd_key'];
            $vbd_key=str_ireplace('\"','"',$vbd_key);

//echo $vbd_key;
            $allowP=true;
        } else{

            $JSON['response']['state']=1920;
            $allowP=false;
        }

    }


    if($allowP) {


        // CHECK KEY

        /*vbd_key_state
        401 Token/vbd_key is invalid
    402 Token/vbd_key expired
    403 An error have ocurred
    404 Warning Token/vbd_key Token is not allowed
    404 Error Token/vbd_key Token is not allowed
    701 User doesnt exist
    702 User Rn is incorrect
    703 Wrong Agent Data provided
    704 Wrong Random Data provided

    705 Log Id error [ not found/wrong user id]
    706 Log Id error [ vbd_key doesn't match] */


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


                    $user_data_all=[
                        'user_id'=>$vbdV->getUser_id(),
                        'ulevel_id'=>$vbdV->getUlevel_id(),
                        'user_rn'=>$vbdV->getUser_rn(),
                        'user_photo'=>$vbdV->getUser_photo(),
                        'user_idate'=>$vbdV->getUser_idate(),
                        'user_name'=>$vbdV->getUser_name(),
                        'user_email'=>$vbdV->getUser_email(),
                        'user_state'=>$vbdV->getUser_state(),
                        'user_email_conf'=>$vbdV->getUser_email_conf(),
                        'deleted'=>$vbdV->getDeleted()
                    ];

                    $Vbd_user_pdataModel = new Vbd_user_pdataModel() ;

                    $resultXY= $Vbd_user_pdataModel->read(['user_id'=>$vbdV->getUser_id(), "by"=>"false"]);


                    if($resultXY['rows']>0){

                        $tempOB=($resultXY['data'][0]);

                        $user_data_all['p_data']= [
                                    'vbd_at_id'=>$tempOB->getVbd_at_id(),
                                    'usp_label_value'=>$tempOB->getUsp_label_value(),
                                    'usp_type_value'=>$tempOB->getUsp_type_value(),
                                    'phone_code'=>$tempOB->getPhone_code(),
                                    'phone_number'=>$tempOB->getPhone_number(),
                                    'phone_number_alt'=>$tempOB->getPhone_number_alt(),
                                    'gender'=>$tempOB->getGender(),
                                    'bio'=>$tempOB->getBio(),
                                    'deleted'=>$tempOB->getDeleted(),
                                ];

                    }



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


            $dateTime = new DateTime($log_track_mng['date_exp']);
            $dateTimeNow= new DateTime('now');
            $dateTimeNow->format('Y-m-d H:i:s');

            date_timezone_set($dateTimeNow, timezone_open(VBD_TIMEZONE));

//        echo '<br/>';echo '<br/>';
//        echo
            $timeNow= 'Now '.date_format($dateTimeNow,'Y-m-d H:i:s');
//        echo '<br/>';
//        echo
            $timeEnd= 'End '.date_format($dateTime,'Y-m-d H:i:s');
//        echo '<br/>';

            $calcDataNow = strtotime(date_format($dateTimeNow,'Y-m-d H:i:s'));
            $calcDataEnd= strtotime(date_format($dateTime,'Y-m-d H:i:s'));

            if ($calcDataEnd >= $calcDataNow){

                $JSON['response']['state']=1;

//            $vbd_key_response['user_data']=$user_data_all;
                $vbd_key_response['vbd_key_state']=200;
                $JSON['response']['vbd_key']['user_data']=$user_data_all;
//            echo '<br/> GOOD bigger : <br/>'.$timeEnd;



            } else{
                $vbd_key_response['vbd_key_state']=402;
//            echo '<br/>EXPIRED bigger :<br/>'.$timeNow;
                $vbd_key_response['vbd_key_error']='key expired';
            }

        }

        $JSON['response']['vbd_key']['vbd_key_state']=$vbd_key_response['vbd_key_state'];


    }
    // if(!isset($_COOKIE['vbd_key'])){

    //     $JSON['response']['state']=1920;
    // }

// var_dump($JSON);
    return $JSON;
}


class VSecurity{

    /**
     * VSecurity constructor.
     */
    public function __construct()
    {

    }

    public static function appSecurity($P_RULES){
        $response=[];
        $response ['response']['state']=11;

        if($P_RULES['security']){
            if($P_RULES['security']['enable'] && $P_RULES['security']['enable']){



                $response=(checkVbKey(['ajax'=>$P_RULES['ajax']]));

                $allowP=true;
                if(isset($response['response']['vbd_key']) && $response['response']['vbd_key']['vbd_key_state']==200){

                    $user_data=$response['response']['vbd_key']['user_data'];

                    if( isset($P_RULES['security']) && isset($P_RULES['security']['enable'])){

                        if($P_RULES['security']['enable'] && $P_RULES['security']['enable']){
                            if( isset($P_RULES['security']['user']) ){


                                if( isset($P_RULES['security']['user']['user_level']) ){


                                    // is set allowed condition
                                    if( isset($P_RULES['security']['user']['user_level']['allowed']) ){

                                        $response['response']['vbd_key']['allowed_levels']=$P_RULES['security']['user']['user_level']['allowed'];
                                        $response['response']['vbd_key']['cur_level']=$user_data['ulevel_id'];
                                        $allowP=false;
                                        foreach ($P_RULES['security']['user']['user_level']['allowed'] as $k=>$v){
                                            if($v==$user_data['ulevel_id']){
                                                $allowP=true;
                                            }
                                        }

                                    }

                                    // elseif is set denied condition
                                    elseif( isset($P_RULES['security']['user']['user_level']['denied']) ){

                                        $response['response']['vbd_key']['denied_levels']=$P_RULES['security']['user']['user_level']['denied'];
                                        $response['response']['vbd_key']['cur_level']=$user_data['ulevel_id'];
                                        $allowP=true;
                                        foreach ($P_RULES['security']['user']['user_level']['denied'] as $k=>$v){
                                            if($v==$user_data['ulevel_id']){
                                                $allowP=false;
                                            }
                                        }

                                    }



                                }


                            }

                        }
                    }
                }



                if($P_RULES['ajax']){


                    $METHOD="post";
                    if($_GET){
                        $METHOD="get";
                    }
                    if(EngineBuild:: RequiredFields ($METHOD,['vbd_key'] )['missing']['count']>0){

                        $allowP=false;

                    }

                    if(isset($response['response']['state']) && $response['response']['state']!=1){


                        unset($response['response']['vbd_key']['user_data']);
                        echo json_encode($response);
                        exit;
                    }


                    if(isset($response['response'])&& isset($response['response']['vbd_key']) && $response['response']['vbd_key']['vbd_key_state']!=200){
                        // start section stop

                        $response['response']['state']=1920;
                        unset($response['response']['vbd_key']['user_data']);
                        echo json_encode($response);
                        exit;
                        // end section stop
                    } else{


                        if($allowP){
                            $response['response']['state']=1;
                        } else{

                            // start section stop
                            $response['response']['state']=1920;
                            unset($response['response']['vbd_key']['user_data']);
                            echo json_encode($response);
                            exit;
                            // end section stop
                        }

                        // temp, just to show bellow
                    }


                } else{
// if is not ajax

                    if(!isset($_COOKIE['vbd_key']) ){

                        // start section stop
                        $response['response']['state']=1920;

                        if(isset($P_RULES['on_deny'])){

                            if(isset($P_RULES['on_deny']['redirect'])){

                                if(!headers_sent()){
                                    header('location: '.$P_RULES['on_deny']['redirect']);
                                } else{
                                    echo "<script type='text/javascript'> window.location.replace('".$P_RULES['on_deny']['redirect']."'); </script>";
                                }

                            }
                            if(isset($P_RULES['on_deny']['toast_msg'])){

                                echo "<div id=\"toast-container\" class=\"toast-bottom-right\"><div class=\"toast toast-error\" aria-live=\"assertive\" style=\"\"><div class=\"toast-message\">".$P_RULES['on_deny']['toast_msg']."</div></div></div>";
                                echo "<div class='vbd-security-error'> <p class='vbd-security-error-msg'>".$P_RULES['on_deny']['toast_msg']."</p>  </div>";
                            }

                        }
                        // end section stop
                    } else{

                        if(  isset($response['response']['vbd_key']) && $response['response']['state']!=1){
                            // start section stop

                            $response['response']['state']=1920;

                            if(isset($P_RULES['on_deny'])){

                                if(isset($P_RULES['on_deny']['redirect'])){

                                    if(!headers_sent()){
                                        header('location: '.$P_RULES['on_deny']['redirect']);
                                    } else{
                                        echo "<script type='text/javascript'> window.location.replace('".$P_RULES['on_deny']['redirect']."'); </script>";
                                    }

                                }
                                if(isset($P_RULES['on_deny']['toast_msg'])){

                                    echo "<div id=\"toast-container\" class=\"toast-bottom-right\"><div class=\"toast toast-error\" aria-live=\"assertive\" style=\"\"><div class=\"toast-message\">".$P_RULES['on_deny']['toast_msg']."</div></div></div>";
                                    echo "<div class='vbd-security-error-w'><div class='vbd-security-error'> <p class='vbd-security-error-msg'>".$P_RULES['on_deny']['toast_msg']."</p>  </div></div>";
                                }

                            }

                            // end section stop
                        } else{

                            if($allowP){
                                $response['response']['state']=1;
                            } else{
                                // start section stop
                                $response['response']['state']=1920;

                                if(isset($P_RULES['on_deny'])){

                                    if(isset($P_RULES['on_deny']['redirect'])){

                                        if(!headers_sent()){
                                            header('location: '.$P_RULES['on_deny']['redirect']);
                                        } else{
                                            echo "<script type='text/javascript'> window.location.replace('".$P_RULES['on_deny']['redirect']."'); </script>";
                                        }

                                    }
                                    if(isset($P_RULES['on_deny']['toast_msg'])){

                                        echo "<div id=\"toast-container\" class=\"toast-bottom-right\"><div class=\"toast toast-error\" aria-live=\"assertive\" style=\"\"><div class=\"toast-message\">".$P_RULES['on_deny']['toast_msg']."</div></div></div>";
                                        echo "<div class='vbd-security-error'> <p class='vbd-security-error-msg'>".$P_RULES['on_deny']['toast_msg']."</p>  </div>";
                                    }

                                }
                                // end section stop
                            }

                        }

                    }



                }



            }
        }

        if($response['response']['state']==1 && isset($response['response']['vbd_key'])){
            if(isset($response['response']['vbd_key']['user_data'])){

                if(!defined('VBD_USER_DATA')){

                    define("VBD_USER_DATA",$response['response']['vbd_key']['user_data']);
                }

            }
        }




        return $response;
    }
}