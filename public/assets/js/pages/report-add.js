(function ($, window, document) {
    $(function () {
        $("#project-selector").chained("#type-selector");
        $("#key-acc-selector").chained("#project-selector");
        $("#media-selector").chained("#type-selector");

        $('#media-selector').change(function(){
            $('.sm-media').hide();
            $('#' + $(this).val()).show();
        });
        $('#project-selector').change(function(){
            if ($(this).val()=='socmed-facebook') {
                $('.sm-media').hide();
                $('#socmed-facebook').show();
            } else if ($(this).val()=='socmed-twitter') {
                $('.sm-media').hide();
                $('#socmed-twitter').show();
            } else if ($(this).val()=='socmed-youtube') {
                $('.sm-media').hide();
                $('#socmed-youtube').show();
            } else if ($(this).val()=='socmed-instagram') {
                $('.sm-media').hide();
                $('#socmed-instagram').show();
            }
        });

        var projectSummary = [
            '401','305','113','101','102','106','104','201','202','204','211','303','306','308','402','403','405'
        ];
        var projectFacebook = [
            '113','101','201','203','207','210','305','303','308','402','403','404','405'
        ];
        var projectTwitter = [
            '113','102','111','106','202','204','214','205','305','303','308','403','402','404','405'
        ];
        var projectNews = [
            '113','101','103','201','203','206','305','308','403','402','404','405'
        ];
        var projectForum = [
            '113','101','103','305','308','403','402','404','405'
        ];
        var projectBlog = [
            '113','101','103','201','203','206','305','308','403','402','404','405'
        ];
        var projectVideo = [
            '101','112','103','212','203','209','308','403','402','404','405'
        ];
        var projectInstagram = [
            '113','101','103','108','105','201','208','305','303','308','403','402','404','405'
        ];
        chartreport('project-summary',projectSummary);
        chartreport('project-facebook',projectFacebook);
        chartreport('project-twitter',projectTwitter);
        chartreport('project-news',projectNews);
        chartreport('project-forum',projectForum);
        chartreport('project-blog',projectBlog);
        chartreport('project-video',projectVideo);
        chartreport('project-instagram',projectInstagram);

        var socmedFacebook = [
            '113','101','110','201','203','207','210','305','303','403','404','405'
        ];
        var socmedTwitter = [
            '113','102','111','106','202','204','214','205','305','303','308','403','404','405'
        ];
        var socmedVideo = [
            '101','112','103','212','203','209','308','403','404','405'
        ];
        var socmedInstagram = [
            '113','101','103','108','105','201','208','203','212','305','303','308','403','404','405'
        ];
        chartreport('socmed-facebook',socmedFacebook);
        chartreport('socmed-twitter',socmedTwitter);
        chartreport('socmed-youtube',socmedVideo);
        chartreport('socmed-instagram',socmedInstagram);
    });
    function chartreport(domId,reportlist) {
        var page = '<h5 class="uk-card-title uk-margin-bottom">'+domId.split('-').join(' ')+' chart</h5>'
        + '<div class="uk-child-width-1-2@s uk-child-width-1-5@m uk-grid-small" id="select-'+domId+'" uk-grid>'
            + '<div>'
                + '<label><input class="uk-checkbox select-all-'+domId+'" type="checkbox"> Select All</label>'
            + '</div>'
        + '</div>';
        $('#'+domId).append(page);
        $('.select-all-'+domId).checkAll(
            { container: $('#select-'+domId), showIndeterminate: true }
        );

        $.ajax({
    		url : baseUrl + '/json/chartlist.json',
            //data : data,
    		beforeSend : function(xhr) {
    		},
    		complete : function(xhr, status) {
    		},
    		success : function(result) {
                data = result.chartList;

                if (data.length > 0) {
                    var chartId=[], chartName=[];
                    for (i = 0; i < data.length; i++) {
                        chartId[i] = data[i].chartId;
                        chartName[i] = data[i].chartName;

                        if (reportlist.length > 0) {
                            var xid=[];
                            for(var x = 0; x < reportlist.length; x++) {
                                xid[x] = reportlist[x];
                                //console.log(xid[x]);
                                if (chartId[i]===xid[x]) {
                                    //console.log(chartId[i]);
                                    var xlist = '<div>'
                                        + '<label>'
                                            + '<input value="'+chartId[i]+'" class="uk-checkbox" type="checkbox"> '
                                            + chartName[i]
                                        + '</label>'
                                    + '</div>';
                                    $('#select-'+domId).append(xlist);
                                }
                            }
                        }
                    }
                }
            }
        });
    }

}(window.jQuery, window, document));