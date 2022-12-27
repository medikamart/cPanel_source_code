<!--Start topbar header-->
<?php 
$user_data = $this->session->userdata('user_data');
?>

<!-- <header class="topbar-nav" style="margin-top:50px;" >

 <nav class="navbar navbar-expand fixed-top bg-white" style="height: 100px!important;"> -->

  <div class="commonHeade">
    <!-- <img src="<?php echo base_url().'assets/logo-com.png'; ?>" style="height:80px;z-index: 99999999;"> -->
      <nav class="nav-bar">
        <ul>
            <li>
              <a  class="nav-link toggle-menu" href="javascript:void();">
               <i style="font-size:25px;color: white;" class="icon-menu menu-icon"></i>
               </a>
            </li>
        </ul>
      </nav>
  </div>
 <!--  <ul style="width: 100%; clear: both;" class="navbar-nav mr-auto align-items-center">
    <li class="nav-item" style="width: 20%;">
      <a class="nav-link toggle-menu" href="javascript:void();">
       <i class="icon-menu menu-icon"></i>
     </a>
    </li>
    <li class="nav-item leftright">
      <h3 style="color: blue;font-weight: bolder;"><span class="blinking" ><?php //echo $user_data[0]['lab_name']; ?></span></h3>
      <p style="font-size: 18px;">Netaji Subhas Daily Market, Stall No: 132 (Suisa, Purulia).</p>
    </li>
    
  </ul> -->
<!-- </nav>
</header > -->



<!--End topbar header-->

<style type="text/css">
  .content-wrapper{
    background: skyblue!important;

  }
  .light-gradient
  {
    background: #a8ff78;  /* fallback for old browsers */
    background: -webkit-linear-gradient(to right, #78ffd6, #a8ff78);  /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to right, #78ffd6, #a8ff78); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

  }

.leftright{
    text-align: center; 
    width: 80%;
   /*animation: blinker 3s linear infinite;*/
   color: blue;
   }
 .commonHeade{
    width: 100%;
    height: 80px;
    background: #38837ff0;
    padding-right:2%;
    z-index: 9;
    position: fixed;
    /*position: relative;*/
   }
   .nav-bar{
    float: right;
   }
   .nav-bar ul li{
    float: left;
    margin: 5px;
    list-style-type: none;
    padding: 18px;

    font-size: 18px;
    color: white;
   }
   .simplebar-content{
    background: #38837ff0;
   }
   .nav-bar ul li:hover{
    font-weight: bolder;
   }
   @media (max-width: 600px)
   {
    .commonHeade{
      width: 100%;
      height: 100px;
      background: #38837ff0;
      padding-right:0%;
     }
    .nav-bar{
      float: right;
     }
      .nav-bar ul li{
      float: left;
      margin: 4px;
      list-style-type: none;
      /*padding-top: 20%;*/
      font-size: 18px;
      /*color: white;*/
      position: relative;
     }
   }
   .footer-div{
    position: relative;
    bottom: 0px; 
    min-height: 10px;
    background: #9BBFC2;
    color: white;
    width: 100%;
    text-align: center;
    font-size: 8px;
    padding: 4px;
    
   }


</style>