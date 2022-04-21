@extends("layouts.simple.hr_master")
@section("title", "User Documents ")

@section("css")
<link rel="stylesheet" type="text/css" href="{{url("assets/css/datatables.css")}}">
<link rel="stylesheet" type="text/css" href="{{url("assets/css/datatable-extension.css")}}">
@endsection

@section("style")
@endsection
<style>
.test{
    width:16%;
}
 </style>
@section("breadcrumb-title")
	<h2><span>User Documents  </span></h2>
@endsection

@section("breadcrumb-items")

@endsection

@section("content")
<div class="card-body">
   <div class="row people-grid-row">
        <div class="col-md-3 col-lg-3 col-xl-4">
            <div class="card widget-profile" style="width: 100%;height: 90%;"">
                <div class="card-body rounded" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);">
                    <div class="pro-widget-content text-center">
                        <div class="profile-info-widget" style="margin-bottom: -37px;">
                            <a class="fa fa-suitcase" style="font-size:25px;color:black"></a>
                            <div class="profile-det-info">
                                <h5><a href="" class="text-info">SSLC</a></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-lg-3 col-xl-4">
            <div class="card widget-profile" style="width: 100%;height: 90%;"">
                <div class="card-body rounded" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);">
                    <div class="pro-widget-content text-center">
                        <div class="profile-info-widget" style="margin-bottom: -37px;">
                            <a class="fa fa-suitcase" style="font-size:25px;color:black"></a>
                            <div class="profile-det-info">
                                <h5><a href="" class="text-info">HSC</a></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-lg-3 col-xl-4">
            <div class="card widget-profile" style="width: 100%;height: 90%;"">
                <div class="card-body rounded" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);">
                    <div class="pro-widget-content text-center">
                        <div class="profile-info-widget" style="margin-bottom: -37px;">
                            <a class="fa fa-suitcase" style="font-size:25px;color:black"></a>
                            <div class="profile-det-info">
                                <h5><a href="" class="text-info">UG</a></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-lg-3 col-xl-4">
            <div class="card widget-profile" style="width: 100%;height: 90%;"">
                <div class="card-body rounded" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);">
                    <div class="pro-widget-content text-center">
                        <div class="profile-info-widget" style="margin-bottom: -37px;">
                            <a class="fa fa-suitcase" style="font-size:25px;color:black"></a>
                            <div class="profile-det-info">
                                <h5><a href="" class="text-info">PG</a></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="form-group test">
    <label for="exampleFormControlSelect7">Verification</label>
    <select class="form-control btn-pill digits" id="exampleFormControlSelect7">
       <option>Verified</option>
       <option>Partitally Verified</option>
    </select>
 </div>
@endsection
@section("script")

@endsection
