(function ($, window, document) {
    $(function () {
        // jQuery.validator.setDefaults({
        //     debug: true,
        //     success: "valid"
        // });
        $.validator.addMethod('filesize', function (value, element, param) {
            return this.optional(element) || (element.files[0].size <= param)
        }, 'File size must be less than 2MB');
        $('#engagementPost').validate({
            rules: {
                postSocmed: {
                    required: true
                },
                image: {
                    // accept: "image/*",
                    // extension: "png|jpe?g",
                    filesize: 204800
                }
            }
        });
        
        var dt = new Date();
        $('#schedule').datetimepicker({
            'format': 'd-m-y H:i',
            'minDate': 0,
            'minDateTime': dt,
            'closeOnDateSelect' : true,
            'validateOnBlur' : true,
        });
        $('#schedule').blur(function () {
            if ($(this).val()) {
                $('#postsave').removeClass('uk-hidden');
                $('#postnowsocmed').addClass('uk-hidden');
                $('#clear').removeClass('uk-hidden');
            } else {
                $('#postnowsocmed').removeClass('uk-hidden');
                $('#postsave').addClass('uk-hidden');
                $('#clear').addClass('uk-hidden');
            }
        });
        $('#clear').click(function(){
            $(this).addClass('uk-hidden');
            $('#schedule').val('');
            $('#postnowsocmed').removeClass('uk-hidden');
            $('#postsave').addClass('uk-hidden');
        });
    });
}(window.jQuery, window, document));
