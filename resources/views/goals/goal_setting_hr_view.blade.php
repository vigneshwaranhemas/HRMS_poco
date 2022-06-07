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
        display: block;
    }
	#goal_sheet_submit{
        position: relative;
        display: none;
    }
</style>
@endsection

@section('breadcrumb-title')
	<h2>View<span>Goals </span></h2>
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
						<div class="ribbon ribbon-bookmark ribbon-vertical-right ribbon-primary" style="height: 50px !important;"><span style="writing-mode: vertical-rl;text-orientation: upright;margin-left: -25px;"> PA</span>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="row">
									<div class="col-md-5">
										<h6 class="mb-0 f-w-700"><i class="icofont icofont-id-card"> </i> Emp ID :</h6>
									</div>
									<div class="col-md-7">
										<p>{{ Auth::user()->empID }}</p>
									</div>
									<div class="col-md-5 m-t-10">
										<h6 class="mb-0 f-w-700"><i class="icofont icofont-ebook"> </i> Supervisor ID :</h6>
									</div>
									<div class="col-md-7 m-t-10">
										<p>{{ Auth::user()->sup_emp_code }}</p>
									</div>
									<div class="col-md-5 m-t-10">
										<h6 class="mb-0 f-w-700"><i class="icofont icofont-id-card"> </i>  HRBP ID :</h6>
									</div>
									<div class="col-md-47 m-t-10">
										<p>900380</p>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="row">
									<div class="col-md-5">
										<h6 class="mb-0 f-w-700"><i class="icofont icofont-ui-user"> </i> Name :</h6>
									</div>
									<div class="col-md-7">
										<p>{{ Auth::user()->username }}</p>
									</div>
									<div class="col-md-5 m-t-10">
										<h6 class="mb-0 f-w-700"><i class="icofont icofont-user-alt-7"> </i> Supervisor :</h6>
									</div>
									<div class="col-md-7 m-t-10">
										<p>{{ Auth::user()->sup_name }}</p>
									</div>
									<div class="col-md-5 m-t-10">
										<h6 class="mb-0 f-w-700"><i class="icofont icofont-user-male"> </i> HRBP :</h6>
									</div>
									<div class="col-md-7 m-t-10">
										<p>Rajesh M S</p>
									</div>
								</div>
							</div>                        
							<div class="col-md-4">
								<div class="row">
									<div class="col-md-5">
										<h6 class="mb-0 f-w-700"><i class="icofont icofont-building"> </i> Department :</h6>
									</div>
									<div class="col-md-7">
										<p>{{ Auth::user()->department }}</p>
									</div>
									<div class="col-md-5 m-t-10">
										<h6 class="mb-0 f-w-700"><i class="icofont icofont-ui-user"> </i> Reviewer :</h6>
									</div>
									<div class="col-md-7 m-t-10">
										<p>{{ Auth::user()->reviewer_name }}</p>
									</div>
									<div class="col-md-5 m-t-10">
										<h6 class="mb-0 f-w-700"><i class="icofont icofont-id-card"> </i> Reviewer ID :</h6>
									</div>
									<div class="col-md-7 m-t-10">
										<p>{{ Auth::user()->reviewer_emp_code }}</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>				
				<div class="card  card-absolute">					
					<div class="card-header  bg-primary">
						<h5 class="text-white" id="goals_sheet_head"></h5>
					</div>
					<div class="card-body">
						<div class="table-responsive m-b-15 ">
							<div class="row">
								<div class="col-lg-12 m-b-35">
									<a id="goal_sheet_edit" class="btn btn-warning text-white float-right" title="Edit Sheet">Edit</a>  
									<!-- Submit buttons -->                                          
									<a id="goal_sheet_submit" onclick="supFormSubmit()" class="btn btn-success text-white float-right" style="display: none;"  title="Overall Sheet Submit">Submit</a>                                            
									<a id="goal_sheet_rev_submit" onclick="revFormSubmit()" style="display: none;" class="btn btn-success text-white float-right" title="Overall Sheet Submit">Submit</a>                                            
									<a id="hr_sheet_submit"  onclick="hrFormSubmit()" style="display: none;"  class="btn btn-success text-white float-right" title="Overall Sheet Submit">Submit</a>                                            
									<h5>EMPLOYEE CONSOLIDATED RATING : <span id="employee_consolidate_rate_show"></span></h5>
									<h5>SUPERVISOR CONSOLIDATED RATING : <span id="supervisor_consolidate_rate_show"></span></h5>
								</div>
							</div>
						<form id="goalsForm">
							<table class="table table-border-vertical table-border-horizontal" id="goals_record_tb">
								<thead>
									<tr>
										<th scope="col">No</th>
										<th scope="col">Key Business Drivers</th>
										<th scope="col">Key Result Areas </th>
										<th scope="col">Measurement Criteria (UOM)</th>
										<th scope="col">Self Assessment</th>
										<th scope="col">Rating </th>
										<th scope="col">Supervisor Reamrks </th>
										<th scope="col">Supervisor Rating </th>
										<th scope="col">Reviewer Remarks </th>
										<th scope="col">HR Remarks </th>
										<th scope="col">BH Remarks </th>
										<!-- <th scope="col">Business Head</th> -->
									</tr>
								</thead>
								<tbody id="goals_record">									
								</tbody>
							</table>
							<input type="hidden" name="goals_setting_id" id="goals_setting_id">
							<!-- <div class="m-t-20 m-b-30 float-right"> -->
								<div class="m-t-20 m-b-30 row float-right" id="save_div">									
									<div class="col-lg-8">
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
										<a onclick="supFormSave();" class="btn btn-primary text-white m-t-30" title="Save Table Value">Save</a>                                            
									</div>
								</div>
								
								<div class="m-t-20 m-b-30 row float-right" style="display: none;" id="save_div_rev">
									<div class="col-lg-8">										
									</div>
									<div class="col-lg-4">
										<a onclick="revFormSave();" class="btn btn-primary text-white m-t-30" title="Save Table Value">Save</a>                                            
									</div>
								</div>
								<div class="m-t-20 m-b-30 row float-right" style="display: none;" id="save_div_hr">									
									<div class="col-lg-8">									
									</div>
									<div class="col-lg-4">
										<a onclick="hrFormSave();" class="btn btn-primary text-white m-t-30" title="Save Table Value">Save</a>                                            
									</div>
								</div>
								
							<!-- </div> -->
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
			$("#save_div").hide();
			$("#save_div_hr").hide();
			$("#save_div_rev").hide();

			$('#goals_record_tb').DataTable( {
				"searching": false,
				"paging": false,
				"info": false,
				"fixedColumns":   {
						left: 6
					}
				// dom: 'Bfrtip',
				// buttons: [
				// 	'copyHtml5',
				// 	'excelHtml5',
				// 	'csvHtml5',
				// 	'pdfHtml5'
				// ]
			} );
		});

		var params = new window.URLSearchParams(window.location.search);
		var id=params.get('id');
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

		/********** Employee Consolidary Rate Head **************/			
		$.ajax({                   
			url:"{{ url('goals_consolidate_rate_head') }}",
			type:"GET",
			data:{id:id},
			dataType : "JSON",
			success:function(response)
			{
				$('#employee_consolidate_rate_show').append('');
				$('#employee_consolidate_rate_show').append(response);
			},
			error: function(error) {
				console.log(error);

			}                                              
				
		});
		
		/********** Supervisor Consolidary Rate Head **************/					
		$.ajax({                   
			url:"{{ url('goals_sup_consolidate_rate_head') }}",
			type:"GET",
			data:{id:id},
			dataType : "JSON",
			success:function(response)
			{
				$('#supervisor_consolidate_rate_show').append('');
				$('#supervisor_consolidate_rate_show').append(response);
			},
			error: function(error) {
				console.log(error);

			}                                              
				
		});

		$.ajax({                   
			url:"{{ url('fetch_goals_hr_details') }}",
			type:"GET",
			data:{id:id},
			dataType : "JSON",
			success:function(response)
			{
				$('#goals_record_tb').DataTable().clear().destroy();
				$('#goals_record').empty();
				$('#goals_record').append(response);
				$('#goals_record_tb').DataTable( {
					"searching": false,
					"paging": false,
					"info":     false,
					"fixedColumns":   {
							left: 6
						}
					// dom: 'Bfrtip',
					// buttons: [
					// 	'copyHtml5',
					// 	'excelHtml5',
					// 	'csvHtml5',
					// 	'pdfHtml5'
					// ]
				} );
				
			},
			error: function(error) {
				console.log(error);

			}                                              
				
		});		

		$(()=>{
			$("#goal_sheet_edit").on('click',()=>{

				var params = new window.URLSearchParams(window.location.search);
				var id=params.get('id');

				$.ajax({                   
					url:"{{ url('check_goal_sheet_role_type_hr') }}",
					type:"POST",
					data:{id:id},
					dataType : "JSON",
					success:function(response)
					{
						if(response == 1){
							//As supervisor
										
							$("#goal_sheet_edit").css("display","none");
							$("#goal_sheet_submit").css("display","block");
							$("#save_div").show();
							$("#save_div_rev").hide();
							$("#save_div_hr").hide();

							var i=1;
							var j=1;
							var k=1;

							// var user_type=$("#user_type").val();
							// if(user_type==1 || user_type==2 || user_type==0)
							// {
								var defined_class1="sup_remark";
								var defined_class2="sup_rating";
								var defined_class3="hr_remarks";
							// }
							
							$("#goals_record_tb tbody tr td."+defined_class1+"").each(

							       	function(index){
									var text_data=$(this).text();
									if ($(this).text() != ""){
										$(".super_p"+i+"").remove();
										var tx = '<textarea id="business_head_edit'+i+'" name="sup_remark_[]" style="width:200px;" class="form-control">'+text_data+'</textarea>';
											tx += '<div class="text-danger sup_remark_'+index+'_error" id="sup_remark_'+index+'_error"></div>';
										$(this).append(tx)
									}
									else{
										var tx = '<textarea id="business_head_edit'+i+'" name="sup_remark_[]" style="width:200px;" class="form-control"></textarea>';
											tx += '<div class="text-danger sup_remark_'+index+'_error" id="sup_remark_'+index+'_error"></div>';
										$(this).append(tx)
										// alert("two")
									}
									i++;
								}
							);
							$("#goals_record_tb tbody tr td."+defined_class2+"").each(
								function(index){

									// console.log("data")
									if ($(this).text() != ""){
										var text_data=$(this).text();
										$('.sup_rating'+j+'').remove();
										var op = '<select class="js-example-basic-single" style="width:150px;" id="employee_consolidated_rate" name="sup_final_output_[]">';
											op += '<option value="" selected>...Select...</option>';
											op += '<option value="EE" '+(text_data=="EE" ? "selected" :"")+'>EE</option>';
											op += '<option value="AE" '+(text_data=="AE" ? "selected" :"")+'>AE</option>';
											op += '<option value="ME" '+(text_data=="ME" ? "selected" :"")+'>ME</option>';
											op += '<option value="PE" '+(text_data=="PE" ? "selected" :"")+'>PE</option>';
											op += '<option value="ND" '+(text_data=="ND" ? "selected" :"")+'>ND</option>';
											op += '</select>';
											op += '<div class="text-danger sup_rating_'+j+'_error"></div>';
										// $(this).append('<textarea id="business_head_edit'+i+'" class="form-control"></textarea>')
										$(this).append(op);
									}
									else{
										var op = '<select class="js-example-basic-single" style="width:150px;" id="employee_consolidated_rate" name="sup_final_output_[]">';
											op += '<option value="" selected>...Select...</option>';
											op += '<option value="EE">EE</option>';
											op += '<option value="AE">AE</option>';
											op += '<option value="ME">ME</option>';
											op += '<option value="PE">PE</option>';
											op += '<option value="ND">ND</option>';
											op += '</select>';
											op += '<div class="text-danger sup_rating_'+j+'_error"></div>';
										// $(this).append('<textarea id="business_head_edit'+i+'" class="form-control"></textarea>')
										$(this).append(op);
										// alert("two")
									}
									j++;
								}
							);

							$("#goals_record_tb tbody tr td."+defined_class3+"").each(
								function(index){

									// console.log("data")
									if ($(this).text() != ""){
										var text_data=$(this).text();
										$('.hr_remark_p'+k+'').remove();
											var tx = '<textarea id="business_head_edit'+k+'" style="width:200px;" class="form-control" name="hr_remarks_[]">'+text_data+'</textarea>';
											tx += '<div class="text-danger hr_remark_'+k+'_error" id="hr_remark_'+k+'_error"></div>';
										$(this).append(tx)
										
									}
									else{
										var tx = '<textarea id="business_head_edit'+k+'" style="width:200px;" class="form-control" name="hr_remarks_[]"></textarea>';
											tx += '<div class="text-danger hr_remark_'+k+'_error" id="hr_remark_'+k+'_error"></div>';
										$(this).append(tx)
										// alert("two")
									}
									k++;
								}
							);
							
						}
						if(response == 2){

							//As reviewer
										
							$("#goal_sheet_edit").css("display","none");
							$("#goal_sheet_submit").css("display","none");
							$("#goal_sheet_rev_submit").css("display","block");
							$("#hr_sheet_submit").css("display","none");
							$("#save_div_rev").show();
							$("#save_div").hide();
							$("#save_div_hr").hide();

							var i=1;
							var j=1;
							// var user_type=$("#user_type").val();
							// if(user_type==1 || user_type==2 || user_type==0)
							// {
								var defined_class1="reviewer_remarks";
								var defined_class2="hr_remarks";
							// }
							
							$("#goals_record_tb tbody tr td."+defined_class1+"").each(
								function(index){

									// console.log("data")
									if ($(this).text() != ""){
										var text_data=$(this).text();
										$('.reviewer_p'+i+'').remove();
										var tx = '<textarea id="business_head_edit'+i+'" style="width:200px;" name="reviewer_remarks_[]" class="form-control">'+text_data+'</textarea>';
											tx += '<div class="text-danger reviewer_remarks_'+index+'_error" id="reviewer_remarks_'+index+'_error"></div>';
										$(this).append(tx)
									}
									else{
										var tx = '<textarea id="business_head_edit'+i+'" style="width:200px;" name="reviewer_remarks_[]" class="form-control"></textarea>';
											tx += '<div class="text-danger reviewer_remarks_'+index+'_error" id="reviewer_remarks_'+index+'_error"></div>';
										$(this).append(tx)
										// alert("two")
									}
									i++;
								}
							);

							$("#goals_record_tb tbody tr td."+defined_class2+"").each(
								function(index){

									// console.log("data")
									if ($(this).text() != ""){
										var text_data=$(this).text();
										$('.hr_remark_p'+j+'').remove();
										var tx = '<textarea id="business_head_edit'+i+'" name="hr_remarks_[]" style="width:200px;" class="form-control">'+text_data+'</textarea>';
											tx += '<div class="text-danger hr_remarks_'+index+'_error" id="hr_remarks_'+index+'_error"></div>';
										$(this).append(tx)
									}
									else{
										var tx = '<textarea id="business_head_edit'+i+'" name="hr_remarks_[]" style="width:200px;" class="form-control"></textarea>';
											tx += '<div class="text-danger hr_remarks_'+index+'_error" id="hr_remarks_'+index+'_error"></div>';
										$(this).append(tx)
										// alert("two")
									}
									i++;
								}
							);
							
						}
						if(response == 0){
							//As hr
							
							$("#goal_sheet_edit").css("display","none");
							$("#goal_sheet_submit").css("display","none");
							$("#goal_sheet_rev_submit").css("display","none");
							$("#hr_sheet_submit").css("display","block");
							$("#save_div").hide();
							$("#save_div_rev").hide();
							$("#save_div_hr").show();
							
							var i=1;
							
								var defined_class1="sup_remark";
								var defined_class2="sup_rating";
								var defined_class3="hr_remarks";
							
							$("#goals_record_tb tbody tr td."+defined_class3+"").each(
								function(index){

									// console.log("data")
									if ($(this).text() != ""){
										var text_data=$(this).text();
										$('.hr_remark_p'+i+'').remove();
										var tx = '<textarea id="business_head_edit'+i+'" name="hr_remarks_[]" style="width:200px;" class="form-control">'+text_data+'</textarea>';
											tx += '<div class="text-danger hr_remarks_'+index+'_error" id="hr_remarks_'+index+'_error"></div>';
										$(this).append(tx)
									}
									else{
										var tx = '<textarea id="business_head_edit'+i+'" name="hr_remarks_[]" style="width:200px;" class="form-control"></textarea>';
											tx += '<div class="text-danger hr_remarks_'+index+'_error" id="hr_remarks_'+index+'_error"></div>';
										$(this).append(tx)
										// alert("two")
									}
									i++;
								}
							);
						}
												
					},
					error: function(error) {
						console.log(error);

					}                                              
						
				});

				
			})
		})
