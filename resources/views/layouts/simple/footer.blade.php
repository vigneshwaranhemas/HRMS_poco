
<style>
    #footer-sticky-notes {
  border-radius: 8px 8px 0 0;
}
#footer-sticky-notes {
  right: 37px;
  background: rgba(0, 0, 0, 0.80);
    background-color: rgba(0, 0, 0, 0.8);
    background-position-x: 0%;
    background-position-y: 0%;
    background-repeat: repeat;
    background-attachment: scroll;
    background-image: none;
    background-size: auto;
    background-origin: padding-box;
    background-clip: border-box;
  bottom: 0;
  position: fixed;
  width: 300px;
  z-index: 3;
  display: none;
}

.foot {
    border-top: 1px solid #999999;
    position:fixed;
    width: 600px;
    z-index: 10000;
    text-align:center;
    height: 500px;
    font-size:18px;
    color: #000;
    background: red;
    display: flex;
    justify-content: center; /* align horizontal */
    border-top-left-radius:20px;
    border-top-right-radius:20px;
    right: 0;
    left: 0;
    margin-right: auto;
    margin-left: auto;
    bottom: -575px;
}

.slide-up
{
    bottom: 0px !important;
}

.slide-down
{
    bottom: -475px !important;
}
#sticky-note-header {
  padding: 10px;
  color: #ffffff;
  border-bottom: 1px solid #ccc;
}

    .default-according
    {
        width: 283px;
        padding: 1rem 1rem 0rem 3rem;
        margin-top: -27px;
        margin-bottom: -12px;
    }
    .default-according .card .card-header i
    {
        position: inherit !important;
    }
    #sticky-note-toggle {
  position: fixed;
  bottom: 0;
  right: 40px;
  padding: 10px 15px;
  background: #fbfbfb;
  border: 1px solid #c3c3c3;
  border-radius: 5px 5px 0 0;
  color: #000000;
  opacity: 0.8;
  z-index: 3;
}
a{
    text-decoration: none;
}

.btn-circle {
  border-radius: 15px;
}
.btn-circle {
  width: 30px;
  height: 30px;
  padding: 6px 0;
  border-radius: 15px;
  text-align: center;
  font-size: 12px;
  line-height: 1.428571429;
}
.btn-default, .btn-default.disabled {
  background: #e4e7ea;
  border: 1px solid #e4e7ea;
}
.pull-right {
  float: right !important;
}
col-xs-9 {
    width: 75%;
}
</style>
      <footer class="footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6 footer-copyright">
                <a href="javascript:;" id="sticky-note-toggle"><i class="fa fa-sticky-note-o"></i></a>
                {{-- <button type="button" class="btn btn-success" style="float: right;margin-right: -538px;">AddItem</button> --}}
              {{-- <p class="mb-0">Copyright © {{ date('Y') }}  HRMS. All rights reserved.</p> --}}
            </div>
            <div class="col-md-6">
              {{-- <p class="pull-right mb-0">Design & Developed by HEMAS <i class="fa fa-heart"></i></p> --}}
            </div>
          </div>
        </div>

        <div id="footer-sticky-notes" class="row hidden-xs hidden-sm">
            <div class="col-xs-12" id="sticky-note-header">
                <div class="col-xs-10" style="line-height: 30px">
                stickyNotes <a href="javascript:;" onclick="showCreateNoteModal()" class="btn btn-success btn-outline btn-xs m-l-10"><i class="fa fa-plus"></i> addNote </a>
                <a href="javascript:;" class="btn btn-default btn-circle pull-right" id="open-sticky-bar"><i class="fa fa-chevron-up"></i></a>
                <a style="display: none;" class="btn btn-default btn-circle pull-right" href="javascript:;" id="close-sticky-bar"><i class="fa fa-chevron-down"></i></a>
                </div>
                {{-- <div class="col-xs-2">
                    <a href="javascript:;" class="btn btn-default btn-circle pull-right" id="open-sticky-bar"><i class="fa fa-chevron-up"></i></a>
                    <a style="display: none;" class="btn btn-default btn-circle pull-right" href="javascript:;" id="close-sticky-bar"><i class="fa fa-chevron-down"></i></a>
                </div> --}}

            </div>

            <div id="sticky-note-list" style="display: none">

                {{-- @foreach($stickyNotes as $note) --}}
                    {{-- <div class="col-md-12 sticky-note" id="stickyBox">
                        <div class="well bg-danger b-none">
                        <p>verification success</p>
                        <hr>
                        <div class="row font-12">
                            <div class="col-xs-9">
                                Updated:  2minutes ago
                            </div>
                            <div class="col-xs-3">
                                <a href="javascript:;"  onclick="showEditNoteModal('1')"><i class="ti-pencil-alt text-white"></i></a>
                                <a href="javascript:;" class="m-l-5" onclick="deleteSticky(1)" ><i class="ti-close text-white"></i></a>
                            </div>
                        </div>
                    </div> --}}

                    <div id="stickyBox" class="col-md-12 sticky-note" style="margin-top: 12px;">
                        <div class="well bg-info b-none">
                            <p style="padding-top: 24px; margin-left: 24px;">test <br>
                                sdfjsd<br>
                                sdfjldsf<br>
                                sdndsflsdf<br>
                                sdfnsdkfnsdf<br>
                                sdfn</p>
                            <hr>
                            <div class="row font-12">

                                <div class="col-xs-9" style="margin-left: 39px;margin-bottom: 17px;">
                                    Updated: 5 days ago
                                </div><div class="col-xs-3">
                                    <a href="javascript:;" onclick="showEditNoteModal(3)"><i class="ti-pencil-alt text-white"></i></a>
                                    <a href="javascript:;" class="m-l-5" onclick="deleteSticky(3)"><i class="ti-close text-white"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="stickyBox" class="col-md-12 sticky-note" style="margin-top: 12px;">
                        <div class="well bg-warning b-none">
                            <p style="padding-top: 24px; margin-left: 24px;">test <br>
                                sdfjsd<br>
                                sdfjldsf<br>
                                sdndsflsdf<br>
                                sdfnsdkfnsdf<br>
                                sdfn</p>
                            <hr>
                            <div class="row font-12">

                                <div class="col-xs-9" style="margin-left: 39px;margin-bottom: 17px;">
                                    Updated: 5 days ago
                                </div><div class="col-xs-3">
                                    <a href="javascript:;" onclick="showEditNoteModal(3)"><i class="ti-pencil-alt text-white"></i></a>
                                    <a href="javascript:;" class="m-l-5" onclick="deleteSticky(3)"><i class="ti-close text-white"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                {{-- @endforeach --}}

            </div>
        </div>


      </footer>



