<?php

/**
 * Created by VBuilder
 * Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/
 * Date: 28/08/2019, Wednesday
 * Time: 02:32 PM
 */

// Email config and functions
EngineBuild::BuildBindingProcessorScope( PATH_TO_VBD."config/Email.php");



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

            // run it
            $resultX= $result['data'][0];
            $ulevel_idX=$resultX->getUlevel_id();
            $emailX=$resultX->getUser_email();
            $user_ridX=$resultX->getUser_rid();
            $email_confX=$resultX->getUser_email_conf();
            if($email_confX=='true'){
                // account has already been verified
                $JSON['response']['state']=11;
            } else{
                // get verifications code and send email

                $linkToConfirm=VBD_EMAIL_CONF_URL."/?stepA=".cryptThisVbuilder($user_id)['e']."&stepB=".cryptThisVbuilder($emailX)['e']."&stepC=".cryptThisVbuilder($ulevel_idX)['e']."&stepD=".cryptThisVbuilder($user_ridX)['e'];


                // get the email config
                $VBD_CONF_EMAIL=VBD_EMAIL_DEF_CONFIG;

                // disable smto debug
                $VBD_CONF_EMAIL['smtpDebug']=false;

                // to
                $VBD_CONF_EMAIL['to']=[
                    ["email"=>$resultX->getUser_email(),"name"=>$resultX->getUser_rn()]
                ];
                // subject
                $VBD_CONF_EMAIL['subject']='Email Confirmation';
                // body

                $VBD_CONF_EMAIL['body']=
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
button.vbd_btn_style{
background-color: #1976d2!important; color: #ffffff!important; 
text-transform: uppercase;
    display: block!important;
    margin: 0 auto!important;
    font-size: 1rem!important;
    word-wrap: break-word;
    white-space: normal; 
    border: 0;
    border-radius: .625rem;
    box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.12);
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    padding: .84rem 2.14rem;
    '
}
</style>
</head>
<body style='width: 100%; background-color: #ffffff; color: #000000!important; '>
<table style='width: 100%; padding: 30px 10px; background-color: #ffffff; color: #000000!important; '>
<tr><td>
<p class='vbd_text_style'> Dear ".$resultX->getUser_rn().", </p><br/>
 <p class='vbd_text_style'>Confirm your email to secure and have full access of our features.</p>
 <p class='vbd_text_style'>Click in the following link to confirm: <a href='{$linkToConfirm}' class='vbd_light' style='color: #1976d2!important;'>$linkToConfirm</a></p>
<br/>
<a href='{$linkToConfirm}' style=' text-decoration: none!important;'>
<button class='vbd_btn_style' style='background-color: #1976d2!important; color: #ffffff!important; 
text-transform: uppercase;
    display: block!important;
    margin: 0 auto!important;
    font-size: 1rem!important;
    word-wrap: break-word;
    white-space: normal; 
    border: 0;
    border-radius: .125rem;
    box-shadow: 0 2px 5px 0 rgba(0,0,0,.16), 0 2px 10px 0 rgba(0,0,0,.12);
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    padding: .84rem 2.14rem;
    '>
Confirm email
</button>
</a>
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
                $VBD_CONF_EMAIL['altBody']=
                    "Dear ".$resultX->getUser_rn().",
            \n
            \n
            Confirm your email to secure and have full access of our features.
            \n
            Click in the following link to verify: {$linkToConfirm}
            \n
            Thank you. \n
            Best regards. \n
            ".VBD_ENTITY_NAME."\n
            ".VBD_ENTITY_EMAIL." \n
            ".VBD_ROOT;


                // end email config

                $resultX= vbdSendEmail([$VBD_CONF_EMAIL]);

                if (!$resultX['result']){
                    // if mail was not sent
                    $JSON['response']['state']=2;
                    echo json_encode($JSON);
                    exit;

                } else {
                    $JSON['response']['state']=1;
                    $JSON['response']['link']=$linkToConfirm;
                }





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