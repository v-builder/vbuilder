$(window).ready(function() {
// load the list
        check_vbd_rp();
});

var rpIdVBD=null;
var rpCodeVBD=null;
var rpRID=null;

function check_vbd_rp(){
        var urlVBD = new URL(document.URL);
        var query_stringVBD = urlVBD.search;

        var search_paramsVBD = new URLSearchParams(query_stringVBD);

        if(search_paramsVBD.get('rid')){
                rpRID=search_paramsVBD.get('rid');
        }

      if(search_paramsVBD.get('user_verify')){

              if(search_paramsVBD.get('rp_email')){
                      $(".vbd-verify-email").text(search_paramsVBD.get('rp_email'));
              }

              rpIdVBD=search_paramsVBD.get('user_verify');

              if(search_paramsVBD.get('rp_code')){



                      rpCodeVBD=search_paramsVBD.get('rp_code');

                      $(".vbd-rp-tab-content .tab-pane.active").removeClass("active");
                      $(".vbd-rp-tab-content .tab-pane.active").addClass("fade");

                      $("#self-rp-reset.tab-pane").removeClass("fade");
                      $("#self-rp-reset.tab-pane").addClass("active");
              } else {

                      $(".vbd-rp-tab-content .tab-pane.active").removeClass("active");
                      $(".vbd-rp-tab-content .tab-pane.active").addClass("fade");

                      $("#self-rp-verify.tab-pane").removeClass("fade");
                      $("#self-rp-verify.tab-pane").addClass("active");

              }



      }
}

/*
* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Author: Vayile Fumo
* Date: 07/09/2019, Saturday
* Time: 02:59 AM
* Project/Module: Password Reset*/

$('form[name=vbd_rp-vbd-self-add-form]').on('submit', function(e) {

        // e.preventDefault();
        var this_fvalidate=true;
        var thisForm=$(this);

        if(this_fvalidate){
                vbdDisableSubmit(thisForm);
                this_fvalidate=false;
                
                var data_preset_vbd_rp="vbd_method=self-add";
                var data_vbd_rp=data_preset_vbd_rp+'&'+$(this).serialize();


                var url= VBUILDER_APP_ROOT+"/api/global/vbd_rp/";
                var content_vbd_rp="none-v";

                var xhr_vbd_rp= new XMLHttpRequest();
                xhr_vbd_rp.open('POST',url,true);
                xhr_vbd_rp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr_vbd_rp.onreadystatechange= function () {


                        if(xhr_vbd_rp.readyState===4){
                                vbdEnableSubmit(thisForm);
                                this_fvalidate=true;
                        } else{
                                vbdDisableSubmit(thisForm);
                                this_fvalidate=false;
                        }

                        if(xhr_vbd_rp.readyState===4 && xhr_vbd_rp.status===200){
                                content_vbd_rp=xhr_vbd_rp.responseText;
                                // alert(content_vbd_rp);
                                try {


                                        var json_vbd_rp=JSON.parse(content_vbd_rp);
//start of submission check
                                        if(json_vbd_rp['response']['state']===1){

                                                rpIdVBD=json_vbd_rp['response']['result']['rp_id'];
                                                $(".vbd-verify-email").text(json_vbd_rp['response']['result']['rp_email']);
// load the list
                                                $('form[name=vbd_rp-vbd-self-add-form]').trigger("reset");
                                                // $('#vbd_rp-modal-add').modal('hide');
                                                vbToast('success','Verification code was sent to your email');
                                                // vbToast('success','Verification code sent to your email');

                                                $(".vbd-rp-tab-content .tab-pane.active").removeClass("active");
                                                $(".vbd-rp-tab-content .tab-pane.active").addClass("fade");

                                                $("#self-rp-verify.tab-pane").removeClass("fade");
                                                $("#self-rp-verify.tab-pane").addClass("active");

                                        }
                                        else
                                        {
// checking for the errors
                                                if(json_vbd_rp['response']['state']===2){

                                                        vbToast('warning','The username/email you entered doesn\'t belong to an account. Please check your username/email and try again.');

                                                } else if(json_vbd_rp['response']['state']===3){

                                                        vbToast('error','Error while sending verification code to your email');
                                                        vbToast('warning','Verify network / make sure the email exists');

                                                } else if( json_vbd_rp['rq_fields']['missing']['count'] != undefined && json_vbd_rp['rq_fields']['missing']['count']!==0){
                                                        vbToast('warning','Please fill all required fields');
                                                } else if( json_vbd_rp['validate']['state'] != undefined && json_vbd_rp['validate']['state']===false){
                                                        vbToast('warning','Fill the fields correctly');
                                                } else if( json_vbd_rp['response']['result']['error'][1] != undefined && json_vbd_rp['response']['result']['error'][1]===1062){
                                                        vbToast('warning','Error. Duplicate entry');
                                                } else{
                                                        vbToast('warning','Error recovering password');
                                                }

                                        }
//end of submission check
                                } catch (e) {

                                        vbToast('error','An error have occured during the request.');
                                        console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
                                }
                        } else{

                                console.log("vbuilder-submition-process",'Loading vbd_rp-vbd-add-form');

                        }
                };
                xhr_vbd_rp.send(data_vbd_rp);



        } else{

                vbToast('warning','Please fill all required fields');

        }

        return false;

});

