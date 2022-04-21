@extends('layouts.simple.buddy_master')
@section('title', 'Premium Admin Template')

@section('css')
    <link rel="stylesheet" type="text/css" href="../assets/css/fontawesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="../assets/css/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="../assets/css/themify.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="../assets/css/feather-icon.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/animate.css">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="../assets/css/datatables.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/owlcarousel.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/rating.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/pe7-icon.css">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <link id="color" rel="stylesheet" href="../assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="../assets/css/responsive.css">
@endsection

@section('style')
<style>
    .modal
    {
        padding-right: 59% !important;
    }
    .table thead th
    {
        border-bottom: 2px solid #dee2e6 !important;
        border: 2px solid #dee2e6;
        width: 1px;
    }
    .table tr
    {
        border-bottom: 2px solid #dee2e6 !important;
        border: 2px solid #dee2e6;
    }
    .table td
    {
        border-bottom: 2px solid #dee2e6 !important;
        border: 2px solid #dee2e6;
    }
    .word-warpped
    {
        word-break: break-word;
        max-width: 160px;
        min-width: 160px;
        /* max-width: 160px; */
        min-width: 356px;
    }
    .remark
    {
        min-width: 286px;

    }
</style>
@endsection

@section('breadcrumb-title')
	<h2>HR Buddy</h2>
@endsection

@section('breadcrumb-items')
   <li class="breadcrumb-item">Dashboard</li>
	<li class="breadcrumb-item active">Default</li>
@endsection

@section('content')
 <!-- Container-fluid starts-->
 <div class="container-fluid">
    <div class="row">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                <div class="dt-ext table-responsive">
                    <table class="display" id="Buddy_info_table">
                    <thead>
                        <tr>
                        <th>EmployeeId</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile Number</th>
                        <th>FeedBack</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($candidate_info)>0)
                        @foreach ($candidate_info as $item)
                        <tr>
                            <td>{{$item->cdID }}</td>
                            <td>{{$item->candidate_name }}</td>
                            <td>{{$item->candidate_email }}</td>
                            <td>{{$item->candidate_mobile }}</td>
                            <td>
                                <button onclick=showAdd("{{$item->cdID}}") aria-expanded="false" data-toggle="dropdown" class="btn btn-default dropdown-toggle waves-effect waves-light" type="button"><i class="fa fa-eye" aria-hidden="true"></i></button>
                            </td>
                        </tr>
                     @endforeach
            @else
                   <tr><td>No Data Available</td></tr>;
            @endif
                        {{-- <tr>
                            <td>Emp102</td>
                            <td>Linda Craver</td>
                            <td>Lindacraver@example.com</td>
                            <td>8747638735</td>
                            <td>
                                <a onclick="showAdd()" class="badge badge-danger" type="button" data-original-title="btn btn-danger btn-xs" title=""><i class="icofont icofont-eye" style="color: #fff;"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>Emp103</td>
                            <td>Jenni Sims</td>
                            <td>Jennisims@example.com</td>
                            <td>9876535487</td>
                            <td>
                                <a onclick="showAdd()" class="badge badge-danger" type="button" data-original-title="btn btn-danger btn-xs" title=""><i class="icofont icofont-eye" style="color: #fff;"></i></a>
                            </td>
                        </tr> --}}
                    </tbody>
                    </table>
                </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->

