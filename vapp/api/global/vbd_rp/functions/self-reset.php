<?php
/**
* Created by VBuilder 
* Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Date: 07/09/2019, Saturday
* Time: 02:59 AM
* Project/Module: Password Reset*/


/*
>> ON VALIDATION
0  ERROR
1  SUCCESS


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
$JSON['rq_fields']=EngineBuild:: RequiredFields ($METHOD,['rp_id','rp_code'] );


if(
    $JSON['rq_fields']['missing']['count']>0
){

    echo json_encode($JSON);


} else {




$rp_id=trim(EngineBuild:: GetField ($METHOD,'rp_id'));
$rp_id=jwtDecode($rp_id);
$rp_code=trim(EngineBuild:: GetField ($METHOD,'rp_code'));


$Vbd_rpModel = new Vbd_rpModel() ;


$result= $Vbd_rpModel->read(['id'=>$rp_id, "by"=>"false"]);
//    echo json_encode($result);



    if(isset($result['result'])&&$result['rows']>0){



        if($result['result']){

            $rpData=$result['data'][0];

            $user_id=$rpData->getUser_id();
            if($rpData->getRp_code()=="VBD-".trim($rp_code)){
                // valid code

                $dateTime = new DateTime($rpData->getRp_date_exp());
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

                if ($calcDataEnd >= $calcDataNow && $rpData->getRp_state()!="1"){
                    // valid
                    $JSON['response']['state']=1;

                  // reset password ---------------------------------------------------




//    $ulevel_id=EngineBuild::GetField ($METHOD,'ulevel_id');
                    $user_password=EngineBuild::GetField ($METHOD,'user_password');
                    $user_password_n=EngineBuild::GetField ($METHOD,'user_password_n');
                    $user_password_n_c=EngineBuild::GetField ($METHOD,'user_password_n_c');

//    $user_rn=ucwords(strtolower(ltrim(rtrim(EngineBuild::GetField ($METHOD,'user_rn')))));
                    //    $user_idate=EngineBuild::GetField ($METHOD,'user_idate');
//    $user_name=strtolower(trim(EngineBuild::GetField ($METHOD,'user_name')));
//    $user_email=strtolower(trim(EngineBuild::GetField ($METHOD,'user_email')));
                    /*
                      $user_state=EngineBuild::GetField ($METHOD,'user_state');*/


                    $user_password=ltrim(rtrim($user_password));
                    $user_password_n=ltrim(rtrim($user_password_n));
                    $user_password_n_c=ltrim(rtrim($user_password_n_c));

                    $user_password=jwtEncode($user_password);

                    // check password
                    if($user_password_n!=$user_password_n_c)
                    {
                        $JSON['response']['state']=1011;
                        echo json_encode($JSON);
                        exit;

                    }

                    $Vbd_userModel = new Vbd_userModel() ;

                    /*$resultUser= $Vbd_userModel->read(['id'=>$user_id, "by"=>"false"])['data'];
                    // check username and email existence
                    foreach ($resultUser as $kx => $vx){
//        $Vbd_user= new Vbd_user();

                        if($vx->getUser_password()!==$user_password && $user_id== $vx->getUser_id()){
                            $JSON['response']['state']=1010;
                            echo json_encode($JSON);
                            exit;
                        }

                    }*/


                    $result= $Vbd_userModel->modelControl(['user_id'=> $user_id,'user_rid'=> randomString(11) ,'user_password'=> jwtEncode($user_password_n)]);
                    // echo json_encode($result);
                    if(isset($result['result'])){

                        if($result['result']){
                            $JSON['response']['state']=1;

                            $result= $Vbd_rpModel->modelControl(['rp_id'=> $rp_id,'rp_state'=> '1']);

                        } else{
                            $JSON['response']['state']=0;

                        }
                        $JSON['response']['result']=$result;

                    }
//                    echo json_encode($JSON);
//exit;


                    // end password reset ---------------------------------------------------

                } else{
                    // expired
                    $JSON['response']['state']=3;
                }
            } else{
                // invalid code
                $JSON['response']['state']=2;

                unset($result['data-json']);

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