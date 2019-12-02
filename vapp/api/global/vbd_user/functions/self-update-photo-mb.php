<?php

/**
 * Created by VBuilder
 * Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/
 * Date: 28/08/2019, Wednesday
 * Time: 02:32 PM
 */



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

// VALIDATE THE FIELDS
$JSON['validate']= EngineBuild:: ValidateFields ($METHOD,
// Define if you want validation activated
    false,
    [
// select the fields and requests
        'user_id'=>['min'=>1,"max"=>20 ],
        'ulevel_id'=>['min'=>1,"max"=>20 ],
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

//    $file=EngineBuild::GetField ($METHOD,'file');


    $IMG_FINAL_PATH="";



    $good=false;
    $goodNr=0;
    $upload_id_=0;
    $notImg='';
    $start=FALSE;

    $isImg=true;
    $json['state']=0;
    $json['start']=false;
    $file['is_file']=false;

    $json['count_upload']=0;
    $json['count_success']=0;
    $json['processes']=[];
    $files=[];
    $fgroup='';
    if(isset($_POST['fgroup'])){
        if($_POST['fgroup']!==''){
            $fgroup=$_POST['fgroup'].'/';
        }
    }

    if(isset($_POST['file'])){

        EngineBuild::BuildProcessor("Vbd_upload");

        $Vbd_uploadModel = new Vbd_uploadModel() ;



            $json['count_upload']++;
            $privacy='';
            $result=false;
/////////
///
///
        $realImage = base64_decode($_POST['image']);
            $name = $realImage['file']['name'];
            $size = $realImage['file']['size'];
            $type = $realImage['file']['type'];
            $tmp_name = $realImage['file']['tmp_name'];

            $file['is_file']=false;
            $file['size']=$size;
            $file['name']=$name;
            $file['type']=$type;
            $file['temp_name']=$tmp_name;


            $date=date("Y").'/'.date("m");

            $add_on_loc=$fgroup;

            // if it is to put files in folders with their respective dates

            if($_POST['date_folder']=='true'){
                $add_on_loc.=date("Y").'/'.date("m").'/';
            }

            $file_typo='other';
            if((strpos($type,'image'))!==false){
                $file_typo='image';
            } elseif((strpos($type,'video'))!==false){
                $file_typo='video';
            }elseif((strpos($type,'audio'))!==false){
                $file_typo='audio';
            }elseif((strpos($type,'application'))!==false){
                $file_typo='application';
            }
//        explode('/',$type)[0]

//        echo "--------typo: {$file_typo} -------";


            $access='public/';
            if($_POST['public']=='false'){
                $access='private/';
                $privacy='private';
            } else{
                $privacy='public';
            }
            $location0 = EngineBuild::getAppRoot()."vbuilder_files/{$access}upload/{$file_typo}/".$add_on_loc;
            $location = "vbuilder_files/{$access}upload/{$file_typo}/".$add_on_loc;
            if(!is_dir($location0)){
                mkdir($location0, 0777, true);
            }
            if(isset($name) && !empty($name)){
                $realName= trim($name);
                $cleanName=$realName;
                $realName= 'vbd'.rand(132, 94599).'-'.$realName;



                $final_db_name=$cleanName;



                $final_location=$location0.$cleanName;
                $final_location_db=$location.$cleanName;
                if(file_exists($final_location)){
                    $file['is_file']=true;

                }
                // if it is to repeat a file
                if($_POST['file_repeat']=='true'){

                    if(file_exists($final_location)){
                        $final_location=$location0.$realName;
//                    $final_db_name=$realName;
                        $final_location_db=$location.$realName;
                    }
                }

                $name_array=explode('.', $final_db_name);
                array_pop($name_array);
                $final_db_name_no_ext=implode('_',$name_array);

                $file['final_name']=$final_db_name;
                $file['final_name_no_ext']=$final_db_name_no_ext;

//           if($_POST['file_repeat']=='true'&& $file['is_file']==true){
//
//           }
                $uploaded=false;
                if(move_uploaded_file($realImage, $final_location)){
                    echo  "";
                    if(!$start){
                        $start=TRUE;
                        $json['start']=true;
                    }
                    $uploaded=true;
                    $extensaoAnexo= pathinfo($name, PATHINFO_EXTENSION);
                    $file['extension']=$extensaoAnexo;
                    $file['path']=$location;
                    if($file['is_file'] && $_POST['file_repeat']=='false'){
//                        $result=$Vbuilder_uploadModel->deleteBaseByPath($final_location_db);
                    }

                    /*$result=$Vbuilder_uploadModel->add($date, $privacy,$type,$final_location_db,$file['final_name_no_ext'],$size,$extensaoAnexo,$user_id);*/

                    $result= $Vbd_uploadModel->add(['upload_date'=> $date,'upload_privacy'=> $privacy,'file_type'=> $type,'file_path'=> $final_location_db,'file_name'=> $file['final_name_no_ext'],'file_ext'=> $extensaoAnexo,'file_size'=> $size,'user_id'=> $user_id]);
                    $IMG_FINAL_PATH=$final_location_db;


                    if($result['result']){
                        $file['state']=1;
                        $upload_id_=$result['data'];
                    } else{
                        $file['state']=0;

                    }
                    $json['count_success']++;

                    $realLocation=$location.$realName;

                }
                if(!$result['result']&&$uploaded){
                    rmrf($final_location_db);
                }
            }
//        else{
//            echo $fmsg = "Please Select a File";
//        }
            $files[]= $file;



    }
    $json['processes']=$files;



    if($json['count_upload']===$json['count_success']){
        $json['state']=1;
    }





if(!$isImg){
    $JSON['response']['state']=2;
}



if($json['count_success']>0){

    $Vbd_userModel = new Vbd_userModel() ;


    $result= $Vbd_userModel->modelControl(['user_id'=> $user_id,'user_photo'=> $upload_id_]);
// echo json_encode($result);
    if(isset($result['result'])){

        if($result['result']){
            $JSON['response']['state']=1;
            $JSON['response']['photo']=$IMG_FINAL_PATH;
        } else{
            $JSON['response']['state']=0;

        }
        $JSON['response']['result']=$result;

    }

}
    echo json_encode($JSON);
}


exit;