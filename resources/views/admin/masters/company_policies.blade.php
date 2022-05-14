@extends('layouts.simple.admin_master')
@section('title', 'Company Policies')

@section('css')
<link rel="stylesheet" type="text/css" href="../assets/css/prism.css">
    <!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="../assets/css/chartist.css">
<link rel="stylesheet" type="text/css" href="../assets/css/date-picker.css">

@endsection

@section('style')
<style>
    .dropdown-basic .dropdown .dropbtn {
        padding: 6px 14px;
    }
    .dataTables_wrapper button
    {
        border-radius: 1px;
    }


</style>
@endsection

@section('breadcrumb-title')
	<h2>Company Policies<span> </span></h2>
@endsection

@section('breadcrumb-items')
    <button class="btn btn-primary" type="button" data-toggle="modal" data-original-title="test" data-target="#exampleModal" style="margin-right: 12px;">Add Policy Category</button>
    <button class="btn btn-primary" type="button" data-toggle="modal" data-original-title="test" data-target="#exampleModal2">Add Policy Information</button>
@endsection

@section('content')

  <!-- Container-fluid starts-->
  {{-- <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="dt-ext table-responsive">
              <table class="display" id="division_data">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Division</th>
                    <th>Status</th>
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
  </div> --}}
  <!-- Container-fluid Ends-->

<!-- Status pop-up model start-->
{{-- <div class="modal fade" id="status_pop_modal_div" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Division Unit Status</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>

              <div class="modal-body">
                <h6>Are you sure you want to Change the status of this Record?</h6>
              </div>
              <div class="modal-footer">
                  <button class="btn btn-primary" type="button" data-dismiss="modal" id="cancelSubmit">Close</button>
                  <button class="btn btn-secondary" type="button" id="confirmSubmit">Save</button>
              </div>

      </div>
    </div>
  </div> --}}
<!-- Status pop-up model start -->

<!-- Delete pop-up model start-->
{{-- <div class="modal fade" id="delete_pop_modal_div" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Division Unit Delete</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>

              <div class="modal-body">
                <h6>Are you sure you want to Delete this Record?</h6>
              </div>
              <div class="modal-footer">
                  <button class="btn btn-primary" type="button" data-dismiss="modal" id="deletecancelSubmit">Close</button>
                  <button class="btn btn-secondary" type="button" id="deleteconfirmSubmit">Delete</button>
              </div>

      </div>
    </div>
  </div> --}}
<!-- Delete pop-up model start -->

<!-- Edit pop-up model start-->
{{-- <div class="modal fade" id="division_edit_pop_modal_div" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Division Unit Details</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>

              <div class="modal-body">
                  <div class="form-row">
                      <div class="col-md-12 mb-3">
                        <label for="division_name">Division Name </label>
                        <input type="text" id="division_name" class="form-control" placeholder="Division Name" name="division_name" />
                      </div>
                      <input type="hidden" name="ed_id" id="ed_id">
                  </div>
              </div>
              <div class="modal-footer">
                  <button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>
                  <button class="btn btn-secondary" type="button" id="editUpdate">Save</button>
              </div>

      </div>
    </div>
  </div> --}}
<!-- Edit pop-up model start -->

  <!-- Pop-up div Policy Category starts-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Policy Category</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
            <form method="POST" action="javascript:void(0)" id="add_policy_category" class="ajax-form">
                {{ csrf_field() }}
              <div class="modal-body">
                  <div class="form-row">
                      <div class="col-md-12 mb-3">
                          <label for="policy_category">Policy Category</label>
                          <input class="form-control" name="policy_category" id="policy_category_input" type="text" placeholder="Policy Category" required="">
                          <div class="text-warning" id="policy_category_error"></div>
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <button class="btn btn-primary" type="button" id="closebutton" data-dismiss="modal">Close</button>
                  <button class="btn btn-secondary" type="button" id="btnSubmit">Save</button>
              </div>
            </form>
      </div>
    </div>
  </div>
<!-- Pop-up div Policy Category Ends-->

 <!-- Pop-up div Policy Information starts-->
 <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModal2Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModal2Label">Add Policy Information</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
            <form method="POST" action="javascript:void(0)" enctype="multipart/form-data" id="add_policy_information" class="ajax-form">
                {{ csrf_field() }}
              <div class="modal-body">
                  <div class="form-row">
                      <div class="col-md-12 mb-3">
                          <label for="policy_category">Policy Category</label>
                          <select class="form-control" id="policy_category" name="policy_category">
                          </select>
                          <div class="text-warning" id="policy_category_information_error"></div>
                      </div>
                      <div class="col-md-12 mb-3">
                        <label for="policy_title">Policy Title</label>
                        <input class="form-control" name="policy_title" id="policy_title_input" type="text" placeholder="Policy Title" required="">
                        <div class="text-warning" id="policy_title_error"></div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="policy_description">Policy Description</label>
                        <textarea class="form-control" name="policy_description" id="policy_description_input" rows="4" cols="50" required=""></textarea>
                        <div class="text-warning" id="policy_description_error"></div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="policy_category">File Upload</label>
                        <input class="form-control" name="file" id="file" type="file" required="">
                    </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <button class="btn btn-primary" type="button" id="closebutton" data-dismiss="modal">Close</button>
                  <button class="btn btn-secondary" type="button" id="info_submit">Save</button>
              </div>
            </form>
      </div>
    </div>
  </div>
<!-- Pop-up div Policy Information Ends-->



@endsection

@section('script')

<script src="../assets/pro_js/add_company_policies.js"></script>

<script>
var add_policy_category_process_link = "{{url('add_policy_category_process')}}";
var get_policy_category_details_link = "{{url('get_policy_category_details')}}";
var add_policy_information_process_link = "{{url('add_policy_information_process')}}";

</script>
@endsection
