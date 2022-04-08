@extends('layouts.simple.hr_master')
@section('title', 'On Boarding')

@section('css')
<link rel="stylesheet" type="text/css" href="{{url("assets/css/datatables.css")}}">
<link rel="stylesheet" type="text/css" href="{{url('assets/css/datatable-extension.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
	<h2><span>On Boarding</span></h2>
@endsection

@section('breadcrumb-items')
   <li class="breadcrumb-item">On Boarding</li>
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
                              <th>INDUCTION MAIL</th>
                              <th>BUDDY MAIL</th>
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
                              <td><p style="color:green" class="fa fa-check"></p></td>
                              <td><p style="color:red" class="fa fa-times"></p></td>
                              <td>
                                {{-- <button  aria-expanded="false"  class="btn btn-default waves-effect waves-light" type="button"> --}}
                                    <a onclick="model_trigger()" href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    <a href="{{url("userdocuments")}}"><i class="fa fa-file-image-o"></i><a>
                                {{-- </button> --}}
                            </td>
                           </tr>
                           <tr>
                                <td>2</td>
                                <td>CD3</td>
                                <td>Shradha</td>
                                <td>Shradha@example.com</td>
                                <td>9898989898</td>
                                <td><p style="color:green" class="fa fa-check"></p></td>
                                <td><p style="color:red" class="fa fa-times"></p></td>
                              <td>
                                {{-- <button  aria-expanded="false"  class="btn btn-default waves-effect waves-light" type="button"> --}}
                                    <a onclick="model_trigger()" href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                   <a href="{{url("userdocuments")}}"><i class="fa fa-file-image-o"></i><a>
                                {{-- </button> --}}
                            </td>
                           </tr>
                           <tr>
                                <td>1</td>
                                <td>CD2</td>
                                <td>Bineta</td>
                                <td>Bineta@example.com</td>
                                <td>9898989898</td>
                                <td><p style="color:green" class="fa fa-check"></p></td>
                                <td><p style="color:red" class="fa fa-times"></p></td>
                              <td>
                               {{-- <button  aria-expanded="false"  class="btn btn-default waves-effect waves-light" type="button"> --}}
                                <a onclick="model_trigger()" href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                <a href="{{url("userdocuments")}}"><i class="fa fa-file-image-o"></i><a>
                            {{-- </button> --}}
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Employee Id Creation</h5>
             <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
              <label>Enter Employee Id</label>
              <input type="text" class="form-control">
          </div>
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
