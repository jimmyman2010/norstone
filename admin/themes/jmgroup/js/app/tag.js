$('#textarea')
    .textext({
        plugins : 'tags autocomplete'
    })
    .bind('getSuggestions', function(e, data)
    {
        var list = [
                'Basic',
                'Closure',
                'Cobol',
                'Delphi',
                'Erlang',
                'Fortran',
                'Go',
                'Groovy',
                'Haskel',
                'Java',
                'JavaScript',
                'OCAML',
                'PHP',
                'Perl',
                'Python',
                'Ruby',
                'Scala'
            ],
            textext = $(e.target).textext()[0],
            query = (data ? data.query : '') || ''
            ;

        $(this).trigger(
            'setSuggestions',
            { result : textext.itemManager().filter(list, query) }
        );
    })
;