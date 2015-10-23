$(function(){
    $('.back-to-top').on('click', function(){
        $("html, body").animate({scrollTop: 0}, 500);
    });

    $('.gadget').on('click', function(){
        $('.menu-account ul').slideToggle(100);
    });

    $('.fancybox-login').fancybox({
        nextEffect: 'none',
        prevEffect: 'none'
    });

    $(window).on('load scroll resize', function(){
        var heightWindow = document.documentElement.clientHeight;
        var widthWindow = document.documentElement.clientWidth;
        var iOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
        if(iOS) {
            var zoomLevel = document.documentElement.clientWidth / window.innerWidth;
            heightWindow = window.innerHeight * zoomLevel;
            widthWindow = window.innerWidth * zoomLevel;
        }

        $('.left-under').height(heightWindow);
        $('.wrapper').css({'min-height': heightWindow + 'px'});

        $('.site-wrapper').width(widthWindow).css('overflow-x', 'hidden');
        if(widthWindow > 1500) {
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

    $('.open-under').on('click', function(){
        var that = $(this),
            under = $(that.data('target'));
        if(under.hasClass('open')) {
            processUnder(under, 0);
        }
        else {
            processUnder(under, 260);
        }
    });

    $('.close-under').on('click', function(){
        var that = $(this),
            under = that.parent();
        processUnder(under, 0);
    });

    function processUnder(under, path){
        if(path === 0) {
            under.removeClass('open').css('z-index', -1);
            setTimeout(function(){
                under.removeAttr('style');
                $('.wrapper').removeAttr('style');
                $(window).trigger('resize');
            }, 500);
        }
        else {
            under.addClass('open');
            setTimeout(function(){
                under.css('z-index', 1);
            }, 500);
        }
        $('.wrapper').css({
            '-webkit-transform': 'translate(' + path + 'px)',
            '-ms-transform': 'translate(' + path + 'px)',
            '-o-transform': 'translate(' + path + 'px)',
            'transform': 'translate(' + path + 'px)',
            '-webkit-transition-duration': '500ms',
            '-ms-transition-duration': '500ms',
            '-o-transition-duration': '500ms',
            'transition-duration': '500ms'
        });
    }

    if (Modernizr.touch) {
        $('.nav-left .mainmenu .has-submenu').on('click', function(e){
            var that = $(this);
            if(!that.hasClass('hover')) {
                e.preventDefault();
                that.siblings('li').removeClass('hover');
                that.addClass('hover');
            }
        });
    }

});