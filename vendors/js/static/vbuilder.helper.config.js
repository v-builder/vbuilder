var vbdHtmlBody=$('body');
// site url
var VBD_ROOT= ( (vbdHtmlBody.data('root'))? vbdHtmlBody.data('root') : "http://localhost/vbuilder" );

// site url
var VBD_USERS= ( (vbdHtmlBody.data('users-url'))? vbdHtmlBody.data('users-url') : "http://localhost/vbuilder/users" );

// login url
var VBD_LOGIN_URL = ( (vbdHtmlBody.data('login'))? vbdHtmlBody.data('login') : "http://localhost/vbuilder/login" );

// vbuilder app path
var VBUILDER_APP_ROOT= ( (vbdHtmlBody.data('app-root'))? vbdHtmlBody.data('app-root') : "http://localhost/vbuilder/vapp" );

// root base complete
var VBD_AJAX_ROOT=VBD_ROOT+"/";

// language var
var VBD_LANG= ( (vbdHtmlBody.data('lang-code'))? vbdHtmlBody.data('lang-code') : "default" );

// user data
var VBD_USER_DATA= ((vbdIsCookieSet("vbd_user_data") && vbdIsCookieSet("vbd_key"))? JSON.parse(vbdGetCookie("vbd_user_data")) : null);

var VBD_LOADED_COUNTRY_CODES=false;

// inportant triggers --------------------------
/*
.vbd-action-self-view
.vbd-confirm-user-email
.vbd-user-update-trigger
.vbd-logout-trigger
*/
// inportant triggers --------------------------
$(document).ready(function() {

    if($('.mdb-select')[0]){

        // $('.mdb-select').material_select();
        // Material Select Destroy

    }

    //

});


// console.log($vbdApp);
function vbdToastClear() {
    toastr.clear();
}
function vbToast(tstype,strxt) {
    // alert(strxt);
  try {
      toastr.options = {
          "closeButton": false,
          "debug": false,
          "newestOnTop": false,
          "progressBar": false,
          "positionClass": "toast-top-right",
          "preventDuplicates": false,
          "onclick": null,
          "showDuration": "300",
          "hideDuration": "1000",
          "timeOut": "5000",
          "extendedTimeOut": "1000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
      };
      toastr[""+tstype](strxt);
  } catch (e) {
      // alert("Ersh: "+e.message+strxt);
      alert("Ersh: "+strxt);
  }
}


function vbIsCookie() {
    var cookieEnabled = navigator.cookieEnabled;
    if (!cookieEnabled){
        document.cookie = "testcookie";
        cookieEnabled = document.cookie.indexOf("testcookie")!=-1;
    }
    // alert(cookieEnabled);
    return cookieEnabled;
}

function vbdGetKey() {
    // var Cookies2 = Cookies.noConflict();
    return  (vbdIsKeySet("vbd_key")? Cookies.get('vbd_key') : "");
}

function vbdGetUserData() {
    // var Cookies2 = Cookies.noConflict();
    return  (vbdIsKeySet("user_data")? Cookies.get('user_data') : "");
}

function vbdGetCookie(thisvbd) {
    // var Cookies2 = Cookies.noConflict();
    return  (vbdIsKeySet(thisvbd)? Cookies.get(thisvbd) : "");
}


function vbdRemoveKey() {
    // var Cookies2 = Cookies.noConflict();
var tempResult=false;

try{
    Cookies.remove('vbd_key');
    tempResult=true;
} catch (e) {

}

  return tempResult;
}
function vbdRemoveCookie(thisvbd) {
    // var Cookies2 = Cookies.noConflict();
var tempResult=false;

try{
    Cookies.remove(thisvbd);
    tempResult=true;
} catch (e) {

}

  return tempResult;
}


function vbdSetKey(tempVar) {
    // var Cookies2 = Cookies.noConflict();
var tempResult=false;

try{

    Cookies.set('vbd_key', tempVar , { expires: 1000 });

    tempResult=true;
} catch (e) {
vbToast('error','errSetCookie: '+e.message);
}

  return tempResult;
}
function vbdSetCookie(vbdCookiName,tempVar) {
    // var Cookies2 = Cookies.noConflict();
var tempResult=false;

try{

    Cookies.set(vbdCookiName, tempVar , { expires: 1000 });

    tempResult=true;
} catch (e) {

}

  return tempResult;
}


