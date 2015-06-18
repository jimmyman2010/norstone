/**
 * Created by ManTran on 6/17/2015.
 */
$(function(){
    var pageBuilder = $('.page-builder');

    var url = pageBuilder.data('href');
    $.get(url, function(html){
        pageBuilder.append(html);
    });

    pageBuilder
        .on('click', '.add-e-pb', function(){
            var that = $(this),
                url = that.attr('href');
            $.get(url, function(html){
                that.parent().parent().append(html);
            });
            return false;
        })

        /* modal */
        .on('click', '.open-modal', function(e){
            e.preventDefault();
            var urlGet = $(this).data('urlGet'),
                urlPost = $(this).data('urlPost');
            $.get(urlGet, function(data){
                var json = JSON.parse(data);
                json.content = JSON.parse(json.content);
                console.log(json);
            });
            $('#' + $(this).data('revealId')).foundation('reveal', 'open');
        })

        /* row */
        .on('click', '.add-e-row', function(){
            var that = $(this),
                url = that.attr('href');
            $.get(url, function(html){
                that.parent().parent().append(html);
            });
            return false;
        })
        .on('click', '.active-e-row', function(){
            var that = $(this),
                url = that.attr('href');
            $.post(url, function(response){
                var json = JSON.parse(response);
                if(json.status) {
                    that.removeClass('fa-toggle-on').addClass('fa-toggle-off');
                }
                else {
                    that.removeClass('fa-toggle-off').addClass('fa-toggle-on');
                }
            });
            return false;
        })
        .on('click', '.delete-e-row', function(){
            var that = $(this),
                url = that.attr('href');
            $.post(url, function(response){
                var json = JSON.parse(response);
                if(json.status) {
                    that.parent().parent().hide();
                }
            });
            return false;
        });
});