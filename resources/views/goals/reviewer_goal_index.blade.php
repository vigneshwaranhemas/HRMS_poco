{{-- Divya --}}
@extends(Auth::user()->role_type === 'Admin' ? 'layouts.simple.admin_master' : ( Auth::user()->role_type === 'Buddy'? 'layouts.simple.buddy_master ': ( Auth::user()->role_type === 'Employee'? 'layouts.simple.candidate_master ': ( Auth::user()->role_type === 'HR'? 'layouts.simple.hr_master ': ( Auth::user()->role_type === 'IT Infra'? 'layouts.simple.itinfra_master ': ( Auth::user()->role_type === 'Site Admin'? 'layouts.simple.site_admin_master': '' ) ) ) ) ) )
@section('title', 'Goals')

@section('css')
<link rel="stylesheet" type="text/css" href="../assets/css/prism.css">
<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="../assets/css/select2.css">
<link rel="stylesheet" type="text/css" href="../assets/css/chartist.css">
<link rel="stylesheet" type="text/css" href="../assets/css/date-picker.css">
@endsection

@section('style')
<style>
    .dataTables_wrapper button.goals_btn{
        border-radius: unset !important;
        padding: revert !important;
    }
    .dataTables_wrapper button.goal_btn_status {
        font-weight: revert;
        font-size: revert;
        color: #fff;
        background-color: #7e37d8;
        border: none;
        padding: revert;
        border-radius: revert;
    }
</style>
@endsection

@section('breadcrumb-title')
	<h2>Reviewer Goal Setting<span>Process</span></h2>
@endsection

@section('breadcrumb-items')
@endsection

