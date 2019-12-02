
$(window).ready(function() {
// load the list
    reload_update_self_pdata();
});

function reload_update_self_pdata(){



    var data_vbd_user_pdata="vbd_method=self-readcontrol&vbd_key="+vbdGetKey();


    var xhrVBD= new XMLHttpRequest();
    xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_user_pdata/",true);
    xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    xhrVBD.onreadystatechange= function () {
        if(xhrVBD.readyState===4 && xhrVBD.status===200){

            update_load_vbd_user_pdata( xhrVBD.responseText)

        }
        if(xhrVBD.readyState<4){

        }
    };

    xhrVBD.send(data_vbd_user_pdata);

    }



function update_load_vbd_user_pdata( thisvbd ){
// alert(thisvbd);
    try {


        var json_vbd_user_pdata=JSON.parse(thisvbd);
//start of submission check
        if(json_vbd_user_pdata['response']['state']===1){

            $('form[name=vbd_user_pdata-vbd-update-form]').trigger("reset");

            //vbToast('success','Personal Data successfully loaded!');
            var tempVar="";
            var jsonVOB= JSON.parse(json_vbd_user_pdata['response']['result']['data-json'][0]);
            item_id_update_vbd_user_pdata=jsonVOB['usp_id'];




            // vbd_at_id
            tempVar='form[name=vbd_user_pdata-vbd-update-form] select[name=vbd_at_id] option[value='+jsonVOB['vbd_at_id']+']';

            if($(tempVar)[0]){
                $(tempVar+"").attr('selected','selected');
            }


            $('form[name=vbd_user_pdata-vbd-update-form] input[name=usp_label_value]').val( jsonVOB['usp_label_value'] );
            $('form[name=vbd_user_pdata-vbd-update-form] input[name=usp_type_value]').val( jsonVOB['usp_type_value'] );

            $('form[name=vbd_user_pdata-vbd-update-form] input[name=phone_number]').val( jsonVOB['phone_number'] );
            $('form[name=vbd_user_pdata-vbd-update-form] input[name=user_bdate]').val( jsonVOB['user_bdate'] );
            $('form[name=vbd_user_pdata-vbd-update-form] input[name=phone_number_alt]').val( jsonVOB['phone_number_alt'] );



            // phone_code
            var tempoVar="";


         var tempInterval= setInterval(function (e) {

              if(VBD_LOADED_COUNTRY_CODES){

                  tempVar='form[name=vbd_user_pdata-vbd-update-form] select[name=phone_code] option[value='+jsonVOB['phone_code']+']';
                  if($(tempVar)[0]){
                      $(tempVar+"").attr('selected','selected');
                  }
                  $("#phone_code_h").text("+"+jsonVOB['phone_code']);
                 clearInterval(tempInterval);

              }
          },2000);
          /*      $.each($('form[name=vbd_user_pdata-vbd-update-form] select[name=phone_code] option'), function (index, obj) {

                     tempoVar= $(this).attr('value');
                     console.log(tempoVar);



            });*/


            // phone shown
            tempVar='form[name=vbd_user_pdata-vbd-update-form] select[name=phone_shown] option[value='+jsonVOB['phone_shown']+']';

            if($(tempVar)[0]){
                $(tempVar+"").attr('selected','selected');
            }


            // gender
            tempVar='form[name=vbd_user_pdata-vbd-update-form] select[name=gender] option[value='+jsonVOB['gender']+']';

            if($(tempVar)[0]){
                $(tempVar+"").attr('selected','selected');
            }


            $('form[name=vbd_user_pdata-vbd-update-form] textarea[name=about]').val( jsonVOB['about'] );
            $('form[name=vbd_user_pdata-vbd-update-form] textarea[name=bio]').val( jsonVOB['bio'] );


        }
        else
        {
// checking for the errors
            if(json_vbd_user_pdata['response']['state']===1920){

                vbToast('warning','Please login');

            } else if( json_vbd_user_pdata['rq_fields']['missing']['count'] != undefined && json_vbd_user_pdata['rq_fields']['missing']['count']!==0){
                vbToast('warning','Missing request data');
            } else if( json_vbd_user_pdata['validate']['state'] != undefined && json_vbd_user_pdata['validate']['state']===false){
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



$('form[name=vbd_user_pdata-vbd-update-form]').on('submit', function(e) {

//uncomment the prevent bellow case an error appear, for debug
//e.preventDefault();
    var this_fvalidate=true;

    var thisForm=$(this);

    if(this_fvalidate){
        vbdDisableSubmit(thisForm);
        this_fvalidate=false;

        var data_preset_vbd_user_pdata="vbd_method=self-update&vbd_key="+vbdGetKey();
        var data_vbd_user_pdata=data_preset_vbd_user_pdata+'&'+$(this).serialize();


        var url= VBUILDER_APP_ROOT+"/api/global/vbd_user_pdata/";
        var content_vbd_user_pdata="none-v";

        var xhr_vbd_user_pdata= new XMLHttpRequest();
        xhr_vbd_user_pdata.open('POST',url,true);
        xhr_vbd_user_pdata.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr_vbd_user_pdata.onreadystatechange= function () {


            if(xhr_vbd_user_pdata.readyState===4){
                vbdEnableSubmit(thisForm);
                this_fvalidate=true;
            } else{
                vbdDisableSubmit(thisForm);
                this_fvalidate=false;
            }


            if(xhr_vbd_user_pdata.readyState===4 && xhr_vbd_user_pdata.status===200){
                content_vbd_user_pdata=xhr_vbd_user_pdata.responseText;

                // alert(content_vbd_user_pdata);

                try {


                    var json_vbd_user_pdata=JSON.parse(content_vbd_user_pdata);
//start of submission check
                    if(json_vbd_user_pdata['response']['state']===1){


                        // $('form[name=vbd_user_pdata-vbd-update-form]').trigger("reset");
                        $('#vbd_user_pdata-modal-update').modal('hide');

                        if( json_vbd_user_pdata['response']['result']['affected'] != undefined && json_vbd_user_pdata['response']['result']['affected']>0){
                            vbToast('success','Personal Data updated');
// load the list
//                             reload_vbd_user_pdata();

                        } else {
                            vbToast('success','None change applied');
                        }

                    }
                    else
                    {
// checking for the errors
                        if(json_vbd_user_pdata['response']['state']===1920){

                            vbToast('warning','Please login');

                        } else if( json_vbd_user_pdata['rq_fields']['missing']['count'] != undefined && json_vbd_user_pdata['rq_fields']['missing']['count']!==0){
                            vbToast('warning','Please fill all required fields');
                        } else if( json_vbd_user_pdata['validate']['state'] != undefined && json_vbd_user_pdata['validate']['state']===false){
                            vbToast('warning','Fill the fields correctly');
                        } else if( json_vbd_user_pdata['response']['result']['error'][1] != undefined && json_vbd_user_pdata['response']['result']['error'][1]===1062){
                            vbToast('warning','Error. Duplicate entry');
                        } else{
                            vbToast('warning','Error updating Personal Data');
                        }

                    }
//end of submission check

                } catch (e) {

                    vbToast('error','An error have occured during the request.');
                    console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
                }
            } else{

                console.log("vbuilder-vbd_user_pdata-submition-process",'Loading vbd_user_pdata-vbd-update-form');

            }
        };
        xhr_vbd_user_pdata.send(data_vbd_user_pdata);



    } else{
        // alert(content_vbd_user_pdata);
        vbToast('warning','Please fill all required fields');

    }
    return false;

});
