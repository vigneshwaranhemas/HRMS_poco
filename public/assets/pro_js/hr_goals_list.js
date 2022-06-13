$( document ).ready(function() {
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
$(document).ready(function() {
    goal_record();
    get_supervisor();
    supervisor_goal_record();   
    add_goal_btn();
});

// $(".mail_class").on('click',function(){
//     alert('sassa');
// })

/*$('#listing_table tbody>tr td').on('change' ,'.mail_class', 'input[type="checkbox"]', function(){
    alert("one")
})*/


/*clear function*/
$("#reset").on('click', function() {
        $("#supervisor_list").val("").trigger('change'); 
        supervisor_goal_record();      
});$("#rev_reset").on('click', function() {
        $("#supervisor_list_1").val("").trigger('change');       
        $("#team_member_filter").val("").trigger('change');
        reviewer_goal_record();       
});$("#hr_reset").on('click', function() {
        $("#reviewer_filter").val("").trigger('change');       
        $("#team_leader_filter_hr").val("").trigger('change');       
        $("#team_member_filter_hr").val("").trigger('change'); 
         $("#gender_hr_2").val("").trigger('change');       
        $("#grade_hr_2").val("").trigger('change');       
        $("#department_hr_2").val("").trigger('change');  
        hr_dttable_record();     
});$("#myself_reset").on('click', function() {
        $("#reviewer_filter_1").val("").trigger('change');       
        $("#team_leader_filter_hr_1").val("").trigger('change');       
        $("#team_member_filter_hr_1").val("").trigger('change');       
        $("#gender_hr_1").val("").trigger('change');       
        $("#grade_hr_1").val("").trigger('change');       
        $("#department_hr_1").val("").trigger('change');  
        hr_listing_tab_record();     
});
/*all search click */
$('#supervisor_list_1').on('change',function() {
    get_team_member_list();
    });
$('#reviewer_filter').on('change',function() {
    get_manager_lsit_drop();
    });
$('#team_leader_filter_hr').on('change',function() {
    get_team_member_drop();
    });
$('#supervisor_filter').on('click',function() {
    supervisor_goal_record();
    });
$('#reviewer_apply').on('click',function() {
    reviewer_goal_record();
    });
$('#profile-info-tab').on('click',function() {
    get_hr_supervisor();
    hr_dttable_record();
    get_grade();
    get_department();
    $('#save_div_rev').hide();
    $('#save_div_hr').show();
    });
$('#hr_apply').on('click',function() {
    hr_dttable_record();
    });
$('#reviewer-info-tab').on('click',function() {
    // alert("ssss")
    reviewer_goal_record();
    $('#save_div_rev').show();
    $('#save_div_hr').hide();
    });
$('#listing-info-tab').on('click',function() {
    hr_listing_tab_record();
    get_hr_supervisor();
     get_grade();
     get_department();
    });
$('#reviewer_filter_1').on('change',function() {
    get_manager_lsit_drop_1();
    });
$('#team_leader_filter_hr_1').on('change',function() {
    get_team_member_drop_1();
    });
$('#list_apply').on('click',function() {
    hr_listing_tab_record();
    });
$('#MySelf-info-tab').on('click',function() {
    // alert("sa")
    $('#save_div_rev').hide();
    $('#save_div_hr').hide();
   goal_record();
    });

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

/*grade*/
function get_grade(){

    $.ajax({                   
        url:"get_grade",
        type:"GET",
        dataType : "JSON",
        success: function(data) {
            var html = '<option value="">Select</option>';
            for (let i = 0; i < data.length; i++) {
                html += "<option value='" + data[i].grade + "'>" + data[i].grade + "</option>";
            }
            // console.log(data)
            $('#grade_hr_1').html(html);
            $('#grade_hr_2').html(html);

        },
        error: function(error) {
            console.log(error);
        }                                              
            
    });
}
/*department*/
function get_department(){

    $.ajax({                   
        url:"get_department",
        type:"GET",
        dataType : "JSON",
        success: function(data) {
            // console.log(data)
            var html = '<option value="">Select</option>';
            for (let i = 0; i < data.length; i++) {
                html += "<option value='" + data[i].department + "'>" + data[i].department + "</option>";
            }
            $('#department_hr_1').html(html);
            $('#department_hr_2').html(html);

        },
        error: function(error) {
            console.log(error);
        }                                              
            
    });
}
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

function get_supervisor(){

    $.ajax({                   
        url:"get_supervisor",
        type:"GET",
        dataType : "JSON",
        success: function(data) {
            // console.log(data)
            var html = '<option value="">Select</option>';
            for (let index = 0; index < data.length; index++) {
                html += "<option value='" + data[index].empID + "'>" + data[index].username + "</option>";
            }
            $('#supervisor_list').html(html);
            $('#supervisor_list_1').html(html);

        },
        error: function(error) {
            console.log(error);
        }                                              
            
    });
}

function get_hr_supervisor(){

    $.ajax({                   
        url:"get_hr_supervisor",
        type:"GET",
        dataType : "JSON",
        success: function(data) {
            // console.log(data)
            var html = '<option value="">Select</option>';
            for (let index = 0; index < data.length; index++) {
                html += "<option value='" + data[index].empID + "'>" + data[index].username + "</option>";
            }
            /*$('#supervisor_list').html(html);*/
            $('#reviewer_filter').html(html);
            $('#reviewer_filter_1').html(html);

        },
        error: function(error) {
            console.log(error);
        }                                              
            
    });
}

function get_team_member_list(){
    var supervisor_list_1 = $('#supervisor_list_1').val();
    // alert(supervisor_list_1)
        $.ajax({                   
            url:"get_team_member_list",
            method: "POST",
            data:{ supervisor_list_1 : supervisor_list_1},
            dataType : "JSON",
            success: function(data) {
                // console.log(data)
                var html = '<option value="">Select</option>';
                for (let index = 0; index < data.length; index++) {
                    html += "<option value='" + data[index].empID + "'>" + data[index].username + "</option>";
                }
                $('#team_member_filter').html(html);

            },
            error: function(error) {
                console.log(error);
            }                                              
                
        });
}


function get_manager_lsit_drop(){
    var reviewer_filter = $('#reviewer_filter').val();
        // alert(reviewer_filter)
    $.ajax({                   
        url:"get_manager_lsit_drop",
        type:"POST",
        data:{ reviewer_filter : reviewer_filter},
        dataType : "JSON",
        success: function(data) {
            // console.log(data)
            var html = '<option value="">Select</option>';
            for (let index = 0; index < data.length; index++) {
                html += "<option value='" + data[index].empID + "'>" + data[index].username + "</option>";
            }
            $('#team_leader_filter_hr').html(html);
            $('#team_leader_filter_hr_1').html(html);
        },
        error: function(error) {
            console.log(error);
        }                                              
            
    });
}
function get_team_member_drop(){
    var team_leader_filter_hr = $('#team_leader_filter_hr').val();
    $.ajax({                   
        url:"get_team_member_drop",
        type:"POST",
        data:{ team_leader_filter_hr : team_leader_filter_hr },
        dataType : "JSON",
        success: function(data) {
            // console.log(data)
            var html = '<option value="">Select</option>';
            for (let index = 0; index < data.length; index++) {
                html += "<option value='" + data[index].empID + "'>" + data[index].username + "</option>";
            }
            $('#team_member_filter_hr').html(html);
        },
        error: function(error) {
            console.log(error);
        }                                              
            
    });
}
function get_manager_lsit_drop_1(){
    var reviewer_filter = $('#reviewer_filter_1').val();
        // alert(reviewer_filter)
    $.ajax({                   
        url:"get_manager_lsit_drop",
        type:"POST",
        data:{ reviewer_filter : reviewer_filter},
        dataType : "JSON",
        success: function(data) {
            // console.log(data)
            var html = '<option value="">Select</option>';
            for (let index = 0; index < data.length; index++) {
                html += "<option value='" + data[index].empID + "'>" + data[index].username + "</option>";
            }
            $('#team_leader_filter_hr_1').html(html);
        },
        error: function(error) {
            console.log(error);
        }                                              
            
    });
}
function get_team_member_drop_1(){
    var team_leader_filter_hr = $('#team_leader_filter_hr_1').val();
    $.ajax({                   
        url:"get_team_member_drop",
        type:"POST",
        data:{ team_leader_filter_hr : team_leader_filter_hr },
        dataType : "JSON",
        success: function(data) {
            // console.log(data)
            var html = '<option value="">Select</option>';
            for (let index = 0; index < data.length; index++) {
                html += "<option value='" + data[index].empID + "'>" + data[index].username + "</option>";
            }
            $('#team_member_filter_hr_1').html(html);
        },
        error: function(error) {
            console.log(error);
        }                                              
            
    });
}

/*datatables for hr page*/
function supervisor_goal_record(){    
    table_cot = $('#supervisor_goal_data').DataTable({
        
        // dom: 'lBfrtip',
        lengthChange: true,
        "buttons": [
            {
                "extend": 'copy',
                "text": '<i class="bi bi-clipboard" ></i>  Copy',
                "titleAttr": 'Copy',
                "exportOptions": {
                    'columns': ':visible'
                },
                "action": newexportaction
            },
            {
                "extend": 'excel',
                "text": '<i class="bi bi-file-earmark-spreadsheet" ></i>  Excel',
                "titleAttr": 'Excel',
                "exportOptions": {
                    'columns': ':visible'
                },
                "action": newexportaction
            },
            {
                "extend": 'csv',
                "text": '<i class="bi bi-file-text" ></i>  CSV',
                "titleAttr": 'CSV',
                "exportOptions": {
                    'columns': ':visible'
                },
                "action": newexportaction
            },
            {
                "extend": 'pdf',
                "text": '<i class="bi bi-file-break" ></i>  PDF',
                "titleAttr": 'PDF',
                "exportOptions": {
                    'columns': ':visible'
                },
                "action": newexportaction
            },
            {
                "extend": 'print',
                "text": '<i class="bi bi-printer"></i>  Print',
                "titleAttr": 'Print',
                "exportOptions": {
                    'columns': ':visible'
                },
                "action": newexportaction
            },
            {
                "extend": 'colvis',
                "text": '<i class="bi bi-eye" ></i>  Colvis',
                "titleAttr": 'Colvis',
                // "action": newexportaction
            },
            
        ],  
        lengthMenu: [[10, 50, 100, 250, 500, -1], [10, 50, 100, 250, 500, "All"]],
        processing: true,
        serverSide: true,
        serverMethod: 'post',
        bDestroy: true,
        scrollCollapse: true,
        drawCallback: function() {
        },
        ajax: {
            url: "get_hr_goal_list_tb",
            type: 'POST',
            dataType: "json",
            data: function (d) {
                d.supervisor_list = $('#supervisor_list').val();
            }
        },
        createdRow: function( row, data, dataIndex ) {
            $( row ).find('td:eq(0)').attr('data-label', 'Sno');
            $( row ).find('td:eq(1)').attr('data-label', 'Candidate Name');
            $( row ).find('td:eq(2)').attr('data-label', 'Position');
            
            /*if (data.red_flag_status == "1") {
                $(row).addClass('table-danger');
            }
            if (data.status_cont == "Offer Rejected") {
                $(row).addClass('table-warning');
            }*/
        },
        columns: [
            {   data: 'DT_RowIndex', name: 'DT_RowIndex'    },
            {   data: 'created_by_name', name: 'created_by_name'  },
            {   data: 'goal_name', name: 'goal_name'  },
            {   data: 'status', name: 'status'  },
            {   data: 'action', name: 'action'  },            
        ],
    });
}
function reviewer_goal_record(){

    
    table_cot = $('#reviewer_tbl').DataTable({
        
        // dom: 'lBfrtip',
        lengthChange: true,
        "buttons": [
            {
                "extend": 'copy',
                "text": '<i class="bi bi-clipboard" ></i>  Copy',
                "titleAttr": 'Copy',
                "exportOptions": {
                    'columns': ':visible'
                },
                "action": newexportaction
            },
            {
                "extend": 'excel',
                "text": '<i class="bi bi-file-earmark-spreadsheet" ></i>  Excel',
                "titleAttr": 'Excel',
                "exportOptions": {
                    'columns': ':visible'
                },
                "action": newexportaction
            },
            {
                "extend": 'csv',
                "text": '<i class="bi bi-file-text" ></i>  CSV',
                "titleAttr": 'CSV',
                "exportOptions": {
                    'columns': ':visible'
                },
                "action": newexportaction
            },
            {
                "extend": 'pdf',
                "text": '<i class="bi bi-file-break" ></i>  PDF',
                "titleAttr": 'PDF',
                "exportOptions": {
                    'columns': ':visible'
                },
                "action": newexportaction
            },
            {
                "extend": 'print',
                "text": '<i class="bi bi-printer"></i>  Print',
                "titleAttr": 'Print',
                "exportOptions": {
                    'columns': ':visible'
                },
                "action": newexportaction
            },
            {
                "extend": 'colvis',
                "text": '<i class="bi bi-eye" ></i>  Colvis',
                "titleAttr": 'Colvis',
                // "action": newexportaction
            },
            
        ],  
        lengthMenu: [[10, 50, 100, 250, 500, -1], [10, 50, 100, 250, 500, "All"]],
        processing: true,
        serverSide: true,
        serverMethod: 'post',
        bDestroy: true,
        scrollCollapse: true,
        drawCallback: function() {
        },
        ajax: {
            url: "get_reviewer_list",
            type: 'POST',
            dataType: "json",
            data: function (d) {
                d.supervisor_list_1 = $('#supervisor_list_1').val();
                d.team_member_filter = $('#team_member_filter').val();
            }
        },
        createdRow: function( row, data, dataIndex ) {
            $( row ).find('td:eq(0)').attr('data-label', 'Sno');
            $( row ).find('td:eq(1)').attr('data-label', 'Candidate Name');
            $( row ).find('td:eq(2)').attr('data-label', 'Position');           
        },
        columns: [
            {   data: 'DT_RowIndex', name: 'DT_RowIndex'    },
            {   data: 'created_by_name', name: 'created_by_name'  },
            {   data: 'goal_name', name: 'goal_name'  },
            {   data: 'status', name: 'status'  },
            {   data: 'action', name: 'action'  },            
        ],
    });
}
function hr_dttable_record(){

    
    table_cot = $('#get_hr_goal').DataTable({
        
        // dom: 'lBfrtip',
        lengthChange: true,
        "buttons": [
            {
                "extend": 'copy',
                "text": '<i class="bi bi-clipboard" ></i>  Copy',
                "titleAttr": 'Copy',
                "exportOptions": {
                    'columns': ':visible'
                },
                "action": newexportaction
            },
            {
                "extend": 'excel',
                "text": '<i class="bi bi-file-earmark-spreadsheet" ></i>  Excel',
                "titleAttr": 'Excel',
                "exportOptions": {
                    'columns': ':visible'
                },
                "action": newexportaction
            },
            {
                "extend": 'csv',
                "text": '<i class="bi bi-file-text" ></i>  CSV',
                "titleAttr": 'CSV',
                "exportOptions": {
                    'columns': ':visible'
                },
                "action": newexportaction
            },
            {
                "extend": 'pdf',
                "text": '<i class="bi bi-file-break" ></i>  PDF',
                "titleAttr": 'PDF',
                "exportOptions": {
                    'columns': ':visible'
                },
                "action": newexportaction
            },
            {
                "extend": 'print',
                "text": '<i class="bi bi-printer"></i>  Print',
                "titleAttr": 'Print',
                "exportOptions": {
                    'columns': ':visible'
                },
                "action": newexportaction
            },
            {
                "extend": 'colvis',
                "text": '<i class="bi bi-eye" ></i>  Colvis',
                "titleAttr": 'Colvis',
                // "action": newexportaction
            },
            
        ],  
        lengthMenu: [[10, 50, 100, 250, 500, -1], [10, 50, 100, 250, 500, "All"]],
        processing: true,
        serverSide: true,
        serverMethod: 'post',
        bDestroy: true,
        scrollCollapse: true,
        drawCallback: function() {
        },
        ajax: {
            url: "get_hr_goal_list_tbl",
            type: 'POST',
            dataType: "json",
            data: function (d) {
                d.reviewer_filter = $('#reviewer_filter').val();
                d.team_leader_filter_hr = $('#team_leader_filter_hr').val();
                d.team_member_filter_hr = $('#team_member_filter_hr').val();
                d.gender_hr_2 = $('#gender_hr_2').val();
                d.grade_hr_2 = $('#grade_hr_2').val();
                d.department_hr_2 = $('#department_hr_2').val();
            }
        },
        createdRow: function( row, data, dataIndex ) {
            $( row ).find('td:eq(0)').attr('data-label', 'Sno');
            $( row ).find('td:eq(1)').attr('data-label', 'Candidate Name');
            $( row ).find('td:eq(2)').attr('data-label', 'Position');           
        },
        columns: [
            {   data: 'DT_RowIndex', name: 'DT_RowIndex'    },
            {   data: 'created_by_name', name: 'created_by_name'  },
            {   data: 'goal_name', name: 'goal_name'  },
            {   data: 'status', name: 'status'  },
            {   data: 'action', name: 'action'  },            
        ],
    });
}
function goal_record(){

    table_cot = $('#goal_data').DataTable({

        // dom: 'lBfrtip',
        lengthChange: true,
        "buttons": [
            {
                "extend": 'copy',
                "text": '<i class="bi bi-clipboard" ></i>  Copy',
                "titleAttr": 'Copy',
                "exportOptions": {
                    'columns': ':visible'
                },
                "action": newexportaction
            },
            {
                "extend": 'excel',
                "text": '<i class="bi bi-file-earmark-spreadsheet" ></i>  Excel',
                "titleAttr": 'Excel',
                "exportOptions": {
                    'columns': ':visible'
                },
                "action": newexportaction
            },
            {
                "extend": 'csv',
                "text": '<i class="bi bi-file-text" ></i>  CSV',
                "titleAttr": 'CSV',
                "exportOptions": {
                    'columns': ':visible'
                },
                "action": newexportaction
            },
            {
                "extend": 'pdf',
                "text": '<i class="bi bi-file-break" ></i>  PDF',
                "titleAttr": 'PDF',
                "exportOptions": {
                    'columns': ':visible'
                },
                "action": newexportaction
            },
            {
                "extend": 'print',
                "text": '<i class="bi bi-printer"></i>  Print',
                "titleAttr": 'Print',
                "exportOptions": {
                    'columns': ':visible'
                },
                "action": newexportaction
            },
            {
                "extend": 'colvis',
                "text": '<i class="bi bi-eye" ></i>  Colvis',
                "titleAttr": 'Colvis',
                // "action": newexportaction
            },

        ],
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
            url: "get_goal_list",
            type: 'GET',
            dataType: "json",
            data: function (d) {
                // d.status = $('#status').val();
                // d.af_from_date = $('#af_from_date').val();
                // d.af_to_date = $('#af_to_date').val();
                // d.af_position_title = $('#af_position_title').val();
            }
        },
        createdRow: function( row, data, dataIndex ) {

        },
        columns: [
            {   data: 'DT_RowIndex', name: 'DT_RowIndex'    },
            {   data: 'goal_name', name: 'goal_name'    },
            {   data: 'action', name: 'action'  },

            // {   data: 'Info', name: 'Info'  },

        ],
    });
}
   

   $('#send_mail').on('click', function(){
         var i=0;
         var j=0;
         var selected=[];
         $('#listing_table tbody>tr').each(function () {
             var currrow=$(this).closest('tr');
             var col1=currrow.find('td:eq(0) input[type=checkbox]');
             if (col1.length) {
                    var status = col1.prop('checked');
                     if(status)
                     {
                      selected.push({
                            checkbox:col1.val()
                         })  
                     }
                     $("#send_mail").show();
                  }
                  $("#send_mail").hide();
             });

         $.ajax({
            url:"pms_employeee_mail",
            type:"POST",
            data:{gid:selected},
            success:function(data){
                console.log(data.response);
                if(data.response==1)
                {
                 Toastify({
                   text: "Mail Send Sucessfully..!",
                   duration: 1000,
                   close:true,
                   backgroundColor: "#4fbe87",
               }).showToast();
               setTimeout(
                   function() {
                       window.location.reload();
                   }, 1000);
              } 
            }
         })
    });        

/*select all*/
// Handle click on "Select all" control
   $('#example-select-all').on('click', function(){
      var rows = table_cot.rows({ 'search': 'applied' }).nodes();
      if (rows !="") {
      $('input[type="checkbox"]', rows).prop('checked', this.checked);
      $("#send_mail").show();
      }else{
        $("#send_mail").hide();
      }
   });

   $('#example tbody').on('change', 'input[type="checkbox"]', function(){
      if(!this.checked){
         var el = $('#example-select-all').get(0);
         if(el && el.checked && ('indeterminate' in el)){
            el.indeterminate = true;
            
         }
      }
   });

function hr_listing_tab_record(){

    
    table_cot = $('#listing_table').DataTable({
            
        // dom: 'lBfrtip',
        lengthChange: true,
        "buttons": [
            {
                "extend": 'copy',
                "text": '<i class="bi bi-clipboard" ></i>  Copy',
                "titleAttr": 'Copy',
                "exportOptions": {
                    'columns': ':visible'
                },
                "action": newexportaction
            },
            {
                "extend": 'excel',
                "text": '<i class="bi bi-file-earmark-spreadsheet" ></i>  Excel',
                "titleAttr": 'Excel',
                "exportOptions": {
                    'columns': ':visible'
                },
                "action": newexportaction
            },
            {
                "extend": 'csv',
                "text": '<i class="bi bi-file-text" ></i>  CSV',
                "titleAttr": 'CSV',
                "exportOptions": {
                    'columns': ':visible'
                },
                "action": newexportaction
            },
            {
                "extend": 'pdf',
                "text": '<i class="bi bi-file-break" ></i>  PDF',
                "titleAttr": 'PDF',
                "exportOptions": {
                    'columns': ':visible'
                },
                "action": newexportaction
            },
            {
                "extend": 'print',
                "text": '<i class="bi bi-printer"></i>  Print',
                "titleAttr": 'Print',
                "exportOptions": {
                    'columns': ':visible'
                },
                "action": newexportaction
            },
            {
                "extend": 'colvis',
                "text": '<i class="bi bi-eye" ></i>  Colvis',
                "titleAttr": 'Colvis',
                // "action": newexportaction
            },
            
        ],  
        lengthMenu: [[10, 50, 100, 250, 500, -1], [10, 50, 100, 250, 500, "All"]],
        processing: true,
        serverSide: true,
        serverMethod: 'post',
        bDestroy: true,
        scrollCollapse: true,
        aoColumnDefs: [
            { "bSortable": false, "aTargets": [ 0, 6, 7, 8] }, 
        ],
        drawCallback: function() {
        },
        ajax: {
            url: "hr_list_tab_record",
            type: 'POST',
            dataType: "json",
            data: function (d) {
                d.reviewer_filter_1 = $('#reviewer_filter_1').val();
                d.team_leader_filter_hr_1 = $('#team_leader_filter_hr_1').val();
                d.team_member_filter_hr_1 = $('#team_member_filter_hr_1').val();
                d.gender_hr_1 = $('#gender_hr_1').val();
                d.grade_hr_1 = $('#grade_hr_1').val();
                d.department_hr_1 = $('#department_hr_1').val();
            }
        },
        createdRow: function( row, data, dataIndex ) {
            $( row ).find('td:eq(0)').html('<input class="mail_class" type="checkbox" name="id[]" value="'+ data.goal_unique_code +'">');   
            $( row ).find('td:eq(0)').attr('data-label', 'Sno');
            $( row ).find('td:eq(1)').attr('data-label', 'Candidate Name');
            $( row ).find('td:eq(2)').attr('data-label', 'Emp ID');           
            $( row ).find('td:eq(3)').attr('data-label', 'Goal Name');           
            $( row ).find('td:eq(4)').attr('data-label', 'Gender');           
            $( row ).find('td:eq(5)').attr('data-label', 'Grade');           
            $( row ).find('td:eq(5)').attr('data-label', 'Department');           
            $( row ).find('td:eq(6)').attr('data-label', 'employee_consolidated_rate');           
            $( row ).find('td:eq(7)').attr('data-label', 'supervisor_consolidated_rate');
        },
        columns: [
           
            {   data: 'DT_RowIndex', name: 'DT_RowIndex'    },
            {   data: 'created_by_name', name: 'created_by_name'  },
            {   data: 'created_by', name: 'created_by'  },
            {   data: 'goal_name', name: 'goal_name'  },
            {   data: 'status', name: 'status'  },
            {   data: 'gender', name: 'gender'  },
            {   data: 'grade', name: 'grade'  },
            {   data: 'department', name: 'department'  },
            {   data: 'employee_consolidated_rate', name: 'employee_consolidated_rate'  },
            {   data: 'supervisor_consolidated_rate', name: 'supervisor_consolidated_rate'  },
        ],
    });
}
