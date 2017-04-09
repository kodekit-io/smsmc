function tableInfluencers(domId, url, chartApiData, influencers, name) {
	$.ajax({
		method : 'POST',
		url : url,
        data : chartApiData,
		beforeSend : function(xhr) {
		},
		complete : function(xhr, status) {
		},
		success : function(result) {
            result = jQuery.parseJSON(result);
			var chartId = result.chartId;
            var chartName = result.chartName;
            var chartInfo = result.chartInfo;
            var chartData = result.chartData;
            if (name != null) {
                var chartTitle = name;
            } else {
                var chartTitle = chartName;
            }
			var $item = [];
			if (influencers.length > 0) {
                for(var i = 0; i < influencers.length; i++) {
					$item[i] = '<div>'
						+ '<table id="'+influencers[i]+'" class="uk-table uk-table-condensed uk-table-striped uk-width-1-1 sm-table uk-margin-remove"></table>'
					+ '</div>';
                }
            }
			var card = '<div id="'+chartId+'" class="sm-chart-container uk-animation-fade">'
                + '<div class="uk-card uk-card-hover uk-card-default uk-card-small">'
                    + '<div class="uk-card-header uk-clearfix">'
                        + '<h5 class="uk-card-title uk-float-left">'+chartTitle+'</h5>'
                        + '<ul class="uk-float-right uk-subnav uk-margin-remove">'
                            + '<li><a class="grey-text fa fa-info-circle" title="'+chartInfo+'" uk-tooltip></a></li>'
                            + '<li><a onclick="hideThis(this)" class="grey-text fa fa-eye-slash" title="Hide This" uk-tooltip></a></li>'
                            + '<li><a onclick="fullscreen(this)" class="grey-text fa fa-expand" title="Full Screen" uk-tooltip></a></li>'
                        + '</ul>'
                    + '</div>'
                    + '<div class="uk-card-body">'
						+ '<div class="uk-child-width-1-'+influencers.length+'@m uk-grid-small" uk-grid>'
							+ $item.join('')
		                + '</div>'
                    + '</div>'
                + '</div>'
            + '</div>';
            $('#'+domId).append(card);

            if (influencers.length > 0) {
                for(var i = 0; i < influencers.length; i++) {
                    var $id = influencers[i];
                    window[$id]($id, result);
                }
            }

		}
	});
}

function top10LikeStatus(id,result) {
	$data = result.chartData.top10LikeStatus.data;
	$groupName = result.chartData.top10LikeStatus.groupName;
	$('#' + id).parent('div').prepend('<span class="sm-text-bold">'+$groupName+'</span>');
	//console.log($data);
	if ($data.length === 0) {
		$('#' + id).html('<div class="uk-position-center">No data chart</div>');
	} else {
		var $content = [];
		for (i = 0; i < $data.length; i++) {
			$name= $data[i].name;
			$score= $data[i].score;
			$value= $data[i].value;
			$link= $data[i].link;
			$content[i] = [ $name, $score, $value, $link ];
		}
		//console.log( $content );
		$('#' + id).DataTable( {
			data: $content, pageLength: 10,  dom: 't',
			columns: [
				{ title: "Name" },
				{ title: "Score" },
				//{ title: "Value" },
				//{ title: "Link" },
				{
					data: null,
					render: function ( data ) {
						var postlink = data[3];
						return '<a href="'+postlink+'" target="_blank" data-uk-tooltip title="See Details" class="fa fa-arrow-circle-right"></a>';
					}
				},
			],
			/*columnDefs: [{
				visible: false,
				targets: [3]
			}],*/
			order: [[ 1, "desc" ]]
		});
		$('#' + id + '_wrapper .bottom-row').hide();
	}
}

