function wordcloud(domId, url, chartApiData, name) {
    var xxx=0;
    $.ajax({
        method: "POST",
        url: url,
        data: chartApiData,
        beforeSend : function(xhr) {
            var cardloader = '<div class="cardloader sm-chart-container uk-animation-fade">'
                + '<div class="uk-card uk-card-small">'
                    + '<div class="uk-card-header uk-clearfix">'
                        + '<h5 class="uk-card-title uk-float-left"></h5>'
                    + '</div>'
                    + '<div class="uk-card-body">'
                        + '<div class="sm-chart"><div class="uk-position-center" uk-spinner></div></div>'
                    + '</div>'
                + '</div>'
            + '</div>';
            $('#'+domId).append(cardloader);
            xxx++;
        },
        complete : function(xhr, status) {
            xxx--;
            if (xxx <= 0) {
                $('.cardloader').remove();
            }
        },
        success: function(result){
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

            var card = '<div class="sm-chart-container uk-animation-fade">'
                + '<div class="uk-card uk-card-hover uk-card-default uk-card-small">'
                    + '<div class="uk-card-header uk-clearfix">'
                        + '<h5 class="uk-card-title uk-float-left">'+chartTitle+'</h5>'
                        + '<ul class="uk-float-right uk-subnav uk-margin-remove">'
                            + '<li><a class="grey-text fa fa-info-circle" title="'+chartInfo+'" uk-tooltip></a></li>'
                            + '<li><a onclick="hideThis(this)" class="grey-text fa fa-eye-slash" title="Hide This" uk-tooltip></a></li>'
                            + '<li><a onclick="fullscreen(this)" class="grey-text fa fa-expand" title="Full Screen" uk-tooltip></a></li>'
                        + '</ul>'
                    + '</div>'
                    + '<div class="uk-card-body">'
                        + '<div id="'+chartId+'" class="sm-chart"></div>'
                    + '</div>'
                + '</div>'
            + '</div>';
            $('#'+domId).append(card);

            if (chartData.length === 0) {
                $('#'+chartId).html('<div class="uk-position-center uk-text-center">No Data!</div>');
            } else {
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
                        html: {
                            class: 'uk-button uk-button-text uk-text-lowercase',
                            title: 'click to search this word'
                        },
                        color: chartData[i].color
                    }
                }
                $('#'+chartId).jQCloud(words, {
                    autoResize: true,
                    fontSize: {
                        from: 0.1,
                        to: 0.025
                    }
                });
                $('#'+chartId)
                .on('click','span',function(e){
                    //var pageUrl = $(location).attr('href')+'?';
                    var pageUrl = window.location.origin + window.location.pathname + '?';
                    var txt = $(this).text();
                    window.location.href = pageUrl+'text='+txt;
                })
                .on('contextmenu','span',function(e){
                    $(this).hide();
                    $('.unhideWord').removeClass('uk-hidden');
                });

                var btnUnhide = '<li class="unhideWord uk-hidden"><a class="green-text sm-text-bold uk-text-small">SHOW ALL</a></li>';
                $('#'+chartId).parent().parent().find('ul').prepend(btnUnhide);
                $('.unhideWord').on('click',function(e){
                    $('#'+chartId+' span').show();
                    $(this).addClass('uk-hidden');
                });

                /* if using echarts' wordcloud
                //CHART
                var domchart = document.getElementById(chartId);
                var theme = 'default';
                var theChart = echarts.init(domchart);
                var loadingTicket;
                var effectIndex = -1;
                var effect = ['spin'];

                theChart.showLoading({
                    text : '',
                });

                var option = {
                    tooltip: {
                        show: true,
                        formatter: '{b}: {c}'
                    },
                    grid: {
                        x: '0',
                        x2: '0',
                        y: '0',
                        y2: '0'
                    },
                    toolbox: {
                        show: true,
                        x: 'right',
                        y: 'bottom',
                        padding: ['0', '0', '0', '0'],
                        feature: {
                            mark: {
                                show: true
                            },
                            restore: {show: true, title: 'Reload'},
                            saveAsImage: {show: true, title: 'Save'}
                        }
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
                },1200);
                $(window).on('resize', function(){
                    if(theChart != null && theChart != undefined){
                        theChart.resize();
                    }
                });
                var url = $(location).attr('href')+'?';
                theChart.on('click', function (param) {
                    window.location.href = url+'&'+param.data.link;
                });
                */
            }
        }
    });
}