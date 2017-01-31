$(document).ready(function() {
    projectGrid('projectGrid');
});

function projectGrid(div) {
    $.ajax({
        url: 'json/project-list.json',
        //dataType: 'jsonp',
        success: function(result){
            var data = result.projectList;
            //console.log(data);

            if (data.length === 0) {
                $('#'+div).html("<div class='uk-text-center'>No Data</div>");
            } else {
                for (var i = 0; i < data.length; i++) {
                    pid = data[i].pid;
                    pdate = data[i].pdate;
                    pgroup = data[i].pgroup;
                    pname = data[i].pname;
                    length = data.length;

                    var project = '<div id="'+pid+'"> \
                        <div class="uk-card uk-card-hover uk-card-default uk-card-small"> \
                            <div class="uk-card-header"> \
                                <h5 class="uk-card-title">'+pname+'</h5> \
                            </div> \
                            <div class="uk-card-body"> \
                                <div uk-grid class="uk-grid-collapse"> \
                                    <div class="uk-width-1-1"> \
                                        <div id="chartCover_'+pid+'" class="sm-chartcover"></div> \
                                    </div> \
                                    <div class="uk-width-2-5">Date Create</div> \
                                    <div class="uk-width-3-5">: '+pdate+'</div> \
                                    <div class="uk-width-2-5">Project Group</div> \
                                    <div class="uk-width-3-5">: '+pgroup+'</div> \
                                </div> \
                            </div> \
                            <div class="uk-card-footer uk-clearfix"> \
                                <div class="uk-inline"> \
                                    <a class="grey-text" uk-icon="icon: more-vertical"></a> \
                                    <div class="sm-card-action" uk-drop="mode: click; pos: right-center"> \
                                        <a uk-toggle="target: #edit_'+pid+'" class="uk-icon-button green white-text" uk-icon="icon: pencil" title="Edit Project" uk-tooltip></a> \
                                        <a uk-toggle="target: #delete_'+pid+'" class="uk-icon-button red white-text" uk-icon="icon: trash" title="Delete Project" uk-tooltip></a> \
                                    </div> \
                                </div> \
                                <a href="'+baseUrl+'/project-all?pid='+pid+'" class="uk-button uk-button-text uk-float-right red-text">View Project</a> \
                            </div> \
                        </div> \
                    </div> \
                    <div id="edit_'+pid+'" uk-modal> \
                        <div class="uk-modal-dialog"> \
                            <div class="uk-modal-body"><h5>Edit Project <span class="uk-text-uppercase">'+pname+'</span>?</h5></div> \
                            <div class="uk-modal-footer uk-clearfix"> \
                                <a class="uk-modal-close uk-button grey white-text">CANCEL</a> \
                                <a href="./edit?pid='+pid+'" class="uk-button uk-float-right blue white-text">YES</a> \
                            </div> \
                        </div> \
                    </div> \
                    <div id="delete_'+pid+'" uk-modal> \
                        <div class="uk-modal-dialog"> \
                            <div class="uk-modal-body"> \
                                <h5>Are You Sure?</h5> \
                                <p>Project <span class="uk-text-uppercase">'+pname+'</span> will no longer available.</p> \
                            </div> \
                            <div class="uk-modal-footer uk-clearfix"> \
                                <a class="uk-modal-close uk-button grey white-text">CANCEL</a> \
                                <a href="./delete?pid='+pid+'" class="uk-button uk-float-right red white-text">YES</a> \
                            </div> \
                        </div> \
                    </div>';
                    $('#'+div).append(project);
                    chartCover(pid);
                }
            }
        }
    });
}
function chartCover(pid) {
    $.ajax({
        url: 'json/401-brandEquity.json',
        //dataType: 'jsonp',
        success: function(result){
            var brandEquity = result.brandEquity;
            //console.log(data);

            if (brandEquity.length === 0) {
                $('#chartCover_'+pid).html("<div class='uk-text-center'>No Data</div>");
            } else {
                var $colors = [], $series=[], $xval = [], $yval = [];
                for (var i = 0; i < brandEquity.length; i++) {
                    $length = brandEquity.length;

                    $unquser = brandEquity[i].unquser;
                    $netBrandReputation = brandEquity[i].netBrandReputation;
                    $netsen = brandEquity[i].netsen;
                    $keywordName = brandEquity[i].keywordName;
                    $color = brandEquity[i].color;
                    $buzz = brandEquity[i].buzz;
                    $brandFavourableTalkability = brandEquity[i].brandFavourableTalkability;
                    $sim = brandEquity[i].sim;
                    $keywordID = brandEquity[i].keywordID;
                    $emss = brandEquity[i].emss;
                    $earnedMediaShare = brandEquity[i].earnedMediaShare;

                    $xval[i] = brandEquity[i].netsen;
                    $yval[i] = brandEquity[i].earnedMediaShare;

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
                //console.log(data.colors);

                var arr_xval = $xval;
                var arr_xmax = Math.max.apply(Math,arr_xval);
                var arr_xmin = Math.min.apply(Math,arr_xval);
                var xmax = arr_xmax + (arr_xmax * 0.1);
                var xmin = arr_xmin - (arr_xmax * 0.1);
                //console.log(xmin+'-'+xmax);

                var arr_yval = $yval;
                var arr_ymax = Math.max.apply(Math,arr_yval);
                var arr_ymin = Math.min.apply(Math,arr_yval);
                var ymax = arr_ymax + (arr_ymax * 0.5);
                var ymin = arr_ymin - (arr_ymax * 0.5);
                //console.log(ymin+'-'+ymax);


                //CHART
                var dom = document.getElementById('chartCover_'+pid);
                var theme = 'default';
                var theChart = echarts.init(dom,theme);
                var loadingTicket;
                var effectIndex = -1;
                var effect = ['spin'];
                //var effectIndex = ++effectIndex % effect.length;
                theChart.showLoading({
                    text : '',
                    //effect : effect[effectIndex],
                });

                var option = {
                    backgroundColor: '#f7f7f7',
                    color: data.colors,
                    title: {
                        show: false
                    },
                    legend: {
                        show: false
                    },
                    grid: {
                        //show: true,
                        /*left: 0,
                        top: 0,
                        right: 0,
                        bottom: 0,*/
                        x: '0',
                        x2: '0',
                        y: '0',
                        y2: '0'
                    },
                    tooltip: {
                        padding: 10,
                        backgroundColor: 'rgba(34, 34, 34, 0.7)',
                        position: function (point, params, dom) {
                            //return [point[0], '10%'];
                        },
                        formatter: function (obj) {
                            var value = obj.value;
                            return '<h6 class="white-text uk-margin-remove">' + obj.seriesName + '</h6>'
                                + '<ul class="uk-list white-text uk-margin-remove" style="font-size:11px;">'
                                + '<li class="uk-margin-remove">Net Sentiment:' + value[0] + '</li>'
                                + '<li class="uk-margin-remove">Earned Media Share:' + value[1] + '</li>'
                                + '<li class="uk-margin-remove">Unique User:' + value[2] + '</li>'
                                + '</ul>';
                        }
                    },
                    xAxis: {
                        type: 'value',
                        splitLine: {
                            lineStyle: {
                                type: 'dotted'
                            }
                        },
                        axisLabel: {
                            show: false
                        },
                        //scale: true,
                        min: xmin,
                        max: xmax
                    },
                    yAxis: {
                        type: 'value',
                        splitLine: {
                            lineStyle: {
                                type: 'dotted'
                            }
                        },
                        axisLabel: {
                            show: false
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
                },1800);
                $(window).on('resize', function(){
                    if(theChart != null && theChart != undefined){
                        theChart.resize();
                    }
                });
            }
        }
    });
}