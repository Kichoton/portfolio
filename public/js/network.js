
$(document).ready(function() {
    $btn_network = $('.btn-network');
    console.log($($btn_network[0]).find('span'))
    console.log($btn_network[0].classList[1])
    
    for(let i=0; i < $btn_network.length; i++){
        
        $($btn_network[i]).css({
            "border-color": $btn_network[i].classList[1],
            "color": $btn_network[i].classList[1]
        })
        
    }

    $btn_network_w = $btn_network.width();
    $($btn_network).find('span').css('display','none');
    $btn_network.css('width','50px');
    
    $btn_network.delay(1000).animate({'width': $btn_network_w});
    $($btn_network).find('span').delay(1050).fadeIn()
});