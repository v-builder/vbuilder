<?php

/**
 * Created by VBuilder
 * Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/
 * Date: 28/08/2019, Wednesday
 * Time: 12:27 PM
 */



//PDO

//if(!isset($THIS_VBD_KEY)){ //header("location: /home"); //}
class Vbd_user_levelModel
{



//CREATE, SCRIPT
    public function add($dataInput=[]){

        $dbh=Database::ConnectPdo();
        $query="INSERT INTO `vbd_user_level` ";
        $query.=" (ulevel_name,ulevel_desc) ";
        $query.="VALUE(:ulevel_name,:ulevel_desc)";

        $req = $dbh->prepare($query);


        $_vbuilder_feedback['result']=false;
        if($req){
            $result=$req->execute([
                'ulevel_name'=> $dataInput['ulevel_name'],'ulevel_desc'=> $dataInput['ulevel_desc']]);

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

        $query="UPDATE `vbd_user_level` ";
        $query.="SET ulevel_name=:ulevel_name, ulevel_desc=:ulevel_desc WHERE ulevel_id=:ulevel_id";

        $req = $dbh->prepare($query);


        $_vbuilder_feedback['result']=false;
        if($req){
            $result=$req->execute([
                'ulevel_id'=> $dataInput['ulevel_id'],'ulevel_name'=> $dataInput['ulevel_name'],'ulevel_desc'=> $dataInput['ulevel_desc']]);

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

        $query="UPDATE `vbd_user_level` ";
        $query.="SET ".$final_str." WHERE ulevel_id=:ulevel_id";

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
        if(isset($dataInput['by']) && isset($dataInput['id'])){
            $strClean=" WHERE deleted='".$dataInput['by']."' AND ulevel_id='".$dataInput['id']."'";
        } else{
            if(isset($dataInput['by'])){
                $strClean=" WHERE deleted='".$dataInput['by']."'";
            } if(isset($dataInput['id'])){
                $strClean=" WHERE ulevel_id='".$dataInput['id']."'";
            }
        }

        $dbh=Database::ConnectPdo();
        $query="SELECT * FROM `vbd_user_level`".$strClean;
        $req = $dbh->prepare($query);
        $_vbuilder_feedback['result']=false;
        if($req){
            $result=$req->execute();
            $rows =$req->rowCount();
            $datas=[];
            $json=[];
            while ($fetch=$req->fetch(PDO::FETCH_ASSOC)){


                $ulevel_id=$fetch['ulevel_id'];
                $ulevel_name=$fetch['ulevel_name'];
                $ulevel_desc=$fetch['ulevel_desc'];
                $deleted=$fetch['deleted'];

                $data=new Vbd_user_level($ulevel_id
                    ,$ulevel_name
                    ,$ulevel_desc
                    ,$deleted);
                $datas[]=$data;
                $temp=$fetch;
                $json[]=json_encode($temp);
            }

            $_vbuilder_feedback['result']=$result;
            $_vbuilder_feedback['rows']=$rows;
//$_vbuilder_feedback['data']=$datas;
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

        $query="UPDATE `vbd_user_level` set deleted=? WHERE ulevel_id=?";

        $req = $dbh->prepare($query);


        $_vbuilder_feedback['result']=false;
        if($req){
            $result=$req->execute([$dataInput['condition'],$dataInput['ulevel_id'] ]);

            $_vbuilder_feedback['result']=$result;
            $_vbuilder_feedback['error']=$req->errorInfo();
            $_vbuilder_feedback['affected']=$req->rowCount();


        }
        return $_vbuilder_feedback;
    }


/// DELETE BASE, SCRIPT
    public function deleteBase($ulevel_id){
        $dbh=Database::ConnectPdo();

        $query="DELETE FROM `vbd_user_level` WHERE ulevel_id=?";

        $req = $dbh->prepare($query);


        $_vbuilder_feedback['result']=false;
        if($req){
            $result=$req->execute([$ulevel_id]);

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