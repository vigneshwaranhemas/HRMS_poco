"use strict";

$(document).ready(function() {
    $.ajax({
        url:"fetch_people_starred_first_empid",
        type:"GET",
        dataType : "JSON",
        success:function(response)
        {
            // alert(response)
            if(response == "empty"){ 

                $(".chat-right-aside").css('display', 'none');
                $(".chat-right-aside-star").css('display', 'block');
                $(".chat-right-aside-employees-empty").css('display', 'none');

            }else{          
                                
                fetch_people_list_ul_li();
                fetch_everyone_details();
                fetch_starred_details();
                                            
            }
            
        }
    });
});


// $(".chat-right-aside").css('display', 'none');
// $(".chat-right-aside-star").css('display', 'block');
// $(".chat-right-aside").html("hi");

function fetch_people_list_ul_li(){

    $.ajax({
        url:"fetch_people_starred_first_empid",
        type:"GET",
        dataType : "JSON",
        success:function(response)
        {
            // alert(response)
            if(response == "empty"){ 
                // alert("no 1")                               
                // $(".chat-right-aside").css('display', 'block');
                $(".chat-right-aside").css('display', 'none');
                $(".chat-right-aside-star").css('display', 'block');
                $(".chat-right-aside-employees-empty").css('display', 'none');

            }else{          
                // alert("yes 1")
                $(".chat-right-aside-star").css('display', 'none');
                $(".chat-right-aside-employees-empty").css('display', 'none');
                $(".chat-right-aside").css('display', 'block');

                var employee = response;
            
                $.ajax({
                    url:"fetch_people_list_filter",
                    type:"GET",
                    data : {employee: employee},
                    dataType : "JSON",
                    success:function(response)
                    {
                        // console.log(response);

                        if(response == "empty"){ 
                            // alert("no")                               
                            // $(".chat-right-aside").css('display', 'none');
                            // $(".chat-right-aside-star").css('display', 'none');
                            // $(".chat-right-aside-employees-empty").css('display', 'block');
                        }else{          
                            // alert("yes")                               
            
                            // $(".chat-right-aside-employees-empty").css('display', 'none');
                            // $(".chat-right-aside-star").css('display', 'none');
                            // $(".chat-right-aside").css('display', 'block');
            
                            var rData = [];
                            rData = response;                   
                            $.each(rData, function (index, value) {
                                                                                                                                                    
                                $("#people_name_show").html(value.username);
                                $("#people_empID_show").html(value.empID);
                                $("#people_designation_show").html(value.designation);
                                $("#people_dept_show").html(value.department);
                                $("#people_contact_show").html(value.contact_no);
                                $("#people_email_show").html(value.email);
                                $("#people_wl_show").html(value.worklocation);                                
                                $("#people_doj_show").html(value.doj);                                
                                $("#people_dob_show").html(value.dob);    
                                // var star_icon = '<a href="javascript:void(0);" id="people_star_add" data-id="'+value.empID+'" data-username="'+value.username+'"><i id="star_class_name" style="color: rgb(255, 199, 23);" class="fa fa-star"></i></a>';
                                // // alert(star_icon)
                                // $("#people_star_i_show").html(star_icon);                                

                            });
                        }
                        
                    }               
                    
                });

                //Star List
                $.ajax({
                    url:"fetch_people_list_filter_star",
                    type:"GET",
                    data : {employee: employee},
                    dataType : "JSON",
                    success:function(response)
                    {
                        console.log(response);
                        $("#people_star_i_show").html(response); 
                    }               
                    
                });
                                            
            }
            
        }
    });
        
}

function fetch_starred_details(){
    
    //Star List
    $.ajax({
        url:"fetch_starred_customusers_list",
        type:"GET",
        dataType : "JSON",
        cache: false,
        success:function(response)
        {
            // console.log(response);
            if(response == "empty"){                                
                // alert("no 2")                               
                $(".chat-right-aside").css('display', 'none');
                $(".chat-right-aside-star").css('display', 'block');
                $(".chat-right-aside-employees-empty").css('display', 'none');
            }else{          
                // alert("yes 2")                               
                $("#people_starred_list_show").html(response); 
                $(".chat-right-aside-employees-empty").css('display', 'none');
                $(".chat-right-aside-star").css('display', 'none');
                $(".chat-right-aside").css('display', 'block');

            }
            // $("#people_starred_list_show").html(resObject.responseJSON); 
        }               
        
    });
}

