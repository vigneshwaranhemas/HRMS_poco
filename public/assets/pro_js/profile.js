
$(document).ready(function() {
    profile_info_process();
    get_state_list();
});

function get_state_list() {
    $.ajax({
        url: state_get_link,
        method: "POST",
        data:{},
        dataType: "json",
        success: function(data) {
            // console.log(data)
            var html = '<option value="">Select</option>';
            for (let index = 0; index < data.length; index++) {
                html += "<option value=" + data[index].state_name + ">" + data[index].state_name + "</option>";
            }
            $('#p_State').html(html);
            $('#c_State').html(html);
        }
    });
}

    $("#p_State").on('change', function () {
        var test =document.getElementById('p_State').value;
        get_district(test);
    });
    $("#c_State").on('change', function () {
        var test =document.getElementById('c_State').value;
        get_district_Current(test);
    });

    function get_district(test) {
        $.ajax({
            url: get_district_link,
            method: "POST",
            data:{"test" : test},
            dataType: "json",
            success: function(data) {
                console.log(data)
                var html = '<option value="">Select</option>';
                for (let index = 0; index < data.length; index++) {
                    html += "<option value=" + data[index].district_name + ">" + data[index].district_name + "</option>";
                }
                $('#p_district').html(html);
            }

        });
    }

    function get_district_Current(test) {
        $.ajax({
            url: get_district_link,
            method: "POST",
            data:{"test" : test},
            dataType: "json",
            success: function(data) {
                console.log(data)
                var html = '<option value="">Select</option>';
                for (let index = 0; index < data.length; index++) {
                    html += "<option value=" + data[index].district_name + ">" + data[index].district_name + "</option>";
                }
                $('#c_district').html(html);

            }

        });
    }

    $("#p_district").on('change', function () {
        var dis_name =document.getElementById('p_district').value;
        get_town_name(dis_name);
    });$("#c_district").on('change', function () {
        var dis_name =document.getElementById('c_district').value;
        get_town_name_Current(dis_name);
    });

    function get_town_name(dis_name) {
        $.ajax({
            url: get_town_name_link,
            method: "POST",
            data:{"district_name" :dis_name},
            dataType: "json",
            success: function(data) {
                // console.log(data)
                var html = '<option value="">Select</option>';
                for (let index = 0; index < data.length; index++) {
                    html += "<option value=" + data[index].district_name + ">" + data[index].district_name + "</option>";
                }
                $('#p_town').html(html);

            }

        });
    }
    function get_town_name_Current(dis_name) {
        $.ajax({
            url: get_town_name_link,
            method: "POST",
            data:{"district_name" :dis_name},
            dataType: "json",
            success: function(data) {
                // console.log(data)
                var html = '<option value="">Select</option>';
                for (let index = 0; index < data.length; index++) {
                    html += "<option value=" + data[index].district_name + ">" + data[index].district_name + "</option>";
                }
                $('#c_town').html(html);

            }

        });
    }


var $modal = $('#modal');
// var $profile_image = $('#profile_image');
var image = document.getElementById('image');
var cropper;
$("body").on("change", ".image", function(e){
      var files = e.target.files;
      var done = function (url) {
        image.src = url;
        $modal.modal('show');
        };
      var reader;
      var file;
      var url;
      if (files && files.length > 0) {
        file = files[0];
        if (URL) {
        done(URL.createObjectURL(file));
        } else if (FileReader) {
        reader = new FileReader();
        reader.onload = function (e) {
        done(reader.result);
        };
        reader.readAsDataURL(file);
        }
      }
  });
    $modal.on('shown.bs.modal', function () {
      cropper = new Cropper(image, {
        aspectRatio: 1,
        viewMode: 3,
        preview: '.preview'
      });
    }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
    });


