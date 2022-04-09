{{-- vigneshwaran --}}
@extends('layouts.simple.candidate_master')
@section('title', 'Premium Admin Template')

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
  {{-- <li class="breadcrumb-item">Dashboard</li>
	<li class="breadcrumb-item active">Default</li>--}}
@endsection

@section('content')
	<!-- Container-fluid starts-->
    <div class="container-fluid">
		<div class="row">

			<div class="col-sm-12">

				<div class="card  card-absolute">
					
					<div class="card-header  bg-primary">
						<h5 class="text-white">Goals - 22 1</h5>
					</div>
					<div class="card-body">
						
						<div class="table-responsive">
							<table class="table  table-border-vertical table-border-horizontal" id="goal-tb">
								<thead>
									<tr>
										<th scope="col">No</th>
										<th scope="col">Key Business Drivers</th>
										<th scope="col">Key Result Areas </th>
										<th scope="col">Sub Indicators</th>
										<th scope="col">Measurement Criteria (UOM)</th>
										<th scope="col">Weightage</th>
										<th scope="col">Reference </th>
										
									</tr>
								</thead>
								<tbody>
									<tr  class="border-bottom-primary">
										<th scope="row">1</th>
										<td>
											<p>Revenue</p>
										</td>
										<td>
											<p>HR Shared Services : </p>
											<p>DTP: </p>
											<p>NAPS: </p>
											<p>BTP: </p>
											<p>Recruiting Services : </p>
											<p>HR Automation Services: </p>
											<p>Other Revenue Streams: </p>
										</td>
										<td>
											
										</td>
										<td>
											<p>Meet Business Expectations as per AOP sign off</p>
											<p>Meet Business Expectations as per AOP sign off</p>
											<p>Meet Business Expectations as per AOP sign off</p>
											<p>Meet Business Expectations as per AOP sign off</p>
											<p>Meet Business Expectations as per AOP sign off</p>
											<p>Meet Business Expectations as per AOP sign off</p>
											<p>Meet Business Expectations as per AOP sign off</p>
										</td>
										<td>
											30%

										</td>
										<td>
											<p>AOP HRSS</p>
											<p>AOP DTP</p>
											<p>AOP NAPS</p>
											<p>AOP BTP</p>
											<p>AOP Recruitment</p>
											<p>AOP Automation Services </p>
											<p>AOP </p>
										</td>
										
									</tr>
									<tr class="border-bottom-primary">
										<th scope="row">1</th>
										<td>
											<p>Customer</p>
										</td>
										<td>
											<p>HEPL Core : Internal Customers</p>
											<p>HR Shared Services & Other HR Verticals</p>
										</td>
										<td>
											<p>1. Employee Engagement Scores</p>
											<p>2. Attrition Management</p>
											<p>1. External Customer Sat Audit Ratings </p>
										</td>
										<td>
											<p>1. Engagement Score > 85%</p>
											<p>2. Overall Voluntary Attrition less than 10% </p>
											<p>1. External Customer Sat Audit Ratings  > 95%</p>
										</td>
										<td>
											20%

										</td>
										<td>
											<p>Employee Engagement Survey Results</p>
											<p>Attrition MIS, Exit Interview MIS</p>
											<p>C Sat Audit Reports</p>
										</td>
										
									</tr>
									

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

		
	</script>

@endsection

