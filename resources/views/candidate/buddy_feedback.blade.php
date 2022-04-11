@extends('layouts.simple.candidate_master')
@section('title', 'Buddy Feedback')

@section('css')
<link rel="stylesheet" type="text/css" href="{{url('assets/css/prism.css')}}">
    <!-- Plugins css start-->
@endsection

@section('style')
<style>
.table th
{
    width:1px;
}
.table th
{
    border: 1px solid #dee2e6;
}
.table td
{
    border: 1px solid #dee2e6;
}
.buddy_list
{
    padding-bottom: 50px;
}
</style>
@endsection

@section('breadcrumb-title')
	<h2>Buddy<span>Feedback </span></h2>
@endsection

@section('breadcrumb-items')
   <li class="breadcrumb-item">Buddy Feedback</li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
          <div class="card">
               <div class="card-body">
                  <div class="row buddy_list">
                     <div class="col-md-3">
                        <p>Employee Number</p>
                        <p>Employee Name</p>
                        <p>Department</p>
                        <p>Designation</p>
                        <p>Date of Joining</p>
                        <p>Work Location</p>
                        <p>Buddy Assigned </p>
                    </div>
                    <div class="col-md-3" style="margin-left: -53px;">
                        {{-- @foreach ($buddy_fields["user_info"] as $item)
                            <p>: {{$item->cdID}} </p>
                            <p>: {{$item->candidate_name}}</p>
                            <p>: {{$item->or_department}} </p>
                            <p>: PHP Developer</p>
                            <p>: {{$item->or_doj}}</p>
                            <p>: Cuddalore</p>
                            <p>: SHANTHI</p>

                        @endforeach --}}
                        {{-- <p>: {{}}</p> --}}
                        <p>: Ram</p>
                        <p>: IT</p>
                        <p>: PHP Developer</p>
                        <p>: 19-03-2022</p>
                        <p>: WFH</p>
                        <p>: Cudddalore</p>
                        <p>: SHANTHI</p>

                    </div>

                  </div>
                  <div class="modal-body" style="margin-left: -14px;">
                    <table class="table table-custom dtable-striped table-bordered" style="width: max-content;" id="buddy_feedbacktable">
                        <thead>
                          <tr>
                            <th scope="col" rowspan="2">S.No</th>
                            <th scope="col" rowspan="2">Question / Query</th>
                            <th scope="col" colspan="5" class="text-center">Response</th>
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
                        <tbody>
                            <tr class="countable_rows">
                            <td>1</td>
                            <td>My Buddy interacted with me pleasantly during the welcome session which helped me be comfortable and bond well </td>
                            <td class="text-center"><input type="checkbox"  value="1"   class="buddycheckboxchecker" name="buddy"></td>
                            <td class="text-center"><input type="checkbox"  value="2"   class="buddy checkboxchecker" name="buddy"></td>
                            <td class="text-center"><input type="checkbox"  value="3"    class="buddy checkboxchecker" name="buddy"></td>
                            <td class="text-center"><input type="checkbox"  value="4"    class="buddy checkboxchecker" name="buddy"></td>
                            <td class="text-center"><input type="checkbox"  value="5"   class="buddycheckboxchecker" name="buddy"></td>
                            <td>
                                <textarea  class="form-control" style="width: 178px; height:52px;"></textarea>
                            </td>
                            </tr>
                            <tr class="countable_rows">
                                <td>2</td>
                                <td>My Buddy gave me valuable and timely information about the Company and Work culture which helped me settle in well without any confusion/ambiguity</td>
                                <td class="text-center"><input type="checkbox"  value="1"   class="buddycheckboxchecker" name="buddy"></td>
                                <td class="text-center"><input type="checkbox"  value="2"   class="buddy checkboxchecker" name="buddy"></td>
                                <td class="text-center"><input type="checkbox"  value="3"    class="buddy checkboxchecker" name="buddy"></td>
                                <td class="text-center"><input type="checkbox"  value="4"    class="buddy checkboxchecker" name="buddy"></td>
                                <td class="text-center"><input type="checkbox"  value="5"   class="buddycheckboxchecker" name="buddy"></td>
                                <td>
                                    <textarea class="form-control"></textarea>
                                </td>
                                </tr>
                                <tr class="countable_rows">
                                    <td>3</td>
                                    <td>My Buddy is well informed about the Company's Whos Who, Businesses, Processes, Policies etc and was able to answer all queries to my satisfaction</td>
                                    <td class="text-center"><input type="checkbox"  value="1"   class="buddycheckboxchecker" name="buddy"></td>
                                    <td class="text-center"><input type="checkbox"  value="2"   class="buddy checkboxchecker" name="buddy"></td>
                                    <td class="text-center"><input type="checkbox"  value="3"    class="buddy checkboxchecker" name="buddy"></td>
                                    <td class="text-center"><input type="checkbox"  value="4"    class="buddy checkboxchecker" name="buddy"></td>
                                    <td class="text-center"><input type="checkbox"  value="5"   class="buddycheckboxchecker" name="buddy"></td>
                                    <td>
                                        <textarea class="form-control"></textarea>
                                    </td>
                                    </tr>
                                    <tr class="countable_rows">
                                        <td>4</td>
                                        <td>My Buddy is well informed about the Company's Whos Who, Businesses, Processes, Policies etc and was able to answer all queries to my satisfaction</td>
                                        <td class="text-center"><input type="checkbox"  value="1"   class="buddycheckboxchecker" name="buddy"></td>
                                        <td class="text-center"><input type="checkbox"  value="2"   class="buddy checkboxchecker" name="buddy"></td>
                                        <td class="text-center"><input type="checkbox"  value="3"    class="buddy checkboxchecker" name="buddy"></td>
                                        <td class="text-center"><input type="checkbox"  value="4"    class="buddy checkboxchecker" name="buddy"></td>
                                        <td class="text-center"><input type="checkbox"  value="5"   class="buddycheckboxchecker" name="buddy"></td>
                                        <td>
                                            <textarea class="form-control"></textarea>
                                        </td>
                                        </tr>
                                        <tr class="countable_rows">
                                            <td>5</td>
                                            <td>My Buddy was able to attend to all my concerns and helped me well to overcome my initial hesitations/sckepticism if any</td>
                                            <td class="text-center"><input type="checkbox"  value="1"   class="buddycheckboxchecker" name="buddy"></td>
                                            <td class="text-center"><input type="checkbox"  value="2"   class="buddy checkboxchecker" name="buddy"></td>
                                            <td class="text-center"><input type="checkbox"  value="3"    class="buddy checkboxchecker" name="buddy"></td>
                                            <td class="text-center"><input type="checkbox"  value="4"    class="buddy checkboxchecker" name="buddy"></td>
                                            <td class="text-center"><input type="checkbox"  value="5"   class="buddycheckboxchecker" name="buddy"></td>
                                            <td>
                                                <textarea class="form-control"></textarea>
                                            </td>
                                            </tr>
                                            <tr class="countable_rows">
                                                <td>6</td>
                                                <td>My Buddy was able to attend to all my concerns and helped me well to overcome my initial hesitations/sckepticism if any</td>
                                                <td class="text-center"><input type="checkbox"  value="1"   class="buddycheckboxchecker" name="buddy"></td>
                                                <td class="text-center"><input type="checkbox"  value="2"   class="buddy checkboxchecker" name="buddy"></td>
                                                <td class="text-center"><input type="checkbox"  value="3"    class="buddy checkboxchecker" name="buddy"></td>
                                                <td class="text-center"><input type="checkbox"  value="4"    class="buddy checkboxchecker" name="buddy"></td>
                                                <td class="text-center"><input type="checkbox"  value="5"   class="buddycheckboxchecker" name="buddy"></td>
                                                <td>
                                                    <textarea class="form-control"></textarea>
                                                </td>
                                                </tr>
                        </tbody>
                      </table>



                </div>
                <div class="modal-body">
                    <div class="row">
                            <div class="col-sm-12" id="target">
                                <p>7.What went very well, during my interactions with my Buddy</p>
                                <div class="form-group row">

                                    <div class="col-sm-4">
                                        <textarea class="form-control"></textarea>
                                    </div>
                                    <div class="col-sm-4">
                                        <textarea class="form-control"></textarea>
                                     </div>
                                     <div class="col-sm-4">
                                        <textarea class="form-control"></textarea>
                                     </div>
                                 </div>
                                 <p>8.What went very well, during my interactions with my Buddy </p>
                                 <div class="form-group row">

                                     <div class="col-sm-4">
                                         <textarea class="form-control"></textarea>
                                     </div>
                                     <div class="col-sm-4">
                                         <textarea class="form-control"></textarea>
                                      </div>
                                      <div class="col-sm-4">
                                         <textarea class="form-control"></textarea>
                                      </div>
                                  </div>
                                  <p>9.My suggestions for the Buddy Program to provide better experience to Future New Joiners </p>
                                  <div class="form-group row">

                                      <div class="col-sm-4">
                                          <textarea class="form-control"></textarea>
                                      </div>
                                      <div class="col-sm-4">
                                          <textarea class="form-control"></textarea>
                                       </div>
                                       <div class="col-sm-4">
                                          <textarea class="form-control"></textarea>
                                       </div>
                                   </div>





                                {{-- <p>Question 7 </p>
                                <input type="hidden" id="field"  value=""></td>
                                <div class="col-sm-4">
                                    <textarea></textarea>
                                </div>
                                <div class="col-sm-4">
                                    <textarea></textarea>
                                </div>
                                <div class="col-sm-4">
                                    <textarea></textarea>
                                </div> --}}
                            </div>
                    </div>
                </div>





               </div>


          </div>

        </div>
    </div>
</div>

@endsection
