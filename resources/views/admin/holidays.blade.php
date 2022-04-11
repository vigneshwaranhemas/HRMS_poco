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

@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h2>Holidays</h2>
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

   <!-- Modal Fade Start -->
   <div class="modal fade" id="add-holidays" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <form  id="getNewHolidaysForm">
         @csrf
            <div class="modal-content">
               <div class="modal-header">
                  <h4 class="modal-title" id="myLargeModalLabel">Add Holiday</h4>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
               </div>
               <div class="modal-body">
                  <div class="form-row mb-3">
                        <div class="col-md-6">
                           <label for="event_name">Occasion</label>
                           <input type="text" name="occassion" id="occassion" class="form-control">
                           <div class="text-warning" id="occassion_error"></div>
                        </div>
                  </div>
               </div>
               <div class="modal-footer">
                  <input type="hidden" id="occassion_date" class="form-control" name="occassion_date">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                  <button class="btn btn-primary" type="submit" id="save">Save</button>
               </div>
            </div>
         </form>
      </div>
      </div>
   </div> 

   <div class="modal fade" id="formEventEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <form  id="getNewEventForm">
         @csrf
            <div class="modal-content">
               <div class="modal-header">
                  <h4 class="modal-title" id="myLargeModalLabel">Edit Holiday</h4>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
               </div>
               <div class="modal-body">
                  <div class="form-row mb-3">
                        <div class="col-md-6">
                           <label for="event_name">Holiday</label>
                           <input type="text" name="event_name" id="event_name" class="form-control" value="Tamil New Year">
                           <div class="text-warning" id="event_name_error"></div>
                        </div>
                  </div>
               </div>
               <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                  <button class="btn btn-primary" type="button">Update</button>
               </div>
            </div>
         </form>
      </div>
      </div>
   </div> 

   <div class="modal fade" id="eventDetailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Holiday Details</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
         </div>
         <form>
         @csrf
            <div class="modal-body">
               <div class="form-body">
                     <div class="row">
                        <div class="col-md-12 ">
                           <div class="form-group">
                                 <h6 class="f-w-700">Holiday Title</h6>
                                 <p>Tamil New Year</p>                                 
                                 <p id="event_name_show">                                    
                                 </p>
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

</div>
<!-- Container-fluid Ends-->
@endsection

@section('script')
    <script src="../assets/js/jquery.ui.min.js"></script>
    <script src="../assets/js/calendar/moment.min.js"></script>
    <script src="../assets/js/calendar/fullcalendar.min.js"></script>
    <!-- Plugins JS start-->
    <script src="../assets/js/select2/select2.full.min.js"></script>
    <script src="../assets/js/select2/select2-custom.js"></script>
    <script src="../assets/js/chat-menu.js"></script>
    <!-- Plugins JS start-->
    <script src="../assets/js/sweet-alert/sweetalert.min.js"></script>
    <!-- Custom JS start-->
    <script src="../assets/js/calendar/holidays.js"></script>    

@endsection

