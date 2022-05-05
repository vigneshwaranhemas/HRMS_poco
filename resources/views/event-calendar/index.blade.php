{{-- Divya --}}
@extends(Auth::user()->role_type === 'Admin' ? 'layouts.simple.admin_master' : ( Auth::user()->role_type === 'Buddy'? 'layouts.simple.buddy_master ': ( Auth::user()->role_type === 'Employee'? 'layouts.simple.candidate_master ': ( Auth::user()->role_type === 'HRSS'? 'layouts.simple.hr_master ': ( Auth::user()->role_type === 'IT Infra'? 'layouts.simple.itinfra_master ': ( Auth::user()->role_type === 'Site Admin'? 'layouts.simple.site_admin_master': '' ) ) ) ) ) )
@section('title', 'Calendar Event')

@section('css')

<link rel="stylesheet" type="text/css" href="../assets/css/prism.css">
<!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="../assets/css/calendar.css">
<link rel="stylesheet" type="text/css" href="../assets/css/chartist.css">
<link rel="stylesheet" type="text/css" href="../assets/css/date-picker.css">
<link rel="stylesheet" type="text/css" href="../assets/css/select2.css">
<link rel="stylesheet" type="text/css" href="../assets/css/sweetalert2.css">

@endsection

@section('style')
<style>
#formEventEditModal{
    position: absolute !important;
}
</style>
@endsection

@section('breadcrumb-title')
    <h2>Events</h2>
@endsection

