/*<br/>
* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/ <br/>
* Author: Vayile Fumo<br/>
* Date: 28/08/2019, Wednesday<br/>
* Time: 02:32 PM<br/>
*/

$(window).ready(function() {
// load the list
    reload_vbd_user();
});
var vbdUserLevelDataStorage={};
function reload_vbd_user() {


    var data_vbd_user="vbd_method=read&vbd_key="+vbdGetKey();


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

                $.when(
                setVbdUserLevelData(json_vbd_user['response']['result']['user-level-data'])

                ).done(function( vbdUserLevelData ) {

//start of submission check
                var vbdLevelAdd;
                if(json_vbd_user['response']['state']===1){
                    $('#vbd_user-vbd-add-form').trigger("reset");
                    $('#vbd_user-modal-add').modal('hide');
//vbToast('success','Records successfully loaded!');

                    $("#vbd_user-table-list tbody").html("");

                    if(json_vbd_user['response']['result']['rows']>0){

                        for ( var ix = 0; ix < json_vbd_user['response']['result']['data-json'].length; ix++) {

                            var jsonVOB= JSON.parse(json_vbd_user['response']['result']['data-json'][ix]);

                          /*  $("#vbd_user-table-list tbody").append('<tr>'+ '<td>'+ jsonVOB['user_id'] +'  </td>' + '<td>'+ jsonVOB['ulevel_id'] +'  </td>' + '<td>'+ jsonVOB['user_rn'] +'  </td>' + '<td>'+ jsonVOB['user_idate'] +'  </td>' + '<td>'+ jsonVOB['user_name'] +'  </td>' + '<td>'+ jsonVOB['user_email'] +'  </td>' + '<td>'+ jsonVOB['user_password'] +'  </td>' + '<td>'+ jsonVOB['user_state'] +'  </td>' +  '<td class="vbd-actions-td">'+
                                '<a href="javascript:;"  data-item-id'+'="'+jsonVOB['user_id']+'" class="vbd-action-link vbd-update-vbd_user" > <span class="fa fa-edit"></span> </a>'+
                                '<a href="javascript:;" data-item-id'+'="'+jsonVOB['user_id']+'" class="vbd-action-link vbd-view-vbd_user ml-1" > <span class="fa fa-info-circle"></span> </a>'+
                                '<a href="javascript:;"  data-item-id'+'="'+jsonVOB['user_id']+'" class="vbd-action-link vbd-askdelete-vbd_user ml-1" >'+
                                ' <span class="fa fa-trash"></span>'+
                                '</a> </td> </tr>');*/

                             vbdLevelAdd=vbdUserLevelData[ jsonVOB['ulevel_id'] ] ['ulevel_name'];

                            $("#vbd_user-table-list tbody").append('<tr>'+'<td>'+ jsonVOB['user_name'] +'  </td>' + '<td>'+ jsonVOB['user_rn'] +'  </td>' + '<td>'+ jsonVOB['user_email'] +'  </td>' + '<td>'+ vbdLevelAdd +'  </td>' + '<td class="vbd-actions-td">'+
                                '<a href="javascript:;"  data-item-id'+'="'+jsonVOB['user_id']+'" class="vbd-action-link vbd-update-vbd_user" > <span class="fa fa-edit"></span> </a>'+
                                '<a href="javascript:;" data-item-id'+'="'+jsonVOB['user_id']+'" class="vbd-action-link vbd-view-vbd_user ml-1" > <span class="fa fa-info-circle"></span> </a>'+
                                '<a href="javascript:;"  data-item-id'+'="'+jsonVOB['user_id']+'" class="vbd-action-link vbd-askdelete-vbd_user ml-1" >'+
                                ' <span class="fa fa-trash"></span>'+
                                '</a> </td> </tr>');

                        }

                    }


                    // appendVbdUserLevel
                    appendVbdUserLevel(json_vbd_user['response']['result']['user-level-data'],'XYZS');





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

                // END OF DONE CALLBACK
                });

//end of submission check
            } catch (e) {

                vbToast('error','Error loading data. Bug');
                console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
            }
        } else{

            console.log("vbuilder-submition-process",'Loading vbd_user list data');

        }
    };
    xhr_vbd_user.send(data_vbd_user);



}


