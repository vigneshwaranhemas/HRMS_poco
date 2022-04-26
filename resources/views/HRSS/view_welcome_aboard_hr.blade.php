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
    label{
        font-weight: bold;
        color: #008CBA;
    }

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

var test_div="<p style='text-align: justify;'>Dear Newbie at HEMA’s!  We are delighted that you are onboard our inspiring HEMA’s bandwagon and we would like to share the joy with all our team mates!  Please help us with interesting information about you, which you would like our HEMA’s Fraternity Fellas to know. </p>\
<p style='text-align: justify;'>Here’s a template which could be of help to you, to introduce yourself. Disclosing of Facts in this Sheet is entirely Voluntary.You may choose to answer/omit any queries listed in the DID YOU KNOW Section.</p>\
<p>I <label id='name'></label> have joined as <label id='designation'></label> at <label id='department'></label> today / on <label id='today_date'></label></p>\
<h5><b>EDUCATION (in chronological order, starting from the oldest to the latest)</b></h5>\
<table class='table' id='education-tb'>\
                        <thead>\
                        </thead>\
                        <tbody>\
                            <tr id='did_my'>\
                            </tr>\
                        </tbody>\
                    </table>\
                    <h5 style='margin-top: 37px;'><b>My Achievements in Education,which I’d like my peers to know : </b></h5>\
                    <div class='card-body editor'>\
                        <div id='achievements_education' name='achievements_education'>\
                        </div>\
                    </div>\
                    <h5><b>WORK EXPERIENCE  (in chronological order, starting from the oldest to the latest) </b></h5>\
                    <p>I Started my professional Career in <label id='work_in'></label> and as <label id='work_designation'></label> (designation) and worked there for about <label id='work_years'></label> Years  and </p>\
                    <table class='table' id='work-tb'>\
                        <thead>\
                        </thead>\
                        <tbody>\
                            <tr id='work_experience'>\
                            </tr>\
                        </tbody>\
                    </table>\
                    <p style='margin-top: 33px;'>My Recent Work Experience before Joining HEMA’s was at <label id='joining_at'></label> As <label id='joining_as'></label></p>\
                    <h5><b>My Achievements at Work , which I’d like my peers to know : </b></h5>\
                    <div class='card-body editor'>\
                            <div name='achievements_work' id='achievements_work'>\
                            </div>\
                        </div>\
                    <h5><b>DID YOU KNOW SECTION: </b></h5>\
                    <h5><b>Some Interesting facts about me, on the personal front, which I’d like to share with my peers : </b></h5>\
                    <p>My favorite pastime/ pursuits <label id='my_favorite_pastime'></label> </p>\
                    <p>My favorite hobbies <label id='my_favorite_hobbies'></label> </p>\
                    <p>Three places Id love to visit <label id='my_favorite_places'></label> </p>\
                    <p>Three Foods I relish <label id='my_favorite_foods'></label> </p>\
                    <p>My Favorite Sports <label id='my_favorite_sports'></label> </p>\
                    <p>My Favorite Movies <label id='my_favorite_movies'></label> </p>\
                    <p>My Favorite <label id='my_favorite'></label> </p>\
                    <p>My Extracurricular Specialities  <label id='my_extracurricular_specialities'></label> </p>\
                    <p>My Career Aspirations <label id='my_career_aspirations'></label> </p>\
                    <p>I can speak these Languages fluently <label id='languages'></label> </p>\
                    <p>Some Interesting Facts about me that my peers can know! <label id='interesting_facts'></label> </p>\
                    <p>My Motto ! <label id='my_motto'></label>  </p>\
                    <p>Books that I Read / Love to Recommend <label id='books'></label> </p>\
";
$(".summernote").summernote('code',test_div);
// console.log(test_div)

$(()=>{
    $('#btnSubmit').on('click',(e)=>{
    //    alert("abc");
   e.preventDefault();
   var summernote_get = $('#summernote_copy').summernote('code').replace(/<\/?[^>]+(>|$)/g, " ");
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
