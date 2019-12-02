


// var navOffset=$("#ft-navegation").offset();
// var navOffsetTop=navOffset.top;

function getWidth(){
    return ((window.innerWidth > 0) ? window.innerWidth : screen.width);
}


$('#vbd-intro-slide').carousel({
    // interval: 10000
});

$(window).bind("load", function() {
    // hashOnloadScroll();

});

$(document).ready(function() {

    // setBannerMargin();
    if($(".se-pre-con")[0]){
        $(".se-pre-con").fadeOut("slow");
    }
    setBodyPadding();

    //
    // Tooltips Initialization
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    })

});



$(window).scroll(function() {
    // checkNavegation();

});
$(window).resize(function() {
    // setBannerMargin();

});




function setBodyPadding() {
    if($("#app-navegation-bar-w.fixed-top")[0]){
    // if(getWidth()<1100){

        var sbbox = document.getElementById("app-navegation-bar-w");

// width and height in pixels, including padding and border
// Corresponds to jQuery outerWidth(), outerHeight()
        var sbwidth = sbbox.offsetWidth;
        var sbheight = sbbox.offsetHeight;

// width and height in pixels, including padding, but without border
// Corresponds to jQuery innerWidth(), innerHeight()
        var sbwidth2 = sbbox.clientWidth;
        var sbheight2 = sbbox.clientHeight;

        $("body").css('padding-top',sbheight);

    // } else{
    //     $("#vbd-intro-slide").css('margin-top',0);
    // }
    }
}
