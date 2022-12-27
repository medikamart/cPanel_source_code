<div class="clearfix"></div>
  
  <div style="background: #F3FCFB!important;padding-top: 125px;" class="content-wrapper">
    <div class="container-fluid">
    <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
        <h4 class="page-title">Business Kyc</h4>
        
     </div>
     </div>
    <!-- End Breadcrumb-->
      <div class="row">
          <div class="col-lg-12">
            <!-- End Breadcrumb-->
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Business Kyc</div>
            <?php 
                if(!empty($kyc))
                {
                    if($kyc[0]['current_status']=='requested')
                    {
                        ?>
                        <h6 style="text-align:center;">Pending from admin.</h6>
                        <?php
                    }elseif($kyc[0]['current_status']=='completed')
                    {
                        ?>
                        <h6 style="text-align:center;color: green;">Your Kyc Successfully Completed.</h6>
                        <?php
                    }elseif($kyc[0]['current_status']=='rejected')
                    {
                        ?>
                        <h6 style="text-align:center;">Rejected due to :-</h6 style="text-align:center;">
                            <p style="text-align:center;color: red;"><?php echo $kyc[0]['action_remarks'] ?></p>
                        <form method="POST" id="businessKycForm" enctype="multipart/form-data" action="<?php echo base_url(); ?>BusinessKyc/kyc_form_submission">
                            <div class="card-body">
                              <div class="row">
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <input title="Business Name" type="text" placeholder="Business Name" class="form-control" id="business_name" name="business_name">
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <select title="Business Type" onchange="getKycForm(this.value)" class="form-control" name="business_type" id="business_type">
                                              <option value="">Business Type</option>
                                              <?php
                                              if(!empty($business_type))
                                              {
                                                foreach($business_type as $key=>$value)
                                                {
                                                    ?>
                                                    <option value="<?php echo $value['id']; ?>"><?php echo $value['business_type']; ?></option>
                                                    <?php
                                                }
                                              }

                                              ?>
                                          </select>
                                      </div>
                                  </div>
                              </div>
                              <section id="kyc_form_area">
                                
                              </section>
                              <div class="row mt-5">
                                  <div class="col-md-12">
                                      <div style="text-align:center;" class="form-group">
                                         <button type="button" onclick="submitKycRequest()" class="btn btn-md btn-info">Submit</button>
                                      </div>
                                     
                                  </div>
                              </div>
                            </div>
                        </form>
                        <?php
                    }
            }else
            {
                ?>
                <form method="POST" id="businessKycForm" enctype="multipart/form-data" action="<?php echo base_url(); ?>BusinessKyc/kyc_form_submission">
                    <div class="card-body">
                      <div class="row">
                          <div class="col-md-4">
                              <div class="form-group">
                                  <input title="Business Name" type="text" placeholder="Business Name" class="form-control" id="business_name" name="business_name">
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                                  <select title="Business Type" onchange="getKycForm(this.value)" class="form-control" name="business_type" id="business_type">
                                      <option value="">Business Type</option>
                                      <?php
                                      if(!empty($business_type))
                                      {
                                        foreach($business_type as $key=>$value)
                                        {
                                            ?>
                                            <option value="<?php echo $value['id']; ?>"><?php echo $value['business_type']; ?></option>
                                            <?php
                                        }
                                      }

                                      ?>
                                  </select>
                              </div>
                          </div>
                      </div>
                      <section id="kyc_form_area">
                        
                      </section>
                      <div class="row mt-5">
                          <div class="col-md-12">
                              <div style="text-align:center;" class="form-group">
                                 <button type="button" onclick="submitKycRequest()" class="btn btn-md btn-info">Submit</button>
                              </div>
                             
                          </div>
                      </div>
                    </div>
                </form>
                <?php
            }

            ?>
            
          </div>
        </div>
      </div><!-- End Row-->
        </div>
      </div>

    </div>
    <!-- End container-fluid-->

    <div class="overlay"></div>
    
   </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
