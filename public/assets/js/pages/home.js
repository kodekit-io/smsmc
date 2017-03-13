(function ($, window, document) {
    $(function () {
        //projectGrid('projectGrid', baseUrl + '/json/project-list-all.json');
        projectGrid('projectGrid', baseUrl + '/get-project-list');
    });

    function projectGrid(domId, url) {
        $.ajax({
            url: url,
            beforeSend : function(xhr) {
            },
            complete : function(xhr, status) {
            },
            success : function(result) {
                result = jQuery.parseJSON(result);
                var data = result.projectList;
                //console.log(data);

                if (data.length === 0 || data == undefined) {
                    $('#'+domId).append(
                        '<div class="uk-position-center uk-text-center uk-card uk-card-default uk-card-body uk-width-auto@m">'
                        + '<a href="'+baseUrl+'/project-add" class="red-text"><i class="fa fa-plus fa-3x"></i><br>Create Your First Project</a>'
                        +'</div>'
                    );

                } else {
                    for (var i = 0; i < data.length; i++) {
                        pid = data[i].pid;
                        pdate = data[i].pdate;
                        pgroup = data[i].pgroup;
                        pname = data[i].pname;
                        length = data.length;

                        var modalEdit = '<div id="edit'+pid+'" uk-modal>'
                            + '<div class="uk-modal-dialog">'
                                + '<div class="uk-modal-body"><h5>Edit Project <span class="uk-text-uppercase">'+pname+'</span>?</h5></div>'
                                + '<div class="uk-modal-footer uk-clearfix">'
                                    + '<a class="uk-modal-close uk-button grey white-text">CANCEL</a>'
                                    + '<a href="'+baseUrl+'/project-edit?pid='+pid+'" class="uk-button uk-float-right blue white-text">YES</a>'
                                + '</div>'
                            + '</div>'
                        + '</div>';
                        var modalDelete = '<div id="delete'+pid+'" uk-modal>'
                            + '<div class="uk-modal-dialog">'
                                + '<div class="uk-modal-body">'
                                    + '<h5>Are You Sure?</h5>'
                                    + '<p>Project <span class="uk-text-uppercase">'+pname+'</span> will no longer available.</p>'
                                + '</div>'
                                + '<div class="uk-modal-footer uk-clearfix">'
                                    + '<a class="uk-modal-close uk-button grey white-text">CANCEL</a>'
                                    + '<a href="'+baseUrl+'/project-delete?pid='+pid+'" class="uk-button uk-float-right red white-text">YES</a>'
                                + '</div>'
                            + '</div>'
                        + '</div>';

                        var project = '<div id="'+pid+'">'
                            + '<div class="uk-card uk-card-hover uk-card-default uk-card-small">'
                                + '<div class="uk-card-header">'
                                    + '<h5 class="uk-card-title uk-text-truncate">'+pname+'</h5>'
                                + '</div>'
                                + '<div class="uk-card-body">'
                                    + '<div uk-grid class="uk-grid-collapse">'
                                        + '<div class="uk-width-1-1">'
                                            + '<div id="chartCover'+pid+'" class="sm-chartcover"></div>'
                                        + '</div>'
                                        + '<div class="uk-width-2-5">Date Create</div>'
                                        + '<div class="uk-width-3-5">: '+pdate+'</div>'
                                        + '<div class="uk-width-2-5">Project Group</div>'
                                        + '<div class="uk-width-3-5">: '+pgroup+'</div>'
                                    + '</div>'
                                + '</div>'
                                + '<div class="uk-card-footer uk-clearfix">'
                                    + '<div class="uk-inline">'
                                        + '<a class="grey-text" uk-icon="icon: more-vertical"></a>'
                                        + '<div class="sm-card-action" uk-drop="mode: click; pos: right-center">'
                                            + '<a class="uk-icon-button green white-text" uk-icon="icon: pencil" title="Edit Project" uk-tooltip href="#edit'+pid+'" uk-toggle></a>'
                                            + modalEdit
                                            + '<a class="uk-icon-button red white-text" uk-icon="icon: trash" title="Delete Project" uk-tooltip href="#delete'+pid+'" uk-toggle></a>'
                                            + modalDelete
                                        + '</div>'
                                    + '</div>'
                                    + '<a href="'+baseUrl+'/project/all/'+pid+'" class="uk-button uk-button-text uk-float-right red-text">View Project</a>'
                                + '</div>'
                            + '</div>'
                        + '</div>'
                        $('#'+domId).append(project);
                        chartCover(pid);
                    }
                }
            },
            error: function (request, status, error) {
                $('#'+domId).append('<div class="uk-position-center uk-text-center">FOUT!</div>');
            }
        });
    }

    function chartCover(pid) {
        $.ajax({
            // url: 'json/charts/401-brand-equity.json',
            url: baseUrl + '/get-brand-equity/' + pid,
            beforeSend : function(xhr) {
            },
            complete : function(xhr, status) {
            },
            success : function(result) {
                //console.log(result);
                var result = jQuery.parseJSON(result);
                var chartData = result.chartData;

                if (chartData.length > 0) {
                    var $colors = [], $series=[], $xval = [], $yval = [];
                    for (var i = 0; i < chartData.length; i++) {
                        $length = chartData.length;

                        $unquser = chartData[i].unquser;
                        $netBrandReputation = chartData[i].netBrandReputation;
                        $netsen = chartData[i].netsen;
                        $keywordName = chartData[i].keywordName;
                        $color = chartData[i].color;
                        $buzz = chartData[i].buzz;
                        $brandFavourableTalkability = chartData[i].brandFavourableTalkability;
                        $sim = chartData[i].sim;
                        $keywordID = chartData[i].keywordID;
                        $emss = chartData[i].emss;
                        $earnedMediaShare = chartData[i].earnedMediaShare;

                        $xval[i] = chartData[i].netsen;
                        $yval[i] = chartData[i].earnedMediaShare;

                        $colors[i] = $color;
                        $series[i] = {
                            name: $keywordName,
                            data: [[$netsen, $earnedMediaShare, $unquser]], //[x,y,z,....]
                            type: 'scatter',
                            symbolSize: function (data) {
                                return Math.sqrt(data[2]);
                            }
                        };

                    }
                    var data = {
                        series: $series,
                        colors: $colors
                    };

                    var arr_xval = $xval;
                    var arr_xmax = Math.max.apply(Math,arr_xval);
                    var arr_xmin = Math.min.apply(Math,arr_xval);
                    var xmax = arr_xmax + (arr_xmax * 0.1);
                    var xmin = arr_xmin - (arr_xmax * 0.1);

                    var arr_yval = $yval;
                    var arr_ymax = Math.max.apply(Math,arr_yval);
                    var arr_ymin = Math.min.apply(Math,arr_yval);
                    var ymax = arr_ymax + (arr_ymax * 0.5);
                    var ymin = arr_ymin - (arr_ymax * 0.5);

                    //CHART
                    var domchart = document.getElementById('chartCover'+pid);
                    var theme = 'default';
                    var theChart = echarts.init(domchart,theme);
                    var loadingTicket;
                    var effectIndex = -1;
                    var effect = ['spin'];
                    theChart.showLoading({
                        text : '',
                    });

                    if(data.colors[0] !== '' && data.colors.length > 0){
                        dataColor = data.colors;
                    } else {
                        dataColor = [
                            '#5ab1ef','#ffb980','#07a2a4','#9a7fd1','#588dd5',
                            '#f5994e','#c05050','#7eb00a','#6f5553','#c14089',
                            '#59678c','#c9ab00','#dc69aa','#2ec7c9','#b6a2de',
                        ];
                    }

                    var option = {
                        backgroundColor: '#f7f7f7',
                        color: dataColor,
                        title: {
                            show: false
                        },
                        legend: {
                            show: false
                        },
                        grid: {
                            x: '0',
                            x2: '0',
                            y: '0',
                            y2: '0'
                        },
                        tooltip: {
                            formatter: function (obj) {
                                var value = obj.value;
                                return '<span class="sm-text-bold">' + obj.seriesName + '</span><br>'
                                + '<table cellpadding="0" cellspacing="0">'
                                    + '<tr><td>Net Sentiment: </td><td class="uk-text-right"> ' + value[0] + '</td></tr>'
                                    + '<tr><td>Earned Media Share: </td><td class="uk-text-right"> ' + value[1] + '</td></tr>'
                                    + '<tr><td>Unique User: </td><td class="uk-text-right"> ' + value[2] + '</td></tr>'
                                + '</table>';
                            }
                        },
                        xAxis: {
                            type: 'value',
                            splitLine: {
                                show: false
                            },
                            axisLabel: {
                                show: false
                            },
                            axisLine: {
                                lineStyle: {
                                    color: "#ccc"
                                }
                            },
                            //scale: true,
                            min: xmin,
                            max: xmax
                        },
                        yAxis: {
                            type: 'value',
                            splitLine: {
                                show: false
                            },
                            axisLabel: {
                                show: false
                            },
                            axisLine: {
                                lineStyle: {
                                    color: "#ccc"
                                }
                            },
                            //scale: true,
                            min: ymin,
                            max: ymax
                        },
                        series: data.series
                    };
                    clearTimeout(loadingTicket);
                    loadingTicket = setTimeout(function (){
                        theChart.hideLoading();
                        theChart.setOption(option);
                    },1200);
                    $(window).on('resize', function(){
                        if(theChart != null && theChart != undefined){
                            theChart.resize();
                        }
                    });
                }
            },
            error: function (request, status, error) {
                $('#chartCover'+pid).append('<div class="uk-position-center uk-text-center">FOUT!</div>');
            }
        });
    }

}(window.jQuery, window, document));