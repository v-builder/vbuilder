/*
start of upload --------------------- ------------------------ --------------- -------------------------*/
var lastAskdeleteVbdUploadHelperElement;
function vbdLoadUploadExecuteHelper(thisvbd,vbdUpdList, vbUpdTarget, vbdUpdInt){

    try {
        vbUpdTarget.html("");
        var tmpStr='';
        var json_vbd_user = JSON.parse(thisvbd);

        // var jsonTemp= JSON.parse(json_vbd_user['response']['result']['data-json']);
        var jsonTemp= json_vbd_user['response']['result']['data-json'];
        // alert(thisvbd);
//start of submission check
        if (json_vbd_user['response']['state'] === 1 && json_vbd_user['response']['result']['rows'] > 0) {
            // show files to vbUpdTarget
            var chkNotDelTmp=true;
            for ( var ix = 0; ix < jsonTemp.length; ix++) {


                var jsonVOB= JSON.parse(jsonTemp[ix]);

                if(jsonVOB['deleted']!='false'){
                    continue;
                }
                chkNotDelTmp=false;
                tmpStr='<div class="upd-file col-12 col-md-6" data-upd="'+jsonVOB['file_type']+'"> ' +
                    '<a href="javascript:;" data-item-id="'+jsonVOB['upload_id']+'" class="vbd-action-link vbd-askdelete-vbd_upload_helper">x' +
                    '</a> '+
                    '<a href="'+VBUILDER_APP_ROOT+'/'+jsonVOB['file_path']+'" target="_blank" >' +
                    '<div  class="upd-header">' +
                    ' <span>' +
                    jsonVOB['file_name']+
                    '</span>' +
                    '</div> </a>' +
                    '<div class="upd-body">' +
                    '<span>'+jsonVOB['file_type']+'</span> | ' + '<span>'+vbdHumanFileSize(jsonVOB['file_size'],true)+'</span> ' +
                    '</div> ' +
                    '</div>' ;

                vbUpdTarget.append(tmpStr);

                // alert(vbdUserLevelData['ulevel_id']);
            }
            if(chkNotDelTmp){
                vbUpdTarget.append("<div class='col-12'> " +
                    "<p class='alert-warning'> None file found" +
                    "</p>" +
                    "</div>");
            }

        } else {

            vbUpdTarget.append("<div class='col-12'> " +
                "<p class='alert-warning'> None file found" +
                "</p>" +
                "</div>");

        }


    } catch (e) {

    }
}



function vbdLoadUploadHelper(vbdUpdList, vbUpdTarget, vbdUpdInt) {

    /*
    $.when(vbdIsKeySet()).done(function( this_fvalidate ) {

         if(this_fvalidate){
         */

    // start it ---------
    var data_vbd_user="upg_id="+vbdUpdList+"&vbd_method=read-upg&vbd_key="+vbdGetKey();


    var xhrVBD= new XMLHttpRequest();
    xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_upload/",true);
    xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    xhrVBD.onreadystatechange= function () {
        if(xhrVBD.readyState===4 && xhrVBD.status===200){
            // alert(xhrVBD.responseText);
            vbdLoadUploadExecuteHelper(xhrVBD.responseText,vbdUpdList, vbUpdTarget, vbdUpdInt);
        }
        if(xhrVBD.readyState<4){

        }
    };

    xhrVBD.send(data_vbd_user);
    // end it ---------

    /*
    }
     else{
         // vbToast('warning','You didn\'t log in');
         }
 });
 */
}


/*

* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/

* Author: Vayile Fumo

* Date: 21/10/2019, Monday

* Time: 10:41 PM

* Project/Module: VB Upload Item
*/


var item_id_delete_vbd_upload=null;

