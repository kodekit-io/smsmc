$(document).ready(function() {
    $("#users").DataTable({
        "searching": false,
        "info": false,
        "ajax": {
            "url" : "json/users.json",
            "data" : "data",
        },
        "columns": [
            {
                "title": "Id",
                "data": null,
                "render": function ( data ) {
                    return data["id"];
                }
            },
            {
                "title": "Username",
                "data": null,
                "render": function ( data ) {
                    return data["username"];
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
                    var url = '/admin-edit/?id='+id;
                    return '<a href="#" title="Edit User" class="uk-button uk-button-small uk-button-default">Edit</a> <a href="#" title="Delete User" class="uk-button uk-button-small uk-button-default">Delete</a>';
                }
            }
        ],
        "order": [[ 0, "asc" ]]
    });
});