function theList(div) {
    // var card = '<div class="uk-animation-fade uk-card uk-card-hover uk-card-default uk-card-small"> \
    //     <div class="uk-card-header uk-clearfix"> \
    //         <h5 class="uk-card-title uk-float-left">Ticket List</h5> \
    //         <a href="' + baseUrl + '/ticket/add" title="Create New Ticket" class="uk-button red white-text uk-float-right">Create New Ticket</a> \
    //     </div> \
    //     <div class="uk-card-body"> \
    //         <table id="ticketList" class="uk-table uk-table-condensed uk-table-striped uk-width-1-1 sm-table"></table> \
    //     </div> \
    // </div>';
    // $('#'+div).append(card);

    var theTable = $('#'+div).DataTable( {
        ajax: {
            // url: baseUrl+'/json/engagement-list.json',
			url : baseUrl + '/engagement/get-list'
        },
        buttons: {
            buttons: [
                //{ extend: 'pdfHtml5', className: 'uk-button uk-button-small red white-text' },
                { extend: 'excelHtml5', className: 'uk-button uk-button-small green darken-2 white-text uk-margin-small-left' },
                { extend: 'csvHtml5', className: 'uk-button uk-button-small teal white-text uk-margin-small-left' }
            ]
        },
        // "engagementId": "33",
        // "postDate": "",
        // "postChanel": "",
        // "engagementMedia": "7",
        // "postDetails": "",
        // "engagementPost": "Test instagram",
        // "engagementAuthor": "gitacaesar",
        // "engagementAuthorGroup": "PO",
        // "engagementDate": "2017-05-05 14:38:05.0",
        // "postLink": "",
        // "postAuthor": ""

        columns: [
			{ data: 'engagementDate', visible: false, },
            { data: 'engagementId', title: 'ID', width: '5%', },
            {
                title: 'Date', width: '20%',
                data: function ( data ) {
                    var localtime = moment(data['engagementDate']).format('llll');
                    // return data['engagementDate'];
                    return localtime;
                }
            },
            {
                data: 'engagementMedia', title: 'Channel', class: 'uk-text-center',  width: '10%',
                render: function ( cellData ) {
                    var channel = cellData;
                    var icon = '';
                    switch (channel) {
            			case '1':
            				icon = 'facebook';
            				break;
            			case '2':
            				icon = 'twitter';
            				break;
            			case '5':
            				icon = 'youtube';
            				break;
            			case '7':
            				icon = 'instagram';
            				break;
            			case '4':
            				icon = 'globe';
            				break;
                        case '9':
            				icon = 'globe';
            				break;
            			case '3':
            				icon = 'rss';
            				break;
            			case '6':
            				icon = 'comments';
            				break;
            		}
                    return '<span class="uk-icon-button white-text color-'+icon+'"><i class="fa fa-'+icon+'"></i> <span class="uk-hidden">'+icon+'</span></span>';
                }
            },
            { title: 'Author', width: '20%',
                data: function ( data ) {
                    var author = data['engagementAuthor'];
                    var group = data['engagementAuthorGroup'];
                    return author+' ('+group+')';
                }
            },
            { data: 'engagementPost', title: 'Post', width: '35%', class: 'uk-text-break' },
        ],
        order: [[ 1, 'desc' ]]
    });
    /*
    theTable.on( 'order.dt search.dt', function () {
        theTable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
    */
    theTable.columns.adjust().draw();
}
