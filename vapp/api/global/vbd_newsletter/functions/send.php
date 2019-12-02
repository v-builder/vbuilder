<?php
/**
* Created by VBuilder 
* Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Date: 27/10/2019, Sunday
* Time: 01:41 PM
* Project/Module: Newsletter*/


/*
>> ON VALIDATION
0  ERROR
1  SUCCESS


>> VALIDATED
0 ERROR
1 SUCCESS
2 DATA INSERTED ALREADY PRESENT


*/

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

EngineBuild::BuildBindingProcessorScope( PATH_TO_VBD."config/Email.php");
EngineBuild::loadEmailPackage();

EngineBuild::BuildProcessor("Vbd_upload_group");


$Vbd_ns_mailModel = new Vbd_ns_mailModel() ;

$METHOD="post";

$JSON['response']['state']=0;
$METHOD= strtolower($METHOD);
$METHOD=trim($METHOD);
//CHECK FOR REQUIRED FIELDS
$JSON['rq_fields']=EngineBuild:: RequiredFields ($METHOD,['ns_id'] );


if(
    $JSON['rq_fields']['missing']['count']>0
){

    echo json_encode($JSON);


} else {




$ns_id=trim(EngineBuild:: GetField ($METHOD,'ns_id'));


$Vbd_newsletterModel = new Vbd_newsletterModel() ;


$result= $Vbd_newsletterModel->read(['id'=>$ns_id, "by"=>"false"]);
    $NS_DATA=$result['data'][0];
//    echo json_encode($result);

    if(isset($result['result'])){

        if($result['result']){
            $JSON['response']['state']=1;





            // def email config
            $VBD_NL_EMAIL=VBD_EMAIL_DEF_CONFIG;

            $Vbd_uploadModel = new Vbd_uploadModel() ;
//            var_dump($result['data']);
            $upg_id=$result['data'][0]->getNs_attach();
            $resultData= $Vbd_uploadModel->read(["upg_id"=>$upg_id]);
            $attachToAdd=[];
            //file_path

            foreach ( $resultData['data'] as $k => $v){

                $attachToAdd[]= PATH_TO_VBD.$v->getFile_path();

            }

            //emails
            $Vbd_nsemailModel = new Vbd_nsemailModel() ;
            $resultEMAILS= $Vbd_nsemailModel->read(["by"=>"false"]);
            $resultEMAILSDATA=[];

            $dataOfAlreadySent=[];

            $resultNsMail= $Vbd_ns_mailModel->read(["by"=>"false"]);

            foreach ($resultNsMail['data']  as $kA => $vA){

                if($vA->getNs_id()==$ns_id){
                    if(!isset($dataOfAlreadySent[$vA->getNsemail_id()])){
                        $dataOfAlreadySent[$vA->getNsemail_id()]=$vA->getNsemail_id();
                    }
                }

            }


            foreach ( $resultEMAILS['data'] as $kA => $vA){

                if(isset($dataOfAlreadySent[$vA->getNsemail_id()])){
                   continue;
                }

                $tmpDT['email']=$vA->getNsemail_email();
                $tmpDT['id']=$vA->getNsemail_id();
//                $tmpEpld=explode($vA->getNsemail_email(),'@');
                $tmpDT['name']=$vA->getNsemail_name();
//                $tmpDT['name']=$tmpEpld[0];
                $resultEMAILSDATA[]=$tmpDT;

            }


            foreach ( $resultEMAILSDATA as $kA => $vA){



                /// start off send mail

                $jsonTmp['state']=0;

                $mail = new PHPMailer(true);
                $mail->CharSet =$VBD_NL_EMAIL['charset'];
//                if($VBD_NL_EMAIL['smtpDebug']){
//                    $mail->SMTPDebug = $VBD_NL_EMAIL['smtpDebugType'];                                       // Enable verbose debug output
//                }
                if($VBD_NL_EMAIL['isSmtp']){
                    $mail->isSMTP();
                }
//if we want to send via SMTP
                $mail->Host = $VBD_NL_EMAIL['host'];
//$mail->isSMTP();
                $mail->SMTPAuth = $VBD_NL_EMAIL['smtpAuth'];
//                $mail->SMTPAuth = true;
                $mail->Username = $VBD_NL_EMAIL['username'];
                $mail->Password = $VBD_NL_EMAIL['password'];

                $mail->SMTPSecure = $VBD_NL_EMAIL['smtpSecure']; //TLS
                $mail->Port = $VBD_NL_EMAIL['port']; //587

                if(isset($vA['name'])){
                    $mail->addAddress($vA['email'], $vA['name'] );
                } else{
                    $mail->addAddress($vA['email'] );
                }


                if(isset($vx1['from']['name'])){
                    $mail->setFrom($VBD_NL_EMAIL['from']['email'], $VBD_NL_EMAIL['from']['name']);
                } else{
                    $mail->setFrom($VBD_NL_EMAIL['from']['email']);
                }
                $mail->Subject = $NS_DATA->getNs_subject();
                $mail->isHTML(true);

                $bodySent= $NS_DATA->getNs_body();

                if((strpos($bodySent,'{{name}}'))!==false){
                    $bodySent= str_replace( '{{name}}', $vA['name'],$bodySent);
                }
                if((strpos($bodySent,'{{email}}'))!==false){
                    $bodySent= str_replace( '{{email}}', $vA['email'],$bodySent);
                }
                if((strpos($bodySent,'{{date}}'))!==false){
                    $bodySent= str_replace( '{{date}}', date('Y-m-d H:i:s'), $bodySent);
                }

                $mail->Body = $bodySent;
                $mail->AltBody = $NS_DATA->getNs_altbody();
                /*$mail->Body = "<table style='width: 100%; border-right: 1px solid #1b6d85;'>
<tr><th style='background-color: #000000; padding: 15px; color:#ffffff;'><span style='color:#ffffff;'> Newsletter</span></th></tr>
<tr><td>

<h3> WEBSITE CONTACT NS, </h3><br/><br/>
<p><strong> </strong> </p>
<br/><br/><br/>

</td></tr>
</table>";*/

                if(sizeof($attachToAdd)>0){

                         foreach ($attachToAdd as $k => $v) {
//                             echo $v;
                             $mail->AddAttachment( $v);
                         }

                }




                if ($mail->send()){
                    $jsonTmp['state']=1;
                } else{
                    $jsonTmp['state']=0;
//                    $json['state']=$mail->ErrorInfo;
                }

                /// end off send mail


                $result= $Vbd_ns_mailModel->add(['nsmail_date'=> date('Y-m-d H:i:s'),'ns_id'=> $ns_id,'nsemail_id'=> $vA['id'],'ns_state'=> ( ($jsonTmp['state']==1)? 'true' : 'false' ) ]);



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