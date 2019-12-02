<?php
/**
* Created by VBuilder 
* Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Date: 27/10/2019, Sunday
* Time: 01:43 PM
* Project/Module: Newsletter Message*/
class Vbd_ns_mail{


    
            private $nsmail_id; 

            private $nsmail_date; 

            private $ns_id; 

            private $nsemail_id; 

            private $ns_state; 

            private $deleted; 
    
    public function __construct($nsmail_id,$nsmail_date,$ns_id,$nsemail_id,$ns_state,$deleted){


            $this->nsmail_id=$nsmail_id;
            $this->nsmail_date=$nsmail_date; 

            $this->ns_id=$ns_id; 

            $this->nsemail_id=$nsemail_id; 

            $this->ns_state=$ns_state; 

            $this->deleted=$deleted; 


    }

//GETTERS & SETTERS




    
                public function getNsmail_id() { 

                return $this->nsmail_id; 

                } 

                public function getNsmail_date() { 

                return $this->nsmail_date; 

                } 

                public function getNs_id() { 

                return $this->ns_id; 

                } 

                public function getNsemail_id() { 

                return $this->nsemail_id; 

                } 

                public function getNs_state() { 

                return $this->ns_state; 

                } 

                public function getDeleted() { 

                return $this->deleted; 

                } 

                public function setNsmail_id($nsmail_id) { 

                $this->nsmail_id=$nsmail_id; 
 
                }
                public function setNsmail_date($nsmail_date) { 

                $this->nsmail_date=$nsmail_date; 
 
                }
                public function setNs_id($ns_id) { 

                $this->ns_id=$ns_id; 
 
                }
                public function setNsemail_id($nsemail_id) { 

                $this->nsemail_id=$nsemail_id; 
 
                }
                public function setNs_state($ns_state) { 

                $this->ns_state=$ns_state; 
 
                }
                public function setDeleted($deleted) { 

                $this->deleted=$deleted; 
 
                }


// All Rights Reserved By Vayile Félix Pessoa Fumo | vayile.pessoa@gmail.com

// https://www.linkedin.com/in/vayile-fumo-a22a66170/

// Mozambique, Maputo


}
