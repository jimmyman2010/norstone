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
});