function fetch_everyone_details(){
    //Star List
    $.ajax({
        url:"fetch_everyone_customusers_list",
        type:"GET",
        dataType : "JSON",
        success:function(response)
        {
            // console.log(response);
            if(response == "empty"){                
                // alert("no 3")                               
                $(".chat-right-aside").css('display', 'none');
                $(".chat-right-aside-star").css('display', 'none');
                $(".chat-right-aside-employees-empty").css('display', 'block');
            }else{          
                // alert("yes 3")                               
                $("#people_everyone_list_show").html(response); 
                $(".chat-right-aside-star").css('display', 'none');
                $(".chat-right-aside-employees-empty").css('display', 'none');
                $(".chat-right-aside").css('display', 'block');

            }
        }               
        
    });
}

$('.people_list_filter').change(function () {
    // alert(this.value)
    var employee = this.value;
    
    $.ajax({
        url:"fetch_people_list_filter",
        type:"GET",
        data : {employee: employee},
        dataType : "JSON",
        success:function(response)
        {
            // console.log(response);

            if(response == "empty"){
                $(".chat-right-aside").css('display', 'none');                        
                $(".chat-right-aside-star").css('display', 'none');
                $(".chat-right-aside-employees-empty").css('display', 'block');
            }else{
                // $(".chat-right-aside").css('display', 'block');                        
                $(".chat-right-aside-star").css('display', 'none');
                $(".chat-right-aside-employees-empty").css('display', 'none');

                var rData = [];
                rData = response;                   
                $.each(rData, function (index, value) {
                                                                                                                                        
                    $("#people_name_show").html(value.username);
                    $("#people_empID_show").html(value.empID);
                    $("#people_designation_show").html(value.designation);
                    $("#people_dept_show").html(value.department);
                    $("#people_contact_show").html(value.contact_no);
                    $("#people_email_show").html(value.email);
                    $("#people_wl_show").html(value.worklocation);                                
                    $("#people_doj_show").html(value.doj);                                
                    $("#people_dob_show").html(value.dob);    
                    // var star_icon = '<a href="javascript:void(0);" id="people_star_add" data-id="'+value.empID+'" data-username="'+value.username+'"><i id="star_class_name" style="color: rgb(255, 199, 23);" class="fa fa-star"></i></a>';
                    // // alert(star_icon)
                    // $("#people_star_i_show").html(star_icon);                                
                    $(".chat-right-aside").css('display', 'block');

                });
            }
            
        }               
        
    });

    //Star List
    $.ajax({
        url:"fetch_people_list_filter_star",
        type:"GET",
        data : {employee: employee},
        dataType : "JSON",
        success:function(response)
        {
            // console.log(response);
            $("#people_star_i_show").html(response); 
        }               
        
    });
});

$('body').on('click','.people_star_add',function(){
    var emp_id = $(this).data('id');
    var username = $(this).data('username');
    // alert(emp_id)

    $.ajax({
        url:"fetch_people_star_add",
        type:"POST",
        data : { emp_id: emp_id },
        dataType : "JSON",
        success:function(response)
        {
            // console.log();  
            if(response.output == "star_addded"){
                $(".star_class_name").css("color", "#ffc717");
                // $("#star_class_name").css("color", "#ffc717");

                fetch_starred_details();
                fetch_everyone_details();

            }else{
                $(".star_class_name").css("color", "#6e7e96");
                fetch_everyone_details();
               
                $.ajax({
                    url:"fetch_people_starred_first_empid",
                    type:"GET",
                    dataType : "JSON",
                    success:function(response)
                    {
                        // alert(response)
                        if(response == "empty"){ 
            
                            $(".chat-right-aside").css('display', 'none');
                            $(".chat-right-aside-star").css('display', 'block');
                            $(".chat-right-aside-employees-empty").css('display', 'none');

                            // //Star List
                            $.ajax({
                                url:"fetch_starred_customusers_list",
                                type:"GET",
                                dataType : "JSON",
                                cache: false,
                                success:function(response)
                                {
                                    $("#people_starred_list_show").html(response); 
                                }               
                                
                            });
            
                        }else{

                            // //Star List
                            $.ajax({
                                url:"fetch_starred_customusers_list",
                                type:"GET",
                                dataType : "JSON",
                                cache: false,
                                success:function(response)
                                {
                                    $("#people_starred_list_show").html(response); 
                                }               
                                
                            });

                            $.ajax({
                                url:"fetch_people_starred_first_empid",
                                type:"GET",
                                dataType : "JSON",
                                success:function(response)
                                {
                                        
                                    // alert("yes 1")
                                    $(".chat-right-aside-star").css('display', 'none');
                                    $(".chat-right-aside-employees-empty").css('display', 'none');
                                    $(".chat-right-aside").css('display', 'block');
                    
                                    var employee = response;
                                    
                                    $.ajax({
                                        url:"fetch_people_list_filter",
                                        type:"GET",
                                        data : {employee: employee},
                                        dataType : "JSON",
                                        success:function(response)
                                        {
                                            // console.log(response);
                    
                                            if(response == "empty"){ 
                                                // alert("no")                               
                                                // $(".chat-right-aside").css('display', 'none');
                                                // $(".chat-right-aside-star").css('display', 'none');
                                                // $(".chat-right-aside-employees-empty").css('display', 'block');
                                            }else{          
                                                // alert("yes")                               
                                
                                                // $(".chat-right-aside-employees-empty").css('display', 'none');
                                                // $(".chat-right-aside-star").css('display', 'none');
                                                // $(".chat-right-aside").css('display', 'block');
                                
                                                var rData = [];
                                                rData = response;                   
                                                $.each(rData, function (index, value) {
                                                                                                                                                                        
                                                    $("#people_name_show").html(value.username);
                                                    $("#people_empID_show").html(value.empID);
                                                    $("#people_designation_show").html(value.designation);
                                                    $("#people_dept_show").html(value.department);
                                                    $("#people_contact_show").html(value.contact_no);
                                                    $("#people_email_show").html(value.email);
                                                    $("#people_wl_show").html(value.worklocation);                                
                                                    $("#people_doj_show").html(value.doj);                                
                                                    $("#people_dob_show").html(value.dob);    
                                                    // var star_icon = '<a href="javascript:void(0);" id="people_star_add" data-id="'+value.empID+'" data-username="'+value.username+'"><i id="star_class_name" style="color: rgb(255, 199, 23);" class="fa fa-star"></i></a>';
                                                    // // alert(star_icon)
                                                    // $("#people_star_i_show").html(star_icon);                                
                    
                                                });
                                            }
                                            
                                        }               
                                        
                                    });
                        
                                    //Star List
                                    $.ajax({
                                        url:"fetch_people_list_filter_star",
                                        type:"GET",
                                        data : {employee: employee},
                                        dataType : "JSON",
                                        success:function(response)
                                        {
                                            // console.log(response);
                                            $("#people_star_i_show").html(response); 
                                        }               
                                        
                                    });
                                                                    
                                    
                                    
                                }
                            });
                           
                        }
                        
                    }
                });
            }   

        }               
        
    });
    // window.location.reload();                                                                                            

    

});

