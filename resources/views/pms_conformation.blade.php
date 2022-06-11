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
    <h2>PMS <span> Cover Letter</span></h2>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">Change Password /</li>
@endsection

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
                                                    <p>Hello < employee name>

 

We are delighted to launch the PAPERLESS SELF ASSESSMENT MODULE for Performance Management System 2021-22, through our new HRMS- BUDGIE.

 

The Self-Assessment Module facilitates eligible employees to summarise individual performance (Self-Assessment) based on management expectations (Goals & Objectives) for the period of evaluation (April 1, 2021, to March 31, 2022).

 

Employees who are on the rolls of HEPL, last on December 31, 2021, are eligible to participate in this program. Employees who have joined HEPL on January 1, 2022, and later are not eligible.

 

Why PMS: 

 

A well-defined Performance Management System creates an ongoing dialogue between the employee and reporting manager to define, manage and continually outperform one’s goals and objectives. It also helps to develop a climate of trust, support, and encouragement and builds transparency in the performance evaluation process.

 

The following is the schedule of PMS 2021-22:

 

Self Assessment                                       By Wednesday, 15th June

Reporting Manager Assessment              By Saturday, 18th June

Reviewer Assessment                              By Monday, 20th June

PMS Panel Review                                   By Tuesday, 22nd June

 

 

We welcome the eligible employees to participate in the PMS program as defined above and contribute to the robustness of the evaluation exercises.

 

Please go through the Tutorials on the Module prior to initiating your actions. Throughout this paperless process flow, if you encounter any difficulty or have any unanswered query, please feel free to reach out to your HR Advisor (dhivya.r@hemas.in) or ping on Teams and we will be more than happy to support. 

 

Best,

Human Resources Team - HEPL</p>
                                             <input type="checkbox" id="check" name="check" value="1" />
                                                <input type="submit" class="btn btn-primary me-1 mb-1 " id="submit"  value="Submit" disabled />
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
