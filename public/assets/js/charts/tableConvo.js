function tableConvo(chartId, url, chartApiData, idMediaParam = '') {
    // var searchText = $('input[name=searchText]').val();
    // $('.dataTables_filter').find('input[type=search]').val(searchText);
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
        // $.ajax({
        //     url: baseUrl + "/charts/download-convo",
        //     method: "POST",
        //     data: chartApiData
        // }).done(function (downloadLink) {
        //     var btnExcel = '<a class="uk-button uk-button-small green darken-2 white-text uk-margin-top" href="'+downloadLink+'" id="download_excel_'+idMedia+'" target="_blank" title="Export Conversation to Excel" uk-tooltip>EXPORT CONVERSATION</a>';
        //     // $('#'+chartId+'_wrapper').find('div.uk-inline.B').append(btnExcel);
        //     $('div#405').find('.uk-card-body').append(btnExcel);
        // });
        var btnExcel = '<a class="uk-button uk-button-small uk-margin-top green darken-2 white-text" id="download_excel_'+idMedia+'" target="_blank" title="Export Conversation to Excel" uk-tooltip>EXPORT CONVERSATION</a>';
        $('div#405').find('.uk-card-body').append(btnExcel);
        $('#download_excel_'+idMedia).on('click', function(e) {
            e.preventDefault();
            $.ajax({
                url: baseUrl + "/charts/download-convo",
                method: "POST",
                data: chartApiData,
                beforeSend: function (xhr) {
                    $('#download_excel_'+idMedia).text('PLEASE WAIT...');
                }
            }).done(function (downloadLink) {
                $('#download_excel_'+idMedia).text('DOWNLOADED!');
                setTimeout(function() {
                    $('#download_excel_'+idMedia).text('EXPORT CONVERSATION');
                }, 3000);
                window.location = downloadLink;
            });
        });
    }

    // Send Ticket
    sendTicket(chartId,chartApiData,theTable);

    // Edit Sentiment
    var sentimentClass = ".sm-sentiment";
    $('#' + chartId).on('click', sentimentClass, function(e) {
        // console.log(chartApiData);
        e.preventDefault();
        $(this).blur();
        var id = $(this).attr('data-id');
        var idMedia = $(this).attr('data-id-media');
        var date = $(this).attr('data-date');
        var modal = '<form id="changeSentiment" class="change-sentiment" action="' + chartApiData.changeSentimentUrl + '">' +
            '<div class="uk-modal-body">' +
                '<h5>Edit Sentiment</h5>' +
                '<input type="hidden" name="_token" value="'+ chartApiData._token +'">' +
                '<input type="hidden" name="reportType" value="'+ chartApiData.reportType +'">' +
                '<input type="hidden" name="idMedia" value="'+ idMedia +'">' +
                '<input type="hidden" name="projectId" value="'+ chartApiData.projectId +'">' +
                '<input type="hidden" name="id" value="' + id + '" >' +
                '<input type="hidden" name="date" value="' + date + '" >' +
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
                        //uikitModal.hide();
                        UIkit.modal.dialog('<div class="uk-modal-body uk-text-center">Sentiment Updated!</div>');
                        theTable.ajax.reload('',false);
                    } else {
                        alert('A problem has been occured while updating the sentiment.');
                    }
                }
            })
            //console.log( $( this ).serialize() );
        });

    });
}
