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
            // events: {
            //     url: 'fetch_birthdays_list',
            //     method: 'GET',
            //     extraParams: function() { // a function that returns an object
            //         return {
            //             employee: employee
            //         };
            //     }
            //     // extraParams: {
            //     //   employee: $("#birthdays_filter_user").val(),
            //     // }
            // },
            events: {
                url: 'fetch_birthdays_list',
                extraParams: function() { // a function that returns an object
                    return {
                        employee: employee
                    };
                }
            },
            eventClick: function(arg) { //edit option   
                getEventDetail(arg.empID); 
            }, 
            // viewRender: function(view, element) {
            //     addFilter(view.title);
            // }
        });
    }
};

var getEventDetail = function (empID) {

    $('#birthdayDetailModalList').modal('show');

    
    //Get empID list
    $.ajax({
        url:"fetch_birthdays_list_empID",
        type:"GET",
        data : {empID: empID},
        dataType : "JSON",
        success:function(response)
        {
            // console.log(response); 
            // console.log(response[0].username); 
            $("#employee_name_show").text('');
            $("#employee_id_show").text('');
            $("#employee_designation_show").text('');
            $("#employee_doj_show").text('');
            $("#employee_dob_show").text('');
            $("#employee_wl_show").text('');
            $("#employee_ps_show").text('');
            $("#employee_grade_show").text('');
            $("#occassion_file_show").text('');
            $("#employee_dept_show").text('');

            var date= response[0].doj;
            var d=new Date(date.split("/").reverse().join("-"));
            var dd=d.getDate();
            var mm=d.getMonth()+1;
            var yy=d.getFullYear();
            var doj = dd+"/"+mm+"/"+yy;

            var date_dob= response[0].dob;
            var dt=new Date(date_dob.split("/").reverse().join("-"));
            var dd_dob=dt.getDate();
            var mm_dob=dt.getMonth()+1;
            var yy_dob=dt.getFullYear();
            var dob = dd_dob+"/"+mm_dob+"/"+yy_dob;

            var name = response[0].username+' <i class="icofont icofont-birthday-cake"  style="font-size: 25px;"></i>';
            $("#employee_name_show").append(name);
            $("#employee_id_show").append(response[0].empID);
            $("#employee_designation_show").append(response[0].designation);
            $("#employee_doj_show").append(doj);
            $("#employee_dob_show").append(dob);
            $("#employee_wl_show").append(response[0].worklocation);
            $("#employee_ps_show").append(response[0].payroll_status);
            $("#employee_grade_show").append(response[0].grade);                
            $("#employee_dept_show").append(response[0].department);                

            // var file = response[0].occassion_file;
            // var ext = file.split('.')[1];    
            // // alert(ext);
            // if(ext=="jpg" || ext=="PNG" || ext=="png" || ext=="jpeg" || ext=="gif") {
            //     // alert("one");
            //     // var link = object[i].Value;

            //     var image = '<img onclick=sample_popup_viewer("'+file+'") class="img-sm image-layer-item image-size"   src="../../holidays_file/'+file+'" style="cursor:pointer;width: 400px;height: 200px;">';
            //     // row.append($('<td>').html(image));
            //     $("#occassion_file_show_list").append(image);  
               
            // }else if (ext=="pdf"|| ext=="doc" || ext=="docx" || ext=="xlsx" || ext=="csv"){
               
            //     var file = '<a href="/file_upload/'+file+'"  style="color:white;"  download><div class="badge bg-danger">'+file+'</div></a>';
            //     $("#occassion_file_show_list").append(file);  

            // }else if(ext=="mp4") {

            //     var video = '';            
            //     video += '<video width="320" height="240" controls>';
            //     video += '<source src="../../holidays_file/'+file+'" type="video/ogg">';
            //     video += '</video>';

            //     $("#occassion_file_show_list").append(video);  
               
            // } else{

            //     $("#occassion_file_show_list").append(" ");  

            // }

        }               
        
    });  

       
}

$('#birthdays_filter_user').change(function () {
    // alert(this.value)
    var employee = this.value;
    alert(employee)
    $('#cal-basic').fullCalendar('refetchEvents');    


    // calendar.refetchEvents();
    // var url = "{{url('fetch_birthdays_list')}}";
    // url: 'fetch_birthdays_list',
    //     method: 'GET',
    //     data: {
    //         employee: $("#birthdays_filter_user").val(),
    //     }
    
    // $.ajax({
    //     url:"fetch_birthdays_filter_user",
    //     type:"GET",
    //     data : {value: employee},
    //     dataType : "JSON",
    //     success:function(response)
    //     {
    var url = "fetch_birthdays_list";
    url = url+'&employee=' + employee;
    // alert(url)

   
});

//View all option
function addFilter(date) {

    $.ajax({
        url:"fetch_birthdays_list_date",
        type:"GET",
        data : {date: date},
        dataType : "JSON",
        success:function(response)
        {
            // console.log(response);

            var options = [];
            var rData = [];
            rData = response;

            //    remove old data
            $('#cal-basic').fullCalendar('removeEvents');
            // var events= [
            //         {
            //             title: 'Event 1',
            //             start: '2022-04-01',
            //             school: '1'
            //         },-
            //         {
            //             title: 'Event 2',
            //             start: '2022-04-02',
            //             school: '2'
            //         },
            //         {
            //             title: 'Event 3',
            //             start: '2022-05-03',
            //             school: '1'
            //         },
            //         {
            //             title: 'Event 4',
            //             start: '2022-05-04',
            //             school: '2'
            //         }
            //     ];               
                         
            //Getting new event json data
            $("#cal-basic").fullCalendar('addEventSource', response);
            // basic_calendar.fullCalendar('addEventSource', response);
            // basic_calendar.fullCalendar('refetchEvents');

        }               
        
    });  

    // $('#holidaysDetailModal').modal('show');
       
}

(function($) {
    "use strict";
    basic_calendar.init();    

})(jQuery);

