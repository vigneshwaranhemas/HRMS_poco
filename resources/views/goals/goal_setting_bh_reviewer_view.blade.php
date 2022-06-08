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
	<h2>Performance Management System</h2>
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
                {{-- <div class="ribbon-vertical-right-wrapper card">
                    <div class="card-body">
                        <div class="ribbon ribbon-bookmark ribbon-vertical-right ribbon-primary" style="height: 107px !important;"><span style="writing-mode: vertical-rl;text-orientation: upright;margin-left: -25px;">PMS</span></div>
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
                    </div> --}}
                    <div class="ribbon-vertical-right-wrapper card">
                        <div class="card-body">
                         <div class="ribbon ribbon-bookmark ribbon-vertical-right ribbon-primary" style="height: 70px !important;"><span style="writing-mode: vertical-rl;text-orientation: upright;margin-left: -25px;">PMS</span>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 class="mb-0 f-w-700"><i class="icofont icofont-id-card"> </i> Emp ID :</h6>
                                        </div>
                                        <div class="col-md-6">
                                            <p id="empID">{{ $user_info['data']->empID }}</p>
                                        </div>
                                        <div class="col-md-6 m-t-10">
                                            <h6 class="mb-0 f-w-700"><i class="icofont icofont-id-card"> </i> R.Manager ID :</h6>
                                        </div>
                                        <div class="col-md-6 m-t-10">
                                            <p id="sup_emp_code">{{ $user_info['data']->sup_emp_code }}</p>
                                        </div>
                                        <div class="col-md-6 m-t-10">
                                            <h6 class="mb-0 f-w-700"><i class="icofont icofont-id-card"> </i>  Reviewer ID :</h6>
                                        </div>
                                        <div class="col-md-6 m-t-10">
                                            <p id="reviewer_emp_code">{{ $user_info['data']->reviewer_emp_code }}</p>
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
                                            <h6 class="mb-0 f-w-700"><i class="icofont icofont-ui-user"> </i> Emp Name :</h6>
                                        </div>
                                        <div class="col-md-5">
                                            <p id="username">{{ $user_info['data']->username }}</p>
                                        </div>
                                        <div class="col-md-7 m-t-10">
                                            <h6 class="mb-0 f-w-700"><i class="icofont icofont-user-alt-7"> </i> R.Manager Name :</h6>
                                        </div>
                                        <div class="col-md-5 m-t-10">
                                            <p id="sup_name">{{ $user_info['data']->sup_name }}</p>
                                        </div>
                                        <div class="col-md-7 m-t-10">
                                            <h6 class="mb-0 f-w-700"><i class="icofont icofont-user-alt-7"> </i> Reveiwer Name :</h6>
                                        </div>
                                        <div class="col-md-5 m-t-10">
                                            <p id="reviewer_name">{{ $user_info['data']->reviewer_name }}</p>
                                        </div>
                                        <div class="col-md-7 m-t-10">
                                            <h6 class="mb-0 f-w-700"><i class="icofont icofont-user-male"> </i> HRBP :</h6>
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
                                            <p id="department">{{ $user_info['data']->department }}</p>
                                        </div>
                                        <div class="col-md-7 m-t-10">
                                            <h6 class="mb-0 f-w-700"><i class="icofont icofont-building"> </i> R.Manager Dept :</h6>
                                        </div>
                                        <div class="col-md-5 m-t-10">
                                            <p>{{ $user_info['sup_emp_code']->department }}</p>
                                        </div>
                                        <div class="col-md-7 m-t-10">
                                            <h6 class="mb-0 f-w-700"><i class="icofont icofont-building"> </i> Reviewer Dept :</h6>
                                        </div>
                                        <div class="col-md-5 m-t-10">
                                            <p>{{ $user_info['reviewer_emp_code']->department }}</p>
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

				<div class="card  card-absolute">
                    <div class="card-header bg-primary goals-header">
                        <h5 class="text-white" id="goals_sheet_head"></h5>
                    </div>
					<div class="card-body">
                        <input type="hidden" id="user_type" >
					<div class="table-responsive m-b-15 ">
                        <div class="row">
                            <div class="col-lg-12 m-b-35">
                                {{-- <button type="button" class="btn btn-warning text-white float-right m-l-10" id="goal_sheet_edit" style="display: none;">Edit</button> --}}
                                <a id="goal_sheet_edit" class="btn btn-warning text-white float-right m-l-10" title="Edit Sheet" style="display: none">Edit</a>
                                <a id="overall_submit" class="btn btn-success text-white float-right" title="Overall Sheet Submit" style="display: none">Submit</a>
                                <a id="overall_submit_1" class="btn btn-success text-white float-right" title="Overall Sheet Submit" style="display: none">Submit</a>
                                <h5>EMPLOYEE CONSOLIDATED RATING : <span id="employee_consolidate_rate_show"></span></h5>
                                <h5>REPORTING MANAGER CONSOLIDATED RATING : <span id="supervisor_consolidate_rate_show"></span></h5>
                                <h5>BUSINESS HEAD STATUS : <span id="Sheet_status"></span></h5>
                            </div>

                        </div>
                        <form id="Bh_form_insert">
							<table class="table  table-border-vertical table-border-horizontal" id="goal-tb">
								<thead>
									<tr>
										<th scope="col">No</th>
										<th scope="col">Key Business Drivers(KBD)</th>
										<th scope="col">Key Result Areas(KRA)</th>
										<th scope="col">Measurement Criteria (Quantified Measures)</th>
										<th scope="col">Self Assessment (Qualitative Remarks) by Employee</th>
										<th scope="col">Rating by Employee</th>
										<th scope="col" class="supervisor_remarks">Supervisors Assessment (Qualitative Remarks by Reporting Manager)</th>
										<th scope="col" class="supervisor_rating">Rating by Reporting Manager </th>
										<th scope="col" class="reviewer_remarks">Reviewer Remarks </th>
										<th scope="col">HR Remarks</th>
										<th scope="col" class="business_head">Business Head assessment and Approval for Release</th>
									</tr>
								</thead>
								<tbody id="goals_record">

								</tbody>
							</table>
				             <input type="hidden" id="goals_setting_id" name="goals_setting_id">
                             <input type="hidden" id="reviewer_hidden_id" name="reviewer_hidden_id">
                             <input type="hidden" id="bh_status_hidden_id" name="bh_status_hidden_id">
                            <div class="m-t-20 m-b-30 row float-right" id="save_div">
                                <div class="col-lg-4" id="consolidated_rating_id" style="display: none">
                                    <label>R.Manager Consolidated Rating</label><br>
                                    <select class="js-example-basic-single" style="width:200px;margin-top:30px !important;" id="supervisor_consolidated_rate" name="supervisor_consolidated_rate">
                                        <option value="" selected>...Select...</option>
                                        <option value="EE">EE</option>
                                        <option value="AE">AE</option>
                                        <option value="ME">ME</option>
                                        <option value="PE">PE</option>
                                        <option value="ND">ND</option>
                                    </select>
                                    <div class="text-danger supervisor_consolidated_rate_error" id=""></div>
                                </div>
                                <div class="col-lg-4" id="bh_sheet_approval" style="display: none">
                                    <label>Status</label><br>
                                    <select class="js-example-basic-single" style="width:200px;margin-top:30px !important;" id="Bh_sheet_approval" name="Bh_sheet_approval">
                                        <option value="" selected>...Select...</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Reverted">Reverted</option>
                                    </select>

                                    <div class="text-danger bh_sheet_approval_error" id=""></div>
                                </div>
                                <div class="col-lg-4">
                               {{-- <button type="button" class="btn btn-primary text-white float-right m-l-30" id="goal_sheet_add" style="display:none;" onclick="data_insert()">Submit</button> --}}
                               <a id="goal_sheet_add" class="btn btn-primary text-white float-right m-l-30" title="Save as Draft" style="display: none; margin-top: 31px;" onclick="data_insert()">Save for Draft</a>
                                </div>
                                </div>



                            </div>
                        </form>
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
				"searching": false,

                "paging": false,

                "info":     false,

                "fixedColumns":   {

                        left: 6

                    }

                // dom: 'Bfrtip',

                // buttons: [

                //  'copyHtml5',

                //  'excelHtml5',

                //  'csvHtml5',

                //  'pdfHtml5'

                // ]
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
                // alert(response.reviewer)
                $("#Bh_sheet_approval").val(response.get_sheet_status.goal_status).trigger('change');
                $('#goal-tb').DataTable().clear().destroy();
				$('#goals_record').append('');
				$('#goals_record').append(response.html);
                     $('#goal-tb').DataTable( {
                    	"searching": false,
                        "paging": false,
                        "info":     false,
                        "fixedColumns":   {
                                left: 6
                            }
                    } );
                    $("#reviewer_hidden_id").val(response.reviewer)
                    $("#bh_status_hidden_id").val(response.get_sheet_status.bh_tb_status);
                    if(response.get_sheet_status.bh_tb_status==1){
                        $("#overall_submit").hide();
                        $("#goal_sheet_edit").show();
                        $("#overall_submit_1").show();

                    }
                    else{
                        $("#overall_submit").hide();
                        $("#goal_sheet_edit").show();
                    }
                    if(response.reviewer==1){
                     $(".supervisor_remarks").hide();
                     $(".reviewer_remarks").hide();
                     $(".supervisor_rating").show();
                    //  $("#consolidated_rating_id").show();
                    //  $("#supervisor_consolidated_rate").val(response.get_sheet_status.supervisor_consolidated_rate).trigger('change')
                 }
                 else if(response.reviewer==2){
                     $(".supervisor_remarks").show();
                     $(".reviewer_remarks").hide();
                     $(".supervisor_rating").show();
                    //  $("#consolidated_rating_id").show();
                    //  $("#supervisor_consolidated_rate").val(response.get_sheet_status.supervisor_consolidated_rate).trigger('change')
                 }
                 else{
                     $(".supervisor_remarks").show();
                     $(".reviewer_remarks").show();
                     $(".supervisor_rating").show();
                     $("#consolidated_rating_id").hide();

                 }
                 $("#supervisor_consolidated_rate").val(response.get_sheet_status.supervisor_consolidated_rate).trigger('change')
                 $("#user_type").val(response.reviewer);
                 $("#employee_consolidate_rate_show").text(response.get_sheet_status.employee_consolidated_rate);
                 $("#supervisor_consolidate_rate_show").text(response.get_sheet_status.supervisor_consolidated_rate);
                 $("#Sheet_status").text(response.get_sheet_status.goal_status)

                 if(response.get_sheet_status.bh_status==1){
                     $("#goal_sheet_edit").hide();
                     $('#overall_submit').hide();
                     $("#overall_submit_1").hide();
                 }
                //  else{
                //     $("#goal_sheet_edit").show();
                //     $('#overall_submit').show();
                //  }
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
              $("#consolidated_rating_id").show();
            //   if(user_type==1 || user_type==2){
            //    $("#consolidated_rating_id").show();
            //   }
            //   else{
            //    $("#consolidated_rating_id").hide();
            //   }
              if($("#bh_status_hidden_id").val()==1){
                  $('#goal_sheet_add').text("Update")
              }
              $("#goal_sheet_add").show();
              $("#overall_submit").show();
              $("#overall_submit_1").hide();
              $("#bh_sheet_approval").show();
              if(user_type==1 || user_type==2 || user_type==0)
              {
                   var defined_class="business_head";
              }
              $("#goal-tb tbody tr td."+defined_class+"").each(function(){
                        if ($(this).text() != ""){
                              var text_data=$(this).text();
                               $(".removable_p_"+i+"").remove();
                              $(this).append('<textarea id="business_head_edit'+i+'" class="form-control" name="bh_sign_off_[]">'+text_data+'</textarea><div class="text-danger bh_sign_off_'+i+'_error color-hider" id="bh_sign_off_'+i+'_error" style="display:none"></div>')
                        }
                        else{
                            $(this).append('<textarea id="business_head_edit'+i+'" class="form-control"  name="bh_sign_off_[]"></textarea><div class="text-danger bh_sign_off_'+i+'_error color-hider" id="bh_sign_off_'+i+'_error" style="display:none"></div>')
                         }
                         i++;
                            }
                        );

                        $("#goal-tb tbody tr td.supervisor_rating").each(function(){
                            if ($(this).text() != ""){
                                var text_data=$(this).text();
                                $(".supervisor_p_"+j+"").remove();
                                $(this).append('<select class="form-control js-example-basic-single key_bus_drivers" id="sup_final_output_'+j+'" name="sup_final_output_[]">\
                                    <option value="">Choose</option>\
                                    <option value="EE" '+(text_data=="EE" ? "selected" : "")+'>EE</option>\
                                    <option value="AE" '+(text_data=="AE" ? "selected" : "")+'>AE</option>\
                                    <option value="ME" '+(text_data=="ME" ? "selected" : "")+'>ME</option>\
                                    <option value="PE" '+(text_data=="PE" ? "selected" : "")+'>PE</option>\
                                    <option value="ND" '+(text_data=="ND" ? "selected" : "")+'>ND</option>\
                                    </select><div class="text-danger sup_final_output_'+j+'_error color-hider"  style="display:none"></div>')
                            }
                            else{
                                $(this).append('<select class="form-control js-example-basic-single key_bus_drivers"  id="sup_final_output_'+j+'"  name="sup_final_output_[]">\
                                    <option value="">Choose</option>\
                                    <option value="EE">EE</option>\
                                    <option value="AE">AE</option>\
                                    <option value="ME">ME</option>\
                                    <option value="PE">PE</option>\
                                    <option value="ND">ND</option>\
                                    </select><div class="text-danger sup_final_output_'+j+'_error color-hider"  style="display:none"></div>')
                            }
                         j++;
                            }
                        );

                 })



      })

