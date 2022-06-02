{{-- Divya --}}
@extends(Auth::user()->role_type === 'Admin' ? 'layouts.simple.admin_master' : ( Auth::user()->role_type === 'Buddy'? 'layouts.simple.buddy_master ': ( Auth::user()->role_type === 'Employee'? 'layouts.simple.candidate_master ': ( Auth::user()->role_type === 'HR'? 'layouts.simple.hr_master ': ( Auth::user()->role_type === 'IT Infra'? 'layouts.simple.itinfra_master ': ( Auth::user()->role_type === 'Site Admin'? 'layouts.simple.site_admin_master': '' ) ) ) ) ) )
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
        position: relative;
        margin-left: 1258px;
        margin-bottom: 24px;
    }
    #goal_sheet_add{
        position: relative;
        margin-left: 1258px;
        margin-bottom: 24px;
    }
    .goals-header
    {
        padding: 0.55rem 1.15rem 0.1rem;
    }
</style>
@endsection

@section('breadcrumb-title')
	<h2>View<span>Goals </span></h2>
@endsection

@section('breadcrumb-items')
<a class="btn btn-success text-white" title="Exceeded Expectations">EE</a>
<a class="btn btn-secondary m-l-10 text-white" title="Achieved Expectations">AE</a>
<a class="btn btn-info m-l-10 text-white" title="Met Expectations">ME</a>
<a class="btn btn-warning m-l-10 text-white" title="Partially Met Expectations">PME</a>
<a class="btn btn-dark m-l-10 text-white" title="Needs Development">ND</a>
@endsection

