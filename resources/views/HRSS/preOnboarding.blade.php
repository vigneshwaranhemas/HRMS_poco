@extends('layouts.simple.hr_master')
@section('title', 'Pre OnBoarding')

@section('css')
<link rel="stylesheet" type="text/css" href="{{url("assets/css/datatables.css")}}">
<link rel="stylesheet" type="text/css" href="{{url('assets/css/datatable-extension.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
	<h2><span>Pre OnBoarding </span></h2>
@endsection

@section('breadcrumb-items')
   <li class="breadcrumb-item">Pre OnBoarding</li>

@endsection

@section('content')



<div class="container-fluid">
    <div class="row">
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
                              <th>ACTION</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>1</td>
                              <td>CD1</td>
                              <td>Kandan</td>
                              <td>kandan@example.com</td>
                              <td>9898989898</td>
                              <td>
                                <button  aria-expanded="false" data-toggle="dropdown" class="btn btn-default dropdown-toggle waves-effect waves-light" type="button"><i class="fa fa-eye" aria-hidden="true"></i></button>
                            </td>
                           </tr>
                           <tr>
                                <td>2</td>
                                <td>CD3</td>
                                <td>Shradha</td>
                                <td>Shradha@example.com</td>
                                <td>9898989898</td>
                              <td>
                                <button  aria-expanded="false" data-toggle="dropdown" class="btn btn-default dropdown-toggle waves-effect waves-light" type="button"><i class="fa fa-eye" aria-hidden="true"></i></button>
                            </td>
                           </tr>
                           <tr>
                                <td>1</td>
                                <td>CD2</td>
                                <td>Bineta</td>
                                <td>Bineta@example.com</td>
                                <td>9898989898</td>
                              <td>
                                <button  aria-expanded="false" data-toggle="dropdown" class="btn btn-default dropdown-toggle waves-effect waves-light" type="button"><i class="fa fa-eye" aria-hidden="true"></i></button>
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
<script src="{{url('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('assets/js/datatable/datatable-extension/dataTables.buttons.min.js')}}"></script>
<script src="{{url('assets/js/datatable/datatable-extension/jszip.min.js')}}"></script>
<script src="{{url('assets/js/datatable/datatable-extension/buttons.colVis.min.js')}}"></script>
<script src="{{url('assets/js/datatable/datatable-extension/pdfmake.min.js')}}"></script>
<script src="{{url('assets/js/datatable/datatable-extension/vfs_fonts.js')}}"></script>
<script src="{{url('assets/js/datatable/datatable-extension/dataTables.autoFill.min.js')}}"></script>
<script src="{{url('assets/js/datatable/datatable-extension/dataTables.select.min.js')}}"></script>
<script src="{{url('assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js')}}"></script>
<script src="{{url('assets/js/datatable/datatable-extension/buttons.html5.min.js')}}"></script>
<script src="{{url('assets/js/datatable/datatable-extension/buttons.print.min.js')}}"></script>
<script src="{{url('assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{url('assets/js/datatable/datatable-extension/dataTables.responsive.min.js')}}"></script>
<script src="{{url('assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js')}}"></script>
<script src="{{url('assets/js/datatable/datatable-extension/dataTables.keyTable.min.js')}}"></script>
<script src="{{url('assets/js/datatable/datatable-extension/dataTables.colReorder.min.js')}}"></script>
<script src="{{url('assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js')}}"></script>
<script src="{{url('assets/js/datatable/datatable-extension/dataTables.rowReorder.min.js')}}"></script>
<script src="{{url('assets/js/datatable/datatable-extension/dataTables.scroller.min.js')}}"></script>
<script src="{{url('assets/js/datatable/datatable-extension/custom.js')}}"></script>
@endsection
