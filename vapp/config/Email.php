<?php
/**
 * Created by Vayile Fumo.
 * User: Vayile Fumo
 * Date: 2019-09-07
 * Time: 15:45
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

EngineBuild::loadEmailPackage();

function vbdSendEmail($arrayVB){

    EngineBuild::loadEmailPackage();

    $mailVB = new PHPMailer(true);

    $stateMailVB=[];

    $stateMailVBDATA=[];

    try {

        foreach ($arrayVB as $kx1=>$vx1){



            //Server settings
        $mailVB->CharSet =$vx1['charset'];
        if($vx1['smtpDebug']){
            $mailVB->SMTPDebug = $vx1['smtpDebugType'];                                       // Enable verbose debug output
        }
        if($vx1['isSmtp']){
            $mailVB->isSMTP();
        }                                           // Set mailer to use SMTP
        $mailVB->Host       = $vx1['host'];  // Specify main and backup SMTP servers
        $mailVB->SMTPAuth   = $vx1['smtpAuth'];                                   // Enable SMTP authentication
        $mailVB->Username   = $vx1['username'];                     // SMTP username
        $mailVB->Password   = $vx1['password'];                               // SMTP password
        $mailVB->SMTPSecure = $vx1['smtpSecure'];                                  // Enable TLS encryption, `ssl` also accepted
        $mailVB->Port       = $vx1['port'];                                     // TCP port to connect to 587: tls 465:ssl
        // TCP port to connect to

            if(isset($vx1['attach'])) {

                if(is_uploaded_file($_FILES[$vx1['attach']]["tmp_name"][0])) {
//                    echo 555555;
                    foreach ($_FILES[$vx1['attach']]["name"] as $kFile => $vFile) {
                        $mailVB->AddAttachment($_FILES[$vx1['attach']]["tmp_name"][$kFile], $_FILES[$vx1['attach']]["name"][$kFile]);
                    }
                }

            }

        //Recipients
        if(isset($vx1['from']['name'])){
            $mailVB->setFrom($vx1['from']['email'], $vx1['from']['name']);
        } else{
            $mailVB->setFrom($vx1['from']['email']);
        }

        foreach ($vx1['to'] as $kxA=>$vxA){
            if(isset($vx1['name'])){

                $stateMailVB['email']=$vxA['email'];
                $mailVB->addAddress($vxA['email'],$vxA['name']);
            } else{
                $mailVB->addAddress($vxA['email']);
            }
        }

        if(isset($vx1['reply'])) {

            foreach ($vx1['reply'] as $kxA => $vxA) {
                if (isset($vxA['name'])) {
                    $mailVB->addReplyTo($vxA['email'], $vxA['name']);
                } else {
                    $mailVB->addReplyTo($vxA['email']);


                }
            }
        }

        if(isset($vx1['cc'])) {

            foreach ($vx1['cc'] as $kxA => $vxA) {
                if (isset($vxA['name'])) {
                    $mailVB->addCC($vxA['email'], $vxA['name']);
                } else {
                    $mailVB->addCC($vxA['email']);


                }
            }
        }


        if(isset($vx1['bcc'])) {

            foreach ($vx1['bcc'] as $kxA => $vxA) {
                if (isset($vxA['name'])) {
                    $mailVB->addBCC($vxA['email'], $vxA['name']);
                } else {
                    $mailVB->addBCC($vxA['email']);
                }
            }
        }

        // Attachments
//            $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//            $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
        $mailVB->isHTML($vx1['isHTML']);                                  // Set email format to HTML
        $mailVB->Subject = $vx1['subject'];
        $mailVB->Body    = $vx1['body'];
        //This is the body in plain text for non-HTML mail clients
        if(isset($vx1['altBody'])){
            $mailVB->AltBody = $vx1['altBody'];
        }



        $stateMailVB['result']=$mailVB->send();
            $stateMailVBDATA[]=$stateMailVB;
    }
//        echo 'Message has been sent';
    } catch (Exception $e) {

        $stateMailVB['result']=false;
        $stateMailVB['error']=$mailVB->ErrorInfo;
//        echo $mailVB->ErrorInfo;
    }

    return $stateMailVBDATA;

}