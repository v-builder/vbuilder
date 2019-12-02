
$(document).ready(function() {


    getUserPdata();
    vbdLoadUserData();
    //

});

$('form[name=vbd_user-vbd-login-form]').on('submit', function(e) {

    e.preventDefault();
    var this_fvalidate=true;
    var thisForm=$(this);

    if(this_fvalidate){
        vbdDisableSubmit(thisForm);
        this_fvalidate=false;
        var data_preset_vbd_user="vbd_method=admin";
        var data_vbd_user=data_preset_vbd_user+'&'+$(this).serialize();
        // var data_vbd_user=$(this).serialize();


        var url= VBUILDER_APP_ROOT+"/api/auth/in/";
        var content_vbd_user="none-v";

        var xhr_vbd_user= new XMLHttpRequest();
        xhr_vbd_user.open('POST',url,true);
        xhr_vbd_user.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr_vbd_user.onreadystatechange= function () {

            if(xhr_vbd_user.readyState===4){
                vbdEnableSubmit(thisForm);
                this_fvalidate=true;
            } else{
                vbdDisableSubmit(thisForm);
                this_fvalidate=false;
            }


            if(xhr_vbd_user.readyState===4 && xhr_vbd_user.status===200){
                content_vbd_user=xhr_vbd_user.responseText;
                try {


                    var json_vbd_user=JSON.parse(content_vbd_user);
//start of submission check
                    if(json_vbd_user['response']['state']===1){
                        item_id_update_vbd_user=null;

                        $("form[name='vbd_user-vbd-login-form']").trigger("reset");
                        $('#vbd_user-modal-login').modal('hide');

                        function vbExecuteLogin() {

                            var tempState=false;
                            try {


                                tempState=vbdSetKey(json_vbd_user['response']['vbd_key']['key']);

                            } catch (e) {
                                vbToast('success','Error saving user data');
                            }
                            vbToast('success','Successfully logged in');
                            return tempState;
                        }

                        if(vbIsCookie()){


                            $.when(vbExecuteLogin()).done(function( tempState ) {
                                if(tempState){
                                    window.location.replace(VBD_ROOT+"/");
                                } else{

                                    vbToast('success','Occurred an error saving user data');
                                }
                            });

                        } else{
                            vbToast('error','Cookies disabled. Please allow cookies to proceed');
                        }

                    }
                    else
                    {
// checking for the errors
                       if(json_vbd_user['response']['state']===2){

                            vbToast('error','Sorry, your password was incorrect. Please double-check your password.');

                        } else if(json_vbd_user['response']['state']===3){

                            vbToast('error',
                                'The username/email you entered doesn\'t belong to an account. Please check your username/email and try again.');

                        } else{
                            vbToast('error','Error logging in. Try again');
                        }

                    }
//end of submission check

                } catch (e) {

                    vbToast('error','An error have occured during the request.');
                    console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
                }
            } else{

                console.log("vbuilder-auth-process",'log in form');

            }
        };
        xhr_vbd_user.send(data_vbd_user);



    } else{

        vbToast('warning','Please fill all required fields');

    }

});




$(document).on('click','.vbd-logout-trigger', function(e) {

    e.preventDefault();

    $.when(vbdIsKeySet()).done(function( this_fvalidate ) {

        if(this_fvalidate){

            vbdUserLogOut( vbdGetKey() );

        } else{

            vbToast('warning','You didn\'t log in');

        }
    });


});





function vbdUserLogOut(ketyToLogOut){

        /*var data_preset_vbd_user="vbd_method=update&vbd_key="+vbdGetKey()+"&user_id="+item_id_update_vbd_user;
        // var data_vbd_user=data_preset_vbd_user+'&'+$(this).serialize();*/
        var data_vbd_user=$(this).serialize()+'&'+"vbd_key="+ketyToLogOut;


        var url= VBUILDER_APP_ROOT+"/api/auth/out/";
        var content_vbd_user="none-v";

        var xhr_vbd_user= new XMLHttpRequest();
        xhr_vbd_user.open('POST',url,true);
        xhr_vbd_user.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr_vbd_user.onreadystatechange= function () {
            if(xhr_vbd_user.readyState===4 && xhr_vbd_user.status===200){
                content_vbd_user=xhr_vbd_user.responseText;
                try {


                    var json_vbd_user=JSON.parse(content_vbd_user);
//start of submission check
                    if(json_vbd_user['response']['state']===1){
                        item_id_update_vbd_user=null;

                        $('#vbd_user-modal-logout').modal('hide');

                        function vbExecuteLogOut() {


                            try {

                                vbdRemoveKey("vbd_key");

                            } catch (e) {

                            }

                            vbToast('success','logged out');
                        }

                        if(vbIsCookie()){


                            $.when(vbExecuteLogOut()).done(function(  ) {
                                window.location.replace(VBD_ROOT+"/");
                            });

                        } else{
                            vbToast('error','Cookies disabled. Please allow cookies to proceed');
                        }

                    }
                    else
                    {
// checking for the errors

                            vbToast('error','Error logging out. Try again');


                    }
//end of submission check

                } catch (e) {

                    vbToast('error','An error have occured during the request.');
                    console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
                }
            } else{

                console.log("vbuilder-auth-process",'log in form');

            }
        };
        xhr_vbd_user.send(data_vbd_user);




}


