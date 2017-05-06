// Table convo Forum
function tableForum(chartId, url, chartApiData, idMedia) {
	var theTable = $('#' + chartId).DataTable({
		processing: true,
        serverSide: true,
        ajax: {
		    url: url,
            type: "POST",
            data: chartApiData,
            complete: function(data) {
		        if (data.responseJSON.draw == 1) {
		            var title = data.responseJSON.chartName;
		            var info = data.responseJSON.chartInfo;
					$('.convo-title').html(title);
                    $('.convo-info').attr('title', info);
                }
            }
        },
        pageLength: 25,
		// buttons: {
		// 	buttons: [
		// 		{
		// 			extend: 'excelHtml5',
		// 			className: 'uk-button uk-button-small green darken-2 white-text uk-margin-small-left'
		// 		},
		// 		{
		// 			extend: 'csvHtml5',
		// 			className: 'uk-button uk-button-small teal white-text uk-margin-small-left'
		// 		}
		// 	]
		// },
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
				"width": "15%"
			},
			{
				"title": "Post",
				"width": "25%",
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
                    $(td).attr('data-id', id);
                    $(td).attr('data-id-media', idMedia);
					// console.log(id);
					switch (cellData) {
						case 'positive':
							$(td).addClass('sm-sentiment green-text');
							break;
						case 'neutral':
							$(td).addClass('sm-sentiment grey-text');
							break;
						case 'negative':
							$(td).addClass('sm-sentiment red-text');
							break;
					}
				}
			},
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
							btn = '<a uk-tooltip title="Open New Ticket" class="sm-btn-openticket orange-text white uk-badge sm-badge" data-id="' + id + '" data-id-media="'+idMedia+'" data-post-date="'+data['Date']+'" data-sentiment="'+data['Sentiment']+'"><span class="nothover">' + cellData + '</span></a>';
							break;
						case 'closed':
							btn = '<span class="black-text" title="Responded and closed" uk-tooltip>' + cellData + '</span>';
							break;
						case 'waiting':
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
								.search($(this).val())
								.draw();
						});

					column.data().unique().sort().each(function(d, j) {
						select.append('<option value="' + d + '">' + d + '</option>')
					});
				}
			});
		}
	});
	theTable.on('order.dt search.dt draw.dt', function() {
        var info = theTable.page.info();
		theTable.column(1, {
			search: 'applied',
			order: 'applied'
		}).nodes().each(function(cell, i) {
			cell.innerHTML = info.start + i + 1;
		});
	}).draw();
	$('.uk-switcher').on('show.uk.switcher', function(){
		$(window).trigger('resize');
		theTable.columns.adjust().draw();
	});
	return theTable;
}