function appendVbdUserLevel(vbdUlevelData,vbdUlevelDataId){

    $("select#addf_ulevel_id").html("");
    $("select#ulevel_id").html("");

    var appendVarT="";
    for ( var ix = 0; ix < vbdUlevelData.length; ix++) {

        var jsonVOB= JSON.parse(vbdUlevelData[ix]);

        appendVarT="";
        if(vbdUlevelDataId===jsonVOB['ulevel_id']){
            appendVarT=" selected"
        }

        $("select#addf_ulevel_id").append('<option value="'+jsonVOB['ulevel_id']+'"'+appendVarT+'>'+jsonVOB['ulevel_name']+'</option>');
        $("select#ulevel_id").append('<option value="'+jsonVOB['ulevel_id']+'"'+appendVarT+'>'+jsonVOB['ulevel_name']+'</option>');

    }


}
function appendVbdUserLevelUpdate(vbdUlevelDataId){

    $("#vbd_user-vbd-update-role-form select#ulevel_id").html("");

    var appendVarT="";
    for(var tempData in vbdUserLevelDataStorage) {


        // alert(tempData.toString());
      if(vbdUserLevelDataStorage.hasOwnProperty(tempData)){


        var jsonVOB= vbdUserLevelDataStorage[tempData];

        appendVarT="";
        if(vbdUlevelDataId=== tempData   ){
            appendVarT=" selected"
        }

        $("#vbd_user-vbd-update-role-form select#ulevel_id").append('<option value="'+jsonVOB['ulevel_id']+'"'+appendVarT+'>'+jsonVOB['ulevel_name']+'</option>');

      }


    }


}



function setVbdUserLevelData(vbdUlevelData){
    var jsonVOB;
    var vbdUserLevelData={};
    for ( var ix = 0; ix < vbdUlevelData.length; ix++) {
         jsonVOB= JSON.parse(vbdUlevelData[ix]);

        vbdUserLevelData[ jsonVOB['ulevel_id'] ] = jsonVOB;
        vbdUserLevelDataStorage[ jsonVOB['ulevel_id'] ] = jsonVOB;

        // alert(vbdUserLevelData[jsonVOB['ulevel_id']]['ulevel_id']);

    }

return vbdUserLevelData
}



/*

* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/

* Author: Vayile Fumo

* Date: 28/08/2019, Wednesday

* Time: 02:32 PM

*/

