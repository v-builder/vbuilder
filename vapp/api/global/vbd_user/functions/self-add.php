<?php

/**
 * Created by VBuilder
 * Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/
 * Date: 28/08/2019, Wednesday
 * Time: 02:32 PM
 */

function vbd_send_email_conf($emailTO,$arrayTemp=[]){
// Email config and functions
    EngineBuild::BuildBindingProcessorScope( PATH_TO_VBD."config/Email.php");



    // run it
    $ulevel_idX=$arrayTemp['ulevel_id'];

    $linkToConfirm=VBD_EMAIL_CONF_URL."/?stepA=".cryptThisVbuilder($arrayTemp['user_id'])['e']."&stepB=".cryptThisVbuilder($emailTO)['e']."&stepC=".cryptThisVbuilder($ulevel_idX)['e']."&stepD=".cryptThisVbuilder($arrayTemp['user_rid'])['e'];


    // get the email config
    $VBD_CONF_EMAIL1=VBD_EMAIL_DEF_CONFIG;

    // disable smto debug
    $VBD_CONF_EMAIL1['smtpDebug']=false;

    // to
    $VBD_CONF_EMAIL1['to']=[
        ["email"=>$emailTO,"name"=>$arrayTemp['user_rn']]
    ];
    // subject
    $VBD_CONF_EMAIL1['subject']='Email Confirmation';
    // body

    $VBD_CONF_EMAIL1['body']=
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
<p class='vbd_text_style'> Dear ".$arrayTemp['user_rn'].", </p><br/>
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
    $VBD_CONF_EMAIL1['altBody']=
        "Dear ".$arrayTemp['user_rn'].",
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







    // get the email config
    $VBD_CONF_EMAIL=VBD_EMAIL_DEF_CONFIG;

    // disable smto debug
    $VBD_CONF_EMAIL['smtpDebug']=false;

    // to
    $VBD_CONF_EMAIL['to']=[
        ["email"=>$emailTO,"name"=>$arrayTemp['user_rn']]
    ];
    // subject
    $VBD_CONF_EMAIL['subject']='Welcome To Our World!';
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
<p class='vbd_text_style'> Hey there ".$arrayTemp['user_rn'].", </p><br/>
 <p class='vbd_text_style'>Welcome to our community. Enjoy, share & get empowered!.</p>
 <p class='vbd_text_style'>Get started: ".VBD_ROOT."</p>
<br/>
<a href='".VBD_ROOT."' style=' text-decoration: none!important;'>
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
GET STARTED
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
        "Hey there ".$arrayTemp['user_rn'].",
            \n
            \n
            Welcome to our community. Enjoy, share & get empowered!
            \n
            Get Started: ".VBD_ROOT."
            \n
            Thank you. \n
            Best regards. \n
            ".VBD_ENTITY_NAME."\n
            ".VBD_ENTITY_EMAIL." \n
            ".VBD_ROOT;


    // end email config

    $resultX= vbdSendEmail([$VBD_CONF_EMAIL1,$VBD_CONF_EMAIL]);


}




/* >> ON VALIDATION
0 ERROR
1 SUCCESS

>> VALIDATED
0 ERROR
1 SUCCESS
2 DATA INSERTED ALREADY PRESENT
*/

// 1011 check password
// 1012 user name exists
// 1013 user email exists

$METHOD="post";
$JSON['response']['state']=0;
$METHOD= strtolower($METHOD);
$METHOD=trim($METHOD);
//CHECK FOR REQUIRED FIELDS
$JSON['rq_fields']=EngineBuild:: RequiredFields ($METHOD,['user_password_c','user_rn','user_name','user_email','user_password'] );


// VALIDATE THE FIELDS
$JSON['validate']= EngineBuild:: ValidateFields ($METHOD,
// Define if you want validation activated
    true,
    [
// select the fields and requests
        'user_email'=>['type'=>"email", 'min'=>2,"max"=>50 ],
        'user_rn'=>['min'=>2,"max"=>50],
        'user_name'=>['min'=>3,"max"=>20, "type"=>"nospace"],
        'password'=>['min'=>6]
    ] );

if(
    $JSON['rq_fields']['missing']['count']>0
    || !$JSON['validate']['state']
){

    echo json_encode($JSON);
    exit;
} else {


    $cur_date_time= date("d/m/Y").", ".date("l")." ".date("h:i")." ".strtoupper(date('a'));

    //-VMAIN Define the user level id
    $ulevel_id='5';

    $user_rn=ucwords(strtolower(ltrim(rtrim(EngineBuild::GetField ($METHOD,'user_rn')))));
    $user_idate=$cur_date_time;
    $user_name=strtolower(trim(EngineBuild::GetField ($METHOD,'user_name')));
    $user_email=strtolower(trim(EngineBuild::GetField ($METHOD,'user_email')));
    $user_password=EngineBuild::GetField ($METHOD,'user_password');
    $user_password_c=EngineBuild::GetField ($METHOD,'user_password_c');
    $user_state='1';


    $user_password=ltrim(rtrim($user_password));
    $user_password_c=ltrim(rtrim($user_password_c));

    // check password
    if($user_password!=$user_password_c)
    {
        $JSON['response']['state']=1011;
        echo json_encode($JSON);
        exit;

    }

    $arrayTemp2=['user_rn'=>$user_rn,'ulevel_id'=>$ulevel_id,'user_rid'=>randomString(11)];


    $Vbd_userModel = new Vbd_userModel() ;
    //    $resultUser= $Vbd_userModel->read(["by"=>"false"])['data'];
    $resultUser= $Vbd_userModel->read([])['data'];
    // check username and email existence
    foreach ($resultUser as $kx => $vx){
//        $Vbd_user= new Vbd_user();

        if($vx->getUser_name()==$user_name){
            $JSON['response']['state']=1012;
            echo json_encode($JSON);
            exit;
        }
        if($vx->getUser_email()==$user_email){
            $JSON['response']['state']=1013;
            echo json_encode($JSON);
            exit;
        }

    }


    $user_password=jwtEncode($user_password);


    $Vbd_user_pdataModel = new Vbd_user_pdataModel() ;


    $result= $Vbd_userModel->add(['ulevel_id'=> $ulevel_id,'user_rid'=>$arrayTemp2['user_rid'],'user_rn'=> $user_rn,'user_idate'=> $user_idate,'user_name'=> $user_name,'user_email'=> $user_email,'user_password'=> $user_password,'user_state'=> $user_state]);
// echo json_encode($result);

    if(isset($result['result'])){

        if($result['result']){
            $arrayTemp2['user_id']=$result['data'];

            //Set Personal/Private Data
            // DEFAULT ACCOUNT PERSONAL DATA TYPE: 1
            $resultX= $Vbd_user_pdataModel->init($result['data'], 1);

            try{
                vbd_send_email_conf($user_email,$arrayTemp2);
            } catch (Exception $exception){

            }
            $JSON['response']['state']=1;
        } else{
            $JSON['response']['state']=0;

        }
        $JSON['response']['result']=$result;

    }
    echo json_encode($JSON);
}



exit;