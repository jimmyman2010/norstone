$(function(){
    $('.back-to-top').on('click', function(){
        $("html, body").animate({scrollTop: 0}, 500);
    });
    $('.slider li').show();
    $('.single-item').slick({
        dots: true,
        autoplay: true,
        arrows: false
    });
});