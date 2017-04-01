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
			console.log(result);

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
