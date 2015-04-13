var uploader = new plupload.Uploader({
    runtimes : 'html5,flash,silverlight,html4',
    browse_button : 'pickfiles', // you can pass in id...
    container: document.getElementById('uploader'), // ... or DOM Element itself
    url : '/admin/file/uploadimage',
    flash_swf_url : '/admin/themes/jmgroup/plupload/Moxie.swf',
    silverlight_xap_url : '/admin/themes/jmgroup/plupload/Moxie.xap',

    filters : {
        max_file_size : '10mb',
        mime_types: [
            {title : "Image files", extensions : "jpg,gif,png,bmp"}
        ]
    },

    init: {
        PostInit: function() {
            document.getElementById('filelist').innerHTML = '';
        },

        FilesAdded: function(up, files) {
            plupload.each(files, function(file) {
                document.getElementById('filelist').innerHTML +=
                '<div id="' + file.id + '" class="photo-zone large-4 medium-6 columns"><table cellpadding="0" cellspacing="0">' +
                    '<tr><td class="controls"><strong class="progress radius"></strong></td></tr>' +
                    '<tr><td class="edit"><span class="name">' +
                        file.name + ' (' + plupload.formatSize(file.size) + ')' +
                    '</span></td></tr><tr><td class="caption">' +
                        '<textarea rows="4" placeholder="Say something about this photo."></textarea>' +
                    '</td></tr>' +
                '</table></div>';
            });

            uploader.start();
        },

        UploadProgress: function(up, file) {
            document.getElementById(file.id).getElementsByTagName('strong')[0].innerHTML = '<span class="meter" style="width: ' + file.percent + '%">' + file.percent + "%</span>";
        },

        FileUploaded: function(up, file, info) {
            var response = JSON.parse(info.response);
            var progressBar = document.getElementById(file.id).getElementsByTagName('strong')[0];
            var editZone = document.getElementById(file.id).getElementsByClassName('edit')[0];

            // show picture after upload successful
            var img = new Image();
            if(response.hasOwnProperty('result')) {
                progressBar.className += ' success';
                img.src = response.result.showUrl + response.result.fileName + '.' + response.result.fileExt;
                img.alt = 'response.result.fileName';
            } else {
                progressBar.className += ' alert';
                img.src = '';
                img.alt = 'error';
            }
            img.onload= function(){
                var nameTag = editZone.getElementsByClassName('name')[0];
                $(nameTag).empty().addClass('overflow');

                editZone.appendChild(img);
            };

            //process generate image include: resize, create thumbnail
            $.get(
                '/admin/file/processimage',
                {'id': response.id},
                function(data){
                    var response = JSON.parse(data);
                    var nameTag = editZone.getElementsByClassName('name')[0];
                    img.src = response.result.showUrl + response.result.fileName + '-thumb-upload.' + response.result.fileExt;
                    nameTag.className = '';
                }
            );

            //show control
            var controlZone = document.getElementById(file.id).getElementsByClassName('controls')[0];
            $(controlZone).empty()
                .append('<label><input type="radio" name="main-image" value="'+response.id+'" /> Main picture</label>')
                .append('<a class="delete-image" data-id="'+response.id+'" href="javascript:;"><i class="fa fa-trash-o"></i></a>');
        },

        UploadComplete: function(up, files) {
            $('.delete-image').on('click', function(){
                var id = $(this).data('id');
                var that = $(this);
                $.post(
                    '/admin/file/delete?id='+id,
                    {},
                    function(data){
                        var response = JSON.parse(data);
                        if(response.hasOwnProperty('result')) {
                            that.parents('.photo-zone').hide();
                        }
                    }
                );
            });
        },

        Error: function(up, err) {
            document.getElementById('console').innerHTML += "\nError #" + err.code + ": " + err.message;
        }
    }
});

uploader.init();