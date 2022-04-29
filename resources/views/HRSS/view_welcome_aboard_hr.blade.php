@extends('layouts.simple.hr_master')
@section('title', 'Welcome Aboard')

@section('css')
<link rel="stylesheet" type="text/css" href="../assets/css/prism.css">
    <!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="../assets/css/chartist.css">
<link rel="stylesheet" type="text/css" href="../assets/css/date-picker.css">

<!-- summernote csss -->
<link rel="stylesheet" type="text/css" href="../assets/css/summernote.css">

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
    /* border-bottom: 1px solid #ccc; */
    color: #555;
    box-sizing: border-box;
    font-family: "Arvo";
    font-size: 18px;
    width: 100px;
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
    /* label{
        font-weight: bold;
        color: #008CBA;
    } */

</style>
@endsection

@section('breadcrumb-title')
	<h2>Welcome Aboard<span> </span></h2>
@endsection

@section('breadcrumb-items')
    {{-- <a href="{{ url('welcome_aboard') }}"><button class="btn btn-primary" type="button">Add Welcome Aboard</button></a> --}}
   {{-- <li class="breadcrumb-item">Dashboard</li>
	<li class="breadcrumb-item active">Default</li> --}}
@endsection

@section('content')

  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
          <form method="POST" action="javascript:void(0);" id="add_welcome_aboard">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="javascript:void(0);" id="add_welcome_aboard_image" >
                        <div class="card-body editor">
                            <div class="summernote" id="summernote" name="summernote">
                            </div>
                        </div>
                        {{-- <input type="text" name="krish_na" id="krish_na"><br> --}}
                        <div class="card-body editor">
                            <div class="summernote" id="summernote_copy" name="summernote_copy">
                            </div>
                        </div>
                        <div class="text-center">
                            {{-- <a href="{{url('welcome_aboard_generate_image')}}"> --}}
                                <button class="btn btn-primary-gradien mb-5" type="submit" id="btnSubmit">Export</button>
                            {{-- </a> --}}
                        </div>
                        <img src="../assets/images/image_generator/image.jpg" alt="image_generator">
                        {{-- <a href="{{url('welcome_aboard_generate_image')}}">
                            <button class="btn btn-primary-gradien mb-5" type="submit" id="btnSubmit">Export</button>
                        </a> --}}
                    </form>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Container-fluid Ends-->


@endsection

@section('script')

<script src="../assets/pro_js/view_welcome_aboard_hr.js"></script>

<!-- summernote js -->
<script src="../assets/js/editor/summernote/summernote.js"></script>
<script src="../assets/js/editor/summernote/summernote.custom.js"></script>

<script>
var add_welcome_aboard_process_link = "{{url('add_welcome_aboard_process')}}";
var get_welcome_aboard_details_link = "{{url('get_welcome_aboard_details')}}";

$(()=>{
    $('#btnSubmit').on('click',(e)=>{
    //    alert("abc");
   e.preventDefault();
   var summernote_get = $('#summernote_copy').summernote('code').replace(/<\/?[^>]+(>|$)/g, " ");
//    var summernote_get = $("#summernote_copy").summernote().replace(/<\/?[^>]+(>|$)/g, "");
//    alert(summernote_get)


    console.log(summernote_get)

   $.ajax({
       url:welcome_aboard_generate_image_link,
       type:"POST",
       data: $("#add_welcome_aboard_image").serialize() + "&summernote_get=" + summernote_get,
       dataType:"json",
       success:function(data) {
        //    alert('sdf')
           console.log(data);

           if(data.response =='success'){
                location.reload();
           }
       },

   });
    })
})

var welcome_aboard_generate_image_link = "{{url('welcome_aboard_generate_image') }}";
</script>
@endsection
