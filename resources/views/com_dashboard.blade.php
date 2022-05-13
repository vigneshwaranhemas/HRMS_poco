@extends('layouts.simple.candidate_master')
@section('title', 'Dashboard')

@section('css')
<link rel="stylesheet" type="text/css" href="../assets/css/prism.css">
    <!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="../assets/css/chartist.css">
<link rel="stylesheet" type="text/css" href="../assets/css/date-picker.css">
<link rel="stylesheet" type="text/css" href="../assets/scss/bootstrap/_modal.scss">
<link rel="stylesheet" type="text/css" href="../assets/css/whether-icon.css">
<link rel="stylesheet" type="text/css" href="../assets/css/ionic-icon.css">
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
	<h2>Default<span>Dashboard </span></h2>
@endsection

@section('breadcrumb-items')
   <li class="breadcrumb-item">Dashboard</li>
	<li class="breadcrumb-item active">Default</li>
@endsection

@section('content')
<!-- Container-fluid starts-->
<div class="container-fluid">
   <div class="row">
      <div class="col-lg-12 xl-100">
         <div class="row">
            <div class="col-sm-6 col-xl-3 col-lg-6 box-col-6">
              <div class="card gradient-warning o-hidden">
                <div class="b-r-4 card-body">
                  <div class="media static-top-widget">
                    <div class="align-self-center text-center">
                      <div class="text-white i" data-feather="message-circle"></div>
                    </div>
                    <div class="media-body"><a class="m-0 text-white" href="{{ url('id_card_varification') }}" >ID Card Info</a>
                        {{-- <input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token"> --}}
                     <i class="icon-bg" data-feather="message-circle"></i>
                     <!--  <h4 class="mb-0 counter text-white">893</h4> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-xl-3 col-lg-6 box-col-6">
              <div class="card gradient-info o-hidden">
                <div class="b-r-4 card-body">
                  <div class="media static-top-widget">
                    <div class="align-self-center text-center">
                      <div class="text-white i" data-feather="user-plus"></div>
                    </div>
                    <div class="media-body"><a class="m-0 text-white" href="{{ url('candidate_profile') }}">Profile</a><i class="icon-bg" data-feather="user-plus"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="col-xl-3 xl-50 col-md-6 box-col-6">
               <div class="card gradient-warning o-hidden">
                  <div class="card-body tag-card">
                     <div class="default-chart">
                        <div class="apex-widgets">
                           <div id="area-widget-chart-3"></div>
                        </div>
                        <div class="widgets-bottom">
                           <h5 class="f-w-700 mb-0">Total Stock<span class="pull-right">70 / 100   </span></h5>
                        </div>
                     </div>
                     <span class="tag-hover-effect"><span class="dots-group"><span class="dots dots1"></span><span class="dots dots2 dot-small"></span><span class="dots dots3 dot-small"></span><span class="dots dots4 dot-medium"></span><span class="dots dots5 dot-small"></span><span class="dots dots6 dot-small"></span><span class="dots dots7 dot-small-semi"></span><span class="dots dots8 dot-small-semi"></span><span class="dots dots9 dot-small">     </span></span></span>
                  </div>
               </div>
            </div>
            <div class="col-xl-3 xl-50 col-md-6 box-col-6">
               <div class="card gradient-info o-hidden">
                  <div class="card-body tag-card">
                     <div class="default-chart">
                        <div class="apex-widgets">
                           <div id="area-widget-chart-4"></div>
                        </div>
                        <div class="widgets-bottom">
                           <h5 class="f-w-700 mb-0">Total Value<span class="pull-right">70 / 100   </span></h5>
                        </div>
                     </div>
                     <span class="tag-hover-effect"><span class="dots-group"><span class="dots dots1"></span><span class="dots dots2 dot-small"></span><span class="dots dots3 dot-small"></span><span class="dots dots4 dot-medium"></span><span class="dots dots5 dot-small"></span><span class="dots dots6 dot-small"></span><span class="dots dots7 dot-small-semi"></span><span class="dots dots8 dot-small-semi"></span><span class="dots dots9 dot-small">     </span></span></span>
                  </div>
               </div>
            </div> -->
         </div>
      </div>

      <div class="col-xl-7 xl-90 box-col-12">
         <div class="card">
            <div class="card-header no-border">
               <h5>Today's Birthdays</h5>
               <ul class="creative-dots">
                  <li class="bg-primary big-dot"></li>
                  <li class="bg-secondary semi-big-dot"></li>
                  <li class="bg-warning medium-dot"></li>
                  <li class="bg-info semi-medium-dot"></li>
                  <li class="bg-secondary semi-small-dot"></li>
                  <li class="bg-primary small-dot"></li>
               </ul>
               <div class="card-header-right">
               <i class="icofont icofont-birthday-cake font-primary"  style="font-size: 18px;"></i>
               </div>
            </div>
            <div class="card-body pt-0">
               <ul class="crm-activity" id="tdy_birthday_card_list">
               </ul>
            </div>
         </div>
      </div>
      <div class="col-xl-5 xl-90 box-col-12">
         <div class="card">
            <div class="card-header no-border">
               <h5>Upcoming Holidays</h5>
               <!-- <ul class="creative-dots">
                  <li class="bg-primary big-dot"></li>
                  <li class="bg-secondary semi-big-dot"></li>
                  <li class="bg-warning medium-dot"></li>
                  <li class="bg-info semi-medium-dot"></li>
                  <li class="bg-secondary semi-small-dot"></li>
                  <li class="bg-primary small-dot"></li>
               </ul> -->
               <div class="card-header-right">
                  <ul class="list-unstyled card-option">
                     <li><a href="{{ route('holidays') }}"><i class="icofont icofont-calendar font-primary"></i></a></li>
                  </ul>
               </div>
            </div>
            <div class="card-body pt-0">
               <div class="activity-table table-responsive">
                  <table class="table table-bordernone">
                     <tbody>
                        @foreach($upcoming_holidays as $upcoming_holiday)
                           <tr>
                              <td>
                              <div class="activity-image"><img class="img-fluid" src="../assets/images/dashboard/clipboard.png" alt=""></div>
                              </td>
                              <td>
                              <div class="activity-details">
                                 <h4 class="default-text">{{ date('d', strtotime($upcoming_holiday->date)) }} <span class="f-14">{{ date('M', strtotime($upcoming_holiday->date)) }}</span></h4>
                                 <h6>{{$upcoming_holiday->occassion }}</h6>
                              </div>
                              </td>
                              <td>
                              <button class="btn btn-shadow-primary" onclick="view_holidays({{ $upcoming_holiday->id }})">View</button>
                              </td>
                           </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>

      <div class="col-xl-7 xl-90 box-col-12">
         <div class="card">
            <div class="card-header no-border">
               <h5>Today's Work Anniversary</h5>
               <ul class="creative-dots">
                  <li class="bg-primary big-dot"></li>
                  <li class="bg-secondary semi-big-dot"></li>
                  <li class="bg-warning medium-dot"></li>
                  <li class="bg-info semi-medium-dot"></li>
                  <li class="bg-secondary semi-small-dot"></li>
                  <li class="bg-primary small-dot"></li>
               </ul>
               <div class="card-header-right">
               <i class="icofont icofont-flora-flower font-primary"  style="font-size: 18px;"></i>
               </div>
            </div>
            <div class="card-body pt-0">
               <ul class="crm-activity" id="tdys_work_annu_list">

               </ul>
            </div>
         </div>
      </div>
      <div class="col-xl-5 xl-90 box-col-12">
         <div class="card">
            <div class="card-header no-border">
               <h5>Upcoming Events</h5>
               <!-- <ul class="creative-dots">
                  <li class="bg-primary big-dot"></li>
                  <li class="bg-secondary semi-big-dot"></li>
                  <li class="bg-warning medium-dot"></li>
                  <li class="bg-info semi-medium-dot"></li>
                  <li class="bg-secondary semi-small-dot"></li>
                  <li class="bg-primary small-dot"></li>
               </ul> -->
               <div class="card-header-right">
                  <ul class="list-unstyled card-option">
                     <li><a href="{{ route('events') }}"><i class="icofont icofont-calendar font-primary"></i></a></li>
                  </ul>
               </div>
            </div>
            <div class="card-body pt-0">
               <div class="activity-table table-responsive">
                  <table class="table table-bordernone">
                     <tbody>
                        @foreach($upcoming_events as $upcoming_event)
                           <tr>
                              <td>
                              <div class="activity-image"><img class="img-fluid" src="../assets/images/dashboard/greeting.png" alt=""></div>
                              </td>
                              <td>
                              <div class="activity-details">
                                 <h4 class="default-text">{{ date('d', strtotime($upcoming_event->start_date_time)) }} <span class="f-14">{{ date('M', strtotime($upcoming_event->start_date_time)) }}</span></h4>
                                 <h6>{{$upcoming_event->event_name }}</h6>
                              </div>
                              </td>
                              <td>
                              <button class="btn btn-shadow-primary" onclick="view_events({{ $upcoming_event->id }})">View</button>
                              </td>
                           </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
       <div class="col-xl-4 xl-30 box-col-12">
         <div class="card gradient-secondary o-hidden monthly-overview">
            <div class="card-header no-border bg-transparent">
               <h5>Monthly Overview</h5>
               <h6 class="mb-0">January</h6>
               <span class="pull-right right-badge"><span class="badge badge-pill">70 / 100</span></span>
            </div>
            <div class="card-body p-0">
               <div class="text-bg"><span>0.7</span></div>
               <div class="area-range-apex">
                  <div id="area-range"></div>
               </div>
               <span class="overview-dots full-lg-dots"><span class="dots-group"><span class="dots dots1"></span><span class="dots dots2 dot-small"></span><span class="dots dots3 dot-small"></span><span class="dots dots4 dot-medium"></span><span class="dots dots5 dot-small"></span><span class="dots dots6 dot-small"></span><span class="dots dots7 dot-small-semi"></span><span class="dots dots8 dot-small-semi"></span><span class="dots dots9 dot-small"></span></span></span>
            </div>
         </div>
      </div>
      <div class="col-xl-4 xl-30 box-col-6">
         <div class="card">
            <div class="card-header no-border">
               <h5></h5>
               <ul class="creative-dots">
                  <li class="bg-primary big-dot"></li>
                  <li class="bg-secondary semi-big-dot"></li>
                  <li class="bg-warning medium-dot"></li>
                  <li class="bg-info semi-medium-dot"></li>
                  <li class="bg-secondary semi-small-dot"></li>
                  <li class="bg-primary small-dot"></li>
               </ul>
               <div class="card-header-right">
                  <ul class="list-unstyled card-option">
                     <li><i class="icofont icofont-gear fa fa-spin font-warning"></i></li>
                     <li><i class="view-html fa fa-code font-warning"></i></li>
                     <li><i class="icofont icofont-maximize full-card font-warning"></i></li>
                     <li><i class="icofont icofont-minus minimize-card font-warning"></i></li>
                     <li><i class="icofont icofont-refresh reload-card font-warning"></i></li>
                     <li><i class="icofont icofont-error close-card font-warning"></i></li>
                  </ul>
               </div>
            </div>
            <div class="card-body pb-0 pt-0">
               <div class="music-layer">
                  <button class="btn btn-pill">View More</button>
               </div>
               <div class="code-box-copy">
                  <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#example-head2" title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                  <pre><code class="language-html" id="example-head2">&lt;!-- Cod Box Copy begin --&gt;
&lt;div class="music-layer"&gt;
&lt;button class="btn btn-pill"&gt;
View More&lt;/button&gt;
&lt;!-- Cod Box Copy end --&gt;</code></pre>
               </div>
            </div>
         </div>
      </div>
      <div class="col-xl-4 xl-30 box-col-6">
         <div class="card gradient-primary o-hidden monthly-overview yearly">
            <div class="card-header no-border bg-transparent">
               <h5>Yearly Overview</h5>
               <h6 class="mb-0">Monday</h6>
               <span class="pull-right right-badge"><span class="badge badge-pill">50 / 100</span></span>
            </div>
            <div class="card-body p-0">
               <div class="text-bg"><span>0.5</span></div>
               <div class="area-range-apex">
                  <div id="area-range-1"></div>
               </div>
               <span class="overview-dots full-width-dots"><span class="dots-group"><span class="dots dots1"></span><span class="dots dots2 dot-small"></span><span class="dots dots3 dot-small"></span><span class="dots dots4 dot-medium"></span><span class="dots dots5 dot-small"></span><span class="dots dots6 dot-small"></span><span class="dots dots7 dot-small-semi"></span><span class="dots dots8 dot-small-semi"></span><span class="dots dots9 dot-small"> </span></span></span>
            </div>
         </div>
      </div>

   </div>
</div>

<!-- Modal Fade -->
<div class="modal fade" id="holidaysDetailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                           <p id="occassion_show"></p>
                     </div>
                     <div class="form-group">
                           <h6 class="f-w-700">Description:</h6>
                           <p id="description_show"></p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>
         </div>
      </div>
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
                           <p id="event_description_show"></p>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <h6 class="f-w-700">Attendees</h6>
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
            <button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
   @yield('content')

</div>

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
<script src="../pro_js/side_bar.js"></script>
<script>
      var get_session_sidebar_link = "{{url('get_session_sidebar')}}";

      fetch_tdys_brd_list();
      fetch_tdys_work_annu_list();

      //Today's birthday card
      function fetch_tdys_brd_list(){
         //Get holidays details
         $.ajax({
            url:"fetch_tdys_brd_list",
            type:"GET",
            dataType : "JSON",
            success:function(response)
            {
                  // console.log(response);
                  $("#tdy_birthday_card_list").append('');
                  $("#tdy_birthday_card_list").append(response);

            }

         });
      }

      //Today's work anniversary
      function fetch_tdys_work_annu_list(){
         //Get holidays details
         $.ajax({
            url:"fetch_tdys_work_annu_list",
            type:"GET",
            dataType : "JSON",
            success:function(response)
            {
                  // console.log(response);
                  $("#tdys_work_annu_list").append('');
                  $("#tdys_work_annu_list").append(response);

            }

         });
      }

      function view_holidays(id){
         //Get holidays details
         $.ajax({
            url:"fetch_holidays_list_id",
            type:"GET",
            data : {id: id},
            dataType : "JSON",
            success:function(response)
            {
                  // console.log(response);
                  $("#occassion_show").text('');
                  $("#description_show").text('');
                  $("#occassion_show").append(response[0].occassion);
                  $("#description_show").append(response[0].description);

            }

         });

         $('#holidaysDetailModal').modal('show');
      }

      function view_events(id){

         //Get Attendees list
         $.ajax({
            url:"fetch_event_attendees_show",
            type:"GET",
            data : {id: id},
            dataType : "JSON",
            success:function(response)
            {
                  // console.log(response);
                  $("#candicate_list_show").html(response);

            }

         });

         //Get category list
         $.ajax({
            url:"fetch_event_edit",
            type:"GET",
            data : {id: id},
            dataType : "JSON",
            success:function(response)
            {
                  // console.log(response);
                  var rData = [];
                  rData = response;
                  $.each(rData, function (index, value) {

                     $("#event_name_show").html(value.event_name);
                     $("#where_show").html(value.where);
                     $("#event_description_show").html(value.description);
                     $("#category_name_show").html(value.category_name);
                     $("#event_type_show").html(value.event_type);

                     // var candicate_list = JSON.parse(value.candicate_list);
                     // console.log(candicate_list.length);

                     var start_date_time = value.start_date_time;
                     var split = start_date_time.split(" ");

                     const timeString = split[1];
                     // Prepend any date. Use your birthday.
                     const timeString12hr = new Date('1970-01-01T' + timeString + 'Z')
                     .toLocaleTimeString('en-US',
                        {timeZone:'UTC',hour12:true,hour:'numeric',minute:'numeric'}
                     );

                     // console.log();
                     $("#start_date_show").html(split[0]);
                     $("#start_time_show").html(timeString12hr);

                     var end_date_time = value.end_date_time;
                     var split = end_date_time.split(" ");

                     const timeString_end = split[1];
                     // Prepend any date. Use your birthday.
                     const timeString12hr_end = new Date('1970-01-01T' + timeString_end + 'Z')
                     .toLocaleTimeString('en-US',
                        {timeZone:'UTC',hour12:true,hour:'numeric',minute:'numeric'}
                     );

                     // console.log();
                     $("#end_date_show").html(split[0]);
                     $("#end_time_show").html(timeString12hr_end);

                  });

            }


         });

         $('#eventDetailModal').modal('show');

      }

</script>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$( document ).ready(function() {
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
$(()=>{
    var sess_data=@json(Session::get('session_info'));
    $.ajax({
        url:"{{url('check_user_status')}}",
        type:"POST",
        data:{empID:sess_data['empID']},
        success:function(data){
            var res =JSON.parse(data);
            if(res.hr_action==0 || res.hr_action==3){
                     $("#loadModal1").modal('show');
            }
            else{
                $("#loadModal1").modal('hide');

            }
        }
    })
})
</script>
