

/*
* Created by VBuilder | https://www.linkedin.com/in/vayile-fumo-a22a66170/
* Author: Vayile Fumo
* Date: 18/09/2019, Wednesday
* Time: 08:35 PM
* Project/Module: Connection Action*/

$(document).on('click','.cr-trigger.cr-add-it, .trigger-connection.tg-add-it', function(e) {

//uncomment the prevent bellow case an error appear, for debug
//e.preventDefault();
        var this_fvalidate=true;

        var thisBtn=$(this);


        if(this_fvalidate){

                thisBtn.attr('disabled', true);
                this_fvalidate=false;

                var data_preset_connection_request="vbd_method=add&vbd_key="+vbdGetKey()+"&to_user_id="+$(this).data('user-id');
                var data_connection_request=data_preset_connection_request+'&'+$(this).serialize();


                var url= VBUILDER_APP_ROOT+"/api/global/connection_request/";
                var content_connection_request="none-v";
                var elemVBLoader=$('.vbd-submition-loader.cr-trigger-loader');

                var xhr_connection_request= new XMLHttpRequest();
                xhr_connection_request.open('POST',url,true);
                xhr_connection_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr_connection_request.onreadystatechange= function () {

                        if(xhr_connection_request.readyState===4){
                                elemVBLoader.fadeOut(300);
                                thisBtn.attr('disabled', false);
                                this_fvalidate=true;
                        } else{
                                elemVBLoader.fadeIn(300);
                                this_fvalidate=false;
                        }

                        if(xhr_connection_request.readyState===4 && xhr_connection_request.status===200){
                                content_connection_request=xhr_connection_request.responseText;
                                try {



                                        var json_connection_request=JSON.parse(content_connection_request);
//start of submission check
                                        if(json_connection_request['response']['state']===1){

// load the list
                                                vbdToastClear();

                                                if(thisBtn.hasClass('trigger-connection')){
thisBtn.removeClass('tg-add-it');
thisBtn.addClass('tg-remove-it');
                                                }
                                                 else{

                                                        $('.cr-trigger.cr-remove-it').removeClass('d-none');
                                                        $('.cr-trigger.cr-add-success').removeClass('d-none');
                                                        $('.cr-trigger.cr-add-it').addClass('d-none');
                                                }




                                                vbToast('success','Connected');
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

                                                        // vbToast('warning','Connection already exist');

                                                        vbdToastClear();
                                                        vbToast('success','Connected');

                                                        if(thisBtn.hasClass('trigger-connection')){
                                                                thisBtn.removeClass('tg-add-it');
                                                                thisBtn.addClass('tg-remove-it');
                                                        } else{

                                                                $('.cr-trigger.cr-remove-it').removeClass('d-none');
                                                                $('.cr-trigger.cr-add-success').removeClass('d-none');
                                                                $('.cr-trigger.cr-add-it').addClass('d-none');

                                                        }


                                                } else{
                                                        vbToast('warning','Error while Connecting');
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

$(document).on('click', '.cr-trigger.cr-remove-it, .trigger-connection.tg-remove-it',function(e) {

//uncomment the prevent bellow case an error appear, for debug
//e.preventDefault();
        var this_fvalidate=true;

        var thisBtn=$(this);

        if(this_fvalidate){

                thisBtn.attr('disabled', true);
                this_fvalidate=false;

                var data_preset_connection_request="vbd_method=deletebase&vbd_key="+vbdGetKey()+"&to_user_id="+$(this).data('user-id');
                var data_connection_request=data_preset_connection_request+'&'+$(this).serialize();


                var url= VBUILDER_APP_ROOT+"/api/global/connection_request/";
                var content_connection_request="none-v";
                var elemVBLoader=$('.vbd-submition-loader.cr-trigger-loader');

                var xhr_connection_request= new XMLHttpRequest();
                xhr_connection_request.open('POST',url,true);
                xhr_connection_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr_connection_request.onreadystatechange= function () {

                        if(xhr_connection_request.readyState===4){
                                elemVBLoader.fadeOut(300);

                                thisBtn.attr('disabled', false);
                                this_fvalidate=true;
                        } else {
                                elemVBLoader.fadeIn(300);
                                this_fvalidate=false;
                        }

                        if(xhr_connection_request.readyState===4 && xhr_connection_request.status===200){
                                content_connection_request=xhr_connection_request.responseText;
                                try {



                                        var json_connection_request=JSON.parse(content_connection_request);
//start of submission check
                                        if(json_connection_request['response']['state']===1){

                                                vbdToastClear();
// load the list
                                                if(thisBtn.hasClass('trigger-connection')){
                                                        thisBtn.removeClass('tg-remove-it');
                                                        thisBtn.addClass('tg-add-it');
                                                } else{
                                                        $('.cr-trigger.cr-remove-it').addClass('d-none');
                                                        $('.cr-trigger.cr-add-success').addClass('d-none');
                                                        $('.cr-trigger.cr-add-it').removeClass('d-none');
                                                }



                                                vbToast('success','Disconnected');
                                        }
                                        else
                                        {
// checking for the errors
                                                if(json_connection_request['response']['state']===1920){

                                                        vbToast('warning','Please login');

                                                }
// checking for the errors
                                                if(json_connection_request['response']['state']===2){

                                                        vbToast('warning','Connection doesn\'t exist');

                                                } else if( json_connection_request['rq_fields']['missing']['count'] != undefined && json_connection_request['rq_fields']['missing']['count']!==0){
                                                        vbToast('warning','Please fill all required fields');
                                                } else if( json_connection_request['validate']['state'] != undefined && json_connection_request['validate']['state']===false){
                                                        vbToast('warning','Fill the fields correctly');
                                                } else{
                                                        vbToast('error','Error while Disconnecting');
                                                }

                                        }
//end of submission check
                                } catch (e) {

                                        vbToast('error','An error have occured during the request.');
                                        console.log("vbuilder-error",'Error requesting json || Message: '+e.message);
                                }
                        } else{

                                console.log("vbuilder-connection_request-submition-process",'Loading disconnect connection_request-vbd-add-form');

                        }
                };
                xhr_connection_request.send(data_connection_request);



        } else{

                vbToast('warning','Please fill all required fields');

        }

        return false;

});
