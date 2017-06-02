// Table convo Facebook
function tableFacebook(chartId, url, chartApiData, idMedia) {
    // console.log(chartApiData);
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
		columns: [
			{
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
				"width": "25%",
				"data": function(data) {
					var post = data["Post"];
					var plink = data["Link"];
					if(post.length>100) {
						var thepost = post.substring(0, 100) + "...";
					} else {
						var thepost = post;
					}
					return '<div class="uk-text-break">'+thepost+' <a href="'+plink+'" target="_blank" uk-tooltip title="'+post+'" class="uk-margin-small-left black-text"> more <i class="fa fa-external-link-square"></i></a></div>';
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
				"width": "2.5%",
				"render": $.fn.dataTable.render.number( '\.', '', 0, '' )
			},
			{
				"data": "Likes",
				"title": "<span class='fa fa- fa-thumbs-up' title='Like' uk-tooltip></span>",
				"class": "uk-text-right",
				"width": "2.5%",
				"render": $.fn.dataTable.render.number( '\.', '', 0, '' )
			},
			{
				"data": "Shares",
				"title": "<span class='fa fa- fa-share' title='Share' uk-tooltip></span>",
				"class": "uk-text-right",
				"width": "2.5%",
				"render": $.fn.dataTable.render.number( '\.', '', 0, '' )
			},
			{
				"title": "",
				"width": "10%",
				"orderable": false,
				"class": "sentiment uk-text-center",
				"data": "Sentiment",
				"createdCell": function(td, cellData, rowData, row, col) {
					var id = rowData['id'];
                    $(td).attr('data-id', id);
                    $(td).attr('data-id-media', idMedia);
                    $(td).attr('data-date', rowData['Date']);
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
						case 'New':
							btn = '<a uk-tooltip title="Open New Ticket" class="sm-btn-openticket orange-text white uk-badge sm-badge" data-id="' + id + '" data-id-media="'+idMedia+'" data-post-date="'+data['Date']+'" data-sentiment="'+data['Sentiment']+'"><span class="nothover">' + cellData + '</span></a>';
							break;
						case 'open':
						case 'Open':
							btn = '<span class="red-text" title="Waiting for a response" uk-tooltip>' + cellData + '</span>';
							break;
						default:
							btn = '<span class="" title="' + cellData + '" uk-tooltip>' + cellData + '</span>';
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
                            var thisVal = $(this).val();
                            var search = '{"sentiment":"'+thisVal+'", "idMedia": "'+idMedia+'"}';
							column
								.search(search)
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
