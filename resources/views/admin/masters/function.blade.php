@extends('layouts.simple.admin_master')
@section('title', 'Function')

@section('css')
<link rel="stylesheet" type="text/css" href="../assets/css/prism.css">
    <!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="../assets/css/chartist.css">
<link rel="stylesheet" type="text/css" href="../assets/css/date-picker.css">

<link rel="stylesheet" type="text/css" href="../assets/css/datatables.css">
<link rel="stylesheet" type="text/css" href="../assets/css/datatable-extension.css">

@endsection

@section('style')
@endsection

@section('breadcrumb-title')
	<h2>Function<span> </span></h2>
@endsection

@section('breadcrumb-items')
   {{-- <li class="breadcrumb-item">Dashboard</li>
	<li class="breadcrumb-item active">Default</li> --}}
    <button class="btn btn-primary" type="button" data-toggle="modal" data-original-title="test" data-target="#exampleModal">Add Function</button>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Function</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <form class="needs-validation" novalidate="">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Function Name</label>
                            <input class="form-control" id="validationCustom01" type="text" placeholder="Function Name" required="">
                            <div class="valid-feedback">Looks good!</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-secondary" type="button">Save</button>
                </div>
            </form>
        </div>
      </div>
    </div>
@endsection

@section('content')
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="dt-ext table-responsive">
              <table class="display" id="export-button">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Function</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>System Architect</td>
                        <td>Edinburgh</td>
                        <td>61</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>System Architect</td>
                        <td>Edinburgh</td>
                        <td>61</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>System Architect</td>
                        <td>Edinburgh</td>
                        <td>61</td>
                    </tr>
                </tfoot>
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
<script src="../assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/js/datatable/datatable-extension/dataTables.buttons.min.js"></script>
<script src="../assets/js/datatable/datatable-extension/jszip.min.js"></script>
<script src="../assets/js/datatable/datatable-extension/buttons.colVis.min.js"></script>
<script src="../assets/js/datatable/datatable-extension/pdfmake.min.js"></script>
<script src="../assets/js/datatable/datatable-extension/vfs_fonts.js"></script>
<script src="../assets/js/datatable/datatable-extension/dataTables.autoFill.min.js"></script>
<script src="../assets/js/datatable/datatable-extension/dataTables.select.min.js"></script>
<script src="../assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js"></script>
<script src="../assets/js/datatable/datatable-extension/buttons.html5.min.js"></script>
<script src="../assets/js/datatable/datatable-extension/buttons.print.min.js"></script>
<script src="../assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js"></script>
<script src="../assets/js/datatable/datatable-extension/dataTables.responsive.min.js"></script>
<script src="../assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js"></script>
<script src="../assets/js/datatable/datatable-extension/dataTables.keyTable.min.js"></script>
<script src="../assets/js/datatable/datatable-extension/dataTables.colReorder.min.js"></script>
<script src="../assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js"></script>
<script src="../assets/js/datatable/datatable-extension/dataTables.rowReorder.min.js"></script>
<script src="../assets/js/datatable/datatable-extension/dataTables.scroller.min.js"></script>
<script src="../assets/js/datatable/datatable-extension/custom.js"></script>
<script src="../assets/js/chat-menu.js"></script>
<!-- Plugins JS Ends-->
<!-- Theme js-->
<script src="../assets/js/script.js"></script>
<script src="../assets/js/theme-customizer/customizer.js"></script>
@endsection

