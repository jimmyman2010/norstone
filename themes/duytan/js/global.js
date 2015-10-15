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
            var top = $(window).scrollTop();
            $('.floating')
                .show()
                .css({
                    '-webkit-transform': 'translateY(' + top + 'px)',
                    '-ms-transform': 'translateY(' + top + 'px)',
                    '-o-transform': 'translateY(' + top + 'px)',
                    'transform': 'translateY(' + top + 'px)',
                    '-webkit-transition-duration': '1s',
                    '-ms-transition-duration': '1s',
                    '-o-transition-duration': '1s',
                    'transition-duration': '1s'
                });
        }
        else {
            $('.floating').hide();
        }
    });
});