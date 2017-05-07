function tableConvo(chartId, url, chartApiData, idMediaParam = '') {
    var idMedia = chartApiData.idMedia;
    if (idMediaParam != '') {
        idMedia = idMediaParam;
        var apiData = {
            'idMediaInAll': idMediaParam
        };
        $.extend( apiData, chartApiData );
    } else {
        apiData = chartApiData;
    }

    switch (idMedia) {
        case 1:
            var theTable = tableFacebook(chartId, url, apiData, idMedia);
            break;
        case 2:
            var theTable = tableTwitter(chartId, url, apiData, idMedia);
            break;
        case 3:
            var theTable = tableBlog(chartId, url, apiData, idMedia);
            break;
        case 4:
            var theTable = tableNews(chartId, url, apiData, idMedia);
            break;
        case 5:
            var theTable = tableVideo(chartId, url, apiData, idMedia);
            break;
        case 6:
            var theTable = tableForum(chartId, url, apiData, idMedia);
            break;
        case 7:
            var theTable = tableInstagram(chartId, url, apiData, idMedia);
            break;
        case 9:
            var theTable = tableNews(chartId, url, apiData, idMedia);
            break;
    }

    if (idMediaParam == '') {
        $.ajax({
            url: baseUrl + "/charts/download-convo",
            method: "POST",
            data: chartApiData
        }).done(function (downloadLink) {
            var btnExcel = '<a class="uk-button uk-button-small green darken-2 white-text uk-margin-top" href="'+downloadLink+'" id="download_excel_'+idMedia+'" target="_blank" title="Export Conversation to Excel" uk-tooltip>EXPORT CONVERSATION</a>';
            // $('#'+chartId+'_wrapper').find('div.uk-inline.B').append(btnExcel);
            $('div#405').find('.uk-card-body').append(btnExcel);
        });
    }

    // Send Ticket
    $('#' + chartId).on('click', '.sm-btn-openticket', function(e) {
        e.preventDefault();
        $(this).blur();
        var postId = $(this).attr('data-id');
        var postDate = $(this).attr('data-post-date');
        var sentiment = $(this).attr('data-sentiment');
        var idMedia = $(this).attr('data-id-media');
        var $ticketTypes = jQuery.parseJSON(chartApiData.ticketTypes);
        var $users = jQuery.parseJSON(chartApiData.users);
        var ticketType = '';
        for (i=0; i < $ticketTypes.length; i++) {
            var theType = $ticketTypes[i];
            ticketType += '<li><label><input class="uk-checkbox" type="checkbox" name="types[]" value="'+ theType.id +'"> '+ theType.name +'</label></li>';
        }
        var $toSelect = '<select id="to_select" name="to[]" class="uk-input" multiple >';
        // var $toCcSelect = '<select id="to_cc_select" name="to_cc[]" class="uk-input" multiple >';
        for (i=0; i < $users.length; i++) {
            var theUser = $users[i];
            $toSelect += '<option value="'+ theUser.idLogin +'"> '+ theUser.name +'</option>';
            // $toCcSelect += '<option value="'+ theUser.idLogin +'"> '+ theUser.name +'</option>';
        }
        $toSelect += '</select>';
        // $toCcSelect += '</select>';

        var modal = '<form class="open-ticket uk-form-horizontal" method="post" id="createticket" action="'+ chartApiData.createTicketUrl +'">' +
            '<input type="hidden" name="_token" value="'+ chartApiData._token +'"> ' +
            '<input type="hidden" name="projectId" value="'+ chartApiData.projectId +'"> ' +
            '<input type="hidden" name="idMedia" value="'+ idMedia +'" >' +
            '<input type="hidden" name="postDate" value="'+ postDate +'"> ' +
            '<input type="hidden" name="sentiment" value="'+ sentiment +'" >' +
            '<input type="hidden" name="postId" value="'+ postId +'">' +
            '<div  class="uk-modal-body">' +
                '<h5>Open New Ticket</h5>' +
                '<div class="uk-margin">' +
                    '<label class="uk-form-label" for="to_select">Send to</label>' +
                    '<div class="uk-form-controls">' +
                        $toSelect +
                    '</div>' +
                '</div>' +
                '<div class="uk-margin">' +
                    '<label class="uk-form-label">Ticket Type</label>' +
                    '<div class="uk-form-controls" style="padding-top:7px;">' +
                        '<ul class="uk-subnav">' +
                            ticketType +
                        '</ul>' +
                    '</div>' +
                '</div>' +
                '<div class="uk-margin">' +
                    '<label class="uk-form-label" for="message">Message</label>' +
                    '<div class="uk-form-controls">' +
                        '<textarea class="uk-textarea" rows="3" placeholder="Additional message" name="message"></textarea>' +
                    '</div>' +
                '</div>' +
                '<div class="uk-margin uk-flex uk-flex-right">' +
                    '<a class="uk-modal-close uk-button grey white-text uk-margin-small-right">CANCEL</a>' +
                    '<button class="uk-button uk-float-right red white-text" type="submit">SUBMIT</button>' +
                '</div>' +
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
    var sentimentClass = ".sm-sentiment";
    $('#' + chartId).on('click', sentimentClass, function(e) {
        // console.log(chartApiData);
        e.preventDefault();
        $(this).blur();
        var id = $(this).attr('data-id');
        var idMedia = $(this).attr('data-id-media');
        var modal = '<form id="changeSentiment" class="change-sentiment" action="' + chartApiData.changeSentimentUrl + '">' +
            '<div class="uk-modal-body">' +
                '<h5>Edit Sentiment</h5>' +
                '<input type="hidden" name="_token" value="'+ chartApiData._token +'">' +
                '<input type="hidden" name="reportType" value="'+ chartApiData.reportType +'">' +
                '<input type="hidden" name="idMedia" value="'+ idMedia +'">' +
                '<input type="hidden" name="projectId" value="'+ chartApiData.projectId +'">' +
                '<input type="hidden" name="id" value="' + id + '" >' +
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
