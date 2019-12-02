<?php
header('Content-Type: application/json');

/* >> ON VALIDATION

0 NONE ACTION / FILL ALL THE FIELDS
1 SUCCESSFULLY LOGGED IN
2 WRONG PASSWORD / CHECK YOUR DATA
3 USER NOT FOUND
4 ERROR ADDING LOG TRACK

>> VALIDATED
0 ERROR
1 SUCCESS
2 DATA INSERTED ALREADY PRESENT
*/

require_once "../base.php";

EngineBuild::Database();
EngineBuild::BuildProcessor("Vbd_user");
EngineBuild::BuildProcessor("Vbd_log_track");



$METHOD="post";
$JSON['response']['state']=0;
$METHOD= strtolower($METHOD);
$METHOD=trim($METHOD);
//CHECK FOR REQUIRED FIELDS

$JSON['rq_fields']=EngineBuild:: RequiredFields ($METHOD,['user_password','user_credential'] );


// VALIDATE THE FIELDS
$JSON['validate']= EngineBuild:: ValidateFields ($METHOD,
// Define if you want validation activated
    true,
    [
// select the fields and requests
        'user_credential'=>['min'=>3],
        'password'=>['min'=>6]
    ] );

if(
    $JSON['rq_fields']['missing']['count']>0
    || !$JSON['validate']['state']
){

    echo json_encode($JSON);
} else {
    $user_password=EngineBuild::GetField ($METHOD,'user_password');
    $user_credential=strtolower(trim(EngineBuild::GetField ($METHOD,'user_credential')));
//    $user_name=strtolower(trim(EngineBuild::GetField ($METHOD,'user_credential')));
//    $user_email=strtolower(trim(EngineBuild::GetField ($METHOD,'user_email')));

    $user_password=ltrim(rtrim($user_password));




    $Vbd_userModel = new Vbd_userModel() ;

    $resultUser= $Vbd_userModel->read(['by'=>'false'])['data'];
    // check username and email existence

    $foundUser=false;
    $authenticated=false;
    $userDataP=Vbd_user::class;

//    var_dump($resultUser);

    foreach ($resultUser as $kx => $vx){
//        $Vbd_user= new Vbd_user();

        if($user_credential== $vx->getUser_name() || $user_credential== $vx->getUser_email()){

            $foundUser=true;


            // admin: <=3 or regular >3

            if(isset($_POST['vbd_method'])){
                if($_POST['vbd_method']=='admin' && $vx->getUlevel_id()<=VBD_MAXL_ADMIN ){
//                 account is from admin
                } else{
                    /// account is from regular.. >3
                    $foundUser=false;
                }
            }

            if($foundUser){

                // encode password to verify
                $user_password=jwtEncode($user_password);


                if($vx->getUser_password()===$user_password){
                    $authenticated=true;
                    $userDataP=$vx;
                }

            }



            break;
        }

    }

    if($foundUser){

        if($authenticated){
            // logged in
//            $JSON['response']['state']=1;
            performLogTrack($userDataP, $JSON);
            exit;

        } else {
            // wrong password
            $JSON['response']['state']=2;
        }

    } else{
        // user does not exist
        $JSON['response']['state']=3;
    }

    echo json_encode($JSON);
}



