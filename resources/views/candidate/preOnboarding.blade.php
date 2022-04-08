@extends('layouts.simple.candidate_master')
@section('title', 'HRSS Pre OnBoarding')

@section('css')
<link rel="stylesheet" type="text/css" href="{{url('assets/css/prism.css')}}">
    <!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="{{url('assets/css/chartist.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('assets/css/date-picker.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
	<h2>Candidate<span>Pre OnBoarding </span></h2>
@endsection

@section('breadcrumb-items')
   <li class="breadcrumb-item">Pre OnBoarding</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
               <div class="card-header">
                  <h5>Pre OnBoarding</h5>
               </div>
               <div class="card-block row">
                  <div class="col-sm-12 col-lg-12 col-xl-12">
                     <div class="table-responsive">
                        <table class="table">
                           <thead class="thead-light">
                              <tr>
                                 <th scope="col">#</th>
                                 <th scope="col">PRE ONBOARDING</th>
                                 <th scope="col">VERIFIED</th>
                                 <th scope="col">DATE</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <th scope="row">1</th>
                                 <td>Hr Ops</td>
                                 <td><label class="switch">
                                    <input type="checkbox" checked=""><span class="switch-state"></span>
                                    </label></td>
                                 <td>
                                    <input type="date" class="datepicker-here form-control digits1" name="date3"  id="date" style="width:50%;" >
                                 </td>
                              </tr>
                              <tr>
                                 <th scope="row">2</th>
                                 <td>Supervisor</td>
                                 <td><label class="switch">
                                    <input type="checkbox" checked=""><span class="switch-state"></span>
                                    </label></td>
                                 <td>
                                    <input type="date" class="datepicker-here form-control digits" name="date3"  id="date" style="width:50%;">

                                 </td>
                              </tr>
                              <tr>
                                 <th scope="row">3</th>
                                 <td>Buddy</td>
                                 <td><label class="switch">
                                    <input type="checkbox" checked=""><span class="switch-state"></span>
                                    </label></td>
                                 <td>
                                    <input type="date" class="form-control test1" name="date3" value="" id="date" style="width:50%;">

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
</div>
@endsection

@section('script')
@endsection
