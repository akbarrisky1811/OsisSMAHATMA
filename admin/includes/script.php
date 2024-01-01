<!-- plugins:js -->
  <script src="assets/vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="assets/vendors/chart.js/Chart.min.js"></script>
  <script src="assets/vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="assets/vendors/summernote/dist/summernote-bs4.min.js"></script>
  <!-- <script src="assets/vendors/lightgallery/js/lightgallery-all.min.js"></script> -->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="assets/js/off-canvas.js"></script>
  <script src="assets/js/hoverable-collapse.js"></script>
  <script src="assets/js/template.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="assets/js/dashboard.js"></script>
  <script src="assets/js/data-table.js"></script>
  <script src="assets/js/jquery.dataTables.js"></script>
  <script src="assets/js/dataTables.bootstrap4.js"></script>
  <script src="assets/js/file-upload.js"></script>
  <script src="assets/js/chart.js"></script>
  <script src="assets/js/editorDemo.js"></script>
  <!-- End custom js for this page-->
  <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
  <!-- <script src="assets/js/light-gallery.js"></script> -->

  <!-- Datatable default show entries -->  
  <script type="text/javascript">
    $(document).ready(function(){
      $('#data-alumni').dataTable({
        "aLengthMenu":[[25, 50, 100, 200, -1], [25, 50, 100, 200, "Semua"]],
        "pageLength":25
      })
    })
  </script>