// SELF TASKS

$(document).on('click','.vbd-action-self-view', function(e) {

    if(!$(this).hasClass('disabled-self-action')){

        e.preventDefault();

        $.when(vbdIsKeySet()).done(function( this_fvalidate ) {

            if(this_fvalidate){

                executeUserSelfView( vbdGetKey() );

            } else{

                vbToast('warning','You didn\'t log in');

            }
        });


    }




});

function executeUserSelfView(vbdKeyIn) {





    var data_vbd_user="vbd_method=self-readcontrol&vbd_key="+vbdGetKey()+"&user_id="+$(this).data('item-id');


    var xhrVBD= new XMLHttpRequest();
    xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_user/",true);
    xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    xhrVBD.onreadystatechange= function () {
        if(xhrVBD.readyState===4 && xhrVBD.status===200){

            self_view_load_vbd_user( xhrVBD.responseText, true)

        }
        if(xhrVBD.readyState<4){

        }
    };

    xhrVBD.send(data_vbd_user);
    
    
}







function self_view_load_vbd_user( thisvbd,isVbdSelf){

    var pOrSelf="self";
    if(isVbdSelf){ pOrSelf="self";
    } else {
        pOrSelf="p";
    }

    try {

        var json_vbd_user=JSON.parse(thisvbd);
//start of submission check
        if(json_vbd_user['response']['state']===1 && json_vbd_user['response']['result']['rows']>0){

            $('#vbd-user-self-view .vbd_user-holder').text("");

//vbToast('success','Record Successfully loaded!');

            var jsonVOB= JSON.parse(json_vbd_user['response']['result']['data-json']);


            function tempGetUlevels(){
                var vbdUserLevelDataStorageSelf={};
               var jsonTemp= json_vbd_user['response']['result']['user-level-data'];

                for ( var ix = 0; ix < jsonTemp.length; ix++) {
                    var jsonVOB2= JSON.parse(jsonTemp[ix]);

                    vbdUserLevelDataStorageSelf[ jsonVOB2['ulevel_id'] ] = jsonVOB2;

                    // alert(vbdUserLevelData[jsonVOB['ulevel_id']]['ulevel_id']);

                }
                return vbdUserLevelDataStorageSelf;
            }

            $.when( tempGetUlevels() ).done(function (vbdUserLevelDataStorageSelf) {

                if(jsonVOB['user_photo']!=null){

                    setVbdUserPhoto(jsonVOB['user_photo'])
                }



                if(isVbdSelf===false){
                    if($("#vbd-user-p-view")[0]){

                        $('#vbd-user-self-view .ulevel_id.vbd_user-self-holder').text(vbdUserLevelDataStorageSelf[[ jsonVOB['ulevel_id'] ]] ['ulevel_name']);

                        $('#vbd-user-self-view .user_rn.vbd_user-self-holder').text( jsonVOB['user_rn'] );
                        $('#vbd-user-self-view .user_idate.vbd_user-self-holder').text( jsonVOB['user_idate'] );
                        $('#vbd-user-self-view .user_name.vbd_user-self-holder').text( jsonVOB['user_name'] );
                        $('#vbd-user-self-view .user_email.vbd_user-self-holder').text( jsonVOB['user_email'] );
                        $('#vbd-user-self-view .user_email_conf.vbd_user-self-holder').text( ((jsonVOB['user_email_conf']=='true')? "Confirmed": "Not confirmed") );
                        $('#vbd-user-self-view .user_state.vbd_user-self-holder').text( jsonVOB['user_state'] );

                    }
                } else {
                    if($(".vbd_user-self-holder")[0]){

                        $('#vbd-user-self-view .ulevel_id.vbd_user-self-holder').text(vbdUserLevelDataStorageSelf[[ jsonVOB['ulevel_id'] ]] ['ulevel_name']);

                        $('#vbd-user-self-view .user_rn.vbd_user-self-holder').text( jsonVOB['user_rn'] );
                        $('#vbd-user-self-view .user_idate.vbd_user-self-holder').text( jsonVOB['user_idate'] );
                        $('#vbd-user-self-view .user_name.vbd_user-self-holder').text( jsonVOB['user_name'] );
                        $('#vbd-user-self-view .user_email.vbd_user-self-holder').text( jsonVOB['user_email'] );
                        $('#vbd-user-self-view .user_email_conf.vbd_user-self-holder').text( ((jsonVOB['user_email_conf']=='true')? "Confirmed": "Not confirmed") );
                        $('#vbd-user-self-view .user_state.vbd_user-self-holder').text( jsonVOB['user_state'] );

                    }
                }

                $('#vbd_user-modal-self-view').modal('show');
            });




        }
        else
        {
// checking for the errors
            if(json_vbd_user['response']['state']===1920){

                vbToast('warning','Please login');

            } else if( json_vbd_user['rq_fields']['missing']['count'] != undefined && json_vbd_user['rq_fields']['missing']['count']!==0){
                vbToast('warning','Missing request data');
            } else if( json_vbd_user['validate']['state'] != undefined && json_vbd_user['validate']['state']===false){
                vbToast('warning','Wrong request data');
            }else{
                vbToast('warning','Error loading Record');
            }

        }
//end of submission check


    } catch (e) {

        vbToast('error','An error have occured during the request.');
        vbToast("error",'Error requesting json || Message: '+e.message);
        console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
    }

}


