@extends('layouts.simple.candidate_master')
@section('title', 'Welcome Aboard')

@section('css')
<link rel="stylesheet" type="text/css" href="../assets/css/prism.css">
    <!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="../assets/css/chartist.css">
<link rel="stylesheet" type="text/css" href="../assets/css/date-picker.css">

@endsection

@section('style')
<style>
    .card-body p{
        margin-bottom: 3% !important;
        font-size: 15px !important;
    }
    .card-body td{
        margin-bottom: 3% !important;
        font-size: 15px !important;
        padding-bottom: 43px;
        padding-left: 0px;
    }
    .card-body h5{
        margin-bottom: 3% !important;
    }

    /* input field css start*/
    .input {
    background-color: transparent;
    border: none;
    border-bottom: 1px solid #ccc;
    color: #555;
    box-sizing: border-box;
    font-family: "Arvo";
    font-size: 18px;
    width: 200px;
    color: #008CBA;
    }

    input::-webkit-input-placeholder {
    color: #aaa;
    }

    input:focus::-webkit-input-placeholder {
    color: dodgerblue;
    }

    .input:focus + .underline {
    transform: scale(1);
    }
    /* input field css end*/

    .table td
    {
        border-top: none !important;
    }

    .editor
    {
        margin-left: -49px;
        margin-top: -58px;
    }

    .interesting_facts
    {
        width: 70%;
    }
    .text-warning
    {
        color: #ff0000!important;
    }
    .card-header
    {
        background-color: rgba(0,0,0,0.03) !important;
        padding: 28px !important;
    }
    .card .card-header .card-header-right
    {
        top: 19px !important;
    }
    .card .card-body
    {
        padding: 28px !important;
    }


</style>
@endsection

@section('breadcrumb-title')
	<h2>Payslip<span> </span></h2>
@endsection

@section('breadcrumb-items')
   {{-- <li class="breadcrumb-item">Dashboard</li>
	<li class="breadcrumb-item active">Default</li> --}}
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">

        <div class="col-sm-12 col-xl-6 xl-100">
            <div class="card">
               <div class="card-header">
                  <h5>Tabs Vertical</h5>
               </div>
               <div class="card-body">
                  <div class="row">
                     <div class="col-sm-3 col-xs-12">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical"><a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Home</a><a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</a><a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Messages</a><a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</a></div>
                     </div>
                     <div class="col-sm-9 col-xs-12">
                        <div class="tab-content" id="v-pills-tabContent">
                           <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                           </div>
                           <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
                           </div>
                           <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
                           </div>
                           <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>

    </div>
</div>


@endsection

@section('script')

<script src="../assets/pro_js/view_welcome_aboard.js"></script>

<script>
var add_welcome_aboard_process_link = "{{url('add_welcome_aboard_process')}}";
var get_welcome_aboard_details_link = "{{url('get_welcome_aboard_details')}}";
</script>
@endsection