function top10ByReachTW(id,result) {
	$data = result.chartData.top10ByReach.data;
	$groupName = result.chartData.top10ByReach.groupName;
	$('#' + id).parent('div').prepend('<span class="sm-text-bold">'+$groupName+'</span>');
	//console.log($data);
	if ($data.length === 0) {
		$('#' + id).html('<div class="uk-position-center">No data chart</div>');
	} else {
		var $content = [];
		for (i = 0; i < $data.length; i++) {
			$name= $data[i].name;
			$score= $data[i].score;
			$value= $data[i].value;
			$link= $data[i].link;
			$content[i] = [ $name, $score, $value, $link ];
		}
		//console.log( $content );
		$('#' + id).DataTable( {
			data: $content, pageLength: 10,  dom: 't',
			columns: [
				{ title: "Name" },
				{ title: "Score", "render": $.fn.dataTable.render.number( '\.', '', 0, '' ) },
				//{ title: "Value", "render": $.fn.dataTable.render.number( '\.', '', 0, '' ) },
				//{ title: "Link" },
				{
					data: null,
					render: function ( data ) {
						var postlink = data[3];
						return '<a href="'+postlink+'" target="_blank" data-uk-tooltip title="See Details" class="fa fa-arrow-circle-right"></a>';
					}
				},
			],
			/*columnDefs: [{
				visible: false,
				targets: [3]
			}],*/
			order: [[ 1, "desc" ]]
		});
		// $('#' + id + '_wrapper .bottom-row').hide();
	}
}

function top10ByNumberTW(id,result) {
	$data = result.chartData.top10ByNumber.data;
	$groupName = result.chartData.top10ByNumber.groupName;
	$('#' + id).parent('div').prepend('<span class="sm-text-bold">'+$groupName+'</span>');
	//console.log($data);
	if ($data.length === 0) {
		$('#' + id).html('<div class="uk-position-center">No data chart</div>');
	} else {
		var $content = [];
		for (i = 0; i < $data.length; i++) {
			$name= $data[i].name;
			$score= $data[i].score;
			$value= $data[i].value;
			$link= $data[i].link;
			$content[i] = [ $name, $score, $value, $link ];
		}
		//console.log( $content );
		$('#' + id).DataTable( {
			data: $content, pageLength: 10,  dom: 't',
			columns: [
				{ title: "Name" },
				{ title: "Score", "render": $.fn.dataTable.render.number( '\.', '', 0, '' ) },
				//{ title: "Value", "render": $.fn.dataTable.render.number( '\.', '', 0, '' ) },
				//{ title: "Link" },
				{
					data: null,
					render: function ( data ) {
						var postlink = data[3];
						return '<a href="'+postlink+'" target="_blank" data-uk-tooltip title="See Details" class="fa fa-arrow-circle-right"></a>';
					}
				},
			],
			/*columnDefs: [{
				visible: false,
				targets: [3]
			}],*/
			order: [[ 1, "desc" ]]
		});
		//$('#' + id + '_wrapper .bottom-row').hide();
	}
}

function top10ByImpactTW(id,result) {
	$data = result.chartData.top10ByImpact.data;
	$groupName = result.chartData.top10ByImpact.groupName;
	$('#' + id).parent('div').prepend('<span class="sm-text-bold">'+$groupName+'</span>');
	//console.log($data);
	if ($data.length === 0) {
		$('#' + id).html('<div class="uk-position-center">No data chart</div>');
	} else {
		var $content = [];
		for (i = 0; i < $data.length; i++) {
			$name= $data[i].name;
			$score= $data[i].score;
			$value= $data[i].value;
			$link= $data[i].link;
			$content[i] = [ $name, $score, $value, $link ];
		}
		//console.log( $content );
		$('#' + id).DataTable( {
			data: $content, pageLength: 10,  dom: 't',
			columns: [
				{ title: "Name" },
				{ title: "Score", "render": $.fn.dataTable.render.number( '\.', '', 0, '' ) },
				//{ title: "Value", "render": $.fn.dataTable.render.number( '\.', '', 0, '' ) },
				//{ title: "Link" },
				{
					data: null,
					render: function ( data ) {
						var postlink = data[3];
						return '<a href="'+postlink+'" target="_blank" data-uk-tooltip title="See Details" class="fa fa-arrow-circle-right"></a>';
					}
				},
			],
			/*columnDefs: [{
				visible: false,
				targets: [3]
			}],*/
			order: [[ 1, "desc" ]]
		});
		//$('#' + id + '_wrapper .bottom-row').hide();
	}
}