/*
* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Author: Vayile Fumo
* Date: 07/09/2019, Saturday
* Time: 02:59 AM
* Project/Module: Password Reset*/



$('form[name=vbd_rp-vbd-self-verify-form]').on('submit', function(e) {

        // e.preventDefault();
        var this_fvalidate=true;
        var thisForm=$(this);

        if(this_fvalidate){
                vbdDisableSubmit(thisForm);
                this_fvalidate=false;

                var data_preset_vbd_rp="vbd_method=self-verify&rp_id="+rpIdVBD+"&rid="+rpRID;
                var data_vbd_rp=data_preset_vbd_rp+'&'+$(this).serialize();
                rpCodeVBD=$(this).find("input[name=rp_code]").val();


                var url= VBUILDER_APP_ROOT+"/api/global/vbd_rp/";
                var content_vbd_rp="none-v";

                var xhr_vbd_rp= new XMLHttpRequest();
                xhr_vbd_rp.open('POST',url,true);
                xhr_vbd_rp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr_vbd_rp.onreadystatechange= function () {

                        if(xhr_vbd_rp.readyState===4){
                                vbdEnableSubmit(thisForm);
                                this_fvalidate=true;
                        } else{
                                vbdDisableSubmit(thisForm);
                                this_fvalidate=false;
                        }

                        if(xhr_vbd_rp.readyState===4 && xhr_vbd_rp.status===200){
                                content_vbd_rp=xhr_vbd_rp.responseText;
                                // alert(content_vbd_rp);
                                try {


                                        var json_vbd_rp=JSON.parse(content_vbd_rp);
//start of submission check
                                        if(json_vbd_rp['response']['state']===1){

                
                                                $('form[name=vbd_rp-vbd-self-verify-form]').trigger("reset");
                                                // $('#vbd_rp-modal-add').modal('hide');
                                                // vbToast('success','Verification code sent to your email');
                                                // vbToast('success','Verification code sent to your email');


                                                $(".vbd-rp-tab-content .tab-pane.active").removeClass("active");
                                                $(".vbd-rp-tab-content .tab-pane.active").addClass("fade");

                                                $("#self-rp-reset.tab-pane").removeClass("fade");
                                                $("#self-rp-reset.tab-pane").addClass("active");

                                        }
                                        else
                                        {
// checking for the errors
                                                if(json_vbd_rp['response']['state']===2){

                                                        vbToast('error','Invalid code');

                                                } else if(json_vbd_rp['response']['state']===3){

                                                        vbToast('warning','Code expired. Request again');

                                                } else if( json_vbd_rp['rq_fields']['missing']['count'] != undefined && json_vbd_rp['rq_fields']['missing']['count']!==0){
                                                        vbToast('warning','Please fill all required fields');
                                                } else if( json_vbd_rp['validate']['state'] != undefined && json_vbd_rp['validate']['state']===false){
                                                        vbToast('warning','Fill the fields correctly');
                                                } else if( json_vbd_rp['response']['result']['error'][1] != undefined && json_vbd_rp['response']['result']['error'][1]===1062){
                                                        vbToast('warning','Error. Duplicate entry');
                                                } else{
                                                        vbToast('warning','Error verifying code');
                                                }

                                        }
//end of submission check
                                } catch (e) {

                                        vbToast('error','An error have occured during the request.');
                                        console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
                                }
                        } else{

                                console.log("vbuilder-submition-process",'Loading vbd_rp-vbd-add-form');

                        }
                };
                xhr_vbd_rp.send(data_vbd_rp);



        } else{

                vbToast('warning','Please fill all required fields');

        }

        return false;

});