function data_insert(){
    $("#goal_sheet_add").prop('disabled',true);
    $('.color-hider').hide();
     var i=1;
     var j=1;
     var error="";
     var defined_class="business_head";
    $("#goal-tb tbody tr td."+defined_class+"").each(function(){
                if ($("#business_head_edit"+i+"").val() != ""){
                }
                else{
                    $("#bh_sign_off_"+i+"_error").html("Business Head Assesment Required!....");
                    error+="error";
                    $("#bh_sign_off_"+i+"_error").show();
                }
                i++;
        });
        $("#goal-tb tbody tr td.supervisor_rating").each(function(){
                        if ($('#sup_final_output_'+j+'').find(":selected").val() != ""){
                        }
                        else{
                             $(".sup_final_output_"+j+"_error").html("Supervisor Rating Required!....");
                             $(".sup_final_output_"+j+"_error").show();
                             error+="error";
                        }
                    j++;

                    });
         if($("#Bh_sheet_approval").val()==""){
             $(".bh_sheet_approval_error").html("Goal Sheet Approval Status Is Required");
             error+="error";
         }
        //  if($("#reviewer_hidden_id").val()==1 || $("#reviewer_hidden_id").val()==2){
              if($('#supervisor_consolidated_rate').val()==""){
                  $('.supervisor_consolidated_rate_error').html("Supervisor Consolidated Rate Required!...");
                  error+="error";
              }
        //  }

        if(error==""){
            $.ajax({
            url:"{{ url('update_bh_goals') }}",
            type:"POST",
            data:$('#Bh_form_insert').serialize(),
            dataType : "JSON",
            success:function(data)
            {
                 console.log(data)
                if(data.success==1){
                     Toastify({
                    text: data.message,
                    duration: 3000,
                    close:true,
                    backgroundColor: "#4fbe87",
                }).showToast();
                 window.location.href='goals';
                }
                else{
                    Toastify({
                    text: data.message,
                    duration: 3000,
                    close:true,
                    backgroundColor: "#4fbe87",
                    }).showToast();
                   window.location.href='goals';
                }

            }
            });
        }
 }


   $(()=>{
       $("#overall_submit").on('click',(e)=>{
           e.preventDefault();
            $.ajax({
                url:"Update_bh_status",
                type:"POST",
                // data:{id:$("#goals_setting_id").val(),user_type:$("#user_type").val()},
                data:$('#Bh_form_insert').serialize(),
                beforeSend:function(data){
                    console.log("loading!...")
                },
                success:function(response){
                    var data=JSON.parse(response);
                    // console.log(data)
                    if(data.success==1){
                     Toastify({
                    text: data.message,
                    duration: 3000,
                    close:true,
                    backgroundColor: "#4fbe87",
                }).showToast();
                 window.location.reload(true);
                }
                else{
                    Toastify({
                    text: data.message,
                    duration: 3000,
                    close:true,
                    backgroundColor: "#4fbe87",
                    }).showToast();
                   window.location.reload(true);
                }
                }
            })
       })
   })

   $('#overall_submit_1').on('click',()=>{
    $.ajax({
                url:"Update_bh_status_only",
                type:"POST",
                data:{id:$("#goals_setting_id").val(),user_type:$("#user_type").val()},
                // data:$('#Bh_form_insert').serialize(),
                beforeSend:function(data){
                    console.log("loading!...")
                },
                success:function(response){
                    var data=JSON.parse(response);
                    // console.log(data)
                    if(data.success==1){
                     Toastify({
                    text: data.message,
                    duration: 3000,
                    close:true,
                    backgroundColor: "#4fbe87",
                }).showToast();
                 window.location.reload(true);
                }
                else{
                    Toastify({
                    text: data.message,
                    duration: 3000,
                    close:true,
                    backgroundColor: "#4fbe87",
                    }).showToast();
                   window.location.reload(true);
                }
                }
            })
   })




	</script>

@endsection