/*save supervisor button*/
	function supFormSave(){
			var error='';

			var rate = $("#supervisor_consolidated_rate").val();
			// alert(rate)
			var $errmsg3 = $(".supervisor_consolidated_rate_error");
			$errmsg3.hide();

			if(rate == ""){
				$errmsg3.html('Consolidated rate is required').show();                
				error+="error";
			}

			var i=1;

			$('#goals_record_tb > tbody  > tr').each(function(index) {
				var col0=$(this).find("td:eq(0)").text();
				var col6=$(this).find("td:eq(5) textarea").val();
				var col7=$(this).find("td:eq(6) option:selected").val();
				var col8=$(this).find("td:eq(8) textarea").val();

				// Supervisor Remarks
				var err_div_name = "#sup_remark_"+index+"_error";            
				var $errmsg0 = $(err_div_name);
				$errmsg0.hide();
				
				if(col6 == "" || col6 == undefined){
					// console.log($errmsg0)
					$errmsg0.html('Supervisor remarks is required').show();                
					error+="error";
				}
				

				// Supervisor Rate				
				var err_div_name1 = ".sup_rating_"+index+"_error";            
				var $errmsg1 = $(err_div_name1);
				$errmsg1.hide();
				
				if(col7 == "" || col7 == undefined){
					// console.log($errmsg0)
					$errmsg1.html('Supervisor rating is required').show();                
					error+="error";
				}

				var err_div_name = "#hr_remark_"+index+"_error";            
				var $errmsg0 = $(err_div_name);
				$errmsg0.hide();
				
				if(col8 == "" || col8 == undefined){
					// console.log($errmsg0)
					$errmsg0.html('HR remarks is required').show();                
					error+="error";
				}
				
				i++;
				

			});

			//Sending data to database
			if(error==""){
				// alert("succes")
				data_insert();
			}
			
			function data_insert(){
                // console.log($('#goalsForm').serialize());
				$.ajax({
					
					url:"{{ url('add_goals_data_hr_save') }}",
					type:"POST",
					data:$('#goalsForm').serialize(),
					dataType : "JSON",
					success:function(data)
					{
						// console.log(data)
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
						$('#business_name_option_error').text(response.responseJSON.errors.business_name);
					}                                              
				});
			}      
		}
