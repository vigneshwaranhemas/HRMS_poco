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
        @if (count(array($user_documents))>0)
             @if(!empty($user_documents->education_details))
                <div class="col-md-3 col-lg-3 col-xl-4">
                    <div class="card widget-profile" style="width: 100%;height: 90%;"">
                        <div class="card-body rounded" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);">
                            <div class="pro-widget-content text-center">
                                <div class="profile-info-widget" style="margin-bottom: -37px;">
                                    <a class="fa fa-suitcase" style="font-size:25px;color:black"></a>
                                    <div class="profile-det-info">
                                        <h5><a href='{{url('Documents/'.$user_documents->education_details)}}' target="_blank" class="text-info">Education</a></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
            @endif

             @if (!empty($user_documents->experience))
                <div class="col-md-3 col-lg-3 col-xl-4">
                    <div class="card widget-profile" style="width: 100%;height: 90%;"">
                        <div class="card-body rounded" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);">
                            <div class="pro-widget-content text-center">
                                <div class="profile-info-widget" style="margin-bottom: -37px;">
                                    <a class="fa fa-suitcase" style="font-size:25px;color:black"></a>
                                    <div class="profile-det-info">
                                        <h5><a href='{{url('Documents/'.$user_documents->experience)}}' class="text-info">Experience</a></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if (!empty($user_documents->benefites))
                <div class="col-md-3 col-lg-3 col-xl-4">
                    <div class="card widget-profile" style="width: 100%;height: 90%;"">
                        <div class="card-body rounded" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);">
                            <div class="pro-widget-content text-center">
                                <div class="profile-info-widget" style="margin-bottom: -37px;">
                                    <a class="fa fa-suitcase" style="font-size:25px;color:black"></a>
                                    <div class="profile-det-info">
                                        <h5><a href='{{url('Documents/'.$user_documents->benefites)}}' class="text-info">Benefits</a></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if (!empty($user_documents->documents))
                <div class="col-md-3 col-lg-3 col-xl-4">
                    <div class="card widget-profile" style="width: 100%;height: 90%;"">
                        <div class="card-body rounded" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);">
                            <div class="pro-widget-content text-center">
                                <div class="profile-info-widget" style="margin-bottom: -37px;">
                                    <a class="fa fa-suitcase" style="font-size:25px;color:black"></a>
                                    <div class="profile-det-info">
                                        <h5><a href='{{url('Documents/'.$user_documents->doc_path)}}' class="text-info">{{$user_documents->documents}}</a></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
     @endif
    </div>
</div>
<div class="form-group test">
    <label for="exampleFormControlSelect7">Status</label>
    <select class="form-control btn-pill digits" id="userDocStatus">
       <option  {{$user_documents->doc_status == 0 ? 'selected' :'' }} value="0">Choose</option>
       <option  {{$user_documents->doc_status == 2 ? 'selected' :'' }} value="2">Verified</option>
       <option  {{$user_documents->doc_status == 1 ? 'selected' :'' }} value="1">Partitally Verified</option>
    </select><br>
   <button type="button" class="btn btn-primary" id="DocStatusBtn">Submit</button>
 </div>
@endsection
@section("script")

@endsection
<script>
    var DocumentStatusurl="{{url('DocumentStatusUpdate')}}";
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="../pro_js/Hrss/OnBoarding.js"></script>
