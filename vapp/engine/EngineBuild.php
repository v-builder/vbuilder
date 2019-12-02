<?php
/**
 * Created by PhpStorm.
 * User: brandlovers
 * Date: 2019-05-14
 * Time: 12:34
 */
// uncomment bellow to access from any url
//header("Access-Control-Allow-Origin: *");

// uncomment bellow to access from particular url
//header('Access-Control-Allow-Origin: http://www.co.mz', true);
//header('Access-Control-Allow-Origin: http://www.co.mz', false);

//INCLUDE DATABASE BY DEFAULT
EngineBuild::Database();

// Entity Name
define("VBD_ENTITY_NAME","VBuilder inc.");

// Entity email
define("VBD_ENTITY_EMAIL","vbuilder.world@gmail.com");

// URL to vbd project root
define("VBD_ROOT",((defined('VBD_W_WP') && !defined('VBD_W_WP_INNER'))? get_site_url() :
    "http://localhost/vbuilder" ));

// vbd project root [to: vendors, imgs 'more used to get in wordpress template files']
define("VBD_TEMPLATE_ROOT",((defined('VBD_W_WP'))? get_template_directory_uri() :
    "http://localhost/vbuilder" ));
//    "http://192.168.254.111/vworld" ));

// address to log in to account
define("VBD_LOGIN_URL",VBD_ROOT.((defined('VBD_W_WP'))?
        "/login" :
        "/vbd-login.php"));

// address to log in to account
define("VBD_USERS_URL",VBD_ROOT.((defined('VBD_W_WP'))?
        "/user/?username=" :
        "/user.php/?username="));

// address to register a new account
define("VBD_REGISTER_URL",VBD_ROOT.((defined('VBD_W_WP'))?
        "/register" :
        "/vbd-register.php"));

// url to reset passswor
define("VBD_RESETP_URL",VBD_ROOT.((defined('VBD_W_WP'))?
        "/reset-password" :
        "/vbd-reset-password.php"));

// URL to verify email
define("VBD_EMAIL_CONF_URL",VBD_ROOT.((defined('VBD_W_WP'))?
        "/verify-email" :
        "/vbd-verify-email.php"));

// URL to my account
define("VBD_URL_MYACCOUNT",VBD_ROOT.((defined('VBD_W_WP'))?
        "/my-account" :
        "/vbd-my-account.php"));

// VBD App folder name
define("VBD_APP","vapp");


// VBD Max User Level Admin ID
define("VBD_MAXL_ADMIN",4);

// User log expiration/time control ------------------
define("VBD_LOG_CONTROL",[

    "1"=> ["mode"=> "days", "value"=> "3" ],
    "2"=> ["mode"=> "days", "value"=> "6" ],
    "3"=> ["mode"=> "days", "value"=> "15" ],
    "4"=> ["mode"=> "days", "value"=> "23" ],
    "5"=> ["mode"=> "days", "value"=> "30" ],
    "6"=> ["mode"=> "days", "value"=> "60" ]

]);

//  ------------------

// App time zone
define("VBD_TIMEZONE","Africa/Maputo");

// encryption keys
//SECURITY KEY & IV | Once the app deployed cannot simple change the keys bellow
define("VBD_SECRET_KEY","T!O@^tA.8G1tWCjoLR+p,QBs:3@v1b9d2r0v1b6d0r9Is4mrF6eJWM~Sim}fTXP+");
define("VBD_SECRET_IV","v1b6d0r9v1b9d2r0T!O@^tA.8G1tWCjoLR+p,QBs:3@Is4mrF6pJWM~Sim}fTXP+");
define("JWT_KEY","T!O@^tA.8G1tWCjoLR+p,QBs:3@v1b9d2r0v1b6d0r9Is4mrF6eJWM~Sim}fTXP+");