function setVbdUserPhoto(vbdIn){


    var jsonVOB={};



    var data_vbd_user="vbd_method=self-readcontrol&vbd_key="+vbdGetKey()+'&'+"upload_id="+vbdIn;


    var xhrVBD= new XMLHttpRequest();
    xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_upload/",true);
    xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    xhrVBD.onreadystatechange= function () {
        if(xhrVBD.readyState===4 && xhrVBD.status===200){



            try {

                var json_vbd_user=JSON.parse(xhrVBD.responseText);
//start of submission check
                if(json_vbd_user['response']['state']===1 && json_vbd_user['response']['result']['rows']>0){



                    jsonVOB= JSON.parse(json_vbd_user['response']['result']['data-json']);

                    if($(".vbd-avatar-img.vbd-user-data")[0]){
                        $(".vbd-avatar-img.vbd-user-data").css("background-image", "url('"+VBUILDER_APP_ROOT+"/"+jsonVOB['file_path']+"')");

                    }

                }
                else
                {
// checking for the errors
                    if(json_vbd_user['response']['state']===1920){

                        vbToast('warning','Please login');

                    } else if( json_vbd_user['rq_fields']['missing']['count'] != undefined && json_vbd_user['rq_fields']['missing']['count']!==0){
                        vbToast('warning','Missing request data');
                    } else if( json_vbd_user['validate']['state'] != undefined && json_vbd_user['validate']['state']===false){
                        vbToast('warning','Wrong request data');
                    }else{
                        vbToast('warning','Error loading Record');
                    }

                }
//end of submission check


            } catch (e) {

                vbToast('error','An error have occured during the request.');
                console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
            }





        }
        if(xhrVBD.readyState<4){

        }
    };

    xhrVBD.send(data_vbd_user);

    return jsonVOB;

}


function setVbdUserSinglePhoto(vbdIn){


    var jsonVOB={};



    var data_vbd_user="vbd_method=p-readcontrol&upload_id="+vbdIn;


    var xhrVBD= new XMLHttpRequest();
    xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_upload/",true);
    xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    xhrVBD.onreadystatechange= function () {
        if(xhrVBD.readyState===4 && xhrVBD.status===200){



            try {

                var json_vbd_user=JSON.parse(xhrVBD.responseText);
//start of submission check
                if(json_vbd_user['response']['state']===1 && json_vbd_user['response']['result']['rows']>0){



                    jsonVOB= JSON.parse(json_vbd_user['response']['result']['data-json']);

                    if($(".vbd-avatar-img.vbd-user-data-p")[0]){

                        $(".vbd-avatar-img.vbd-user-data-p").css("background-image", "url('"+VBUILDER_APP_ROOT+"/"+jsonVOB['file_path']+"')");

                    }

                }
                else
                {
// checking for the errors
                    if(json_vbd_user['response']['state']===1920){

                        vbToast('warning','Please login');

                    } else if( json_vbd_user['rq_fields']['missing']['count'] != undefined && json_vbd_user['rq_fields']['missing']['count']!==0){
                        vbToast('warning','Missing request data');
                    } else if( json_vbd_user['validate']['state'] != undefined && json_vbd_user['validate']['state']===false){
                        vbToast('warning','Wrong request data');
                    }else{
                        vbToast('warning','Error loading Record');
                    }

                }
//end of submission check


            } catch (e) {

                vbToast('error','An error have occured during the request.');
                console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
            }





        }
        if(xhrVBD.readyState<4){

        }
    };

    xhrVBD.send(data_vbd_user);

    return jsonVOB;

}


