(function ($, window, document) {
    $(function () {
        $('ul.pagination').addClass('uk-pagination uk-flex-center');

        // $('#select-group').checkAll(
        //     { container: $('ul'), showIndeterminate: true }
        // );

        // Edit Project
        $('.uk-card').on('click', '.sm-edit-project', function(e) {
            e.preventDefault();
            $(this).blur();
            var pId = $(this).attr('data-id');
            var pName = $(this).attr('data-name');
            var link = baseUrl+'/project/'+pId+'/edit';
            var modal = '<h5>Edit Project <span class="uk-text-uppercase">'+pName+'</span>?</h5>';
            UIkit.modal.confirm(modal).then(function(){
                window.location.href = link;
            },function(){});

        });

        // Delete Project
        $('.uk-card').on('click', '.sm-delete-project', function(e) {
            e.preventDefault();
            $(this).blur();
            var pId = $(this).attr('data-id');
            var pName = $(this).attr('data-name');
            var link = baseUrl+'/project/'+pId+'/delete';
            var modal = '<h5>Are you sure?</h5>Project <span class="uk-text-uppercase">'+pName+'</span> will no longer available.</h5>';
            UIkit.modal.confirm(modal).then(function(){
                window.location.href = link;
            },function(){});

        });
    });

    $('#searchtext').keypress(function(event ) {
        if ( event.which == 13 ) {
            $('#searchform').submit();
        }
    });

}(window.jQuery, window, document));

// function submitThisForm(cb) {
//     if(cb.checked) {
//         $('#searchform').submit();
//     }
// }
