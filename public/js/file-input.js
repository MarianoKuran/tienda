window.addEventListener('DOMContentLoaded', function () {
    var inputFile = $('#component-input-file');
    var previewSection = $('#preview-file-container');
    var imagePreview = $('#img-preview');

    inputFile.on('change', function () {
        let file = URL.createObjectURL(inputFile[0].files[0]);
        imagePreview.attr('src', file);
        $('#component-input-file-form').submit();
    });

    previewSection.on('click', function () {
        inputFile.click();
    });
});