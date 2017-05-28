function ticketList(div) {
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
                title: 'Ticket Date', width: '10%', class: '',
                data: function ( data ) {
                    var localtime = moment.parseZone(data['date']).format('llll');
                    return localtime;
                }
            },
            {
				title: 'From', width: '8%', class: 'uk-text-break',
				data: function ( data ) {
					var name = data['fromName'];
					var group = data['fromGroup'];
					return '<span class="sm-text-bold">'+ name +'</span><br>('+group+')';
				}
			},
            {
				title: 'To', width: '8%', class: 'uk-text-break',
				data: function ( data ) {
					var name = data['sendName'];
					var group = data['sendGroup'];
					return '<span class="sm-text-bold">'+ name +'</span><br>('+group+')';
				}
			},
            {
                title: 'Message', width: '14%', class: 'uk-text-break',
                data: function ( data ) {
                    return '"'+ data['content'] +'"';
                }
            },
            {
                "title": 'Media', "class": 'uk-text-center uk-text-break', "width": '5%',
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
                title: 'Related Post', width: '28%', class: 'uk-text-break',
                data: function ( data ) {
                    var date = data['postDate'];
                    var localtime = moment.parseZone(date).format('llll');
                    var postAuthor = data.post['author'];
                    var datapost = String(data.post['post']);
                    var shortpost = datapost.substring(0, 255);
                    if(datapost.length>255){
                        postDetails = shortpost+'<span title="'+datapost+'" uk-tooltip>... <i class="fa fa-arrow-right"></i></span>';
                    } else {
                        postDetails = datapost;
                    }
                    var postLink = data.post['url'];
                    if (data.post['sentiment'] == 'positive') {
                        var color = 'green';
                    } else if (data.post['sentiment'] == 'negative') {
                        var color = 'red';
                    } else {
                        var color = 'grey'
                    }
                    var postSentiment = '<span class="sm-text-bold '+color+'-text">'+data.post['sentiment']+'</span>';
                    var post = '<span class="sm-text-bold black-text">'+postAuthor+'</span> '+
                    '<em class="grey-text">(on '+localtime+')</em> :'+
                    '<div>'+postDetails+'<div>'+
                    ''+postSentiment+' | <a href="'+postLink+'" class="uk-button uk-button-text uk-text-capitalize blue-text" title="Open link post" target="_blank" uk-tooltip>Original Post</a>';
					if ( datapost == 'undefined' || datapost == '' || datapost === undefined) {
						return '-'
					} else {
                        return post
                    }
                }
            },
            {
                data: 'type', title: 'Type', width: '6%', class: 'uk-text-break',
            },
            {
                title: 'Status', width: '6%', class: 'uk-text-break',
                data: function ( data ) {
                    var status = data['status'];
                    var btn = '';
                    switch (status) {
                        case 'close':
                            btn = '<span class="black-text" title="Responded and closed" uk-tooltip>'+status+'</span>'
                        break;
                        case 'open':
                            btn = '<span class="red-text" title="Waiting for a response" uk-tooltip>'+status+'</span>'
                        break;
                        case 'new':
                            btn = '<span class="orange-text" title="New" uk-tooltip>'+status+'</span>'
                        break;
                    }

                    return btn;
                }
            },
            {
                orderable: false, class: 'uk-text-center uk-text-break', width: '10%',
                data: function ( data ) {
                    var ticketId = data['ticketId'];
                    var ticketStatus = data['status'];
                    var btn = '';
                    if (ticketStatus === 'close') {
                        btn = '<a href="' + baseUrl + '/ticket/' + ticketId + '/detail" class="uk-label sm-label sm-label-close" title="Re-open Ticket" uk-tooltip><i class="fa fa-fw fa-envelope-open-o"></i> Re-open</a>';
                    } else {
                        btn = '<a href="' + baseUrl + '/ticket/' + ticketId + '/detail" class="uk-label sm-label sm-label-open" title="Ticket Details" uk-tooltip><i class="fa fa-fw fa-ticket"></i> Details</a>';
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
