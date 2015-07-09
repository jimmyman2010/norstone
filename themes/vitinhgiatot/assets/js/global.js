/**
 * Created by ManTran on 7/4/2015.
 */
$(function(){
    $('.category-sorting .dropdownbox select').on('change', function() {
        window.location.href = $(this).val();
    });
    $('li[role="presentation"] > a').on('click', function(){
        var that = $(this);
        $('html,body').animate({
            scrollTop: that.offset().top - 60
        }, 1000);
    });

    $('.has-sub-menu > a > i').on('click', function(e){
        e.preventDefault();
        if($(window).outerWidth() < 767) {
            var li = $(this).parent().parent();
            if (li.hasClass('hover')) {
                li.removeClass('hover');
                $(this).removeClass('fa-chevron-circle-up').addClass('fa-chevron-circle-down');
            }
            else {
                li.addClass('hover');
                $(this).removeClass('fa-chevron-circle-down').addClass('fa-chevron-circle-up');
            }
        }
    });
    $('.has-sub-menu').on('mouseenter', function(){
        if($(window).outerWidth() < 767) {
            $(this).addClass('hover');
            $(this).find('> a > i').removeClass('fa-chevron-circle-down').addClass('fa-chevron-circle-up');
        }
    });

    $(window).on('load scroll', function(){
        if($(window).scrollTop() > 90) {
            $('.top-fix').addClass('down');
        }
        else {
            $('.top-fix').removeClass('down');
        }
    });
});