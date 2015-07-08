/**
 * Created by ManTran on 7/4/2015.
 */
$(function(){
    $('.category-sorting .dropdownbox select').on('change', function() {
        window.location.href = $(this).val();
    });
});