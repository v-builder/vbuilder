<?php
/**
* Created by VBuilder 
* Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Date: 11/09/2019, Wednesday
* Time: 01:01 PM
* Project/Module: Account Type*/
class Vbd_at{


    
            private $vbd_at_id; 

            private $vbd_at_type; 

            private $vbd_at_desc; 

            private $deleted; 
    
    public function __construct($vbd_at_id,$vbd_at_type,$vbd_at_desc,$deleted){


            $this->vbd_at_id=$vbd_at_id;
            $this->vbd_at_type=$vbd_at_type; 

            $this->vbd_at_desc=$vbd_at_desc; 

            $this->deleted=$deleted; 


    }

//GETTERS & SETTERS




    
                public function getVbd_at_id() { 

                return $this->vbd_at_id; 

                } 

                public function getVbd_at_type() { 

                return $this->vbd_at_type; 

                } 

                public function getVbd_at_desc() { 

                return $this->vbd_at_desc; 

                } 

                public function getDeleted() { 

                return $this->deleted; 

                } 

                public function setVbd_at_id($vbd_at_id) { 

                $this->vbd_at_id=$vbd_at_id; 
 
                }
                public function setVbd_at_type($vbd_at_type) { 

                $this->vbd_at_type=$vbd_at_type; 
 
                }
                public function setVbd_at_desc($vbd_at_desc) { 

                $this->vbd_at_desc=$vbd_at_desc; 
 
                }
                public function setDeleted($deleted) { 

                $this->deleted=$deleted; 
 
                }


// All Rights Reserved By Vayile Félix Pessoa Fumo | vayile.pessoa@gmail.com

// https://www.linkedin.com/in/vayile-fumo-a22a66170/

// Mozambique, Maputo


}
