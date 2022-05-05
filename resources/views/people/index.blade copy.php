{{-- Divya --}}
@extends(Auth::user()->role_type === 'Admin' ? 'layouts.simple.admin_master' : ( Auth::user()->role_type === 'Buddy'? 'layouts.simple.buddy_master ': ( Auth::user()->role_type === 'Employee'? 'layouts.simple.candidate_master ': ( Auth::user()->role_type === 'HR'? 'layouts.simple.hr_master ': ( Auth::user()->role_type === 'IT Infra'? 'layouts.simple.itinfra_master ': ( Auth::user()->role_type === 'Site Admin'? 'layouts.simple.site_admin_master': '' ) ) ) ) ) )
@section('title', 'People')

@section('css')

@endsection

@section('style')
<style>
    .chat-box .chat-menu.chat-menu-style{
        margin-left: 20px;
        border-right: 1px solid #f8f5fd !important;
    }
    .card-style{
        margin-left: 70px !important;
        margin-top: 30px !important;
    }
</style>
@endsection

@section('breadcrumb-title')
    <h2>People</h2>
@endsection

@section('breadcrumb-items')
   {{--<li class="breadcrumb-item">Dashboard</li>
	<li class="breadcrumb-item active">Default</li>--}}   
@endsection

@section('content')
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col call-chat-body">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row chat-box">
                            <!-- Chat right side start-->
                            <div class="col pl-0 chat-menu chat-menu-style">
                                <!-- chat start-->
                                <ul class="nav nav-tabs nav-material nav-primary" id="info-tab" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" id="info-home-tab" data-toggle="tab" href="#info-home" role="tab" aria-selected="true">Starred</a>
                                    <div class="material-border"></div>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" id="profile-info-tab" data-toggle="tab" href="#info-profile" role="tab" aria-selected="false">Everyone</a>
                                        <div class="material-border"></div>
                                    </li>
                                </ul>
                                <div class="tab-content" id="info-tabContent">
                                    <div class="tab-pane fade show active" id="info-home" role="tabpanel" aria-labelledby="info-home-tab">
                                        <div class="people-list">
                                            <div class="search">
                                                <form class="theme-form">
                                                    <div class="form-group">
                                                    <input class="form-control" type="text" placeholder="Enter Emp. Name or ID..."><i class="fa fa-pencil"></i>
                                                    </div>
                                                </form>
                                            </div>
                                            <ul class="list digits">
                                                <li class="clearfix"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">
                                                    <div class="about">
                                                        <div class="name">A M Karthikeyan <small><span class="digits">(#900460)</span></small></div>
                                                        <div class="status"><i class="fa fa-share font-success"></i>  Senior Manager</div>
                                                    </div>
                                                </li>
                                                <li class="clearfix"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">
                                                    <div class="about">
                                                        <div class="name">A M Karthikeyan <small><span class="digits">(#900460)</span></small></div>
                                                        <div class="status"><i class="fa fa-share font-success"></i>  Senior Manager</div>
                                                    </div>
                                                </li> <li class="clearfix"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">
                                                    <div class="about">
                                                        <div class="name">A M Karthikeyan <small><span class="digits">(#900460)</span></small></div>
                                                        <div class="status"><i class="fa fa-share font-success"></i>  Senior Manager</div>
                                                    </div>
                                                </li> <li class="clearfix"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">
                                                    <div class="about">
                                                        <div class="name">A M Karthikeyan <small><span class="digits">(#900460)</span></small></div>
                                                        <div class="status"><i class="fa fa-share font-success"></i>  Senior Manager</div>
                                                    </div>
                                                </li> <li class="clearfix"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">
                                                    <div class="about">
                                                        <div class="name">A M Karthikeyan <small><span class="digits">(#900460)</span></small></div>
                                                        <div class="status"><i class="fa fa-share font-success"></i>  Senior Manager</div>
                                                    </div>
                                                </li> <li class="clearfix"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">
                                                    <div class="about">
                                                        <div class="name">A M Karthikeyan <small><span class="digits">(#900460)</span></small></div>
                                                        <div class="status"><i class="fa fa-share font-success"></i>  Senior Manager</div>
                                                    </div>
                                                </li> <li class="clearfix"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">
                                                    <div class="about">
                                                        <div class="name">A M Karthikeyan <small><span class="digits">(#900460)</span></small></div>
                                                        <div class="status"><i class="fa fa-share font-success"></i>  Senior Manager</div>
                                                    </div>
                                                </li> <li class="clearfix"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">
                                                    <div class="about">
                                                        <div class="name">A M Karthikeyan <small><span class="digits">(#900460)</span></small></div>
                                                        <div class="status"><i class="fa fa-share font-success"></i>  Senior Manager</div>
                                                    </div>
                                                </li> <li class="clearfix"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">
                                                    <div class="about">
                                                        <div class="name">A M Karthikeyan <small><span class="digits">(#900460)</span></small></div>
                                                        <div class="status"><i class="fa fa-share font-success"></i>  Senior Manager</div>
                                                    </div>
                                                </li> <li class="clearfix"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">
                                                    <div class="about">
                                                        <div class="name">A M Karthikeyan <small><span class="digits">(#900460)</span></small></div>
                                                        <div class="status"><i class="fa fa-share font-success"></i>  Senior Manager</div>
                                                    </div>
                                                </li> <li class="clearfix"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">
                                                    <div class="about">
                                                        <div class="name">A M Karthikeyan <small><span class="digits">(#900460)</span></small></div>
                                                        <div class="status"><i class="fa fa-share font-success"></i>  Senior Manager</div>
                                                    </div>
                                                </li> <li class="clearfix"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">
                                                    <div class="about">
                                                        <div class="name">A M Karthikeyan <small><span class="digits">(#900460)</span></small></div>
                                                        <div class="status"><i class="fa fa-share font-success"></i>  Senior Manager</div>
                                                    </div>
                                                </li> <li class="clearfix"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">
                                                    <div class="about">
                                                        <div class="name">A M Karthikeyan <small><span class="digits">(#900460)</span></small></div>
                                                        <div class="status"><i class="fa fa-share font-success"></i>  Senior Manager</div>
                                                    </div>
                                                </li> <li class="clearfix"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">
                                                    <div class="about">
                                                        <div class="name">A M Karthikeyan <small><span class="digits">(#900460)</span></small></div>
                                                        <div class="status"><i class="fa fa-share font-success"></i>  Senior Manager</div>
                                                    </div>
                                                </li> <li class="clearfix"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">
                                                    <div class="about">
                                                        <div class="name">A M Karthikeyan <small><span class="digits">(#900460)</span></small></div>
                                                        <div class="status"><i class="fa fa-share font-success"></i>  Senior Manager</div>
                                                    </div>
                                                </li> <li class="clearfix"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">
                                                    <div class="about">
                                                        <div class="name">A M Karthikeyan <small><span class="digits">(#900460)</span></small></div>
                                                        <div class="status"><i class="fa fa-share font-success"></i>  Senior Manager</div>
                                                    </div>
                                                </li> <li class="clearfix"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">
                                                    <div class="about">
                                                        <div class="name">A M Karthikeyan <small><span class="digits">(#900460)</span></small></div>
                                                        <div class="status"><i class="fa fa-share font-success"></i>  Senior Manager</div>
                                                    </div>
                                                </li> <li class="clearfix"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">
                                                    <div class="about">
                                                        <div class="name">A M Karthikeyan <small><span class="digits">(#900460)</span></small></div>
                                                        <div class="status"><i class="fa fa-share font-success"></i>  Senior Manager</div>
                                                    </div>
                                                </li> <li class="clearfix"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">
                                                    <div class="about">
                                                        <div class="name">A M Karthikeyan <small><span class="digits">(#900460)</span></small></div>
                                                        <div class="status"><i class="fa fa-share font-success"></i>  Senior Manager</div>
                                                    </div>
                                                </li> <li class="clearfix"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">
                                                    <div class="about">
                                                        <div class="name">A M Karthikeyan <small><span class="digits">(#900460)</span></small></div>
                                                        <div class="status"><i class="fa fa-share font-success"></i>  Senior Manager</div>
                                                    </div>
                                                </li> <li class="clearfix"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">
                                                    <div class="about">
                                                        <div class="name">A M Karthikeyan <small><span class="digits">(#900460)</span></small></div>
                                                        <div class="status"><i class="fa fa-share font-success"></i>  Senior Manager</div>
                                                    </div>
                                                </li> <li class="clearfix"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">
                                                    <div class="about">
                                                        <div class="name">A M Karthikeyan <small><span class="digits">(#900460)</span></small></div>
                                                        <div class="status"><i class="fa fa-share font-success"></i>  Senior Manager</div>
                                                    </div>
                                                </li> <li class="clearfix"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">
                                                    <div class="about">
                                                        <div class="name">A M Karthikeyan <small><span class="digits">(#900460)</span></small></div>
                                                        <div class="status"><i class="fa fa-share font-success"></i>  Senior Manager</div>
                                                    </div>
                                                </li> <li class="clearfix"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">
                                                    <div class="about">
                                                        <div class="name">A M Karthikeyan <small><span class="digits">(#900460)</span></small></div>
                                                        <div class="status"><i class="fa fa-share font-success"></i>  Senior Manager</div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="info-profile" role="tabpanel" aria-labelledby="profile-info-tab">
                                        <div class="people-list">
                                            <div class="search">
                                                <form class="theme-form">
                                                    <div class="form-group">
                                                    <input class="form-control" type="text" placeholder="Enter Emp. Name or ID..."><i class="fa fa-pencil"></i>
                                                    </div>
                                                </form>
                                            </div>
                                            <ul class="list digits">
                                                <li class="clearfix"><img class="rounded-circle user-image" src="../assets/images/user/1.jpg" alt="">
                                                    <div class="about">
                                                        <div class="name">A M Karthikeyan <small><span class="digits">(#900460)</span></small></div>
                                                        <div class="status"><i class="fa fa-share font-success"></i>  Senior Manager</div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>                                
                                    </div>
                                    <div class="tab-pane fade" id="info-contact" role="tabpanel" aria-labelledby="contact-info-tab">
                                        <div class="user-profile">
                                            <div class="image">
                                            <div class="avatar text-center"><img alt="" src="../assets/images/user/1.jpg"></div>
                                            <div class="icon-wrapper"><i class="icofont icofont-pencil-alt-5"></i></div>
                                            </div>
                                            <div class="user-content text-center">
                                            <h5 class="text-uppercase">mark jenco</h5>
                                            <div class="social-media">
                                                <ul class="list-inline">
                                                    <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>                                                
                                                </ul>
                                            </div>
                                            <hr>
                                            <div class="follow text-center">
                                                <div class="row">
                                                <div class="col border-right"><span>Following</span>
                                                    <div class="follow-num">236k</div>
                                                </div>
                                                <div class="col"><span>Follower</span>
                                                    <div class="follow-num">3691k</div>
                                                </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="text-center digits">
                                                <p class="mb-0">Mark.jecno23@gmail.com</p>
                                                <p class="mb-0">+91 365 - 658 - 1236</p>
                                                <p class="mb-0">Fax: 123-4560</p>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col pr-0 chat-right-aside"> 
                                <!-- <img style="width:150px;" src="../assets/images/user/1.jpg" alt="">                                             -->
                                <div class="chat">
                                    <!-- chat-header start-->
                                    <div class="chat-header clearfix"><img style="width:50px;height:50px" class="rounded-circle" src="../assets/images/user/1.jpg" alt="">
                                        <div class="about">
                                            <!-- <div class="name">Kori Thomas  <span class="font-primary f-12"><i class="icon-star"></i></span></div> -->
                                            <div class="name" style="font-size:20px;margin-top:10px:margin-left:10px;">Kori Thomas</div>
                                            <!-- <div class="status digits">PHP Developer</div> -->
                                        </div>
                                        <ul class="list-inline float-left float-sm-right chat-menu-icons">
                                            <li class="list-inline-item"><a href="#"><i class="icon-star"></i></a></li>
                                        </ul>
                                    </div>                                
                                </div> 
                                <div class="row mt-5" style="margin-left: 60px;">
                                    <div class="col-lg-3">
                                        <h6 class="mb-0">Employee ID:</h6>                                   
                                    </div>
                                    <div class="col-lg-9">
                                        <p class="mb-0" style="font-size: 16px;">900386</p>                                    
                                    </div>
                                </div>
                                <div class="row mt-3" style="margin-left: 60px;">
                                    <div class="col-lg-3">
                                        <h6 class="mb-0">Designation:</h6>                                   
                                    </div>
                                    <div class="col-lg-9">
                                        <p class="mb-0" style="font-size: 16px;">PHP Developer</p>                                    
                                    </div>
                                </div>
                                <div class="row mt-3" style="margin-left: 60px;">
                                    <div class="col-lg-3">
                                        <h6 class="mb-0">Department:</h6>                                   
                                    </div>
                                    <div class="col-lg-9">
                                        <p class="mb-0" style="font-size: 16px;">IT</p>                                    
                                    </div>
                                </div>
                                <div class="row mt-3" style="margin-left: 60px;">
                                    <div class="col-lg-3">
                                        <h6 class="mb-0">Contact Details:</h6>                                   
                                    </div>
                                    <div class="col-lg-9">
                                        <p class="mb-0" style="font-size: 16px;">9514492479</p>                                    
                                    </div>
                                </div>
                                <div class="row mt-3" style="margin-left: 60px;">
                                    <div class="col-lg-3">
                                        <h6 class="mb-0">Email:</h6>                                   
                                    </div>
                                    <div class="col-lg-9">
                                        <p class="mb-0" style="font-size: 16px;">divyak@hemas.in</p>                                    
                                    </div>
                                </div>
                                <div class="row mt-3" style="margin-left: 60px;">
                                    <div class="col-lg-3">
                                        <h6 class="mb-0">Work Location:</h6>                                   
                                    </div>
                                    <div class="col-lg-9">
                                        <p class="mb-0" style="font-size: 16px;">On Site</p>                                    
                                    </div>
                                </div>
                                <div class="row mt-3" style="margin-left: 60px;">
                                    <div class="col-lg-3">
                                        <h6 class="mb-0">Joining Date:</h6>                                   
                                    </div>
                                    <div class="col-lg-9">
                                        <p class="mb-0" style="font-size: 16px;">15/11/2021</p>                                    
                                    </div>
                                </div>
                                <div class="row mt-3" style="margin-left: 60px;">
                                    <div class="col-lg-3">
                                        <h6 class="mb-0">Date Of Birth:</h6>                                   
                                    </div>
                                    <div class="col-lg-9">
                                        <p class="mb-0" style="font-size: 16px;">09/04/1999</p>                                    
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
 
@endsection