function vbdIsKeySet() {

    var tempVar=false;

    if(vbIsCookie()){

        if (document.cookie.indexOf("vbd_key") >= 0) {
            tempVar=true;
        }


    } else{
        vbToast('error','Cookies disabled. Please allow cookies to proceed');
    }
    return tempVar;

}

function vbdIsCookieSet(thidvbd) {

    var tempVar=false;

    if(vbIsCookie()){

        if (document.cookie.indexOf(thidvbd) >= 0) {
            tempVar=true;
        }


    } else{
        vbToast('error','Cookies disabled. Please allow cookies to proceed');
    }
    return tempVar;

}


function vbdDisableSubmit(elemVB) {
    elemVB.find(".vbd-btn-submit").attr('disabled', true);
    elemVB.find(".vbd-submition-loader").fadeIn();

}

function vbdEnableSubmit(elemVB) {
    elemVB.find(".vbd-btn-submit").attr('disabled', false);
    elemVB.find(".vbd-submition-loader").fadeOut(300);
}


function vbdLoadUserData() {

    $.when(vbdIsKeySet()).done(function( this_fvalidate ) {

        if(this_fvalidate){

            // start it ---------
            var data_vbd_user="vbd_method=self-readcontrol&vbd_key="+vbdGetKey();


            var xhrVBD= new XMLHttpRequest();
            xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_user/",true);
            xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


            xhrVBD.onreadystatechange= function () {
                if(xhrVBD.readyState===4 && xhrVBD.status===200){


                    vbdLoadUserDataExecute(xhrVBD.responseText);
                }
                if(xhrVBD.readyState<4){

                }
            };

            xhrVBD.send(data_vbd_user);
            // end it ---------



        } else{

            // vbToast('warning','You didn\'t log in');

        }
    });


}





