$(function(){
    $('.back-to-top').on('click', function(){
        $("html, body").animate({scrollTop: 0}, 500);
    });

    $('.fancybox-login').fancybox({
        nextEffect: 'none',
        prevEffect: 'none'
    });

    $(window).on('load scroll resize', function(){
        var winWidth = $(window).outerWidth();
        if(winWidth > 1500) {
            $('.floating').show();
            $('.floating').css({
                '-webkit-transform': 'translateY(' + $(window).scrollTop() + 'px)',
                'transform': 'translateY(' + $(window).scrollTop() + 'px)',
                '-webkit-transition-duration': '1s',
                'transition-duration': '1s'
            });
        }
        else {
            $('.floating').hide();
        }
    });
});