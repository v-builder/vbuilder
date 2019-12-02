
$(window).ready(function() {
// load the list
 load_vbd_data('vbd_user','read','.data-total-users');
 load_vbd_data('vbd_nsemail','read','.data-total-nsemail');

});





// var vbdUserLevelDataStorage={};

 function load_vbd_data(vbd_url,vbd_method,vbd_target)  {


    var data_vbd_user="vbd_method="+vbd_method+"&vbd_key="+vbdGetKey();


    var url= VBUILDER_APP_ROOT+"/api/global/"+vbd_url+"/";
    var content_vbd_user="none-v";

    var tmpRows=0;

    var xhr_vbd_user= new XMLHttpRequest();
    xhr_vbd_user.open('POST',url,true);
    xhr_vbd_user.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr_vbd_user.onreadystatechange=  function () {

        if(xhr_vbd_user.readyState===4 && xhr_vbd_user.status===200){

            content_vbd_user=xhr_vbd_user.responseText;

            try {

                var json_vbd_user=JSON.parse(content_vbd_user);

                var vbdLevelAdd;

                if(json_vbd_user['response']['state']===1){
                    // $('#vbd_user-vbd-add-form').trigger("reset");
                    // $('#vbd_user-modal-add').modal('hide');
//vbToast('success','Records successfully loaded!');

                    // $("#vbd_user-table-list tbody").html("");

                    tmpRows=json_vbd_user['response']['result']['rows'];



                }
                else
                {

// checking for the errors
                    if(json_vbd_user['response']['state']===1920){

                        vbToast('warning','Please login. Error loading data');

                    }  else if( json_vbd_user['rq_fields']['missing']['count'] != undefined && json_vbd_user['rq_fields']['missing']['count']!==0){
                        vbToast('warning','Error loading data. Missing');
                    } else if( json_vbd_user['validate']['state'] != undefined && json_vbd_user['validate']['state']===false){
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

            console.log("vbuilder-submition-process",'Loading vbd_user list data');

        }

        $(''+vbd_target).text(tmpRows);

    };
    xhr_vbd_user.send(data_vbd_user);



}