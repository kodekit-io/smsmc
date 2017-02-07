function ticketList(div) {
    var card = '<div class="uk-animation-fade uk-card uk-card-hover uk-card-default uk-card-small"> \
        <div class="uk-card-header uk-clearfix"> \
            <h5 class="uk-card-title uk-float-left">Ticket List</h5> \
        </div> \
        <div class="uk-card-body"> \
            <table id="ticketList" class="uk-table uk-table-condensed uk-table-striped uk-width-1-1 sm-table"></table> \
        </div> \
    </div>';
    $('#'+div).append(card);

    var theTable = $('#ticketList').DataTable( {
        ajax: {
            "url": "json/ticket-list.json",
        },
        buttons: {
            buttons: [
                //{ extend: 'pdfHtml5', className: 'uk-button uk-button-small red white-text' },
                { extend: 'excelHtml5', className: 'uk-button uk-button-small green darken-2 white-text uk-margin-small-left' },
                { extend: 'csvHtml5', className: 'uk-button uk-button-small teal white-text uk-margin-small-left' }
            ]
        },
        columns: [
            { "data": null, "width": "2.5%" },
            {
                "data": null,"title": "Ticket Date","width": "10%",
                "render": function ( data ) {
                    var date = data["ticketDate"];
                    var now = new Date();
                    var offset = now.getTimezoneOffset() / 60;
                    var newdate = new Date(date);
                    var timezoneDif = offset * 60 + newdate.getTimezoneOffset();
                    var localtime = new Date(newdate.getTime() + timezoneDif * 60 * 1000);
                    return localtime;
                }
            },
            { "data": "ticketFrom", "title": "From", "width": "10%" },
            { "data": "ticketTo", "title": "To", "width": "10%" },
            { "data": "ticketMessage", "title": "Message", "width": "12.5%" },
            {
                "data": null, "title": "Post", "width": "20%",
                "render": function ( data ) {
                    var date = data["postDate"];
                    var now = new Date();
                    var offset = now.getTimezoneOffset() / 60;
                    var newdate = new Date(date);
                    var timezoneDif = offset * 60 + newdate.getTimezoneOffset();
                    var localtime = new Date(newdate.getTime() + timezoneDif * 60 * 1000);
                    var postAuthor = data["postAuthor"];
                    var postDetails = data["postDetails"];
                    var postLink = data["postLink"];
                    var post = '<span class="black-text">'+postAuthor+'</span> wrote on <em class="grey-text">'+localtime+'</em> :<br>'+postDetails+'<br><a href="'+postLink+'" class="uk-button uk-button-text red-text" title="Post Details" target="_blank" uk-tooltip>Post Details <i class="fa fa-arrow-right"></i></a>'
                    return post;
                }
            },
            {
                "data": "postChannel", "title": "Channel", "width": "7.5%", "class": "uk-text-center",
                "render": function ( cellData ) {
                    var channel = cellData;
                    var icon = "";
                    var ifb = "<span class='uk-icon-button blue darken-4 white-text'><i class='fa fa-facebook'></i> <span class='uk-hidden'>facebook</span></span>";
                    var itw = "<span class='uk-icon-button blue accent-1 white-text'><i class='fa fa-twitter'></i> <span class='uk-hidden'>twitter</span></span>";
                    var iyt = "<span class='uk-icon-button red white-text'><i class='fa fa-youtube'></i> <span class='uk-hidden'>youtube</span></span>";
                    var iig = "<span class='uk-icon-button pink darken-4 white-text'><i class='fa fa-instagram'></i> <span class='uk-hidden'>instagram</span></span>";
                    switch (channel) {
                        case 'facebook':
                            icon = ifb;
                            break;
                        case 'twitter':
                            icon = itw;
                            break;
                        case 'youtube':
                            icon = iyt;
                            break;
                        case 'instagram':
                            icon = iig;
                            break;
                    }
                    return icon;
                }
            },
            { "data": "postSentiment", "title": "Sentiment", "width": "7.5%" },
            {
                "data": "ticketStatus", "title": "Status", "width": "7.5%",
                "render": function ( cellData ) {
                    var status = cellData;
                    var btn = "";
                    switch (status) {
                        case 'Close':
                            btn = '<span class="uk-badge sm-badge green white-text" title="Responded and closed" uk-tooltip>Closed</span>'
                        break;
                        case 'Open':
                            btn = '<span class="uk-badge sm-badge red white-text" title="Waiting for a response" uk-tooltip>Open</span>'
                        break;
                    }

                    return btn;
                }
            },
            {
                "data": "ticketStatus", "orderable": false, "width": "12.5%", "class": "uk-text-right",
                "render": function ( cellData ) {
                    var btn = "";
                    if (cellData === "Open") {
                        btn = '<a href="#" class="uk-button uk-button-small red white-text" title="Respond Now" uk-tooltip><i class="fa fa-wa fa-reply"></i> Respond</a>'
                    } else {
                        btn = '<a href="#" class="uk-button uk-button-small uk-button-default" title="Re-open Ticket" uk-tooltip><i class="fa fa-wa fa-envelope-open-o"></i> Re-open</a>'
                    }
                    return btn;
                }
            },
        ],
        order: [[ 1, "desc" ]]
    });
    theTable.on( 'order.dt search.dt', function () {
        theTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
    theTable.columns.adjust().draw();
}