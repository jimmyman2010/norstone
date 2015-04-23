$(function(){
    'use strict';
    $('#gallery-name').on('blur', function(){
        var that = $(this),
            name = $(this).val();
        $.get(
            '/admin/gallery/checkingduplicated',
            {'name': name},
            function(data){
                if(data === true){
                    that.parent().removeClass('duplicated');
                } else {
                    that.parent().addClass('duplicated');
                }
            }
        );
    });
});