tinymce.init({
    selector: '#details',
    menubar: false,
    width: '100%',
    height: 650,
    resize: false,
    placeholder: 'type news details here...',

    plugins: [
        "advlist autolink link image lists charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        "save table contextmenu directionality emoticons template paste textcolor"
    ],
    toolbar1: 'fontselect | fontsizeselect | bold italic underline | alignleft aligncenter alignright alignjustify lineheight | bullist numlist outdent indent',
    toolbar2: 'styleselect | table image link ',
    font_formats: 'Arial=arial,helvetica,sans-serif; Courier New=courier new,courier,monospace; AkrutiKndPadmini=Akpdmi-n',
    fontsize_formats: '8pt 10pt 12pt 14pt 16pt 18pt 24pt 36pt 48pt',
    lineheight_formats: '1 1.1 1.2 1.3 1.4 1.5 2',
    toolbar_mode: 'wrap',
    toolbar_sticky: true,

    /**
     * File upload
     */
    setup: function (editor) {
        editor.on('init change', function () {
            editor.save();
        });
    },
    content_css: [
        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
        '//www.tinymce.com/css/codepen.min.css'
    ],

    image_title: true,
    automatic_uploads: true,
    images_upload_url: '',
    file_picker_types: 'image',
    file_picker_callback: function(cb, value, meta) {
        var input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');
        input.onchange = function() {
            var file = this.files[0];
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function () {
                var id = 'blobid' + (new Date()).getTime();
                var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                var base64 = reader.result.split(',')[1];
                var blobInfo = blobCache.create(id, file, base64);
                blobCache.add(blobInfo);
                cb(blobInfo.blobUri(), { title: file.name });
            };
        };
        input.click();
    }
});
