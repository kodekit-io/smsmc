function timeline(div,type) {
    var url = 'json/timeline-'+type+'.json'
    $.ajax({
        url: url,
        //dataType: 'jsonp',
        success: function(result){
            var name = result.name;
            var desc = result.desc;

            var card = '<div class="uk-animation-fade uk-card sm-chart-container uk-card-hover uk-card-default uk-card-small"> \
                <div class="uk-card-header uk-clearfix"> \
                    <h5 class="uk-card-title uk-float-left color-text-'+type+'"><i class="fa fa-'+type+'"></i> '+name+'</h5> \
                    <ul class="uk-float-right uk-subnav uk-margin-remove"> \
                        <li><a class="grey-text fa fa-info-circle" title="'+desc+'" uk-tooltip></a></li> \
                        <li><a onclick="hideThis(this)" class="grey-text fa fa-eye-slash" title="Hide This" uk-tooltip></a></li> \
                        <li><a onclick="fullscreen(this)" class="grey-text fa fa-expand" title="Full Screen" uk-tooltip></a></li> \
                    </ul> \
                </div> \
                <div class="uk-card-body"> \
                    <table id="'+div+''+type+'" class="uk-table uk-table-condensed uk-width-1-1 sm-table"></table> \
                </div> \
            </div>';
            $('#'+div).append(card);

            var theTable = $('#'+div+''+type).DataTable( {
                paging: true,
                searching: false,
                info: false,
                processing: true,
                dom: "<'sm-timeline-wrap't><'uk-grid uk-grid-collapse sm-timeline-foot'<'uk-width-1-2'l><'uk-width-1-2'p>>",
                language: {
                    "lengthMenu": "Show _MENU_",
                    "paginate": {
                        "previous": "<i class='fa fa-chevron-left'></i>",
                        "next": "<i class='fa fa-chevron-right'></i>"
                    }
                },
                ajax: {
                    "url": url,
                    "data" : "data"
                },
                columns: [
                    { data: "postDate", visible: false },
                    {   data: null, width: "100%",
                        render: function ( data ) {
                            var d = data['postDate'];
                            var postDate = moment.parseZone(d).local().format('llll');
                            var userName = data['userName'];
                            var userImg = data['userImg'];
                            var userUrl = data['userUrl'];
                            var postText = data['postText'];
                            var postTrim = postText.substring(0,150);
                            var postImg = data['postImg'];
                            var postVid = data['postVid'];
                            var img = '';
                            if (postImg !=''){
                                img = '<div class="sm-timeline-img" style="background-image:url('+postImg+')"></div>';
                            }
                            var vid = '';
                            if (postVid !=''){
                                vid = '<video class="video-js sm-timeline-vid" controls preload="auto" data-setup=\'{ "techOrder": ["youtube"], "sources": [{ "type": "video/youtube", "src": "'+postVid+'"}] }\' ></video>';
                            }
                            var postUrl = data['postUrl'];
                            var timeline =  '<div class="uk-grid-small" uk-grid>'
                                                + '<div class="uk-width-auto">'
                                                    + '<a href="'+userUrl+'" target="_blank" title="'+userName+'"><img class="uk-border-rounded" src="'+userImg+'" width="32" height="32" alt="'+userName+'"></a>'
                                                + '</div>'
                                                + '<div class="uk-width-expand">'
                                                    + '<h5 class="uk-margin-remove"><a class="color-text-'+type+'" href="'+userUrl+'" target="_blank" title="'+userName+'">' +userName+ '</a></h5>'
                                                    + '<div class="uk-text-meta uk-text-small uk-text-truncate">' +postDate+ '</div>'
                                                    + img
                                                    + vid
                                                    + '<div title="'+postText+'" uk-tooltip>' +postTrim+ '</div>'
                                                    + '<ul class="uk-iconnav">'
                                                        + '<li><a href="'+postUrl+'" class="fa fa-link" target="_blank" title="Open link" uk-tooltip></a></li>'
                                                        + '<li><a href="" class="fa fa-comment" title="Reply" uk-tooltip></a></li>'
                                                    + '</div>'
                                                + '</div>'
                                            + '</div>';
                            return timeline;
                        }
                    }
                ],
                order: [[ 0, "desc" ]]
            });
            theTable.columns.adjust().draw();
        }
    })
}
