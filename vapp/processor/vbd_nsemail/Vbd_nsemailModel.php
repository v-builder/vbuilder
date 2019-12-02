<?php
/**
* Created by VBuilder 
* Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Date: 27/10/2019, Sunday
* Time: 12:05 PM
* Project/Module: Newsletter Email*/

//PDO 



class Vbd_nsemailModel{



//CREATE, SCRIPT 
public function add($dataInput=[]){

$dbh=Database::ConnectPdo();


$query="INSERT INTO `vbd_nsemail` ";
$query.=" (nsemail_name,nsemail_email,nsemail_date) ";
$query.="VALUE(:nsemail_name,:nsemail_email,:nsemail_date)";

$req = $dbh->prepare($query);



$_vbuilder_feedback['result']=false;
if($req){

$result=$req->execute([
'nsemail_name'=> $dataInput['nsemail_name'],'nsemail_email'=> $dataInput['nsemail_email'],'nsemail_date'=> $dataInput['nsemail_date']]);
$lastID= $dbh->lastInsertId();
$_vbuilder_feedback['result']=$result;
$_vbuilder_feedback['error']=$req->errorInfo();
$_vbuilder_feedback['data']=$lastID;
}

return $_vbuilder_feedback;
}


//CREATE, SCRIPT
public function addEmail($dataInput=[]){

$dbh=Database::ConnectPdo();


$query="INSERT INTO `vbd_nsemail` ";
$query.=" (nsemail_email,nsemail_date) ";
$query.="VALUE(:nsemail_email,:nsemail_date)";

$req = $dbh->prepare($query);



$_vbuilder_feedback['result']=false;
if($req){

$result=$req->execute(['nsemail_email'=> $dataInput['nsemail_email'],'nsemail_date'=> $dataInput['nsemail_date']]);
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

$query="UPDATE `vbd_nsemail` ";
$query.="SET nsemail_name=:nsemail_name, nsemail_email=:nsemail_email, nsemail_date=:nsemail_date WHERE nsemail_id=:nsemail_id";

$req = $dbh->prepare($query);



$_vbuilder_feedback['result']=false;
if($req){

$result=$req->execute([ 
'nsemail_id'=> $dataInput['nsemail_id'],'nsemail_name'=> $dataInput['nsemail_name'],'nsemail_email'=> $dataInput['nsemail_email'],'nsemail_date'=> $dataInput['nsemail_date']]);
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

$query="UPDATE `vbd_nsemail` ";
$query.="SET ".$final_str." WHERE nsemail_id=:nsemail_id";

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
$strClean=" WHERE deleted='".$dataInput['by']."' AND nsemail_id='".$dataInput['id']."'";
} else{

if(isset($dataInput['by'])){
$strClean=" WHERE deleted='".$dataInput['by']."'";
}  if(isset($dataInput['id'])){
$strClean=" WHERE nsemail_id='".$dataInput['id']."'";
}
}

$dbh=Database::ConnectPdo();
$query="SELECT * FROM `vbd_nsemail`".$strClean;
$req = $dbh->prepare($query);
$_vbuilder_feedback['result']=false;
if($req){
$result=$req->execute();
$rows =$req->rowCount();
$datas=[];
$json=[];
while ($fetch=$req->fetch(PDO::FETCH_ASSOC)){



 $nsemail_id=$fetch['nsemail_id'];
 $nsemail_name=$fetch['nsemail_name'];
 $nsemail_email=$fetch['nsemail_email'];
 $nsemail_date=$fetch['nsemail_date'];
 $deleted=$fetch['deleted'];

$data=new Vbd_nsemail($nsemail_id 
,$nsemail_name 
,$nsemail_email 
,$nsemail_date 
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

$query="UPDATE `vbd_nsemail` set deleted=? WHERE nsemail_id=?";
$req = $dbh->prepare($query);

$_vbuilder_feedback['result']=false;
if($req){
$result=$req->execute([$dataInput['condition'],$dataInput['nsemail_id'] ]);
$_vbuilder_feedback['result']=$result;
$_vbuilder_feedback['error']=$req->errorInfo();
$_vbuilder_feedback['affected']=$req->rowCount(); 
}

return $_vbuilder_feedback;
}


/// DELETE BASE, SCRIPT 
public function deleteBase($nsemail_id){
$dbh=Database::ConnectPdo();
$query="DELETE FROM `vbd_nsemail` WHERE nsemail_id=?";
$req = $dbh->prepare($query);

$_vbuilder_feedback['result']=false;
if($req){
$result=$req->execute([$nsemail_id]);
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
