<?php
/**
* Created by VBuilder 
* Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Date: 07/09/2019, Saturday
* Time: 02:59 AM
* Project/Module: Password Reset*/
class Vbd_rp{


    
            private $rp_id; 

            private $rp_email; 

            private $user_id; 

            private $rp_code; 

            private $rp_date; 

            private $rp_date_exp; 

            private $rp_state; 

            private $deleted; 
    
    public function __construct($rp_id,$rp_email,$user_id,$rp_code,$rp_date,$rp_date_exp,$rp_state,$deleted){


            $this->rp_id=$rp_id;
            $this->rp_email=$rp_email; 

            $this->user_id=$user_id; 

            $this->rp_code=$rp_code; 

            $this->rp_date=$rp_date; 

            $this->rp_date_exp=$rp_date_exp; 

            $this->rp_state=$rp_state; 

            $this->deleted=$deleted; 


    }

//GETTERS & SETTERS




    
                public function getRp_id() { 

                return $this->rp_id; 

                } 

                public function getRp_email() { 

                return $this->rp_email; 

                } 

                public function getUser_id() { 

                return $this->user_id; 

                } 

                public function getRp_code() { 

                return $this->rp_code; 

                } 

                public function getRp_date() { 

                return $this->rp_date; 

                } 

                public function getRp_date_exp() { 

                return $this->rp_date_exp; 

                } 

                public function getRp_state() { 

                return $this->rp_state; 

                } 

                public function getDeleted() { 

                return $this->deleted; 

                } 

                public function setRp_id($rp_id) { 

                $this->rp_id=$rp_id; 
 
                }
                public function setRp_email($rp_email) { 

                $this->rp_email=$rp_email; 
 
                }
                public function setUser_id($user_id) { 

                $this->user_id=$user_id; 
 
                }
                public function setRp_code($rp_code) { 

                $this->rp_code=$rp_code; 
 
                }
                public function setRp_date($rp_date) { 

                $this->rp_date=$rp_date; 
 
                }
                public function setRp_date_exp($rp_date_exp) { 

                $this->rp_date_exp=$rp_date_exp; 
 
                }
                public function setRp_state($rp_state) { 

                $this->rp_state=$rp_state; 
 
                }
                public function setDeleted($deleted) { 

                $this->deleted=$deleted; 
 
                }


// All Rights Reserved By Vayile Félix Pessoa Fumo | vayile.pessoa@gmail.com

// https://www.linkedin.com/in/vayile-fumo-a22a66170/

// Mozambique, Maputo


}
