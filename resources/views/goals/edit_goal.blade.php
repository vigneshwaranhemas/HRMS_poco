{{-- Divya --}}
@extends(Auth::user()->role_type === 'Admin' ? 'layouts.simple.admin_master' : ( Auth::user()->role_type === 'Buddy'? 'layouts.simple.buddy_master ': ( Auth::user()->role_type === 'Employee'? 'layouts.simple.candidate_master ': ( Auth::user()->role_type === 'HR'? 'layouts.simple.hr_master ': ( Auth::user()->role_type === 'IT Infra'? 'layouts.simple.itinfra_master ': ( Auth::user()->role_type === 'Site Admin'? 'layouts.simple.site_admin_master': '' ) ) ) ) ) )
@section('title', 'Add Goal Setting')

@section('css')
<link rel="stylesheet" type="text/css" href="../assets/css/prism.css">
    <!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="../assets/css/chartist.css">
<link rel="stylesheet" type="text/css" href="../assets/css/date-picker.css">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
	<h2>Edit Goal Setting<span>Process</span></h2>
@endsection

@section('breadcrumb-items')
   {{--<li class="breadcrumb-item">Dashboard</li>
	<li class="breadcrumb-item active">Default</li>--}}
@endsection

@section('content')
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="row">
        <input type="text" id="edit_goals_setting_id" value="{{ $id }}">
        <div class="col-sm-12">
            <div class="ribbon-vertical-right-wrapper card">
                <div class="card-body">
                    <div class="ribbon ribbon-bookmark ribbon-vertical-right ribbon-primary" style="height: 107px !important;"><span style="writing-mode: vertical-rl;text-orientation: upright;margin-left: -25px;"> Goals</span></div>
                    <div class="row">
                        <div class="col-md-4">

                        <h6 class="mb-0 f-w-700"><i class="fa fa-user"> </i> Name</h6>
                        <p>{{ Auth::user()->username }}</p>
                        </div>
                        <div class="col-md-4">
                        <h6 class="mb-0 f-w-700"><i class="fa fa-sitemap"> </i> Function</h6>
                        <p>{{ Auth::user()->designation }}</p>
                        </div>
                        <div class="col-md-4">
                        <h6 class="mb-0 f-w-700"><i class="fa fa-ticket"> </i> Emp ID</h6>
                        <p>{{ Auth::user()->empID }}</p>
                        </div>

                    </div>
                </div>
                </div>

            <div class="card">
                <!-- <div class="card-header">
                    <div class="table-responsive ">
                        <table class="table table-border-vertical table-border-horizontal">

                            <tbody class="table-primary">
                                <tr>
                                    <th scope="row">Name</th>
                                    <td>Ganagavathy KGV</td>
                                    <td rowspan="3" style="vertical-align : middle;text-align:center;">
                                        Goals 22-23</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row">Function</th>
                                    <td>IT</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th scope="row">Emp ID</th>
                                    <td>900102</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div> -->
                <div class="card-body">

                    <div class="table-responsive">
                        <form id="goalsForm">
                        <table class="table" id="goal-tb">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Key Business Drivers</th>
                                    <th scope="col">Key Result Areas </th>
                                    <th scope="col">Sub Indicators</th>
                                    <th scope="col">Measurement Criteria (UOM)</th>
                                    <th scope="col">Weightage</th>
                                    <th scope="col">Reference </th>
                                    <th scope="col"></th>
                                    <th scope="col">
                                        <i class="fa fa-plus txt-primary"
                                            style="font-size: x-large;" data-original-title="Add KBD" title="Add KBD"  onclick="additionalKBD();"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <tr>
                                    <th scope="row">1</th>
                                    <td>
                                        <select class="form-control js-example-basic-single">
                                            <option value="Revenue">Revenue</option>
                                            <option value="Customer">Customer</option>
                                            <option value="Process">Process</option>
                                            <option value="People">People</option>
                                            <option value="Projects">Projects</option>

                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="" id="" class="form-control">
                                    </td>
                                    <td>
                                        <input type="text" name="" id="" class="form-control">

                                    </td>
                                    <td>
                                        <input type="text" name="" id="" class="form-control">

                                    </td>
                                    <td>
                                        <input type="text" name="" id="" class="form-control">

                                    </td>
                                    <td>
                                        <input type="text" name="" id="" class="form-control">

                                    </td>
                                    <td>
                                        <i class="fa fa-edit txt-info" style="font-size: x-large;"></i>
                                        <i class="fa fa-trash-o txt-danger"
                                            style="font-size: x-large;"></i>
                                    </td>
                                </tr>
                                    -->

                            </tbody>
                        </table>
                        <button type="submit" id="datatable_form_save" class="btn btn-primary m-t-30"><i class="ti-save"></i> Save</button>                                            
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
<!-- Container-fluid Ends-->
@endsection