/*submit supervisor button*/
	function supFormSubmit(){
			var error='';

			var rate = $("#supervisor_consolidated_rate").val();
			// alert(rate)
			var $errmsg3 = $(".supervisor_consolidated_rate_error");
			$errmsg3.hide();

			if(rate == ""){
				$errmsg3.html('Consolidated rate is required').show();                
				error+="error";
			}

			var i=1;

			$('#goals_record_tb > tbody  > tr').each(function(index) {
				var col0=$(this).find("td:eq(0)").text();
				var col6=$(this).find("td:eq(5) textarea").val();
				var col7=$(this).find("td:eq(6) option:selected").val();
				var col8=$(this).find("td:eq(8) textarea").val();

				// Supervisor Remarks
				var err_div_name = "#sup_remark_"+index+"_error";            
				var $errmsg0 = $(err_div_name);
				$errmsg0.hide();
				
				if(col6 == "" || col6 == undefined){
					// console.log($errmsg0)
					$errmsg0.html('Supervisor remarks is required').show();                
					error+="error";
				}
				

				// Supervisor Rate				
				var err_div_name1 = ".sup_rating_"+index+"_error";            
				var $errmsg1 = $(err_div_name1);
				$errmsg1.hide();
				
				if(col7 == "" || col7 == undefined){
					// console.log($errmsg0)
					$errmsg1.html('Supervisor rating is required').show();                
					error+="error";
				}

				var err_div_name = "#hr_remark_"+index+"_error";            
				var $errmsg0 = $(err_div_name);
				$errmsg0.hide();
				
				if(col8 == "" || col8 == undefined){
					$errmsg0.html('HR remarks is required').show();                
					error+="error";
				}
				
				i++;
				

			});

			//Sending data to database
			if(error==""){
				data_insert();
			}
			
			function data_insert(){

				$.ajax({
					
					url:"{{ url('add_goals_data_hr_sup') }}",
					type:"POST",
					data:$('#goalsForm').serialize(),
					dataType : "JSON",
					success:function(data)
					{
						// console.log(data)
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
						$('#business_name_option_error').text(response.responseJSON.errors.business_name);
					}                                              
				});
			}      
		}

