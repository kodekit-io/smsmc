function notifications(div) {
    var card = '<div class="uk-animation-fade uk-card uk-card-hover uk-card-default uk-card-small"> \
        <div class="uk-card-header"> \
            <h5 class="uk-card-title">Your Notifications</h5> \
        </div> \
        <div class="uk-card-body"> \
            <table id="notifications" class="uk-table uk-table-hover sm-table uk-margin-remove"></table> \
        </div> \
    </div>';
    $('#'+div).append(card);

    var theTable = $('#notifications').DataTable( {
        ajax: {
            "url": "json/notifications.json",
        },
        paging: true,
        searching: false,
        info: false,
        processing: true,
        dom: "<'sm-timeline-wrap't><'uk-grid uk-grid-collapse sm-timeline-foot'<'uk-width-1-2'l><'uk-width-1-2'p>>",
        language: {
            "lengthMenu": "Show _MENU_"
        },
        columns: [
            {
                "data": "notifDate",
                "render": function ( a, b, c, d ) {
                    var date = moment(c.notifDate);
                    var statclass = c.notifStatus.toLowerCase();
                    var ago = date.fromNow();
                    var type = c.notifType;
                    var icon = '';
                    switch (type) {
                        case 'ticket':
                            icon = '<span class="fa fa-lg fa-ticket red-text"></span>'
                        break;
                    }
                    var stat = '';
                    switch (statclass) {
                        case 'unread':
                            stat = '<a title="Mark as Read" uk-tooltip class="fa fa-eye-slash red-text"></a>'
                        break;
                        case 'read':
                            stat = '<span title="Read" uk-tooltip class="fa fa-eye grey-text"></span>'
                        break;
                    }
                    var msg = '';
                    if (c.notifMessage!=''){
                        msg = ' and said: <em class="grey-text">"'+c.notifMessage+'"</em>';
                    }
                    var notif = '<div class="uk-animation-slide-left-small uk-grid-small '+statclass+'" uk-grid>'
                        + '<div class="uk-width-auto@s">'+icon+'</div>'
                        + '<div class="uk-width-expand@s">'
                            + '<a class="black-text" href="'+baseUrl+'/engagement-ticket-details?ticketId='+c.notifLink+'">'
                                + '<span class="sm-text-bold">' +c.notifFrom+ '</span> sent you a ' +type+ '' +msg
                            + '</a><br>'
                            + ago
                        +'</div>'
                        + '<div class="uk-width-auto@s">'+stat+'</div>'
                    + '</div>';
                    $('.unread').closest('td').addClass('unread');
                    return notif;
                }
            }
            //
            // {
            //     "data": "notifType",
            //     "render": function ( cellData ) {
            //         var status = cellData;
            //         var btn = "";
            //         switch (status) {
            //             case 'ticket':
            //                 btn = '<span class="fa fa-lg fa-ticket red-text"></span>'
            //             break;
            //         }
            //
            //         return btn;
            //     }
            // },
            // {
            //     "data": null,
            //     "render": function ( data ) {
            //         var date = moment(data['notifDate']);
            //         var ago = date.fromNow();
            //         var type = data['notifType'];
            //         var from = data['notifFrom'];
            //         var to = data['notifTo'];
            //         var msg = '';
            //         if (data['notifMessage']!=''){
            //             msg = ' and said: <em class="grey-text">"'+data['notifMessage']+'"</em>';
            //         }
            //         var notif = '<span class="sm-text-bold">'+from+'</span> sent you a '+type+''+msg+'<br>'+ago;
            //         return notif;
            //     }
            // },
            // {
            //     "data": null,
            //     "render": function ( data ) {
            //         var status = data['notifStatus'];
            //         var show = data['notifShow'];
            //         if (status=='Unread') {
            //             var action = '<a title="Mark as Read" uk-tooltip class="fa fa-eye-slash"></a>';
            //         } else {
            //             var action = '<span title="Read" uk-tooltip class="fa fa-eye grey-text"></span>';
            //         }
            //         return action;
            //     }
            // }
        ],
        order: [[ 0, "desc" ]]
    });
}