$('#people_tab_li_1').click(function () {    
    // alert("1")
    $.ajax({
        url:"fetch_people_starred_first_empid",
        type:"GET",
        dataType : "JSON",
        success:function(response)
        {
            // alert(response)
            // console.log(response)
            if(response == "empty"){
                // alert("star tab 1  no")
                $(".chat-right-aside").css('display', 'none');                        
                $(".chat-right-aside-star").css('display', 'block');
                $(".chat-right-aside-employees-empty").css('display', 'none');

            }else{
                $(".chat-right-aside-star").css('display', 'none');

                // alert("star tab 1 yes")
                var employee = response;
            
                $.ajax({
                    url:"fetch_people_list_filter",
                    type:"GET",
                    data : {employee: employee},
                    dataType : "JSON",
                    success:function(response)
                    {
                        // console.log(response);
                        if(response == "empty"){
                            // alert("no")
                            // $(".chat-right-aside").css('display', 'none');                        
                            // $(".chat-right-aside-star").css('display', 'none');
                            // $(".chat-right-aside-employees-empty").css('display', 'none');

                        }else{
                            // alert("yes")

                            var rData = [];
                            rData = response;                   
                            $.each(rData, function (index, value) {
                                                                                                                                                    
                                $("#people_name_show").html(value.username);
                                $("#people_empID_show").html(value.empID);
                                $("#people_designation_show").html(value.designation);
                                $("#people_dept_show").html(value.department);
                                $("#people_contact_show").html(value.contact_no);
                                $("#people_email_show").html(value.email);
                                $("#people_wl_show").html(value.worklocation);                                
                                $("#people_doj_show").html(value.doj);                                
                                $("#people_dob_show").html(value.dob);    
                                // var star_icon = '<a href="javascript:void(0);" id="people_star_add" data-id="'+value.empID+'" data-username="'+value.username+'"><i id="star_class_name" style="color: rgb(255, 199, 23);" class="fa fa-star"></i></a>';
                                // // alert(star_icon)
                                // $("#people_star_i_show").html(star_icon);  
                                $(".chat-right-aside-star").css('display', 'none');
                                $(".chat-right-aside-employees-empty").css('display', 'none');                                  
                                $(".chat-right-aside").css('display', 'block');

                            });
                        }
                        
                    }               
                    
                });

                //Star List
                $.ajax({
                    url:"fetch_people_list_filter_star",
                    type:"GET",
                    data : {employee: employee},
                    dataType : "JSON",
                    success:function(response)
                    {
                        // console.log(response);
                        $("#people_star_i_show").html(response); 
                    }               
                    
                });
            }
            
        }
    });
});

