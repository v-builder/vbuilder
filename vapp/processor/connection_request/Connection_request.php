<?php
/**
* Created by VBuilder 
* Author: Vayile Fumo | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Date: 18/09/2019, Wednesday
* Time: 08:35 PM
* Project/Module: Connection Action*/
class Connection_request{


    
            private $cr_id; 

            private $from_user_id; 

            private $to_user_id; 

            private $cr_date; 

            private $cr_date_response; 

            private $cr_state; 

            private $cr_response; 

            private $deleted; 
    
    public function __construct($cr_id,$from_user_id,$to_user_id,$cr_date,$cr_date_response,$cr_state,$cr_response,$deleted){


            $this->cr_id=$cr_id;
            $this->from_user_id=$from_user_id; 

            $this->to_user_id=$to_user_id; 

            $this->cr_date=$cr_date; 

            $this->cr_date_response=$cr_date_response; 

            $this->cr_state=$cr_state; 

            $this->cr_response=$cr_response; 

            $this->deleted=$deleted; 


    }

//GETTERS & SETTERS




    
                public function getCr_id() { 

                return $this->cr_id; 

                } 

                public function getFrom_user_id() { 

                return $this->from_user_id; 

                } 

                public function getTo_user_id() { 

                return $this->to_user_id; 

                } 

                public function getCr_date() { 

                return $this->cr_date; 

                } 

                public function getCr_date_response() { 

                return $this->cr_date_response; 

                } 

                public function getCr_state() { 

                return $this->cr_state; 

                } 

                public function getCr_response() { 

                return $this->cr_response; 

                } 

                public function getDeleted() { 

                return $this->deleted; 

                } 

                public function setCr_id($cr_id) { 

                $this->cr_id=$cr_id; 
 
                }
                public function setFrom_user_id($from_user_id) { 

                $this->from_user_id=$from_user_id; 
 
                }
                public function setTo_user_id($to_user_id) { 

                $this->to_user_id=$to_user_id; 
 
                }
                public function setCr_date($cr_date) { 

                $this->cr_date=$cr_date; 
 
                }
                public function setCr_date_response($cr_date_response) { 

                $this->cr_date_response=$cr_date_response; 
 
                }
                public function setCr_state($cr_state) { 

                $this->cr_state=$cr_state; 
 
                }
                public function setCr_response($cr_response) { 

                $this->cr_response=$cr_response; 
 
                }
                public function setDeleted($deleted) { 

                $this->deleted=$deleted; 
 
                }


// All Rights Reserved By Vayile Félix Pessoa Fumo | vayile.pessoa@gmail.com

// https://www.linkedin.com/in/vayile-fumo-a22a66170/

// Mozambique, Maputo


}
