$section1 = $('.div-logo-kichoton');
$logo_kichoton = $('.div-logo-kichoton').find("img");
$section2 = $(".next");
$next = $(".next").find("img");
$section3 = $(".twitch");
$logo_twitch = $(".twitch").find(".logo-twitch");
$text_twitch = $(".twitch").find(".text-twitch");
$twitch_p = $text_twitch.find('p')
$section4 = $(".embed");
$embed = $("#twitch-embed");

$logo_kichoton.hide();
$next.hide();
$logo_twitch.hide();
// $text_twitch.hide();
$embed.hide();

$( document ).ready(function() {
    $section1.removeClass("d-none");
    $logo_kichoton.delay(600).fadeIn(1000);
    $section2.delay(1600).removeClass("d-none");
    $next.delay(1600).fadeIn(1000);

    

    $(document).scroll(function(){
        console.log('jécoute')
        console.log($(document).scrollTop());
        $topPos = $(document).scrollTop();
        if($topPos > 322){
            $logo_twitch.fadeIn(1000);
        }if($topPos > 422){
            $(document).stop()
            var showText = function (target, message, index, interval) {   
                if (index < message.length) {
                  $(target).append(message[index++]);
                  setTimeout(function () { showText(target, message, index, interval); }, interval);
                }
            }
            for(let i=0; i < $twitch_p.length; i++){
                if(!$($twitch_p[i]).hasClass('text-displayed')){
                    let text = $twitch_p[i].innerText;
                    $($twitch_p[i]).empty();
                    $($twitch_p[i]).removeClass("d-none");
                    $($twitch_p[i]).addClass("text-displayed");
                    $(function () {
                        showText($twitch_p[i], text, 0, 100);   
                    });
                }                
            }

            // Essayer de faire en sorte que les event se lance l'un après l'auter 
            

            
        }
    })
});
