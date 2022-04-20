<?php
// echo json_encode(count($get_education_my)); die();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Poco admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Poco admin template, dashboard template, flat admin template, responsive admin template, web app (Laravel 8)">
    <meta name="author" content="pixelstrap">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" href="../assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/images/favicon.png" type="image/x-icon">
    <title>Welcome Aboard</title>
    @include('layouts.simple.css')

<link rel="stylesheet" type="text/css" href="../assets/css/prism.css">
    <!-- Plugins css start-->
<link rel="stylesheet" type="text/css" href="../assets/css/chartist.css">
<link rel="stylesheet" type="text/css" href="../assets/css/date-picker.css">

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
    width: 150px;
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
    h2{
        text-align: center;
    }

</style>

</head>
<body>
  <!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
            <div class="card">
                <div class="card-body">

                    <h2>Welcome Aboard<span> </span></h2>

                    <p>Dear Newbie at HEMA’s!  We are delighted that you are onboard our inspiring HEMA’s bandwagon and we would like to share the joy with all our team mates!  Please help us with interesting information about you, which you would like our HEMA’s Fraternity Fellas to know. </p>

                    <p>Here’s a template which could be of help to you, to introduce yourself. Disclosing of Facts in this Sheet is entirely Voluntary.You may choose to answer/omit any queries listed in the DID YOU KNOW Section.</p>

                    <p>I <input class="input" type="text" name="name" id="name" value="{{$info['name']}}" placeholder="Enter Your Name" required readonly>(Your Name) have joined as <input type="text" class="input" name="designation" id="designation" value="{{$info['designation']}}" placeholder="Enter Your Designation" readonly>(Your designation) at <input class="input" type="text" name="department" id="department" value="{{$info['department'] }}" placeholder="Enter Your Department" readonly>(Your Department/Function)            today      /     on <input class="input" type="date" name="today_date" id="today_date" value="{{$info['today_date'] }}" placeholder="Choose The Date" readonly>    (strike off which is irrelevant)</p>

                    <h5><b>EDUCATION (in chronological order, starting from the oldest to the latest)</b></h5>
                    <table class="table" id="education-tb">
                        <thead>
                        </thead>
                        <tbody>
                            <tr>
                            <table>
                                <tbody>
                                    <?php $i=0; ?>
                                    @foreach ($info['get_education_my'] as $link)
                                    <tr>
                                        <td>I did my <input class='input' type='text' value="{{ $link }}" readonly> from <input class='input' type='text' value="{{$info['get_education_from'][$i] }}" readonly> in <input class='input' type='text' value="{{$info['get_education_in'][$i] }}" readonly><td>
                                    </tr>
                                    <?php $i++;?>
                                    @endforeach
                                </tbody>
                            </table>
                            </tr>
                        </tbody>
                    </table>

                    <h5 style="margin-top: -10px;"><b>My Achievements in Education,which I’d like my peers to know : </b></h5>

                        <div class="card-body editor">
                            <div id="achievements_education" name="achievements_education" style="margin-left: 50px;">
                                <p>{{ $info['achievements_education'] }}</p>
                            </div>
                        </div>

                    <h5><b>WORK EXPERIENCE  (in chronological order, starting from the oldest to the latest) </b></h5>

                    <p>I Started my professional Career in <input class="input" type="text" name="work_in" id="work_in" value="{{$info['work_in'] }}" readonly> and as<input class="input" type="text" name="work_designation" id="work_designation" value="{{$info['work_designation'] }}" readonly> (designation) and worked there for about<input class="input" type="text" name="work_years" id="work_years" value="{{$info['work_years'] }}" readonly> Years  and </p>

                    <table class="table" id="work-tb">
                        <thead>
                        </thead>
                        <tbody>
                            <tr>
                            <table>
                                <tbody>
                                    <?php $i=0; ?>
                                    @foreach ($info['work_experience_at'] as $link)
                                    <tr>
                                        <td>I did my <input class='input' type='text' value="{{ $link }}" readonly> from <input class='input' type='text' value="{{$info['work_experience_as'][$i] }}" readonly> in <input class='input' type='text' value="{{$info['work_experience_years'][$i] }}" readonly><td>
                                    </tr>
                                    <?php $i++;?>
                                    @endforeach
                                </tbody>
                            </table>
                            </tr>
                        </tbody>
                    </table>

                    <p style="margin-top: -10px;">My Recent Work Experience before Joining HEMA’s was at <input class="input" type="text" name="joining_at" id="joining_at" value="{{$info['joining_at'] }}" readonly> As<input class="input" type="text" name="joining_as" id="joining_as" value="{{$info['joining_as'] }}" readonly>  </p>

                    <h5><b>My Achievements at Work , which I’d like my peers to know : </b></h5>

                        <div class="card-body editor">
                            <div name="achievements_work" id="achievements_work" style="margin-left: 50px;">
                                <p>{{ $info['achievements_work'] }}</p>
                            </div>
                        </div>

                    <h5><b>DID YOU KNOW SECTION: </b></h5>

                    <h5><b>Some Interesting facts about me, on the personal front, which I’d like to share with my peers : </b></h5>

                    <p>My favorite pastime/ pursuits <input class="input" type="text" name="my_favorite_pastime" id="my_favorite_pastime" value="{{$info['my_favorite_pastime'] }}" readonly>  </p>
                    <p>My favorite hobbies <input class="input" type="text" name="my_favorite_hobbies" id="my_favorite_hobbies" value="{{$info['my_favorite_hobbies'] }}" readonly>  </p>
                    <p>Three places Id love to visit <input class="input" type="text" name="my_favorite_places" id="my_favorite_places" value="{{$info['my_favorite_places'] }}" readonly>  </p>
                    <p>Three Foods I relish <input class="input" type="text" name="my_favorite_foods" id="my_favorite_foods" value="{{$info['my_favorite_foods'] }}" readonly>  </p>
                    <p>My Favorite Sports <input class="input" type="text" name="my_favorite_sports" id="my_favorite_sports" value="{{$info['my_favorite_sports'] }}" readonly>  </p>
                    <p>My Favorite Movies <input class="input" type="text" name="my_favorite_movies" id="my_favorite_movies" value="{{$info['my_favorite_movies'] }}" readonly>  </p>
                    <p>My Favorite <input class="input" type="text" name="my_favorite" id="my_favorite" value="{{$info['my_favorite'] }}" readonly>  </p>
                    <p>My Extracurricular Specialities  <input class="input" type="text" name="my_extracurricular_specialities" id="my_extracurricular_specialities" value="{{$info['my_extracurricular_specialities'] }}" readonly> </p>
                    <p>My Career Aspirations <input class="input" type="text" name="my_career_aspirations" id="my_career_aspirations" value="{{$info['my_career_aspirations'] }}" readonly>  </p>
                    <p>I can speak these Languages fluently <input class="input" type="text" name="languages" id="languages" value="{{$info['languages'] }}" readonly>  </p>
                    <p>Some Interesting Facts about me that my peers can know! <input class="input interesting_facts" type="text" name="interesting_facts" id="interesting_facts" value="{{$info['interesting_facts'] }}" readonly>  </p>
                    <p>My Motto ! <input class="input" type="text" name="my_motto" id="my_motto" value="{{$info['my_motto'] }}" readonly>  </p>
                    <p>Books that I Read / Love to Recommend <input class="input" type="text" name="books" id="books" value="{{$info['books'] }}" readonly>  </p>

                </div>
            </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid Ends-->

</body>
</html>
