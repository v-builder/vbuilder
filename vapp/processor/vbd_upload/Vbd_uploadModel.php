<?php

/**
 * Created by VBuilder
 * Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/
 * Date: 04/09/2019, Wednesday
 * Time: 10:41 PM
 */



//PDO

//if(!isset($THIS_VBD_KEY)){ //header("location: /home"); //}
class Vbd_uploadModel
{



//CREATE, SCRIPT
    public function add($dataInput=[]){

        $dbh=Database::ConnectPdo();
        $query="INSERT INTO `vbd_upload` ";
        $query.=" (upload_date,upload_privacy,file_type,file_path,file_name,file_ext,file_size,user_id) ";
        $query.="VALUE(:upload_date,:upload_privacy,:file_type,:file_path,:file_name,:file_ext,:file_size,:user_id)";

        $req = $dbh->prepare($query);


        $_vbuilder_feedback['result']=false;
        if($req){
            $result=$req->execute([
                'upload_date'=> $dataInput['upload_date'],
                'upload_privacy'=> $dataInput['upload_privacy'],
                'file_type'=> $dataInput['file_type'],'file_path'=> $dataInput['file_path'],
                'file_name'=> $dataInput['file_name'],'file_ext'=> $dataInput['file_ext'],
                'file_size'=> $dataInput['file_size'],'user_id'=> $dataInput['user_id']]);

            $lastID= $dbh->lastInsertId();
            $_vbuilder_feedback['result']=$result;
            $_vbuilder_feedback['error']=$req->errorInfo();
            $_vbuilder_feedback['data']=$lastID;

        }
        return $_vbuilder_feedback;
    }


    public function addFull($dataInput=[]){

        $dbh=Database::ConnectPdo();
        $query="INSERT INTO `vbd_upload` ";
        $query.=" (upload_date,upload_privacy,file_type,file_path,file_name,file_ext,file_size,upg_id,user_id) ";
        $query.="VALUE(:upload_date,:upload_privacy,:file_type,:file_path,:file_name,:file_ext,:file_size,:upg_id,:user_id)";

        $req = $dbh->prepare($query);


        $_vbuilder_feedback['result']=false;
        if($req){
            $result=$req->execute([
                'upload_date'=> $dataInput['upload_date'],
                'upload_privacy'=> $dataInput['upload_privacy'],
                'file_type'=> $dataInput['file_type'],'file_path'=> $dataInput['file_path'],
                'file_name'=> $dataInput['file_name'],'file_ext'=> $dataInput['file_ext'],
                'file_size'=> $dataInput['file_size'],
                'upg_id'=> $dataInput['upg_id'],
                'user_id'=> $dataInput['user_id']

            ]);

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

        $query="UPDATE `vbd_upload` ";
        $query.="SET upload_date=:upload_date, upload_privacy=:upload_privacy, file_type=:file_type, file_path=:file_path, file_name=:file_name, file_ext=:file_ext, file_size=:file_size, user_id=:user_id WHERE upload_id=:upload_id";

        $req = $dbh->prepare($query);


        $_vbuilder_feedback['result']=false;
        if($req){
            $result=$req->execute([
                'upload_id'=> $dataInput['upload_id'],'upload_date'=> $dataInput['upload_date'],'upload_privacy'=> $dataInput['upload_privacy'],'file_type'=> $dataInput['file_type'],'file_path'=> $dataInput['file_path'],'file_name'=> $dataInput['file_name'],'file_ext'=> $dataInput['file_ext'],'file_size'=> $dataInput['file_size'],'user_id'=> $dataInput['user_id']]);

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

        $query="UPDATE `vbd_upload` ";
        $query.="SET ".$final_str." WHERE upload_id=:upload_id";

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
            $strClean=" WHERE deleted='".$dataInput['by']."' AND upload_id='".$dataInput['id']."'";
        } else{
            if(isset($dataInput['by'])){
                $strClean=" WHERE deleted='".$dataInput['by']."'";
            }

            if(isset($dataInput['id'])){
                $strClean=" WHERE upload_id='".$dataInput['id']."'";
            }

            if(isset($dataInput['upg_id'])){
                $strClean=" WHERE upg_id='".$dataInput['upg_id']."'";
            }
        }

        $dbh=Database::ConnectPdo();
        $query="SELECT * FROM `vbd_upload`".$strClean;
        $req = $dbh->prepare($query);
        $_vbuilder_feedback['result']=false;
        if($req){
            $result=$req->execute();
            $rows =$req->rowCount();
            $datas=[];
            $json=[];
            while ($fetch=$req->fetch(PDO::FETCH_ASSOC)){


                $upload_id=$fetch['upload_id'];
                $upload_date=$fetch['upload_date'];
                $upload_privacy=$fetch['upload_privacy'];
                $file_type=$fetch['file_type'];
                $file_path=$fetch['file_path'];
                $file_name=$fetch['file_name'];
                $file_ext=$fetch['file_ext'];
                $file_size=$fetch['file_size'];
                $upg_id=$fetch['upg_id'];
                $user_id=$fetch['user_id'];
                $deleted=$fetch['deleted'];

                $data=new Vbd_upload($upload_id
                    ,$upload_date
                    ,$upload_privacy
                    ,$file_type
                    ,$file_path
                    ,$file_name
                    ,$file_ext
                    ,$file_size
                    ,$upg_id
                    ,$user_id
                    ,$deleted);
                $datas[]=$data;
                $temp=$fetch;
                $json[]=json_encode($temp);
            }

            $_vbuilder_feedback['result']=$result;
            $_vbuilder_feedback['rows']=$rows;
            $_vbuilder_feedback['data']=$datas;
            if(!isset($json)){
                $_vbuilder_feedback['data-json']=$json;
            } else{
                $_vbuilder_feedback['data-json']=$json;
            }
        }
        return $_vbuilder_feedback;

    }






///DELETE CONTROL, SCRIPT BY CONDITION
    /* the removing process here is classic, made respecting the rules deliting by state. Delete with the parameter $condition. */
    public function deleteControl($dataInput=[]){
        $dbh=Database::ConnectPdo();

        $query="UPDATE `vbd_upload` set deleted=? WHERE upload_id=?";

        $req = $dbh->prepare($query);


        $_vbuilder_feedback['result']=false;
        if($req){
            $result=$req->execute([$dataInput['condition'],$dataInput['upload_id'] ]);

            $_vbuilder_feedback['result']=$result;
            $_vbuilder_feedback['error']=$req->errorInfo();
            $_vbuilder_feedback['affected']=$req->rowCount();


        }
        return $_vbuilder_feedback;
    }


/// DELETE BASE, SCRIPT
    public function deleteBase($upload_id){
        $dbh=Database::ConnectPdo();

        $query="DELETE FROM `vbd_upload` WHERE upload_id=?";

        $req = $dbh->prepare($query);


        $_vbuilder_feedback['result']=false;
        if($req){
            $result=$req->execute([$upload_id]);

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