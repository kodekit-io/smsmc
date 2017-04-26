(function ($, window, document) {
    $(function () {
        groupList('roles', baseUrl + '/setting/role/list');
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
                var data = result.data;
                var theTable = $("#"+domId).DataTable({
                    //"searching": false,
                    //"info": false,
                    "data": data,
                    "columns": [
                        {
                            "title": "Role Name",
                            "data": "name"
                        },
                        {
                            "title": "",
                            "class": "uk-text-right",
                            "data": function ( data ) {
                                var id = data["idRole"];
                                var url = '/setting/role/' + id + '/';
                                return '<a href="' + url + 'edit" title="Edit Group" class="uk-button uk-button-small uk-button-default">Edit</a>';
                            }
                        }
                    ],
                    "order": [[ 0, "asc" ]]
                });

            }
        });
    }
}(window.jQuery, window, document));
