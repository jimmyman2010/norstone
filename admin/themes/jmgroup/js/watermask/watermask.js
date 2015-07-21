/**
 * Created by ManTran on 7/17/2015.
 */
$(function(){
    // create a wrapper around native canvas element (with id="c")
    var canvas = new fabric.Canvas('canvas'),
        $canvas = $('#canvas'),
        btnAddWatermask = $('#add-watermask-button'),
        btnDeleteWatermask = $('#delete-watermask-button'),
        btnAddText = $('#add-text-button'),
        ctrlOpacity = $('#color-opacity-controls input[type="range"]'),
        ctrlColor = $('#color-opacity-controls input[type="color"]');

    canvas.setBackgroundImage($canvas.data('background'), canvas.renderAll.bind(canvas));

    btnAddWatermask.on('click', function(){
        mihaildev.elFinder.openManager({
            filter:'image',
            path:'image',
            callback:'addImage',
            url:'/admin/elfinder/manager?filter=image&path=image&callback=addImage',
            width:'auto',
            height:'auto',
            id:'addImage'
        });
    });
    mihaildev.elFinder.register('addImage', function(file, id){
        var imgElement = new Image();
        imgElement.src = file.url;
        imgElement.onload = function(){
            var imgInstance = new fabric.Image(imgElement, {
                left: 10,
                top: 10
            });
            canvas.add(imgInstance);
        };
        return true;
    });

    btnDeleteWatermask.on('click', function(){
        var obj = canvas.getActiveObject();
        canvas.remove(obj);
    });

    btnAddText.on('click', function(){
        var text = new fabric.IText('www.vitinhgiatot.com', {
            left: 100,
            top: 100,
            fontFamily: 'Arial'
        });
        canvas.add(text);
    });

    ctrlOpacity.on('change', function(){
        var obj = canvas.getActiveObject();
        obj.setOpacity($(this).val()/100);
        canvas.renderAll();
    });
    ctrlColor.on('change', function(){
        var obj = canvas.getActiveObject();
        obj.setColor($(this).val());
        canvas.renderAll();
    });
    canvas.on('object:selected', function(){
        var obj = canvas.getActiveObject();
        ctrlOpacity.val(obj.opacity * 100);
        ctrlColor.val(rgb2hex(obj.fill));
        canvas.renderAll();

        btnDeleteWatermask.removeAttr('disabled').addClass('alert').removeClass('disabled');
    });
    canvas.on('selection:cleared', function(){
        btnDeleteWatermask.attr('disabled', 'disabled').removeClass('alert').addClass('disabled');
    });

    $('#watermask-save').on('click', function(){
        console.log(JSON.stringify(canvas));
        $.post('/admin/file/watermask-save?id=52', {
            'fabric': JSON.stringify(canvas)
        }, function(responce){
            console.log(responce);
        });
    });

    //Function to convert hex format to a rgb color
    function rgb2hex(orig){
        var rgb = orig.replace(/\s/g,'').match(/^rgba?\((\d+),(\d+),(\d+)/i);
        return (rgb && rgb.length === 4) ? "#" +
        ("0" + parseInt(rgb[1],10).toString(16)).slice(-2) +
        ("0" + parseInt(rgb[2],10).toString(16)).slice(-2) +
        ("0" + parseInt(rgb[3],10).toString(16)).slice(-2) : orig;
    }
});