// EMAIL DEFAULT CONFIGURATIONS
define("VBD_EMAIL_DEF_CONFIG",
    [
        //if you want to debug | true to tests, false to production
        "smtpDebug"=>true,
        // debug type
        "smtpDebugType"=>2,

        "charset"=>"UTF-8",
        // gmail: smtp.gmail.com"
        "host"=>"smtp.gmail.com",
        "isSmtp"=>true,
        // smtp authentication
        "smtpAuth"=>true,
        // ssl/tls
        "smtpSecure"=>"ssl",
        // 587/465 | gmail: 587
        "port"=>"465",
        'username'=>"vbuilder.world@gmail.com",
        "password"=>"unlockVbuilder1920",

        "from"=>["email"=>"vbuilder.world@gmail.com","name"=>"VBuilder inc."],
//        "to"=>[ ["email"=>"vbuilder.world@gmail.comm","name"=>"VBuilder inc."] ],
//            "reply"=>[ ["email"=>"email@domain.com","name"=>"Name Surname"] ],
//            "cc"=>[ ["email"=>"email@domain.com","name"=>"Name Surname"] ],
//            "bcc"=>[ ["email"=>"email@domain.com","name"=>"Name Surname"] ],

//        "subject"=>"Password Recovery",
        "isHTML"=>true,
//        "body"=>"Powered by VBuilder inc.",

        //This is the body in plain text for non-HTML mail clients
//            "altBody"=>"Powered by VBuilder inc.",
    ]
);





/*
----------------------- DO NOT EDIT THE CODE BELLOW -----------------------------------
---------------------------------------------------------------------------------------*/

function vbdCWP($strxc){
    return str_ireplace('.php','',$strxc);
}

