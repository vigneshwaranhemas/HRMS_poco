@extends('layouts.simple.candidate_master')
@section('title', 'ID Card Validation Form')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
	<h2>ID Card <span>Information</span></h2>
@endsection

@section('breadcrumb-items')
	<!-- <li class="breadcrumb-item">Forms</li>
    <li class="breadcrumb-item">Form Controls</li>	 -->
	<li class="breadcrumb-item active">ID Card Information/</li>
@endsection

@section('content')
<div class="container-fluid">
   <div class="row">
      <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
               <form class="" enctype="multipart/form-data" id= "idcard_info" novalidate="">
                  <div class="form-row">
                     <div class="col-md-4 mb-3">
                        <label for="f_name">First name</label>
                        <input class="form-control alpha" style="text-transform:uppercase" id="f_name" type="text" name="f_name" placeholder="First name" required="">
                        <span class="text-danger color-hider" id="f_name_error"  style="display:none;color: red;"></span>
                        <div class="valid-feedback">Looks good!</div>
                     </div>
                     <div class="col-md-4 mb-3">
                        <label for="m_name">Middle Name</label>
                        <input class="form-control alpha" id="m_name" type="text" name="m_name" placeholder="Middle name" >
                        <div class="valid-feedback">Looks good!</div>
                     </div>
                     <div class="col-md-4 mb-3">
                        <label for="validationCustomUsername">Last Name</label>
                        <!-- <div class="input-group">
                           <div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">@</span></div>
                           <input class="form-control" id="validationCustomUsername" type="text" placeholder="Username" aria-describedby="inputGroupPrepend" required="">
                           <div class="invalid-feedback">Please choose a username.</div>
                        </div> -->
                         <input class="form-control alpha" style="text-transform:uppercase" id="l_name" name="l_name" type="text" placeholder="Middle name" >
                         <span class="text-danger color-hider" id="l_name_error"  style="display:none;color: red;"></span>
                     </div>
                  </div>
                  <div class="form-row">
                     <div class="col-md-4 mb-3">
                        <label for="working_loc">Working Location</label>
                        <input class="form-control" id="working_loc" name="working_loc" type="text" placeholder="Working Location" readonly>
                        <div class="invalid-feedback">Please provide a valid Location.</div>
                     </div>
                     <div class="col-md-4 mb-3">
                        <label for="emp_num_1">Employee Mobile Number 1</label>
                        <input class="form-control" maxlength="10" onkeypress="return isNumber(event)" id="emp_num_1" name="emp_num_1" type="text" placeholder="Employee Mobile Number 1" required="">
                        <span class="text-danger color-hider" id="emp_num_1_loc_error"  style="display:none;color: red;"></span>
                        <!-- <div class="invalid-feedback">Please provide a valid state.</div> -->
                     </div>
                     <div class="col-md-4 mb-3">
                        <label for="emp_num_2">Employee Mobile Number 2</label>
                        <input class="form-control" maxlength="10" id="emp_num_2" onkeypress="return isNumber(event)" name="emp_num_2" type="text" placeholder="Employee Mobile Number 2" required="">
                        <!-- <div class="invalid-feedback">Please provide a valid zip.</div> -->
                     </div>
                  </div>

                  <div class="form-row">
                     <div class="col-md-4 mb-3">
                        <label for="rel_emp">Relationship of Employee</label>
                        <input class="form-control" id="rel_emp" name="rel_emp" type="text" placeholder="Relationship of Employee" required="">
                        <!-- <div class="invalid-feedback">Please provide a valid Location.</div> -->
                     </div>
                     <div class="col-md-4 mb-3">
                        <label for="name_rel_ship">Name of Relationship</label>
                        <input class="form-control alpha" id="name_rel_ship" name="name_rel_ship" type="text" placeholder="Name of Relationship" required="">
                        <!-- <div class="invalid-feedback">Please provide a valid state.</div> -->
                     </div>
                     <div class="col-md-4 mb-3">
                        <label for="emrg_con_num">Emergency contact number</label>
                        <input class="form-control" maxlength="10" onkeypress="return isNumber(event)" id="emrg_con_num" name="emrg_con_num" type="text" placeholder="Emergency contact number" required="">
                        <span class="text-danger color-hider" id="emrg_con_num_error"  style="display:none;color: red;"></span>

                        <!-- <div class="invalid-feedback">Please provide a valid zip.</div> -->
                     </div>
                  </div>
                  <div class="form-row">
                     <div class="col-md-4 mb-3">
                        <label for="rel_emp">DOJ</label>
                        <input class="form-control" id="doj" name="doj" type="date" readonly placeholder="Date Of Join" >

                        <!-- <div class="invalid-feedback">Please provide a valid Location.</div> -->
                     </div>
                     <div class="col-md-4 mb-3">
                        <label for="blood_grp">Blood Group</label>
                        <!-- <input class="form-control" id="blood_grp" name="blood_grp" type="text" placeholder="Blood Group" required=""> -->
                        <select class="form-control" placeholder="Blood Group" id="blood_grp" name="blood_grp" required=""> <option value="">Select Blood Group</option>
                           <option value="A+">A+</option><option value="A-">A-</option>
                           <option value="B+">B+</option><option value="B-">B-</option>
                           <option value="O+">O+</option><option value="O-">O-</option>
                           <option value="AB+">AB+</option><option value="AB-">AB-</option>
                        </select>
                        <span class="text-danger color-hider" id="blood_grp_error"  style="display:none;color: red;"></span>
                        <!-- <div class="invalid-feedback">Please provide a valid state.</div> -->
                     </div>
                     <div class="col-md-4 mb-3">
                        <label for="emp_code">Employee code</label>
                        <input class="form-control" id="emp_code" name="emp_code" type="text" placeholder="Employee code" readonly>
                        <!-- <div class="invalid-feedback">Please provide a valid zip.</div> -->
                     </div>
                  </div>
                  <div class="form-row">
                     <div class="col-md-6 mb-3">
                        <label for="official_email">Official Email ID</label>
                        <input class="form-control" id="official_email" name="official_email" type="email" placeholder="Official Email Id" readonly >
                        <!-- <div class="invalid-feedback">Please provide a valid Location.</div> -->
                     </div>
                     <div class="col-md-6 mb-3">
                        <label for="emp_dob">DOB</label>
                        <input class="form-control" id="emp_dob" name="emp_dob" type="date" placeholder="Blood Group" required="">
                        <span class="text-danger color-hider" id="emp_dob_error"  style="display:none;color: red;"></span>
                        <!-- <div class="invalid-feedback">Please provide a valid state.</div> -->
                     </div>
                  </div>
                  <!-- <div class="form-group">
                     <div class="form-check">
                        <div class="checkbox p-0">
                           <input class="form-check-input" id="invalidCheck" type="checkbox" required="">
                           <label class="form-check-label" for="invalidCheck">Agree to terms and conditions</label>
                        </div>
                        <div class="invalid-feedback">You must agree before submitting.</div>
                     </div>
                  </div> -->
                  <!-- <button class="btn btn-primary" type="button" id="closebutton" data-dismiss="modal">Close</button> -->
                  <center><button class="btn btn-secondary" type="btnSubmit">Save</button>
                  </center>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

@section('script')
<script src="../assets/js/form-validation-custom.js"></script>
<script src="../assets/pro_js/idcard_verification.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var idcard_info_view_link = "{{url('idcard_info')}}";
    var idcard_info_link = "{{url('idcard_info_save')}}";

</script>
<script type="text/javascript">
   /*only Numbers*/
   function isNumber(evt) {
          evt = (evt) ? evt : window.event;
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode > 31 && (charCode < 48 || charCode > 57)) {
              return false;
          }
          return true;
      }

      /*only letters*/
      $(document).ready(function(){
          $(".alpha").keydown(function(event){
              var inputValue = event.which;
              if(!(inputValue >= 65 && inputValue <= 123) &&/*letters,white space,tab*/
               (inputValue != 32 && inputValue != 0) && 
               (inputValue != 48 && inputValue != 8)/*backspace*/
               && (inputValue != 9)/*tab*/) { 
                  event.preventDefault(); 
              }
          });
      });
</script>
@endsection