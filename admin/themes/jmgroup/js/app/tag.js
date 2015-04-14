$('#tags')
    .textext({
        plugins : 'tags autocomplete'
    })
    .bind('getSuggestions', function(e, data) {
        'use strict';
        var suggesString = $(this).data('suggestions');
        var list = suggesString.split(',');
        var textext = $(e.target).textext()[0],
            query = (data ? data.query : '') || '';

        $(this).trigger(
            'setSuggestions',
            { result : textext.itemManager().filter(list, query) }
        );
    })
    .bind('isTagAllowed', function(e, data) {
        'use strict';
        var formData = $(e.target).textext()[0].tags()._formData;

        var flag = true;
        $.each(formData, function(index, value){
            if(value === data.tag) {
                flag = false;
            }
        });
        if (!flag) {
            var message = [ data.tag, 'is already listed.' ].join(' ');
            alert(message);

            data.result = false;

        }
    })
;