<?php 

    if($this->session->flashdata('success')!=null)
    {
        ?>
        <script type="text/javascript">
            swal('success','<?php echo $this->session->flashdata("success") ?>','success');
        </script>
        <?php
        $this->session->set_flashdata('success',null);
    }
    if($this->session->flashdata('error')!=null)
    {
        ?>
        <script type="text/javascript">
            swal('error','<?php echo $this->session->flashdata("error") ?>','error');
        </script>
        <?php
        $this->session->set_flashdata('error',null);
    }
?>
<style type="text/css">
   canvas{
      display: none;
      margin: 0px auto;
   }
   video:{
      display: none;
      margin: 0px auto;
   }
</style>
<script type="text/javascript">
var emailValidateTextCode = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
let email_valiadate = false;
let partners_contacts_match = false;
let partners_emails_match = false;
let directors_contacts_match = false;
let directors_emails_match = false;
let dataObj = {
  business_type:null,
  business_name:null,
  business_contact:null,
  business_email:null,
  business_address:null,
  shop_with_bill_board:null,
  owner_name:null,
  address_proof:null
};


function addressType(type)
{
  if(type==2)
  {
    $('#rent_agreement_area').show();
  }else
  {
    $('#rent_agreement_area').hide();
  }
}
function getBase64(file) {
  return new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve(reader.result);
    reader.onerror = error => reject(error);
  });
}


function imageTobase64(inp_file)
{
   var file = document.querySelector('#'+inp_file).files[0];
   getBase64(file).then(
        data =>{
         document.getElementById('hdn_'+inp_file).value = data.split('base64,')[1];
         // console.log(data);
        } 
   );
}

function getKycForm(form_type)
{
  $.ajax({
    type:'POST',
    url:'<?php  echo base_url(); ?>BusinessKyc/get_kyc_form',
    data:{form_type: form_type},
    success:function(res)
    {
      $('#kyc_form_area').html(res);
    }
  })
}
function submitKycRequest()
{
  swal({
  title: "Are you sure?",
  text: "Please verify all of this before submission",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
        $('#businessKycForm').submit();
      // let businessKycFormData = $('#businessKycForm').serializeArray();
      // $.ajax({
      //   type:'POST',
      //   url:'<?php echo base_url(); ?>BusinessKyc/kyc_form_submission',
      //   data:businessKycFormData,
      //   success:function(res)
      //   {
      //     res = JSON.parse(res);
      //     if(res.response_code==200)
      //     {
      //       swal('success',res.Message,'success');
      //     }else
      //     {
      //       swal('error',res.Message,'error');
      //     }
      //   }
      // })
      // console.log(businessKycFormData);
  }
});
}


function verifyOtpMobile()
{
  if($('#business_contact_otp').val().length>5)
  {
     $.ajax({
        type:'POST',
        url:'<?php echo base_url(); ?>Registration/verifyOtp',
        data:{send_type: "M",send_to: $('#business_contact').val(),otp: $('#business_contact_otp').val()},
        success:function(resData)
        {
           resData = JSON.parse(resData);
           if(resData.status_code==200)
           {
              console.log(resData);
              $('#business_contact').attr('disabled',true);
              $('#business_contact_otp').hide();
              $('#business_contact_error').html('');
              dataObj.business_contact = $('#business_contact').val();
           }else
           {
              $('#business_contact_error').html('<span style="color:red;">Invalid OTP.</span>');
           }

        }
     });
  }
  
}

function verifyOtpEmail()
{
  if($('#business_email_otp').val().length>5)
  {
     $.ajax({
        type:'POST',
        url:'<?php echo base_url(); ?>Registration/verifyOtp',
        data:{send_type: "E",send_to: $('#business_email').val(),otp: $('#business_email_otp').val()},
        success:function(resData)
        {
           resData = JSON.parse(resData);
           if(resData.status_code==200)
           {
              console.log(resData);
              $('#business_email').attr('disabled',true);
              $('#business_email_otp').hide();
              $('#business_email_error').html('');
              dataObj.email = $('#business_email').val();
           }else
           {
              $('#business_email_error').html('<span style="color:red;">Invalid OTP.</span>');
           }

        }
     });
  }
  
}


