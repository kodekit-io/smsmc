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
            { "data": "ticketId", "title": "ID", "width": "5%", },
            {
                "data": "ticketDate","title": "Ticket Date", "width": "9%",
                "render": function ( cellData ) {
                    var localtime = moment.parseZone(cellData).local().format('llll');
                    return localtime;
                }
            },
            { "data": "ticketFrom", "title": "From", "width": "7.5%" },
            { "data": "ticketTo", "title": "To", "width": "7.5%" },
            { "data": "ticketMessage", "title": "Message", "width": "12.5%" },
            {
                "data": "postChannel", "title": "Channel", "class": "uk-text-center",  "width": "5%",
                "render": function ( cellData ) {
                    var channel = cellData;
                    var icon = "";
                    switch (channel) {
            			case 'facebook':
            				icon = 'facebook';
            				break;
            			case 'twitter':
            				icon = 'twitter';
            				break;
            			case 'youtube':
            				icon = 'youtube';
            				break;
            			case 'instagram':
            				icon = 'instagram';
            				break;
            			case 'news':
            				icon = 'globe';
            				break;
            			case 'blog':
            				icon = 'rss';
            				break;
            			case 'forum':
            				icon = 'comments';
            				break;
            		}
                    return '<span class="uk-icon-button white-text color-'+icon+'"><i class="fa fa-'+icon+'"></i> <span class="uk-hidden">'+channel+'</span></span>';
                }
            },
            {
                "data": null, "title": "Post", "width": "25%",
                "render": function ( data ) {
                    var date = data["postDate"];
                    var localtime = moment.parseZone(date).local().format('llll');
                    var postAuthor = data["postAuthor"];
                    var postDetails = data["postDetails"];
                    var postLink = data["postLink"];
                    var postSentiment = data["postSentiment"];
                    var post = '<span class="black-text">'+postAuthor+'</span> wrote:<br>'+postDetails+'<br><em class="grey-text">'+localtime+'</em><br><span class="">'+postSentiment+'</span> | <a href="'+postLink+'" class="uk-button uk-button-text red-text" title="Post Details" target="_blank" uk-tooltip>Post Details <i class="fa fa-angle-right"></i></a>'
                    return post;
                }
            },
            //{ "data": "postSentiment", "title": "Sentiment" },
            {
                "data": "ticketUpdate","title": "Updates","width": "9%",
                "render": function ( cellData ) {
                    var localtime = moment.parseZone(cellData).local().format('llll');
                    return localtime;
                }
            },
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
                "data": null, "orderable": false, "class": "uk-text-center", "width": "12%",
                "render": function ( data ) {
                    var ticketId = data["ticketId"];
                    var ticketStatus = data["ticketStatus"];
                    var btn = "";
                    if (ticketStatus === "Open") {
                        btn = '<a href="'+baseUrl+'/engagement-ticket-details?ticketId='+ticketId+'" class="uk-button uk-button-small uk-button-secondary red white-text" title="Ticket Details" uk-tooltip><i class="fa fa-fw fa-ticket"></i> Details</a>'
                    } else {
                        btn = '<a href="#" class="uk-button uk-button-small uk-button-secondary" title="Re-open Ticket" uk-tooltip><i class="fa fa-fw fa-envelope-open-o"></i> Re-open</a>'
                    }
                    return btn;
                }
            },
        ],
        order: [[ 8, "desc" ]]
    });
    /*
    theTable.on( 'order.dt search.dt', function () {
        theTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
    */
    theTable.columns.adjust().draw();
}