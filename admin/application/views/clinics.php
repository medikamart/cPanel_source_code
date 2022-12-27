<div class="clearfix"></div>
  
  <div style="background: #F3FCFB!important;padding-top: 125px;" class="content-wrapper">
    <div class="container-fluid">
    <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
        <h4 class="page-title">Clinics</h4>
        
     </div>
     </div>
    <!-- End Breadcrumb-->
      <div class="row">
          <div class="col-lg-12">
            <!-- End Breadcrumb-->
      <div class="row">
        <div class="col-lg-12">
          
          <div class="card">

            <div class="card-header"><i class="fa fa-table"></i> Clinic List</div>
            <div class="card-body">
              <div class="col-lg-2">
                    <select onchange="getclinics(this.value)" class="form-control" name="status">
                      <option <?php  if($status==""){echo 'selected="selected"';}  ?> value="">All</option>
                       <option <?php  if($status=="active"){echo 'selected="selected"';}  ?> value="active">Active</option>
                        <option <?php  if($status=="inactive"){echo 'selected="selected"';}  ?> value="inactive">Inactive</option>
                    </select>
                  </div>
              <div  class="table-responsive">
                
              <table id="default-datatable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sl. No.</th>
                        <th>Clinic Code</th>
                        <th>Lab Name</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Expiry Date</th>
                        <th>User Kyc</th>
                        <th>Business Kyc</th>
                        <th>Created On</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                      foreach($result as $key=>$value)
                      {
                        ?>
                        <tr>
                        <td><?php echo ($key+1);  ?></td>
                        <td><?php echo $value['clinic_code']; ?></td>
                        <td><?php echo $value['business_name']; ?></td>
                        <td><?php echo $value['first_name']; ?></td>
                        <td><?php echo $value['last_name']; ?></td>
                        <td><?php echo $value['phone']; ?></td>
                        <td><?php echo $value['email']; ?></td>
                        <td><?php echo $value['expiry_date']; ?></td>
                        <td><?php if($value['user_kyc']==1){echo 'Approved';}else{echo 'Pending';} ?></td>
                        <td><?php if($value['bsiness_kyc']==1){echo 'Approved';}else{echo 'Pending';}?></td>
                        <td><?php echo $value['c_date']; ?></td>
                        
                    </tr>
                        <?php
                      }

                    ?>
                </tbody>
                
            </table>
            </div>
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
  <script type="text/javascript">
    $(document).ready(function(){
      $('#overlay2').hide();
    });
    function getclinics(value)
   {
      window.location.href = '<?php echo base_url(); ?>Dashboard/clinics/'+value;
   }

  </script>