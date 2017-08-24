function chartBubble(domId, url, chartApiData, name) {
    $.ajax({
        method: "POST",
        url: url,
        data: chartApiData,
        beforeSend : function(xhr) {
            $('#'+domId).append(cardloader);
        },
        complete : function(xhr, status) {
            $('.cardloader').remove();
        },
        success: function(result) {
            if (result[0]===undefined) {
                $('#'+domId).html(cardEmpty);
            }
            var result = jQuery.parseJSON(result);
            var chartId = result.chartId;
            var chartName = result.chartName;
            var chartInfo = result.chartInfo;
            var chartData = result.chartData;
            if (name != null) {
                var chartTitle = name;
            } else {
                var chartTitle = chartName;
            }

            var card = '<div class="sm-chart-container">'
                + '<div class="uk-card uk-card-small">'
                    + '<div class="">'
                        + '<div id="'+chartId+'" class="sm-chart"></div>'
                    + '</div>'
                + '</div>'
            + '</div>';
            $('#'+domId).append(card);

            if (chartData.length > 0) {
                var $colors=[], $series=[], $legend=[], $xval=[], $yval=[];
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
                    $legend[i] = $keywordName;
                    $series[i] = {
                        name: $keywordName,
                        data: [[$netsen, $earnedMediaShare, $unquser]],
                        type: 'scatter',
                        label: {
                            normal: {
                                show: true,
                                position: 'bottom',
                                textStyle: {
                                    fontSize: 10
                                },
                                formatter: function (params) {
                                    var net = 'Net Sentiment: '+ params.value[0];
                                    var ems = 'EMS: '+ params.value[1];
                                    var unq = 'Unique: '+ params.value[2];
                                    return unq+'\n'+ems+'\n'+net;
                                }
                            }
                        },
                        symbolSize: 25
                    };

                }
                var data = {
                    series: $series,
                    colors: $colors,
                    legend: $legend
                };

                var arr_xval = $xval;
                var arr_xmax = Math.max.apply(Math,arr_xval);
                var arr_xmin = Math.min.apply(Math,arr_xval);

                if (arr_xmin < 10) {
                    var xmin = arr_xmin - 10;
                } else {
                    var xmin = arr_xmin - (arr_xmax * 0.1);
                }
                if (arr_xmax < 10) {
                    var xmax = arr_xmax + 10;
                } else {
                    var xmax = arr_xmax + (arr_xmax * 0.1);
                }

                var arr_yval = $yval;
                var arr_ymax = Math.max.apply(Math,arr_yval);
                var arr_ymin = Math.min.apply(Math,arr_yval);
                if (arr_ymin < 10) {
                    var ymin = arr_ymin - 10;
                } else {
                    var ymin = arr_ymin - (arr_ymax * 0.1);
                }
                if (arr_ymax < 10) {
                    var ymax = arr_ymax + 10;
                } else {
                    var ymax = arr_ymax + (arr_ymax * 0.1);
                }

                //CHART
                var domchart = document.getElementById(chartId);
                var theme = 'default';
                var theChart = echarts.init(domchart,theme);
                var loadingTicket;
                var effectIndex = -1;
                var effect = ['spin'];
                //var effectIndex = ++effectIndex % effect.length;
                theChart.showLoading({
                    text : '',
                    //effect : effect[effectIndex],
                });

                if (data.colors[0]===undefined || data.colors[0]=='' || data.colors[0]==null) {
                    dataColor = [
                        '#5ab1ef','#ffb980','#07a2a4','#9a7fd1','#588dd5',
                        '#f5994e','#c05050','#7eb00a','#6f5553','#c14089',
                        '#59678c','#c9ab00','#dc69aa','#2ec7c9','#b6a2de',
                    ];
                } else {
                    dataColor = data.colors;
                }

                var option = {
                    title: {
                        text: chartName.toUpperCase(),
                        left: '10px',
                        top: '10px',
                    },
                    backgroundColor: '#ffffff',
                    animation: false,
                    color: dataColor,
                    legend: {
                        data: data.legend,
                        left: '10px',
                        bottom: '10px',
                        itemGap: 5,
                        formatter: function (name) {
                            var shortKey = name.substring(0, 10);
                            if(name.length>10){
                                return shortKey+'..';
                            } else {
                                return name;
                            }
                        },
                        textStyle: {
                            fontSize: 11,
                            color: '#333'
                        }
                    },
                    grid: {
                        x: '15px',
                        x2: '15px',
                        y: '50px',
                        y2: '75px'
                    },
                    toolbox: {
                        show: false,
                    },
                    xAxis: {
                        type: 'value',
                        // name: 'Net Sentiment',
                        // nameLocation: 'middle',
                        // nameGap: -15,
                        nameTextStyle: {
                            color: '#999',
                            textStyle: {
                                fontSize: 11
                            },
                        },
                        axisLabel: {
                            textStyle: {
                                fontSize: 11
                            },
                            formatter: function (v) {
                                if(v>10) {
                                    val = numeral(v).format('0a');
                                    return val;
                                } else {
                                    return v;
                                }
                            }
                        },
                        min: xmin,
                        max: xmax
                    },
                    yAxis: {
                        type: 'value',
                        // name: 'EMS',
                        // nameLocation: 'end',
                        // nameRotate: 90,
                        // nameGap: -30,
                        nameTextStyle: {
                            color: '#999',
                            textStyle: {
                                fontSize: 11
                            },
                        },
                        splitLine: {
                            show: true
                        },
                        axisLine: {
                            show: false
                        },
                        axisLabel: {
                            show: false
                        },
                        min: ymin,
                        max: ymax
                    },
                    series: data.series
                };

                clearTimeout(loadingTicket);
                loadingTicket = setTimeout(function (){
                    theChart.hideLoading();
                    theChart.setOption(option);
                    imgUrl = theChart.getDataURL();
                    if($("#report-form").length !== 0) {
                        //console.log('add');
                        $('#report-form').append('<input type="hidden" name="'+domId+'" value="'+imgUrl+'" />');
                    }
                    theChart.resize();
                },1200);
                $(window).on('resize', function(){
                    if(theChart != null && theChart != undefined){
                        theChart.resize();
                    }
                });

            } else {
                $('#'+chartId).html(msgEmpty);
            }
        },
        error: function(xhr, status){
            $('#'+domId).html(cardEmpty);
        }
    });
}
