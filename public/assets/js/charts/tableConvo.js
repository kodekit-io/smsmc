function tableConvo(domId, url, chartApiData, name) {
	var xxx = 0;
	$.ajax({
		method: "POST",
		url: url,
		data: chartApiData,
		beforeSend: function(xhr) {
			var cardloader = '<div class="cardloader sm-chart-container uk-animation-fade">' +
				'<div class="uk-card uk-card-small">' +
				'<div class="uk-card-header uk-clearfix">' +
				'<h5 class="uk-card-title uk-float-left"></h5>' +
				'</div>' +
				'<div class="uk-card-body">' +
				'<div class="sm-chart"><div class="uk-position-center" uk-spinner></div></div>' +
				'</div>' +
				'</div>' +
				'</div>';
			$('#' + domId).append(cardloader);
			xxx++;
		},
		complete: function(xhr, status) {
			xxx--;
			if (xxx <= 0) {
				$('.cardloader').remove();
			}
		},
		success: function(result) {
			var result = jQuery.parseJSON(result);
			// console.log(result);

			var chartId = result.chartId;
			var chartName = result.chartName;
			var chartInfo = result.chartInfo;
			var chartData = result.chartData;
			if (name != null) {
				var chartTitle = name;
			} else {
				var chartTitle = chartName;
			}

			var card = '<div id="' + chartId + '" class="sm-chart-container uk-animation-fade">' +
				'<div class="uk-card uk-card-hover uk-card-default uk-card-small">' +
				'<div class="uk-card-header uk-clearfix">' +
				'<h5 class="uk-card-title uk-float-left">' + chartTitle + '</h5>' +
				'<ul class="uk-float-right uk-subnav uk-margin-remove">' +
				'<li><a class="grey-text fa fa-info-circle" title="' + chartInfo + '" uk-tooltip></a></li>' +
				'<li><a onclick="hideThis(this)" class="grey-text fa fa-eye-slash" title="Hide This" uk-tooltip></a></li>' +
				'<li><a onclick="fullscreen(this)" class="grey-text fa fa-expand" title="Full Screen" uk-tooltip></a></li>' +
				'</ul>' +
				'</div>' +
				'<div class="uk-card-body">' +
				'<table id="' + chartId + 'Table" class="uk-table uk-table-condensed uk-table-striped uk-width-1-1 sm-table uk-margin-remove"></table>' +
				'</div>' +
				'</div>' +
				'</div>';
			$('#' + domId).append(card);

			var idMedia = chartApiData.idMedia;
			switch (idMedia) {
				case 1:
					tableFacebook(chartId, chartData);
					break;
				case 2:
					tableTwitter(chartId, chartData);
					break;
				case 3:
					tableBlog(chartId, chartData);
					break;
				case 4:
					tableNews(chartId, chartData);
					break;
				case 5:
					tableVideo(chartId, chartData);
					break;
				case 6:
					tableForum(chartId, chartData);
					break;
				case 7:
					tableInstagram(chartId, chartData);
					break;
				case 8:
					tableAll(chartId, chartData);
					break;
			}

			// Send Ticket
			$('#' + chartId + 'Table').on('click', '.sm-btn-openticket', function(e) {
			    var $createTicketUrl = chartApiData.baseUrl + '/convo/create-ticket';
			    var $ticketTypes = chartApiData.ticketTypes;
				e.preventDefault();
				$(this).blur();
				var postId = $(this).attr('data-id');

				var ticketType = '';
				for (i=0; i < $ticketTypes.length; i++) {
				    var $ticketTypeId = $ticketTypes[i].id;
				    var $ticketTypeName = $ticketTypes[i].name;
				    ticketType += '<li><label><input class="uk-checkbox" type="checkbox" name="types[]" value="' + $ticketTypeId + '"> ' + $ticketTypeName + '</label></li>';
                }

				var modal = '<form class="open-ticket" method="post" action="'+ $createTicketUrl +'">' +
                    '<input type="hidden" value="' + chartApiData._token + '" name="_token" /> ' +
					'<div class="uk-modal-body">' +
                        '<h5>Open New Ticket</h5>' +
                        '<div class="uk-margin">' +
                            '<label>To</label>' +
                            '<input class="uk-input" type="text" name="to">' +
                        '</div>' +
                        '<div class="uk-margin">' +
                            '<label>CC</label>' +
                            '<input class="uk-input" type="text" name="to_cc">' +
                        '</div>' +
                        '<div class="uk-margin">' +
                            '<div class="uk-inline">' +
                                '<a class="uk-button uk-button-default uk-button-small">Ticket Type <span uk-icon="icon: chevron-down"></span></a>' +
                                '<div class="sm-dropdown">' +
                                    '<ul class="uk-nav uk-navbar-dropdown-nav uk-list-line">' +
                                        ticketType +
                                    '</ul>' +
                                '</div>' +
					        '</div>' +
					    '</div>' +
                        '<div class="uk-margin">' +
                            '<textarea class="uk-textarea" rows="3" name="message" placeholder="Additional message"></textarea>' +
                            '<input type="hidden" name="postId" value="' + postId + '">' +
                        '</div>' +
					'</div>' +
					'<div class="uk-modal-footer uk-clearfix">' +
                        '<a class="uk-modal-close uk-button grey white-text">CANCEL</a>' +
                        '<button class="uk-button uk-float-right red white-text" name="createticket" value="createticket" type="submit" id="submitticket">SUBMIT</button>' +
					'</div>' +
					'</form>';
				UIkit.modal.dialog(modal);
			});

			// Edit Sentiment
			$('#' + chartId + 'Table').on('click', '.sm-sentiment', function(e) {
				e.preventDefault();
				$(this).blur();
				var id = $(this).attr('data-id');
				var modal = '<form id="changeSentiment" class="change-sentiment">' +
					'<div class="uk-modal-body">' +
					'<h5>Edit Sentiment</h5>' +
					'<div class="uk-margin">' +
					'<select class="uk-select">' +
					'<option value="1">Positive</option>' +
					'<option value="0">Neutral</option>' +
					'<option value="-1">Negative</option>' +
					'</select>' +
					'<input type="hidden" name="id" value="' + id + '" >' +
					'</div>' +
					'</div>' +
					'<div class="uk-modal-footer uk-clearfix">' +
					'<a class="uk-modal-close uk-button grey white-text">CANCEL</a>' +
					'<button class="uk-button uk-float-right red white-text" type="submit">SUBMIT</button>' +
					'</div>' +
					'</form>';
				UIkit.modal.dialog(modal);

			});

		}
	});
}