function top10News(id,result) {
	$data = result.chartData.top10LikeStatus.data;
	$groupName = result.chartData.top10LikeStatus.groupName;
	$('#' + id).parent('div').prepend('<span class="sm-text-bold">'+$groupName+'</span>');
	//console.log($data);
	if ($data.length === 0) {
		$('#' + id).html('<div class="uk-position-center">No data chart</div>');
	} else {
		var $content = [];
		for (i = 0; i < $data.length; i++) {
			$name= $data[i].name;
			$score= $data[i].score;
			$value= $data[i].value;
			$link= $data[i].link;
			$popularity= $data[i].popularity;
			$content[i] = [ $name, $score, $value, $popularity, $link ];
		}
		//console.log( $content );
		$('#' + id).DataTable( {
			data: $content, pageLength: 10,  dom: 't',
			columns: [
				{ title: "Media", },
				{ title: "Rank", "render": $.fn.dataTable.render.number( '\.', '', 0, '' ) },
				//{ title: "Value", "render": $.fn.dataTable.render.number( '\.', '', 0, '' ) },
				{ title: "Popularity", "render": $.fn.dataTable.render.number( '\.', '', 0, '' ) },
				{
					data: null,
					render: function ( data ) {
						var postlink = data[4];
						return '<a href="'+postlink+'" target="_blank" data-uk-tooltip title="See Details" class="fa fa-arrow-circle-right"></a>';
					}
				},
			],
			order: [[ 2, "desc" ]]
		});
		//$('#' + id + '_wrapper .bottom-row').hide();
	}
}

function top10Blog(id,result) {
	$data = result.chartData.top10LikeStatus.data;
	$groupName = result.chartData.top10LikeStatus.groupName;
	$('#' + id).parent('div').prepend('<span class="sm-text-bold">'+$groupName+'</span>');
	//console.log($data);
	if ($data.length === 0) {
		$('#' + id).html('<div class="uk-position-center">No data chart</div>');
	} else {
		var $content = [];
		for (i = 0; i < $data.length; i++) {
			$name= $data[i].name;
			$score= $data[i].score;
			$value= $data[i].value;
			$link= $data[i].link;
			$popularity= $data[i].popularity;
			$content[i] = [ $name, $score, $value, $popularity, $link ];
		}
		//console.log( $content );
		$('#' + id).DataTable( {
			data: $content, pageLength: 10,  dom: 't',
			columns: [
				{ title: "Blog", },
				{ title: "Score", "render": $.fn.dataTable.render.number( '\.', '', 0, '' ) },
				//{ title: "Value", "render": $.fn.dataTable.render.number( '\.', '', 0, '' ) },
				{ title: "Popularity", "render": $.fn.dataTable.render.number( '\.', '', 0, '' ) },
				{
					data: null,
					render: function ( data ) {
						var postlink = data[4];
						return '<a href="'+postlink+'" target="_blank" data-uk-tooltip title="See Details" class="fa fa-arrow-circle-right"></a>';
					}
				},
			],
			order: [[ 1, "desc" ]]
		});
		//$('#' + id + '_wrapper .bottom-row').hide();
	}
}

