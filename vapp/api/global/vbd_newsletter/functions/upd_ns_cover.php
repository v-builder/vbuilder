
                
                <?php
                 
                function upd_ns_cover($user_idTmp){

                EngineBuild::BuildProcessor("Vbd_upload");
                EngineBuild::BuildProcessor("Vbd_upload_group");

                $Vbd_uploadModel = new Vbd_uploadModel() ;

                $jsonUP["count_files"]=0;
                $jsonUP["count_success"]=0;
                $jsonUP["start"]=false;
                $files=[];
                $resultS=[];
                $tmpResult["state"]=0;

                if(is_uploaded_file($_FILES["ns_cover"]["tmp_name"][0])){
                foreach ($_FILES["ns_cover"]["name"] as $f => $name) {
                $jsonUP["start"]=true;
                $jsonUP["count_files"]++;
                $name = $_FILES["ns_cover"]["name"][$f];
                $size = $_FILES["ns_cover"]["size"][$f];
                $type = $_FILES["ns_cover"]["type"][$f];
                $tmp_name = $_FILES["ns_cover"]["tmp_name"][$f];

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
                $resultUpload= $Vbd_uploadModel->add(["upload_date"=> $date,
                "upload_privacy"=> $privacy,"file_type"=> $type,
                "file_path"=> $final_location_db,"file_name"=> $file["final_name_no_ext"],
                "file_ext"=> $extensaoAnexo,"file_size"=> $size,"user_id"=> $user_idTmp]
                );
                if($resultUpload["result"]){
                $file["state"]=1;
                $file["upload_id"]=$resultUpload["data"];
                } else{
                $file["state"]=0;
                }
                $resultS[]=$resultUpload;
                //        echo "The file ". basename( $_FILES["ns_cover"]["name"]). " has been uploaded.";
                }
                $files[]= $file;
                // end of foreach
                }
                }
                else 
                {
                $tmpResult["state"]=1;
                }


                $Vbd_upload_groupModel = new Vbd_upload_groupModel() ;

                $dateTimeNow= new DateTime("now");
                date_timezone_set($dateTimeNow, timezone_open(VBD_TIMEZONE));
                $dateTimeNow->format("Y-m-d H:i:s");
                $timeNow= date_format($dateTimeNow,"Y-m-d H:i:s");

                $upg_date=$timeNow;

                $upg_desc="";
                $tmpResultUpdG= $Vbd_upload_groupModel->add(["user_id"=> $user_idTmp,"upg_date"=> $upg_date,"upg_desc"=> $upg_desc]);

                $tmpResult=$tmpResultUpdG;

                if($jsonUP["count_files"]>0 ){

                foreach ($files as $k => $v){
                if($v["state"]!=1){
                continue;
                }
                $resultUploadX= $Vbd_uploadModel->modelControl(
                ["upload_id"=> $v["upload_id"],
                "upg_id"=> $tmpResultUpdG["data"]
                ]);

                }


                }



                return ["count_files"=>$jsonUP["count_files"],
                "count_success"=>$jsonUP["count_success"],"results"=>$resultS,
                "result"=>$tmpResult,
                "start"=>$jsonUP["start"]];

                }



              