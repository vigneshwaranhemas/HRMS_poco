$( document ).ready(function() {
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

$(document).ready(function(){
    get_division_list();
});


//Insertion
$(()=>{
    $('#btnSubmit').on('click',(e)=>{
    //    alert("abc");

   e.preventDefault();

   $.ajax({
       url:add_division_unit_process_link,
       method:"POST",
       data: $("#add_division_unit").serialize(),
       dataType:"json",

       success:function(data) {
        //    alert('sdf')
           console.log(data);
           $('#btnSubmit').prop("disabled",false);
               $('#btnSubmit').html('Submit');


           if(data.response =='success'){

               $('#btnSubmit').prop("disabled",true);

                $('#btnSubmit').html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Processing');
                $('#exampleModal').click();

               Toastify({
                   text: "Added Sucessfully..!",
                   duration: 3000,
                   close:true,
                   backgroundColor: "#4fbe87",
               }).showToast();

               setTimeout(
                   function() {
                    //    window.location.href = "view_recruiter";
                    // location.reload();
                    get_division_list();
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

        $('#division_name_error').text(response.responseJSON.errors.division_name);

        }

   });
    })
})

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

function get_division_list(){

table_cot = $('#division_data').DataTable({

    dom: 'lBfrtip',
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
    lengthMenu: [[15, 50, 100, 250, 500, -1], [15, 50, 100, 250, 500, "All"]],
    processing: true,
    serverSide: true,
    serverMethod: 'post',
    bDestroy: true,
    scrollX: true,
    scrollY: 800,
    scrollCollapse: true,
    drawCallback: function() {


    },
    // aoColumnDefs: [
    //     { 'visible': false, 'targets': [3] }
    // ],
    ajax: {
        url: get_division_unit_link_database,
        type: 'POST',
        dataType: "json",
        data: function (d) {

        }
    },
    createdRow: function( row, data, dataIndex ) {
        $( row ).find('td:eq(0)').attr('data-label', 'Sno');
        $( row ).find('td:eq(1)').attr('data-label', 'Division Name');
        $( row ).find('td:eq(2)').attr('data-label', 'action');
    },
    columns: [
        {   data: 'DT_RowIndex', name: 'DT_RowIndex'    },
        {   data: 'division_name', name: 'division_name'    },
        {   data: 'status', name: 'status'    },
        {   data: 'action', name: 'action'    },


    ],
});
}

//Edit pop-up model and data show
function division_edit_process(id){

    $('#division_edit_pop_modal_div').modal('show');

    $.ajax({
        url: get_division_unit_details_link,
        method: "POST",
        data:{"id":id,},
        dataType: "json",
        success: function(data) {

            if(data.length !=0){
                $('#division_name').val(data[0].division_name);
                $('#ed_id').val(id);
            }
        }
    });
}

//Edit function
$(()=>{

    $("#editUpdate").on('click', function() {
        // alert("abc");

        $("#editUpdate").attr("disabled", true);
        $('#editUpdate').html('Processing..!');

        var ed_division_name = $('#division_name').val();
        var ed_id = $('#ed_id').val();

        $.ajax({
            url: update_division_details_link,
            method: "POST",
            data:{
                "id":ed_id,
                "division_name":ed_division_name,
            },
            dataType: "json",
            success: function(data) {

                $('#close_edit_pop').click();
                $("#editUpdate").attr("disabled", false);
                $('#editUpdate').html('Update');
                $('#division_edit_pop_modal_div').click();

                if(data.response =='Updated'){
                    Toastify({
                        text: "Updated Successfully",
                        duration: 3000,
                        close:true,
                        backgroundColor: "#4fbe87",
                    }).showToast();

                    setTimeout(
                        function() {
                            // location.reload();
                            get_division_list();
                        }, 2000);
                }
                else {
                    Toastify({
                        text: "Request Failed..! Try Again",
                        duration: 3000,
                        close:true,
                        backgroundColor: "#f3616d",
                    }).showToast();

                }

                setTimeout(
                    function() {
                        get_division_list();
                    }, 2000);

            }
        });
    });

    })

function division_status_process(id, status_data){
    // $('#confirmbox').click();
    $('#status_pop_modal_div').modal('show');

    $("#confirmSubmit").on('click', function() {
        $('#close_status_pop').click();

        $.ajax({
            url: process_division_status_link,
            method: "POST",
            data:{"id":id,"status":status_data,},
            dataType: "json",
            success: function(data) {

                if(data.response =='success'){
                    $('#status_pop_modal_div').click();
                    Toastify({
                        text: "Status Changed Successfully",
                        duration: 3000,
                        close:true,
                        backgroundColor: "#4fbe87",
                    }).showToast();

                    setTimeout(
                        function() {
                            // location.reload();
                            get_division_list();
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
                            get_division_list();
                        }, 2000);


                }
            }

        });
    });
    $("#cancelSubmit").on('click', function() {

        $('#modal_close').click();
        location.reload();

        return false;
    });
}

function division_delete_process(id){
    // $('#confirmbox').click();
    $('#delete_pop_modal_div').modal('show');

    $("#deleteconfirmSubmit").on('click', function() {
        $('#close_delete_pop').click();

        $.ajax({
            url: process_division_unit_delete_link,
            method: "POST",
            data:{"id":id,},
            dataType: "json",
            success: function(data) {

                if(data.response =='success'){
                    $('#delete_pop_modal_div').click();
                    Toastify({
                        text: "Delete Successfully",
                        duration: 3000,
                        close:true,
                        backgroundColor: "#4fbe87",
                    }).showToast();

                    setTimeout(
                        function() {
                            // location.reload();
                            get_division_list();
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
                            get_division_list();
                        }, 2000);
                }
            }

        });
    });
    $("#deletecancelSubmit").on('click', function() {

        $('#modal_close').click();
        location.reload();

        return false;
    });
}
