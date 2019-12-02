<?php
/**
* Created by VBuilder 
* Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Date: 27/10/2019, Sunday
* Time: 12:05 PM
* Project/Module: Newsletter Email*/
class Vbd_nsemail{


    
            private $nsemail_id; 

            private $nsemail_name; 

            private $nsemail_email; 

            private $nsemail_date; 

            private $deleted; 
    
    public function __construct($nsemail_id,$nsemail_name,$nsemail_email,$nsemail_date,$deleted){


            $this->nsemail_id=$nsemail_id;
            $this->nsemail_name=$nsemail_name; 

            $this->nsemail_email=$nsemail_email; 

            $this->nsemail_date=$nsemail_date; 

            $this->deleted=$deleted; 


    }

//GETTERS & SETTERS




    
                public function getNsemail_id() { 

                return $this->nsemail_id; 

                } 

                public function getNsemail_name() { 

                return $this->nsemail_name; 

                } 

                public function getNsemail_email() { 

                return $this->nsemail_email; 

                } 

                public function getNsemail_date() { 

                return $this->nsemail_date; 

                } 

                public function getDeleted() { 

                return $this->deleted; 

                } 

                public function setNsemail_id($nsemail_id) { 

                $this->nsemail_id=$nsemail_id; 
 
                }
                public function setNsemail_name($nsemail_name) { 

                $this->nsemail_name=$nsemail_name; 
 
                }
                public function setNsemail_email($nsemail_email) { 

                $this->nsemail_email=$nsemail_email; 
 
                }
                public function setNsemail_date($nsemail_date) { 

                $this->nsemail_date=$nsemail_date; 
 
                }
                public function setDeleted($deleted) { 

                $this->deleted=$deleted; 
 
                }


// All Rights Reserved By Vayile Félix Pessoa Fumo | vayile.pessoa@gmail.com

// https://www.linkedin.com/in/vayile-fumo-a22a66170/

// Mozambique, Maputo


}
