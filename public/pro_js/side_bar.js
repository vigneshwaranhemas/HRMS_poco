$(document).ready(function (){

     $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    get_side_bar();
});

function get_side_bar(){

 $.ajax({
        url: get_session_sidebar_link,
        method: "POST",
        data:{},
        dataType: "json",
        success: function(data) {

        }
    });
}