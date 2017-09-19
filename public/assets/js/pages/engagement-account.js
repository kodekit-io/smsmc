(function ($, window, document) {
    $(function () {
        // Delete User
        $('form').on('click', 'a', function(e) {
            e.preventDefault();
            $(this).blur();
            var id = $(this).attr('data-id');
            var name = $(this).attr('data-name');
            var url = baseUrl+'/engagement/account-logout/'+id;
            var modal = '<h5>Delete user '+name+'?</h5>';
            UIkit.modal.confirm(modal).then(function(){
                $.ajax({
                    type: "POST",
                    url: url,
                    data: $('form').serialize(),
                    success: function(result) {
                        window.location.reload();
                    }
                });
            },function(){});
        });
    });
}(window.jQuery, window, document));
