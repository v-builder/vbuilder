<?php
/**
* Created by VBuilder 
* Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Date: 19/10/2019, Saturday
* Time: 10:54 AM
* Project/Module: VB Upload Group*/
class Vbd_upload_group{


    
            private $upg_id; 

            private $user_id; 

            private $upg_date; 

            private $upg_desc; 

            private $deleted; 
    
    public function __construct($upg_id,$user_id,$upg_date,$upg_desc,$deleted){


            $this->upg_id=$upg_id;
            $this->user_id=$user_id; 

            $this->upg_date=$upg_date; 

            $this->upg_desc=$upg_desc; 

            $this->deleted=$deleted; 


    }

//GETTERS & SETTERS




    
                public function getUpg_id() { 

                return $this->upg_id; 

                } 

                public function getUser_id() { 

                return $this->user_id; 

                } 

                public function getUpg_date() { 

                return $this->upg_date; 

                } 

                public function getUpg_desc() { 

                return $this->upg_desc; 

                } 

                public function getDeleted() { 

                return $this->deleted; 

                } 

                public function setUpg_id($upg_id) { 

                $this->upg_id=$upg_id; 
 
                }
                public function setUser_id($user_id) { 

                $this->user_id=$user_id; 
 
                }
                public function setUpg_date($upg_date) { 

                $this->upg_date=$upg_date; 
 
                }
                public function setUpg_desc($upg_desc) { 

                $this->upg_desc=$upg_desc; 
 
                }
                public function setDeleted($deleted) { 

                $this->deleted=$deleted; 
 
                }


// All Rights Reserved By Vayile Félix Pessoa Fumo | vayile.pessoa@gmail.com

// https://www.linkedin.com/in/vayile-fumo-a22a66170/

// Mozambique, Maputo


}
