function reportView(div) {
    var card = '<div class="uk-animation-fade uk-card uk-card-hover uk-card-default uk-card-small"> \
        <div class="uk-card-header uk-clearfix"> \
            <h5 class="uk-card-title uk-float-left">Report List</h5> \
        </div> \
        <div class="uk-card-body"> \
            <table id="reportTable" class="uk-table uk-table-condensed uk-table-striped uk-width-1-1 sm-table"></table> \
        </div> \
    </div>';
    $('#'+div).append(card);

    var theTable = $('#reportTable').DataTable( {
        ajax: {
            "url": "json/reportlist.json",
        },
        columns: [
            { "data": null, "width": "2.5%" },
            {
                "data": null,"title": "Report Created","width": "12.5%",
                "render": function ( data ) {
                    var date = data["reportDate"];
                    var now = new Date();
                    var offset = now.getTimezoneOffset() / 60;
                    var newdate = new Date(date);
                    var timezoneDif = offset * 60 + newdate.getTimezoneOffset();
                    var localtime = newdate;
                    return localtime;
                }
            },
            { "data": "reportName", "title": "Title", "width": "17.5%" },
            { "data": "reportDesc", "title": "Descriptions", "width": "25%" },
            {
                "data": null,"title": "Start Report","width": "12.5%",
                "render": function ( data ) {
                    var date = data["startDate"];
                    var now = new Date();
                    var offset = now.getTimezoneOffset() / 60;
                    var newdate = new Date(date);
                    var timezoneDif = offset * 60 + newdate.getTimezoneOffset();
                    var localtime = newdate;
                    return localtime;
                }
            },
            {
                "data": null,"title": "End Report","width": "12.5%",
                "render": function ( data ) {
                    var date = data["endDate"];
                    var now = new Date();
                    var offset = now.getTimezoneOffset() / 60;
                    var newdate = new Date(date);
                    var timezoneDif = offset * 60 + newdate.getTimezoneOffset();
                    var localtime = newdate;
                    return localtime;
                }
            },
            {
                "data": "reportLink", "orderable": false, "width": "17.5%", "class": "uk-text-right",
                "render": function ( cellData ) {
                    var link = cellData;
                    var del = ""
                    var btn = "";
                    if (link != "") {
                        btn = '<a href="'+link+'" class="uk-button uk-button-small uk-button-default" title="Download Report" uk-tooltip><i class="fa fa-download fa-fw"></i> Download</a>'
                    } else {

                    }
                    return btn;
                }
            },
        ],
        order: [[ 1, "desc" ]]
    });
    theTable.on( 'order.dt search.dt', function () {
        theTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
    theTable.columns.adjust().draw();
}