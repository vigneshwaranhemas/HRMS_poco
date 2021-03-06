@extends(Auth::user()->role_type === 'Admin' ? 'layouts.simple.admin_master' : ( Auth::user()->role_type === 'Buddy'? 'layouts.simple.buddy_master ': ( Auth::user()->role_type === 'Employee'? 'layouts.simple.candidate_master ': ( Auth::user()->role_type === 'HR'? 'layouts.simple.hr_master ': ( Auth::user()->role_type === 'IT Infra'? 'layouts.simple.itinfra_master ': ( Auth::user()->role_type === 'Site Admin'? 'layouts.simple.site_admin_master': '' ) ) ) ) ) )

@section('title', 'User Profile')
@section('css')
<!-- <link rel="stylesheet" type="text/css" href="../assets/css/photoswipe.css"> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
 -->
 <link rel="stylesheet" type="text/css" href="../assets/css/date-picker.css">
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<link rel="stylesheet" href="../assets/css/cropper.css"/>
<link rel="stylesheet" href="../assets/css/croppie.css"/>
<script src="../assets/js/cropper.js"></script>
 <link href="../assets/css/select2.css" rel="stylesheet">


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
.card .card-body
{
   padding: 10px !important;
}

.cr-boundary{
   width: 1089px !important;
}

