<?php
/**
* Created by VBuilder 
* Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Date: 11/09/2019, Wednesday
* Time: 08:24 PM
* Project/Module: Personal Data*/

//PDO 



class Vbd_user_pdataModel{



//CREATE, SCRIPT 
public function add($dataInput=[]){

$dbh=Database::ConnectPdo();


$query="INSERT INTO `vbd_user_pdata` ";
$query.=" (user_id,vbd_at_id,usp_label_value,usp_type_value,phone_code,phone_number,phone_number_alt,phone_shown,gender,about,bio) ";
$query.="VALUE(:user_id,:vbd_at_id,:usp_label_value,:usp_type_value,:phone_code,:phone_number,:phone_number_alt,:phone_shown,:gender,:about,:bio)";

$req = $dbh->prepare($query);



$_vbuilder_feedback['result']=false;
if($req){

$result=$req->execute([
'user_id'=> $dataInput['user_id'],'vbd_at_id'=> $dataInput['vbd_at_id'],'usp_label_value'=> $dataInput['usp_label_value'],'usp_type_value'=> $dataInput['usp_type_value'],'phone_code'=> $dataInput['phone_code'],'phone_number'=> $dataInput['phone_number'],'phone_number_alt'=> $dataInput['phone_number_alt'],'phone_shown'=> $dataInput['phone_shown'],'gender'=> $dataInput['gender'],'about'=> $dataInput['about'],'bio'=> $dataInput['bio']]);
$lastID= $dbh->lastInsertId();
$_vbuilder_feedback['result']=$result;
$_vbuilder_feedback['error']=$req->errorInfo();
$_vbuilder_feedback['data']=$lastID;
}

return $_vbuilder_feedback;
}
//CREATE, SCRIPT
public function init($user_id,$vbd_at_id){

$dbh=Database::ConnectPdo();


$query="INSERT INTO `vbd_user_pdata` ";
$query.=" (user_id,vbd_at_id) ";
$query.="VALUE(:user_id,:vbd_at_id)";

$req = $dbh->prepare($query);



$_vbuilder_feedback['result']=false;
if($req){

$result=$req->execute([
'user_id'=> $user_id,
'vbd_at_id'=> $vbd_at_id]
);
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

$query="UPDATE `vbd_user_pdata` ";
$query.="SET vbd_at_id=:vbd_at_id,user_bdate=:user_bdate, usp_label_value=:usp_label_value, usp_type_value=:usp_type_value, phone_code=:phone_code, phone_number=:phone_number, phone_number_alt=:phone_number_alt, phone_shown=:phone_shown, gender=:gender, about=:about, bio=:bio WHERE usp_id=:usp_id";

$req = $dbh->prepare($query);



$_vbuilder_feedback['result']=false;
if($req){

$result=$req->execute([ 
'usp_id'=> $dataInput['usp_id'],'user_bdate'=> $dataInput['user_bdate'],'vbd_at_id'=> $dataInput['vbd_at_id'],'usp_label_value'=> $dataInput['usp_label_value'],'usp_type_value'=> $dataInput['usp_type_value'],'phone_code'=> $dataInput['phone_code'],'phone_number'=> $dataInput['phone_number'],'phone_number_alt'=> $dataInput['phone_number_alt'],'phone_shown'=> $dataInput['phone_shown'],'gender'=> $dataInput['gender'],'about'=> $dataInput['about'],'bio'=> $dataInput['bio']]);
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

$query="UPDATE `vbd_user_pdata` ";
$query.="SET ".$final_str." WHERE usp_id=:usp_id";

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
$strClean=" WHERE deleted='".$dataInput['by']."' AND usp_id='".$dataInput['id']."'";
} else{

if(isset($dataInput['by'])){
$strClean=" WHERE deleted='".$dataInput['by']."'";
}  if(isset($dataInput['id'])){
$strClean=" WHERE usp_id='".$dataInput['id']."'";
}
if(isset($dataInput['user_id'])){
$strClean=" WHERE user_id='".$dataInput['user_id']."'";
}
}
$dbh=Database::ConnectPdo();
$query="SELECT * FROM `vbd_user_pdata`".$strClean;

$req = $dbh->prepare($query);
$_vbuilder_feedback['result']=false;
if($req){
$result=$req->execute();
$rows =$req->rowCount();
$datas=[];
$json=[];
while ($fetch=$req->fetch(PDO::FETCH_ASSOC)){



 $usp_id=$fetch['usp_id'];
 $user_id=$fetch['user_id'];
 $vbd_at_id=$fetch['vbd_at_id'];
 $usp_label_value=$fetch['usp_label_value'];
 $usp_type_value=$fetch['usp_type_value'];
 $phone_code=$fetch['phone_code'];
 $phone_number=$fetch['phone_number'];
 $phone_number_alt=$fetch['phone_number_alt'];
 $phone_shown=$fetch['phone_shown'];
 $gender=$fetch['gender'];
 $about=$fetch['about'];
 $bio=$fetch['bio'];
 $deleted=$fetch['deleted'];

$data=new Vbd_user_pdata($usp_id
,$user_id
,$vbd_at_id 
,$usp_label_value 
,$usp_type_value 
,$phone_code 
,$phone_number 
,$phone_number_alt 
,$phone_shown 
,$gender 
,$about 
,$bio 
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

$query="UPDATE `vbd_user_pdata` set deleted=? WHERE usp_id=?";
$req = $dbh->prepare($query);

$_vbuilder_feedback['result']=false;
if($req){
$result=$req->execute([$dataInput['condition'],$dataInput['usp_id'] ]);
$_vbuilder_feedback['result']=$result;
$_vbuilder_feedback['error']=$req->errorInfo();
$_vbuilder_feedback['affected']=$req->rowCount(); 
}

return $_vbuilder_feedback;
}


/// DELETE BASE, SCRIPT 
public function deleteBase($usp_id){
$dbh=Database::ConnectPdo();
$query="DELETE FROM `vbd_user_pdata` WHERE usp_id=?";
$req = $dbh->prepare($query);

$_vbuilder_feedback['result']=false;
if($req){
$result=$req->execute([$usp_id]);
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