function runSelfUpdateTrigger(withModalX){
    $.when(vbdIsKeySet()).done(function( this_fvalidate ) {

        if(this_fvalidate){


            item_id_update_vbd_user=null;
            $('#vbd_user-vbd-self-update-form').trigger("reset");

            var data_vbd_user="vbd_method=self-readcontrol&vbd_key="+vbdGetKey();

            var xhrVBD= new XMLHttpRequest();
            xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_user/",true);
            xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


            xhrVBD.onreadystatechange= function () {
                if(xhrVBD.readyState===4 && xhrVBD.status===200){

                    self_update_load_vbd_user( xhrVBD.responseText,withModalX);

                }
                if(xhrVBD.readyState<4){

                }
            };

            xhrVBD.send(data_vbd_user);




        } else{

            vbToast('warning','You didn\'t log in');

        }
    });
}



$(document).on('click','.vbd-user-update-trigger', function(e) {


    if(!$(this).hasClass('disabled-self-action')){

        e.preventDefault();
        runSelfUpdateTrigger(true);

        }




});




function self_update_load_vbd_user( thisvbd,withModalX){

    try {


        var json_vbd_user=JSON.parse(thisvbd);
//start of submission check
        if(json_vbd_user['response']['state']===1){



            $('#vbd_user-vbd-self-update-form').trigger("reset");
//vbToast('success','Record Successfully loaded!');

            var jsonVOB= JSON.parse(json_vbd_user['response']['result']['data-json'][0]);
            item_id_update_vbd_user=jsonVOB['user_id'];

            if(jsonVOB['user_photo']!=null){

                setVbdUserPhoto(jsonVOB['user_photo'])
            }

            // $('#vbd_user-vbd-update-role-form select#ulevel_id').val( jsonVOB['ulevel_id'] );
            $('#vbd_user-vbd-self-update-form input[name=user_rn]').val( jsonVOB['user_rn'] );
            $('#vbd_user-vbd-self-update-form input[name=user_name]').val( jsonVOB['user_name'] );
            $('#vbd_user-modal-self-update .user_rn.vbd_user-holder').text( jsonVOB['user_rn'] );
            $('#vbd_user-vbd-self-update-form input[name=user_email]').val( jsonVOB['user_email'] );
            // $('#vbd_user-vbd-self-update-form input#user_state').val( jsonVOB['user_state'] );

            if(withModalX){

                $('#vbd_user-modal-self-update').modal('show');
            }

        }
        else
        {
// checking for the errors
            if(json_vbd_user['response']['state']===1920){

                vbToast('warning','Please login');

            } else if(json_vbd_user['response']['state']===1011){

                vbToast('warning','Wrong password confirmation');

            } else if(json_vbd_user['response']['state']===1012){

                vbToast('warning','Username already Exist. Choose other');

            } else if(json_vbd_user['response']['state']===1013){

                vbToast('warning','Email already Exist. Choose other');

            } else if(json_vbd_user['response']['state']===1014){

                vbToast('warning','Wrong password');

            } else if( json_vbd_user['rq_fields']['missing']['count'] != undefined && json_vbd_user['rq_fields']['missing']['count']!==0){
                vbToast('warning','Missing request data');
            } else if( json_vbd_user['validate']['state'] != undefined && json_vbd_user['validate']['state']===false){
                vbToast('warning','Wrong request data');
            }else{
                vbToast('warning','Error loading Record');
            }

        }
//end of submission check


    } catch (e) {

        vbToast('error','An error have occured during the request.');
        console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
    }

}