<div class="modal fade" id="edit-column-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 261%;">
            <div class="modal-body">
                <table class="table table-custom dtable-striped table-bordered" style="width: -webkit-fill-available;">
                    <thead>
                        <tr>
                            <th scope="col" rowspan="2">No</th>
                            <th scope="col" rowspan="2">Question / Query</th>
                            <th scope="col" colspan="6" class="text-center">Response</th>
                        </tr>
                        <tr>
                            <th scope="col">STRONGLY DISAGREE</th>
                            <th scope="col">DISAGREE</th>
                            <th scope="col">NEITEHR AGREE NOR DISAGREE</th>
                            <th scope="col">AGREE</th>
                            <th scope="col">STRONGLY AGREE</th>
                            <th scope="col">Remarks</th>
                        </tr>
                        </thead>

                    <tbody id="buddy_feedback_tableId">
                        <tr>
                        <th scope="row">1</th>
                        <td><p class="word-warpped">My Buddy interacted with me pleasantly during the welcome session which helped me be comfortable and  bond well</p> </td>

                        <td>
                            <div class="text-center">
                                <p style="color:green" class="fa fa-check"></p>
                            </div>
                        </td>

                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                        <td class="remark">none</td>


                        </tr>
                        {{-- <tr>
                        <th scope="row">2</th>
                        <td><p class="word-warpped">My Buddy gave me valuable and timely information about the Company and Work culture which helped me settle in well  without any confusion/ambiguity</p></td>
                        <td></td>
                        <td><p style="color:green" class="fa fa-check"></p></td>
                        <td></td>
                        <td></td>
                        <td></td>

                        <td class="remark">none</td>

                        </tr>
                        <tr>
                        <th scope="row">3</th>
                        <td><p class="word-warpped">My Buddy is well informed about the Company's Whos Who, Businesses, Processes, Policies etc and was able to answer all queries to my satisfaction</p></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><p style="color:green" class="fa fa-check"></p></td>

                            <td class="remark">none</td>

                        </tr>
                        <tr>
                        <th scope="row">4</th>
                        <td><p class="word-warpped">My Buddy made me feel at ease while facilitating interactions with Functional/Dept Heads, Team Leads, My Peers and Colleagues</p></td>
                            <td></td>
                            <td></td>
                            <td><p style="color:green" class="fa fa-check"></p></td>
                            <td></td>
                            <td></td>

                            <td class="remark">none</td>

                        </tr>
                        <tr>
                        <th scope="row">5</th>
                        <td><p class="word-warpped">My Buddy was able to attend to all my concerns and helped me well to overcome my initial hesitations/sckepticism if any</p></td>
                            <td><p style="color:green" class="fa fa-check"></p></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>

                            <td class="remark">none</td>

                        </tr>
                        <tr>
                        <th scope="row">6</th>
                        <td><p class="word-warpped">My Buddy was able to attend to all my concerns and helped me well to overcome my initial hesitations/sckepticism if any</p></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><p style="color:green" class="fa fa-check"></p></td>
                            <td></td>

                            <td class="remark">none</td>
                        </tr> --}}
                    </tbody>
                </table>
                <div class="modal-body" id="textarea_div">

                </div>
                {{-- <div class="row" style="margin-top: 40px;">
                <div class="row" style="margin-top: 40px;">


                <div class="modal-body" id="textarea_div">

                </div>
                {{-- <div class="row" style="margin-top: 40px;">
                <div class="row" style="margin-top: 40px;">
                    <div class="col-md-12">
                        <h6>7.  What went very well, during  my interactions with my Buddy</h6>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="card">
                            <div class="card-body grid-showcase">

                                <p>No </p>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="card">
                            <div class="card-body grid-showcase">
                                <p>Auto-layout for flexbox grid columns also means you can set the width of one column and have the sibling columns automatically resize around it. You may use predefined grid classes (as shown below), grid mixins, or inline widths. Note that the other columns will resize no matter the width of the center column.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="card">
                            <div class="card-body grid-showcase">
                                <p>Auto-layout for flexbox grid columns also means you can set the width of one column and have the sibling columns automatically resize around it. You may use predefined grid classes (as shown below), grid mixins, or inline widths. Note that the other columns will resize no matter the width of the center column.</p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row" style="margin-top: 40px;">

                    <div class="col-md-12">
                        <h6>8.  What went very well, during  my interactions with my Buddy</h6>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="card">
                            <div class="card-body grid-showcase">
                                <p>Auto-layout for flexbox grid columns also means you can set the width of one column and have the sibling columns automatically resize around it. You may use predefined grid classes (as shown below), grid mixins, or inline widths. Note that the other columns will resize no matter the width of the center column.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="card">
                            <div class="card-body grid-showcase">
                                <p>Auto-layout for flexbox grid columns also means you can set the width of one column and have the sibling columns automatically resize around it. You may use predefined grid classes (as shown below), grid mixins, or inline widths. Note that the other columns will resize no matter the width of the center column.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="card">
                            <div class="card-body grid-showcase">
                                <p>Auto-layout for flexbox grid columns also means you can set the width of one column and have the sibling columns automatically resize around it. You may use predefined grid classes (as shown below), grid mixins, or inline widths. Note that the other columns will resize no matter the width of the center column.</p>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="../pro_js/buddy/buddy.js"></script>
@section('script')
    <!-- latest jquery-->

    <script>
        // function showAdd() {
        //     $('#edit-column-form').modal('show');
        // }
    </script>
@endsection

