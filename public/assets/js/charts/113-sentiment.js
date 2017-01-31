function chart113(id) {
    $.ajax({
        url: 'json/113-sentiment.json',
        //dataType: 'jsonp',
        success: function(result){
            var chartId = result.chartId;
            var chartName = result.chartName;
            var sentiment = result.sentiment;



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

            if (sentiment.length === 0) {
                $('#'+chartId).html("<div class='center'>No Data</div>");
            } else {
                var $series=[], $legend=[], $color=[], $key=[];
                for (var i = 0; i < sentiment.length; i++) {
                    $legend[i] = sentiment[i].name;
                    $color[i] = sentiment[i].color;
                    $data = sentiment[i].data;
                    for (var n = 0; n < $data.length; n++) {
                        $key[n] = $data[n][0];
                    }

                    $series[i] = {
                        name: sentiment[i].name,
                        type:'bar',
                        stack: 'sentiment',
                        barMaxWidth: 50,
                        itemStyle : { normal: {label : {show: false, position: 'insideRight'}}},
                        data: $data
                    }
                }

                var data = {
                    name: $legend,
                    color: $color,
                    cat: $key,
                    //series: $series
                }


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
                    tooltip : {
                        trigger: 'axis',
                        axisPointer : {
                            type : 'shadow'
                        }
                    },
                    color: data.color,
                    legend: {
                        data: data.name,
                        x: 'left',
                        y: 'bottom',
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
                                show: true,
                                type: ['stack', 'tiled'],
                                title: {stack: 'Stack', tiled: 'Bar'},
                            },
                            restore: {show: true, title: 'Reload'},
                            saveAsImage: {show: true, title: 'Save'}
                        }
                    },
                    calculable : true,
                    xAxis : [
                        {
                            type : 'category',
                            data : data.cat,
                            axisLabel: {
                                textStyle: {
                                    fontSize: 10
                                }
                            }
                        }
                    ],
                    yAxis : [
                        {
                            type : 'value',
                            axisLabel: {
                                textStyle: {
                                    fontSize: 10
                                },
                                formatter: function (v) {
                                    $v = numeral(v).format('0a');
                                    return $v;
                                }
                            },
                        }
                    ],
                    series : $series
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