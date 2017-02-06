function convoSample(div,domId,judul) {
    var card = '<div id="'+domId+'" class="sm-chart-container uk-animation-fade"> \
        <div class="uk-card uk-card-hover uk-card-default uk-card-small"> \
            <div class="uk-card-header uk-clearfix"> \
                <h5 class="uk-card-title uk-float-left">'+judul+'</h5> \
                <ul class="uk-float-right uk-subnav uk-margin-remove"> \
                    <li><a class="grey-text fa fa-info-circle" title="Short text information about '+judul+'" uk-tooltip></a></li> \
                    <li><a onclick="hideThis(this)" class="grey-text fa fa-eye-slash" title="Hide This" uk-tooltip></a></li> \
                    <li><a onclick="fullscreen(this)" class="grey-text fa fa-expand" title="Full Screen" uk-tooltip></a></li> \
                </ul> \
            </div> \
            <div class="uk-card-body"> \
                <table id="'+domId+'Table" class="uk-table uk-table-condensed uk-table-striped uk-width-1-1 sm-table"></table> \
                <div id="openTicket" uk-modal> \
                    <div class="uk-modal-dialog"> \
                        <div class="uk-modal-body"> \
                            <h5>Open New Ticket</h5> \
                            <form> \
                                <fieldset class="uk-fieldset"> \
                                    <div class="uk-margin"> \
                                        <select class="uk-select"> \
                                            <option>Send to All</option> \
                                            <option>User 1</option><option>User 2</option><option>User 3</option> \
                                        </select> \
                                    </div> \
                                    <div class="uk-margin"> \
                                        <textarea class="uk-textarea" rows="3" placeholder="Additional message"></textarea> \
                                    </div> \
                                </fieldset> \
                            </form> \
                        </div> \
                        <div class="uk-modal-footer uk-clearfix"> \
                            <a class="uk-modal-close uk-button grey white-text">CANCEL</a> \
                            <a class="uk-modal-close uk-button uk-float-right red white-text">SEND</a> \
                        </div> \
                    </div> \
                </div> \
            </div> \
        </div> \
    </div>';
    $('#'+div).append(card);

    var theTable = $('#'+domId+'Table').DataTable( {
        ajax: {
            "url": "json/convo-sample.json",
            //"data" : data
        },
        buttons: {
            buttons: [
                //{ extend: 'pdfHtml5', className: 'uk-button uk-button-small red white-text' },
                { extend: 'excelHtml5', className: 'uk-button uk-button-small green darken-2 white-text uk-margin-small-left' },
                { extend: 'csvHtml5', className: 'uk-button uk-button-small teal white-text uk-margin-small-left' }
            ]
        },
        columns: [
            { "data": null,"orderable": false,"width": "2.5%" },
            {
                "data": null,"title": "Date","width": "12.5%",
                "render": function ( data ) {
                    var date = data["Date"];
                    var now = new Date();
                    var offset = now.getTimezoneOffset() / 60;
                    var newdate = new Date(date);
                    var timezoneDif = offset * 60 + newdate.getTimezoneOffset();
                    var localtime = new Date(newdate.getTime() + timezoneDif * 60 * 1000);
                    return localtime;
                }
            },
            {
                "data": null, "title": "Channel", "width": "5%", "class": "uk-text-center",
                "render": function ( data ) {
                    var channel = data["Media Type"];
                    var icon = "";
                    var ifb = "<span class='uk-icon-button blue darken-4 white-text'><i class='fa fa-facebook'></i> <span class='uk-hidden'>facebook</span></span>";
                    var itw = "<span class='uk-icon-button blue accent-1 white-text'><i class='fa fa-twitter'></i> <span class='uk-hidden'>twitter</span></span>";
                    var iyt = "<span class='uk-icon-button red white-text'><i class='fa fa-youtube'></i> <span class='uk-hidden'>youtube</span></span>";
                    var iig = "<span class='uk-icon-button pink darken-4 white-text'><i class='fa fa-instagram'></i> <span class='uk-hidden'>instagram</span></span>";
                    switch (channel) {
                        case 'facebook':
                            icon = ifb;
                            break;
                        case 'twitter':
                            icon = itw;
                            break;
                        case 'youtube':
                            icon = iyt;
                            break;
                        case 'instagram':
                            icon = iig;
                            break;
                    }
                    return icon;
                }
            },
            { "data": "Author", "title": "Author", "width": "15%" },
            {
                "data": null, "title": "Post", "width": "40%",
                "render": function ( data ) {
                    var post = data["Post"];
                    var postrim = post.substring(0,100) + "...";
                    var plink = data["Post Link"];
                    return '<a href="'+plink+'" target="_blank" data-uk-tooltip title="'+post+'" class="uk-link">'+postrim+'</a>';
                }
            },
            /*
            { "data": "Comments", "title": "Comments", "render": $.fn.dataTable.render.number( '\.', '', 0, '' ) },
            { "data": "Likes", "title": "Likes", "render": $.fn.dataTable.render.number( '\.', '', 0, '' ) },
            { "data": "Shares", "title": "Shares", "render": $.fn.dataTable.render.number( '\.', '', 0, '' ) },
            */
            {
                "data": "Sentiment","title": "","width": "12.5%","orderable": false,"class": "uk-text-center",
                "createdCell": function (td, cellData, rowData, row, col) {
                    switch (cellData) {
                        case 'positive':
                        case 'Positif':
                        case 'positif':
                            $(td).css('color', 'green');
                            break;
                        case 'neutral':
                        case 'Netral':
                        case 'netral':
                            $(td).css('color', 'grey');
                            break;
                        case 'negative':
                        case 'Negatif':
                        case 'negatif':
                            $(td).css('color', 'red');
                            break;
                    }
                }
            },
            {
                "data": "Status", "orderable": true, "width": "12.5%", "class": "uk-text-center",
                "render": function ( cellData ) {
                    var status = cellData;
                    var btn = "";
                    switch (status) {
                        case 'Mark This':
                            btn = '<a href="#openTicket" uk-tooltip uk-toggle title="Need a response" class="orange white-text uk-badge sm-badge">Mark This</a>'
                        break;
                        case 'Closed':
                            btn = '<span class="uk-badge sm-badge green white-text" title="Responded and closed" uk-tooltip>Closed</span>'
                        break;
                        case 'Open':
                            btn = '<span class="uk-badge sm-badge red white-text" title="Waiting for a response" uk-tooltip>Open</span>'
                        break;
                    }

                    return btn;
                }
            },
            /*{
                "data": null, "orderable": false, "width": "12.5%", "class": "uk-text-right",
                "render": function ( data ) {
                    return '<a href="#openTicket" uk-tooltip uk-toggle title="Mark as Need Respond" class="uk-button uk-button-small orange white-text">Mark This</a>';
                }
            }*/
        ],
        order: [[ 1, "desc" ]],
        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                if(column[0][0] == 5) {
                    var select = $('<select class="uk-select select-sentiment"><option value="">All Sentiment</option></select>')
                        .appendTo( $(column.header()).empty() )
                        .on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            column
                                .search( val ? '^'+val+'$' : '', true, false )
                                .draw();
                        } );

                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    });
                }
            });
        }
    });
    theTable.on( 'order.dt search.dt', function () {
        theTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
    theTable.columns.adjust().draw();

}