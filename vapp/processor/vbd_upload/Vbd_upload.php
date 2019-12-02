<?php

/**
 * Created by VBuilder
 * Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/
 * Date: 04/09/2019, Wednesday
 * Time: 10:41 PM
 */

class Vbd_upload
{

    private $upload_id;
    private $upload_date;
    private $upload_privacy;
    private $file_type;
    private $file_path;
    private $file_name;
    private $file_ext;
    private $file_size;
    private $user_id;
    private $upg_id;
    private $deleted;

    public function __construct($upload_id,$upload_date,$upload_privacy,$file_type,$file_path,$file_name,$file_ext,$file_size,$upg_id,$user_id,$deleted){

        $this->upload_id=$upload_id;

        $this->upload_date=$upload_date;

        $this->upload_privacy=$upload_privacy;

        $this->file_type=$file_type;

        $this->file_path=$file_path;

        $this->file_name=$file_name;

        $this->file_ext=$file_ext;

        $this->file_size=$file_size;

        $this->upg_id=$upg_id;

        $this->user_id=$user_id;

        $this->deleted=$deleted;

    }

//GETTERS & SETTERS

    public function getUpload_id() {
        return $this->upload_id;
    }

    public function getUpload_date() {
        return $this->upload_date;
    }

    public function getUpload_privacy() {
        return $this->upload_privacy;
    }

    public function getFile_type() {
        return $this->file_type;
    }

    public function getFile_path() {
        return $this->file_path;
    }

    public function getFile_name() {
        return $this->file_name;
    }

    public function getFile_ext() {
        return $this->file_ext;
    }

    public function getFile_size() {
        return $this->file_size;
    }

    public function getUpg_id() {
        return $this->upg_id;
    }

    public function getUser_id() {
        return $this->user_id;
    }

    public function getDeleted() {
        return $this->deleted;
    }

    public function setUpload_id($upload_id) {
        $this->upload_id=$upload_id;
    }

    public function setUpload_date($upload_date) {
        $this->upload_date=$upload_date;
    }

    public function setUpload_privacy($upload_privacy) {
        $this->upload_privacy=$upload_privacy;
    }

    public function setFile_type($file_type) {
        $this->file_type=$file_type;
    }

    public function setFile_path($file_path) {
        $this->file_path=$file_path;
    }

    public function setFile_name($file_name) {
        $this->file_name=$file_name;
    }

    public function setFile_ext($file_ext) {
        $this->file_ext=$file_ext;
    }

    public function setFile_size($file_size) {
        $this->file_size=$file_size;
    }

    public function setUser_id($user_id) {
        $this->user_id=$user_id;
    }

    public function setUpg_id($upg_id) {
        $this->upg_id=$upg_id;
    }

    public function setDeleted($deleted) {
        $this->deleted=$deleted;
    }


// All Rights Reserved By Vayile Félix Pessoa Fumo | vayile.pessoa@gmail.com
// https://www.linkedin.com/in/vayile-fumo-a22a66170/
// Mozambique, Maputo


}