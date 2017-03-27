$(document).ready(function() {
    $("#users").DataTable({
        //"searching": false,
        //"info": false,
        "ajax": {
            //"url" : "json/users-list.json",
            "url": baseUrl + '/setting/user/list',
            "data" : "user",
        },
        "columns": [
            {
                "title": "Id",
                "data": null,
                "render": function ( data ) {
                    return data["idLogin"];
                }
            },
            {
                "title": "Username",
                "data": null,
                "render": function ( data ) {
                    return data["userName"];
                }
            },
            {
                "title": "Name",
                "data": null,
                "render": function ( data ) {
                    return data["name"];
                }
            },
            {
                "title": "Email",
                "data": null,
                "render": function ( data ) {
                    return data["email"];
                }
            },
            {
                "title": "BP",
                "data": null,
                "render": function ( data ) {
                    return data["BP"];
                }
            },
            {
                "title": "Group",
                "data": null,
                "render": function ( data ) {
                    return data["group"];
                }
            },
            {
                "title": "Type",
                "data": null,
                "render": function ( data ) {
                    return data["type"];
                }
            },
            {
                "title": "",
                "data": null,
                "class": "uk-text-right",
                "render": function ( data ) {
                    var id = data["id"];
                    var url = '/setting/user/' + id + '/';
                    return '<a href="' + url + 'edit" title="Edit User" class="uk-button uk-button-small uk-button-default">Edit</a> <a href="' + url + 'delete" title="Delete User" class="uk-button uk-button-small uk-button-default">Delete</a>';
                }
            }
        ],
        "order": [[ 0, "asc" ]]
    });
});