@section('script')
<script src="../assets/js/typeahead/handlebars.js"></script>
<script src="../assets/js/typeahead/typeahead.bundle.js"></script>
<script src="../assets/js/typeahead/typeahead.custom.js"></script>
<script src="../assets/js/typeahead-search/handlebars.js"></script>
<script src="../assets/js/typeahead-search/typeahead-custom.js"></script>
<script src="../assets/js/chart/chartist/chartist.js"></script>
<script src="../assets/js/chart/chartist/chartist-plugin-tooltip.js"></script>
<script src="../assets/js/chart/apex-chart/apex-chart.js"></script>
<script src="../assets/js/chart/apex-chart/stock-prices.js"></script>
<script src="../assets/js/prism/prism.min.js"></script>
<script src="../assets/js/clipboard/clipboard.min.js"></script>
<script src="../assets/js/counter/jquery.waypoints.min.js"></script>
<script src="../assets/js/counter/jquery.counterup.min.js"></script>
<script src="../assets/js/counter/counter-custom.js"></script>
<script src="../assets/js/custom-card/custom-card.js"></script>
<script src="../assets/js/notify/bootstrap-notify.min.js"></script>
<script src="../assets/js/dashboard/default.js"></script>
<script src="../assets/js/notify/index.js"></script>
<script src="../assets/js/datepicker/date-picker/datepicker.js"></script>
<script src="../assets/js/datepicker/date-picker/datepicker.en.js"></script>
<script src="../assets/js/datepicker/date-picker/datepicker.custom.js"></script>

