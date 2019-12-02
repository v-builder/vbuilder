<?php

/**
 * Created by VBuilder
 * Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/
 * Date: 28/08/2019, Wednesday
 * Time: 12:27 PM
 */

class Vbd_user_level
{

    private $ulevel_id;
    private $ulevel_name;
    private $ulevel_desc;
    private $deleted;

    public function __construct($ulevel_id,$ulevel_name,$ulevel_desc,$deleted){

        $this->ulevel_id=$ulevel_id;

        $this->ulevel_name=$ulevel_name;

        $this->ulevel_desc=$ulevel_desc;

        $this->deleted=$deleted;

    }

//GETTERS & SETTERS

    public function getUlevel_id() {
        return $this->ulevel_id;
    }

    public function getUlevel_name() {
        return $this->ulevel_name;
    }

    public function getUlevel_desc() {
        return $this->ulevel_desc;
    }

    public function getDeleted() {
        return $this->deleted;
    }

    public function setUlevel_id($ulevel_id) {
        $this->ulevel_id=$ulevel_id;
    }

    public function setUlevel_name($ulevel_name) {
        $this->ulevel_name=$ulevel_name;
    }

    public function setUlevel_desc($ulevel_desc) {
        $this->ulevel_desc=$ulevel_desc;
    }

    public function setDeleted($deleted) {
        $this->deleted=$deleted;
    }


// All Rights Reserved By Vayile Félix Pessoa Fumo | vayile.pessoa@gmail.com
// https://www.linkedin.com/in/vayile-fumo-a22a66170/
// Mozambique, Maputo


}