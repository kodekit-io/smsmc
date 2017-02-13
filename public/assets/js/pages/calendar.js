function calendar(div) {
    var now = new Date();

    $.ajax({
        url: 'json/calendar.json',
        //dataType: 'jsonp',
        success: function(result){
            var data = result.data;
            if (data.length === 0) {
                $('#'+div).html("<div class='center'>No Data</div>");
            } else {
                $('#'+div).fullCalendar({
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,basicWeek,basicDay'
                    },
                    defaultDate: now,
                    navLinks: true, // can click day/week names to navigate views
                    editable: true,
                    eventLimit: true, // allow "more" link when too many
                    events: data
                });
            }
        }
    });
}