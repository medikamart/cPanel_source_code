<div class="clearfix"></div>

<div style="background: #F3FCFB!important;padding-top: 125px;" class="content-wrapper">

   <div class="container-fluid">

      <!-- Breadcrumb-->

      <div class="row pt-2 pb-2">

         <div class="col-sm-9">

            <h4 class="page-title">My Plan</h4>

         </div>

      </div>

      <!-- End Breadcrumb-->

      <div class="row">

         <div class="col-lg-12">

            <!-- End Breadcrumb-->

            <div class="row">

               <div class="col-lg-12">

                  <div class="card">

                     <div class="card-header"><i class="fa fa-table"></i> My Plan List</div>

                     <div class="card-body">


                        <div class="row">
                           <?php 
                              $std_plan = 0;
                              if(!empty($result))
                              {
                                 foreach($result as $key=>$value)
                                 {
                                    if(date('Y-m-d H:i:s',strtotime($value['end_date']))>=date('Y-m-d H:i:s'))
                                    {
                                        $std_plan = 1;
                                    }
                                 }
                              }
                              if($std_plan==0)
                              {
                                 ?>
                                    <div class="col-md-6">
                                       <div class="card">
                                          <div class="card-header">

                                             <h6><strong>Basic</strong></h6>

                                             <p>For new and small businesses to solve their billing and report generation problem</p>

                                          </div>

                                          <div class="card-body">

                                             <ul>

                                                <li><i style="color:green;font-size: 25px;" class="zmdi zmdi-check"></i><strong>Upto 100 Reports /month</strong></li>

                                                <li><i style="color:green;font-size: 25px;" class="zmdi zmdi-check"></i><strong>Report sharing and alerts</strong></li>

                                                <li><i style="color:green;font-size: 25px;" class="zmdi zmdi-check"></i><strong>Dashboard and business analytics</strong></li>

                                                <li><i style="color:green;font-size: 25px;" class="zmdi zmdi-check"></i><strong>Wallet services</strong></li>

                                                <li><i style="color:green;font-size: 25px;" class="zmdi zmdi-check"></i><strong>Customer support</strong></li>

                                                <li><i style="color:green;font-size: 25px;" class="zmdi zmdi-check"></i><strong>Cloud storage support upto 2 GB</strong></li>

                                                <li><i style="color:red;font-size: 25px;" class="zmdi zmdi-close"></i><strong><strike>User role delegation and tracking</strike></strong></li>

                                                <li><i style="color:red;font-size: 25px;" class="zmdi zmdi-close"></i><strong><strike>Payment collection</strike></strong></li>

                                                <li style="list-style-type: none;">

                                                   <br>

                                                   <a href="#"  class="button-3 w-button not-effected" style="font-size: 26px;background: #3f764d;color: white;">Active</a></li>

                                             </ul>

                                          </div>
                                       </div>
                                    </div>
                                 <?php
                              }else
                              {
                                 ?>
                                    <div class="col-md-6">
                                       <div class="card">
                                          <div class="card-header">

                                          <h6><strong>Standard Plan</strong></h6>

                                          <p>For medium and stable businesses needing advance sharing and payment collection features</p>

                                       </div>

                                       <div class="card-body">

                                          <ul>

                                             <li><i style="color:green;font-size: 25px;" class="zmdi zmdi-check"></i><strong>Unlimited Billing & Reports</strong></li>

                                             <li><i style="color:green;font-size: 25px;" class="zmdi zmdi-check"></i><strong>Report Sharing & Alerts</strong></li>

                                             <li><i style="color:green;font-size: 25px;" class="zmdi zmdi-check"></i><strong>Dashboard / Business Analytics</strong></li>

                                             <li><i style="color:green;font-size: 25px;" class="zmdi zmdi-check"></i><strong>Wallet Services</strong></li>

                                             <li><i style="color:green;font-size: 25px;" class="zmdi zmdi-check"></i><strong>Payment Collection</strong></li>

                                             <li><i style="color:green;font-size: 25px;" class="zmdi zmdi-check"></i><strong>User Role Delegation & Tracking</strong></li>

                                             <li><i style="color:green;font-size: 25px;" class="zmdi zmdi-check"></i><strong>Instant settlement upto 24 hrs</strong></li>

                                             <li><i style="color:green;font-size: 25px;" class="zmdi zmdi-check"></i><strong>Customer Support</strong></li>

                                             <li><i style="color:green;font-size: 25px;" class="zmdi zmdi-check"></i><strong>Cloud Storage Support upto 10 GB</strong></li>

                                             <li style="list-style-type: none;">

                                                <br>

                                                <a href="#" class="button-3 w-button not-effected" style="font-size: 26px;background: green;color: white;">Active</a></li>

                                          </ul>

                                       </div>
                                       </div>
                                       
                                        </div>
                                    </div>
                                 <?php
                              }
                            ?>
                        <div  class="table-responsive">

                           <table id="default-datatable" class="table table-bordered">

                              <thead>

                                 <tr>

                                    <th>Sl. No.</th>

                                    <th>Subscription ID</th>

                                    <th>Plan ID</th>

                                    <th>Amount</th>

                                    <th>Start Date</th>

                                    <th>End Date</th>

                                    <th>Days</th>

                                    <th>Paid Status</th>

                                 </tr>

                              </thead>

                              <tbody>

                                 <?php

                                    foreach($result as $key=>$value)

                                    {

                                      ?>

                                 <tr>

                                    <td><?php echo ($key+1);  ?></td>

                                    <td><?php echo $value['subscription_id'] ?></td>

                                    <td><?php echo $value['plan_id'] ?></td>

                                    <td><?php echo $value['amount'] ?></td>

                                    <td><?php echo date('d-M-Y',strtotime($value['start_date'])); ?></td>

                                    <td><?php echo date('d-M-Y',strtotime($value['end_date'])); ?></td>

                                    <td><?php echo $value['days'] ?></td>

                                    <td><?php echo $value['current_status'] ?></td>

                                 

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

            </div>

            <!-- End Row-->

         </div>

      </div>

   </div>

   <!-- End container-fluid-->

   <div class="overlay"></div>

</div>

<!--End content-wrapper-->

<!--Start Back To Top Button-->

<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>

<!--End Back To Top Button-->

<script type="text/javascript">

   $(document).ready(function(){

     $('#overlay2').hide();

   });

</script>