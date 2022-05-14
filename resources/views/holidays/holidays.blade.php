{{-- Divya --}}
@extends(Auth::user()->role_type === 'Admin' ? 'layouts.simple.admin_master' : ( Auth::user()->role_type === 'Buddy'? 'layouts.simple.buddy_master ': ( Auth::user()->role_type === 'Employee'? 'layouts.simple.candidate_master ': ( Auth::user()->role_type === 'HR'? 'layouts.simple.hr_master ': ( Auth::user()->role_type === 'IT Infra'? 'layouts.simple.itinfra_master ': ( Auth::user()->role_type === 'Site Admin'? 'layouts.simple.site_admin_master': '' ) ) ) ) ) )
@section('title', 'Holidays')

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
/* .fc-widget-header{
   width: 143.2px !important;
}
.fc-resizable{
   max-width: fit-content;
} */

/* Multi Select2 */
.select2-container--default.select2-container--focus .select2-selection--multiple {
    border: solid #b3d7ff 3px !important;
    outline: 0;
}
.selection .select2-selection{
   font-family: work-Sans,sans-serif;
   border-radius: 0 !important;
}   
.select2-container--default .select2-selection--multiple {
    background-color: white;
    border: 1px solid #ced4da;
    border-radius: 4px;
    cursor: text;
}

</style>
@endsection

@section('breadcrumb-title')
    <h2>Holidays</h2>
@endsection

@section('breadcrumb-items')
   {{--<li class="breadcrumb-item">Dashboard</li>
	<li class="breadcrumb-item active">Default</li>--}}
   <select class="js-example-basic-single col-sm-12"  id="holidays_state_filter" name="holidays_state_filter">
      <option value="">Select State...</option>
      @foreach($stateList as $state)
         <option value="{{ $state->state_name }}">{{ $state->state_name }}</option>
      @endforeach
   </select>
   
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
                              <div class="row">
                                 <div class="col-md-3">
                                    <div class="lnb-calendars" id="lnb-calendars">
                                       <div>
                                          <div class="lnb-calendars-item">
                                             <label>
                                                <input class="tui-full-calendar-checkbox-square" type="checkbox" value="all" checked="" data-original-title="" title=""><span></span><strong>View all</strong>
                                             </label>
                                          </div>
                                       </div>

                                       <div class="lnb-calendars-d1" id="calendarList">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-md-9">
                                    <div id="cal-basic"></div>
                                 </div>
                              </div>
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
         <form method="post" id="holidays-form-insert" enctype="multipart/form-data">
         <!-- <form  id="getNewHolidaysForm"> -->
         @csrf
            <div class="modal-content">
               <div class="modal-header">
                  <h4 class="modal-title" id="myLargeModalLabel">Holiday Add</h4>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
               </div>
               <div class="modal-body">
                  <div class="form-row mb-3">
                     <div class="col-md-12">
                        <label for="occassion">Occassion:</label>
                        <input type="text" name="occassion" id="occassion" class="form-control">
                        <div class="text-danger" id="occassion_error"></div>
                     </div>
                  </div>
                  <div class="form-row mb-3">
                     <div class="col-md-12">
                        <label for="description">Description:</label>
                        <textarea type="text" name="description" id="description" class="form-control"></textarea>
                        <div class="text-danger" id="description_error"></div>
                     </div>
                  </div>
                  <div class="form-row mb-3">
                     <div class="col-md-3">
                        <label for="repeat-event">State:</label>
                     </div>
                     <div class="col-md-9">
                        <input id="all_state" name="all_state" value="true" type="checkbox">                                
                        <label for="">All State</label>
                     </div>

                     <div class="col-md-12">
                        <select class="js-example-basic-multiple col-sm-12 form-control js-example-basic-multiple-state" id="state" name="state[]"  style="width:100%" multiple="multiple">
                           <option value="" disabled>Select State...</option>
                           @foreach($stateList as $state)
                              <option value="{{ $state->state_name }}">{{ $state->state_name }}</option>
                           @endforeach
                        </select>
                        <div class="text-danger" id="state_error"></div>
                     </div>
                     
                  </div>    
                  <div class="form-row mb-3">
                     <div class="col-md-12">
                        <label for="occassion_file">File:</label>
                        <input type="file" name="occassion_file" id="occassion_file" class="form-control">
                        <div class="text-danger" id="occassion_file_error"></div>
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

   <div class="modal fade" id="formHolidaysEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <form  id="updateHolidaysForm">
         @csrf
            <div class="modal-content">
               <div class="modal-header">
                  <h4 class="modal-title" id="myLargeModalLabel">Holiday Edit</h4>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
               </div>
               <div class="modal-body">
                  <div class="form-group">
                     <label class="col-form-label" for="occassion_edit">Occassion:</label>
                     <input type="text" name="occassion" id="occassion_edit" class="form-control">
                     <div class="text-danger" id="occassion_error"></div>
                  </div>
                  <div class="form-group">
                     <label class="col-form-label" for="description_edit">Description:</label>
                     <textarea class="form-control" name="description" id="description_edit"></textarea>
                  </div>                            
                  <div class="form-row mb-3">
                     <div class="col-md-3">
                        <label for="repeat-event">State:</label>
                     </div>
                     <div class="col-md-9">
                        <input id="all_state_edit" name="all_state" value="true" type="checkbox">                                
                        <label for="">All State</label>
                     </div>

                     <div class="col-md-12">
                        <select class="js-example-basic-multiple col-sm-12 form-control" id="state_edit" name="state[]" style="width:100%" multiple="multiple">                           
                        </select>
                        <!-- <select class="select2 form-control"   multiple="multiple">                           
                        </select>    -->
                        <div class="text-danger" id="state_error"></div>
                     </div>
                     
                  </div>  

                  <!-- </div>
                  <div class="form-group">
                     <label class="col-form-label" for="description_edit">State:</label>
                     <select class="select2 form-control" id="state_edit" name="state_edit">
                     </select>
                     <div class="text-danger" id="state_edit_error"></div>
                  </div> -->
                  <div class="form-group">
                     <label class="col-form-label" for="occassion_file_edit">File:</label>
                     <input type="file" name="occassion_file" id="occassion_file_edit" class="form-control">
                     <p class="mt-2" id="occassion_file_edit_show"></p>
                  </div>
               </div>
               <div class="modal-footer">
                  <input type="hidden" name="id" id="holidays_edit_id" class="form-control">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                  <button class="btn btn-primary" type="submit">Update</button>
               </div>
            </div>
         </form>
      </div>
      </div>
   </div>

   <div class="modal fade" id="holidaysDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <form  id="formHolidaysDelete">
         @csrf
            <div class="modal-content">
               <div class="modal-header">
                  <h4 class="modal-title" id="myLargeModalLabel">Holiday Delete</h4>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
               </div>
               <div class="modal-body">
                  <h6>Are you sure you want to Delete this Record?</h6>
               </div>
               <div class="modal-footer">
                  <input type="hidden" name="id" id="holidays_delete_id" class="form-control">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                  <button class="btn btn-primary" type="submit">Delete</button>
               </div>
            </div>
         </form>
      </div>
      </div>
   </div>

   <div class="modal fade" id="holidaysDetailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                              <h6 class="f-w-700">Occassion:</h6>
                              <p id="occassion_show"></p>
                        </div>
                        <div class="form-group">
                              <h6 class="f-w-700">Description:</h6>
                              <p id="description_show"></p>
                        </div>
                        <div class="form-group">
                              <h6 class="f-w-700">State:</h6>
                              <p id="state_show"></p>
                        </div>
                        <div class="form-group">
                              <p id="occassion_file_show"></p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <input type="hidden" class="form form-control" id="holidays_show_id">
               <button class="btn btn-dark" type="button" data-dismiss="modal">Close</button>
               <button class="btn btn-danger delete-holidays" type="button" onclick="_gaq.push(['_trackEvent', 'example', 'try', 'delete-event']);">Delete</button>
               <!-- <button class="btn btn-danger delete-event" type="button">Delete</button> -->
               <button class="btn btn-primary edit-holidays" type="button">Edit</button>
            </div>
         </form>
      </div>
      </div>
   </div>

   <div class="modal fade" id="holidaysDetailModalList" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Holiday Details</h5>
               <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
               <div class="form-body">
                  <div class="row">
                     <div class="col-md-12 ">
                        <div class="form-group">
                           <h6 class="f-w-700">Occassion:</h6>
                           <p id="occassion_show_list"></p>
                        </div>
                        <div class="form-group">
                           <h6 class="f-w-700">Description:</h6>
                           <p id="description_show_list"></p>
                        </div>
                        <div class="form-group">
                           <h6 class="f-w-700">State:</h6>
                           <p id="state_show_list"></p>
                        </div>
                        <div class="form-group">
                           <p id="occassion_file_show_list"></p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

