<?php

/**
 * Created by VBuilder
 * Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/
 * Date: 28/08/2019, Wednesday
 * Time: 12:49 PM
 */

class Vbd_log_track
{

    private $log_id;
    private $user_id;
    private $device_name;
    private $log_key;
    private $log_guide;
    private $log_extra;
    private $log_date;
    private $log_date_exp;
    private $log_state;
    private $deleted;

    public function __construct($log_id,$user_id,$device_name,$log_key,$log_guide,$log_extra,$log_date,$log_date_exp,$log_state,$deleted){

        $this->log_id=$log_id;

        $this->user_id=$user_id;

        $this->device_name=$device_name;

        $this->log_key=$log_key;

        $this->log_guide=$log_guide;

        $this->log_extra=$log_extra;

        $this->log_date=$log_date;

        $this->log_date_exp=$log_date_exp;

        $this->log_state=$log_state;

        $this->deleted=$deleted;

    }

//GETTERS & SETTERS

    public function getLog_id() {
        return $this->log_id;
    }

    public function getUser_id() {
        return $this->user_id;
    }

    public function getDevice_name() {
        return $this->device_name;
    }

    public function getLog_key() {
        return $this->log_key;
    }

    public function getLog_guide() {
        return $this->log_guide;
    }

    public function getLog_extra() {
        return $this->log_extra;
    }

    public function getLog_date() {
        return $this->log_date;
    }

    public function getLog_date_exp() {
        return $this->log_date_exp;
    }

    public function getLog_state() {
        return $this->log_state;
    }

    public function getDeleted() {
        return $this->deleted;
    }

    public function setLog_id($log_id) {
        $this->log_id=$log_id;
    }

    public function setUser_id($user_id) {
        $this->user_id=$user_id;
    }

    public function setDevice_name($device_name) {
        $this->device_name=$device_name;
    }

    public function setLog_key($log_key) {
        $this->log_key=$log_key;
    }

    public function setLog_guide($log_guide) {
        $this->log_guide=$log_guide;
    }

    public function setLog_extra($log_extra) {
        $this->log_extra=$log_extra;
    }

    public function setLog_date($log_date) {
        $this->log_date=$log_date;
    }

    public function setLog_date_exp($log_date_exp) {
        $this->log_date_exp=$log_date_exp;
    }

    public function setLog_state($log_state) {
        $this->log_state=$log_state;
    }

    public function setDeleted($deleted) {
        $this->deleted=$deleted;
    }


// All Rights Reserved By Vayile Félix Pessoa Fumo | vayile.pessoa@gmail.com
// https://www.linkedin.com/in/vayile-fumo-a22a66170/
// Mozambique, Maputo


}