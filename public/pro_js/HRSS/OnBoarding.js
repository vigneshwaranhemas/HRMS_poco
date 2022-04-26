function model_trigger(one){
    $('#emp_hidden_id').val(one);
    $('#exampleModal').modal('show');
}
function edit_modal(one){
    $("#can_hidden_id").val(one)
    $('#ConformationModal').modal('show');

  }
function user_documents(id)
{
    window.location.href="userdocuments?id="+id;
}
$(()=>{
    //Employee Id creation For Candidate Created By Hr
     $('#EmpIdCreationBtn').on('click',(e)=>{
         var token=$("#token").val();
        if($('#NewEmpId').val()==""){
            Toastify({
                text:"Please Enter the Employee Id",
                duration: 3000,
                close:true,
                backgroundColor: "#f3616d",
                }).showToast();
        }
        else{
                $.ajax({
                url:email_and_seat_request_url,
                type:"POST",
                data:{empID: $("#NewEmpId").val(),old_empID:$('#emp_hidden_id').val(),_token:token},
                beforeSend:(e)=>{
                    console.log("Loading!.....");
                },
                success:(response)=>{
                    var res=JSON.parse(response);
                    if(res.success==0)
                    {
                        Toastify({
                            text:res.message,
                            duration: 3000,
                            close:true,
                            backgroundColor: "#f3616d",
                            }).showToast();
                    }
                    else{
                        Toastify({
                            text: res.message,
                            duration: 3000,
                            close:true,
                            backgroundColor: "#4fbe87",
                            }).showToast();
                    }
                }
        })
        }
     })
})
//user document status update by vignesh
$(()=>{
     $("#DocStatusBtn").on('click',(e)=>{
         e.preventDefault();
         var doc_status = $('#userDocStatus').find(":selected").val();
         var params = new window.URLSearchParams(window.location.search);
         var id=params.get('id')
         $.ajax({
            url:DocumentStatusurl,
            type:"POST",
            data:{status:doc_status,id},
            beforeSend:(e)=>{
                console.log("Loading!...");
            },
            success:(response)=>{
                var res=JSON.parse(response);
                if(res.success==1)
                {
                    Toastify({
                        text:res.message,
                        duration: 3000,
                        close:true,
                        backgroundColor: "#4fbe87",
                        }).showToast();
                        setTimeout(
                            function() {
                                location.reload();;
                            }, 2000);
                }
                else{
                    Toastify({
                        text: res.message,
                        duration: 3000,
                        close:true,
                        backgroundColor: "#f3616d",
                        }).showToast();
                        setTimeout(
                            function() {
                                location.reload();;
                            }, 2000);
                }
            }
        })
     })

})
//candidate Onboard status update work by vignesh
$(()=>{
    $('#Candidate_Status_update').on('click',(e)=>{
        var cdID=$("#can_hidden_id").val();
        $.ajax({
            url:Candidate_status_update,
            type:"POST",
            data:{id:cdID},
            beforeSend:(e)=>{
                console.log("Loading!...");
            },
            success:(response)=>{
                var res=JSON.parse(response);
                if(res.success==1)
                {
                    Toastify({
                        text:res.message,
                        duration: 3000,
                        close:true,
                        backgroundColor: "#4fbe87",
                        }).showToast();
                        setTimeout(
                            function() {
                                location.reload();;
                            }, 2000);
                }
                else{
                    Toastify({
                        text: res.message,
                        duration: 3000,
                        close:true,
                        backgroundColor: "#f3616d",
                        }).showToast();
                        setTimeout(
                            function() {
                                location.reload();;
                            }, 2000);
                }
            }
        })
    })
})
