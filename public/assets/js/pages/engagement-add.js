(function ($, window, document) {
    $(function () {
        $('.sm-formyoutube').addClass('uk-hidden').prop('required',false);
        $('.sm-forminput').removeClass('uk-hidden').prop('required',true);
        $('#post-to').change(function(){
            if ($(this).val()=='1') {
                $('.sm-vid').show();
                $('.sm-img').show();
                $('.sm-formyoutube').addClass('uk-hidden').prop('required',false);
                $('.sm-forminput').removeClass('uk-hidden').prop('required',true);
            } else if ($(this).val()=='2') {
                $('.sm-vid').hide();
                $('.sm-img').show();
                $('.sm-formyoutube').addClass('uk-hidden').prop('required',false);
                $('.sm-forminput').removeClass('uk-hidden').prop('required',true);
            } else if ($(this).val()=='5') {
                $('.sm-vid').show();
                $('.sm-img').hide();
                $('.sm-formyoutube').removeClass('uk-hidden').prop('required',true);
                $('.sm-forminput').addClass('uk-hidden').prop('required',false);
            } else if ($(this).val()=='7') {
                $('.sm-vid').hide();
                $('.sm-img').show();
                $('.sm-formyoutube').addClass('uk-hidden').prop('required',false);
                $('.sm-forminput').removeClass('uk-hidden').prop('required',true);
            }
        });
        // jQuery.validator.setDefaults({
        //     debug: true,
        //     success: "valid"
        // });
        $.validator.addMethod('filesize', function (value, element, param) {
            return this.optional(element) || (element.files[0].size <= param)
        }, 'Filesize is too big');
        $('#engagementPost').validate({
            rules: {
                postSocmed: {
                    required: true
                },
                image: {
                    // accept: "image/*",
                    // extension: "png|jpe?g",
                    filesize: 2048000
                },
                video: {
                    // accept: "image/*",
                    // extension: "png|jpe?g",
                    filesize: 1024000000
                }
            }
        });

        var dt = new Date();
        $('#schedule').datetimepicker({
            'format': 'd/m/y H:i',
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
                $('#set').addClass('uk-hidden');
            } else {
                $('#postnowsocmed').removeClass('uk-hidden');
                $('#postsave').addClass('uk-hidden');
                $('#clear').addClass('uk-hidden');
                $('#set').removeClass('uk-hidden');
            }
        });
        $('#clear').click(function(){
            $(this).addClass('uk-hidden');
            $('#schedule').val('');
            $('#postnowsocmed').removeClass('uk-hidden');
            $('#postsave').addClass('uk-hidden');
            $('#set').removeClass('uk-hidden');
        });
    });
}(window.jQuery, window, document));
