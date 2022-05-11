

      <footer class="footer">
        <a href="javascript:;" id="sticky-note-toggle"><i class="pe-7s-file"></i></a>
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6 footer-copyright">
              <p class="mb-0">Copyright © {{ date('Y') }}  HRMS. All rights reserved.</p>
            </div>
            <div class="col-md-6">
              <p class="pull-right mb-0">Design & Develop by HEMAS <i class="fa fa-heart"></i></p>
            </div>
            <div id="footer-sticky-notes" class="row hidden-xs hidden-sm">
                <div class="col-xs-12" id="sticky-note-header">
                    <div class="col-xs-10" style="line-height: 30px">
                    @lang('app.menu.stickyNotes') <a href="javascript:;" onclick="showCreateNoteModal()" class="btn btn-success btn-outline btn-xs m-l-10"><i class="fa fa-plus"></i> @lang("modules.sticky.addNote")</a>
                        </div>
                    <div class="col-xs-2">
                        <a href="javascript:;" class="btn btn-default btn-circle pull-right" id="open-sticky-bar"><i class="fa fa-chevron-up"></i></a>
                        <a style="display: none;" class="btn btn-default btn-circle pull-right" href="javascript:;" id="close-sticky-bar"><i class="fa fa-chevron-down"></i></a>
                    </div>

                </div>

                {{-- <div id="sticky-note-list" style="display: none">

                    @foreach($stickyNotes as $note)
                        <div class="col-md-12 sticky-note" id="stickyBox_{{$note->id}}">
                        <div class="well
                         @if($note->colour == 'red')
                            bg-danger
                         @endif
                         @if($note->colour == 'green')
                            bg-success
                         @endif
                         @if($note->colour == 'yellow')
                            bg-warning
                         @endif
                         @if($note->colour == 'blue')
                            bg-info
                         @endif
                         @if($note->colour == 'purple')
                            bg-purple
                         @endif
                         b-none">
                            <p>{!! nl2br($note->note_text)  !!}</p>
                            <hr>
                            <div class="row font-12">
                                <div class="col-xs-9">
                                    @lang("modules.sticky.lastUpdated"): {{ $note->updated_at->diffForHumans() }}
                                </div>
                                <div class="col-xs-3">
                                    <a href="javascript:;"  onclick="showEditNoteModal({{$note->id}})"><i class="ti-pencil-alt text-white"></i></a>
                                    <a href="javascript:;" class="m-l-5" onclick="deleteSticky({{$note->id}})" ><i class="ti-close text-white"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div> --}}
            </div>
          </div>
        </div>
      </footer>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

 <script src="../pro_js/side_bar.js"></script>
 <!-- date formate  -->
 <script src='../assets/js/moment.js'></script>
      <script>
        $(document).ready(function (){

            $('#sticky-note-toggle').click(function () {
        $('#footer-sticky-notes').toggle();
        $('#sticky-note-toggle').hide();
    })


            // document.body.style.zoom="90%"
            // var browserZoomLevel = Math.round(window.devicePixelRatio * 100);
            // alert(browserZoomLevel)
        //  $.ajaxSetup({
        //     headers: {
        //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
    })
     var get_session_sidebar_link = "{{url('get_session_sidebar')}}";
   </script>
