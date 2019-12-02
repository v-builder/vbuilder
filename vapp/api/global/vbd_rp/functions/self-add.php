<?php
/**
 * Created by VBuilder
 * Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/
 * Date: 07/09/2019, Saturday
 * Time: 01:27 AM
 * Project/Module: Password Reset*/

$tempvar=EngineBuild::getAppRoot();


// Email config and functions
EngineBuild::BuildBindingProcessorScope( PATH_TO_VBD."config/Email.php");




//include_once (PATH_TO_VBD."api/global/vbd_rp/PHPMailer/SMTP.php");
/*
>> ON VALIDATION
0  ERROR
1  SUCCESS
2  USER NOT FOUND
3  MAIL NOT SENT

*/


$METHOD="post";

$JSON['response']['state']=0;
$METHOD= strtolower($METHOD);
$METHOD=trim($METHOD);

//CHECK FOR REQUIRED FIELDS
$JSON['rq_fields']=EngineBuild:: RequiredFields ($METHOD,['user_credential'] );

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
    $rp_email="";
    $user_id=0;
    $rp_date="";
    $rp_date_exp="";
    $rp_codeNr=rand(10100,99999);
    $rp_code="VBD-".$rp_codeNr;
    $user_credential=strtolower(trim(EngineBuild::GetField ($METHOD,'user_credential')));
    $rp_state="0";

    $Vbd_userModel = new Vbd_userModel() ;

    $resultUser= $Vbd_userModel->read(['by'=>'false'])['data'];
    // check username and email existence

    $foundUser=false;
    $authenticated=false;
    $userDataP=Vbd_user::class;

    foreach ($resultUser as $kx => $vx){
//        $Vbd_user= new Vbd_user();

        if($user_credential== $vx->getUser_name() || $user_credential== $vx->getUser_email()){

            $foundUser=true;

            $userDataP=$vx;

            break;
        }

    }

    if(!$foundUser){
//        case user not found
        $JSON['response']['state']=2;
        echo json_encode($JSON);
        exit;
    } else{

        ini_set( 'display_errors', 1 );
        error_reporting( E_ALL );

        // CASE USER FOUND

        $user_id=$userDataP->getUser_id();
        $user_email=$userDataP->getUser_email();
        $rp_email=$user_email;
        // set time

        $timeOutType="hours";
        $timeOutToAdd=6;

        $dateTime = new DateTime();
        $dateTimeNow= new DateTime('now');
        $dateTimeNow->format('Y-m-d H:i:s');

        date_timezone_set($dateTime, timezone_open(VBD_TIMEZONE));
        date_timezone_set($dateTimeNow, timezone_open(VBD_TIMEZONE));
        $dateTime->format('Y-m-d H:i:s');
        $dateTime->modify('+'.$timeOutToAdd.' '.$timeOutType);
        $timeNow= date_format($dateTimeNow,'Y-m-d H:i:s');
        $timeEnd= date_format($dateTime,'Y-m-d H:i:s');
        // Reset password variables
        $rp_date=$timeNow;
        $rp_date_exp=$timeEnd;
        // end of time set


//        $sendMail=EngineBuild::sendEmail($VBD_PASSWORD_RECOVERY_OB);

        $resultX['result']=false;
        // get the email config
        $VBD_PASSWORD_RECOVERY_EMAIL=VBD_EMAIL_DEF_CONFIG;

        // disable smto debug
        $VBD_PASSWORD_RECOVERY_EMAIL['smtpDebug']=false;

        // to
        $VBD_PASSWORD_RECOVERY_EMAIL['to']=[
             ["email"=>$userDataP->getUser_email(),"name"=>$userDataP->getUser_rn()]
        ];
        // subject
        $VBD_PASSWORD_RECOVERY_EMAIL['subject']='Password Recovery';
        // body

//        $urlToVerify=VBD_RESETP_URL."/?user_verify=".jwtEncode($rp_id)."&rp_code=".$rp_code;

        $VBD_PASSWORD_RECOVERY_EMAIL['body']=
        "<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<style type='text/css'>
.vbd_text_style{
color: #000000!important;
font-size: .97rem!important;
line-height: 1.23rem!important;
    text-decoration: none!important;
}
a.vbd_text_style{
    text-decoration: none!important;
color: #000000!important;
}
a{
    text-decoration: none!important;
color: #000000!important;
}
</style>
</head>
<body style='width: 100%; background-color: #ffffff; color: #000000!important; '>
<table style='width: 100%; padding: 30px 10px; background-color: #ffffff; color: #000000!important; '>
<tr><td>
<p class='vbd_text_style'> Dear ".$userDataP->getUser_rn().", </p><br/>
 <p class='vbd_text_style'>We received a password recovery request from you at: ".$rp_date.", the verification code provided in this email will be available for {$timeOutToAdd} {$timeOutType}, until {$rp_date_exp}. </p>
 <p class='vbd_text_style'>Your verification code is: <strong>{$rp_code}</strong></p>

<br/>
<span  class='vbd_text_style'>Thank you.</span>
<br/>
<span  class='vbd_text_style'>Best regards.</span>
<br/>
<span  class='vbd_text_style'>".VBD_ENTITY_NAME."</span>
<br/>
<a href='mailto(".VBD_ENTITY_EMAIL.")'  class='vbd_text_style' style='color: black!important;'>".VBD_ENTITY_EMAIL."</a>
<br/>
<a href='".VBD_ROOT."' class='vbd_text_style style='color: black!important;''>".VBD_ROOT."</span>
</td></tr>
</table>
</body>
</html>";

        //This is the body in plain text for non-HTML mail clients
        $VBD_PASSWORD_RECOVERY_EMAIL['altBody']=
            "Dear ".$userDataP->getUser_rn().",
            \n
            \n
            We received a password recovery request from you at: ".$rp_date.", the verification code provided in this email will be available {$timeOutToAdd} {$timeOutType}, until {$rp_date_exp}
            \n
            Your verification code is: {$rp_code}
            \n
            Thank you. \n
            Best regards. \n
            ".VBD_ENTITY_NAME."\n
            ".VBD_ENTITY_EMAIL." \n
            ".VBD_ROOT;


        // end email config

        $resultX= vbdSendEmail([$VBD_PASSWORD_RECOVERY_EMAIL]);

        if (!$resultX[0]['result']){
            // if mail was not sent
            $JSON['response']['state']=3;
            echo json_encode($JSON);
            exit;

        } else {



            // if email was sent
            $Vbd_rpModel = new Vbd_rpModel() ;

            $result= $Vbd_rpModel->read(["by"=>"false"]);

            foreach ($result['data'] as $k=>$v){

                if($v->getUser_id()==$user_id){
                    $Vbd_rpModel->modelControl(['rp_id'=> $v->getRp_id(),'rp_date_exp'=> $rp_date]);
                }

            }

            $result= $Vbd_rpModel->add(['rp_email'=> $rp_email,'user_id'=> $user_id,'rp_code'=> $rp_code,'rp_date'=> $rp_date,'rp_date_exp'=> $rp_date_exp,'rp_state'=> $rp_state]);

//    echo json_encode($result);

            if(isset($result['result'])){


                // send code with link



                // subject
                $VBD_PASSWORD_RECOVERY_EMAIL['subject']='Password recovery link';
                // body

                $urlToVerify=VBD_RESETP_URL."/?user_verify=".jwtEncode($result['data'])."&rp_code=".$rp_codeNr."&email=".$rp_email;

                $VBD_PASSWORD_RECOVERY_EMAIL['body']=
                    "<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<style type='text/css'>
.vbd_text_style{
color: #000000!important;
font-size: .97rem!important;
line-height: 1.23rem!important;
    text-decoration: none!important;
}
a.vbd_text_style{
    text-decoration: none!important;
color: #000000!important;
}
a{
    text-decoration: none!important;
color: #000000!important;
}
.vbd_light{
color: #1976d2!important;
}
a.vbd_light{
color: #1976d2!important;
}
</style>
</head>
<body style='width: 100%; background-color: #ffffff; color: #000000!important; '>
<table style='width: 100%; padding: 30px 10px; background-color: #ffffff; color: #000000!important; '>
<tr><td>
<p class='vbd_text_style'> Dear ".$userDataP->getUser_rn().", </p><br/>
 <p class='vbd_text_style'>We received a password recovery request from you at: ".$rp_date.", the verification code provided in this email will be available for {$timeOutToAdd} {$timeOutType}, until {$rp_date_exp}. </p>
 <p class='vbd_text_style'>Your verification code is: <strong>{$rp_code}</strong>. click in the following link to reset your password <a href='{$urlToVerify}' class='vbd_light' style='color: #1976d2!important;'>$urlToVerify</a> </p>

<br/>
<span  class='vbd_text_style'>Thank you.</span>
<br/>
<span  class='vbd_text_style'>Best regards.</span>
<br/>
<span  class='vbd_text_style'>".VBD_ENTITY_NAME."</span>
<br/>
<a href='mailto(".VBD_ENTITY_EMAIL.")'  class='vbd_text_style' style='color: black!important;'>".VBD_ENTITY_EMAIL."</a>
<br/>
<a href='".VBD_ROOT."' class='vbd_text_style style='color: black!important;''>".VBD_ROOT."</span>
</td></tr>
</table>
</body>
</html>";

                //This is the body in plain text for non-HTML mail clients
                $VBD_PASSWORD_RECOVERY_EMAIL['altBody']=
                    "Dear ".$userDataP->getUser_rn().",
            \n
            \n
            We received a password recovery request from you at: ".$rp_date.", the verification code provided in this email will be available {$timeOutToAdd} {$timeOutType}, until {$rp_date_exp}
            \n
            Your verification code is: {$rp_code} click in the following link to reset your password {$urlToVerify}
            \n
            Thank you. \n
            Best regards. \n
            ".VBD_ENTITY_NAME."\n
            ".VBD_ENTITY_EMAIL." \n
            ".VBD_ROOT;


                //
                $resultX= vbdSendEmail([$VBD_PASSWORD_RECOVERY_EMAIL]);
                $JSON['response']['result']=$result;
                if($result['result']&&$resultX[0]['result']){
                    $JSON['response']['state']=1;
                    $JSON['response']['result']['rp_id']=jwtEncode($result['data']);
                    $JSON['response']['result']['rp_email']=$rp_email;
                } else{
                    $JSON['response']['state']=0;

                }

            }


        }


        // END OF EMAIL SEND





    echo json_encode($JSON);


    exit;

}


}



exit;