@section('content')
	<!-- Container-fluid starts-->
    <div class="container-fluid">
		<div class="row">

            <div class="card-header bg-primary goals-header">
                <h5 class="text-white" id="goals_sheet_head"></h5>
            </div>
			<div class="col-sm-12">
                <div class="ribbon-vertical-right-wrapper card">
                    <div class="card-body">
                        <div class="ribbon ribbon-bookmark ribbon-vertical-right ribbon-primary" style="height: 107px !important;"><span style="writing-mode: vertical-rl;text-orientation: upright;margin-left: -25px;"> Goals</span></div>
                        <div class="row">
                            <div class="col-md-4">

                                <div class="row">
                                    <div class="col-md-5">
                                        <h6 class="mb-0 f-w-700"><i class="fa fa-user"> </i> Name :</h6>
                                    </div>
                                    <div class="col-md-7">
                                        <p>{{$user_info->username }}</p>
                                    </div>
                                    <div class="col-md-5 m-t-10">
                                        <h6 class="mb-0 f-w-700"><i class="fa fa-user"> </i> Emp ID :</h6>
                                    </div>
                                    <div class="col-md-7 m-t-10">
                                        <p>{{ $user_info->empID }}</p>
                                    </div>
                                    <div class="col-md-5 m-t-10">
                                        <h6 class="mb-0 f-w-700"><i class="fa fa-user"> </i> Supervisor :</h6>
                                    </div>
                                    <div class="col-md-47 m-t-10">
                                        <p>{{ $user_info->sup_name }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-5">
                                        <h6 class="mb-0 f-w-700"><i class="fa fa-user"> </i> Supervisor ID :</h6>
                                    </div>
                                    <div class="col-md-7">
                                        <p>{{ $user_info->sup_emp_code }}</p>
                                    </div>
                                    <div class="col-md-5 m-t-10">
                                        <h6 class="mb-0 f-w-700"><i class="fa fa-user"> </i> HRBP :</h6>
                                    </div>
                                    <div class="col-md-7 m-t-10">
                                        <p>Rajesh M S</p>
                                    </div>
                                    <div class="col-md-5 m-t-10">
                                        <h6 class="mb-0 f-w-700"><i class="fa fa-user"> </i> HRBP ID :</h6>
                                    </div>
                                    <div class="col-md-7 m-t-10">
                                        <p>900380</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-5">
                                        <h6 class="mb-0 f-w-700"><i class="fa fa-user"> </i> Department :</h6>
                                    </div>
                                    <div class="col-md-7">
                                        <p>{{ $user_info->department }}</p>
                                    </div>
                                    <div class="col-md-5 m-t-10">
                                        <h6 class="mb-0 f-w-700"><i class="fa fa-user"> </i> Reviewer :</h6>
                                    </div>
                                    <div class="col-md-7 m-t-10">
                                        <p>{{$user_info->reviewer_name }}</p>
                                    </div>
                                    <div class="col-md-5 m-t-10">
                                        <h6 class="mb-0 f-w-700"><i class="fa fa-user"> </i> Reviewer ID :</h6>
                                    </div>
                                    <div class="col-md-7 m-t-10">
                                        <p>{{$user_info->reviewer_emp_code }}</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    </div>




				<input type="hidden" id="goals_setting_id">

				<div class="card  card-absolute">


					<div class="card-body">

                        <input type="hidden" id="user_type" >
                        <button type="button" class="btn btn-warning" id="goal_sheet_edit"  title="Edit">Edit</button>
                        <button type="button" class="btn btn-primary" id="goal_sheet_add" style="display:none;">Submit</button>
						<div class="table-responsive m-b-15 ">
							<table class="table  table-border-vertical table-border-horizontal" id="goal-tb">
								<thead>
									<tr>
										<th scope="col">No</th>
										<th scope="col">Key Business Drivers</th>
										<th scope="col">Key Result Areas </th>
										<th scope="col">Measurement Criteria (Quantified Measures)</th>
										<th scope="col">Self Assessment (Qualitative Remarks) by Employee</th>
										<th scope="col">Rating by Employee</th>
										<th scope="col" class="supervisor_remarks">Supervisors Assessment (Qualitative Remarks by Reporting Manager)</th>
										<th scope="col" class="supervisor_rating">Rating by Supervisor </th>
										<th scope="col" class="reviewer_remarks">Reviewer Remarks </th>
										<th scope="col">HR Remarks</th>
										<th scope="col" class="business_head">Business Head assessment and Approval for Release</th>
									</tr>
								</thead>
								<tbody id="goals_record">

								</tbody>
							</table>
                            <div class="m-t-20 m-b-30 row float-right" id="save_div">
                                <div class="col-lg-4" id="consolidated_rating_id" style="display: none">
                                    <label>Consolidated Rating</label><br>
                                    <select class="js-example-basic-single" style="width:200px;margin-top:30px !important;" id="supervisor_consolidated_rate" name="employee_consolidated_rate">
                                        <option value="" selected>...Select...</option>
                                        <option value="EE">EE</option>
                                        <option value="AE">AE</option>
                                        <option value="ME">ME</option>
                                        <option value="PE">PE</option>
                                        <option value="ND">ND</option>
                                    </select>

                                    <div class="text-danger supervisor_consolidated_rate_error" id=""></div>
                                </div>
                                <div class="col-lg-4">
                                    <label>Status</label><br>
                                    <select class="js-example-basic-single" style="width:200px;margin-top:30px !important;" id="Bh_status" name="Bh_status">
                                        <option value="" selected>...Select...</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Reverted">Reverted</option>
                                    </select>

                                    <div class="text-danger supervisor_consolidated_rate_error" id=""></div>
                                </div>
                                <div class="col-lg-4">
                                <a onclick="supFormSubmit();" class="btn btn-primary text-white m-t-30" title="Overall Submit">Save</a>
                                </div>
                                </div>

						</div>
					</div>

				</div>
			</div>

		</div>
	</div>
	<!-- Container-fluid Ends-->
@endsection

@section('script')
    <!-- latest jquery-->
    <script src="../assets/js/jquery-3.5.1.min.js"></script>
	<!-- Bootstrap js-->
	<script src="../assets/js/bootstrap/popper.min.js"></script>
	<script src="../assets/js/bootstrap/bootstrap.js"></script>
	<!-- feather icon js-->
	<script src="../assets/js/icons/feather-icon/feather.min.js"></script>
	<script src="../assets/js/icons/feather-icon/feather-icon.js"></script>
	<!-- Sidebar jquery-->
	<script src="../assets/js/sidebar-menu.js"></script>
	<script src="../assets/js/config.js"></script>
	<!-- Plugins JS start-->
	<script src="../assets/js/select2/select2.full.min.js"></script>
	<script src="../assets/js/select2/select2-custom.js"></script>
	<script src="../assets/js/chat-menu.js"></script>
    <script src="../assets/js/button-tooltip-custom.js"></script>

	<!-- Plugins JS Ends-->
	<!-- Theme js-->
	<script src="../assets/js/script.js"></script>
	<script src="../assets/js/theme-customizer/customizer.js"></script>
	<!-- login js-->
	<!-- Plugin used-->
	<script>
        $( document ).ready(function() {
			// goal_record();
			$('#goal-tb').DataTable( {
				dom: 'Bfrtip',
				buttons: [
					'copyHtml5',
					'excelHtml5',
					'csvHtml5',
					'pdfHtml5'
				]
			} );
		});
		var params = new window.URLSearchParams(window.location.search);
		var id=params.get('id')
		$('#goals_setting_id').val(id);

		var id = $('#goals_setting_id').val();

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
			url:"{{ url('fetch_goals_reviewer_details') }}",
			type:"GET",
			data:{id:id},
			dataType : "JSON",
			success:function(response)
			{
                $('#goal-tb').DataTable().clear().destroy();


                //   for(var i=0;i<response.hidden_rows.length;i++){
                //        $("."+response.hidden_rows[i]).hide();
                //   }
				$('#goals_record').append('');
				$('#goals_record').append(response.html);
                     $('#goal-tb').DataTable( {
                    	dom: 'Bfrtip',
                    	buttons: [
                    		'copyHtml5',
                    		'excelHtml5',
                    		'csvHtml5',
                    		'pdfHtml5'
                    	]
                    } );
                    if(response.reviewer==1){
                    //  alert("one")
                     $(".supervisor_remarks").hide();
                     $(".reviewer_remarks").hide();
                     $(".supervisor_rating").show();
                     $("#consolidated_rating_id").show();
                 }
                 else if(response.reviewer==2){
                     $(".supervisor_remarks").show();
                     $(".reviewer_remarks").hide();
                     $(".supervisor_rating").show();
                     $("#consolidated_rating_id").hide();

                 }
                 else{
                     $(".supervisor_remarks").show();
                     $(".reviewer_remarks").show();
                     $(".supervisor_rating").show();
                     $("#consolidated_rating_id").hide();

                 }
                 $("#user_type").val(response.reviewer);
			},
			error: function(error) {
				console.log(error);

			}

		});


      $(()=>{
          $("#goal_sheet_edit").on('click',()=>{
              var i=1;
              var j=1;
              var user_type=$("#user_type").val();
              $("#goal_sheet_edit").hide();
              $("#goal_sheet_add").show();
              if(user_type==1 || user_type==2 || user_type==0)
              {
                   var defined_class="business_head";
              }
            //   alert(defined_class)
              $("#goal-tb tbody tr td."+defined_class+"").each(function(){

                        if ($(this).text() != ""){
                              var text_data=$(this).text();
                               $(".removable_p_"+i+"").remove();
                              $(this).append('<textarea id="business_head_edit'+i+'" class="form-control" name="bh_sign_off_[]">'+text_data+'</textarea>')
                        }
                        else{
                            $(this).append('<textarea id="business_head_edit'+i+'" class="form-control"  name="bh_sign_off_[]"></textarea>')
                        }
                         i++;
                            }
                        );

                        $("#goal-tb tbody tr td.supervisor_rating").each(function(){
                        if ($(this).text() != ""){
                              var text_data=$(this).text();
                               $(".removable_p_"+j+"").remove();
                               $(this).append('<select class="form-control js-example-basic-single key_bus_drivers" name="sup_final_output_[]">\
                                <option value="">Choose</option>\
                                <option value="EE" '+(text_data=="EE" ? "selected" : "")+'>EE</option>\
                                <option value="AE" '+(text_data=="AE" ? "selected" : "")+'>AE</option>\
                                <option value="ME" '+(text_data=="ME" ? "selected" : "")+'>ME</option>\
                                <option value="PE  '+(text_data=="PE" ? "selected" : "")+'>PE</option>\
                                <option value="ND" '+(text_data=="ND" ? "selected" : "")+'>ND</option>\
                                </select>')

                        }
                        else{
                            $(this).append('<select class="form-control js-example-basic-single key_bus_drivers" name="sup_final_output_[]">\
                                <option value="">Choose</option>\
                                <option value="EE">EE</option>\
                                <option value="AE">AE</option>\
                                <option value="ME">ME</option>\
                                <option value="PE >PE</option>\
                                <option value="ND">ND</option>\
                                </select>')
                        }
                         j++;
                            }
                        );

                 })



      })



	</script>

@endsection

