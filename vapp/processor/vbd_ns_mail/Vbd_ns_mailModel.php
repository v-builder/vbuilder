<?php
/**
* Created by VBuilder 
* Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Date: 27/10/2019, Sunday
* Time: 01:43 PM
* Project/Module: Newsletter Message*/

//PDO 



class Vbd_ns_mailModel{



//CREATE, SCRIPT 
public function add($dataInput=[]){

$dbh=Database::ConnectPdo();


$query="INSERT INTO `vbd_ns_mail` ";
$query.=" (nsmail_date,ns_id,nsemail_id,ns_state) ";
$query.="VALUE(:nsmail_date,:ns_id,:nsemail_id,:ns_state)";

$req = $dbh->prepare($query);



$_vbuilder_feedback['result']=false;
if($req){

$result=$req->execute([
'nsmail_date'=> $dataInput['nsmail_date'],'ns_id'=> $dataInput['ns_id'],'nsemail_id'=> $dataInput['nsemail_id'],'ns_state'=> $dataInput['ns_state']]);
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

$query="UPDATE `vbd_ns_mail` ";
$query.="SET nsmail_date=:nsmail_date, ns_id=:ns_id, nsemail_id=:nsemail_id, ns_state=:ns_state WHERE nsmail_id=:nsmail_id";

$req = $dbh->prepare($query);



$_vbuilder_feedback['result']=false;
if($req){

$result=$req->execute([ 
'nsmail_id'=> $dataInput['nsmail_id'],'nsmail_date'=> $dataInput['nsmail_date'],'ns_id'=> $dataInput['ns_id'],'nsemail_id'=> $dataInput['nsemail_id'],'ns_state'=> $dataInput['ns_state']]);
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

$query="UPDATE `vbd_ns_mail` ";
$query.="SET ".$final_str." WHERE nsmail_id=:nsmail_id";

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
$strClean=" WHERE deleted='".$dataInput['by']."' AND nsmail_id='".$dataInput['id']."'";
} else{

if(isset($dataInput['by'])){
$strClean=" WHERE deleted='".$dataInput['by']."'";
}  if(isset($dataInput['id'])){
$strClean=" WHERE nsmail_id='".$dataInput['id']."'";
}
}

$dbh=Database::ConnectPdo();
$query="SELECT * FROM `vbd_ns_mail`".$strClean;
$req = $dbh->prepare($query);
$_vbuilder_feedback['result']=false;
if($req){
$result=$req->execute();
$rows =$req->rowCount();
$datas=[];
$json=[];
while ($fetch=$req->fetch(PDO::FETCH_ASSOC)){



 $nsmail_id=$fetch['nsmail_id'];
 $nsmail_date=$fetch['nsmail_date'];
 $ns_id=$fetch['ns_id'];
 $nsemail_id=$fetch['nsemail_id'];
 $ns_state=$fetch['ns_state'];
 $deleted=$fetch['deleted'];

$data=new Vbd_ns_mail($nsmail_id 
,$nsmail_date 
,$ns_id 
,$nsemail_id 
,$ns_state 
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


// READ, SCRIPT
public function readComplete($dataInput=[]){


$strClean="";

$strClean="";
if(isset($dataInput['by']) && isset($dataInput['id'])){
$strClean=" WHERE vbd_ns_mail.deleted='".$dataInput['by']."' AND vbd_ns_mail.nsmail_id='".$dataInput['id']."'";
} else{

if(isset($dataInput['by'])){
$strClean=" WHERE vbd_ns_mail.deleted='".$dataInput['by']."'";
}  if(isset($dataInput['id'])){
$strClean=" WHERE vbd_ns_mail.nsmail_id='".$dataInput['id']."'";
}
}

$dbh=Database::ConnectPdo();
$query="SELECT vbd_ns_mail.nsmail_id, vbd_ns_mail.nsmail_date, vbd_ns_mail.ns_id, vbd_ns_mail.nsemail_id, vbd_ns_mail.ns_state, vbd_ns_mail.deleted, vbd_nsemail.nsemail_name, vbd_nsemail.nsemail_email, vbd_newsletter.ns_subject   FROM `vbd_ns_mail` LEFT JOIN vbd_nsemail ON vbd_ns_mail.nsemail_id=vbd_nsemail.nsemail_id LEFT JOIN vbd_newsletter ON vbd_ns_mail.ns_id=vbd_newsletter.ns_id".$strClean;
$req = $dbh->prepare($query);
$_vbuilder_feedback['result']=false;
if($req){
$result=$req->execute();
$rows =$req->rowCount();
$datas=[];
$json=[];
while ($fetch=$req->fetch(PDO::FETCH_ASSOC)){



 $nsmail_id=$fetch['nsmail_id'];
 $nsmail_date=$fetch['nsmail_date'];
 $ns_id=$fetch['ns_id'];
 $nsemail_id=$fetch['nsemail_id'];
 $ns_state=$fetch['ns_state'];
 $deleted=$fetch['deleted'];

$data=new Vbd_ns_mail($nsmail_id
,$nsmail_date
,$ns_id
,$nsemail_id
,$ns_state
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

$query="UPDATE `vbd_ns_mail` set deleted=? WHERE nsmail_id=?";
$req = $dbh->prepare($query);

$_vbuilder_feedback['result']=false;
if($req){
$result=$req->execute([$dataInput['condition'],$dataInput['nsmail_id'] ]);
$_vbuilder_feedback['result']=$result;
$_vbuilder_feedback['error']=$req->errorInfo();
$_vbuilder_feedback['affected']=$req->rowCount(); 
}

return $_vbuilder_feedback;
}


/// DELETE BASE, SCRIPT 
public function deleteBase($nsmail_id){
$dbh=Database::ConnectPdo();
$query="DELETE FROM `vbd_ns_mail` WHERE nsmail_id=?";
$req = $dbh->prepare($query);

$_vbuilder_feedback['result']=false;
if($req){
$result=$req->execute([$nsmail_id]);
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
