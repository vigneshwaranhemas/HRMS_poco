"use strict";
var basic_calendar = {
    init: function() {
        $('#cal-basic').fullCalendar({
            // defaultDate: '2016-06-12',
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicWeek,basicDay,listWeek'
            },
            editable: true,
            selectable: true,
            selectHelper: true,
            droppable: true,
            eventLimit: true,
            select: function(arg) {
                // alert(arg)
                addEventModal(arg); //Fri Apr 08 2022 00:00:00 GMT+0000
                // $('#cal-basic').fullCalendar('unselect');
            },
            events: "fetch_all_event",  
            eventClick: function(arg) { //edit option              
                console.log(arg);
                getEventDetail(arg.id, arg.start, arg.end); 
            },          
        });
            

    }
};

//Save data
$('#getNewEventForm').on('submit',function(event){
    event.preventDefault();
    // Get Alll Text Box Id's
    var category_name = $('#category_id').val();
    // alert(category_name);  

    $.ajax({
        url:"add_new_event_insert",
        type:"POST",
        data:$("#getNewEventForm").serialize(),
        dataType : "JSON",
        success:function(response)
        {
            
            $('#add-event').modal('hide');

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
            $('#event_name_error').text(response.responseJSON.errors.event_name);
            $('#where_error').text(response.responseJSON.errors.where);
            $('#description_error').text(response.responseJSON.errors.description);
            $('#candicate_list_options_error').text(response.responseJSON.errors.candicate_list_options);
            $('#end_time_error').text(response.responseJSON.errors.end_time);
            $('#start_date_error').text(response.responseJSON.errors.start_date);
            $('#start_time_error').text(response.responseJSON.errors.start_time);
            $('#end_date_error').text(response.responseJSON.errors.end_date);
            $('#category_name_sel_error').text(response.responseJSON.errors.category_name);
            $('#event_type_sel_error').text(response.responseJSON.errors.event_type);

        }
        
    }); 

});

function addEventModal(arg){  
    
    if(arg){
        
        var sd = new Date(arg); //getting date from select list like Thu Apr 07 2022 05:30:00 GMT+0530 (India Standard Time)   
        var momemtFormat = "DD-MM-YYYY"; //DD-MM-YYYY
        if(momemtFormat!= null ){
            var mDate = moment(sd).format("DD-MM-YYYY");
            // alert(mDate)
        }
        var curr_date = sd.getDate();
        if(curr_date < 10){
            curr_date = '0'+curr_date;
        }
        var curr_month = sd.getMonth();
        curr_month = curr_month+1;
        if(curr_month < 10){
            curr_month = '0'+curr_month;
        }
        var curr_year = sd.getFullYear();
        var fDate = moment(sd).format("YYYY-MM-DD");
        $('#start_date').val(fDate);

        var ed = new Date(arg);
        var curr_date = sd.getDate();
        if(curr_date < 10){
            curr_date = '0'+curr_date;
        }
        var curr_month = sd.getMonth();
        curr_month = curr_month+1;
        if(curr_month < 10){
            curr_month = '0'+curr_month;
        }
        var curr_year = ed.getFullYear();
        $('#end_date').val(fDate);

    }

    var d = new Date();
    var n = d.toLocaleString([], { hour: '2-digit', minute: '2-digit' });

    $('#start_time').val(n);
    $('#end_time').val(n);
    
    //Get category list
    $.ajax({
        url:"fetch_event_category_all",
        type:"GET",
        dataType : "JSON",
        success:function(response)
        {
            // console.log(response);
                               
            var options = [];
            var rData = [];
            rData = response;
            var selectData = '';
            selectData = '<option value="" selected>Select Category...</option>';
            options.push(selectData); 
            $.each(rData, function (index, value) {
                selectData = '<option value="' + value.category_name + '">' + value.category_name + '</option>';
                options.push(selectData);                      
            });

            $('#category_id' ).html(options);                      
                                
        }
       
        
    }); 

    //Get event type list
    $.ajax({
        url:"fetch_event_type_all",
        type:"GET",
        dataType : "JSON",
        success:function(response)
        {
            // console.log(response);
                               
            var options = [];
            var rData = [];
            rData = response;
            var selectData = '';
            selectData = '<option value="" selected>Please Select Event Type</option>';
            options.push(selectData); 
            $.each(rData, function (index, value) {                        
                selectData = '<option value="' + value.event_type + '">' + value.event_type + '</option>';
                options.push(selectData);                      
            });

            $('#event_type_id' ).html(options);                      
                                
        }
       
        
    }); 

    // $('#colorselector').colorselector();
    
    $('#add-event').modal('show');

}

