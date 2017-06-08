function getTotalMedia(url, chartApiData) {
    $.ajax({
        method: "POST",
        url: url,
        data: chartApiData,
        beforeSend : function(xhr) {
        },
        complete : function(xhr, status) {
        },
        success: function(result){
            var result = jQuery.parseJSON(result);
            console.log(result);
            if (result.length === 0) {
            } else {
                var chartData = result.chartData;
                if (chartData.length > 0) {
                    for (var i = 0; i < chartData.length; i++) {
                        var name = chartData[i].name;
                        var total = chartData[i].total;
                        if(total != '') {
                            $('.totName').css('margin-top','-7px').addClass('uk-animation-slide-bottom-small');
                        }
                        // console.log(name);
                        switch (name) {
                            case 'Twitter':
                                $('#totBuzzTW').text(total);
                            break;
                            case 'Facebook':
                                $('#totBuzzFB').text(total);
                            break;
                            case 'News':
                                $('#totBuzzNews').text(total);
                            break;
                            case 'Blog':
                                $('#totBuzzBlog').text(total);
                            break;
                            case 'Forum':
                                $('#totBuzzForum').text(total);
                            break;
                            case 'Youtube':
                                $('#totBuzzVid').text(total);
                            break;
                            case 'Instagram':
                                $('#totBuzzIG').text(total);
                            break;
                        }
                    }
                }
            }
        },
        error: function(xhr, status){
        }
    });
}
