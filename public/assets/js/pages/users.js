(function ($, window, document) {
    $(function () {
		userlist('users', baseUrl + '/setting/user/list');

        // Delete modal
        $('#users').on('click', '.btn-delete', function(e) {
            e.preventDefault();
            $(this).blur();
            var id = $(this).attr('data-id');
			var name = $(this).attr('data-name');
            var url = '/setting/user/' + id + '/';
            var modal = '<div class="uk-modal-body">' +
                    '<h5>Are you sure ?</h5>' +
					'<p>User <strong>'+name+'</strong> will be deleted</p>' +
                '</div>' +
                '<div class="uk-modal-footer uk-clearfix">' +
                    '<a class="uk-modal-close uk-button grey white-text">CANCEL</a>' +
                    '<a href="' + url + 'delete" class="uk-button uk-float-right red white-text">DELETE</a>' +
                '</div>' +
            '</form>';
            var uikitModal = UIkit.modal.dialog(modal);
        });
	});

	function userlist(domId,url) {
		$.ajax({
            url: url,
			dataType: 'json',
            beforeSend : function(xhr) {
            },
            complete : function(xhr, status) {
            },
            success : function(result) {
				var data = result.user;
			    var theTable = $("#"+domId).DataTable({
			        //"searching": false,
			        //"info": false,
					"data": data,
			        "columns": [
			            {
			                "title": "Id",
			                "data": "idLogin"
			            },
			            {
			                "title": "Username",
			                "data": "userName"
			            },
			            {
			                "title": "Name",
			                "data": "name"
			            },
			            {
			                "title": "Email",
			                "data": "email"
			            },
			            {
			                "title": "Pillar",
			                "data": "BP"
			            },
			            {
			                "title": "User Group",
			                "data": "group"
			            },
			            {
			                "title": "Type",
			                "data": "type"
			            },
			            {
			                "title": "",
			                "class": "uk-text-right",
			                "data": function ( data ) {
			                    var id = data["idLogin"];
								var name = data["userName"];
			                    var url = '/setting/user/' + id + '/';
			                    var editBtn = '';
			                    if ($canEdit) {
			                    	editBtn = '<a href="' + url + 'edit" title="Edit User" class="uk-button uk-button-small uk-button-default">Edit</a>';
								}
			                    var deleteBtn = '';
			                    if ($canDelete) {
			                    	deleteBtn = '<a title="Delete User" class="uk-button uk-button-small uk-button-default btn-delete" data-id="'+id+'" data-name="'+name+'">Delete</a>';
								}
			                    return editBtn + ' ' + deleteBtn;
			                }
			            }
			        ],
			        "order": [[ 0, "asc" ]]
			    });

			}
		});
	}
}(window.jQuery, window, document));
