@extends('layouts.simple.candidate_master')
@section('title', 'User Profile')

@section('css')
<link rel="stylesheet" type="text/css" href="../assets/css/photoswipe.css">
<link rel="stylesheet" type="text/css" href="../assets/css/croppie.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>

@endsection

@section('style')
<style type="text/css">
img.test {
display: block;
max-width: 100%;
}
.preview {
overflow: hidden;
width: 160px; 
height: 160px;
margin: 10px;
border: 1px solid red;
}
.modal-lg{
max-width: 1000px !important;
}
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('breadcrumb-title')
  <h2>User<span>Profile</span></h2>
@endsection

@section('breadcrumb-items')
  <li class="breadcrumb-item">Apps</li>
    <li class="breadcrumb-item">Profile</li>
  <li class="breadcrumb-item active">My Profile</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="user-profile">
      <div class="row">
         <!-- user profile first-style start-->
         <div class="col-sm-12">
            <div class="card hovercard text-center">
               <div class="img-container">
                  <div class="icon-wrapper"><i class="icofont icofont-pencil-alt-5" data-toggle="modal" data-original-title="test" data-target="#profile_banner"></i></div>
                  <div class="my-gallery" id="aniimated-thumbnials" itemscope="">
                     <figure itemprop="associatedMedia" itemscope="">
                        <a href="../assets/images/other-images/profile-style-img3.png" itemprop="contentUrl" data-size="1600x950"><img class="img-fluid rounded" src="../assets/images/other-images/profile-style-img3.png" itemprop="thumbnail" alt="gallery"></a>
                     </figure>
                  </div>
               </div>
               <div class="user-image">
                  <div class="avatar"><img alt="" src="../assets/images/user/7.jpg"></div>
                  <div class="icon-wrapper"><i class="icofont icofont-pencil-alt-5" data-toggle="modal" data-original-title="test" data-target="#profile_image"></i></div>
               </div>
               <div class="info">
                  <div class="row">
                     <div class="col-sm-6 col-lg-4 order-sm-1 order-xl-0">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="ttl-info text-left">
                                 <h6><i class="fa fa-envelope"></i>   Email</h6>
                                 <span>Marekjecno@yahoo.com</span>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="ttl-info text-left">
                                 <h6><i class="fa fa-calendar"></i>   BOD</h6>
                                 <span>02 January 1990</span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-12 col-lg-4 order-sm-0 order-xl-1">
                        <div class="user-designation">
                           <div class="title"><a target="_blank" href="">KUMAR</a></div>
                           <div class="desc mt-2">designer</div>
                        </div>
                     </div>
                     <div class="col-sm-6 col-lg-4 order-sm-2 order-xl-2">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="ttl-info text-left">
                                 <h6><i class="fa fa-phone"></i>   Contact Us</h6>
                                 <span>India +91 123-456-7890</span>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="ttl-info text-left">
                                 <h6><i class="fa fa-location-arrow"></i>   Location</h6>
                                 <span>B69 Near School Demo Home</span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- user profile first-style end-->
         <!-- user profile second-style start-->
         <div class="card shadow-lg p-3 mb-5 bg-white rounded">
               <svg x="0" y="0" viewBox="0 0 360 220">
                  <g>
                     <path fill="#7e37d8" d="M0.732,193.75c0,0,29.706,28.572,43.736-4.512c12.976-30.599,37.005-27.589,44.983-7.061                                          c8.09,20.815,22.83,41.034,48.324,27.781c21.875-11.372,46.499,4.066,49.155,5.591c6.242,3.586,28.729,7.626,38.246-14.243                                          s27.202-37.185,46.917-8.488c19.715,28.693,38.687,13.116,46.502,4.832c7.817-8.282,27.386-15.906,41.405,6.294V0H0.48                                          L0.732,193.75z"></path>
                  </g>
                  <text transform="matrix(1 0 0 1 69.7256 116.2686)" fill="#fff" font-size="30">KUMAR</text>
               </svg>
               <div class="col-sm-3 tabs-responsive-side">

                  <br>
                  <div class="nav flex-column nav-pills nav-material nav-left text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                     <a class="nav-link active" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</a>
                     <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Contact</a>
                     <a class="nav-link" id="v-pills-Working-Information-tab" data-toggle="pill" href="#v-pills-Working-Information" role="tab" aria-controls="v-pills-Working-Information" aria-selected="false">Working Information</a>
                     <a class="nav-link" id="v-pills-Information-tab" data-toggle="pill" href="#v-pills-Information" role="tab" aria-controls="v-pills-Information" aria-selected="false">HR Information</a>
                     <a class="nav-link" id="v-pills-Account-information-tab" data-toggle="pill" href="#v-pills-Account-information" role="tab" aria-controls="v-pills-Account-information" aria-selected="false">Account information</a>
                     <a class="nav-link" id="v-pills-Education-tab" data-toggle="pill" href="#v-pills-Education" role="tab" aria-controls="v-pills-Education" aria-selected="false">Education</a>
                     <a class="nav-link" id="v-pills-Experience-tab" data-toggle="pill" href="#v-pills-Experience" role="tab" aria-controls="v-pills-Experience" aria-selected="false">Experience</a>
                     <a class="nav-link" id="v-pills-Documents-tab" data-toggle="pill" href="#v-pills-Documents" role="tab" aria-controls="v-pills-Documents" aria-selected="false">Other Documents</a>
                     <a class="nav-link" id="v-pills-Family-tab" data-toggle="pill" href="#v-pills-Family" role="tab" aria-controls="v-pills-Family" aria-selected="false">Family</a>
                     
                  </div>
                  <br>
               </div>

         </div>
         <div class="card col-xl-9 shadow-lg p-3 mb-5 bg-white rounded">
            <div class="col-sm-12">
               <!-- profile -->
               <div class="tab-content" id="v-pills-tabContent">
                  <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                     <nav class="navbar navbar-light bg-primary rounded">
                       <span class="navbar-brand mb-0 h1">Profile</span>
                     </nav>
                     <div class="container-fluid">
                        <div class="row">
                           <div class="col-sm-12 col-xl-12">
                              <div class="card" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);">
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
                                 <div class="card-body rounded">
                                    <div class="row">
                                       <div class="col-md-6">
                                          <div> <strong>Name : </strong>  Kumar</div><hr>
                                          <div> <strong>Gender : </strong> Male</div><hr>
                                          <div> <strong>Marital Status : </strong> Single</div><hr>
                                       </div>
                                       <div class="col-md-6">
                                          <div> <strong>Blood Group : </strong> A++
                                          </div><hr>
                                          <div> <strong>Date of Birth :</strong> 11-05-1994
                                          </div><hr>
                                          <div> <strong>Roll of Intake : </strong>  HEPL
                                          </div><hr>
                                       </div>
                                    </div>

                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               <!-- contact -->
               <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                    <nav class="navbar navbar-light bg-primary rounded">
                       <span class="navbar-brand mb-0 h1">Contant</span>
                     </nav>
                  <div class="container-fluid">
                     <div class="row">
                        <div class="col-sm-12 col-xl-12">
                           <div class="card" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);">
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
                              <div class="card-body rounded">
                                 <div class="row">
                                    <div class="col-md-6">
                                       <div><strong>Phone Number :</strong> 987654321</div><hr>
                                       <div><strong>Secondary Number :</strong>987654321</div><hr>
                                       <div><strong>Personal Email :</strong> mariacotton@example.com</div><hr>
                                       <div><strong>State :</strong> Tamil Nadu</div><hr>
                                    </div>
                                    <div class="col-md-6">
                                       <div><strong>Permanent Address :</strong>465 - KALIYAMMAN KOIL STREET, SANDRORPALAYAM, CUDDALORE PORT, CUDDALORE , TN - 607003</div><hr>
                                       <div><strong>Current Address :</strong>465 - KALIYAMMAN KOIL STREET, SANDRORPALAYAM, CUDDALORE PORT, CUDDALORE , TN - 607003</div><hr>
                                       </div><hr>
                                    </div>
                                 </div>
                                 <!--  <div class="col-md-3"><strong>Phone Number </div><div class="col-md-3"> </strong> 987654321</div> -->
                              </div>
                           </div>
                        </div>
                     </div>
               </div>
               <!-- Working-Information -->
               <div class="tab-pane fade" id="v-pills-Working-Information" role="tabpanel" aria-labelledby="v-pills-Working-Information">
                  <nav class="navbar navbar-light bg-primary rounded">
                    <span class="navbar-brand mb-0 h1">Working Information</span>
                  </nav>
                  <br>
                  <div class="container-fluid">
                        <div class="row">
                           <div class="col-sm-12 col-xl-12">
                              <div class="card" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);">
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
                                 <div class="card-body rounded">
                                    <div class="row">
                                       <div class="col-md-6">
                                          <div><strong>Date Of Joining : </strong>06 Jun 2022</div><hr>
                                          <div><strong>Work Location : </strong>Onsite-Cuddalore</div><hr>
                                          <div><strong>CTC : </strong> 29,869</div><hr>
                                          <div><strong>RFH : </strong> HEPLRFH00436</div><hr>
                                       </div>
                                       <div class="col-md-6">
                                          <div><strong>Business Unit : </strong>BPO</div><hr>
                                          <div><strong>Position : </strong> Purchase Officer</div><hr>
                                          <div><strong>Department : </strong>Business Process Outsourcing</div><hr>
                                          <div><strong>Grade : </strong>7G</div><hr>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
               </div>
               <!-- HR Information -->
               <div class="tab-pane fade" id="v-pills-Information" role="tabpanel" aria-labelledby="v-pills-Information-tab">
                   <nav class="navbar navbar-light bg-primary rounded">
                    <span class="navbar-brand mb-0 h1">HR Information</span>
                  </nav>
                  <br>
                  <div class="container-fluid">
                     <div class="row">
                        <div class="col-sm-12 col-xl-12">
                           <div class="card" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);">
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
                              <div class="card-body rounded">
                                 <div class="row">
                                    <div class="col-md-6">
                                        <div><strong>HR Recruiter :  </strong>Soumiya</div> <hr>
                                        <div><strong>HR Onboarder : </strong>Anjum Fathima</div><hr>
                                    </div>
                                    <div class="col-md-6">
                                       <div><strong>Supervisor ": </strong> Padmapriya B - padmapriyab@hemas.in</div> <hr>
                                       <div><strong>Reviewer : </strong>Pradeesh N - pradeeshn@cavinkare.com</div>
                                       </div><hr>
                                    </div>
                                 </div>

                              </div>
                           </div>
                        </div>
                     </div>
               </div>
               <!-- Account information -->
               <div class="tab-pane fade" id="v-pills-Account-information" role="tabpanel" aria-labelledby="v-pills-Account-information-tab">
                  <nav class="navbar navbar-light bg-primary rounded">
                    <span class="navbar-brand mb-0 h1">Account Information</span>
                  </nav>
                  <br>
                  <!-- Individual column searching (text inputs) Starts-->
                  <div class="card-body">
                     <form class="theme-form row">
                        <div class="form-group col-12">
                           <input class="form-control" type="text" placeholder="AC Holder name">
                        </div>
                        <div class="form-group col-12">
                           <input class="form-control" type="text" placeholder="Account number">
                        </div>
                        <div class="form-group col-6 p-r-0">
                           <select class="form-control" size="1">
                              <option>Select Bank</option>
                              <option>SBI</option>
                              <option>ICICI</option>
                              <option>KOTAK</option>
                              <option>BOB</option>
                           </select>
                        </div>
                        <div class="form-group col-6">
                           <input class="form-control" type="text" placeholder="ICFC code">
                        </div>
                        <div class="form-group col-12">
                           <input class="form-control" type="text" placeholder="Enter mobile number">
                        </div>
                        <div class="form-group col-12">
                           <input class="form-control" type="text" placeholder="Other Details">
                        </div>
                        <div class="col-6">
                           <button class="btn btn-info-gradien btn-block btn-pill" type="button" data-original-title="btn btn-info-gradien" title="">Submit</button>
                        </div>
                     </form>
                  </div>
               </div>
               <!-- Education -->
               <div class="tab-pane fade" id="v-pills-Education" role="tabpanel" aria-labelledby="v-pills-Education-tab">
                  <nav class="navbar navbar-light bg-primary rounded">
                    <span class="navbar-brand mb-0 h1">Education Information</span>
                  </nav>
                    <div class="card-body">
                        <div class="employee-office-table">
                            <div class="table-responsive">
                            <table class="table custom-table table-hover">
                                <thead>
                                    <tr>
                                        <th>Qualification</th>
                                        <th>University</th>
                                        <th>Begin On</th>
                                        <th>Due By</th>
                                        <th>File</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a>SSLC</a></td>
                                        <td>St.Joseph's</td>
                                        <td>15 Dec 20__</td>
                                        <td>17 Dec 20__</td>
                                        <td><a href="employment.html" class="avatar"><img class="img-fluid img-circle rounded" alt="avatar image" src="../assets/images/avtar/16.jpg" style="width: 50px;"></a></td>
                                    </tr>
                                    <tr>
                                        <td><a> HSC </a></td>
                                        <td>St.Joseph's</td>
                                        <td>15 Dec 2009</td>
                                        <td>17 Dec 2011</td>
                                        <td>
                                            <a href="employment.html" class="avatar"><img class="img-fluid img-circle rounded" alt="avatar image" src="../assets/images/avtar/16.jpg" style="width: 50px;"></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a>B.SC</a></td>
                                        <td>St.Joseph's University</td>
                                        <td>15 Dec 2011</td>
                                        <td>17 Dec 2014</td>
                                        <td>
                                            <a href="employment.html" class="avatar"><img class="img-fluid img-circle rounded" alt="avatar image" src="../assets/images/avtar/16.jpg" style="width: 50px;"></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a>MCA</a></td>
                                        <td> SRM University</td>
                                        <td>15 Dec 2014</td>
                                        <td>17 Dec 2016</td>
                                        <td>
                                            <a href="employment.html" class="avatar"><img class="img-fluid img-circle rounded" alt="avatar image" src="../assets/images/avtar/16.jpg" style="width: 50px;"></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
               </div>
                  <!-- Experience -->
               <div class="tab-pane fade" id="v-pills-Experience" role="tabpanel" aria-labelledby="v-pills-Experience-tab">
                  <nav class="navbar navbar-light bg-primary rounded">
                    <span class="navbar-brand mb-0 h1">Experience</span>
                  </nav>
                  <div class="ctm-border-radius shadow-sm card">
                     <div class="card-body">
                         <div class="row people-grid-row">
                             <div class="col-md-3 col-lg-3 col-xl-4">
                                 <div class="card widget-profile">
                                     <div class="card-body rounded" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);">
                                         <div class="pro-widget-content text-center">
                                             <div class="profile-info-widget">
                                                 <a class="fa fa-suitcase" style="font-size:25px;color:black">
                                                     <!-- <img alt="User Image"> -->
                                                 </a>
                                                 <div class="profile-det-info">
                                                     <h5><a href="employment.html" class="text-info">Maria Cotton</a></h5>
                                                     <div>
                                                         <p class="mb-0"><b>PHP Team Lead</b></p>
                                                         <p class="mb-0 ctm-text-sm">3Years</p>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-md-3 col-lg-3 col-xl-4">
                                 <div class="card widget-profile">
                                     <div class="card-body rounded" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);">
                                         <div class="pro-widget-content text-center">
                                             <div class="profile-info-widget">
                                                 <a class="fa fa-suitcase" style="font-size:25px;color:black">
                                                     <!-- <img src="../public/img/profiles/img-5.jpg" alt="User Image"> -->
                                                 </a>
                                                 <div class="profile-det-info">
                                                     <h5><a href="employment.html" class="text-info">Danny Ward</a></h5>
                                                     <div>
                                                         <p class="mb-0"><b>Designing Team Lead</b></p>
                                                         <p class="mb-0 ctm-text-sm">2 Years</p>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-md-3 col-lg-3 col-xl-4">
                                 <div class="card widget-profile">
                                     <div class="card-body rounded" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);">
                                         <div class="pro-widget-content text-center">
                                             <div class="profile-info-widget">
                                                 <a class="fa fa-suitcase" style="font-size:25px;color:black">
                                                     <!-- <img src="../public/img/profiles/img-4.jpg" alt="User Image"> -->
                                                 </a>
                                                 <div class="profile-det-info">
                                                     <h5><a href="employment.html" class="text-info">Linda Craver</a></h5>
                                                     <div>
                                                         <p class="mb-0"><b>IOS Team Lead</b></p>
                                                         <p class="mb-0 ctm-text-sm">1 Year</p>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-md-3 col-lg-3 col-xl-4">
                                 <div class="card widget-profile">
                                     <div class="card-body rounded" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);">
                                         <div class="pro-widget-content text-center">
                                             <div class="profile-info-widget">
                                                 <a class="fa fa-suitcase" style="font-size:25px;color:black">
                                                     <!-- <img src="../public/img/profiles/img-3.jpg" alt="User Image"> -->
                                                 </a>
                                                 <div class="profile-det-info">
                                                     <h5><a href="employment.html" class="text-info">Jenni Sims</a></h5>
                                                     <div>
                                                         <p class="mb-0"><b>Android Team Lead</b></p>
                                                         <p class="mb-0 ctm-text-sm">2 Years</p>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-md-3 col-lg-3 col-xl-4">
                                 <div class="card widget-profile">
                                     <div class="card-body rounded" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);">
                                         <div class="pro-widget-content text-center">
                                             <div class="profile-info-widget">
                                                 <a class="fa fa-suitcase" style="font-size:25px;color:black">
                                                     <!-- <img src="../public/img/profiles/img-2.jpg" alt="User Image"> -->
                                                 </a>
                                                 <div class="profile-det-info">
                                                     <h5><a href="employment.html" class="text-info">John Gibbs</a></h5>
                                                     <div>
                                                         <p class="mb-0"><b> Business Team Lead</b></p>
                                                         <p class="mb-0 ctm-text-sm">2 Years</p>
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
               <!-- Other Documents -->
               <div class="tab-pane fade" id="v-pills-Documents" role="tabpanel" aria-labelledby="v-pills-Documents-tab">
                  <nav class="navbar navbar-light bg-primary rounded">
                    <span class="navbar-brand mb-0 h1">Other Documents</span>
                    <h4><i data-target="#add_document" >+ Add Document</i></h4>
                  </nav>
                  <br>
                     <div class="ctm-border-radius shadow-sm card">
                     <div class="card-body">
                         <div class="row people-grid-row">
                             <div class="col-md-3 col-lg-3 col-xl-4">
                                 <div class="card widget-profile">
                                     <div class="card-body rounded" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);">
                                         <div class="pro-widget-content text-center">
                                             <div class="profile-info-widget">
                                                 <a class="fa fa-suitcase" style="font-size:25px;color:black">
                                                     <!-- <img alt="User Image"> -->
                                                 </a>
                                                 <div class="profile-det-info">
                                                     <h5><a href="employment.html" class="text-info">Maria Cotton</a></h5>
                                                     <div>
                                                         <p class="mb-0"><b>PHP Team Lead</b></p>
                                                         <p class="mb-0 ctm-text-sm">3Years</p>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-md-3 col-lg-3 col-xl-4">
                                 <div class="card widget-profile">
                                     <div class="card-body rounded" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);">
                                         <div class="pro-widget-content text-center">
                                             <div class="profile-info-widget">
                                                 <a class="fa fa-suitcase" style="font-size:25px;color:black">
                                                     <!-- <img src="../public/img/profiles/img-5.jpg" alt="User Image"> -->
                                                 </a>
                                                 <div class="profile-det-info">
                                                     <h5><a href="employment.html" class="text-info">Danny Ward</a></h5>
                                                     <div>
                                                         <p class="mb-0"><b>Designing Team Lead</b></p>
                                                         <p class="mb-0 ctm-text-sm">2 Years</p>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-md-3 col-lg-3 col-xl-4">
                                 <div class="card widget-profile">
                                     <div class="card-body rounded" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);">
                                         <div class="pro-widget-content text-center">
                                             <div class="profile-info-widget">
                                                 <a class="fa fa-suitcase" style="font-size:25px;color:black">
                                                     <!-- <img src="../public/img/profiles/img-4.jpg" alt="User Image"> -->
                                                 </a>
                                                 <div class="profile-det-info">
                                                     <h5><a href="employment.html" class="text-info">Linda Craver</a></h5>
                                                     <div>
                                                         <p class="mb-0"><b>IOS Team Lead</b></p>
                                                         <p class="mb-0 ctm-text-sm">1 Year</p>
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
               <!-- Family -->                   
               <div class="tab-pane fade" id="v-pills-Family" role="tabpanel" aria-labelledby="v-pills-Family-tab">
                  <nav class="navbar navbar-light bg-primary rounded">
                    <span class="navbar-brand mb-0 h1">Family</span>
                  </nav>
                  <br>
                  <p>Family</p>
               </div>

               <!-- Pop-up div image upload-->
               <div class="modal fade" id="profile_image" tabindex="-1" role="dialog" aria-labelledby="profile_imageLabel" aria-hidden="true">
                   <div class="modal-dialog" role="document">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title" id="profile_imageLabel">Add Profile Image</h5>
                             <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                         </div>
                           <form method="POST"  id="imageUploadForm" enctype="multipart/form-data">
                                        @csrf
                           <div class="container mt-3">
                              <div class="card">
                                 <div class="card-body">
                                    <input type="file" name="image" class="image">
                                 </div>
                              </div>  
                           </div>
                              <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                 <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">×</span>
                                          </button>
                                       </div>
                                       <div class="modal-body">
                                          <div class="img-container">
                                             <div class="row">
                                                <div class="col-md-8">
                                                   <img id="image" class="test" src="https://avatars0.githubusercontent.com/u/3456749">
                                                </div>
                                             <div class="col-md-4">
                                                <div class="preview"></div>
                                             </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                          <button type="button" class="btn btn-primary" id="crop">Crop</button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>                            
                          </div>
                        </div>                             
                         </form>
                     </div>
                   </div>
                 </div>
               <!-- Pop-up  image upload Ends-->
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('script')
<script src="../assets/js/croppie.js"></script>

<script src="../assets/js/counter/jquery.waypoints.min.js"></script>
 <script src="../assets/js/counter/jquery.counterup.min.js"></script>
 <script src="../assets/js/counter/counter-custom.js"></script>
 <script src="../assets/js/photoswipe/photoswipe.min.js"></script>
 <script src="../assets/js/photoswipe/photoswipe-ui-default.min.js"></script>
 <script src="../assets/js/photoswipe/photoswipe.js"></script>
 <!-- custom js -->
 <script src="../assets/pro_js/profile.js"></script>

 <script type="text/javascript">

   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   var upload_images = "{{url('profile_upload_images')}}";

   
 </script>
@endsection