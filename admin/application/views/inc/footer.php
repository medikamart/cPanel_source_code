  <!--Start footer-->
  <footer class="footer">
      <div class="container">
        <div class="text-center">
          Copyright © 2021 Dr. Labo
        </div>
      </div>
    </footer>
  <!--End footer-->
  </div><!--End wrapper-->
  <!-- Bootstrap core JavaScript-->
   
  <script src="<?php echo base_url().'assets/js/popper.min.js'; ?>"></script>
  <script src="<?php echo base_url().'assets/js/bootstrap.min.js'; ?>"></script>
  <script src="<?php echo base_url().'assets/plugins/jquery-validation/js/jquery.validate.min.js'; ?>"></script>
  
  <!-- simplebar js -->
  <script src="<?php echo base_url().'assets/plugins/simplebar/js/simplebar.js'; ?>"></script>
  <!-- waves effect js -->
  <script src="<?php echo base_url().'assets/js/waves.js'; ?>"></script>
  <!-- sidebar-menu js -->
  <script src="<?php echo base_url().'assets/js/sidebar-menu.js'; ?>"></script>
  <!-- Custom scripts -->
  <script src="<?php echo base_url().'assets/js/app-script.js'; ?>"></script>
  <!-- Chart js -->
  <script src="<?php echo base_url().'assets/plugins/Chart.js/Chart.min.js'; ?>"></script>
  <!--Peity Chart -->
  <script src="<?php echo base_url().'assets/plugins/peity/jquery.peity.min.js'; ?>"></script>
  <!-- Index js -->
  
  <!--Data Tables js-->
  <script src="<?php echo base_url().'assets/plugins/bootstrap-datatable/js/jquery.dataTables.min.js'; ?>"></script>
  <script src="<?php echo base_url().'assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js'; ?>"></script>
  <script src="<?php echo base_url().'assets/plugins/bootstrap-datatable/js/dataTables.buttons.min.js'; ?>"></script>
  <script src="<?php echo base_url().'assets/plugins/bootstrap-datatable/js/buttons.bootstrap4.min.js'; ?>"></script>
  <script src="<?php echo base_url().'assets/plugins/bootstrap-datatable/js/jszip.min.js'; ?>"></script>
  <script src="<?php echo base_url().'assets/plugins/bootstrap-datatable/js/pdfmake.min.js'; ?>"></script>
  <script src="<?php echo base_url().'assets/plugins/bootstrap-datatable/js/vfs_fonts.js'; ?>"></script>
  <script src="<?php echo base_url().'assets/plugins/bootstrap-datatable/js/buttons.html5.min.js'; ?>"></script>
  <script src="<?php echo base_url().'assets/plugins/bootstrap-datatable/js/buttons.print.min.js'; ?>"></script>
  <script src="<?php echo base_url().'assets/plugins/bootstrap-datatable/js/buttons.colVis.min.js'; ?>"></script>
  <script src="<?php echo base_url().'assets/plugins/select2/js/select2.min.js'; ?>"></script>
  <script src="<?php echo base_url().'assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js'; ?>"></script>
  <script>
     $(document).ready(function() {
      //Default data table
       $('#default-datatable').DataTable();
       $('select').select2();

       var table = $('#example').DataTable( {
        lengthChange: false,
        buttons: [ 'copy', 'excel', 'pdf', 'print', 'colvis' ]
      } );
 
     table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
      
      } );
     $('#autoclose-datepicker').datepicker({
        autoclose: true,
        todayHighlight: true
      });

     function change_gender(value)
     {
        if(value=='Mrs.' || value=='Miss.')
        {
          $('select[name=sex]').val('Female').trigger('change');
        }else if(value=='Mr.')
        {
          $('select[name=sex]').val('Male').trigger('change');
        }
     }
     $('input').keyup(function(){
      var str = $(this).val().toUpperCase();
      $(this).val(str);
     })
    </script>
    <script src="<?php echo base_url().'assets/js/index.js'; ?>"></script>
<style>
label
{
  color:blue;
  font-size:12px;
}
.form-control{
   color:blue!important;
  font-size:12px;
  		
}


.select2-container--default .select2-selection--single .select2-selection__rendered {
    color:blue!important;
    font-size:12px;
}
.select2-results__option[aria-selected] {
    cursor: pointer;
    color: blue;
   font-size:12px;
}
#show_test_area{
	
   color: red;
   font-size:12px;

}
</style>
</body>
</html>
