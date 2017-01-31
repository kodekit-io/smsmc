function chart401(id) {
    $.ajax({
        url: 'json/401-brandEquity.json',
        //dataType: 'jsonp',
        success: function(result){
            var chartId = result.chartId;
            var chartName = result.chartName;
            var brandEquity = result.brandEquity;
            //console.log(data);

            var card = '<div class="sm-chart-container uk-animation-fade uk-width-1-1@s uk-width-1-2@m uk-width-1-4@xl"> \
                <div class="uk-card uk-card-hover uk-card-default uk-card-small"> \
                    <div class="uk-card-header uk-clearfix"> \
                        <h5 class="uk-card-title uk-float-left">'+chartName+'</h5> \
                        <a class="btn-fullscreen uk-float-right grey-text fa fa-expand" title="Full Screen" uk-tooltip></a> \
                    </div> \
                    <div class="uk-card-body"> \
                        <div id="'+chartId+'" class="sm-chart"></div> \
                    </div> \
                </div> \
            </div>';
            $('#'+id).append(card);

            if (brandEquity.length === 0) {
                $('#'+chartId).html("<div class='uk-text-center'>No Data</div>");
            } else {
                var $colors=[], $series=[], $legend=[], $xval=[], $yval=[];
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
                var dom = document.getElementById(chartId);
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
                    color: data.colors,
                    title: {
                        show: false
                    },
                    legend: {
                        data: data.legend,
                        //padding: ['0', '0', '0', '0'],
                        x: 'left',
                        y: 'bottom'
                    },
                    grid: {
                        x: '30px',
                        x2: '10px',
                        y: '10px',
                        y2: '60px'
                    },
                    toolbox: {
                        show: true,
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
                        name: 'Net Sentiment',
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
                        min: xmin,
                        max: xmax
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
                        min: ymin,
                        max: ymax
                    },
                    series: data.series
                };

                clearTimeout(loadingTicket);
                loadingTicket = setTimeout(function (){
                    theChart.hideLoading();
                    theChart.setOption(option);
                    theChart.resize();
                },1800);
                $(window).on('resize', function(){
                    if(theChart != null && theChart != undefined){
                        theChart.resize();
                    }
                });
                $('.btn-fullscreen').on('click', function(e) {
                    $(this).closest('.sm-chart-container').toggleClass('sm-card-fullscreen').toggleClass('uk-animation-fade').toggleClass('uk-animation-scale-up');
                    $(this).toggleClass('fa-expand').toggleClass('fa-compress');
                    if(theChart != null && theChart != undefined){
                        theChart.resize();
                    }
                    e.preventDefault();
                });
            }
        }
    });
}