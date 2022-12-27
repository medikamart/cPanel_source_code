<!--Start topbar header-->
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>

<?php 

$user_data = $this->session->userdata('user_data');

?>



<!-- <header class="topbar-nav" style="margin-top:50px;" >



 <nav class="navbar navbar-expand fixed-top bg-white" style="height: 100px!important;"> -->



  <div class="commonHeade">
    <div class="top-left-section">
      <div class="top-left-f1">
         <i  style="font-size:25px;cursor: pointer;" class="icon-menu menu-icon toggle-menu"></i>
      </div>
      <div class="top-left-f2">
        <img src="<?php echo base_url().'assets/logo-com.png'; ?>" style="height: 75px;
    margin-top: 1px;">
      </div>
    </div>
    <div class="top-middle-section"></div>
    <div class="top-right-section">
      <div class="top-right-f1">
        <a href="<?php echo base_url(); ?>Billing/wallet"><i class="fa fa-credit-card" style="font-size:25px;cursor: pointer;margin-top: 25px;" aria-hidden="true"></i></a>
      </div>
      <div class="top-right-f2">
        <i class="fa fa-bell-o" onclick="showNotBox()" style="font-size:25px;cursor: pointer;margin-top: 25px;" aria-hidden="true"></i>
        <sup><span class="badge badge-md badge-danger" id="not_count" style="font-size: 101%;<?php if($total_not==0){echo 'display: none;';} ?>"><?php echo $total_not; ?></span></sup>
        <div class="notbox-box">
          <nav>
            <ul id="not_list">
              <?php 
                // print_r($data_not);
                if(!empty($data_not))
                {
                  foreach ($data_not as $key => $value) {
                   ?>
                   <li id="not_<?php echo $value['id']; ?>" onmouseleave="readNotification(this.id)" class="<?php if($value['read_status']==0){echo 'unread';}else{echo'read';} ?>">
                      <a ><?php echo $value['message'].' <p>['.$value['date_times'].']</p>'; ?>
                      </a>
                    </li>
                   <?php
                  }
                }
               ?>
            </ul>
          </nav>
        </div>
      </div>
      <div class="top-right-f3">
        <i onclick="showProfileBox()" class="fa fa-user-circle-o" style="font-size:25px;cursor: pointer;margin-top: 25px;"  aria-hidden="true"></i>
        <div class="profile-box">
          <nav>
            <ul>
              <!-- <li>
                <a>Profile</a>
              </li>
              <li>
                <a>Change Password</a>
              </li> -->
              <li>
                <a href="<?php echo base_url().'login/logout'; ?>">Logout</a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
      

  </div>

  <!-- <nav class="nav-bar">

        <ul>

            <li>

              <a  class="nav-link toggle-menu" href="javascript:void();">

               <i style="font-size:25px;color: white;" class="icon-menu menu-icon"></i>

               </a>

            </li>

        </ul>

      </nav> -->

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
  .unread{
    color: red;
  }
  .read{
    color: none;
  }


  .notbox-box{
    width: 300px;
    height: 300px;
    opacity: 0.7;
    position: absolute;
    top: 80px;
    right: 0px;
    display: none;
  }
  .notbox-box nav ul{
    width: 100%;
  }
  .notbox-box nav ul li{
    width: 100%;
    list-style-type: none;
    text-align: left;
    background: #c5e4ff;
    margin-top: 5px;
    padding: 10px;
    cursor: pointer;
    font-weight: bold;
    /*color: black;*/
  }
  .notbox-box nav ul li:hover{
    background: aliceblue;
    font-weight: bold;
    /*color: black;*/
  }


  .profile-box{
    width: 300px;
    height: 300px;
    opacity: 0.7;
    position: absolute;
    top: 80px;
    right: 0px;
    display: none;
  }
  .profile-box nav ul{
    width: 100%;
  }
  .profile-box nav ul li{
    width: 100%;
    list-style-type: none;
    text-align: left;
    background: #c5e4ff;
    margin-top: 5px;
    padding: 10px;
    cursor: pointer;
    font-weight: bold;
    color: black;
  }
  .profile-box nav ul li:hover{
    background: aliceblue;
    font-weight: bold;
    color: black;
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

    background: #daeeff;

    z-index: 99999;

    position: fixed;
    display: flex;

    /*position: relative;*/

   }

   .top-left-section{
    flex: 1;
    /*background: red;*/
    display: flex;
   }
   .top-left-f1{
    flex: 0.5;
    /*background: blue;*/
    text-align: center;
    padding-top: 25px;
   }
   .top-left-f2{
    flex: 2;
    /*background: orange;*/
    text-align: left;
   }
   .top-middle-section{
    flex: 2;
    /*background: yellow;*/
   }
   .top-right-section{
    flex: 2;
    /*background: green;*/
    display: flex;
    text-align: right;
   }
   .top-right-f1
   {
    flex: 15;
    /*background: yellow;*/
   }
   .top-right-f2
   {
    flex: 3;
    /*background: red;*/
   }
   .top-right-f3
   {
    flex: 2;
    /*background: blue;*/
    padding-right: 14px;
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

    background: aliceblue;

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
<script type="text/javascript">
  let probox = false;
  function showProfileBox()
  {
    if(probox==false)
    {
      $('.profile-box').show();
      probox = true;
    }else if(probox==true)
    {
      $('.profile-box').hide();
      probox = false;
    }
  }

  let notbox = false;
  function showNotBox()
  {
    if(notbox==false)
    {
      $('.notbox-box').show();
      notbox = true;
    }else if(notbox==true)
    {
      $('.notbox-box').hide();
      notbox = false;
    }
  }
  function readNotification(str)
  {
    let id = str.split('_')[1];
    $.ajax({
      type:'POST',
      url:'<?php echo base_url(); ?>Dashboard/readNotification',
      data:{id:id},
      success:function(res){
        res = JSON.parse(res);
        if(parseFloat(res.response_data.total)==0)
        {
          $('#not_count').html(0);
          $('#not_count').hide();
        }else
        {
          $('#not_count').html(parseFloat(res.response_data.total));
          $('#not_count').show();
        }
        $('#'+str).css('color','black');
      }
    })
    
  }

</script>

<script>

  // Enable pusher logging - don't include this in production
  Pusher.logToConsole = true;

  var pusher = new Pusher('6cf5b937d1e20a7e2484', {
    cluster: 'ap2'
  });

  var channel = pusher.subscribe('my-channel');
  let clinic_code = '<?php echo $this->session->userdata('user_data')['clinic_code']; ?>';
  let user_id= '<?php echo $this->session->userdata('user_data')['user_id']; ?>';
  console.log(clinic_code);
  console.log(user_id);
  channel.bind('my-event', function(data) {
    if(clinic_code==data.clinic_code && user_id==data.user_id)
    {
        $('#not_list').append('<li id="not_'+data.id+'" onmouseleave="readNotification(this.id)" class="unread"><a >'+data.message+' <p>['+data.date_times+']</p></a></li>');
        $('#not_count').html(data.total);
        if(parseFloat(data.total)==0)
        {
          $('#not_count').html(0);
          $('#not_count').hide();
        }else
        {
          $('#not_count').html(parseFloat(data.total));
          $('#not_count').show();
        }
    }
  });
</script>