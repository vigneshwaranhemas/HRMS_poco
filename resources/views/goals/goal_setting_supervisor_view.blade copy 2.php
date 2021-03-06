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
			<div class="col-sm-12">
				<div class="ribbon-vertical-right-wrapper card">
					<div class="card-body">
						<div class="ribbon ribbon-bookmark ribbon-vertical-right ribbon-primary" style="height: 50px !important;"><span style="writing-mode: vertical-rl;text-orientation: upright;margin-left: -25px;"> PA</span>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="row">
									<div class="col-md-6">
										<h6 class="mb-0 f-w-700"><i class="icofont icofont-id-card"> </i> Emp ID :</h6>
									</div>
									<div class="col-md-6">
										<p id="empID"></p>
									</div>
									<div class="col-md-6 m-t-10">
										<h6 class="mb-0 f-w-700"><i class="icofont icofont-ebook"> </i> Supervisor ID :</h6>
									</div>
									<div class="col-md-6 m-t-10">
										<p id="sup_emp_code"></p>
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
									<div class="col-md-5">
										<h6 class="mb-0 f-w-700"><i class="icofont icofont-ui-user"> </i> Name :</h6>
									</div>
									<div class="col-md-7">
										<p id="username"></p>
									</div>
									<div class="col-md-5 m-t-10">
										<h6 class="mb-0 f-w-700"><i class="icofont icofont-user-alt-7"> </i> Supervisor :</h6>
									</div>
									<div class="col-md-7 m-t-10">
										<p id="sup_name"></p>
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
										<p id="department"></p>
									</div>
									<div class="col-md-5 m-t-10">
										<h6 class="mb-0 f-w-700"><i class="icofont icofont-ui-user"> </i> Reviewer :</h6>
									</div>
									<div class="col-md-7 m-t-10">
										<p id="reviewer_name"></p>
									</div>
									<div class="col-md-5 m-t-10">
										<h6 class="mb-0 f-w-700"><i class="icofont icofont-id-card"> </i> Reviewer ID :</h6>
									</div>
									<div class="col-md-7 m-t-10">
										<p id="reviewer_emp_code"></p>
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
									<a id="goal_sheet_edit" class="btn btn-warning text-white float-right m-l-10" title="Edit Sheet">Edit</a>                                            
									<a id="goal_sheet_submit" class="btn btn-success text-white float-right" title="Overall Sheet Submit">Submit For Approval</a>                                            
									<!-- <button type="button" class="btn btn-warning "  >Edit</button> -->
									<h5>EMPLOYEE CONSOLIDATED RATING : <span id="employee_consolidate_rate_show"></span></h5>
									<h5>SUPERVISOR CONSOLIDATED RATING : <span id="supervisor_consolidate_rate_show"></span></h5>
								</div>
							</div>
							<form id="supGoalsForm">
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
											<a onclick="supFormSubmit();" class="btn btn-primary text-white m-t-30" title="Save Table Value">Save</a>
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
			$.ajaxSetup({
				headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
		});

		$( document ).ready(function() {
			// goal_record();
			get_goal_setting_reviewer_tl();

			$("#save_div").hide();

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
			
			tb_data();

		});

		var params = new window.URLSearchParams(window.location.search);
		var id=params.get('id')
		$('#goals_setting_id').val(id);
		// $("#goal_sheet_sup_id").val(id);

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

