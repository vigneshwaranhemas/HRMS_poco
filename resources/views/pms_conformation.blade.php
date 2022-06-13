@extends('layouts.simple.candidate_master')
@section('title', 'ID Card Validation Form')

@section('css')
@endsection

@section('style')
<style type="text/css">
 
#submit {
  display: block;
  margin: 20px 0;
}
</style>


@endsection

@section('breadcrumb-title')
    <h2>PMS 2021-22<span> OVERVIEW</span></h2>
@endsection

@section('breadcrumb-items')
    <!-- <li class="breadcrumb-item active">Change Password /</li> -->
@endsection
<?php
        $session_val = Session::get('session_info');
        $username = $session_val['username']; ?>
@section('content')
<div class="container-fluid">
   <div id="main">
        <div class="page-heading">
            <section id="multiple-column-form">
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form" id="pms_status" method="post"
                                        action="javascript:void(0)">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <h4 class=""><b>Hello <?php echo $username;?></b></h4>
                                                    <p style="text-align: justify;font-size:17px">We are delighted to launch the <b>PAPERLESS SELF ASSESSMENT MODULE</b> for Performance Management System 2021-22, through our new HRMS- BUDGIE. </p>
                                                    <p style="text-align: justify;font-size:17px">The Self-Assessment Module facilitates eligible employees to summarise <b>individual performance</b> (Self-Assessment) based on <b>management expectations</b> (Goals & Objectives) for the period of evaluation (April 1, 2021, to March 31, 2022).</p>
                                                    <p style="text-align: justify;font-size:17px">Employees who are on the rolls of HEPL, last on December 31, 2021, are eligible to participate in this program. Employees who have joined HEPL on January 1, 2022, and later are not eligible.</p>
                                                    <p style="text-align: justify;font-size:17px"><b>Why PMS:</b></p>
                                                    <p style="text-align: justify;font-size:17px">A well-defined Performance Management System creates an ongoing dialogue between the employee and reporting manager to define, manage and continually outperform one’s goals and objectives. It also helps to develop a climate of trust, support, and encouragement and builds transparency in the performance evaluation process.</h5>
                                                    <p style="text-align: justify;font-size:17px">The following is the schedule of PMS 2021-22:</p>
                                                    <!-- <table>
                                                        <tr><td><p style="text-align: justify;font-size:17px">Self Assessment</p></td><td><p style="text-align: justify;font-size:17px">By Wednesday, 15th June</p></td></tr>
                                                        <tr><td><p style="text-align: justify;font-size:17px">Reporting Manager Assessment</p></td><td><p style="text-align: justify;font-size:17px">By Saturday, 18th June</p></td></tr>
                                                        <tr><td><p style="text-align: justify;font-size:17px">Reviewer Assessment</p></td><td><p style="text-align: justify;font-size:17px">By Monday, 20th June</p></td></tr>
                                                        <tr><td><p style="text-align: justify;font-size:17px">PMS Panel Review</p></td><td><p style="text-align: justify;font-size:17px">By Tuesday, 22nd June</p></td></tr>
                                                    </table> -->
                                                    <ul class="pl-4 mb-4 list-circle">
                                                        <li><p style="text-align: justify;font-size:17px">Self Assessment - By Wednesday, 15th June</p></li>
                                                        <li><p style="text-align: justify;font-size:17px">Reporting Manager Assessment - By Saturday, 18th June</h5></li>
                                                        <li><p style="text-align: justify;font-size:17px">Reviewer Assessment - By Monday, 20th June</h5></li>
                                                        <li><p style="text-align: justify;font-size:17px">PMS Panel Review - By Tuesday, 22nd June</h5></li>
                                                    </ul>                                                     
                                                    <p style="text-align: justify;font-size:17px">We welcome the eligible employees to participate in the PMS program as defined above and contribute to the robustness of the evaluation exercises.</p>
                                                    <p style="text-align: justify;font-size:17px">Please go through the Tutorials on the Module prior to initiating your actions. Throughout this paperless process flow, if you encounter any difficulty or have any unanswered query, please feel free to reach out to your HR Advisor (<span style="color:blue;">dhivya.r@hemas.in</span>) or ping on Teams and we will be more than happy to support. </h5>                                                   
                                                    <p style="text-align: justify;font-size:17px">As we interact with the module, we may come across any difficulties or errors. Please reach out to (<span style="color:blue;">ganagavathy.k@hemas.in</span>) with the screenshots and She will be ready with the solutions for us to complete PMS efficiently.</p>
                                                    <h5>Best,</h5>                                                    
                                                    <h5><b>Human Resources Team - HEPL</b></h5>            
                                                    <center>
                                                        <p style="font-size:17px"><input class="m-t-30" type="checkbox" id="check" name="check" value="1" />  I have read the overview and <b>guidelines</b></p>
                                                        <input type="submit" class="btn btn-primary mb-1 " id="submit"  value="GET STARTED" disabled />
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- // Basic multiple Column Form section end -->
        </div>
        </div>
</div>
@endsection

<?php
        $session_val = Session::get('session_info');
        $pms_status = $session_val['pms_status'];
?>
@section('script')
<script src="../assets/js/form-validation-custom.js"></script>
<script src="../pro_js/pms_con.js"></script>

<script type="text/javascript">
    var pms_conformation_sub = "{{url('pms_conformation_sub')}}";
</script>
@endsection