function vbdLoadUserDataExecute(thisvbd){


try {

    var json_vbd_user=JSON.parse(thisvbd);
//start of submission check
    if(json_vbd_user['response']['state']===1 && json_vbd_user['response']['result']['rows']>0){

//vbToast('success','Record Successfully loaded!');



        var jsonVOB= JSON.parse(json_vbd_user['response']['result']['data-json']);
        var jsonPDATA= JSON.parse(json_vbd_user['response']['result']['p_data']);


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

            // set USER DATA IN COOKIE
            if(VBD_ROOT===window.location.href || VBD_ROOT+"/"===window.location.href){
                // case you want root uncomment bellow & comment above
            // if(window.location.pathname=="/"){
                if(jsonVOB['user_email_conf']!='true'){

                    // case you want a email confirmation alert
                    vbToast('warning','Please confirm your email');
                }
                
            }


            vbdSetCookie("vbd_user_data",json_vbd_user['response']['result']['data-json']);

            VBD_USER_DATA=JSON.parse(json_vbd_user['response']['result']['data-json']);

            // alert(vbdGetCookie("vbd_user_data_"+jsonVOB['user_id']));
            if(jsonVOB['user_photo']!=null){

                setVbdUserPhoto(jsonVOB['user_photo']);
            }

            var tempLBL="";
            var tempLBL2="";

            if($("#vbd-user-self-view")[0]){

                $('#vbd-user-self-view .ulevel_id.vbd_user-self-holder').text(vbdUserLevelDataStorageSelf[[ jsonVOB['ulevel_id'] ]] ['ulevel_name']);

                $('#vbd-user-self-view .user_rn.vbd_user-self-holder').text( jsonVOB['user_rn'] );
                $('#vbd-user-self-view .user_idate.vbd_user-self-holder').text( jsonVOB['user_idate'] );
                $('#vbd-user-self-view .user_name.vbd_user-self-holder').text( jsonVOB['user_name'] );
                $('#vbd-user-self-view .user_email.vbd_user-self-holder').text( jsonVOB['user_email'] );
                $('#vbd-user-self-view .user_email_conf.vbd_user-self-holder').text( ((jsonVOB['user_email_conf']=='true')? "Confirmed": "Not confirmed") );
                $('#vbd-user-self-view .user_password.vbd_user-self-holder').text( jsonVOB['user_password'] );
                $('#vbd-user-self-view .user_state.vbd_user-self-holder').text( jsonVOB['user_state'] );

            }

            if($(".vbd-user-self-view")[0]){


                $('.vbd-user-self-view .ulevel_id.vbd_user-self-holder').text(vbdUserLevelDataStorageSelf[[ jsonVOB['ulevel_id'] ]] ['ulevel_name']);

                $('.vbd-user-self-view .user_rn.vbd_user-self-holder').text( jsonVOB['user_rn'] );
                $('.vbd-user-self-view .user_idate.vbd_user-self-holder').text( jsonVOB['user_idate'] );
                $('.vbd-user-self-view .user_name.vbd_user-self-holder').text( jsonVOB['user_name'] );
                $('.vbd-user-self-view .user_email.vbd_user-self-holder').text( jsonVOB['user_email'] );
                $('.vbd-user-self-view .user_email_conf.vbd_user-self-holder').text( ((jsonVOB['user_email_conf']=='true')? "Confirmed": "Not confirmed") );
                $('.vbd-user-self-view .user_password.vbd_user-self-holder').text( jsonVOB['user_password'] );
                $('.vbd-user-self-view .user_state.vbd_user-self-holder').text( jsonVOB['user_state'] );

            }

            if($(".vbd_pd_about.pdata-self-holder")[0]){
                $(".vbd_pd_about.pdata-self-holder").text(jsonPDATA['about']);
            }

            if($(".user-ocupation-typo-self-holder")[0]){
            if(jsonPDATA['vbd_at_id']=='1'){

                if(jsonPDATA['usp_label_value']!=null && jsonPDATA['usp_type_value']!=null){
                    if(jsonPDATA['usp_label_value'].length>1 && jsonPDATA['usp_type_value'].length>1){
                        tempLBL="Works at";
                        tempLBL2="as";
                    }
                }

                    $(".user-ocupation-typo-self-holder").html(tempLBL+" <strong class='vbd_pd_usp_label_value pdata-self-holder'> </strong> "+tempLBL2+" \n" +
                        "                            <strong class='vbd_pd_usp_type_value pdata-self-holder'></strong>");
                }
            if(jsonPDATA['vbd_at_id']=='2'){

                if(jsonPDATA['usp_label_value']!=null && jsonPDATA['usp_type_value']!=null){
                    if(jsonPDATA['usp_label_value'].length>1 && jsonPDATA['usp_type_value'].length>1){
                        tempLBL="Studies";
                        tempLBL2="at";
                    }
                }


                $(".user-ocupation-typo-self-holder").html(tempLBL+" <strong class='vbd_pd_usp_type_value pdata-self-holder'></strong> "+tempLBL2+" \n <strong class='vbd_pd_usp_label_value pdata-self-holder'> </strong> \n" +
                        "                            ");
                }
            }


            if($(".vbd_pd_usp_label_value.pdata-self-holder")[0] && jsonPDATA['usp_label_value']!=null){
                var tempoVar="";
                if(jsonPDATA['usp_type_value'].length>1){
                     // tempoVar=" | ";
                }
                $(".vbd_pd_usp_label_value.pdata-self-holder").text(jsonPDATA['usp_label_value']+tempoVar);
            }
            if($(".vbd_pd_usp_type_value.pdata-self-holder")[0] && jsonPDATA['usp_type_value']!=null){
                $(".vbd_pd_usp_type_value.pdata-self-holder").text(jsonPDATA['usp_type_value']);
            }
            if($(".vbd_pd_usp_bio.pdata-self-holder")[0]){
                $(".vbd_pd_usp_bio.pdata-self-holder").text(jsonPDATA['bio']);
            }



        });




    }
    else
    {
// checking for the errors
        if(json_vbd_user['response']['state']===1920){

            // vbToast('warning','You are not logged in');

        } else if( json_vbd_user['rq_fields']['missing']['count'] != undefined && json_vbd_user['rq_fields']['missing']['count']!==0){
            vbToast('warning','Missing request data');
        } else if( json_vbd_user['validate']['state'] != undefined && json_vbd_user['validate']['state']===false){
            vbToast('warning','Wrong request data');
        }else{

            // vbToast('warning','2Error while loading user data');
        }


    }