Class EngineBuild{

    private static $root;
    private static $require;
    private static $functionAlert;
    private static $app_root;
    private static $app_template_url;




    /**
     * EngineBuild constructor.
     * @param $root
     */
    public function __construct()
    {
        self::$root = self::getVbRootPath();
        self::$require= true;
        self::$functionAlert= true;
        self::$app_root= VBD_APP;
        self::$app_template_url= '';

    }


    public static function getVbRootPath(){
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


    public static function isRequest(){

        $submited=['state'=>false,"method"=>""];

        if($_POST){
            $submited['state']=true;
            $submited['method']="post";
        }
        if($_GET){
            $submited['state']=true;
            $submited['method']="get";
        }
        return $submited;
    }

    public static function getVbRootScope(){
        $const="root_scope.json";
        $rp="";
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


    public static function Database(){


        if( defined('VBD_W_WP') ){
            include_once (self::vbd_wp_theme_dir().PATH_TO_VBD."config/Database.php");
        } else{
            if(file_exists(PATH_TO_VBD."config/Database.php")){
                include_once PATH_TO_VBD."config/Database.php";
            }
        }

    }
    public static function vbd_wp_theme_dir(){


        return "wp-content/themes/".self::wpThemeName()."/";

    }

    public static function loadDetect(){


        if( defined('VBD_W_WP') ){

            include_once (self::vbd_wp_theme_dir().PATH_TO_VBD."engine/detect.clean.php");

        } else{
            if(file_exists(PATH_TO_VBD."engine/detect.clean.php")){
                include_once PATH_TO_VBD."engine/detect.clean.php";
            }
        }

    }

    public static function loadEmailPackage(){

            if( defined('VBD_W_WP') ){

                require_once self::vbd_wp_theme_dir().PATH_TO_VBD.'lib/email/PHPMailer/src/Exception.php';
                require_once self::vbd_wp_theme_dir().PATH_TO_VBD.'lib/email/PHPMailer/src/PHPMailer.php';
                require_once self::vbd_wp_theme_dir().PATH_TO_VBD.'lib/email/PHPMailer/src/SMTP.php';


            } else{

                require_once PATH_TO_VBD.'lib/email/PHPMailer/src/Exception.php';
                require_once PATH_TO_VBD.'lib/email/PHPMailer/src/PHPMailer.php';
                require_once PATH_TO_VBD.'lib/email/PHPMailer/src/SMTP.php';

            }

    }

    public static function loadTinyPHP(){

            if( defined('VBD_W_WP') ){

                require_once self::vbd_wp_theme_dir().PATH_TO_VBD.'lib/email/PHPMailer/src/Exception.php';
                require_once self::vbd_wp_theme_dir().PATH_TO_VBD.'lib/email/PHPMailer/src/PHPMailer.php';
                require_once self::vbd_wp_theme_dir().PATH_TO_VBD.'lib/email/PHPMailer/src/SMTP.php';


            } else{

                require_once PATH_TO_VBD.'lib/email/PHPMailer/src/Exception.php';
                require_once PATH_TO_VBD.'lib/email/PHPMailer/src/PHPMailer.php';
                require_once PATH_TO_VBD.'lib/email/PHPMailer/src/SMTP.php';

            }

    }

    public static function sendEmail($arrayVB=[]){

        EngineBuild::loadEmailPackage();





        $mailVB = new PHPMailer(true);

        try {
            //Server settings
            $mailVB->CharSet =$arrayVB['charset'];
            if($arrayVB['smtpDebug']){
                $mailVB->SMTPDebug = $arrayVB['smtpDebugType'];                                       // Enable verbose debug output
            }
            if($arrayVB['isSmtp']){
                $mailVB->isSMTP();
            }                                           // Set mailer to use SMTP
            $mailVB->Host       = $arrayVB['host'];  // Specify main and backup SMTP servers
            $mailVB->SMTPAuth   = $arrayVB['smtp'];                                   // Enable SMTP authentication
            $mailVB->Username   = $arrayVB['username'];                     // SMTP username
            $mailVB->Password   = $arrayVB['password'];                               // SMTP password
            $mailVB->SMTPSecure = $arrayVB['smtpSecure'];                                  // Enable TLS encryption, `ssl` also accepted
            $mailVB->Port       = $arrayVB['port'];                                     // TCP port to connect to 587: tls 465:ssl
            // TCP port to connect to

            //Recipients
            if(isset($arrayVB['from']['name'])){
                $mailVB->setFrom($arrayVB['from']['email'], $arrayVB['from']['name']);
            } else{
                $mailVB->setFrom($arrayVB['from']['email']);
            }

            foreach ($arrayVB['to'] as $kx=>$vx){
                if(isset($vx['name'])){
                    $mailVB->addAddress($vx['email'],$vx['name']);
                } else{
                    $mailVB->addAddress($vx['email']);
                }
            }

            if(isset($arrayVB['reply'])) {

                foreach ($arrayVB['reply'] as $kx => $vx) {
                    if (isset($vx['name'])) {
                        $mailVB->addReplyTo($vx['email'], $vx['name']);
                    } else {
                        $mailVB->addReplyTo($vx['email']);


                    }
                }
            }

            if(isset($arrayVB['cc'])) {

                foreach ($arrayVB['cc'] as $kx => $vx) {
                    if (isset($vx['name'])) {
                        $mailVB->addCC($vx['email'], $vx['name']);
                    } else {
                        $mailVB->addCC($vx['email']);


                    }
                }
            }

            if(isset($arrayVB['bcc'])) {

                foreach ($arrayVB['bcc'] as $kx => $vx) {
                    if (isset($vx['name'])) {
                        $mailVB->addBCC($vx['email'], $vx['name']);
                    } else {
                        $mailVB->addBCC($vx['email']);
                    }
                }
            }

            // Attachments
//            $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//            $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mailVB->isHTML($arrayVB['isHTML']);                                  // Set email format to HTML
            $mailVB->Subject = $arrayVB['subject'];
            $mailVB->Body    = $arrayVB['body'];
            //This is the body in plain text for non-HTML mail clients
            if(isset($arrayVB['altBody'])){
                $mailVB->AltBody = $arrayVB['altBody'];
            }

            $stateMailVB['result']=$mailVB->send();

            echo 'Message has been sent';
        } catch (Exception $e) {

            $stateMailVB['result']=false;
            $stateMailVB['error']=$mailVB->ErrorInfo;
            echo $mailVB->ErrorInfo;
            }

        return $stateMailVB;

    }

    public static function wpThemeName(){

        return ( (defined('VBD_W_WP'))?  str_replace( '%2F', '/', rawurlencode( get_template())) : "" );

    }

    public static function getAppRoot(){

        return PATH_TO_VBD;

    }
    public static function getAppRootClean(){

        return str_replace(PATH_TO_VBD,self::getVbdApp().'/','');

    }
    public static function getVbdApp(){

        return VBD_APP;

    }
    public static function getRoot(){

        return self::$root;

    }

    public static function getAppUrl(){

        return VBD_ROOT;

    }
    public static function getAppTemplateUrl(){

        return ((self::$app_template_url=='') ? VBD_TEMPLATE_ROOT : self::$app_template_url);

    }


    public static function getVbdTemplateUrl(){

        return VBD_TEMPLATE_ROOT.'/'.self::getVbdApp();

    }

    public static function setAppTemplateUrl($strIn){

        self::$app_template_url=$strIn;

    }


    public static function BuildProcessor($processor){

        if(self::$require){

            if( defined('VBD_W_WP') ){


                if(file_exists(self::vbd_wp_theme_dir().PATH_TO_VBD."processor/".strtolower($processor)."/".ucfirst(strtolower($processor)).".php")){

                    require_once (self::vbd_wp_theme_dir().PATH_TO_VBD."processor/".strtolower($processor)."/".ucfirst(strtolower($processor)).".php");
                }
                if(file_exists(self::vbd_wp_theme_dir().PATH_TO_VBD."processor/".strtolower($processor)."/".ucfirst(strtolower($processor))."Model.php")){

                    require_once (self::vbd_wp_theme_dir().PATH_TO_VBD."processor/".strtolower($processor)."/".ucfirst(strtolower($processor))."Model.php");
                }

            } else{

                if(file_exists(PATH_TO_VBD."processor/".strtolower($processor)."/".ucfirst(strtolower($processor)).".php")){

                    require_once PATH_TO_VBD."processor/".strtolower($processor)."/".ucfirst(strtolower($processor)).".php";
                }
                if(file_exists(PATH_TO_VBD."processor/".strtolower($processor)."/".ucfirst(strtolower($processor))."Model.php")){

                    require_once PATH_TO_VBD."processor/".strtolower($processor)."/".ucfirst(strtolower($processor))."Model.php";
                }

            }



        } else{



            if( defined('VBD_W_WP') ){


                if(file_exists(self::vbd_wp_theme_dir().PATH_TO_VBD."processor/".strtolower($processor)."/".ucfirst(strtolower($processor)).".php")){

                    include_once (self::vbd_wp_theme_dir().PATH_TO_VBD."processor/".strtolower($processor)."/".ucfirst(strtolower($processor)).".php");
                }
                if(file_exists(self::vbd_wp_theme_dir().PATH_TO_VBD."processor/".strtolower($processor)."/".ucfirst(strtolower($processor))."Model.php")){

                    include_once (self::vbd_wp_theme_dir().PATH_TO_VBD."processor/".strtolower($processor)."/".ucfirst(strtolower($processor))."Model.php");
                }

            } else {

                if(file_exists(PATH_TO_VBD."processor/".strtolower($processor)."/".ucfirst(strtolower($processor)).".php")){

                    include_once PATH_TO_VBD."processor/".strtolower($processor)."/".ucfirst(strtolower($processor)).".php";
                }
                if(file_exists(PATH_TO_VBD."processor/".strtolower($processor)."/".ucfirst(strtolower($processor))."Model.php")){

                    include_once PATH_TO_VBD."processor/".strtolower($processor)."/".ucfirst(strtolower($processor))."Model.php";
                }

            }


        }


    }
    public static function BuildBindingProcessor($processor,$action){

        if( defined('VBD_W_WP') ){

            if(self::$require){


                if(file_exists(self::vbd_wp_theme_dir().PATH_TO_VBD."processor/".strtolower($processor)."/".$action.".php")){
                    require_once self::vbd_wp_theme_dir().PATH_TO_VBD."processor/".strtolower($processor)."/".$action.".php";
                }


            }
            else
            {

                if(file_exists(self::vbd_wp_theme_dir().PATH_TO_VBD."processor/".strtolower($processor)."/".$action.".php")){

                    include_once self::vbd_wp_theme_dir().PATH_TO_VBD."processor/".strtolower($processor)."/".$action.".php";
                }

            }
            // end part one

        } else{


            if(self::$require){


                if(file_exists(PATH_TO_VBD."processor/".strtolower($processor)."/".$action.".php")){
                    require_once PATH_TO_VBD."processor/".strtolower($processor)."/".$action.".php";
                }


            }
            else
            {

                if(file_exists(PATH_TO_VBD."processor/".strtolower($processor)."/".$action.".php")){

                    include_once PATH_TO_VBD."processor/".strtolower($processor)."/".$action.".php";
                }

            }

        }



    }


    public static function BuildBindingProcessorScope($pathx){

//        echo self::getVbRootScope().$path."";

        $tempVar=$pathx;
        $tempVar=vbdCWP($tempVar)."";

        if( defined('VBD_W_WP') ){
            get_template_part( $tempVar, get_post_format() );
        } else {


            if(self::$require){

                if(file_exists($pathx)){
                    require $pathx."";
                }

            }
            else
            {

                if(file_exists($pathx)){

                    include $pathx."";
                }

            }


        }


    }

    public static function BuildBindingCleanScope($pathx){

//        echo self::getVbRootScope().$path."";



            if(self::$require){

                if(file_exists($pathx)){
                    require $pathx."";
                }

            }
            else
            {

                if(file_exists($pathx)){

                    include $pathx."";
                }

            }




    }

    public static function vbd_header($path){

//        echo self::getVbRootScope().$path."";

        if( defined('VBD_W_WP') ){
            get_header();
        } else{


            if(self::$require){

                if(file_exists($path)){
                    require $path."";
                }

            }
            else
            {

                if(file_exists($path)){

                    include $path."";
                }

            }


        }

    }


    public static function vbd_footer($path){

//        echo self::getVbRootScope().$path."";

        if( defined('VBD_W_WP') ){
            get_footer();
        } else{


            if(self::$require){

                if(file_exists($path)){
                    require $path."";
                }

            }
            else
            {

                if(file_exists($path)){

                    include $path."";
                }

            }


        }

    }



    public static function BuildSelfFunctions($functionAlerto,$method, $array=[]){


        foreach ($array as $k=>$v){

            if($method=='post'){

                if(isset($_POST['vbd_method']) && $k==$_POST['vbd_method']){



                    if(file_exists("./functions/".$v.".php")){

                        include_once "./functions/".$v.".php";
                    } else{

                        if($functionAlerto){

                            echo ">> NOT EXISTENT FILE: ".self::getVbRootPath()."./functions/".$v.".php  for {$k}";
                        }
                    }


                }


            } else {


                if(isset($_GET['vbd_method']) && $k==$_GET['vbd_method']){



                    if(file_exists("./functions/".$v.".php")){

                        include_once "./functions/".$v.".php";
                    } else{

                        if($functionAlerto){

                            echo ">> NOT EXISTENT FILE: ".self::getVbRootPath()."./functions/".$v.".php  for {$k}";
                        }
                    }


                }

            }


        }




    }

    public static function RequiredFields($method, $array=[] ){

        $data=['missing'=>['count'=>0]];

        foreach ($array as $k => $v){

            if($method=='post'){

                if(!isset($_POST[$v])){
                    $data['missing']['count']+=1;
                    $data['missing']['data'][]=$v."";
                }

            } else{

                // IS GET
                if(!isset($_GET[$v])){
                    $data['missing']['count']+=1;
                    $data['missing']['data'][]=$v."";
                }

            }
        }

        return $data;
    }

    public static function ValidateFields($method, $vbd_validate, $array=[] ){

        $data=['state'=>true,'error'=>['count'=>0]];

        if($vbd_validate){

            foreach ($array as $k => $v){

                if($method=='post'){

                    if(isset($_POST[$k])){

                        foreach ($v as $k2 =>$v2){

                            if($k2=='type' && $v2=='email'){

//                                if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$_POST[$k]))
//                                {
//                                    $data['error']['count']+=1;
//                                    $data['state']=false;
//                                    $data['error']['data'][]= [$k=>"email"];
//                                }

                            }
                            if($k2=='min' ){

                                if (strlen(ltrim(rtrim($_POST[$k]))) <$v2) {
                                    $data['error']['count']+=1;
                                    $data['state']=false;
                                    $data['error']['data'][]= [$k=>"min"];
                                }

                            }
                            if($k2=='max' ){

                                if (strlen(ltrim(rtrim($_POST[$k]))) >$v2) {
                                    $data['error']['count']+=1;
                                    $data['state']=false;
                                    $data['error']['data'][]= [$k=>"max"];
                                }

                            }
                            if($k2=='length' ){

                                if (strlen(ltrim(rtrim($_POST[$k]))) !=$v2) {
                                    $data['error']['count']+=1;
                                    $data['state']=false;
                                    $data['error']['data'][]= [$k=>"length"];
                                }

                            }
                            if($k2=='type' && $v2=='nospace'){

                                if ( preg_match('/\s/',$_POST[$k] ) ) {
                                    $data['error']['count']+=1;
                                    $data['state']=false;
                                    $data['error']['data'][]= [$k=>"nospace"];
                                }

                            }

                        }
//                    end of foreach
                    }
                }
                else
                {

                    // IS GET

                    if(isset($_GET[$k])){

                        foreach ($v as $k2 =>$v2){

                            if($k2=='type' && $v2=='email'){

                                if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$_GET[$k]))
                                {
                                    $data['error']['count']+=1;
                                    $data['state']=false;
                                    $data['error']['data'][]= [$k=>"email"];
                                }

                            }
                            if($k2=='min' ){

                                if (strlen(ltrim(rtrim($_GET[$k]))) <$v2) {
                                    $data['error']['count']+=1;
                                    $data['state']=false;
                                    $data['error']['data'][]= [$k=>"min"];
                                }

                            }
                            if($k2=='max' ){

                                if (strlen(ltrim(rtrim($_GET[$k]))) >$v2) {
                                    $data['error']['count']+=1;
                                    $data['state']=false;
                                    $data['error']['data'][]= [$k=>"max"];
                                }

                            }
                            if($k2=='length' ){

                                if (strlen(ltrim(rtrim($_GET[$k]))) !=$v2) {
                                    $data['error']['count']+=1;
                                    $data['state']=false;
                                    $data['error']['data'][]= [$k=>"length"];
                                }

                            }
                            if($k2=='type' && $v2=='nospace'){

                                if ( preg_match('/\s/',$_GET[$k] ) ) {
                                    $data['error']['count']+=1;
                                    $data['state']=false;
                                    $data['error']['data'][]= [$k=>"nospace"];
                                }

                            }

                        }
//                    end of foreach
                    }

                }
            }

        }

        return $data;

    }

    public static function GetField($method,$value){


        $data="";
        if($method=='post'){

            if(isset($_POST[$value])){
                $data=$_POST[$value];
            }

        } else{

            // IS GET
            if(isset($_GET[$value])){
                $data=$_GET[$value];
            }

        }

        return $data;
    }

    public static function GetFieldNl($method,$value){


        $data=null;
        if($method=='post'){

            if(isset($_POST[$value])){
                $data=$_POST[$value];
            }

        } else{

            // IS GET
            if(isset($_GET[$value])){
                $data=$_GET[$value];
            }

        }

        return $data;
    }



    public static function redirectPage($P_URL){
        if(!headers_sent()){
            header('location: '.$P_URL);
        } else{
            echo "<script type='text/javascript'> window.location.replace('".$P_URL."'); </script>";
        }

    }
    /**
     * @param string $root
     */
    public static function setRoot($root)
    {
        self::$root = $root;
    }

    /**
     * @return bool
     */
    public static function isRequire()
    {
        return self::$require;
    }

    /**
     * @param bool $require
     */
    public static function setRequire($require)
    {
        self::$require = $require;
    }

    /**
     * @return bool
     */
    public static function isFunctionAlert()
    {
        return self::$functionAlert;
    }

    /**
     * @param bool $functionAlert
     */
    public static function setFunctionAlert($functionAlert)
    {
        self::$functionAlert = $functionAlert;
    }






}