function business_type_ui(type)
{
    $('.partnership_deed').hide();
    $('.mca_certificate').hide();
    $('.business_pan').hide();
    $('.owner_name').hide();
    $('.partners_name').hide();
    $('.directors_name').hide();
    $('.cin_no').hide();
    if(type==1)
    {
        //Unregistered
        $('.partnership_deed').hide();
        $('.mca_certificate').hide();
        $('.business_pan').hide();
        $('.owner_name').show();
        $('.partners_name').hide();
        $('.directors_name').hide();
        $('.cin_no').hide();

    }else if(type==2)
    {
        //Proprietorship
        $('.partnership_deed').hide();
        $('.mca_certificate').hide();
        $('.business_pan').show();
        $('.owner_name').show();
        $('.partners_name').hide();
        $('.directors_name').hide();
        $('.cin_no').hide();

    }else if(type==3)
    {
        //Partnership
        $('.partnership_deed').show();
        $('.mca_certificate').hide();
        $('.business_pan').show();
        $('.owner_name').hide();
        $('.partners_name').show();
        $('.directors_name').hide();
        $('.cin_no').hide();

    }else if(type==4)
    {
        // Limited Liability Partnership
        $('.partnership_deed').hide();
        $('.mca_certificate').show();
        $('.business_pan').show();
        $('.owner_name').hide();
        $('.partners_name').hide();
        $('.directors_name').show();
        $('.cin_no').hide();

    }else if(type==5)
    {
        //Private Limited
        $('.partnership_deed').hide();
        $('.mca_certificate').show();
        $('.business_pan').show();
        $('.owner_name').hide();
        $('.partners_name').hide();
        $('.directors_name').show();
        $('.cin_no').show();

    }
}

function ValidateEmail()
{
  let email = $('#business_email').val();
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
     $('#business_email_error').html('<div style="text-align:center;width:100%;"><img style="width:30px;height:30px;margin-top:5px;" src="<?php echo base_url(); ?>assets/otp_loader.gif" /><p style="color:green;">Waiting for OTP.</p></div>');
     $.ajax({
        type:'POST',
        url:'<?php echo base_url(); ?>Registration/sendOtp',
        data:{send_type: "E",send_to: $('#business_email').val()},
        success:function(resData)
        {
           resData = JSON.parse(resData);
           if(resData.status_code==200)
           {
              
              $('#business_email').attr('disabled',true);
              $('#business_email_otp').show();
              otpTimerEmail('email');
           }else
           {
              $('#business_email_error').html('<span style="color:red;">OTP Sent Failed, Try Again.</span>');
           }

        }
     });
     
  }else
  {
     $('#business_email').attr('disabled',false);
  }
}
function sendOtp()
{
  if($('#business_contact').val().length>9)
  {
     $('#business_contact_error').html('<div style="text-align:center;width:100%;"><img style="width:30px;height:30px;margin-top:5px;" src="<?php echo base_url(); ?>assets/otp_loader.gif" /><p style="color:green;">Waiting for OTP.</p></div>');
     $.ajax({
        type:'POST',
        url:'<?php echo base_url(); ?>Registration/sendOtp',
        data:{send_type: "M",send_to: $('#business_contact').val()},
        success:function(resData)
        {
           resData = JSON.parse(resData);
           if(resData.status_code==200)
           {
              
              $('#business_contact').attr('disabled',true);
              $('#contact_phone_otp').show();
              otpTimer('mobile');
           }else
           {
              $('#business_contact_error').html('<span style="color:red;">OTP Sent Failed, Try Again.</span>');
           }

        }
     });
     
  }else
  {
     $('#business_contact').attr('disabled',false);
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
        $('#business_contact').attr('disabled',false);
        $('#mobile_otp_resend_btn').show();
        $('#business_contact_error').html('');
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
        $('#business_email').attr('disabled',false);
        $('#email_otp_resend_btn').show();
        $('#business_email_error').html('');
     }
  },1000);  
}

