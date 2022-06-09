{{-- Divya --}}
@extends(Auth::user()->role_type === 'Admin' ? 'layouts.simple.admin_master' : ( Auth::user()->role_type === 'Buddy'? 'layouts.simple.buddy_master ': ( Auth::user()->role_type === 'Employee'? 'layouts.simple.candidate_master ': ( Auth::user()->role_type === 'HR'? 'layouts.simple.hr_master ': ( Auth::user()->role_type === 'IT Infra'? 'layouts.simple.itinfra_master ': ( Auth::user()->role_type === 'Site Admin'? 'layouts.simple.site_admin_master': '' ) ) ) ) ) )
@section('title', 'Add Goal Setting')

@section('css')
<link rel="stylesheet" type="text/css" href="../assets/css/prism.css">
<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="../assets/css/chartist.css">
<link rel="stylesheet" type="text/css" href="../assets/css/date-picker.css">
<link rel="stylesheet" type="text/css" href="../assets/css/select2.css">
@endsection

@section('style')
<style>
    #goal_sheet_edit{
        display: none;
    }
    #datatable_form_update{
        display: none;
    }
    #goal_sheet_submit_update{
        display: none;
    }
</style>
@endsection

@section('breadcrumb-title')
	<h2>Performance Management <span>System</span></h2>
@endsection

@section('breadcrumb-items')
    <a class="btn btn-sm text-white" style="background-color: #FFD700;" title="Significantly Exceeds Expectations">SEE</a>                                            
    <a class="btn btn-sm text-white m-l-10" style="background-color: #008000;" title="Exceeded Expectations">EE</a>                                            
    <a class="btn btn-sm btn-success m-l-10 text-white" title="Met Expectations">ME</a>                                            
    <a class="btn btn-sm m-l-10 text-white" style="background-color: #FFA500" title="Partially Met Expectations">PME</a>                                            
    <a class="btn btn-sm m-l-10 text-white" style="background-color: #FF0000;" title="Needs Development">ND</a>   
@endsection

