(function ($, window, document) {
    $(function () {
        $('#login').validate({
            rules: {
                username: {
                    required: true
                },
				password: {
                    required: true,
                    minlength: 6
                }
            },
            errorElement: 'span',
			errorPlacement: function(error, element) {
			    if (element.attr('name') == 'username')
			        $('#username').parent().append(error);
			    else if  (element.attr('name') == 'password')
			        $('#password').parent().append(error);
			}
        });

        if (localStorage.checkBoxValidation && localStorage.checkBoxValidation != '') {
            $('#remember').attr('checked', 'checked');
            $('#username').val(localStorage.username);
            $('#password').val(localStorage.password);
        } else {
            $('#remember').removeAttr('checked');
            $('#username').val('');
            $('#password').val('');
        }
        $('#remember').click(function() {
            if ($('#remember').is(':checked')) {
                localStorage.username = $('#username').val();
                localStorage.password = $('#password').val();
                localStorage.checkBoxValidation = $('#remember').val();
            } else {
                localStorage.username = '';
                localStorage.password = '';
                localStorage.checkBoxValidation = '';
            }
        });
    });
}(window.jQuery, window, document));