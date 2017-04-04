function tableAll(div) {
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

	$('.convo-title').html('Conversation Ticket');
	$('.convo-info').attr('title', 'Conversation Ticket');

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
			{ data: 'postDate', visible: false, },
            { data: null, "orderable": false, width: '5%', },
            {
                title: 'Date', width: '15%',
                data: function ( data ) {
                    var localtime = moment.parseZone(data['postDate']).format('llll');
                    return localtime;
                }
            },
            // {
			// 	title: 'From', width: '7.5%',
			// 	data: function ( data ) {
			// 		var name = data['fromName'];
			// 		var group = data['fromGroup'];
			// 		return name+' ('+group+')';
			// 	}
			// },
            // {
			// 	title: 'To', width: '7.5%',
			// 	data: function ( data ) {
			// 		var name = data['sendName'];
			// 		var group = data['sendGroup'];
			// 		return name+' ('+group+')';
			// 	}
			// },
            // { data: 'content', title: 'Message', width: '10%' },
            {
                data: 'media', title: 'Channel', class: 'uk-text-center',  width: '10%',
                render: function ( cellData ) {
                    var channel = cellData;
                    var icon = '';
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
			{
                title: 'Author', width: '15%',
                data: function ( data ) {
                    // var date = data['postDate'];
                    // var localtime = moment.parseZone(date).format('llll');
                    var postAuthor = data.post['author'];
                    // var postDetails = data.post['post'];
                    // var postLink = data.post['url'];
                    // var postSentiment = data.post['sentiment'];
                    var post = postAuthor;
					if ( postAuthor !== undefined  ) {
						return post;
					} else { return ''; }
                }
            },
            {
                title: 'Post', width: '30%',
                data: function ( data ) {
                    // var date = data['postDate'];
                    // var localtime = moment.parseZone(date).format('llll');
                    // var postAuthor = data.post['author'];
                    var postDetails = data.post['post'];
                    // var postLink = data.post['url'];
                    // var postSentiment = data.post['sentiment'];
                    var post = postDetails;
					if ( postDetails !== undefined  ) {
						return post;
					} else { return ''; }
                }
            },
			{
				"title": "Sentiment",
				"width": "15%",
				"orderable": false,
				"class": "sentiment uk-text-center",
				"data": "sentiment",
				"createdCell": function(td, cellData, rowData, row, col) {
					var id = rowData['id'];
					// console.log(id);
					switch (cellData) {
						case 'positive':
							$(td).addClass('sm-sentiment green-text').attr('data-id', id);
							break;
						case 'neutral':
							$(td).addClass('sm-sentiment grey-text').attr('data-id', id);
							break;
						case 'negative':
							$(td).addClass('sm-sentiment red-text').attr('data-id', id);
							break;
					}
				}
			},
			// {
            //     data: 'type', title: 'Type', width: '10%'
            // },
			{
				"title": "Status",
				"orderable": false,
				"width": "20%",
				"class": "uk-text-center",
				"data": function(data) {
					var cellData = data['status'];
					var id = data['id'];
					var btn = '';
					switch (cellData) {
						case 'new':
							btn = '<a uk-tooltip title="Open New Ticket" class="sm-btn-openticket orange-text white uk-badge sm-badge" data-id="' + id + '"><span class="nothover">' + cellData + '</span></a>';
							break;
						case 'closed':
							btn = '<span class="black-text" title="Responded and closed" uk-tooltip>' + cellData + '</span>';
							break;
						case 'open':
							btn = '<span class="red-text" title="Waiting for a response" uk-tooltip>' + cellData + '</span>';
							break;
						default:

							break;
					}
					//console.log(row);
					return btn;
				}
			}
            // {
            //     orderable: false, class: 'uk-text-center', width: '12%',
            //     data: function ( data ) {
            //         var ticketId = data['ticketId'];
            //         var ticketStatus = data['status'];
            //         var btn = '';
            //         if (ticketStatus === 'open') {
            //             btn = '<a href="' + baseUrl + '/ticket/' + ticketId + '/detail" class="uk-button uk-button-small uk-button-secondary red white-text" title="Ticket Details" uk-tooltip><i class="fa fa-fw fa-ticket"></i> Details</a>'
            //         } else {
            //             btn = '<a href="' + baseUrl + '/ticket/' + ticketId + '/reopen" class="uk-button uk-button-small uk-button-secondary" title="Re-open Ticket" uk-tooltip><i class="fa fa-fw fa-envelope-open-o"></i> Re-open</a>'
            //         }
            //         return btn;
            //     }
            // },
        ],
        order: [[ 0, 'desc' ]]
    });

    theTable.on( 'order.dt search.dt', function () {
        theTable.column(1, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    theTable.columns.adjust().draw();
}


// Table convo tableAll
// function tableAll(chartId, url, chartApiData) {
// 	var theTable = $('#' + chartId).DataTable({
// 		processing: true,
//         serverSide: true,
//         ajax: {
// 		    url: url,
//             type: "POST",
//             data: chartApiData,
//             complete: function(data) {
// 		        if (data.responseJSON.draw == 1) {
// 		            var title = data.responseJSON.chartName;
// 		            var info = data.responseJSON.chartInfo;
//                     $('.convo-title').html('Conversation Ticket');
//                     $('.convo-info').attr('title', info);
// 					console.log(data);
//                 }
//             }
//         },
//         pageLength: 25,
// 		buttons: {
// 			buttons: [
// 				{
// 					extend: 'excelHtml5',
// 					className: 'uk-button uk-button-small green darken-2 white-text uk-margin-small-left'
// 				},
// 				{
// 					extend: 'csvHtml5',
// 					className: 'uk-button uk-button-small teal white-text uk-margin-small-left'
// 				}
// 			]
// 		},
// 		columns: [{
// 				"data": "postDate",
// 				"visible": false
// 			},
// 			{
// 				"data": null,
// 				"orderable": false,
// 				"width": "2.5%"
// 			},
// 			{
// 				"title": "postDate",
// 				"width": "12.5%",
// 				"data": function(data) {
// 					var localtime = moment.parseZone(data['Date']).format('llll');
// 					return localtime;
// 				}
// 			},
// 			{
// 				"data": "post.author",
// 				"title": "Author",
// 				"width": "20%"
// 			},
// 			{
// 				"title": "Post",
// 				"width": "35%",
// 				"data": function(data) {
// 					var post = data.post["post"];
// 					var postrim = post.substring(0, 100) + "...";
// 					var plink = data.post["url"];
// 					return '<a href="' + plink + '" target="_blank" data-uk-tooltip title="' + post + '" class="uk-link">' + postrim + '</a>';
// 				}
// 			},
// 			{
// 				"data": "media",
// 				"title": "Type",
// 				"width": "10%"
// 			},
// 			{
// 				"title": "",
// 				"width": "10%",
// 				"orderable": false,
// 				"class": "sentiment uk-text-center",
// 				"data": "post.sentiment",
// 				"createdCell": function(td, cellData, rowData, row, col) {
// 					var id = rowData['id'];
// 					// console.log(id);
// 					switch (cellData) {
// 						case 'positive':
// 							$(td).addClass('sm-sentiment green-text').attr('data-id', id);
// 							break;
// 						case 'neutral':
// 							$(td).addClass('sm-sentiment grey-text').attr('data-id', id);
// 							break;
// 						case 'negative':
// 							$(td).addClass('sm-sentiment red-text').attr('data-id', id);
// 							break;
// 					}
// 				}
// 			},
// 			{
// 				"title": "Status",
// 				"orderable": false,
// 				"width": "10%",
// 				"class": "uk-text-center",
// 				"data": function(data) {
// 					var cellData = data['status'];
// 					var id = data['id'];
// 					var btn = '';
// 					switch (cellData) {
// 						case 'new':
// 							btn = '<a uk-tooltip title="Open New Ticket" class="sm-btn-openticket orange-text white uk-badge sm-badge" data-id="' + id + '"><span class="nothover">' + cellData + '</span></a>';
// 							break;
// 						case 'closed':
// 							btn = '<span class="black-text" title="Responded and closed" uk-tooltip>' + cellData + '</span>';
// 							break;
// 						case 'waiting':
// 							btn = '<span class="red-text" title="Waiting for a response" uk-tooltip>' + cellData + '</span>';
// 							break;
// 						default:
//
// 							break;
// 					}
// 					//console.log(row);
// 					return btn;
// 				}
// 			}
// 		],
// 		order: [
// 			[0, "desc"]
// 		],
// 		initComplete: function() {
// 			this.api().columns().every(function() {
// 				var column = this;
// 				if (column[0][0] == 9) {
// 					var select = $('<select class="uk-select select-sentiment"><option value="">All Sentiment</option></select>')
// 						.appendTo($(column.header()).empty())
// 						.on('change', function() {
// 							var val = $.fn.dataTable.util.escapeRegex(
// 								$(this).val()
// 							);
// 							column
// 								.search($(this).val())
// 								.draw();
// 						});
//
// 					column.data().unique().sort().each(function(d, j) {
// 						select.append('<option value="' + d + '">' + d + '</option>')
// 					});
// 				}
// 			});
// 		}
// 	});
// 	theTable.on('order.dt search.dt draw.dt', function() {
//         var info = theTable.page.info();
// 		theTable.column(1, {
// 			search: 'applied',
// 			order: 'applied'
// 		}).nodes().each(function(cell, i) {
// 			cell.innerHTML = info.start + i + 1;
// 		});
// 	}).draw();
// 	theTable.columns.adjust().draw();
//
// 	return theTable;
// }