var getEventDetail = function (id, start, end) {
    // alert(start) "2022-03-30T15:30:00Z"
    // alert(id)
    $("#event_edit_id").val(id);
    
    //Get Attendees list
    $.ajax({
        url:"fetch_event_attendees_show",
        type:"GET",
        data : {id: id},
        dataType : "JSON",
        success:function(response)
        {
            // console.log(response);     
            $("#candicate_list_show").html(response);

        }               
        
    });  

    //Get category list
    $.ajax({
        url:"fetch_event_edit",
        type:"GET",
        data : {id: id},
        dataType : "JSON",
        success:function(response)
        {
            // console.log(response);                                                                                                    
            var rData = [];
            rData = response;                   
            $.each(rData, function (index, value) {
                                                                                                                                      
                $("#event_name_show").html(value.event_name);
                $("#where_show").html(value.where);
                $("#description_show").html(value.description);
                $("#category_name_show").html(value.category_name);
                $("#event_type_show").html(value.event_type);
                
                // var candicate_list = JSON.parse(value.candicate_list);
                // console.log(candicate_list.length);

                var start_date_time = value.start_date_time;
                var split = start_date_time.split(" ");

                const timeString = split[1];
                // Prepend any date. Use your birthday.
                const timeString12hr = new Date('1970-01-01T' + timeString + 'Z')
                .toLocaleTimeString('en-US',
                    {timeZone:'UTC',hour12:true,hour:'numeric',minute:'numeric'}
                );

                // console.log();
                $("#start_date_show").html(split[0]);
                $("#start_time_show").html(timeString12hr);

                var end_date_time = value.end_date_time;
                var split = end_date_time.split(" ");

                const timeString_end = split[1];
                // Prepend any date. Use your birthday.
                const timeString12hr_end = new Date('1970-01-01T' + timeString_end + 'Z')
                .toLocaleTimeString('en-US',
                    {timeZone:'UTC',hour12:true,hour:'numeric',minute:'numeric'}
                );

                // console.log();
                $("#end_date_show").html(split[0]);
                $("#end_time_show").html(timeString12hr_end);

            });
                                
        }
       
        
    }); 

    $('#eventDetailModal').modal('show');


}


$('.delete-event').click(function(){
    var id = $("#event_edit_id").val(); 
    $('#event_delete_id').val(id);                             
    $('#eventDeleteModal').modal('show');
});

