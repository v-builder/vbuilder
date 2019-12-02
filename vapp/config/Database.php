<?php


/**
 * Created by VBuilder | vbuilder.wtechbuilders.com/development
 * Author: Vayile Fumo
 * Org: Wise Tech-Builders
 * Date: 23/12/2018, Sunday
 * Time: 05:47 PM
 */

//CONNECTION SCRIPT

class Database
{

    private static $bdd = null;

    private static $host='localhost';

    private static $user='root';

    private static $pass='root';

//    private static $db='vtech';
    private static $db='vtech_7';

    private static $port='3306';


    private function __construct() {

    }


    public static function getVbRootPath()
    {
        $const="vbuilder.json";
        $rp="./";
        $rpForm="../";
        $rpFormNow="";
        $rpHelp="";
        $i=0;
        $file=$rp.$const;
        while(!file_exists($file)){
            $rpHelp=$rpHelp.$rpForm;
            $i++;
            $file=$rpHelp.$const;
            if($i==5){
            }
        }
        if($i>0){
            $rp=$rpHelp;
        }
        return $rp;
    }


    public static function Connect(){
        $con= new mysqli(self::$host,self::$user,self::$pass,self::$db,self::$port);
        if($con->connect_errno){
            die('Error connecting to the database server, '.$con->error);
        }
        else
        {
            $con->query("SET character_set_results=utf8");
            $con->query("set names 'utf8'");
        }

        return $con;

    }



    public static function ConnectPdo()

    {

        if(is_null(self::$bdd))
        {
            $temp_port=self::$port;
            $temp_host=self::$host;
            $temp_db=self::$db;
            self::$bdd = new PDO("mysql:host={$temp_host};port={$temp_port};dbname={$temp_db};charset=utf8",self::$user,self::$pass);
            self::$bdd->exec("set names utf8");
        }

        return self::$bdd;

    }



    public static function execute_base()

    {
        $success=false;
        $sqlFileToExecute = self::getVbRootPath().'config/base.sql';
        $link = self::Connect();
        if (!$link) {
            die ("MySQL Connection error");
        }


        $sqlErrorCode='err';
        $sqlErrorText='err';
        $f = fopen($sqlFileToExecute,"r+");
        $sqlFile = fread($f, filesize($sqlFileToExecute));
        $sqlArray = explode(';',$sqlFile);
        foreach ($sqlArray as $stmt) {
            if (strlen($stmt)>3 && substr(ltrim($stmt),0,2)!='/*') {
                $result = $link->query($stmt);
                if (!$result) {
                    $sqlErrorCode =$link->error;
                    $sqlErrorText = $link->error;
                    $sqlStmt = $stmt;
                    break;
                }
            }
        }
        if ($sqlErrorCode == 0) {
            $success=true;
        } else {
            echo "An error occured during installation! \n";
            echo "Error code: $sqlErrorCode \n";
            echo "Error text: $sqlErrorText \n";
            echo "Statement:\n $sqlStmt \n";
        }
        return $success;
    }

    public static function execute_app_base()
    {
        $success=false;
        $sqlFileToExecute = self::getVbRootPath().'config/app_base.sql';
        $link = self::Connect();
        if (!$link) {
            die ("MySQL Connection error");
        }


        $sqlErrorCode='err';
        $sqlErrorText='err';
        $f = fopen($sqlFileToExecute,"r+");
        $sqlFile = fread($f, filesize($sqlFileToExecute));
        $sqlArray = explode(';',$sqlFile);
        foreach ($sqlArray as $stmt) {
            if (strlen($stmt)>3 && substr(ltrim($stmt),0,2)!='/*') {
                $result = $link->query($stmt);
                if (!$result) {
                    $sqlErrorCode =$link->error;
                    $sqlErrorText = $link->error;
                    $sqlStmt = $stmt;
                    break;
                }
            }
        }
        if ($sqlErrorCode == 0) {
            $success=true;
        } else {
            echo "An error occured during installation! \n";
            echo "Error code: $sqlErrorCode \n";
            echo "Error text: $sqlErrorText \n";
            echo "Statement:\n $sqlStmt \n";
        }
        return $success;
    }


// All Rights Reserved By Vayile Félix Pessoa Fumo | vayilepessoa@gmail.com
// https://www.linkedin.com/in/vayile-fumo-a22a66170/
// Mozambique, Maputo


}
