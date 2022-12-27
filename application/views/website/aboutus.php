<?php  $this->load->view('website/inc/main_header'); ?>
   <body class="body-2">
      <div class="w-embed w-iframe">
        
      </div>
      <?php  $this->load->view('website/inc/top_header'); ?>
      <div class="container-fluid" style="padding: 0 10%;">
            <section style="text-align:left;">
               <img class="image-about" src="<?php echo base_url(); ?>resource_asset/we_are.png">
            <h1><strong>Who we are</strong></h1>
            
            <p>We are a highly enthusisatic team and fastest <br>
            growing privately owned company with a vision to <br>
            empower healthcare  infrastructure to improve productivity<br>
             with our best in class cloud based solutions.</p>
            </section>
            <section style="text-align:right;">
               <img class="image-about" src="<?php echo base_url(); ?>resource_asset/we_do.png">
            <h1><strong>What we do</strong></h1>
            
            <p>We use high end technological learning and deep <br>
            tech innovation of Artificial intelligence and Machine <br>
           Learnining to build solutions that save our time money <br>
           and effort.</p>
           </section>
           <section style="text-align:left;">
            <img class="image-about" src="<?php echo base_url(); ?>resource_asset/mission.png">
            <h1><strong>Our Mission </strong></h1>
            
            <p>To develop our healthcare infrastructure by empowering <br>
            healthcare sector to increase their productivity, affordability,<br>
             accessibility and quality of service.</p>
           </section>
           <section style="text-align:right;">
            <img class="image-about" src="<?php echo base_url(); ?>resource_asset/vission.png">
            <h1><strong>Our Vision </strong></h1>
            
            <p>To empower 10lakh+ healthcare units pan India with a strong<br>
             motive contributing to nations economy by 2030.</p>
           </section>
      </div>
      <div class="container-fluid" style="padding: 0 10%; text-align: center;">
         <h1><strong>Our Core Team</strong></h1>
            <section style="display: inline-block;margin: 20px;">
               <img class="image-team" src="<?php echo base_url(); ?>resource_asset/SantoshRastogi.jpg">
            <h6><strong>Santosh Rastogi, NIT</strong></h6>
            <p>(Founder & CEO)</p>
            </section>
            <section style="display: inline-block; margin: 20px;">
               <img class="image-team" src="<?php echo base_url(); ?>resource_asset/MukulPandey.jpeg">
            <h6><strong>Mukul Pandey, XLRI</strong></h6>
            <p>(Director)</p>
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