<script>


    $(".use-address").click(function() {
        var html = '<input type="text" name="" id="" class="form-control m-t-5">';

        var id = $(this).closest("tr").find("td:eq(2)").html(html);
        // $("#resultas").append(id);
    });

    function additionalKRA(x,cur_rowCount) {
        // alert($(x).closest('td').parent()[0].sectionRowIndex);
        // alert(cur_rowCount)

        var rand_no = Math.floor(Math.random()*90000) + 10000;
        var code = cur_rowCount+'_'+rand_no;
        
        var html2 = '<textarea id="" class="form-control m-t-5 '+code+'" name="key_res_areas_'+cur_rowCount+'[]"></textarea>';
        var html3 = '<textarea id="" class="form-control m-t-5 '+code+'" name="sub_indicators_'+cur_rowCount+'[]"></textarea>';
        var html4 = '<textarea id="" class="form-control m-t-5 '+code+'" name="measurement_criteria_'+cur_rowCount+'[]"></textarea>';
        var html6 = '<textarea id="" class="form-control m-t-5 '+code+'" name="reference_'+cur_rowCount+'[]"></textarea>';
        
        var html7 = '';

        html7 +='<div class="dropup m-t-35">';
            html7 +='<button type="button" class="btn btn-xs btn-danger '+code+'" onclick="removeRow(this,'+code+');" style="padding:0.37rem 0.8rem !important;" data-original-title="Edit KRA" title="Edit KRA"><i class="fa fa-close"></i></button>';
            // html7 +='<button type="button" class="btn btn-xs btn-danger sub_row_'+cur_rowCount+'" onclick="removeRow(this,'+class_sub+');" style="padding:0.37rem 0.8rem !important;" data-original-title="Edit KRA" title="Edit KRA"><i class="fa fa-close"></i></button>';
        html7 +='</div>';
        
        $(x).closest("tr").find("td:eq(2)").append(html2);
        $(x).closest("tr").find("td:eq(3)").append(html3);
        $(x).closest("tr").find("td:eq(4)").append(html4);
        $(x).closest("tr").find("td:eq(6)").append(html6);
        $(x).closest("tr").find("td:eq(7)").append(html7);

    }

    function removeRow(html_ui, class_name){
        const string = ''+class_name+'';
        var first = string.slice(0, 1);
        var last = string.slice(-5);
        var code = first+'_'+last;
        $('.'+code+'').remove();
    }

    function additionalKBD(){
        var rowCount = $('#goal-tb tr').length;
        // var cur_rowCount = rowCount + 1;
        var cur_rowCount = rowCount;

        var html = '<tr>';
                html +='<td scope="row">1</td>';
                html +='<td>';
                    html +='<select class="form-control js-example-basic-single key_bus_drivers" name="key_bus_drivers_'+cur_rowCount+'[]">';
                        html +='<option value="Revenue">Revenue</option>';
                        html +='<option value="Customer">Customer</option>';
                        html +='<option value="Process">Process</option>';
                        html +='<option value="People">People</option>';
                        html +='<option value="Projects">Projects</option>';
                    html +='</select>';
                html +='</td>';

                html +='<td>';
                    html +='<textarea name="key_res_areas_'+cur_rowCount+'[]" id="" class="form-control"></textarea>';
                html +='</td>';

                html +='<td>';
                    html +='<textarea name="sub_indicators_'+cur_rowCount+'[]" id="" class="form-control"></textarea>';
                html +='</td>';

                html +='<td>';
                    html +='<textarea name="measurement_criteria_'+cur_rowCount+'[]" id="" class="form-control"></textarea>';
                html +='</td>';

                html +='<td>';
                    html +='<input type="text" name="weightage_'+cur_rowCount+'[]" id="" class="form-control">';
                html +='</td>';

                html +='<td>';
                    html +='<textarea name="reference_'+cur_rowCount+'[]" id="" class="form-control"></textarea>';
                html +='</td>';

                html +='<td>';
                        html +='<div style="margin-top: 80px;"></div>';
                html +='</td>';

                html +='<td>';
                    html +='<div class="dropup">';
                        html +='<button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>';
                        html +='<div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">';
                                    html +='<a class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs" type="button" data-original-title="Add KRA" title="Add KRA"><i class="fa fa-plus" onclick="additionalKRA(this,'+cur_rowCount+');"></i></button></a>';
                                    // html +='<a class="dropdown-item ditem-gs"><button class="btn btn-info btn-xs" type="button" data-original-title="Edit KRA" title="Edit KRA"><i class="fa fa-pencil"></i></button></a>';
                                    html +='<a class="dropdown-item ditem-gs"><button class="btn btn-danger btn-xs" type="button" id="btnDelete"  data-original-title="Delete KRA" title="Delete KRA"><i class="fa fa-trash-o"></i></button></a>';
                        html +='</div>';
                    html +='</div>';
                    // html +='<div class="dropup m-t-5">';
                    //     html +='<button type="button" class="btn btn-xs btn-danger" style="padding:0.37rem 0.8rem !important;" data-original-title="Edit KRA" title="Edit KRA"><i class="fa fa-close"></i></button>';
                    // html +='</div>';
                html +='</td>';

            html +='</tr>';
        $('#goal-tb tr:last').after(html);
        updatesno();
    }

    function updatesno(){

        $.each($("#goal-tb tr:not(:first)"), function (i, el) {
            var sn = i + 1;            
            var sno = "<p>"+sn+"</p>";
            $(this).find("td:first").html(sno);
        })

    }

    $("#goal-tb").on('click','#btnDelete',function(){
        // alert("sdf")
        $(this).closest('tr').remove();
        updatesno();
    }); 


    function formTable() {

        var test = [];
        var error='';
        
        $('#goal-tb tr').each(function(index, tr) {
            $(tr).find('td').each (function (index, td) {
                console.log(td)
            });
        });

        // $('#goal-tb tbody>tr').each(function (element) {
        //     // var currrow=$(this).closest('tr');
        //     alert("col4")

        //     var col0=$(this).find("td:eq(0)").text();
        //     // var col1=$(this).find("td:eq(1) textarea").val();
        //     //    var col2=$(this).find("td:eq(2) option:selected").val();
        //     //    var col4_input=$(this).find("td:eq(4) input:checked").val();
        //     // alert(col0)
            
                                                                    
        // });

        //Sending data to database
        //    if(error==""){
        //        // alert("succes")
        //        data_insert();
        //    }
        //    else{
        //        // alert("test")
        //        // data_insert();
        //        scrollUp();
        //    }
          
           // console.log(test);
           // var formData =  JSON.stringify(test);
           // alert(formData);
                    
        //    function data_insert(){
        //        // alert("jsd");

        //        var business_name_option=$("#business_name_option").val();

        //        $.ajax({
                   
        //            url:"{{ ('business_form') }}",
        //            type:"POST",
        //            data:{business_name:business_name_option, serialize_form_value:test},
        //            dataType : "JSON",
        //            success:function(data)
        //            {
        //                window.location.reload();                         
        //            },
        //            error: function(response) {
        //                // alert(response.responseJSON.errors.business_name_option);
        //                $('#business_name_option_error').text(response.responseJSON.errors.business_name);

        //            }                                              
                       
        //        });
        //    }            
       

    }

    $("#goalsForm").submit(function(e) {
        e.preventDefault();
        $('button[type="submit"]').attr('disabled' , true);

        // console.log($('#goalsForm').serialize());

        $.ajax({
                   
            url:"{{ ('add_goals_data') }}",
            type:"POST",
            data:$('#goalsForm').serialize(),
            dataType : "JSON",
            success:function(data)
            {
                Toastify({
                    text: "Added Sucessfully..!",
                    duration: 3000,
                    close:true,
                    backgroundColor: "#4fbe87",
                }).showToast();    
                
                $('button[type="submit"]').attr('disabled' , false);
                
                window.location = "{{ url('goals')}}";                
            },
            error: function(response) {
                // alert(response.responseJSON.errors.business_name_option);
                // $('#business_name_option_error').text(response.responseJSON.errors.business_name);

            }                                              
                
        });

    });



</script>

<script>
    var id = $('#edit_goals_setting_id').val();

    $.ajax({                   
        url:"{{ url('goals_sheet_head') }}",
        type:"GET",
        data:{id:id},
        dataType : "JSON",
        success:function(response)
        {
            $('#goals_sheet_head').append('');
            $('#goals_sheet_head').append(response);
        },
        error: function(error) {
            console.log(error);

        }                                              
            
    });

    $.ajax({                   
        url:"{{ url('fetch_goals_setting_id_edit') }}",
        type:"GET",
        data:{id:id},
        dataType : "JSON",
        success:function(response)
        {
            $('#goal-tb tr:last').after(response);

            // $('#goals_edit_record').append('');
            // $('#goals_edit_record').append(response);
        },
        error: function(error) {
            console.log(error);

        }                                              
            
    });
</script>

@endsection

