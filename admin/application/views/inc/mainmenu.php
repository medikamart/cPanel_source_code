<!-- Start wrapper-->
<?php 
$user_data = $this->session->userdata('user_data');
?>
<style type="text/css">
  a{
    color: white!important;
  }
</style>
 <div id="wrapper">
  
  <!--Start sidebar-wrapper-->
   <div id="sidebar-wrapper" style="background: #38837ff0;" data-simplebar="" data-simplebar-auto-hide="true">
     <div class="brand-logo">
     </div>
     <div class="brand-logo" style="position:relative;">
      <img src="<?php echo base_url().'assets/images/logo-icon.png'; ?>" style="height:80px;z-index: 999;padding: 10px;">
     </div>
     <ul class="sidebar-menu do-nicescrol">
      <li class="sidebar-header text-center">
        <h6><?php echo $this->business_name; ?></h6>
      <p><?php echo $_SESSION['user_data']['first_name'].' '.$_SESSION['user_data']['last_name'] ?></p>
      </li>
      <li>
        <a href="<?php echo base_url().'Dashboard';  ?>" class="waves-effect">
          <i class="zmdi zmdi-palette"></i> <span>Dashboard</span> 
          <!-- <i class="fa fa-angle-left pull-right"></i> -->
        </a>
        
      </li>
      <li>
        <a href="index-2.html" class="waves-effect">
          <i class="zmdi zmdi-library"></i> <span>Operation</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="sidebar-submenu">
          <li><a href="<?php echo base_url().'Dashboard/clinics';  ?>"><i class="zmdi zmdi-star-outline"></i> Clinics</a></li>
          <li><a href="<?php echo base_url().'Kyc/userkycrequest';  ?>"><i class="zmdi zmdi-star-outline"></i>User Kyc</a></li>
          <li><a href="<?php echo base_url().'BusinessKyc/businesskycrequest';  ?>"><i class="zmdi zmdi-star-outline"></i> Business Kyc</a></li>
         
        </ul>
      </li>

      <li>
        <a href="<?php echo base_url().'login/logout'; ?>" class="waves-effect">
          <i class="zmdi zmdi-traffic"></i> <span>Logout</span>
        </a>
      </li>
    </ul>
     
   </div>
   
   <!--End sidebar-wrapper-->
