/**
 * Created by Jimmy on 6/18/2015.
 */
$(function(){
    var buttons = $('.action-buttons');
    buttons.on('click', 'button', function(){
        buttons.children('input').val($(this).data('submit'));
    });

    $('#content-using_page_builder').on('click', 'input[type="radio"]', function(){
        $('.radio-group').hide();
        $('.radio-group.radio-item-'+$(this).val()).show();
    });
});