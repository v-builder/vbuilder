var vbdStepsConf=[];
vbdStepsConf[0]=null;
vbdStepsConf[1]=null;
vbdStepsConf[2]=null;
vbdStepsConf[3]=null;

$(window).ready(function() {
// load the list
    vbd_get_email_confirmation();
});


function vbd_get_email_confirmation() {

    var urlVBD = new URL(document.URL);
    var query_stringVBD = urlVBD.search;

    var search_paramsVBD = new URLSearchParams(query_stringVBD);


    if(search_paramsVBD.get('stepA')){
        vbdStepsConf[0]=search_paramsVBD.get('stepA');
    }

    if(search_paramsVBD.get('stepB')){
        vbdStepsConf[1]=search_paramsVBD.get('stepB');
    }

    if(search_paramsVBD.get('stepC')){
        vbdStepsConf[2]=search_paramsVBD.get('stepC');
    }

    if(search_paramsVBD.get('stepD')){
        vbdStepsConf[3]=search_paramsVBD.get('stepD');
    }

    vbd_send_email_confirmation();


}

function vbd_send_email_confirmation() {

    var data_vbd_user="vbd_method=self-email-conf-run&stepA="+vbdStepsConf[0]+"&stepB="+vbdStepsConf[1]+"&stepC="+vbdStepsConf[2]+"&stepD="+vbdStepsConf[3];


    var url= VBUILDER_APP_ROOT+"/api/global/vbd_user/";
    var content_vbd_user="none-v";

    var xhr_vbd_user= new XMLHttpRequest();
    xhr_vbd_user.open('POST',url,true);
    xhr_vbd_user.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr_vbd_user.onreadystatechange= function () {
        if(xhr_vbd_user.readyState===4 && xhr_vbd_user.status===200){
            content_vbd_user=xhr_vbd_user.responseText;

            // alert(content_vbd_user);
            try {


                var json_vbd_user=JSON.parse(content_vbd_user);
//start of submission check
                if(json_vbd_user['response']['state']===1){
                    $(".vbd-confirm-user-email").fadeOut();

                    // redirect to login page
                    /*setTimeout(function () {
                        window.location.replace(VBD_LOGIN_URL);
                    },15000);*/

                    vbToast('success','Email confirmed');


                    $('#vbd-user-self-email-conf .alert').addClass('alert-success');
                    $('#vbd-user-self-email-conf .alert p').text("Email confirmed");
                    $('#vbd-user-self-email-conf .vbd-submition-loader').fadeOut();

                }
                else
                {
// checking for the errors
                    if(json_vbd_user['response']['state']===1920){

                        vbToast('warning','You don\'t have permission to execute this task');

                    } else  if(json_vbd_user['response']['state']===11){

                        $(".vbd-confirm-user-email").fadeOut();

                        setTimeout(function () {
                            window.location.replace(VBD_LOGIN_URL);
                        },15000);

                        vbToast('warning','Email already confirmed');

                        $('#vbd-user-self-email-conf .alert').addClass('alert-warning');
                        $('#vbd-user-self-email-conf .alert p').text("Email already confirmed");
                        $('#vbd-user-self-email-conf .vbd-submition-loader').fadeOut();

                    }   else{
                        vbToast('warning','Error while confirming email ');
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

}