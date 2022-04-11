@extends('layouts.simple.hr_master')
@section('title', 'EmailId Creation')

@section('css')
<link rel="stylesheet" type="text/css" href="{{url("assets/css/datatables.css")}}">
<link rel="stylesheet" type="text/css" href="{{url('assets/css/datatable-extension.css')}}">

@endsection

@section('style')

<style>
    .tdtextwidth{
        width: 163px;
    }
    .bg-warning
    {
        background-color: #7e37d8 !important;
    }
    </style>
@endsection

@section('breadcrumb-title')
	<h2><span>EmailId Creation</span></h2>
@endsection

@section('breadcrumb-items')
   <li class="breadcrumb-item">EmailId Creation</li>
	{{-- <li class="breadcrumb-item active">Default</li> --}}
@endsection

@section('content')



<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
               <div class="card-body">
                 <button type="button" style="margin-left: 902px;margin-bottom:13px;" class="btn btn-pill btn-primary">Submit</button>

                  <div class="dt-ext table-responsive">
                    <table class="display" id="export-button">
                        <thead>
                           <tr>
                              <th>#</th>
                              <th>Checked</th>
                              <th>EMPLOYEE ID</th>
                              <th>NAME</th>
                              <th>EMAIL</th>
                              <th>STATUS</th>
                              <th>HR SUGGEST EMAIL</th>
                              <th>ADMIN VERIFICATION</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>1</td>
                              <td>
                                <div class="media-body  text-center switch-sm icon-state">
                                    <label class="switch">
                                    <input type="checkbox" checked=""><span class="switch-state bg-warning"></span>
                                    </label>
                                 </div>
                              </td>
                              <td>CD1</td>
                              <td>Kandan</td>
                              <td>kandan@example.com</td>
                              <td class="text-center"></td>
                              <td><input type="text" class="form-control tdtextwidth"></td>
                              <td><select class="form-control">
                                   <option>Choose</option>
                                   <option>Laptop</option>
                                   <option>Desktop</option>
                                  </select>
                              </td>
                           </tr>
                           <tr>
                                <td>2</td>
                                <td>
                                    <div class="media-body text-center switch-sm icon-state">
                                        <label class="switch">
                                        <input type="checkbox" checked=""><span class="switch-state bg-warning"></span>
                                        </label>
                                     </div>
                                  </td>
                                <td>CD3</td>
                                <td>Shradha</td>
                                <td>Shradha@example.com</td>
                                <td class="text-center"><span class="badge badge-warning">In Progress</span></td>
                                <td><input type="text" class="form-control tdtextwidth"></td>
                                <td><select class="form-control">
                                    <option>Choose</option>
                                    <option>Laptop</option>
                                    <option>Desktop</option>
                                   </select>
                               </td>

                           </tr>
                           <tr>
                                <td>3</td>
                                <td>
                                    <div class="media-body  text-center switch-sm icon-state">
                                        <label class="switch">
                                        <input type="checkbox" checked=""><span class="switch-state bg-warning"></span>
                                        </label>
                                     </div>
                                  </td>
                                <td>CD2</td>
                                <td>Bineta</td>
                                <td>Bineta@example.com</td>
                                <td class="text-center"><span class="badge badge-success">Active</span></td>
                                <td><input type="text" class="form-control tdtextwidth"></td>
                                <td><select class="form-control" name="test">
                                    <option>Choose</option>
                                    <option>Laptop</option>
                                    <option>Desktop</option>
                                   </select>
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
@endsection
@section('script')

@endsection
