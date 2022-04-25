function model_trigger(one){
    $('#emp_hidden_id').val(one);
    $('#exampleModal').modal('show');
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
