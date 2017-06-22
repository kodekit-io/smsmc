(function ($, window, document) {
    $(function () {
		groupList('groups', baseUrl + '/setting/group/list');
	});

	function groupList(domId,url) {
		$.ajax({
            url: url,
			dataType: 'json',
            beforeSend : function(xhr) {
            },
            complete : function(xhr, status) {
            },
            success : function(result) {
				var data = result.group;
			    var theTable = $("#"+domId).DataTable({
			        //"searching": false,
			        //"info": false,
					"data": data,
			        "columns": [
			            {
			                "title": "Group Name",
			                "data": "groupName"
			            },
                        {
			                "title": "Description",
							"data": "description"
			            },
			            {
			                "title": "",
			                "class": "uk-text-right",
			                "data": function ( data ) {
			                    var id = data["id"];
			                    var url = '/setting/group/' + id + '/';
			                    return '<a href="' + url + 'edit" title="Edit Group" class="uk-button uk-button-small uk-button-default">Edit</a> <a href="' + url + 'delete" title="Delete Group" class="uk-button uk-button-small uk-button-default">Delete</a>';
			                }
			            }
			        ],
			        "order": [[ 0, "asc" ]]
			    });

			}
		});
	}
}(window.jQuery, window, document));
