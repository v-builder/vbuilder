<?php

/**
 * Created by VBuilder
 * Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/
 * Date: 28/08/2019, Wednesday
 * Time: 12:34 PM
 */



//PDO

//if(!isset($THIS_VBD_KEY)){ //header("location: /home"); //}
class Vbd_userModel
{



//CREATE, SCRIPT
    public function add($dataInput=[]){

        $dbh=Database::ConnectPdo();
        $query="INSERT INTO `vbd_user` ";
        $query.=" (ulevel_id,user_rid,user_rn,user_idate,user_name,user_email,user_password,user_state) ";
        $query.="VALUE(:ulevel_id,:user_rid,:user_rn,:user_idate,:user_name,:user_email,:user_password,:user_state)";

        $req = $dbh->prepare($query);


        $_vbuilder_feedback['result']=false;
        if($req){
            $result=$req->execute([
                'ulevel_id'=> $dataInput['ulevel_id'], 'user_rid'=> $dataInput['user_rid'],
                'user_rn'=> $dataInput['user_rn'],'user_idate'=> $dataInput['user_idate'],
                'user_name'=> $dataInput['user_name'],'user_email'=> $dataInput['user_email'],
                'user_password'=> $dataInput['user_password'],'user_state'=> $dataInput['user_state']]);

            $lastID= $dbh->lastInsertId();
            $_vbuilder_feedback['result']=$result;
            $_vbuilder_feedback['error']=$req->errorInfo();
            $_vbuilder_feedback['data']=$lastID;

        }
        return $_vbuilder_feedback;
    }




//UPDATE, SCRIPT
    public function update($dataInput=[]){

        $dbh=Database::ConnectPdo();

        $query="UPDATE `vbd_user` ";
        $query.="SET user_rn=:user_rn, user_name=:user_name, user_email=:user_email WHERE user_id=:user_id";

        $req = $dbh->prepare($query);


        $_vbuilder_feedback['result']=false;
        if($req){
            $result=$req->execute([
                'user_id'=> $dataInput['user_id'],
                'user_rn'=> $dataInput['user_rn'],
                'user_name'=> $dataInput['user_name'],
                'user_email'=> $dataInput['user_email']]);

            $_vbuilder_feedback['result']=$result;
            $_vbuilder_feedback['error']=$req->errorInfo();
            $_vbuilder_feedback['affected']=$req->rowCount();


        }
        return $_vbuilder_feedback;
    }


//MODELCONTROL, SCRIPT
    public function modelControl($dataInput=[]){


        $dbh=Database::ConnectPdo();

        $final_str="";
        $final_strAdd=" ";
        $final_array=[];

        $count=0;
        foreach ( $dataInput as $k => $v){

// final string
            if($count>0){

                $final_strAdd=", ";
            }

            $final_str.=$final_strAdd.$k."=:".$k;

// final array
            $final_array[$k]=$v;
            $count++;
        }

        $query="UPDATE `vbd_user` ";
        $query.="SET ".$final_str." WHERE user_id=:user_id";

        $req = $dbh->prepare($query);


        $_vbuilder_feedback['result']=false;
        if($req){

            $result=$req->execute($dataInput);
            $_vbuilder_feedback['result']=$result;
            $_vbuilder_feedback['error']=$req->errorInfo();
            $_vbuilder_feedback['affected']=$req->rowCount();
        }

        return $_vbuilder_feedback;
    }


// READ, SCRIPT
    public function read($dataInput=[]){


        $strClean="";
        $strClean="";
        if(isset($dataInput['by']) && isset($dataInput['id'])){
            $strClean=" WHERE deleted='".$dataInput['by']."' AND user_id='".$dataInput['id']."'";
        }
        elseif(isset($dataInput['by']) && isset($dataInput['user_name'])){
            $strClean=" WHERE deleted='".$dataInput['by']."' AND user_name='".$dataInput['user_name']."'";
        } else{
            if(isset($dataInput['by'])){
                $strClean=" WHERE deleted='".$dataInput['by']."'";
            } if(isset($dataInput['id'])){
                $strClean=" WHERE user_id='".$dataInput['id']."'";
            } if(isset($dataInput['user_name'])){
                $strClean=" WHERE user_name='".$dataInput['user_name']."'";
            }
        }

        $dbh=Database::ConnectPdo();
        $query="SELECT * FROM `vbd_user`".$strClean;

        $req = $dbh->prepare($query);
        $_vbuilder_feedback['result']=false;

        if($req){
            $result=$req->execute();
            $rows =$req->rowCount();
            $datas=[];
            $json=[];
            $jsonPublic=[];
            while ($fetch=$req->fetch(PDO::FETCH_ASSOC)){


                $user_id=$fetch['user_id'];
                $ulevel_id=$fetch['ulevel_id'];
                $user_rn=$fetch['user_rn'];
                $user_rid=$fetch['user_rid'];
                $user_idate=$fetch['user_idate'];
                $user_photo=$fetch['user_photo'];
                $user_name=$fetch['user_name'];
                $user_email=$fetch['user_email'];
                $user_password=$fetch['user_password'];
                $user_state=$fetch['user_state'];
                $user_email_conf=$fetch['user_email_conf'];
                $deleted=$fetch['deleted'];

                $data=new Vbd_user($user_id
                    ,$ulevel_id
                    ,$user_rid
                    ,$user_rn
                    ,$user_photo
                    ,$user_idate
                    ,$user_name
                    ,$user_email
                    ,$user_password
                    ,$user_state
                    ,$user_email_conf
                    ,$deleted);
                $datas[]=$data;
                $temp=$fetch;
                $json[]=json_encode($temp);

                unset($temp['user_password']);
                $jsonPublic[]=json_encode($temp);
            }

            $_vbuilder_feedback['result']=$result;
            $_vbuilder_feedback['rows']=$rows;
$_vbuilder_feedback['data']=$datas;
            $_vbuilder_feedback['data-json']=$jsonPublic;
           /* if(!isset($json)){

            } else{
                $_vbuilder_feedback['data-json']=$json;
            }*/
        }
        return $_vbuilder_feedback;

    }


// READ, SCRIPT
    public function readPublic(){



        $dbh=Database::ConnectPdo();
        $query="SELECT  vbd_user.user_id, vbd_user.ulevel_id, vbd_user.user_rn , vbd_user.user_name , vbd_user.user_email  , vbd_user.deleted , vbd_upload.upload_id  , vbd_upload.file_path, vbd_user_pdata.gender , vbd_user_pdata.vbd_at_id , vbd_user_pdata.usp_label_value, vbd_user_pdata.usp_type_value, vbd_user_pdata.about  FROM vbd_user LEFT JOIN vbd_upload ON vbd_user.user_photo=vbd_upload.upload_id LEFT JOIN vbd_user_pdata ON vbd_user.user_id=vbd_user_pdata.user_id;";
        $req = $dbh->prepare($query);
        $_vbuilder_feedback['result']=false;
        if($req){
            $result=$req->execute();
            $rows =$req->rowCount();
            $datas=[];
            $json=[];
            $jsonPublic=[];
            while ($fetch=$req->fetch(PDO::FETCH_ASSOC)){


//                $user_id=$fetch['user_id'];


                $data=$fetch;

                $datas[]=$data;

                $temp=$fetch;
                $json[]=json_encode($temp);

                unset($temp['user_password']);
                $jsonPublic[]=json_encode($temp);
            }

            $_vbuilder_feedback['result']=$result;
            $_vbuilder_feedback['rows']=$rows;
$_vbuilder_feedback['data']=$datas;
            $_vbuilder_feedback['data-json']=$jsonPublic;
           /* if(!isset($json)){

            } else{
                $_vbuilder_feedback['data-json']=$json;
            }*/
        }
        return $_vbuilder_feedback;

    }






///DELETE CONTROL, SCRIPT BY CONDITION
    /* the removing process here is classic, made respecting the rules deliting by state. Delete with the parameter $condition. */
    public function deleteControl($dataInput=[]){
        $dbh=Database::ConnectPdo();

        $query="UPDATE `vbd_user` set deleted=? WHERE user_id=?";

        $req = $dbh->prepare($query);


        $_vbuilder_feedback['result']=false;
        if($req){
            $result=$req->execute([$dataInput['condition'],$dataInput['user_id'] ]);

            $_vbuilder_feedback['result']=$result;
            $_vbuilder_feedback['error']=$req->errorInfo();
            $_vbuilder_feedback['affected']=$req->rowCount();


        }
        return $_vbuilder_feedback;
    }


/// DELETE BASE, SCRIPT
    public function deleteBase($user_id){
        $dbh=Database::ConnectPdo();

        $query="DELETE FROM `vbd_user` WHERE user_id=?";

        $req = $dbh->prepare($query);


        $_vbuilder_feedback['result']=false;
        if($req){
            $result=$req->execute([$user_id]);

            $_vbuilder_feedback['result']=$result;
            $_vbuilder_feedback['error']=$req->errorInfo();
            $_vbuilder_feedback['affected']=$req->rowCount();


        }
        return $_vbuilder_feedback;
    }

// All Rights Reserved By Vayile Félix Pessoa Fumo | vayile.pessoa@gmail.com
// https://www.linkedin.com/in/vayile-fumo-a22a66170/
// Mozambique, Maputo


}