function cryptThisVbuilder($data){

    $enc= encrypt_decrypt_custom('encrypt',$data,VBD_SECRET_KEY,VBD_SECRET_IV);
    $dec= encrypt_decrypt_custom('decrypt',$data,VBD_SECRET_KEY,VBD_SECRET_IV);
    return ['e'=>$enc,'d'=>$dec];
}


/*
function cryptThisVbuilderWithBase($data){
    $enc= encrypt_decrypt_custom('encrypt',$data,'v1b9d2r0v1b6d0r9','v1b6d0r9v1b9d2r0');
    $dec= encrypt_decrypt_custom('decrypt',$data,'v1b9d2r0v1b6d0r9','v1b6d0r9v1b9d2r0');
    return ['e'=>$enc,'d'=>$dec];
}*/

function encrypt_decrypt_custom($action, $string,$secret_key,$secret_iv) {
    $output = false;
    $encrypt_method = "AES-256-CBC";

    // hash
    $key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if( $action == 'decrypt' ) {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}


function vbdIncludeJWT(){
    if( defined('VBD_W_WP') ){
        include_once (EngineBuild::vbd_wp_theme_dir().PATH_TO_VBD."engine/jwt_helper.php");
    } else{
        if(file_exists(PATH_TO_VBD."engine/jwt_helper.php")){
            include_once PATH_TO_VBD."engine/jwt_helper.php";
        }
    }
}



function jwtEncode($str){
    vbdIncludeJWT();
    return JWT::encode([$str],JWT_KEY, $algo = 'HS256');
}


function jwtDecode($jwt){
    vbdIncludeJWT();
    return JWT::decode($jwt,JWT_KEY, $verify = true)[0];
}




function randomString($length ) {
    $str = "";
    $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
    $max = count($characters) - 1;
    for ($i = 0; $i < $length; $i++) {
        $rand = mt_rand(0, $max);
        $str .= $characters[$rand];
    }
    return $str;
}




// LOG FUNCTIONS

function getRandomStrCryptedFromArray($array=[]){
    $length=sizeof($array);
    $random= rand(0,$length-1);

    return cryptThisVbuilder(randomString($array[$random]))['e'];

}

function keyEncryption( $param=[] ){
    $reservedIndex=array();
    $random['state']=false;
    $KEY_GUIDE=array();
    $averageStrlenData=array();

    $interval['first']=0;
    $interval['last']=10;
    if( ($param['config']['total']>6) && ($param['config']['total'] <=30)){
        $interval['last']=$param['config']['total'];
    } else{
        $param['config']['total']=13;
    }


    if($param['config']['set_random_index']['enable']){
        if($param['config']['set_random_index']['interval'][0]<$param['config']['total']-2){
            $interval['first']=$param['config']['set_random_index']['interval'][0];
        }
        if($param['config']['set_random_index']['interval'][0]<=$param['config']['total']){
            $interval['last']=$param['config']['set_random_index']['interval'][1];
        }
    }


    foreach ($param['data'] as $k => $v){

        $averageStrlenData[]=strlen($v['value']);
        $position=rand($interval['first'],$interval['last']);

        while (isset($reservedIndex[$position]) ){
            $position=rand($interval['first'],$interval['last']);
        }

        $reservedIndex[$position]=$v['value'];
        $KEY_GUIDE[$k]=cryptThisVbuilder($position)['e'];
    }
    $FINAL_KEY_DATA=array();
    for($i=0; $i<=$param['config']['total'];$i++){
        $finalData=null;
        if(isset($reservedIndex[$i])){
            $finalData= cryptThisVbuilder( $reservedIndex[$i] )['e'];
        }
        else
        {
            $finalData=getRandomStrCryptedFromArray($averageStrlenData);
        }
        $FINAL_KEY_DATA[$i]=$finalData;
    }
    $FINAL_KEY_DATA[]=cryptThisVbuilder($param['data']['log_id']['value'])['e'];
    return ['data'=>JWT::jsonEncode($FINAL_KEY_DATA),'guide'=>JWT::jsonEncode($KEY_GUIDE)];
}


function is_valid_vbd_key( $vbd_key){




    $state=false;
    if(strlen($vbd_key)>10){
        $requiredStart='["';
        $givenStart= substr($vbd_key,0,2);
        if($givenStart==$requiredStart){
            $state=true;
        }

    }
    return $state;
}





function vbd_key_app_retrieveGuide($keyEncryptionData){

    EngineBuild::BuildProcessor("Vbd_log_track");

    $guide=array();
    $guide['result']=false;

    $log_id=cryptThisVbuilder(array_pop($keyEncryptionData))['d'];

    $Vbuilder_log_trackModel= new Vbd_log_trackModel();
    $dataVbuilder_log_track=$Vbuilder_log_trackModel->read(["by"=>"false"]);
    rsort($dataVbuilder_log_track['data']);

    foreach($dataVbuilder_log_track['data'] as $vbdK=>$vbdV){
        if($log_id==$vbdV->getLog_id()){
            $guide['result']=true;
            $guide['data']=$vbdV->getLog_guide();
            break;
        }
    }



    return $guide;
}

function vbd_key_retrieve($keyEncryptionData,$keyEncryptionGuide){
    $gatheredData=array();
    $sizeofGuide=0;
    foreach ($keyEncryptionGuide as $ki => $vi){

        $index=cryptThisVbuilder($vi)['d'];


        if(isset($keyEncryptionData[$index])){
            $sizeofGuide++;
            $gatheredData[$ki]=cryptThisVbuilder( $keyEncryptionData[$index] )['d'];
        }
        $itemsAllowed=false;
        if(sizeof($gatheredData)==$sizeofGuide){
            $itemsAllowed=true;
        }

    }
    return ['data'=>$gatheredData,'allowed'=>$itemsAllowed];
}


// AGENTDATA


EngineBuild::loadDetect();


$USER_AGENT_BASIC=[];
if(empty($_SERVER['HTTP_USER_AGENT'])) {

//    $USER_AGENT_BASIC=['device'=> 'unrecognized','os'=>"unrecognized",'browser'=> "unknown"];
    $USER_AGENT_BASIC['device']='unrecognized';
    $USER_AGENT_BASIC['os']='unrecognized';
    $USER_AGENT_BASIC['browser']='unknown';
} else{
    $USER_AGENT_BASIC=['device'=> Detect::deviceType(),'os'=>Detect::os(),'browser'=> Detect::browser()];
}
define('USER_AGENT_BASIC', $USER_AGENT_BASIC);

function agentDataConfirm($data){

    $confirm=true;

    if($data['agent_os']!=USER_AGENT_BASIC['os']){
        $confirm=false;
    }
    if($data['agent_device']!=USER_AGENT_BASIC['device']){
        $confirm=false;
    }
    if($data['agent_browser']!=USER_AGENT_BASIC['browser']){
        $confirm=false;
    }


    return $confirm;
}
function randomDataConfirm($data){

    $confirm=true;

    if($data['random_key']!=''){
        $confirm=false;
    }

    if($data['random_key_extra']!=''){
        $confirm=false;
    }
    return true;
}



function vbd_key_retrieveGuide($keyEncryptionData){

    EngineBuild::BuildProcessor("Vbd_log_track");

    $guide=array();
    $guide['result']=false;

    $log_id=cryptThisVbuilder(array_pop($keyEncryptionData))['d'];

    $Vbuilder_log_trackModel= new Vbd_log_trackModel();
    $dataVbuilder_log_track=$Vbuilder_log_trackModel->read(["by"=>"false"]);
    rsort($dataVbuilder_log_track['data']);

    foreach($dataVbuilder_log_track['data'] as $vbdK=>$vbdV){
        if($log_id==$vbdV->getLog_id()){
            $guide['result']=true;
            $guide['data']=$vbdV->getLog_guide();
            break;
        }
    }



    return $guide;
}

function redirectToBase(){
    header('location: '.VBD_ROOT);
}

// INCLUDE VSECURITY FILE
EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."/engine/VSecurity.php");
EngineBuild::BuildBindingProcessorScope(EngineBuild::getAppRoot()."/engine/VbdUploadHelper.php");