/* reviewer submit button */
	function revFormSubmit(){
        var error='';
                var i=1;

                $('#goals_record_tb > tbody  > tr').each(function(index) {
                    var col0=$(this).find("td:eq(0)").text();
                    // var col6=$(this).find("td:eq(5) textarea").val();
                    var col8=$(this).find("td:eq(7) textarea").val();
                    var col9=$(this).find("td:eq(8) textarea").val();

                    // Supervisor Rate
                    var err_div_name1 = ".reviewer_remarks_"+index+"_error";
                    var $errmsg1 = $(err_div_name1);
                    $errmsg1.hide();
                    // alert(err_div_name1)

                    if(col8 == "" || col8 == undefined){
                        // console.log($errmsg0)
                        $errmsg1.html('Reviewer Remarks is required').show();
                        error+="error";
                    }

                    var err_div_name = ".hr_remarks_"+index+"_error";
                    var $errmsg0 = $(err_div_name);
                    $errmsg0.hide();
                    // alert(err_div_name)
                     if(col9 == "" || col9 == undefined){
                        // console.log($errmsg0)
                        $errmsg0.html('HR Remarks is required').show();
                        error+="error";
                    }

                    i++;


                });
                //Sending data to database
                if(error==""){
                    // alert("succes")
                    data_insert_reviewer();
                }
            function data_insert_reviewer(){

                $.ajax({

                    url:"{{ url('update_goals_sup_reviewer_tm') }}",
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

                        // $('button[type="submit"]').attr('disabled' , false);

                        window.location = "{{ url('goals')}}";
                    },
                    error: function(response) {
                        // $('#business_name_option_error').text(response.responseJSON.errors.business_name);

                    }

                });
            }
        }