.cr-vp-circle
{
   border-radius: inherit !important;
   width: 581px !important;
}
/*.banner_ji{
   margin-top: 70px;
}*/
.select2
{
       width: 100% !important;
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
                  <div class="my-gallery" id="aniimated-thumbnials" itemscope="">
                      <div class="icon-wrapper"><i class="icofont icofont-pencil-alt-5" data-toggle="modal" data-original-title="test" data-target="#exampleModal"></i></div>
                     <figure itemprop="associatedMedia" itemscope>
                        <!-- <a href="../assets/images/other-images/profile-style-img3.png" itemprop="contentUrl" data-size="1600x950"><img class="img-fluid rounded" src="../assets/images/other-images/profile-style-img3.png" itemprop="thumbnail" alt="gallery"></a> -->
                        <a class="avatar" itemprop="contentUrl" data-size="1600x950"><img width="1300" height="330" class="img-fluid rounded" itemprop="thumbnail" alt="" id="banner_img"></a>
                        <!-- <div class="avatar" itemprop="contentUrl" data-size="1600x950"><img class="img-fluid rounded" itemprop="thumbnail" alt="" id="banner_img" src=""></div> -->
                     </figure>
                  </div>
               </div>
               <div class="user-image">
                  <div class="avatar"><img id="profile_img" src=""></div>
                  <div class="icon-wrapper"><i class="icofont icofont-pencil-alt-5" data-toggle="modal" data-original-title="test" data-target="#profile_image"></i></div>
               </div>
            <!-- Pop-up banner starts-->
            <div class="modal fade banner_ji" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">??</span></button>
                      </div>
                     <div class="card">
                        <div class="container">
                           <div class="panel panel-default">
                             <div class="panel-heading"> Crop Banner Image</div>
                             <div class="panel-body">
                              <div class="row">
                                 <div class="col-md-4 text-center">
                                    <div id="upload-demo" itemprop="contentUrl" data-size="1600x950"></div>
                                 </div>
                              </div>
                              <div>
                                 <strong>Select Image:</strong>
                                    <input type="file" class="img-fluid rounded" itemprop="thumbnail" id="upload" accept=".jpeg,.jpg,.png,.GIF,.JPEG,.JPG,.PNG" name="upload">
                                    <button class="btn btn-success upload-result">Upload Image</button>
                              </div>
                                    <span class="text-danger color-hider" id="upload_error" style="display:none;color: red;"></span>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                             </div>
                           </div>
                        </div>

                     </div>

                  </div>
               </div>
            </div>
            <!-- Pop-up div Ends-->
            <div class="text-center">
               <div class="info">
                  <div class="row">
                     <div class="col-sm-6 col-lg-4 order-sm-1 order-xl-0">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="ttl-info text-left">
                                 <h6><i class="fa fa-envelope"></i>   Email</h6>
                                 <div id="email"></div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="ttl-info text-left">
                                 <h6><i class="fa fa-calendar"></i>   DOB</h6>
                                 <div id="dob"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-12 col-lg-4 order-sm-0 order-xl-1">
                        <div class="user-designation">
                           <div class="title"><a target="_blank" id="pro_name" href=""></a></div>
                           <div class="desc mt-2" id="designation"></div>
                        </div>
                     </div>
                     <div class="col-sm-6 col-lg-4 order-sm-2 order-xl-2">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="ttl-info text-left">
                                 <h6><i class="fa fa-phone"></i>   Contact Us</h6>
                                 <span><a id="contact_no"></a></span>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="ttl-info text-left">
                                 <h6><i class="fa fa-location-arrow"></i>   Work Location</h6>
                                 <span><a id="worklocation"></a></span>
                              </div>
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
         <div class="card col-xl-2 shadow-lg p-3 mb-5 bg-white rounded">
               <svg x="0" y="0" viewBox="0 0 360 220">
                  <g>
                     <path fill="#7e37d8" d="M0.732,193.75c0,0,29.706,28.572,43.736-4.512c12.976-30.599,37.005-27.589,44.983-7.061                                          c8.09,20.815,22.83,41.034,48.324,27.781c21.875-11.372,46.499,4.066,49.155,5.591c6.242,3.586,28.729,7.626,38.246-14.243                                          s27.202-37.185,46.917-8.488c19.715,28.693,38.687,13.116,46.502,4.832c7.817-8.282,27.386-15.906,41.405,6.294V0H0.48                                          L0.732,193.75z"></path>
                  </g>
                  <text transform="matrix(1 0 0 1 69.7256 116.2686)" fill="#fff" font-size="30"></text>
               </svg>
               <div class="col-sm-3 tabs-responsive-side">
                  <div class="nav flex-column nav-pills nav-material nav-left text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                     <a class="nav-link active" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</a>
                     <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Contact</a>
                     <a class="nav-link" id="v-pills-Working-Information-tab" data-toggle="pill" href="#v-pills-Working-Information" role="tab" aria-controls="v-pills-Working-Information" aria-selected="false">Working Information</a>
                     <a class="nav-link" id="v-pills-Information-tab" data-toggle="pill" href="#v-pills-Information" role="tab" aria-controls="v-pills-Information" aria-selected="false">HR Information</a>
                     <a class="nav-link" id="v-pills-Account-information-tab" data-toggle="pill" href="#v-pills-Account-information" role="tab" aria-controls="v-pills-Account-information" aria-selected="false">Account Information</a>
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
                       <button class="btn btn-success" type="button" data-toggle="modal" data-original-title="test" data-target="#skillModal">+ Add Skill</button>
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
                                          <div> <strong>Name : </strong>  <a id="can_name"></a></div><hr>
                                          <div> <strong>Gender : </strong><a id="gender"></a></div><hr>
                                          <div> <strong>Marital Status : </strong> - </div><hr>
                                          <div> <strong>skill : </strong> <a id="skill"></a></div><hr>
                                       </div>
                                       <div class="col-md-6">
                                          <div> <strong>Blood Group : </strong> <a id="blood_grp"></a>
                                          </div><hr>
                                          <div> <strong>Date of Birth :</strong> <a id="dob_tx"></a>
                                          </div><hr>
                                          <div> <strong>Roll of Intake : </strong> <a id="payroll_status"></a>
                                          </div><hr>
                                          
                                       </div>
                                    </div>

                                 </div>
                              <!-- Pop-up div starts-->
                                 <div class="modal fade" id="skillModal" tabindex="-1" role="dialog" aria-labelledby="skillModalLabel" aria-hidden="true">
                                     <div class="modal-dialog" role="document">
                                       <div class="modal-content">
                                           <div class="modal-header">
                                               <h5 class="modal-title" id="skillModalLabel">Add Skill Set</h5>
                                               <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">??</span></button>
                                           </div>
                                             <form method="POST" action="javascript:void(0)" id="add_skill_set" class="ajax-form" enctype="multipart/form-data">
                                               <div class="modal-body">
                                                   <div class="col-md-12 mb-3">
                                                           <label for="Skill">Skill</label>
                                                           <select class="form-control dynamic-option-create-multiple" name="skill[]" id="skill" placeholder="Enter Your Skills" >
                                                           </select>
                                                            <span class="text-danger color-hider" id="skill_error"  style="display:none;color: red;"></span>
                                                         </div>
                                               </div>
                                               <div class="modal-footer">
                                                   <button class="btn btn-primary" type="button" id="closebutton" data-dismiss="modal">Close</button>
                                                   <button class="btn btn-secondary" type="submit" id="skill_Submit">Save</button>
                                               </div>
                                             </form>
                                       </div>
                                     </div>
                                 </div>
                  <!-- Pop-up div Ends-->
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               <!-- contact -->
               <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                    <nav class="navbar navbar-light bg-primary rounded">
                       <span class="navbar-brand mb-0 h1">Contact</span>
                       <button class="btn btn-success" type="button" onclick="Contact_information()" data-toggle="modal" data-original-title="test" data-target="#ContactModal">+ Add Contact</button>
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
                                       <div><strong>Phone Number :</strong> <p id="p_num_view"></p></div><hr>
                                       <div><strong>Permanent Address :</strong><p id="p_addres_view"></p></div><hr>
                                       <div><strong>Personal Email :</strong> <p id="p_email_view"></p></div><hr>
                                    </div>
                                    <div class="col-md-6">

                                       <div><strong>Secondary Number :</strong><p id="s_num_view"></p></div><hr>
                                       <div><strong>Current Address :</strong><p id="c_addres_view"></p></div><hr>
                                       <!-- <div><strong>State :</strong> <a id="State_view"></a></div><hr> -->
                                       </div><hr>
                                    </div>
                                 </div>
                                 <!--  <div class="col-md-3"><strong>Phone Number </div><div class="col-md-3"> </strong> 987654321</div> -->
                              </div>
                           </div>
                        </div>
                     </div>
                       <!-- Pop-up div starts-->
                  <div class="modal fade" id="ContactModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                        <!-- <div class="modal-content" style="margin-left: -28%;width: 166%;"> -->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Contact</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">??</span></button>
                            </div>
                              <form method="POST" action="javascript:void(0)" id="add_contact_info" class="ajax-form" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                <div class="modal-body">
                                    <div class="form-row">
                                       <div class="col-md-6 mb-3">
                                            <label for="phone_number">Phone Number *</label>
                                            <input class="form-control" maxlength="10" name="phone_number" id="phone_number" type="text" placeholder="Phone Number" >
                                            <span class="text-danger color-hider" id="phone_number_error"  style="display:none;color: red;"></span>
                                        </div> 
                                        <div class="col-md-6 mb-3">
                                            <label for="s_number">Secondary Number</label>
                                            <input class="form-control" maxlength="10" name="s_number" id="s_number" type="text" placeholder="Secondary Number" >
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="p_email">Personal Email *</label>
                                            <input class="form-control" name="p_email" id="p_email" type="email" placeholder="Email">
                                           <span class="text-danger color-hider" id="p_email_error"  style="display:none;color: red;"></span>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                          
                                        </div>
                                       <div class="col-md-6 mb-3">
                                          <label for="p_email">Permanent Address *</label>
                                        <textarea class="custom-select"  type="text" id="p_addres" name="p_addres" size="35" ></textarea>
                                          <span class="text-danger color-hider" id="p_addres_error"  style="display:none;color: red;"></span>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                          <label for="p_email">Present Address *</label>
                                          <textarea class="custom-select"  type="text" id="c_addres" name="c_addres" size="35" ></textarea>
                                          <span class="text-danger color-hider" id="c_addres_error"  style="display:none;color: red;"></span>
                                       </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="p_State">Permanent State *</label>
                                            <select name="p_State" id="p_State" class="custom-select">
                                                  <option value="">--Select--</option>
                                             </select>
                                            <span class="text-danger color-hider" id="p_State_error"  style="display:none;color: red;"></span>
                                        </div>
                                         <div class="col-md-6 mb-3">
                                         <label for="c_State"> Present State *</label>
                                         <select name="c_State" id="c_State" class="custom-select">
                                               <option value="">--Select--</option>
                                          </select>
                                       <span class="text-danger color-hider" id="c_State_error"  style="display:none;color: red;"></span>
                                       </div>
                                         <div class="col-md-6 mb-3">
                                            <label for="p_district">Permanent District *</label>
                                            <select name="p_district" id="p_district" class="custom-select">
                                                  <option value="">--Select--</option>
                                             </select>
                                            <span class="text-danger color-hider" id="p_district_error"  style="display:none;color: red;"></span>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="c_district">Present District *</label>
                                            <select name="c_district" id="c_district" class="custom-select">
                                                  <option value="">--Select--</option>
                                             </select>
                                            <span class="text-danger color-hider" id="c_district_error"  style="display:none;color: red;"></span>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                         <label for="p_town">Permanent Town *</label>
                                         <select name="p_town" id="p_town" class="custom-select">
                                                  <option value="">--Select--</option>
                                             </select>
                                         <span class="text-danger color-hider" id="p_town_error"  style="display:none;color: red;"></span>
                                       </div>
                                        <div class="col-md-6 mb-3">
                                          <label for="c_town">Present Town *</label>
                                          <select name="c_town" id="c_town" class="custom-select">
                                          <option value="">--Select--</option>
                                          </select>
                                       <span class="text-danger color-hider" id="c_town_error"  style="display:none;color: red;"></span>
                                       </div>
                                       <div>
                                          <input id="sameadd" name="sameadd" type="checkbox" value="Sameadd" onchange="CopyAdd();"/>Click to Clone the Address
                                          <p id="text" style="display:none;color: green;">Address is Cloned...</p>
                                       </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary" type="button" id="closebutton" data-dismiss="modal">Close</button>
                                    <button class="btn btn-secondary" type="btnSubmit">Save</button>
                                </div>
                              </form>
                        </div>
                      </div>
                    </div>
                  <!-- Pop-up div Ends-->
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
                                          <div><strong>Date Of Joining : </strong><a id="doj"></a></div><hr>
                                          <div><strong>Work Location : </strong><a id="worklocation_tx"></a></div><hr>
                                          <div><strong>CTC : </strong> *****</div><hr>
                                          <div><strong>RFH : </strong> -</div><hr>
                                       </div>
                                       <div class="col-md-6">
                                          <div><strong>Department : </strong><a id="department"></a></div><hr>
                                          <div><strong>Designation : </strong> <a id="designation_tx"></a></div><hr>
                                          <!-- <div><strong>Designation : </strong><a id="designation"></a></div><hr> -->
                                          <div><strong>Grade : </strong><a id="grade"></a></div><hr>
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
                                        <div><strong>HR Recruiter : </strong> - </div> <hr>
                                        <div><strong>HR Onboarder : </strong> - </div><hr>
                                    </div>
                                    <div class="col-md-6">
                                       <div><strong>Supervisor : </strong> <a id="sup_name"></a></div> <hr>
                                       <div><strong>Reviewer : </strong> <a id="reviewer_name"></a></div><hr>
                                       </div>
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
                     <form class="theme-form row" method="POST" action="javascript:void(0)" id="add_account_info" enctype="multipart/form-data">
                        <div class="form-group col-6">
                           <input class="form-control" type="text" name="acc_name" id="acc_name" placeholder="AC Holder name">
                             <span class="text-danger color-hider" id="acc_name_error"  style="display:none;color: red;"></span>
                        </div>
                       <div class="form-group col-6">
                           <select class="custom-select" id="bank_name"  name="bank_name">
                              <option value="">--Select Bank--</option>
                              <option value="SBI">SBI</option>
                              <option value="AXIS">AXIS</option>
                              <option value="UCO">UCO</option>
                              <option value="CBI">CBI</option>
                              <option value="UBI">UBI</option>
                              <option value="ICICI">ICICI</option>
                              <option value="KVB">KVB</option>
                              <option value="HDFC">HDFC</option>

                              <!-- <option>PUVATHA BANK</option> -->
                           </select>
                           <span class="text-danger color-hider" id="bank_name_error"  style="display:none;color: red;"></span>
                        </div>
                        <div class="form-group col-6">
                           <input class="form-control" type="text" minlength="12" maxlength="13" name="acc_number" id="acc_number" placeholder="Account number">
                           <span class="text-danger color-hider" id="acc_number_error" style="display:none;color: red;"></span>
                        </div>
                        <div class="form-group col-6">
                           <input class="form-control" type="text" minlength="12" maxlength="13" name="con_acc_number" id="con_acc_number" placeholder="Confirm Account number">
                           <span class="text-danger color-hider" id="con_acc_number_error" style="display:none;color: red;"></span>
                        </div>
                        <div class="form-group col-6">
                           <input class="form-control" name="ifsc_code" id="ifsc_code" type="text" placeholder="IFSC code">
                           <span class="text-danger color-hider" id="ifsc_code_error"  style="display:none;color: red;"></span>
                        </div>
                        <div class="form-group col-6">
                           <input class="form-control" minlength="10" maxlength="10" name="acc_mobile" id="acc_mobile" type="text" placeholder="Enter mobile number">
                           <span class="text-danger color-hider" id="acc_mobile_error"  style="display:none;color: red;"></span>
                        </div>
                        <div class="form-group col-6">
                           <input class="form-control" name="branch_name" id="branch_name" type="text" placeholder="Branch Name">
                           <span class="text-danger color-hider" id="branch_name_error"  style="display:none;color: red;"></span>
                        </div>
                        <div class="col-4">
                           <!-- <input type="hidden" name="type_id" id="type_id"> -->
                           <button class="btn btn-info-gradien btn-block btn-pill" data-original-title="btn btn-info-gradien" type="submit" >Save</button>
                        </div>
                     </form>
                  </div>
                  </div>
                  </div>
               </div>
               <!-- Education -->
               <div class="tab-pane fade" id="v-pills-Education" role="tabpanel" aria-labelledby="v-pills-Education-tab">
                  <nav class="navbar navbar-light bg-primary rounded">
                    <span class="navbar-brand mb-0 h1">Education Information</span>
                    <button class="btn btn-success" type="button" data-toggle="modal" data-original-title="test" data-target="#documentModal">+ Add Education</button>
                  </nav>
                  <br>
                    <div class="card-body">
                        <div class="employee-office-table">
                            <div class="table-responsive">
                            <table class="table custom-table table-hover" >
                                <thead>
                                    <tr>
                                        <th>Qualification</th>
                                        <th>University</th>
                                        <th>Begin On</th>
                                        <th>End On</th>
                                        <!-- <th>Skill Set</th> -->
                                        <th>Certificate</th>
                                    </tr>
                                </thead>
                                <tbody id="education_td">

                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                    <!-- Pop-up div starts-->
                  <div class="modal fade" id="documentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Education</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">??</span></button>
                            </div>
                              <form method="POST" action="javascript:void(0)" id="add_education_unit" class="ajax-form" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="form-row">
                                       <div class="col-md-12 mb-3">
                                            <label for="Qualification">Qualification</label>
                                            <input class="form-control" name="qualification" id="qualification" type="text" placeholder="Qualification">
                                            <span class="text-danger color-hider" id="qualification_error"  style="display:none;color: red;"></span>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="University">Institute</label>
                                            <input class="form-control" name="institute" id="institute" type="text" placeholder="Institute">
                                            <span class="text-danger color-hider" id="institute_error"  style="display:none;color: red;"></span>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="Begin_On">Begin On</label>
                                            <input class="form-control" name="begin_on" id="begin_on" type="month" placeholder="" >
                                            <span class="text-danger color-hider" id="begin_on_error"  style="display:none;color: red;"></span>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="Due By">End On</label>
                                            <input class="form-control" name="end_on" id="end_on" type="month" placeholder="" >
                                            <span class="text-danger color-hider" id="end_on_error"  style="display:none;color: red;"></span>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="edu_certificate">Education Certificate</label>
                                            <input class="form-control" name="edu_certificate" id="edu_certificate" type="file" accept=".doc,.docx,.xls,.xlsx,.ppt,.pdf" placeholder="" >
                                            <span class="text-danger color-hider" id="edu_certificate_error"  style="display:none;color: red;"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary" type="button" id="closebutton" data-dismiss="modal">Close</button>
                                    <button class="btn btn-secondary" type="submit">Save</button>
                                </div>
                              </form>
                        </div>
                      </div>
                    </div>
                  <!-- Pop-up div Ends-->
               </div>
               <!-- Experience -->
               <div class="tab-pane fade" id="v-pills-Experience" role="tabpanel" aria-labelledby="v-pills-Experience-tab">
                  <nav class="navbar navbar-light bg-primary rounded">
                    <span class="navbar-brand mb-0 h1">Experience</span>
                     <button class="btn btn-success" type="button" data-toggle="modal" data-original-title="test" data-target="#expModal">+ Add Experience</button>
                  </nav>
                  <br>
                  <div class="ctm-border-radius shadow-sm card">
                     <div id="Experience_tbl">
                     </div>
                  </div>
                   <!-- Pop-up div starts-->
                  <div class="modal fade" id="expModal" tabindex="-1" role="dialog" aria-labelledby="expModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="Experience">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="expModalLabel">Add Experience</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">??</span></button>
                            </div>
                              <form method="POST" action="javascript:void(0)" id="add_experience_unit" class="ajax-form" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="form-row">
                                       <div class="col-md-12 mb-3">
                                            <label for="job_title">Job Title</label>
                                            <input class="form-control" name="job_title" id="job_title" type="text" placeholder="Job Tiltle">
                                            <span class="text-danger color-hider" id="job_title_error"  style="display:none;color: red;"></span>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="cmp_name">Company Name</label>
                                            <input class="form-control" name="cmp_name" id="cmp_name" type="text" placeholder="Company Name">
                                            <span class="text-danger color-hider" id="cmp_name_error"  style="display:none;color: red;"></span>
                                        </div>
                                         <div class="col-md-12 mb-3">
                                            <label for="exp_begin_On">Begin On</label>
                                            <input class="form-control" name="exp_begin_on" id="exp_begin_on" type="date" placeholder="">
                                            <span class="text-danger color-hider" id="exp_begin_on_error"  style="display:none;color: red;"></span>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="Due By">End On</label>
                                            <input class="form-control" name="exp_end_on" id="exp_end_on" type="date" placeholder="">
                                            <span class="text-danger color-hider" id="exp_end_on_error"  style="display:none;color: red;"></span>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="exp_upload_file">Experience Certificate</label>
                                            <input class="form-control" name="exp_file" id="exp_file" accept=".doc,.docx,.xls,.xlsx,.ppt,.pdf" type="file" aria-describedby="fileHelp">
                                             <!-- <small id="fileHelp" class="form-text text-muted">Please upload a valid file.</small> -->
                                             <span class="text-danger color-hider" id="exp_file_error"  style="display:none;color: red;"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary" type="button" id="closebutton" data-dismiss="modal">Close</button>
                                    <button class="btn btn-secondary" type="submit">Save</button>
                                </div>
                              </form>
                        </div>
                      </div>
                  </div>
                  <!-- Pop-up div Ends-->
               </div>
               <!-- Other Documents -->
               <div class="tab-pane fade" id="v-pills-Documents" role="tabpanel" aria-labelledby="v-pills-Documents-tab">
                  <nav class="navbar navbar-light bg-primary rounded">
                    <span class="navbar-brand mb-0 h1">Other Documents</span>
                    <!-- <h4><i data-target="#add_document" >+ Add Document</i></h4> -->
                     <button class="btn btn-success" type="button" data-toggle="modal" data-original-title="test" data-target="#docModal">+ Add Document</button>
                  </nav>
                  <br>
                     <div id="testing">
                     </div>
                     <!-- Pop-up div starts-->
                  <div class="modal fade" id="docModal" tabindex="-1" role="dialog" aria-labelledby="docModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="docModalLabel">Add Documents</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">??</span></button>
                            </div>
                              <form method="POST" action="javascript:void(0)" id="add_documents_unit" class="ajax-form" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                <div class="modal-body">
                                    <div class="form-row">
                                       <div class="col-md-12 mb-3">
                                            <label for="documents_name">Documents Name</label>
                                            <input class="form-control" name="documents_name" id="documents_name" type="text" placeholder="Documents Name" required="">
                                            <span class="text-danger color-hider" id="documents_name_error"  style="display:none;color: red;"></span>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="upload_file">File</label>
                                            <input class="form-control" name="file" id="file" accept=".doc,.docx,.xls,.xlsx,.ppt,.pdf" type="file" placeholder=""  aria-describedby="fileHelp" required="">
                                             <!-- <small id="fileHelp" class="form-text text-muted">Please upload a valid file.</small> -->
                                             <span class="text-danger color-hider" id="file_error"  style="display:none;color: red;"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary" type="button" id="closebutton" data-dismiss="modal">Close</button>
                                    <button class="btn btn-secondary" type="submit" id="doc_Submit">Save</button>
                                </div>
                              </form>
                        </div>
                      </div>
                  </div>
                  <!-- Pop-up div Ends-->
               </div>
               <!-- Family -->
               <div class="tab-pane fade" id="v-pills-Family" role="tabpanel" aria-labelledby="v-pills-Family-tab">
                  <nav class="navbar navbar-light bg-primary rounded">
                    <span class="navbar-brand mb-0 h1">Family</span>
                    <button class="btn btn-success" type="button" data-toggle="modal" data-original-title="test" data-target="#FamilyModal">+ Add Family Info</button>
                  </nav>
                  <br>
                  <div class="card-body">
                        <div class="employee-office-table">
                            <div class="table-responsive">
                            <table class="table custom-table table-hover" >
                                <thead>
                                    <tr>
                                        <th>Names</th>
                                        <th>Gender</th>
                                        <th>Relationship</th>
                                        <th>Marital Status</th>
                                        <th>Blood Group</th>
                                    </tr>
                                </thead>
                                <tbody id="family_td">

                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                     <!-- Pop-up div starts-->
                  <div class="modal fade" id="FamilyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Family Information</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">??</span></button>
                            </div>
                              <form method="POST" action="javascript:void(0)" id="add_family_unit" class="ajax-form" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                <div class="modal-body">
                                    <div class="form-row">
                                       <div class="col-md-12 mb-3">
                                            <label for="fm_name">Name</label>
                                            <input class="form-control" name="fm_name" id="fm_name" type="text" placeholder="Name">
                                            <span class="text-danger color-hider" id="fm_name_error"  style="display:none;color: red;"></span>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="fm_gender">Gender</label>
                                            <select class="form-control" name="fm_gender" id="fm_gender">
                                                <option value="">Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Other">Other</option>
                                             </select>
                                            <span class="text-danger color-hider" id="fm_gender_error"  style="display:none;color: red;"></span>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="fn_relationship">Relationship</label>
                                            <!-- <input class="form-control" name="fn_relationship" id="fn_relationship" type="text" placeholder="Relationship"> -->
                                             <select class="form-control" name="fn_relationship" id="fn_relationship">
                                                <option value="">Select</option>
                                               <option value="Mother">Mother</option>
                                               <option value="Father">Father</option>
                                               <option value="Daughter">Daughter</option>
                                               <option value="son">Son</option>
                                               <option value="sister">Sister</option>
                                               <option value="brother">Brother</option>
                                               <option value="aunty">Aunty</option>
                                               <option value="uncle">Uncle</option>
                                               <option value="cousin_female">Cousin(Female)</option>
                                               <option value="cousin_male">Cousin(Male)</option>
                                               <option value="grandmother">Grandmother</option>
                                               <option value="grandfather">Grandfather</option>
                                               <option value="granddaughter">Granddaughter</option>
                                               <option value="grandson">Grandson</option>
                                             </select>
                                             <span class="text-danger color-hider" id="fn_relationship_error"  style="display:none;color: red;"></span>

                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="fn_marital">Marital Status</label>
                                            <!-- <input class="form-control" name="fn_marital" id="fn_marital" type="text" placeholder="Marital Status"> -->
                                            <select class="form-control" name="fn_marital" id="fn_marital">
                                                 <option value="">-Select Marital Status-</option>
                                                 <option value="Single">Single</option>
                                                 <option value="Married">Married</option>
                                                 <option value="Widowed">Widowed</option>
                                                 <option value="Separated">Separated</option>
                                                 <option value="Divorced">Divorced</option>
                                             </select>
                                            <span class="text-danger color-hider" id="fn_marital_error"  style="display:none;color: red;"></span>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="fn_blood_gr">Blood Group</label>
                                            <!-- <input class="form-control" name="fn_blood_gr" id="fn_blood_gr" type="text" placeholder="Blood Group"> -->
                                           <select class="form-control" id="fn_blood_gr" name="fn_blood_gr" >
                                             <option value="">-Select Blood Group-</option>
                                             <option value="A+">A+</option><option value="A-">A-</option>
                                             <option value="B+">B+</option><option value="B-">B-</option>
                                             <option value="O+">O+</option><option value="O-">O-</option>
                                             <option value="AB+">AB+</option><option value="AB-">AB-</option>
                                             </select>
                                            <span class="text-danger color-hider" id="fn_blood_gr_error"  style="display:none;color: red;"></span>
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary" type="button" id="closebutton" data-dismiss="modal">Close</button>
                                    <button class="btn btn-secondary" type="submit" >Save</button>
                                </div>
                              </form>
                        </div>
                      </div>
                  </div>
                  <!-- Pop-up div Ends-->
               </div>

               <!-- Pop-up div image upload-->

               <div class="modal fade" id="profile_image" tabindex="-1" role="dialog" aria-labelledby="profile_imageLabel" aria-hidden="true">
                   <div class="modal-dialog" role="document">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title" id="profile_imageLabel">Add Profile Image</h5>
                             <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">??</span></button>
                         </div>
                           <form method="POST"  id="imageUploadForm" enctype="multipart/form-data">
                                        @csrf
                           <div class="container mt-3">
                              <div class="card">
                                 <div class="card-body">
                                    <input type="file" name="image" accept=".jpeg,.jpg,.png,.GIF,.JPEG,.JPG,.PNG" class="image">
                                 </div>
                              </div>
                           </div>
                              <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                 <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">??</span>
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
               <!-- Pop-up div Ends-->
               <!-- /.banner popup image -->
                  <div class="modal fade sample-preview_ban" tabindex="-1" role="dialog"
                  aria-labelledby="myLargeModalLabel" aria-hidden="true">
                     <div class="modal-dialog modal-lg">
                        <div class="modal-header" style="border-bottom: 0;">
                           <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                           <img id="sample_view_ban" style="width: 65%; margin-left: 20%;">
                        </div>
                     </div>
                  </div>
                  <!-- /.End banner pop up image -->

                  <!-- /.profile popup image -->
                  <div class="modal fade sample-preview_pro" tabindex="-1" role="dialog"
                  aria-labelledby="myLargeModalLabel" aria-hidden="true">
                     <div class="modal-dialog modal-lg">
                        <div class="modal-header" style="border-bottom: 0;">
                           <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                           <img id="sample_view_pro" style="width: 35%; margin-left: 30%;">
                        </div>
                     </div>
                  </div>
                  <!-- /.End banner pop up image -->
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('script')

<!-- date picker -->
<script src="../assets/js/datepicker/date-picker/datepicker.js"></script>
<script src="../assets/js/datepicker/date-picker/datepicker.en.js"></script>
<script src="../assets/js/datepicker/date-picker/datepicker.custom.js"></script>

<script src="../assets/js/counter/jquery.waypoints.min.js"></script>
 <script src="../assets/js/counter/jquery.counterup.min.js"></script>
 <script src="../assets/js/counter/counter-custom.js"></script>
 <script src="../assets/js/photoswipe/photoswipe.min.js"></script>
 <script src="../assets/js/photoswipe/photoswipe-ui-default.min.js"></script>
 <script src="../assets/js/photoswipe/photoswipe.js"></script>
 <script src="../assets/js/croppie.js"></script>
 <!-- custom js -->
 <script src="../assets/pro_js/profile.js"></script>
 <script src='../assets/js/select2/select2-custom.js'></script>
 <script src='../assets/js/select2/select2.full.min.js'></script>

 <script type="text/javascript">
   /*multiselect*/
   $(document).ready(function() {
        $("select.exist-option-only").select2();
        $("select.dynamic-option-create-multiple").select2({
          tags: true,
          multiple: true,
        });
      })

   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

  
   /*state list*/
   var add_skill_set_link = "{{url('add_skill_set')}}";
   var state_get_link = "{{url('state_get')}}";
   var get_district_link = "{{url('get_district')}}";
   var get_district_cur_link = "{{url('get_district_cur')}}";
   var get_town_name_link = "{{url('get_town_name')}}";
   var get_town_name_curr_link = "{{url('get_town_name_curr')}}";
   var upload_images = "{{url('profile_upload_images')}}";
   var display_image = "{{url('profile_display_images')}}";
   var add_documents_unit_process_link = "{{url('documents_insert')}}";
   var documents_info_link = "{{url('documents_info_pro')}}";
   var account_info_link = "{{url('profile_account_info_add')}}";
   var account_info_get_link = "{{url('account_info_get')}}";
   var education_information_link = "{{url('education_information_insert')}}";
   var education_information_get_link = "{{url('education_information_view')}}";
   var experience_info_link = "{{url('experience_info_view')}}";
   var add_contact_info_link = "{{url('add_contact_info')}}";
   var Contact_info_get_link = "{{url('Contact_info_view')}}";
   var add_family_info_link = "{{url('add_family_add')}}";
   var family_information_get_link = "{{url('family_information_view')}}";
   var banner_image_crop_link = "{{url('banner_image_crop')}}";
   var profile_banner_image_link = "{{url('profile_banner')}}";
   var experience_information_link = "{{url('experience_information')}}";


 </script>
@endsection
