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

    <title>Patho Care|Medikamart</title>
  </head>
  <body>
    
  <style type="text/css">
  .content .contents .form-group.first, .content .bg .form-group.first {
    border-top-left-radius: 7px;
    border-top-right-radius: 7px;
    margin-bottom: 20px;
    font-size: 15px;        
    }
  .content {
    background: #F3FCFB;
   }
   .commonHeade{
    width: 100%;
    height: 100px;
    background: #38837ff0;
    padding-right:2%;
   }
   .nav-bar{
    float: right;
   }
   .nav-bar ul li{
    float: left;
    margin: 10px;
    list-style-type: none;
    padding-top: 20%;

    margin-left: 23px;
    font-size: 16px;
    color: white;
   }

   .nav-bar ul li:hover{
    font-weight: bolder;
    color: yellow;
   }
   @media (max-width: 600px)
   {
    .commonHeade{
      width: 100%;
      height: 100px;
      background: #38837ff0;
      padding-right:0%;
     }
    .nav-bar{
      float: left;
     }
      .nav-bar ul li{
      float: left;
      margin: 10px;
      list-style-type: none;
      /*padding-top: 20%;*/
      font-size: 12px;
      /*color: white;*/
      position: relative;
     }
   }
   .footer-div{
    position: relative;
    bottom: 0px; 
    min-height: 10px;
    background: #9BBFC2;
    color: white;
    width: 100%;
    text-align: center;
    font-size: 8px;
    padding: 4px;
    
   }
  </style>
<div class="commonHeade">
      <img src="<?php echo base_url();?>assets/logo-com.png" style="height:100px;">
      <!-- <nav class="nav-bar">
        <ul>
          <a href="#">
            <li>Demo</li>
          </a>
          <a href="#">
            <li>Subscriptions</li>
          </a>
          <a href="#">
            <li>Contact Us</li>
          </a>
        </ul>
      </nav> -->
  </div>
  <div class="content">
    <div class="container" style="margin-top: -79px;">
      
      <div class="row">
        <div class="col-md-6">
          <img src="<?php echo base_url().'assets/images/labimage.jpg'; ?>" style="box-shadow: 2px 2px 10px 2px white; border-radius: 10px;" alt="Image" class="img-fluid">
          <a href="<?php echo base_url(); ?>Registration/register/userinfo" style="background:#38837ff0;margin-top: 25px;color: white;text-decoration: none;min-height: 20px;text-align: center;font-size: 25px;border-radius: 10px;line-height: 20px;padding: 15px;padding-top: 30px;" class="btn-block"><p style="color:white;font-weight: bold;">Create free account now</p>
            <p style="color:white;">100% Free !</p>
            <p style="font-size: 11px;color:white;">Terms & Conditions apply</p>
          </a>
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
              <h3>
                <sub><b><span>Patho </span>
                <span style="color: #38837ff0;">Care</span></b><br><b style="font-size:15px;"> Sign In</b></sub>
                
              </h3>
            </div>
            <form action="<?php echo base_url().'Login/login_now';   ?>" method="post">
    
              <div class="form-group first">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" id="username">

              </div>
              <div class="form-group last mb-4">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password">
                
              </div>
              
              <div  class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span style="color:#38837ff0!important;" class="caption">Remember me</span>
                  <input type="checkbox" style="color:#38837ff0!important;" checked="checked"/>
                  <div class="control__indicator"></div>
                </label>
                <span class="ml-auto"><a href="#" style="color:#38837ff0!important;" class="forgot-pass">Forgot Password</a></span> 
                 
              </div>

              <input type="submit" value="Sign In" style="background:#38837ff0;" class="btn btn-block btn-primary">
            </form>
            </div>
          </div>
           
        </div>
        
      </div>
    </div>
  </div>
  <div class="footer-div">
      <h6 style="margin-top:3px;">Copyrights & Privacy & Policy</h6>
  </div>
    <script src="<?php echo base_url().'login_asset/js/jquery-3.3.1.min.js'; ?>"></script>
    <script src="<?php echo base_url().'login_asset/js/popper.min.js'; ?>"></script>
    <script src="<?php echo base_url().'login_asset/js/bootstrap.min.js'; ?>"></script>
    <script src="<?php echo base_url().'login_asset/js/main.js'; ?>"></script>
    <script src="<?php echo base_url().'login_asset/sweetalert.min.js'; ?>"></script>
    
    
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