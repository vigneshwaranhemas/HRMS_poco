@extends('layouts.simple.candidate_master')
@section('title', 'Leave Balance')

@section('css')
<link rel="stylesheet" type="text/css" href="../assets/css/prism.css">
    <!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="../assets/css/chartist.css">
<link rel="stylesheet" type="text/css" href="../assets/css/date-picker.css">

@endsection

@section('style')
<style>
.card .card-header
{
    border-bottom: 0px solid #f2f4ff;
}


</style>
@endsection

@section('breadcrumb-title')
	<h2>Leave Balance<span> </span></h2>
@endsection

@section('breadcrumb-items')
   {{-- <li class="breadcrumb-item">Dashboard</li>
	<li class="breadcrumb-item active">Default</li> --}}
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">

        <div class="col-sm-8 col-xl-4">
            <div class="card b-r-0">
               <div class="card-header">
                  <h5>Loss Of Pay</h5>
                  <div class="card-header-right">
                     <span>Granted: 0</span>
                  </div>
               </div>
               <div class="card-body" style="margin-top: -45px;">
                <div class="col-md-12 text-center">
                    <h5>05</h5>
                    <p>Balance</p>
                    <a href="http://127.0.0.1:8000/payslip"><button class="btn btn-primary" type="button">View Details</button></a>
                </div>
               </div>
            </div>
         </div>

         <div class="col-sm-8 col-xl-4">
            <div class="card b-r-0">
               <div class="card-header">
                  <h5>On Duty</h5>
                  <div class="card-header-right">
                     <span>Granted: 0</span>
                  </div>
               </div>
               <div class="card-body" style="margin-top: -45px;">
                <div class="col-md-12 text-center">
                    <h5>05</h5>
                    <p>Balance</p>
                    <a href="http://127.0.0.1:8000/payslip"><button class="btn btn-primary" type="button">View Details</button></a>
                </div>
               </div>
            </div>
         </div>

         <div class="col-sm-8 col-xl-4">
            <div class="card b-r-0">
               <div class="card-header">
                  <h5>Probationary Leave</h5>
                  <div class="card-header-right">
                     <span>Granted: 0</span>
                  </div>
               </div>
               <div class="card-body" style="margin-top: -45px;">
                <div class="col-md-12 text-center">
                    <h5>05</h5>
                    <p>Balance</p>
                    <a href="http://127.0.0.1:8000/payslip"><button class="btn btn-primary" type="button">View Details</button></a>
                </div>
               </div>
            </div>
         </div>

         <div class="col-sm-8 col-xl-4">
            <div class="card b-r-0">
               <div class="card-header">
                  <h5>Work From Home</h5>
                  <div class="card-header-right">
                     <span>Granted: 0</span>
                  </div>
               </div>
               <div class="card-body" style="margin-top: -45px;">
                <div class="col-md-12 text-center">
                    <h5>05</h5>
                    <p>Balance</p>
                    <a href="http://127.0.0.1:8000/payslip"><button class="btn btn-primary" type="button">View Details</button></a>
                </div>
               </div>
            </div>
         </div>

         <div class="col-sm-8 col-xl-4">
            <div class="card b-r-0">
               <div class="card-header">
                  <h5>Privilege Leave</h5>
                  <div class="card-header-right">
                     <span>Granted: 0</span>
                  </div>
               </div>
               <div class="card-body" style="margin-top: -45px;">
                <div class="col-md-12 text-center">
                    <h5>05</h5>
                    <p>Balance</p>
                    <a href="http://127.0.0.1:8000/payslip"><button class="btn btn-primary" type="button">View Details</button></a>
                </div>
               </div>
            </div>
         </div>

         <div class="col-sm-8 col-xl-4">
            <div class="card b-r-0">
               <div class="card-header">
                  <h5>Sick Leave</h5>
                  <div class="card-header-right">
                     <span>Granted: 0</span>
                  </div>
               </div>
               <div class="card-body" style="margin-top: -45px;">
                <div class="col-md-12 text-center">
                    <h5>05</h5>
                    <p>Balance</p>
                    <a href="http://127.0.0.1:8000/payslip"><button class="btn btn-primary" type="button">View Details</button></a>
                </div>
               </div>
            </div>
         </div>

         <div class="col-sm-8 col-xl-4">
            <div class="card b-r-0">
               <div class="card-header">
                  <h5>Casual Leave</h5>
                  <div class="card-header-right">
                     <span>Granted: 0</span>
                  </div>
               </div>
               <div class="card-body" style="margin-top: -45px;">
                <div class="col-md-12 text-center">
                    <h5>05</h5>
                    <p>Balance</p>
                    <a href="http://127.0.0.1:8000/payslip"><button class="btn btn-primary" type="button">View Details</button></a>
                </div>
               </div>
            </div>
         </div>


    </div>
</div>


@endsection

@section('script')

{{-- <script src="../assets/pro_js/view_welcome_aboard.js"></script> --}}

<script>
// var add_welcome_aboard_process_link = "{{url('add_welcome_aboard_process')}}";
// var get_welcome_aboard_details_link = "{{url('get_welcome_aboard_details')}}";
</script>
@endsection
