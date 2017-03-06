function tableConvoAll(domId, url, chartApiData, name) {
    var xxx=0;
    $.ajax({
        method: "POST",
        url: url,
        data: chartApiData,
        beforeSend : function(xhr) {
            var cardloader = '<div class="cardloader sm-chart-container uk-animation-fade">'
                + '<div class="uk-card uk-card-small">'
                    + '<div class="uk-card-header uk-clearfix">'
                        + '<h5 class="uk-card-title uk-float-left"></h5>'
                    + '</div>'
                    + '<div class="uk-card-body">'
                        + '<div class="sm-chart"><div class="uk-position-center" uk-spinner></div></div>'
                    + '</div>'
                + '</div>'
            + '</div>';
            $('#'+domId).append(cardloader);
            xxx++;
        },
        complete : function(xhr, status) {
            xxx--;
            if (xxx <= 0) {
                $('.cardloader').remove();
            }
        },
        success: function(result){
            var result = jQuery.parseJSON(result);
            //console.log(result);
            var chartId = result.chartId;
            var chartName = result.chartName;
            var chartInfo = result.chartInfo;
            var chartData = result.chartData;
            if (name != null) {
                var chartTitle = name;
            } else {
                var chartTitle = chartName;
            }
            var modal = '<div id="openTicket" uk-modal>'
                + '<div class="uk-modal-dialog">'
                    + '<div class="uk-modal-body">'
                        + '<h5>Open New Ticket</h5>'
                        + '<form class="open-ticket">'
                            + '<div class="uk-flex uk-flex-middle">'
                                + '<div>'
                                    + '<a class="uk-button uk-button-default uk-button-small" type="button">Send to <span uk-icon="icon: chevron-down"></span></a>'
                                    + '<div uk-dropdown="offset: 0">'
                                        + '<ul class="uk-nav uk-navbar-dropdown-nav uk-list-line sendto">'
                                            + '<li><label><input class="uk-checkbox" type="checkbox"> Pulp & Paper</label></li>'
                                            + '<li><label><input class="uk-checkbox" type="checkbox"> Agribusiness & Food</label></li>'
                                            + '<li><label><input class="uk-checkbox" type="checkbox"> President Office</label></li>'
                                            + '<li><label><input class="uk-checkbox sendtoall" type="checkbox"> Send To All</label></li>'
                                        + '</ul>'
                                    + '</div>'
                                + '</div>'
                                + '<div class="uk-margin-left">'
                                    + '<a class="uk-button uk-button-default uk-button-small" type="button">Ticket Type <span uk-icon="icon: chevron-down"></span></a>'
                                    + '<div uk-dropdown="offset: 0">'
                                        + '<ul class="uk-nav uk-navbar-dropdown-nav uk-list-line">'
                                            + '<li><label><input class="uk-checkbox" type="checkbox"> Respon</label></li>'
                                            + '<li><label><input class="uk-checkbox" type="checkbox"> Monitor</label></li>'
                                            + '<li><label><input class="uk-checkbox" type="checkbox"> Content - Pulp & Paper</label></li>'
                                            + '<li><label><input class="uk-checkbox" type="checkbox"> Content - Agribusiness & Food</label></li>'
                                            + '<li><label><input class="uk-checkbox" type="checkbox"> Content - Property</label></li>'
                                            + '<li><label><input class="uk-checkbox" type="checkbox"> Content - President Office</label></li>'
                                            + '<li><label><input class="uk-checkbox" type="checkbox"> Content - Financial Services</label></li>'
                                            + '<li><label><input class="uk-checkbox" type="checkbox"> Content - Communication & Technology</label></li>'
                                            + '<li><label><input class="uk-checkbox" type="checkbox"> Content - Energy & Infrastructure</label></li>'
                                            + '<li><label><input class="uk-checkbox" type="checkbox"> Content - Initiatives Project</label></li>'
                                        + '</ul>'
                                    + '</div>'
                                + '</div>'
                            + '</div>'
                            + '<div class="uk-margin">'
                                + '<textarea class="uk-textarea" rows="3" placeholder="Additional message"></textarea>'
                            + '</div>'
                        + '</form>'
                    + '</div>'
                    + '<div class="uk-modal-footer uk-clearfix">'
                        + '<a class="uk-modal-close uk-button grey white-text">CANCEL</a>'
                        + '<a class="uk-modal-close uk-button uk-float-right red white-text">SEND</a>'
                    + '</div>'
                + '</div>'
            + '</div>';
            var card = '<div id="'+chartId+'" class="sm-chart-container uk-animation-fade">'
                + '<div class="uk-card uk-card-hover uk-card-default uk-card-small">'
                    + '<div class="uk-card-header uk-clearfix">'
                        + '<h5 class="uk-card-title uk-float-left">'+chartTitle+'</h5>'
                        + '<ul class="uk-float-right uk-subnav uk-margin-remove">'
                            + '<li><a class="grey-text fa fa-info-circle" title="'+chartInfo+'" uk-tooltip></a></li>'
                            + '<li><a onclick="hideThis(this)" class="grey-text fa fa-eye-slash" title="Hide This" uk-tooltip></a></li>'
                            + '<li><a onclick="fullscreen(this)" class="grey-text fa fa-expand" title="Full Screen" uk-tooltip></a></li>'
                        + '</ul>'
                    + '</div>'
                    + '<div class="uk-card-body">'
                        + '<table id="'+chartId+'Table" class="uk-table uk-table-condensed uk-table-striped uk-width-1-1 sm-table uk-margin-remove"></table>'
                        + modal
                    + '</div>'
                + '</div>'
            + '</div>';
            $('#'+domId).append(card);

            var theTable = $('#'+chartId+'Table').DataTable( {
                data: chartData,
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
                        "data": "date","title": "Date", "width": "12.5%",
                        "render": function ( cellData ) {
                            var localtime = moment.parseZone(cellData).local().format('llll');
                            return localtime;
                        }
                    },
                    {
                        "data": "channel", "title": "Channel", "width": "5%", "class": "uk-text-center",
                        "render": function ( cellData ) {
                            var channel = cellData;
                            var icon = "";
                            switch (channel) {
                    			case 'facebook':
                    				icon = 'facebook';
                    				break;
                    			case 'twitter':
                    				icon = 'twitter';
                    				break;
                    			case 'youtube':
                    				icon = 'youtube';
                    				break;
                    			case 'instagram':
                    				icon = 'instagram';
                    				break;
                    			case 'news':
                    				icon = 'globe';
                    				break;
                    			case 'blog':
                    				icon = 'rss';
                    				break;
                    			case 'forum':
                    				icon = 'comments';
                    				break;
                    		}
                            return '<span class="uk-icon-button white-text color-'+icon+'"><i class="fa fa-'+icon+'"></i> <span class="uk-hidden">'+channel+'</span></span>';
                        }
                    },
                    { "data": "author", "title": "Author", "width": "15%" },
                    {
                        "data": null, "title": "Post", "width": "40%",
                        "render": function ( data ) {
                            var post = data["post"];
                            var postrim = post.substring(0,100) + "...";
                            var plink = data["postLink"];
                            return '<a href="'+plink+'" target="_blank" data-uk-tooltip title="'+post+'" class="uk-link">'+postrim+'</a>';
                        }
                    },
                    {
                        "data": "sentiment","title": "","width": "12.5%","orderable": false,"class": "sentiment uk-text-center",
                        "createdCell": function (td, cellData, rowData, row, col) {
                            switch (cellData) {
                                case 'positive':
                                    $(td).addClass('green-text');
                                    break;
                                case 'neutral':
                                    $(td).addClass('grey-text');
                                    break;
                                case 'negative':
                                    $(td).addClass('red-text');
                                    break;
                            }
                        }
                    },
                    {
                        "data": "status", "title": "Status", "orderable": false, "width": "12.5%", "class": "uk-text-center",
                        "render": function ( cellData, display, row ) {
                            var btn = '';
                            switch (cellData) {
                                case 'New':
                                    btn = '<a href="#openTicket" uk-toggle uk-tooltip title="Open New Ticket" class="sm-btn-openticket orange-text white uk-badge sm-badge"><span class="nothover">'+cellData+'</span></a>';
                                break;
                                case 'Closed':
                                    btn = '<span class="uk-badge sm-badge green white-text" title="Responded and closed" uk-tooltip>'+cellData+'</span>';
                                break;
                                case 'Open':
                                    btn = '<span class="uk-badge sm-badge red white-text" title="Waiting for a response" uk-tooltip>'+cellData+'</span>';
                                break;
                            }
                            //console.log(row);
                            return btn;
                        }
                    }
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
                        if(column[0][0] == 6) {
                            var select = $('<select class="uk-select select-sentiment"><option value="">All Status</option></select>')
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

            // Edit Sentiment
            var sentiment = [
                "positive",
                "neutral",
                "negative"
            ];
            $('#'+chartId+'Table').on('click', '.sentiment', function() {
                var row = this.parentElement;
                if (!$('#'+chartId+'Table').hasClass("editing")) {
                    $('#'+chartId+'Table').addClass("editing");
                    var data = theTable.row(row).data();
                    var $row = $(row);
                    var idx = $row.find("td:nth-child(1)").text();
                    var thisSentiment = $row.find("td:nth-child(6)");
                    var thisSentimentText = thisSentiment.text();
                    thisSentiment.empty().append($("<select></select>", {
                        "id": "sentiment_" + idx,
                        "class": "changeSentiment"
                    }).append(function() {
                        var options = [];
                        $.each(sentiment, function(k, v) {
                            options.push($("<option></option>", {
                                "text": v,
                                "value": v
                            }))
                        })
                        return options;
                    }));
                    $("#sentiment_" + idx).val(thisSentimentText)
                }
            });

            $('#'+chartId+'Table tbody').on("change", ".changeSentiment", function() {
            	var $this = $(this);
                var $tempData = $this.val();
                switch ($tempData) {
                    case 'positive':
                        $this.parent("td").addClass('green-text').removeClass('red-text').removeClass('grey-text');
                        break;
                    case 'neutral':
                        $this.parent("td").addClass('grey-text').removeClass('red-text').removeClass('green-text');
                        break;
                    case 'negative':
                        $this.parent("td").addClass('red-text').removeClass('green-text').removeClass('grey-text');
                        break;
                }
                $this.parent("td").empty().text($this.val());
                $('#'+chartId+'Table').removeClass("editing");
                // todo : Post $tempData to API
            });

        }
    });
}