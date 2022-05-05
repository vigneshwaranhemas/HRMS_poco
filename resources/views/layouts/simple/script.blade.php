<!-- latest jquery-->
<script src="../assets/js/jquery-3.5.1.min.js"></script>
<script src="../assets/js/bootstrap/popper.min.js"></script>
<!-- Bootstrap js-->
<script src="../assets/js/bootstrap/bootstrap.js"></script>
<!-- feather icon js-->
<script src="../assets/js/icons/feather-icon/feather.min.js"></script>
<script src="../assets/js/icons/feather-icon/feather-icon.js"></script>
<!-- Sidebar jquery-->
<script src="../assets/js/sidebar-menu.js"></script>
<script src="../assets/js/config.js"></script>
<script src="../assets/js/chat-menu.js"></script>
@yield('script')
<!-- Plugins JS Ends-->
<!-- Theme js-->
<script src="../assets/js/script.js"></script>
<script src="../assets/js/theme-customizer/customizer.js"></script>


<!-- Profile Image -->

<script>
    fetch_login_profile_image();

    //Login Profile Image
    function fetch_login_profile_image(){
         //Get holidays details
         $.ajax({
            url:"fetch_login_profile_image",
            type:"GET",
            dataType : "JSON",
            success:function(response)
            {
                  // console.log(response);
                  $("#login_profile_image").append('');
                  $("#login_profile_image").append(response);

            }

         });
      }
</script>

<!-- toast js -->
<script src="../assets/toastify/toastify.js"></script>

<!-- login js-->

<!-- DataTables Plugins JS start-->
<script src="../assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/js/datatable/datatable-extension/dataTables.buttons.min.js"></script>
<script src="../assets/js/datatable/datatable-extension/jszip.min.js"></script>
<script src="../assets/js/datatable/datatable-extension/buttons.colVis.min.js"></script>
<script src="../assets/js/datatable/datatable-extension/pdfmake.min.js"></script>
<script src="../assets/js/datatable/datatable-extension/vfs_fonts.js"></script>
<script src="../assets/js/datatable/datatable-extension/dataTables.autoFill.min.js"></script>
<script src="../assets/js/datatable/datatable-extension/dataTables.select.min.js"></script>
<script src="../assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js"></script>
<script src="../assets/js/datatable/datatable-extension/buttons.html5.min.js"></script>
<script src="../assets/js/datatable/datatable-extension/buttons.print.min.js"></script>
<script src="../assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js"></script>
<script src="../assets/js/datatable/datatable-extension/dataTables.responsive.min.js"></script>
<script src="../assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js"></script>
<script src="../assets/js/datatable/datatable-extension/dataTables.keyTable.min.js"></script>
<script src="../assets/js/datatable/datatable-extension/dataTables.colReorder.min.js"></script>
<script src="../assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js"></script>
<script src="../assets/js/datatable/datatable-extension/dataTables.rowReorder.min.js"></script>
<script src="../assets/js/datatable/datatable-extension/dataTables.scroller.min.js"></script>
<script src="../assets/js/datatable/datatable-extension/custom.js"></script>
<script src="../assets/js/chat-menu.js"></script>
<!-- DataTables Plugins JS Ends-->
