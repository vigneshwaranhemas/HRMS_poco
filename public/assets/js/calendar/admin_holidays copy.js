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
            $("#state_show").text('');
            $("#occassion_file_show").text('');
            $("#occassion_show").append(response[0].occassion);
            $("#description_show").append(response[0].description);  
            $("#state_show").append(response[0].state);  
            
            var file = response[0].occassion_file;
            var ext = file.split('.')[1];    
            // alert(ext);
            if(ext=="jpg" || ext=="PNG" || ext=="png" || ext=="jpeg" || ext=="gif") {
                // alert("one");
                // var link = object[i].Value;

                var image = '<img onclick=sample_popup_viewer("'+file+'") class="img-sm image-layer-item image-size"   src="../../holidays_file/'+file+'" style="cursor:pointer;width: 400px;height: 200px;">';
                // row.append($('<td>').html(image));
                $("#occassion_file_show").append(image);  
               
            }else if (ext=="pdf"|| ext=="doc" || ext=="docx" || ext=="xlsx" || ext=="csv"){
               
                var file = '<a href="/file_upload/'+file+'"  style="color:white;"  download><div class="badge bg-danger">'+file+'</div></a>';
                $("#occassion_file_show").append(file);  

            }else if(ext=="mp4") {

                var video = '';            
                video += '<video width="320" height="240" controls>';
                video += '<source src="../../holidays_file/'+file+'" type="video/ogg">';
                video += '</video>';

                $("#occassion_file_show").append(video);  
               
            }else{
                $("#occassion_file_show").append(" ");
            }

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
    $('#occassion_error').html("");
    $('#occassion_file_error').html("");
    $('#state_error').html("");
    
    var files = $('#occassion_file')[0].files;
    var fd = new FormData();
    // Append data 
    fd.append('occassion',$('#occassion').val());
    fd.append('description',$('#description').val());
    fd.append('state',$('#state').val());
    fd.append('occassion_date',$('#occassion_date').val());
    fd.append('occassion_file',files[0]);
    // console.log(fd)
    $.ajax({
        url:"add_new_holidays_insert",
        type:"POST",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
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
            $('#occassion_file_error').text(response.responseJSON.errors.occassion_file);
            $('#state_error').text(response.responseJSON.errors.state);
        }        
    }); 

});


$('#holidays_state_filter').change(function () {
    // alert(this.value)
    var state = this.value;
     var url = "fetch_holidays_list";
    var fil = url+'?state=' + state;
    $('#cal-basic').fullCalendar('refetchEvents', fil);    
   
});

//Update Holidays data
$('#updateHolidaysForm').on('submit',function(event){
    event.preventDefault();
    // Get Alll Text Box Id's
    var files = $('#occassion_file_edit')[0].files;
    var fd = new FormData();
    // Append data 
    fd.append('occassion',$('#occassion_edit').val());
    fd.append('description',$('#description_edit').val());
    fd.append('state',$('#state_edit').val());
    fd.append('id',$('#holidays_edit_id').val());
    fd.append('occassion_file',files[0]);
    // console.log(fd)

    $.ajax({
        url: "holidays_update",
        type:"POST",
        data: fd,
        cache: false,
        processData: false,
        contentType: false,
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

    //Get State list
    $.ajax({
        url:"fetch_holidays_state_id",
        type:"GET",
        data : { id: id },
        dataType : "JSON",
        cache: false,
        processData:true, 
        success:function(response)
        {
            // console.log(response); 
            $("#state_edit").html(response);           
          
        },
        error: function(error){
            console.log(error); 

        }
        
    });

    //Get Holidays list
    $.ajax({
        url:"fetch_holidays_list_id",
        type:"GET",
        data : { id: id },
        dataType : "JSON",
        success:function(response)
        {
            // console.log(response); 
            $("#occassion_edit").val(response[0].occassion);
            $("#description_edit").append(response[0].description);  
            $("#occassion_file_edit_show").text("");

            var file = response[0].occassion_file;
            var ext = file.split('.')[1];    
            // alert(ext);
            if(ext=="jpg" || ext=="PNG" || ext=="png" || ext=="jpeg" || ext=="gif") {
                // alert("one");
                // var link = object[i].Value;

                var image = '<img onclick=sample_popup_viewer("'+file+'") class="img-sm rounded-circle image-layer-item image-size"   src="../../holidays_file/'+file+'" style="cursor:pointer;width: 37px;height: 35px;">';
                // row.append($('<td>').html(image));
                $("#occassion_file_edit_show").append(image);  
               
            }else if (ext=="pdf"|| ext=="doc" || ext=="docx" || ext=="xlsx" || ext=="csv"){
               
                var file = '<a href="/file_upload/'+file+'"  style="color:white;"  download><div class="badge bg-danger">'+file+'</div></a>';
                $("#occassion_file_edit_show").append(file);  

            }else{

                $("#occassion_file_edit_show").append(" ");  

            }
          

        }               
        
    });  

    $('#holidays_edit_id').val(id);                         
    $('#formHolidaysEditModal').modal('show');

});

(function($) {
    "use strict";
    basic_calendar.init();    

})(jQuery);

