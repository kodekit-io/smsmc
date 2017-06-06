function theList(div) {
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
        columns: [
			{ data: 'engagementDate', visible: false, },
            { data: 'engagementId', title: 'ID', width: '3%', },
            {
                data: 'engagementMedia', title: 'Channel', class: 'uk-text-center',  width: '8%',
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
            {
                title: 'Post Date', width: '15%',
                sortable: false,
                data: function ( data ) {
                    var dateAsli = data['engagementDate'];
                    var dateUtc = moment.utc(dateAsli).format('llll');
                    var dateLoc = moment.utc(dateAsli).local().format('llll');
                    return dateLoc;
                }
            },
            {
                title: 'Author', width: '15%',
                data: function ( data ) {
                    var author = data['engagementAuthor'];
                    var group = data['engagementAuthorGroup'];
                    return author+' ('+group+')';
                }
            },
            { data: 'engagementPost', title: 'Post', width: '40%', class: 'uk-text-break' },
            {
                title: 'Status', width: '20%', class: 'uk-text-break',
                data: function ( data ) {
                    var dateAsli = data['engagementDate'];
                    var dateUtc = moment.utc(dateAsli).format('YYYY-MM-DD HH:mm:ss');
                    var dateLoc = moment(dateAsli).local().format('YYYY-MM-DD HH:mm:ss');
                    var now = moment.utc().format('YYYY-MM-DD HH:mm:ss');

                    var isbefore = moment(now).isBefore(dateUtc);

                    var iclock = '<i class="fa fa-clock-o fa-fw"></i> ';
                    var icheck = '<i class="fa fa-check fa-fw"></i> ';
                    var edit = '<a class="uk-label sm-label red" title="Edit Post" uk-tooltip><i class="fa fa-pencil fa-fw"></i> Edit Post</a>';
                    var link = '<a class="uk-button uk-button-link teal-text" title="See original post" uk-tooltip>See details <i class="fa fa-external-link-square fa-fw"></i></a>'
                    var scheduled = '<div class="uk-flex uk-flex-middle uk-flex-between">' +
                        '<div class="red-text">'+iclock+' Scheduled</div>' +
                        // '<div>'+edit+'</div>' +
                    '</div>';
                    var published = '<div class="uk-flex uk-flex-middle uk-flex-between">' +
                        '<div class="teal-text">'+icheck+' Published</div>' +
                        '<div>'+link+'</div>' +
                    '</div>';
                    if (isbefore==true) {
                        return scheduled; //+'<br>'+isbefore+'<br>asli '+dateAsli+'<br>utc '+dateUtc+'<br>loc '+dateLoc+'<br>now '+now;
                    } else {
                        return published; //+'<br>'+isbefore+'<br>asli '+dateAsli+'<br>utc '+dateUtc+'<br>loc '+dateLoc+'<br>now '+now;
                    }
                }
            },
        ],
        order: [[ 6, 'desc' ]]
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
