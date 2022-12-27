<?php  $this->load->view('website/inc/main_header'); ?>
   <body class="body-2">
      <div class="w-embed w-iframe">
        
      </div>
      <?php  $this->load->view('website/inc/plan_top_header'); ?>
         <div class="container-fluid" style="padding: 0 10%;">
            <section style="text-align:left;">
                  <div class="container">                      
                     <div class="row ">
                        <div style="margin:0px auto;" class="col-lg-5">
                           <div style="margin-bottom: 10px;">
                              <div style="width: 100%;background: grey;height: 10px;">
                                 <div id="progress_bar" style="height: 100%;width: 50%;background: green;"></div>
                              </div>
                              <p style="text-align:center;color: black;font: 12px;"><span id="lbl_perc">50%</span></p>
                           </div>

                           <!-- Step 1 Registration -->
                           <div style="display: none;margin-bottom: 10px;" class="card card-body tab tab1">
                              <form method="post" action="#" autocomplete="off">
                                    <div class="col-lg-12 mt-3">
                                       <input type="text" onkeyup="checkRequired(this.id);stepbtnEffect(1);" placeholder="First Name" class="form-control req-input" name="first_name" id="first_name">
                                       <p id="error-first_name" style="color: red;"></p>
                                    </div>
                                    <div class="col-lg-12 mt-3">
                                       <input type="text" onkeyup="optionalParaCap(this.id)" placeholder="Middle Name" class="form-control" name="middle_name" id="middle_name">
                                       <p style="color: grey;">(Optional)</p>
                                    </div>
                                    <div class="col-lg-12 mt-3">
                                       <input type="text" onkeyup="checkRequired(this.id);stepbtnEffect(1);" placeholder="Last Name" class="form-control req-input" name="last_name" id ="last_name">
                                       <p id="error-last_name" style="color: red;"></p>
                                    </div>
                                    <div class="col-lg-12 mt-3">
                                       <label style="color:grey;font-weight: normal;">Organisational Role</label>
                                       <select class="form-control select2" name="reg_role_id" id ="reg_role_id">
                                          <?php
                                             if(!empty($org_role))
                                             {
                                                foreach($org_role as $key=>$value)
                                                {
                                                   ?>
                                                   <option value="<?php echo $value['id']; ?>"><?php echo $value['role_name']; ?></option>
                                                   <?php
                                                }
                                             }
                                            ?>
                                       </select>
                                    </div>
                                    <div style="text-align:right;" class="col-lg-12">
                                       <div class="next-btn btn-step1" style="margin-top:10px;height: 40px;width: 40px;padding: 6px;font-size: 20px;border-radius: 20px; text-align: center;border: 1px solid grey; float: right;cursor: pointer;" onclick="saveStep1();"><i class="zmdi zmdi-trending-flat"></i></div>
                                    </div>
                              </form>
                           </div>

                           <!-- Step 2 Registration -->
                           <div style="display: none;margin-bottom: 10px;" class="card card-body tab tab2">
                              <div style="text-align:left;" class="col-lg-12">
                                 <div class="next-btn" style="height: 40px;width: 40px;padding: 6px;font-size: 20px;border-radius: 20px; text-align: center;border: 1px solid grey; float: left;cursor: pointer;" onclick="show_tab(1);"><i class="zmdi zmdi-arrow-left"></i></div>
                              </div>
                              <div class="col-lg-12 mt-3">
                                 <input type="number" onkeyup="sendOtp()" placeholder="Mobile" id="mobile_no" class="form-control" name="mobile_no">
                              </div>
                              <div class="col-lg-12 mt-3">
                                 <input type="number" style="display:none;" id="mobile_otp" placeholder="Enter OTP" onkeyup="verifyOtpMobile()" class="form-control" name="mobile_otp">
                                 <!-- <p style="color:red;">Invalid OTP !</p> -->
                                 <p id="mobile_otp_error"></p>
                                 <p>00.<span style="color:grey;" id="lbl_mobile_otp_timer">00</span> sec.</p>
                                 <p id="mobile_otp_resend_btn" style="color:blue;cursor: pointer;display: none;"><strong onclick="sendOtp()">Resend <i class="zmdi zmdi-rotate-left"></i></strong></p>
                              </div>
                              <div style="text-align:right;" class="col-lg-12">
                                 <div class="next-btn" style="margin-top:10px;height: 40px;width: 40px;padding: 6px;font-size: 20px;border-radius: 20px; text-align: center;border: 1px solid grey; float: right;cursor: pointer;" onclick="show_tab(3);"><i class="zmdi zmdi-trending-flat"></i></div>
                              </div>
                           </div>
                           <!-- Step 3 Registration -->
                           <form autocomplete="off">
                           <div style="display: none;margin-bottom: 10px;" class="card card-body tab tab3">
                              
                                    <div style="text-align:left;" class="col-lg-12">
                                       <div class="next-btn" style="height: 40px;width: 40px;padding: 6px;font-size: 20px;border-radius: 20px; text-align: center;border: 1px solid grey; float: left;cursor: pointer;" onclick="show_tab(2);"><i class="zmdi zmdi-arrow-left"></i></div>
                                    </div>
                                    <div class="col-lg-12 mt-3">
                                       <input type="email" onblur="sendOtpEmail()"  onkeyup="ValidateEmail()" placeholder="Email" id="email_id" class="form-control" name="email_id">
                                       <p id="email_id-error"></p>
                                    </div>
                                    <div class="col-lg-12 mt-3">
                                       <input type="text" style="display:none;" onkeyup="verifyOtpEmail()" id="email_otp" placeholder="Enter OTP" class="form-control" name="email_otp">
                                       <!-- <p style="color:red;">Invalid OTP !</p> -->
                                       <p id="email_otp_error"></p>
                                       <p>00.<span style="color:grey;" id="lbl_email_otp_timer">00</span> sec.</p>
                                       <p id="email_otp_resend_btn" style="color:blue;cursor: pointer;display: none;"><strong onclick="sendOtpEmail()">Resend <i class="zmdi zmdi-rotate-left"></i></strong></p>
                                    </div>

                                    <div style="text-align:right;" class="col-lg-12">
                                       <div class="next-btn" style="margin-top:10px;height: 40px;width: 40px;padding: 6px;font-size: 20px;border-radius: 20px; text-align: center;border: 1px solid grey; float: right;cursor: pointer;" onclick="show_tab(4);"><i class="zmdi zmdi-trending-flat"></i></div>
                                    </div>

                              
                           </div>
                           </form>
                           <!-- Step 4 Registration -->
                           <form autocomplete="off">
                           <div style="display: none;margin-bottom: 10px;" class="card card-body tab tab4">
                              <div style="text-align:left;" class="col-lg-12">
                                 <div class="next-btn" style="height: 40px;width: 40px;padding: 6px;font-size: 20px;border-radius: 20px; text-align: center;border: 1px solid grey; float: left;cursor: pointer;" onclick="show_tab(3);"><i class="zmdi zmdi-arrow-left"></i></div>
                              </div>
                              <div class="col-lg-12 mt-4">
                                 <p>Instruction :<i title="Password should be Min 6, Max 16, Atleast 1 Character,1 Number & 1 Symbol." class="zmdi zmdi-help-outline"></i></p>

                                 <input onkeyup="ValidatePassword();validateConfirmPassword();" type="password" placeholder="Create password" class="form-control" name="password" id="password">
                                 <p id="password-error" style="color:red;"></p>
                              </div>
                              <div class="col-lg-12 mt-4">
                                 <input type="password" onkeyup="validateConfirmPassword()" placeholder="Confirm password" class="form-control" id="confirm_password" name="confirm_password">
                                 <p id="confirm_password-error" style="color:red;"></p>
                              </div>
                              <div style="text-align:left;" class="col-lg-12 mt-4">
                                 
                                 <span><input id="chk_box" type="checkbox" name="chk_box"> <a style="color:black;" href="#">I agree to the <u>terms & conditions*</u></a></span></p>
                              </div>
                              <div style="text-align:right;" class="col-lg-12">
                                 <div class="finish-btn" onclick="finalSubmission()" style="margin-top:10px;height: 50px;padding: 10px;font-size: 20px;border-radius: 20px; text-align: center;background: #88e788; float: right;cursor: pointer;"><strong>Create Account</strong></div>
                              </div>
                           </div>
                           </form>
                           <div style="display: none;margin-bottom: 10px;" class="card card-body tab tab5">
                              <p>Your account has been successfully created, kindly login again with your credentials.</p>
                              <p>You will be redirected to login page in few seconds. </p>
                              <p>Do not refresh.Please wait.</p>
                           </div>
                        </div>
                        </div>
                     </div>
                  </div>
            </section>
         </div>
     <?php  $this->load->view('website/inc/footer'); ?>

   </body>
