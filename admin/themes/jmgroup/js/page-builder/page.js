/**
 * Created by Jimmy on 6/18/2015.
 */
$(function(){
    var buttons = $('.action-buttons');
    buttons.on('click', 'button', function(){
        buttons.children('input').val($(this).data('submit'));
    });
});