$('form[name=vbd_user-vbd-self-update-form]').on('submit', function(e) {

    e.preventDefault();
    var this_fvalidate=true;

    var thisForm=$(this);

    if(this_fvalidate){
        vbdDisableSubmit(thisForm);
        this_fvalidate=false;

        var data_preset_vbd_user="vbd_method=self-update&vbd_key="+vbdGetKey();

        var data_vbd_user=data_preset_vbd_user+'&'+$(this).serialize();


        var url= VBUILDER_APP_ROOT+"/api/global/vbd_user/";
        var content_vbd_user="none-v";

        var xhr_vbd_user= new XMLHttpRequest();
        xhr_vbd_user.open('POST',url,true);
        xhr_vbd_user.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr_vbd_user.onreadystatechange= function () {

            if(xhr_vbd_user.readyState===4){
                vbdEnableSubmit(thisForm);
                this_fvalidate=true;
            } else{
                vbdDisableSubmit(thisForm);
                this_fvalidate=false;
            }

            if(xhr_vbd_user.readyState===4){
                vbdEnableSubmit(thisForm);
                this_fvalidate=true;
            } else{
                vbdDisableSubmit(thisForm);
                this_fvalidate=false;
            }


            if(xhr_vbd_user.readyState===4 && xhr_vbd_user.status===200){
                content_vbd_user=xhr_vbd_user.responseText;
                try {


                    var json_vbd_user=JSON.parse(content_vbd_user);
//start of submission check
                    if(json_vbd_user['response']['state']===1){
                        item_id_update_vbd_user=null;

                        // $('#vbd_user-vbd-self-update-form').trigger("reset");

                        if( json_vbd_user['response']['result']['affected'] != undefined && json_vbd_user['response']['result']['affected']>0){
                            vbToast('success','Account updated');
// load the list
                            self_reload_vbd_user();

                        } else {
                            vbToast('success','None change applied');
                        }
                        $('#vbd_user-modal-self-update').modal('hide');


                    }
                    else
                    {
// checking for the errors
                        if(json_vbd_user['response']['state']===1920){

                            vbToast('warning','Please login');

                        } else if(json_vbd_user['response']['state']===1011){

                            vbToast('warning','Wrong password confirmation');

                        } else if(json_vbd_user['response']['state']===1012){

                            vbToast('warning','Username already Exist. Choose other');

                        } else if(json_vbd_user['response']['state']===1013){

                            vbToast('warning','Email already Exist. Choose other');

                        } else if(json_vbd_user['response']['state']===1014){

                vbToast('warning','Wrong password');

            } else if( json_vbd_user['rq_fields']['missing']['count'] != undefined && json_vbd_user['rq_fields']['missing']['count']!==0){
                            vbToast('warning','Please fill all required fields');
                        } else if( json_vbd_user['validate']['state'] != undefined && json_vbd_user['validate']['state']===false){
                            vbToast('warning','Fill the fields correctly');
                        } else if( json_vbd_user['response']['result']['error'][1] != undefined && json_vbd_user['response']['result']['error'][1]===1062){
                            vbToast('warning','Error. Duplicate entry');
                        } else{
                            vbToast('warning','Error updating record');
                        }

                    }
//end of submission check

                } catch (e) {

                    vbToast('error','An error have occured during the request.');
                    console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
                }
            } else{

                console.log("vbuilder-submition-process",'Loading vbd_user-vbd-self-update-form');

            }
        };
        xhr_vbd_user.send(data_vbd_user);



    } else{

        vbToast('warning','Please fill all required fields');

    }

});




$('form[name=vbd_user-vbd-self-update-password-form]').on('submit', function(e) {

    e.preventDefault();
    var this_fvalidate=true;

    var thisForm=$(this);

    if(this_fvalidate){
        vbdDisableSubmit(thisForm);
        this_fvalidate=false;
        
        var data_preset_vbd_user="vbd_method=self-update-password&vbd_key="+vbdGetKey();
        var data_vbd_user=data_preset_vbd_user+'&'+$(this).serialize();

        var url= VBUILDER_APP_ROOT+"/api/global/vbd_user/";
        var content_vbd_user="none-v";

        var xhr_vbd_user= new XMLHttpRequest();
        xhr_vbd_user.open('POST',url,true);
        xhr_vbd_user.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr_vbd_user.onreadystatechange= function () {

            if(xhr_vbd_user.readyState===4){
                vbdEnableSubmit(thisForm);
                this_fvalidate=true;
            } else{
                vbdDisableSubmit(thisForm);
                this_fvalidate=false;
            }
            
            if(xhr_vbd_user.readyState===4 && xhr_vbd_user.status===200){
                content_vbd_user=xhr_vbd_user.responseText;
                try {


                    var json_vbd_user=JSON.parse(content_vbd_user);
//start of submission check
                    if(json_vbd_user['response']['state']===1){
                        item_id_update_vbd_user=null;

                        $('form[name=vbd_user-vbd-self-update-password-form]').trigger("reset");
                        $('#vbd_user-modal-update').modal('hide');

                        if( json_vbd_user['response']['result']['affected'] != undefined && json_vbd_user['response']['result']['affected']>0){
                            vbToast('success','Password updated');
// load the list

                        } else {
                            vbToast('success','None change applied');
                        }

                    }
                    else
                    {
// checking for the errors
                        if(json_vbd_user['response']['state']===1920){

                            vbToast('warning','Please login');

                        } else if(json_vbd_user['response']['state']===1011){

                            vbToast('warning','Wrong password confirmation');

                        } else if(json_vbd_user['response']['state']===1010){

                            vbToast('warning','Wrong current password');

                        } else if( json_vbd_user['rq_fields']['missing']['count'] != undefined && json_vbd_user['rq_fields']['missing']['count']!==0){
                            vbToast('warning','Please fill all required fields');
                        } else if( json_vbd_user['validate']['state'] != undefined && json_vbd_user['validate']['state']===false){
                            vbToast('warning','Fill the fields correctly');
                        } else if( json_vbd_user['response']['result']['error'][1] != undefined && json_vbd_user['response']['result']['error'][1]===1062){
                            vbToast('warning','Error. Duplicate entry');
                        } else{
                            vbToast('warning','Error updating account');
                        }

                    }
//end of submission check

                } catch (e) {

                    vbToast('error','An error have occured during the request.');
                    console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
                }
            } else{

                console.log("vbuilder-submition-process",'Loading vbd_user-vbd-update-role-form');

            }
        };
        xhr_vbd_user.send(data_vbd_user);



    } else{

        vbToast('warning','Please fill all required fields');

    }

});



