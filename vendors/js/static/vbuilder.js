
$(document).on('click','.vbuilder-lang-change',function (e) {

    e.preventDefault();
    var nopreloader=true;
    var preloader="";
    if($(this).data('preloader')){
        nopreloader=false;
        preloader=$(this).data('preloader');
    }

    var url="/core/changeLang";
    var data="key="+$(this).data('key');
    // alert(url);
    var xhr= new XMLHttpRequest();
    xhr.open('POST',url,true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange= function () {
        if(xhr.readyState===4 && xhr.status===200){
            content=xhr.responseText;
            try {
                var json=JSON.parse(content);

                if(json.state==1){
                    location.reload();
                }

            } catch (e) {
                showSnackBar('An error hav occured while changing lang.');
                console.log("vbuilder-error",'Error requesting json for lang || Message: '+e.message);
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


});

/*
window.ready= function () {

    var btn= document.getElementsByClassName('btn-responsive');
    var nav= document.getElementsByClassName('navegation');
    btn.onclick= function () {
        nav.style.display="block!important";
        alert('dfs');
    }
};

window.onload=  btn();


function btn() {
    btn.onclick = function () {

       var btn = document.getElementsByClassName('btn-responsive'); v
        nav.style.display = "block!important";
        alert('dfs');
    };

         var min=$(this).attr('data-responsive');
      if(min==="yes"){
          $('ul.navegation').css('display','none');
      }


}*/
var vpages;
$(document).on('click', ".content-window-target",function () {

    var nrw= $(this).data("content-window-multiple-class");
    if(nrw==="no"){
        var present=$(".content-window-target.present-w");
        present.removeClass("present-w");
        $(this).addClass("present-w");
        var previous= present.data("content-window-id");
        var next= $(this).data("content-window-id");

        $("#"+previous).removeClass("present-w");

        $("#"+next).addClass("present-w");
    }

    else {


        var present=$(".content-window-target.present-w."+nrw);
        present.removeClass("present-w");
        $(this).addClass("present-w");
        var previous= present.data("content-window-id");
        var next= $(this).data("content-window-id");

        $("#"+previous).removeClass("present-w");

        $("#"+next).addClass("present-w");


    }


});

//
// $(document).on('click', ".content-window-target.cw-1",function () {
//
//
//     var present=$(".content-window-target.present-w.cw-1");
//     present.removeClass("present-w");
//     $(this).addClass("present-w");
//     var previous= present.data("content-window-id");
//     var next= $(this).data("content-window-id");
//
//     $("#"+previous).removeClass("present-w");
//
//     $("#"+next).addClass("present-w");
//
// });




function enventContentChange() {
    $(".content-change").each(function () {
        var location=$(this).data("content-change-location");
        var url=$(this).data("content-change-url");
        var auto=$(this).data("content-change-auto");

        if(auto=='yes'){

            vpages["var" + location] = changeContent(url, location);
console.log(43);
        }


    });

}


$(document).on('click', ".nav-bar a", function() {
    var elem=this;
    $(".nav-bar .navegation li").removeClass("present-w");
    $(this).parent().addClass("present-w");
});

$(document).on('click', ".disabled-btn", function(e) {
   e.preventDefault();
});


$(document).on('click', ".rtc", function(e) {
    e.preventDefault();
// window.location
//     =$(this).attr('href');

    if($(this).data('rtc-title')){
        document.title= $(this).data('rtc-title');
    }

    window.history.pushState('','',$(this).attr('href'));

});
// $(".bla").live('click', function(){ ... }

$(document).on('click', ".content-change",function enventContent() {

    var location=$(this).data("content-change-location");
    var url=$(this).data("content-change-url");
    var repeat=$(this).data("content-change-repeat");
    // alert("clicked");
    if(repeat=="no"){
        // none repeat?
        var exist=false;
        for(var key in vpages)
        {
            if(key==="var"+location){
                exist=true;
            }
            // var value = arr[key];
            // document.write(key + " = " + value + '<br>');
        }
        if(!exist){
            vpages["var"+location]= location;
        }
    } else{
        if(!$(this).parent().hasClass('present-w')&&!$(this).hasClass('present-w')) {

        }
        changeContent(url, location,this);
        vpages["var"+location]= location;
   // alert("repeated change");
    }
});

function showSnackBar(text) {

    $("#vsnackbar").html(text);
    var x = document.getElementById("vsnackbar");
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
function showSnackBarTimed(text,time) {

    $("#vsnackbar").html(text);
    var x = document.getElementById("vsnackbar");
    x.className = "show";
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, time);
}

///COPY TEXT
function copyText(elem) {

    // alert("click");
    var id = $(elem).data("copy-text-id");

    var el = document.getElementById(id);
    var range = document.createRange();
    range.selectNodeContents(el);
    var sel = window.getSelection();
    sel.removeAllRanges();
    sel.addRange(range);
    document.execCommand('copy');
    $(elem).addClass("txt-black");
    showSnackBar('copied.');
    // alert("Contents copied to clipboard.");
    return false;
}
function copyHtml(elem) {
    var id = $(elem).data("copy-text-id");
    var str= $('#'+id).html();
    // Create new element
    var el = document.createElement('textarea');
    el.value = str;
    // Set non-editable to avoid focus and move outside of view
    el.setAttribute('readonly', '');
    el.style = {position: 'absolute', left: '-9999px'};
    document.body.appendChild(el);
    // Select text inside element
    el.select();
    // Copy text to clipboard
    document.execCommand('copy');
    // Remove temporary element
    document.body.removeChild(el);
    showSnackBar('copied.');
    return false;
}
function copyVal(elem) {
    var id = $(elem).data("copy-text-id");
    var str= $('#'+id).val();
    // Create new element
    var el = document.createElement('textarea');
    el.value = str;
    // Set non-editable to avoid focus and move outside of view
    el.setAttribute('readonly', '');
    el.style = {position: 'absolute', left: '-9999px'};
    document.body.appendChild(el);
    // Select text inside element
    el.select();
    // Copy text to clipboard
    document.execCommand('copy');
    // Remove temporary element
    document.body.removeChild(el);
    showSnackBar('copied.');
    return false;
}

$(document).on('click', ".copy-text-by-id",function () {
    copyText(this);
});
$(document).on('click', ".copy-html-by-id",function () {
    copyHtml(this);
});

$(document).on('click', ".copy-val-by-id",function () {
    copyVal(this);
});


$.each($('.code-to-convert'), function (index, obj) {
    $(this).text($(this).html());
});
function bytesToSize(bytes) {
    var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    if (bytes == 0) return '0 Byte';
    var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
    return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
};

// $.each($('.put-in-other'), function (index, obj) {
//     alert("ok");
//         // alert("goi");
//         var id = $(this).data("id-to-put");
//         // var el = document.getElementById(id);
//         $("#"+id).text($(this).html());
//
// });

// $.each(data, function() {
//     $.each(this, function(k, v) {
//         $(this).text($(this).html());
//     });
// });
//END COPYTEXT

// ASSISTANCE WINDOW CALL
function viewWindow(elem){
    var dataId = $(elem).data("window-id");

    $("#"+dataId).show();
    $(".assistance").show();

}

$(document).on('click', ".assistance-window-call",function () {

    viewWindow(this);
});

$(document).on('click', ".assistance-window-close",function () {

    closeWindow(this);
});
function closeWindow(elem){
    var dataId = $(elem).data("window-id");
    $(".assistance").hide();
    $("#"+dataId).hide();
}

$.each($('.put-in-other'), function (index, obj) {
    var id = $(this).data("id-to-put");
    // var el = document.getElementById(id);
    // $("#"+id).text($(this).html());
    placeInOtherId(".put-in-other",id,this);
    // alert("done");
});

function checkInputValue(elem){
    var label= $("label");
var input=elem;
    var labelA="";

    label.each(function () {
        labelA=$(this).attr("for");

        var local=$('#'+labelA);
        var fieldType= local.tagName;
        // alert(fieldType);
        var data=$(local).val();
        var type=$(local).attr('type');
        if(local.value){
            if(type!=='checkbox'&& type!=='radio'){
                $(this).addClass("label-highlight");
            }



        } else{

            if(($(this).hasClass("label-inside"))){
                // alert('fdf');
                $(this).addClass("label-controled");
            }
            // $(this).removeClass("label-highlight");
        }
        if(type=='checkbox'){
            var chks=local.checked;
            if(chks){
                $(this).addClass("label-highlight");
            } else{
                $(this).removeClass("label-highlight");
            }
        }
        if(fieldType=="SELECT"){
            // var slc=local.val();
            // if(local.attr('disab'))
           // alert('value selc:'+data);
           if(data==null){
               $(this).removeClass("label-highlight");
           } else{
               $(this).addClass("label-highlight");
           }
        }

        if(type=='radio'){
            // var name= $(this).attr('name');
            // $.each($('input'), function (index, obj) {
            //     var inputName = $(this).attr('name');
            //
            // });
            var radio=local.selected;
            if(radio){
                $(this).addClass("label-highlight");
            } else{
                $(this).removeClass("label-highlight");
            }
        }

        // var type= local.attr("type");
        // if(type==="checkbox"||type==="radio"){
        //     $(this).removeClass("label-controled");
        // }


    });
}
// END ASSISTANCE WINDOW CALL
$('document').ready(

  function () {
// convert html
//       $('code').each(function() {
//           $(this).text($(this).html());
//       });

      checkInputValue(this);


// END CHECK FORM VARIABLES

          $(document).on('click', ".btn-responsive", function () {
              var nav= $(this).data('nav-id');
              // alert('#'+nav);
         var cssbtn= $('#'+nav).css('display');
         if (cssbtn==='none'){
             $('#'+nav).css('display','block');
         }
         if (cssbtn==='block'){
             $('#'+nav).css('display','none');
         }

     }
      );



          $(document).on('click', ".cbo-call", function () {
              var nav= $(this).data('cbo-id');
              // alert('#'+nav);
         var cssbtn= $('#'+nav).css('display');
         if (cssbtn==='none'){
             $('#'+nav).css('display','block');
         }
         if (cssbtn==='block'){
             $('#'+nav).css('display','none');
         }

     }
      );

    // $(document).on('click', ".menu-btn",function () {
    //
    //           var menulist= $('.menu-list').css('display');
    //
    //           if (menulist==='none'){
    //               $('.menulist').css('display','block');
    //           }
    //           if (menulist==='block'){
    //               $('.menulist').css('display','none');
    //           }
    //
    //
    //       }
    //   );



//       $(document).on('click', function () {
//
// var base= $(this);
//
//           // $.each($('.navegation'), function (index, obj) {
//           //     var cssbtn= $(this).css('display');
//           //     if (cssbtn==='block'){
//           //         $(this).css('display','none');
//           //     }
//           // });
//
//           $.each($('.cbo-call'), function (elem1) {
//               var nav= $(this).data('cbo-id');
//               var elem=document.getElementById(nav);
//               // alert(nav);
//               var cssbtn= $(nav).css('display');
//               if (cssbtn==='block'&&this!==base){
//                   // $(elem).css('display','none');
//               }
//               if (elem1===this){
//                   alert("this");
//               }
//           });
//       });





      ///MENU

      $(document).on('click', ".btn-menu",function () {
              var cssbtn= $('.menu-list').css('display');
              if (cssbtn==='none'){
                  $('.menu-list').css('display','block');
              }
              if (cssbtn==='block'){
                  $('.menu-list').css('display','none');
              }

          }
      );


  }
);

$(window).ready(function() {
    // Animate loader off screen

    $(".se-pre-con").fadeOut("slow");
    // $(".se-pre-con").hide();
    vpages= new Object();



    //
    $.each($('.validate-on-load .validate'), function (index, obj) {
    var validateValue= validateInput(this,true);
    });
    // $('form.validate-on-load').on('each','.validate', function () {
    //     var validateValue= validateInput(this,true);
    // });
});

if($('.content-change')[0]){

    enventContentChange();
}

function reloadPage(){
    //alert('sup');
    window.location.reload();
}



function vGetContent(url){
    var nopreloader=true;
    if($(this).data('preloader')){
        nopreloader=false;
    }
    // $(".se-pre-con").show();
var content="none";

    var xhr= new XMLHttpRequest();
    xhr.open('GET',url,true);
    xhr.onreadystatechange= function () {
        if(xhr.readyState===4 && xhr.status===200){
          content=xhr.responseText;
            if(nopreloader==false){
                $(".se-pre-con").show();
            }
        } else{
            if(nopreloader==false){
                $(".se-pre-con").show();
            }
        }
    };
    xhr.send();
    return content;
}



function changeContent(url,target){
    // $(".se-pre-con").show();
    var content="none";
    var location=$(target);
    var xhr= new XMLHttpRequest();
    xhr.open('GET',url,true);
    xhr.onreadystatechange= function () {
        if(xhr.readyState===4 && xhr.status===200){
            // $(window).ready(function() {
            //     // Animate loader off screen

            // });
            // var json=JSON.parse(xhr.responseText);
            location.html(xhr.responseText);
            content=xhr.responseText;
            // location.innerHTML=xhr.responseText;
            // .innerHTML= "fdfdf";
            // target.innerHTML=<;
// alert("readed");


            if(allPagePreload===true){
                $(".se-pre-con").fadeOut("slow");
            }

        } else{
            // $(window).ready(function() {
            //     // Animate loader off screen
            if(allPagePreload===true){
                $(".se-pre-con").show();
            }
            // });
        }
    };

    xhr.send();
    return content;
}

function changeContentPost(url,data,target){

    var response=jQuery.ajax({

        url: url,
        data: data,
        type: "POST",
        success:function(data){
            $(target).html(data);
        },
        error:function (){
          showSnackBar('error 559');
        }
    });
}

if($('.nav-fixed-top').length){
    $('body').addClass('padding-nav-fixed-top');
}
function changeContent(url,target,elem){
    // $(".se-pre-con").show();
    var content="none";
    var location=$(target);
    var xhr= new XMLHttpRequest();
    xhr.open('GET',url,true);
    xhr.onreadystatechange= function () {
        if(xhr.readyState===4 && xhr.status===200){
            // $(window).ready(function() {
            //     // Animate loader off screen

            // });
            // var json=JSON.parse(xhr.responseText);
            location.html(xhr.responseText);
            content=xhr.responseText;
            // location.innerHTML=xhr.responseText;
            // .innerHTML= "fdfdf";
            // target.innerHTML=<;
// alert("readed");

            if($(elem).data('callback')){
                executeFunction($(elem).data('callback'));
            }
            if(allPagePreload===true){
                $(".se-pre-con").fadeOut("slow");
            }

        } else{
            // $(window).ready(function() {
            //     // Animate loader off screen
            if(allPagePreload===true){
                $(".se-pre-con").show();
            }
            // });
        }
    };

    xhr.send();
    return content;
}


$(document).on('focus', "input",function () {
    var label= $("label");
    label.each(function () {

            $(this).removeClass("label-highlight");


    });
    checkInputValue();

    var forName= $(this).attr("id");

    var labelA="";
    label.each(function () {
        labelA=$(this).attr("for");
        if(labelA===forName){
            // alert("found");
            $(this).addClass("label-highlight");
            $(this).removeClass("label-controled");
        }

    });
    // alert(forName);
});
$(document).on('focus', "select",function () {
    var label= $("label");
    label.each(function () {

            $(this).removeClass("label-highlight");


    });
    checkInputValue();

    var forName= $(this).attr("id");

    var labelA="";
    label.each(function () {
        labelA=$(this).attr("for");
        if(labelA===forName){
            // alert("found");
            $(this).addClass("label-highlight");
            $(this).removeClass("label-controled");
        }

    });
    // alert(forName);
});

$(document).on('blur','input',function () {
    checkInputValue();

});
$(document).on('focus', "textarea",function () {
    var label= $("label");
    label.each(function () {

            $(this).removeClass("label-highlight");


    });
    checkInputValue();

    var forName= $(this).attr("id");

    var labelA="";
    label.each(function () {
        labelA=$(this).attr("for");
        if(labelA===forName){
            // alert("found");
            $(this).addClass("label-highlight");
            $(this).removeClass("label-controled");
        }

    });
    // alert(forName);
});

$(document).on('blur', "input.validate",function () {
    checkInputValue(this);
    validateInput(this,false);

});
$(document).on('blur', "textarea.validate",function () {
    checkInputValue(this);
    validateInput(this,false);

});
$(document).on('blur', "select.validate",function () {
    checkInputValue(this);
    validateInput(this,false);


});
$(document).on('keyup', "input.validate",function () {
    checkInputValue(this);
    validateInput(this,false);

});
$(document).on('keyup', "textarea.validate",function () {
    checkInputValue(this);
    validateInput(this,false);

});
$(document).on('keyup', "select.validate",function () {
    checkInputValue(this);
    validateInput(this,false);

});

$(document).on('click', ".action-link-prevent a.action-link",function (e) {
   e.preventDefault();

});

function executeFunction(func){
    eval(func+"()");
}
$(document).on('submit', "form.vform-frame",function () {

    var theForm= $(this);
    var results= ["one","last"];

// var inError=0;
    $.each($(theForm).find('.validate'), function (index, obj) {
        var err= validateInput(this,true);
        if(err!==0){
            results.push("err");
        }
    });

// if(err!==0){
//
// }

    if(($(this).data('auto-submit')) && !(($(this).data('auto-submit'))==='yes')){


        // var target='next';
        //
        // $('funcValidated')[target]();
        // $(this)[funcValidated]();
        var funcVD=false, funcIV=false;

        var funcValidated=$(this).data('func-validated');
        if($(this).data('func-validated')){
            funcVD=true;

        }
        var funcInvalidated=$(this).data('func-invalidated');
        if($(this).data('func-invalidated')){
            funcIV=true;

        }


        // alert('set false to auto submit');
        // alert(funcInvalidated);
        // alert(funcValidated);
        if(results.length>2){
            if(funcIV){
                // eval('funcInvalidated'+"()");
                executeFunction(funcInvalidated);
            } else{
                alert('Error in Invalidated function or not defined');
            }

        } else{
            if(funcVD){
                // eval('funcValidated'+"()");
                executeFunction(funcValidated);
            } else{
                alert('Error in Validated function or not defined');
            }

        }
        return false;
    } else{
        alert('auto-submit');
        if(results.length>2){
            return false;
        } else{
            alert('good to submit');
            return true;
        }
    }

});


function validateInput(elem,scroll) {
    var fieldType=elem.tagName;
    // alert(fieldType);
    var data=$(elem).val();
    var identifier=$(elem).attr('id');

    var inErr=0;
    $(elem).removeClass("input-invalidated-css");
    $(elem).addClass("input-validated-css");
 if(fieldType=='SELECT'){

     // start check selecttttttttttttttttttttttt

     if($(elem).attr('required')){
         if(data==null){
             inErr=434;
         }
     }

     // end check selecttttttttttttttttttttttt
 } else{
     // START CHECKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKKK
     // $(elem).css('border-color','#0c7ea7');
     var type="fdf";
     if($(elem).attr('type')){
         type=$(elem).attr('type');
     }

if(data!=''){
      if(type=="email"){
             var regExp=/..@..+[.]+../;
             if(!regExp.test(data)) {
               inErr=4343;
             }
         } 
       }
     // alert(data);
     var dlength=$(elem).val().length;


     if((data=='')|| (data=null)){
         if($(elem).attr('required')){
             inErr=79;
         }
     } else{
      

     }

if(dlength>0){
    if(type=="number"){

        if(isNaN($(elem).val())){
            // alert(dlength);
            inErr=4343;
        }
}

}


         // alert(dlength);


         if($(elem).attr('minlength')){

             var minl=$(elem).attr('minlength');
             if(dlength<minl){
                 inErr=434;
                 // if(submit){
                 //     results.push("err");
                 // }
                 // alert('less than expected');
             }
         }
         if($(elem).attr('maxlength')){
             var maxl=$(elem).attr('maxlength');
             if(dlength>maxl){
                 inErr=434;

                 // alert('bigger than expected');
             }
         }





     // end chk
 }
    if(inErr!==0) {
        inErr = 55;
        // $(elem).css('border-color','#C41515');
        $(elem).removeClass("input-validated-css");
        $(elem).addClass("input-invalidated-css");

        if(scroll){
            $('html, body').animate({
                scrollTop: ($("#"+identifier).offset())
            }, 1200);

        }
    }
    if($('#'+identifier+'-vbuilder-error').css('display')){
        var errorPlace=$('#'+identifier+'-vbuilder-error');
        if(inErr===0){
            errorPlace.css('display','none');
        } else{
            errorPlace.css('display','block');
        }

    }
return inErr;
}


function placeInOtherId(fromTagWithIndetifier,toId) {
    var el = document.getElementById(toId);
    var text= $(fromTagWithIndetifier).html();
    el.innerText=text;
}

function placeInOtherId(fromTagWithIndetifier,toId,elem) {
    var el = document.getElementById(toId);
    var text= $(elem).html();
    el.innerText=text;
}



// //Start of Ajax Request
// var nopreloader=true;
// var preloader="";
// if($(this).data('preloader')){
//     nopreloader=false;
//     preloader=$(this).data('preloader');
// }
// data="host="+$('#host').val()+"&port="+$('#port').val()+"&user="+$('#user').val()+"&password="+$('#password').val()+"&db="+$('#database').val();
// var url= "/processor/connection/connectionCheck.php";
// var content="none-v";
//
// var xhr= new XMLHttpRequest();
// xhr.open('POST',url,true);
// xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
// xhr.onreadystatechange= function () {
//     if(xhr.readyState===4 && xhr.status===200){
//         content=xhr.responseText;
//         try {
//             if(JSON.parse(content)){
//                 var json=JSON.parse(content);
//                 alert('The connection is: '+json.result);
//             } else{
//                 alert('Invalid connection');
//             }
//         } catch (e) {
//             alert('Invalid connection');
//             console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
//         }
//
//         if(nopreloader===false){
//             $(preloader).fadeOut("slow");
//         }
//     } else{
//         if(nopreloader===false){
//             $(preloader).show();
//         }
//     }
// };
// xhr.send(data);
//
// // End of ajax request

$(document).on('click', ".supplier-closer",function () {

    var supplier="#"+$(this).data('supplier');


    $(supplier).find('.supplier-content').fadeOut(100);
    $(supplier).fadeOut(500);

    if($(supplier).data('clear-supplier')) {
        if ($(supplier).data('clear-img')) {
            var imgSrc = $(supplier).data('clear-img');
            $(supplier).find('.supplier-content').html('<br/><br/>  <img class="supplier-clear-loading center-content vh-5" src="' + imgSrc + '"><br/><br/>');

        } else {
            $(location).html('');
        }
    }

});

$(document).on('click', ".supplier-opener",function () {
    var supplier="#"+$(this).data('supplier');

    $(supplier).fadeIn(150);
    $(supplier).find('.supplier-content').fadeIn(500);

});


// DRAG

function doSortable() {
    $(".vbuilder_sort_table tbody").sortable({


        update: function (event, ui) {
            $(this).children().each(function (index) {
                $(this).data('idd',index + 1);
                $(this).find('td').last().html(index + 1)
            });
        }
    });
}

// $(doSortable);