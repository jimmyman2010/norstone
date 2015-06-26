/**
 * Created by ManTran on 6/24/2015.
 */
$(function(){
    $('#arrangement-form').on('submit', function(){
        var dataString = [];
        $('#arrangementSelected li').each(function(i, e){
            dataString.push($(this).data('id'));
        });
        $('#arrangementProduct').val(dataString.toString());
    });
});