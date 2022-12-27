<div class="clearfix"></div>
  
  <div style="background: #F3FCFB!important;padding-top: 125px;" class="content-wrapper">
    <div class="container-fluid">
    <!-- Breadcrumb-->
     <div class="row pt-2 pb-2 mt-5">
        <div class="col-sm-9">
        <h4 class="page-title">Business KYC Details</h4>
        
     </div>
     </div>
    <!-- End Breadcrumb-->
      <div class="row">
          <div class="col-lg-12">
            <!-- End Breadcrumb-->
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> KYC Details</div>
            <div class="card-body">
            <div class="card card-body">
              <h5>Business Basic</h5>
              <div class="row">
                <div class="col-md-4">
                  <label>Business Name</label>
                  <input type="text" readonly="readonly" name="" value="<?php echo $businessData[0]['business_name']; ?>" class="form-control">
                </div>
                <div class="col-md-4">
                  <label>business_type</label>
                  <input type="text" readonly="readonly" name="" value="<?php 
                  if($businessData[0]['business_type']==1)
                  {
                    echo 'Unregistered';
                  }elseif($businessData[0]['business_type']==2)
                  {
                    echo 'Proprietorship';
                  }elseif($businessData[0]['business_type']==3)
                  {
                    echo 'Partnership';
                  }elseif($businessData[0]['business_type']==4)
                  {
                    echo 'Limited Liability Partnership';
                  }elseif($businessData[0]['business_type']==5)
                  {
                    echo 'Private Limited';
                  } ?>" class="form-control">
                </div>
                <div class="col-md-4">
                  <label>business_contact</label>
                  <input type="text" readonly="readonly" name="" value="<?php echo $businessData[0]['business_contact']; ?>" class="form-control">
                </div>
                <div class="col-md-4">
                  <label>business_email</label>
                  <input type="text" readonly="readonly" name="" value="<?php echo $businessData[0]['business_email']; ?>" class="form-control">
                </div>
                <div class="col-md-4">
                  <label>business_address</label>
                  <input type="text" readonly="readonly" name="" value="<?php echo $businessData[0]['business_address']; ?>" class="form-control">
                </div>
                <div class="col-md-4">
                  <label>requested_date</label>
                  <input type="text" readonly="readonly" name="" value="<?php echo $businessData[0]['requested_date']; ?>" class="form-control">
                </div>
                <div class="col-md-4">
                  <label>current_status</label>
                  <input type="text" readonly="readonly" name="" value="<?php echo $businessData[0]['current_status']; ?>" class="form-control">
                </div>
                <div class="col-md-4">
                  <label>address_type</label>
                  <input type="text" readonly="readonly" name="" value="<?php 
                  if($businessData[0]['address_type']==1)
                  {
                    echo 'OWNER';
                  }elseif($businessData[0]['address_type']==2)
                  {
                    echo 'RENTER';
                  } ?>" class="form-control">
                </div>
                <?php

                  if($businessData[0]['business_type']==1)
                  {
                    ?>
                    <div class="col-md-4">
                      <label>owner_name</label>
                      <input type="text" readonly="readonly" name="" value="<?php echo $businessData[0]['owner_name']; ?>" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label>aadhar_no</label>
                      <input type="text" readonly="readonly" name="" value="<?php echo $businessData[0]['aadhar_no']; ?>" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label>pan_no</label>
                      <input type="text" readonly="readonly" name="" value="<?php echo $businessData[0]['pan_no']; ?>" class="form-control">
                    </div>

                    <?php
                  }elseif($businessData[0]['business_type']==2)
                  {
                    ?>
                    <div class="col-md-4">
                      <label>owner_name</label>
                      <input type="text" readonly="readonly" name="" value="<?php echo $businessData[0]['owner_name']; ?>" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label>aadhar_no</label>
                      <input type="text" readonly="readonly" name="" value="<?php echo $businessData[0]['aadhar_no']; ?>" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label>pan_no</label>
                      <input type="text" readonly="readonly" name="" value="<?php echo $businessData[0]['pan_no']; ?>" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label>gst_no</label>
                      <input type="text" readonly="readonly" name="" value="<?php echo $businessData[0]['gst_no']; ?>" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label>registration_no</label>
                      <input type="text" readonly="readonly" name="" value="<?php echo $businessData[0]['registration_no']; ?>" class="form-control">
                    </div>
                    <?php
                  }elseif($businessData[0]['business_type']==3)
                  {
                    ?>
                    <div class="col-md-4">
                      <label>primary_partner_aadhar_no</label>
                      <input type="text" readonly="readonly" name="" value="<?php echo $businessData[0]['primary_partner_aadhar_no']; ?>" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label>primary_partner_pan_no</label>
                      <input type="text" readonly="readonly" name="" value="<?php echo $businessData[0]['primary_partner_pan_no']; ?>" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label>business_pan</label>
                      <input type="text" readonly="readonly" name="" value="<?php echo $businessData[0]['business_pan']; ?>" class="form-control">
                    </div>
                    <?php
                  }elseif($businessData[0]['business_type']==4)
                  {
                    ?> 
                      <div class="col-md-4">
                        <label>primary_director_aadhar</label>
                        <input type="text" readonly="readonly" name="" value="<?php echo $businessData[0]['primary_director_aadhar']; ?>" class="form-control">
                      </div>
                      <div class="col-md-4">
                        <label>primary_director_pan</label>
                        <input type="text" readonly="readonly" name="" value="<?php echo $businessData[0]['primary_director_pan']; ?>" class="form-control">
                      </div> 
                    <?php
                  }elseif($businessData[0]['business_type']==5)
                  {
                    ?>
                    <div class="col-md-4">
                        <label>primary_director_aadhar</label>
                        <input type="text" readonly="readonly" name="" value="<?php echo $businessData[0]['primary_director_aadhar']; ?>" class="form-control">
                      </div>
                      <div class="col-md-4">
                        <label>primary_director_pan</label>
                        <input type="text" readonly="readonly" name="" value="<?php echo $businessData[0]['primary_director_pan']; ?>" class="form-control">
                      </div>
                      <div class="col-md-4">
                        <label>cin_no</label>
                        <input type="text" readonly="readonly" name="" value="<?php echo $businessData[0]['cin_no']; ?>" class="form-control">
                      </div>
                    <?php
                  }
                 ?>
              </div>
            </div>
            <div class="card card-body">
              <h5>Business Document</h5>
              <div class="row">
                <div class="col-md-4">
                  <label>shop_with_bill_board</label>
                  <p><a target="_blank" href="<?php echo $base_url.'all-uploaded-img/businesskyc/'.$businessData[0]['shop_with_bill_board']; ?>" style="color:green!important;">view</a></p>
                </div>
                <div class="col-md-4">
                  <label>electricity_bill</label>
                  <p><a target="_blank" href="<?php echo $base_url.'all-uploaded-img/businesskyc/'.$businessData[0]['electricity_bill']; ?>" style="color:green!important;">view</a></p>
                </div>
                <?php 
                  if($businessData[0]['business_type']==2)
                  {
                    ?>
                    <div class="col-md-4">
                      <label>rent_agreement</label>
                      <p><a target="_blank" href="<?php echo $base_url.'all-uploaded-img/businesskyc/'.$businessData[0]['rent_agreement']; ?>" style="color:green!important;">view</a></p>
                    </div>
                    <?php
                  }
                  if($businessData[0]['business_type']==1)
                  {
                    ?>
                    <div class="col-md-4">
                      <label>adhar_document</label>
                      <p><a target="_blank" href="<?php echo $base_url.'all-uploaded-img/businesskyc/'.$businessData[0]['adhar_document']; ?>" style="color:green!important;">view</a></p>
                    </div>
                    <div class="col-md-4">
                      <label>pan_document</label>
                      <p><a target="_blank" href="<?php echo $base_url.'all-uploaded-img/businesskyc/'.$businessData[0]['pan_document']; ?>" style="color:green!important;">view</a></p>
                    </div>
                    <?php
                  }elseif($businessData[0]['business_type']==2)
                  {
                    ?>
                      <div class="col-md-4">
                        <label>adhar_document</label>
                        <p><a target="_blank" href="<?php echo $base_url.'all-uploaded-img/businesskyc/'.$businessData[0]['adhar_document']; ?>" style="color:green!important;">view</a></p>
                      </div>
                      <div class="col-md-4">
                        <label>pan_document</label>
                        <p><a target="_blank" href="<?php echo $base_url.'all-uploaded-img/businesskyc/'.$businessData[0]['pan_document']; ?>" style="color:green!important;">view</a></p>
                      </div>
                      <div class="col-md-4">
                        <label>gst_certificate</label>
                        <p><a target="_blank" href="<?php echo $base_url.'all-uploaded-img/businesskyc/'.$businessData[0]['gst_certificate']; ?>" style="color:green!important;">view</a></p>
                      </div>
                    <?php
                  }elseif($businessData[0]['business_type']==3)
                  {
                    ?>
                    <div class="col-md-4">
                        <label>gst_certificate</label>
                        <p><a target="_blank" href="<?php echo $base_url.'all-uploaded-img/businesskyc/'.$businessData[0]['gst_certificate']; ?>" style="color:green!important;">view</a></p>
                    </div>
                    <div class="col-md-4">
                        <label>primary_partner_adhar_document</label>
                        <p><a target="_blank" href="<?php echo $base_url.'all-uploaded-img/businesskyc/'.$businessData[0]['primary_partner_adhar_document']; ?>" style="color:green!important;">view</a></p>
                      </div>
                      <div class="col-md-4">
                        <label>primary_partner_pan_document</label>
                        <p><a target="_blank" href="<?php echo $base_url.'all-uploaded-img/businesskyc/'.$businessData[0]['primary_partner_pan_document']; ?>" style="color:green!important;">view</a></p>
                      </div>
                      <div class="col-md-4">
                        <label>self_declaration_document</label>
                        <p><a target="_blank" href="<?php echo $base_url.'all-uploaded-img/businesskyc/'.$businessData[0]['self_declaration_document']; ?>" style="color:green!important;">view</a></p>
                      </div>
                      <div class="col-md-4">
                        <label>partnership_deed</label>
                        <p><a target="_blank" href="<?php echo $base_url.'all-uploaded-img/businesskyc/'.$businessData[0]['partnership_deed']; ?>" style="color:green!important;">view</a></p>
                      </div>
                      <div class="col-md-4">
                        <label>business_pan_document</label>
                        <p><a target="_blank" href="<?php echo $base_url.'all-uploaded-img/businesskyc/'.$businessData[0]['business_pan_document']; ?>" style="color:green!important;">view</a></p>
                      </div>
                    <?php
                  }elseif($businessData[0]['business_type']==4)
                  {
                    ?>
                    <div class="col-md-4">
                      <label>certificate_of_incorporation</label>
                      <p><a target="_blank" href="<?php echo $base_url.'all-uploaded-img/businesskyc/'.$businessData[0]['certificate_of_incorporation']; ?>" style="color:green!important;">view</a></p>
                    </div>
                    <div class="col-md-4">
                        <label>gst_certificate</label>
                        <p><a target="_blank" href="<?php echo $base_url.'all-uploaded-img/businesskyc/'.$businessData[0]['gst_certificate']; ?>" style="color:green!important;">view</a></p>
                    </div>
                    <div class="col-md-4">
                        <label>self_declaration_document</label>
                        <p><a target="_blank" href="<?php echo $base_url.'all-uploaded-img/businesskyc/'.$businessData[0]['self_declaration_document']; ?>" style="color:green!important;">view</a></p>
                    </div>
                    <div class="col-md-4">
                        <label>business_pan_document</label>
                        <p><a target="_blank" href="<?php echo $base_url.'all-uploaded-img/businesskyc/'.$businessData[0]['business_pan_document']; ?>" style="color:green!important;">view</a></p>
                      </div>
                    <div class="col-md-4">
                      <label>primary_director_aadhar_document</label>
                      <p><a target="_blank" href="<?php echo $base_url.'all-uploaded-img/businesskyc/'.$businessData[0]['primary_director_aadhar_document']; ?>" style="color:green!important;">view</a></p>
                    </div>
                    <div class="col-md-4">
                      <label>primary_director_pan_document</label>
                      <p><a target="_blank" href="<?php echo $base_url.'all-uploaded-img/businesskyc/'.$businessData[0]['primary_director_pan_document']; ?>" style="color:green!important;">view</a></p>
                    </div>
                    <?php
                  }elseif($businessData[0]['business_type']==5)
                  {
                    ?>
                    <div class="col-md-4">
                        <label>gst_certificate</label>
                        <p><a target="_blank" href="<?php echo $base_url.'all-uploaded-img/businesskyc/'.$businessData[0]['gst_certificate']; ?>" style="color:green!important;">view</a></p>
                    </div>
                    <div class="col-md-4">
                        <label>self_declaration_document</label>
                        <p><a target="_blank" href="<?php echo $base_url.'all-uploaded-img/businesskyc/'.$businessData[0]['self_declaration_document']; ?>" style="color:green!important;">view</a></p>
                    </div>
                    <div class="col-md-4">
                        <label>business_pan_document</label>
                        <p><a target="_blank" href="<?php echo $base_url.'all-uploaded-img/businesskyc/'.$businessData[0]['business_pan_document']; ?>" style="color:green!important;">view</a></p>
                      </div>
                    <div class="col-md-4">
                      <label>primary_director_aadhar_document</label>
                      <p><a target="_blank" href="<?php echo $base_url.'all-uploaded-img/businesskyc/'.$businessData[0]['primary_director_aadhar_document']; ?>" style="color:green!important;">view</a></p>
                    </div>
                    <div class="col-md-4">
                      <label>primary_director_pan_document</label>
                      <p><a target="_blank" href="<?php echo $base_url.'all-uploaded-img/businesskyc/'.$businessData[0]['primary_director_pan_document']; ?>" style="color:green!important;">view</a></p>
                    </div>
                    <div class="col-md-4">
                      <label>certificate_of_incorporation</label>
                      <p><a target="_blank" href="<?php echo $base_url.'all-uploaded-img/businesskyc/'.$businessData[0]['certificate_of_incorporation']; ?>" style="color:green!important;">view</a></p>
                    </div>
                    <div class="col-md-4">
                      <label>br_document</label>
                      <p><a target="_blank" href="<?php echo $base_url.'all-uploaded-img/businesskyc/'.$businessData[0]['br_document']; ?>" style="color:green!important;">view</a></p>
                    </div>
                    <?php
                  }

                 ?>
                
                
                
                
                
                
              </div>
            </div>

           <div class="card card-body">
                  <h5>Members Details</h5>
                  <div class="row">
                    <div class="col-md-12">
                      <table style="width: 100%;">
                          <thead style="background:grey;color: white;">
                            <tr>
                              <th>Sl. No.</th>
                              <th>Name</th>
                              <th>Mobile</th>
                              <th>Email</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php

                              foreach($persons as $key=>$value)
                              {
                                ?>
                                <tr>
                                  <th><?php echo ($key+1); ?></th>
                                  <th><?php echo $value['name']; ?></th>
                                  <th><?php echo $value['mobile']; ?></th>
                                  <th><?php echo $value['email']; ?></th>
                                </tr>
                                <?php 
                              }
                             ?>
                            
                        </tbody>
                        </table>
                    </div>
                    <hr>
                    <?php 
                    
                    if($businessData[0]['current_status']=='requested')
                      {
                        ?>
                          <form method="POST" action="<?php echo base_url("BusinessKyc/updatekycdetails"); ?>" enctype="multipart/form-data">
                              <div class="col-md-12">
                                <label>Approved</label>
                               <input required="" type="radio" name="status" value="approved">
                               <label>Rejected</label>
                               <input required="" type="radio" name="status" value="rejected">
                              </div>
                              <input type="hidden" name="clinic_code" value="<?php echo $businessData[0]['clinic_code']; ?>">
                              <input type="hidden" name="kyc_id" value="<?php echo $businessData[0]['id']; ?>">
                              <div class="col-md-12">
                                <label>Remarks</label>
                                <textarea required="" name="remarks" class="form-control"></textarea>
                              </div>

                              <div class="col-md-12">
                                <hr>
                                <button type="submit" class="btn btn-md btn-success">Submit</button>
                              </div>
                          </form>
                        <?php
                      }
                      ?>
                    
                    
                  </div>
                  
                </div>
            
              
            </div>
          </div>
        </div>
      </div><!-- End Row-->
        </div>
      </div>

    </div>

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
    <!-- End container-fluid-->
    <div id="myModal" class="modal">
       <span style="color:white!important;" class="close">X</span>
       <img class="modal-content" id="img01">
       <div id="caption"></div>
    </div>
    <div class="overlay"></div>
    
   </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
  <style type="text/css">


  th,td{
    font-size: 10px;
  }
  
   input{
      color: black!important;
   }
   body {font-family: Arial, Helvetica, sans-serif;}
   #myImg {
   border-radius: 5px;
   cursor: pointer;
   transition: 0.3s;
   }
   #myImg:hover {opacity: 0.7;}
   /* The Modal (background) */
   .modal {
   display: none; /* Hidden by default */
   position: fixed; /* Stay in place */
   z-index: 1; /* Sit on top */
   padding-top: 100px; /* Location of the box */
   left: 0;
   top: 0;
   width: 100%; /* Full width */
   height: 100%; /* Full height */
   overflow: auto; /* Enable scroll if needed */
   background-color: rgb(0,0,0); /* Fallback color */
   background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
   }
   /* Modal Content (image) */
   .modal-content {
   margin: auto;
   display: block;
   width: 80%;
   max-width: 700px;
   }
   /* Caption of Modal Image */
   #caption {
   margin: auto;
   display: block;
   width: 80%;
   max-width: 700px;
   text-align: center;
   color: #ccc;
   padding: 10px 0;
   height: 150px;
   }
   /* Add Animation */
   .modal-content, #caption {  
   -webkit-animation-name: zoom;
   -webkit-animation-duration: 0.6s;
   animation-name: zoom;
   animation-duration: 0.6s;
   }
   @-webkit-keyframes zoom {
   from {-webkit-transform:scale(0)} 
   to {-webkit-transform:scale(1)}
   }
   @keyframes zoom {
   from {transform:scale(0)} 
   to {transform:scale(1)}
   }
   /* The Close Button */
   .close {
   position: absolute;
   top: 73px;
   right: 25px;
   color: #f1f1f1;
   font-size: 40px;
   font-weight: bold;
   transition: 0.3s;
   }
   .close:hover,
   .close:focus {
   color: #bbb;
   text-decoration: none;
   cursor: pointer;
   }
   /* 100% Image Width on Smaller Screens */
   @media only screen and (max-width: 700px){
   .modal-content {
   width: 100%;
   }
   }
</style>
