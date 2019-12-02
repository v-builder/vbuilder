/*<br/>
* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/ <br/>
* Author: Vayile Fumo<br/>
* Date: 11/09/2019, Wednesday<br/>
* Time: 08:24 PM<br/>
* Project/Module: Personal Data<br/>*/

$(window).ready(function() {
// load the list
reload_vbd_user_pdata();
});

function reload_vbd_user_pdata() {


var data_vbd_user_pdata="vbd_method=read&vbd_key="+vbdGetKey();


var url= VBUILDER_APP_ROOT+"/api/global/vbd_user_pdata/";
var content_vbd_user_pdata="none-v";

var xhr_vbd_user_pdata= new XMLHttpRequest();
xhr_vbd_user_pdata.open('POST',url,true);
xhr_vbd_user_pdata.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr_vbd_user_pdata.onreadystatechange= function () {

if(xhr_vbd_user_pdata.readyState===4 && xhr_vbd_user_pdata.status===200){

content_vbd_user_pdata=xhr_vbd_user_pdata.responseText;

try {

var json_vbd_user_pdata=JSON.parse(content_vbd_user_pdata);

//start of submission check
if(json_vbd_user_pdata['response']['state']===1){
$('#vbd_user_pdata-vbd-add-form').trigger("reset");
$('#vbd_user_pdata-modal-add').modal('hide');
//vbToast('success','Records successfully loaded!');

$("#vbd_user_pdata-table-list tbody").html("");

if(json_vbd_user_pdata['response']['result']['rows']>0){

for ( var ix = 0; ix < json_vbd_user_pdata['response']['result']['data-json'].length; ix++) {

var jsonVOB= JSON.parse(json_vbd_user_pdata['response']['result']['data-json'][ix]);

$("#vbd_user_pdata-table-list tbody").append('<tr>'+ '<td>'+ jsonVOB['usp_id'] +'  </td>' + '<td>'+ jsonVOB['user_id'] +'  </td>' + '<td>'+ jsonVOB['vbd_at_id'] +'  </td>' + '<td>'+ jsonVOB['usp_label_value'] +'  </td>' + '<td>'+ jsonVOB['usp_type_value'] +'  </td>' + '<td>'+ jsonVOB['phone_code'] +'  </td>' + '<td>'+ jsonVOB['phone_number'] +'  </td>' + '<td>'+ jsonVOB['phone_number_alt'] +'  </td>' + '<td>'+ jsonVOB['phone_shown'] +'  </td>' + '<td>'+ jsonVOB['gender'] +'  </td>' + '<td>'+ jsonVOB['about'] +'  </td>' + '<td>'+ jsonVOB['bio'] +'  </td>' +  '<td class="vbd-actions-td">'+
        '<a href="javascript:;"  data-item-id'+'="'+jsonVOB['usp_id']+'" class="vbd-action-link vbd-update-vbd_user_pdata" > <span class="fa fa-edit"></span> </a>'+
       '<a href="javascript:;" data-item-id'+'="'+jsonVOB['usp_id']+'" class="vbd-action-link vbd-view-vbd_user_pdata ml-1" > <span class="fa fa-info-circle"></span> </a>'+
       '<a href="javascript:;"  data-item-id'+'="'+jsonVOB['usp_id']+'" class="vbd-action-link vbd-askdelete-vbd_user_pdata ml-1" >'+
           ' <span class="fa fa-trash"></span>'+
        '</a> </td> </tr>');
}

}


}
else
{
// checking for the errors
if(json_vbd_user_pdata['response']['state']===1920){

vbToast('warning','Please login. Error loading data');

} else if( json_vbd_user_pdata['rq_fields']['missing']['count'] != undefined && json_vbd_user_pdata['rq_fields']['missing']['count']!==0){
vbToast('warning','Error loading data. Missing');
} else if( json_vbd_user_pdata['validate']['state'] != undefined && json_vbd_user_pdata['validate']['state']===false){
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

console.log("vbuilder-submition-process",'Loading vbd_user_pdata list data');

}
};
xhr_vbd_user_pdata.send(data_vbd_user_pdata);



}



 /*
* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Author: Vayile Fumo
* Date: 11/09/2019, Wednesday
* Time: 08:24 PM
* Project/Module: Personal Data*/

$('form[name=vbd_user_pdata-vbd-add-form]').on('submit', function(e) {

//uncomment the prevent bellow case an error appear, for debug
//e.preventDefault();
var this_fvalidate=true;

var thisForm=$(this);

if(this_fvalidate){
vbdDisableSubmit(thisForm);
this_fvalidate=false;

var data_preset_vbd_user_pdata="vbd_method=add&vbd_key="+vbdGetKey();
var data_vbd_user_pdata=data_preset_vbd_user_pdata+'&'+$(this).serialize();


var url= VBUILDER_APP_ROOT+"/api/global/vbd_user_pdata/";
var content_vbd_user_pdata="none-v";

var xhr_vbd_user_pdata= new XMLHttpRequest();
xhr_vbd_user_pdata.open('POST',url,true);
xhr_vbd_user_pdata.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr_vbd_user_pdata.onreadystatechange= function () {

if(xhr_vbd_user_pdata.readyState===4){
vbdEnableSubmit(thisForm);
this_fvalidate=true;
} else{
vbdDisableSubmit(thisForm);
this_fvalidate=false;
}

if(xhr_vbd_user_pdata.readyState===4 && xhr_vbd_user_pdata.status===200){
content_vbd_user_pdata=xhr_vbd_user_pdata.responseText;
try {



var json_vbd_user_pdata=JSON.parse(content_vbd_user_pdata);
//start of submission check
if(json_vbd_user_pdata['response']['state']===1){

// load the list
reload_vbd_user_pdata();

$('form[name=vbd_user_pdata-vbd-add-form]').trigger("reset");
$('#vbd_user_pdata-modal-add').modal('hide');
vbToast('success','Personal Data successfully added');
}
else
{
// checking for the errors
if(json_vbd_user_pdata['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_vbd_user_pdata['rq_fields']['missing']['count'] != undefined && json_vbd_user_pdata['rq_fields']['missing']['count']!==0){
vbToast('warning','Please fill all required fields');
} else if( json_vbd_user_pdata['validate']['state'] != undefined && json_vbd_user_pdata['validate']['state']===false){
vbToast('warning','Fill the fields correctly');
} else if( json_vbd_user_pdata['response']['result']['error'][1] != undefined && json_vbd_user_pdata['response']['result']['error'][1]===1062){
vbToast('warning','Error. Duplicate entry');
} else{
vbToast('warning','Error adding Personal Data');
}

}
//end of submission check
} catch (e) {

vbToast('error','An error have occured during the request.');
console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
}
} else{

console.log("vbuilder-vbd_user_pdata-submition-process",'Loading vbd_user_pdata-vbd-add-form');

}
};
xhr_vbd_user_pdata.send(data_vbd_user_pdata);



} else{

vbToast('warning','Please fill all required fields');

}

return false;

});

 /*
* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Author: Vayile Fumo
* Date: 11/09/2019, Wednesday
* Time: 08:24 PM
* Project/Module: Personal Data*/

var item_id_update_vbd_user_pdata=null;

$(document).on('click', ".vbd-update-vbd_user_pdata", function (e) {

e.preventDefault();

item_id_update_vbd_user_pdata=null;
$('form[name=vbd_user_pdata-vbd-update-form]').trigger("reset");




var data_vbd_user_pdata="vbd_method=readcontrol&vbd_key="+vbdGetKey()+"&usp_id="+$(this).data('item-id');


var xhrVBD= new XMLHttpRequest();
xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_user_pdata/",true);
xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


xhrVBD.onreadystatechange= function () {
if(xhrVBD.readyState===4 && xhrVBD.status===200){

update_load_vbd_user_pdata( xhrVBD.responseText)

}
if(xhrVBD.readyState<4){

}
};

xhrVBD.send(data_vbd_user_pdata);

});



function update_load_vbd_user_pdata( thisvbd){

try {


var json_vbd_user_pdata=JSON.parse(thisvbd);
//start of submission check
if(json_vbd_user_pdata['response']['state']===1){

$('form[name=vbd_user_pdata-vbd-update-form]').trigger("reset");

//vbToast('success','Personal Data successfully loaded!');

var jsonVOB= JSON.parse(json_vbd_user_pdata['response']['result']['data-json'][0]);
item_id_update_vbd_user_pdata=jsonVOB['usp_id'];

        $('form[name=vbd_user_pdata-vbd-update-form] input[name=user_id]').val( jsonVOB['user_id'] );
        $('form[name=vbd_user_pdata-vbd-update-form] input[name=vbd_at_id]').val( jsonVOB['vbd_at_id'] );
        $('form[name=vbd_user_pdata-vbd-update-form] input[name=usp_label_value]').val( jsonVOB['usp_label_value'] );
        $('form[name=vbd_user_pdata-vbd-update-form] input[name=usp_type_value]').val( jsonVOB['usp_type_value'] );
        $('form[name=vbd_user_pdata-vbd-update-form] input[name=phone_code]').val( jsonVOB['phone_code'] );
        $('form[name=vbd_user_pdata-vbd-update-form] input[name=phone_number]').val( jsonVOB['phone_number'] );
        $('form[name=vbd_user_pdata-vbd-update-form] input[name=phone_number_alt]').val( jsonVOB['phone_number_alt'] );
        $('form[name=vbd_user_pdata-vbd-update-form] input[name=phone_shown]').val( jsonVOB['phone_shown'] );
        $('form[name=vbd_user_pdata-vbd-update-form] input[name=gender]').val( jsonVOB['gender'] );
        $('form[name=vbd_user_pdata-vbd-update-form] input[name=about]').val( jsonVOB['about'] );
        $('form[name=vbd_user_pdata-vbd-update-form] input[name=bio]').val( jsonVOB['bio'] );

$('#vbd_user_pdata-modal-update').modal('show');

}
else
{
// checking for the errors
if(json_vbd_user_pdata['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_vbd_user_pdata['rq_fields']['missing']['count'] != undefined && json_vbd_user_pdata['rq_fields']['missing']['count']!==0){
vbToast('warning','Missing request data');
} else if( json_vbd_user_pdata['validate']['state'] != undefined && json_vbd_user_pdata['validate']['state']===false){
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



$('form[name=vbd_user_pdata-vbd-update-form]').on('submit', function(e) {

//uncomment the prevent bellow case an error appear, for debug
//e.preventDefault();
var this_fvalidate=true;

var thisForm=$(this);

if(this_fvalidate){
vbdDisableSubmit(thisForm);
this_fvalidate=false;

var data_preset_vbd_user_pdata="vbd_method=update&vbd_key="+vbdGetKey()+"&usp_id="+item_id_update_vbd_user_pdata;
var data_vbd_user_pdata=data_preset_vbd_user_pdata+'&'+$(this).serialize();


var url= VBUILDER_APP_ROOT+"/api/global/vbd_user_pdata/";
var content_vbd_user_pdata="none-v";

var xhr_vbd_user_pdata= new XMLHttpRequest();
xhr_vbd_user_pdata.open('POST',url,true);
xhr_vbd_user_pdata.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr_vbd_user_pdata.onreadystatechange= function () {


if(xhr_vbd_user_pdata.readyState===4){
vbdEnableSubmit(thisForm);
this_fvalidate=true;
} else{
vbdDisableSubmit(thisForm);
this_fvalidate=false;
}


if(xhr_vbd_user_pdata.readyState===4 && xhr_vbd_user_pdata.status===200){
content_vbd_user_pdata=xhr_vbd_user_pdata.responseText;
try {


var json_vbd_user_pdata=JSON.parse(content_vbd_user_pdata);
//start of submission check
if(json_vbd_user_pdata['response']['state']===1){
item_id_update_vbd_user_pdata=null;

$('form[name=vbd_user_pdata-vbd-update-form]').trigger("reset");
$('#vbd_user_pdata-modal-update').modal('hide');

if( json_vbd_user_pdata['response']['result']['affected'] != undefined && json_vbd_user_pdata['response']['result']['affected']>0){
vbToast('success','Personal Data updated');
// load the list
reload_vbd_user_pdata();

} else {
vbToast('success','None change applied');
}

}
else
{
// checking for the errors
if(json_vbd_user_pdata['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_vbd_user_pdata['rq_fields']['missing']['count'] != undefined && json_vbd_user_pdata['rq_fields']['missing']['count']!==0){
vbToast('warning','Please fill all required fields');
} else if( json_vbd_user_pdata['validate']['state'] != undefined && json_vbd_user_pdata['validate']['state']===false){
vbToast('warning','Fill the fields correctly');
} else if( json_vbd_user_pdata['response']['result']['error'][1] != undefined && json_vbd_user_pdata['response']['result']['error'][1]===1062){
vbToast('warning','Error. Duplicate entry');
} else{
vbToast('warning','Error updating Personal Data');
}

}
//end of submission check

} catch (e) {

vbToast('error','An error have occured during the request.');
console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
}
} else{

console.log("vbuilder-vbd_user_pdata-submition-process",'Loading vbd_user_pdata-vbd-update-form');

}
};
xhr_vbd_user_pdata.send(data_vbd_user_pdata);



} else{

vbToast('warning','Please fill all required fields');

}
return false;

});

 
/*<br/>
* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/ <br/>
* Author: Vayile Fumo<br/>
* Date: 11/09/2019, Wednesday<br/>
* Time: 08:24 PM<br/>
* Project/Module: Personal Data<br/>*/


$(document).on('click', ".vbd-view-vbd_user_pdata", function (e) {

e.preventDefault();

var data_vbd_user_pdata="vbd_method=readcontrol&vbd_key="+vbdGetKey()+"&usp_id="+$(this).data('item-id');


var xhrVBD= new XMLHttpRequest();
xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_user_pdata/",true);
xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


xhrVBD.onreadystatechange= function () {
if(xhrVBD.readyState===4 && xhrVBD.status===200){

view_load_vbd_user_pdata( xhrVBD.responseText)

}
if(xhrVBD.readyState<4){

}
};

xhrVBD.send(data_vbd_user_pdata);

});



function view_load_vbd_user_pdata( thisvbd){

try {


var json_vbd_user_pdata=JSON.parse(thisvbd);
//start of submission check
if(json_vbd_user_pdata['response']['state']===1 && json_vbd_user_pdata['response']['result']['rows']>0){

$('#vbd_user_pdata-item-view .vbd_user_pdata-holder').text("");
$('#vbd_user_pdata-modal-view').modal('show');

//vbToast('success','Record Successfully loaded!');

var jsonVOB= JSON.parse(json_vbd_user_pdata['response']['result']['data-json'][0]);

        $('#vbd_user_pdata-item-view .user_id.vbd_user_pdata-holder').text( jsonVOB['user_id'] );
                $('#vbd_user_pdata-item-view .vbd_at_id.vbd_user_pdata-holder').text( jsonVOB['vbd_at_id'] );
                $('#vbd_user_pdata-item-view .usp_label_value.vbd_user_pdata-holder').text( jsonVOB['usp_label_value'] );
                $('#vbd_user_pdata-item-view .usp_type_value.vbd_user_pdata-holder').text( jsonVOB['usp_type_value'] );
                $('#vbd_user_pdata-item-view .phone_code.vbd_user_pdata-holder').text( jsonVOB['phone_code'] );
                $('#vbd_user_pdata-item-view .phone_number.vbd_user_pdata-holder').text( jsonVOB['phone_number'] );
                $('#vbd_user_pdata-item-view .phone_number_alt.vbd_user_pdata-holder').text( jsonVOB['phone_number_alt'] );
                $('#vbd_user_pdata-item-view .phone_shown.vbd_user_pdata-holder').text( jsonVOB['phone_shown'] );
                $('#vbd_user_pdata-item-view .gender.vbd_user_pdata-holder').text( jsonVOB['gender'] );
                $('#vbd_user_pdata-item-view .about.vbd_user_pdata-holder').text( jsonVOB['about'] );
                $('#vbd_user_pdata-item-view .bio.vbd_user_pdata-holder').text( jsonVOB['bio'] );
        
$('#vbd_user_pdata-modal-view').modal('show');

}
else
{
// checking for the errors
if(json_vbd_user_pdata['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_vbd_user_pdata['rq_fields']['missing']['count'] != undefined && json_vbd_user_pdata['rq_fields']['missing']['count']!==0){
vbToast('warning','Missing request data');
} else if( json_vbd_user_pdata['validate']['state'] != undefined && json_vbd_user_pdata['validate']['state']===false){
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
* Time: 08:24 PM
* Project/Module: Personal Data*/


var item_id_delete_vbd_user_pdata=null;

$(document).on('click', ".vbd-action-link.vbd-askdelete-vbd_user_pdata", function (e) {

e.preventDefault();
item_id_delete_vbd_user_pdata=null;
var data_vbd_user_pdata="vbd_method=readcontrol&vbd_key="+vbdGetKey()+"&usp_id="+$(this).data('item-id');


var xhrVBD= new XMLHttpRequest();
xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_user_pdata/",true);
xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


xhrVBD.onreadystatechange= function () {
if(xhrVBD.readyState===4 && xhrVBD.status===200){

delete_load_vbd_user_pdata( xhrVBD.responseText)

}
if(xhrVBD.readyState<4){

}
};

xhrVBD.send(data_vbd_user_pdata);

});




// Open modal if data exist
function delete_load_vbd_user_pdata( thisvbd ){

try {


var json_vbd_user_pdata=JSON.parse(thisvbd);
//start of submission check
if(json_vbd_user_pdata['response']['state']===1 && json_vbd_user_pdata['response']['result']['rows']>0){

$('.vbuilder-delete-vbd_user_pdata-holder').text("");
$('#vbd_user_pdata-modal-delete').modal('show');

//vbToast('success','Personal Data successfully loaded!');

var jsonVOB= JSON.parse(json_vbd_user_pdata['response']['result']['data-json'][0]);

$('.vbuilder-delete-vbd_user_pdata-holder').text( jsonVOB['usp_id'] );
item_id_delete_vbd_user_pdata=jsonVOB['usp_id'];

}
else
{
// checking for the errors
if(json_vbd_user_pdata['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_vbd_user_pdata['rq_fields']['missing']['count'] != undefined && json_vbd_user_pdata['rq_fields']['missing']['count']!==0){
vbToast('warning','Missing request data');
} else if( json_vbd_user_pdata['validate']['state'] != undefined && json_vbd_user_pdata['validate']['state']===false){
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

$(document).on('click', ".vbd-action-link.vbd-delete-vbd_user_pdata", function (e) {
e.preventDefault();


var data_vbd_user_pdata="vbd_method=delete&vbd_key="+vbdGetKey()+"&usp_id="+item_id_delete_vbd_user_pdata;


var xhrVBD= new XMLHttpRequest();
xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_user_pdata/",true);
xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


xhrVBD.onreadystatechange= function () {
if(xhrVBD.readyState===4 && xhrVBD.status===200){

delete_execute_vbd_user_pdata( xhrVBD.responseText)

}
if(xhrVBD.readyState<4){

}
};

xhrVBD.send(data_vbd_user_pdata);

});


function delete_execute_vbd_user_pdata( thisvbd){

try {



var json_vbd_user_pdata=JSON.parse(thisvbd);

//start of submission check
if(json_vbd_user_pdata['response']['state']===1){

item_id_update_vbd_user_pdata=null;

if( json_vbd_user_pdata['response']['result']['affected'] != undefined && json_vbd_user_pdata['response']['result']['affected']>0){
vbToast('success','Personal Data deleted');
// load the list
reload_vbd_user_pdata();

} else {
vbToast('success','None change applied');
}


}
else
{
// checking for the errors
if(json_vbd_user_pdata['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_vbd_user_pdata['rq_fields']['missing']['count'] != undefined && json_vbd_user_pdata['rq_fields']['missing']['count']!==0){
vbToast('warning','Missing request data');
} else if( json_vbd_user_pdata['validate']['state'] != undefined && json_vbd_user_pdata['validate']['state']===false){
vbToast('warning','Wrong request data');
}else{
vbToast('warning','Error deleting Personal Data');
}

}
//end of submission check


} catch (e) {

vbToast('error','An error have occured during the request.');
console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
}

}