/* reviewer save button*/
	function revFormSave(){
        var error='';
                var i=1;

                $('#goals_record_tb > tbody  > tr').each(function(index) {
                    var col0=$(this).find("td:eq(0)").text();
                    // var col6=$(this).find("td:eq(5) textarea").val();
                    var col8=$(this).find("td:eq(7) textarea").val();
                    var col9=$(this).find("td:eq(8) textarea").val();

                    // Supervisor Rate
                    var err_div_name1 = ".reviewer_remarks_"+index+"_error";
                    var $errmsg1 = $(err_div_name1);
                    $errmsg1.hide();
                    // alert(err_div_name1)

                    if(col8 == "" || col8 == undefined){
                        // console.log($errmsg0)
                        $errmsg1.html('Reviewer Remarks is required').show();
                        error+="error";
                    }

                    var err_div_name = ".hr_remarks_"+index+"_error";
                    var $errmsg0 = $(err_div_name);
                    $errmsg0.hide();
                    // alert(err_div_name)
                     if(col9 == "" || col9 == undefined){
                        // console.log($errmsg0)
                        $errmsg0.html('HR Remarks is required').show();
                        error+="error";
                    }

                    i++;


                });
                //Sending data to database
                if(error==""){
                    // alert("succes")
                    data_insert_reviewer();
                }
            function data_insert_reviewer(){

                $.ajax({

                    url:"{{ url('update_goals_sup_reviewer_tm_save') }}",
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

                        // $('button[type="submit"]').attr('disabled' , false);

                        window.location = "{{ url('goals')}}";
                    },
                    error: function(response) {
                        // $('#business_name_option_error').text(response.responseJSON.errors.business_name);

                    }

                });
            }
        }

