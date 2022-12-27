<div class="clearfix"></div>
  
  <div style="background: #F3FCFB!important;padding-top: 125px;" class="content-wrapper">
    <div class="container-fluid">
    <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
        <h4 class="page-title">Due Payment Report</h4>
        
     </div>
     <!-- <div class="col-sm-3">
       <div class="btn-group float-sm-right">
        <button type="button" class="btn btn-outline-primary waves-effect waves-light"><i class="fa fa-cog mr-1"></i> Create</button>
        <button type="button" class="btn btn-outline-primary dropdown-toggle dropdown-toggle-split waves-effect waves-light" data-toggle="dropdown">
        <span class="caret"></span>
        </button>
        <div class="dropdown-menu">
          <a href="<?php echo base_url().'Billing/billing';  ?>">
          <button class="dropdown-item">New</button>
          </a>
        </div>
      </div> -->
     </div>
     </div>
    <!-- End Breadcrumb-->
      <div class="row">
          <div class="col-lg-12">
            <!-- End Breadcrumb-->
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Due Payment Report</div>
            <form method="POST" action="<?php  echo base_url(); ?>/Report/getVendorPaymentDue_ajax" enctype="multipart/form-data">
            <div class="card-body">
              <div  class="row">
              <div class="col-md-3">
                <b>Refered By</b>
                <select class="form-control" name="vendor_id">
                  <?php  
                  if(!empty($vendor_list))
                  {
                    foreach($vendor_list as $key=>$value)
                    {
                      ?>

                      <option value="<?php echo $value['id']; ?>"><?php echo $value['vendor_name']; ?></option>

                      <?php
                    }
                  }
                  ?>
                </select>
              </div>
              <div class="col-md-3">
                <b>From Date</b>
                <input type="date" name="from_date" class="form-control" value="<?php echo date('Y-m-d');  ?>" />
              </div>
              <div class="col-md-3">
                <b>To Date</b>
                <input type="date" name="to_date" class="form-control" value="<?php echo date('Y-m-d');  ?>" />
              </div>
              <div class="col-md-3">
                <b>Payment Status</b>
                <select class="form-control" name="pay_status">
                  <option value="">All</option>
                  <option value="1">Paid</option>
                  <option value="0">Unpaid</option>
                </select>
              </div>
              <div class="col-md-3">
                
                <button type="submit" class="btn btn-sm btn-success" style="margin-top:5%;">Export Pdf</button>
              </div>
              </div>
            </div>
            </form>
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
      #test_list_form ul li{
        list-style-type: none;
        font-size: 13px;
        padding: 5px;
      }
      #test_list_form button{
        text-align: center;
        margin: 20px;
      }
    </style>
   
