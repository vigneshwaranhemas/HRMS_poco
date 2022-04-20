@extends('layouts.simple.hr_master')
@section('title', 'On Boarding')

@section('css')
<link rel="stylesheet" type="text/css" href="{{url("assets/css/datatables.css")}}">
<link rel="stylesheet" type="text/css" href="{{url('assets/css/datatable-extension.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
	<h2><span>On Boarding</span></h2>
@endsection

@section('breadcrumb-items')
   <li class="breadcrumb-item">On Boarding</li>
	{{-- <li class="breadcrumb-item active">Default</li> --}}
@endsection

@section('content')



<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
               <div class="card-body">
                  <div class="dt-ext table-responsive">
                    <table class="display" id="export-button">
                        <thead>
                           <tr>
                              <th>#</th>
                              <th>EMPLOYEE ID</th>
                              <th>NAME</th>
                              <th>EMAIL</th>
                              <th>MOBILE NUMBER</th>
                              <th>INDUCTION MAIL</th>
                              <th>BUDDY MAIL</th>
                              <th>ACTION</th>
                           </tr>
                        </thead>
                        <tbody>
                            @if (count($candidate_info) > 0)
                                                    <?php $i=1;?>
                                                      @foreach ($candidate_info as  $info)
                                                           <tr>
                                                               <td>{{$i}}</td>
                                                               <td>{{$info["cdID"]}}</td>
                                                               <td>{{$info["candidate_name"]}}</td>
                                                               <td>{{$info["candidate_email"]}}</td>
                                                               <td>{{$info["candidate_mobile"]}}</td>
                                                                 @if ($info["Induction_mail"]==1)
                                                                  <?php $color="green";?>
                                                                  <?php $class="fa-check";?>
                                                                 @else
                                                                   <?php $class="fa-times";?>
                                                                   <?php $color="red;" ?>
                                                                 @endif

                                                                 @if ($info["Buddy_mail"]==1)
                                                                 <?php $color1="green";?>
                                                                 <?php $class1="fa-check";?>
                                                                @else
                                                                  <?php $class1="fa-times";?>
                                                                  <?php $color1="red;" ?>
                                                                @endif
                                                               <td><p style="color:{{$color}}" class="fa {{$class}}"></p></td>
                                                               <td><p style="color:{{$color1}}" class="fa {{$class1}}"></p></td>
                                                               <td>
                                                                <a onclick=model_trigger("{{$info["cdID"]}}") href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                                <a href="{{url("userdocuments")}}"><i class="fa fa-file-image-o"></i><a>
                                                            </td>
                                                           </tr>
                                                         <?php $i++;?>
                                                      @endforeach
                                                  @else

                                                  @endif

                        </tbody>
                     </table>
                     <input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token">
                  </div>
               </div>
            </div>
         </div>

    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Employee Id Creation</h5>
             <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
              <label>Enter Employee Id</label>
              <input type="text" class="form-control" id="NewEmpId">
          </div>
          <div class="modal-footer">
             <button class="btn btn-primary" type="button"  data-dismiss="modal">Close</button>
             <button class="btn btn-secondary" type="button" id="EmpIdCreationBtn" data-dismiss="modal">Save changes</button>
             <input type="hidden" id="emp_hidden_id">
          </div>
       </div>
    </div>
 </div>
@endsection
@section('script')
@endsection
<script>
    var email_and_seat_request_url="{{url('Email_and_Seat_request')}}";
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="../pro_js/Hrss/OnBoarding.js"></script>
