
function vbdAjaxHelper(methodvbd,urlvbd,datavbd){
var data_result_vbd=">>";

    var xhrVBD= new XMLHttpRequest();
    xhrVBD.open(methodvbd,urlvbd,true);
    xhrVBD.setRequestHeader("Content-type", "application/x-www-form-urlencoded");


    xhrVBD.onreadystatechange= function () {
        if(xhrVBD.readyState===4 && xhrVBD.status===200){
            data_result_vbd=xhrVBD.responseText;

 }
        if(xhrVBD.readyState<4){
  
        }
    };

    xhrVBD.send(datavbd);

return data_result_vbd;
}



$(document).on("click",".vbd-action-link",function (e) {
    e.preventDefault();
});





function $vbdHelper(vbdHelperDataI){


    var elemX=this;
    var elemV=this;
    vbdHelperDataI.forEach(function(elementX) {
        var keyX = Object.getOwnPropertyNames(elementX);
        elemV[keyX]= [Object.values(elementX),""];
    });


    function _affectIt(elementX, tempFunc){
        // tempFunc(Object.values(this[elementX]));

        tempFunc( elementX );
    }

    function _changeIt(keyElementX,valueX){

        this[keyElementX][1]=valueX;
        var tempVar=this[keyElementX][0];
        // $(tempVar+"").prepend("fdsfdf");
        // $(tempVar).append("ffdfd");
        if($(""+tempVar)[0]){
            $(""+this[keyElementX][0]).each(function () {

                var tagNameV =$(this).get( 0 ).nodeName+"";
                tagNameV=tagNameV.toLowerCase();
                if(tagNameV==='img'){
                    $(this).attr('src',valueX);
                } else if (tagNameV==="table"){
                    $(this).html(valueX);
                }  else{
                    $(this).text(valueX);
                }

            })
        }
    }

    return Object.values(this);

}


function vbdHumanFileSize(bytes, si) {
    var thresh = si ? 1000 : 1024;
    if(Math.abs(bytes) < thresh) {
        return bytes + ' B';
    }
    var units = si
        ? ['kB','MB','GB','TB','PB','EB','ZB','YB']
        : ['KiB','MiB','GiB','TiB','PiB','EiB','ZiB','YiB'];
    var u = -1;
    do {
        bytes /= thresh;
        ++u;
    } while(Math.abs(bytes) >= thresh && u < units.length - 1);
    return bytes.toFixed(1)+' '+units[u];
}