$("#crop").click(function(){
      canvas = cropper.getCroppedCanvas({
        width: 160,
        height: 160,
        type: 'circle'
      });
      canvas.toBlob(function(blob) {
      url = URL.createObjectURL(blob);
      var reader = new FileReader();
      reader.readAsDataURL(blob); 
      reader.onloadend = function() {
      var base64data = reader.result; 
          $.ajax({
          type: "POST",
          dataType: "json",
          url: upload_images,
          data: {'_token': $('meta[name="_token"]').attr('content'), 'image': base64data},
          success: function(data){
          console.log(data.success);
          /*$modal.modal('hide');
          alert("Crop image successfully uploaded");
          location.reload();*/
          if(data.success =='insert'){

               Toastify({
                   text: "Image successfully uploaded..!",
                   duration: 3000,
                   close:true,
                   backgroundColor: "#4fbe87",
               }).showToast();

               setTimeout(
                   function() {
                    $modal.modal('hide');
                    location.reload();
                   }, 2000);

           }else if(data.success =='update'){

            Toastify({
                   text: "Successfully uploaded..!",
                   duration: 3000,
                   close:true,
                   backgroundColor: "#4fbe87",
               }).showToast();

               setTimeout(
                   function() {
                   $modal.modal('hide');
                    location.reload();
                   }, 2000);

           }
           else{
               Toastify({
                   text: "Request Failed..! Try Again",
                   duration: 3000,
                   close:true,
                   backgroundColor: "#f3616d",
               }).showToast();

               setTimeout(
                   function() {
                       location.reload();
                   }, 2000);

           }
          }
        });
      }
  });
})


//Edit pop-up model and data show
function profile_info_process(id){
    $.ajax({
        url: display_image,
        method: "POST",
        data:{},
        dataType: "json",
        success: function(data) {
            // console.log(data)
          if (data != ""){
             $('#pro_name').html(data.username);
             $('#can_name').html(data.username);
             $('#email').html(data.email);
             $('#dob').html(data.dob);
             $('#contact_no').html(data.contact_no);
             $('#worklocation').html(data.worklocation);
             $('#designation').html(data.designation);
             $('#gender').html(data.gender);
             $('#dob_tx').html(data.dob);
             $('#payroll_status').html(data.payroll_status);
             $('#doj').html(data.doj);
             $('#worklocation_tx').html(data.worklocation);
             $('#department').html(data.department);
             $('#grade').html(data.grade);
             $('#designation_tx').html(data.designation);
            $("#profile_img").attr('src',"../uploads/"+data.path);
          }else{
            $("#profile_img").attr('src',"../assets/images/user/7.jpg");
          }

        }
    });
}

/*upload file in popup*/
$(()=>{
    $('#btnSubmit').on('click',(e)=>{
        // alert('asdasdasdas')
   e.preventDefault();
      var formData = new FormData(document.getElementById("add_documents_unit"));
   $.ajax({
       url:add_documents_unit_process_link,
       method:"POST",  
        data:formData,
        processData:false,
        cache:false,
        contentType:false,
        dataType:"json",

       success:function(data) {
           // console.log(data);
           if(data.response =='insert'){
               Toastify({
                   text: "Added Sucessfully..!",
                   duration: 3000,
                   close:true,
                   backgroundColor: "#4fbe87",
               }).showToast();

               setTimeout(
                   function() {
                    location.reload();
                   }, 2000);
           }
           else{
               Toastify({
                   text: "Request Failed..! Try Again",
                   duration: 3000,
                   close:true,
                   backgroundColor: "#f3616d",
               }).showToast();

               setTimeout(
                   function() {
                       location.reload();
                   }, 2000);

               }
           }, 
       });
    })
})

/*document information*/
$("#v-pills-Documents-tab").on('click', function() {
    documents_info();
});

function documents_info(){
    $.ajax({
        url: documents_info_link,
        method: "POST",
        data:{},
        dataType: "json",
        success: function(data) {
                if (data !="") {
                $('#testing').empty();
                 html ="";
                // console.log(data)
                    html +="<div class='card-body'>";
                    html +="<div class='row people-grid-row'>";
              for (let index = 0; index < data.length; index++) {
                    html +="<div class='col-md-3 col-lg-3 col-xl-4'>";
                    html +="<div class='card widget-profile' style='width: 100%;height: 90%;'>";
                    html +="<div class='card-body rounded' style='box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);'>";
                    html +="<div class='pro-widget-content text-center'>";
                    html +="<div class='profile-info-widget' style='margin-bottom: -37px;'>";
                    html +="<a class='fa fa-suitcase' style='font-size:25px;color:black'></a>";
                    html +="<div class='profile-det-info'>";
                    html +="<h5><a href='' class='text-info'>" + data[index].doc_name + "</a></h5>";
                    html +="</div>";
                    html +="</div>";
                    html +="</div>";
                    html +="</div>";
                    html +="</div>";
                    html +="</div>";
                    
                }
                    html +="</div>";
                    html +="</div>";
                $('#testing').append(html);
            }
        }
    });
}
/*account information*/
$("#v-pills-Account-information-tab").on('click', function() {
    account_information();
});

