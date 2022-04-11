{{-- Divya --}}
@extends('layouts.simple.admin_master')
@section('title', 'Premium Admin Template')

@section('css')
<link rel="stylesheet" type="text/css" href="../assets/css/prism.css">
<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="../assets/css/calendar.css">
<link rel="stylesheet" type="text/css" href="../assets/css/chartist.css">
<link rel="stylesheet" type="text/css" href="../assets/css/date-picker.css">
<link rel="stylesheet" type="text/css" href="../assets/css/select2.css">
<link rel="stylesheet" type="text/css" href="../assets/css/sweetalert2.css">

<!-- Font Awesome-->
<link rel="stylesheet" type="text/css" href="../assets/css/fontawesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="../assets/css/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="../assets/css/themify.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="../assets/css/feather-icon.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/animate.css">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="../assets/css/select2.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/pe7-icon.css">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <link id="color" rel="stylesheet" href="../assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/responsive.css">

@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h2>Events</h2>
@endsection

@section('breadcrumb-items')
   <li class="breadcrumb-item">Dashboard</li>
	<li class="breadcrumb-item active">Default</li>
@endsection

@section('content')
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="calendar-wrap">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="cal-basic"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   

    <div class="mb-2">
                        <div class="col-form-label">Default Placeholder</div>
                        <select class="js-example-placeholder-multiple col-sm-12 select2-hidden-accessible" multiple="" tabindex="-1" aria-hidden="true">
                          <option value="AL">Alabama</option>
                          <option value="WY">Wyoming</option>
                          <option value="WY">Coming</option>
                          <option value="WY">Hanry Die</option>
                          <option value="WY">John Doe</option>
                        </select><span class="select2 select2-container select2-container--default select2-container--focus" dir="ltr" style="width: 859px;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1"><ul class="select2-selection__rendered"><li class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" role="textbox" aria-autocomplete="list" placeholder="Select Your Name" style="width: 847px;"></li></ul></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                      </div>  

    <!-- Modal Fade Start -->
    <div class="modal fade bd-example-modal-lg" id="add-event" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form  id="getNewEventForm">
            @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Add Event</h4>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row mb-3">
                            <div class="col-md-6">
                                <label for="event_name">Event Name</label>
                                <input type="text" name="event_name" id="event_name" class="form-control">
                                <div class="text-warning" id="event_name_error"></div>
                            </div>
                            <div class="col-md-2">
                                <label for="label_color">Color</label>
                                <input type="color" name="label_color" value="#00C292" id="colorselector" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="where">Where</label>
                                <input type="text" name="where" id="where" class="form-control">                                
                                <div class="text-warning" id="where_error"></div> 
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col-md-6">
                                <label for="category_name">Category
                                    <a href="javascript:;" id="add_category" class="btn btn-xs btn-success btn-outline add_category"><i class="fa fa-plus"></i></a>
                                </label>
                                <select class="form-control" id="category_id" name="category_name">  
                                    <option value="">Select Category...</option>                                              
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="label_color">Event Type
                                    <a href="javascript:;" id="createEventType" class="btn btn-xs btn-outline btn-success createEventType"><i class="fa fa-plus"></i></a>
                                </label>
                                <select class="select2 form-control" id="event_type_id" name="event_type">
                                    <option value="">Please Select Event Type</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col-md-12">
                                <label for="category_name">Description</label>
                                <textarea name="description" id="description" class="form-control"></textarea>
                                <div class="text-danger" id="description_error"></div> 
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col-xs-6 col-md-3">
                                <label for="category_name">Starts On</label>
                                <input type="date" name="start_date" id="start_date" class="form-control">
                                <div class="text-danger" id="start_date_error"></div> 
                            </div>
                            <div class="col-xs-5 col-md-3">
                                <label>&nbsp;</label>
                                <input type="time" name="start_time" id="start_time"
                                    class="form-control">
                                <div class="text-danger" id="start_time_error"></div> 
                            </div>
                            <div class="col-xs-6 col-md-3">
                                <label for="category_name">Ends On</label>
                                <input type="date" name="end_date" id="end_date" class="form-control">
                                <div class="text-danger" id="end_date_error"></div> 
                            </div>
                            <div class="col-xs-5 col-md-3">
                                <label>&nbsp;</label>
                                <input type="time" name="end_time" id="end_time"
                                    class="form-control">
                                <div class="text-danger" id="end_time_error"></div> 
                            </div>
                        </div>                       
                        <div class="form-row mb-3">
                            <div class="col-md-3">
                                <label for="repeat-event">Add Attendees</label>
                            </div>
                            <div class="col-md-9">
                                <input id="" name="" value="yes" type="checkbox">
                                <label for="">All Candicates</label>
                            </div>
                            <div class="col-md-12">
                                <select class="select2 m-b-10 select2-multiple form-control" multiple="multiple" name="candicate_list_options[]">
                                    @foreach($candicate_details as $candicate_detail)
                                    <option value="{{$candicate_detail->candidate_name }}">{{$candicate_detail->candidate_name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger" id="candicate_list_options_error"></div> 
                            </div>
                            

                            <!-- <div class="form-group">
                                <label class="col-xs-3 m-t-10 required">Add Attendees</label>
                                <div class="col-xs-7">
                                    <div class="checkbox checkbox-info">
                                        <input id="candicate_list" name="candicate_list" value="true"
                                            type="checkbox">
                                        <label for="all-employees">All Candicates</label>
                                    </div>
                                </div>
                            </div> -->
                            <!-- <div class="form-group">
                                <select class="select2 m-b-10 select2-multiple form-control" multiple="multiple" name="candicate_list_options[]">
                                    @foreach($candicate_details as $candicate_detail)
                                    <option value="{{$candicate_detail->candidate_name }}">{{$candicate_detail->candidate_name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger" id="candicate_list_options_error"></div> 

                            </div> -->
                        </div>
                        <div class="form-row mb-3">
                            <div class="col-md-12">
                                <input id="repeat-event" name="repeat" value="yes" type="checkbox">
                                <label for="repeat-event">Repeat</label>
                            </div>
                        </div>
                        <div class="form-row mb-3" id="repeat-fields" style="display: none">
                            <div class="col-xs-6 col-md-4">
                                <label>Repeat Every</label>
                                <input type="number" min="1" value="1" name="repeat_count" class="form-control">
                            </div>
                            <div class="col-xs-6 col-md-4">
                                <label>&nbsp;</label>
                                <select name="repeat_type" id="" class="form-control">
                                    <option value="day">Day</option>
                                    <option value="week">Week</option>
                                    <option value="month">Month</option>
                                    <option value="year">Year</option>
                                </select>
                            </div>
                            <div class="col-xs-6 col-md-4">
                                <label>Cycles <a class="mytooltip" href="javascript:void(0)"> <i class="fa fa-info-circle"></i></a></label>
                                <input type="text" name="repeat_cycles" id="repeat_cycles" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="button">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="add-category-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form  id="getNewEventForm">
            @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Event Category</h4>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <table class="table" class="mb-3" id="goal-tb">
                            <thead>
                                <tr>
                                  <th scope="col">No</th>
                                  <th scope="col">Category Name</th>
                                  <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              <tr>
                                  <td>1</td>
                                  <td>Games</td>
                                  <td>
                                    <button class="btn btn-danger mt-2 mb-2" type="button" data-dismiss="modal">Delete</button>
                                  </td>
                              </tr>
                              <tr>
                                  <td>2</td>
                                  <td>Presentations</td>
                                  <td>
                                    <button class="btn btn-danger mt-2 mb-2" type="button" data-dismiss="modal">Delete</button>
                                  </td>
                              </tr>
                              <tr>
                                  <td>3</td>
                                  <td>Treasure Hunt</td>
                                  <td>
                                    <button class="btn btn-danger mt-2 mb-2" type="button" data-dismiss="modal">Delete</button>
                                  </td>
                              </tr>
                            </tbody>
                        </table>
                        
                        <form method="post" id="eventCategoryForm">  
                        @csrf  
                        <div class="form-row mb-3">
                            <div class="col-md-6">
                                <label for="event_name" style="font-weight: bold;">Add Category Name</label>
                                <input type="text" name="category_name" id="category_name" class="form-control">
                                <div class="text-danger" id="category_name_error"></div> 
                            </div>
                        </div>
                        <button class="btn btn-success mt-2 mb-2" type="button" data-dismiss="modal">Save</button>
                        </form>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <div class="modal fade bd-example-modal-lg" id="event-type-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form  id="getNewEventForm">
            @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Event Type</h4>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <table class="table" class="mb-3" id="goal-tb">
                            <thead>
                                <tr>
                                  <th scope="col">No</th>
                                  <th scope="col">Name</th>
                                  <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              <tr>
                                  <td>1</td>
                                  <td>Women's Day</td>
                                  <td>
                                    <button class="btn btn-danger mt-2 mb-2" type="button" data-dismiss="modal">Delete</button>
                                  </td>
                              </tr>
                              <tr>
                                  <td>2</td>
                                  <td>Tamil New Year</td>
                                  <td>
                                    <button class="btn btn-danger mt-2 mb-2" type="button" data-dismiss="modal">Delete</button>
                                  </td>
                              </tr>
                              <tr>
                                  <td>3</td>
                                  <td>Seminars</td>
                                  <td>
                                    <button class="btn btn-danger mt-2 mb-2" type="button" data-dismiss="modal">Delete</button>
                                  </td>
                              </tr>
                            </tbody>
                        </table>
                        
                        <form method="post" id="eventTypeForm">  
                        @csrf  
                        <div class="form-row mb-3">
                            <div class="col-md-6">
                                <label for="event_name" style="font-weight: bold;">Event Type</label>
                                <input type="text" name="event_type" id="event_type" class="form-control">
                                <div class="text-danger" id="event_type_error"></div>  
                            </div>
                        </div>
                        <button class="btn btn-success mt-2 mb-2" type="button" data-dismiss="modal">Save</button>
                        </form>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="eventDetailModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Events Details</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <form>
                @csrf
                    <div class="modal-body">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <h6 class="f-w-700">Events Details</h6>
                                        <p id="event_name_show">                                    
                                        </p>
                                        <p class="font-normal"> &mdash; <i>at</i> <span  id="where_show"></span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h6 class="f-w-700">Description</h6>
                                        <p id="description_show"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h6 class="f-w-700">Attendees</h6>
                                        <p><div class="avatar"><img class="img-30 rounded-circle" src="../assets/images/user/1.jpg" alt="#"><img class="img-30 rounded-circle" src="../assets/images/user/1.jpg" alt="#"><img class="img-30 rounded-circle" src="../assets/images/user/1.jpg" alt="#"></div></p>
                                        <p id="candicate_list_show"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h6 class="f-w-700">Category</h6>
                                        <p id="category_name_show"></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h6 class="f-w-700">Event type</h6>
                                        <p id="event_type_show"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h6 class="f-w-700">Starts On</h6>
                                        <div class="row">
                                            <div class="col-lg-5">
                                                <p id="start_date_show"></p>
                                            </div>
                                            <div class="col-lg-7">
                                                <p id="start_time_show"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h6 class="f-w-700">Ends On</h6>
                                        <div class="row">
                                            <div class="col-lg-5">
                                                <p id="end_date_show"></p>
                                            </div>
                                            <div class="col-lg-7">
                                                <p id="end_time_show"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" class="form form-control" id="event_edit_id">
                        <button class="btn btn-dark" type="button" data-dismiss="modal">Close</button>
                        <button class="btn btn-danger delete-event" type="button" onclick="_gaq.push(['_trackEvent', 'example', 'try', 'delete-event']);">Delete</button>
                        <!-- <button class="btn btn-danger delete-event" type="button">Delete</button> -->
                        <button class="btn btn-primary edit-event" type="button">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="modal fade bd-example-modal-lg" id="formEventEditModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form  id="getNewEventForm">
            @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Edit Event</h4>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row mb-3">
                            <div class="col-md-6">
                                <label for="event_name">Event Name</label>
                                <input type="text" name="event_name" id="event_name" class="form-control">
                                <div class="text-warning" id="event_name_error"></div>
                            </div>
                            <div class="col-md-2">
                                <label for="label_color">Color</label>
                                <input type="color" name="label_color" value="#00C292" id="colorselector" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="where">Where</label>
                                <input type="text" name="where" id="where" class="form-control">                                
                                <div class="text-warning" id="where_error"></div> 
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col-md-6">
                                <label for="category_name">Category
                                    <a href="javascript:;" id="add_category" class="btn btn-xs btn-success btn-outline add_category"><i class="fa fa-plus"></i></a>
                                </label>
                                <select class="form-control" id="category_id" name="category_name">  
                                    <option value="">Select Category...</option>                                              
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="label_color">Event Type
                                    <a href="javascript:;" id="createEventType" class="btn btn-xs btn-outline btn-success createEventType"><i class="fa fa-plus"></i></a>
                                </label>
                                <select class="select2 form-control" id="event_type_id" name="event_type">
                                    <option value="">Please Select Event Type</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col-md-12">
                                <label for="category_name">Description</label>
                                <textarea name="description" id="description" class="form-control"></textarea>
                                <div class="text-danger" id="description_error"></div> 
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col-xs-6 col-md-3">
                                <label for="category_name">Starts On</label>
                                <input type="date" name="start_date" id="start_date" class="form-control">
                                <div class="text-danger" id="start_date_error"></div> 
                            </div>
                            <div class="col-xs-5 col-md-3">
                                <label>&nbsp;</label>
                                <input type="time" name="start_time" id="start_time"
                                    class="form-control">
                                <div class="text-danger" id="start_time_error"></div> 
                            </div>
                            <div class="col-xs-6 col-md-3">
                                <label for="category_name">Ends On</label>
                                <input type="date" name="end_date" id="end_date" class="form-control">
                                <div class="text-danger" id="end_date_error"></div> 
                            </div>
                            <div class="col-xs-5 col-md-3">
                                <label>&nbsp;</label>
                                <input type="time" name="end_time" id="end_time"
                                    class="form-control">
                                <div class="text-danger" id="end_time_error"></div> 
                            </div>
                        </div>                       
                        <div class="form-row mb-3">
                            <div class="col-md-3">
                                <label for="repeat-event">Add Attendees</label>
                            </div>
                            <div class="col-md-9">
                                <input id="" name="" value="yes" type="checkbox">
                                <label for="">All Candicates</label>
                            </div>
                            <div class="col-md-12">
                                <select class="select2 m-b-10 select2-multiple form-control" multiple="multiple" name="candicate_list_options[]">
                                    @foreach($candicate_details as $candicate_detail)
                                    <option value="{{$candicate_detail->candidate_name }}">{{$candicate_detail->candidate_name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger" id="candicate_list_options_error"></div> 
                            </div>
                            <!-- <div class="form-group">
                                <label class="col-xs-3 m-t-10 required">Add Attendees</label>
                                <div class="col-xs-7">
                                    <div class="checkbox checkbox-info">
                                        <input id="candicate_list" name="candicate_list" value="true"
                                            type="checkbox">
                                        <label for="all-employees">All Candicates</label>
                                    </div>
                                </div>
                            </div> -->
                            <!-- <div class="form-group">
                                <select class="select2 m-b-10 select2-multiple form-control" multiple="multiple" name="candicate_list_options[]">
                                    @foreach($candicate_details as $candicate_detail)
                                    <option value="{{$candicate_detail->candidate_name }}">{{$candicate_detail->candidate_name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger" id="candicate_list_options_error"></div> 

                            </div> -->
                        </div>
                        <div class="form-row mb-3">
                            <div class="col-md-12">
                                <input id="repeat-event" name="repeat" value="yes" type="checkbox">
                                <label for="repeat-event">Repeat</label>
                            </div>
                        </div>
                        <div class="form-row mb-3" id="repeat-fields" style="display: none">
                            <div class="col-xs-6 col-md-4">
                                <label>Repeat Every</label>
                                <input type="number" min="1" value="1" name="repeat_count" class="form-control">
                            </div>
                            <div class="col-xs-6 col-md-4">
                                <label>&nbsp;</label>
                                <select name="repeat_type" id="" class="form-control">
                                    <option value="day">Day</option>
                                    <option value="week">Week</option>
                                    <option value="month">Month</option>
                                    <option value="year">Year</option>
                                </select>
                            </div>
                            <div class="col-xs-6 col-md-4">
                                <label>Cycles <a class="mytooltip" href="javascript:void(0)"> <i class="fa fa-info-circle"></i></a></label>
                                <input type="text" name="repeat_cycles" id="repeat_cycles" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="button">Edit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal Fade End -->
   
</div>
<!-- Container-fluid Ends-->
@endsection

@section('script')
    <script src="../assets/js/jquery.ui.min.js"></script>
    <script src="../assets/js/calendar/moment.min.js"></script>
    <script src="../assets/js/calendar/fullcalendar.min.js"></script>
    <script src="../assets/js/calendar/events.js"></script>    
    <!-- Plugins JS start-->
    <script src="../assets/js/select2/select2.full.min.js"></script>
    <script src="../assets/js/select2/select2-custom.js"></script>
    <script src="../assets/js/chat-menu.js"></script>
    <!-- Plugins JS start-->
    <script src="../assets/js/sweet-alert/sweetalert.min.js"></script>


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
    <script src="../assets/js/select2/select2.full.min.js"></script>
    <script src="../assets/js/select2/select2-custom.js"></script>
    <script src="../assets/js/chat-menu.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="../assets/js/script.js"></script>
    <script src="../assets/js/theme-customizer/customizer.js"></script>
@endsection