@section('content')
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="ribbon-vertical-right-wrapper card">
                <div class="card-body">
                    <div class="ribbon ribbon-bookmark ribbon-vertical-right ribbon-primary" style="height: 70px !important;"><span style="writing-mode: vertical-rl;text-orientation: upright;margin-left: -25px;"> PMS</span>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="mb-0 f-w-700"><i class="icofont icofont-id-card"> </i> Emp ID :</h6>
                                </div>
                                <div class="col-md-6">
                                    <p id="empID">{{ Auth::user()->empID }}</p>
                                </div>
                                <div class="col-md-6 m-t-10">
                                    <h6 class="mb-0 f-w-700"><i class="icofont icofont-id-card"> </i> R.Manager ID :</h6>
                                </div>
                                <div class="col-md-6 m-t-10">
                                    <p id="sup_emp_code">{{ Auth::user()->sup_emp_code }}</p>
                                </div>
                                <div class="col-md-6 m-t-10">
                                    <h6 class="mb-0 f-w-700"><i class="icofont icofont-id-card"> </i>  Reviewer ID :</h6>
                                </div>
                                <div class="col-md-6 m-t-10">
                                    <p id="reviewer_emp_code">{{ Auth::user()->reviewer_emp_code }}</p>
                                </div>
                                <div class="col-md-6 m-t-10">
                                    <h6 class="mb-0 f-w-700"><i class="icofont icofont-id-card"> </i>  HRBP ID :</h6>
                                </div>
                                <div class="col-md-6 m-t-10">
                                    <p>900380</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-7">
                                    <h6 class="mb-0 f-w-700"><i class="icofont icofont-user-alt-7"> </i> Emp Name :</h6>
                                </div>
                                <div class="col-md-5">
                                    <p id="username">{{ Auth::user()->username }}</p>
                                </div>
                                <div class="col-md-7 m-t-10">
                                    <h6 class="mb-0 f-w-700"><i class="icofont icofont-user-alt-7"> </i> R.Manager Name :</h6>
                                </div>
                                <div class="col-md-5 m-t-10">
                                    <p id="sup_name">{{ Auth::user()->sup_name }}</p>
                                </div>
                                <div class="col-md-7 m-t-10">
                                    <h6 class="mb-0 f-w-700"><i class="icofont icofont-user-alt-7"> </i> Reveiwer Name :</h6>
                                </div>
                                <div class="col-md-5 m-t-10">
                                    <p id="reviewer_name">{{ Auth::user()->reviewer_name }}</p>
                                </div>
                                <div class="col-md-7 m-t-10">
                                    <h6 class="mb-0 f-w-700"><i class="icofont icofont-user-alt-7"> </i> HRBP :</h6>
                                </div>
                                <div class="col-md-5 m-t-10">
                                    <p>Rajesh M S</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-7">
                                    <h6 class="mb-0 f-w-700"><i class="icofont icofont-building"> </i> Emp Dept:</h6>
                                </div>
                                <div class="col-md-5">
                                    <p id="department">{{ Auth::user()->department }}</p>
                                </div>
                                <div class="col-md-7 m-t-10">
                                    <h6 class="mb-0 f-w-700"><i class="icofont icofont-building"> </i> R.Manager Dept :</h6>
                                </div>
                                <div class="col-md-5 m-t-10">
                                    <p id="sup_dept"></p>
                                </div>
                                <div class="col-md-7 m-t-10">
                                    <h6 class="mb-0 f-w-700"><i class="icofont icofont-building"> </i> Reviewer Dept :</h6>
                                </div>
                                <div class="col-md-5 m-t-10">
                                    <p id="rev_dept"></p>
                                </div>
                                <div class="col-md-7 m-t-10">
                                    <h6 class="mb-0 f-w-700"><i class="icofont icofont-building"> </i> HRBP Dept :</h6>
                                </div>
                                <div class="col-md-5 m-t-10">
                                    <p>HR</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">                        
                        <form id="goalsForm">
                            <!-- <button type="submit" id="goal_sheet_submit" class="btn btn-success  float-right m-b-30"><i class="ti-save"></i> Submit</button>                                            
                            <button id="goal_sheet_submit_update" class="btn btn-success  float-right m-b-30"><i class="ti-save"></i> Submit</button>                                             -->
                            <a id="goal_sheet_submit" type="submit" class="btn btn-success text-white float-right m-b-30" title="Submit For Approval">Submit</a>                                            
                            <a id="goal_sheet_submit_update" type="submit" class="btn btn-success text-white float-right m-b-30" title="Submit For Approval">Submit</a>                                            
                            <table class="table" id="goal-tb">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Key Business Drivers (KBD)</th>
                                        <th scope="col">Key Result Areas (KRA)</th>
                                        <th scope="col">Measurement Criteria (Quantified Measures)</th>
                                        <th scope="col">Self Assessment (Qualitative Remarks) by Employee</th>
                                        <th scope="col">Self Rating</th>
                                        <!-- <th scope="col">Actuals </th> -->
                                        <th scope="col"></th>
                                        <th scope="col">
                                            <i class="fa fa-plus txt-primary"
                                                style="font-size: x-large;" data-original-title="Add KBD" title="Add KBD"  onclick="additionalKBD();"></i>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="goals_record">                              
                                </tbody>
                            </table>
                            <input type="hidden" name="goals_setting_id" id="goals_setting_id">								
                            <div class="m-t-40 m-b-30 float-right">
                                <div class="row">									
                                    <div class="col-lg-6">
                                        <label>Self Consolidated Rating</label><br>
                                        <select class="js-example-basic-single" style="width:200px;margin-top:30px !important;" id="employee_consolidated_rate" name="employee_consolidated_rate">
                                            <option value="" selected>...Select...</option>
                                            <option value="EE">EE</option>
                                            <option value="AE">AE</option>
                                            <option value="ME">ME</option>
                                            <option value="PE">PE</option>
                                            <option value="ND">ND</option>
                                        </select>
                                        <div class="text-danger employee_consolidated_rate_error" id=""></div>
                                    </div>
                                    <div class="col-lg-6">
                                        <a id="datatable_form_save" type="submit" class="btn btn-primary text-white m-t-30" title="Save As Draft">Save As Draft</a>                                            
                                        <a id="datatable_form_update" type="submit" class="btn btn-primary text-white m-t-30" title="Save As Draft">Update</a>                                            
                                        <!-- <button type="submit" id="datatable_form_save" class="btn btn-primary m-t-30"><i class="ti-save"></i> Save</button>                                            
                                        <button id="datatable_form_update" class="btn btn-primary m-t-30"><i class="ti-save"></i> Update</button>                                             -->
                                    </div>
                                </div>
                            </div>                                                
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
<!-- Plugins JS start-->
<script src="../assets/js/select2/select2.full.min.js"></script>
<script src="../assets/js/select2/select2-custom.js"></script>

