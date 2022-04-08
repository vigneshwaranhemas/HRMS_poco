$( document ).ready(function() {
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

$(document).ready(function(){
    get_permision_role_list();
});

//Menu list show
function get_permision_role_list(){
    $.ajax({
        url: get_permision_role_link,
        method: "POST",
        data:{},
        dataType: "json",
        success: function(data) {
            // console.log(data)
            var html = '';
            for (let index = 0; index < data.length; index++) {
                html += "<div class='row rounded test_data alert-primary'>";
                html += "<div class='col-md-12 b-all m-t-10' id='tes_data"+index+"'></div>";

                html +="<div class='col-md-4 text-center p-10 bg-inverse '><h5 class='text-white'><strong id='role_display_name'>"+ data[index].name +"</strong></h5></div><div class='col-md-4 text-center bg-inverse role-members'><a class='btn btn-xs btn-danger btn-rounded show-members' data-role-id='0'><i class='fa fa-users'></i> 3 Member(s)</a></div><div class='col-md-4 p-10 bg-inverse' style='padding-bottom: 11px !important;'><button class='btn btn-success btn-rounded pull-right toggle-permission' id='function_data' custom-data='"+data[index].role_id+"' data-role-id='0' onclick=get_menu_list("+index+",'"+data[index].role_id+"') ><i class='fa fa-key'></i> Permissions</button><input type='hidden' id='hid_value"+index+"' value='0'></div><table class='table col-md-12 b-all m-t-10 sub_menu_list ' id='dyntable"+index+"' style='display:none;'><thead><tr class='bg-white'><th>Name</th><th>Sub Menus</th><th>View</th><th>Update</th><th>Edit</th><th>Delete</th></tr></thead><tbody id='premission_tbody"+index+"'></tbody></table><button style='display:none;' class='btn btn-success' onclick=sub_menu_save("+index+",'"+data[index].role_id+"') id='hidbutton"+index+"'> save</button>";
                html += "</div><br>";                
            }
            // $.getScript("http://127.0.0.1:8000/plugins/bower_components/switchery/dist/switchery.min.js");
            // $.getScript("http://127.0.0.1:8000/plugins/bower_components/switchery/dist/switchery.min.css");
            $('.menu_list').html(html);
        }
    });
}

    
/*get menu list */
    function get_menu_list(e,role_id){
        var role_id=$("#function_data").attr('custom-data');
        // alert(role_id)
        var dashboard=[];
        var blog=[];
        $.ajax({
            url: get_menu_link,
            method: "POST",
            data:{role_id:role_id},
            dataType: "json",
            success: function(data) {
                // alert($("#hid_value"+e).val())

                if($("#hid_value"+e).val()==0){
                 $("#hid_value"+e).val(1);   
                 $("#dyntable"+e).show();                    
                 $("#hidbutton"+e).show();                    
                }else{
                 $("#dyntable"+e).hide(); 
                 $("#hid_value"+e).val(0);   
                 $("#hidbutton"+e).hide(0);   
                }
                $('#premission_tbody'+e).empty();
                $('#premission_tbody'+e).append(data);
                
            }
        });
    
}

//table save a data 
    function sub_menu_save(e,text){
           var i=0;
            var selected=[];
           
        $('#dyntable'+e+' tbody>tr').each(function () {
            var currrow=$(this).closest('tr');
            var col0=currrow.find('td:eq(0)').text();
              if(col0!=""){
               
            }
            else{
             var text_value=currrow.find('td:eq(0) input[type=hidden]').val();
             var col1=currrow.find('td:eq(1)').text();
             var col2=currrow.find('td:eq(2) input[type=checkbox]').is(':checked');
             if(col2){
                col2=1
             }
             else{
                col2=0
             }
             var col3=currrow.find('td:eq(3) input[type=checkbox]').is(':checked');
             if(col3){
                col3=2
             }
             else{
                col3=0
             }var col4=currrow.find('td:eq(4) input[type=checkbox]').is(':checked');
             if(col4){
                col4=3
             }
             else{
                col4=0
             }var col5=currrow.find('td:eq(5) input[type=checkbox]').is(':checked');
             if(col5){
                col5=4
             }
             else{
                col5=0
             }
                selected.push({
                    role:text,
                    menu:text_value,
                    sub_menu:col1,
                    view:col2,
                    update:col3,
                    add:col4,
                    delete:col5,
                });    
            }            
   
          i++;
  
    });
     $.ajax({
            url: get_sub_menu_save_link,
            method: "POST",
            data:{selected:selected},
            dataType: "json",
            success: function(data) {
                // console.log(data)
                if(data !=''){
                    Toastify({
                        text: "Role Added Successfully",
                        duration: 3000,
                        close:true,
                        backgroundColor: "#4fbe87",
                    }).showToast();
                    
                }
                else{
                    Toastify({
                        text: "Role is wrong",
                        duration: 3000,
                        close:true,
                        backgroundColor: "#f3616d",
                    }).showToast();
                   
                }
            }
        });
    }

    



