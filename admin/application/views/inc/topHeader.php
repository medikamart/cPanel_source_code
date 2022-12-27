<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>IOTAS|Medikamart</title>

  <!--favicon-->
  <!-- <link rel="icon" href="<?php echo base_url().'assets/images/favicon.ico'; ?>" type="image/x-icon"> -->
  <!-- simplebar CSS-->
  <link href="<?php echo base_url().'assets/plugins/simplebar/css/simplebar.css'; ?>" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link href="<?php echo base_url().'assets/css/bootstrap.min.css'; ?>" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="<?php echo base_url().'assets/css/animate.css'; ?>" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="<?php echo base_url().'assets/css/icons.css'; ?>" rel="stylesheet" type="text/css"/>
  <!-- Sidebar CSS-->
  <link href="<?php echo base_url().'assets/css/sidebar-menu.css'; ?>" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="<?php echo base_url().'assets/css/app-style.css'; ?>" rel="stylesheet"/>
  <link href="<?php echo base_url().'assets/plugins/select2/css/select2.min.css" rel="stylesheet'; ?>"/>
  <link href="<?php echo base_url().'assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css'; ?>" rel="stylesheet" type="text/css">
   <!--Data Tables -->
  <link href="<?php echo base_url().'assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css'; ?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url().'assets/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css'; ?>" rel="stylesheet" type="text/css">
<script src="<?php echo base_url().'login_asset/sweetalert.min.js'; ?>"></script>
  <style> 
        #loader2 { 
            /*border: 5px dotted red; */
            border-radius: 50%; 
            /*border-top: 5px dotted #444444; */
            width: 80px; 
            height: 80px; 
            /*animation: spin 1s linear infinite; */
            z-index: 999999999999;

        } 
        #overlay2{
          position: fixed;
          width: 100%;
          height: 100%;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          background: white;
          cursor: pointer;
          z-index: 999999999999;
          background-image: url('<?= base_url()?>/app-assets/loader.gif');
          background-position: center;
          background-repeat: no-repeat;
          background-size: 75px 75px;
          display: hidden;

        }
        @keyframes spin { 
            100% { 
                transform: rotate(360deg); 
            } 
        } 
          
        .center { 
            position: absolute; 
            top: 0; 
            bottom: 0; 
            left: 0; 
            right: 0; 
            margin: auto; 

        } 
    </style>
    <script src="<?php echo base_url().'assets/js/jquery.min.js'; ?>"></script>
</head>
<body>
   
    
<!-- <div id="overlay2">
        <div id="loader2" class="center">
           
        </div>
</div> -->
<!-- END: Head-->



