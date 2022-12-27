<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo base_url().'login_asset/fonts/icomoon/style.css'; ?>">

    <link rel="stylesheet" href="<?php echo base_url().'login_asset/css/owl.carousel.min.css'; ?>">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url().'login_asset/css/bootstrap.min.css'; ?>">
    
    <!-- Style -->
    <link rel="stylesheet" href="<?php echo base_url().'login_asset/css/style.css'; ?>">

    <title>Lab Office Registration</title>
  </head>
  <body>
  <script src="<?php echo base_url().'login_asset/js/jquery-3.3.1.min.js'; ?>"></script>
  <script src="<?php echo base_url().'login_asset/js/popper.min.js'; ?>"></script>
  <script src="<?php echo base_url().'login_asset/js/bootstrap.min.js'; ?>"></script>
  <script src="<?php echo base_url().'login_asset/js/main.js'; ?>"></script>
  <script src="<?php echo base_url().'login_asset/sweetalert.min.js'; ?>"></script>
  <div class="content">
    <div class="container">
      <?php

          if(isset($_GET['passcode']))
          {
            ?>
            <form method="POST" action="<?php echo base_url(); ?>PasswordSet/setpassword">
            <input type="hidden" type="hidden" value="<?php echo $_GET['passcode']; ?>" name="passcode">
            <div style="width:60%;margin: 0px auto;" class="card card-body">
              <h4>Set Password</h4>
              <hr>
              <div class="row">
                <div class="col-md-12">
                  <label><strong>Password</strong></label>
                  <input type="password" class="form-control" required="required" placeholder="Enter Password..." name="password">
                  <label class="password_err err"></label>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <label><strong>Confirm Password</strong></label>
                  <input type="password" required="required" onkeyup="confirmPasswordKeyUp(this.value)" class="form-control" placeholder="Enter Password..." name="confirm_password">
                  <label class="confirm_password_err err"></label>
                </div>
              </div>
              <div class="row">
                <div style="text-align:right;" class="col-md-12">
                  <hr>
                  <button type="submit" class="btn btn-sm btn-info">Submit</button>
                </div>
              </div>
            </div>
            </form>
            <script type="text/javascript">
              function confirmPasswordKeyUp(confm)
              {
                // console.log(confm);
                console.log($('input[name=password]').val());
                if($('input[name=password]').val()!=confm)
                {
                  $('.confirm_password_err').html('Confirm Password Not Match !');
                }else{
                  $('.confirm_password_err').html('');
                }
              }
            </script>
            <?php
          } ?>

    </div>
  </div>
    
  </body>
  <?php 
  if(!empty($this->session->flashdata('success'))){
  ?>
    <script type="text/javascript">
      $(document).ready(function () {
        var msg = "<?php echo $this->session->flashdata('success'); ?>";
        swal(msg, "", "success");
      });
    </script>
  <?php
  }
  if(!empty($this->session->flashdata('error'))){
  ?>
    <script type="text/javascript">
      $(document).ready(function () {
        var msg = "<?php echo $this->session->flashdata('error'); ?>";
        swal(msg, "", "error");
      });
    </script>
  <?php
  } 
?>
</html>
<style type="text/css">
  .plan{
    margin:10px;
  }
  .color-green{
    color: green;
  }
  .color-blue{
    color: blue!important;
    text-decoration: none!important;
  }
  .text-align-center{
    text-align: center;
  }
  .err{
    color: red;
  }
</style>
