{{-- Divya --}}

@extends(Auth::user()->role_type === 'Admin' ? 'layouts.simple.admin_master' : ( Auth::user()->role_type === 'Buddy'? 'layouts.simple.buddy_master ': ( Auth::user()->role_type === 'can'? 'layouts.simple.candidate_master ': ( Auth::user()->role_type === 'HR'? 'layouts.simple.hr_master ': ( Auth::user()->role_type === 'Itinfra'? 'layouts.simple.itinfra_master': ( Auth::user()->role_type === 'Site Admin'? 'layouts.simple.site_admin_master': '' ) ) ) ) ) )

@section('title', 'Premium Admin Template')

@section('css')
<link rel="stylesheet" type="text/css" href="../assets/css/prism.css">
    <!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="../assets/css/chartist.css">
<link rel="stylesheet" type="text/css" href="../assets/css/date-picker.css">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
	<h2>Goal Setting<span>Process</span></h2>
@endsection

@section('breadcrumb-items')
  <a href="add_goal_setting"><button class="btn btn-primary-gradien mb-5" type="button" data-original-title="Add Goal Sheet" title="Add Goal Sheet">Add Goal Sheet</button></a>

@endsection

@section('content')
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">            
            <div class="card">
                <div class="card-body">
                    <!-- <a href="hr_add_goal_setting"><button class="btn btn-primary-gradien mb-5" type="button" data-original-title="Add Goal Sheet" title="Add Goal Sheet">Add Goal Sheet</button></a> -->
                    <div class="table-responsive">
                        <table class="table" id="goal-tb">
                            <thead>
                                <tr>
                                  <th scope="col">No</th>
                                  <th scope="col">Goal list</th>
                                  <th scope="col">Action </th>
                                </tr>
                            </thead>
                            <tbody>
                              <tr>
                                  <td>1</td>
                                  <td>Goal-22 1</td>
                                  <td>
                                      <div class="dropup">
                                          <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                                          <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                                              <a href="goal-setting.html" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs" type="button"><i class="fa fa-eye"></i></button></a>
                                              <a class="dropdown-item ditem-gs"><button class="btn btn-info btn-xs" type="button"><i class="fa fa-pencil"></i></button></a>
                                              <a class="dropdown-item ditem-gs"><button class="btn btn-danger btn-xs" type="button"><i class="fa fa-trash-o"></i></button></a>
                                          </div>
                                      </div>
                                  </td>
                              </tr>
                              <tr>
                                  <td>2</td>
                                  <td>Goal-22 2</td>
                                  <td>
                                      <div class="dropup">
                                          <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                                          <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                                              <a href="goal-setting.html" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs" type="button"><i class="fa fa-eye"></i></button></a>
                                              <a class="dropdown-item ditem-gs"><button class="btn btn-info btn-xs" type="button"><i class="fa fa-pencil"></i></button></a>
                                              <a class="dropdown-item ditem-gs"><button class="btn btn-danger btn-xs" type="button"><i class="fa fa-trash-o"></i></button></a>
                                          </div>
                                      </div>
                                  </td>
                              </tr>
                              <tr>
                                  <td>3</td>
                                  <td>Goal-22 3</td>
                                  <td>
                                      <div class="dropup">
                                          <button type="button" class="btn btn-secondary" style="padding:0.37rem 0.8rem !important;" data-toggle="dropdown" id="dropdownMenuButton"><i class="fa fa-spin fa-cog"></i></button>
                                          <div class="dropdown-menu" style="transform: translate3d(-17px, 21px, 0px) !important; min-width: unset;" aria-labelledby="dropdownMenuButton">
                                              <a href="goal-setting.html" class="dropdown-item ditem-gs"><button class="btn btn-primary btn-xs" type="button"><i class="fa fa-eye"></i></button></a>
                                              <a class="dropdown-item ditem-gs"><button class="btn btn-info btn-xs" type="button"><i class="fa fa-pencil"></i></button></a>
                                              <a class="dropdown-item ditem-gs"><button class="btn btn-danger btn-xs" type="button"><i class="fa fa-trash-o"></i></button></a>
                                          </div>
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
@endsection