function getWholeNo(number)
{
  if(number<10)
        number= '0'+number;
  return number;
}

function addPartners(max)
{
    max = max<2?2:max;
    max = max>15?15:max;
    $('#partners_count').val(max);
    let pi = 0;
    $('#partners_name_area').html('');
    while(pi<max)
    {
        if(pi==0)
        {
            $('#partners_name_area').append('<div class="col-md-4 mt-2">'+
                                                '<input type="text" class="form-control" name="partners_name[]" placeholder="Primary Partner\'s Name" >'+
                                              '</div>'+
                                              '<div class="col-md-4 mt-2">'+
                                                '<input onkeyup="validatePartnersPhone()" type="number" class="form-control partners_contact_validation" name="partners_contact[]" id="p_'+pi+'" placeholder="Partner\'s Contact" >'+
                                                '<p id="partners_contact_validation_'+pi+'"></p>'+
                                              '</div>'+
                                              '<div class="col-md-4 mt-2">'+
                                                '<input type="email" onkeyup="validatePartnersEmail()" class="form-control partners_email_validation" name="partners_email[]" placeholder="Partner\'s Email" id="e_'+pi+'" >'+
                                                '<p id="partners_email_validation_'+pi+'"></p>'+
                                              '</div>');
        }else
        {
            $('#partners_name_area').append('<div class="col-md-4 mt-2">'+
                                                '<input type="text" class="form-control" name="partners_name[]" placeholder="Secondry Partner\'s Name" >'+
                                              '</div>'+
                                              '<div class="col-md-4 mt-2">'+
                                                '<input onkeyup="validatePartnersPhone()" type="number" class="form-control partners_contact_validation" name="partners_contact[]" id="p_'+pi+'" placeholder="Partner\'s Contact" >'+
                                                '<p id="partners_contact_validation_'+pi+'"></p>'+
                                              '</div>'+
                                              '<div class="col-md-4 mt-2">'+
                                                '<input type="email" onkeyup="validatePartnersEmail()" class="form-control partners_email_validation" name="partners_email[]" placeholder="Partner\'s Email" id="e_'+pi+'" >'+
                                                '<p id="partners_email_validation_'+pi+'"></p>'+
                                              '</div>');
        }
        pi++;
    }   
}  


function addDirectors(max)
{
    max = max<2?2:max;
    max = max>15?15:max;
    $('#directors_count').val(max);
    let pi = 0;
    $('#directors_name_area').html('');
    while(pi<max)
    {
        $('#directors_name_area').append('<div class="col-md-4 mt-2">'+
                                          '<input type="text" class="form-control" name="directors_name[]" placeholder="'+(pi+1)+' Director\'s Name" >'+
                                        '</div>'+
                                        '<div class="col-md-4 mt-2">'+
                                          '<input onkeyup="validateDirectorsPhone()" type="number" class="form-control directors_contact_validation" name="directors_contact[]" id="p_'+pi+'" placeholder="Director\'s Contact" >'+
                                          '<p id="directors_contact_validation_'+pi+'"></p>'+
                                        '</div>'+
                                        '<div class="col-md-4 mt-2">'+
                                          '<input type="email" onkeyup="validateDirectorsEmail()" class="form-control directors_email_validation" name="directors_email[]" placeholder="Director\'s Email" id="e_'+pi+'" >'+
                                          '<p id="directors_email_validation_'+pi+'"></p>'+
                                        '</div>');
        pi++;
    }   
}  

$(document).ready(function() {
     $('body').bind('cut copy paste', function(event) {
     event.preventDefault();
     });
 });
function removePi(dpi)
{
    $('#partners_name_'+dpi).remove();
    pinos--;
} 

