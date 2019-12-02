<?php

/**
 * Created by VBuilder
 * Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/
 * Date: 28/08/2019, Wednesday
 * Time: 12:34 PM
 */

class Vbd_user
{

    private $user_id;
    private $user_rid;
    private $ulevel_id;
    private $user_rn;
    private $user_photo;
    private $user_idate;
    private $user_name;
    private $user_email;
    private $user_password;
    private $user_state;
    private $user_email_conf;
    private $deleted;

    public function __construct($user_id,$ulevel_id,$user_rid,$user_rn,$user_photo,$user_idate,$user_name,$user_email,$user_password,$user_state,$user_email_conf,$deleted){

        $this->user_id=$user_id;

        $this->ulevel_id=$ulevel_id;

        $this->user_rid=$user_rid;

        $this->user_rn=$user_rn;

        $this->user_photo=$user_photo;

        $this->user_idate=$user_idate;

        $this->user_name=$user_name;

        $this->user_email=$user_email;

        $this->user_password=$user_password;

        $this->user_state=$user_state;

        $this->user_email_conf=$user_email_conf;

        $this->deleted=$deleted;

    }

    /**
     * @return mixed
     */
    public function getUser_rid()
    {
        return $this->user_rid;
    }

    /**
     * @param mixed $user_rid
     */
    public function setUser_rid($user_rid)
    {
        $this->user_rid = $user_rid;
    }


    /**
     * @return mixed
     */
    public function getUser_photo()
    {
        return $this->user_photo;
    }

    /**
     * @param mixed $user_photo
     */
    public function setUser_photo($user_photo)
    {
        $this->user_photo = $user_photo;
    }




//GETTERS & SETTERS



    public function getUser_id() {
        return $this->user_id;
    }

    /**
     * @return mixed
     */
    public function getUser_email_conf()
    {
        return $this->user_email_conf;
    }

    /**
     * @param mixed $user_email_conf
     */
    public function setUser_email_conf($user_email_conf)
    {
        $this->user_email_conf = $user_email_conf;
    }

    public function getUlevel_id() {
        return $this->ulevel_id;
    }

    public function getUser_rn() {
        return $this->user_rn;
    }

    public function getUser_idate() {
        return $this->user_idate;
    }

    public function getUser_name() {
        return $this->user_name;
    }

    public function getUser_email() {
        return $this->user_email;
    }

    public function getUser_password() {
        return $this->user_password;
    }

    public function getUser_state() {
        return $this->user_state;
    }

    public function getDeleted() {
        return $this->deleted;
    }

    public function setUser_id($user_id) {
        $this->user_id=$user_id;
    }

    public function setUlevel_id($ulevel_id) {
        $this->ulevel_id=$ulevel_id;
    }

    public function setUser_rn($user_rn) {
        $this->user_rn=$user_rn;
    }

    public function setUser_idate($user_idate) {
        $this->user_idate=$user_idate;
    }

    public function setUser_name($user_name) {
        $this->user_name=$user_name;
    }

    public function setUser_email($user_email) {
        $this->user_email=$user_email;
    }

    public function setUser_password($user_password) {
        $this->user_password=$user_password;
    }

    public function setUser_state($user_state) {
        $this->user_state=$user_state;
    }

    public function setDeleted($deleted) {
        $this->deleted=$deleted;
    }


// All Rights Reserved By Vayile Félix Pessoa Fumo | vayile.pessoa@gmail.com
// https://www.linkedin.com/in/vayile-fumo-a22a66170/
// Mozambique, Maputo


}