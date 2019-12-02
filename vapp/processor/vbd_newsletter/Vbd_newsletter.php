<?php
/**
* Created by VBuilder 
* Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Date: 27/10/2019, Sunday
* Time: 01:41 PM
* Project/Module: Newsletter*/
class Vbd_newsletter{


    
            private $ns_id; 

            private $ns_date; 

            private $ns_subject; 

            private $ns_body; 

            private $ns_altbody; 

            private $ns_cleanbody; 

            private $ns_attach; 

            private $user_id; 

            private $ns_cover; 

            private $ns_pdf; 

            private $deleted; 
    
    public function __construct($ns_id,$ns_date,$ns_subject,$ns_body,$ns_altbody,$ns_cleanbody,$ns_attach,$user_id,$ns_cover,$ns_pdf,$deleted){


            $this->ns_id=$ns_id;
            $this->ns_date=$ns_date; 

            $this->ns_subject=$ns_subject; 

            $this->ns_body=$ns_body; 

            $this->ns_altbody=$ns_altbody; 

            $this->ns_cleanbody=$ns_cleanbody; 

            $this->ns_attach=$ns_attach; 

            $this->user_id=$user_id; 

            $this->ns_cover=$ns_cover; 

            $this->ns_pdf=$ns_pdf; 

            $this->deleted=$deleted; 


    }

//GETTERS & SETTERS




    
                public function getNs_id() { 

                return $this->ns_id; 

                } 

                public function getNs_date() { 

                return $this->ns_date; 

                } 

                public function getNs_subject() { 

                return $this->ns_subject; 

                } 

                public function getNs_body() { 

                return $this->ns_body; 

                } 

                public function getNs_altbody() { 

                return $this->ns_altbody; 

                } 

                public function getNs_cleanbody() { 

                return $this->ns_cleanbody; 

                } 

                public function getNs_attach() { 

                return $this->ns_attach; 

                } 

                public function getUser_id() { 

                return $this->user_id; 

                } 

                public function getNs_cover() { 

                return $this->ns_cover; 

                } 

                public function getNs_pdf() { 

                return $this->ns_pdf; 

                } 

                public function getDeleted() { 

                return $this->deleted; 

                } 

                public function setNs_id($ns_id) { 

                $this->ns_id=$ns_id; 
 
                }
                public function setNs_date($ns_date) { 

                $this->ns_date=$ns_date; 
 
                }
                public function setNs_subject($ns_subject) { 

                $this->ns_subject=$ns_subject; 
 
                }
                public function setNs_body($ns_body) { 

                $this->ns_body=$ns_body; 
 
                }
                public function setNs_altbody($ns_altbody) { 

                $this->ns_altbody=$ns_altbody; 
 
                }
                public function setNs_cleanbody($ns_cleanbody) { 

                $this->ns_cleanbody=$ns_cleanbody; 
 
                }
                public function setNs_attach($ns_attach) { 

                $this->ns_attach=$ns_attach; 
 
                }
                public function setUser_id($user_id) { 

                $this->user_id=$user_id; 
 
                }
                public function setNs_cover($ns_cover) { 

                $this->ns_cover=$ns_cover; 
 
                }
                public function setNs_pdf($ns_pdf) { 

                $this->ns_pdf=$ns_pdf; 
 
                }
                public function setDeleted($deleted) { 

                $this->deleted=$deleted; 
 
                }


// All Rights Reserved By Vayile Félix Pessoa Fumo | vayile.pessoa@gmail.com

// https://www.linkedin.com/in/vayile-fumo-a22a66170/

// Mozambique, Maputo


}
