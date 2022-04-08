@extends('layouts.simple.admin_master')
@section('title', 'Seating Request')

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
	<h2><span>Candidate Seating</span></h2>
@endsection

@section('breadcrumb-items')
   <li class="breadcrumb-item">Day One</li>
	{{-- <li class="breadcrumb-item active">Default</li> --}}
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
                              <th>SEATING ALLOTED</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>1</td>
                              <td>900311</td>
                              <td>Kandan</td>
                              <td>kandan@example.com</td>
                              <td>9898989898</td>
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
</div>

{{-- div popup model --}}

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Email Creation</h5>
             <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">Are you sure to confirm  that seating was alloted to this employee!...</div>
          <div class="modal-footer">
             <button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>
             <button class="btn btn-secondary" type="button" data-dismiss="modal">Save changes</button>
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

<script>

    function model_trigger(){
       $('#exampleModal').modal('show');
    }
  </script>
@endsection
