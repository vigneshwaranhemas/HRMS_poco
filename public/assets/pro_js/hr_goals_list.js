$( document ).ready(function() {
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
$(document).ready(function() {
    get_supervisor();
    supervisor_goal_record();
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
    });
$('#hr_apply').on('click',function() {
    hr_dttable_record();
    });
$('#reviewer-info-tab').on('click',function() {
    reviewer_goal_record();
    });
/*end search*/

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
        },
        error: function(error) {
            console.log(error);
        }                                              
            
    });
}
function get_team_member_drop(){
    var team_leader_filter_hr = $('#team_leader_filter_hr').val();
// alert(team_leader_filter_hr)
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


function supervisor_goal_record(){    
    table_cot = $('#supervisor_goal_data').DataTable({
        
        dom: 'lBfrtip',
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
            {   data: 'action', name: 'action'  },            
        ],
    });
}

function reviewer_goal_record(){

    
    table_cot = $('#reviewer_tbl').DataTable({
        
        dom: 'lBfrtip',
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
            {   data: 'action', name: 'action'  },            
        ],
    });
}

function hr_dttable_record(){

    
    table_cot = $('#get_hr_goal').DataTable({
        
        dom: 'lBfrtip',
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
            {   data: 'action', name: 'action'  },            
        ],
    });
}



