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
                        + '<h5 class="uk-card-title">'+chartTitle+'</h5>'
                    + '</div>'
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
                        data: [[$netsen, $earnedMediaShare, $unquser]], //[x,y,z,....]
                        type: 'scatter',
                        symbolSize: function (data) {
                            return Math.sqrt(data[2]);
                        }
                    };

                }
                var data = {
                    series: $series,
                    colors: $colors,
                    legend: $legend
                };
                //console.log(data.colors);

                // var arr_xval = $xval;
                // var arr_xmax = Math.max.apply(Math,arr_xval);
                // var arr_xmin = Math.min.apply(Math,arr_xval);
                // var xmax = arr_xmax + (arr_xmax * 0.1);
                // var xmin = arr_xmin - (arr_xmax * 0.1);
                // //console.log(xmin+'-'+xmax);
                //
                // var arr_yval = $yval;
                // var arr_ymax = Math.max.apply(Math,arr_yval);
                // var arr_ymin = Math.min.apply(Math,arr_yval);
                // var ymax = arr_ymax + (arr_ymax * 0.5);
                // var ymin = arr_ymin - (arr_ymax * 0.5);
                // //console.log(ymin+'-'+ymax);


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
                    backgroundColor: '#ffffff',
                    color: dataColor,
                    title: {
                        show: false
                    },
                    legend: {
                        data: data.legend,
                        x: 'left',
                        y: 'bottom',
                        itemGap: 5,
                        formatter: function (name) {
                            return name;
                        },
                        textStyle: {
                            fontSize: 11
                        },
                        tooltip:{
                            show:true
                        }
                    },
                    grid: {
                        x: '30px',
                        x2: '50px',
                        y: '50px',
                        y2: '70px'
                    },
                    toolbox: {
                        show: false,
                        x: 'right',
                        y: 'bottom',
                        padding: ['0', '0', '0', '0'],
                        feature: {
                            mark: {show: true},
                            //dataView : {show: false, readOnly: false},
                            magicType: {
                                show: false
                            },
                            restore: {show: true, title: 'Reload'},
                            saveAsImage: {show: true, title: 'Save'}
                        }
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
                        name: 'Net Sentiment',
                        nameLocation: 'middle',
                        nameGap: -15,
                        nameTextStyle: {
                            color: '#999'
                        },
                        axisLabel: {
                            //show: false,
                            textStyle: {
                                fontSize: 10
                            },
                            formatter: function (v) {
                                $v = numeral(v).format('0a');
                                return $v;
                            }
                        },
                        // min: xmin,
                        // max: xmax
                    },
                    yAxis: {
                        type: 'value',
                        name: 'EMS',
                        nameLocation: 'middle',
                        nameGap: -15,
                        nameTextStyle: {
                            color: '#999'
                        },
                        splitLine: {
                            lineStyle: {
                                type: 'dotted'
                            }
                        },
                        axisLabel: {
                            //show: false,
                            textStyle: {
                                fontSize: 10
                            },
                            formatter: function (v) {
                                $v = numeral(v).format('0a');
                                return $v;
                            }
                        },
                        // min: ymin,
                        // max: ymax
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