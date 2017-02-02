function ontologySample(div,domId,judul) {
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
    $.get('json/ontology.json', function (webkitDep) {
        //theChart.hideLoading();

        var option = {
            //color: ['#f00','#00f','#0f0'],
            legend: {
                data: ['A', 'B', 'C', 'D', 'E'],
                x: 'left',
                y: 'bottom',
            },
            grid: {
                x: 0,
                x2: 0,
                y: 0,
                y2: 0
            },
            series: [{
                type: 'graph',
                layout: 'force',
                roam: true,
                animation: false,
                label: {
                    normal: {
                        position: 'right',
                        formatter: '{b}'
                    }
                },
                draggable: true,
                data: webkitDep.nodes.map(function (node, idx) {
                    node.id = idx;
                    return node;
                }),
                categories: webkitDep.categories,
                force: {
                    initLayout: 'circular',
                    edgeLength: 5,
                    repulsion: 20,
                    gravity: 0.2
                },
                edges: webkitDep.links,
                itemStyle: {}
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
    });


}