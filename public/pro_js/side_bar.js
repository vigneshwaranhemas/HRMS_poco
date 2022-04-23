$(document).ready(function (){

     $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    get_side_bar();
});

// $(()=>{
//  $('.text_side,.active_side').on('click',function(){
//     // alert("asdasdasd")
//         // $('li').removeClass('open');
//         $('li').addClass('open');
//     });
   
// })

function test(one){
    // alert("one")
    $(one).addClass('open');
}
 
function get_side_bar(){

 $.ajax({
        url: get_session_sidebar_link,
        method: "POST",
        data:{},
        dataType: "json",
        success: function(data) {
          // console.log(data.sidebar_list)
          $('#sidebar_data').empty();

          $('#sidebar_data').append(data.sidebar_list);

        }
    });
}

