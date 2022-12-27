<div class="clearfix"></div>
  
  <div style="background: #F3FCFB!important;padding-top: 125px;" class="content-wrapper">
    <div class="container-fluid">
    <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
        <h4 class="page-title">User Kyc</h4>
        
     </div>
     </div>
    <!-- End Breadcrumb-->
      <div class="row">
          <div class="col-lg-12">
            <!-- End Breadcrumb-->
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> User Kyc</div>
            <div class="card-body">

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
                            <form style="margin:10px auto;" id="kyc_request_form" method="post" action="<?php echo base_url("Kyc/userkycsubmit"); ?>" enctype="multipart/form-data">
                              <div style="padding: 10px;" class="row">
                                 <div class="col-md-6">
                                   
                                    <input type="text" onkeyup="verifyPan()" id="pan_number" required="" class="form-control" placeholder="PAN" name="pan_number">
                                    <p id="pan-error"></p>
                                    <p id="pan-errors"></p>
                                 </div>
                                 <div class="col-md-6">
                                   
                                    <input type="number" id="aadhar_number" onkeyup="verifyAadharNo()" required="" placeholder="AADHAR" class="form-control" name="aadhar_number">
                                    <p id="aadhar-error"></p>
                                    <p id="aadhar-errors"></p>
                                 </div>

                                   <div class="col-md-6">
                                   <label>Aadhar Front</label>
                                    <input type="file" required="" onchange="imageTobase64('aadhar_front')" placeholder="Aadhar front" id="aadhar_front" class="form-control" name="aadhar_front">
                                    <input type="hidden" id="hdn_aadhar_front" name="hdn_aadhar_front">
                                 </div>
                                 <div class="col-md-6">
                                    <label>Aadhar Back</label>
                                    <input type="file" required="" id="aadhar_back" onchange="imageTobase64('aadhar_back')" placeholder="Aadhar back" class="form-control" name="aadhar_back">
                                    <input type="hidden" id="hdn_aadhar_back" name="hdn_aadhar_back">
                                 </div>
                                 <div class="col-md-6">
                                   <label>Pan</label>
                                    <input type="file" required="" id="pan_image" onchange="imageTobase64('pan_image')" placeholder="Pan image" class="form-control" name="pan_image">
                                    <input type="hidden" id="hdn_pan_image" name="hdn_pan_image">
                                 </div>
                                 <div class="col-md-6">
                                   <label>Profile Picture</label>
                                    <input type="file" required="" onchange="imageTobase64('user_selfi')" placeholder="User image" class="form-control" id="user_selfi" name="user_selfi">
                                    <input type="hidden" id="hdn_user_selfi" name="hdn_user_selfi">
                                 </div>
                              </div>

                              <div style="padding:5px;" class="row">
                                 <div class="col-md-12" style="margin-top:10px;text-align: center;">
                                   <button type="submit" name="submit_kyc" class="btn btn-lg btn-success">Submit Kyc Request</button>
                                 </div>
                              </div>
                            </form>
                            <?php
                        }
                        
                     
                    }else
                    {
                        ?>
                        <form style="margin:10px auto;" id="kyc_request_form" method="post" action="<?php echo base_url("Kyc/userkycsubmit"); ?>" enctype="multipart/form-data">
                              <div style="padding: 10px;" class="row">
                                 <div class="col-md-6">
                                   
                                    <input type="text" onkeyup="verifyPan()" id="pan_number" required="" class="form-control" placeholder="PAN" name="pan_number">
                                    <p id="pan-error"></p>
                                    <p id="pan-errors"></p>
                                 </div>
                                 <div class="col-md-6">
                                   
                                    <input type="number" id="aadhar_number" onkeyup="verifyAadharNo()" required="" placeholder="AADHAR" class="form-control" name="aadhar_number">
                                    <p id="aadhar-error"></p>
                                    <p id="aadhar-errors"></p>
                                 </div>

                                   <div class="col-md-6">
                                   <label>Aadhar Front</label>
                                    <input type="file" required="" onchange="imageTobase64('aadhar_front')" placeholder="Aadhar front" id="aadhar_front" class="form-control" name="aadhar_front">
                                    <input type="hidden" id="hdn_aadhar_front" name="hdn_aadhar_front">
                                 </div>
                                 <div class="col-md-6">
                                    <label>Aadhar Back</label>
                                    <input type="file" required="" id="aadhar_back" onchange="imageTobase64('aadhar_back')" placeholder="Aadhar back" class="form-control" name="aadhar_back">
                                    <input type="hidden" id="hdn_aadhar_back" name="hdn_aadhar_back">
                                 </div>
                                 <div class="col-md-6">
                                   <label>Pan</label>
                                    <input type="file" required="" id="pan_image" onchange="imageTobase64('pan_image')" placeholder="Pan image" class="form-control" name="pan_image">
                                    <input type="hidden" id="hdn_pan_image" name="hdn_pan_image">
                                 </div>
                                 <div class="col-md-6">
                                   <label>Profile Picture</label>
                                    <input type="file" required="" onchange="imageTobase64('user_selfi')" placeholder="User image" class="form-control" id="user_selfi" name="user_selfi">
                                    <input type="hidden" id="hdn_user_selfi" name="hdn_user_selfi">
                                 </div>
                              </div>

                              <div style="padding:5px;" class="row">
                                 <div class="col-md-12" style="margin-top:10px;text-align: center;">
                                   <button type="submit" name="submit_kyc" class="btn btn-lg btn-success">Submit Kyc Request</button>
                                 </div>
                              </div>
                      </form>
                        <?php
                    }
                ?>
              
            </div>
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
let pan_verify = false;
let aadhar_verify = false;

