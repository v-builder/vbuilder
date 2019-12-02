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

                if ($calcDataEnd >= $calcDataNow || $rpData->getRp_state()=="1"){
                    // valid
                    $JSON['response']['state']=1;

                    $timeOutToAdd=(60)*7;

                    $timeOutType="seconds";

                    $dateTime = new DateTime();
                    $dateTimeNow= new DateTime('now');
                    $dateTimeNow->format('Y-m-d H:i:s');

                    date_timezone_set($dateTime, timezone_open(VBD_TIMEZONE));
                    date_timezone_set($dateTimeNow, timezone_open(VBD_TIMEZONE));
                    $dateTime->format('Y-m-d H:i:s');
                    $dateTime->modify('+'.$timeOutToAdd.' '.$timeOutType);
                    $timeNow= date_format($dateTimeNow,'Y-m-d H:i:s');
                    $timeEnd= date_format($dateTime,'Y-m-d H:i:s');

                    $result= $Vbd_rpModel->modelControl(['rp_id'=> $rp_id,'rp_date_exp'=> $timeEnd]);


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