//end of submission check


} catch (e) {

    vbToast('error','-Error while loading user data');
    alert(e.message);
    // vbToast("error",'Error requesting json || Message: '+e.message);
    console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
}


}


function executeSingleUser() {

    var urlVBDX = new URL(document.URL);
    var query_stringVBDX = urlVBDX.search;

    var search_paramsVBDX = new URLSearchParams(query_stringVBDX);

    if(search_paramsVBDX.get('username')){

        $.when(vbdIsKeySet()).done(function( this_fvalidate ) {

            if(this_fvalidate){
                $.when(vbdGetKey()).done(function( dataTmpVal ) {
                    vbdLoadSingleUserData( search_paramsVBDX.get('username') ,dataTmpVal);
                });
            } else {
                vbdLoadSingleUserData( search_paramsVBDX.get('username') ,"null");
            }
        });
    } else{
        $("#vbd-user-p-view").addClass('d-none');
        $("#vbd-user-p-view-error").removeClass('d-none');
    }

}

function vbdLoadSingleUserData(tempUN,vbdTmpKey) {



    // start it ---------
    var data_vbd_user="vbd_method=p-readcontrol&user_name="+tempUN+"&vbd_key="+vbdTmpKey;


    var xhrVBD= new XMLHttpRequest();
    xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_user/",true);
    xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    xhrVBD.onreadystatechange= function () {
        if(xhrVBD.readyState===4 && xhrVBD.status===200){


            vbdLoadSingleUserDataExecute(xhrVBD.responseText);
        }
        if(xhrVBD.readyState<4){

        }
    };

    xhrVBD.send(data_vbd_user);
    // end it ---------

}