$('form[name=vbd_user-vbd-self-add-form]').on('submit', function(e) {

    e.preventDefault();
    var this_fvalidate=true;

    var thisForm=$(this);

    if(this_fvalidate){
        vbdDisableSubmit(thisForm);
        this_fvalidate=false;

        var data_preset_vbd_user="vbd_method=self-add";
        var data_vbd_user=data_preset_vbd_user+'&'+$(this).serialize();


        var url= VBUILDER_APP_ROOT+"/api/global/vbd_user/";
        var content_vbd_user="none-v";

        var xhr_vbd_user= new XMLHttpRequest();
        xhr_vbd_user.open('POST',url,true);
        xhr_vbd_user.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr_vbd_user.onreadystatechange= function () {


            if(xhr_vbd_user.readyState===4){
                vbdEnableSubmit(thisForm);
                this_fvalidate=true;
            } else{
                vbdDisableSubmit(thisForm);
                this_fvalidate=false;
            }
            
            if(xhr_vbd_user.readyState===4 && xhr_vbd_user.status===200){
                content_vbd_user=xhr_vbd_user.responseText;
                // alert(content_vbd_user);
                try {


                    var json_vbd_user=JSON.parse(content_vbd_user);
//start of submission check
                    if(json_vbd_user['response']['state']===1){


                        function reportCreatedAccount(){

                            $('form[name=vbd_user-vbd-self-add-form]').trigger("reset");
                            $('#vbd_user-modal-self-add').modal('hide');
                            vbToast('success','Account created');

                        }

                        $.when(reportCreatedAccount()).done(function () {

                            setTimeout(function () {
                            window.location.replace(VBD_LOGIN_URL+"/?account_created=true");
                        },3000);

                        });


                    }
                    else
                    {
// checking for the errors
                        if(json_vbd_user['response']['state']===1920){

                            vbToast('warning','Please login');

                        } else if(json_vbd_user['response']['state']===1011){

                            vbToast('warning','Wrong password confirmation');

                        } else if(json_vbd_user['response']['state']===1012){

                            vbToast('warning','Username already Exist. Choose other');

                        } else if(json_vbd_user['response']['state']===1013){

                            vbToast('warning','Email already Exist. Choose other');

                        } else if( json_vbd_user['rq_fields']['missing']['count'] != undefined && json_vbd_user['rq_fields']['missing']['count']!==0){
                            vbToast('warning','Please fill all required fields');
                        } else if( json_vbd_user['validate']['state'] != undefined && json_vbd_user['validate']['state']===false){
                            vbToast('warning','Fill the fields correctly');
                        } else if( json_vbd_user['response']['result']['error'][1] != undefined && json_vbd_user['response']['result']['error'][1]===1062){
                            vbToast('warning','Error. Duplicate entry');
                        } else{
                            vbToast('warning','Error Adding Record');
                        }

                    }
//end of submission check
                } catch (e) {

                    // alert(content_vbd_user);
                    vbToast('error','An error have occured during the request.');
                    console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
                }
            } else{

                console.log("vbuilder-submition-process",'Loading vbd_user-vbd-add-form');

            }
        };
        xhr_vbd_user.send(data_vbd_user);



    } else{

        vbToast('warning','Please fill all required fields');

    }

});




// PHOTO UPLOAD

