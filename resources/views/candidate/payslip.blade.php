@extends('layouts.simple.candidate_master')
@section('title', 'Payslip')

@section('css')
<link rel="stylesheet" type="text/css" href="../assets/css/prism.css">
    <!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="../assets/css/chartist.css">
<link rel="stylesheet" type="text/css" href="../assets/css/date-picker.css">

@endsection

@section('style')
<style>
    /* .card-body p{
        margin-bottom: -22% !important;
        font-size: 15px !important;
    } */
    .card-body td{
        margin-bottom: 3% !important;
        font-size: 15px !important;
        padding-bottom: 43px;
        padding-left: 0px;
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
    .list-group-items
    {
        border: 1px solid rgba(0,0,0,0.125);
        cursor: pointer;
    }
    .top-left
    {
        margin-left: 12px;
        margin-top: 9px;
    }
    .last-update
    {
        margin-left: 12px;
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
        <div class="col-sm-12 col-xl-12">
            <div class="card">
               <div class="card-header">
                  <h5>Document Center / Payslip</h5>
               </div>
               <div class="card-body">
                  <div class="row">
                     <div class="col-sm-4">
                        <div class="list-group" id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="list-home">2021</a>

                            <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="list-profile">2020</a>

                            <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="list-messages">2019</a>

                            <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="list-settings">2018</a></div>
                     </div>
                     <div class="col-sm-8">
                        <div class="tab-content" id="nav-tabContent">
                           <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">

                                <div class="list-group-items collapsed" data-toggle="collapse" data-target="#collapseicon_first" aria-expanded="false" aria-controls="collapse11">
                                    <div class="row">
                                        <div class="col-md-8">
                                        <h5 class="top-left"> March 2022</h5>
                                        </div>
                                        <div class="col-md-4">
                                        <p> Last updated on 03 Mar, 2022</p>
                                        </div>
                                    </div>
                                    <p class="last-update">Payroll for the month of Mar 2022</p>
                                </div>
                                <div class="collapse" id="collapseicon_first" aria-labelledby="collapseicon_first" data-parent="#accordionoc" style="border: 1px solid rgba(0, 0, 0, 0.125);">
                                   <div class="card-body">
                                    <a href=""><button class="btn btn-primary">Mar 2022.pdf <i class="fa fa-download"></i></button></a>
                                    </div>
                                </div>

                                <div class="list-group-items collapsed" data-toggle="collapse" data-target="#collapseicon_second" aria-expanded="true" aria-controls="collapse11">
                                    <div class="row">
                                        <div class="col-md-8">
                                        <h5 class="top-left"> Feb 2022</h5>
                                        </div>
                                        <div class="col-md-4">
                                        <p> Last updated on 03 Mar, 2022</p>
                                        </div>
                                    </div>
                                    <p class="last-update">Payroll for the month of Mar 2022</p>
                                </div>
                                <div class="collapse" id="collapseicon_second" aria-labelledby="collapseicon_second" data-parent="#accordionoc" style="border: 1px solid rgba(0, 0, 0, 0.125);">
                                   <div class="card-body">
                                    <button class="btn btn-primary">Mar 2022.pdf <i class="fa fa-download"></i></button>
                                    </div>
                                </div>

                           </div>


                           <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</div>
                           <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</div>
                           <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</div>
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
