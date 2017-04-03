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