function verifyPan()
{

     var regex = /[A-Z]{5}[0-9]{4}[A-Z]{1}$/;    
     if(!regex.test($('#pan_number').val().toUpperCase())){         
     console.log("invalid PAN no");    
      $('#pan-error').html('<span style="float: right;color:red;"><i class="zmdi zmdi-check-circle"></i></span>');
      pan_verify = false;
     }else
     {
      console.log("Valid");
      $('#pan-error').html('<span style="float: right;color:green;"><i class="zmdi zmdi-check-circle"></i></span>');
      pan_verify = true;
      $('#pan-errors').html('');
     }
}
function verifyAadharNo()
{
   
   if($('#aadhar_number').val().length==12)
      {            
         console.log("Valid");
         $('#aadhar-error').html('<span style="float: right;color:green;"><i class="zmdi zmdi-check-circle"></i></span>');
         aadhar_verify = true;
         $('#aadhar-errors').html('');
     }else
     {
      console.log("invalid Aadhar no"); 
      $('#aadhar-error').html('<span style="float: right;color:red;"><i class="zmdi zmdi-check-circle"></i></span>');
      aadhar_verify = false;
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
         console.log(data);
        } 
   );
}
$('#kyc_request_form').submit((e)=>{
   e.preventDefault();
   if(pan_verify==false)
   {
      $('#pan-errors').html('<span style="color:red;">Invalid Pan !</span>');
   }else if(aadhar_verify==false)
   {
      $('#aadhar-errors').html('<span style="color:red;">Invalid Aadhar !</span>');
   }else
   {
      let data = $('#kyc_request_form').serializeArray();
      $.ajax({
         type:'POST',
         url:'<?php echo base_url(); ?>Kyc/userkycsubmit',
         data:data,
         success:function(res)
         {
             res = JSON.parse(res);
             if(res.response_code == 200){
                
                 swal("SUCCESS!", ''+res.msg+'', "success");
                 setTimeout(function(){ window.location.href='<?php echo base_url(); ?>Billing/billing'; }, 1000);
            }
             else
             {
               swal("ERROR!", ''+res.msg+'', "error");
             }
         }
       });
   }
   
})
</script>