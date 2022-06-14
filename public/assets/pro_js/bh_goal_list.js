$( document ).ready(function() {
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

$(document).ready(function(){
    bh_all_member_filter();
    add_goal_btn();
});


$(()=>{
    $("#profile-info-tab").on('click',()=>{
      Get_all_team_member_data();
    })
})



 function bh_supervisor_filter()
 {
      var one=$('#supervisor_filter1').val();
      $.ajax({
          url:supervisor_filter_url,
          type:"POST",
          data:{id:one},
          beforeSend:function(data){
              console.log("Loading!...")
          },
          success:function(response){
            $('#team_member_goal_data').DataTable().clear().destroy();
              $("#bh_table_data_id").empty();
              console.log(response);
            var res=JSON.parse(response);
            for(var i=0;i<res.length;i++){
                var tr="<tr>";
                var td="<td>"+i+"</td>";
                var td1="<td>"+res[i].created_by_name+"</td>";
                var td2="<td>"+res[i].goal_name+"</td>";
                if(res[i].goal_status=="Pending")
                {
                    var color_class="btn btn-danger";
                }
                else if(res[i].goal_status=="Revert"){
                    var color_class="btn btn-primary";

                }
                else if(res[i].goal_status=="Approved"){
                    var color_class="btn btn-success";

                }
                var td3="<td><button class='"+color_class+" btn-xs goal_btn_status' type='button'>"+res[i].goal_status+"</button></td>"

                var td4="<td><div class='dropup'>\
                        <a href='goal_setting_bh_reviewer_view?id="+res[i].goal_unique_code+"' ><button type='button' class='btn btn-secondary' style='padding:0.37rem 0.8rem !important;' id='dropdownMenuButton'><i class='fa fa-eye'></i></button></a>\
                                </div>'</td></tr>";

                $('#team_member_goal_data').append(tr+td+td1+td2+td3+td4);

            }

            $('#team_member_goal_data').DataTable( {
                "searching": false,
                "paging": false,
                "info":     false,
                "fixedColumns":   {
                        left: 6
                    }
            } );



          }
      })
 }

//PMS Instruction
$('#pms_instruction').on('click',function(){    
    $('#pmsInstructionModal').modal('show');      
});

 function Get_all_team_member_data(){
    $.ajax({
        url:get_all_member_info_url,
        type:"GET",
        // data:{id:one},
        beforeSend:function(data){
            console.log("Loading!...")
        },
        success:function(response){
          $('#team_member_goal_data').DataTable().clear().destroy();
        //   $("#bh_table_data_id").empty();
          var res=JSON.parse(response);
          console.log(res);

          for(var i=0;i<res.length;i++){
              var tr="<tr>";
              var td="<td>"+(i+1)+"</td>";
              var td1="<td>"+res[i].created_by_name+"</td>";
              var td2="<td>"+res[i].goal_name+"</td>";
              if(res[i].goal_status=="Pending")
              {
                  var color_class="btn btn-danger";
              }
              else if(res[i].goal_status=="Revert"){
                  var color_class="btn btn-primary";

              }
              else if(res[i].goal_status=="Approved"){
                  var color_class="btn btn-success";

              }
              var td3="<td><button class='"+color_class+" btn-xs goal_btn_status' type='button'>"+res[i].goal_status+"</button></td>"

                var td4="<td><div class='dropup'>\
                        <a href='goal_setting_bh_reviewer_view?id="+res[i].goal_unique_code+"' ><button type='button' class='btn btn-secondary' style='padding:0.37rem 0.8rem !important;' id='dropdownMenuButton'><i class='fa fa-eye'></i></button></a>\
                                </div>'</td></tr>";
              $('#team_member_goal_data').append(tr+td+td1+td2+td3+td4);

          }

          $('#team_member_goal_data').DataTable( {
            "searching": false,
            "paging": false,
            "info":     false,
            "fixedColumns":   {
                    left: 6
                }
        } );



        }
    })
 }




function add_goal_btn(){
    $.ajax({
        url:"add_goal_btn",
        type:"GET",
        dataType : "JSON",
        success:function(response)
        {
            // alert(response)
            if(response == "Yes"){
                $('#add_goal_btn').css('display', 'none');
            }else{
                $('#add_goal_btn').css('display', 'block');
            }
        },
        error: function(error) {
            console.log(error);

        }

    });
}


function team_member_goal_record(){
    table_cot = $('#team_member_goal_data').DataTable({
        searching:false,
        paging:false,
        info:false,
        fixedColumns:{
          left:6
        },
        lengthChange: true,
        lengthMenu: [[10, 50, 100, 250, 500, -1], [10, 50, 100, 250, 500, "All"]],
        processing: true,
        serverSide: true,
        serverMethod: 'post',
        bDestroy: true,
        scrollCollapse: true,
        drawCallback: function() {

        },
        // aoColumnDefs: [
        //     { 'visible': false, 'targets': [3] }
        // ],
        ajax: {
            url: "get_bh_goal_list",
            type: 'GET',
            dataType: "json",
            data: function (d) {
                d.reviewer_filter = $('#reviewer_filter').val();
                d.team_leader_filter = $('#team_leader_filter').val();
                d.team_member_filter = $('#team_member_filter').val();
            }
        },
        createdRow: function( row, data, dataIndex ) {
            // $( row ).find('td:eq(0)').attr('data-label', 'Sno');
            // $( row ).find('td:eq(1)').attr('data-label', 'Business Name');
            // $( row ).find('td:eq(2)').attr('data-label', 'action');
        },
        columns: [
            {   data: 'DT_RowIndex', name: 'DT_RowIndex'    },
            {   data: 'created_by_name', name: 'created_by_name'    },
            {   data: 'goal_name', name: 'goal_name'    },
            {   data: 'status', name: 'status'    },
            {   data: 'action', name: 'action'  },

            // {   data: 'Info', name: 'Info'  },

        ],
    });
}

function clearFunction() {
    $('#team_member_filter').val('');
    team_member_goal_record();
}

$('#team_member_filter').change(function() {
    // team_member_goal_record();
});

$('#reviewer_filter').change(function() {
    var reviewer_filter = $('#reviewer_filter').val();

    if(reviewer_filter != ''){
        $.ajax({
            url:"fetch_reviewer_filter",
            type:"GET",
            data:{reviewer_filter:reviewer_filter},
            dataType : "JSON",
            success:function(response)
            {
                // console.log(response)
                $('#team_leader_filter').html(response);
            },
            error: function(error) {
                console.log(error);

            }

        });
    }

});

$('#team_leader_filter').change(function() {
    var team_leader_filter = $('#team_leader_filter').val();

    if(team_leader_filter != ''){
        $.ajax({
            url:"fetch_team_leader_filter",
            type:"GET",
            data:{team_leader_filter:team_leader_filter},
            dataType : "JSON",
            success:function(response)
            {
                // console.log(response)
                $('#team_member_filter').html(response);
            },
            error: function(error) {
                console.log(error);

            }

        });
    }

});

// for export all data
function newexportaction(e, dt, button, config) {
    var self = this;
    var oldStart = dt.settings()[0]._iDisplayStart;
    dt.one('preXhr', function (e, s, data) {
        // Just this once, load all data from the server...
        data.start = 0;
        data.length = 2147483647;
        dt.one('preDraw', function (e, settings) {
            // Call the original action function
            if (button[0].className.indexOf('buttons-copy') >= 0) {
                $.fn.dataTable.ext.buttons.copyHtml5.action.call(self, e, dt, button, config);
            } else if (button[0].className.indexOf('buttons-excel') >= 0) {
                $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
                    $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config) :
                    $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
            } else if (button[0].className.indexOf('buttons-csv') >= 0) {
                $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
                    $.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button, config) :
                    $.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt, button, config);
            } else if (button[0].className.indexOf('buttons-pdf') >= 0) {
                $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
                    $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config) :
                    $.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt, button, config);
            } else if (button[0].className.indexOf('buttons-print') >= 0) {
                $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
            }
            dt.one('preXhr', function (e, s, data) {
                // DataTables thinks the first item displayed is index 0, but we're not drawing that.
                // Set the property to what it was before exporting.
                settings._iDisplayStart = oldStart;
                data.start = oldStart;
            });
            // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
            setTimeout(dt.ajax.reload, 0);
            // Prevent rendering of the full data to the DOM
            return false;
        });
    });
    // Requery the server with the new one-time export settings
    dt.ajax.reload();
}

