<?php
/**
* Created by VBuilder 
* Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Date: 27/10/2019, Sunday
* Time: 01:41 PM
* Project/Module: Newsletter*/

//PDO 



class Vbd_newsletterModel{



//CREATE, SCRIPT 
public function add($dataInput=[]){

$dbh=Database::ConnectPdo();


$query="INSERT INTO `vbd_newsletter` ";
$query.=" (ns_date,ns_subject,ns_body,ns_altbody,ns_cleanbody,ns_attach,user_id,ns_cover,ns_pdf) ";
$query.="VALUE(:ns_date,:ns_subject,:ns_body,:ns_altbody,:ns_cleanbody,:ns_attach,:user_id,:ns_cover,:ns_pdf)";

$req = $dbh->prepare($query);



$_vbuilder_feedback['result']=false;
if($req){

$result=$req->execute([
'ns_date'=> $dataInput['ns_date'],'ns_subject'=> $dataInput['ns_subject'],'ns_body'=> $dataInput['ns_body'],'ns_altbody'=> $dataInput['ns_altbody'],'ns_cleanbody'=> $dataInput['ns_cleanbody'],'ns_attach'=> $dataInput['ns_attach'],'user_id'=> $dataInput['user_id'],'ns_cover'=> $dataInput['ns_cover'],'ns_pdf'=> $dataInput['ns_pdf']]);
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

$query="UPDATE `vbd_newsletter` ";
$query.="SET ns_date=:ns_date, ns_subject=:ns_subject, ns_body=:ns_body, ns_altbody=:ns_altbody, ns_cleanbody=:ns_cleanbody, ns_attach=:ns_attach, user_id=:user_id, ns_cover=:ns_cover, ns_pdf=:ns_pdf WHERE ns_id=:ns_id";

$req = $dbh->prepare($query);



$_vbuilder_feedback['result']=false;
if($req){

$result=$req->execute([ 
'ns_id'=> $dataInput['ns_id'],'ns_date'=> $dataInput['ns_date'],'ns_subject'=> $dataInput['ns_subject'],'ns_body'=> $dataInput['ns_body'],'ns_altbody'=> $dataInput['ns_altbody'],'ns_cleanbody'=> $dataInput['ns_cleanbody'],'ns_attach'=> $dataInput['ns_attach'],'user_id'=> $dataInput['user_id'],'ns_cover'=> $dataInput['ns_cover'],'ns_pdf'=> $dataInput['ns_pdf']]);
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

$query="UPDATE `vbd_newsletter` ";
$query.="SET ".$final_str." WHERE ns_id=:ns_id";

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
$strClean=" WHERE deleted='".$dataInput['by']."' AND ns_id='".$dataInput['id']."'";
} else{

if(isset($dataInput['by'])){
$strClean=" WHERE deleted='".$dataInput['by']."'";
}  if(isset($dataInput['id'])){
$strClean=" WHERE ns_id='".$dataInput['id']."'";
}
}

$dbh=Database::ConnectPdo();
$query="SELECT * FROM `vbd_newsletter`".$strClean;
$req = $dbh->prepare($query);
$_vbuilder_feedback['result']=false;
if($req){
$result=$req->execute();
$rows =$req->rowCount();
$datas=[];
$json=[];
while ($fetch=$req->fetch(PDO::FETCH_ASSOC)){



 $ns_id=$fetch['ns_id'];
 $ns_date=$fetch['ns_date'];
 $ns_subject=$fetch['ns_subject'];
 $ns_body=$fetch['ns_body'];
 $ns_altbody=$fetch['ns_altbody'];
 $ns_cleanbody=$fetch['ns_cleanbody'];
 $ns_attach=$fetch['ns_attach'];
 $user_id=$fetch['user_id'];
 $ns_cover=$fetch['ns_cover'];
 $ns_pdf=$fetch['ns_pdf'];
 $deleted=$fetch['deleted'];

$data=new Vbd_newsletter($ns_id 
,$ns_date 
,$ns_subject 
,$ns_body 
,$ns_altbody 
,$ns_cleanbody 
,$ns_attach 
,$user_id 
,$ns_cover 
,$ns_pdf 
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

$query="UPDATE `vbd_newsletter` set deleted=? WHERE ns_id=?";
$req = $dbh->prepare($query);

$_vbuilder_feedback['result']=false;
if($req){
$result=$req->execute([$dataInput['condition'],$dataInput['ns_id'] ]);
$_vbuilder_feedback['result']=$result;
$_vbuilder_feedback['error']=$req->errorInfo();
$_vbuilder_feedback['affected']=$req->rowCount(); 
}

return $_vbuilder_feedback;
}


/// DELETE BASE, SCRIPT 
public function deleteBase($ns_id){
$dbh=Database::ConnectPdo();
$query="DELETE FROM `vbd_newsletter` WHERE ns_id=?";
$req = $dbh->prepare($query);

$_vbuilder_feedback['result']=false;
if($req){
$result=$req->execute([$ns_id]);
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
