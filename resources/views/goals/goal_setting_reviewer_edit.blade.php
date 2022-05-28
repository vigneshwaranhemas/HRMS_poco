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
	#remark_div{
		display: none;
	}
</style>
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

				<input type="hidden" id="goals_setting_id">

				<div class="card  card-absolute">
					
					<div class="card-header  bg-primary">
						<h5 class="text-white" id="goals_sheet_head"></h5>
					</div>
					<div class="card-body">

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
										<th scope="col">Supervisors Assessment (Qualitative Remarks by Reporting Manager)</th>
										<th scope="col">Rating by Supervisor </th>
										<th scope="col" id="reviewer_th_show" style="display:none;">Reviewer Remarks </th>
										<!-- <th scope="col">Reviewer Remarks </th>
										<th scope="col">HR Remarks</th>
										<th scope="col">business Head assessment and Approval for Release</th> -->
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
		var params = new window.URLSearchParams(window.location.search);
		var id=params.get('id')
		$('#goals_setting_id').val(id);
			
		var id = $('#goals_setting_id').val();
		// alert(id)
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
			url:"{{ url('goals_sup_th_check') }}",
			type:"GET",
			data:{id:id},
			dataType : "JSON",
			success:function(response)
			{
				if(response == "Yes"){
					$('#reviewer_th_show').css('display', 'none');

				}else{
					$('#reviewer_th_show').css('display', 'block');
				}
			},
			error: function(error) {
				console.log(error);
			}                                              
				
		});


		$.ajax({                   
			url:"{{ url('fetch_goals_reviewer_edit') }}",
			type:"GET",
			data:{id:id},
			dataType : "JSON",
			success:function(response)
			{
				$('#goals_record').append('');
				$('#goals_record').append(response);
			},
			error: function(error) {
				console.log(error);

			}                                              
				
		});
		
		$('#goals_status').change(function() {
			var goals_status = $('#goals_status').val();
			if(goals_status == "Revert"){
				$('#remark_div').css('display', 'block');
			}
			
		});

		function goals_status(){
			var goals_status = $('#goals_status').val();
			var params = new window.URLSearchParams(window.location.search);
			var id=params.get('id')

			$.ajax({                   
				url:"{{ url('goals_status') }}",
				type:"POST",
				data:{
					goals_status:goals_status,
					id:id
				},
				dataType : "JSON",
				success:function(response)
				{
					window.location = "{{ url('goals')}}";                				
				},
				error: function(error) {
					console.log(error);

				}                                              
					
			});
		}
	</script>

@endsection

