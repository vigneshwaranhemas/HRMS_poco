"use strict";

fetch_people_list_ul_li();
fetch_starred_details();
fetch_everyone_details();

function fetch_people_list_ul_li(){

    $.ajax({
        url:"fetch_people_starred_first_empid",
        type:"GET",
        dataType : "JSON",
        success:function(response)
        {
            // alert(response)
            var employee = response;
            
            $.ajax({
                url:"fetch_people_list_filter",
                type:"GET",
                data : {employee: employee},
                dataType : "JSON",
                success:function(response)
                {
                    console.log(response);
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
            $("#people_starred_list_show").html(response); 
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
            $("#people_everyone_list_show").html(response); 
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

            }else{
                $(".star_class_name").css("color", "#6e7e96");
            }   

        }               
        
    });
    // window.location.reload();                                                                                            

    fetch_starred_details();
    fetch_everyone_details();

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
            var employee = response;
            
            $.ajax({
                url:"fetch_people_list_filter",
                type:"GET",
                data : {employee: employee},
                dataType : "JSON",
                success:function(response)
                {
                    // console.log(response);
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
});

$('#people_tab_li_2').click(function () {
    // alert("2")
    $.ajax({
        url:"fetch_people_everyone_first_empid",
        type:"GET",
        dataType : "JSON",
        success:function(response)
        {
            // alert(response)
            var employee = response;
            
            $.ajax({
                url:"fetch_people_list_filter",
                type:"GET",
                data : {employee: employee},
                dataType : "JSON",
                success:function(response)
                {
                    // console.log(response);
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
            console.log(response);
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

});