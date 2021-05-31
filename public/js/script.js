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
    $contact.replaceWith($('<span>' + $contact.text() + '</span>')); 
}
if (url.includes("about_me")){
    $about_me = $('#about_me')
    $about_me.replaceWith($('<span>' + $about_me.text() + '</span>'));
}
if (url.includes("web")){
    $web = $('#web')
    $web.replaceWith($('<span>' + $web.text() + '</span>'));
}
if (url.includes("graphisme")){
    $graphisme = $('#graphisme')
    $graphisme.replaceWith($('<span>' + $graphisme.text() + '</span>'));
}

// créas