</html>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<style type="text/css">

/*.req-input{
   border: 1px solid red!important;
}*/
.next-btn:hover{
   background: black;
   color: white;
}
.finish-btn:hover{
   background: green!important;
}
.fill-step1, .fill-step2, .fill-step3{
   background-color: #9fdfaf;
}
.step{
   cursor: pointer;
}
.ul li{
   list-style-type: none;
   float: left;
   width: 33%;
   padding: 0px;
   font-size: 25px;
  text-align: center;
  color: white;

}
.step{
   width:10px; height:10px;border-radius: 5px;background: skyblue;
}

.image-about{
   width: 40%;
}
.image-team{
   border-radius: 50px;
   height: 100px;
   width: 100px;
}
   .float{
   position:fixed;
   /*width:60px;*/
   font-size: 20px;
   height:60px;
   bottom:40px;
   right:40px;
   background-color:#0C9;
   color:#FFF;
   border-radius:50px;
   text-align:center;
   box-shadow: 2px 2px 3px #999;
}
.my-float{
   margin-top:22px;
}
a:hover{
   color: white;
}
.not-effected:hover{
   color: black;
   text-decoration: none;
}
.not-underline{
   text-decoration: none;
}
body{margin-top:20px;}
.timeline-steps {
    display: flex;
    justify-content: center;
    flex-wrap: wrap
}

