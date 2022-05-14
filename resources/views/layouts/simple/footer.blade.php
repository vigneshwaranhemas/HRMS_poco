
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
</style>
      <footer class="footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-4 footer-copyright">
              <p class="mb-0">Copyright © {{ date('Y') }}  HRMS. All rights reserved.</p>
            </div>


            <div class="col-md-4">
              <p class="pull-right mb-0">Design & Develop by HEMAS <i class="fa fa-heart"></i></p>
                {{-- <div class="note">
                    <a href="javascript:;" title="sticky-note" data-toggle="modal" data-original-title="test" data-target="#exampleModal"><i class="pe-7s-note" style="font-size: 22px; border: 1px solid; padding: 0.5rem 0.5rem 0.5rem 0.5rem;"></i></a>
                </div> --}}

            </div>
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
<script src="../pro_js/side_bar.js"></script>
 <!-- date formate  -->
 <script src='../assets/js/moment.js'></script>
      <script>


     var get_session_sidebar_link = "{{url('get_session_sidebar')}}";

    //  $("#collapseicon1").collapse({
    //     toggle: true,
    //     direction: "up"
    //  });
   </script>
