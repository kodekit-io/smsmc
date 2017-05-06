(function ($, window, document) {
    $(function () {
        $.validator.addMethod('filesize', function (value, element, param) {
            return this.optional(element) || (element.files[0].size <= param)
        }, 'File size must be less than 1MB');
        $('#project_add').validate({
            rules: {
                field_title: {
                    required: true
                },
                project_image: {
                    // accept: "image/*",
                    extension: "png|jpe?g",
                    filesize: 1024000
                }
            },
        });
    });

}(window.jQuery, window, document));

function delRowItem(e) {
    $(e).closest('li').remove();
}

function addRowAdv(wrapper) {
    r = $('#'+wrapper).find('li').length + 1;
    $('#'+wrapper).append(
        '<li>'
        + '<textarea class="uk-textarea field-'+wrapper+'" rows="6" name="field_'+wrapper+'['+r+']"></textarea>'
        + '<a onclick="delRowItem(this)" class="fa fa-close sm-del-row white-text red" title="Remove this Field" uk-tooltip></a>'
        +'</li>'
    );
}