function account_information(){
    $.ajax({
        url: account_info_get_link,
        method: "POST",
        data:{},
        dataType: "json",
        success: function(data) {
            if (data !="") {
                    $('#acc_mobile').val(data['0'].acc_mobile);
                    $('#acc_name').val(data['0'].acc_name);
                    $('#acc_number').val(data['0'].acc_number);
                    $('#bank_name').val(data['0'].bank_name);
                    $('#branch_name').val(data['0'].branch_name);
                    $('#ifsc_code').val(data['0'].ifsc_code);
                }
            }
        });
    }

$('#add_account_info').submit(function(e) {    
    e.preventDefault();
      var formData = new FormData(this);
    $.ajax({  
        url:account_info_link, 
        method:"POST",  
        data:formData,
        processData:false,
        cache:false,
        contentType:false,
        dataType:"json",
        success:function(data) {
        if(data.error)
           {
            $(".color-hider").hide();
                var keys=Object.keys(data.error);
                $.each( data.error, function( key, value ) {
                $("#"+key+'_error').text(value)
                $("#"+key+'_error').show();
                });
           }
            if(data.response =='insert'){
               Toastify({
                   text: "Added Sucessfully..!",
                   duration: 3000,
                   close:true,
                   backgroundColor: "#4fbe87",
               }).showToast();

               setTimeout(
                   function() {
                    location.reload();
                   }, 2000);

           }else if(data.response =='Update'){
               Toastify({
                   text: "Update Sucessfully..!",
                   duration: 3000,
                   close:true,
                   backgroundColor: "#4fbe87",
               }).showToast();

               setTimeout(
                   function() {
                    location.reload();
                   }, 2000);

           }
           else{
               Toastify({
                   text: "Request Failed..! Try Again",
                   duration: 3000,
                   close:true,
                   backgroundColor: "#f3616d",
               }).showToast();

               setTimeout(
                   function() {
                   }, 2000);

               }
            
        },
    }); 
});

/*education information*/
$("#v-pills-Education-tab").on('click', function() {
    education_information();
});

function education_information(){
    $.ajax({
        url: education_information_get_link,
        method: "POST",
        data:{},
        dataType: "json",
        success: function(data) {
            // console.log(data)
            if (data !="") {
                $('#education_td').empty();
                        html ='';
                    $.each(data, function (key, val) {
                        html +='<tr>';
                        html +='<td data-label="allcount">'+val.degree+'</td>';
                        html +='<td data-label="allcount">'+val.university+'</td>';
                        html +='<td data-label="allcount">'+val.edu_start_month+"-"+val.edu_start_year+'</td>';
                        html +='<td data-label="allcount">'+val.edu_end_month+"-"+val.edu_end_year+'</td>';
                        html +='<td data-label="allcount"><a href="../uploads/'+ val.edu_certificate +'" target =_blank><img class="rounded-circle" src="../assets/images/user/1.jpg"  alt=""></a></td>';

                    });
                    $('#education_td').html(html);
                }
            }
        });
    }

$('#add_education_unit').submit(function(e) { 
    e.preventDefault();
      var formData = new FormData(this);
    $.ajax({  
        url:education_information_link, 
        method:"POST",  
        data:formData,
        processData:false,
        cache:false,
        contentType:false,
        dataType:"json",
        success:function(data) {
            if(data.response =='insert'){
               Toastify({
                   text: "Added Sucessfully..!",
                   duration: 3000,
                   close:true,
                   backgroundColor: "#4fbe87",
               }).showToast();

               setTimeout(
                   function() {
                    location.reload();
                   }, 2000);

           }
           else{
               Toastify({
                   text: "Request Failed..! Try Again",
                   duration: 3000,
                   close:true,
                   backgroundColor: "#f3616d",
               }).showToast();

               setTimeout(
                   function() {
                   }, 2000);

               }
            
        },
    }); 
});

/*Experience information*/
$("#v-pills-Experience-tab").on('click', function() {
    experience_info();
});