function vbdLoadSingleUserDataExecute(thisvbd){

    try {

        var json_vbd_user=JSON.parse(thisvbd);
//start of submission check
        if(json_vbd_user['response']['state']===1 ){

//vbToast('success','Record Successfully loaded!');



            var jsonVOB= JSON.parse(json_vbd_user['response']['result']['data-json']);
            var jsonPDATA= JSON.parse(json_vbd_user['response']['result']['p_data']);


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

                // set USER DATA IN COOKIE

                VBD_USER_DATA=JSON.parse(json_vbd_user['response']['result']['data-json']);

                // alert(vbdGetCookie("vbd_user_data_"+jsonVOB['user_id']));
                if(jsonVOB['user_photo']!=null){

                    setVbdUserSinglePhoto(jsonVOB['user_photo']);
                }

var tempLBL="";
var tempLBL2="";


                document.title=jsonVOB['user_rn']+" | Profile";


                $(".cr-trigger.p-holder").attr('data-user-id',jsonVOB['user_id'] );



                // users connection check --------------------------------------------
                if( jsonVOB['found_cr'] != undefined ){


                    try {

                        if(jsonVOB['found_cr']=='true'){
                          $('.cr-trigger.cr-remove-it').removeClass('d-none');
                            $('.cr-trigger.cr-add-success').removeClass('d-none');
                        } else {
                            $('.cr-trigger.cr-add-it').removeClass('d-none');

                        }

                    } catch (e) {

                    }


                }



                $('#vbd-user-p-view .user_rn.vbd_user-p-holder').text( jsonVOB['user_rn'] );
                $('#vbd-user-p-view .user_idate.vbd_user-p-holder').text( jsonVOB['user_idate'] );
                $('#vbd-user-p-view .user_name.vbd_user-p-holder').text( jsonVOB['user_name'] );
                $('#vbd-user-p-view .user_email.vbd_user-p-holder').text( jsonVOB['user_email'] );
                $('#vbd-user-p-view .user_email_conf.vbd_user-p-holder').text( ((jsonVOB['user_email_conf']=='true')? "Confirmed": "Not confirmed") );
                $('#vbd-user-p-view .user_password.vbd_user-p-holder').text( jsonVOB['user_password'] );
                $('#vbd-user-p-view .user_state.vbd_user-p-holder').text( jsonVOB['user_state'] );

                if($(".vbd_pd_about.pdata-p-holder")[0]){
                    $(".vbd_pd_about.pdata-p-holder").text(jsonPDATA['about']);
                }


                if($(".user-ocupation-typo-p-holder")[0]){
                    if(jsonPDATA['vbd_at_id']=='1'){

                        if(jsonPDATA['usp_label_value']!=null && jsonPDATA['usp_type_value']!=null){
                            if(jsonPDATA['usp_label_value'].length>1 && jsonPDATA['usp_type_value'].length>1){
                                tempLBL="Works at";
                                tempLBL2="as";

                            }
                        }

                        $(".user-ocupation-typo-p-holder").html(tempLBL+" <strong class='vbd_pd_usp_label_value pdata-p-holder'>"+"</strong> "+tempLBL2+" \n <strong class=' vbd_pd_usp_type_value  pdata-p-holder'>"+" </strong> \n" +
                            "                            ");

                    }
                    if(jsonPDATA['vbd_at_id']=='2'){

                        if(jsonPDATA['usp_label_value']!=null && jsonPDATA['usp_type_value']!=null){
                            if(jsonPDATA['usp_label_value'].length>1 && jsonPDATA['usp_type_value'].length>1){
                                tempLBL="Studies";
                                tempLBL2="at";

                                $(".user-ocupation-typo-p-holder").html(tempLBL+" <strong class='vbd_pd_usp_type_value pdata-p-holder'>"+"</strong> "+tempLBL2+" \n <strong class='vbd_pd_usp_label_value pdata-p-holder'>"+" </strong> \n" +
                                    "                            ");

                            }
                        }


                    }
                }


                if($(".vbd_pd_usp_label_value.pdata-p-holder")[0] && jsonPDATA['usp_label_value']!=null){


                        var tempoVar="";
                        if(jsonPDATA['usp_type_value']!=null){
                            // tempoVar=" as ";
                        }
                        $(".vbd_pd_usp_label_value.pdata-p-holder").text(jsonPDATA['usp_label_value']+tempoVar);


                }

                if($(".vbd_pd_usp_type_value.pdata-p-holder")[0] && jsonPDATA['usp_type_value']!=null){
                    $(".vbd_pd_usp_type_value.pdata-p-holder").text(jsonPDATA['usp_type_value']);
                }
                if($(".vbd_pd_usp_bio.pdata-p-holder")[0]){
                    $(".vbd_pd_usp_bio.pdata-p-holder").text(jsonPDATA['bio']);
                }



                $.when(vbdIsKeySet()).done(function( this_fvalidate ) {

                    if(this_fvalidate){
                        $.when(vbdGetKey()).done(function( dataTmpVal ) {


                            // alert(jsonVOB['found_cr']);


                        });
                    }
                });



            });




        }
        else
        {

            $("#vbd-user-p-view").addClass('d-none');
            $("#vbd-user-p-view-error").removeClass('d-none');

// checking for the errors
            if(json_vbd_user['response']['state']===1920){

                // vbToast('warning','You are not logged in');

            } else if( json_vbd_user['rq_fields']['missing']['count'] != undefined && json_vbd_user['rq_fields']['missing']['count']!==0){
                vbToast('warning','Missing request data');
            } else if( json_vbd_user['validate']['state'] != undefined && json_vbd_user['validate']['state']===false){
                vbToast('warning','Wrong request data');
            }else{

                vbToast('warning','2Error while loading user data');
            }


        }
//end of submission check


    } catch (e)
    {



        vbToast('error','Error while loading user data');
        // alert(e.message);
        // alert(thisvbd);
        // vbToast("error",'Error requesting json || Message: '+e.message);
        console.log("vbuilder-error",'Error requesting json || Message: '+e.message);

    }


}








// ---------- PUBLIC ALLOWED DATA -------------