function validatePartnersPhone()
{
    partners_contacts_match = true;
    let contact_array = [];
    $('.partners_contact_validation').each(function(i,v) {
       // console.log(v.value);
       contact_array.push(v.value);
    });
    let findDuplicates = contact_array.filter((item, index) => contact_array.indexOf(item) != index);
    removeItemAll(findDuplicates, '');
    console.log(findDuplicates);
    $('.partners_contact_validation').each(function(i,v) {
       if(findDuplicates.includes(v.value))
       {
            $('#partners_contact_validation_'+v.id.split('_')[1]).html('<span style="color:red;">Same number not allowed !</span>');
            partners_contacts_match = false;
       }else
       {
            $('#partners_contact_validation_'+v.id.split('_')[1]).html('');
       }
    });
}

function validatePartnersEmail()
{
    partners_emails_match = true;
    let contact_array = [];
    $('.partners_email_validation').each(function(i,v) {
       // console.log(v.value);
       contact_array.push(v.value);
    });
    let findDuplicates = contact_array.filter((item, index) => contact_array.indexOf(item) != index);
    removeItemAll(findDuplicates, '');
    console.log(findDuplicates);
    $('.partners_email_validation').each(function(i,v) {
       if(findDuplicates.includes(v.value))
       {
            $('#partners_email_validation_'+v.id.split('_')[1]).html('<span style="color:red;">Same email not allowed !</span>');
            // console.log();
            partners_emails_match = false;
       }else
       {
              let email = v.value;
              if(email.match(emailValidateTextCode))
              {

                 $('#partners_email_validation_'+v.id.split('_')[1]).html('<span style="float: right;color:green;"><i class="zmdi zmdi-check-circle"></i></span>');
              }else
              {
                 partners_emails_match = false;
                 $('#partners_email_validation_'+v.id.split('_')[1]).html('<span style="float: right;color:red;"><i class="zmdi zmdi-check-circle"></i></span>');
              }
       }
    });
}

function validateDirectorsPhone()
{
    directors_contacts_match = true;
    let contact_array = [];
    $('.directors_contact_validation').each(function(i,v) {
       // console.log(v.value);
       contact_array.push(v.value);
    });
    let findDuplicates = contact_array.filter((item, index) => contact_array.indexOf(item) != index);
    removeItemAll(findDuplicates, '');
    console.log(findDuplicates);
    $('.directors_contact_validation').each(function(i,v) {
       if(findDuplicates.includes(v.value))
       {
            $('#directors_contact_validation_'+v.id.split('_')[1]).html('<span style="color:red;">Same number not allowed !</span>');
            partners_contacts_match = false;
       }else
       {
            $('#directors_contact_validation_'+v.id.split('_')[1]).html('');
       }
    });
}

function validateDirectorsEmail()
{
    directors_emails_match = true;
    let contact_array = [];
    $('.directors_email_validation').each(function(i,v) {
       // console.log(v.value);
       contact_array.push(v.value);
    });
    let findDuplicates = contact_array.filter((item, index) => contact_array.indexOf(item) != index);
    removeItemAll(findDuplicates, '');
    console.log(findDuplicates);
    $('.directors_email_validation').each(function(i,v) {
       if(findDuplicates.includes(v.value))
       {
            $('#directors_email_validation_'+v.id.split('_')[1]).html('<span style="color:red;">Same email not allowed !</span>');
            // console.log();
            directors_emails_match = false;
       }else
       {
              let email = v.value;
              if(email.match(emailValidateTextCode))
              {

                 $('#directors_email_validation_'+v.id.split('_')[1]).html('<span style="float: right;color:green;"><i class="zmdi zmdi-check-circle"></i></span>');
              }else
              {
                 partners_emails_match = false;
                 $('#directors_email_validation_'+v.id.split('_')[1]).html('<span style="float: right;color:red;"><i class="zmdi zmdi-check-circle"></i></span>');
              }
       }
    });
}



function removeItemAll(arr, value) {
  var i = 0;
  while (i < arr.length) {
    if (arr[i] === value) {
      arr.splice(i, 1);
    } else {
      ++i;
    }
  }
  return arr;
}

</script>
<style type="text/css">
    .removebtn
    {
        font-size: 12px;
        cursor: pointer;
    }
    .removebtn:hover
    {
        color: red;
        text-decoration: underline;
    }
</style>