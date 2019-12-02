<?php
/**
* Created by VBuilder 
* Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Date: 07/09/2019, Saturday
* Time: 02:59 AM
* Project/Module: Password Reset*/

//PDO 



class Vbd_rpModel{



//CREATE, SCRIPT 
public function add($dataInput=[]){

$dbh=Database::ConnectPdo();


$query="INSERT INTO `vbd_rp` ";
$query.=" (rp_email,user_id,rp_code,rp_date,rp_date_exp,rp_state) ";
$query.="VALUE(:rp_email,:user_id,:rp_code,:rp_date,:rp_date_exp,:rp_state)";

$req = $dbh->prepare($query);



$_vbuilder_feedback['result']=false;
if($req){

$result=$req->execute([
'rp_email'=> $dataInput['rp_email'],'user_id'=> $dataInput['user_id'],'rp_code'=> $dataInput['rp_code'],'rp_date'=> $dataInput['rp_date'],'rp_date_exp'=> $dataInput['rp_date_exp'],'rp_state'=> $dataInput['rp_state']]);
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

$query="UPDATE `vbd_rp` ";
$query.="SET rp_email=:rp_email, user_id=:user_id, rp_code=:rp_code, rp_date=:rp_date, rp_date_exp=:rp_date_exp, rp_state=:rp_state WHERE rp_id=:rp_id";

$req = $dbh->prepare($query);



$_vbuilder_feedback['result']=false;
if($req){

$result=$req->execute([ 
'rp_id'=> $dataInput['rp_id'],'rp_email'=> $dataInput['rp_email'],'user_id'=> $dataInput['user_id'],'rp_code'=> $dataInput['rp_code'],'rp_date'=> $dataInput['rp_date'],'rp_date_exp'=> $dataInput['rp_date_exp'],'rp_state'=> $dataInput['rp_state']]);
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

$query="UPDATE `vbd_rp` ";
$query.="SET ".$final_str." WHERE rp_id=:rp_id";

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
$strClean=" WHERE deleted='".$dataInput['by']."' AND rp_id='".$dataInput['id']."'";
} else{

if(isset($dataInput['by'])){
$strClean=" WHERE deleted='".$dataInput['by']."'";
}  if(isset($dataInput['id'])){
$strClean=" WHERE rp_id='".$dataInput['id']."'";
}
}

$dbh=Database::ConnectPdo();
$query="SELECT * FROM `vbd_rp`".$strClean;
$req = $dbh->prepare($query);
$_vbuilder_feedback['result']=false;
if($req){
$result=$req->execute();
$rows =$req->rowCount();
$datas=[];
$json=[];
while ($fetch=$req->fetch(PDO::FETCH_ASSOC)){



 $rp_id=$fetch['rp_id'];
 $rp_email=$fetch['rp_email'];
 $user_id=$fetch['user_id'];
 $rp_code=$fetch['rp_code'];
 $rp_date=$fetch['rp_date'];
 $rp_date_exp=$fetch['rp_date_exp'];
 $rp_state=$fetch['rp_state'];
 $deleted=$fetch['deleted'];

$data=new Vbd_rp($rp_id 
,$rp_email 
,$user_id 
,$rp_code 
,$rp_date 
,$rp_date_exp 
,$rp_state 
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
/*
the removing process here is classic, made respecting the rules
deliting by state. Delete with the parameter $condition.
*/
public function deleteControl($dataInput=[]){
$dbh=Database::ConnectPdo();

$query="UPDATE `vbd_rp` set deleted=? WHERE rp_id=?";
$req = $dbh->prepare($query);

$_vbuilder_feedback['result']=false;
if($req){
$result=$req->execute([$dataInput['condition'],$dataInput['rp_id'] ]);
$_vbuilder_feedback['result']=$result;
$_vbuilder_feedback['error']=$req->errorInfo();
$_vbuilder_feedback['affected']=$req->rowCount(); 
}

return $_vbuilder_feedback;
}


/// DELETE BASE, SCRIPT 
public function deleteBase($rp_id){
$dbh=Database::ConnectPdo();
$query="DELETE FROM `vbd_rp` WHERE rp_id=?";
$req = $dbh->prepare($query);

$_vbuilder_feedback['result']=false;
if($req){
$result=$req->execute([$rp_id]);
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
