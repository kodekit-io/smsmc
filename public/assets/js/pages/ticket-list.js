function ticketList(div) {
    var card = '<div class="uk-animation-fade uk-card uk-card-hover uk-card-default uk-card-small"> \
        <div class="uk-card-header uk-clearfix"> \
            <h5 class="uk-card-title uk-float-left">Ticket List</h5> \
            <a href="'+baseUrl+'/engagement-ticket-create" title="Create New Ticket" class="uk-button red white-text uk-float-right">Create New Ticket</a> \
        </div> \
        <div class="uk-card-body"> \
            <table id="ticketList" class="uk-table uk-table-condensed uk-table-striped uk-width-1-1 sm-table"></table> \
        </div> \
    </div>';
    $('#'+div).append(card);

    var theTable = $('#ticketList').DataTable( {
        ajax: {
            // "url": "json/ticket-list.json",
			url : baseUrl + '/view-ticket'
        },
        buttons: {
            buttons: [
                //{ extend: 'pdfHtml5', className: 'uk-button uk-button-small red white-text' },
                { extend: 'excelHtml5', className: 'uk-button uk-button-small green darken-2 white-text uk-margin-small-left' },
                { extend: 'csvHtml5', className: 'uk-button uk-button-small teal white-text uk-margin-small-left' }
            ]
        },
        columns: [
			{ "data": "date", "visible": false, },
            { "data": "ticketId", "title": "ID", "width": "5%", },
            {
                "data": "date","title": "Ticket Date", "width": "9%",
                "render": function ( cellData ) {
                    var localtime = moment.parseZone(cellData).local().format('llll');
                    return localtime;
                }
            },
            // { "data": "ticketFrom", "title": "From", "width": "7.5%" },
            { "data": "sendName", "title": "To", "width": "7.5%" },
            // { "data": "ticketMessage", "title": "Message", "width": "10%" },
            {
                "data": "media", "title": "Channel", "class": "uk-text-center",  "width": "5%",
                "render": function ( cellData ) {
                    var channel = cellData;
                    var icon = "";
                    switch (channel) {
            			case 1:
            				icon = 'facebook';
            				break;
            			case 2:
            				icon = 'twitter';
            				break;
            			case 5:
            				icon = 'youtube';
            				break;
            			case 7:
            				icon = 'instagram';
            				break;
            			case 4:
            				icon = 'globe';
            				break;
            			case 3:
            				icon = 'rss';
            				break;
            			case 6:
            				icon = 'comments';
            				break;
            		}
                    return '<span class="uk-icon-button white-text color-'+icon+'"><i class="fa fa-'+icon+'"></i> <span class="uk-hidden">'+icon+'</span></span>';
                }
            },
			/*
            {
                "data": null, "title": "Post", "width": "20%",
                "render": function ( data ) {
                    var date = data["postDate"];
                    var localtime = moment.parseZone(date).local().format('llll');
                    var postAuthor = data.post["Author"];
                    var postDetails = data.post["Post"];
                    var postLink = data.post["Url"];
                    var postSentiment = data.post["sentiment"];
                    var post = '<span class="black-text">'+postAuthor+'</span> wrote:<br>'+postDetails+'<br><em class="grey-text">'+localtime+'</em><br><span class="">'+postSentiment+'</span> | <a href="'+postLink+'" class="uk-button uk-button-text red-text" title="Post Details" target="_blank" uk-tooltip>Post Details <i class="fa fa-angle-right"></i></a>'
                    return post;
                }
            },
			*/
            //{ "data": "postSentiment", "title": "Sentiment" },
            // {
            //     "data":"", "title": "Updates","width": "9%",
            //     "render": function ( cellData ) {
            //         var localtime = moment.parseZone(cellData).local().format('llll');
            //         return localtime;
            //     }
            // },
            {
                "data": "type","title": "Type","width": "7.5%"
            },
            {
                "data": "status", "title": "Status", "width": "7.5%",
                "render": function ( cellData ) {
                    var status = cellData;
                    var btn = "";
                    switch (status) {
                        case 'closed':
                            btn = '<span class="black-text" title="Responded and closed" uk-tooltip>'+cellData+'</span>'
                        break;
                        case 'open':
                            btn = '<span class="red-text" title="Waiting for a response" uk-tooltip>'+cellData+'</span>'
                        break;
                    }

                    return btn;
                }
            },
            {
                "data": null, "orderable": false, "class": "uk-text-center", "width": "12%",
                "render": function ( data ) {
                    var ticketId = data["ticketId"];
                    var ticketStatus = data["status"];
                    var btn = "";
                    if (ticketStatus === "open") {
                        btn = '<a href="'+baseUrl+'/engagement-ticket-details?ticketId='+ticketId+'" class="uk-button uk-button-small uk-button-secondary red white-text" title="Ticket Details" uk-tooltip><i class="fa fa-fw fa-ticket"></i> Details</a>'
                    } else {
                        btn = '<a href="'+baseUrl+'/engagement-ticket-details?ticketId='+ticketId+'" class="uk-button uk-button-small uk-button-secondary" title="Re-open Ticket" uk-tooltip><i class="fa fa-fw fa-envelope-open-o"></i> Re-open</a>'
                    }
                    return btn;
                }
            },
        ],
        order: [[ 0, "desc" ]]
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
