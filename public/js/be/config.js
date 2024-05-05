tinymce.init({
    selector: '.textarea_des',
    plugins: 'image link',
    toolbar: 'filemanager image link',
    file_picker_callback: function(callback, value, meta) {
        if (meta.filetype === 'file') {
            // Open Laravel Filemanager for file selection
            Filemanager.popup({
                callback: callback,
                value: value,
                field_type: 'file',
            });
        }
    },
});