function tableAll(chartId, chartData) {
	var theTable = $('#' + chartId + 'Table').DataTable({
		data: chartData, pageLength: 25,
		buttons: {
			buttons: [
				//{ extend: 'pdfHtml5', className: 'uk-button uk-button-small red white-text' },
				{
					extend: 'excelHtml5',
					className: 'uk-button uk-button-small green darken-2 white-text uk-margin-small-left'
				},
				{
					extend: 'csvHtml5',
					className: 'uk-button uk-button-small teal white-text uk-margin-small-left'
				}
			]
		},
		columns: [{
				"data": "postDate",
				"visible": false
			},
			{
				"data": null,
				"orderable": false,
				"width": "2.5%"
			},
			{
				"title": "postDate",
				"width": "12.5%",
				"data": function(data) {
					var localtime = moment.parseZone(data['Date']).format('llll');
					return localtime;
				}
			},
			{
				"data": "post.author",
				"title": "Author",
				"width": "20%"
			},
			{
				"title": "Post",
				"width": "35%",
				"data": function(data) {
					var post = data.post["post"];
					var postrim = post.substring(0, 100) + "...";
					var plink = data.post["url"];
					return '<a href="' + plink + '" target="_blank" data-uk-tooltip title="' + post + '" class="uk-link">' + postrim + '</a>';
				}
			},
			{
				"data": "media",
				"title": "Type",
				"width": "10%"
			},
			{
				"title": "",
				"width": "10%",
				"orderable": false,
				"class": "sentiment uk-text-center",
				"data": "post.sentiment",
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
			{
				"title": "Status",
				"orderable": false,
				"width": "10%",
				"class": "uk-text-center",
				"data": function(data) {
					var cellData = data['status'];
					var id = data['id'];
					var btn = '';
					switch (cellData) {
						case 'New':
							btn = '<a uk-tooltip title="Open New Ticket" class="sm-btn-openticket orange-text white uk-badge sm-badge" data-id="' + id + '"><span class="nothover">' + cellData + '</span></a>';
							break;
						case 'Closed':
							btn = '<span class="black-text" title="Responded and closed" uk-tooltip>' + cellData + '</span>';
							break;
						case 'Waiting':
							btn = '<span class="red-text" title="Waiting for a response" uk-tooltip>' + cellData + '</span>';
							break;
						default:

							break;
					}
					//console.log(row);
					return btn;
				}
			}
		],
		order: [
			[0, "desc"]
		],
		// order: [[ 1, "desc" ]],
		// initComplete: function () {
		//     this.api().columns().every( function () {
		//         var column = this;
		//         if(column[0][0] == 5) {
		//             var select = $('<select class="uk-select select-sentiment"><option value="">All Sentiment</option></select>')
		//                 .appendTo( $(column.header()).empty() )
		//                 .on( 'change', function () {
		//                     var val = $.fn.dataTable.util.escapeRegex(
		//                         $(this).val()
		//                     );
		//                     column
		//                         .search( val ? '^'+val+'$' : '', true, false )
		//                         .draw();
		//                 } );
		//
		//             column.data().unique().sort().each( function ( d, j ) {
		//                 select.append( '<option value="'+d+'">'+d+'</option>' )
		//             });
		//         }
		//         if(column[0][0] == 6) {
		//             var select = $('<select class="uk-select select-status"><option value="">All Status</option></select>')
		//                 .appendTo( $(column.header()).empty() )
		//                 .on( 'change', function () {
		//                     var val = $.fn.dataTable.util.escapeRegex(
		//                         $(this).val()
		//                     );
		//                     column
		//                         .search( val ? '^'+val+'$' : '', true, false )
		//                         .draw();
		//                 } );
		//
		//             column.data().unique().sort().each( function ( d, j ) {
		//                 select.append( '<option value="'+d+'">'+d+'</option>' )
		//             });
		//         }
		//     });
		// }
	});
	theTable.on('order.dt search.dt', function() {
		theTable.column(0, {
			search: 'applied',
			order: 'applied'
		}).nodes().each(function(cell, i) {
			cell.innerHTML = i + 1;
		});
	}).draw();
	theTable.columns.adjust().draw();
}

// Table convo Facebook
function tableFacebook(chartId, chartData) {
	var theTable = $('#' + chartId + 'Table').DataTable({
		data: chartData, pageLength: 25,
		buttons: {
			buttons: [
				//{ extend: 'pdfHtml5', className: 'uk-button uk-button-small red white-text' },
				{
					extend: 'excelHtml5',
					className: 'uk-button uk-button-small green darken-2 white-text uk-margin-small-left'
				},
				{
					extend: 'csvHtml5',
					className: 'uk-button uk-button-small teal white-text uk-margin-small-left'
				}
			]
		},
		columns: [{
				"data": "Date",
				"visible": false
			},
			{
				"data": null,
				"orderable": false,
				"width": "2.5%"
			},
			{
				"title": "Date",
				"width": "12.5%",
				"data": function(data) {
					var localtime = moment.parseZone(data['Date']).local().format('llll');
					return localtime;
				}
			},
			{
				"data": "Author",
				"title": "Author",
				"width": "17.5%"
			},
			{
				"title": "Post",
				"width": "35%",
				"data": function(data) {
					var post = data["Post"];
					var postrim = post.substring(0, 100) + "...";
					var plink = data["Link"];
					return '<a href="' + plink + '" target="_blank" data-uk-tooltip title="' + post + '" class="uk-link">' + postrim + '</a>';
				}
			},
			{
				"data": "Media Type",
				"title": "Type",
				"width": "5%"
			},
			{
				"data": "Comments",
				"title": "<span class='fa fa- fa-comment' title='Comment' uk-tooltip></span>",
				"class": "uk-text-right",
				"width": "2.5%"
			},
			{
				"data": "Likes",
				"title": "<span class='fa fa- fa-thumbs-up' title='Like' uk-tooltip></span>",
				"class": "uk-text-right",
				"width": "2.5%"
			},
			{
				"data": "Shares",
				"title": "<span class='fa fa- fa-share' title='Share' uk-tooltip></span>",
				"class": "uk-text-right",
				"width": "2.5%"
			},
			{
				"title": "",
				"width": "10%",
				"orderable": false,
				"class": "sentiment uk-text-center",
				"data": "Sentiment",
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
			{
				"title": "Status",
				"orderable": false,
				"width": "10%",
				"class": "uk-text-center",
				"data": function(data) {
					var cellData = data['status'];
					var id = data['id'];
					var btn = '';
					switch (cellData) {
						case 'New':
							btn = '<a uk-tooltip title="Open New Ticket" class="sm-btn-openticket orange-text white uk-badge sm-badge" data-id="' + id + '"><span class="nothover">' + cellData + '</span></a>';
							break;
						case 'Closed':
							btn = '<span class="black-text" title="Responded and closed" uk-tooltip>' + cellData + '</span>';
							break;
						case 'Waiting':
							btn = '<span class="red-text" title="Waiting for a response" uk-tooltip>' + cellData + '</span>';
							break;
						default:

							break;
					}
					//console.log(row);
					return btn;
				}
			}
		],
		order: [
			[0, "desc"]
		],
		initComplete: function() {
			this.api().columns().every(function() {
				var column = this;
				if (column[0][0] == 9) {
					var select = $('<select class="uk-select select-sentiment"><option value="">All Sentiment</option></select>')
						.appendTo($(column.header()).empty())
						.on('change', function() {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
							);
							column
								.search(val ? '^' + val + '$' : '', true, false)
								.draw();
						});

					column.data().unique().sort().each(function(d) {
						select.append('<option value="' + d + '">' + d + '</option>')
					});
				}
				if (column[0][0] == 10) {
					var select = $('<select class="uk-select select-status"><option value="">All Status</option></select>')
						.appendTo($(column.header()).empty())
						.on('change', function() {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
							);
							column
								.search(val ? '^' + val + '$' : '', true, false)
								.draw();
						});

					column.data().unique().sort().each(function(d, j) {
						select.append('<option value="' + d + '">' + d + '</option>')
					});
				}
			});
		}
	});
	theTable.on('order.dt search.dt', function() {
		theTable.column(1, {
			search: 'applied',
			order: 'applied'
		}).nodes().each(function(cell, i) {
			cell.innerHTML = i + 1;
		});
	}).draw();
	theTable.columns.adjust().draw();
}

