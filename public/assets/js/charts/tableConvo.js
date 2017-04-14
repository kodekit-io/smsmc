function tableConvo(chartId, url, chartApiData, idMediaParam = '') {
    if (idMediaParam != '') {
        chartApiData.idMedia = idMediaParam;
    }
    var idMedia = chartApiData.idMedia;

    $('#download_excel').hide();
    $.ajax({
        url: baseUrl + "/charts/download-convo",
        method: "POST",
        data: chartApiData
    }).done(function (downloadLink) {
        $('#download_excel').attr('href', downloadLink);
        $('#download_excel').attr('target', '_blank');
        $('#download_excel').show();
    });

    switch (idMedia) {
        case 1:
            var theTable = tableFacebook(chartId, url, chartApiData);
            break;
        case 2:
            var theTable = tableTwitter(chartId, url, chartApiData);
            break;
        case 3:
            var theTable = tableBlog(chartId, url, chartApiData);
            break;
        case 4:
            var theTable = tableNews(chartId, url, chartApiData);
            break;
        case 5:
            var theTable = tableVideo(chartId, url, chartApiData);
            break;
        case 6:
            var theTable = tableForum(chartId, url, chartApiData);
            break;
        case 7:
            var theTable = tableInstagram(chartId, url, chartApiData);
            break;
    }



    // Send Ticket
    $('#' + chartId).on('click', '.sm-btn-openticket', function(e) {
        e.preventDefault();
        $(this).blur();
        var postId = $(this).attr('data-id');
        var postDate = $(this).attr('data-date');
        var sentiment = $(this).attr('data-sentiment');
        var $ticketTypes = jQuery.parseJSON(chartApiData.ticketTypes);
        var $users = jQuery.parseJSON(chartApiData.users);
        var ticketType = '';
        for (i=0; i < $ticketTypes.length; i++) {
            var theType = $ticketTypes[i];
            ticketType += '<li><label><input class="uk-checkbox" type="checkbox" name="types[]" value="'+ theType.id +'"> '+ theType.name +'</label></li>';
        }
        var $toSelect = '<select id="to_select" name="to[]" class="uk-input" multiple >';
        var $toCcSelect = '<select id="to_cc_select" name="to_cc[]" class="uk-input" multiple >';
        for (i=0; i < $users.length; i++) {
            var theUser = $users[i];
            $toSelect += '<option value="'+ theUser.idLogin +'"> '+ theUser.name +'</option>';
            $toCcSelect += '<option value="'+ theUser.idLogin +'"> '+ theUser.name +'</option>';
        }
        $toSelect += '</select>';
        $toCcSelect += '</select>';

        var modal = '<form class="open-ticket" method="post" id="createticket" action="'+ chartApiData.createTicketUrl +'">' +
            '<input type="hidden" name="_token" value="'+ chartApiData._token +'"> ' +
            '<input type="hidden" name="projectId" value="'+ chartApiData.projectId +'"> ' +
            '<input type="hidden" name="postDate" value="'+ postDate +'"> ' +
            '<input type="hidden" name="idMedia" value="' + chartApiData.idMedia + '" >' +
            '<input type="hidden" name="sentiment" value="' + sentiment + '" >' +
            '<input type="hidden" name="postId" value="' + postId + '">' +
            '<div class="uk-modal-body">' +
                '<h5>Open New Ticket</h5>' +
                '<div class="uk-margin">' +
                    '<label>To</label>' +
                    $toSelect +
                '</div>' +
                '<div class="uk-margin">' +
                    '<label>CC</label>' +
                    $toCcSelect +
                '</div>' +
                '<div class="uk-margin">' +
                    '<div class="uk-inline">' +
                        '<label class="uk-margin-small-right">Ticket Type</label>' +
                        '<ul class="uk-subnav uk-margin-remove-top uk-margin-remove-bottom">' +
                            ticketType +
                        '</ul>' +
                    '</div>' +
                '</div>' +
                '<div class="uk-margin">' +
                    '<textarea class="uk-textarea" rows="3" placeholder="Additional message" name="message"></textarea>' +
                '</div>' +
            '</div>' +
            '<div class="uk-modal-footer uk-clearfix">' +
                '<a class="uk-modal-close uk-button grey white-text">CANCEL</a>' +
                '<button class="uk-button uk-float-right red white-text" type="submit">SUBMIT</button>' +
            '</div>' +
        '</form>';
        var uikitModal = UIkit.modal.dialog(modal);

        $("#to_select").select2();
        $("#to_cc_select").select2();

        $( "#createticket" ).on( "submit", function( event ) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function ($res) {
                    if ($res == '1') {
                        uikitModal.hide();
                    } else {
                        alert('Error when updating the data.');
                    }
                }
            })
        });
    });

    // Edit Sentiment
    $('#' + chartId).on('click', '.sm-sentiment', function(e) {
        e.preventDefault();
        $(this).blur();
        var id = $(this).attr('data-id');
        var postDate = $(this).attr('data-date');
        var modal = '<form id="changeSentiment" class="change-sentiment" action="' + chartApiData.changeSentimentUrl + '">' +
            '<div class="uk-modal-body">' +
            '<h5>Edit Sentiment</h5>' +
            '<input type="hidden" name="_token" value="'+ chartApiData._token +'">' +
            '<input type="hidden" name="reportType" value="'+ chartApiData.reportType +'">' +
            '<input type="hidden" name="idMedia" value="'+ chartApiData.idMedia +'">' +
            '<input type="hidden" name="projectId" value="'+ chartApiData.projectId +'">' +
            '<input type="hidden" name="id" value="' + id + '" >' +
            '<input type="hidden" name="postDate" value="' + postDate + '" >' +
            '<div class="uk-margin">' +
            '<select name="sentiment" class="uk-select">' +
            '<option value="1">Positive</option>' +
            '<option value="0">Neutral</option>' +
            '<option value="-1">Negative</option>' +
            '</select>' +
            '</div>' +
            '</div>' +
            '<div class="uk-modal-footer uk-clearfix">' +
            '<a class="uk-modal-close uk-button grey white-text">CANCEL</a>' +
            '<button class="uk-button uk-float-right red white-text" type="submit">SUBMIT</button>' +
            '</div>' +
            '</form>';
        var uikitModal = UIkit.modal.dialog(modal);

        $( "#changeSentiment" ).on( "submit", function( event ) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function ($res) {
                    if ($res == '1') {
                        uikitModal.hide();
                        theTable.ajax.reload();
                    } else {
                        alert('Error when updating the data.');
                    }
                }
            })
            //console.log( $( this ).serialize() );
        });

    });
}