function vbdReadPublic() {


    var this_fvalidate=true;
    if(this_fvalidate){

        // start it ---------
        var data_vbd_user="vbd_method=read-public";


        var xhrVBD= new XMLHttpRequest();
        xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_user/",true);
        xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


        xhrVBD.onreadystatechange= function () {
            if(xhrVBD.readyState===4 && xhrVBD.status===200){


                vbdLoadPublic(xhrVBD.responseText);
            }
            if(xhrVBD.readyState<4){

            }
        };

        xhrVBD.send(data_vbd_user);
        // end it ---------



    } else{

        // vbToast('warning','You didn\'t log in');

    }


}








function vbdLoadPublic(thisvbd){
// alert(thisvbd);
    var urlVBDX = new URL(document.URL);
    var query_stringVBDX = urlVBDX.search;

    var search_paramsVBDX = new URLSearchParams(query_stringVBDX);
    var isSetUserGet="";
    if(search_paramsVBDX.get('username')){
        isSetUserGet=search_paramsVBDX.get('username');
    }

    vbdLoadUserData();
    $.when(vbdIsKeySet()).done(function( this_fvalidate ) {


    var imgTemp="";
    var tempUrl="";
    var tempVar="";
        var VBD_USER_DATA_TMP=[];
        if(this_fvalidate) {
             VBD_USER_DATA_TMP = JSON.parse(vbdGetCookie("vbd_user_data"));
             VBD_USER_DATA_TMP = JSON.parse(VBD_USER_DATA_TMP[0]);

        }

    try {



        var json_vbd_user=JSON.parse(thisvbd);
//start of submission check
        if(json_vbd_user['response']['state']===1 && json_vbd_user['response']['result']['rows']>0){

//vbToast('success','Record Successfully loaded!');

            var foundCrTg="";

            var jsonVOB= json_vbd_user['response']['result']['data-json'];

            if($(".vbd-users-list.public-loading")[0]){
                $(".vbd-users-list.public-loading").html("");
            }

            if($(".vbd-users-list.public-discover")[0]){
                $(".vbd-users-list.public-discover").html("");
            }

            var usp_type_value2="";
            var usp_type_value="";
            var usp_label_value="";

            // alert(json_vbd_user['response']['result']['data-json']);

            for ( var ix = 0; ix < jsonVOB.length; ix++) {


                foundCrTg="";

                var jsonVOB2= JSON.parse(jsonVOB[ix]);


                if(isSetUserGet===jsonVOB2['user_name']){
                    continue;
                }

                imgTemp=VBUILDER_APP_ROOT+"/lib/img/avatar-sample.png";

                if(jsonVOB2['file_path']!=null){
                    imgTemp=VBUILDER_APP_ROOT+"/"+jsonVOB2['file_path'];
                }
                tempVar="";
                usp_type_value2="";
                usp_type_value="";
                usp_label_value="";

                // if(jsonVOB2['vbd_at_id']==1) {
                    if(jsonVOB2['usp_type_value']!=null){

                        usp_type_value=jsonVOB2['usp_type_value'];
                    }

                    if(jsonVOB2['usp_label_value']!=null){

                        usp_label_value=jsonVOB2['usp_label_value'];
                        usp_type_value2="at"
                    }

                    tempVar="<strong class='vbd_pd_usp_type_value '>"+usp_type_value+"</strong>" + " "+usp_type_value2+" <strong class='vbd_pd_usp_label_valuer'>"+usp_label_value+"</strong>\n";


                // }

                tempUrl=VBD_USERS+jsonVOB2['user_name'];



                if(this_fvalidate){

                    if(VBD_USER_DATA_TMP['user_id']==jsonVOB2['user_id']){
                        continue;
                    }

                }


                var finalTG="";

                if(jsonVOB2['found_cr'] != undefined){
                    finalTG="tg-remove-it";
                    if(jsonVOB2['found_cr']=='false'){
                        finalTG="tg-add-it";
                    }
                }




                if(jsonVOB2['found_cr'] != undefined){
                foundCrTg="<a href='javascript:;' class='trigger-connection "+finalTG+" ' data-user-id='"+jsonVOB2['user_id']+"'>  " +
                    "<span class='fa fa-link fa-tg-add-it' data-toggle='tooltip' title='Connect'></span>  <span class='fa fa-unlink fa-tg-remove-it' data-toggle='tooltip' title='Disconnect'></span> </a>";
                    }

                if($(".vbd-users-list.public-loading")[0]){

                    if(jsonVOB2['found_cr'] != undefined){
                        foundCrTg="<a href='javascript:;' class='trigger-connection "+finalTG+" ' data-user-id='"+jsonVOB2['user_id']+"'>  " +
                            "<span class='fa fa-link fa-tg-add-it' data-toggle='tooltip' title='Connect'></span>  <span class='fa fa-unlink fa-tg-remove-it' data-toggle='tooltip' title='Disconnect'></span> </a>";

                    }


                    $(".vbd-users-list.public-loading").append("<!--                start of a user   -->\n" +
                    "                <li class='vbd-user-item col-12'>\n" +
                    foundCrTg +
                    "                    <div  class='row'>\n" +
                    "  " +
                    "                      <div class='col-3 col-md-4 vbd-uer-item-img'>\n" +
                    "                            \n" +
                    "                                <img class='vbd-avatar-img vbd-user-p-data' style=\""+"background-image: url('"+imgTemp+"');"+"\" src='"+VBUILDER_APP_ROOT+"/lib/img/shape_square.png' alt='profile photo'/>\n" +
                    "  \n" +
                    "                        </div>\n" +
                    "\n" +
                    "                        <div class='col-8 col-md-7  vbd-uer-item-scope'>\n" +
                    "      <a href='"+tempUrl+"'>" +
                    "                      <p class='style-user-rn'>  <span class='p_user_rn vbd_user-p-holder'>"+jsonVOB2['user_name']+"</span>  </p>\n" +
                    "                            <p class='style-user-professional p-user-ocupation-typo-self-holder'>\n" +
                     tempVar+
                    " </p> " +
                    "</a>" +
                    "</div>\n" +
                    "              </a>\n" +


                    "                </li>");
                    }


                if($(".vbd-users-list.public-discover")[0]){
                // for discover


                    if(jsonVOB2['found_cr'] != undefined){
                    foundCrTg="<a href='javascript:;' class='trigger-connection "+finalTG+"  btn btn-sm' data-user-id='"+jsonVOB2['user_id']+"'>  " +
                        "<span class='fa-tg-add-it'>Connect <span class='fa fa-link fa-tg-add-it' ></span></span>    <span class='fa-tg-remove-it'>Disconnect <span class='fa fa-unlink fa-tg-remove-it'></span> </span></a>";
                        }

                    $(".vbd-users-list.public-discover").append(

                    "\n" +
                    "                   <div class='col-12 col-md-4 col-lg-3 vbd-user-item'>\n" +
                    "\n" +
                    "                       <a href='"+tempUrl+"'>\n" +
                    "\n" +
                    "                           <div class='vbd-user-item-w'>\n" +
                    "\n" +
                    "                               <div class=' col-7 col-md-9 mx-auto vbd-uer-item-img'>\n" +
                    "\n" +
                    "                                   <img class='vbd-avatar-img vbd-user-p-data' style='background-image: url(\""+imgTemp+"\");' src='"+VBUILDER_APP_ROOT+"/lib/img/shape_square.png' alt='profile photo'>\n" +
                    "\n" +
                    "                               </div>\n" +
                    "\n" +
                    "                               <div class='col-12  vbd-uer-item-scope'>\n" +
                    "                                   <a href='"+tempUrl+"'>                      <p class='style-user-rn'>  <span class='p_user_rn vbd_user-p-holder'>"+jsonVOB2['user_name']+"</span>  </p>\n" +
                    "                                       <p class='style-user-professional p-user-ocupation-typo-self-holder'>\n" +
                    "                                       " +tempVar+
                    "  </p> </a></div>\n" +
                    "\n" +
                    "\n" + foundCrTg +
                    "\n" +
                    "\n" +
                    "\n" +
                    "                           </div>\n" +
                    "\n" +
                    "                       </a>\n" +
                    "\n" +
                    "                       </div>"
                );
                }


            }





        }
        else
        {
// checking for the errors


                vbToast('warning','Error while loading data');


        }
//end of submission check


    } catch (e) {

        vbToast('error','-Error while loading user data');
        alert(e.message);
        // vbToast("error",'Error requesting json || Message: '+e.message);
        console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
    }


    // when closer


    });




}