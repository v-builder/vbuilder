
var VBD_KEY2="VBD_KEY2";

function camelizeStr(str) {

    return str
        .replace(/\s(.)/g, function($1) { return $1.toUpperCase(); })
        .replace(/\s/g, '')
        .replace(/^(.)/, function($1) { return $1.toLowerCase(); });

}

$('#vbuildingForm').on('submit', function(e) {

    // e.preventDefault();


    funcValidatedVbuilding();

return false;
    });

$('document').ready(function () {

    if(typeof(Storage)!=="undefined") {

        if(localStorage.vbuiler_colnr){

            $('#col_nr').val(localStorage.vbuiler_colnr);

        } else {
            localStorage.vbuiler_colnr=3;
        }
        // alert(localStorage.vbuiler_colnr);

    } else{
        $('#col_nr').val('2');
        console.log('vbuilder-err','Local Storage Not Supported');
    }
    generateColByNr();

});


$(document).on('click','#setCol',function (e) {
    e.preventDefault();
    $('.section-loader').show();
    if(typeof(Storage)!=="undefined") {
        localStorage.vbuiler_colnr=$('#col_nr').val();
        generateColByNr();
    } else{
        console.log('vbuilder-err','Local Storage Not Supported');
        generateColByNr();
    }

});

function autoGenCol() {
    $('.section-loader').show();
    if(typeof(Storage)!=="undefined") {

        if(!localStorage.vbuiler_colnr){
            localStorage.vbuiler_colnr=4;
        }
        generateColByNr();
    } else{
        console.log('vbuilder-err','Local Storage Not Supported');
        generateColByNr();
    }
}

function generateColByNr() {
    $('.section-loader').show();
    var colNr=3;
    var onlyappend=false;
    if(typeof(Storage)!=="undefined") {
        colNr=localStorage.vbuiler_colnr-1;
        // if(colNr)
    } else{
        console.log('vbuilder-err','Local Storage Not Supported');
    }
    $('#col_nr').val(localStorage.vbuiler_colnr);
    var holder=$('#cols-holder');
    var holderType=$('#cols-holder-t');
    var temp=0;
    holder.html('');
    holderType.html('');

    // holder.append(" <div id='col-id-holder' class='vform-item w-3-3 relative'>\n" +
    //     "                                <label for='col-id'> <span class='fa fa-key txt-blue'></span> COL-ID</label>\n" +
    //     "                                <input  id='col-id' value='vb_id' placeholder='column name' name='col-id' type='text' class='validate label-inside' required/>\n" +
    //     "<!--                                <input type='radio' id='del-col' class='item-radio-in option-box' value='1' name='del-col' required checked>-->\n" +
    //     "                            </div>");

    holder.append("<div class='col-12 col-md-3'><div class=\"md-form \"><label for='col-id'><span class='fa fa-key txt-blue'></span> PK</label>\n" +
        "    <input id='col-id' name='col-id' type='text' class='form-control' required=''>\n" +
        "       \n" +
        "        </div></div>");

    for (var i=1; i<=colNr; i++){
        temp=i+1;
        if(i===colNr){
            holder.append("<div class='col-12 col-md-3'><div class='md-form '>\n" +
                "                                    <label for='"+i+"'>"+temp+"COL</label>\n" +
                "                                    <input  id='"+i+"' name='"+i+"' type='text' class='form-control' required/>\n" +
                "     <input type='radio' id='del-col-"+i+"' class='item-radio-in option-box' value='"+i+"' name='del-col' required checked>\n" +
                "                                                          " +
                "</div></div>");
        } else{
            holder.append("<div class='col-12 col-md-3'><div class='md-form '>\n" +
                "                                    <label for='"+i+"'>"+temp+"COL</label>\n" +
                "                                    <input   id='"+i+"' name='"+i+"' type='text' class='form-control' required/>\n" +
                "     <input type='radio' id='del-col-"+i+"' class='item-radio-in option-box' value='"+i+"' name='del-col' required>\n" +
                "                                                          " +
                "</div></div>");


        }

        holderType.append(' <div class="col-12 mt-3">\n' +
            '                             <div class="md-formx vbd-md-formx colHolderT'+i+'">\n' +
            '\n' +
            '                                 <label for="colHolderLbl'+i+'"> Col '+i+' [ <span class="colHolderLbl'+i+'"></span> ] </label>\n' +
            '\n' +
            '                                 <select class="form-control d-block " id="colHolderTv'+i+'" name="colHolderLbl'+i+'" required="">\n' +
            '                                     <option value="1" selected>Text</option>\n' +
            '                                     <option value="8">Number</option>\n' +
            '                                     <option value="2">File</option>\n' +
            '                                     <option value="3">Date Time - Local</option>\n' +
            '                                     <option value="4">Date</option>\n' +
            '                                     <option value="5">Time</option>\n' +
            '                                     <option value="6">Radio</option>\n' +
            '                                     <option value="7">Check</option>\n' +
            '\n' +
            '                                 </select>\n' +
            '\n' +
            '                             </div>\n' +
            '\n' +
            '                         </div>');



    }

    $('.section-loader').fadeOut('slow');

}



