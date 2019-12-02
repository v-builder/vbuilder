<?php

require_once "./global.php";

if(isset($_POST['vtarget'])){
    if($_POST['vtarget']=='controller'){
        Controller::renderMvcItem( $_POST['vgoal'],'controller');
    }
}
if(isset($_POST['view'])&&isset($_POST['action'])){
    Controller::renderView($_POST['action'],$_POST['view']);
}
