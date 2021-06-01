console.log($('.crea').width());
$creas = $('.crea')
$imgs = $('.img-fluid')

for(i=0; i<$creas.length; i++){
    $($creas[i]).height($('.crea').width())
}

for(i=0; i<$imgs.length; i++){
    if($imgs[i].width < $imgs[i].height){
        $($imgs[i]).addClass('h-100')
    }
    else{
        $($imgs[i]).addClass('w-100')
    }
    
}
$('.sail-crea').hide()
$('.name-crea').hide()

$('.crea').mouseenter(function(e){
    $(this).find($('.sail-crea')).fadeIn(200);
    $(this).find($('.name-crea')).fadeIn(200);

})

$('.crea').mouseleave(function(e){
   $(this).find($('.sail-crea')).fadeOut(200);
   $(this).find($('.name-crea')).fadeOut(200);
})