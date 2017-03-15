(function ($, window, document) {
    $(function () {
        $('#project_add').validate({
            rules: {
                field_title: {
                    required: true
                },
                errorPlacement: function(error, element) {
                    if (element.attr('name') == 'field_title') {
                        $('#field_title').parent().append(error);
                    }
                }
            }
            // submitHandler: function(form) {
            //     // do other things for a valid form
            //     form.submit();
            // }
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