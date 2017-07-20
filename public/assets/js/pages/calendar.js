function calendar(div) {
    var now = new Date();

    $.ajax({
        // url: baseUrl+'/json/calendar.json',
        url: baseUrl+'/engagement/get-calendar',
        dataType: 'json',
        success: function(result){
            // console.log(result);
            var data = result.data;

            var id=[],title=[],date=[],channel=[],attachment=[],dataset=[];
            for (var i = 0; i < data.length; i++) {
                id[i] = data[i].id;
                title[i] = data[i].title;
                channel[i] = data[i].chanel;
                attachment[i] = data[i].attachment;
                date[i] = moment(data[i].date).local().format('YYYY-MM-DD HH:mm:ss');
                dataset[i] = {"id":id[i],"title":title[i],"date":date[i],"channel":channel[i],"attachment":attachment[i]};
            }
            // console.log(data);
            // console.log(dataset);
            // if (data.length === 0) {
                // $('#'+div).html("<div class='center'>No Data</div>");
            // } else {
            $('#'+div).fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay'
                },
                defaultDate: now,
                navLinks: true, // can click day/week names to navigate views
                editable: false,
                eventLimit: true, // allow "more" link when too many
                events: dataset
            });
            // }

        }
    });
}
