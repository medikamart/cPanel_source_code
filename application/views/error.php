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

       if($status=='LINK_EXPIRED')
       {
        ?>
          <div class="alert">
            <!-- <span class="closebtn">&times;</span>   -->
            <strong>Ooops</strong> Invitation Link has been expired !
          </div>
        <?php
       }elseif($status=='SUCCESS')
       {
        ?>
          <div class="alert success">
              <!-- <span class="closebtn">&times;</span>   -->
              <strong>Success</strong> Your Password Configutaion Successfully Done !, Plesae Login.
          </div>
        <?php
       }elseif($status=='FAILED')
       {
          ?>
            <div class="alert success">
                <!-- <span class="closebtn">&times;</span>   -->
                <strong>Success</strong> Your Password Configutaion Failed !, Plesae Try Again.
            </div>
          <?php
       }


       ?>
       

        

    </div>
  </div>
    
  </body>
 
</html>
<style>
.alert {
  padding: 20px;
  background-color: #f44336;
  color: white;
  opacity: 1;
  transition: opacity 0.6s;
  margin-bottom: 15px;
  text-align: center;
}

.alert.success {background-color: #04AA6D;}
.alert.info {background-color: #2196F3;}
.alert.warning {background-color: #ff9800;}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}
</style>