function performLogTrack($userData= Vbd_user::class, $JSON){
   // Generate random keys
    $random_key=null;
    $random_key_extra=null;
    if(rand(1,14)%2==0){
        $random_key=rand(110,999).randomString(2).rand(10000,12434);
        $random_key_extra=rand(110,999).randomString(2).rand(10000,12434);
    } else{
        $random_key=rand(1010,19900).randomString(2).rand(13030,90434);
        $random_key_extra=rand(10000,1990000).randomString(2).rand(2000000,90000000);
    }

    $Vbd_log_trackModel= new Vbd_log_trackModel();

    $user_id=$userData->getUser_id();
    $device_name='---vbuilder---';
    $log_key='---vbuilder---';
    $log_guide='---vbuilder---';
    $log_extra='---vbuilder---';
    $log_date=date('Y-m-d H:i:s');
    $log_date_exp=date('Y-m-d H:i:s');
    $log_state="1";



    $result= $Vbd_log_trackModel->add(['user_id'=> $user_id,'device_name'=> $device_name,'log_key'=> $log_key,'log_guide'=> $log_guide,'log_extra'=> $log_extra,'log_date'=> $log_date,'log_date_exp'=> $log_date_exp,
        'log_state'=> $log_state]);

    if(!$result['result']){
        // user does not exist
        $JSON['response']['state']=4;
        echo json_encode($JSON);
        exit;
    }

    $log_id=$result['data'];


    $keyEncryption= keyEncryption([

        'config'=>

            [
                'total'=>20,
                'set_random_index'=>['enable'=>false,'interval'=>[0,20]]
            ]

        ,

        'data'=>

            [
                'log_id'=> ['value'=> $log_id ],
                'user_id'=> ['value'=> $userData->getUser_id()],
                'user_rn'=> ['value'=> '---vbuilder---' ],
                'random_key'=> ['value'=> $random_key ],
                'random_key_extra'=> ['value'=> $random_key_extra ],

                'agent_device'=>['value'=> USER_AGENT_BASIC['device']],
                'agent_os'=>['value'=> USER_AGENT_BASIC['os']],
                'agent_browser'=>['value'=> USER_AGENT_BASIC['browser']]
            ]

    ]);

    //Response VBD KEY
    $JSON['response']['vbd_key']['key']=str_ireplace('\"','"',$keyEncryption['data']);

    $keyEncryptionData=$keyEncryption['data'];
    $keyEncryptionGuide=$keyEncryption['guide'];

    $timeOutType='seconds';
    $time_zone_vbd_key=VBD_TIMEZONE;



    // Seconds
//$timeOutToAdd=60;

// Minutes
    $timeOutToAdd=(60)*2;

// One hour
//$timeOutToAdd=(60*60)*1;

// One Day
//$timeOutToAdd=((60*60)*24)*1;
// $cookie_type='app';

    $timeOutType="days";
    $timeOutToAdd=23;

try{
    $timeOutType=VBD_LOG_CONTROL[$userData->getUlevel_id()]['mode'];

    $timeOutToAdd=VBD_LOG_CONTROL[$userData->getUlevel_id()]['value'];

} catch (Exception $exception){

    }

// $cookieName=null;

// $cookieName=VBUILDER_CONFIG[0]['core_configs']['cookie_app_log'];

    $dateTime = new DateTime();
    $dateTimeNow= new DateTime('now');
    $dateTimeNow->format('Y-m-d H:i:s');

    date_timezone_set($dateTime, timezone_open(VBD_TIMEZONE));
    date_timezone_set($dateTimeNow, timezone_open(VBD_TIMEZONE));
    $dateTime->format('Y-m-d H:i:s');
    $dateTime->modify('+'.$timeOutToAdd.' '.$timeOutType);
    $timeNow= date_format($dateTimeNow,'Y-m-d H:i:s');
    $timeEnd= date_format($dateTime,'Y-m-d H:i:s');


    $device_name='---vbuilder---';
    $log_extra='---vbuilder---';
    $log_date=$timeNow;
    $log_date_exp=$timeEnd;
    $log_state='1';

    $resultUpdate= $Vbd_log_trackModel->update(['log_id'=> $log_id,'user_id'=> $user_id,'device_name'=> $device_name,'log_key'=> $keyEncryptionData,'log_guide'=> $keyEncryptionGuide,'log_extra'=> $log_extra,'log_date'=> $log_date,'log_date_exp'=> $log_date_exp,'log_state'=> $log_state]);


    if(!$resultUpdate['result']){

        $JSON['response']['state']=4;
        echo json_encode($JSON);
        exit;

    } else{

        $JSON['response']['state']=1;
        $data_log_track= $Vbd_log_trackModel->read(["by"=>"false"]);
        rsort($data_log_track['data']);


        foreach($data_log_track['data'] as $vbdK=>$vbdV){
            if( ( $user_id== $vbdV->getUser_id()) && ($vbdV->getLog_id()!=$log_id)  && ($vbdV->getLog_state()!='0') ){

                $Vbd_log_trackModel->modelControl(['log_id'=> $vbdV->getLog_id(),'log_state'=> '0','deleted'=>'true']);

            }
        }

    }



    echo json_encode($JSON);
    exit;

}