//Delete Record
$('#goal_data').on('click','.deleteRecord',function(){
    // alert("delete");
    var id = $(this).data('id');
    // alert(id)
    $('#goalsDeleteModal').modal('show');
    $('#goals_id_delete').val(id);

});

$("#formGoalDelete").submit(function(e) {
    e.preventDefault();

    $('button[type="submit"]').attr('disabled' , true);

    $.ajax({
        url:"goals_delete",
        type:"POST",
        data:$('#formGoalDelete').serialize(),
        dataType : "JSON",
        success:function(data)
        {
            Toastify({
                text: "Deleted Sucessfully..!",
                duration: 3000,
                close:true,
                backgroundColor: "#4fbe87",
            }).showToast();

            $('button[type="submit"]').attr('disabled' , false);
            $('#goalsDeleteModal').modal('hide');
            goal_record();
            // window.location = "{{ url('goals')}}";
            // $("#goal_data").load("{{url('get_goal_list')}}");
        },
        error: function(response) {
            // alert(response.responseJSON.errors.business_name_option);
            // $('#business_name_option_error').text(response.responseJSON.errors.business_name);

        }

    });

});

function bh_filter_apply(){
    team_member_goal_record();
}


$(()=>{
    $("#testing_one").on('click',(e)=>{
        e.preventDefault();
        $("#reviewer_filter").val('').trigger('change');
        $("#team_leader_filter").val('').trigger('change');
        $("#team_member_filter").val('').trigger('change');
        Get_all_team_member_data();
    })
})