$('form[name=vbd_user-vbd-add-form]').on('submit', function(e) {

    e.preventDefault();
    var this_fvalidate=true;
    var thisForm=$(this);

    if(this_fvalidate){
        vbdDisableSubmit(thisForm);
        this_fvalidate=false;

        var data_preset_vbd_user="vbd_method=add&vbd_key="+vbdGetKey();
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

// load the list
                        reload_vbd_user();

                        $('#vbd_user-vbd-add-form').trigger("reset");
                        $('#vbd_user-modal-add').modal('hide');
                        vbToast('success','Record Successfully Added!');
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


/*

* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/

* Author: Vayile Fumo

* Date: 28/08/2019, Wednesday

* Time: 02:32 PM

*/

var item_id_update_vbd_user=null;

$(document).on('click', ".vbd-update-vbd_user", function (e) {

    e.preventDefault();

    item_id_update_vbd_user=null;
    $('#vbd_user-vbd-update-form').trigger("reset");




    var data_vbd_user="vbd_method=readcontrol&vbd_key="+vbdGetKey()+"&user_id="+$(this).data('item-id');


    var xhrVBD= new XMLHttpRequest();
    xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_user/",true);
    xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    xhrVBD.onreadystatechange= function () {
        if(xhrVBD.readyState===4 && xhrVBD.status===200){

            update_load_vbd_user( xhrVBD.responseText);

        }
        if(xhrVBD.readyState<4){

        }
    };

    xhrVBD.send(data_vbd_user);

});



function update_load_vbd_user( thisvbd){

    try {


        var json_vbd_user=JSON.parse(thisvbd);
//start of submission check
        if(json_vbd_user['response']['state']===1){

            $('#vbd_user-vbd-update-form').trigger("reset");
            $('#vbd_user-modal-update').modal('hide');
//vbToast('success','Record Successfully loaded!');

            var jsonVOB= JSON.parse(json_vbd_user['response']['result']['data-json'][0]);
            item_id_update_vbd_user=jsonVOB['user_id'];

            // $('#vbd_user-vbd-update-role-form select#ulevel_id').val( jsonVOB['ulevel_id'] );
            $('#vbd_user-vbd-update-form input#user_rn').val( jsonVOB['user_rn'] );
            $('#vbd_user-vbd-update-form input#user_name').val( jsonVOB['user_name'] );
            $('#vbd_user-modal-update .user_name.vbd_user-holder').text( jsonVOB['user_name'] );
            $('#vbd_user-vbd-update-form input#user_email').val( jsonVOB['user_email'] );
            // $('#vbd_user-vbd-update-form input#user_state').val( jsonVOB['user_state'] );

            // appendVbdUserLevel
            appendVbdUserLevelUpdate(jsonVOB['ulevel_id']);


            $('#vbd_user-modal-update').modal('show');




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



$('form[name=vbd_user-vbd-update-form]').on('submit', function(e) {

    e.preventDefault();
    var this_fvalidate=true;
    var thisForm=$(this);

    if(this_fvalidate){
        vbdDisableSubmit(thisForm);
        this_fvalidate=false;

        var data_preset_vbd_user="vbd_method=update&vbd_key="+vbdGetKey()+"&user_id="+item_id_update_vbd_user;
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

                        $('#vbd_user-vbd-update-form').trigger("reset");
                        $('#vbd_user-modal-update').modal('hide');

                        if( json_vbd_user['response']['result']['affected'] != undefined && json_vbd_user['response']['result']['affected']>0){
                            vbToast('success','Record updated!');
// load the list
                            reload_vbd_user();

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

                        } else if(json_vbd_user['response']['state']===1012){

                            vbToast('warning','Username already Exist. Choose other');

                        } else if(json_vbd_user['response']['state']===1013){

                            vbToast('warning','Email already Exist. Choose other');

                        } else if(json_vbd_user['response']['state']===1616){

                            vbToast('warning','Can not edit user in same or higher level');

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

                console.log("vbuilder-submition-process",'Loading vbd_user-vbd-update-form');

            }
        };
        xhr_vbd_user.send(data_vbd_user);



    } else{

        vbToast('warning','Please fill all required fields');

    }

});

// UPDATE ROLE
$('form[name=vbd_user-vbd-update-role-form]').on('submit', function(e) {

    e.preventDefault();
    var this_fvalidate=true;
    var thisForm=$(this);

    if(this_fvalidate){
        vbdDisableSubmit(thisForm);
        this_fvalidate=false;

        var data_preset_vbd_user="vbd_method=update-role&vbd_key="+vbdGetKey()+"&user_id="+item_id_update_vbd_user;
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

                        $('#vbd_user-vbd-update-role-form').trigger("reset");
                        $('#vbd_user-modal-update').modal('hide');

                        if( json_vbd_user['response']['result']['affected'] != undefined && json_vbd_user['response']['result']['affected']>0){
                            vbToast('success','Record updated!');
// load the list
                            reload_vbd_user();

                        } else {
                            vbToast('success','None change applied');
                        }

                    }
                    else
                    {
// checking for the errors
                        if(json_vbd_user['response']['state']===1920){

                            vbToast('warning','Please login');

                        } else if(json_vbd_user['response']['state']===1616){

                            vbToast('warning','Can not edit user in same or higher level');

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

                console.log("vbuilder-submition-process",'Loading vbd_user-vbd-update-role-form');

            }
        };
        xhr_vbd_user.send(data_vbd_user);



    } else{

        vbToast('warning','Please fill all required fields');

    }

});


// UPDATE PASSWORD


$('form[name=vbd_user-vbd-update-password-form]').on('submit', function(e) {

    e.preventDefault();
    var this_fvalidate=true;
    var thisForm=$(this);

    if(this_fvalidate){
        vbdDisableSubmit(thisForm);
        this_fvalidate=false;
        
        var data_preset_vbd_user="vbd_method=update-password&vbd_key="+vbdGetKey()+"&user_id="+item_id_update_vbd_user;
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

                        $('#vbd_user-vbd-update-password-form').trigger("reset");
                        $('#vbd_user-modal-update').modal('hide');

                        if( json_vbd_user['response']['result']['affected'] != undefined && json_vbd_user['response']['result']['affected']>0){
                            vbToast('success','Record updated!');
// load the list
                            reload_vbd_user();

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

                        } else if(json_vbd_user['response']['state']===1616){

                            vbToast('warning','Can not edit user in same or higher level');

                        } else if(json_vbd_user['response']['state']===1010){

                            vbToast('warning','Wrong current password');

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

                console.log("vbuilder-submition-process",'Loading vbd_user-vbd-update-role-form');

            }
        };
        xhr_vbd_user.send(data_vbd_user);



    } else{

        vbToast('warning','Please fill all required fields');

    }

});

// UPDATE PASSWORD RESET


$('#vbd_user-vbd-update-passwordr-form').on('submit', function(e) {

    e.preventDefault();
    var this_fvalidate=true;
    var thisForm=$(this);

    if(this_fvalidate){
        vbdDisableSubmit(thisForm);
        this_fvalidate=false;
        
        var data_preset_vbd_user="vbd_method=update-password-reset&vbd_key="+vbdGetKey()+"&user_id="+item_id_update_vbd_user;
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

                        $('#vbd_user-vbd-update-passwordr-form').trigger("reset");
                        $('#vbd_user-modal-update').modal('hide');

                        if( json_vbd_user['response']['result']['affected'] != undefined && json_vbd_user['response']['result']['affected']>0){
                            vbToast('success','Record updated!');
// load the list
                            reload_vbd_user();

                        } else {
                            vbToast('success','None change applied');
                        }

                    }
                    else
                    {
// checking for the errors
                        if(json_vbd_user['response']['state']===1920){

                            vbToast('warning','Please login');

                        } else if(json_vbd_user['response']['state']===1616){

                            vbToast('warning','Can not edit user in same or higher level');

                        }  else if(json_vbd_user['response']['state']===1011){

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
                            vbToast('warning','Error updating record');
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

/*<br/>
* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/ <br/>
* Author: Vayile Fumo<br/>
* Date: 28/08/2019, Wednesday<br/>
* Time: 02:32 PM<br/>
*/


$(document).on('click', ".vbd-view-vbd_user", function (e) {

    e.preventDefault();

    var data_vbd_user="vbd_method=readcontrol&vbd_key="+vbdGetKey()+"&user_id="+$(this).data('item-id');


    var xhrVBD= new XMLHttpRequest();
    xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_user/",true);
    xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    xhrVBD.onreadystatechange= function () {
        if(xhrVBD.readyState===4 && xhrVBD.status===200){

            view_load_vbd_user( xhrVBD.responseText)

        }
        if(xhrVBD.readyState<4){

        }
    };

    xhrVBD.send(data_vbd_user);

});



function view_load_vbd_user( thisvbd){

    try {


        var json_vbd_user=JSON.parse(thisvbd);
//start of submission check
        if(json_vbd_user['response']['state']===1 && json_vbd_user['response']['result']['rows']>0){

            $('#vbd_user-item-view .vbd_user-holder').text("");
            $('#vbd_user-modal-view').modal('show');

//vbToast('success','Record Successfully loaded!');

            var jsonVOB= JSON.parse(json_vbd_user['response']['result']['data-json'][0]);



            $('#vbd_user-item-view .ulevel_id.vbd_user-holder').text(vbdUserLevelDataStorage[[ jsonVOB['ulevel_id'] ]] ['ulevel_name']);

            $('#vbd_user-item-view .user_rn.vbd_user-holder').text( jsonVOB['user_rn'] );
            $('#vbd_user-item-view .user_idate.vbd_user-holder').text( jsonVOB['user_idate'] );
            $('#vbd_user-item-view .user_name.vbd_user-holder').text( jsonVOB['user_name'] );
            $('#vbd_user-item-view .user_email.vbd_user-holder').text( jsonVOB['user_email'] );
            $('#vbd_user-item-view .user_password.vbd_user-holder').text( jsonVOB['user_password'] );
            $('#vbd_user-item-view .user_state.vbd_user-holder').text( jsonVOB['user_state'] );

            $('#vbd_user-modal-view').modal('show');

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


/*

* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/

* Author: Vayile Fumo

* Date: 28/08/2019, Wednesday

* Time: 02:32 PM

*/


var item_id_delete_vbd_user=null;

$(document).on('click', ".vbd-action-link.vbd-askdelete-vbd_user", function (e) {

    e.preventDefault();
    item_id_delete_vbd_user=null;
    var data_vbd_user="vbd_method=readcontrol&vbd_key="+vbdGetKey()+"&user_id="+$(this).data('item-id');


    var xhrVBD= new XMLHttpRequest();
    xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_user/",true);
    xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    xhrVBD.onreadystatechange= function () {
        if(xhrVBD.readyState===4 && xhrVBD.status===200){

            delete_load_vbd_user( xhrVBD.responseText)

        }
        if(xhrVBD.readyState<4){

        }
    };

    xhrVBD.send(data_vbd_user);

});




// Open modal if data exist
function delete_load_vbd_user( thisvbd ){

    try {


        var json_vbd_user=JSON.parse(thisvbd);
//start of submission check
        if(json_vbd_user['response']['state']===1 && json_vbd_user['response']['result']['rows']>0){

            $('.vbuilder-delete-vbd_user-holder').text("");
            $('#vbd_user-modal-delete').modal('show');

//vbToast('success','Record Successfully loaded!');

            var jsonVOB= JSON.parse(json_vbd_user['response']['result']['data-json'][0]);

            $('.vbuilder-delete-vbd_user-holder').text( jsonVOB['user_name'] );
            item_id_delete_vbd_user=jsonVOB['user_id'];

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


// confirm item deletion

$(document).on('click', ".vbd-action-link.vbd-delete-vbd_user", function (e) {
    e.preventDefault();


    var data_vbd_user="vbd_method=delete&vbd_key="+vbdGetKey()+"&user_id="+item_id_delete_vbd_user;


    var xhrVBD= new XMLHttpRequest();
    xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_user/",true);
    xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    xhrVBD.onreadystatechange= function () {
        if(xhrVBD.readyState===4 && xhrVBD.status===200){

            delete_execute_vbd_user( xhrVBD.responseText)

        }
        if(xhrVBD.readyState<4){

        }
    };

    xhrVBD.send(data_vbd_user);

});


function delete_execute_vbd_user( thisvbd){

    try {



        var json_vbd_user=JSON.parse(thisvbd);

//start of submission check
        if(json_vbd_user['response']['state']===1){

            item_id_update_vbd_user=null;

            if( json_vbd_user['response']['result']['affected'] != undefined && json_vbd_user['response']['result']['affected']>0){
                vbToast('success','Record Deleted!');
// load the list
                reload_vbd_user();

            } else {
                vbToast('success','None change applied');
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
                vbToast('warning','Error deleting Record');
            }

        }
//end of submission check


    } catch (e) {

        vbToast('error','An error have occured during the request.');
        console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
    }

}