function trimAndCorrectInput(elemHere){

    // elemHere.val( camelizeStr(elemHere.val()).trim() );
    elemHere.val( (elemHere.val()).trim() );
}

$(document).on('keyup','#cols-holder input',function (e) {
var tempVal=$(this).attr('id');

if($(".colHolderLbl"+tempVal)[0]){

    $(".colHolderLbl"+tempVal).text($(this).val());
}
// if($(this).attr('name')){
//
// }
    trimAndCorrectInput($(this));

});

$(document).on('keyup','#table-name',function (e) {
    trimAndCorrectInput($(this));
});



function funcValidatedVbuilding() {

    var gotFileType=false;

    var colNr=0;
    if(typeof(Storage)!=="undefined") {
        colNr=localStorage.vbuiler_colnr-1;
    } else{
        colNr=$('#col_nr').val();
        console.log('vbuilder-err','Local Storage Not Supported');
    }

    for (var i=1; i<=colNr; i++){
        if($('#colHolderTv'+i).val()==2){
            gotFileType=true;
        }
    }

    postAndSetContent("vgoal=object&vtarget=controller",'#object-output');
    postAndSetContent("vgoal=model&vtarget=controller",'#model-output');
    postAndSetContent("vgoal=modelpdo&vtarget=controller",'#modelpdo-output');
    postAndSetContent("vgoal=cadd&vtarget=controller",'#ct-add-w');

    if(gotFileType){

        $("#ct-addfdata-tg").show();
        postAndSetContent("vgoal=caddfdata&vtarget=controller",'#ct-addfdata-w');
        postAndSetContent("vgoal=formfdatajs&vtarget=controller",'#form-addfdata-output-js');
        postAndSetContent("vgoal=formupdatefdatajs&vtarget=controller",'#form-updatefdata-output-js');
    }
    else
        {

        $("#ct-addfdata-tg").hide();
    }

    postAndSetContent("vgoal=cindex&vtarget=controller",'#ct-index-w');
    postAndSetContent("vgoal=cupdate&vtarget=controller",'#ct-update-w');
    postAndSetContent("vgoal=cmodelc&vtarget=controller",'#ct-modelc-w');
    postAndSetContent("vgoal=cread&vtarget=controller",'#ct-read-w');
    postAndSetContent("vgoal=creadc&vtarget=controller",'#ct-readc-w');
    postAndSetContent("vgoal=cdelete&vtarget=controller",'#ct-delete-w');
    postAndSetContent("vgoal=cdeleteb&vtarget=controller",'#ct-deleteb-w');

    postAndSetContent("vgoal=controller&vtarget=controller",'#controller-output');

    postAndSetContent("vgoal=form&vtarget=controller",'#form-add-output');
    postAndSetContent("vgoal=formjs&vtarget=controller",'#form-add-output-js');

    postAndSetContent("vgoal=formview&vtarget=controller",'#form-sview-output');
    postAndSetContent("vgoal=formviewjs&vtarget=controller",'#form-sview-output-js');

    postAndSetContent("vgoal=formupdate&vtarget=controller",'#form-update-output');
    postAndSetContent("vgoal=formupdatejs&vtarget=controller",'#form-update-output-js');

    postAndSetContent("vgoal=formdelete&vtarget=controller",'#form-delete-output');
    postAndSetContent("vgoal=formdeletejs&vtarget=controller",'#form-delete-output-js');

    postAndSetContent("vgoal=list&vtarget=controller",'#form-list-output');
    postAndSetContent("vgoal=listjs&vtarget=controller",'#form-list-output-js');

    postAndSetContent("vgoal=page&vtarget=controller",'#form-page-output');

    postAndSetContent("vgoal=index&vtarget=controller",'#form-index-output');


    $('#startGenProjectFiles').show();


    showSnackBar('Generated');

    $('#outpu-trigger').trigger('click');
}