function reviewer_filter_reset(){
    $("#supervisor_filter").val('').trigger('change');
    $("#team_leader_filter1").val('').trigger('change');
    get_reviewer_data_bh();
}
function bh_supervisor_filter_reset(){
    $("#supervisor_filter1").val('').trigger('change');
    bh_all_member_filter();

}

$(()=>{
    $("#info-home-tab").on('click',(e)=>{
      team_member_goal_record();
    })
})

//get overall user data under reviewer created by vignesh
$(()=>{
    $('#info-reviewer-tab').on('click',(e)=>{
        get_reviewer_data_bh();
    })
})

//get userdata with reviewer drop down filter
function get_reviewer_data_bh(){
    $.ajax({
        url:get_reviewer_tab_url,
        type:"GET",
        beforeSend:function(data){
            console.log("Loading!...")
        },
        success:function(response){
           $('#team_member_goal_data').DataTable().clear().destroy();
           $("#bh_table_data_id").empty();
           var res=JSON.parse(response);
           var  user_data=res.result;
           var user_info=res.user_info_unser_reviewer;
           for(var j=0;j<user_info.length;j++){
               var option ="<option value="+user_info[j].empID+">"+user_info[j].username+"</option>";
               $("#supervisor_filter").append(option);
           }

           for(var i=0;i<user_data.length;i++){
              var tr="<tr>";
              var td="<td>"+(i+1)+"</td>";
              var td1="<td>"+user_data[i].created_by_name+"</td>";
              var td2="<td>"+user_data[i].goal_name+"</td>";
              if(user_data[i].goal_status=="Pending")
              {
                  var color_class="btn btn-danger";
              }
              else if(user_data[i].goal_status=="Revert"){
                  var color_class="btn btn-primary";

              }
              else if(user_data[i].goal_status=="Approved"){
                  var color_class="btn btn-success";

              }
              var td3="<td><button class='"+color_class+" btn-xs goal_btn_status' type='button'>"+user_data[i].goal_status+"</button></td>"

              var td4="<td><div class='dropup'>\
              <a href='goal_setting_bh_reviewer_view?id="+user_data[i].goal_unique_code+"' ><button type='button' class='btn btn-secondary' style='padding:0.37rem 0.8rem !important;' id='dropdownMenuButton'><i class='fa fa-eye'></i></button></a>\
                      </div>'</td></tr>";

              $('#team_member_goal_data').append(tr+td+td1+td2+td3+td4);

          }

          $('#team_member_goal_data').DataTable( {
            "searching": false,
            "paging": false,
            "info":     false,
            "fixedColumns":   {
                    left: 6
                }
        } );



        }
    })
}


$(()=>{
    $('#supervisor_filter').on('change',()=>{
        var data=[];
        var supervisor_id=$("#supervisor_filter").val();
        var employee_id=$("#team_leader_filter1").val();
        data.push({
            sup_id:supervisor_id,
            emp_id:employee_id,
            id:2
        });
        get_filtered_reviewer_data(data)
    })
})

//get userdata with  reviwer wise filter


