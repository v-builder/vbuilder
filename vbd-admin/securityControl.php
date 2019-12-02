<?php
/**
 * Created by Vayile Fumo.
 * User: Vayile Fumo
 * Date: 2019-10-25
 * Time: 11:19
 */




$VSecurity=VSecurity::appSecurity
(
    [

        'ajax'=>false ,
        'security'=>
            [
                'enable'=>true,
                'user'=>[
                    'user_level'=>[
//                        'allowed'=>[1,5]
//                        ,
//                        'denied'=>[1,2,3,4,5]
                    ]

                ]

            ],

        // if is not ajax
        'on_deny'=> [
//            'redirect'=>VBD_ROOT,
//            'toast_msg'=>'You don\'t have permissions to perform actions in this page. Please log in with an authorized account <a class="vbd-security-error-msg-link" href="'.VBD_ROOT.'"> Home page</a>'
        ]

    ]
);

$allowUserPage=false;
if($VSecurity['response']['state']==1 ){

    $allowUserPage=true;

    if(VBD_USER_DATA['ulevel_id']>VBD_MAXL_ADMIN){
        $allowUserPage=false;
    }

}

if(!$allowUserPage){
    EngineBuild::redirectPage(VBD_ROOT."/vbd-admin/login.php");
}
