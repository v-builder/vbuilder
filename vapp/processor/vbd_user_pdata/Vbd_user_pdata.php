<?php
/**
* Created by VBuilder 
* Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Date: 11/09/2019, Wednesday
* Time: 08:24 PM
* Project/Module: Personal Data*/
class Vbd_user_pdata{


    
            private $usp_id;

            private $user_id;

            private $vbd_at_id; 

            private $usp_label_value; 

            private $usp_type_value; 

            private $phone_code; 

            private $phone_number; 

            private $phone_number_alt; 

            private $phone_shown; 

            private $gender; 

            private $about; 

            private $bio; 

            private $deleted; 
    
    public function __construct($usp_id,$user_id,$vbd_at_id,$usp_label_value,$usp_type_value,$phone_code,$phone_number,$phone_number_alt,$phone_shown,$gender,$about,$bio,$deleted){


            $this->usp_id=$usp_id;

        $this->user_id=$user_id;

        $this->vbd_at_id=$vbd_at_id;


            $this->usp_label_value=$usp_label_value; 

            $this->usp_type_value=$usp_type_value; 

            $this->phone_code=$phone_code; 

            $this->phone_number=$phone_number; 

            $this->phone_number_alt=$phone_number_alt; 

            $this->phone_shown=$phone_shown; 

            $this->gender=$gender; 

            $this->about=$about; 

            $this->bio=$bio; 

            $this->deleted=$deleted; 


    }

//GETTERS & SETTERS




    
                public function getUsp_id() { 

                return $this->usp_id; 

                }

                public function getUser_id() {

                return $this->user_id;

                }



                public function getVbd_at_id() { 

                return $this->vbd_at_id; 

                } 

                public function getUsp_label_value() { 

                return $this->usp_label_value; 

                } 

                public function getUsp_type_value() { 

                return $this->usp_type_value; 

                } 

                public function getPhone_code() { 

                return $this->phone_code; 

                } 

                public function getPhone_number() { 

                return $this->phone_number; 

                } 

                public function getPhone_number_alt() { 

                return $this->phone_number_alt; 

                } 

                public function getPhone_shown() { 

                return $this->phone_shown; 

                } 

                public function getGender() { 

                return $this->gender; 

                } 

                public function getAbout() { 

                return $this->about; 

                } 

                public function getBio() { 

                return $this->bio; 

                } 

                public function getDeleted() { 

                return $this->deleted; 

                } 

                public function setUsp_id($usp_id) { 

                $this->usp_id=$usp_id; 
 
                }
                public function setUser_id($user_id) {

                $this->usp_id=$user_id;

                }
                public function setVbd_at_id($vbd_at_id) { 

                $this->vbd_at_id=$vbd_at_id; 
 
                }
                public function setUsp_label_value($usp_label_value) { 

                $this->usp_label_value=$usp_label_value; 
 
                }
                public function setUsp_type_value($usp_type_value) { 

                $this->usp_type_value=$usp_type_value; 
 
                }
                public function setPhone_code($phone_code) { 

                $this->phone_code=$phone_code; 
 
                }
                public function setPhone_number($phone_number) { 

                $this->phone_number=$phone_number; 
 
                }
                public function setPhone_number_alt($phone_number_alt) { 

                $this->phone_number_alt=$phone_number_alt; 
 
                }
                public function setPhone_shown($phone_shown) { 

                $this->phone_shown=$phone_shown; 
 
                }
                public function setGender($gender) { 

                $this->gender=$gender; 
 
                }
                public function setAbout($about) { 

                $this->about=$about; 
 
                }
                public function setBio($bio) { 

                $this->bio=$bio; 
 
                }
                public function setDeleted($deleted) { 

                $this->deleted=$deleted; 
 
                }


// All Rights Reserved By Vayile Félix Pessoa Fumo | vayile.pessoa@gmail.com

// https://www.linkedin.com/in/vayile-fumo-a22a66170/

// Mozambique, Maputo


}