<script type="text/javascript">
    $(document).ready(function() {
  $('.fooot').click(function() {
      if($('.foot').hasClass('slide-up')) {
        $('.foot').addClass('slide-down', 1000, 'easeOutBounce');
        $('.foot').removeClass('slide-up');
      } else {
        $('.foot').removeClass('slide-down');
        $('.foot').addClass('slide-up', 1000, 'easeOutBounce');
      }
  });
});

</script>




 <div class="foot">

    <div id="footer-sticky-notes" class="row hidden-xs hidden-sm">
        <div class="col-xs-12" id="sticky-note-header">
            <div class="col-xs-10" style="line-height: 30px">
            Sticky Notes <a href="javascript:;"  class="btn btn-success btn-outline btn-xs m-l-10 fooot"><i class="fa fa-plus"></i> Add Note</a>
                </div>
            <div class="col-xs-2">
                <a href="javascript:;" class="btn btn-default btn-circle pull-right" id="open-sticky-bar"><i class="fa fa-chevron-up"></i></a>
                <a style="display: none;" class="btn btn-default btn-circle pull-right" href="javascript:;" id="close-sticky-bar"><i class="fa fa-chevron-down"></i></a>
            </div>

        </div>


    </div>


</div>





<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="{{asset('pro_js/side_bar.js')}}"></script>
 <!-- date formate  -->
 <script src='{{asset('assets/js/moment.js')}}'></script>
      <script>
     var get_session_sidebar_link = "{{url('get_session_sidebar')}}";
     $('#sticky-note-toggle').click(function () {
        $('#footer-sticky-notes').toggle();
        $('#sticky-note-toggle').hide();

    })

    var stickyNoteOpen = $('#open-sticky-bar');
    var stickyNoteClose = $('#close-sticky-bar');
    var stickyNotes = $('#footer-sticky-notes');
    // alert(document.documentElement.clientHeight)
    // console.log(window.innerHeight)
    var viewportHeight = Math.max(718, 718 || 0);
    var stickyNoteHeaderHeight = stickyNotes.height();

    $('#sticky-note-list').css('max-height', viewportHeight-150);

    stickyNoteOpen.click(function () {
        $('#sticky-note-list').toggle(function () {
            $(this).animate({
                height: (viewportHeight-150)
            })
        });
        stickyNoteClose.toggle();
        stickyNoteOpen.toggle();
    })

    stickyNoteClose.click(function () {
        $('#sticky-note-list').toggle(function () {
            $(this).animate({
                height: 0
            })
        });
        stickyNoteOpen.toggle();
        stickyNoteClose.toggle();
    })



    $('body').on('click', '.right-side-toggle', function () {
        $(".right-sidebar").slideDown(50).removeClass("shw-rside");
    })



   </script>
