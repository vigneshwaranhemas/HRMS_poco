@extends('layouts.simple.admin_master')
@section('title', 'Business')

@section('css')
<!-- <link rel="stylesheet" type="text/css" href="../assets/css/prism.css"> -->
    <!-- Plugins css start-->
<!-- <link rel="stylesheet" type="text/css" href="../assets/css/chartist.css">
<link rel="stylesheet" type="text/css" href="../assets/css/date-picker.css"> -->

@endsection

@section('style')
<style>
  /* .dropdown-basic .dropdown .dropbtn {
      padding: 6px 14px;
  }
  .dataTables_wrapper button
  {
      border-radius: 1px;
  } */ 
</style>
@endsection

@section('breadcrumb-title')
	<h2>Employee List<span> </span></h2>
@endsection

@section('breadcrumb-items')
   {{-- <li class="breadcrumb-item">Dashboard</li>
	<li class="breadcrumb-item active">Default</li> --}}
@endsection

@section('content')

  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="dt-ext table-responsive">
              <table class="display" id="employee_data">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Employee ID</th>
                    <th>Employee Name</th>
                    <th>Role Type</th>
                    <th>Gender</th>
                    <th>DOJ</th>
                    <th>DOB</th>
                    <th>Department</th>
                    <th>Designation</th>
                    <th>Work Location</th>
                    <th>Grade</th>
                    <th>Email</th>
                    <th>Contact No</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

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

<script src="../assets/pro_js/employee_list.js"></script>

<script>
    var get_employee_list = "{{url('get_employee_list')}}";
</script>
@endsection

