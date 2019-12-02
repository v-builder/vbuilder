/*<br/>
* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/ <br/>
* Author: Vayile Fumo<br/>
* Date: 28/08/2019, Wednesday<br/>
* Time: 01:15 PM<br/>
*/

$(window).ready(function() {
// load the list
    reload_vbd_user_level();
});

function reload_vbd_user_level() {


    var data_vbd_user_level="vbd_method=read&vbd_key="+vbdGetKey();


    var url= VBUILDER_APP_ROOT+"/api/global/vbd_user_level/";
    var content_vbd_user_level="none-v";

    var xhr_vbd_user_level= new XMLHttpRequest();
    xhr_vbd_user_level.open('POST',url,true);
    xhr_vbd_user_level.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr_vbd_user_level.onreadystatechange= function () {

        if(xhr_vbd_user_level.readyState===4 && xhr_vbd_user_level.status===200){

            content_vbd_user_level=xhr_vbd_user_level.responseText;

            try {

                var json_vbd_user_level=JSON.parse(content_vbd_user_level);

//start of submission check
                if(json_vbd_user_level['response']['state']===1){
                    $('#vbd_user_level-vbd-add-form').trigger("reset");
                    $('#vbd_user_level-modal-add').modal('hide');
//vbToast('success','Records successfully loaded!');

                    $("#vbd_user_level-table-list tbody").html("");

                    if(json_vbd_user_level['response']['result']['rows']>0){

                        for ( var ix = 0; ix < json_vbd_user_level['response']['result']['data-json'].length; ix++) {

                            var jsonVOB= JSON.parse(json_vbd_user_level['response']['result']['data-json'][ix]);

                            $("#vbd_user_level-table-list tbody").append('<tr>'+ '<td>'+ jsonVOB['ulevel_id'] +'  </td>' + '<td>'+ jsonVOB['ulevel_name'] +'  </td>' + '<td>'+ jsonVOB['ulevel_desc'] +'  </td>' +  '<td class="vbd-actions-td">'+
                                '<a href="javascript:;"  data-item-id'+'="'+jsonVOB['ulevel_id']+'" class="vbd-action-link vbd-update-vbd_user_level" > <span class="fa fa-edit"></span> </a>'+
                                '<a href="javascript:;" data-item-id'+'="'+jsonVOB['ulevel_id']+'" class="vbd-action-link vbd-view-vbd_user_level ml-1" > <span class="fa fa-info-circle"></span> </a>'+
                                '<a href="javascript:;"  data-item-id'+'="'+jsonVOB['ulevel_id']+'" class="vbd-action-link vbd-askdelete-vbd_user_level ml-1" >'+
                                ' <span class="fa fa-trash"></span>'+
                                '</a> </td> </tr>');
                        }

                    }


                }
                else
                {
// checking for the errors
                    if(json_vbd_user_level['response']['state']===1920){

                        vbToast('warning','Please login. Error loading data');

                    } else if( json_vbd_user_level['rq_fields']['missing']['count'] != undefined && json_vbd_user_level['rq_fields']['missing']['count']!==0){
                        vbToast('warning','Error loading data. Missing');
                    } else if( json_vbd_user_level['validate']['state'] != undefined && json_vbd_user_level['validate']['state']===false){
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

            console.log("vbuilder-submition-process",'Loading vbd_user_level list data');

        }
    };
    xhr_vbd_user_level.send(data_vbd_user_level);



}






/*

* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/

* Author: Vayile Fumo

* Date: 28/08/2019, Wednesday

* Time: 01:15 PM

*/

$('form[name=vbd_user_level-vbd-add-form]').on('submit', function(e) {

    e.preventDefault();
    var this_fvalidate=true;
    var thisForm=$(this);

    if(this_fvalidate){
        vbdDisableSubmit(thisForm);
        this_fvalidate=false;

        var data_preset_vbd_user_level="vbd_method=add&vbd_key="+vbdGetKey();
        var data_vbd_user_level=data_preset_vbd_user_level+'&'+$(this).serialize();


        var url= VBUILDER_APP_ROOT+"/api/global/vbd_user_level/";
        var content_vbd_user_level="none-v";

        var xhr_vbd_user_level= new XMLHttpRequest();
        xhr_vbd_user_level.open('POST',url,true);
        xhr_vbd_user_level.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr_vbd_user_level.onreadystatechange= function () {

            if(xhr_vbd_user_level.readyState===4){
                vbdEnableSubmit(thisForm);
                this_fvalidate=true;
            } else{
                vbdDisableSubmit(thisForm);
                this_fvalidate=false;
            }
            
            if(xhr_vbd_user_level.readyState===4 && xhr_vbd_user_level.status===200){
                content_vbd_user_level=xhr_vbd_user_level.responseText;
                try {


                    var json_vbd_user_level=JSON.parse(content_vbd_user_level);
//start of submission check
                    if(json_vbd_user_level['response']['state']===1){

// load the list
                        reload_vbd_user_level();

                        $('form[name=vbd_user_level-vbd-add-form]').trigger("reset");
                        $('#vbd_user_level-modal-add').modal('hide');
                        vbToast('success','Record Successfully Added!');
                    }
                    else
                    {
// checking for the errors
                        if(json_vbd_user_level['response']['state']===1920){

                            vbToast('warning','Please login');

                        } else if( json_vbd_user_level['rq_fields']['missing']['count'] != undefined && json_vbd_user_level['rq_fields']['missing']['count']!==0){
                            vbToast('warning','Please fill all required fields');
                        } else if( json_vbd_user_level['validate']['state'] != undefined && json_vbd_user_level['validate']['state']===false){
                            vbToast('warning','Fill the fields correctly');
                        } else if( json_vbd_user_level['response']['result']['error'][1] != undefined && json_vbd_user_level['response']['result']['error'][1]===1062){
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
            } else{

                console.log("vbuilder-submition-process",'Loading vbd_user_level-vbd-add-form');

            }
        };
        xhr_vbd_user_level.send(data_vbd_user_level);



    } else{

        vbToast('warning','Please fill all required fields');

    }

});



/*

* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/

* Author: Vayile Fumo

* Date: 28/08/2019, Wednesday

* Time: 01:15 PM

*/

var item_id_update_vbd_user_level=null;

$(document).on('click', ".vbd-update-vbd_user_level", function (e) {

    e.preventDefault();

    item_id_update_vbd_user_level=null;
    $('#vbd_user_level-vbd-update-form').trigger("reset");




    var data_vbd_user_level="vbd_method=readcontrol&vbd_key="+vbdGetKey()+"&ulevel_id="+$(this).data('item-id');


    var xhrVBD= new XMLHttpRequest();
    xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_user_level/",true);
    xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    xhrVBD.onreadystatechange= function () {
        if(xhrVBD.readyState===4 && xhrVBD.status===200){

            update_load_vbd_user_level( xhrVBD.responseText)

        }
        if(xhrVBD.readyState<4){

        }
    };

    xhrVBD.send(data_vbd_user_level);

});



function update_load_vbd_user_level( thisvbd){

    try {


        var json_vbd_user_level=JSON.parse(thisvbd);
//start of submission check
        if(json_vbd_user_level['response']['state']===1){

            $('#vbd_user_level-vbd-update-form').trigger("reset");
            $('#vbd_user_level-modal-update').modal('hide');
//vbToast('success','Record Successfully loaded!');

            var jsonVOB= JSON.parse(json_vbd_user_level['response']['result']['data-json'][0]);
            item_id_update_vbd_user_level=jsonVOB['ulevel_id'];

            $('#vbd_user_level-vbd-update-form input#ulevel_name').val( jsonVOB['ulevel_name'] );
            $('#vbd_user_level-vbd-update-form input#ulevel_desc').val( jsonVOB['ulevel_desc'] );

            $('#vbd_user_level-modal-update').modal('show');

        }
        else
        {
// checking for the errors
            if(json_vbd_user_level['response']['state']===1920){

                vbToast('warning','Please login');

            } else if( json_vbd_user_level['rq_fields']['missing']['count'] != undefined && json_vbd_user_level['rq_fields']['missing']['count']!==0){
                vbToast('warning','Missing request data');
            } else if( json_vbd_user_level['validate']['state'] != undefined && json_vbd_user_level['validate']['state']===false){
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



$('form[name=vbd_user_level-vbd-update-form]').on('submit', function(e) {

    e.preventDefault();
    var this_fvalidate=true;
    var thisForm=$(this);

    if(this_fvalidate){
        vbdDisableSubmit(thisForm);
        this_fvalidate=false;

        var data_preset_vbd_user_level="vbd_method=update&vbd_key="+vbdGetKey()+"&ulevel_id="+item_id_update_vbd_user_level;
        var data_vbd_user_level=data_preset_vbd_user_level+'&'+$(this).serialize();


        var url= VBUILDER_APP_ROOT+"/api/global/vbd_user_level/";
        var content_vbd_user_level="none-v";

        var xhr_vbd_user_level= new XMLHttpRequest();
        xhr_vbd_user_level.open('POST',url,true);
        xhr_vbd_user_level.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr_vbd_user_level.onreadystatechange= function () {

            if(xhr_vbd_user_level.readyState===4){
                vbdEnableSubmit(thisForm);
                this_fvalidate=true;
            } else{
                vbdDisableSubmit(thisForm);
                this_fvalidate=false;
            }

            if(xhr_vbd_user_level.readyState===4 && xhr_vbd_user_level.status===200){
                content_vbd_user_level=xhr_vbd_user_level.responseText;
                try {


                    var json_vbd_user_level=JSON.parse(content_vbd_user_level);
//start of submission check
                    if(json_vbd_user_level['response']['state']===1){
                        item_id_update_vbd_user_level=null;

                        $('form[name=vbd_user_level-vbd-update-form]').trigger("reset");
                        $('#vbd_user_level-modal-update').modal('hide');

                        if( json_vbd_user_level['response']['result']['affected'] != undefined && json_vbd_user_level['response']['result']['affected']>0){
                            vbToast('success','Record updated!');
// load the list
                            reload_vbd_user_level();

                        } else {
                            vbToast('success','None change applied');
                        }

                    }
                    else
                    {
// checking for the errors
                        if(json_vbd_user_level['response']['state']===1920){

                            vbToast('warning','Please login');

                        } else if( json_vbd_user_level['rq_fields']['missing']['count'] != undefined && json_vbd_user_level['rq_fields']['missing']['count']!==0){
                            vbToast('warning','Please fill all required fields');
                        } else if( json_vbd_user_level['validate']['state'] != undefined && json_vbd_user_level['validate']['state']===false){
                            vbToast('warning','Fill the fields correctly');
                        } else if( json_vbd_user_level['response']['result']['error'][1] != undefined && json_vbd_user_level['response']['result']['error'][1]===1062){
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

                console.log("vbuilder-submition-process",'Loading vbd_user_level-vbd-update-form');

            }
        };
        xhr_vbd_user_level.send(data_vbd_user_level);



    } else{

        vbToast('warning','Please fill all required fields');

    }

});



/*<br/>
* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/ <br/>
* Author: Vayile Fumo<br/>
* Date: 28/08/2019, Wednesday<br/>
* Time: 01:15 PM<br/>
*/


$(document).on('click', ".vbd-view-vbd_user_level", function (e) {

    e.preventDefault();

    var data_vbd_user_level="vbd_method=readcontrol&vbd_key="+vbdGetKey()+"&ulevel_id="+$(this).data('item-id');


    var xhrVBD= new XMLHttpRequest();
    xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_user_level/",true);
    xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    xhrVBD.onreadystatechange= function () {
        if(xhrVBD.readyState===4 && xhrVBD.status===200){

            view_load_vbd_user_level( xhrVBD.responseText)

        }
        if(xhrVBD.readyState<4){

        }
    };

    xhrVBD.send(data_vbd_user_level);

});



function view_load_vbd_user_level( thisvbd){

    try {


        var json_vbd_user_level=JSON.parse(thisvbd);
//start of submission check
        if(json_vbd_user_level['response']['state']===1 && json_vbd_user_level['response']['result']['rows']>0){

            $('#vbd_user_level-item-view .vbd_user_level-holder').text("");
            $('#vbd_user_level-modal-view').modal('show');

//vbToast('success','Record Successfully loaded!');

            var jsonVOB= JSON.parse(json_vbd_user_level['response']['result']['data-json'][0]);

            $('#vbd_user_level-item-view .ulevel_name.vbd_user_level-holder').text( jsonVOB['ulevel_name'] );
            $('#vbd_user_level-item-view .ulevel_desc.vbd_user_level-holder').text( jsonVOB['ulevel_desc'] );

            $('#vbd_user_level-modal-view').modal('show');

        }
        else
        {
// checking for the errors
            if(json_vbd_user_level['response']['state']===1920){

                vbToast('warning','Please login');

            } else if( json_vbd_user_level['rq_fields']['missing']['count'] != undefined && json_vbd_user_level['rq_fields']['missing']['count']!==0){
                vbToast('warning','Missing request data');
            } else if( json_vbd_user_level['validate']['state'] != undefined && json_vbd_user_level['validate']['state']===false){
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




/*

* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/

* Author: Vayile Fumo

* Date: 28/08/2019, Wednesday

* Time: 01:15 PM

*/


var item_id_delete_vbd_user_level=null;

$(document).on('click', ".vbd-action-link.vbd-askdelete-vbd_user_level", function (e) {

    e.preventDefault();
    item_id_delete_vbd_user_level=null;
    var data_vbd_user_level="vbd_method=readcontrol&vbd_key="+vbdGetKey()+"&ulevel_id="+$(this).data('item-id');


    var xhrVBD= new XMLHttpRequest();
    xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_user_level/",true);
    xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    xhrVBD.onreadystatechange= function () {
        if(xhrVBD.readyState===4 && xhrVBD.status===200){

            delete_load_vbd_user_level( xhrVBD.responseText)

        }
        if(xhrVBD.readyState<4){

        }
    };

    xhrVBD.send(data_vbd_user_level);

});




// Open modal if data exist
function delete_load_vbd_user_level( thisvbd ){

    try {


        var json_vbd_user_level=JSON.parse(thisvbd);
//start of submission check
        if(json_vbd_user_level['response']['state']===1 && json_vbd_user_level['response']['result']['rows']>0){

            $('.vbuilder-delete-vbd_user_level-holder').text("");
            $('#vbd_user_level-modal-delete').modal('show');

//vbToast('success','Record Successfully loaded!');

            var jsonVOB= JSON.parse(json_vbd_user_level['response']['result']['data-json'][0]);

            $('.vbuilder-delete-vbd_user_level-holder').text( jsonVOB['ulevel_id'] );
            item_id_delete_vbd_user_level=jsonVOB['ulevel_id'];

        }
        else
        {
// checking for the errors
            if(json_vbd_user_level['response']['state']===1920){

                vbToast('warning','Please login');

            } else if( json_vbd_user_level['rq_fields']['missing']['count'] != undefined && json_vbd_user_level['rq_fields']['missing']['count']!==0){
                vbToast('warning','Missing request data');
            } else if( json_vbd_user_level['validate']['state'] != undefined && json_vbd_user_level['validate']['state']===false){
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

$(document).on('click', ".vbd-action-link.vbd-delete-vbd_user_level", function (e) {

    e.preventDefault();


    var data_vbd_user_level="vbd_method=delete&vbd_key="+vbdGetKey()+"&ulevel_id="+item_id_delete_vbd_user_level;


    var xhrVBD= new XMLHttpRequest();
    xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_user_level/",true);
    xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    xhrVBD.onreadystatechange= function () {
        if(xhrVBD.readyState===4 && xhrVBD.status===200){

            delete_execute_vbd_user_level( xhrVBD.responseText)

        }
        if(xhrVBD.readyState<4){

        }
    };

    xhrVBD.send(data_vbd_user_level);

});


function delete_execute_vbd_user_level( thisvbd){

    try {



        var json_vbd_user_level=JSON.parse(thisvbd);

//start of submission check
        if(json_vbd_user_level['response']['state']===1){

            item_id_update_vbd_user_level=null;

            if( json_vbd_user_level['response']['result']['affected'] != undefined && json_vbd_user_level['response']['result']['affected']>0){
                vbToast('success','Record Deleted!');
// load the list
                reload_vbd_user_level();

            } else {
                vbToast('success','None change applied');
            }


        }
        else
        {
// checking for the errors
            if(json_vbd_user_level['response']['state']===1920){

                vbToast('warning','Please login');

            } else if( json_vbd_user_level['rq_fields']['missing']['count'] != undefined && json_vbd_user_level['rq_fields']['missing']['count']!==0){
                vbToast('warning','Missing request data');
            } else if( json_vbd_user_level['validate']['state'] != undefined && json_vbd_user_level['validate']['state']===false){
                vbToast('warning','Wrong request data');
            }else{
                vbToast('warning','Error deleting Record');
            }

        }
//end of submission check


    } catch (e) {

        vbToast('error','An error have occured during the request.');
        console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
    }

}