$(document).on('click', ".vbd-action-link.vbd-askdelete-vbd_upload_helper", function (e) {

    e.preventDefault();
    // set as lest trigger to delete upload
    lastAskdeleteVbdUploadHelperElement=$(this).parent();

    item_id_delete_vbd_upload=null;
    var data_vbd_upload="vbd_method=readcontrol&vbd_key="+vbdGetKey()+"&upload_id="+$(this).data('item-id');


    var xhrVBD= new XMLHttpRequest();
    xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_upload/",true);
    xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    xhrVBD.onreadystatechange= function () {
        if(xhrVBD.readyState===4 && xhrVBD.status===200){

            // alert(xhrVBD.responseText);
            delete_load_vbd_uploadHelper( xhrVBD.responseText)

        }
        if(xhrVBD.readyState<4){

        }
    };

    xhrVBD.send(data_vbd_upload);

});




// Open modal if data exist
function delete_load_vbd_uploadHelper( thisvbd ){

    try {


        var json_vbd_upload=JSON.parse(thisvbd);
//start of submission check
        if(json_vbd_upload['response']['state']===1 && json_vbd_upload['response']['result']['rows']>0){

            $('.vbuilder-delete-vbd_upload-holder-helper').text("");
            // $('.modal.show').modal('hide');
            $('#vbd_upload-modal-delete-helper').modal('show');
            //     $('#vbd_upload-modal-delete{
            // zIndex=1050;
            // }

//vbToast('success','Vb Upload Item successfully loaded!');

            var jsonVOB= JSON.parse(json_vbd_upload['response']['result']['data-json'][0]);

            // $('.vbuilder-delete-vbd_upload-holder-helper').text( jsonVOB['upload_id'] );

            $('.vbuilder-delete-vbd_upload-holder-helper').text( jsonVOB['file_name'] );
            item_id_delete_vbd_upload=jsonVOB['upload_id'];

        }
        else
        {
// checking for the errors
            if(json_vbd_upload['response']['state']===1920){

                vbToast('warning','Please login');

            } else if( json_vbd_upload['rq_fields']['missing']['count'] != undefined && json_vbd_upload['rq_fields']['missing']['count']!==0){
                vbToast('warning','Missing request data');
            } else if( json_vbd_upload['validate']['state'] != undefined && json_vbd_upload['validate']['state']===false){
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


// confirm item deletion

$(document).on('click', ".vbd-action-link.vbd-delete-vbd_upload_helper", function (e) {
    e.preventDefault();



    var data_vbd_upload="vbd_method=delete&vbd_key="+vbdGetKey()+"&upload_id="+item_id_delete_vbd_upload;


    var xhrVBD= new XMLHttpRequest();
    xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_upload/",true);
    xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    xhrVBD.onreadystatechange= function () {
        if(xhrVBD.readyState===4 && xhrVBD.status===200){

            delete_execute_vbd_uploadHelper( xhrVBD.responseText)

        }
        if(xhrVBD.readyState<4){

        }
    };

    xhrVBD.send(data_vbd_upload);

});


function delete_execute_vbd_uploadHelper( thisvbd){

    try {



        var json_vbd_upload=JSON.parse(thisvbd);

//start of submission check
        if(json_vbd_upload['response']['state']===1){

            item_id_update_vbd_upload=null;

            if( json_vbd_upload['response']['result']['affected'] != undefined && json_vbd_upload['response']['result']['affected']>0){
                vbToast('success','Deleted');
// load the list
//                 reload_vbd_upload_helper();

                lastAskdeleteVbdUploadHelperElement.addClass('d-none');
                lastAskdeleteVbdUploadHelperElement.hide();
            } else {
                vbToast('success','None change applied');
            }


        }
        else
        {
// checking for the errors
            if(json_vbd_upload['response']['state']===1920){

                vbToast('warning','Please login');

            } else if( json_vbd_upload['rq_fields']['missing']['count'] != undefined && json_vbd_upload['rq_fields']['missing']['count']!==0){
                vbToast('warning','Missing request data');
            } else if( json_vbd_upload['validate']['state'] != undefined && json_vbd_upload['validate']['state']===false){
                vbToast('warning','Wrong request data');
            }else{
                vbToast('warning','Error deleting Vb Upload Item');
            }

        }
//end of submission check


    } catch (e) {

        vbToast('error','An error have occured during the request.');
        console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
    }

}



/*
end of upload -------------------------------------------------------------------------------------*/