function requestModel(){
    var setState=1;
    if($('#set').val()=='on'){
        setState=1;
    } else{
        setState=0;
    }

    $(".item-radio-in").each(function () {
        // alert($(this).val());
    });


    var nopreloader=true;
    var preloader="";
    if($(this).data('preloader')){
        nopreloader=false;
        preloader=$(this).data('preloader');
    }
    var dataPreset="vgoal=model&vtarget=controller&vbd_key="+VBD_KEY2;
    var data=dataPreset+"&col-id="+$('#col-id').val()+"&module="+$('#vbuildingForm').find('#vbd_module').val()+"&table-name="+$('#table-name').val()+"&set="+setState+"&get=1&del-col="+$('.item-radio-in:checked').val();

    data=data+genRemainingUrl();

    // alert(data);
    // var url= "/processor/model/modelController.php";
    var url= VBD_ROOT+"/sycho.php";
    var content="none-v";

    var xhr= new XMLHttpRequest();
    xhr.open('POST',url,true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange= function () {
        if(xhr.readyState===4 && xhr.status===200){
            content=xhr.responseText;
            try {
                // alert(content);
            } catch (e) {
                showSnackBar('Invalid connection');
                console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
            }

            if(nopreloader===false){
                $(preloader).fadeOut("slow");
            }
        } else{
            if(nopreloader===false){
                $(preloader).show();
            }
        }
    };
    xhr.send(data);

}

function postAndSetContenttt(rule,loc){
    var setState=1;
    if($('#set').val()=='on'){
        setState=1;
    } else{
        setState=0;
    }

    $(".item-radio-in").each(function () {
        // alert($(this).val());
    });


    var nopreloader=true;
    var preloader="";
    if($(this).data('preloader')){
        nopreloader=false;
        preloader=$(this).data('preloader');
    }

    var data=rule+"&col-id="+$('#col-id').val()+"&module="+$('#vbuildingForm').find('#vbd_module').val()+"&table-name="+$('#table-name').val()+"&set="+setState+"&get=1&del-col="+$('.item-radio-in:checked').val()+"&vbd_key="+VBD_KEY2;

    data=data+genRemainingUrl();

    // alert(data);
    // var url= "/processor/model/modelController.php";
    var url= VBD_ROOT+"/sycho.php";
    var content="none-v";

    var xhr= new XMLHttpRequest();
    xhr.open('POST',url,true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange= function () {
        if(xhr.readyState===4 && xhr.status===200){
            content=xhr.responseText;
            try {

                $(loc).html(content);
            } catch (e) {
                showSnackBar('Ivalid Request: '+rule);
                console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
            }

            if(nopreloader===false){
                $(preloader).fadeOut("slow");
            }
        } else{
            if(nopreloader===false){
                $(preloader).show();
            }
        }
    };
    xhr.send(data);

    return content;
}

function postAndSetContent(rule,loc){
    var setState=1;
   /* if($('#set').val()=='on'){
        setState=1;
    } else{
        setState=0;
    }
*/
    $(".item-radio-in").each(function () {
        // alert($(this).val());
    });


    var nopreloader=true;
    var preloader="";
    if($(this).data('preloader')){
        nopreloader=false;
        preloader=$(this).data('preloader');
    }

    var data="vbd_key="+VBD_KEY2+"&"+rule+"&col-id="+$('#col-id').val()+
        "&module="+$('#vbuildingForm').find('#vbd_module').val()+
        "&table-name="+$('#table-name').val()+"&set="+setState+"&get=1&del-col="
        +$('.item-radio-in:checked').val();

    data=data+genRemainingUrl();

    // alert(data);
    // var url= "/processor/model/modelController.php";
    var url= VBD_ROOT+"/sycho.php";
    var content="none-v";

    var xhr= new XMLHttpRequest();
    xhr.open('POST',url,true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange= function () {
        if(xhr.readyState===4 && xhr.status===200){
            content=xhr.responseText;
            try {

                $(loc).html(content);
            } catch (e) {
                showSnackBar('Ivalid Request: '+rule);
                console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
            }

            if(nopreloader===false){
                $(preloader).fadeOut("slow");
            }
        } else{
            if(nopreloader===false){
                $(preloader).show();
            }
        }
    };
    xhr.send(data);

    return content;
}
function postAndSetContentT(rule,loc){
    var setState=1;
    if($('#set').val()=='on'){
        setState=1;
    } else{
        setState=0;
    }

    $(".item-radio-in").each(function () {
        // alert($(this).val());
    });


    var nopreloader=true;
    var preloader="";
    if($(this).data('preloader')){
        nopreloader=false;
        preloader=$(this).data('preloader');
    }

    var data=rule+"&col-id="+$('#col-id').val()+"&module="+$('#vbuildingForm').find('#vbd_module').val()+"&table-name="+$('#table-name').val()+"&set="+setState+"&get=1&del-col="+$('.item-radio-in:checked').val()+"&vbd_key="+VBD_KEY2;


    data=data+genRemainingUrl();

    // alert(data);
    // var url= "/processor/model/modelController.php";
    var url= VBD_ROOT+"/sycho.php";

    var response=jQuery.ajax({

        url: VBD_ROOT+"/sycho.php",
        data: data,
        type: "POST",
        success:function(data){

            $(loc).html(data);

        },
        error:function (){
            alert('err');
        }
    });
}






function genRemainingUrl() {
    var colNr=0;
    if(typeof(Storage)!=="undefined") {
        colNr=localStorage.vbuiler_colnr-1;
    } else{
        colNr=$('#col_nr').val();
        console.log('vbuilder-err','Local Storage Not Supported');
    }

    var data="";
    for (var i=1; i<=colNr; i++){
        // data=data+"&"+i+"="+$('#'+i).val();
        data=data+"&"+i+"="+$('#'+i).val()+"&"+"colHolderLbl"+i+"="+$('#colHolderTv'+i).val();
    }
    // alert(data);
    return data;
}






$(document).on('click','#genProjectFiles',function (e) {
    // e.preventDefault();

    // generateProjectFiles();
    showSnackBar('Starting Download');
    $('#vbdTempModal').modal('hide');
});
$(document).on('click','#startGenProjectFiles',function (e) {
    e.preventDefault();
    $('#vbuilder-main-supplier-content').show();
    $('#vbdTempModal').modal('show');
    showSnackBar('Preparing files');
    generateProjectFiles();


});


function generateProjectFiles(){


    var gotFileType=false;

    var colNr=0;
    if(typeof(Storage)!=="undefined") {
        colNr=localStorage.vbuiler_colnr-1;
    } else{
        colNr=$('#col_nr').val();
        console.log('vbuilder-err','Local Storage Not Supported');
    }

    for (var i=1; i<=colNr; i++){
        if($('#colHolderTv'+i).val()==2){
            gotFileType=true;
        }
    }
    //
    var setState=1;
    if($('#set').val()=='on'){
        setState=1;
    } else{
        setState=0;
    }

    $(".item-radio-in").each(function () {
        // alert($(this).val());
    });


    var nopreloader=true;
    var preloader="";
    if($(this).data('preloader')){
        nopreloader=false;
        preloader=$(this).data('preloader');
    }
    var url= VBD_ROOT+"/project_files.php/?";
    var content="none-v";


    // GET PAGES

    //PROCESSORS
    var contextObject=encodeURIComponent($('#object-output').text());
    var contextModel="NULL";

    var model_targert= $("input[name='model-vbuilder']:checked").val();

    contextModel=encodeURIComponent($('#modelpdo-output').text());

    var contextController=encodeURIComponent($('#controller-output').text());
    var contextPage=encodeURIComponent($('#form-page-output').text());

    //controlers
    var contextCtIndex=encodeURIComponent($('#ct-index-w').text());
    var contextCtAdd=encodeURIComponent($('#ct-add-w').text());
    var contextCtUpdate=encodeURIComponent($('#ct-update-w').text());
    var contextCtModelc=encodeURIComponent($('#ct-modelc-w').text());
    var contextCtDelete=encodeURIComponent($('#ct-delete-w').text());
    var contextCtDeletebase=encodeURIComponent($('#ct-deleteb-w').text());
    var contextCtRead=encodeURIComponent($('#ct-read-w').text());
    var contextCtReadc=encodeURIComponent($('#ct-readc-w').text());


    //VIEWS
    var contextIndex=encodeURIComponent($('#form-index-output').val());
    var contextAdd=encodeURIComponent($('#form-add-output').html());
    var contextView=encodeURIComponent($('#form-sview-output').val());
    var contextDelete=encodeURIComponent($('#form-delete-output').val());
    var contextUpdate=encodeURIComponent($('#form-update-output').val());
    var contextList=encodeURIComponent($('#form-list-output').val());

    var allJsContext=$("#form-list-output-js").text()+"\n "+$("#form-add-output-js").text();

    if(gotFileType){
        allJsContext=allJsContext+"\n" +$("#form-addfdata-output-js").text();
    }

    allJsContext=allJsContext+"\n "+$("#form-update-output-js").text();

    if(gotFileType){
        allJsContext=allJsContext+"\n" +$("#form-updatefdata-output-js").text();
    }

    allJsContext=allJsContext+"\n " +
        "\n" +$("#form-sview-output-js").text()+"\n" +$("#form-delete-output-js").text();



    var ContextJs=encodeURIComponent(allJsContext);

    var data="vbd_key="+VBD_KEY2+"&module="+$('#vbuildingForm').find('#vbd_module').val()+"&table-name="+$('#vbuildingForm').find('#table-name').val()+'&contextPage='+contextPage
        +'&contextModel='+contextModel+'&contextObject='+contextObject+'&contextController='+contextController
        +'&contextIndex='+contextIndex+'&contextAdd='+contextAdd+'&contextView='+contextView
        +'&contextDelete='+contextDelete+'&contextUpdate='+contextUpdate+'&contextList='+contextList
        +'&contextJs='+ContextJs+
        '&contextCtIndex='+contextCtIndex+'&contextCtAdd='+contextCtAdd+
        '&contextCtUpdate='+contextCtUpdate+'&contextCtModelc='+contextCtModelc+
        '&contextCtDelete='+contextCtDelete+'&contextCtDeletebase='+contextCtDeletebase+
        '&contextCtRead='+contextCtRead+'&contextCtReadc='+contextCtReadc;


    data=data+"&col-id="+$('#col-id').val()+
        "&module="+$('#vbuildingForm').find('#vbd_module').val()+
        "&table-name="+$('#table-name').val()+"&set="+setState+"&get=1&del-col="
        +$('.item-radio-in:checked').val();

    if(gotFileType){
        var contextAddfdata=encodeURIComponent($('#ct-addfdata-w').text());

        data=data+'&contextAddfdata='+contextAddfdata+genRemainingUrl();
    }
    // var href=url+data;

    // window.location.href=href;
    $('#vbdTempModal .modal-body').html('<p> Wait a few seconds.. </p>  <img class=" center-content vh-5" src="'+VBUILDER_APP_ROOT+'/lib/img/preloader.gif">');
    var response=jQuery.ajax({

        url: url,
        data: data,
        type: "POST",
        success:function(data){
            $("#vbdTempModal .modal-body").html(data);
        },
        error:function (){
            showSnackBar('error 559');
        }
    });

    // window.open(href);
    $('#vbdTempModal').modal('show');
}

