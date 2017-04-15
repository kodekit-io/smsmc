function reportView(div, url) {
    var card = '<div class="uk-animation-fade uk-card uk-card-hover uk-card-default uk-card-small"> \
        <div class="uk-card-header uk-clearfix"> \
            <h5 class="uk-card-title uk-float-left">Report List</h5> \
        </div> \
        <div class="uk-card-body"> \
            <table id="reportTable" class="uk-table uk-table-condensed uk-table-striped uk-width-1-1 sm-table"></table> \
        </div> \
    </div>';
    $('#'+div).append(card);
    $.ajax({
        url : url,
        dataType: 'json',
        beforeSend : function(xhr) {
        },
        complete : function(xhr, status) {
        },
        success : function(result) {
            // console.log(result);
            var theTable = $('#reportTable').DataTable( {
                // ajax: {
                //     "url": url,
                // },
                data : result.data,
                columns: [
                    { "data": null, "width": "2.5%" },
                    {
                        "title": "Report Created","width": "10%",
                        "data": function ( data ) {
                            // var date = data["reportDate"];
                            var localtime = moment.parseZone(data["reportDate"]).format('llll');
                            return localtime;
                        }
                    },
                    { "data": "name", "title": "Title", "width": "20%" },
                    { "data": "summary", "title": "Descriptions", "width": "27.5%" },
                    {
                        "title": "Start Report","width": "10%",
                        "data": function ( data ) {
                            var localtime = moment.parseZone(data["startDate"]).format('llll');
                            return localtime;
                        }
                    },
                    {
                        "title": "End Report","width": "10%",
                        "data": function ( data ) {
                            var localtime = moment.parseZone(data["endDate"]).format('llll');
                            return localtime;
                        }
                    },
                    {
                        "title": 'Page', "class": 'uk-text-center',  "width": '5%',
                        "data": function ( data ) {
                            var channel = data["mediaID"];
                            var icon = '', color = '';
                            switch (channel) {
                    			case "1":
                    				icon = 'facebook';
                                    color = 'facebook';
                    				break;
                    			case "2":
                    				icon = 'twitter';
                                    color = 'twitter';
                    				break;
                    			case "5":
                    				icon = 'youtube';
                                    color = 'youtube';
                    				break;
                    			case "7":
                    				icon = 'instagram';
                                    color = 'instagram';
                    				break;
                    			case "4":
                    				icon = 'globe';
                                    color = 'news';
                    				break;
                    			case "3":
                    				icon = 'rss';
                                    color = 'blog';
                    				break;
                    			case "6":
                    				icon = 'comments';
                                    color = 'forum';
                    				break;
                                case "8":
                    				icon = 'th-large';
                                    color = 'allmedia';
                                    break;
                                case "9":
                    				icon = 'globe';
                                    color = 'news';
                    				break;
                    		}
                            return '<span class="uk-icon-button white-text color-'+color+'" title="'+color+'" uk-tooltip><i class="fa fa-'+icon+'"></i> <span class="uk-hidden">'+icon+'</span></span>';
                        }
                    },
                    {
                        "orderable": false, "width": "15%", "class": "uk-text-right",
                        "data": function ( data ) {
                            var excel = data["excel"];
                            var id = data["id"];
                            var unduh = '<a href="'+excel+'" class="uk-button uk-button-small uk-button-primary uk-margin-small-right" title="Download Report" uk-tooltip><i class="fa fa-download fa-fw"></i></a>';
                            var hapus = '<a data-id="'+id+'" class="uk-button uk-button-small uk-button-danger sm-delete-report" title="Delete Report" uk-tooltip><i class="fa fa-close fa-fw"></i></a>';
                            if (excel != "") {
                                return unduh + hapus;
                            } else {
                                return hapus;
                            }

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
    });
    // Delete Report
    $('#reportTable').on('click', '.sm-delete-report', function(e) {
        e.preventDefault();
        $(this).blur();
        var id = $(this).attr('data-id');
        var link = baseUrl+'/report/delete/'+id;
        var modal = '<h5>Are you sure?</h5>';
        UIkit.modal.confirm(modal).then(function(){
            window.location.href = link;
        },function(){});

    });
}