/* hr submit form*/
	function hrFormSubmit() {
		  var error = "";
		  var i = 1;

		  $("#goals_record_tb > tbody  > tr").each(function (index) {
		    var col0 = $(this).find("td:eq(0)").text();
		    var col10 = $(this).find("td:eq(8) textarea").val();

		    // Supervisor Rate
		    var err_div_name1 = ".hr_remarks_" + index + "_error";
		    var $errmsg1 = $(err_div_name1);
		    $errmsg1.hide();

		    if (col10 == "" || col10 == undefined) {
		      $errmsg1.html("HR Remarks is required").show();
		      error += "error";
		    }
		    i++;
		  });
		  if (error == "") {
		    data_insert_reviewer();
		  }
		  function data_insert_reviewer() {
		    $.ajax({
		      url: "{{ url('update_goals_hr_reviewer_tm') }}",
		      type: "POST",
		      data: $("#goalsForm").serialize(),
		      dataType: "JSON",
		      success: function (data) {
		        Toastify({
		          text: "Added Sucessfully..!",
		          duration: 3000,
		          close: true,
		          backgroundColor: "#4fbe87",
		        }).showToast();

		        // $('button[type="submit"]').attr('disabled' , false);

		        window.location = "{{ url('goals')}}";
		      },
		      error: function (response) {
		        // $('#business_name_option_error').text(response.responseJSON.errors.business_name);
		      },
		    });
		  }
		}