// Table convo twitter
function tableTwitter(chartId, chartData) {
	var theTable = $('#' + chartId + 'Table').DataTable({
		data: chartData, pageLength: 25,
		buttons: {
			buttons: [
				//{ extend: 'pdfHtml5', className: 'uk-button uk-button-small red white-text' },
				{
					extend: 'excelHtml5',
					className: 'uk-button uk-button-small green darken-2 white-text uk-margin-small-left'
				},
				{
					extend: 'csvHtml5',
					className: 'uk-button uk-button-small teal white-text uk-margin-small-left'
				}
			]
		},
		columns: [{
				"data": "Date",
				"visible": false
			},
			{
				"data": null,
				"orderable": false,
				"width": "2.5%"
			},
			{
				"title": "Date",
				"width": "12.5%",
				"data": function(data) {
					var localtime = moment.parseZone(data['Date']).local().format('llll');
					return localtime;
				}
			},
			{
				"data": "Author",
				"title": "Author",
				"width": "15%"
			},
			{
				"title": "Post",
				"width": "30%",
				"data": function(data) {
					var post = data["Post"];
					var postrim = post.substring(0, 100) + "...";
					var plink = data["Link"];
					return '<a href="' + plink + '" target="_blank" data-uk-tooltip title="' + post + '" class="uk-link">' + postrim + '</a>';
				}
			},
			{
				"data": "Interactions",
				"title": "Inter- actions",
				"class": "uk-text-right",
				"width": "5%"
			},
			{
				"data": "Original Reach",
				"title": "Original Reach",
				"class": "uk-text-right",
				"width": "5%"
			},
			{
				"data": "Viral Reach",
				"title": "Viral Reach",
				"class": "uk-text-right",
				"width": "5%"
			},
			{
				"data": "Viral Score",
				"title": "Viral Score",
				"class": "uk-text-right",
				"width": "5%"
			},
			{
				"title": "",
				"width": "10%",
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
			{
				"title": "Status",
				"orderable": false,
				"width": "10%",
				"class": "uk-text-center",
				"data": function(data) {
					var cellData = data['status'];
					var id = data['id'];
					var btn = '';
					switch (cellData) {
						case 'New':
							btn = '<a uk-tooltip title="Open New Ticket" class="sm-btn-openticket orange-text white uk-badge sm-badge" data-id="' + id + '"><span class="nothover">' + cellData + '</span></a>';
							break;
						case 'Closed':
							btn = '<span class="black-text" title="Responded and closed" uk-tooltip>' + cellData + '</span>';
							break;
						case 'Waiting':
							btn = '<span class="red-text" title="Waiting for a response" uk-tooltip>' + cellData + '</span>';
							break;
						default:

							break;
					}
					//console.log(row);
					return btn;
				}
			}
		],
		order: [
			[0, "desc"]
		],
		initComplete: function() {
			this.api().columns().every(function() {
				var column = this;
				if (column[0][0] == 9) {
					var select = $('<select class="uk-select select-sentiment"><option value="">All Sentiment</option></select>')
						.appendTo($(column.header()).empty())
						.on('change', function() {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
							);
							column
								.search(val ? '^' + val + '$' : '', true, false)
								.draw();
						});

					column.data().unique().sort().each(function(d, j) {
						select.append('<option value="' + d + '">' + d + '</option>')
					});
				}
				if (column[0][0] == 10) {
					var select = $('<select class="uk-select select-status"><option value="">All Status</option></select>')
						.appendTo($(column.header()).empty())
						.on('change', function() {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
							);
							column
								.search(val ? '^' + val + '$' : '', true, false)
								.draw();
						});

					column.data().unique().sort().each(function(d, j) {
						select.append('<option value="' + d + '">' + d + '</option>')
					});
				}
			});
		}
	});
	theTable.on('order.dt search.dt', function() {
		theTable.column(1, {
			search: 'applied',
			order: 'applied'
		}).nodes().each(function(cell, i) {
			cell.innerHTML = i + 1;
		});
	}).draw();
	theTable.columns.adjust().draw();
}

