<?php
header('Content-Type: application/json');

define("PATH_TO_VBD","");
require_once "engine/EngineBuild.php";




$result=Database::Connect();
$datas['db-con']=['pdo'=>false,'mysqli'=>false];
if(!$result->connect_errno){

    $datas['db-con']['mysqli']=true;
}

$dbh=Database::ConnectPdo();
$query="SHOW TABLES;";
$req = $dbh->prepare($query);

if($req){
    $datas['db-con']['pdo']=true;
}

echo json_encode($datas);