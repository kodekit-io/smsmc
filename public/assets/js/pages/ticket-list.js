function ticketList(div) {
    // var card = '<div class="uk-animation-fade uk-card uk-card-hover uk-card-default uk-card-small"> \
    //     <div class="uk-card-header uk-clearfix"> \
    //         <h5 class="uk-card-title uk-float-left">Ticket List</h5> \
    //         <a href="' + baseUrl + '/ticket/add" title="Create New Ticket" class="uk-button red white-text uk-float-right">Create New Ticket</a> \
    //     </div> \
    //     <div class="uk-card-body"> \
    //         <table id="ticketList" class="uk-table uk-table-condensed uk-table-striped uk-width-1-1 sm-table"></table> \
    //     </div> \
    // </div>';
    // $('#'+div).append(card);

    var theTable = $('#'+div).DataTable( {
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
			{ data: 'date', visible: false, },
            { data: 'ticketId', title: 'ID', width: '5%', },
            {
                title: 'Ticket Date', width: '9%',
                data: function ( data ) {
                    var localtime = moment.parseZone(data['date']).format('llll');
                    return localtime;
                }
            },
            {
				title: 'From', width: '7.5%',
				data: function ( data ) {
					var name = data['fromName'];
					var group = data['fromGroup'];
					return name+' ('+group+')';
				}
			},
            {
				title: 'To', width: '7.5%',
				data: function ( data ) {
					var name = data['sendName'];
					var group = data['sendGroup'];
					return name+' ('+group+')';
				}
			},
            { data: 'content', title: 'Message', width: '10%' },
            // {
            //     data: 'media', title: 'Channel', class: 'uk-text-center',  width: '5%',
            //     render: function ( cellData ) {
            //         var channel = cellData;
            //         var icon = '';
            //         switch (channel) {
            // 			case 1:
            // 				icon = 'facebook';
            // 				break;
            // 			case 2:
            // 				icon = 'twitter';
            // 				break;
            // 			case 5:
            // 				icon = 'youtube';
            // 				break;
            // 			case 7:
            // 				icon = 'instagram';
            // 				break;
            // 			case 4:
            // 				icon = 'globe';
            // 				break;
            // 			case 3:
            // 				icon = 'rss';
            // 				break;
            // 			case 6:
            // 				icon = 'comments';
            // 				break;
            // 		}
            //         return '<span class="uk-icon-button white-text color-'+icon+'"><i class="fa fa-'+icon+'"></i> <span class="uk-hidden">'+icon+'</span></span>';
            //     }
            // },
            {
                "title": 'Media', "class": 'uk-text-center',  "width": '5%',
                "data": function ( data ) {
                    var channel = data["media"];
                    var icon = '', color = '';
                    switch (channel) {
                        case 1:
                            icon = 'facebook';
                            color = 'facebook';
                            break;
                        case 2:
                            icon = 'twitter';
                            color = 'twitter';
                            break;
                        case 5:
                            icon = 'youtube';
                            color = 'youtube';
                            break;
                        case 7:
                            icon = 'instagram';
                            color = 'instagram';
                            break;
                        case 4:
                            icon = 'globe';
                            color = 'news';
                            break;
                        case 3:
                            icon = 'rss';
                            color = 'blog';
                            break;
                        case 6:
                            icon = 'comments';
                            color = 'forum';
                            break;
                        case 8:
                            icon = 'th-large';
                            color = 'allmedia';
                            break;
                        case 9:
                            icon = 'globe';
                            color = 'news';
                            break;
                    }
                    return '<span class="uk-icon-button white-text color-'+color+'" title="'+color+'" uk-tooltip><i class="fa fa-'+icon+'"></i> <span class="uk-hidden">'+icon+'</span></span>';
                }
            },
            {
                title: 'Post', width: '20%',
                data: function ( data ) {
                    var date = data['postDate'];
                    var localtime = moment.parseZone(date).format('llll');
                    var postAuthor = data.post['author'];
                    var postDetails = data.post['post'];
                    var postLink = data.post['url'];
                    var postSentiment = data.post['sentiment'];
                    var post = '<span class="black-text">'+postAuthor+'</span> wrote:<br>'+postDetails+'<br><em class="grey-text">'+localtime+'</em><br><span >'+postSentiment+'</span> | <a href="'+postLink+'" class="uk-button uk-button-text red-text" title="Post Details" target="_blank" uk-tooltip>Post Details <i class="fa fa-angle-right"></i></a>';
					if ( postDetails !== undefined  ) {
						return post;
					} else { return ''; }
                }
            },
            {
                data: 'type', title: 'Type', width: '7.5%'
            },
            {
                title: 'Status', width: '7.5%',
                data: function ( data ) {
                    var status = data['status'];
                    var btn = '';
                    switch (status) {
                        case 'closed':
                            btn = '<span class=black-text title=Responded and closed uk-tooltip>'+status+'</span>'
                        break;
                        case 'open':
                            btn = '<span class=red-text title=Waiting for a response uk-tooltip>'+status+'</span>'
                        break;
                    }

                    return btn;
                }
            },
            {
                orderable: false, class: 'uk-text-center', width: '12%',
                data: function ( data ) {
                    var ticketId = data['ticketId'];
                    var ticketStatus = data['status'];
                    var btn = '';
                    if (ticketStatus === 'close') {
                        btn = '<a href="' + baseUrl + '/ticket/' + ticketId + '/detail" class="uk-button uk-button-small uk-button-secondary" title="Re-open Ticket" uk-tooltip><i class="fa fa-fw fa-envelope-open-o"></i> Re-open</a>';
                    } else {
                        btn = '<a href="' + baseUrl + '/ticket/' + ticketId + '/detail" class="uk-button uk-button-small uk-button-secondary white-text" title="Ticket Details" uk-tooltip><i class="fa fa-fw fa-ticket"></i> Details</a>';
                    }
                    return btn;
                }
            },
        ],
        order: [[ 0, 'desc' ]]
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