</div>
<!-- Container-fluid Ends-->
@endsection

@section('script')
   <!-- <script src="../assets/js/jquery.ui.min.js"></script>
   <script src="../assets/js/calendar/moment.min.js"></script>
   <script src="../assets/js/calendar/fullcalendar.min.js"></script> -->
   <!-- Plugins JS start-->

   <script src="../assets/js/select2/select2.full.min.js"></script>

   <script src="../assets/js/select2/select2-custom.js"></script>
   <script src="../assets/js/chat-menu.js"></script>
   <!-- Plugins JS start-->
   <!-- <script src="https://fullcalendar.io/releases/fullcalendar/3.9.0/lib/moment.min.js"></script>
   <script src="https://fullcalendar.io/releases/fullcalendar/3.9.0/lib/jquery.min.js"></script>
   <script src="https://fullcalendar.io/releases/fullcalendar/3.9.0/fullcalendar.min.js"></script>
   <script src="https://fullcalendar.io/releases/fullcalendar-scheduler/1.9.4/scheduler.min.js"></script> -->

   <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

   <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->
   <!-- Custom JS start-->

   <!-- Plugins JS start-->
   <!-- <script src="../assets/js/select2/select2.full.min.js"></script>
   <script src="../assets/js/select2/select2-custom.js"></script> -->
   
   @if(Auth::user()->role_type === 'Admin')
      <script src="../assets/js/calendar/admin_holidays.js"></script>
   @else
      <script src="../assets/js/calendar/holidays.js"></script>
   @endif

   <script>
      $(document).ready(function() {
         // $('.js-example-basic-multiple').select2();
      });

   </script>

@endsection