@section('breadcrumb-items')
   {{--<li class="breadcrumb-item">Dashboard</li>
	<li class="breadcrumb-item active">Default</li>--}}
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

    <!-- Modal Fade Start -->
    <!-- Event Add -->
    <div class="modal fade bd-example-modal-lg" id="add-event" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="post" id="event-form-insert" enctype="multipart/form-data">
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
                                <div class="text-danger" id="event_name_error"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="where">Where</label>
                                <input type="text" name="where" id="where" class="form-control">                                
                                <div class="text-danger" id="where_error"></div> 
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col-md-6">
                                <label for="category_name">Category
                                    <a href="javascript:;" id="add_category" class="btn btn-xs btn-primary btn-outline add_category"><i class="fa fa-plus"></i></a>
                                </label>
                                <select class="form-control" id="category_id" name="category_name">  
                                    <option value="">Select Category...</option>                                              
                                </select>
                                <div class="text-danger" id="category_name_sel_error"></div> 
                            </div>
                            <div class="col-md-6">
                                <label for="label_color">Event Type
                                    <a href="javascript:;" id="createEventType" class="btn btn-xs btn-outline btn-primary createEventType"><i class="fa fa-plus"></i></a>
                                </label>
                                <select class="select2 form-control" id="event_type_id" name="event_type">
                                    <option value="">Please Select Event Type</option>
                                </select>
                                <div class="text-danger" id="event_type_sel_error"></div> 
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col-md-6">
                                <label for="file">Event File</label>
                                <input type="file" name="file" class="form-control form-control-sm" id="image-input">
                                <div class="text-danger" id="file_error"></div>
                            </div>                            
                            <div class="col-md-6">
                                <label for="label_color">Color</label>
                                <input type="color" name="label_color" value="#7e37d8" id="colorselector" class="form-control">
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
                            <div class="col-md-2">
                                <label for="repeat-event">Add Attendees</label>
                            </div>
                            <div class="col-md-2">
                                <input id="candicate_list" name="candicate_list" type="checkbox">
                                <label for="candicate_list">All Candicates</label>
                            </div>
                            <div class="col-md-8">
                                <div id="all_filter">
                                    <input id="attendees_all_filter" name="attendees_all_filter" type="checkbox">
                                    <label for="attendees_all_filter" id="attendees_all_filter_label"></label>
                                </div>                               
                            </div>
                            <div class="col-md-6 mb-3">
                                <select class="form-control" id="attendees_filter_op" name="attendees_filter_op">  
                                    <option value="">Select Attendees...</option>                                              
                                    <option value="Gender">Gender</option>                                              
                                    <option value="Department">Department</option>                                              
                                    <option value="Designation">Designation</option>                                              
                                    <option value="Work Location">Work Location</option>                                              
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <select class="form-control attendees_filter" id="gender_filter_option" name="gender_filter_option">  
                                    <option value="">Select Gender...</option>                                              
                                    <option value="Male">Male</option>                                              
                                    <option value="Female">Female</option>                                              
                                </select>
                                <select class="form-control attendees_filter" id="dept_filter_option" name="dept_filter_option">  
                                    <option value="">Select Department...</option> 
                                    @foreach($departments as $department)
                                        <option value="{{ $department->department_name }}">{{ $department->department_name }}</option>
                                    @endforeach    
                                </select>
                                <select class="form-control attendees_filter" id="designation_filter_option" name="designation_filter_option">  
                                    <option value="">Select Designation...</option> 
                                    @foreach($designations as $designation)
                                        <option value="{{ $designation->designation_name }}">{{ $designation->designation_name }}</option>
                                    @endforeach                                             
                                </select>
                                <select class="form-control attendees_filter" id="wfh_filter_option" name="wfh_filter_option">  
                                    <option value="">Select Work Location...</option>                                         
                                    @foreach($locations as $location)
                                        <option value="{{ $location->location_name }}">{{ $location->location_name }}</option>
                                    @endforeach                                                 
                                </select>
                            </div>

                            <div class="col-md-12">
                                <select class="select2 m-b-10 select2-multiple form-control" multiple="multiple" id="candicate_list_options" name="candicate_list_options[]">
                                    
                                </select>
                                <div class="text-danger" id="candicate_list_options_error"></div> 
                            </div>
                            
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
                                <input type="text" value="1" name="repeat_cycles" id="repeat_cycles" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                        <!-- <button class="btn btn-primary" type="button">Save</button> -->
                        <button type="submit" class="btn btn-primary save-event" id="event_insert_db">Submit</button>

                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Event Details Show -->
    <div class="modal fade bd-example-modal-lg" id="eventDetailModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Event Details</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <form>
                @csrf
                    <div class="modal-body">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <h6 class="f-w-700">Event Details</h6>
                                        <p id="event_name_show"></p>
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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h6 class="f-w-700">Attendees</h6>
                                        <p id="attendees_filter_op_show"></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h6 class="f-w-700">Attendees Filter Type</h6>
                                        <p id="attendees_filter_show"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h6 class="f-w-700">Attendees List</h6>
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
                            <p id="event_file_show"></p>
                        </div>
                    </div>
                    @if(Auth::user()->role_type === 'Admin')
                        <div class="modal-footer">
                            <input type="hidden" class="form form-control" id="event_edit_id">
                            <button class="btn btn-dark" type="button" data-dismiss="modal">Close</button>
                            <button class="btn btn-danger delete-event" type="button" onclick="_gaq.push(['_trackEvent', 'example', 'try', 'delete-event']);">Delete</button>
                            <!-- <button class="btn btn-danger delete-event" type="button">Delete</button> -->
                            <button class="btn btn-primary edit-event" type="button">Edit</button>
                        </div> 
                    @endif                    
                </form>
            </div>
        </div>
    </div>

     <!-- /.Sample upload pop up image -->
     <div class="modal fade sample-preview" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">     
            <div class="modal-header" style="border-bottom: 0;">                      
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <img id="sample_view" style="width: 75%; margin-left: 124px;">
            </div>                                            
        </div>
    </div>
    <!-- /.End sample upload pop up image -->
        
    <!-- Event edit -->
    <div class="modal fade bd-example-modal-lg" id="formEventEditModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <form method="post" id="event-form-update" enctype="multipart/form-data">
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
                                <input type="text" name="event_name" id="event_name_edit" class="form-control">
                                <div class="text-danger" id="event_name_edit_error"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="where">Where</label>
                                <input type="text" name="where" id="where_edit" class="form-control">                                
                                <div class="text-danger" id="where_edit_error"></div> 
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col-md-6">
                                <label for="category_name">Category
                                    <a href="javascript:;" id="add_category" class="btn btn-xs btn-primary btn-outline add_category"><i class="fa fa-plus"></i></a>
                                </label>
                                <select class="form-control" id="category_id_edit" name="category_name">  
                                    <option value="">Select Category...</option>                                              
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="label_color">Event Type
                                    <a href="javascript:;" id="createEventType" class="btn btn-xs btn-outline btn-primary createEventType"><i class="fa fa-plus"></i></a>
                                </label>
                                <select class="select2 form-control" id="event_type_id_edit" name="event_type">
                                    <option value="">Please Select Event Type</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col-md-6">
                                <label for="file">Event File</label>
                                <input type="file" name="file" class="form-control form-control-sm" id="image-file-edit">
                                <div id="event_file_edit_show"></div>
                                <div class="text-danger" id="file_edit_error"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="label_color">Color</label>
                                <input type="color" name="label_color" value="#7e37d8" id="label_color_edit" class="form-control">
                            </div>
                            <p id="chosen_file_show"></p>                           
                        </div>
                        <div class="form-row mb-3">
                            <div class="col-md-12">
                                <label for="category_name">Description</label>
                                <textarea name="description" id="description_edit" class="form-control"></textarea>
                                <div class="text-danger" id="description_edit_error"></div> 
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col-xs-6 col-md-3">
                                <label for="category_name">Starts On</label>
                                <input type="date" name="start_date" id="start_date_edit" class="form-control">
                                <div class="text-danger" id="start_date_edit_error"></div> 
                            </div>
                            <div class="col-xs-5 col-md-3">
                                <label>&nbsp;</label>
                                <input type="time" name="start_time" id="start_time_edit"
                                    class="form-control">
                                <div class="text-danger" id="start_time_edit_error"></div> 
                            </div>
                            <div class="col-xs-6 col-md-3">
                                <label for="category_name">Ends On</label>
                                <input type="date" name="end_date" id="end_date_edit" class="form-control">
                                <div class="text-danger" id="end_date_edit_error"></div> 
                            </div>
                            <div class="col-xs-5 col-md-3">
                                <label>&nbsp;</label>
                                <input type="time" name="end_time" id="end_time_edit"
                                    class="form-control">
                                <div class="text-danger" id="end_time_edit_error"></div> 
                            </div>
                        </div>                       
                        <div class="form-row mb-3">
                            <div class="col-md-2">
                                <label for="repeat-event">Add Attendees</label>
                            </div>
                            <div class="col-md-2">
                                <input id="candicate_list_edit" name="candicate_list" value="true" type="checkbox">                                
                                <label for="">All Candicates</label>
                            </div>
                            <div class="col-md-8">
                                <div id="all_filter_edit">
                                    <input id="attendees_all_filter_edit" name="attendees_all_filter" type="checkbox">
                                    <label for="attendees_all_filter" id="attendees_all_filter_label_edit"></label>
                                </div>                               
                            </div>

                            <div class="col-md-6 mb-3">
                                <select class="form-control" id="attendees_filter_op_edit" name="attendees_filter_op">  
                                    <option value="">Select Attendees...</option>                                              
                                    <option value="Gender">Gender</option>                                              
                                    <option value="Department">Department</option>                                              
                                    <option value="Designation">Designation</option>                                              
                                    <option value="Work Location">Work Location</option>                                              
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <select class="form-control attendees_filter_edit" id="gender_filter_option_edit" name="gender_filter_option">  
                                    <option value="">Select Gender...</option>                                              
                                    <option value="Male">Male</option>                                              
                                    <option value="Female">Female</option>                                              
                                </select>
                                <select class="form-control attendees_filter_edit" id="dept_filter_option_edit" name="dept_filter_option">  
                                    <option value="">Select Department...</option>                                              
                                    @foreach($departments as $department)
                                        <option value="{{ $department->department_name }}">{{ $department->department_name }}</option>
                                    @endforeach                                              
                                </select>
                                <select class="form-control attendees_filter_edit" id="designation_filter_option_edit" name="designation_filter_option">  
                                    <option value="">Select Designation...</option>                                              
                                    @foreach($designations as $designation)
                                        <option value="{{ $designation->designation_name }}">{{ $designation->designation_name }}</option>
                                    @endforeach                                    
                                </select>
                                <select class="form-control attendees_filter_edit" id="wfh_filter_option_edit" name="wfh_filter_option">  
                                    <option value="">Select Work Location...</option>                                              
                                    @foreach($locations as $location)
                                        <option value="{{ $location->location_name }}">{{ $location->location_name }}</option>
                                    @endforeach                                                
                                </select>
                            </div>

                            <div class="col-md-12">
                                <select class="select2 m-b-10 select2-multiple form-control" id="candicate_select_op_list_edit" multiple="multiple" name="candicate_list_options_edit[]">                                   
                                </select>
                                <div class="text-danger" id="candicate_list_options_edit_error"></div> 
                            </div>

                        </div>
                        <div class="form-row mb-3">
                            <div class="col-md-12">
                                <input id="repeat-event-edit" name="repeat" value="yes" type="checkbox">
                                <label for="repeat-event">Repeat</label>
                            </div>
                        </div>
                        <div class="form-row mb-3" id="repeat-fields-edit" style="display: none">
                            <div class="col-xs-6 col-md-4">
                                <label>Repeat Every</label>
                                <input type="number" min="1" value="1" id="repeat_count_edit" name="repeat_count" class="form-control">
                            </div>
                            <div class="col-xs-6 col-md-4">
                                <label>&nbsp;</label>
                                <select name="repeat_type" id="repeat_type_edit" class="form-control">
                                    <option value="day">Day</option>
                                    <option value="week">Week</option>
                                    <option value="month">Month</option>
                                    <option value="year">Year</option>
                                </select>
                            </div>
                            <div class="col-xs-6 col-md-4">
                                <label>Cycles <a class="mytooltip" href="javascript:void(0)"> <i class="fa fa-info-circle"></i></a></label>
                                <input type="text" name="repeat_cycles" id="repeat_cycles_edit" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="event_update_id" id="event_update_id" class="form-control">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">Edit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- event delete -->
    <div class="modal fade" id="eventDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form  id="formEventsDelete">
            @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Event Delete</h4>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <h6>Are you sure you want to Delete this Record?</h6>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" id="event_delete_id" class="form-control">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">Delete</button>
                    </div>
                </div>
            </form>
        </div>
   </div> 

    <!-- Add category -->
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
                        <table class="table category-table" class="mb-3" id="goal-tb">
                            <thead>
                                <tr>
                                  <th scope="col">No</th>
                                  <th scope="col">Category Name</th>
                                  <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        
                        <form method="post" action="javascript:void(0)" id="eventCategoryForm">  
                            <div class="form-row mb-3">
                                <div class="col-md-6">
                                    <label for="category_name" style="font-weight: bold;">Add Category Name</label>
                                    <input type="text" name="category_name" id="category_name" class="form-control">
                                    <div class="text-danger" id="category_name_error"></div> 
                                </div>
                            </div>
                            <button class="btn btn-success mt-2 mb-2" type="submit" id="submit_event_category">Save</button>
                        </form>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Add event type -->
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
                        <table class="table event-type-table" class="mb-3" id="goal-tb">
                            <thead>
                                <tr>
                                  <th scope="col">No</th>
                                  <th scope="col">Name</th>
                                  <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>                             
                            </tbody>
                        </table>
                        
                        <form method="post" action="javascript:void(0)" id="eventTypeForm">  
                            <div class="form-row mb-3">
                                <div class="col-md-6">
                                    <label for="event_type" style="font-weight: bold;">Event Type</label>
                                    <input type="text" name="event_type" id="event_type" class="form-control">
                                    <div class="text-danger" id="event_type_error"></div>  
                                </div>
                            </div>
                            <button class="btn btn-success mt-2 mb-2" id="submit_event_type" type="button">Save</button>
                        </form>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
    <!-- <script src="../assets/js/jquery.ui.min.js"></script>
    <script src="../assets/js/calendar/moment.min.js"></script>
    <script src="../assets/js/calendar/fullcalendar.min.js"></script> -->

    @if(Auth::user()->role_type === 'Admin')
      <script src="../assets/js/calendar/admin_events.js"></script>    
    @else
        <script src="../assets/js/calendar/events.js"></script>    
    @endif

    <!-- Plugins JS start-->
    <script src="../assets/js/select2/select2.full.min.js"></script>
    <script src="../assets/js/select2/select2-custom.js"></script>
    <script src="../assets/js/chat-menu.js"></script>
    <!-- Plugins JS start-->
    <script src="../assets/js/sweet-alert/sweetalert.min.js"></script>
    <script src="../assets/js/script.js"></script>
    <script src="../assets/js/theme-customizer/customizer.js"></script>
    <script src="../assets/js/tooltip-init.js"></script>

    <script>
        $(document).ready(function() {
                            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });           

        });

        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });    

        //Hide filter options 
        // $("#gender_filter_option").val(" ");
        // $("#dept_filter_option").val(" ");
        // $("#designation_filter_option").val(" ");
        // $("#wfh_filter_option").val(" ");
        // $("#candicate_list_options").val("");

        $("#gender_filter_option").hide();
        $("#dept_filter_option").hide();
        $("#designation_filter_option").hide();
        $("#wfh_filter_option").hide();
        $("#candicate_list_options").hide();
        $("#all_filter").hide();   

        $("#gender_filter_option_edit").hide();
        $("#dept_filter_option_edit").hide();
        $("#designation_filter_option_edit").hide();
        $("#wfh_filter_option_edit").hide();
        // $("#candicate_list_options_edit").hide();
        $("#all_filter_edit").hide();   

    </script>
@endsection