/*save hr button*/
	function hrFormSave() {
		  var error = "";
		  var i = 1;

		  $("#goals_record_tb > tbody  > tr").each(function (index) {
		    var col0 = $(this).find("td:eq(0)").text();
		    var col10 = $(this).find("td:eq(8) textarea").val();

		    // Supervisor Rate
		    var err_div_name1 = ".hr_remarks_" + index + "_error";
		    var $errmsg1 = $(err_div_name1);
		    $errmsg1.hide();

		    if (col10 == "" || col10 == undefined) {
		      $errmsg1.html("HR Remarks is required").show();
		      error += "error";
		    }
		    i++;
		  });
		  if (error == "") {
		    data_insert_reviewer();
		  }
		  function data_insert_reviewer() {
		    $.ajax({
		      url: "{{ url('save_hr_reviewer') }}",
		      type: "POST",
		      data: $("#goalsForm").serialize(),
		      dataType: "JSON",
		      success: function (data) {
		        Toastify({
		          text: "Added Sucessfully..!",
		          duration: 3000,
		          close: true,
		          backgroundColor: "#4fbe87",
		        }).showToast();

		        // $('button[type="submit"]').attr('disabled' , false);

		        window.location = "{{ url('goals')}}";
		      },
		      error: function (response) {
		        // $('#business_name_option_error').text(response.responseJSON.errors.business_name);
		      },
		    });
		  }
		}


		
	</script>


@endsection

