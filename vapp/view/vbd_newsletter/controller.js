/*<br/>
* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/ <br/>
* Author: Vayile Fumo<br/>
* Date: 27/10/2019, Sunday<br/>
* Time: 12:41 PM<br/>
* Project/Module: Newsletter<br/>*/

$(window).ready(function() {
// load the list
reload_vbd_newsletter();

});

function reload_vbd_newsletter() {


var data_vbd_newsletter="vbd_method=read&vbd_key="+vbdGetKey();


var url= VBUILDER_APP_ROOT+"/api/global/vbd_newsletter/";
var content_vbd_newsletter="none-v";

var xhr_vbd_newsletter= new XMLHttpRequest();
xhr_vbd_newsletter.open('POST',url,true);
xhr_vbd_newsletter.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr_vbd_newsletter.onreadystatechange= function () {

if(xhr_vbd_newsletter.readyState===4 && xhr_vbd_newsletter.status===200){

content_vbd_newsletter=xhr_vbd_newsletter.responseText;

try {

var json_vbd_newsletter=JSON.parse(content_vbd_newsletter);

//start of submission check
if(json_vbd_newsletter['response']['state']===1){
$('#vbd_newsletter-vbd-add-form').trigger("reset");
$('#vbd_newsletter-modal-add').modal('hide');
//vbToast('success','Records successfully loaded!');

$("#vbd_newsletter-table-list tbody").html("");

if(json_vbd_newsletter['response']['result']['rows']>0){

for ( var ix = 0; ix < json_vbd_newsletter['response']['result']['data-json'].length; ix++) {

var jsonVOB= JSON.parse(json_vbd_newsletter['response']['result']['data-json'][ix]);

/*$("#vbd_newsletter-table-list tbody").append('<tr>'+ '<td>'+ jsonVOB['ns_id'] +'  </td>' + '<td>'+ jsonVOB['ns_date'] +'  </td>' + '<td>'+ jsonVOB['ns_subject'] +'  </td>' + '<td>'+ jsonVOB['ns_body'] +'  </td>' + '<td>'+ jsonVOB['ns_altbody'] +'  </td>' + '<td>'+ jsonVOB['ns_cleanbody'] +'  </td>' + '<td>'+ jsonVOB['ns_attach'] +'  </td>' + '<td>'+ jsonVOB['user_id'] +'  </td>' + '<td>'+ jsonVOB['ns_cover'] +'  </td>' + '<td>'+ jsonVOB['ns_pdf'] +'  </td>' +  '<td class="vbd-actions-td">'+
        '<a href="javascript:;"  data-item-id'+'="'+jsonVOB['ns_id']+'" class="vbd-action-link vbd-update-vbd_newsletter" > <span class="fa fa-edit"></span> </a>'+
       '<a href="javascript:;" data-item-id'+'="'+jsonVOB['ns_id']+'" class="vbd-action-link vbd-view-vbd_newsletter ml-1" > <span class="fa fa-info-circle"></span> </a>'+
       '<a href="javascript:;"  data-item-id'+'="'+jsonVOB['ns_id']+'" class="vbd-action-link vbd-askdelete-vbd_newsletter ml-1" >'+
           ' <span class="fa fa-trash"></span>'+
        '</a> </td> </tr>');*/

    $("#vbd_newsletter-table-list tbody").append('<tr>'+  '<td>'+ jsonVOB['ns_subject'] +'  </td>' + '<td>'+ jsonVOB['ns_date'] +'  </td>' +  '<td class="vbd-actions-td">'+
        '<a href="javascript:;"  data-item-id'+'="'+jsonVOB['ns_id']+'" class="vbd-action-link vbd-update-vbd_newsletter" > <span class="fa fa-edit"></span> </a>'+
        '<a href="javascript:;" data-item-id'+'="'+jsonVOB['ns_id']+'" class="vbd-action-link vbd-view-vbd_newsletter ml-1" > <span class="fa fa-info-circle"></span> </a>'+
        '<a href="javascript:;" data-item-id'+'="'+jsonVOB['ns_id']+'" class="vbd-action-link vbd-view-c-vbd_newsletter ml-1" > <span class="fa fa-eye"></span> </a>'+
        '<a href="javascript:;"  data-item-id'+'="'+jsonVOB['ns_id']+'" class="vbd-action-link vbd-askdelete-vbd_newsletter ml-1" >'+
        ' <span class="fa fa-trash"></span>'+
        '</a> </td> </tr>');
}

}


}
else
{
// checking for the errors
if(json_vbd_newsletter['response']['state']===1920){

vbToast('warning','Please login. Error loading data');

} else if( json_vbd_newsletter['rq_fields']['missing']['count'] != undefined && json_vbd_newsletter['rq_fields']['missing']['count']!==0){
vbToast('warning','Error loading data. Missing');
} else if( json_vbd_newsletter['validate']['state'] != undefined && json_vbd_newsletter['validate']['state']===false){
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

console.log("vbuilder-submition-process",'Loading vbd_newsletter list data');

}
};
xhr_vbd_newsletter.send(data_vbd_newsletter);



}



 /*
* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Author: Vayile Fumo
* Date: 27/10/2019, Sunday
* Time: 12:41 PM
* Project/Module: Newsletter*/

$('form[name=vbd_newsletter-vbd-add-form]').on('submit', function(e) {

//uncomment the prevent bellow case an error appear, for debug
//e.preventDefault();
var this_fvalidate=true;

var thisForm=$(this);

if(this_fvalidate){
vbdDisableSubmit(thisForm);
this_fvalidate=false;

var data_preset_vbd_newsletter="vbd_method=add&vbd_key="+vbdGetKey();
var data_vbd_newsletter=data_preset_vbd_newsletter+'&'+$(this).serialize();


var url= VBUILDER_APP_ROOT+"/api/global/vbd_newsletter/";
var content_vbd_newsletter="none-v";

var xhr_vbd_newsletter= new XMLHttpRequest();
xhr_vbd_newsletter.open('POST',url,true);
xhr_vbd_newsletter.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr_vbd_newsletter.onreadystatechange= function () {

if(xhr_vbd_newsletter.readyState===4){
vbdEnableSubmit(thisForm);
this_fvalidate=true;
} else{
vbdDisableSubmit(thisForm);
this_fvalidate=false;
}

if(xhr_vbd_newsletter.readyState===4 && xhr_vbd_newsletter.status===200){
content_vbd_newsletter=xhr_vbd_newsletter.responseText;
try {



var json_vbd_newsletter=JSON.parse(content_vbd_newsletter);
//start of submission check
if(json_vbd_newsletter['response']['state']===1){

// load the list
reload_vbd_newsletter();

$('form[name=vbd_newsletter-vbd-add-form]').trigger("reset");
$('#vbd_newsletter-modal-add').modal('hide');
vbToast('success','Newsletter successfully added');
}
else
{
// checking for the errors
if(json_vbd_newsletter['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_vbd_newsletter['rq_fields']['missing']['count'] != undefined && json_vbd_newsletter['rq_fields']['missing']['count']!==0){
vbToast('warning','Please fill all required fields');
} else if( json_vbd_newsletter['validate']['state'] != undefined && json_vbd_newsletter['validate']['state']===false){
vbToast('warning','Fill the fields correctly');
} else if( json_vbd_newsletter['response']['result']['error'][1] != undefined && json_vbd_newsletter['response']['result']['error'][1]===1062){
vbToast('warning','Error. Duplicate entry');
} else{
vbToast('warning','Error adding Newsletter');
}

}
//end of submission check
} catch (e) {

vbToast('error','An error have occured during the request.');
console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
}
} else{

console.log("vbuilder-vbd_newsletter-submition-process",'Loading vbd_newsletter-vbd-add-form');

}
};
xhr_vbd_newsletter.send(data_vbd_newsletter);



} else{

vbToast('warning','Please fill all required fields');

}

return false;

});

/*
* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Author: Vayile Fumo
* Date: 27/10/2019, Sunday
* Time: 12:41 PM
* Project/Module: Newsletter*/



$('form[name=vbd_newsletter-vbd-addfdata-form]').on('submit', function(e) {

//uncomment the prevent bellow case an error appear, for debug
//e.preventDefault();
var this_fvalidate=true;

var thisForm=$(this);

// For upload
    var formFD_vbd_newsletter = document.forms.namedItem("vbd_newsletter-vbd-addfdata-form");
    formDataVB_vbd_newsletter = new FormData(formFD_vbd_newsletter);
    formDataVB_vbd_newsletter.append("vbd_method", "add-fdata");
    formDataVB_vbd_newsletter.append("vbd_key", vbdGetKey());
    // formDataVB.append("field_xx", "This is some extra data");


if(this_fvalidate){
vbdDisableSubmit(thisForm);
this_fvalidate=false;


var url= VBUILDER_APP_ROOT+"/api/global/vbd_newsletter/";
var content_vbd_newsletter="none-v";

var xhr_vbd_newsletter= new XMLHttpRequest();
xhr_vbd_newsletter.open('POST',url,true);
//xhr_vbd_newsletter.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr_vbd_newsletter.onreadystatechange= function () {

if(xhr_vbd_newsletter.readyState===4){
vbdEnableSubmit(thisForm);
this_fvalidate=true;
} else{
vbdDisableSubmit(thisForm);
this_fvalidate=false;
}

if(xhr_vbd_newsletter.readyState===4 && xhr_vbd_newsletter.status===200){
content_vbd_newsletter=xhr_vbd_newsletter.responseText;

try {



var json_vbd_newsletter=JSON.parse(content_vbd_newsletter);
//start of submission check
if(json_vbd_newsletter['response']['state']===1){

// load the list
reload_vbd_newsletter();

$('form[name=vbd_newsletter-vbd-addfdata-form]').trigger("reset");
$('#vbd_newsletter-modal-add').modal('hide');
vbToast('success','Newsletter successfully added');
}
else
{
// checking for the errors
if(json_vbd_newsletter['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_vbd_newsletter['rq_fields']['missing']['count'] != undefined && json_vbd_newsletter['rq_fields']['missing']['count']!==0){
vbToast('warning','Please fill all required fields');
} else if( json_vbd_newsletter['validate']['state'] != undefined && json_vbd_newsletter['validate']['state']===false){
vbToast('warning','Fill the fields correctly');
} else if( json_vbd_newsletter['response']['result']['error'][1] != undefined && json_vbd_newsletter['response']['result']['error'][1]===1062){
vbToast('warning','Error. Duplicate entry');
} else{
vbToast('warning','Error adding Newsletter');
}

}
//end of submission check
} catch (e) {

vbToast('error','An error have occured during the request.');
console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
}
} else{

console.log("vbuilder-vbd_newsletter-submition-process",'Loading vbd_newsletter-vbd-add-form');

}
};
xhr_vbd_newsletter.send(formDataVB_vbd_newsletter);



} else{

vbToast('warning','Please fill all required fields');

}

return false;

});


 /*
* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Author: Vayile Fumo
* Date: 27/10/2019, Sunday
* Time: 12:41 PM
* Project/Module: Newsletter*/

var item_id_update_vbd_newsletter=null;

$(document).on('click', ".vbd-update-vbd_newsletter", function (e) {

e.preventDefault();

item_id_update_vbd_newsletter=null;
$('form[name=vbd_newsletter-vbd-updatefdata-form]').trigger("reset");




var data_vbd_newsletter="vbd_method=readcontrol&vbd_key="+vbdGetKey()+"&ns_id="+$(this).data('item-id');


var xhrVBD= new XMLHttpRequest();
xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_newsletter/",true);
xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


xhrVBD.onreadystatechange= function () {
if(xhrVBD.readyState===4 && xhrVBD.status===200){

update_load_vbd_newsletter( xhrVBD.responseText);

}
if(xhrVBD.readyState<4){

}
};

xhrVBD.send(data_vbd_newsletter);

});



function update_load_vbd_newsletter( thisvbd){

try {


var json_vbd_newsletter=JSON.parse(thisvbd);
//start of submission check
if(json_vbd_newsletter['response']['state']===1){

$('form[name=vbd_newsletter-vbd-update-form]').trigger("reset");

//vbToast('success','Newsletter successfully loaded!');

var jsonVOB= JSON.parse(json_vbd_newsletter['response']['result']['data-json'][0]);
item_id_update_vbd_newsletter=jsonVOB['ns_id'];

        $('form[name=vbd_newsletter-vbd-updatefdata-form] input[name=ns_date]').val( jsonVOB['ns_date'] );
        $('form[name=vbd_newsletter-vbd-updatefdata-form] input[name=ns_subject]').val( jsonVOB['ns_subject'] );
        $('form[name=vbd_newsletter-vbd-updatefdata-form] textarea[name=ns_body]').val( jsonVOB['ns_body'] );
        $('form[name=vbd_newsletter-vbd-updatefdata-form] textarea[name=ns_altbody]').val( jsonVOB['ns_altbody'] );
        $('form[name=vbd_newsletter-vbd-updatefdata-form] textarea[name=ns_cleanbody]').val( jsonVOB['ns_cleanbody'] );
        // $('form[name=vbd_newsletter-vbd-updatefdata-form] input[name=ns_attach]').val( jsonVOB['ns_attach'] );
        // $('form[name=vbd_newsletter-vbd-updatefdata-form] input[name=user_id]').val( jsonVOB['user_id'] );
        // $('form[name=vbd_newsletter-vbd-updatefdata-form] input[name=ns_cover]').val( jsonVOB['ns_cover'] );
        // $('form[name=vbd_newsletter-vbd-updatefdata-form] input[name=ns_pdf]').val( jsonVOB['ns_pdf'] );

        // get upload
        vbdLoadUploadHelper(jsonVOB['ns_attach'], $("#vbd_newsletter-ns_attach-update-vbd-upd"), 0);

                // get upload
        vbdLoadUploadHelper(jsonVOB['ns_cover'], $("#vbd_newsletter-ns_cover-update-vbd-upd"), 0);

                // get upload
        vbdLoadUploadHelper(jsonVOB['ns_pdf'], $("#vbd_newsletter-ns_pdf-update-vbd-upd"), 0);

        
$('#vbd_newsletter-modal-update').modal('show');

}
else
{
// checking for the errors
if(json_vbd_newsletter['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_vbd_newsletter['rq_fields']['missing']['count'] != undefined && json_vbd_newsletter['rq_fields']['missing']['count']!==0){
vbToast('warning','Missing request data');
} else if( json_vbd_newsletter['validate']['state'] != undefined && json_vbd_newsletter['validate']['state']===false){
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



$('form[name=vbd_newsletter-vbd-update-form]').on('submit', function(e) {

//uncomment the prevent bellow case an error appear, for debug
//e.preventDefault();
var this_fvalidate=true;

var thisForm=$(this);

if(this_fvalidate){
vbdDisableSubmit(thisForm);
this_fvalidate=false;

var data_preset_vbd_newsletter="vbd_method=update&vbd_key="+vbdGetKey()+"&ns_id="+item_id_update_vbd_newsletter;
var data_vbd_newsletter=data_preset_vbd_newsletter+'&'+$(this).serialize();


var url= VBUILDER_APP_ROOT+"/api/global/vbd_newsletter/";
var content_vbd_newsletter="none-v";

var xhr_vbd_newsletter= new XMLHttpRequest();
xhr_vbd_newsletter.open('POST',url,true);
xhr_vbd_newsletter.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr_vbd_newsletter.onreadystatechange= function () {


if(xhr_vbd_newsletter.readyState===4){
vbdEnableSubmit(thisForm);
this_fvalidate=true;
} else{
vbdDisableSubmit(thisForm);
this_fvalidate=false;
}


if(xhr_vbd_newsletter.readyState===4 && xhr_vbd_newsletter.status===200){
content_vbd_newsletter=xhr_vbd_newsletter.responseText;
try {


var json_vbd_newsletter=JSON.parse(content_vbd_newsletter);
//start of submission check
if(json_vbd_newsletter['response']['state']===1){
item_id_update_vbd_newsletter=null;

$('form[name=vbd_newsletter-vbd-update-form]').trigger("reset");
$('#vbd_newsletter-modal-update').modal('hide');

if( json_vbd_newsletter['response']['result']['affected'] != undefined && json_vbd_newsletter['response']['result']['affected']>0){
vbToast('success','Newsletter updated');
// load the list
reload_vbd_newsletter();

} else {
vbToast('success','None change applied');
}

}
else
{
// checking for the errors
if(json_vbd_newsletter['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_vbd_newsletter['rq_fields']['missing']['count'] != undefined && json_vbd_newsletter['rq_fields']['missing']['count']!==0){
vbToast('warning','Please fill all required fields');
} else if( json_vbd_newsletter['validate']['state'] != undefined && json_vbd_newsletter['validate']['state']===false){
vbToast('warning','Fill the fields correctly');
} else if( json_vbd_newsletter['response']['result']['error'][1] != undefined && json_vbd_newsletter['response']['result']['error'][1]===1062){
vbToast('warning','Error. Duplicate entry');
} else{
vbToast('warning','Error updating Newsletter');
}

}
//end of submission check

} catch (e) {

vbToast('error','An error have occured during the request.');
console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
}
} else{

console.log("vbuilder-vbd_newsletter-submition-process",'Loading vbd_newsletter-vbd-update-form');

}
};
xhr_vbd_newsletter.send(data_vbd_newsletter);



} else{

vbToast('warning','Please fill all required fields');

}
return false;

});

/*
* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Author: Vayile Fumo
* Date: 27/10/2019, Sunday
* Time: 12:41 PM
* Project/Module: Newsletter*/


$('form[name=vbd_newsletter-vbd-updatefdata-form]').on('submit', function(e) {

//uncomment the prevent bellow case an error appear, for debug
//e.preventDefault();
var this_fvalidate=true;

var thisForm=$(this);

// For upload
    var formFD_vbd_newsletter = document.forms.namedItem("vbd_newsletter-vbd-updatefdata-form");
    formDataVB_vbd_newsletter = new FormData(formFD_vbd_newsletter);
    formDataVB_vbd_newsletter.append("vbd_method", "update");
    formDataVB_vbd_newsletter.append("vbd_key", vbdGetKey());
    formDataVB_vbd_newsletter.append("ns_id", item_id_update_vbd_newsletter );
    // formDataVB.append("field_xx", "This is some extra data");


if(this_fvalidate){
vbdDisableSubmit(thisForm);
this_fvalidate=false;


var url= VBUILDER_APP_ROOT+"/api/global/vbd_newsletter/";
var content_vbd_newsletter="none-v";

var xhr_vbd_newsletter= new XMLHttpRequest();
xhr_vbd_newsletter.open('POST',url,true);
//xhr_vbd_newsletter.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr_vbd_newsletter.onreadystatechange= function () {

if(xhr_vbd_newsletter.readyState===4){
vbdEnableSubmit(thisForm);
this_fvalidate=true;
} else{
vbdDisableSubmit(thisForm);
this_fvalidate=false;
}

if(xhr_vbd_newsletter.readyState===4 && xhr_vbd_newsletter.status===200){
content_vbd_newsletter=xhr_vbd_newsletter.responseText;
// alert(content_vbd_newsletter);
try {



var json_vbd_newsletter=JSON.parse(content_vbd_newsletter);
//start of submission check
if(json_vbd_newsletter['response']['state']===1){

// load the list
reload_vbd_newsletter();

$('form[name=vbd_newsletter-vbd-updatefdata-form]').trigger("reset");
$('#vbd_newsletter-modal-update').modal('hide');
vbToast('success','Newsletter successfully updated');
}
else
{
// checking for the errors
if(json_vbd_newsletter['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_vbd_newsletter['rq_fields']['missing']['count'] != undefined && json_vbd_newsletter['rq_fields']['missing']['count']!==0){
vbToast('warning','Please fill all required fields');
} else if( json_vbd_newsletter['validate']['state'] != undefined && json_vbd_newsletter['validate']['state']===false){
vbToast('warning','Fill the fields correctly');
} else if( json_vbd_newsletter['response']['result']['error'][1] != undefined && json_vbd_newsletter['response']['result']['error'][1]===1062){
vbToast('warning','Error. Duplicate entry');
} else{
vbToast('warning','Error adding Newsletter');
}

}
//end of submission check
} catch (e) {

vbToast('error','An error have occured during the request.');
console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
}
} else{

console.log("vbuilder-vbd_newsletter-submition-process",'Loading vbd_newsletter-vbd-add-form');

}
};
xhr_vbd_newsletter.send(formDataVB_vbd_newsletter);



} else{

vbToast('warning','Please fill all required fields');

}

return false;

});


 
/*<br/>
* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/ <br/>
* Author: Vayile Fumo<br/>
* Date: 27/10/2019, Sunday<br/>
* Time: 12:41 PM<br/>
* Project/Module: Newsletter<br/>*/


$(document).on('click', ".vbd-send-vbd_newsletter", function (e) {

e.preventDefault();

    var thisForm=$("form[name=vbd_newsletter-vbd-updatefdata-form]");

    vbdDisableSubmit(thisForm);

var data_vbd_newsletter="vbd_method=send&vbd_key="+vbdGetKey()+"&ns_id="+item_id_update_vbd_newsletter;


var xhrVBD= new XMLHttpRequest();
xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_newsletter/",true);
xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


xhrVBD.onreadystatechange= function () {
if(xhrVBD.readyState===4 && xhrVBD.status===200){
    vbdEnableSubmit(thisForm);





    var content_vbd_newsletter=xhrVBD.responseText;

    // alert(content_vbd_newsletter);

    try {



        var json_vbd_newsletter=JSON.parse(content_vbd_newsletter);
//start of submission check
        if(json_vbd_newsletter['response']['state']===1){

// load the list
            reload_vbd_newsletter();

            $('form[name=vbd_newsletter-vbd-addfdata-form]').trigger("reset");
            $('#vbd_newsletter-modal-add').modal('hide');
            vbToast('success','Newsletter Sent');
        }
        else
        {
// checking for the errors
            if(json_vbd_newsletter['response']['state']===1920){

                vbToast('warning','Please login');

            } else if( json_vbd_newsletter['rq_fields']['missing']['count'] != undefined && json_vbd_newsletter['rq_fields']['missing']['count']!==0){
                vbToast('warning','Please fill all required fields');
            } else if( json_vbd_newsletter['validate']['state'] != undefined && json_vbd_newsletter['validate']['state']===false){
                vbToast('warning','Fill the fields correctly');
            } else if( json_vbd_newsletter['response']['result']['error'][1] != undefined && json_vbd_newsletter['response']['result']['error'][1]===1062){
                vbToast('warning','Error. Duplicate entry');
            } else{
                vbToast('warning','Error sending Newsletter');
            }

        }
//end of submission check
    } catch (e) {

        vbToast('error','An error have occured during the request.');
        console.log("vbuilder-error",'Error requesting json || Message: '+e.message);

        }

}
if(xhrVBD.readyState<4){
    vbdDisableSubmit(thisForm);
}
};

xhrVBD.send(data_vbd_newsletter);

});

$(document).on('click', ".vbd-view-vbd_newsletter", function (e) {

e.preventDefault();

var data_vbd_newsletter="vbd_method=readcontrol&vbd_key="+vbdGetKey()+"&ns_id="+$(this).data('item-id');


var xhrVBD= new XMLHttpRequest();
xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_newsletter/",true);
xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


xhrVBD.onreadystatechange= function () {
if(xhrVBD.readyState===4 && xhrVBD.status===200){

view_load_vbd_newsletter( xhrVBD.responseText)

}
if(xhrVBD.readyState<4){

}
};

xhrVBD.send(data_vbd_newsletter);

});



function view_load_vbd_newsletter( thisvbd){

try {


var json_vbd_newsletter=JSON.parse(thisvbd);
//start of submission check
if(json_vbd_newsletter['response']['state']===1 && json_vbd_newsletter['response']['result']['rows']>0){

$('#vbd_newsletter-item-view .vbd_newsletter-holder').text("");
$('#vbd_newsletter-modal-view').modal('show');

//vbToast('success','Record Successfully loaded!');

var jsonVOB= JSON.parse(json_vbd_newsletter['response']['result']['data-json'][0]);

        $('#vbd_newsletter-item-view .ns_date.vbd_newsletter-holder').text( jsonVOB['ns_date'] );
                $('#vbd_newsletter-item-view .ns_subject.vbd_newsletter-holder').text( jsonVOB['ns_subject'] );
                $('#vbd_newsletter-item-view .ns_body.vbd_newsletter-holder').text( jsonVOB['ns_body'] );
                $('#vbd_newsletter-item-view .ns_altbody.vbd_newsletter-holder').text( jsonVOB['ns_altbody'] );
                $('#vbd_newsletter-item-view .ns_cleanbody.vbd_newsletter-holder').text( jsonVOB['ns_cleanbody'] );
                $('#vbd_newsletter-item-view .ns_attach.vbd_newsletter-holder').text( jsonVOB['ns_attach'] );
                $('#vbd_newsletter-item-view .user_id.vbd_newsletter-holder').text( jsonVOB['user_id'] );
                $('#vbd_newsletter-item-view .ns_cover.vbd_newsletter-holder').text( jsonVOB['ns_cover'] );
                $('#vbd_newsletter-item-view .ns_pdf.vbd_newsletter-holder').text( jsonVOB['ns_pdf'] );
        

                // get upload
                vbdLoadUploadHelper(jsonVOB['ns_attach'], $("#vbd_newsletter-ns_attach-vbd-upd"), 0);

                                // get upload
                vbdLoadUploadHelper(jsonVOB['ns_cover'], $("#vbd_newsletter-ns_cover-vbd-upd"), 0);

                                // get upload
                vbdLoadUploadHelper(jsonVOB['ns_pdf'], $("#vbd_newsletter-ns_pdf-vbd-upd"), 0);

                $('#vbd_newsletter-modal-view').modal('show');

}
else
{
// checking for the errors
if(json_vbd_newsletter['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_vbd_newsletter['rq_fields']['missing']['count'] != undefined && json_vbd_newsletter['rq_fields']['missing']['count']!==0){
vbToast('warning','Missing request data');
} else if( json_vbd_newsletter['validate']['state'] != undefined && json_vbd_newsletter['validate']['state']===false){
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












// start of complete view

$(document).on('click', ".vbd-view-c-vbd_newsletter", function (e) {

    e.preventDefault();

    var data_vbd_newsletter="vbd_method=readcontrol&vbd_key="+vbdGetKey()+"&ns_id="+$(this).data('item-id');


    var xhrVBD= new XMLHttpRequest();
    xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_newsletter/",true);
    xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    xhrVBD.onreadystatechange= function () {
        if(xhrVBD.readyState===4 && xhrVBD.status===200){

            viewc_load_vbd_newsletter( xhrVBD.responseText)

        }
        if(xhrVBD.readyState<4){

        }
    };

    xhrVBD.send(data_vbd_newsletter);

});



function viewc_load_vbd_newsletter( thisvbd){

    $('.sentNs').text('0');
    $('.sentNsError').text('0');
    $('.sentNsTotal').text('0');

    try {


        var json_vbd_newsletter=JSON.parse(thisvbd);
//start of submission check
        if(json_vbd_newsletter['response']['state']===1 && json_vbd_newsletter['response']['result']['rows']>0){

            $('#vbd_newsletter-item-view-c .vbd_newsletter-holder').text("");
            $('#vbd_newsletter-modal-view-c').modal('show');

            var jsonVOB= JSON.parse(json_vbd_newsletter['response']['result']['data-json'][0]);

            $('.ns_subject').text(jsonVOB['ns_subject']);
            viewc_load_vbd_newsletterFinalize(jsonVOB['ns_id']);

        }
        else
        {
// checking for the errors
            if(json_vbd_newsletter['response']['state']===1920){

                vbToast('warning','Please login');

            } else if( json_vbd_newsletter['rq_fields']['missing']['count'] != undefined && json_vbd_newsletter['rq_fields']['missing']['count']!==0){
                vbToast('warning','Missing request data');
            } else if( json_vbd_newsletter['validate']['state'] != undefined && json_vbd_newsletter['validate']['state']===false){
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



function viewc_load_vbd_newsletterFinalize(nsID) {


    var data_vbd_ns_mail="vbd_method=read-complete&vbd_key="+vbdGetKey();

    var sentNs=0;
    var sentNsError=0;
    var sentNsTotal=0;

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

                            if(nsID!=jsonVOB['ns_id']){
                                continue;
                            }

                            if(jsonVOB['ns_state']=='true'){
                                sentNs++;
                            } else {
                                sentNsError++;
                            }
                            sentNsTotal++;

                            $('.sentNs').text(sentNs);
                            $('.sentNsError').text(sentNsError);
                            $('.sentNsTotal').text(sentNsTotal);

                            $("#vbd_ns_mail-table-list tbody").append('<tr>'+ '<td>'+ jsonVOB['ns_id'] +'. '+jsonVOB['ns_subject']+'  </td>'+ '<td>'+ jsonVOB['nsemail_email'] +'  </td>'  + '<td>'+ jsonVOB['nsmail_date'] +'  </td>' + '<td class="'+((jsonVOB['ns_state']=='true')? 'bg-success' : 'bg-danger')+'">' +'  </td>' +  '<td class="vbd-actions-td">'+
                                '</td> </tr>');
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

// end of complete view


/*
* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/ 
* Author: Vayile Fumo
* Date: 27/10/2019, Sunday
* Time: 12:41 PM
* Project/Module: Newsletter*/


var item_id_delete_vbd_newsletter=null;

$(document).on('click', ".vbd-action-link.vbd-askdelete-vbd_newsletter", function (e) {

e.preventDefault();
item_id_delete_vbd_newsletter=null;
var data_vbd_newsletter="vbd_method=readcontrol&vbd_key="+vbdGetKey()+"&ns_id="+$(this).data('item-id');


var xhrVBD= new XMLHttpRequest();
xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_newsletter/",true);
xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


xhrVBD.onreadystatechange= function () {
if(xhrVBD.readyState===4 && xhrVBD.status===200){

delete_load_vbd_newsletter( xhrVBD.responseText)

}
if(xhrVBD.readyState<4){

}
};

xhrVBD.send(data_vbd_newsletter);

});




// Open modal if data exist
function delete_load_vbd_newsletter( thisvbd ){

try {


var json_vbd_newsletter=JSON.parse(thisvbd);
//start of submission check
if(json_vbd_newsletter['response']['state']===1 && json_vbd_newsletter['response']['result']['rows']>0){

$('.vbuilder-delete-vbd_newsletter-holder').text("");
$('#vbd_newsletter-modal-delete').modal('show');

//vbToast('success','Newsletter successfully loaded!');

var jsonVOB= JSON.parse(json_vbd_newsletter['response']['result']['data-json'][0]);

$('.vbuilder-delete-vbd_newsletter-holder').text( jsonVOB['ns_id'] );
item_id_delete_vbd_newsletter=jsonVOB['ns_id'];

}
else
{
// checking for the errors
if(json_vbd_newsletter['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_vbd_newsletter['rq_fields']['missing']['count'] != undefined && json_vbd_newsletter['rq_fields']['missing']['count']!==0){
vbToast('warning','Missing request data');
} else if( json_vbd_newsletter['validate']['state'] != undefined && json_vbd_newsletter['validate']['state']===false){
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

$(document).on('click', ".vbd-action-link.vbd-delete-vbd_newsletter", function (e) {
e.preventDefault();


var data_vbd_newsletter="vbd_method=delete&vbd_key="+vbdGetKey()+"&ns_id="+item_id_delete_vbd_newsletter;


var xhrVBD= new XMLHttpRequest();
xhrVBD.open("POST",VBUILDER_APP_ROOT+"/api/global/vbd_newsletter/",true);
xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


xhrVBD.onreadystatechange= function () {
if(xhrVBD.readyState===4 && xhrVBD.status===200){

delete_execute_vbd_newsletter( xhrVBD.responseText)

}
if(xhrVBD.readyState<4){

}
};

xhrVBD.send(data_vbd_newsletter);

});


function delete_execute_vbd_newsletter( thisvbd){

try {



var json_vbd_newsletter=JSON.parse(thisvbd);

//start of submission check
if(json_vbd_newsletter['response']['state']===1){

item_id_update_vbd_newsletter=null;

if( json_vbd_newsletter['response']['result']['affected'] != undefined && json_vbd_newsletter['response']['result']['affected']>0){
vbToast('success','Newsletter deleted');
// load the list
reload_vbd_newsletter();

} else {
vbToast('success','None change applied');
}


}
else
{
// checking for the errors
if(json_vbd_newsletter['response']['state']===1920){

vbToast('warning','Please login');

} else if( json_vbd_newsletter['rq_fields']['missing']['count'] != undefined && json_vbd_newsletter['rq_fields']['missing']['count']!==0){
vbToast('warning','Missing request data');
} else if( json_vbd_newsletter['validate']['state'] != undefined && json_vbd_newsletter['validate']['state']===false){
vbToast('warning','Wrong request data');
}else{
vbToast('warning','Error deleting Newsletter');
}

}
//end of submission check


} catch (e) {

vbToast('error','An error have occured during the request.');
console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
}

}



