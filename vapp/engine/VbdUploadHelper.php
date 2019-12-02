<?php

// $arrTmp['key'=>'key_name', 'upg_id'=> 0 , 'user_id'=>0 ]
                function vbdUploadHelper($arrTmp=[]){

                EngineBuild::BuildProcessor("Vbd_upload");
                EngineBuild::BuildProcessor("Vbd_upload_group");

                $Vbd_uploadModel = new Vbd_uploadModel() ;
                $Vbd_upload_groupModel = new Vbd_upload_groupModel() ;

                // get upg_id
                $tmpResultUpdG= $Vbd_upload_groupModel->read(['id'=>$arrTmp['upg_id'], "by"=>"false"]);

                $jsonUP["count_files"]=0;
                $jsonUP["count_success"]=0;
                $jsonUP["start"]=false;
                $files=[];
                $resultS=[];
                $tmpResult=0;

                if($tmpResultUpdG['result'] && $tmpResultUpdG['rows']>0){


                    if($tmpResultUpdG['data'][0]->getUser_id()==$arrTmp['user_id']){


                        if(is_uploaded_file($_FILES[$arrTmp['key']]["tmp_name"][0])){

                            foreach ($_FILES[$arrTmp['key']]["name"] as $f => $name) {
                                $jsonUP["start"]=true;
                                $jsonUP["count_files"]++;
                                $name = $_FILES[$arrTmp['key']]["name"][$f];
                                $size = $_FILES[$arrTmp['key']]["size"][$f];
                                $type = $_FILES[$arrTmp['key']]["type"][$f];
                                $tmp_name = $_FILES[$arrTmp['key']]["tmp_name"][$f];

                                $file["is_file"]=false;
                                $file["size"]=$size;
                                $file["name"]=$name;
                                $file["type"]=$type;
                                $file["temp_name"]=$tmp_name;
                                $file["uploaded"]=0;

                                $date=date("Y")."/".date("m");
                                $file_typo="other";
                                if((strpos($type,"image"))!==false){
                                    $file_typo="image";
                                } elseif((strpos($type,"video"))!==false){
                                    $file_typo="video";
                                }elseif((strpos($type,"audio"))!==false){
                                    $file_typo="audio";
                                }elseif((strpos($type,"application"))!==false){
                                    $file_typo="application";
                                }

                                $fgroup="";
                                $add_on_loc=$fgroup;

                                $access="public/";
                                $privacy="public";

                                $add_on_loc.=date("Y")."/".date("m")."/";
                                $location0 = EngineBuild::getAppRoot()."vbuilder_files/{$access}upload/{$file_typo}/".$add_on_loc;
                                $location = "vbuilder_files/{$access}upload/{$file_typo}/".$add_on_loc;
                                if(!is_dir($location0)){
                                    mkdir($location0, 0777, true);
                                }

                                $realName= trim($name);
                                $cleanName=$realName;
                                $realName= "vbd".rand(132, 94599)."-".$realName;
                                $final_db_name=$cleanName;
                                $final_location=$location0.$cleanName;
                                $final_location_db=$location.$cleanName;
                                $target_dir0 = "uploads/";

                                $name_array=explode(".", $final_db_name);
                                array_pop($name_array);
                                $final_db_name_no_ext=implode("_",$name_array);
                                $file["final_name"]=$final_db_name;
                                $file["final_name_no_ext"]=$final_db_name_no_ext;

                                if(file_exists($final_location)){
                                    $final_location=$location0.date("Y").date("m").date("d").$cleanName;
                                    $final_location_db=$location.date("Y").date("m").date("d").$cleanName;
                                }
                                if(move_uploaded_file($tmp_name, $final_location)){
                                    $file["uploaded"]=1; $jsonUP["count_success"]++; $extensaoAnexo= pathinfo($name, PATHINFO_EXTENSION);
                                    $file["extension"]=$extensaoAnexo;  $file["path"]=$location;

                                    $resultUpload= $Vbd_uploadModel->addFull(["upload_date"=> $date,
                                            "upload_privacy"=> $privacy,"file_type"=> $type,
                                            "file_path"=> $final_location_db,"file_name"=> $file["final_name_no_ext"],
                                            "file_ext"=> $extensaoAnexo,"file_size"=> $size,"user_id"=> $arrTmp['user_id'],"upg_id"=> $arrTmp['upg_id']]
                                    );
                                    if($resultUpload["result"]){
                                        $file["state"]=1;
                                        $file["upload_id"]=$resultUpload["data"];
                                    } else{
                                        $file["state"]=0;
                                    }
                                    $resultS[]=$resultUpload;
                                    //        echo "The file ". basename( $_FILES[$arrTmp['key']]["name"]). " has been uploaded.";
                                }
                                $files[]= $file;
                                // end of foreach
                            }
                        } else{
                            $tmpResult=1;
                        }

                        if($jsonUP["count_files"]>0 && $jsonUP["count_files"]==$jsonUP["count_success"]){
                            $tmpResult=1;
                        }

                    } else{

                        $tmpResult=2;

                    }




                }


                return ["count_files"=>$jsonUP["count_files"],
                "count_success"=>$jsonUP["count_success"],"results"=>$resultS,
                "state"=>$tmpResult,
                "start"=>$jsonUP["start"]];

                }



              