@section('content')
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                <ul class="nav nav-tabs nav-material nav-primary" id="info-tab" role="tablist">
                    <li class="nav-item"><a class="nav-link active" id="info-home-tab" data-toggle="tab" href="#info-home" role="tab" aria-controls="info-home" aria-selected="true"><i class="icofont icofont-ui-home"></i>Supervisor</a>
                    <div class="material-border"></div>
                    </li>
                    <li class="nav-item"><a class="nav-link" id="info-reviewer-tab" data-toggle="tab" href="#info-reviewer" role="tab" aria-controls="info-reviewer" aria-selected="true"><i class="fa fa-user" aria-hidden="true"></i>Reviewer</a>
                    <div class="material-border"></div>
                    </li>
                    <li class="nav-item"><a class="nav-link" id="profile-info-tab" data-toggle="tab" href="#info-profile" role="tab" aria-controls="info-profile" aria-selected="false"><i class="icofont icofont-man-in-glasses"></i>MySelf</a>
                    <div class="material-border"></div>
                    </li>
                </ul>
                <div class="tab-content" id="info-tabContent">
                    <div class="tab-pane fade show active" id="info-home" role="tabpanel" aria-labelledby="info-home-tab">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-2 m-t-5">
                                        <label for="Leader">Select Team Leader</label>
                                        <select class="js-example-basic-single float-right" style="width:300px;" id="team_leader_filter" name="team_leader_filter">
                                            <option value="">...Select...</option>
                                            @foreach($supervisor_list as $supervisor)
                                                <option value="{{ $supervisor->empID }}">{{ $supervisor->username }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-8 m-t-35">
                                        <button type="button" id="reviewer_filter_apply" onclick="supervisor_filter_apply();" class="btn btn-success"><i class="ti-save"></i> Apply</button>
                                        <button type="button" id="reset" onclick="supervisor_filter_reset();" class="btn btn-dark"><i class="ti-save"></i> Clear</button>
                                    </div>
                                </div>

                                <div class="table-responsive m-t-40">
                                    <table class="table" id="team_member_goal_data">
                                        <thead>
                                            <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Employee Name</th>
                                            <th scope="col">Goal Name</th>
                                            <th scope="col">Status</th>
                                            <!-- <th scope="col">Date</th> -->
                                            <th scope="col">Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="info-reviewer" role="tabpanel" aria-labelledby="info-reviewer-tab">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-2 m-t-5">
                                        <label for="Leader">Select Team Leader</label>
                                        <select class="js-example-basic-single float-right" style="width:300px;" id="team_leader_filter_for_reviewer" name="team_leader_filter_for_reviewer">
                                            <option value="">...Select...</option>
                                            @foreach($supervisor_list as $supervisor)
                                                <option value="{{ $supervisor->empID }}">{{ $supervisor->username }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-2 m-t-5">
                                        <label for="Leader">Select Team Member</label>
                                        <select class="js-example-basic-single float-right" style="width:300px;" id="team_member_filter" name="team_member_filter">
                                            <option value="">...Select...</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-8 m-t-35">
                                        <button type="button" id="reviewer_filter_apply" onclick="reviewer_filter_apply();" class="btn btn-success"><i class="ti-save"></i> Apply</button>
                                        <button type="button" id="reset" onclick="reviewer_filter_reset();" class="btn btn-dark"><i class="ti-save"></i> Clear</button>
                                    </div>
                                </div>

                                <div class="table-responsive m-t-40">
                                    <table class="table" id="team_member_goal_data_for_reviewer">
                                        <thead>
                                            <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Employee Name</th>
                                            <th scope="col">Goal Name</th>
                                            <th scope="col">Status</th>
                                            <!-- <th scope="col">Date</th> -->
                                            <th scope="col">Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="info-profile" role="tabpanel" aria-labelledby="profile-info-tab">
                        <div class="card">
                            <div class="card-body">
                                <a href="add_goal_setting" id="add_goal_btn" style="display:none"><button class="btn  float-right btn-primary-gradien" type="button" data-original-title="Add Goal Sheet" title="Add Goal Sheet">Add Goal Sheet</button></a>
                                <div class="table-responsive">
                                    <table class="table" id="goal_data">
                                        <thead>
                                            <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Goal list</th>
                                            <th scope="col">Action </th>
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
                </div>
            </div>
        </div>

        <!-- MOdal Fade -->
        <div class="modal fade" id="goalsDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form  id="formGoalDelete">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Goal Delete</h4>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <h6>Are you sure you want to Delete this Record?</h6>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" id="goals_id_delete" class="form-control">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">Delete</button>
                    </div>
                    </div>
                </form>
            </div>
            </div>
        </div>

    </div>
</div>
<!-- Container-fluid Ends-->
@endsection

@section('script')
<script src="../assets/js/typeahead/handlebars.js"></script>
<script src="../assets/js/typeahead/typeahead.bundle.js"></script>
<script src="../assets/js/typeahead/typeahead.custom.js"></script>
<script src="../assets/js/typeahead-search/handlebars.js"></script>
<script src="../assets/js/typeahead-search/typeahead-custom.js"></script>
<script src="../assets/js/chart/chartist/chartist.js"></script>
<script src="../assets/js/chart/chartist/chartist-plugin-tooltip.js"></script>
<script src="../assets/js/chart/apex-chart/apex-chart.js"></script>
<script src="../assets/js/chart/apex-chart/stock-prices.js"></script>
<script src="../assets/js/prism/prism.min.js"></script>
<script src="../assets/js/clipboard/clipboard.min.js"></script>
<script src="../assets/js/counter/jquery.waypoints.min.js"></script>
<script src="../assets/js/counter/jquery.counterup.min.js"></script>
<script src="../assets/js/counter/counter-custom.js"></script>
<script src="../assets/js/custom-card/custom-card.js"></script>
<script src="../assets/js/notify/bootstrap-notify.min.js"></script>
<script src="../assets/js/dashboard/default.js"></script>
<script src="../assets/js/notify/index.js"></script>
<script src="../assets/js/datepicker/date-picker/datepicker.js"></script>
<script src="../assets/js/datepicker/date-picker/datepicker.en.js"></script>
<script src="../assets/js/datepicker/date-picker/datepicker.custom.js"></script>
<!-- Select2 -->
<script src="../assets/js/select2/select2.full.min.js"></script>
<script src="../assets/js/select2/select2-custom.js"></script>

<script src="../assets/pro_js/reviewer_goal_list.js"></script>
@endsection