function topLikeVid(id,result) {
	// console.log(result);
	$data = result.chartData.top10LikeStatus.data;
	$groupName = result.chartData.top10LikeStatus.groupName;
	$('#' + id).parent('div').prepend('<span class="sm-text-bold">'+$groupName+'</span>');

	// console.log($data);
	if ($data.length === 0) {
		$('#' + id).html('<div class="uk-position-center">No data chart</div>');
	} else {
		var $content = [];
		for (i = 0; i < $data.length; i++) {
			$name= $data[i].name;
			$score= $data[i].score;
			$value= $data[i].value;
			$link= $data[i].link;
			//$author= $data[i].author;
			$content[i] = [ $name, $value, $link ];
		}
		//console.log( $content );
		$('#' + id).DataTable( {
			data: $content, pageLength: 10,  dom: 't',
			columns: [
				{ title: "Author" },
				//{ title: "Title" },
				{ title: "Value", "render": $.fn.dataTable.render.number( '\.', '', 0, '' ) },
				{
					data: null,
					render: function ( data ) {
						var postlink = data[3];
						return '<a href="'+postlink+'" target="_blank" data-uk-tooltip title="See Details" class="uk-button uk-button-small">See Video</a>';
					}
				},
			],
			order: [[ 0, "desc" ]]
		});
		$('#' + id + '_wrapper .bottom-row').hide();
	}
}
function topRateVid(id,result) {
	$data = result.chartData.video_rating.data;
	$groupName = result.chartData.video_rating.groupName;
	$('#' + id).parent('div').prepend('<span class="sm-text-bold">'+$groupName+'</span>');
	//console.log($data);
	if ($data.length === 0) {
		$('#' + id).html('<div class="uk-position-center">No data chart</div>');
	} else {
		var $content = [];
		for (i = 0; i < $data.length; i++) {
			$name= $data[i].name;
			$score= $data[i].score;
			$value= $data[i].value;
			$link= $data[i].link;
			//$author= $data[i].author;
			$content[i] = [ $name, $value, $link ];
		}
		//console.log( $content );
		$('#' + id).DataTable( {
			data: $content, pageLength: 10,  dom: 't',
			columns: [
				{ title: "Author" },
				//{ title: "Title" },
				{ title: "Value", "render": $.fn.dataTable.render.number( '\.', '', 0, '' ) },
				{
					data: null,
					render: function ( data ) {
						var postlink = data[3];
						return '<a href="'+postlink+'" target="_blank" data-uk-tooltip title="See Details" class="uk-button uk-button-small">See Video</a>';
					}
				},
			],
			order: [[ 0, "desc" ]]
		});
		$('#' + id + '_wrapper .bottom-row').hide();
	}
}

function top10Forum(id,result) {
	$data = result.chartData.top10LikeStatus.data;
	$groupName = result.chartData.top10LikeStatus.groupName;
	$('#' + id).parent('div').prepend('<span class="sm-text-bold">'+$groupName+'</span>');
	//console.log($data);
	if ($data.length === 0) {
		$('#' + id).html('<div class="uk-position-center">No data chart</div>');
	} else {
		var $content = [];
		for (i = 0; i < $data.length; i++) {
			$name= $data[i].name;
			$score= $data[i].score;
			$value= $data[i].value;
			$link= $data[i].link;
			$popularity= $data[i].popularity;
			$content[i] = [ $name, $score, $value, $popularity, $link ];
		}
		//console.log( $content );
		$('#' + id).DataTable( {
			data: $content, pageLength: 10,  dom: 't',
			columns: [
				{ title: "Forum", },
				{ title: "Score", "render": $.fn.dataTable.render.number( '\.', '', 0, '' ) },
				//{ title: "Value", "render": $.fn.dataTable.render.number( '\.', '', 0, '' ) },
				{ title: "Popularity", "render": $.fn.dataTable.render.number( '\.', '', 0, '' ) },
				{
					data: null,
					render: function ( data ) {
						var postlink = data[4];
						return '<a href="'+postlink+'" target="_blank" data-uk-tooltip title="See Details" class="fa fa-arrow-circle-right"></a>';
					}
				},
			],
			order: [[ 1, "desc" ]]
		});
		//$('#' + id + '_wrapper .bottom-row').hide();
	}
}

