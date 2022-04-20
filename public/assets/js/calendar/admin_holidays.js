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
            select: function(arg) {
                addHolidayModal(arg);
                $('#cal-basic').fullCalendar('unselect');
            },
            eventClick: function(arg) { //edit option   
                getEventDetail(arg.id, arg.start, arg.end); 
            }, 
            events: "fetch_holidays_list",
            // events: [
            //     {
            //         title: 'Event 1',
            //         start: '2022-05-01',
            //         school: '1'
            //     },-
            //     {
            //         title: 'Event 2',
            //         start: '2022-05-02',
            //         school: '2'
            //     },
            //     {
            //         title: 'Event 3',
            //         start: '2022-05-03',
            //         school: '1'
            //     },
            //     {
            //         title: 'Event 4',
            //         start: '2022-05-04',
            //         school: '2'
            //     }
            // ],
            eventRender: function eventRender( event, element, view ) {
                // console.log(view.title)
                // console.log(view)
                // console.log(element) 
                // alert($('.tui-full-calendar-checkbox-square:checked').val())
                return ['all', event.status].indexOf($('.tui-full-calendar-checkbox-square:checked').val()) >= 0
            },
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


// $('#school_selector').on('change',function(){
//     $('#cal-basic').fullCalendar('rerenderEvents');
// });


// $('#calendarList').on('change',function(){
//     $('#cal-basic').fullCalendar('rerenderEvents');
// });

// $('.tui-full-calendar-checkbox-round').on('click',function(){
//     var value = $(this).val(); 
//         alert(value)   
//     $('#cal-basic').fullCalendar('rerenderEvents');
// });

 //Filter Record

 $('#lnb-calendars').on('change','.tui-full-calendar-checkbox-round',function(){
    
    var value = $(this).val(); 
    
    // console.log(col0)   

    //remove old data
    // $('#cal-basic').fullCalendar('removeEvents');
    // var events= [
    //                 {
    //                     title: 'Event 1',
    //                     start: '2022-04-01',
    //                     school: '1'
    //                 },-
    //                 {
    //                     title: 'Event 2',
    //                     start: '2022-04-02',
    //                     school: '2'
    //                 },
    //                 {
    //                     title: 'Event 3',
    //                     start: '2022-05-03',
    //                     school: '1'
    //                 },
    //                 {
    //                     title: 'Event 4',
    //                     start: '2022-05-04',
    //                     school: '2'
    //                 }
    //             ];
                
    // //Getting new event json data
    // $("#cal-basic").fullCalendar('addEventSource', events);

    // var events = [ { id: '3', title  : 'event2', start  : '2022-04-02' } ];
    // console.log(events)
    // basic_calendar.fullCalendar('addEventSource', events);
    // basic_calendar.fullCalendar('refetchEvents');

    // var url = "{{route('fetch_holidays_list')}}";
    // // var employee = '';

    // basic_calendar.refetchEvents();
    //    url = url+'?date=' + value;

    // $('#cal-basic').fullCalendar('rerenderEvents');
  

});


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
            $("#occassion_show").text('');
            $("#description_show").text('');
            $("#occassion_show").append(response[0].occassion);
            $("#description_show").append(response[0].description);                

        }               
        
    });  

    $('#holidaysDetailModal').modal('show');
       
}

$('.delete-holidays').click(function(){
    var id = $("#holidays_show_id").val(); 
    $('#holidays_delete_id').val(id);                             
    $('#holidaysDeleteModal').modal('show');
});

function convert(str) {
    var date = new Date(str),
    mnth = ("0" + (date.getMonth() + 1)).slice(-2),
    day = ("0" + date.getDate()).slice(-2);
    return [date.getFullYear(), mnth, day].join("-");
}

function addHolidayModal(arg){
    var date = convert(arg);
    // alert("YES");
    $('#occassion_date').val(date);
    $('#add-holidays').modal('show');

}

//Save data
$('#getNewHolidaysForm').on('submit',function(event){
    event.preventDefault();

    var occassion_date = $('#occassion_date').val();
    // alert(occassion_date);  

    $.ajax({
        url:"add_new_holidays_insert",
        type:"POST",
        data:$("#getNewHolidaysForm").serialize(),
        dataType : "JSON",
        success:function(response)
        {
            
            $('#add-holidays').modal('hide');

            Toastify({
                text: "Added Sucessfully..!",
                duration: 3000,
                close:true,
                backgroundColor: "#4fbe87",
            }).showToast();

            window.location.reload();
                                                                    
        },
        error: function(response) {
            console.log(response.responseJSON.errors);
            $('#occassion_error').text(response.responseJSON.errors.occassion);

        }
        
    }); 

});

//Update Holidays data
$('#updateHolidaysForm').on('submit',function(event){
    event.preventDefault();
    // Get Alll Text Box Id's
    var occassion_edit = $('#occassion_edit').val();
    // alert(occassion_edit);  

    $.ajax({
        url: "holidays_update",
        type:"POST",
        data:$("#updateHolidaysForm").serialize(),
        dataType : "JSON",
        success:function(response)
        {
            
            $('#formHolidaysEditModal').modal('hide');

            Toastify({
                text: "Updated Sucessfully..!",
                duration: 3000,
                close:true,
                backgroundColor: "#4fbe87",
            }).showToast();

            window.location.reload();
                                                                    
        },
        error: function(response) {

            console.log(response.responseJSON.errors);                   

        }
        
    }); 

});

//Delete Holidays data
$('#formHolidaysDelete').on('submit',function(event){
    event.preventDefault();
    // Get Alll Text Box Id's
    var holidays_delete_id = $('#holidays_delete_id').val();
    // alert(holidays_delete_id);  

    $.ajax({
        url: "holidays_delete",
        type:"POST",
        data:$("#formHolidaysDelete").serialize(),
        dataType : "JSON",
        success:function(response)
        {
            
            $('#holidaysDeleteModal').modal('hide');

            Toastify({
                text: "Deleted Sucessfully..!",
                duration: 3000,
                close:true,
                backgroundColor: "#4fbe87",
            }).showToast();

            window.location.reload();
                                                                    
        },
        error: function(response) {

            console.log(response.responseJSON.errors);                   

        }
        
    }); 

});

//Edit Data
$('body').on('click','.edit-holidays',function(){
    // alert("edit");
    $('#holidaysDetailModal').modal('hide');
    var id = $("#holidays_show_id").val();     
    // alert(id)
    //Get Holidays list
    $.ajax({
        url:"fetch_holidays_list_id",
        type:"GET",
        data : {id: id},
        dataType : "JSON",
        success:function(response)
        {
            // console.log(response); 
            $("#occassion_edit").val(response[0].occassion);
            $("#description_edit").append(response[0].description);                

        }               
        
    });  

    $('#holidays_edit_id').val(id);                         
    $('#formHolidaysEditModal').modal('show');

});

(function($) {
    "use strict";
    basic_calendar.init();    

})(jQuery);