function experience_info(){
    $.ajax({
        url: experience_info_link,
        method: "POST",
        data:{},
        dataType: "json",
        success: function(data) {

            $('#Experience_tbl').empty();
            if (data !="") {
                     html ="";
                    // console.log(data)
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

$("#v-pills-messages-tab").on('click', function() {
    Contact_info_page();
});
function Contact_info_page(){
    $.ajax({
        url: Contact_info_get_link,
        method: "POST",
        data:{},
        dataType: "json",
        success: function(data) {
            console.log(data)
                if (data !="") {
                    $('#p_num_view').html(data['0'].phone_number);
                    $('#s_num_view').html(data['0'].s_number);
                    $('#p_email_view').html(data['0'].p_email);
                    $('#p_adderss_view').html(data['0'].p_adderss);
                    $('#c_address_view').html(data['0'].c_address);
                    $('#State_view').html(data['0'].State);
                }
            }
        });
    }

/*contact info in pop-up*/
function Contact_information(){
    $.ajax({
        url: Contact_info_get_link,
        method: "POST",
        data:{},
        dataType: "json",
        success: function(data) {
            // console.log(data['0'].phone_number)
            if (data !="") {
                $('#phone_number').val(data['0'].phone_number);
                $('#s_number').val(data['0'].s_number);
                $('#p_email').val(data['0'].p_email);
                $('#p_adderss').val(data['0'].p_adderss);
                $('#c_address').val(data['0'].c_address);
                $('#State').val(data['0'].State);
            }

            }
        });
    }


$('#add_contact_info').submit(function(e) {    
    e.preventDefault();
      var formData = new FormData(this);
    $.ajax({  
        url:add_contact_info_link, 
        method:"POST",  
        data:formData,
        processData:false,
        cache:false,
        contentType:false,
        dataType:"json",
        success:function(data) {
        if(data.error)
           {
            $(".color-hider").hide();
                var keys=Object.keys(data.error);
                $.each( data.error, function( key, value ) {
                $("#"+key+'_error').text(value)
                $("#"+key+'_error').show();
                });
           }
            if(data.response =='insert'){
               Toastify({
                   text: "Added Sucessfully..!",
                   duration: 3000,
                   close:true,
                   backgroundColor: "#4fbe87",
               }).showToast();

               setTimeout(
                   function() {
                    location.reload();
                   }, 2000);

           }else if(data.response =='Update'){
               Toastify({
                   text: "Update Sucessfully..!",
                   duration: 3000,
                   close:true,
                   backgroundColor: "#4fbe87",
               }).showToast();

               setTimeout(
                   function() {
                    location.reload();
                   }, 2000);
           }
           else{
               Toastify({
                   text: "Request Failed..! Try Again",
                   duration: 3000,
                   close:true,
                   backgroundColor: "#f3616d",
               }).showToast();

               setTimeout(
                   function() {
                   }, 2000);

               }
            
        },
    }); 
});

/*famil information */
$("#v-pills-Family-tab").on('click', function() {
    family_information();
});

function family_information(){
    $.ajax({
        url: family_information_get_link,
        method: "POST",
        data:{},
        dataType: "json",
        success: function(data) {
            console.log(data)
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

$('#add_family_unit').submit(function(e) {    
    e.preventDefault();
      var formData = new FormData(this);
    $.ajax({  
        url:add_family_info_link, 
        method:"POST",  
        data:formData,
        processData:false,
        cache:false,
        contentType:false,
        dataType:"json",
        success:function(data) {
        if(data.error)
           {
            $(".color-hider").hide();
                var keys=Object.keys(data.error);
                $.each( data.error, function( key, value ) {
                $("#"+key+'_error').text(value)
                $("#"+key+'_error').show();
                });
           }
            if(data.response =='insert'){
               Toastify({
                   text: "Added Sucessfully..!",
                   duration: 3000,
                   close:true,
                   backgroundColor: "#4fbe87",
               }).showToast();

               setTimeout(
                   function() {
                    location.reload();
                   }, 2000);

           }else{
               Toastify({
                   text: "Request Failed..! Try Again",
                   duration: 3000,
                   close:true,
                   backgroundColor: "#f3616d",
               }).showToast();

               setTimeout(
                   function() {
                   }, 2000);

               }
            
        },
    }); 
});