<<<<<<< HEAD
		/********** Employee Sumbit **************/			
		$.ajax({                   
			url:"{{ url('goals_sup_submit_status') }}",
			type:"GET",
			data:{id:id},
			dataType : "JSON",
			success:function(response)
			{
				if(response == "1"){
					$("#goal_sheet_submit").css("display","block");
					$("#goal_sheet_edit").css("display","block");
				}else if(response == "2"){
					$("#goal_sheet_edit").css("display","none");
					$("#goal_sheet_submit").css("display","none");
				}else{
					$("#goal_sheet_submit").css("display","none");
					$("#goal_sheet_edit").css("display","block");
				}
			},
			error: function(error) {
				console.log(error);

			}                                              
				
		});
		
		/********** Supervisor Consolidary Rate Head **************/			
		$.ajax({                   
=======
		/********** Supervisor Consolidary Rate Head **************/
		$.ajax({
>>>>>>> 6961bb3044e3a0f85ff8f5d8a5e7aad8508b347a
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

		function tb_data(){

			$.ajax({                   
				url:"{{ url('fetch_goals_sup_details') }}",
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
		}

		$(()=>{
			$("#goal_sheet_edit").on('click',()=>{
				
				$.ajax({
					url:"{{ url('fetch_goals_sup_details') }}",
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

>>>>>>> 6961bb3044e3a0f85ff8f5d8a5e7aad8508b347a
				$("#goal_sheet_edit").css("display","none");
				$("#goal_sheet_submit").css("display","block");
				$("#save_div").show();

				var i=1;
				// var user_type=$("#user_type").val();
				// if(user_type==1 || user_type==2 || user_type==0)
				// {
					var defined_class1="sup_remark";
					var defined_class2="sup_rating";
				// }
<<<<<<< HEAD
				
				//supervisor remarks
=======

>>>>>>> 6961bb3044e3a0f85ff8f5d8a5e7aad8508b347a
				$("#goals_record_tb tbody tr td."+defined_class1+"").each(
					function(index){

						// console.log($(this).text())
						if ($(this).text() != ""){
<<<<<<< HEAD
							var text_data=$(this).text();
							$(".sup_remark_p_"+i+"").remove();
							var tx = '<textarea id="sup_remark'+i+'" name="sup_remark[]" style="width:200px;" class="form-control">'+text_data+'</textarea>';
=======
							// alert("one")
						}
						else{
							var tx = '<textarea id="business_head_edit'+i+'" name="sup_remark[]" style="width:200px;" class="form-control"></textarea>';
>>>>>>> 6961bb3044e3a0f85ff8f5d8a5e7aad8508b347a
								tx += '<div class="text-danger sup_remark_'+index+'_error" id="sup_remark_'+index+'_error"></div>';
							$(this).append(tx);
							// $(this).append('<textarea id="sup_remark'+i+'" class="form-control" name="sup_remark[]">'+text_data+'</textarea>')
						}
						else{				
							var tx = '<textarea id="sup_remark'+i+'" name="sup_remark[]" style="width:200px;" class="form-control"></textarea>';
								tx += '<div class="text-danger sup_remark_'+index+'_error" id="sup_remark_'+index+'_error"></div>';
							$(this).append(tx);
							// alert("two")
						}
						i++;
					}
				);

				//supervisor rating
				var j = 1;

				$("#goals_record_tb tbody tr td."+defined_class2+"").each(
					function(index){

						// console.log("data")
						if ($(this).text() != ""){
<<<<<<< HEAD
						
							var text_data=$(this).text();								
							$(".sup_rating_p_"+j+"").remove();
							$(this).append('<select class="form-control js-example-basic-single key_bus_drivers" name="sup_final_output_[]">\
											<option value="">Choose</option>\
											<option value="EE" '+(text_data=="EE" ? "selected" : "")+'>EE</option>\
											<option value="AE" '+(text_data=="AE" ? "selected" : "")+'>AE</option>\
											<option value="ME" '+(text_data=="ME" ? "selected" : "")+'>ME</option>\
											<option value="PE  '+(text_data=="PE" ? "selected" : "")+'>PE</option>\
											<option value="ND" '+(text_data=="ND" ? "selected" : "")+'>ND</option>\
											</select>')
=======
							// alert("one")
>>>>>>> 6961bb3044e3a0f85ff8f5d8a5e7aad8508b347a
						}
						else{				
							var op = '<select class="js-example-basic-single" name="sup_rating[]" style="width:150px;" id="employee_consolidated_rate" name="employee_consolidated_rate">';
								op += '<option value="" selected>...Select...</option>';
								op += '<option value="EE">EE</option>';
								op += '<option value="AE">AE</option>';
								op += '<option value="ME">ME</option>';
								op += '<option value="PE">PE</option>';
								op += '<option value="ND">ND</option>';
								op += '</select>';
								op += '<div class="text-danger sup_rating_'+index+'_error"></div>';
							// $(this).append('<textarea id="business_head_edit'+i+'" class="form-control"></textarea>')
							$(this).append(op);
							// alert("two")
						}
						i++;
						j++;
					}
				);

<<<<<<< HEAD
				//supervisor consolidate rate
				$.ajax({                   
					url:"{{ url('goals_sup_consolidate_rate_head') }}",
					type:"GET",
					data:{id:id},
					dataType : "JSON",
					success:function(response)
					{
						if(response != ""){
							$('#supervisor_consolidated_rate').val(response).change();							
						}

					},
					error: function(error) {
						console.log(error);

					}                                              
						
				});
		
				
=======
>>>>>>> 6961bb3044e3a0f85ff8f5d8a5e7aad8508b347a
			})
		})

		function supFormSubmit(){

			var error='';

			var rate = $("#supervisor_consolidated_rate").val();
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

				i++;


			});

			//Sending data to database
			if(error==""){
				// alert("succes")
				data_insert();
			}

			function data_insert(){

				$.ajax({

					url:"{{ url('update_goals_sup') }}",
					type:"POST",
					data:$('#supGoalsForm').serialize(),
					dataType : "JSON",
					success:function(data)
					{
						Toastify({
							text: "Added Sucessfully..!",
							duration: 3000,
							close:true,
							backgroundColor: "#4fbe87",
<<<<<<< HEAD
						}).showToast();    
						
						tb_data();
						$("#save_div").hide();
						$("#goal_sheet_edit").css("display","block");

						// $('button[type="submit"]').attr('disabled' , false);
						
						// window.location = "{{ url('goals')}}";                
=======
						}).showToast();

						// $('button[type="submit"]').attr('disabled' , false);

						window.location = "{{ url('goals')}}";
>>>>>>> 6961bb3044e3a0f85ff8f5d8a5e7aad8508b347a
					},
					error: function(response) {
						// $('#business_name_option_error').text(response.responseJSON.errors.business_name);

					}

				});
			}
		}

<<<<<<< HEAD
		//Edit pop-up model and data show
        function get_goal_setting_reviewer_tl(){

			var params = new window.URLSearchParams(window.location.search);
			var id=params.get('id')
			// alert(id)

			$.ajax({
				url: "get_goal_setting_reviewer_details_tl",
				method: "POST",
				data:{"id":id,},
				dataType: "json",
				success: function(data) {
					console.log(data)

					if(data.length !=0){
						$('#empID').html(data[0].empID);
						$('#username').html(data[0].username);
						$('#sup_emp_code').html(data[0].sup_emp_code);
						$('#sup_name').html(data[0].sup_name);
						$('#department').html(data[0].department);
						$('#reviewer_name').html(data[0].reviewer_name);
						$('#reviewer_emp_code').html(data[0].reviewer_emp_code);
					}
				}
			});
		}
		
=======
>>>>>>> 6961bb3044e3a0f85ff8f5d8a5e7aad8508b347a
	</script>

@endsection

