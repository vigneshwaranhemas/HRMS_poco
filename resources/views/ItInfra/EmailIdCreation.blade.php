@extends('layouts.simple.itinfra_master')
@section('title', 'EmailId Creation')

@section('css')
<link rel="stylesheet" type="text/css" href="{{url("assets/css/datatables.css")}}">
<link rel="stylesheet" type="text/css" href="{{url('assets/css/datatable-extension.css')}}">
@endsection

@section('style')
<style>
    .bg-info
      {
          background-color: #7e37d8 !important;
      }
   </style>
@endsection

@section('breadcrumb-title')
	<h2><span>EmailId Creation  </span></h2>
@endsection

@section('breadcrumb-items')
   <li class="breadcrumb-item">EmailId Creation </li>

@endsection

@section('content')
<div class="col-sm-12 col-xl-12 xl-100">
    <div class="card">

       <div class="card-body">
          <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
             <li class="nav-item">
                <a class="nav-link active" id="top-home-tab" data-toggle="tab" href="#top-home" role="tab" aria-controls="top-home" aria-selected="true"><i class="icofont icofont-ui-home"></i>Pending</a>
                <div class="material-border"></div>
             </li>
             <li class="nav-item">
                <a class="nav-link" id="profile-top-tab" data-toggle="tab" href="#top-profile" role="tab" aria-controls="top-profile" aria-selected="false"><i class="icofont icofont-man-in-glasses"></i>Completed</a>
                <div class="material-border"></div>
             </li>

          </ul>
          <div class="tab-content" id="top-tabContent">
             <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                <div class="col-sm-12">
                    <div class="card">
                       <div class="card-body">
                          <div class="dt-ext table-responsive">
                            <table class="display" id="export-button">
                                <thead>
                                   <tr>
                                      <th>#</th>
                                      <th>EMPLOYEE ID</th>
                                      <th>NAME</th>
                                      <th>EMAIL</th>
                                      <th>MOBILE NUMBER</th>
                                      <th>HR SUGGESTED MAIL</th>
                                      <th>Asset</th>
                                      <th>EmailId Creation</th>
                                   </tr>
                                </thead>
                                <tbody>
                                   <tr>
                                      <td>1</td>
                                      <td>900311</td>
                                      <td>Kandan</td>
                                      <td>kandan@hemas.com</td>
                                      <td>9898989898</td>
                                      <td>kandan@hemas.in</td>
                                      <td>Laptop</td>
                                      <td>
                                        <div class="media-body text-center icon-state">
                                            <label class="switch">
                                            <input type="checkbox"  onchange="model_trigger()"><span class="switch-state bg-info"></span>
                                            </label>
                                         </div>
                                        </td>
                                   </tr>
                                   <tr>
                                        <td>2</td>
                                        <td>900313</td>
                                        <td>Shradha</td>
                                        <td>Shradha@example.com</td>
                                        <td>9898989898</td>
                                        <td>Bineta@hemas.in</td>
                                        <td>Desktop</td>
                                        <td>
                                            <div class="media-body text-center icon-state">
                                                <label class="switch">
                                                <input type="checkbox"  onchange="model_trigger()"><span class="switch-state bg-info"></span>
                                                </label>
                                             </div>
                                            </td>

                                   </tr>
                                   <tr>
                                        <td>1</td>
                                        <td>900312</td>
                                        <td>Bineta</td>
                                        <td>Bineta@example.com</td>
                                        <td>9898989898</td>
                                        <td>Shradha@hemas.in</td>
                                        <td>Laptop</td>
                                        <td>
                                            <div class="media-body text-center icon-state">
                                                <label class="switch">
                                                <input type="checkbox"  onchange="model_trigger()"><span class="switch-state bg-info"></span>
                                                </label>
                                             </div>
                                            </td>
                                   </tr>
                                </tbody>
                             </table>
                          </div>
                       </div>
                    </div>
                 </div>
             </div>
             <div class="tab-pane fade" id="top-profile" role="tabpanel" aria-labelledby="profile-top-tab">
                <div class="col-sm-12">
                    <div class="card">
                       <div class="card-body">
                          <div class="dt-ext table-responsive">
                            <table class="display" id="export-button1">
                                <thead>
                                   <tr>
                                      <th>#</th>
                                      <th>EMPLOYEE ID</th>
                                      <th>NAME</th>
                                      <th>EMAIL</th>
                                      <th>MOBILE NUMBER</th>
                                      <th>OFFICIAL EMAILID</th>
                                      <th>Asset</th>
                                      {{-- <th>EmailId Creation</th> --}}
                                   </tr>
                                </thead>
                                <tbody>
                                   <tr>
                                      <td>1</td>
                                      <td>900311</td>
                                      <td>Kandan</td>
                                      <td>kandan@hemas.com</td>
                                      <td>9898989898</td>
                                      <td>kandan@hemas.in</td>
                                      <td>Laptop</td>
                                      {{-- <td><label class="switch">
                                        <input type="checkbox" checked onchange="model_trigger()" ><span class="switch-state"></span>
                                        </label></td> --}}
                                   </tr>
                                   <tr>
                                        <td>2</td>
                                        <td>900312</td>
                                        <td>Shradha</td>
                                        <td>Shradha@example.com</td>
                                        <td>9898989898</td>
                                        <td>Bineta@hemas.in</td>
                                        <td>Desktop</td>
                                        {{-- <td><label class="switch">
                                            <input type="checkbox" checked onchange="model_trigger()" ><span class="switch-state"></span>
                                            </label></td> --}}

                                   </tr>
                                   <tr>
                                        <td>1</td>
                                        <td>900313</td>
                                        <td>Bineta</td>
                                        <td>Bineta@example.com</td>
                                        <td>9898989898</td>
                                        <td>Shradha@hemas.in</td>
                                        <td>Laptop</td>
                                        {{-- <td><label class="switch">
                                            <input type="checkbox" checked  onchange="model_trigger()"><span class="switch-state"></span>
                                            </label></td> --}}
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
 </div>
 {{-- div popup model --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Email Creation</h5>
             <button class="close" type="button" data-dismiss="modal" arsia-label="Close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">Are you sure to confirm this email id as created</div>
          <div class="modal-footer">
             <button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>
             <button class="btn btn-secondary" type="button" data-dismiss="modal">Save changes</button>
          </div>
       </div>
    </div>
 </div>
 @endsection

@section('script')


<script>

    function model_trigger(){
       $('#exampleModal').modal('show');
    }
  </script>
@endsection