//Delete Holidays data
$('#formEventsDelete').on('submit',function(event){
    event.preventDefault();
    // Get Alll Text Box Id's
    var event_delete_id = $('#event_delete_id').val();
    // alert(event_delete_id);  

    $.ajax({
        url: "event_delete",
        type:"POST",
        data:$("#formEventsDelete").serialize(),
        dataType : "JSON",
        success:function(response)
        {
            
            $('#eventDeleteModal').modal('hide');

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


// function addEventModal(start, end, allDay){
//     if(start){
        
//         var sd = new Date(start); //getting date from select list
//         // alert(sd)
//         var momemtFormat = "DD-MM-YYYY"; //DD-MM-YYYY
//         if(momemtFormat!= null ){
//             var mDate = moment(sd).format("DD-MM-YYYY");
//         }
//         var curr_date = sd.getDate();
//         if(curr_date < 10){
//             curr_date = '0'+curr_date;
//         }
//         var curr_month = sd.getMonth();
//         curr_month = curr_month+1;
//         if(curr_month < 10){
//             curr_month = '0'+curr_month;
//         }
//         var curr_year = sd.getFullYear();
//         var fDate = moment(sd).format("YYYY-MM-DD");
//         $('#start_date').val(fDate);

//         var ed = new Date(start);
//         var curr_date = sd.getDate();
//         if(curr_date < 10){
//             curr_date = '0'+curr_date;
//         }
//         var curr_month = sd.getMonth();
//         curr_month = curr_month+1;
//         if(curr_month < 10){
//             curr_month = '0'+curr_month;
//         }
//         var curr_year = ed.getFullYear();
//         $('#end_date').val(fDate);

//     }

//     var d = new Date();
//     var n = d.toLocaleString([], { hour: '2-digit', minute: '2-digit' });

//     $('#start_time').val(n);
//     $('#end_time').val(n);
    
//     //Get category list
//     $.ajax({
//         url:"{{ ('fetch_event_category_all') }}",
//         type:"GET",
//         dataType : "JSON",
//         success:function(response)
//         {
//             console.log(response);
                               
//             var options = [];
//             var rData = [];
//             rData = response;
//             var selectData = '';
//             selectData = '<option value="" selected>Select Category...</option>';
//             options.push(selectData); 
//             $.each(rData, function (index, value) {
//                 selectData = '<option value="' + value.category_name + '">' + value.category_name + '</option>';
//                 options.push(selectData);                      
//             });

//             $('#category_id' ).html(options);                      
                                
//         }
       
        
//     }); 

//     //Get event type list
//     $.ajax({
//         url:"{{ ('fetch_event_type_all') }}",
//         type:"GET",
//         dataType : "JSON",
//         success:function(response)
//         {
//             console.log(response);
                               
//             var options = [];
//             var rData = [];
//             rData = response;
//             var selectData = '';
//             selectData = '<option value="" selected>Please Select Event Type</option>';
//             options.push(selectData); 
//             $.each(rData, function (index, value) {                        
//                 selectData = '<option value="' + value.event_type + '">' + value.event_type + '</option>';
//                 options.push(selectData);                      
//             });

//             $('#event_type_id' ).html(options);                      
                                
//         }
       
        
//     }); 

//     // $('#colorselector').colorselector();
    
//     $('#add-event').modal('show');

// }

function formatAMPM(date) {
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var ampm = hours >= 12 ? 'pm' : 'am';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0'+minutes : minutes;
    var strTime = hours + ':' + minutes + ' ' + ampm;
    return strTime;
}     

// console.log(formatAMPM(new Date));

$('#repeat-event').change(function () {
    if($(this).is(':checked')){
        $('#repeat-fields').show();
    }
    else{
        $('#repeat-fields').hide();
    }
});

$('#repeat-event-edit').change(function () {
    if($(this).is(':checked')){
        $('#repeat-fields-edit').show();
    }
    else{
        $('#repeat-fields-edit').hide();
    }
});

$('.add_category').click(function () {
    $.ajax({
        url:"fetch_event_category_all",
        type:"GET",
        dataType : "JSON",
        success:function(response)
        {
            // console.log(response);
                                                  
            var rData = [];
            let listData = "";
            rData = response;
            $.each(rData, function (index, value) {                        
                listData += '<tr>'+
                    '<td>'+(index+1)+'</td>'+
                    '<td>' + value.category_name + '</td>'+
                    '<td><a href="javascript:;" data-cat-id="' + value.id + '" class="btn btn-sm btn-danger btn-rounded delete-category">Remove</a></td>'+
                    '</tr>';
            });

            $('.category-table tbody' ).html(listData);                      
                                
        }
       
        
    }); 

    $('#add-category-modal').modal('show');
});        


$('.createEventType').click(function () {
    
    $.ajax({
        url:"fetch_event_type_all",
        type:"GET",
        dataType : "JSON",
        success:function(response)
        {
            // console.log(response);
                                                
            var rData = [];
            let listData = "";
            rData = response;
            $.each(rData, function (index, value) {                        
                listData += '<tr>'+
                    '<td>'+(index+1)+'</td>'+
                    '<td>' + value.event_type + '</td>'+
                    '<td><a href="javascript:;" data-cat-id="' + value.id + '" class="btn btn-sm btn-danger btn-rounded delete-event-type">Remove</a></td>'+
                    '</tr>';
            });

            $('.event-type-table tbody' ).html(listData);                      
                                
        }    
        
    }); 

    $('#event-type-modal').modal('show');
});

// save new category
$("#submit_event_category").on('click',()=>{
    var category_name=$("#category_name").val();
    // alert(category_name);
    // console.log($("#eventCategoryForm").serialize())
    $.ajax({
        url:"event_category_insert",
        type:"POST",
        // data:$("#eventCategoryForm").serialize(),
        data:{category_name:category_name},
        dataType : "JSON",
        success:function(response)
        {
            console.log(response);                                   
            $('#category_name_error').text(" ");

            Toastify({
                text: "Added Sucessfully..!",
                duration: 3000,
                close:true,
                backgroundColor: "#4fbe87",
            }).showToast();

            var options = [];
            var rData = [];
            let listData = "";
            rData = response;
            var selectData = '';
            selectData = '<option value="" selected>Select Category...</option>';
            options.push(selectData); 
            $.each(rData, function (index, value) {
                selectData = '<option value="' + value.category_name + '">' + value.category_name + '</option>';
                options.push(selectData);
                listData += '<tr>'+
                    '<td>'+(index+1)+'</td>'+
                    '<td>' + value.category_name + '</td>'+
                    '<td><a href="javascript:;" data-cat-id="' + value.id + '" class="btn btn-sm btn-danger btn-rounded delete-category">Remove</a></td>'+
                    '</tr>';
            });

            $('.category-table tbody' ).html(listData);

            // $('#category_add').html(options);
            $('#category_name').val(' ');                    
            $('#category_id').html(options);
            $('#category_id_edit').html(options);
                                                                    
        },
        error: function(response) {
            console.log(response.responseJSON.errors.category_name);
            $('#category_name_error').text(response.responseJSON.errors.category_name);

        }
        
    }); 

    return false;        
});

// save new category
$("#submit_event_type").on('click', function(){
    
    var event_type = $('#event_type').val();
    // alert(event_type);  

    $.ajax({
        url:"event_type_insert",
        type:"POST",
        data:{event_type: event_type},
        // data:$("#eventTypeForm").serialize(),
        dataType : "JSON",
        success:function(response)
        {
            console.log(response);                                   
            $('#event_type_error').text(" ");

            Toastify({
                text: "Added Sucessfully..!",
                // duration: 3000,
                close:true,
                backgroundColor: "#4fbe87",
            }).showToast();

            var options = [];
            var rData = [];
            let listData = "";
            rData = response;
            var selectData = '';
            selectData = '<option value="" selected>Please Select Event Type</option>';
            options.push(selectData); 
            $.each(rData, function (index, value) {
                selectData = '<option value="' + value.event_type + '">' + value.event_type + '</option>';
                options.push(selectData);
                listData += '<tr>'+
                    '<td>'+(index+1)+'</td>'+
                    '<td>' + value.event_type + '</td>'+
                    '<td><a href="javascript:;" data-cat-id="' + value.id + '" class="btn btn-sm btn-danger btn-rounded delete-event-type">Remove</a></td>'+
                    '</tr>';
            });

            $('.event-type-table tbody' ).html(listData);

            // $('#category_add').html(options);
            $('#event_type').val(' ');                    
            $('#event_type_id').html(options);
            $('#event_type_id_edit').html(options);
                                                                    
        },
        error: function(response) {
            console.log(response.responseJSON.errors.event_type);
            $('#event_type_error').text(response.responseJSON.errors.event_type);

        }
        
    }); 
    
    return false;        
});

//Update Event data
$('#updateEventForm').on('submit',function(event){
    event.preventDefault();
    // Get Alll Text Box Id's
    var event_name_edit = $('#event_name_edit').val();
    // alert(event_name_edit);  

    $.ajax({
        url:"event_update",
        type:"POST",
        data:$("#updateEventForm").serialize(),
        dataType : "JSON",
        success:function(response)
        {
            
            $('#formEventEditModal').modal('hide');

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

$('body').on('click', '.delete-category', function(e) {
    var id = $(this).data('cat-id');     
    // var token = "{{ csrf_token() }}";
    
    $.ajax({
        type: 'POST',
        url:"event_category_delete",
        data: {'id': id},
        dataType: "JSON",
        success: function (response) {
            // console.log(response);
            // console.log(response.message);
            if (response.message == "success") {

                Toastify({
                    text: "Deleted Sucessfully..!",
                    duration: 3000,
                    close:true,
                    backgroundColor: "#4fbe87",
                }).showToast();

                $('.category-table tbody').html(' ');                    
                $('#category_id').html(' ');                    

                var options = [];
                var rData = [];
                let listData = "";
                rData = response.data;
                var selectData = '';
                selectData = '<option value="" selected>Select Category...</option>';
                options.push(selectData); 
                $.each(rData, function (index, value) {
                    selectData = '<option value="' + value.category_name + '">' + value.category_name + '</option>';
                    options.push(selectData);
                    listData += '<tr>'+
                        '<td>'+(index+1)+'</td>'+
                        '<td>' + value.category_name + '</td>'+
                        '<td><a href="javascript:;" data-cat-id="' + value.id + '" class="btn btn-sm btn-danger btn-rounded delete-category">Remove</a></td>'+
                        '</tr>';
                });

                $('.category-table tbody' ).html(listData);

                // $('#category_add').html(options);
                $('#category_name').val(' ');                    
                $('#category_id').html(options);
                
            }
        }
        
    }); 

    e.preventDefault();
});


$('body').on('click', '.delete-event-type', function(e) {
    var id = $(this).data('cat-id');     
    // var token = "{{ csrf_token() }}";
    
    $.ajax({
        type: 'POST',
        url:"event_type_delete",
        data: {'id': id},
        dataType: "JSON",
        success: function (response) {
            // console.log(response);
            if (response.message == "success") {

                Toastify({
                    text: "Deleted Sucessfully..!",
                    duration: 3000,
                    close:true,
                    backgroundColor: "#4fbe87",
                }).showToast();

                $('.event-type-table tbody').html(' ');                    
                $('#event_type_id').html(' ');                    

                var options = [];
                var rData = [];
                let listData = "";
                rData = response.data;
                var selectData = '';
                selectData = '<option value="" selected>Select Category...</option>';
                options.push(selectData); 
                $.each(rData, function (index, value) {
                    selectData = '<option value="' + value.event_type + '">' + value.event_type + '</option>';
                    options.push(selectData);
                    listData += '<tr>'+
                        '<td>'+(index+1)+'</td>'+
                        '<td>' + value.event_type + '</td>'+
                        '<td><a href="javascript:;" data-cat-id="' + value.id + '" class="btn btn-sm btn-danger btn-rounded delete-category">Remove</a></td>'+
                        '</tr>';
                });

                $('.event-type-table tbody' ).html(listData);                      

                // $('#category_add').html(options);
                $('#event_type').val(' ');                    
                $('#event_type_id').html(options);
                
            }
        }
        
    }); 

    e.preventDefault();
});

//Edit Data
$('body').on('click','.edit-event',function(){
    // alert("edit");    
    // $("#event_name_edit").val(" ");
    // $("#label_color_edit").val(" ");
    // $("#where_edit").val(" ");
    // $("#description_edit").val(" ");
    // $("#category_name_edit").val(" ");
    // $("#event_type_edit").html("");
    
    $('#eventDetailModal').modal('hide');

    var id = $("#event_edit_id").val(); 
    console.log(id);
    
    $("#event_update_id").val(id);

    //Get Category list
    $.ajax({
        url:"fetch_select_option_event_category",
        type:"GET",
        data : {id: id},
        dataType : "JSON",
        success:function(response)
        {
            console.log(response);                                                                                                                      
            // $("#category_id_edit").val(response);
            $('#category_id_edit').html(response);

        }               
        
    });

    //Get Event Type list
    $.ajax({
        url:"fetch_selected_event_type",
        type:"GET",
        data : {id: id},
        dataType : "JSON",
        success:function(response)
        {
            // console.log(response);                                                                                                                      
            // $("#category_id_edit").val(response);
            $('#event_type_id_edit').html(response);

        }               
        
    });                   

    //Get Event list
    $.ajax({
        url:"fetch_event_edit",
        type:"GET",
        data : {id: id},
        dataType : "JSON",
        success:function(response)
        {
            // console.log(response);                                                                                                    
            var rData = [];
            rData = response;                   
            $.each(rData, function (index, value) {                

                $("#event_name_edit").val(value.event_name);
                $("#label_color_edit").val(value.label_color);
                $("#where_edit").val(value.where);
                $("#description_edit").val(value.description);
                $("#category_name_edit").val(value.category_name);
                $("#event_type_edit").html(value.event_type);
                $("#candicate_list_edit").prop("checked", false);        
                
                if(value.candicate_list == "yes"){                    
                    $("#candicate_list_edit").prop("checked", true);        
                }else{                   
                    $("#candicate_list_edit").prop("checked", false);        
                }
                
                if(value.repeat == "yes"){
                    
                    $("#repeat-event-edit").prop("checked", true);    
                    $("#repeat_count_edit").val(value.repeat_every);
                    $("#repeat_cycles_edit").val(value.repeat_cycles);
                    $("#repeat_type_edit").val(value.repeat_type);
                    $('#repeat-fields-edit').show();
                    
                }else{
                   
                    $("#repeat-event-edit").prop("checked", false);        
                    $('#repeat-fields-edit').hide();
                    
                }
                

                var start_date_time = value.start_date_time;
                var split = start_date_time.split(" ");

                $("#start_date_edit").val(split[0]);
                $("#start_time_edit").val(split[1]);

                var end_date_time = value.end_date_time;
                var split = end_date_time.split(" ");
        
                // console.log();
                $("#end_date_edit").val(split[0]);
                $("#end_time_edit").val(split[1]);

            });
                                

        }
       
        
    }); 

    //Get Attendees list
    $.ajax({
        url:"fetch_event_attendees_list",
        type:"GET",
        data : {id: id},
        dataType : "JSON",
        success:function(response)
        {
            // console.log(response);                                                                                                                      
            // $("#category_id_edit").val(response);
            $('#candicate_select_op_list_edit').html(response);

        }               
        
    }); 

    $('#formEventEditModal').modal('show');

});

$('#repeat-event-edit').change(function () {
    if($(this).is(':checked')){
        $('#repeat-fields-edit').show();
    }
    else{
        $('#repeat-fields-edit').hide();
    }
});

$('.toggle-filter').click(function () {
    $('#ticket-filters').slideToggle();
});

$('#reset-filters').click(function () {
    $('.select2').val('all');
    $('.select2').trigger('change')
    employee = $('#employeeID').val();
    category = $('#category').val();
    event_type = $('#event_type').val();
    calendar.refetchEvents();        
});
$('#apply-filters').click(function () {
    employee = $('#employeeID').val();
    client = $('#clientID').val();
    category = $('#category_id').val();
    event_type = $('#event_type').val();

    calendar.refetchEvents();
    url = url+'?employee=' + employee + '&client=' + client + '&category=' + category + '&event_type=' + event_type;
});

(function($) {
    "use strict";
    basic_calendar.init();    

})(jQuery);

