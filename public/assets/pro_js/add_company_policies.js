$( document ).ready(function() {
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

$(document).ready(function(){
    // get_division_list();
    get_policy_category();
});


//Insertion
$(()=>{
    $('#btnSubmit').on('click',(e)=>{
    //    alert("abc");
   e.preventDefault();

   $.ajax({
       url:add_policy_category_process_link,
       method:"POST",
       data: $("#add_policy_category").serialize(),
       dataType:"json",

       success:function(data) {
        //    alert('sdf')
           console.log(data);
           $('#btnSubmit').prop("disabled",false);
               $('#btnSubmit').html('Submit');
               $('#policy_category_input').val('');

           if(data.response =='success'){
                $('#exampleModal').click();

               Toastify({
                   text: "Added Sucessfully..!",
                   duration: 3000,
                   close:true,
                   backgroundColor: "#4fbe87",
               }).showToast();

               setTimeout(
                   function() {
                    // get_division_list();
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
       error: function(response) {

        $('#policy_category_error').text(response.responseJSON.errors.policy_category);

        }

   });
    })
})

function get_policy_category(){

    // $('#division_edit_pop_modal_div').modal('show');

    $.ajax({
        url: get_policy_category_details_link,
        method: "POST",
        dataType: "json",
        success: function(data) {
            // console.log(data)

            if(data.length !=0){
                // $('#policy_category').val(data[0].policy_category);
                // $('#ed_id').val(id);
                var html = '<option value="">Select</option>';
                for (let index = 0; index < data.length; index++) {
                    html += "<option value=" + data[index].cp_id + ">" + data[index].policy_category + "</option>";
                }
                $('#policy_category').html(html);
            }
        }
    });
}


// $(()=>{
//     $("#add_policy_information").submit(function(e) {
//         e.preventDefault();
//         var d = $('#file')[0].files[0]
//         var formData = new FormData($('#add_policy_information')[0]);

//         formData.append('image',d);
//         for (var p of formData) {
//             console.log(p);
//           }
//         // $.ajax({
//         //     url: "Insert_policy_information",
//         //     type: 'POST',
//         //     data: formData,
//         //     success: function (data) {
//         //         // alert(data)
//         //         console.log(data)
//         //     },
//         //     cache: false,
//         //     contentType: false,
//         //     processData: false
//         // });
//     });
// })


//Insertion
$(()=>{
    $('#info_submit').on('click',(e)=>{
    //    alert("abc");
   e.preventDefault();

   $.ajax({
       url:add_policy_information_process_link,
       method:"POST",
       data: $("#add_policy_information").serialize(),
       dataType:"json",

       success:function(data) {
        //    alert('sdf')
           console.log(data);
           $('#info_submit').prop("disabled",false);
               $('#info_submit').html('Submit');
            //    $('#policy_category_input').val('');

        //    if(data.response =='success'){
        //         $('#exampleModal2').click();

        //        Toastify({
        //            text: "Added Sucessfully..!",
        //            duration: 3000,
        //            close:true,
        //            backgroundColor: "#4fbe87",
        //        }).showToast();

        //        setTimeout(
        //            function() {
        //             // get_division_list();
        //             location.reload();
        //            }, 2000);
        //    }
        //    else{
        //        Toastify({
        //            text: "Request Failed..! Try Again",
        //            duration: 3000,
        //            close:true,
        //            backgroundColor: "#f3616d",
        //        }).showToast();

        //        setTimeout(
        //            function() {
        //                location.reload();
        //            }, 2000);
        //    }

       },
       error: function(response) {

        // $('#policy_category_error').text(response.responseJSON.errors.policy_category);

        }

   });
    })
})