function topCommentIG(id,result) {
	$data = result.chartData['top Comment'].data;
	$groupName = result.chartData['top Comment'].groupName;
	$('#' + id).parent('div').prepend('<span class="sm-text-bold">'+$groupName+'</span>');
	if ($data.length === 0) {
		$('#' + id).html('<div class="uk-position-center">No data chart</div>');
	} else {
		var $content = [];
		for (i = 0; i < $data.length; i++) {
			$name= $data[i].name;
			$score= $data[i].score;
			$value= $data[i].value;
			$link= $data[i].link;
			$content[i] = [ $name, $value, $link ];
		}
		//console.log( $content );
		$('#' + id).DataTable( {
			data: $content, pageLength: 10,  dom: 't',
			columns: [
				{ title: "Name" },
				{ title: "Value", "render": $.fn.dataTable.render.number( '\.', '', 0, '' ) },
				{
					data: null,
					render: function ( data ) {
						var postlink = data[2];
						return '<a href="'+postlink+'" target="_blank" data-uk-tooltip title="See Details" class="fa fa-arrow-circle-right"></a>';
					}
				},
			],
			order: [[ 0, "desc" ]]
		});
		$('#' + id + '_wrapper .bottom-row').hide();
	}
}
function topLoveIG(id,result) {
	$data = result.chartData['top Love'].data;
	$groupName = result.chartData['top Love'].groupName;
	$('#' + id).parent('div').prepend('<span class="sm-text-bold">'+$groupName+'</span>');
	if ($data.length === 0) {
		$('#' + id).html('<div class="uk-position-center">No data chart</div>');
	} else {
		var $content = [];
		for (i = 0; i < $data.length; i++) {
			$name= $data[i].name;
			$score= $data[i].score;
			$value= $data[i].value;
			$link= $data[i].link;
			$content[i] = [ $name, $value, $link ];
		}
		//console.log( $content );
		$('#' + id).DataTable( {
			data: $content, pageLength: 10,  dom: 't',
			columns: [
				{ title: "Name" },
				{ title: "Value", "render": $.fn.dataTable.render.number( '\.', '', 0, '' ) },
				{
					data: null,
					render: function ( data ) {
						var postlink = data[2];
						return '<a href="'+postlink+'" target="_blank" data-uk-tooltip title="See Details" class="fa fa-arrow-circle-right"></a>';
					}
				},
			],
			order: [[ 0, "desc" ]]
		});
		$('#' + id + '_wrapper .bottom-row').hide();
	}
}
function topViewIG(id,result) {
	$data = result.chartData['top View'].data;
	$groupName = result.chartData['top View'].groupName;
	$('#' + id).parent('div').prepend('<span class="sm-text-bold">'+$groupName+'</span>');
	if ($data.length === 0) {
		$('#' + id).html('<div class="uk-position-center">No data chart</div>');
	} else {
		var $content = [];
		for (i = 0; i < $data.length; i++) {
			$name= $data[i].name;
			$score= $data[i].score;
			$value= $data[i].value;
			$link= $data[i].link;
			$content[i] = [ $name, $value, $link ];
		}
		//console.log( $content );
		$('#' + id).DataTable( {
			data: $content, pageLength: 10,  dom: 't',
			columns: [
				{ title: "Name" },
				{ title: "Value", "render": $.fn.dataTable.render.number( '\.', '', 0, '' ) },
				{
					data: null,
					render: function ( data ) {
						var postlink = data[2];
						return '<a href="'+postlink+'" target="_blank" data-uk-tooltip title="See Details" class="fa fa-arrow-circle-right"></a>';
					}
				},
			],
			order: [[ 0, "desc" ]]
		});
		$('#' + id + '_wrapper .bottom-row').hide();
	}
}

