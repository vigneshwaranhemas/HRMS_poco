

      <footer class="footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6 footer-copyright">
              <p class="mb-0">Copyright © {{ date('Y') }}  HRMS. All rights reserved.</p>
            </div>
            <div class="col-md-6">
              <p class="pull-right mb-0">Design & Develop by HEMAS <i class="fa fa-heart"></i></p>
            </div>
          </div>
        </div>
      </footer>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
 <script src="../pro_js/side_bar.js"></script>
 <!-- date formate  -->
 <script src='../assets/js/moment.js'></script>
      <script>
        /*$(document).ready(function (){

         $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });*/
     var get_session_sidebar_link = "{{url('get_session_sidebar')}}";
   </script>