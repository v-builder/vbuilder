<?php

define("PATH_TO_VBD","../vapp/");

//if not using .htaccess
define("VBD_FILE_EXT",".php");

//if  using .htaccess
//define("VBD_FILE_EXT","");

//if(!defined('VBD_W_WP')){ define('VBD_W_WP',true); }

require_once PATH_TO_VBD."engine/EngineBuild.php";
