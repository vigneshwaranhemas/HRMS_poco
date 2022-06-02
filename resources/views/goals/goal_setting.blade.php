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

				<input type="hidden" id="goals_setting_id">

				<div class="card  card-absolute">
					
					<div class="card-header  bg-primary">
						<h5 class="text-white" id="goals_sheet_head"></h5>
					</div>
					<div class="card-body">

						<div class="table-responsive">
							<div class="row">
								<div class="col-lg-12 m-b-35">
									<h5>CONSOLIDATED RATING : <span id="employee_consolidate_rate_show"></span></h5>
								</div>
							</div>
							<table class="table table-border-vertical table-border-horizontal" id="goals_record_tb">
								<thead>
									<tr>
										<th scope="col">No</th>
										<th scope="col">Key Business Drivers</th>
										<th scope="col">Key Result Areas </th>
										<th scope="col">Measurement Criteria (Quantified Measures)</th>
										<th scope="col">Self Assessment (Qualitative Remarks) by Employee</th>
										<th scope="col">Rating by Employee</th>
									</tr>
								</thead>
								<tbody id="goals_record">									
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
			get_tb_record();
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
		});

		var params = new window.URLSearchParams(window.location.search);
		var id=params.get('id')
		$('#goals_setting_id').val(id);
		// function goals_record(){
			
			var id = $('#goals_setting_id').val();

			/**********Sheet Head**************/			
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

			function get_tb_record(){
				$.ajax({                   
					url:"{{ url('fetch_goals_setting_id_details') }}",
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
			
		// }

		/**********Data Table**************/

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