$('form[name=vbd_rp-vbd-self-reset-form]').on('submit', function(e) {

        // e.preventDefault();
        var this_fvalidate=true;
        var thisForm=$(this);

        if(this_fvalidate){
                vbdDisableSubmit(thisForm);
                this_fvalidate=false;

                var data_preset_vbd_rp="vbd_method=self-reset&rp_id="+rpIdVBD+"&rp_code="+rpCodeVBD+"&rid="+rpRID;
                var data_vbd_rp=data_preset_vbd_rp+'&'+$(this).serialize();


                var url= VBUILDER_APP_ROOT+"/api/global/vbd_rp/";
                var content_vbd_rp="none-v";

                var xhr_vbd_rp= new XMLHttpRequest();
                xhr_vbd_rp.open('POST',url,true);
                xhr_vbd_rp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr_vbd_rp.onreadystatechange= function () {

                        if(xhr_vbd_rp.readyState===4){
                                vbdEnableSubmit(thisForm);
                                this_fvalidate=true;
                        } else{
                                vbdDisableSubmit(thisForm);
                                this_fvalidate=false;
                        }


                        if(xhr_vbd_rp.readyState===4 && xhr_vbd_rp.status===200){
                                content_vbd_rp=xhr_vbd_rp.responseText;
                                // alert(content_vbd_rp);
                                try {


                                        var json_vbd_rp=JSON.parse(content_vbd_rp);
//start of submission check
                                        if(json_vbd_rp['response']['state']===1){


                                                $('form[name=vbd_rp-vbd-self-reset-form]').trigger("reset");
                                                // $('#vbd_rp-modal-add').modal('hide');
                                                // vbToast('success','Verification code sent to your email');
                                                vbToast('success','Password updated');

                                                setTimeout(function () {
                                                        window.location.replace(VBD_LOGIN_URL+"/?account_reset=true");
                                                },3000);

                                        }
                                        else
                                        {
// checking for the errors
                                                if(json_vbd_rp['response']['state']===2){

                                                        vbToast('error','Invalid code');

                                                } else if(json_vbd_rp['response']['state']===3){

                                                        vbToast('warning','Code expired. Request again');

                                                }  else if(json_vbd_rp['response']['state']===1011){

                                                        vbToast('warning','Wrong password confirmation');

                                                } else if( json_vbd_rp['rq_fields']['missing']['count'] != undefined && json_vbd_rp['rq_fields']['missing']['count']!==0){
                                                        vbToast('warning','Please fill all required fields');
                                                } else if( json_vbd_rp['validate']['state'] != undefined && json_vbd_rp['validate']['state']===false){
                                                        vbToast('warning','Fill the fields correctly');
                                                } else if( json_vbd_rp['response']['result']['error'][1] != undefined && json_vbd_rp['response']['result']['error'][1]===1062){
                                                        vbToast('warning','Error. Duplicate entry');
                                                } else{
                                                        vbToast('warning','Error reseting password');
                                                }

                                        }
//end of submission check
                                } catch (e) {

                                        vbToast('error','An error have occured during the request.');
                                        console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
                                }
                        } else{

                                console.log("vbuilder-submition-process",'Loading vbd_rp-vbd-add-form');

                        }
                };
                xhr_vbd_rp.send(data_vbd_rp);



        } else{

                vbToast('warning','Please fill all required fields');

        }

        return false;

});