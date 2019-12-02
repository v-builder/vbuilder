/*<br/>
* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/ <br/>
* Author: Vayile Fumo<br/>
* Date: 11/09/2019, Wednesday<br/>
* Time: 01:01 PM<br/>
* Project/Module: Account Type<br/>*/

$(window).ready(function() {
// load the list
reload_vbd_at();
});

function reload_vbd_at() {


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
$('#vbd_at-vbd-add-form').trigger("reset");
$('#vbd_at-modal-add').modal('hide');
//vbToast('success','Records successfully loaded!');

$("#vbd_at-table-list tbody").html("");

if(json_vbd_at['response']['result']['rows']>0){

for ( var ix = 0; ix < json_vbd_at['response']['result']['data-json'].length; ix++) {

var jsonVOB= JSON.parse(json_vbd_at['response']['result']['data-json'][ix]);

$("#vbd_at-table-list tbody").append('<tr>'+ '<td>'+ jsonVOB['vbd_at_id'] +'  </td>' + '<td>'+ jsonVOB['vbd_at_type'] +'  </td>' + '<td>'+ jsonVOB['vbd_at_desc'] +'  </td>' +  '<td class="vbd-actions-td">'+
        '<a href="javascript:;"  data-item-id'+'="'+jsonVOB['vbd_at_id']+'" class="vbd-action-link vbd-update-vbd_at" > <span class="fa fa-edit"></span> </a>'+
       '<a href="javascript:;" data-item-id'+'="'+jsonVOB['vbd_at_id']+'" class="vbd-action-link vbd-view-vbd_at ml-1" > <span class="fa fa-info-circle"></span> </a>'+
       '<a href="javascript:;"  data-item-id'+'="'+jsonVOB['vbd_at_id']+'" class="vbd-action-link vbd-askdelete-vbd_at ml-1" >'+
           ' <span class="fa fa-trash"></span>'+
        '</a> </td> </tr>');
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



 /*
* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Author: Vayile Fumo
* Date: 11/09/2019, Wednesday
* Time: 01:01 PM
* Project/Module: Account Type*/

$('form[name=vbd_at-vbd-add-form]').on('submit', function(e) {

//uncomment the prevent bellow case an error appear, for debug
//e.preventDefault();
var this_fvalidate=true;

var thisForm=$(this);

if(this_fvalidate){
vbdDisableSubmit(thisForm);
this_fvalidate=false;

var data_preset_vbd_at="vbd_method=add&vbd_key="+vbdGetKey();
var data_vbd_at=data_preset_vbd_at+'&'+$(this).serialize();


var url= VBUILDER_APP_ROOT+"/api/global/vbd_at/";
var content_vbd_at="none-v";

var xhr_vbd_at= new XMLHttpRequest();
xhr_vbd_at.open('POST',url,true);
xhr_vbd_at.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr_vbd_at.onreadystatechange= function () {

if(xhr_vbd_at.readyState===4){
vbdEnableSubmit(thisForm);
this_fvalidate=true;
} else{
vbdDisableSubmit(thisForm);
this_fvalidate=false;
}

if(xhr_vbd_at.readyState===4 && xhr_vbd_at.status===200){
content_vbd_at=xhr_vbd_at.responseText;
try {



var json_vbd_at=JSON.parse(content_vbd_at);
//start of submission check
if(json_vbd_at['response']['state']===1){

// load the list
reload_vbd_at();

$('form[name=vbd_at-vbd-add-form]').trigger("reset");
$('#vbd_at-modal-add').modal('hide');
vbToast('success','Account Type successfully added');
}
else
{
// checking for the errors
if(json_vbd_at['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_vbd_at['rq_fields']['missing']['count'] != undefined && json_vbd_at['rq_fields']['missing']['count']!==0){
vbToast('warning','Please fill all required fields');
} else if( json_vbd_at['validate']['state'] != undefined && json_vbd_at['validate']['state']===false){
vbToast('warning','Fill the fields correctly');
} else if( json_vbd_at['response']['result']['error'][1] != undefined && json_vbd_at['response']['result']['error'][1]===1062){
vbToast('warning','Error. Duplicate entry');
} else{
vbToast('warning','Error adding Account Type');
}

}
//end of submission check
} catch (e) {

vbToast('error','An error have occured during the request.');
console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
}
} else{

console.log("vbuilder-vbd_at-submition-process",'Loading vbd_at-vbd-add-form');

}
};
xhr_vbd_at.send(data_vbd_at);



} else{

vbToast('warning','Please fill all required fields');

}

return false;

});

 /*
* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Author: Vayile Fumo
* Date: 11/09/2019, Wednesday
* Time: 01:01 PM
* Project/Module: Account Type*/

var item_id_update_vbd_at=null;

$(document).on('click', ".vbd-update-vbd_at", function (e) {

e.preventDefault();

item_id_update_vbd_at=null;
$('form[name=vbd_at-vbd-update-form]').trigger("reset");




var data_vbd_at="vbd_method=readcontrol&vbd_key="+vbdGetKey()+"&vbd_at_id="+$(this).data('item-id');


var xhrVBD= new XMLHttpRequest();
xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_at/",true);
xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


xhrVBD.onreadystatechange= function () {
if(xhrVBD.readyState===4 && xhrVBD.status===200){

update_load_vbd_at( xhrVBD.responseText)

}
if(xhrVBD.readyState<4){

}
};

xhrVBD.send(data_vbd_at);

});



function update_load_vbd_at( thisvbd){

try {


var json_vbd_at=JSON.parse(thisvbd);
//start of submission check
if(json_vbd_at['response']['state']===1){

$('form[name=vbd_at-vbd-update-form]').trigger("reset");

//vbToast('success','Account Type successfully loaded!');

var jsonVOB= JSON.parse(json_vbd_at['response']['result']['data-json'][0]);
item_id_update_vbd_at=jsonVOB['vbd_at_id'];

        $('form[name=vbd_at-vbd-update-form] input[name=vbd_at_type]').val( jsonVOB['vbd_at_type'] );
        $('form[name=vbd_at-vbd-update-form] input[name=vbd_at_desc]').val( jsonVOB['vbd_at_desc'] );

$('#vbd_at-modal-update').modal('show');

}
else
{
// checking for the errors
if(json_vbd_at['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_vbd_at['rq_fields']['missing']['count'] != undefined && json_vbd_at['rq_fields']['missing']['count']!==0){
vbToast('warning','Missing request data');
} else if( json_vbd_at['validate']['state'] != undefined && json_vbd_at['validate']['state']===false){
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



$('form[name=vbd_at-vbd-update-form]').on('submit', function(e) {

//uncomment the prevent bellow case an error appear, for debug
//e.preventDefault();
var this_fvalidate=true;

var thisForm=$(this);

if(this_fvalidate){
vbdDisableSubmit(thisForm);
this_fvalidate=false;

var data_preset_vbd_at="vbd_method=update&vbd_key="+vbdGetKey()+"&vbd_at_id="+item_id_update_vbd_at;
var data_vbd_at=data_preset_vbd_at+'&'+$(this).serialize();


var url= VBUILDER_APP_ROOT+"/api/global/vbd_at/";
var content_vbd_at="none-v";

var xhr_vbd_at= new XMLHttpRequest();
xhr_vbd_at.open('POST',url,true);
xhr_vbd_at.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr_vbd_at.onreadystatechange= function () {


if(xhr_vbd_at.readyState===4){
vbdEnableSubmit(thisForm);
this_fvalidate=true;
} else{
vbdDisableSubmit(thisForm);
this_fvalidate=false;
}


if(xhr_vbd_at.readyState===4 && xhr_vbd_at.status===200){
content_vbd_at=xhr_vbd_at.responseText;
try {


var json_vbd_at=JSON.parse(content_vbd_at);
//start of submission check
if(json_vbd_at['response']['state']===1){
item_id_update_vbd_at=null;

$('form[name=vbd_at-vbd-update-form]').trigger("reset");
$('#vbd_at-modal-update').modal('hide');

if( json_vbd_at['response']['result']['affected'] != undefined && json_vbd_at['response']['result']['affected']>0){
vbToast('success','Account Type updated');
// load the list
reload_vbd_at();

} else {
vbToast('success','None change applied');
}

}
else
{
// checking for the errors
if(json_vbd_at['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_vbd_at['rq_fields']['missing']['count'] != undefined && json_vbd_at['rq_fields']['missing']['count']!==0){
vbToast('warning','Please fill all required fields');
} else if( json_vbd_at['validate']['state'] != undefined && json_vbd_at['validate']['state']===false){
vbToast('warning','Fill the fields correctly');
} else if( json_vbd_at['response']['result']['error'][1] != undefined && json_vbd_at['response']['result']['error'][1]===1062){
vbToast('warning','Error. Duplicate entry');
} else{
vbToast('warning','Error updating Account Type');
}

}
//end of submission check

} catch (e) {

vbToast('error','An error have occured during the request.');
console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
}
} else{

console.log("vbuilder-vbd_at-submition-process",'Loading vbd_at-vbd-update-form');

}
};
xhr_vbd_at.send(data_vbd_at);



} else{

vbToast('warning','Please fill all required fields');

}
return false;

});

 
/*<br/>
* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/ <br/>
* Author: Vayile Fumo<br/>
* Date: 11/09/2019, Wednesday<br/>
* Time: 01:01 PM<br/>
* Project/Module: Account Type<br/>*/


$(document).on('click', ".vbd-view-vbd_at", function (e) {

e.preventDefault();

var data_vbd_at="vbd_method=readcontrol&vbd_key="+vbdGetKey()+"&vbd_at_id="+$(this).data('item-id');


var xhrVBD= new XMLHttpRequest();
xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_at/",true);
xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


xhrVBD.onreadystatechange= function () {
if(xhrVBD.readyState===4 && xhrVBD.status===200){

view_load_vbd_at( xhrVBD.responseText)

}
if(xhrVBD.readyState<4){

}
};

xhrVBD.send(data_vbd_at);

});



function view_load_vbd_at( thisvbd){

try {


var json_vbd_at=JSON.parse(thisvbd);
//start of submission check
if(json_vbd_at['response']['state']===1 && json_vbd_at['response']['result']['rows']>0){

$('#vbd_at-item-view .vbd_at-holder').text("");
$('#vbd_at-modal-view').modal('show');

//vbToast('success','Record Successfully loaded!');

var jsonVOB= JSON.parse(json_vbd_at['response']['result']['data-json'][0]);

        $('#vbd_at-item-view .vbd_at_type.vbd_at-holder').text( jsonVOB['vbd_at_type'] );
                $('#vbd_at-item-view .vbd_at_desc.vbd_at-holder').text( jsonVOB['vbd_at_desc'] );
        
$('#vbd_at-modal-view').modal('show');

}
else
{
// checking for the errors
if(json_vbd_at['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_vbd_at['rq_fields']['missing']['count'] != undefined && json_vbd_at['rq_fields']['missing']['count']!==0){
vbToast('warning','Missing request data');
} else if( json_vbd_at['validate']['state'] != undefined && json_vbd_at['validate']['state']===false){
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
* Date: 11/09/2019, Wednesday
* Time: 01:01 PM
* Project/Module: Account Type*/


var item_id_delete_vbd_at=null;

$(document).on('click', ".vbd-action-link.vbd-askdelete-vbd_at", function (e) {

e.preventDefault();
item_id_delete_vbd_at=null;
var data_vbd_at="vbd_method=readcontrol&vbd_key="+vbdGetKey()+"&vbd_at_id="+$(this).data('item-id');


var xhrVBD= new XMLHttpRequest();
xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_at/",true);
xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


xhrVBD.onreadystatechange= function () {
if(xhrVBD.readyState===4 && xhrVBD.status===200){

delete_load_vbd_at( xhrVBD.responseText)

}
if(xhrVBD.readyState<4){

}
};

xhrVBD.send(data_vbd_at);

});




// Open modal if data exist
function delete_load_vbd_at( thisvbd ){

try {


var json_vbd_at=JSON.parse(thisvbd);
//start of submission check
if(json_vbd_at['response']['state']===1 && json_vbd_at['response']['result']['rows']>0){

$('.vbuilder-delete-vbd_at-holder').text("");
$('#vbd_at-modal-delete').modal('show');

//vbToast('success','Account Type successfully loaded!');

var jsonVOB= JSON.parse(json_vbd_at['response']['result']['data-json'][0]);

$('.vbuilder-delete-vbd_at-holder').text( jsonVOB['vbd_at_id'] );
item_id_delete_vbd_at=jsonVOB['vbd_at_id'];

}
else
{
// checking for the errors
if(json_vbd_at['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_vbd_at['rq_fields']['missing']['count'] != undefined && json_vbd_at['rq_fields']['missing']['count']!==0){
vbToast('warning','Missing request data');
} else if( json_vbd_at['validate']['state'] != undefined && json_vbd_at['validate']['state']===false){
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

$(document).on('click', ".vbd-action-link.vbd-delete-vbd_at", function (e) {
e.preventDefault();


var data_vbd_at="vbd_method=delete&vbd_key="+vbdGetKey()+"&vbd_at_id="+item_id_delete_vbd_at;


var xhrVBD= new XMLHttpRequest();
xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_at/",true);
xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


xhrVBD.onreadystatechange= function () {
if(xhrVBD.readyState===4 && xhrVBD.status===200){

delete_execute_vbd_at( xhrVBD.responseText)

}
if(xhrVBD.readyState<4){

}
};

xhrVBD.send(data_vbd_at);

});


function delete_execute_vbd_at( thisvbd){

try {



var json_vbd_at=JSON.parse(thisvbd);

//start of submission check
if(json_vbd_at['response']['state']===1){

item_id_update_vbd_at=null;

if( json_vbd_at['response']['result']['affected'] != undefined && json_vbd_at['response']['result']['affected']>0){
vbToast('success','Account Type deleted');
// load the list
reload_vbd_at();

} else {
vbToast('success','None change applied');
}


}
else
{
// checking for the errors
if(json_vbd_at['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_vbd_at['rq_fields']['missing']['count'] != undefined && json_vbd_at['rq_fields']['missing']['count']!==0){
vbToast('warning','Missing request data');
} else if( json_vbd_at['validate']['state'] != undefined && json_vbd_at['validate']['state']===false){
vbToast('warning','Wrong request data');
}else{
vbToast('warning','Error deleting Account Type');
}

}
//end of submission check


} catch (e) {

vbToast('error','An error have occured during the request.');
console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
}

}



