var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
  return new bootstrap.Popover(popoverTriggerEl)
})


$(".button").mouseenter(function(e) {
    $(this).removeClass("button-anim-out")
    $(this).addClass("button-anim-in")
})

$(".button").mouseleave(function(e) {
    $(this).removeClass("button-anim-in")
    $(this).addClass("button-anim-out")
})

var url = window.location.href; 

if( url.includes("contact")){
    $contact = $('#contact')
    $contact.addClass('disabled active'); 
    $contact.attr('tabindex', "-1"); 
    $contact.attr('aria-disabled', 'true'); 
}
if (url.includes("about_me")){
    $about_me = $('#about_me')
    $about_me.addClass('disabled active'); 
    $about_me.attr('tabindex', "-1"); 
    $about_me.attr('aria-disabled', 'true'); 
}
if (url.includes("web")){
    $web = $('#web')
    $web.addClass('disabled active'); 
    $web.attr('tabindex', "-1"); 
    $web.attr('aria-disabled', 'true'); 
}
if (url.includes("graphisme")){
    $graphisme = $('#graphisme')
    $graphisme.addClass('disabled active'); 
    $graphisme.attr('tabindex', "-1"); 
    $graphisme.attr('aria-disabled', 'true'); 
}

// $message_sent = $(".message-sent")

// if($message_sent.length > 0){
//     $("#message_save").replaceWith('')
// }

// ----------accueil

$(document).ready(function(){
	$('#nav-icon1').click(function(){
        $(this).toggleClass('open');
    });
    
});
// console.log($('#btn-slider').position().left)

$('#btn-slider').click(function() {
    if($('#buttons').hasClass('btn-hidden')){
        if ($(window).width()<1201){
            $('#buttons').animate({top : '50%'})
        }else{
            $('#buttons').animate({left : '55%'})
        }
        $('#buttons').removeClass('btn-hidden')
        $('#buttons').addClass('btn-visible')
    }else{
        if ($(window).width()<1201){
            $('#buttons').animate({top : '0%'})
        }else{
            $('#buttons').animate({left : '25%'})
        }
        $('#buttons').removeClass('btn-visible')
        $('#buttons').addClass('btn-hidden')
    }
})