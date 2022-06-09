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
@endsection

@section('breadcrumb-title')
	<h2>View<span>Goals </span></h2>
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
									<h5>CONSOLIDATED RATING : <span id="employee_consolidate_rate_show"></span></h5>
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
			// goal_record();
			$('#goals_record_tb').DataTable( {
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

		/**********Consolidary rate Head**************/			
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
					dom: 'Bfrtip',
					buttons: [
						'copyHtml5',
						'excelHtml5',
						'csvHtml5',
						'pdfHtml5'
					]
				} );
				
			},
			error: function(error) {
				console.log(error);

			}                                              
				
		});		

		$(()=>{
			$("#goal_sheet_edit").on('click',()=>{
				
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
				
				$("#goals_record_tb tbody tr td."+defined_class1+"").each(
					function(index){

						// console.log("data")
						if ($(this).text() != ""){
							alert("one")
						}
						else{
							var tx = '<textarea id="business_head_edit'+i+'" name="sup_remark[]" style="width:200px;" class="form-control"></textarea>';
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
							alert("one")
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
					}
				);
				
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
				// console.log(col0)
				// console.log(col6)
				// console.log(col7)
				// console.log(index)

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
						}).showToast();    
						
						$('button[type="submit"]').attr('disabled' , false);
						
						window.location = "{{ url('goals')}}";                
					},
					error: function(response) {
						// $('#business_name_option_error').text(response.responseJSON.errors.business_name);
		
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

		
	</script>

@endsection