$(document).on("change","input[name=vbd-self-update-photo-file]",function(){
    var filesX = $(this)[0].files;
    var tempElem=$(this).files;
    var files = document.getElementById("vbd-self-update-photo-file").files;
    var file;
    $.when(vbdIsKeySet()).done(function( this_fvalidate ) {

        if(this_fvalidate && filesX.length>0){
if($(".dropdown-menu.self-update-photo")[0]){
    $(".dropdown-menu.self-update-photo").removeClass('show');
}

    $('#progressBarVbdUp').addClass('show-it');
    // var files = _("file1").files;



    var formdatax = new FormData();
    // alert(file.name+" | "+file.size+" | "+file.type);
    // loop through files

            for (var i = 0; i < files.length; i++) {

                // get item
                file = files.item(i);
                //or
                file = files[i];

              /*  if(file.size > 1*1024*1024) {
                    vbToast("success","File exceeded size 1MB");
                    return;
                }*/
                formdatax.append("file[]", file);


            }


    formdatax.append('vbd_key',vbdGetKey());
    formdatax.append('vbd_method',"self-update-photo");

            formdatax.append('date_folder','true');
            formdatax.append('file_repeat','true');
            formdatax.append('public','true');

    var ajax = new XMLHttpRequest();
    ajax.upload.addEventListener("progress", progressHandlerVbdUp, false);
    ajax.addEventListener("load", completeHandlerVbdUp, false);
    ajax.addEventListener("error", errorHandlerVbdUp, false);
    ajax.addEventListener("abort", abortHandlerVbdUp, false);
    ajax.open("POST", VBUILDER_APP_ROOT+"/api/global/vbd_user/");
    ajax.send(formdatax);


    function progressHandlerVbdUp(event) {
       var percent = (event.loaded / event.total) * 100;
        document.getElementById("progressBarVbdUp").value = Math.round(percent);
    }

    function completeHandlerVbdUp(event) {
        // alert(JSON.parse(event.target.responseText));

        getVbUploadStatus(event.target.responseText);

        // document.getElementById("statusVbdUp").innerHTML = event.target.responseText;
        document.getElementById("progressBarVbdUp").value = 0;
        $('.loader_upload').hide();
        $('#progressBarVbdUp').removeClass('show-it');
        $('#total-files').text('');
        $('#upload_form').trigger('reset');
    }




    function errorHandlerVbdUp(event) {
     vbToast("error","Upload Failed");
    }

    function abortHandlerVbdUp(event) {
        vbToast("error","Upload Aborted");
    }

    function getVbUploadStatus(content_vbd_user) {
        try {

            // alert(content_vbd_user);

            var json_vbd_user=JSON.parse(content_vbd_user);
//start of submission check
            if(json_vbd_user['response']['state']===1){

                vbToast("success","Profile photo updated");

                $(".vbd-avatar-img.vbd-user-data").css("background-image", "url('"+VBUILDER_APP_ROOT+"/"+json_vbd_user['response']['photo']+"')");
            }
            else
            {
// checking for the errors
                if(json_vbd_user['response']['state']===1920){

                    vbToast('warning','Please login');

                } else if(json_vbd_user['response']['state']===2){

                    vbToast('warning','Please upload a image');

                }  else if( json_vbd_user['rq_fields']['missing']['count'] != undefined && json_vbd_user['rq_fields']['missing']['count']!==0){
                    vbToast('warning','Please fill all required fields');
                } else if( json_vbd_user['validate']['state'] != undefined && json_vbd_user['validate']['state']===false){
                    vbToast('warning','Fill the fields correctly');
                } else if( json_vbd_user['response']['result']['error'][1] != undefined && json_vbd_user['response']['result']['error'][1]===1062){
                    vbToast('warning','Error. Duplicate entry');
                } else{
                    vbToast('warning','Error Adding Record');
                }

            }
//end of submission check
        } catch (e) {

            vbToast('error','An error have occured during the request.');
            console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
        }
    }

        } else{

            if(filesX.length==0){
                vbToast('warning','Please select a file');

            } else{
                vbToast('warning','You didn\'t log in');

            }

        }
    });


});


/*$(document).on('click','.vbd_user-modal-self-update-w .vbd-avatar-img.vbd-user-data', function(e) {

$("label.vbd-avatar-img-trigger").trigger("click");

});*/

$(document).on('click','.vbd-avatar-img-trigger-call', function(e) {

    $(".vbd-avatar-img-trigger").trigger("click");

});



