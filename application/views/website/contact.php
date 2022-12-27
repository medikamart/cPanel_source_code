<?php  $this->load->view('website/inc/main_header'); ?>
   <body class="body-2">
      <div class="w-embed w-iframe">
        
      </div>
      <?php  $this->load->view('website/inc/top_header'); ?>
      <div class="container-fluid" style="padding: 0 10%;">
            <section style="text-align:left;">
               <img class="image-about" src="<?php echo base_url(); ?>resource_asset/contact.png">
            <h1><strong>Contact Us</strong></h1>
            <div class="container-fluid">
               <div style="padding:10px;" class="row">
                  <div class="col-md-6">
                     <strong>Name</strong>
                     <input type="text" class="form-control" name="name">
                  </div>
                  <div class="col-md-6">
                     <strong>Email Address</strong>
                     <input type="email"  class="form-control" name="email">
                  </div>
                  <div class="col-md-6">
                     <strong>Company (Optional)</strong>
                     <input type="text"  class="form-control" name="company">
                  </div>
                  <div class="col-md-6">
                     <strong>Phone (Optional)</strong>
                     <input type="text" class="form-control" name="phone">
                  </div>

                  <div style="padding:10px;" class="col-md-12">
                     <textarea type="text" placeholder="Your Message" class="form-control" name="message"></textarea>
                  </div>
                  <div style="padding:10px;text-align: right;" class="col-md-12">
                     <button style="background: #3f764d;color: white;" class="btn btn-md btn-info">Get in touch</button>
                  </div>
               </div>
               
            </div>
            </section>

         <section style="text-align:center;">
            <h1><strong>Or reach us at</strong></h1>
            
            <div class="container-fluid">
               <div style="padding:10px;" class="row">
                  <div class="col-md-4">
                     <strong>Registered Address</strong>
                     <p>86-B, Deven Bagan, Tinplate, Golmuri, Jamshedpur - 831003, Jharkhand, India.</p>
                     
                  </div>
                  <div class="col-md-4">
                     <strong>Phone</strong>
                     <p>NA</p>
                     
                  </div>
                  <div class="col-md-4">
                     <strong>Email</strong>
                     <p>support@medikamart.in</p>
                     
                  </div>
                 
               </div>
               
            </div>
            </section>
            
      </div>
      <?php  $this->load->view('website/inc/footer'); ?>
   </body>
</html>



<style type="text/css">
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
</style>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>