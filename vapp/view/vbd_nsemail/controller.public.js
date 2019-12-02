/*
* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/
* Author: Vayile Fumo
* Date: 27/10/2019, Sunday
* Time: 11:05 AM
* Project/Module: Newsletter Email*/

$('form[name=vbd_nsemail-vbd-add-public-form]').on('submit', function(e) {

//uncomment the prevent bellow case an error appear, for debug
//e.preventDefault();
        var this_fvalidate=true;

        var thisForm=$(this);

        if(this_fvalidate){


                var $emailN = $(this).find("input[name=nsemail_email]"); //change form to id or containment selector
                var re = /[A-Z0-9._%+-]+@[A-Z0-9.-]+.[A-Z]{2,4}/igm;
                if ($emailN.val() == '' || !re.test($emailN.val()))
                {

                        vbToast('warning','Please insert a valid email');

                }
                else
                {

                        vbdDisableSubmit(thisForm);
                        this_fvalidate=false;

                        var data_preset_vbd_nsemail="vbd_method=add-public";
                        var data_vbd_nsemail=data_preset_vbd_nsemail+'&'+$(this).serialize();


                        var url= VBUILDER_APP_ROOT+"/api/global/vbd_nsemail/";
                        var content_vbd_nsemail="none-v";

                        var xhr_vbd_nsemail= new XMLHttpRequest();
                        xhr_vbd_nsemail.open('POST',url,true);
                        xhr_vbd_nsemail.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhr_vbd_nsemail.onreadystatechange= function () {

                                if(xhr_vbd_nsemail.readyState===4){
                                        vbdEnableSubmit(thisForm);
                                        this_fvalidate=true;
                                } else{
                                        vbdDisableSubmit(thisForm);
                                        this_fvalidate=false;
                                }

                                if(xhr_vbd_nsemail.readyState===4 && xhr_vbd_nsemail.status===200){
                                        content_vbd_nsemail=xhr_vbd_nsemail.responseText;
                                        // alert(content_vbd_nsemail);
                                        try {



                                                var json_vbd_nsemail=JSON.parse(content_vbd_nsemail);
//start of submission check
                                                if(json_vbd_nsemail['response']['state']===1){

// load the list

                                                        $('form[name=vbd_nsemail-vbd-add-public-form]').trigger("reset");

                                                        vbToast('success','Email successfully added');
                                                }
                                                else
                                                {
// checking for the errors
                                                        if(json_vbd_nsemail['response']['state']===1920){

                                                                vbToast('warning','Please login');

                                                        } else if( json_vbd_nsemail['rq_fields']['missing']['count'] != undefined && json_vbd_nsemail['rq_fields']['missing']['count']!==0){
                                                                vbToast('warning','Please fill all required fields');
                                                        } else if( json_vbd_nsemail['validate']['state'] != undefined && json_vbd_nsemail['validate']['state']===false){
                                                                vbToast('warning','Fill the fields correctly');
                                                        } else if( json_vbd_nsemail['response']['result']['error'][1] != undefined && json_vbd_nsemail['response']['result']['error'][1]===1062){
                                                                vbToast('warning','The email already is in our list');
                                                        } else{
                                                                vbToast('warning','Error adding Newsletter Email');
                                                        }

                                                }
//end of submission check
                                        } catch (e) {

                                                vbToast('error','An error have occured during the request.');
                                                console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
                                        }
                                } else{

                                        console.log("vbuilder-vbd_nsemail-submition-process",'Loading vbd_nsemail-vbd-add-form');

                                }
                        };
                        xhr_vbd_nsemail.send(data_vbd_nsemail);



                }


        } else{

                vbToast('warning','Please fill all required fields');

        }

        return false;

});