.timeline-steps .timeline-step {
    align-items: center;
    display: flex;
    flex-direction: column;
    position: relative;
    margin: 1rem
}

@media (min-width:768px) {
    .timeline-steps .timeline-step:not(:last-child):after {
        content: "";
        display: block;
        border-top: .25rem dotted #3b82f6;
        width: 3.46rem;
        position: absolute;
        left: 7.5rem;
        top: .3125rem
    }
    .timeline-steps .timeline-step:not(:first-child):before {
        content: "";
        display: block;
        border-top: .25rem dotted #3b82f6;
        width: 3.8125rem;
        position: absolute;
        right: 7.5rem;
        top: .3125rem
    }
}

.timeline-steps .timeline-content {
    width: 10rem;
    text-align: center
}

.timeline-steps .timeline-content .inner-circle {
    border-radius: 1.5rem;
    height: 1rem;
    width: 1rem;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background-color: #3b82f6
}

.timeline-steps .timeline-content .inner-circle:before {
    content: "";
    background-color: #3b82f6;
    display: inline-block;
    height: 3rem;
    width: 3rem;
    min-width: 3rem;
    border-radius: 6.25rem;
    opacity: .5
}
</style>
<script type="text/javascript">
   let dataObj = {
      first_name:null,
      middle_name:null,
      last_name:null,
      reg_role_id:null,
      mobile:null,
      email:null,
      password:null,
   };

   let step_1_f1=false;
   let step_1_f2=false;
   let email_valiadate = false;
   let password_valiadate = false;
   let mobile_otp = false;
   let email_otp = false;
   let confirm_password_valiadate = false;
   var emailValidateTextCode = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
   var passwordValidationCode = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/;
   let fill_stage = 1;
   show_tab(1);

   /*
      Form Submission Code start
   */
   function finalSubmission()
   {
      if($("#chk_box").prop('checked') == true && password_valiadate==true && confirm_password_valiadate==true)
      {
         dataObj.password = $('#password').val();
          $.ajax({
            type:'POST',
            url:'<?php echo base_url(); ?>Registration/finalRegistration',
            data:dataObj,
            success:function(resData)
            {
               resData = JSON.parse(resData);
               if(resData.status_code==200)
               {
                  fill_stage = 5;
                  show_tab(5);
                  setTimeout(function(){
                     window.location.href = '<?php echo base_url(); ?>';
                  },5000);
               }else
               {
                  swal("error",resData.msg,'error');
               }

            }
         });
      }
   }
   function verifyOtpMobile()
   {
      if($('#mobile_otp').val().length>5)
      {
         $.ajax({
            type:'POST',
            url:'<?php echo base_url(); ?>Registration/verifyOtp',
            data:{send_type: "M",send_to: $('#mobile_no').val(),otp: $('#mobile_otp').val()},
            success:function(resData)
            {
               resData = JSON.parse(resData);
               if(resData.status_code==200)
               {
                  console.log(resData);
                  $('#mobile_no').attr('disabled',true);
                  $('#mobile_otp').hide();
                  $('#mobile_otp_error').html('');
                  dataObj.mobile = $('#mobile_no').val();
                  show_tab(3);
               }else
               {
                  $('#mobile_otp_error').html('<span style="color:red;">Invalid OTP.</span>');
               }

            }
         });
      }
      
   }

   function verifyOtpEmail()
   {
      if($('#email_otp').val().length>5)
      {
         $.ajax({
            type:'POST',
            url:'<?php echo base_url(); ?>Registration/verifyOtp',
            data:{send_type: "E",send_to: $('#email_id').val(),otp: $('#email_otp').val()},
            success:function(resData)
            {
               resData = JSON.parse(resData);
               if(resData.status_code==200)
               {
                  console.log(resData);
                  $('#email_id').attr('disabled',true);
                  $('#email_otp').hide();
                  $('#email_otp_error').html('');
                  dataObj.email = $('#email_id').val();
                  show_tab(4);
               }else
               {
                  $('#email_otp_error').html('<span style="color:red;">Invalid OTP.</span>');
               }

            }
         });
      }
      
   }

   function saveStep1()
   {
      if($('#first_name').val()!='' && $('#last_name').val()!='' && $('#reg_role_id').val()!='')
      {
         dataObj.first_name = $('#first_name').val();
         dataObj.middle_name = $('#middle_name').val();
         dataObj.last_name = $('#last_name').val();
         dataObj.reg_role_id = $('#reg_role_id').val();
         formStep1 = true;
         show_tab(2);
      }else
      {
         show_tab(1);
      }
   }


   function ValidatePassword()
   {
      let password = $('#password').val();
      if(password.match(passwordValidationCode))
      {
         password_valiadate = true;
         $('#password-error').html('<span style="float: right;color:green;"><i class="zmdi zmdi-check-circle"></i></span>');
      }else
      {
         password_valiadate = false;
         $('#password-error').html('<span style="float: right;color:red;"><i class="zmdi zmdi-check-circle"></i></span>');
      }
   }

   function validateConfirmPassword()
   {
      if($('#password').val()==$('#confirm_password').val())
      {
         confirm_password_valiadate = true;
         $('#confirm_password-error').html('<span style="float: right;color:green;"><i class="zmdi zmdi-check-circle"></i></span>');
      }else
      {
         confirm_password_valiadate = false;
         $('#confirm_password-error').html('<span style="float: right;color:red;"><i class="zmdi zmdi-check-circle"></i></span>');
      }
   }

   function ValidateEmail()
   {
      let email = $('#email_id').val();
      if(email.match(emailValidateTextCode))
      {
         email_valiadate = true;
         $('#email_id-error').html('<span style="float: right;color:green;"><i class="zmdi zmdi-check-circle"></i></span>');
      }else
      {
         email_valiadate = false;
         $('#email_id-error').html('<span style="float: right;color:red;"><i class="zmdi zmdi-check-circle"></i></span>');
      }
   }
   function sendOtpEmail()
   {
      if(email_valiadate==true)
      {
         $('#email_otp_error').html('<div style="text-align:center;width:100%;"><img style="width:30px;height:30px;margin-top:5px;" src="<?php echo base_url(); ?>assets/otp_loader.gif" /><p style="color:green;">Waiting for OTP.</p></div>');
         $.ajax({
            type:'POST',
            url:'<?php echo base_url(); ?>Registration/sendOtp',
            data:{send_type: "E",send_to: $('#email_id').val()},
            success:function(resData)
            {
               resData = JSON.parse(resData);
               if(resData.status_code==200)
               {
                  // alert(resData.response_data);
                  $('#email_id').attr('disabled',true);
                  $('#email_otp').show();
                  otpTimerEmail('email');
               }else
               {
                  $('#email_otp_error').html('<span style="color:red;">OTP Sent Failed, Try Again.</span>');
               }

            }
         });
         
      }else
      {
         $('#email').attr('disabled',false);
      }
   }
   function sendOtp()
   {
      if($('#mobile_no').val().length>9)
      {
         $('#mobile_otp_error').html('<div style="text-align:center;width:100%;"><img style="width:30px;height:30px;margin-top:5px;" src="<?php echo base_url(); ?>assets/otp_loader.gif" /><p style="color:green;">Waiting for OTP.</p></div>');
         $.ajax({
            type:'POST',
            url:'<?php echo base_url(); ?>Registration/sendOtp',
            data:{send_type: "M",send_to: $('#mobile_no').val()},
            success:function(resData)
            {
               resData = JSON.parse(resData);
               if(resData.status_code==200)
               {
                  // alert(resData.response_data);
                  $('#mobile_no').attr('disabled',true);
                  $('#mobile_otp').show();
                  otpTimer('mobile');
               }else
               {
                  $('#mobile_otp_error').html('<span style="color:red;">OTP Sent Failed, Try Again.</span>');
               }

            }
         });
         
      }else
      {
         $('#mobile_no').attr('disabled',false);
      }
   }
   function otpTimer(otpType)
   {
      let timer_flag = null;
      let otp_mobile_timer = 10;
      timer_flag = setInterval(function(){
         if(otp_mobile_timer>0)
         {
            $('#lbl_'+otpType+'_otp_timer').html(getWholeNo(otp_mobile_timer));
             otp_mobile_timer--;
             $('#mobile_otp_resend_btn').hide();
         }else
         {
            clearInterval(timer_flag);
            $('#lbl_'+otpType+'_otp_timer').html(getWholeNo(0));
            $('#mobile_no').attr('disabled',false);
            $('#mobile_otp_resend_btn').show();
            $('#mobile_otp_error').html('');
         }
      },1000);  
   }

   function otpTimerEmail(otpType)
   {
      let timer_flag = null;
      let otp_email_timer = 10;
      timer_flag = setInterval(function(){
         if(otp_email_timer>0)
         {
            $('#lbl_'+otpType+'_otp_timer').html(getWholeNo(otp_email_timer));
             otp_email_timer--;
             $('#email_otp_resend_btn').hide();
         }else
         {
            clearInterval(timer_flag);
            $('#lbl_'+otpType+'_otp_timer').html(getWholeNo(0));
            $('#email_id').attr('disabled',false);
            $('#email_otp_resend_btn').show();
            $('#email_otp_error').html('');
         }
      },1000);  
   }

   function getWholeNo(number)
   {
      if(number<10)
            number= '0'+number;
      return number;
   }   

   function checkRequired(id)
   {
      if($('#'+id).val()=='')
      {
         if(id=='first_name')
         {
            step_1_f1=false;
         }
         if(id=='last_name')
         {
            step_1_f2=false;
         }
         document.getElementById(id).style.border = '1px solid red';
         document.getElementById('error-'+id).innerHTML = 'Required field !';
      }else
      {
         if(id=='first_name')
         {
            step_1_f1=true;
         }
         if(id=='last_name')
         {
            step_1_f2=true;
         }
         let sub_str = $('#'+id).val().substr(1,$('#'+id).val().length);
         let flett = $('#'+id).val()[0].toUpperCase();
         $('#'+id).val(flett+''+sub_str);
         document.getElementById(id).style.border = '1px solid green';
         document.getElementById('error-'+id).innerHTML = '';
      }
   }

   function optionalParaCap(id)
   {
      if($('#'+id).val().length>0)
      {
         let sub_str = $('#'+id).val().substr(1,$('#'+id).val().length);
         let flett = $('#'+id).val()[0].toUpperCase();
         $('#'+id).val(flett+''+sub_str);
      }
      
   }

   function stepbtnEffect(btn)
   {
      if(btn==1)
      {
         if(step_1_f1==true && step_1_f2==true)
         {
            document.querySelector('.btn-step1').style.background = 'black';
            document.querySelector('.btn-step1').style.color = 'white';
         }else
         {
            document.querySelector('.btn-step1').style.background = 'white';
            document.querySelector('.btn-step1').style.color = 'black';
         }
      }
   }
   function fillStage()
   {
      if(fill_stage==1)
      {
         $('#progress_bar').css('width','0%');
         $('#lbl_perc').html('0%');
      }
      if(fill_stage==2)
      {
         $('#progress_bar').css('width','30%');
         $('#lbl_perc').html('30%');
      }
      if(fill_stage==3)
      {
         $('#progress_bar').css('width','60%');
         $('#lbl_perc').html('60%');
      }
      if(fill_stage==4)
      {
         $('#progress_bar').css('width','90%');
         $('#lbl_perc').html('90%');
      }
      if(fill_stage==5)
      {
         $('#progress_bar').css('width','100%');
         $('#lbl_perc').html('100%');
      }
   }
   function show_tab(tab)
   {
      $('.tab').hide();
      $('.tab'+tab).show();
      fill_stage = tab;
      fillStage();
   }
   function sendOTP(e)
   {
      $(e).attr('disabled',true);
      let t = 60;
      let s = setInterval(function(){
         if(t>0)
         {
           $(e).html(t+'Sec');
           t--; 
         }else
         {
            clearInterval(s);
            $(e).html('Resend');
            $(e).attr('disabled',false);
         }
         
      },1000);
      
   }

</script>


<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->