function wordcloud(domId, url, chartApiData, name) {
    $.ajax({
        method: "POST",
        url: url,
        data: chartApiData,
        beforeSend : function(xhr) {
            $('#'+domId).append(cardloader);
        },
        complete : function(xhr, status) {
            $('#'+domId+' .cardloader').remove();
        },
        success: function(result){
            var result = jQuery.parseJSON(result);
            // console.log(result.length);
            if (result.length === 0) {
                $('#'+domId).html(cardEmpty);
            } else {
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
                            + '<div id="'+chartId+'" class="sm-chart sm-wordcloud"></div>'
                        + '</div>'
                    + '</div>'
                + '</div>';
                $('#'+domId).append(card);

                if (chartData.length > 0) {
                    var series=[], words=[];
                    for (var i = 0; i < chartData.length; i++) {
                        series[i] = {
                            name: chartData[i].key,
                            value: chartData[i].value,
                            link: chartData[i].link,
                            textStyle: {
                                normal: {
                                    color: chartData[i].color
                                }
                            }
                        }
                        words[i] = {
                            text: chartData[i].key,
                            weight: chartData[i].value,
                            color: chartData[i].color
                        }
                    }
                    //
                    // $('#'+chartId).jQCloud(words, {
                    //     autoResize: true,
                    //     fontSize: {
                    //         from: 0.1,
                    //         to: 0.025
                    //     }
                    // });
                    // $('#'+chartId)
                    // .on('click','span',function(e){
                    //     //var pageUrl = $(location).attr('href')+'?';
                    //     var pageUrl = window.location.origin + window.location.pathname + '?';
                    //     var txt = $(this).text();
                    //     window.location.href = pageUrl+'text='+txt;
                    // })
                    // .on('contextmenu','span',function(e){
                    //     $(this).hide();
                    //     $('.unhideWord').removeClass('uk-hidden');
                    // });
                    //
                    // var btnUnhide = '<li class="unhideWord uk-hidden"><a class="green-text sm-text-bold uk-text-small">SHOW ALL</a></li>';
                    // $('#'+chartId).parent().parent().find('ul').prepend(btnUnhide);
                    // $('.unhideWord').on('click',function(e){
                    //     $('#'+chartId+' span').show();
                    //     $(this).addClass('uk-hidden');
                    // });

                    // if using echarts wordcloud
                    //CHART
                    var domchart = document.getElementById(chartId);
                    var theme = 'default';
                    var theChart = echarts.init(domchart,theme);
                    var loadingTicket;

                    theChart.showLoading({
                        text : '',
                    });

                    var option = {
                        title: {
                            text: chartName.toUpperCase(),
                            left: '10px',
                            top: '10px',
                        },
                        backgroundColor: '#ffffff',
                        grid: {
                            x: '15px',
                            x2: '15px',
                            y: '50px',
                            y2: '75px'
                        },
                        toolbox: {
                            show: false
                        },
                        series: [{
                            name: chartName,
                            type: 'wordCloud',
                            size: ['100%', '100%'],
                            textPadding: 10,
                            sizeRange: [10, 60],
                            rotationRange: [-90, 90],
                            rotationStep: 10,
                            gridSize: 8,
                            data: series
                        }]
                    };

                    clearTimeout(loadingTicket);
                    loadingTicket = setTimeout(function (){
                        theChart.hideLoading();
                        theChart.setOption(option);
                        theChart.resize();

                        setTimeout(function() {
                            var imgUrl = theChart.getConnectedDataURL({
                                type: 'png',
                                backgroundColor: '#fff',
                                excludeComponents: ["toolbox"],
                                pixelRatio: 1
                            });
                            //console.log(imgUrl);
                            $('#report-form').append('<input type="hidden" name="'+domId+'" value="'+imgUrl+'" />');
                        }, 2000);

                    }, 2000);

                    $(window).on('resize', function(){
                        if(theChart != null && theChart != undefined){
                            theChart.resize();
                        }
                    });
                    // var url = $(location).attr('href')+'?';
                    // theChart.on('click', function (param) {
                    //     window.location.href = url+'&'+param.data.link;
                    // });

                } else {
                    $('.sm-wordcloud').html(msgEmpty);
                }
            }
        },
        error: function(xhr, status){
            $('#'+domId).html(cardEmpty);
        }
    });
}
