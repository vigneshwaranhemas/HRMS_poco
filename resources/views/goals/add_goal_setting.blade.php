{{-- vigneshwaran --}}
@extends(Auth::user()->role_type === 'Admin' ? 'layouts.simple.admin_master' : ( Auth::user()->role_type === 'Buddy'? 'layouts.simple.buddy_master ': ( Auth::user()->role_type === 'can'? 'layouts.simple.candidate_master ': ( Auth::user()->role_type === 'HR'? 'layouts.simple.hr_master ': ( Auth::user()->role_type === 'Itinfra'? 'layouts.simple.itinfra_master ': ( Auth::user()->role_type === 'Site Admin'? 'layouts.simple.site_admin_master': '' ) ) ) ) ) )
@section('title', 'Premium Admin Template')

@section('css')
<link rel="stylesheet" type="text/css" href="../assets/css/prism.css">
    <!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="../assets/css/chartist.css">
<link rel="stylesheet" type="text/css" href="../assets/css/date-picker.css">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
	<h2>Goal Setting<span>Process</span></h2>
@endsection

@section('breadcrumb-items')
   {{--<li class="breadcrumb-item">Dashboard</li>
	<li class="breadcrumb-item active">Default</li>--}}
@endsection

@section('content')
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="ribbon-vertical-right-wrapper card">
                <div class="card-body">
                    <div class="ribbon ribbon-bookmark ribbon-vertical-right ribbon-primary" style="height: 107px !important;"><span style="writing-mode: vertical-rl;text-orientation: upright;margin-left: -25px;"> Goals</span></div>
                    <div class="row">
                        <div class="col-md-4">
                        
                        <h6 class="mb-0 f-w-700"><i class="fa fa-user"> </i> Name</h6>
                        <p>Ganagavathy KGV</p>
                        </div>
                        <div class="col-md-4">
                        <h6 class="mb-0 f-w-700"><i class="fa fa-sitemap"> </i> Function</h6>
                        <p>IT</p>
                        </div>
                        <div class="col-md-4">
                        <h6 class="mb-0 f-w-700"><i class="fa fa-ticket"> </i> Emp ID</h6>
                        <p>900102</p>
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

    $(document).ready(function() {
        setTimeout(
            function() {
                var html = '<tr>';
                        html +='<td scope="row">1</td>';
                        html +='<td>';
                            html +='<select class="form-control js-example-basic-single">';
                                html +='<option value="Revenue">Revenue</option>';
                                html +='<option value="Customer">Customer</option>';
                                html +='<option value="Process">Process</option>';
                                html +='<option value="People">People</option>';
                                html +='<option value="Projects">Projects</option>';
                            html +='</select>';
                        html +='</td>';
                            
                        html +='<td>';
                            html +='<input type="text" name="" id="" class="form-control">';
                        html +='</td>';
                            
                        html +='<td>';
                            html +='<input type="text" name="" id="" class="form-control">';
                        html +='</td>';
                            
                        html +='<td>';
                            html +='<input type="text" name="" id="" class="form-control">';
                        html +='</td>';
                            
                        html +='<td>';
                            html +='<input type="text" name="" id="" class="form-control">';
                        html +='</td>';

                        html +='<td>';
                            html +='<input type="text" name="" id="" class="form-control">';
                        html +='</td>';
                            
                        html +='<td>';
                            html +='<div class="dropup">';
                                html +='<button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>';
                                html +='<div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">';
                                    html +='<a class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs" type="button" data-original-title="Add KRA" title="Add KRA"><i class="fa fa-plus" onclick="additionalKRA(this,0);"></i></button></a>';
                                    html +='<a class="dropdown-item ditem-gs"><button class="btn btn-info btn-xs" type="button" data-original-title="Edit KRA" title="Edit KRA"><i class="fa fa-pencil"></i></button></a>';
                                    html +='<a class="dropdown-item ditem-gs"><button class="btn btn-danger btn-xs" type="button" data-original-title="Delete KRA" title="Delete KRA"><i class="fa fa-trash-o"></i></button></a>';
                                html +='</div>';
                            html +='</div>';
                            
                            // html +=' <button class="btn btn-primary btn-xs" type="button" data-original-title="Add KRA" title="Add KRA"><i class="fa fa-plus" onclick="additionalKRA(this,0);"></i></button>';
                            // html +=' <button class="btn btn-info btn-xs" type="button" data-original-title="Edit KRA" title="Edit KRA"><i class="fa fa-pencil"></i></button>';
                            // html +=' <button class="btn btn-danger btn-xs" type="button" data-original-title="Delete KRA" title="Delete KRA"><i class="fa fa-trash-o"></i></button>';
                        html +='</td>';
                    html +='</tr>';
                $('#goal-tb tr:last').after(html);
        
            }, 
        2000 );
    });

    $(".use-address").click(function() {
        var html = '<input type="text" name="" id="" class="form-control m-t-5">';
        
        var id = $(this).closest("tr").find("td:eq(2)").html(html);
        // $("#resultas").append(id);
    });

    function additionalKRA(x,cur_rowCount) {
        // alert($(x).closest('td').parent()[0].sectionRowIndex);

        var html = '<input type="text" name="" id="" class="form-control m-t-5">';
        $(x).closest("tr").find("td:eq(2)").append(html);
        $(x).closest("tr").find("td:eq(3)").append(html);
        $(x).closest("tr").find("td:eq(4)").append(html);
        $(x).closest("tr").find("td:eq(6)").append(html);

        

    }
    function additionalKBD(){
        var rowCount = $('#myTable tr').length;
        var cur_rowCount = rowCount + 1;
        var html = '<tr>';
                html +='<td scope="row">1</td>';
                html +='<td>';
                    html +='<select class="form-control js-example-basic-single">';
                        html +='<option value="Revenue">Revenue</option>';
                        html +='<option value="Customer">Customer</option>';
                        html +='<option value="Process">Process</option>';
                        html +='<option value="People">People</option>';
                        html +='<option value="Projects">Projects</option>';
                    html +='</select>';
                html +='</td>';
                    
                html +='<td>';
                    html +='<input type="text" name="" id="" class="form-control">';
                html +='</td>';
                    
                html +='<td>';
                    html +='<input type="text" name="" id="" class="form-control">';
                html +='</td>';
                    
                html +='<td>';
                    html +='<input type="text" name="" id="" class="form-control">';
                html +='</td>';
                    
                html +='<td>';
                    html +='<input type="text" name="" id="" class="form-control">';
                html +='</td>';

                html +='<td>';
                    html +='<input type="text" name="" id="" class="form-control">';
                html +='</td>';
                
                html +='<td>';
                    html +='<div class="dropup">';
                        html +='<button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>';
                        html +='<div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">';
                                    html +='<a class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs" type="button" data-original-title="Add KRA" title="Add KRA"><i class="fa fa-plus" onclick="additionalKRA(this,'+cur_rowCount+');"></i></button></a>';
                                    html +='<a class="dropdown-item ditem-gs"><button class="btn btn-info btn-xs" type="button" data-original-title="Edit KRA" title="Edit KRA"><i class="fa fa-pencil"></i></button></a>';
                                    html +='<a class="dropdown-item ditem-gs"><button class="btn btn-danger btn-xs" type="button" data-original-title="Delete KRA" title="Delete KRA"><i class="fa fa-trash-o"></i></button></a>';
                        html +='</div>';
                    html +='</div>';
                            
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

</script>
@endsection

