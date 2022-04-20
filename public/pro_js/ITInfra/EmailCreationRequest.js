
$(()=>{
    $('#EmailStatusUpdateBtn').on('click',(e)=>{
        var token=$("#token").val();
        e.preventDefault();
        var selected=[];
        $('#export-button tbody>tr').each(function () {
            var currrow=$(this).closest('tr');
            if(currrow.find('td:eq(1) input[type=checkbox]').is(':checked')){
                  var col2=currrow.find('td:eq(2)').text();
                   selected.push({
                     cdID:col2
                   });
            }
        });
        $.ajax({
            url:url,
            type:"POST",
            data:{empID:selected,_token:token},
            beforeSend:(e)=>{
               console.log("Loading!.....");
            },
            success:(response)=>{
                var res=JSON.parse(response);
                console.log(res);
                // if(res.success==1){
                //     Toastify({
                //         text: res.message,
                //         duration: 3000,
                //         close:true,
                //         backgroundColor: "#4fbe87",
                //         }).showToast();
                //         setTimeout(
                //             function() {
                //                 location.reload();;
                //             }, 2000);
                // }
                // else{
                //     Toastify({
                //         text: res.message,
                //         duration: 3000,
                //         close:true,
                //         backgroundColor: "#f3616d",
                //         }).showToast();
                //         setTimeout(
                //             function() {
                //                 location.reload();;
                //             }, 2000);
                // }
            }
        })
    })
})
