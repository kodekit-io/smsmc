function notifications(div) {
    var card = '<div class="uk-animation-fade uk-card uk-card-hover uk-card-default uk-card-small"> \
        <div class="uk-card-header"> \
            <h5 class="uk-card-title">Your Notifications</h5> \
        </div> \
        <div class="uk-card-body"> \
            <table id="notifications" class="uk-table uk-table-hover sm-table uk-margin-remove"></table> \
        </div> \
    </div>';
    $('#'+div).append(card);

    var url = baseUrl + '/get-notification';
    $.ajax({
        url: url,
        success: function(result){
            console.log(result);
            var theTable = $('#notifications').DataTable( {
                ajax: {
                    url: url,
                    dataSrc: 'detail'
                },
                paging: true,
                pageLength: 25,
                searching: false,
                info: false,
                processing: true,
                dom: "<'sm-timeline-wrap't><'uk-grid uk-grid-collapse sm-timeline-foot'<'uk-width-1-2'l><'uk-width-1-2'p>>",
                language: {
                    "lengthMenu": "Show _MENU_",
                    "emptyTable": "Loading..."
                },
                columns: [
                    { data: "date", visible : false },
                    {
                        width: "100%",
                        data: function(data) {
                            var tanggal = moment(data['date']);
                            var ago = tanggal.fromNow();
                            var id = data['ticketId'];
                            var msg = data['message'];
                            // if (msg != '' || msg != null) {
                            //     msg = 'with message: ' + data['message'];
                            // }
                            var icon = '<span class="fa fa-lg fa-ticket red-text"></span>';

                            var notif = '<div class="uk-animation-slide-left-small uk-grid-small" uk-grid>'
                                + '<div class="uk-width-auto@s">'+icon+'</div>'
                                + '<div class="uk-width-expand@s">'
                                    + '<div class="sm-text-bold uk-margin-remove">"'+msg+'"</div>'
                                    + '<i class="fa fa-clock-o"></i> ' + ago
                                + '</div>'
                                + '<div class="uk-width-auto@s">'
                                    + '<a class="uk-button uk-button-text uk-margin-left" href="' + baseUrl + '/ticket/' +id + '/detail">'
                                        + 'See details <i class="fa fa-arrow-right"></i>'
                                    + '</a>'
                                + '</div>'
                            + '</div>';

                            return notif;
                        }
                    }
                ],
                order: [[ 0, "desc" ]]
            });
            theTable.columns.adjust().draw();
        }
    });
}