function topStatusFB(id,result) {
	$data = result.chartData.status.data;
	$share = result.chartData.status.data.share;
	$comment = result.chartData.status.data.comment;
	$like = result.chartData.status.data.like;
	$groupName = result.chartData.status.groupName;
	$('#' + id).parent('div').prepend('<span class="sm-text-bold">'+$groupName+'</span>');
	if ($data.length === 0) {
		$('#' + id).html('<div class="uk-position-center">No data chart</div>');
	} else {
		var $content = [];
		for (i = 0; i < $share.length; i++) {
			$shareName= $share[i].name;
			$shareValue= $share[i].value;
			$shareScore= $share[i].score;
			$shareLink= $share[i].link;

			$commentName= $comment[i].name;
			$commentValue= $comment[i].value;
			$commentScore= $comment[i].score;
			$commentLink= $comment[i].link;

			$likeName= $like[i].name;
			$likeValue= $like[i].value;
			$likeScore= $like[i].score;
			$likeLink= $like[i].link;

			$content[i] = [ $commentName, $commentValue, $likeValue, $shareValue, $shareLink ]

		}

		$('#' + id).DataTable( {
			data: $content, pageLength: 10,  dom: 't',
			columns: [
				{ title: "Name" },
				{ title: "<span class='fa fa- fa-comment' title='Comment' uk-tooltip></span>", "render": $.fn.dataTable.render.number( '\.', '', 0, '' ) },
				{ title: "<span class='fa fa- fa-thumbs-up' title='Like' uk-tooltip></span>", "render": $.fn.dataTable.render.number( '\.', '', 0, '' ) },
				{ title: "<span class='fa fa- fa-share' title='Share' uk-tooltip></span>", "render": $.fn.dataTable.render.number( '\.', '', 0, '' ) },
				{
					data: null,
					render: function ( data ) {
						var postlink = data[4];
						return '<a href="'+postlink+'" target="_blank" data-uk-tooltip title="See Details" class="fa fa-arrow-circle-right"></a>';
					}
				},
			],
			order: [[ 2, "desc" ]]
		});
	}
}

function topLinkFB(id,result) {
	$data = result.chartData.link.data;
	$share = result.chartData.link.data.share;
	$comment = result.chartData.link.data.comment;
	$like = result.chartData.link.data.like;
	$groupName = result.chartData.link.groupName;
	$('#' + id).parent('div').prepend('<span class="sm-text-bold">'+$groupName+'</span>');
	//console.log($data);
	if ($data.length === 0) {
		$('#' + id).html('<div class="uk-position-center">No data chart</div>');
	} else {
		var $content = [];
		for (i = 0; i < $share.length; i++) {
			$shareName= $share[i].name;
			$shareValue= $share[i].value;
			$shareScore= $share[i].score;
			$shareLink= $share[i].link;

			$commentName= $comment[i].name;
			$commentValue= $comment[i].value;
			$commentScore= $comment[i].score;
			$commentLink= $comment[i].link;

			$likeName= $like[i].name;
			$likeValue= $like[i].value;
			$likeScore= $like[i].score;
			$likeLink= $like[i].link;

			$content[i] = [ $commentName, $commentValue, $likeValue, $shareValue, $shareLink ]

		}

		$('#' + id).DataTable( {
			data: $content, pageLength: 10,  dom: 't',
			columns: [
				{ title: "Name" },
				{ title: "<span class='fa fa- fa-comment' title='Comment' uk-tooltip></span>", "render": $.fn.dataTable.render.number( '\.', '', 0, '' ) },
				{ title: "<span class='fa fa- fa-thumbs-up' title='Like' uk-tooltip></span>", "render": $.fn.dataTable.render.number( '\.', '', 0, '' ) },
				{ title: "<span class='fa fa- fa-share' title='Share' uk-tooltip></span>", "render": $.fn.dataTable.render.number( '\.', '', 0, '' ) },
				{
					data: null,
					render: function ( data ) {
						var postlink = data[4];
						return '<a href="'+postlink+'" target="_blank" data-uk-tooltip title="See Details" class="fa fa-arrow-circle-right"></a>';
					}
				},
			],
			order: [[ 2, "desc" ]]
		});
	}
}

