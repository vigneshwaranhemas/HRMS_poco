
$(document).ready(function() {
    profile_info_process();
    profile_banner_image();
    get_state_list();
    Contact_info_page();
});
$.ajaxSetup({
headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

/*popup*/

/*banner image popup*/
$("#banner_img").on('click', function() {
    $.ajax({
        url: profile_banner_image_link,
        method: "POST",
        data:{},
        dataType: "json",
        success: function(data) {
            banner_img_popup(data.banner_image);
        }
    });
});
 function banner_img_popup(sample){
       $("#sample_view_ban").attr("src", "../banner/"+sample);
       $(".sample-preview_ban").modal('show');
   }

/*profile image popup*/
$("#profile_img").on('click', function() {
    $.ajax({
        url: display_image,
        method: "POST",
        data:{},
        dataType: "json",
        success: function(data) {
            // console.log(data['image'])
          if(data['image'] != ""){
            profile_img_popup(data['image'].path);
          }
        }
    });
});
 function profile_img_popup(sample){
       $("#sample_view_pro").attr("src", "../uploads/"+sample);
       $(".sample-preview_pro").modal('show');
   }

/*banner image upload*/
$uploadCrop = $('#upload-demo').croppie({
    enableExif: true,
    viewport: {
        width: 700,
        height: 200,
        type: 'rectangle'
    },
    boundary: {
        width: 300,
        height: 300
    }
});


$('#upload').on('change', function () {
    var reader = new FileReader();
    reader.onload = function (e) {
        $uploadCrop.croppie('bind', {
            url: e.target.result
        }).then(function(){
            console.log('jQuery bind complete');
        });
    }
    reader.readAsDataURL(this.files[0]);
});


$('.upload-result').on('click', function (ev) {
    $uploadCrop.croppie('result', {
        type: 'canvas',
        size: 'viewport'
    }).then(function (resp) {
        $.ajax({
            // url: "/image-crop",
            url: banner_image_crop_link,
            type: "POST",
            data: {"image":resp},
            success: function (data) {
                // console.log(data)
            if(data.error){
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
                /*html = '<img src="' + resp + '" />';
                $("#upload-demo-i").html(html);*/
            }
        });
    });
});
/*banner image end upload*/


$("#sameadd").on('click', function() {
       var c_State = document.getElementById('p_State').value;
       var c_district = document.getElementById('p_district').value;
      get_district_Current(c_State,c_district);
      var c_district = document.getElementById('p_district').value;
      var c_town = document.getElementById('p_town').value;
       get_town_name_Current(c_district,c_town);
       CopyAdd();

});

/*clone textbox value*/
    function CopyAdd() {
      var cb1 = document.getElementById('sameadd');
      var p_addres = document.getElementById('p_addres');
      var c_addres = document.getElementById('c_addres');
      var p_State = document.getElementById('p_State');
      var c_State = document.getElementById('c_State');

      if (cb1.checked) {
        var checkBox = document.getElementById("sameadd");
        var text = document.getElementById("text");

                c_addres.value = p_addres.value;
                c_State.value = p_State.value;
          if (checkBox.checked == true){
            text.style.display = "block";
          } else {
             text.style.display = "none";
          }
      }
    }


function profile_banner_image(){
    $.ajax({
        url: profile_banner_image_link,
        method: "POST",
        data:{},
        dataType: "json",
        success: function(data) {
            if (Object.keys(data).length === 0) {
                $("#banner_img").attr('src',"../assets/images/other-images/profile-style-img3.png");
            }
            else{
                $("#banner_img").attr('src',"../banner/"+data.banner_image);
            }
        }
    });
}
/*skill*/
$('#add_skill_set').submit(function(e) {

        $(this).attr('disabled','disabled');
        $("#doc_Submit").text('Processing...');

   e.preventDefault();
      var formData = new FormData(document.getElementById("add_skill_set"));
   $.ajax({
       url:add_skill_set_link,
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
           // console.log(data);
           if(data.response =='Update'){
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
    })



/*contact info in pop-up*/
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
            // console.log(data)
                if (data !="") {
                    $('#p_num_view').html(data['0'].phone_number);
                    $('#s_num_view').html(data['0'].s_number);
                    $('#p_email_view').html(data['0'].p_email);
                    $('#p_addres_view').html(data['0'].p_addres+','+data['0'].p_town+','+data['0']. p_district+','+data['0'].p_State);
                    $('#c_addres_view').html(data['0'].c_addres+','+data['0'].c_town+','+data['0']. c_district+','+data['0'].c_State);
                }
            }
        });
    }

function Contact_information(){
    $.ajax({
        url: Contact_info_get_link,
        method: "POST",
        data:{},
        dataType: "json",
        success: function(data) {
            // console.log(data['0'])
            if (data !="") {
                $('#phone_number').val(data['0'].phone_number);
                $('#s_number').val(data['0'].s_number);
                $('#p_email').val(data['0'].p_email);
                $('#p_addres').val(data['0'].p_addres);
                $('#p_State').val(data['0'].p_State);
                get_district(data['0'].p_State,data['0'].p_district);
                $('#p_district').val(data['0'].p_district);
                get_town_name(data['0'].p_district,data['0'].p_town);
                $('#p_town').val(data['0'].p_town);
                $('#c_addres').val(data['0'].c_addres);
                $('#c_State').val(data['0'].c_State);
                get_district_Current(data['0'].c_State,data['0'].c_district);
                $('#c_district').val(data['0'].c_district);
                get_town_name_Current(data['0'].c_district,data['0'].c_town);
                $('#c_town').val(data['0'].c_town);
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
/*listing*/
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
                html += "<option value='" + data[index].state_name + "'>" + data[index].state_name + "</option>";
            }
            $('#p_State').html(html);
            $('#c_State').html(html);
        }
    });
}
     $("#p_State").on('change', function () {
            var p_State =document.getElementById('p_State').value;
            get_district(p_State);
        });
        $("#c_State").on('change', function () {
            var c_State =document.getElementById('c_State').value;
            // console.log(c_State)
            get_district_Current(c_State);
        });

    function get_district(p_State,p_district) {
        if (p_district =="") {
        $.ajax({
            url: get_district_link,
            method: "POST",
            data:{"p_State":p_State},
            dataType: "json",
            success: function(data) {
                var html = '<option value="">Select</option>';
                for (let index = 0; index < data.length; index++) {
                    html += "<option value='" + data[index].district_name + "'>" + data[index].district_name + "</option>";
                }
                $('#p_district').html(html);
            }

        });
    }else{
        // alert("not_empty")
        $.ajax({
            url: get_district_link,
            method: "POST",
            data:{"p_State":p_State},
            dataType: "json",
            success: function(data) {
                // console.log(data)
                var html = '<option value="">Select</option>';
                for (let index = 0; index < data.length; index++) {
                    // console.log(data[index].district_name )
                    if (p_district == data[index].district_name ) {

                    html += "<option value='" + data[index].district_name + "' selected>" + data[index].district_name + "</option>";
                    }else{
                         html += "<option value='" + data[index].district_name + "'>" + data[index].district_name + "</option>";
                    }
                }
                $('#p_district').html(html);

            }

        });
    }
    }

    function get_district_Current(c_State,c_district) {
        // console.log("text_"+c_district)
       if (c_district =="") {
        $.ajax({
            url: get_district_cur_link,
            method: "POST",
            data:{"c_State":c_State},
            dataType: "json",
            success: function(data) {
                var html = '<option value="">Select</option>';
                for (let index = 0; index < data.length; index++) {
                    html += "<option value='" + data[index].district_name + "'>" + data[index].district_name + "</option>";
                }
                $('#c_district').html(html);
            }

        });
    }else{
        // console.log(c_State)
        $.ajax({
            url: get_district_cur_link,
            method: "POST",
            data:{"c_State":c_State},
            dataType: "json",
            success: function(data) {
                // console.log(data)
                var html = '<option value="">Select</option>';
                for (let index = 0; index < data.length; index++) {
                    console.log(data[index].district_name )
                        console.log("text"+c_district)
                    if (c_district == data[index].district_name ) {
                    html += "<option value='" + data[index].district_name + "' selected>" + data[index].district_name + "</option>";
                    }else{
                        // console.log(data[index].district_name )
                         html += "<option value='" + data[index].district_name + "'>" + data[index].district_name + "</option>";
                    }
                }
                $('#c_district').html(html);
            }

        });
    }
    }


    $("#p_district").on('change', function () {
        var p_district =document.getElementById('p_district').value;
        // alert(p_district)
        get_town_name(p_district);
    });
    $("#c_district").on('change', function () {
        var c_district =document.getElementById('c_district').value;
        // alert(c_district)
        get_town_name_Current(c_district);
    });




    function get_town_name(p_district,p_town) {
        if (p_town == "") {
        $.ajax({
            url: get_town_name_link,
            method: "POST",
            data:{ "p_district" : p_district},
            dataType: "json",
            success: function(data) {
                // console.log(data)
                var html = '<option value="">Select</option>';
                for (let index = 0; index < data.length; index++) {
                    html += "<option value='" + data[index].town_name + "'>" + data[index].town_name + "</option>";
                }
                $('#p_town').html(html);
            }

        });
    }else{
         $.ajax({
            url: get_town_name_link,
            method: "POST",
            data:{ "p_district" : p_district},
            dataType: "json",
            success: function(data) {
                // console.log(data)
                var html = '<option value="">Select</option>';
                for (let index = 0; index < data.length; index++) {

                    if (p_town == data[index].town_name ) {
                    html += "<option value='" + data[index].town_name + "' selected>" + data[index].town_name + "</option>";
                    }else{
                         html += "<option value='" + data[index].town_name + "'>" + data[index].town_name + "</option>";
                    }
                }
                $('#p_town').html(html);
            }

        });
    }
    }
    function get_town_name_Current(c_district,c_town) {
        if (c_town == "") {
        $.ajax({
            url: get_town_name_curr_link,
            method: "POST",
            data:{ "c_district" : c_district},
            dataType: "json",
            success: function(data) {
                // console.log(data)
                var html = '<option value="">Select</option>';
                for (let index = 0; index < data.length; index++) {
                    html += "<option value='" + data[index].town_name + "'>" + data[index].town_name + "</option>";
                }
                $('#c_town').html(html);
            }

        });
    }else{
        // alert("asd")
         $.ajax({
            url: get_town_name_curr_link,
            method: "POST",
            data:{ "c_district" : c_district},
            dataType: "json",
            success: function(data) {
                // console.log(data)
                var html = '<option value="">Select</option>';
                for (let index = 0; index < data.length; index++) {

                    if (c_town == data[index].town_name ) {
                        html += "<option value='" + data[index].town_name + "' selected>" + data[index].town_name + "</option>";
                    }else{
                         html += "<option value='" + data[index].town_name + "'>" + data[index].town_name + "</option>";
                    }
                }
                // alert(html)
                $('#c_town').html(html);
            }

        });
    }
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
          // console.log(data.success);
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
            if((data['image']==null)){
                  $("#profile_img").attr('src',"../uploads/dummy.png");
                // default_profile
            }
          if (data['profile'] != ""){
              var dob = moment(data['profile'].dob).format('DD-MM-YYYY');
              var doj = moment(data['profile'].doj).format('DD-MM-YYYY');
              let skill = data['profile'].skill;
              // alert(skill)
             $('#pro_name').html(data['profile'].username);
             $('#can_name').html(data['profile'].username);
             $('#email').html(data['profile'].email);
             $('#blood_grp').html(data['profile'].blood_grp);
             $('#dob').html(dob);
            console.log(skill)
            
               /* for (let i = 0; i < skill.length; i++) {
                      console.log(skill[i]+ "<br>"); // here i represents index
                    }*/
             $('#contact_no').html(data['profile'].contact_no);
             $('#worklocation').html(data['profile'].worklocation);
             $('#designation').html(data['profile'].designation);
             $('#gender').html(data['profile'].gender);
             $('#dob_tx').html(dob);
             $('#payroll_status').html(data['profile'].payroll_status);
             $('#doj').html(doj);
             $('#worklocation_tx').html(data['profile'].worklocation);
             $('#department').html(data['profile'].department);
             $('#designation').html(data['profile'].designation);
             $('#grade').html(data['profile'].grade);
             $('#sup_name').html(data['profile'].sup_name);
             $('#reviewer_name').html(data['profile'].reviewer_name);
             $('#designation_tx').html(data['profile'].designation);
          }
          if(data['profile'] != ""){
            $("#profile_img").attr('src',"../uploads/"+data['image'].path);
          }
        }
    });
}

