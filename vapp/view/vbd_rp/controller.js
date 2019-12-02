/*<br/>
* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/ <br/>
* Author: Vayile Fumo<br/>
* Date: 07/09/2019, Saturday<br/>
* Time: 02:59 AM<br/>
* Project/Module: Password Reset<br/>*/

$(window).ready(function() {
// load the list
reload_vbd_rp();
});

function reload_vbd_rp() {


var data_vbd_rp="vbd_method=read&vbd_key="+vbdGetKey();


var url= VBUILDER_APP_ROOT+"/api/global/vbd_rp/";
var content_vbd_rp="none-v";

var xhr_vbd_rp= new XMLHttpRequest();
xhr_vbd_rp.open('POST',url,true);
xhr_vbd_rp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr_vbd_rp.onreadystatechange= function () {

if(xhr_vbd_rp.readyState===4 && xhr_vbd_rp.status===200){

content_vbd_rp=xhr_vbd_rp.responseText;

try {

var json_vbd_rp=JSON.parse(content_vbd_rp);

//start of submission check
if(json_vbd_rp['response']['state']===1){
$('#vbd_rp-vbd-add-form').trigger("reset");
$('#vbd_rp-modal-add').modal('hide');
//vbToast('success','Records successfully loaded!');

$("#vbd_rp-table-list tbody").html("");

if(json_vbd_rp['response']['result']['rows']>0){

for ( var ix = 0; ix < json_vbd_rp['response']['result']['data-json'].length; ix++) {

var jsonVOB= JSON.parse(json_vbd_rp['response']['result']['data-json'][ix]);

$("#vbd_rp-table-list tbody").append('<tr>'+ '<td>'+ jsonVOB['rp_id'] +'  </td>' + '<td>'+ jsonVOB['rp_email'] +'  </td>' + '<td>'+ jsonVOB['user_id'] +'  </td>' + '<td>'+ jsonVOB['rp_code'] +'  </td>' + '<td>'+ jsonVOB['rp_date'] +'  </td>' + '<td>'+ jsonVOB['rp_date_exp'] +'  </td>' + '<td>'+ jsonVOB['rp_state'] +'  </td>' +  '<td class="vbd-actions-td">'+
        '<a href="javascript:;"  data-item-id'+'="'+jsonVOB['rp_id']+'" class="vbd-action-link vbd-update-vbd_rp" > <span class="fa fa-edit"></span> </a>'+
       '<a href="javascript:;" data-item-id'+'="'+jsonVOB['rp_id']+'" class="vbd-action-link vbd-view-vbd_rp ml-1" > <span class="fa fa-info-circle"></span> </a>'+
       '<a href="javascript:;"  data-item-id'+'="'+jsonVOB['rp_id']+'" class="vbd-action-link vbd-askdelete-vbd_rp ml-1" >'+
           ' <span class="fa fa-trash"></span>'+
        '</a> </td> </tr>');
}

}


}
else
{
// checking for the errors
if(json_vbd_rp['response']['state']===1920){

vbToast('warning','Please login. Error loading data');

} else if( json_vbd_rp['rq_fields']['missing']['count'] != undefined && json_vbd_rp['rq_fields']['missing']['count']!==0){
vbToast('warning','Error loading data. Missing');
} else if( json_vbd_rp['validate']['state'] != undefined && json_vbd_rp['validate']['state']===false){
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

console.log("vbuilder-submition-process",'Loading vbd_rp list data');

}
};
xhr_vbd_rp.send(data_vbd_rp);



}



 /*
* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Author: Vayile Fumo
* Date: 07/09/2019, Saturday
* Time: 02:59 AM
* Project/Module: Password Reset*/

$('#vbd_rp-vbd-add-form').on('submit', function(e) {

e.preventDefault();
var this_fvalidate=true;

if(this_fvalidate){

var data_preset_vbd_rp="vbd_method=add&vbd_key="+vbdGetKey();
var data_vbd_rp=data_preset_vbd_rp+'&'+$(this).serialize();


var url= VBUILDER_APP_ROOT+"/api/global/vbd_rp/";
var content_vbd_rp="none-v";

var xhr_vbd_rp= new XMLHttpRequest();
xhr_vbd_rp.open('POST',url,true);
xhr_vbd_rp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr_vbd_rp.onreadystatechange= function () {
if(xhr_vbd_rp.readyState===4 && xhr_vbd_rp.status===200){
content_vbd_rp=xhr_vbd_rp.responseText;
try {


var json_vbd_rp=JSON.parse(content_vbd_rp);
//start of submission check
if(json_vbd_rp['response']['state']===1){

// load the list
reload_vbd_rp();

$('#vbd_rp-vbd-add-form').trigger("reset");
$('#vbd_rp-modal-add').modal('hide');
vbToast('success','Password Reset successfully added');
}
else
{
// checking for the errors
if(json_vbd_rp['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_vbd_rp['rq_fields']['missing']['count'] != undefined && json_vbd_rp['rq_fields']['missing']['count']!==0){
vbToast('warning','Please fill all required fields');
} else if( json_vbd_rp['validate']['state'] != undefined && json_vbd_rp['validate']['state']===false){
vbToast('warning','Fill the fields correctly');
} else if( json_vbd_rp['response']['result']['error'][1] != undefined && json_vbd_rp['response']['result']['error'][1]===1062){
vbToast('warning','Error. Duplicate entry');
} else{
vbToast('warning','Error adding Password Reset');
}

}
//end of submission check
} catch (e) {

vbToast('error','An error have occured during the request.');
console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
}
} else{

console.log("vbuilder-submition-process",'Loading vbd_rp-vbd-add-form');

}
};
xhr_vbd_rp.send(data_vbd_rp);



} else{

vbToast('warning','Please fill all required fields');

}

});

 /*
* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Author: Vayile Fumo
* Date: 07/09/2019, Saturday
* Time: 02:59 AM
* Project/Module: Password Reset*/

var item_id_update_vbd_rp=null;

$(document).on('click', ".vbd-update-vbd_rp", function (e) {

e.preventDefault();

item_id_update_vbd_rp=null;
$('#vbd_rp-vbd-update-form').trigger("reset");




var data_vbd_rp="vbd_method=readcontrol&vbd_key="+vbdGetKey()+"&rp_id="+$(this).data('item-id');


var xhrVBD= new XMLHttpRequest();
xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_rp/",true);
xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


xhrVBD.onreadystatechange= function () {
if(xhrVBD.readyState===4 && xhrVBD.status===200){

update_load_vbd_rp( xhrVBD.responseText)

}
if(xhrVBD.readyState<4){

}
};

xhrVBD.send(data_vbd_rp);

});



function update_load_vbd_rp( thisvbd){

try {


var json_vbd_rp=JSON.parse(thisvbd);
//start of submission check
if(json_vbd_rp['response']['state']===1){

$('#vbd_rp-vbd-update-form').trigger("reset");
$('#vbd_rp-modal-update').modal('hide');
//vbToast('success','Password Reset successfully loaded!');

var jsonVOB= JSON.parse(json_vbd_rp['response']['result']['data-json'][0]);
item_id_update_vbd_rp=jsonVOB['rp_id'];

        $('#vbd_rp-vbd-update-form input#rp_email').val( jsonVOB['rp_email'] );
        $('#vbd_rp-vbd-update-form input#user_id').val( jsonVOB['user_id'] );
        $('#vbd_rp-vbd-update-form input#rp_code').val( jsonVOB['rp_code'] );
        $('#vbd_rp-vbd-update-form input#rp_date').val( jsonVOB['rp_date'] );
        $('#vbd_rp-vbd-update-form input#rp_date_exp').val( jsonVOB['rp_date_exp'] );
        $('#vbd_rp-vbd-update-form input#rp_state').val( jsonVOB['rp_state'] );

$('#vbd_rp-modal-update').modal('show');

}
else
{
// checking for the errors
if(json_vbd_rp['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_vbd_rp['rq_fields']['missing']['count'] != undefined && json_vbd_rp['rq_fields']['missing']['count']!==0){
vbToast('warning','Missing request data');
} else if( json_vbd_rp['validate']['state'] != undefined && json_vbd_rp['validate']['state']===false){
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



$('#vbd_rp-vbd-update-form').on('submit', function(e) {

e.preventDefault();
var this_fvalidate=true;

if(this_fvalidate){

var data_preset_vbd_rp="vbd_method=update&vbd_key="+vbdGetKey()+"&rp_id="+item_id_update_vbd_rp;
var data_vbd_rp=data_preset_vbd_rp+'&'+$(this).serialize();


var url= VBUILDER_APP_ROOT+"/api/global/vbd_rp/";
var content_vbd_rp="none-v";

var xhr_vbd_rp= new XMLHttpRequest();
xhr_vbd_rp.open('POST',url,true);
xhr_vbd_rp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr_vbd_rp.onreadystatechange= function () {
if(xhr_vbd_rp.readyState===4 && xhr_vbd_rp.status===200){
content_vbd_rp=xhr_vbd_rp.responseText;
try {


var json_vbd_rp=JSON.parse(content_vbd_rp);
//start of submission check
if(json_vbd_rp['response']['state']===1){
item_id_update_vbd_rp=null;

$('#vbd_rp-vbd-update-form').trigger("reset");
$('#vbd_rp-modal-update').modal('hide');

if( json_vbd_rp['response']['result']['affected'] != undefined && json_vbd_rp['response']['result']['affected']>0){
vbToast('success','Password Reset updated');
// load the list
reload_vbd_rp();

} else {
vbToast('success','None change applied');
}

}
else
{
// checking for the errors
if(json_vbd_rp['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_vbd_rp['rq_fields']['missing']['count'] != undefined && json_vbd_rp['rq_fields']['missing']['count']!==0){
vbToast('warning','Please fill all required fields');
} else if( json_vbd_rp['validate']['state'] != undefined && json_vbd_rp['validate']['state']===false){
vbToast('warning','Fill the fields correctly');
} else if( json_vbd_rp['response']['result']['error'][1] != undefined && json_vbd_rp['response']['result']['error'][1]===1062){
vbToast('warning','Error. Duplicate entry');
} else{
vbToast('warning','Error updating Password Reset');
}

}
//end of submission check

} catch (e) {

vbToast('error','An error have occured during the request.');
console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
}
} else{

console.log("vbuilder-submition-process",'Loading vbd_rp-vbd-update-form');

}
};
xhr_vbd_rp.send(data_vbd_rp);



} else{

vbToast('warning','Please fill all required fields');

}

});

 
/*<br/>
* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/ <br/>
* Author: Vayile Fumo<br/>
* Date: 07/09/2019, Saturday<br/>
* Time: 02:59 AM<br/>
* Project/Module: Password Reset<br/>*/


$(document).on('click', ".vbd-view-vbd_rp", function (e) {

e.preventDefault();

var data_vbd_rp="vbd_method=readcontrol&vbd_key="+vbdGetKey()+"&rp_id="+$(this).data('item-id');


var xhrVBD= new XMLHttpRequest();
xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_rp/",true);
xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


xhrVBD.onreadystatechange= function () {
if(xhrVBD.readyState===4 && xhrVBD.status===200){

view_load_vbd_rp( xhrVBD.responseText)

}
if(xhrVBD.readyState<4){

}
};

xhrVBD.send(data_vbd_rp);

});



function view_load_vbd_rp( thisvbd){

try {


var json_vbd_rp=JSON.parse(thisvbd);
//start of submission check
if(json_vbd_rp['response']['state']===1 && json_vbd_rp['response']['result']['rows']>0){

$('#vbd_rp-item-view .vbd_rp-holder').text("");
$('#vbd_rp-modal-view').modal('show');

//vbToast('success','Record Successfully loaded!');

var jsonVOB= JSON.parse(json_vbd_rp['response']['result']['data-json'][0]);

        $('#vbd_rp-item-view .rp_email.vbd_rp-holder').text( jsonVOB['rp_email'] );
                $('#vbd_rp-item-view .user_id.vbd_rp-holder').text( jsonVOB['user_id'] );
                $('#vbd_rp-item-view .rp_code.vbd_rp-holder').text( jsonVOB['rp_code'] );
                $('#vbd_rp-item-view .rp_date.vbd_rp-holder').text( jsonVOB['rp_date'] );
                $('#vbd_rp-item-view .rp_date_exp.vbd_rp-holder').text( jsonVOB['rp_date_exp'] );
                $('#vbd_rp-item-view .rp_state.vbd_rp-holder').text( jsonVOB['rp_state'] );
        
$('#vbd_rp-modal-view').modal('show');

}
else
{
// checking for the errors
if(json_vbd_rp['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_vbd_rp['rq_fields']['missing']['count'] != undefined && json_vbd_rp['rq_fields']['missing']['count']!==0){
vbToast('warning','Missing request data');
} else if( json_vbd_rp['validate']['state'] != undefined && json_vbd_rp['validate']['state']===false){
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
* Date: 07/09/2019, Saturday
* Time: 02:59 AM
* Project/Module: Password Reset*/


var item_id_delete_vbd_rp=null;

$(document).on('click', ".vbd-action-link.vbd-askdelete-vbd_rp", function (e) {

e.preventDefault();
item_id_delete_vbd_rp=null;
var data_vbd_rp="vbd_method=readcontrol&vbd_key="+vbdGetKey()+"&rp_id="+$(this).data('item-id');


var xhrVBD= new XMLHttpRequest();
xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_rp/",true);
xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


xhrVBD.onreadystatechange= function () {
if(xhrVBD.readyState===4 && xhrVBD.status===200){

delete_load_vbd_rp( xhrVBD.responseText)

}
if(xhrVBD.readyState<4){

}
};

xhrVBD.send(data_vbd_rp);

});




// Open modal if data exist
function delete_load_vbd_rp( thisvbd ){

try {


var json_vbd_rp=JSON.parse(thisvbd);
//start of submission check
if(json_vbd_rp['response']['state']===1 && json_vbd_rp['response']['result']['rows']>0){

$('.vbuilder-delete-vbd_rp-holder').text("");
$('#vbd_rp-modal-delete').modal('show');

//vbToast('success','Password Reset successfully loaded!');

var jsonVOB= JSON.parse(json_vbd_rp['response']['result']['data-json'][0]);

$('.vbuilder-delete-vbd_rp-holder').text( jsonVOB['rp_id'] );
item_id_delete_vbd_rp=jsonVOB['rp_id'];

}
else
{
// checking for the errors
if(json_vbd_rp['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_vbd_rp['rq_fields']['missing']['count'] != undefined && json_vbd_rp['rq_fields']['missing']['count']!==0){
vbToast('warning','Missing request data');
} else if( json_vbd_rp['validate']['state'] != undefined && json_vbd_rp['validate']['state']===false){
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

$(document).on('click', ".vbd-action-link.vbd-delete-vbd_rp", function (e) {
e.preventDefault();


var data_vbd_rp="vbd_method=delete&vbd_key="+vbdGetKey()+"&rp_id="+item_id_delete_vbd_rp;


var xhrVBD= new XMLHttpRequest();
xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_rp/",true);
xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


xhrVBD.onreadystatechange= function () {
if(xhrVBD.readyState===4 && xhrVBD.status===200){

delete_execute_vbd_rp( xhrVBD.responseText)

}
if(xhrVBD.readyState<4){

}
};

xhrVBD.send(data_vbd_rp);

});


function delete_execute_vbd_rp( thisvbd){

try {



var json_vbd_rp=JSON.parse(thisvbd);

//start of submission check
if(json_vbd_rp['response']['state']===1){

item_id_update_vbd_rp=null;

if( json_vbd_rp['response']['result']['affected'] != undefined && json_vbd_rp['response']['result']['affected']>0){
vbToast('success','Password Reset deleted');
// load the list
reload_vbd_rp();

} else {
vbToast('success','None change applied');
}


}
else
{
// checking for the errors
if(json_vbd_rp['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_vbd_rp['rq_fields']['missing']['count'] != undefined && json_vbd_rp['rq_fields']['missing']['count']!==0){
vbToast('warning','Missing request data');
} else if( json_vbd_rp['validate']['state'] != undefined && json_vbd_rp['validate']['state']===false){
vbToast('warning','Wrong request data');
}else{
vbToast('warning','Error deleting Password Reset');
}

}
//end of submission check


} catch (e) {

vbToast('error','An error have occured during the request.');
console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
}

}



