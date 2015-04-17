$(function(){
    $('.connected').sortable({
        connectWith: '.connected'
    });
    $('#gallery-form').on('submit', function(){
        var stringRelated = '';
        $('.related .connected li').each(function(index, element){
            if(index > 0) {
                stringRelated += ',';
            }
            stringRelated += $(this).data('id');
        });
        $('#relatedGallery').val(stringRelated);
    });
});