// Table convo news
function tableNews(chartId, chartData) {
	var theTable = $('#' + chartId + 'Table').DataTable({
		data: chartData, pageLength: 25,
		buttons: {
			buttons: [
				//{ extend: 'pdfHtml5', className: 'uk-button uk-button-small red white-text' },
				{
					extend: 'excelHtml5',
					className: 'uk-button uk-button-small green darken-2 white-text uk-margin-small-left'
				},
				{
					extend: 'csvHtml5',
					className: 'uk-button uk-button-small teal white-text uk-margin-small-left'
				}
			]
		},
		columns: [{
				"data": "Date",
				"visible": false
			},
			{
				"data": null,
				"orderable": false,
				"width": "2.5%"
			},
			{
				"title": "Date",
				"width": "12.5%",
				"data": function(data) {
					var localtime = moment.parseZone(data['Date']).local().format('llll');
					return localtime;
				}
			},
			{
				"data": "Media",
				"title": "Media",
				"width": "20%"
			},
			{
				"title": "Post",
				"width": "30%",
				"data": function(data) {
					var title = data["Title"];
					var post = data["Summary"];
					var postrim = post.substring(0, 100) + " ...";
					var plink = data["url"];
					return '<a href="' + plink + '" target="_blank" data-uk-tooltip title="' + postrim + '" class="uk-link">' + title + '</a>';
				}
			},
			{
				"data": "Comments",
				"title": "Comments",
				"class": "uk-text-right",
				"width": "7.5%"
			},
			{
				"data": "Reach",
				"title": "Reach",
				"class": "uk-text-right",
				"width": "7.5%"
			},
			{
				"title": "",
				"width": "10%",
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
			{
				"title": "Status",
				"orderable": false,
				"width": "10%",
				"class": "uk-text-center",
				"data": function(data) {
					var cellData = data['status'];
					var id = data['id'];
					var btn = '';
					switch (cellData) {
						case 'New':
							btn = '<a uk-tooltip title="Open New Ticket" class="sm-btn-openticket orange-text white uk-badge sm-badge" data-id="' + id + '"><span class="nothover">' + cellData + '</span></a>';
							break;
						case 'Closed':
							btn = '<span class="black-text" title="Responded and closed" uk-tooltip>' + cellData + '</span>';
							break;
						case 'Waiting':
							btn = '<span class="red-text" title="Waiting for a response" uk-tooltip>' + cellData + '</span>';
							break;
						default:

							break;
					}
					//console.log(row);
					return btn;
				}
			}
		],
		order: [
			[0, "desc"]
		],
		initComplete: function() {
			this.api().columns().every(function() {
				var column = this;
				if (column[0][0] == 7) {
					var select = $('<select class="uk-select select-sentiment"><option value="">All Sentiment</option></select>')
						.appendTo($(column.header()).empty())
						.on('change', function() {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
							);
							column
								.search(val ? '^' + val + '$' : '', true, false)
								.draw();
						});

					column.data().unique().sort().each(function(d, j) {
						select.append('<option value="' + d + '">' + d + '</option>')
					});
				}
				if (column[0][0] == 8) {
					var select = $('<select class="uk-select select-status"><option value="">All Status</option></select>')
						.appendTo($(column.header()).empty())
						.on('change', function() {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
							);
							column
								.search(val ? '^' + val + '$' : '', true, false)
								.draw();
						});

					column.data().unique().sort().each(function(d, j) {
						select.append('<option value="' + d + '">' + d + '</option>')
					});
				}
			});
		}
	});
	theTable.on('order.dt search.dt', function() {
		theTable.column(1, {
			search: 'applied',
			order: 'applied'
		}).nodes().each(function(cell, i) {
			cell.innerHTML = i + 1;
		});
	}).draw();
	theTable.columns.adjust().draw();
}
// Table convo blog
function tableBlog(chartId, chartData) {
	var theTable = $('#' + chartId + 'Table').DataTable({
		data: chartData, pageLength: 25,
		buttons: {
			buttons: [
				//{ extend: 'pdfHtml5', className: 'uk-button uk-button-small red white-text' },
				{
					extend: 'excelHtml5',
					className: 'uk-button uk-button-small green darken-2 white-text uk-margin-small-left'
				},
				{
					extend: 'csvHtml5',
					className: 'uk-button uk-button-small teal white-text uk-margin-small-left'
				}
			]
		},
		columns: [{
				"data": "Date",
				"visible": false
			},
			{
				"data": null,
				"orderable": false,
				"width": "2.5%"
			},
			{
				"title": "Date",
				"width": "12.5%",
				"data": function(data) {
					var localtime = moment.parseZone(data['Date']).local().format('llll');
					return localtime;
				}
			},
			{
				"title": "Author",
				"width": "20%",
				"data": function(data) {
					var author = data["Author"];
					var link = '//' + data["Author Url"];
					return '<a href="' + link + '" target="_blank" data-uk-tooltip title="' + author + '" class="uk-link">' + author + '</a>';
				}
			},
			{
				"title": "Post",
				"width": "45%",
				"data": function(data) {
					var title = data["Title"];
					var post = data["Summary"];
					var postrim = post.substring(0, 100) + " ...";
					var plink = data["Url"];
					return '<a href="' + plink + '" target="_blank" data-uk-tooltip title="' + postrim + '" class="uk-link">' + title + '</a>';
				}
			},
			{
				"title": "",
				"width": "10%",
				"orderable": false,
				"class": "sentiment uk-text-center",
				"data": "Sentiment",
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
			{
				"title": "Status",
				"orderable": false,
				"width": "10%",
				"class": "uk-text-center",
				"data": function(data) {
					var cellData = data['status'];
					var id = data['id'];
					var btn = '';
					switch (cellData) {
						case 'New':
							btn = '<a uk-tooltip title="Open New Ticket" class="sm-btn-openticket orange-text white uk-badge sm-badge" data-id="' + id + '"><span class="nothover">' + cellData + '</span></a>';
							break;
						case 'Closed':
							btn = '<span class="black-text" title="Responded and closed" uk-tooltip>' + cellData + '</span>';
							break;
						case 'Waiting':
							btn = '<span class="red-text" title="Waiting for a response" uk-tooltip>' + cellData + '</span>';
							break;
						default:

							break;
					}
					//console.log(row);
					return btn;
				}
			}
		],
		order: [
			[0, "desc"]
		],
		initComplete: function() {
			this.api().columns().every(function() {
				var column = this;
				if (column[0][0] == 5) {
					var select = $('<select class="uk-select select-sentiment"><option value="">All Sentiment</option></select>')
						.appendTo($(column.header()).empty())
						.on('change', function() {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
							);
							column
								.search(val ? '^' + val + '$' : '', true, false)
								.draw();
						});

					column.data().unique().sort().each(function(d, j) {
						select.append('<option value="' + d + '">' + d + '</option>')
					});
				}
				if (column[0][0] == 6) {
					var select = $('<select class="uk-select select-status"><option value="">All Status</option></select>')
						.appendTo($(column.header()).empty())
						.on('change', function() {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
							);
							column
								.search(val ? '^' + val + '$' : '', true, false)
								.draw();
						});

					column.data().unique().sort().each(function(d, j) {
						select.append('<option value="' + d + '">' + d + '</option>')
					});
				}
			});
		}
	});
	theTable.on('order.dt search.dt', function() {
		theTable.column(1, {
			search: 'applied',
			order: 'applied'
		}).nodes().each(function(cell, i) {
			cell.innerHTML = i + 1;
		});
	}).draw();
	theTable.columns.adjust().draw();
}
// Table convo Forum
function tableForum(chartId, chartData) {
	var theTable = $('#' + chartId + 'Table').DataTable({
		data: chartData, pageLength: 25,
		buttons: {
			buttons: [
				//{ extend: 'pdfHtml5', className: 'uk-button uk-button-small red white-text' },
				{
					extend: 'excelHtml5',
					className: 'uk-button uk-button-small green darken-2 white-text uk-margin-small-left'
				},
				{
					extend: 'csvHtml5',
					className: 'uk-button uk-button-small teal white-text uk-margin-small-left'
				}
			]
		},
		columns: [{
				"data": "Date",
				"visible": false
			},
			{
				"data": null,
				"orderable": false,
				"width": "2.5%"
			},
			{
				"title": "Date",
				"width": "12.5%",
				"data": function(data) {
					var localtime = moment.parseZone(data['Date']).local().format('llll');
					return localtime;
				}
			},
			{
				"data": "Media",
				"title": "Media",
				"width": "20%"
			},
			{
				"title": "Post",
				"width": "30%",
				"data": function(data) {
					var title = data["Title"];
					var post = data["Summary"];
					var postrim = post.substring(0, 100) + " ...";
					var plink = data["url"];
					return '<a href="' + plink + '" target="_blank" data-uk-tooltip title="' + postrim + '" class="uk-link">' + title + '</a>';
				}
			},
			{
				"data": "Comments",
				"title": "Comments",
				"class": "uk-text-right",
				"width": "7.5%"
			},
			{
				"data": "Reach",
				"title": "Reach",
				"class": "uk-text-right",
				"width": "7.5%"
			},
			{
				"title": "",
				"width": "10%",
				"orderable": false,
				"class": "sentiment uk-text-center",
				"data": "sentiment",
				"createdCell": function(td, cellData, rowData, row, col) {
					var id = rowData['id'];
					console.log(id);
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
			{
				"title": "Status",
				"orderable": false,
				"width": "10%",
				"class": "uk-text-center",
				"data": function(data) {
					var cellData = data['status'];
					var id = data['id'];
					var btn = '';
					switch (cellData) {
						case 'New':
							btn = '<a uk-tooltip title="Open New Ticket" class="sm-btn-openticket orange-text white uk-badge sm-badge" data-id="' + id + '"><span class="nothover">' + cellData + '</span></a>';
							break;
						case 'Closed':
							btn = '<span class="black-text" title="Responded and closed" uk-tooltip>' + cellData + '</span>';
							break;
						case 'Waiting':
							btn = '<span class="red-text" title="Waiting for a response" uk-tooltip>' + cellData + '</span>';
							break;
						default:

							break;
					}
					//console.log(row);
					return btn;
				}
			}
		],
		order: [
			[0, "desc"]
		],
		initComplete: function() {
			this.api().columns().every(function() {
				var column = this;
				if (column[0][0] == 7) {
					var select = $('<select class="uk-select select-sentiment"><option value="">All Sentiment</option></select>')
						.appendTo($(column.header()).empty())
						.on('change', function() {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
							);
							column
								.search(val ? '^' + val + '$' : '', true, false)
								.draw();
						});

					column.data().unique().sort().each(function(d, j) {
						select.append('<option value="' + d + '">' + d + '</option>')
					});
				}
				if (column[0][0] == 8) {
					var select = $('<select class="uk-select select-status"><option value="">All Status</option></select>')
						.appendTo($(column.header()).empty())
						.on('change', function() {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
							);
							column
								.search(val ? '^' + val + '$' : '', true, false)
								.draw();
						});

					column.data().unique().sort().each(function(d, j) {
						select.append('<option value="' + d + '">' + d + '</option>')
					});
				}
			});
		}
	});
	theTable.on('order.dt search.dt', function() {
		theTable.column(1, {
			search: 'applied',
			order: 'applied'
		}).nodes().each(function(cell, i) {
			cell.innerHTML = i + 1;
		});
	}).draw();
	theTable.columns.adjust().draw();
}
// Table convo Video
function tableVideo(chartId, chartData) {
	var theTable = $('#' + chartId + 'Table').DataTable({
		data: chartData, pageLength: 25,
		buttons: {
			buttons: [
				//{ extend: 'pdfHtml5', className: 'uk-button uk-button-small red white-text' },
				{
					extend: 'excelHtml5',
					className: 'uk-button uk-button-small green darken-2 white-text uk-margin-small-left'
				},
				{
					extend: 'csvHtml5',
					className: 'uk-button uk-button-small teal white-text uk-margin-small-left'
				}
			]
		},
		columns: [{
				"data": "Date",
				"visible": false
			},
			{
				"data": null,
				"orderable": false,
				"width": "2.5%"
			},
			{
				"title": "Date",
				"width": "12.5%",
				"data": function(data) {
					var localtime = moment.parseZone(data['Date']).local().format('llll');
					return localtime;
				}
			},
			{
				"data": "Author",
				"title": "Author",
				"width": "20%"
			},
			{
				"title": "Video",
				"width": "30%",
				"data": function(data) {
					var title = data["Title"];
					var post = data["Summary"];
					var postrim = post.substring(0, 100) + "...";
					var plink = data["Url"];
					var img = data["Thumbnail"];
					return '<div class="thumb-wrap" data-uk-tooltip="{pos:\'top-left\'}" title="' + postrim + '">' +
						'<a href="' + plink + '" target="_blank" class="thumb-img"><span style="background-image:url(' + img + ');"></span></a>' +
						'<a href="' + plink + '" target="_blank" class="thumb-txt">' + post + '</a>' +
						'</div>';
				}
			},
			{
				"data": "Comments",
				"title": "Comments",
				"class": "uk-text-right",
				"width": "7.5%"
			},
			{
				"data": "view",
				"title": "View",
				"class": "uk-text-right",
				"width": "7.5%"
			},
			{
				"title": "",
				"width": "10%",
				"orderable": false,
				"class": "sentiment uk-text-center",
				"data": "Sentiment",
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
			{
				"title": "Status",
				"orderable": false,
				"width": "10%",
				"class": "uk-text-center",
				"data": function(data) {
					var cellData = data['status'];
					var id = data['id'];
					var btn = '';
					switch (cellData) {
						case 'New':
							btn = '<a uk-tooltip title="Open New Ticket" class="sm-btn-openticket orange-text white uk-badge sm-badge" data-id="' + id + '"><span class="nothover">' + cellData + '</span></a>';
							break;
						case 'Closed':
							btn = '<span class="black-text" title="Responded and closed" uk-tooltip>' + cellData + '</span>';
							break;
						case 'Waiting':
							btn = '<span class="red-text" title="Waiting for a response" uk-tooltip>' + cellData + '</span>';
							break;
						default:

							break;
					}
					//console.log(row);
					return btn;
				}
			}
		],
		order: [
			[0, "desc"]
		],
		initComplete: function() {
			this.api().columns().every(function() {
				var column = this;
				if (column[0][0] == 7) {
					var select = $('<select class="uk-select select-sentiment"><option value="">All Sentiment</option></select>')
						.appendTo($(column.header()).empty())
						.on('change', function() {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
							);
							column
								.search(val ? '^' + val + '$' : '', true, false)
								.draw();
						});

					column.data().unique().sort().each(function(d, j) {
						select.append('<option value="' + d + '">' + d + '</option>')
					});
				}
				if (column[0][0] == 8) {
					var select = $('<select class="uk-select select-status"><option value="">All Status</option></select>')
						.appendTo($(column.header()).empty())
						.on('change', function() {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
							);
							column
								.search(val ? '^' + val + '$' : '', true, false)
								.draw();
						});

					column.data().unique().sort().each(function(d, j) {
						select.append('<option value="' + d + '">' + d + '</option>')
					});
				}
			});
		}
	});
	theTable.on('order.dt search.dt', function() {
		theTable.column(1, {
			search: 'applied',
			order: 'applied'
		}).nodes().each(function(cell, i) {
			cell.innerHTML = i + 1;
		});
	}).draw();
	theTable.columns.adjust().draw();
}
// Table convo Instagram
function tableInstagram(chartId, chartData) {
	var theTable = $('#' + chartId + 'Table').DataTable({
		data: chartData, pageLength: 25,
		buttons: {
			buttons: [
				//{ extend: 'pdfHtml5', className: 'uk-button uk-button-small red white-text' },
				{
					extend: 'excelHtml5',
					className: 'uk-button uk-button-small green darken-2 white-text uk-margin-small-left'
				},
				{
					extend: 'csvHtml5',
					className: 'uk-button uk-button-small teal white-text uk-margin-small-left'
				}
			]
		},
		columns: [{
				"data": "Date",
				"visible": false
			},
			{
				"data": null,
				"orderable": false,
				"width": "2.5%"
			},
			{
				"title": "Date",
				"width": "12.5%",
				"data": function(data) {
					var localtime = moment.parseZone(data['Date']).local().format('llll');
					return localtime;
				}
			},
			{
				"title": "Author",
				"width": "15%",
				"data": function(data) {
					var user = data["Author"];
					return '<a href="https://www.instagram.com/' + user + '" target="_blank" data-uk-tooltip title="' + user + '" class="uk-link">' + user + '</a>';
				}
			},
			{
				"title": "Post",
				"width": "35%",
				"data": function(data) {
					var post = data["Post"];
					var postrim = post.substring(0, 200) + "...";
					var plink = data["Url"];
					return '<a href="' + plink + '" target="_blank" data-uk-tooltip="{pos:\'top-left\'}" title="' + postrim + '">' + postrim + '</a>';
				}
			},
			{
				"data": "Comments",
				"title": "Comments",
				"class": "uk-text-right",
				"width": "7.5%"
			},
			{
				"data": "Likes",
				"title": "Likes",
				"class": "uk-text-right",
				"width": "7.5%"
			},
			{
				"title": "",
				"width": "10%",
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
			{
				"title": "Status",
				"orderable": false,
				"width": "10%",
				"class": "uk-text-center",
				"data": function(data) {
					var cellData = data['status'];
					var id = data['id'];
					var btn = '';
					switch (cellData) {
						case 'New':
							btn = '<a uk-tooltip title="Open New Ticket" class="sm-btn-openticket orange-text white uk-badge sm-badge" data-id="' + id + '"><span class="nothover">' + cellData + '</span></a>';
							break;
						case 'Closed':
							btn = '<span class="black-text" title="Responded and closed" uk-tooltip>' + cellData + '</span>';
							break;
						case 'Waiting':
							btn = '<span class="red-text" title="Waiting for a response" uk-tooltip>' + cellData + '</span>';
							break;
						default:

							break;
					}
					//console.log(row);
					return btn;
				}
			}
		],
		order: [
			[0, "desc"]
		],
		initComplete: function() {
			this.api().columns().every(function() {
				var column = this;
				if (column[0][0] == 7) {
					var select = $('<select class="uk-select select-sentiment"><option value="">All Sentiment</option></select>')
						.appendTo($(column.header()).empty())
						.on('change', function() {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
							);
							column
								.search(val ? '^' + val + '$' : '', true, false)
								.draw();
						});

					column.data().unique().sort().each(function(d, j) {
						select.append('<option value="' + d + '">' + d + '</option>')
					});
				}
				if (column[0][0] == 8) {
					var select = $('<select class="uk-select select-status"><option value="">All Status</option></select>')
						.appendTo($(column.header()).empty())
						.on('change', function() {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
							);
							column
								.search(val ? '^' + val + '$' : '', true, false)
								.draw();
						});

					column.data().unique().sort().each(function(d, j) {
						select.append('<option value="' + d + '">' + d + '</option>')
					});
				}
			});
		}
	});
	theTable.on('order.dt search.dt', function() {
		theTable.column(1, {
			search: 'applied',
			order: 'applied'
		}).nodes().each(function(cell, i) {
			cell.innerHTML = i + 1;
		});
	}).draw();
	theTable.columns.adjust().draw();
}
