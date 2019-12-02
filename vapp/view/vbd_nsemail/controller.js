/*<br/>
* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/ <br/>
* Author: Vayile Fumo<br/>
* Date: 27/10/2019, Sunday<br/>
* Time: 11:05 AM<br/>
* Project/Module: Newsletter Email<br/>*/

$(window).ready(function() {
// load the list
reload_vbd_nsemail();
});

function reload_vbd_nsemail() {


var data_vbd_nsemail="vbd_method=read&vbd_key="+vbdGetKey();


var url= VBUILDER_APP_ROOT+"/api/global/vbd_nsemail/";
var content_vbd_nsemail="none-v";

var xhr_vbd_nsemail= new XMLHttpRequest();
xhr_vbd_nsemail.open('POST',url,true);
xhr_vbd_nsemail.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr_vbd_nsemail.onreadystatechange= function () {

if(xhr_vbd_nsemail.readyState===4 && xhr_vbd_nsemail.status===200){

content_vbd_nsemail=xhr_vbd_nsemail.responseText;
// alert(content_vbd_nsemail);
try {

var json_vbd_nsemail=JSON.parse(content_vbd_nsemail);

//start of submission check
if(json_vbd_nsemail['response']['state']===1){
$('#vbd_nsemail-vbd-add-form').trigger("reset");
$('#vbd_nsemail-modal-add').modal('hide');
//vbToast('success','Records successfully loaded!');

$("#vbd_nsemail-table-list tbody").html("");

if(json_vbd_nsemail['response']['result']['rows']>0){

for ( var ix = 0; ix < json_vbd_nsemail['response']['result']['data-json'].length; ix++) {

var jsonVOB= JSON.parse(json_vbd_nsemail['response']['result']['data-json'][ix]);

$("#vbd_nsemail-table-list tbody").append('<tr>'+ '<td>'+ jsonVOB['nsemail_id'] +'  </td>' + '<td>'+ jsonVOB['nsemail_name'] +'  </td>' + '<td>'+ jsonVOB['nsemail_email'] +'  </td>' + '<td>'+ jsonVOB['nsemail_date'] +'  </td>' +  '<td class="vbd-actions-td">'+
        // '<a href="javascript:;"  data-item-id'+'="'+jsonVOB['nsemail_id']+'" class="vbd-action-link vbd-update-vbd_nsemail" > <span class="fa fa-edit"></span> </a>'+
       '<a href="javascript:;" data-item-id'+'="'+jsonVOB['nsemail_id']+'" class="vbd-action-link vbd-view-vbd_nsemail ml-1" > <span class="fa fa-info-circle"></span> </a>'+
       '<a href="javascript:;"  data-item-id'+'="'+jsonVOB['nsemail_id']+'" class="vbd-action-link vbd-askdelete-vbd_nsemail ml-1" >'+
           ' <span class="fa fa-trash"></span>'+
        '</a> </td> </tr>');
}

}


}
else
{
// checking for the errors
if(json_vbd_nsemail['response']['state']===1920){

vbToast('warning','Please login. Error loading data');

} else if( json_vbd_nsemail['rq_fields']['missing']['count'] != undefined && json_vbd_nsemail['rq_fields']['missing']['count']!==0){
vbToast('warning','Error loading data. Missing');
} else if( json_vbd_nsemail['validate']['state'] != undefined && json_vbd_nsemail['validate']['state']===false){
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

console.log("vbuilder-submition-process",'Loading vbd_nsemail list data');

}
};
xhr_vbd_nsemail.send(data_vbd_nsemail);



}



 /*
* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Author: Vayile Fumo
* Date: 27/10/2019, Sunday
* Time: 11:05 AM
* Project/Module: Newsletter Email*/

$('form[name=vbd_nsemail-vbd-add-form]').on('submit', function(e) {

//uncomment the prevent bellow case an error appear, for debug
//e.preventDefault();
var this_fvalidate=true;

var thisForm=$(this);

if(this_fvalidate){
vbdDisableSubmit(thisForm);
this_fvalidate=false;

var data_preset_vbd_nsemail="vbd_method=add&vbd_key="+vbdGetKey();
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
try {



var json_vbd_nsemail=JSON.parse(content_vbd_nsemail);
//start of submission check
if(json_vbd_nsemail['response']['state']===1){

// load the list
reload_vbd_nsemail();

$('form[name=vbd_nsemail-vbd-add-form]').trigger("reset");
$('#vbd_nsemail-modal-add').modal('hide');
vbToast('success','Newsletter Email successfully added');
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
vbToast('warning','Error. Duplicate entry');
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



} else{

vbToast('warning','Please fill all required fields');

}

return false;

});

 /*
* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Author: Vayile Fumo
* Date: 27/10/2019, Sunday
* Time: 11:05 AM
* Project/Module: Newsletter Email*/

var item_id_update_vbd_nsemail=null;

$(document).on('click', ".vbd-update-vbd_nsemail", function (e) {

e.preventDefault();

item_id_update_vbd_nsemail=null;
$('form[name=vbd_nsemail-vbd-update-form]').trigger("reset");




var data_vbd_nsemail="vbd_method=readcontrol&vbd_key="+vbdGetKey()+"&nsemail_id="+$(this).data('item-id');


var xhrVBD= new XMLHttpRequest();
xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_nsemail/",true);
xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


xhrVBD.onreadystatechange= function () {
if(xhrVBD.readyState===4 && xhrVBD.status===200){

update_load_vbd_nsemail( xhrVBD.responseText);

}
if(xhrVBD.readyState<4){

}
};

xhrVBD.send(data_vbd_nsemail);

});



function update_load_vbd_nsemail( thisvbd){

try {


var json_vbd_nsemail=JSON.parse(thisvbd);
//start of submission check
if(json_vbd_nsemail['response']['state']===1){

$('form[name=vbd_nsemail-vbd-update-form]').trigger("reset");

//vbToast('success','Newsletter Email successfully loaded!');

var jsonVOB= JSON.parse(json_vbd_nsemail['response']['result']['data-json'][0]);
item_id_update_vbd_nsemail=jsonVOB['nsemail_id'];

        $('form[name=vbd_nsemail-vbd-update-form] input[name=nsemail_name]').val( jsonVOB['nsemail_name'] );
        $('form[name=vbd_nsemail-vbd-update-form] input[name=nsemail_email]').val( jsonVOB['nsemail_email'] );
        $('form[name=vbd_nsemail-vbd-update-form] input[name=nsemail_date]').val( jsonVOB['nsemail_date'] );


$('#vbd_nsemail-modal-update').modal('show');

}
else
{
// checking for the errors
if(json_vbd_nsemail['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_vbd_nsemail['rq_fields']['missing']['count'] != undefined && json_vbd_nsemail['rq_fields']['missing']['count']!==0){
vbToast('warning','Missing request data');
} else if( json_vbd_nsemail['validate']['state'] != undefined && json_vbd_nsemail['validate']['state']===false){
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



$('form[name=vbd_nsemail-vbd-update-form]').on('submit', function(e) {

//uncomment the prevent bellow case an error appear, for debug
//e.preventDefault();
var this_fvalidate=true;

var thisForm=$(this);

if(this_fvalidate){
vbdDisableSubmit(thisForm);
this_fvalidate=false;

var data_preset_vbd_nsemail="vbd_method=update&vbd_key="+vbdGetKey()+"&nsemail_id="+item_id_update_vbd_nsemail;
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
try {


var json_vbd_nsemail=JSON.parse(content_vbd_nsemail);
//start of submission check
if(json_vbd_nsemail['response']['state']===1){
item_id_update_vbd_nsemail=null;

$('form[name=vbd_nsemail-vbd-update-form]').trigger("reset");
$('#vbd_nsemail-modal-update').modal('hide');

if( json_vbd_nsemail['response']['result']['affected'] != undefined && json_vbd_nsemail['response']['result']['affected']>0){
vbToast('success','Newsletter Email updated');
// load the list
reload_vbd_nsemail();

} else {
vbToast('success','None change applied');
}

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
vbToast('warning','Error. Duplicate entry');
} else{
vbToast('warning','Error updating Newsletter Email');
}

}
//end of submission check

} catch (e) {

vbToast('error','An error have occured during the request.');
console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
}
} else{

console.log("vbuilder-vbd_nsemail-submition-process",'Loading vbd_nsemail-vbd-update-form');

}
};
xhr_vbd_nsemail.send(data_vbd_nsemail);



} else{

vbToast('warning','Please fill all required fields');

}
return false;

});

 
/*<br/>
* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/ <br/>
* Author: Vayile Fumo<br/>
* Date: 27/10/2019, Sunday<br/>
* Time: 11:05 AM<br/>
* Project/Module: Newsletter Email<br/>*/


$(document).on('click', ".vbd-view-vbd_nsemail", function (e) {

e.preventDefault();

var data_vbd_nsemail="vbd_method=readcontrol&vbd_key="+vbdGetKey()+"&nsemail_id="+$(this).data('item-id');


var xhrVBD= new XMLHttpRequest();
xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_nsemail/",true);
xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


xhrVBD.onreadystatechange= function () {
if(xhrVBD.readyState===4 && xhrVBD.status===200){

view_load_vbd_nsemail( xhrVBD.responseText)

}
if(xhrVBD.readyState<4){

}
};

xhrVBD.send(data_vbd_nsemail);

});



function view_load_vbd_nsemail( thisvbd){

try {


var json_vbd_nsemail=JSON.parse(thisvbd);
//start of submission check
if(json_vbd_nsemail['response']['state']===1 && json_vbd_nsemail['response']['result']['rows']>0){

$('#vbd_nsemail-item-view .vbd_nsemail-holder').text("");
$('#vbd_nsemail-modal-view').modal('show');

//vbToast('success','Record Successfully loaded!');

var jsonVOB= JSON.parse(json_vbd_nsemail['response']['result']['data-json'][0]);

        $('#vbd_nsemail-item-view .nsemail_name.vbd_nsemail-holder').text( jsonVOB['nsemail_name'] );
                $('#vbd_nsemail-item-view .nsemail_email.vbd_nsemail-holder').text( jsonVOB['nsemail_email'] );
                $('#vbd_nsemail-item-view .nsemail_date.vbd_nsemail-holder').text( jsonVOB['nsemail_date'] );
        

$('#vbd_nsemail-modal-view').modal('show');

}
else
{
// checking for the errors
if(json_vbd_nsemail['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_vbd_nsemail['rq_fields']['missing']['count'] != undefined && json_vbd_nsemail['rq_fields']['missing']['count']!==0){
vbToast('warning','Missing request data');
} else if( json_vbd_nsemail['validate']['state'] != undefined && json_vbd_nsemail['validate']['state']===false){
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
* Time: 11:05 AM
* Project/Module: Newsletter Email*/


var item_id_delete_vbd_nsemail=null;

$(document).on('click', ".vbd-action-link.vbd-askdelete-vbd_nsemail", function (e) {

e.preventDefault();
item_id_delete_vbd_nsemail=null;
var data_vbd_nsemail="vbd_method=readcontrol&vbd_key="+vbdGetKey()+"&nsemail_id="+$(this).data('item-id');


var xhrVBD= new XMLHttpRequest();
xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_nsemail/",true);
xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


xhrVBD.onreadystatechange= function () {
if(xhrVBD.readyState===4 && xhrVBD.status===200){

delete_load_vbd_nsemail( xhrVBD.responseText)

}
if(xhrVBD.readyState<4){

}
};

xhrVBD.send(data_vbd_nsemail);

});




// Open modal if data exist
function delete_load_vbd_nsemail( thisvbd ){

try {


var json_vbd_nsemail=JSON.parse(thisvbd);
//start of submission check
if(json_vbd_nsemail['response']['state']===1 && json_vbd_nsemail['response']['result']['rows']>0){

$('.vbuilder-delete-vbd_nsemail-holder').text("");
$('#vbd_nsemail-modal-delete').modal('show');

//vbToast('success','Newsletter Email successfully loaded!');

var jsonVOB= JSON.parse(json_vbd_nsemail['response']['result']['data-json'][0]);

$('.vbuilder-delete-vbd_nsemail-holder').text( jsonVOB['nsemail_email'] );
item_id_delete_vbd_nsemail=jsonVOB['nsemail_id'];

}
else
{
// checking for the errors
if(json_vbd_nsemail['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_vbd_nsemail['rq_fields']['missing']['count'] != undefined && json_vbd_nsemail['rq_fields']['missing']['count']!==0){
vbToast('warning','Missing request data');
} else if( json_vbd_nsemail['validate']['state'] != undefined && json_vbd_nsemail['validate']['state']===false){
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

$(document).on('click', ".vbd-action-link.vbd-delete-vbd_nsemail", function (e) {
e.preventDefault();


var data_vbd_nsemail="vbd_method=delete&vbd_key="+vbdGetKey()+"&nsemail_id="+item_id_delete_vbd_nsemail;


var xhrVBD= new XMLHttpRequest();
xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_nsemail/",true);
xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


xhrVBD.onreadystatechange= function () {
if(xhrVBD.readyState===4 && xhrVBD.status===200){

delete_execute_vbd_nsemail( xhrVBD.responseText)

}
if(xhrVBD.readyState<4){

}
};

xhrVBD.send(data_vbd_nsemail);

});


function delete_execute_vbd_nsemail( thisvbd){

try {



var json_vbd_nsemail=JSON.parse(thisvbd);

//start of submission check
if(json_vbd_nsemail['response']['state']===1){

item_id_update_vbd_nsemail=null;

if( json_vbd_nsemail['response']['result']['affected'] != undefined && json_vbd_nsemail['response']['result']['affected']>0){
vbToast('success','Newsletter Email deleted');
// load the list
reload_vbd_nsemail();

} else {
vbToast('success','None change applied');
}


}
else
{
// checking for the errors
if(json_vbd_nsemail['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_vbd_nsemail['rq_fields']['missing']['count'] != undefined && json_vbd_nsemail['rq_fields']['missing']['count']!==0){
vbToast('warning','Missing request data');
} else if( json_vbd_nsemail['validate']['state'] != undefined && json_vbd_nsemail['validate']['state']===false){
vbToast('warning','Wrong request data');
}else{
vbToast('warning','Error deleting Newsletter Email');
}

}
//end of submission check


} catch (e) {

vbToast('error','An error have occured during the request.');
console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
}

}