function topPhotoFB(id,result) {
	$data = result.chartData.photo.data;
	$share = result.chartData.photo.data.share;
	$comment = result.chartData.photo.data.comment;
	$like = result.chartData.photo.data.like;
	$groupName = result.chartData.photo.groupName;
	$('#' + id).parent('div').prepend('<span class="sm-text-bold">'+$groupName+'</span>');

	if ($data.length === 0) {
		$('#' + id).html('<div class="uk-position-center">No data chart</div>');
	} else {
		var $content = [];
		for (i = 0; i < $share.length; i++) {
			$shareName= $share[i].name;
			$shareValue= $share[i].value;
			$shareScore= $share[i].score;
			$shareLink= $share[i].link;

			$commentName= $comment[i].name;
			$commentValue= $comment[i].value;
			$commentScore= $comment[i].score;
			$commentLink= $comment[i].link;

			$likeName= $like[i].name;
			$likeValue= $like[i].value;
			$likeScore= $like[i].score;
			$likeLink= $like[i].link;

			$content[i] = [ $commentName, $commentValue, $likeValue, $shareValue, $shareLink ]

		}

		$('#' + id).DataTable( {
			data: $content, pageLength: 10,  dom: 't',
			columns: [
				{ title: "Name" },
				{ title: "<span class='fa fa- fa-comment' title='Comment' uk-tooltip></span>", "render": $.fn.dataTable.render.number( '\.', '', 0, '' ) },
				{ title: "<span class='fa fa- fa-thumbs-up' title='Like' uk-tooltip></span>", "render": $.fn.dataTable.render.number( '\.', '', 0, '' ) },
				{ title: "<span class='fa fa- fa-share' title='Share' uk-tooltip></span>", "render": $.fn.dataTable.render.number( '\.', '', 0, '' ) },
				{
					data: null,
					render: function ( data ) {
						var postlink = data[4];
						return '<a href="'+postlink+'" target="_blank" data-uk-tooltip title="See Details" class="fa fa-arrow-circle-right"></a>';
					}
				},
			],
			order: [[ 2, "desc" ]]
		});
	}
}

function topVideoFB(id,result) {
	$data = result.chartData.video.data;
	$share = result.chartData.video.data.share;
	$comment = result.chartData.video.data.comment;
	$like = result.chartData.video.data.like;
	$groupName = result.chartData.video.groupName;
	$('#' + id).parent('div').prepend('<span class="sm-text-bold">'+$groupName+'</span>');

	if ($data.length === 0) {
		$('#' + id).html('<div class="uk-position-center">No data chart</div>');
	} else {
		var $content = [];
		for (i = 0; i < $share.length; i++) {
			$shareName= $share[i].name;
			$shareValue= $share[i].value;
			$shareScore= $share[i].score;
			$shareLink= $share[i].link;

			$commentName= $comment[i].name;
			$commentValue= $comment[i].value;
			$commentScore= $comment[i].score;
			$commentLink= $comment[i].link;

			$likeName= $like[i].name;
			$likeValue= $like[i].value;
			$likeScore= $like[i].score;
			$likeLink= $like[i].link;

			$content[i] = [ $commentName, $commentValue, $likeValue, $shareValue, $shareLink ]

		}

		$('#' + id).DataTable( {
			data: $content, pageLength: 10,  dom: 't',
			columns: [
				{ title: "Name" },
				{ title: "<span class='fa fa- fa-comment' title='Comment' uk-tooltip></span>", "render": $.fn.dataTable.render.number( '\.', '', 0, '' ) },
				{ title: "<span class='fa fa- fa-thumbs-up' title='Like' uk-tooltip></span>", "render": $.fn.dataTable.render.number( '\.', '', 0, '' ) },
				{ title: "<span class='fa fa- fa-share' title='Share' uk-tooltip></span>", "render": $.fn.dataTable.render.number( '\.', '', 0, '' ) },
				{
					data: null,
					render: function ( data ) {
						var postlink = data[4];
						return '<a href="'+postlink+'" target="_blank" data-uk-tooltip title="See Details" class="fa fa-arrow-circle-right"></a>';
					}
				},
			],
			order: [[ 2, "desc" ]]
		});
	}
}
