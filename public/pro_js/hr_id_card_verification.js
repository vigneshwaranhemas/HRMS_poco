
$(document).ready(function(){
    // hr_id_card_ver();
});



function hr_id_card_ver(id){
    // var params = new window.URLSearchParams(window.location.search);
    // var id=params.get('id')
    // alert(id)
    $.ajax({
        url:hr_card_varification_link,
        method: "POST",
        data:{"id":id,},
        dataType: "json",
        success: function(data) {
             // console.log(data);
           if (data !="") {
                    $('#can_id').val(data[0].id);
                    $('#can_id_hr').val(data[0].id);
                    $('#img_path_hide').val(data[0].img_path);
                    $("#pro_img").attr('src',"../ID_card_photo/"+data[0].img_path+".jpg");
                    $('#f_name').val(data[0].username);
                    $('#m_name').val(data[0].m_name);/**/
                    $('#l_name').val(data[0].l_name);/**/
                    $('#working_loc').val(data[0].worklocation);
                    $('#emp_num_1').val(data[0].contact_no);
                    $('#emp_num_2').val(data[0].emp_num_2);/**/
                    $('#rel_emp').val(data[0].rel_emp);/**/
                    $('#name_rel_ship').val(data[0].name_rel_ship);/**/
                    $('#emrg_con_num').val(data[0].emrg_con_num);/**/
                    $('#doj').val(data[0].doj);
                    $('#blood_grp').val(data[0].blood_grp);/**/
                    $('#emp_code').val(data[0].empID);
                    $('#official_email').val(data[0].email);
                    $('#emp_dob').val(data[0].dob);
                    $('#p_email').val(data[0].p_email);
                }
                if (data[0].hr_action ==2 ) {
                        $('#hr_acc_but').hide();
                        $('.readone').prop("readonly",true);
                        $('.readone_1').prop("disabled",true);
                        $('#rev_but').hide();
                    }else{
                        $('.readone').prop("readonly",false);
                        $('.readone_1').prop("disabled",false);
                        $('#hr_acc_but').show();
                        $('#rev_but').show();
                    }
            $("#idModal").modal('show')
        }
    });
}

$('#hr_idcard_info').submit(function(e) {  

    $(this).attr('disabled','disabled');   
    $("#hr_acc_but").text('Processing...');   
    
        e.preventDefault();
          var formData = new FormData(this);
        $.ajax({  
            url:hr_idcard_verfi_link, 
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
                if(data.response =='Update'){
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

$('#hr_remarks_form').submit(function(e) {

    $(this).attr('disabled','disabled');   
    $("#hr_rev_but").text('Processing...');   

    // alert("asdasds")    
        e.preventDefault();
          var formData = new FormData(this);
        $.ajax({  
            url:hr_id_remark_link, 
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
                if(data.response =='Update'){
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