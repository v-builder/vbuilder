<?php

/**
 * Created by VBuilder
 * Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/
 * Date: 28/08/2019, Wednesday
 * Time: 12:49 PM
 */



//PDO

//if(!isset($THIS_VBD_KEY)){ //header("location: /home"); //}
class Vbd_log_trackModel
{



//CREATE, SCRIPT
    public function add($dataInput=[]){

        $dbh=Database::ConnectPdo();
        $query="INSERT INTO `vbd_log_track` ";
        $query.=" (user_id,device_name,log_key,log_guide,log_extra,log_date,log_date_exp,log_state) ";
        $query.="VALUE(:user_id,:device_name,:log_key,:log_guide,:log_extra,:log_date,:log_date_exp,:log_state)";

        $req = $dbh->prepare($query);


        $_vbuilder_feedback['result']=false;
        if($req){
            $result=$req->execute([
                'user_id'=> $dataInput['user_id'],'device_name'=> $dataInput['device_name'],'log_key'=> $dataInput['log_key'],'log_guide'=> $dataInput['log_guide'],'log_extra'=> $dataInput['log_extra'],'log_date'=> $dataInput['log_date'],'log_date_exp'=> $dataInput['log_date_exp'],'log_state'=> $dataInput['log_state']]);

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

        $query="UPDATE `vbd_log_track` ";
        $query.="SET user_id=:user_id, device_name=:device_name, log_key=:log_key, log_guide=:log_guide, log_extra=:log_extra, log_date=:log_date, log_date_exp=:log_date_exp, log_state=:log_state WHERE log_id=:log_id";

        $req = $dbh->prepare($query);


        $_vbuilder_feedback['result']=false;
        if($req){
            $result=$req->execute([
                'log_id'=> $dataInput['log_id'],'user_id'=> $dataInput['user_id'],'device_name'=> $dataInput['device_name'],'log_key'=> $dataInput['log_key'],'log_guide'=> $dataInput['log_guide'],'log_extra'=> $dataInput['log_extra'],'log_date'=> $dataInput['log_date'],'log_date_exp'=> $dataInput['log_date_exp'],'log_state'=> $dataInput['log_state']]);

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

        $query="UPDATE `vbd_log_track` ";
        $query.="SET ".$final_str." WHERE log_id=:log_id";

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
            $strClean=" WHERE deleted='".$dataInput['by']."' AND log_id='".$dataInput['id']."'";
        } else{
            if(isset($dataInput['by'])){
                $strClean=" WHERE deleted='".$dataInput['by']."'";
            } if(isset($dataInput['id'])){
                $strClean=" WHERE log_id='".$dataInput['id']."'";
            }
        }

        $dbh=Database::ConnectPdo();
        $query="SELECT * FROM `vbd_log_track`".$strClean;
        $req = $dbh->prepare($query);
        $_vbuilder_feedback['result']=false;
        if($req){
            $result=$req->execute();
            $rows =$req->rowCount();
            $datas=[];
            $json=[];
            while ($fetch=$req->fetch(PDO::FETCH_ASSOC)){


                $log_id=$fetch['log_id'];
                $user_id=$fetch['user_id'];
                $device_name=$fetch['device_name'];
                $log_key=$fetch['log_key'];
                $log_guide=$fetch['log_guide'];
                $log_extra=$fetch['log_extra'];
                $log_date=$fetch['log_date'];
                $log_date_exp=$fetch['log_date_exp'];
                $log_state=$fetch['log_state'];
                $deleted=$fetch['deleted'];

                $data=new Vbd_log_track($log_id
                    ,$user_id
                    ,$device_name
                    ,$log_key
                    ,$log_guide
                    ,$log_extra
                    ,$log_date
                    ,$log_date_exp
                    ,$log_state
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

        $query="UPDATE `vbd_log_track` set deleted=? WHERE log_id=?";

        $req = $dbh->prepare($query);


        $_vbuilder_feedback['result']=false;
        if($req){
            $result=$req->execute([$dataInput['condition'],$dataInput['log_id'] ]);

            $_vbuilder_feedback['result']=$result;
            $_vbuilder_feedback['error']=$req->errorInfo();
            $_vbuilder_feedback['affected']=$req->rowCount();


        }
        return $_vbuilder_feedback;
    }


/// DELETE BASE, SCRIPT
    public function deleteBase($log_id){
        $dbh=Database::ConnectPdo();

        $query="DELETE FROM `vbd_log_track` WHERE log_id=?";

        $req = $dbh->prepare($query);


        $_vbuilder_feedback['result']=false;
        if($req){
            $result=$req->execute([$log_id]);

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