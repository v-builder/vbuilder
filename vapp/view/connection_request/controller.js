/*<br/>
* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/ <br/>
* Author: Vayile Fumo<br/>
* Date: 18/09/2019, Wednesday<br/>
* Time: 08:35 PM<br/>
* Project/Module: Connection Action<br/>*/

$(window).ready(function() {
// load the list
reload_connection_request();
});

function reload_connection_request() {


var data_connection_request="vbd_method=read&vbd_key="+vbdGetKey();


var url= VBUILDER_APP_ROOT+"/api/global/connection_request/";
var content_connection_request="none-v";

var xhr_connection_request= new XMLHttpRequest();
xhr_connection_request.open('POST',url,true);
xhr_connection_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr_connection_request.onreadystatechange= function () {

if(xhr_connection_request.readyState===4 && xhr_connection_request.status===200){

content_connection_request=xhr_connection_request.responseText;

try {

var json_connection_request=JSON.parse(content_connection_request);

//start of submission check
if(json_connection_request['response']['state']===1){
$('#connection_request-vbd-add-form').trigger("reset");
$('#connection_request-modal-add').modal('hide');
//vbToast('success','Records successfully loaded!');

$("#connection_request-table-list tbody").html("");

if(json_connection_request['response']['result']['rows']>0){

for ( var ix = 0; ix < json_connection_request['response']['result']['data-json'].length; ix++) {

var jsonVOB= JSON.parse(json_connection_request['response']['result']['data-json'][ix]);

$("#connection_request-table-list tbody").append('<tr>'+ '<td>'+ jsonVOB['cr_id'] +'  </td>' + '<td>'+ jsonVOB['from_user_id'] +'  </td>' + '<td>'+ jsonVOB['to_user_id'] +'  </td>' + '<td>'+ jsonVOB['cr_date'] +'  </td>' + '<td>'+ jsonVOB['cr_date_response'] +'  </td>' + '<td>'+ jsonVOB['cr_state'] +'  </td>' + '<td>'+ jsonVOB['cr_response'] +'  </td>' +  '<td class="vbd-actions-td">'+
        '<a href="javascript:;"  data-item-id'+'="'+jsonVOB['cr_id']+'" class="vbd-action-link vbd-update-connection_request" > <span class="fa fa-edit"></span> </a>'+
       '<a href="javascript:;" data-item-id'+'="'+jsonVOB['cr_id']+'" class="vbd-action-link vbd-view-connection_request ml-1" > <span class="fa fa-info-circle"></span> </a>'+
       '<a href="javascript:;"  data-item-id'+'="'+jsonVOB['cr_id']+'" class="vbd-action-link vbd-askdelete-connection_request ml-1" >'+
           ' <span class="fa fa-trash"></span>'+
        '</a> </td> </tr>');
}

}


}
else
{
// checking for the errors
if(json_connection_request['response']['state']===1920){

vbToast('warning','Please login. Error loading data');

} else if( json_connection_request['rq_fields']['missing']['count'] != undefined && json_connection_request['rq_fields']['missing']['count']!==0){
vbToast('warning','Error loading data. Missing');
} else if( json_connection_request['validate']['state'] != undefined && json_connection_request['validate']['state']===false){
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

console.log("vbuilder-submition-process",'Loading connection_request list data');

}
};
xhr_connection_request.send(data_connection_request);



}



 /*
* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Author: Vayile Fumo
* Date: 18/09/2019, Wednesday
* Time: 08:35 PM
* Project/Module: Connection Action*/

$('form[name=connection_request-vbd-add-form]').on('submit', function(e) {

//uncomment the prevent bellow case an error appear, for debug
//e.preventDefault();
var this_fvalidate=true;

var thisForm=$(this);

if(this_fvalidate){
vbdDisableSubmit(thisForm);
this_fvalidate=false;

var data_preset_connection_request="vbd_method=add&vbd_key="+vbdGetKey();
var data_connection_request=data_preset_connection_request+'&'+$(this).serialize();


var url= VBUILDER_APP_ROOT+"/api/global/connection_request/";
var content_connection_request="none-v";

var xhr_connection_request= new XMLHttpRequest();
xhr_connection_request.open('POST',url,true);
xhr_connection_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr_connection_request.onreadystatechange= function () {

if(xhr_connection_request.readyState===4){
vbdEnableSubmit(thisForm);
this_fvalidate=true;
} else{
vbdDisableSubmit(thisForm);
this_fvalidate=false;
}

if(xhr_connection_request.readyState===4 && xhr_connection_request.status===200){
content_connection_request=xhr_connection_request.responseText;
try {



var json_connection_request=JSON.parse(content_connection_request);
//start of submission check
if(json_connection_request['response']['state']===1){

// load the list
reload_connection_request();

$('form[name=connection_request-vbd-add-form]').trigger("reset");
$('#connection_request-modal-add').modal('hide');
vbToast('success','Connection Action successfully added');
}
else
{
// checking for the errors
if(json_connection_request['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_connection_request['rq_fields']['missing']['count'] != undefined && json_connection_request['rq_fields']['missing']['count']!==0){
vbToast('warning','Please fill all required fields');
} else if( json_connection_request['validate']['state'] != undefined && json_connection_request['validate']['state']===false){
vbToast('warning','Fill the fields correctly');
} else if( json_connection_request['response']['result']['error'][1] != undefined && json_connection_request['response']['result']['error'][1]===1062){
vbToast('warning','Error. Duplicate entry');
} else{
vbToast('warning','Error adding Connection Action');
}

}
//end of submission check
} catch (e) {

vbToast('error','An error have occured during the request.');
console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
}
} else{

console.log("vbuilder-connection_request-submition-process",'Loading connection_request-vbd-add-form');

}
};
xhr_connection_request.send(data_connection_request);



} else{

vbToast('warning','Please fill all required fields');

}

return false;

});

 /*
* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Author: Vayile Fumo
* Date: 18/09/2019, Wednesday
* Time: 08:35 PM
* Project/Module: Connection Action*/

var item_id_update_connection_request=null;

$(document).on('click', ".vbd-update-connection_request", function (e) {

e.preventDefault();

item_id_update_connection_request=null;
$('form[name=connection_request-vbd-update-form]').trigger("reset");




var data_connection_request="vbd_method=readcontrol&vbd_key="+vbdGetKey()+"&cr_id="+$(this).data('item-id');


var xhrVBD= new XMLHttpRequest();
xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/connection_request/",true);
xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


xhrVBD.onreadystatechange= function () {
if(xhrVBD.readyState===4 && xhrVBD.status===200){

update_load_connection_request( xhrVBD.responseText)

}
if(xhrVBD.readyState<4){

}
};

xhrVBD.send(data_connection_request);

});



function update_load_connection_request( thisvbd){

try {


var json_connection_request=JSON.parse(thisvbd);
//start of submission check
if(json_connection_request['response']['state']===1){

$('form[name=connection_request-vbd-update-form]').trigger("reset");

//vbToast('success','Connection Action successfully loaded!');

var jsonVOB= JSON.parse(json_connection_request['response']['result']['data-json'][0]);
item_id_update_connection_request=jsonVOB['cr_id'];

        $('form[name=connection_request-vbd-update-form] input[name=from_user_id]').val( jsonVOB['from_user_id'] );
        $('form[name=connection_request-vbd-update-form] input[name=to_user_id]').val( jsonVOB['to_user_id'] );
        $('form[name=connection_request-vbd-update-form] input[name=cr_date]').val( jsonVOB['cr_date'] );
        $('form[name=connection_request-vbd-update-form] input[name=cr_date_response]').val( jsonVOB['cr_date_response'] );
        $('form[name=connection_request-vbd-update-form] input[name=cr_state]').val( jsonVOB['cr_state'] );
        $('form[name=connection_request-vbd-update-form] input[name=cr_response]').val( jsonVOB['cr_response'] );

$('#connection_request-modal-update').modal('show');

}
else
{
// checking for the errors
if(json_connection_request['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_connection_request['rq_fields']['missing']['count'] != undefined && json_connection_request['rq_fields']['missing']['count']!==0){
vbToast('warning','Missing request data');
} else if( json_connection_request['validate']['state'] != undefined && json_connection_request['validate']['state']===false){
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



$('form[name=connection_request-vbd-update-form]').on('submit', function(e) {

//uncomment the prevent bellow case an error appear, for debug
//e.preventDefault();
var this_fvalidate=true;

var thisForm=$(this);

if(this_fvalidate){
vbdDisableSubmit(thisForm);
this_fvalidate=false;

var data_preset_connection_request="vbd_method=update&vbd_key="+vbdGetKey()+"&cr_id="+item_id_update_connection_request;
var data_connection_request=data_preset_connection_request+'&'+$(this).serialize();


var url= VBUILDER_APP_ROOT+"/api/global/connection_request/";
var content_connection_request="none-v";

var xhr_connection_request= new XMLHttpRequest();
xhr_connection_request.open('POST',url,true);
xhr_connection_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr_connection_request.onreadystatechange= function () {


if(xhr_connection_request.readyState===4){
vbdEnableSubmit(thisForm);
this_fvalidate=true;
} else{
vbdDisableSubmit(thisForm);
this_fvalidate=false;
}


if(xhr_connection_request.readyState===4 && xhr_connection_request.status===200){
content_connection_request=xhr_connection_request.responseText;
try {


var json_connection_request=JSON.parse(content_connection_request);
//start of submission check
if(json_connection_request['response']['state']===1){
item_id_update_connection_request=null;

$('form[name=connection_request-vbd-update-form]').trigger("reset");
$('#connection_request-modal-update').modal('hide');

if( json_connection_request['response']['result']['affected'] != undefined && json_connection_request['response']['result']['affected']>0){
vbToast('success','Connection Action updated');
// load the list
reload_connection_request();

} else {
vbToast('success','None change applied');
}

}
else
{
// checking for the errors
if(json_connection_request['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_connection_request['rq_fields']['missing']['count'] != undefined && json_connection_request['rq_fields']['missing']['count']!==0){
vbToast('warning','Please fill all required fields');
} else if( json_connection_request['validate']['state'] != undefined && json_connection_request['validate']['state']===false){
vbToast('warning','Fill the fields correctly');
} else if( json_connection_request['response']['result']['error'][1] != undefined && json_connection_request['response']['result']['error'][1]===1062){
vbToast('warning','Error. Duplicate entry');
} else{
vbToast('warning','Error updating Connection Action');
}

}
//end of submission check

} catch (e) {

vbToast('error','An error have occured during the request.');
console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
}
} else{

console.log("vbuilder-connection_request-submition-process",'Loading connection_request-vbd-update-form');

}
};
xhr_connection_request.send(data_connection_request);



} else{

vbToast('warning','Please fill all required fields');

}
return false;

});

 
/*<br/>
* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/ <br/>
* Author: Vayile Fumo<br/>
* Date: 18/09/2019, Wednesday<br/>
* Time: 08:35 PM<br/>
* Project/Module: Connection Action<br/>*/


$(document).on('click', ".vbd-view-connection_request", function (e) {

e.preventDefault();

var data_connection_request="vbd_method=readcontrol&vbd_key="+vbdGetKey()+"&cr_id="+$(this).data('item-id');


var xhrVBD= new XMLHttpRequest();
xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/connection_request/",true);
xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


xhrVBD.onreadystatechange= function () {
if(xhrVBD.readyState===4 && xhrVBD.status===200){

view_load_connection_request( xhrVBD.responseText)

}
if(xhrVBD.readyState<4){

}
};

xhrVBD.send(data_connection_request);

});



function view_load_connection_request( thisvbd){

try {


var json_connection_request=JSON.parse(thisvbd);
//start of submission check
if(json_connection_request['response']['state']===1 && json_connection_request['response']['result']['rows']>0){

$('#connection_request-item-view .connection_request-holder').text("");
$('#connection_request-modal-view').modal('show');

//vbToast('success','Record Successfully loaded!');

var jsonVOB= JSON.parse(json_connection_request['response']['result']['data-json'][0]);

        $('#connection_request-item-view .from_user_id.connection_request-holder').text( jsonVOB['from_user_id'] );
                $('#connection_request-item-view .to_user_id.connection_request-holder').text( jsonVOB['to_user_id'] );
                $('#connection_request-item-view .cr_date.connection_request-holder').text( jsonVOB['cr_date'] );
                $('#connection_request-item-view .cr_date_response.connection_request-holder').text( jsonVOB['cr_date_response'] );
                $('#connection_request-item-view .cr_state.connection_request-holder').text( jsonVOB['cr_state'] );
                $('#connection_request-item-view .cr_response.connection_request-holder').text( jsonVOB['cr_response'] );
        
$('#connection_request-modal-view').modal('show');

}
else
{
// checking for the errors
if(json_connection_request['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_connection_request['rq_fields']['missing']['count'] != undefined && json_connection_request['rq_fields']['missing']['count']!==0){
vbToast('warning','Missing request data');
} else if( json_connection_request['validate']['state'] != undefined && json_connection_request['validate']['state']===false){
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
* Date: 18/09/2019, Wednesday
* Time: 08:35 PM
* Project/Module: Connection Action*/


var item_id_delete_connection_request=null;

$(document).on('click', ".vbd-action-link.vbd-askdelete-connection_request", function (e) {

e.preventDefault();
item_id_delete_connection_request=null;
var data_connection_request="vbd_method=readcontrol&vbd_key="+vbdGetKey()+"&cr_id="+$(this).data('item-id');


var xhrVBD= new XMLHttpRequest();
xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/connection_request/",true);
xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


xhrVBD.onreadystatechange= function () {
if(xhrVBD.readyState===4 && xhrVBD.status===200){

delete_load_connection_request( xhrVBD.responseText)

}
if(xhrVBD.readyState<4){

}
};

xhrVBD.send(data_connection_request);

});




// Open modal if data exist
function delete_load_connection_request( thisvbd ){

try {


var json_connection_request=JSON.parse(thisvbd);
//start of submission check
if(json_connection_request['response']['state']===1 && json_connection_request['response']['result']['rows']>0){

$('.vbuilder-delete-connection_request-holder').text("");
$('#connection_request-modal-delete').modal('show');

//vbToast('success','Connection Action successfully loaded!');

var jsonVOB= JSON.parse(json_connection_request['response']['result']['data-json'][0]);

$('.vbuilder-delete-connection_request-holder').text( jsonVOB['cr_id'] );
item_id_delete_connection_request=jsonVOB['cr_id'];

}
else
{
// checking for the errors
if(json_connection_request['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_connection_request['rq_fields']['missing']['count'] != undefined && json_connection_request['rq_fields']['missing']['count']!==0){
vbToast('warning','Missing request data');
} else if( json_connection_request['validate']['state'] != undefined && json_connection_request['validate']['state']===false){
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

$(document).on('click', ".vbd-action-link.vbd-delete-connection_request", function (e) {
e.preventDefault();


var data_connection_request="vbd_method=delete&vbd_key="+vbdGetKey()+"&cr_id="+item_id_delete_connection_request;


var xhrVBD= new XMLHttpRequest();
xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/connection_request/",true);
xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


xhrVBD.onreadystatechange= function () {
if(xhrVBD.readyState===4 && xhrVBD.status===200){

delete_execute_connection_request( xhrVBD.responseText)

}
if(xhrVBD.readyState<4){

}
};

xhrVBD.send(data_connection_request);

});


function delete_execute_connection_request( thisvbd){

try {



var json_connection_request=JSON.parse(thisvbd);

//start of submission check
if(json_connection_request['response']['state']===1){

item_id_update_connection_request=null;

if( json_connection_request['response']['result']['affected'] != undefined && json_connection_request['response']['result']['affected']>0){
vbToast('success','Connection Action deleted');
// load the list
reload_connection_request();

} else {
vbToast('success','None change applied');
}


}
else
{
// checking for the errors
if(json_connection_request['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_connection_request['rq_fields']['missing']['count'] != undefined && json_connection_request['rq_fields']['missing']['count']!==0){
vbToast('warning','Missing request data');
} else if( json_connection_request['validate']['state'] != undefined && json_connection_request['validate']['state']===false){
vbToast('warning','Wrong request data');
}else{
vbToast('warning','Error deleting Connection Action');
}

}
//end of submission check


} catch (e) {

vbToast('error','An error have occured during the request.');
console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
}

}



