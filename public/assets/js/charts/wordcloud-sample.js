function wordCloudSample(div,domId,judul) {
    var card = '<div id="'+domId+'" class="sm-chart-container uk-animation-fade"> \
        <div class="uk-card uk-card-hover uk-card-default uk-card-small"> \
            <div class="uk-card-header uk-clearfix"> \
                <h5 class="uk-card-title uk-float-left">'+judul+'</h5> \
                <ul class="uk-float-right uk-subnav uk-margin-remove"> \
                    <li><a class="grey-text fa fa-info-circle" title="Short text information about '+judul+'" uk-tooltip></a></li> \
                    <li><a onclick="hideThis(this)" class="grey-text fa fa-eye-slash" title="Hide This" uk-tooltip></a></li> \
                    <li><a onclick="fullscreen(this)" class="grey-text fa fa-expand" title="Full Screen" uk-tooltip></a></li> \
                </ul> \
            </div> \
            <div class="uk-card-body"> \
                <div id="'+domId+'Chart" class="sm-chart"></div> \
            </div> \
        </div> \
    </div>';
    $('#'+div).append(card);

    //CHART
    var dom = document.getElementById(domId+'Chart');
    var theme = 'default';
    var theChart = echarts.init(dom);
    var loadingTicket;
    var effectIndex = -1;
    var effect = ['spin'];

    theChart.showLoading({
        text : '',
    });

    function createRandomItemStyle() {
        return {
            normal: {
                color: 'rgb(' + [
                    Math.round(Math.random() * 160),
                    Math.round(Math.random() * 160),
                    Math.round(Math.random() * 160)
                ].join(',') + ')'
            }
        };
    }

    var option = {
        tooltip: {
            show: true
        },
        series: [{
            name: 'Trends',
            type: 'wordCloud',
            size: ['80%', '80%'],
            textRotation : [0, 45, 90, -45],
            textPadding: 0,
            autoSize: {
                enable: true,
                minSize: 12
            },
            data: [
                {
                    name: "Sam S Club",
                    value: 10000,
                    itemStyle: {
                        normal: {
                            color: 'black'
                        }
                    }
                },
                {
                    name: "Macys",
                    value: 6181,
                    itemStyle: createRandomItemStyle()
                },
                {
                    name: "Amy Schumer",
                    value: 4386,
                    itemStyle: createRandomItemStyle()
                },
                {
                    name: "Jurassic World",
                    value: 4055,
                    itemStyle: createRandomItemStyle()
                },
                {
                    name: "Charter Communications",
                    value: 2467,
                    itemStyle: createRandomItemStyle()
                },
                {
                    name: "Chick Fil A",
                    value: 2244,
                    itemStyle: createRandomItemStyle()
                },
                {
                    name: "Planet Fitness",
                    value: 1898,
                    itemStyle: createRandomItemStyle()
                },
                {
                    name: "Pitch Perfect",
                    value: 1484,
                    itemStyle: createRandomItemStyle()
                },
                {
                    name: "Express",
                    value: 1112,
                    itemStyle: createRandomItemStyle()
                },
                {
                    name: "Home",
                    value: 965,
                    itemStyle: createRandomItemStyle()
                },
                {
                    name: "Johnny Depp",
                    value: 847,
                    itemStyle: createRandomItemStyle()
                },
                {
                    name: "Lena Dunham",
                    value: 582,
                    itemStyle: createRandomItemStyle()
                },
                {
                    name: "Lewis Hamilton",
                    value: 555,
                    itemStyle: createRandomItemStyle()
                },
                {
                    name: "KXAN",
                    value: 550,
                    itemStyle: createRandomItemStyle()
                },
                {
                    name: "Mary Ellen Mark",
                    value: 462,
                    itemStyle: createRandomItemStyle()
                },
                {
                    name: "Farrah Abraham",
                    value: 366,
                    itemStyle: createRandomItemStyle()
                },
                {
                    name: "Rita Ora",
                    value: 360,
                    itemStyle: createRandomItemStyle()
                },
                {
                    name: "Serena Williams",
                    value: 282,
                    itemStyle: createRandomItemStyle()
                },
                {
                    name: "NCAA baseball tournament",
                    value: 273,
                    itemStyle: createRandomItemStyle()
                },
                {
                    name: "Point Break",
                    value: 265,
                    itemStyle: createRandomItemStyle()
                }
            ]
        }]
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


}