/*upload file in popup*/
$(()=>{
    // $('#btnSubmit').on('click',(e)=>{
        // alert('asdasdasdas')
$('#add_documents_unit').submit(function(e) {

        $(this).attr('disabled','disabled');
        $("#doc_Submit").text('Processing...');

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
         if(data.error)
           {
            $(".color-hider").hide();
                var keys=Object.keys(data.error);
                $.each( data.error, function( key, value ) {
                $("#"+key+'_error').text(value)
                $("#"+key+'_error').show();
                });
           }
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
                    html +='<h5><a href="../uploads/'+  data[index].path +'" class="text-info" target =_blank>' + data[index].doc_name + '</a></h5>';
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
            // console.log(data)
            if (data !="") {
                    $('#acc_mobile').val(data['0'].acc_mobile);
                    $('#acc_name').val(data['0'].acc_name);
                    $('#acc_number').val(data['0'].acc_number);
                    $('#bank_name').val(data['0'].bank_name);
                    $('#branch_name').val(data['0'].branch_name);
                    $('#ifsc_code').val(data['0'].ifsc_code);
                    $('#con_acc_number').val(data['0'].con_acc_number);
                }
            }
        });
    }

$('#add_account_info').submit(function(e) {
    // alert("asdasd")

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
            if (data !="") {
                $('#education_td').empty();
                        html ='';
                    $.each(data, function (key, val) {
                        html +='<tr>';
                        html +='<td data-label="allcount">'+val.degree+'</td>';
                        html +='<td data-label="allcount">'+val.university+'</td>';
                        html +='<td data-label="allcount">'+val.edu_start_month+"-"+val.edu_start_year+'</td>';
                        html +='<td data-label="allcount">'+val.edu_end_month+"-"+val.edu_end_year+'</td>';
                        /*for(var i = 0; i < val.skill.split(",").length; i++){
                                html +='<td data-label="allcount">'+ val.skill.split(",")[i] + '</td>';
                            }*/
                        html +='<td data-label="allcount"><a href="../education/'+ val.edu_certificate +'" target =_blank><img class="rounded-circle" src="../assets/images/user/1.jpg"  alt=""></a></td>';

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
            if(data.error){
                // alert("assa")
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

$('#add_experience_unit').submit(function(e) {
    e.preventDefault();
      var formData = new FormData(this);
    $.ajax({
        url:experience_information_link,
        method:"POST",
        data:formData,
        processData:false,
        cache:false,
        contentType:false,
        dataType:"json",
        success:function(data) {
            if(data.error){
                // alert("assa")
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

function experience_info(){
    $.ajax({
        url: experience_info_link,
        method: "POST",
        data:{},
        dataType: "json",
        success: function(data) {
            // console.log(data)
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
                        html +='Job Title : <a href="../experience/'+  data[index].certificate +'" class="text-info" target =_blank > ' + data[index].job_title + '</a><br>';
                        html +="<p>Company Name :" + data[index].company_name + "</p>";
                        html +="<p>Begin On : " + data[index].exp_start_month + ' - ' + data[index].exp_start_year + "</p>";
                        html +="<p>End On : " +data[index].exp_end_month + ' - ' + data[index].exp_end_year + "</p>";
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

function family_information(){
    $.ajax({
        url: family_information_get_link,
        method: "POST",
        data:{},
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
