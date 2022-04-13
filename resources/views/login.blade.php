@extends('layouts.app.master')
 @section('title', 'Login')

@section('css')
@endsection

@section('style')
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
                    <div class="col-xl-8 xl-100 box-col-12">
                       <div class="card year-overview">
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
                    <form class="theme-form" id="loginForm" method="post" action="javascript:void(0)">
                      <h4>LOGIN</h4><br>
                      {{ csrf_field() }}
                      <div class="form-group form-row mt-3 mb-0">
                          <div class="col-sm-5">
                           <label class="col-form-label pt-0">Employee ID</label>
                          </div>
                         <div class="col-sm-7">
                            <input class="form-control" name="employee_id" id="employee_id" type="text" required="">
                          </div>
                      </div>
                      <div class="form-group form-row mt-3 mb-0">
                        <div class="col-sm-5"> <label class="col-form-label">Password</label></div>
                         <div class="col-sm-7">
                        <input class="form-control"  name="login_password" id="login_password"  type="password" required=""></div>
                      </div>
                      <div class="form-group form-row mt-3 mb-0">
                        <div class="col-sm-4"></div>
                          <div class="col-sm-4">
                            <button class="btn btn-primary btn-block" id="btnLogin" type="submit">LOGIN</button>
                          </div>
                      </div>
                    </form>
                  </div>
                  <div class="sub-cont">
                    <div class="img">
                      <div class="img__text m--up">
                        <h2>Welcome To HEPL</h2>
                        <!-- <p></p> -->
                      </div>
                      <div class="img__text m--in">
                        <!-- <h2>One of us?</h2>
                        <p>If you already has an account, just sign in. We've missed you!</p> -->
                      </div>
                      <!-- <div class="img__btn"><span class="m--up">Sign up</span><span class="m--in">Sign in</span></div> -->
                    </div>
                    <!-- <div>
                      <form class="theme-form">
                        <h4 class="text-center">NEW USER</h4>
                        <h6 class="text-center">Enter your Username and Password For Signup</h6>
                        <div class="form-row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <input class="form-control" type="text" placeholder="First Name">
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <input class="form-control" type="text" placeholder="Last Name">
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <input class="form-control" type="text" placeholder="User Name">
                        </div>
                        <div class="form-group">
                          <input class="form-control" type="password" placeholder="Password">
                        </div>
                        <div class="form-row">
                          <div class="col-sm-4">
                            <button class="btn btn-primary" type="submit">Sign Up</button>
                          </div>
                          <div class="col-sm-8">
                            {{-- <div class="text-left mt-2 m-l-20">Are you already user?  <a class="btn-link text-capitalize" href="{{ route('login') }}">Login</a></div> --}}
                          </div>
                        </div>
                        <div class="form-divider"></div>
                        <div class="social mt-3">
                          <div class="form-row btn-showcase">
                            <div class="col-sm-4">
                              <button class="btn social-btn btn-fb">Facebook</button>
                            </div>
                            <div class="col-sm-4">
                              <button class="btn social-btn btn-twitter">Twitter</button>
                            </div>
                            <div class="col-sm-4">
                              <button class="btn social-btn btn-google">Google +</button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
          </div>
        </div>
     </div>
  </div>
</div>
<!-- login page end-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

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

    var login_check_process_link = "{{url('login_check_process')}}";
</script>
 @endsection

@section('script')

@endsection
