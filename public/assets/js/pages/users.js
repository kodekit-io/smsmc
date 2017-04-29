(function ($, window, document) {
    $(function () {
		userlist('users', baseUrl + '/setting/user/list');
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
			                "title": "BP",
			                "data": "BP"
			            },
			            {
			                "title": "Group",
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
			                    var url = '/setting/user/' + id + '/';
			                    var editBtn = '';
			                    if ($canEdit) {
			                    	editBtn = '<a href="' + url + 'edit" title="Edit User" class="uk-button uk-button-small uk-button-default">Edit</a>';
								}
			                    var deleteBtn = '';
			                    if ($canDelete) {
			                    	deleteBtn = '<a href="' + url + 'delete" title="Delete User" class="uk-button uk-button-small uk-button-default">Delete</a>';
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