$('#people_tab_li_2').click(function () {

    fetch_everyone_details();

    // alert("2")
    $.ajax({
        url:"fetch_people_everyone_first_empid",
        type:"GET",
        dataType : "JSON",
        success:function(response)
        {
            // alert(response)
            if(response == "empty"){
                // alert("star tab 1  no")
                $(".chat-right-aside").css('display', 'none');                        
                $(".chat-right-aside-star").css('display', 'none');
                $(".chat-right-aside-employees-empty").css('display', 'block');

            }else{
                $(".chat-right-aside-employees-empty").css('display', 'none');
                $(".chat-right-aside-star").css('display', 'none');

                var employee = response;
            
                $.ajax({
                    url:"fetch_people_list_filter",
                    type:"GET",
                    data : {employee: employee},
                    dataType : "JSON",
                    success:function(response)
                    {
                        // console.log(response);
                        if(response == "empty"){
                            // $(".chat-right-aside").css('display', 'none');
                            // $(".chat-right-aside-star").css('display', 'none');
                            // $(".chat-right-aside-employees-empty").css('display', 'block');
                        }else{
                            // $(".chat-right-aside-star").css('display', 'none');
                            // $(".chat-right-aside-employees-empty").css('display', 'none');

                            var rData = [];
                            rData = response;                   
                            $.each(rData, function (index, value) {
                                                                                                                                                    
                                $("#people_name_show").html(value.username);
                                $("#people_empID_show").html(value.empID);
                                $("#people_designation_show").html(value.designation);
                                $("#people_dept_show").html(value.department);
                                $("#people_contact_show").html(value.contact_no);
                                $("#people_email_show").html(value.email);
                                $("#people_wl_show").html(value.worklocation);                                
                                $("#people_doj_show").html(value.doj);                                
                                $("#people_dob_show").html(value.dob);    
                                // var star_icon = '<a href="javascript:void(0);" id="people_star_add" data-id="'+value.empID+'" data-username="'+value.username+'"><i id="star_class_name" style="color: rgb(255, 199, 23);" class="fa fa-star"></i></a>';
                                // // alert(star_icon)
                                // $("#people_star_i_show").html(star_icon);                                
                                $(".chat-right-aside").css('display', 'block');

                            });
                        }
                        
                    }               
                    
                });

                //Star List
                $.ajax({
                    url:"fetch_people_list_filter_star",
                    type:"GET",
                    data : {employee: employee},
                    dataType : "JSON",
                    success:function(response)
                    {
                        console.log(response);
                        $("#people_star_i_show").html(response); 
                    }               
                    
                });
            }
            
        }
    });
        
});

//Menu list active 
$('body').on('click','.people_list_ul_li',function(){

    var employee = $(this).data('id');
    // alert(emp_id)
    $.ajax({
        url:"fetch_people_list_filter",
        type:"GET",
        data : {employee: employee},
        dataType : "JSON",
        success:function(response)
        {
            // console.log(response);
            if(response == "empty"){
                $(".chat-right-aside").css('display', 'none');
                $(".chat-right-aside-star").css('display', 'block');
                $(".chat-right-aside-employees-empty").css('display', 'none');
            }else{
                $(".chat-right-aside-star").css('display', 'none');
                $(".chat-right-aside-employees-empty").css('display', 'none');

                var rData = [];
                rData = response;                   
                $.each(rData, function (index, value) {
                                                                                                                                        
                    $("#people_name_show").html(value.username);
                    $("#people_empID_show").html(value.empID);
                    $("#people_designation_show").html(value.designation);
                    $("#people_dept_show").html(value.department);
                    $("#people_contact_show").html(value.contact_no);
                    $("#people_email_show").html(value.email);
                    $("#people_wl_show").html(value.worklocation);                                
                    $("#people_doj_show").html(value.doj);                                
                    $("#people_dob_show").html(value.dob);    
                    // var star_icon = '<a href="javascript:void(0);" id="people_star_add" data-id="'+value.empID+'" data-username="'+value.username+'"><i id="star_class_name" style="color: rgb(255, 199, 23);" class="fa fa-star"></i></a>';
                    // // alert(star_icon)
                    // $("#people_star_i_show").html(star_icon);                                
                    $(".chat-right-aside").css('display', 'block');

                });
            }
            
        }               
        
    });

    //Star List
    $.ajax({
        url:"fetch_people_list_filter_star",
        type:"GET",
        data : {employee: employee},
        dataType : "JSON",
        success:function(response)
        {
            // console.log(response);
            $("#people_star_i_show").html(response); 
        }               
        
    });

});

//Filter
// $('body').on('click','.icon-filter',function(){
//     $('.div_filter').css('display', 'block');
// });

$('body').on('click','.div_filter_close',function(){
    $('.div_filter').css('display', 'none');
});