function bh_reviewer_filter(){
    var data=[];
     var supervisor_id=$("#supervisor_filter").val();
     var employee_id=$("#team_leader_filter1").val();
     if(supervisor_id!="" && employee_id!=""){
           data.push({
               sup_id:supervisor_id,
               emp_id:employee_id,
               id:1
           });
        get_filtered_reviewer_data(data)

     }
     if(supervisor_id!="" && employee_id==""){
        data.push({
            sup_id:supervisor_id,
            emp_id:employee_id,
            id:2
        });

        get_filtered_reviewer_data(data)
     }
     if(supervisor_id=="" && employee_id==""){
        get_reviewer_data_bh(data);
     }
}


function  get_filtered_reviewer_data(one){

    // console.log(one[0].emp_id)
     $.ajax({
         url:get_reviewer_filter_url,
         type:"POST",
         data:{data:one},
         beforeSend:function(data){
             console.log("Loading!....")
         },
         success:function(response){
             var res=JSON.parse(response);
             $("#team_leader_filter1").empty();
             $('#team_member_goal_data').DataTable().clear().destroy();
             var user_info=res.user_info;
             var result=res.result;
             var option ="<option value=''>...Select..</option>";
             $("#team_leader_filter1").append(option);
                for(var j=0;j<user_info.length;j++){
                    var option ="<option value="+user_info[j].empID+" "+(user_info[j].empID==one[0].emp_id ? "selected" : "")+">"+user_info[j].username+"</option>";
                    $("#team_leader_filter1").append(option);
               }
            //  }
             for(var i=0;i<result.length;i++){
                var tr="<tr>";
                var td="<td>"+(i+1)+"</td>";
                var td1="<td>"+result[i].created_by_name+"</td>";
                var td2="<td>"+result[i].goal_name+"</td>";
                if(result[i].goal_status=="Pending")
                {
                    var color_class="btn btn-danger";
                }
                else if(result[i].goal_status=="Revert"){
                    var color_class="btn btn-primary";

                }
                else if(result[i].goal_status=="Approved"){
                    var color_class="btn btn-success";

                }
                var td3="<td><button class='"+color_class+" btn-xs goal_btn_status' type='button'>"+result[i].goal_status+"</button></td>"

                var td4="<td><div class='dropup'>\
                <a href='goal_setting_bh_reviewer_view?id="+result[i].goal_unique_code+"' ><button type='button' class='btn btn-secondary' style='padding:0.37rem 0.8rem !important;' id='dropdownMenuButton'><i class='fa fa-eye'></i></button></a>\
                        </div>'</td></tr>";

                $('#team_member_goal_data').append(tr+td+td1+td2+td3+td4);

            }

            $('#team_member_goal_data').DataTable( {
                // dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ]
            } );



          }


     })
}

function bh_all_member_filter(){
      $.ajax({
          url:"get_all_supervisors_info_bh",
          type:"GET",
          beforeSend:function(data){
              console.log("Loading!...")
          },
          success:function(response){
            var result=JSON.parse(response);
            $('#team_member_goal_data').DataTable().clear().destroy();
            for(var i=0;i<result.length;i++){
                var tr="<tr>";
                var td="<td>"+(i+1)+"</td>";
                var td1="<td>"+result[i].created_by_name+"</td>";
                var td2="<td>"+result[i].goal_name+"</td>";
                if(result[i].goal_status=="Pending")
                {
                    var color_class="btn btn-danger";
                }
                else if(result[i].goal_status=="Revert"){
                    var color_class="btn btn-primary";

                }
                else if(result[i].goal_status=="Approved"){
                    var color_class="btn btn-success";

                }
                var td3="<td><button class='"+color_class+" btn-xs goal_btn_status' type='button'>"+result[i].goal_status+"</button></td>"
                var td4="<td><div class='dropup'>\
                        <a href='goal_setting_bh_reviewer_view?id="+result[i].goal_unique_code+"' ><button type='button' class='btn btn-secondary' style='padding:0.37rem 0.8rem !important;' id='dropdownMenuButton'><i class='fa fa-eye'></i></button></a>\
                                </div>'</td></tr>";
                $('#team_member_goal_data').append(tr+td+td1+td2+td3+td4);
            }

            $('#team_member_goal_data').DataTable( {
                "searching": false,
                "paging": false,
                "info":     false,
                "fixedColumns":   {
                        left: 6
                    }
            } );
          }
      })
}
