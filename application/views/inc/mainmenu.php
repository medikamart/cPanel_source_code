<!-- Start wrapper-->
<?php 
   $user_data = $this->session->userdata('user_data');
   
   ?>
<style type="text/css">
   a{
   color: black;
   }
   #brand-image-icon:hover{
     content:url("<?php echo base_url(); ?>assets/images/upload-img.png");
     cursor: pointer;
     border-radius: 25px;
     opacity: 0.8;
   }
</style>
<div id="wrapper">
<!--Start sidebar-wrapper-->
<div id="sidebar-wrapper"  data-simplebar="" data-simplebar-auto-hide="true">
   <div class="brand-logo">
   </div>
   <div class="brand-logo" title="Upload Only .Jpeg" style="position:relative;">
      <img onclick="updateLogo()" id="brand-image-icon" src="<?php echo $_SESSION['logo_image']; ?>" style="height:80px;z-index: 999;padding: 10px;">
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
         <i class="zmdi zmdi-library"></i> <span>Accounts</span> <i class="fa fa-angle-left pull-right"></i>
         </a>
         <ul class="sidebar-submenu">
            <li><a href="<?php echo base_url().'Billing/billing';  ?>"><i class="zmdi zmdi-star-outline"></i> New Billing</a></li>
            <li><a href="<?php echo base_url().'Billing/billing_list';  ?>"><i class="zmdi zmdi-star-outline"></i> Billing Invoice</a></li>
            <li><a href="<?php echo base_url().'Report/getVendorDue';  ?>"><i class="zmdi zmdi-star-outline"></i> Due Report</a></li>
         </ul>
      </li>
      <li>
         <a href="index-2.html" class="waves-effect">
         <i class="zmdi zmdi-shield-check"></i> <span>Test Reports</span> <i class="fa fa-angle-left pull-right"></i>
         </a>
         <ul class="sidebar-submenu">
            <li><a href="<?php echo base_url().'Billing/pending_report';  ?>"><i class="zmdi zmdi-star-outline"></i> Pending Reports</a></li>
            <li><a href="<?php echo base_url().'Billing/billing_list';  ?>"><i class="zmdi zmdi-star-outline"></i> Test Reports</a></li>
         </ul>
      </li>
      <!-- <li>
         <a href="index-2.html" class="waves-effect">
         
           <i class="zmdi zmdi-group-work"></i> <span>Business</span> <i class="fa fa-angle-left pull-right"></i>
         
         </a>
         
         <ul class="sidebar-submenu">
         
           
         
         </ul>
         
         </li> -->
      <li>
         <a href="index-2.html" class="waves-effect">
         <i class="zmdi zmdi-settings"></i> <span>Account Setting</span> <i class="fa fa-angle-left pull-right"></i>
         </a>
         <ul class="sidebar-submenu">
            <li><a href="<?php echo base_url().'Master/category';  ?>"><i class="zmdi zmdi-star-outline"></i> Category</a></li>
            <li><a href="<?php echo base_url().'Master/test';  ?>"><i class="zmdi zmdi-star-outline"></i> Test</a></li>
            <li><a href="<?php echo base_url().'Master/unit';  ?>"><i class="zmdi zmdi-star-outline"></i> Unit</a></li>
            <li><a href="<?php echo base_url().'Master/vendor/vendor';  ?>"><i class="zmdi zmdi-star-outline"></i> Vendor</a></li>
            <li><a href="<?php echo base_url().'Master/patient/patient';  ?>"><i class="zmdi zmdi-star-outline"></i> Patient</a></li>
            <li><a href="<?php echo base_url().'Master/role';  ?>"><i class="zmdi zmdi-star-outline"></i> Role</a></li>
            <li><a href="<?php echo base_url().'Master/sub_user';  ?>"><i class="zmdi zmdi-star-outline"></i> Users</a></li>
            <li><a href="<?php echo base_url().'Tool/toolGallery';  ?>"><i class="zmdi zmdi-star-outline"></i> Pad Config</a></li>
         </ul>
      </li>
      <li>
         <a href="index-2.html" class="waves-effect">
         <i class="zmdi zmdi-toys"></i> <span>Upgrade</span> <i class="fa fa-angle-left pull-right"></i>
         </a>
         <ul class="sidebar-submenu">
            <li><a href="<?php echo base_url().'Subscription'; ?>"><i class="zmdi zmdi-star-outline"></i> Upgrade Now</a></li>
            <li><a href="<?php echo base_url().'Subscription/myplan'; ?>"><i class="zmdi zmdi-star-outline"></i> My Plan</a></li>
         </ul>
      </li>
      <li>
         <a href="index-2.html" class="waves-effect">
         <i class="zmdi zmdi-traffic"></i> <span>FeedBack</span> <i class="fa fa-angle-left pull-right"></i>
         </a>
         <ul class="sidebar-submenu">
            <li><a href="<?php echo base_url().'Feedback'; ?>"><i class="zmdi zmdi-star-outline"></i> Write Feedback</a></li>
         </ul>
      </li>
      <li>
         <a href="index-2.html" class="waves-effect">
         <i class="zmdi zmdi-help"></i> <span>Support</span> <i class="fa fa-angle-left pull-right"></i>
         </a>
         <ul class="sidebar-submenu">
            <li><a href="<?php echo base_url().'Master/test_market';  ?>"><i class="zmdi zmdi-star-outline"></i> Lab Store</a></li>
         </ul>
      </li>
   </ul>
</div>
<form id="logoform" method="POST" action="<?php echo base_url(); ?>Registration/updateLogoClinicImage" enctype="multipart/form-data">
   <input type="file" onchange="updateBase64()" name="image_fle" id="logo_image">
   <input type="hidden" name="image" id="logo_hdn_image">
</form>
<!--End sidebar-wrapper-->
<style type="text/css">
  .sidebar-menu li{
   background: #daeeff;
   }
   .sidebar-menu li a{
    color: black;
   }
   .sidebar-header{
    background: aliceblue!important;
   }
</style>
<script type="text/javascript">
   function updateLogo()
   {
      $('#logo_image').click();
   }

async function updateBase64()
{
    const file = document.querySelector('#logo_image').files[0];
    const bs64 = await toBase64(file);
   console.log(bs64);
   $('#logo_hdn_image').val(bs64.split("data:image\/jpeg;base64,")[1]);
   $('#logoform').submit();
}

const toBase64 = file => new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve(reader.result);
    reader.onerror = error => reject(error);
});
</script>