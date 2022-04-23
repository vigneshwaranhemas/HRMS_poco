@extends('layouts.simple.admin_master')
@section('title', 'Seating Request')

@section('css')
<link rel="stylesheet" type="text/css" href="{{url("assets/css/datatables.css")}}">
<link rel="stylesheet" type="text/css" href="{{url('assets/css/datatable-extension.css')}}">
@endsection

@section('style')

<style>
  .bg-info
    {
        background-color: #7e37d8 !important;
    }
 </style>

@endsection

@section('breadcrumb-title')
	<h2><span>Candidate Seating</span></h2>
@endsection

@section('breadcrumb-items')
   <li class="breadcrumb-item">Candidate Seating And IdCard Request</li>

	{{-- <li class="breadcrumb-item active">Default</li> --}}
@endsection

@section('content')



<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                     <div class="col-md-6 text-left">
                     <h5>Candidate Seating And IdCard Request</h5>
                     </div>

                     <div class="col-md-6 text-right">
                     <button type="button" class="btn btn-primary" id="StatusUpdateBtn">Save changes</button>
                     </div>
                    </div>
                </div>
               <div class="card-body">
                  <div class="dt-ext table-responsive">
                    <table class="display" id="export-button">
                        <thead>
                           <tr>
                              <th>#</th>
                              <th>VERIFIED</th>
                              <th>EMPLOYEE ID</th>
                              <th>NAME</th>
                              <th>EMAIL</th>
                              <th>MOBILE NUMBER</th>
                              <th>SEATING STATUS</th>
                              <th>IDCARD  STATUS</th>
                           </tr>
                        </thead>
                        <tbody>
                           @if (count($seating_info)>0)
                                 <?php $i=1;?>
                                 @foreach ($seating_info as $data)
                                     <td>{{$i}}</td>
                                     <td><input type="checkbox"><input type="hidden" value="{{$data['empId']}}"></td>
                                     <td>{{$data['empId']}}</td>
                                     <td>{{$data['candidate_name']}}</td>
                                     <td>{{$data['candidate_email']}}</td>
                                     <td>{{$data['candidate_mobile']}}</td>
                                     <td>
                                        <div class="media-body text-center icon-state">
                                            <label class="switch">
                                            <input type="checkbox" {{$data['Seating_Request'] == 0 ? '' : 'checked'}}  onchange=model_trigger("{{$data['empId']}}",1)><span class="switch-state bg-info"></span>
                                            </label>
                                         </div>
                                        </td>
                                        <td>
                                            <div class="media-body text-center icon-state">
                                                <label class="switch">
                                                <input type="checkbox" {{$data['IdCard_status'] == 0 ? '' : 'checked'}}  onchange=model_trigger1("{{$data['empId']}}",2)><span class="switch-state bg-info"></span>
                                                </label>
                                             </div>
                                            </td>
                                        </tr>

                                    <?php $i++; ?>
                                 @endforeach
                           @endif
                        </tbody>
                     </table>
                     <input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token">
                     {{-- <button type="button" id="AdminUpdateBtn"><button> --}}
                  </div>
               </div>
            </div>
         </div>

    </div>
</div>

{{-- div popup model --}}

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Seating Request</h5>
             <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">Are you sure to confirm  that seating was alloted to this employee!...</div>
          <div class="modal-footer">
             <button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>
             <button class="btn btn-secondary" type="button" data-dismiss="modal" id="SeatingRequestBtn">Save changes</button>
             <input type="hidden" id="hidden_seat">
             <input type="hidden" id="hidden_status">
          </div>
       </div>
    </div>
 </div>
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Seating Request</h5>
             <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">Are you sure to confirm  that IdCard was Created to this employee!...</div>
          <div class="modal-footer">
             <button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>
             <button class="btn btn-secondary" type="button" data-dismiss="modal" id="SeatingRequestBtn1">Save changes</button>
             <input type="hidden" id="hidden_seat1">
             <input type="hidden" id="hidden_status1">
          </div>
       </div>
    </div>
 </div>


@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{url('pro_js/admin/Seating_Request.js')}}">
</script>
<script>
var Seating_url="Admin_Seating_Request";
var Status_update="Admin_Request_update";
</script>
@section('script')

@endsection
