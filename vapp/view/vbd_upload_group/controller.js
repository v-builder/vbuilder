/*<br/>
* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/ <br/>
* Author: Vayile Fumo<br/>
* Date: 19/10/2019, Saturday<br/>
* Time: 10:54 AM<br/>
* Project/Module: VB Upload Group<br/>*/

$(window).ready(function() {
// load the list
reload_vbd_upload_group();
});

function reload_vbd_upload_group() {


var data_vbd_upload_group="vbd_method=read&vbd_key="+vbdGetKey();


var url= VBUILDER_APP_ROOT+"/api/global/vbd_upload_group/";
var content_vbd_upload_group="none-v";

var xhr_vbd_upload_group= new XMLHttpRequest();
xhr_vbd_upload_group.open('POST',url,true);
xhr_vbd_upload_group.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr_vbd_upload_group.onreadystatechange= function () {

if(xhr_vbd_upload_group.readyState===4 && xhr_vbd_upload_group.status===200){

content_vbd_upload_group=xhr_vbd_upload_group.responseText;

try {

var json_vbd_upload_group=JSON.parse(content_vbd_upload_group);

//start of submission check
if(json_vbd_upload_group['response']['state']===1){
$('#vbd_upload_group-vbd-add-form').trigger("reset");
$('#vbd_upload_group-modal-add').modal('hide');
//vbToast('success','Records successfully loaded!');

$("#vbd_upload_group-table-list tbody").html("");

if(json_vbd_upload_group['response']['result']['rows']>0){

for ( var ix = 0; ix < json_vbd_upload_group['response']['result']['data-json'].length; ix++) {

var jsonVOB= JSON.parse(json_vbd_upload_group['response']['result']['data-json'][ix]);

$("#vbd_upload_group-table-list tbody").append('<tr>'+ '<td>'+ jsonVOB['upg_id'] +'  </td>' + '<td>'+ jsonVOB['user_id'] +'  </td>' + '<td>'+ jsonVOB['upg_date'] +'  </td>' + '<td>'+ jsonVOB['upg_desc'] +'  </td>' +  '<td class="vbd-actions-td">'+
        '<a href="javascript:;"  data-item-id'+'="'+jsonVOB['upg_id']+'" class="vbd-action-link vbd-update-vbd_upload_group" > <span class="fa fa-edit"></span> </a>'+
       '<a href="javascript:;" data-item-id'+'="'+jsonVOB['upg_id']+'" class="vbd-action-link vbd-view-vbd_upload_group ml-1" > <span class="fa fa-info-circle"></span> </a>'+
       '<a href="javascript:;"  data-item-id'+'="'+jsonVOB['upg_id']+'" class="vbd-action-link vbd-askdelete-vbd_upload_group ml-1" >'+
           ' <span class="fa fa-trash"></span>'+
        '</a> </td> </tr>');
}

}


}
else
{
// checking for the errors
if(json_vbd_upload_group['response']['state']===1920){

vbToast('warning','Please login. Error loading data');

} else if( json_vbd_upload_group['rq_fields']['missing']['count'] != undefined && json_vbd_upload_group['rq_fields']['missing']['count']!==0){
vbToast('warning','Error loading data. Missing');
} else if( json_vbd_upload_group['validate']['state'] != undefined && json_vbd_upload_group['validate']['state']===false){
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

console.log("vbuilder-submition-process",'Loading vbd_upload_group list data');

}
};
xhr_vbd_upload_group.send(data_vbd_upload_group);



}



 /*
* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Author: Vayile Fumo
* Date: 19/10/2019, Saturday
* Time: 10:54 AM
* Project/Module: VB Upload Group*/

$('form[name=vbd_upload_group-vbd-add-form]').on('submit', function(e) {

//uncomment the prevent bellow case an error appear, for debug
//e.preventDefault();
var this_fvalidate=true;

var thisForm=$(this);

if(this_fvalidate){
vbdDisableSubmit(thisForm);
this_fvalidate=false;

var data_preset_vbd_upload_group="vbd_method=add&vbd_key="+vbdGetKey();
var data_vbd_upload_group=data_preset_vbd_upload_group+'&'+$(this).serialize();


var url= VBUILDER_APP_ROOT+"/api/global/vbd_upload_group/";
var content_vbd_upload_group="none-v";

var xhr_vbd_upload_group= new XMLHttpRequest();
xhr_vbd_upload_group.open('POST',url,true);
xhr_vbd_upload_group.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr_vbd_upload_group.onreadystatechange= function () {

if(xhr_vbd_upload_group.readyState===4){
vbdEnableSubmit(thisForm);
this_fvalidate=true;
} else{
vbdDisableSubmit(thisForm);
this_fvalidate=false;
}

if(xhr_vbd_upload_group.readyState===4 && xhr_vbd_upload_group.status===200){
content_vbd_upload_group=xhr_vbd_upload_group.responseText;
try {



var json_vbd_upload_group=JSON.parse(content_vbd_upload_group);
//start of submission check
if(json_vbd_upload_group['response']['state']===1){

// load the list
reload_vbd_upload_group();

$('form[name=vbd_upload_group-vbd-add-form]').trigger("reset");
$('#vbd_upload_group-modal-add').modal('hide');
vbToast('success','Vb Upload Group successfully added');
}
else
{
// checking for the errors
if(json_vbd_upload_group['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_vbd_upload_group['rq_fields']['missing']['count'] != undefined && json_vbd_upload_group['rq_fields']['missing']['count']!==0){
vbToast('warning','Please fill all required fields');
} else if( json_vbd_upload_group['validate']['state'] != undefined && json_vbd_upload_group['validate']['state']===false){
vbToast('warning','Fill the fields correctly');
} else if( json_vbd_upload_group['response']['result']['error'][1] != undefined && json_vbd_upload_group['response']['result']['error'][1]===1062){
vbToast('warning','Error. Duplicate entry');
} else{
vbToast('warning','Error adding Vb Upload Group');
}

}
//end of submission check
} catch (e) {

vbToast('error','An error have occured during the request.');
console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
}
} else{

console.log("vbuilder-vbd_upload_group-submition-process",'Loading vbd_upload_group-vbd-add-form');

}
};
xhr_vbd_upload_group.send(data_vbd_upload_group);



} else{

vbToast('warning','Please fill all required fields');

}

return false;

});

 /*
* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Author: Vayile Fumo
* Date: 19/10/2019, Saturday
* Time: 10:54 AM
* Project/Module: VB Upload Group*/

var item_id_update_vbd_upload_group=null;

$(document).on('click', ".vbd-update-vbd_upload_group", function (e) {

e.preventDefault();

item_id_update_vbd_upload_group=null;
$('form[name=vbd_upload_group-vbd-update-form]').trigger("reset");




var data_vbd_upload_group="vbd_method=readcontrol&vbd_key="+vbdGetKey()+"&upg_id="+$(this).data('item-id');


var xhrVBD= new XMLHttpRequest();
xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_upload_group/",true);
xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


xhrVBD.onreadystatechange= function () {
if(xhrVBD.readyState===4 && xhrVBD.status===200){

update_load_vbd_upload_group( xhrVBD.responseText)

}
if(xhrVBD.readyState<4){

}
};

xhrVBD.send(data_vbd_upload_group);

});



function update_load_vbd_upload_group( thisvbd){

try {


var json_vbd_upload_group=JSON.parse(thisvbd);
//start of submission check
if(json_vbd_upload_group['response']['state']===1){

$('form[name=vbd_upload_group-vbd-update-form]').trigger("reset");

//vbToast('success','Vb Upload Group successfully loaded!');

var jsonVOB= JSON.parse(json_vbd_upload_group['response']['result']['data-json'][0]);
item_id_update_vbd_upload_group=jsonVOB['upg_id'];

        $('form[name=vbd_upload_group-vbd-update-form] input[name=user_id]').val( jsonVOB['user_id'] );
        $('form[name=vbd_upload_group-vbd-update-form] input[name=upg_date]').val( jsonVOB['upg_date'] );
        $('form[name=vbd_upload_group-vbd-update-form] input[name=upg_desc]').val( jsonVOB['upg_desc'] );

$('#vbd_upload_group-modal-update').modal('show');

}
else
{
// checking for the errors
if(json_vbd_upload_group['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_vbd_upload_group['rq_fields']['missing']['count'] != undefined && json_vbd_upload_group['rq_fields']['missing']['count']!==0){
vbToast('warning','Missing request data');
} else if( json_vbd_upload_group['validate']['state'] != undefined && json_vbd_upload_group['validate']['state']===false){
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



$('form[name=vbd_upload_group-vbd-update-form]').on('submit', function(e) {

//uncomment the prevent bellow case an error appear, for debug
//e.preventDefault();
var this_fvalidate=true;

var thisForm=$(this);

if(this_fvalidate){
vbdDisableSubmit(thisForm);
this_fvalidate=false;

var data_preset_vbd_upload_group="vbd_method=update&vbd_key="+vbdGetKey()+"&upg_id="+item_id_update_vbd_upload_group;
var data_vbd_upload_group=data_preset_vbd_upload_group+'&'+$(this).serialize();


var url= VBUILDER_APP_ROOT+"/api/global/vbd_upload_group/";
var content_vbd_upload_group="none-v";

var xhr_vbd_upload_group= new XMLHttpRequest();
xhr_vbd_upload_group.open('POST',url,true);
xhr_vbd_upload_group.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr_vbd_upload_group.onreadystatechange= function () {


if(xhr_vbd_upload_group.readyState===4){
vbdEnableSubmit(thisForm);
this_fvalidate=true;
} else{
vbdDisableSubmit(thisForm);
this_fvalidate=false;
}


if(xhr_vbd_upload_group.readyState===4 && xhr_vbd_upload_group.status===200){
content_vbd_upload_group=xhr_vbd_upload_group.responseText;
try {


var json_vbd_upload_group=JSON.parse(content_vbd_upload_group);
//start of submission check
if(json_vbd_upload_group['response']['state']===1){
item_id_update_vbd_upload_group=null;

$('form[name=vbd_upload_group-vbd-update-form]').trigger("reset");
$('#vbd_upload_group-modal-update').modal('hide');

if( json_vbd_upload_group['response']['result']['affected'] != undefined && json_vbd_upload_group['response']['result']['affected']>0){
vbToast('success','Vb Upload Group updated');
// load the list
reload_vbd_upload_group();

} else {
vbToast('success','None change applied');
}

}
else
{
// checking for the errors
if(json_vbd_upload_group['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_vbd_upload_group['rq_fields']['missing']['count'] != undefined && json_vbd_upload_group['rq_fields']['missing']['count']!==0){
vbToast('warning','Please fill all required fields');
} else if( json_vbd_upload_group['validate']['state'] != undefined && json_vbd_upload_group['validate']['state']===false){
vbToast('warning','Fill the fields correctly');
} else if( json_vbd_upload_group['response']['result']['error'][1] != undefined && json_vbd_upload_group['response']['result']['error'][1]===1062){
vbToast('warning','Error. Duplicate entry');
} else{
vbToast('warning','Error updating Vb Upload Group');
}

}
//end of submission check

} catch (e) {

vbToast('error','An error have occured during the request.');
console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
}
} else{

console.log("vbuilder-vbd_upload_group-submition-process",'Loading vbd_upload_group-vbd-update-form');

}
};
xhr_vbd_upload_group.send(data_vbd_upload_group);



} else{

vbToast('warning','Please fill all required fields');

}
return false;

});

 
/*<br/>
* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/ <br/>
* Author: Vayile Fumo<br/>
* Date: 19/10/2019, Saturday<br/>
* Time: 10:54 AM<br/>
* Project/Module: VB Upload Group<br/>*/


$(document).on('click', ".vbd-view-vbd_upload_group", function (e) {

e.preventDefault();

var data_vbd_upload_group="vbd_method=readcontrol&vbd_key="+vbdGetKey()+"&upg_id="+$(this).data('item-id');


var xhrVBD= new XMLHttpRequest();
xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_upload_group/",true);
xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


xhrVBD.onreadystatechange= function () {
if(xhrVBD.readyState===4 && xhrVBD.status===200){

view_load_vbd_upload_group( xhrVBD.responseText)

}
if(xhrVBD.readyState<4){

}
};

xhrVBD.send(data_vbd_upload_group);

});



function view_load_vbd_upload_group( thisvbd){

try {


var json_vbd_upload_group=JSON.parse(thisvbd);
//start of submission check
if(json_vbd_upload_group['response']['state']===1 && json_vbd_upload_group['response']['result']['rows']>0){

$('#vbd_upload_group-item-view .vbd_upload_group-holder').text("");
$('#vbd_upload_group-modal-view').modal('show');

//vbToast('success','Record Successfully loaded!');

var jsonVOB= JSON.parse(json_vbd_upload_group['response']['result']['data-json'][0]);

        $('#vbd_upload_group-item-view .user_id.vbd_upload_group-holder').text( jsonVOB['user_id'] );
                $('#vbd_upload_group-item-view .upg_date.vbd_upload_group-holder').text( jsonVOB['upg_date'] );
                $('#vbd_upload_group-item-view .upg_desc.vbd_upload_group-holder').text( jsonVOB['upg_desc'] );
        
$('#vbd_upload_group-modal-view').modal('show');

}
else
{
// checking for the errors
if(json_vbd_upload_group['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_vbd_upload_group['rq_fields']['missing']['count'] != undefined && json_vbd_upload_group['rq_fields']['missing']['count']!==0){
vbToast('warning','Missing request data');
} else if( json_vbd_upload_group['validate']['state'] != undefined && json_vbd_upload_group['validate']['state']===false){
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
* Date: 19/10/2019, Saturday
* Time: 10:54 AM
* Project/Module: VB Upload Group*/


var item_id_delete_vbd_upload_group=null;

$(document).on('click', ".vbd-action-link.vbd-askdelete-vbd_upload_group", function (e) {

e.preventDefault();
item_id_delete_vbd_upload_group=null;
var data_vbd_upload_group="vbd_method=readcontrol&vbd_key="+vbdGetKey()+"&upg_id="+$(this).data('item-id');


var xhrVBD= new XMLHttpRequest();
xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_upload_group/",true);
xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


xhrVBD.onreadystatechange= function () {
if(xhrVBD.readyState===4 && xhrVBD.status===200){

delete_load_vbd_upload_group( xhrVBD.responseText)

}
if(xhrVBD.readyState<4){

}
};

xhrVBD.send(data_vbd_upload_group);

});




// Open modal if data exist
function delete_load_vbd_upload_group( thisvbd ){

try {


var json_vbd_upload_group=JSON.parse(thisvbd);
//start of submission check
if(json_vbd_upload_group['response']['state']===1 && json_vbd_upload_group['response']['result']['rows']>0){

$('.vbuilder-delete-vbd_upload_group-holder').text("");
$('#vbd_upload_group-modal-delete').modal('show');

//vbToast('success','Vb Upload Group successfully loaded!');

var jsonVOB= JSON.parse(json_vbd_upload_group['response']['result']['data-json'][0]);

$('.vbuilder-delete-vbd_upload_group-holder').text( jsonVOB['upg_id'] );
item_id_delete_vbd_upload_group=jsonVOB['upg_id'];

}
else
{
// checking for the errors
if(json_vbd_upload_group['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_vbd_upload_group['rq_fields']['missing']['count'] != undefined && json_vbd_upload_group['rq_fields']['missing']['count']!==0){
vbToast('warning','Missing request data');
} else if( json_vbd_upload_group['validate']['state'] != undefined && json_vbd_upload_group['validate']['state']===false){
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

$(document).on('click', ".vbd-action-link.vbd-delete-vbd_upload_group", function (e) {
e.preventDefault();


var data_vbd_upload_group="vbd_method=delete&vbd_key="+vbdGetKey()+"&upg_id="+item_id_delete_vbd_upload_group;


var xhrVBD= new XMLHttpRequest();
xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_upload_group/",true);
xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


xhrVBD.onreadystatechange= function () {
if(xhrVBD.readyState===4 && xhrVBD.status===200){

delete_execute_vbd_upload_group( xhrVBD.responseText)

}
if(xhrVBD.readyState<4){

}
};

xhrVBD.send(data_vbd_upload_group);

});


function delete_execute_vbd_upload_group( thisvbd){

try {



var json_vbd_upload_group=JSON.parse(thisvbd);

//start of submission check
if(json_vbd_upload_group['response']['state']===1){

item_id_update_vbd_upload_group=null;

if( json_vbd_upload_group['response']['result']['affected'] != undefined && json_vbd_upload_group['response']['result']['affected']>0){
vbToast('success','Vb Upload Group deleted');
// load the list
reload_vbd_upload_group();

} else {
vbToast('success','None change applied');
}


}
else
{
// checking for the errors
if(json_vbd_upload_group['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_vbd_upload_group['rq_fields']['missing']['count'] != undefined && json_vbd_upload_group['rq_fields']['missing']['count']!==0){
vbToast('warning','Missing request data');
} else if( json_vbd_upload_group['validate']['state'] != undefined && json_vbd_upload_group['validate']['state']===false){
vbToast('warning','Wrong request data');
}else{
vbToast('warning','Error deleting Vb Upload Group');
}

}
//end of submission check


} catch (e) {

vbToast('error','An error have occured during the request.');
console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
}

}



