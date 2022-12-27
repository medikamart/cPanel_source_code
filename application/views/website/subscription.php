<?php  $this->load->view('website/inc/main_header'); ?>
<body class="body-2">
   <div class="w-embed w-iframe">
   </div>
   <?php  $this->load->view('website/inc/top_header'); ?>
   <div class="container-fluid" style="padding:10%;background: #103208;text-align: center;color: white;">
      <p><strong>IT’S TIME TO TRY IT</strong></p>
      <h1><strong>Ready to use Medikamart ? Choose a plan.</strong></h1>
      <div class="row package">
         <div style="text-align:center;" class="col-md-12">
         </div>
         <div class="col-md-6">
            <div class="card">
               <div class="card-header">
                  <h6><strong>Basic</strong></h6>
                  <h4><strong><strike style="color: red;">₹199-</strike> <strong><sub><span style="font-size:25px;">/</span>month</sub></strong> ,<span style="color:#15bd49;">Now</span>  ₹<span style="font-size: 56px;">0</span><strong><sub><span style="font-size:25px;">/</span>month</sub></strong></strong></h4>
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
                     <li><a href="<?php echo base_url(); ?>Login"  class="button-3 w-button not-effected" style="font-size: 26px;background: #3f764d;color: white;">Create free account</a></li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="col-md-6">
            <div class="card">
               <div class="card-header">
                  <div style="width:200px; height: 30px; margin: 0px auto; border-radius: 25px;clear: both; display: inline-block;text-align: center;position: absolute; right: 10px;" class="outer-btn">
                     <div onclick="changePlan('month')" id="month-plan" style="background: green;cursor: pointer;color: white; width: 50%; height:100%;float: left;padding-top:5px ;" class="inner-btn">
                        Monthly
                     </div>
                     <div onclick="changePlan('year')" id="year-plan" style="background: lightblue; width: 50%;cursor: pointer; height:100%;float: right;padding-top:5px ;" class="inner-btn">
                        Yearly
                     </div>
                  </div>
                  <h6><strong>Standard Plan</strong></h6>
                  <section id="price_lbl">
                     <h4 ><strong>₹<span style="font-size: 56px;">299</span><strong><sub><span style="font-size:25px;">/</span>month</sub></strong></strong><sub style="font-size:15px;">(exclusive tax)</sub></h4>
                     <p style="font-size: 16px;">billed monthly</p>
                  </section>
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
                     <li><a href="<?php echo base_url(); ?>Login"  class="button-3 w-button not-effected" style="font-size: 26px;background: orange;color: white;">Upgrade Now</a></li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
   <?php  $this->load->view('website/inc/footer'); ?>
</body>
</html>
<script type="text/javascript">
   function changePlan(plan)
   {
      if(plan=='month')
      {
         $('#month-plan').css('background','green');
         $('#month-plan').css('color','white');
         $('#year-plan').css('background','lightblue');
         $('#year-plan').css('color','black');
   
         $('#price_lbl').html('<h4 ><strong>₹<span style="font-size: 56px;">299</span><strong><sub><span style="font-size:25px;">/</span>month</sub></strong></strong><sub style="font-size:15px;">(exclusive tax)</sub></h4><p style="font-size: 16px;">billed monthly</p>');
   
      }else if(plan='year')
      {
         $('#month-plan').css('background','lightblue');
         $('#month-plan').css('color','black');
         $('#year-plan').css('background','green');
         $('#year-plan').css('color','white');
         $('#price_lbl').html('<h5><strong><span style="font-size: 28px;color:red;"><strike>₹3588</strike></span>, ₹<span style="font-size: 35px;">3289</span><strong><sub><span style="font-size:25px;">/</span>annually</sub></strong></strong><sub style="font-size:15px;">(exclusive tax)</sub></h5><p style="font-size: 16px;color:blue;font-size: 24px;color: blue;font-weight: bold;">(1 Month Free)</p><p style="font-size: 16px;">billed annually</p>');
      }
   }
   
</script>
<style type="text/css">
   .package{
   margin-top: 5%;
   text-align: left;
   color: black;
   }
   .package ul li
   {
   /*height: 40px;*/
   list-style-type: none;
   }
   .package ul li i{
   padding: 10px;
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
</style>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>