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

        var images = $('input[name="Gallery[image_id]"]');
        if(images.length > 0) {
            var flag = true;
            images.each(function () {
                if ($(this).prop('checked')) {
                    flag = false;
                    return;
                }
            });
            if (flag) {
                $(images.get(0)).prop('checked', 'checked');
            }
        }
    });
});