// view user photo
$(document).on('click','.vbd-avatar-img-trigger', function(e) {

    e.preventDefault();


    var bgTemp = $(this ).find("img").css('background-image');
    bgTemp = bgTemp.replace('url(','').replace(')','').replace(/\"/gi, "");

    $("#vbd_user-modal-self-view-photo img.vbd-user-holder").attr("src",bgTemp);

    // $('.modal.show').modal('hide');
    $('#vbd_user-modal-self-view-photo').modal('show');

});








function self_reload_vbd_user() {

    var data_vbd_user="vbd_method=self-readcontrol&vbd_key="+vbdGetKey();


    var xhrVBD= new XMLHttpRequest();
    xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_user/",true);
    xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    xhrVBD.onreadystatechange= function () {
        if(xhrVBD.readyState===4 && xhrVBD.status===200){


            var json_vbd_user= JSON.parse(xhrVBD.responseText);
            var jsonVOB= JSON.parse(json_vbd_user['response']['result']['data-json']);

            $vbdApp.changeIt('user_rn',jsonVOB['user_rn']);

            if(jsonVOB['user_photo']!=null){

                setVbdUserPhoto(jsonVOB['user_photo']);
            }

            if($(".user_rn.vbd_user-self-holder")[0]){

                $(".user_rn.vbd_user-self-holder").each(function () {
                    $(this).text( jsonVOB['user_rn'] );
                });
            }




            if($(".user_name.vbd_user-self-holder")[0]){

                $('.user_name.vbd_user-self-holder').text( jsonVOB['user_name'] );
            }

            if($(".user_email.vbd_user-self-holder")[0]){

                $('.user_email.vbd_user-self-holder').text( jsonVOB['user_email'] );
            }



        }
        if(xhrVBD.readyState<4){

        }
    };

    xhrVBD.send(data_vbd_user);
}


// REMOVE USER PHOTO
$(document).on('click','.vbd-self-update-remove-photo', function(e) {

    e.preventDefault();

    $.when(vbdIsKeySet()).done(function( this_fvalidate ) {

        if(this_fvalidate){


            var data_vbd_user="vbd_method=self-update-rphoto&vbd_key="+vbdGetKey();


            var url= VBUILDER_APP_ROOT+"/api/global/vbd_user/";
            var content_vbd_user="none-v";

            var xhr_vbd_user= new XMLHttpRequest();
            xhr_vbd_user.open('POST',url,true);
            xhr_vbd_user.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr_vbd_user.onreadystatechange= function () {
                if(xhr_vbd_user.readyState===4 && xhr_vbd_user.status===200){
                    content_vbd_user=xhr_vbd_user.responseText;
                    try {


                        var json_vbd_user=JSON.parse(content_vbd_user);
//start of submission check
                        if(json_vbd_user['response']['state']===1){
                            item_id_update_vbd_user=null;

                            if($(".vbd-avatar-img.vbd-user-data")[0]){
                                $(".vbd-avatar-img.vbd-user-data").css("background-image", "url('"+VBUILDER_APP_ROOT+"/lib/img/avatar-sample.png')");
                            }
// load the list
                            if( json_vbd_user['response']['result']['affected'] != undefined && json_vbd_user['response']['result']['affected']>0){
                                vbToast('success','Photo removed');

                                self_reload_vbd_user();

                            } else {
                                $('#vbd_user-modal-self-update').modal('hide');
                                vbToast('warning','None change applied');
                            }

                        }
                        else
                        {
// checking for the errors
                            if(json_vbd_user['response']['state']===1920){

                                vbToast('warning','Please login');

                            }  else if( json_vbd_user['rq_fields']['missing']['count'] != undefined && json_vbd_user['rq_fields']['missing']['count']!==0){
                                vbToast('warning','Please fill all required fields');
                            } else if( json_vbd_user['validate']['state'] != undefined && json_vbd_user['validate']['state']===false){
                                vbToast('warning','Fill the fields correctly');
                            } else if( json_vbd_user['response']['result']['error'][1] != undefined && json_vbd_user['response']['result']['error'][1]===1062){
                                vbToast('warning','Error. Duplicate entry');
                            } else{
                                vbToast('warning','Error removing photo');
                            }

                        }
//end of submission check

                    } catch (e) {

                        vbToast('error','An error have occured during the request.');
                        console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
                    }
                } else{

                    console.log("vbuilder-submition-process",'Loading vbd_user-vbd-self-update-rphoto');

                }
            };
            xhr_vbd_user.send(data_vbd_user);




        } else{

            vbToast('warning','You didn\'t log in');

        }
    });


});



// CONFIRM EMAIL -EMAIL

$(document).on('click','.vbd-confirm-user-email', function(e) {

    e.preventDefault();

    vbToast('success','Sending confirmation to email');


    $.when(vbdIsKeySet()).done(function( this_fvalidate ) {



            $.when(vbdGetUserData()).done(function( tempUserData ) {



                if(this_fvalidate){
                var data_vbd_user="vbd_method=self-email-conf&vbd_key="+vbdGetKey();


                var url= VBUILDER_APP_ROOT+"/api/global/vbd_user/";
                var content_vbd_user="none-v";

                var xhr_vbd_user= new XMLHttpRequest();
                xhr_vbd_user.open('POST',url,true);
                xhr_vbd_user.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr_vbd_user.onreadystatechange= function () {
                    if(xhr_vbd_user.readyState===4 && xhr_vbd_user.status===200){
                        content_vbd_user=xhr_vbd_user.responseText;
                        try {


                            var json_vbd_user=JSON.parse(content_vbd_user);
//start of submission check
                            if(json_vbd_user['response']['state']===1){
                                vbToast('success','Email confirmation steps sent to your email');
                            }
                            else
                            {
// checking for the errors
                                if(json_vbd_user['response']['state']===1920){

                                    vbToast('warning','Please login');

                                } else if(json_vbd_user['response']['state']===2){

                                    vbToast('error','Could not send verification to your email');
                                    vbToast('warning','Verify network / make sure that email exists');

                                } else  if(json_vbd_user['response']['state']===11){

                                vbToast('warning','Email already confirmed');
                                }   else{
                                    vbToast('warning','Error sending email confirmation');
                                }

                            }
//end of submission check

                        } catch (e) {

                            vbToast('error','An error have occured during the request.');
                            console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
                        }
                    } else{

                        console.log("vbuilder-submition-process",'Loading vbd_user-vbd-self-update-rphoto');

                    }
                };
                xhr_vbd_user.send(data_vbd_user);




            } else{

                vbToast('warning','You didn\'t log in');

            }

            });

    });


});







