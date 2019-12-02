/*<br/>
* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/ <br/>
* Author: Vayile Fumo<br/>
* Date: 27/10/2019, Sunday<br/>
* Time: 12:43 PM<br/>
* Project/Module: Newsletter Message<br/>*/

$(window).ready(function() {
// load the list
reload_vbd_ns_mail();
});



function reload_vbd_ns_mail() {


var data_vbd_ns_mail="vbd_method=read-complete&vbd_key="+vbdGetKey();


var url= VBUILDER_APP_ROOT+"/api/global/vbd_ns_mail/";
var content_vbd_ns_mail="none-v";

var xhr_vbd_ns_mail= new XMLHttpRequest();
xhr_vbd_ns_mail.open('POST',url,true);
xhr_vbd_ns_mail.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr_vbd_ns_mail.onreadystatechange= function () {

if(xhr_vbd_ns_mail.readyState===4 && xhr_vbd_ns_mail.status===200){

content_vbd_ns_mail=xhr_vbd_ns_mail.responseText;

try {

var json_vbd_ns_mail=JSON.parse(content_vbd_ns_mail);

//start of submission check
if(json_vbd_ns_mail['response']['state']===1){
$('#vbd_ns_mail-vbd-add-form').trigger("reset");
$('#vbd_ns_mail-modal-add').modal('hide');
//vbToast('success','Records successfully loaded!');

$("#vbd_ns_mail-table-list tbody").html("");

if(json_vbd_ns_mail['response']['result']['rows']>0){

for ( var ix = 0; ix < json_vbd_ns_mail['response']['result']['data-json'].length; ix++) {

var jsonVOB= JSON.parse(json_vbd_ns_mail['response']['result']['data-json'][ix]);

$("#vbd_ns_mail-table-list tbody").append('<tr>'+ '<td>'+ jsonVOB['ns_id'] +'. '+jsonVOB['ns_subject']+'  </td>'+ '<td>'+ jsonVOB['nsemail_email'] +'  </td>'  + '<td>'+ jsonVOB['nsmail_date'] +'  </td>' + '<td class="'+((jsonVOB['ns_state']=='true')? 'bg-success' : 'bg-danger')+'">' +'  </td>' +  '<td class="vbd-actions-td">'+
        '<a href="javascript:;"  data-item-id'+'="'+jsonVOB['nsmail_id']+'" class="vbd-action-link vbd-update-vbd_ns_mail" > <span class="fa fa-edit"></span> </a>'+
       '<a href="javascript:;" data-item-id'+'="'+jsonVOB['nsmail_id']+'" class="vbd-action-link vbd-view-vbd_ns_mail ml-1" > <span class="fa fa-info-circle"></span> </a>'+
       '<a href="javascript:;"  data-item-id'+'="'+jsonVOB['nsmail_id']+'" class="vbd-action-link vbd-askdelete-vbd_ns_mail ml-1" >'+
           ' <span class="fa fa-trash"></span>'+
        '</a> </td> </tr>');
}

}


}
else
{
// checking for the errors
if(json_vbd_ns_mail['response']['state']===1920){

vbToast('warning','Please login. Error loading data');

} else if( json_vbd_ns_mail['rq_fields']['missing']['count'] != undefined && json_vbd_ns_mail['rq_fields']['missing']['count']!==0){
vbToast('warning','Error loading data. Missing');
} else if( json_vbd_ns_mail['validate']['state'] != undefined && json_vbd_ns_mail['validate']['state']===false){
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

console.log("vbuilder-submition-process",'Loading vbd_ns_mail list data');

}
};
xhr_vbd_ns_mail.send(data_vbd_ns_mail);



}



function reload_vbd_ns_mailOld() {


var data_vbd_ns_mail="vbd_method=read&vbd_key="+vbdGetKey();


var url= VBUILDER_APP_ROOT+"/api/global/vbd_ns_mail/";
var content_vbd_ns_mail="none-v";

var xhr_vbd_ns_mail= new XMLHttpRequest();
xhr_vbd_ns_mail.open('POST',url,true);
xhr_vbd_ns_mail.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr_vbd_ns_mail.onreadystatechange= function () {

if(xhr_vbd_ns_mail.readyState===4 && xhr_vbd_ns_mail.status===200){

content_vbd_ns_mail=xhr_vbd_ns_mail.responseText;

try {

var json_vbd_ns_mail=JSON.parse(content_vbd_ns_mail);

//start of submission check
if(json_vbd_ns_mail['response']['state']===1){
$('#vbd_ns_mail-vbd-add-form').trigger("reset");
$('#vbd_ns_mail-modal-add').modal('hide');
//vbToast('success','Records successfully loaded!');

$("#vbd_ns_mail-table-list tbody").html("");

if(json_vbd_ns_mail['response']['result']['rows']>0){

for ( var ix = 0; ix < json_vbd_ns_mail['response']['result']['data-json'].length; ix++) {

var jsonVOB= JSON.parse(json_vbd_ns_mail['response']['result']['data-json'][ix]);

$("#vbd_ns_mail-table-list tbody").append('<tr>'+ '<td>'+ jsonVOB['nsmail_id'] +'  </td>' + '<td>'+ jsonVOB['nsmail_date'] +'  </td>' + '<td>'+ jsonVOB['ns_id'] +'  </td>' + '<td>'+ jsonVOB['nsemail_id'] +'  </td>' + '<td>'+ jsonVOB['ns_state'] +'  </td>' +  '<td class="vbd-actions-td">'+
        '<a href="javascript:;"  data-item-id'+'="'+jsonVOB['nsmail_id']+'" class="vbd-action-link vbd-update-vbd_ns_mail" > <span class="fa fa-edit"></span> </a>'+
       '<a href="javascript:;" data-item-id'+'="'+jsonVOB['nsmail_id']+'" class="vbd-action-link vbd-view-vbd_ns_mail ml-1" > <span class="fa fa-info-circle"></span> </a>'+
       '<a href="javascript:;"  data-item-id'+'="'+jsonVOB['nsmail_id']+'" class="vbd-action-link vbd-askdelete-vbd_ns_mail ml-1" >'+
           ' <span class="fa fa-trash"></span>'+
        '</a> </td> </tr>');
}

}


}
else
{
// checking for the errors
if(json_vbd_ns_mail['response']['state']===1920){

vbToast('warning','Please login. Error loading data');

} else if( json_vbd_ns_mail['rq_fields']['missing']['count'] != undefined && json_vbd_ns_mail['rq_fields']['missing']['count']!==0){
vbToast('warning','Error loading data. Missing');
} else if( json_vbd_ns_mail['validate']['state'] != undefined && json_vbd_ns_mail['validate']['state']===false){
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

console.log("vbuilder-submition-process",'Loading vbd_ns_mail list data');

}
};
xhr_vbd_ns_mail.send(data_vbd_ns_mail);



}



 /*
* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Author: Vayile Fumo
* Date: 27/10/2019, Sunday
* Time: 12:43 PM
* Project/Module: Newsletter Message*/

$('form[name=vbd_ns_mail-vbd-add-form]').on('submit', function(e) {

//uncomment the prevent bellow case an error appear, for debug
//e.preventDefault();
var this_fvalidate=true;

var thisForm=$(this);

if(this_fvalidate){
vbdDisableSubmit(thisForm);
this_fvalidate=false;

var data_preset_vbd_ns_mail="vbd_method=add&vbd_key="+vbdGetKey();
var data_vbd_ns_mail=data_preset_vbd_ns_mail+'&'+$(this).serialize();


var url= VBUILDER_APP_ROOT+"/api/global/vbd_ns_mail/";
var content_vbd_ns_mail="none-v";

var xhr_vbd_ns_mail= new XMLHttpRequest();
xhr_vbd_ns_mail.open('POST',url,true);
xhr_vbd_ns_mail.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr_vbd_ns_mail.onreadystatechange= function () {

if(xhr_vbd_ns_mail.readyState===4){
vbdEnableSubmit(thisForm);
this_fvalidate=true;
} else{
vbdDisableSubmit(thisForm);
this_fvalidate=false;
}

if(xhr_vbd_ns_mail.readyState===4 && xhr_vbd_ns_mail.status===200){
content_vbd_ns_mail=xhr_vbd_ns_mail.responseText;
try {



var json_vbd_ns_mail=JSON.parse(content_vbd_ns_mail);
//start of submission check
if(json_vbd_ns_mail['response']['state']===1){

// load the list
reload_vbd_ns_mail();

$('form[name=vbd_ns_mail-vbd-add-form]').trigger("reset");
$('#vbd_ns_mail-modal-add').modal('hide');
vbToast('success','Newsletter Message successfully added');
}
else
{
// checking for the errors
if(json_vbd_ns_mail['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_vbd_ns_mail['rq_fields']['missing']['count'] != undefined && json_vbd_ns_mail['rq_fields']['missing']['count']!==0){
vbToast('warning','Please fill all required fields');
} else if( json_vbd_ns_mail['validate']['state'] != undefined && json_vbd_ns_mail['validate']['state']===false){
vbToast('warning','Fill the fields correctly');
} else if( json_vbd_ns_mail['response']['result']['error'][1] != undefined && json_vbd_ns_mail['response']['result']['error'][1]===1062){
vbToast('warning','Error. Duplicate entry');
} else{
vbToast('warning','Error adding Newsletter Message');
}

}
//end of submission check
} catch (e) {

vbToast('error','An error have occured during the request.');
console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
}
} else{

console.log("vbuilder-vbd_ns_mail-submition-process",'Loading vbd_ns_mail-vbd-add-form');

}
};
xhr_vbd_ns_mail.send(data_vbd_ns_mail);



} else{

vbToast('warning','Please fill all required fields');

}

return false;

});

 /*
* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Author: Vayile Fumo
* Date: 27/10/2019, Sunday
* Time: 12:43 PM
* Project/Module: Newsletter Message*/

var item_id_update_vbd_ns_mail=null;

$(document).on('click', ".vbd-update-vbd_ns_mail", function (e) {

e.preventDefault();

item_id_update_vbd_ns_mail=null;
$('form[name=vbd_ns_mail-vbd-update-form]').trigger("reset");




var data_vbd_ns_mail="vbd_method=readcontrol&vbd_key="+vbdGetKey()+"&nsmail_id="+$(this).data('item-id');


var xhrVBD= new XMLHttpRequest();
xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_ns_mail/",true);
xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


xhrVBD.onreadystatechange= function () {
if(xhrVBD.readyState===4 && xhrVBD.status===200){

update_load_vbd_ns_mail( xhrVBD.responseText);

}
if(xhrVBD.readyState<4){

}
};

xhrVBD.send(data_vbd_ns_mail);

});



function update_load_vbd_ns_mail( thisvbd){

try {


var json_vbd_ns_mail=JSON.parse(thisvbd);
//start of submission check
if(json_vbd_ns_mail['response']['state']===1){

$('form[name=vbd_ns_mail-vbd-update-form]').trigger("reset");

//vbToast('success','Newsletter Message successfully loaded!');

var jsonVOB= JSON.parse(json_vbd_ns_mail['response']['result']['data-json'][0]);
item_id_update_vbd_ns_mail=jsonVOB['nsmail_id'];

        $('form[name=vbd_ns_mail-vbd-update-form] input[name=nsmail_date]').val( jsonVOB['nsmail_date'] );
        $('form[name=vbd_ns_mail-vbd-update-form] input[name=ns_id]').val( jsonVOB['ns_id'] );
        $('form[name=vbd_ns_mail-vbd-update-form] input[name=nsemail_id]').val( jsonVOB['nsemail_id'] );
        $('form[name=vbd_ns_mail-vbd-update-form] input[name=ns_state]').val( jsonVOB['ns_state'] );


$('#vbd_ns_mail-modal-update').modal('show');

}
else
{
// checking for the errors
if(json_vbd_ns_mail['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_vbd_ns_mail['rq_fields']['missing']['count'] != undefined && json_vbd_ns_mail['rq_fields']['missing']['count']!==0){
vbToast('warning','Missing request data');
} else if( json_vbd_ns_mail['validate']['state'] != undefined && json_vbd_ns_mail['validate']['state']===false){
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



$('form[name=vbd_ns_mail-vbd-update-form]').on('submit', function(e) {

//uncomment the prevent bellow case an error appear, for debug
//e.preventDefault();
var this_fvalidate=true;

var thisForm=$(this);

if(this_fvalidate){
vbdDisableSubmit(thisForm);
this_fvalidate=false;

var data_preset_vbd_ns_mail="vbd_method=update&vbd_key="+vbdGetKey()+"&nsmail_id="+item_id_update_vbd_ns_mail;
var data_vbd_ns_mail=data_preset_vbd_ns_mail+'&'+$(this).serialize();


var url= VBUILDER_APP_ROOT+"/api/global/vbd_ns_mail/";
var content_vbd_ns_mail="none-v";

var xhr_vbd_ns_mail= new XMLHttpRequest();
xhr_vbd_ns_mail.open('POST',url,true);
xhr_vbd_ns_mail.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr_vbd_ns_mail.onreadystatechange= function () {


if(xhr_vbd_ns_mail.readyState===4){
vbdEnableSubmit(thisForm);
this_fvalidate=true;
} else{
vbdDisableSubmit(thisForm);
this_fvalidate=false;
}


if(xhr_vbd_ns_mail.readyState===4 && xhr_vbd_ns_mail.status===200){
content_vbd_ns_mail=xhr_vbd_ns_mail.responseText;
try {


var json_vbd_ns_mail=JSON.parse(content_vbd_ns_mail);
//start of submission check
if(json_vbd_ns_mail['response']['state']===1){
item_id_update_vbd_ns_mail=null;

$('form[name=vbd_ns_mail-vbd-update-form]').trigger("reset");
$('#vbd_ns_mail-modal-update').modal('hide');

if( json_vbd_ns_mail['response']['result']['affected'] != undefined && json_vbd_ns_mail['response']['result']['affected']>0){
vbToast('success','Newsletter Message updated');
// load the list
reload_vbd_ns_mail();

} else {
vbToast('success','None change applied');
}

}
else
{
// checking for the errors
if(json_vbd_ns_mail['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_vbd_ns_mail['rq_fields']['missing']['count'] != undefined && json_vbd_ns_mail['rq_fields']['missing']['count']!==0){
vbToast('warning','Please fill all required fields');
} else if( json_vbd_ns_mail['validate']['state'] != undefined && json_vbd_ns_mail['validate']['state']===false){
vbToast('warning','Fill the fields correctly');
} else if( json_vbd_ns_mail['response']['result']['error'][1] != undefined && json_vbd_ns_mail['response']['result']['error'][1]===1062){
vbToast('warning','Error. Duplicate entry');
} else{
vbToast('warning','Error updating Newsletter Message');
}

}
//end of submission check

} catch (e) {

vbToast('error','An error have occured during the request.');
console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
}
} else{

console.log("vbuilder-vbd_ns_mail-submition-process",'Loading vbd_ns_mail-vbd-update-form');

}
};
xhr_vbd_ns_mail.send(data_vbd_ns_mail);



} else{

vbToast('warning','Please fill all required fields');

}
return false;

});

 
/*<br/>
* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/ <br/>
* Author: Vayile Fumo<br/>
* Date: 27/10/2019, Sunday<br/>
* Time: 12:43 PM<br/>
* Project/Module: Newsletter Message<br/>*/


$(document).on('click', ".vbd-view-vbd_ns_mail", function (e) {

e.preventDefault();

var data_vbd_ns_mail="vbd_method=readcontrol&vbd_key="+vbdGetKey()+"&nsmail_id="+$(this).data('item-id');


var xhrVBD= new XMLHttpRequest();
xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_ns_mail/",true);
xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


xhrVBD.onreadystatechange= function () {
if(xhrVBD.readyState===4 && xhrVBD.status===200){

view_load_vbd_ns_mail( xhrVBD.responseText)

}
if(xhrVBD.readyState<4){

}
};

xhrVBD.send(data_vbd_ns_mail);

});



function view_load_vbd_ns_mail( thisvbd){

try {


var json_vbd_ns_mail=JSON.parse(thisvbd);
//start of submission check
if(json_vbd_ns_mail['response']['state']===1 && json_vbd_ns_mail['response']['result']['rows']>0){

$('#vbd_ns_mail-item-view .vbd_ns_mail-holder').text("");
$('#vbd_ns_mail-modal-view').modal('show');

//vbToast('success','Record Successfully loaded!');

var jsonVOB= JSON.parse(json_vbd_ns_mail['response']['result']['data-json'][0]);

        $('#vbd_ns_mail-item-view .nsmail_date.vbd_ns_mail-holder').text( jsonVOB['nsmail_date'] );
                $('#vbd_ns_mail-item-view .ns_id.vbd_ns_mail-holder').text( jsonVOB['ns_id'] );
                $('#vbd_ns_mail-item-view .nsemail_id.vbd_ns_mail-holder').text( jsonVOB['nsemail_id'] );
                $('#vbd_ns_mail-item-view .ns_state.vbd_ns_mail-holder').text( jsonVOB['ns_state'] );
        

$('#vbd_ns_mail-modal-view').modal('show');

}
else
{
// checking for the errors
if(json_vbd_ns_mail['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_vbd_ns_mail['rq_fields']['missing']['count'] != undefined && json_vbd_ns_mail['rq_fields']['missing']['count']!==0){
vbToast('warning','Missing request data');
} else if( json_vbd_ns_mail['validate']['state'] != undefined && json_vbd_ns_mail['validate']['state']===false){
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
* Date: 27/10/2019, Sunday
* Time: 12:43 PM
* Project/Module: Newsletter Message*/


var item_id_delete_vbd_ns_mail=null;

$(document).on('click', ".vbd-action-link.vbd-askdelete-vbd_ns_mail", function (e) {

e.preventDefault();
item_id_delete_vbd_ns_mail=null;
var data_vbd_ns_mail="vbd_method=readcontrol&vbd_key="+vbdGetKey()+"&nsmail_id="+$(this).data('item-id');


var xhrVBD= new XMLHttpRequest();
xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_ns_mail/",true);
xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


xhrVBD.onreadystatechange= function () {
if(xhrVBD.readyState===4 && xhrVBD.status===200){

delete_load_vbd_ns_mail( xhrVBD.responseText)

}
if(xhrVBD.readyState<4){

}
};

xhrVBD.send(data_vbd_ns_mail);

});




// Open modal if data exist
function delete_load_vbd_ns_mail( thisvbd ){

try {


var json_vbd_ns_mail=JSON.parse(thisvbd);
//start of submission check
if(json_vbd_ns_mail['response']['state']===1 && json_vbd_ns_mail['response']['result']['rows']>0){

$('.vbuilder-delete-vbd_ns_mail-holder').text("");
$('#vbd_ns_mail-modal-delete').modal('show');

//vbToast('success','Newsletter Message successfully loaded!');

var jsonVOB= JSON.parse(json_vbd_ns_mail['response']['result']['data-json'][0]);

$('.vbuilder-delete-vbd_ns_mail-holder').text( jsonVOB['nsmail_id'] );
item_id_delete_vbd_ns_mail=jsonVOB['nsmail_id'];

}
else
{
// checking for the errors
if(json_vbd_ns_mail['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_vbd_ns_mail['rq_fields']['missing']['count'] != undefined && json_vbd_ns_mail['rq_fields']['missing']['count']!==0){
vbToast('warning','Missing request data');
} else if( json_vbd_ns_mail['validate']['state'] != undefined && json_vbd_ns_mail['validate']['state']===false){
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

$(document).on('click', ".vbd-action-link.vbd-delete-vbd_ns_mail", function (e) {
e.preventDefault();


var data_vbd_ns_mail="vbd_method=delete&vbd_key="+vbdGetKey()+"&nsmail_id="+item_id_delete_vbd_ns_mail;


var xhrVBD= new XMLHttpRequest();
xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_ns_mail/",true);
xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


xhrVBD.onreadystatechange= function () {
if(xhrVBD.readyState===4 && xhrVBD.status===200){

delete_execute_vbd_ns_mail( xhrVBD.responseText)

}
if(xhrVBD.readyState<4){

}
};

xhrVBD.send(data_vbd_ns_mail);

});


function delete_execute_vbd_ns_mail( thisvbd){

try {



var json_vbd_ns_mail=JSON.parse(thisvbd);

//start of submission check
if(json_vbd_ns_mail['response']['state']===1){

item_id_update_vbd_ns_mail=null;

if( json_vbd_ns_mail['response']['result']['affected'] != undefined && json_vbd_ns_mail['response']['result']['affected']>0){
vbToast('success','Newsletter Message deleted');
// load the list
reload_vbd_ns_mail();

} else {
vbToast('success','None change applied');
}


}
else
{
// checking for the errors
if(json_vbd_ns_mail['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_vbd_ns_mail['rq_fields']['missing']['count'] != undefined && json_vbd_ns_mail['rq_fields']['missing']['count']!==0){
vbToast('warning','Missing request data');
} else if( json_vbd_ns_mail['validate']['state'] != undefined && json_vbd_ns_mail['validate']['state']===false){
vbToast('warning','Wrong request data');
}else{
vbToast('warning','Error deleting Newsletter Message');
}

}
//end of submission check


} catch (e) {

vbToast('error','An error have occured during the request.');
console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
}

}



