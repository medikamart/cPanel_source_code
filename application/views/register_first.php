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
          $page_section =  $this->uri->segment(3);
          if($page_section=='userinfo')
          {
            ?>
            <div style="width:60%;margin: 0px auto;" class="card card-body">
              <h4>Registration</h4>
              <hr>
              <div class="row">
                <div class="col-md-12">
                  <label><strong>First Name</strong></label>
                  <input type="text" class="form-control" placeholder="Enter First Name..." name="first_name">
                  <label class="first_name_err err"></label>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <label><strong>Last Name</strong></label>
                  <input type="text" class="form-control" placeholder="Enter Last Name..." name="last_name">
                  <label class="last_name_err err"></label>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <label><strong>Email</strong></label>
                  <input type="email" class="form-control" placeholder="Enter Email..." name="email">
                  <label class="email_err err"></label>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <label><strong>Phone</strong></label>
                  <input type="number" class="form-control" placeholder="Enter Number..." name="phone">
                  <label class="email_otp_err err"></label>
                </div>
              </div>
              
              <div class="row">
                <div class="col-md-12">
                  <label><strong>Password</strong></label>
                  <input type="password" class="form-control" placeholder="Enter Password..." name="password">
                  <label class="password_err err"></label>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <label><strong>Confirm Password</strong></label>
                  <input type="password" onkeyup="confirmPasswordKeyUp(this.value)" class="form-control" placeholder="Enter Password..." name="confirm_password">
                  <label class="confirm_password_err err"></label>
                </div>
              </div>
              <div class="row">
                <div style="text-align:right;" class="col-md-12">
                  <hr>
                  <a href="<?php echo base_url();  ?>Login">
                    <button type="button" class="btn btn-sm btn-info">Home</button>
                  </a>
                  <button onclick="userinfoSubmit()" type="button" class="btn btn-sm btn-info">Next</button>
                
                </div>
              </div>
            </div>
            <script type="text/javascript">
              checkformData();
              function confirmPasswordKeyUp(value){
                let password = $('input[name=password]').val();
                if(value.length>0 && value!=password)
                {
                  $('.confirm_password_err').html('<span>* Confirm password not match.</span>');
                }else if(value.length==0){
                  $('.confirm_password_err').html('');
                }else if(value.length>0 && value==password){
                  $('.confirm_password_err').html('');
                }
              }

              function checkformData()
              {
                let userData = localStorage.getItem('userinfo');

                if(userData!=null)
                {
                  userData = JSON.parse(userData);
                  $('input[name=first_name]').val(userData.first_name);
                  $('input[name=last_name]').val(userData.last_name);
                  $('input[name=email]').val(userData.email);
                  $('input[name=phone]').val(userData.phone);
                }
              }
              function userinfoSubmit()
              {
                if($('input[name=first_name]').val()=='')
                {
                  swal('warning','First name is required !','warning');
                }else if($('input[name=last_name]').val()=='')
                {
                  swal('warning','Last name is required !','warning');
                }else if($('input[name=email]').val()=='')
                {
                  swal('warning','Email is required !','warning');
                }else if($('input[name=phone]').val()=='')
                {
                  swal('warning','Phone is required !','warning');
                }else if($('input[name=password]').val()=='')
                {
                  swal('warning','Password is required !','warning');
                }else if($('input[name=confirm_password]').val()=='')
                {
                  swal('warning','Confirm password is required !','warning');
                }else
                {
                  

                  $.ajax({
                    type:'POST',
                    url:'<?php echo base_url();  ?>Registration/register_userinfo',
                    data:{
                      first_name: $('input[name=first_name]').val(),
                      last_name: $('input[name=last_name]').val(),
                      email: $('input[name=email]').val(),
                      phone: $('input[name=phone]').val(),
                      password: $('input[name=password]').val(),
                    },
                    success:function(res)
                    {
                      res = JSON.parse(res);
                      if(res.status==true)
                      {
                        localStorage.setItem('userinfo',JSON.stringify({
                          first_name: $('input[name=first_name]').val(),
                          last_name: $('input[name=last_name]').val(),
                          email: $('input[name=email]').val(),
                          phone: $('input[name=phone]').val(),
                          clinic_code:res.response_data['clinic_code'],
                        }));
                        swal('success','Successfully Saved','success');
                        setTimeout(()=>{
                          location.href='<?php echo base_url();?>Registration/register/otpverify';
                        },2000)
                        
                      }else{
                        swal('error',res.msg,'error');
                      }
                      
                    }
                  })

                }
              }

            </script>
            <?php
          }elseif($page_section=='otpverify')
          {
            ?>
            <div style="width:60%;margin: 0px auto;" class="card card-body">
              <div class="row">
                <div class="col-md-6">
                  <label><strong>Verify Phone OTP </strong></label>
                  <label class="otp-phone-lbl"></label>
                  <input type="number" placeholder="Phone OTP" class="form-control" name="phone_otp">
                  <label class="phone_otp_err err"></label>
                </div>
                <div class="col-md-6">
                  <label><strong>Verify Email OTP </strong></label>
                  <label class="otp-email-lbl"></label>
                  <input type="number" placeholder="Email OTP" class="form-control" name="email_otp">
                  <label class="email_otp_err err"></label>
                </div>
                <div class="col-md-12" style="text-align:center;">
                  <hr>
                  <a href="<?php echo base_url();  ?>Registration/register/userinfo">
                    <button type="button" class="btn btn-sm btn-info">Back</button>
                  </a>
                  <button onclick="sendOtp()" id="get_otp_btn" type="button" class="btn btn-sm btn-info">Get OTP</button>
                  <button onclick="resendOtp()" id="resend_otp_btn" style="display:none;" type="button" class="btn btn-sm btn-info">Resend OTP</button>
                  <button onclick="otpverifySubmit()" type="button" class="btn btn-sm btn-info">Verify OTP</button>
                </div>
              </div>
            </div>
            <script type="text/javascript">
              let userData = localStorage.getItem('userinfo');
              userData = JSON.parse(userData);
              function sendOtp()
              {
                $.ajax({
                    type:'POST',
                    url:'<?php echo base_url();  ?>Registration/register_sendotp',
                    data:{
                      clinic_code:userData.clinic_code
                    },
                    success:function(res)
                    {
                      res = JSON.parse(res);
                      if(res.status)
                      {
                        $('#get_otp_btn').hide();
                        $('#resend_otp_btn').show();
                        $('#resend_otp_btn').prop('disabled',true);
                        let c = 60;
                        let sI = setInterval(()=>{
                          if(c>0)
                          {
                            $('#resend_otp_btn').html('Resend OTP ('+c+'secs)');
                            c--;
                          }else{
                            $('#resend_otp_btn').html('Resend OTP');
                            $('#resend_otp_btn').prop('disabled',false);
                            clearInterval(sI);
                          }
                          
                        },1000);
                        alert('Phone otp=>'+res.response_data.pOtp);
                        alert('Email otp=>'+res.response_data.eOtp);
                        $('.otp-phone-lbl').html('OTP send To '+res.response_data.phone);
                        $('.otp-email-lbl').html('OTP send To '+res.response_data.email);
                      }else{
                        swal('error','otp send failed try again','error');
                      }
                    }
                });
              }
              function resendOtp()
              {
                $.ajax({
                    type:'POST',
                    url:'<?php echo base_url();  ?>Registration/register_sendotp',
                    data:{
                      clinic_code:userData.clinic_code
                    },
                    success:function(res)
                    {
                      res = JSON.parse(res);
                      if(res.status)
                      {
                        $('#get_otp_btn').hide();
                        $('#resend_otp_btn').show();
                        $('#resend_otp_btn').prop('disabled',true);
                        let c = 60;
                        let sI = setInterval(()=>{
                          if(c>0)
                          {
                            $('#resend_otp_btn').html('Resend OTP ('+c+'secs)');
                            c--;
                          }else{
                            $('#resend_otp_btn').html('Resend OTP');
                            $('#resend_otp_btn').prop('disabled',false);
                            clearInterval(sI);
                          }
                          
                        },1000);
                        alert('Phone otp=>'+res.response_data.pOtp);
                        alert('Email otp=>'+res.response_data.eOtp);
                        $('.otp-phone-lbl').html('OTP Resend To '+res.response_data.phone);
                        $('.otp-email-lbl').html('OTP Resend To '+res.response_data.email);
                      }else{
                        swal('error','otp send failed try again','error');
                      }
                      
                    }
                });
              }
              function otpverifySubmit()
              {
                if($('input[name=phone_otp]').val()=='')
                {
                  swal('warning','Phone OTP required !','warning');
                }else if($('input[name=email_otp]').val()=='')
                {
                   swal('warning','Email OTP required !','warning');
                }else
                {
                    let phone_otp = $('input[name=phone_otp]').val();
                    let email_otp = $('input[name=email_otp]').val();
                    $.ajax({
                        type:'POST',
                        url:'<?php echo base_url();  ?>Registration/register_otpVerify',
                        data:{
                          clinic_code:userData.clinic_code,
                          phoneOtp:phone_otp,
                          emailOtp:email_otp
                        },
                        success:function(res)
                        {
                          res = JSON.parse(res);
                          if(res.status)
                          {
                           swal('success',res.msg,'success');
                           setTimeout(()=>{
                              location.href='<?php echo base_url();?>Registration/register/labinfo';
                            },2000);
                           
                          }else{
                            swal('error',res.msg,'error');
                          }
                          
                        }
                    });
                }
                
              }
            </script>
            <?php
          }elseif($page_section=='labinfo')
          {
            ?>
            <div style="width:60%;margin: 0px auto;" class="card card-body">
              <div class="row">
                <div class="col-md-6">
                  <label><strong>Lab Full Name </strong></label>
                  <input type="text" placeholder="Lab Full Name" class="form-control" name="lab_full_name">
                  <label class="lab_full_name_err err"></label>
                </div>
                <div class="col-md-6">
                  <label><strong>Lab Short Name </strong></label>
                  <input type="text" placeholder="Lab Short Name" class="form-control" name="lab_short_name">
                  <label class="lab_short_name_err err"></label>
                </div>
                <div class="col-md-12" style="text-align:center;">
                  <hr>
                  <a href="<?php echo base_url();  ?>Registration/register/otpverify">
                    <button type="button" class="btn btn-sm btn-info">Back</button>
                  </a>
                  <button onclick="labinfoSubmit()" type="button" class="btn btn-sm btn-info">Next</button>
                </div>
              </div>
            </div>
            <script type="text/javascript">
              let userData = localStorage.getItem('userinfo');
              userData = JSON.parse(userData);
              function labinfoSubmit()
              {
                
                if($('input[name=lab_full_name]').val()=='')
                {

                }else if($('input[name=lab_short_name]').val()=='')
                {

                }else
                {
                  let lab_full_name = $('input[name=lab_full_name]').val();
                  let lab_short_name = $('input[name=lab_short_name]').val();
                  $.ajax({
                    type:'POST',
                    url:'<?php echo base_url();  ?>Registration/updateLabInfo',
                    data:{
                      lab_full_name:lab_full_name,
                      lab_short_name:lab_short_name,
                      clinic_code:userData.clinic_code
                    },
                    success:function(res)
                    {
                      res = JSON.parse(res);
                      if(res.status)
                      {
                        swal('success','Successfully Saved','success');
                        setTimeout(()=>{location.href='<?php echo base_url();?>Registration/register/plan';},2000);
                      }else{
                        swal('error','failed try again','error');
                      }
                    }
                  });
                }
              }
            </script>
            <?php
          }elseif($page_section=='plan')
          {
            ?>
            <div style="width:60%;margin: 0px auto;" class="card card-body">
              <h4>Choose Plan</h4>
              <hr>
              <div class="row plan-list">
              
              </div>
              <div class="row">
                <div class="col-md-12" style="text-align:center;">
                  <hr>
                  <a href="<?php echo base_url();  ?>Registration/register/labinfo">
                    <button type="button" class="btn btn-sm btn-info">Back</button>
                  </a>
                  <button onclick="planSubmit()" type="button" class="btn btn-sm btn-info">Next</button>
                </div>
              </div>
            </div>
            <script type="text/javascript">
              let userData = localStorage.getItem('userinfo');
              userData = JSON.parse(userData);
              planList();
              function planList()
              {
                $.ajax({
                    type:'POST',
                    url:'<?php echo base_url();  ?>Plan/get_plan_list',
                    data:{},
                    success:function(res)
                    {
                      res = JSON.parse(res);
                      if(res.status)
                      {
                        $.each(res.data,function(i,v){
                          $('.plan-list').append('<div class="col-md-6">'+
                                                '<div class="card card-body plan">'+
                                                  '<input type="radio" value="'+v.id+'" class="rdo-btn" name="plan">'+
                                                  '<h5>'+v.plan_name+'</h5>'+
                                                  '<p>Rs.'+v.amount+'/'+v.days+' days</p>'+
                                                  '<p>'+v.remarks+'</p>'+
                                                '</div>'+
                                              '</div>');
                        });
                       console.log(res);
                      }else{
                        swal('error','otp send failed try again','error');
                      }
                    }
                  });
              }
              function planSubmit(){
                if($("input[name='plan']:checked").val()=='')
                {
                  swal('warning','plesae choose any plan','warning');
                }else{
                  $.ajax({
                    type:'POST',
                    url:'<?php echo base_url();  ?>Registration/saveSubscription',
                    data:{plan_id: $("input[name='plan']:checked").val(),clinic_code:userData.clinic_code},
                    success:function(res)
                    {
                      res = JSON.parse(res);
                      if(res.status)
                      {
                        swal('success','Congratulations Successfully Registred !','success');
                        setTimeout(()=>{location.href='<?php echo base_url();?>Registration/register/response';},2000)
                      }else{
                        swal('error','something went wrong','error');
                      }
                    }
                  });
                }
              }
            </script>
            <?php
          }elseif($page_section=='response')
          {
            ?>
            <div style="width:60%;margin: 0px auto;" class="card card-body text-align-center">
              <h4 style="text-align:left;">Welcome</h4>
              <hr>
              <p><strong class="color-green">Successfully Registered. All Detais sent to your registered email.</strong></p>
              <a class="color-blue" href="<?php echo base_url(); ?>Login">Click here to login now</a>
            </div>
            <script type="text/javascript">
              localStorage.setItem('userinfo',null);
            </script>
            <?php
          }
       ?>

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
