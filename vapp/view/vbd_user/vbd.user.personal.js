
// USER -pdata


function getUserPdata() {


    var data_vbd_at="vbd_method=read&vbd_key="+vbdGetKey();


    var url= VBUILDER_APP_ROOT+"/api/global/vbd_at/";
    var content_vbd_at="none-v";

    var xhr_vbd_at= new XMLHttpRequest();
    xhr_vbd_at.open('POST',url,true);
    xhr_vbd_at.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr_vbd_at.onreadystatechange= function () {

        if(xhr_vbd_at.readyState===4 && xhr_vbd_at.status===200){

            content_vbd_at=xhr_vbd_at.responseText;

            try {

                var json_vbd_at=JSON.parse(content_vbd_at);

//start of submission check
                if(json_vbd_at['response']['state']===1){

//vbToast('success','Records successfully loaded!');

                    $("select#vbd_at_id").html("");
var appendVarT="";

                    if(json_vbd_at['response']['result']['rows']>0){

                        for ( var ix = 0; ix < json_vbd_at['response']['result']['data-json'].length; ix++) {

                            var jsonVOB= JSON.parse(json_vbd_at['response']['result']['data-json'][ix]);

                            $("select#vbd_at_id").append('<option value="'+jsonVOB['vbd_at_id']+'"'+appendVarT+'>'+jsonVOB['vbd_at_type']+'</option>');


                        }

                    }
                }
                else
                {
// checking for the errors
                    if(json_vbd_at['response']['state']===1920){

                        vbToast('warning','Please login. Error loading data');

                    } else if( json_vbd_at['rq_fields']['missing']['count'] != undefined && json_vbd_at['rq_fields']['missing']['count']!==0){
                        vbToast('warning','Error loading data. Missing');
                    } else if( json_vbd_at['validate']['state'] != undefined && json_vbd_at['validate']['state']===false){
                        vbToast('warning','Error loading data. Missing');
                    }  else{
                        vbToast('warning','Error loading data');
                    }

                }
//end of submission check
            } catch (e) {

                vbToast('error','Error loading data. Bug');
                console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
            }
        } else{

            console.log("vbuilder-submition-process",'Loading vbd_at list data');

        }
    };
    xhr_vbd_at.send(data_vbd_at);



}


function getPhoneData() {


    var data_vbd_at="vbd_method=read&vbd_key="+vbdGetKey();


    var url= VBUILDER_APP_ROOT+"/countries.json";
    var content_vbd_at="none-v";
    var tempVar="";
    var xhr_vbd_at= new XMLHttpRequest();
    xhr_vbd_at.open('POST',url,true);
    xhr_vbd_at.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr_vbd_at.onreadystatechange= function () {

        if(xhr_vbd_at.readyState===4 && xhr_vbd_at.status===200){

            content_vbd_at=xhr_vbd_at.responseText;

            try {

                var json_vbd_at=JSON.parse(content_vbd_at);


//vbToast('success','Records successfully loaded!');

                    $("select#phone_code").html("");

                    if(json_vbd_at.length>0){

                        for ( var ix = 0; ix < json_vbd_at.length; ix++) {

                            tempVar="";
                            if(json_vbd_at[ix]['callingCodes'][0]==='258'){
                                // tempVar='selected';
                            }
                            if(json_vbd_at[ix]['flag'][0].length>0){

                                $("select#phone_code").append('<option value="'+json_vbd_at[ix]['callingCodes'][0]+'" '+tempVar+'>' +
                                    '' +json_vbd_at[ix]['name']+'<img alt="flag" class="flag-img" src="'+json_vbd_at[ix]['flag'][0]+'"/></option>');

                            }

                        }

                        VBD_LOADED_COUNTRY_CODES=true;
                    }


//end of submission check
            } catch (e) {

                // vbToast('error','Error loading data. Bug');
                console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
            }
        } else{

            // console.log("vbuilder-submition-process",'Loading vbd_at list data');

        }
    };
    xhr_vbd_at.send(data_vbd_at);



}



$(document).on("change","select#phone_code",function(){
    $("#phone_code_h").text("+"+$(this).val());
});
