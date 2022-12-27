<?php  $this->load->view('website/inc/main_header'); ?>
   <body class="body-2">
      <div class="w-embed w-iframe">
        
      </div>
      <?php  $this->load->view('website/inc/top_header'); ?>
      <div class="container-fluid" style="padding: 0 10%;">
            <section style="text-align:left;">
               <img class="image-about" src="<?php echo base_url(); ?>resource_asset/tutorial.png">
            <h1><strong>Knowledge Base </strong></h1>
            <div class="container-fluid">
               <div style="padding:10px;" class="row">
                  <div class="col-md-6">
                     <strong>No data found</strong>
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