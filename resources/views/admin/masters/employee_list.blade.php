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
                    <th>Supervisor Name</th>
                    <th>Reviewer Name</th>
                    <th>Action</th>
                    <th>Info</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
              <!-- Edit pop-up model start -->
                <div class="modal fade text-left" id="role_edit_div" tabindex="-1" role="dialog" aria-labelledby="show_edit_pop_title" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                        role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"> Edit Role</h4>
                                <button type="button" id="close_edit_pop" class="close"
                                    data-bs-dismiss="modal" aria-label="Close">
                                    <i class="bi bi-x-circle-fill"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-2 col-12">
                                    </div>
                                    <div class="col-md-8 col-12">
                                        <div class="form-group">
                                            <label for="employe_role">Role Type </label>
                                            <select name="created_by" id="employe_role" name="employe_role" class="form-control">
                                                <option value="">Select</option>
                                                
                                              </select>
                                        </div>
                                      
                                        <input type="hidden" name="ed_id" id="ed_id">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                 <button type="button" class="btn btn-danger cancelbtn" id="editCancel" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-success deletebtn"
                                    id="editUpdate">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
              <!-- end edit -->
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
    /*popup admin*/
    var get_role_type_link = "{{url('get_role_type')}}";
    var get_employee_link = "{{url('get_employee_pop')}}";
    var employee_list_pop_link = "{{url('update_employee_list_pop')}}";
    var hr_id_card_varification_link = "{{url('hr_id_card_ver')}}";
</script>
@endsection

