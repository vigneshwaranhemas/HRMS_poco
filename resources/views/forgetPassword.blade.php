@extends('layouts.app.master')
 @section('title', 'Login')

@section('css')
<!-- tost css -->
@endsection
<link rel="stylesheet" href="../assets/toastify/toastify.css">

@section('style')
<style>
  .authentication-main .auth-innerright .card-body .theme-form{
    /* width: 500px !important; */
    width: 336px !important;
  }

  @media only screen and (max-width: 991px){
    .authentication-main .auth-innerright .card-body .theme-form{
      width: 100% !important;
      padding: 20px;
      /* margin-left: -20px; */
    }
  }

  @media only screen and (max-width: 425px){
    .responsive_top{
      margin-top: -130px;
    }
  }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')
<!-- login page start-->
<div class="container-fluid p-0">
  <div class="authentication-main">
    <div class="row">
      <div class="col-md-12">
        <div class="auth-innerright">
          <div class="authentication-box">
            <div class="card-body p-0">
              <div class="cont text-center">
                <div>
                    <div class="card year-overview">
                      <div class="row">
                        <div class="col-xl-1 col-lg-1 col-1">
                          <div class="card-header no-border d-flex">
                            <ul class="creative-dots">
                              <li class="bg-primary big-dot"></li>
                              <li class="bg-secondary semi-big-dot"></li>
                              <li class="bg-warning medium-dot"></li>
                              <li class="bg-info semi-medium-dot"></li>
                              <li class="bg-secondary semi-small-dot"></li>
                              <li class="bg-primary small-dot"></li>
                            </ul>
                          </div>
                        </div>
                          <form class="theme-form mt-5 mb-5" id="forgot_pass" method="post" action="javascript:void(0)">
                            <h4>Forget Password</h4><br>
                            {{ csrf_field() }}
                            <div class="form-group form-row mt-3 mb-0">
                              <div class="col-sm-5"><label class="col-form-label pt-0">Employee ID</label></div>
                              <div class="col-sm-7">
                                <input class="form-control" name="employee_id" id="employee_id" type="text" onfocusout="getEmpemail()">
                                <span class="text-danger color-hider" id="employee_id_error" style="display:none;color: red;"></span>
                              </div>
                            </div>
                            <div class="form-group form-row mt-3 mb-0">
                              <div class="col-sm-5"> <label class="col-form-label pt-0">Email</label></div>
                              <div class="col-sm-7">
                              <input class="form-control"  name="emp_email" id="emp_email"  type="email" >
                              <span class="text-danger color-hider" id="emp_email_error" style="display:none;color: red;"></span>
                              </div>
                            </div>
                            <div class="form-group form-row mt-3 mb-0">
                              <div class="col-sm-4"></div>
                              <div class="col-sm-4">
                                <button class="btn btn-primary btn-block" id="forgot_pass_but" type="submit">Submit</button>
                              </div>
                            </div>
                          </form>
                       
                      </div>
                    </div>
                  </div>
                </div>
              </div>
        <!-- </div> -->
      </div>
    </div>
  </div>
</div>
<!-- login page end-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<!-- toast js -->
<script src="../assets/toastify/toastify.js"></script>

<script src="../pro_js/jquery/jquery.min.js"></script>
<script src="../pro_js/login.js"></script>
<script type="text/javascript">

    $( document ).ready(function() {
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        });

    var forgot_pass_process_link = "{{url('forgot_pass_process')}}";
    var getemail_process_link = "{{url('getemail_process')}}";

</script>

 @endsection

@section('script')

@endsection
