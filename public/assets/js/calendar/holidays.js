"use strict";
var basic_calendar = {
    init: function() {
        $('#cal-basic').fullCalendar({
            // defaultDate: '2016-06-12',
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicWeek,basicDay,list'
            },
            editable: true,
            selectable: true,
            selectHelper: true,
            droppable: true,
            eventLimit: true,
            eventClick: function(arg) { //edit option   
                getEventDetail(arg.id, arg.start, arg.end); 
            }, 
            events: "fetch_holidays_list",
            viewRender: function(view, element) {
                // console.log(view['title'])
                // console.log(view.title)
                addFilter(view.title);

            }
        });
    }
};

//View all option
function addFilter(date) {

    $.ajax({
        url:"fetch_holidays_list_date",
        type:"GET",
        data : {date: date},
        dataType : "JSON",
        success:function(response)
        {
            // console.log(response);
            $("#calendarList").html("");

            var options = [];
            var rData = [];
            rData = response;
            var html = '';

            $.each(rData, function (index, value) {   

                html += '<div class="lnb-calendars-item">';
                html += '<label style="background-color: transparent;">';
                html += '<input type="checkbox" class="tui-full-calendar-checkbox-round" value="' + value.id + '" checked="" data-original-title="" title="">';
                html += '<span class="kk" style="border-color: rgb(158, 95, 255); background-color: rgb(158, 95, 255);"></span>';
                html += '<span>' + value.occassion + '</span>';
                html += '</label>';
                html += '</div>';        
                options.push(html);                      
            });
                                 
            $("#calendarList").append(html);

        }               
        
    });  

    // $('#holidaysDetailModal').modal('show');
       
}

var getEventDetail = function (id, start, end) {
    // alert(start) //"2022-03-30T15:30:00Z"
    // alert(id)
    $("#holidays_show_id").val(id);
    
    //Get Holidays list
    $.ajax({
        url:"fetch_holidays_list_id",
        type:"GET",
        data : {id: id},
        dataType : "JSON",
        success:function(response)
        {
            // console.log(response); 
            $("#occassion_show_list").text('');
            $("#description_show_list").text('');
            $("#occassion_show_list").append(response[0].occassion);
            $("#description_show_list").append(response[0].description);                

        }               
        
    });  

    $('#holidaysDetailModalList').modal('show');
       
}


function convert(str) {
    var date = new Date(str),
    mnth = ("0" + (date.getMonth() + 1)).slice(-2),
    day = ("0" + date.getDate()).slice(-2);
    return [date.getFullYear(), mnth, day].join("-");
}

(function($) {
    "use strict";
    basic_calendar.init();    

})(jQuery);