<script>

    $(document).ready(function() {
        setTimeout(
            function() {
                var html = '<tr>';
                        html +='<td scope="row">1</td>';
                        html +='<td>';
                            html +='<select class="form-control js-example-basic-single key_bus_drivers key_bus_drivers_1" id="key_bus_drivers_1" name="key_bus_drivers_1[]">';
                                html +='<option value="">...Select...</option>';
                                html +='<option value="Revenue">Revenue</option>';
                                html +='<option value="Customer">Customer</option>';
                                html +='<option value="Process">Process</option>';
                                html +='<option value="People">People</option>';
                                html +='<option value="Projects">Projects</option>';
                            html +='</select>';
                            html += '<div class="text-danger key_bus_drivers_1_error" id=""></div>';
                        html +='</td>';

                        html +='<td>';
                            html +='<textarea name="key_res_areas_1[]" id="key_res_areas_1" class="form-control key_res_areas_1"></textarea>';
                            html += '<div class="text-danger key_res_areas_1_error" id=""></div>';
                        html +='</td>';

                        html +='<td>';
                            html +='<textarea name="measurement_criteria_1[]" id="" class="form-control"></textarea>';
                        html +='</td>';

                        html +='<td>';
                            html +='<textarea type="text" name="self_assessment_remark_1[]" id="self_assessment_remark_1" class="form-control self_assessment_remark_1"></textarea>';
                            html += '<div class="text-danger self_assessment_remark_1_error" id=""></div>';
                        html +='</td>';

                        html +='<td>';
                            html +='<select id="rating_by_employee_1" class="form-control js-example-basic-single key_bus_drivers rating_by_employee_1" name="rating_by_employee_1[]">';
                                html +='<option value="">...Select...</option>';
                                html +='<option value="EE">EE</option>';
                                html +='<option value="AE">AE</option>';
                                html +='<option value="ME">ME</option>';
                                html +='<option value="PE">PE</option>';
                                html +='<option value="ND">ND</option>';
                            html +='</select>';
                            html += '<div class="text-danger rating_by_employee_1_error" id=""></div>';
                        html +='</td>';

                        html +='<td>';
                            html +='<div style="margin-top: 80px;"></div>';
                        html +='</td>';

                        html +='<td>';
                            html +='<div class="dropup">';
                                html +='<button type="button" class="btn btn-xs btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>';
                                html +='<div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">';
                                    html +='<a class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs" type="button" data-original-title="Add KRA" title="Add KRA"><i class="fa fa-plus" onclick="additionalKRA(this,1);"></i></button></a>';
                                    // html +='<a class="dropdown-item ditem-gs"><button class="btn btn-info btn-xs" type="button" data-original-title="Edit KRA" title="Edit KRA"><i class="fa fa-pencil"></i></button></a>';
                                    html +='<a class="dropdown-item ditem-gs"><button class="btn btn-danger btn-xs" type="button"  id="btnDelete" data-original-title="Delete KRA" title="Delete KRA"><i class="fa fa-trash-o"></i></button></a>';
                                html +='</div>';
                            html +='</div>';

                            // html +='<div class="dropup m-t-5">';
                            //     html +='<button type="button" class="btn btn-xs btn-info" style="padding:0.37rem 0.8rem !important;" data-original-title="Edit KRA" title="Edit KRA"><i class="fa fa-pencil"></i></button>';
                            // html +='</div>';
                            // html +='<div class="dropup m-t-5">';
                            //     html +='<button type="button" class="btn btn-xs btn-danger" id="btnDelete" style="padding:0.37rem 0.8rem !important;" data-original-title="Edit KRA" title="Edit KRA"><i class="fa fa-close"></i></button>';
                            // html +='</div>';

                            // html +=' <button class="btn btn-primary btn-xs" type="button" data-original-title="Add KRA" title="Add KRA"><i class="fa fa-plus" onclick="additionalKRA(this,0);"></i></button>';
                            // html +=' <button class="btn btn-info btn-xs" type="button" data-original-title="Edit KRA" title="Edit KRA"><i class="fa fa-pencil"></i></button>';
                            // html +=' <button class="btn btn-danger btn-xs" type="button" data-original-title="Delete KRA" title="Delete KRA"><i class="fa fa-trash-o"></i></button>';
                        html +='</td>';
                    html +='</tr>';
                $('#goal-tb tr:last').after(html);

            },
        2000 );

        login_user_details();
    });

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

        var html2 = '<textarea class="form-control m-t-5 key_res_areas_'+cur_rowCount+' '+code+'" id="key_res_areas_'+code+'" name="key_res_areas_'+cur_rowCount+'[]"></textarea>';
            html2 += '<div class="text-danger key_res_areas_'+code+'_error" id=""></div>';
        var html3 = '<textarea class="form-control m-t-5 measurement_criteria_'+cur_rowCount+' '+code+'" id="measurement_criteria_'+code+'" name="measurement_criteria_'+cur_rowCount+'[]"></textarea>';
        var html4 = '<textarea class="form-control m-t-5 self_assessment_remark_'+cur_rowCount+' '+code+'"  id="self_assessment_remark_'+code+'" name="self_assessment_remark_'+cur_rowCount+'[]"></textarea>';
            html4 += '<div class="text-danger self_assessment_remark_'+code+'_error" id=""></div>';

        var html5 ='';
            html5 +='<select class="form-control js-example-basic-single key_bus_drivers m-t-35 rating_by_employee_'+cur_rowCount+' '+code+'"  id="rating_by_employee_'+code+'" name="rating_by_employee_'+cur_rowCount+'[]">';
                        html5 +='<option value="">...Select...</option>';
                        html5 +='<option value="EE">EE</option>';
                        html5 +='<option value="AE">AE</option>';
                        html5 +='<option value="ME">ME</option>';
                        html5 +='<option value="PE">PE</option>';
                        html5 +='<option value="ND">ND</option>';
            html5 +='</select>';
            html5 += '<div class="text-danger rating_by_employee_'+code+'_error" id=""></div>';

        var html11 = '';

        html11 +='<div class="dropup m-t-35">';
            html11 +='<button type="button" class="btn btn-xs btn-danger '+code+'" onclick="removeRow(this,'+code+');" style="padding:0.37rem 0.8rem !important;" data-original-title="Edit KRA" title="Edit KRA"><i class="fa fa-close"></i></button>';
            // html7 +='<button type="button" class="btn btn-xs btn-danger sub_row_'+cur_rowCount+'" onclick="removeRow(this,'+class_sub+');" style="padding:0.37rem 0.8rem !important;" data-original-title="Edit KRA" title="Edit KRA"><i class="fa fa-close"></i></button>';
        html11 +='</div>';

        $(x).closest("tr").find("td:eq(2)").append(html2);
        $(x).closest("tr").find("td:eq(3)").append(html3);
        $(x).closest("tr").find("td:eq(4)").append(html4);
        $(x).closest("tr").find("td:eq(5)").append(html5);
        $(x).closest("tr").find("td:eq(6)").append(html11);

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
                    html +='<select class="form-control js-example-basic-single key_bus_drivers key_bus_drivers_'+cur_rowCount+'" id="key_bus_drivers_'+cur_rowCount+'" name="key_bus_drivers_'+cur_rowCount+'[]">';
                        html +='<option value="">...Select...</option>';
                        html +='<option value="Revenue">Revenue</option>';
                        html +='<option value="Customer">Customer</option>';
                        html +='<option value="Process">Process</option>';
                        html +='<option value="People">People</option>';
                        html +='<option value="Projects">Projects</option>';
                    html +='</select>';
                    html += '<div class="text-danger key_bus_drivers_'+cur_rowCount+'_error" id=""></div>';
                html +='</td>';

                html +='<td>';
                    html +='<textarea name="key_res_areas_'+cur_rowCount+'[]" id="key_res_areas_'+cur_rowCount+'" class="form-control key_res_areas_'+cur_rowCount+'"></textarea>';
                    html += '<div class="text-danger key_res_areas_'+cur_rowCount+'_error" ></div>';
                html +='</td>';

                html +='<td>';
                    html +='<textarea name="measurement_criteria_'+cur_rowCount+'[]" id="" class="form-control"></textarea>';
                html +='</td>';

                html +='<td>';
                    html +='<textarea name="self_assessment_remark_'+cur_rowCount+'[]" id="self_assessment_remark_'+cur_rowCount+'" class="form-control self_assessment_remark_'+cur_rowCount+'"></textarea>';
                    html += '<div class="text-danger self_assessment_remark_'+cur_rowCount+'_error" id=""></div>';
                html +='</td>';

                // html +='<td>';
                //     html +='<input type="text" name="weightage_'+cur_rowCount+'[]" id="" class="form-control">';
                // html +='</td>';

                html +='<td>';
                    html +='<select class="form-control js-example-basic-single key_bus_drivers rating_by_employee_'+cur_rowCount+'" id="rating_by_employee_'+cur_rowCount+'" name="rating_by_employee_'+cur_rowCount+'[]">';
                        html +='<option value="">...Select...</option>';
                        html +='<option value="EE">EE</option>';
                        html +='<option value="AE">AE</option>';
                        html +='<option value="ME">ME</option>';
                        html +='<option value="PE">PE</option>';
                        html +='<option value="ND">ND</option>';
                    html +='</select>';
                    html += '<div class="text-danger rating_by_employee_'+cur_rowCount+'_error" id=""></div>';
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
                html +='</td>';

            html +='</tr>';

        $('#goal-tb tr:last').after(html);
        updatesno();
    }

    //Edit pop-up model and data show
    function login_user_details(){

        $.ajax({
            url: "get_goal_login_user_details_sup",
            method: "GET",
            dataType: "json",
            success: function(data) {
                // console.log(data)
                if(data.length !=0){                                        
                    $('#sup_dept').html(data[0].department);                    
                }
            }
        });

        $.ajax({
            url: "get_goal_login_user_details_rev",
            method: "GET",
            dataType: "json",
            success: function(data) {
                // console.log(data)
                if(data.length !=0){                                        
                    $('#rev_dept').html(data[0].department);                    
                }
            }
        });

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

    //New entry    
    $("#datatable_form_save").on('click',()=>{
        $('button[type="submit"]').attr('disabled' , true);
        var error='';
        var rate = $("#employee_consolidated_rate").val();
        var $errmsg3 = $(".employee_consolidated_rate_error");
        $errmsg3.hide();

        if(rate == ""){
            $errmsg3.html('Employee Consolidated Rate is required').show();                
            error+="error";
        }

        $('#goal-tb tr').each(function() {
            var col0=$(this).find("td:eq(0)").text();
            var col1=$(this).find("td:eq(1) option:selected").val();
            var col2=$(this).find("td:eq(2) textarea").val();
            var col4=$(this).find("td:eq(4) textarea").val();
            var col5=$(this).find("td:eq(5) option:selected").val();
            // console.log(col0)
            // console.log(col1)

            // Key business drivers
            var err_div_name = ".key_bus_drivers_"+col0+"_error";            
            var $errmsg0 = $(err_div_name);
            $errmsg0.hide();
            
            if(col1 == ""){
                $errmsg0.html('Key business drivers is required').show();                
                error+="error";
            }
            
            //Key result areas
            var cass_name = ".key_res_areas_"+col0;

            $(cass_name).each(function () {                
                var sub_value = $(this).val();
                var sub_class_id = $(this).get(0).id;
                var err_div_name = "."+sub_class_id+"_error";
                var $errmsg = $(err_div_name);
                $errmsg.hide();
                
                if(sub_value == ""){
                    $errmsg.html('Key result areas is required').show();                
                    error+="error";
                }
                    
            });

            //Self Assessment (Qualitative Remarks) by Employee
            var cass_name1 = ".self_assessment_remark_"+col0;

            $(cass_name1).each(function () {          
                var sub_value1 = $(this).val();
                var sub_class_id1 = $(this).get(0).id;
                var err_div_name1 = "."+sub_class_id1+"_error";
                var $errmsg1 = $(err_div_name1);
                $errmsg1.hide();
                console.log(err_div_name1)
                
                if(sub_value1 == ""){
                    $errmsg1.html('Self assessment is required').show();                
                    error+="error";
                }
                    
            });

            //Rating by Employee
            var cass_name2 = ".rating_by_employee_"+col0;

            $(cass_name2).each(function () {                
                var sub_value2 = $(this).val();
                var sub_class_id2 = $(this).get(0).id;
                var err_div_name2 = "."+sub_class_id2+"_error";
                var $errmsg2 = $(err_div_name2);
                $errmsg2.hide();
                
                if(sub_value2 == ""){
                    $errmsg2.html('Rating by employee is required').show();                
                    error+="error";
                }
                    
            });

        });

        //Sending data to database
        if(error==""){
            // alert("succes")
            new_data_insert();
        }             

        function new_data_insert(){
            $.ajax({            
                url:"{{ url('add_goals_data') }}",
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

                    // $("#goals_setting_id").val(data);
                    // $("#datatable_form_save").css('display', 'none');
                    // $("#datatable_form_update").css('display', 'block');
                    // $("#goal_sheet_submit").css('display', 'none');
                    // $("#goal_sheet_submit_update").css('display', 'block');

                    location = "goals";                

                }
            });
                    
        }
        return false;        
    });    

    //New Submit entry
    $("#goal_sheet_submit").on('click',()=>{        

        $('button[type="submit"]').attr('disabled' , true);

        var error='';

        var rate = $("#employee_consolidated_rate").val();
        var $errmsg3 = $(".employee_consolidated_rate_error");
        $errmsg3.hide();

        if(rate == ""){
            $errmsg3.html('Employee Consolidated Rate is required').show();                
            error+="error";
        }

        $('#goal-tb tr').each(function() {
            var col0=$(this).find("td:eq(0)").text();
            var col1=$(this).find("td:eq(1) option:selected").val();
            var col2=$(this).find("td:eq(2) textarea").val();
            var col4=$(this).find("td:eq(4) textarea").val();
            var col5=$(this).find("td:eq(5) option:selected").val();
            // console.log(col0)
            // console.log(col1)

            // Key business drivers
            var err_div_name = ".key_bus_drivers_"+col0+"_error";            
            var $errmsg0 = $(err_div_name);
            $errmsg0.hide();
            
            if(col1 == ""){
                $errmsg0.html('Key business drivers is required').show();                
                error+="error";
            }
            
            //Key result areas
            var cass_name = ".key_res_areas_"+col0;

            $(cass_name).each(function () {                
                var sub_value = $(this).val();
                var sub_class_id = $(this).get(0).id;
                var err_div_name = "."+sub_class_id+"_error";
                var $errmsg = $(err_div_name);
                $errmsg.hide();
                
                if(sub_value == ""){
                    $errmsg.html('Key result areas is required').show();                
                    error+="error";
                }
                    
            });

            //Self Assessment (Qualitative Remarks) by Employee
            var cass_name1 = ".self_assessment_remark_"+col0;

            $(cass_name1).each(function () {          
                var sub_value1 = $(this).val();
                var sub_class_id1 = $(this).get(0).id;
                var err_div_name1 = "."+sub_class_id1+"_error";
                var $errmsg1 = $(err_div_name1);
                $errmsg1.hide();
                console.log(err_div_name1)
                
                if(sub_value1 == ""){
                    $errmsg1.html('Self assessment is required').show();                
                    error+="error";
                }
                    
            });

            //Rating by Employee
            var cass_name2 = ".rating_by_employee_"+col0;

            $(cass_name2).each(function () {                
                var sub_value2 = $(this).val();
                var sub_class_id2 = $(this).get(0).id;
                var err_div_name2 = "."+sub_class_id2+"_error";
                var $errmsg2 = $(err_div_name2);
                $errmsg2.hide();
                
                if(sub_value2 == ""){
                    $errmsg2.html('Rating by employee is required').show();                
                    error+="error";
                }
                    
            });

        });

        //Sending data to database
        if(error==""){
            // alert("succes")
            new_sub_goal_data_insert();
        }

        function new_sub_goal_data_insert(){
            $.ajax({            
                url:"{{ url('add_goals_data_submit') }}",
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

                    location = "goals";                

                }
            });
                    
        }        

        return false;        
    });
    
    //update entry
    $("#datatable_form_update").on('click',()=>{   
        
        $('button[type="submit"]').attr('disabled' , true);
        
        var error='';

        var rate = $("#employee_consolidated_rate").val();
        var $errmsg3 = $(".employee_consolidated_rate_error");
        $errmsg3.hide();

        if(rate == ""){
            $errmsg3.html('Employee Consolidated Rate is required').show();
            error+="error";
        }

        $('#goal-tb tr').each(function() {
            var col0=$(this).find("td:eq(0)").text();
            var col1=$(this).find("td:eq(1) option:selected").val();
            var col2=$(this).find("td:eq(2) textarea").val();
            var col4=$(this).find("td:eq(4) textarea").val();
            var col5=$(this).find("td:eq(5) option:selected").val();
            // console.log(col0)
            // console.log(col1)

            // Key business drivers
            var err_div_name = ".key_bus_drivers_"+col0+"_error";
            var $errmsg0 = $(err_div_name);
            $errmsg0.hide();

            if(col1 == ""){
                $errmsg0.html('Key business drivers is required').show();
                error+="error";
            }

            //Key result areas
            var cass_name = ".key_res_areas_"+col0;

            $(cass_name).each(function () {
                var sub_value = $(this).val();
                var sub_class_id = $(this).get(0).id;
                var err_div_name = "."+sub_class_id+"_error";
                var $errmsg = $(err_div_name);
                $errmsg.hide();

                if(sub_value == ""){
                    $errmsg.html('Key result areas is required').show();
                    error+="error";
                }

            });

            //Self Assessment (Qualitative Remarks) by Employee
            var cass_name1 = ".self_assessment_remark_"+col0;

            $(cass_name1).each(function () {
                var sub_value1 = $(this).val();
                var sub_class_id1 = $(this).get(0).id;
                var err_div_name1 = "."+sub_class_id1+"_error";
                var $errmsg1 = $(err_div_name1);
                $errmsg1.hide();
                console.log(err_div_name1)

                if(sub_value1 == ""){
                    $errmsg1.html('Self assessment is required').show();
                    error+="error";
                }

            });

            //Rating by Employee
            var cass_name2 = ".rating_by_employee_"+col0;

            $(cass_name2).each(function () {
                var sub_value2 = $(this).val();
                var sub_class_id2 = $(this).get(0).id;
                var err_div_name2 = "."+sub_class_id2+"_error";
                var $errmsg2 = $(err_div_name2);
                $errmsg2.hide();

                if(sub_value2 == ""){
                    $errmsg2.html('Rating by employee is required').show();
                    error+="error";
                }

            });

        });

        //Sending data to database
        if(error==""){
            // alert("succes")
            update_data_insert();
        }
        
        function update_data_insert(){
            $.ajax({            
                url:"{{ url('update_emp_goals_data') }}",
                type:"POST",
                data:$('#goalsForm').serialize(),
                dataType : "JSON",
                success:function(data)
                {

                    Toastify({
                        text: "Updated Sucessfully..!",
                        duration: 3000,
                        close:true,
                        backgroundColor: "#4fbe87",
                    }).showToast();    
                    
                    $('button[type="submit"]').attr('disabled' , false);

					$("#datatable_form_save").css('display', 'none');
					$("#datatable_form_update").css('display', 'block');

                    // location = "goal_setting_edit?id="+data+"";                

                }
            });
                    
        }        

        return false;        
    });

    //update Submit entry
    $("#goal_sheet_submit_update").on('click',()=>{
        $('button[type="submit"]').attr('disabled' , true);

        var error='';
        var rate = $("#employee_consolidated_rate").val();
        var $errmsg3 = $(".employee_consolidated_rate_error");
        $errmsg3.hide();

        if(rate == ""){
            $errmsg3.html('Employee Consolidated Rate is required').show();                
            error+="error";
        }

        $('#goal-tb tr').each(function() {
            var col0=$(this).find("td:eq(0)").text();
            var col1=$(this).find("td:eq(1) option:selected").val();
            var col2=$(this).find("td:eq(2) textarea").val();
            var col4=$(this).find("td:eq(4) textarea").val();
            var col5=$(this).find("td:eq(5) option:selected").val();
            // console.log(col0)
            // console.log(col1)

            // Key business drivers
            var err_div_name = ".key_bus_drivers_"+col0+"_error";            
            var $errmsg0 = $(err_div_name);
            $errmsg0.hide();
            
            if(col1 == ""){
                $errmsg0.html('Key business drivers is required').show();                
                error+="error";
            }
            
            //Key result areas
            var cass_name = ".key_res_areas_"+col0;

            $(cass_name).each(function () {                
                var sub_value = $(this).val();
                var sub_class_id = $(this).get(0).id;
                var err_div_name = "."+sub_class_id+"_error";
                var $errmsg = $(err_div_name);
                $errmsg.hide();
                
                if(sub_value == ""){
                    $errmsg.html('Key result areas is required').show();                
                    error+="error";
                }
                    
            });

            //Self Assessment (Qualitative Remarks) by Employee
            var cass_name1 = ".self_assessment_remark_"+col0;

            $(cass_name1).each(function () {          
                var sub_value1 = $(this).val();
                var sub_class_id1 = $(this).get(0).id;
                var err_div_name1 = "."+sub_class_id1+"_error";
                var $errmsg1 = $(err_div_name1);
                $errmsg1.hide();
                console.log(err_div_name1)
                
                if(sub_value1 == ""){
                    $errmsg1.html('Self assessment is required').show();                
                    error+="error";
                }
                    
            });

            //Rating by Employee
            var cass_name2 = ".rating_by_employee_"+col0;

            $(cass_name2).each(function () {                
                var sub_value2 = $(this).val();
                var sub_class_id2 = $(this).get(0).id;
                var err_div_name2 = "."+sub_class_id2+"_error";
                var $errmsg2 = $(err_div_name2);
                $errmsg2.hide();
                
                if(sub_value2 == ""){
                    $errmsg2.html('Rating by employee is required').show();                
                    error+="error";
                }
                    
            });

        });

        //Sending data to database
        if(error==""){
            // alert("succes")
            update_submit_data_insert();
        }

        function update_submit_data_insert(){
            var employee_consolidated_rate = $("#employee_consolidated_rate").val();

            $.ajax({            
                url:"{{ url('update_emp_goals_data_submit') }}",
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

                    location = "goals";                

                }
            });
                    
        }        
        return false;        
    });

</script>
@endsection

