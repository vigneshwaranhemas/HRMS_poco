
$(document).ready(function(){
    hr_to_profile();
});
function hr_to_profile(id){
    var params = new window.URLSearchParams(window.location.search);
    var id=params.get('id')
    var empID=params.get('empID')
    // alert(id)
    $.ajax({
        url:hr_id_card_varification_link,
        method: "POST",
        data:{"id":id,"empID":empID},
        dataType: "json",
        success: function(data) {
             // console.log(data);
           if (data !="") {
            var dob = moment(data[0].dob).format('DD-MM-YYYY');
            var doj = moment(data[0].doj).format('DD-MM-YYYY');
                    // $('#pro_img').val(data[0].img_path);
                    $("#pro_img").attr('src',"../ID_card_photo/"+data[0].img_path+".jpg");
                    $('#can_name').html(data[0].username + data[0].m_name +" " + data[0].l_name);
                    $('#can_name_1').html(data[0].username + data[0].m_name +" "+ data[0].l_name);
                     $('#can_designation_1').html(data[0].designation);
                    $('#can_email').html(data[0].email);
                    $('#can_dob').html(dob);
                    $('#can_dob_1').html(dob);
                    $('#can_cont').html(data[0].contact_no);
                    $('#can_blood_grp').html(data[0].blood_grp);
                    $('#gender').html(data[0].gender);

                    /*working info*/
                    $('#doj').html(doj);
                    $('#working_loc').html(data[0].worklocation);
                    $('#can_department').html(data[0].department);
                    $('#can_designation').html(data[0].designation);
                    $('#grade').html(data[0].grade);


                }
        }
    });
}
/*contact info in pop-up*/
$("#v-pills-messages-tab").on('click', function() {
    Contact_info_hr();
});
function Contact_info_hr(id){
    var params = new window.URLSearchParams(window.location.search);
    var id=params.get('id')
    var empID=params.get('empID')
    $.ajax({
        url: Contact_info_hr_link,
        method: "POST",
        data:{"id":id,"empID":empID},
        dataType: "json",
        success: function(data) {
            // console.log(data)
                if (data !="") {
                    $('#contact_no_1').html(data[0].contact_no);
                    $('#emp_num_2').html(data[0].emp_num_2);
                    $('#p_addres_view').html(data[0].p_addres+data[0].p_district+data[0].p_town+data[0].p_State);
                    $('#c_addres_view').html(data[0].c_addres+data[0].c_district+data[0].c_town+data[0].c_State);
                    $('#p_email').html(data[0].p_email);
                }
            }
        });
    }
/*account information*/
$("#v-pills-Account-information-tab").on('click', function() {
    account_info_hr();
});

function account_info_hr(){
    var params = new window.URLSearchParams(window.location.search);
    var empID=params.get('empID')
    $.ajax({
        url: account_info_hr_link,
        method: "POST",
        data:{"empID":empID},
        dataType: "json",
        success: function(data) {
            // console.log(data)
            if (data !="") {
                    /*account information*/
                    $('#acc_name').html(data[0].acc_name);
                    $('#bank_name').html(data[0].bank_name);
                    $('#branch_name').html(data[0].branch_name);
                    $('#acc_number').html(data[0].acc_number);
                    $('#ifsc_code').html(data[0].ifsc_code);
                }
            }
        });
    }

/*education information*/
$("#v-pills-Education-tab").on('click', function() {
    education_information_hr();
});

function education_information_hr(){
    var params = new window.URLSearchParams(window.location.search);
    var empID=params.get('empID')
    $.ajax({
        url: education_information_get_link,
        method: "POST",
        data:{"empID":empID},
        dataType: "json",
        success: function(data) {
            // console.log(data)
            if (data !="") {
                $('#education_td_hr').empty();
                        html ='';
                    $.each(data, function (key, val) {
                        html +='<tr>';
                        html +='<td data-label="allcount">'+val.degree+'</td>';
                        html +='<td data-label="allcount">'+val.university+'</td>';
                        html +='<td data-label="allcount">'+val.edu_start_month+"-"+val.edu_start_year+'</td>';
                        html +='<td data-label="allcount">'+val.edu_end_month+"-"+val.edu_end_year+'</td>';
                        html +='<td data-label="allcount"><a href="../education/'+ val.edu_certificate +'" target =_blank><img class="rounded-circle" src="../assets/images/user/1.jpg"  alt=""></a></td>';

                    });
                    $('#education_td_hr').html(html);
                }
            }
        });
    }


/*Experience information*/
$("#v-pills-Experience-tab").on('click', function() {
    experience_info_hr();
});
function experience_info_hr(id,empID){
    var params = new window.URLSearchParams(window.location.search);
    var id=params.get('id')
    var empID=params.get('empID')
    // alert(empID)

    $.ajax({
        url: experience_info_hr_link,
        method: "POST",
        data:{"id":id,"empID":empID},
        dataType: "json",
        success: function(data) {
            $('#Experience_tbl').empty();
            if (data !="") {
                     html ="";
                        html +="<div class='card-body'>";
                        html +="<div class='row people-grid-row'>";
                  for (let index = 0; index < data.length; index++) {
                        html +="<div class='col-md-3 col-lg-3 col-xl-4'>";
                        html +="<div class='card widget-profile'>";
                        html +="<div class='card-body rounded' style='box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);'>";
                        html +="<div class='pro-widget-content text-center'>";
                        html +="<div class='profile-info-widget'>";
                        html +="<a class='fa fa-suitcase' style='font-size:25px;color:black'></a>";
                        html +="<div class='profile-det-info'>";
                        html +="<a class='text-info' >" + data[index].job_title + "</a>";
                        html +="<p>" + data[index].company_name + "</p>";
                        html +="</div>";
                        html +="</div>";
                        html +="</div>";
                        html +="</div>";
                        html +="</div>";
                        html +="</div>";
                    }
                        html +="</div>";
                        html +="</div>";
                    $('#Experience_tbl').append(html);
                }
            }
    });
}

/*famil information */
$("#v-pills-Family-tab").on('click', function() {
    family_information();
});

function family_information(id,empID){
     var params = new window.URLSearchParams(window.location.search);
    var id=params.get('id')
    var emp_id=params.get('empID')
    
    $.ajax({
        url: family_information_get_link,
        method: "POST",
        data:{"id":id,"emp_id":emp_id},
        dataType: "json",
        success: function(data) {
            // console.log(data)
            $('#education_td').empty();
            if (data !="") {
                    html ='';
                $.each(data, function (key, val) {
                    html +='<tr>';
                    html +='<td data-label="allcount">'+val.fm_name+'</td>';
                    html +='<td data-label="allcount">'+val.fm_gender+'</td>';
                    html +='<td data-label="allcount">'+val.fn_relationship+'</td>';
                    html +='<td data-label="allcount">'+val.fn_marital+'</td>';
                    html +='<td data-label="allcount">'+val.fn_blood_gr+'</td>';

                });
                $('#family_td').html(html);
                }
            }
        });
    }
