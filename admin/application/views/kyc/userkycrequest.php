<div class="clearfix"></div>
  
  <div style="background: #F3FCFB!important;padding-top: 125px;" class="content-wrapper">
    <div class="container-fluid">
    <!-- Breadcrumb-->
     <div class="row pt-2 pb-2 mt-5">
        <div class="col-sm-9">
        <h4 class="page-title">User Kyc Request</h4>
        
     </div>
     
     </div>
    <!-- End Breadcrumb-->
      <div class="row">
          <div class="col-lg-12">
            <!-- End Breadcrumb-->
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Request List</div>
            <div class="card-body">
              <div class="row mb-2">
                <div class="col-md-4">
                  <select onchange="getuserkycrequest(this.value)" class="form-control">
                    <option <?php if($current_status=='requested'){echo 'selected="selected"';} ?> value="requested">Requested</option>
                    <option <?php if($current_status=='completed'){echo 'selected="selected"';} ?> value="completed">Completed</option>
                    <option <?php if($current_status==''){echo 'selected="selected"';} ?> value="">All</option>
                  </select>
                </div>
              </div>
              <div  class="table-responsive">
              <table id="default-datatable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sl. No.</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Pan</th>
                        <th>Aadhar</th>
                        <th>Pan Image</th>
                        <th>Aadhar Front</th>
                        <th>Aadhar Back</th>
                        <th>User Image</th>
                        <th>Request Date</th>
                        <th>Status</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                      foreach($kyc_request as $key=>$value)
                      {
                        ?>
                        <tr>
                            <td><?php echo ($key+1) ?></td>
                            <td><?php echo $value['first_name']; ?></td>
                            <td><?php echo $value['middle_name']; ?></td>
                            <td><?php echo $value['last_name']; ?></td>
                            <td><?php echo $value['pan_no']; ?></td>
                            <td><?php echo $value['aadhar_no']; ?></td>
                            <td align="center"><i id="<?php echo $value['pan_image']; ?>" onclick="openPopupImageBox(this.id)" style="font-size:25px;cursor:pointer;" class="zmdi zmdi-center-focus-strong"></i></td>
                            <td align="center"><i id="<?php echo $value['aadhar_front']; ?>" onclick="openPopupImageBox(this.id)" style="font-size:25px;cursor:pointer;" class="zmdi zmdi-center-focus-strong"></i></td>
                            <td align="center"><i id="<?php echo $value['aadhar_back']; ?>" onclick="openPopupImageBox(this.id)" style="font-size:25px;cursor:pointer;" class="zmdi zmdi-center-focus-strong"></i></td>
                            <td align="center"><i id="<?php echo $value['user_selfi']; ?>" onclick="openPopupImageBox(this.id)" style="font-size:25px;cursor:pointer;" class="zmdi zmdi-center-focus-strong"></i></td>
                            <td><?php echo $value['c_date']; ?></td>
                            <td><?php echo $value['current_status']; ?></td>
                            <td>
                              <?php
                              if($value['current_status']=='requested')
                              {
                                ?>
                                <button id="<?php echo $value['id'].'|'.$value['clinic_code'].'|completed'; ?>" onclick="updateStatus(this.id)" class="btn btn-md btn-success">Ok</button>
                                <button id="<?php echo $value['id'].'|'.$value['clinic_code'].'|rejected'; ?>" onclick="updateStatus(this.id)" class="btn btn-md btn-danger">Reject</button>
                                <?php
                              }
                              ?>
                              
                            </td>
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
      </div><!-- End Row-->
        </div>
      </div>

    </div>
    <!-- End container-fluid-->
    <div id="myModal" class="modal">
       <span style="color:white!important;" class="close">X</span>
       <img class="modal-content" id="img01">
       <div id="caption"></div>
    </div>
    <div class="overlay"></div>
    
   </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
  <style type="text/css">
   input{
      color: black!important;
   }
   body {font-family: Arial, Helvetica, sans-serif;}
   #myImg {
   border-radius: 5px;
   cursor: pointer;
   transition: 0.3s;
   }
   #myImg:hover {opacity: 0.7;}
   /* The Modal (background) */
   .modal {
   display: none; /* Hidden by default */
   position: fixed; /* Stay in place */
   z-index: 1; /* Sit on top */
   padding-top: 100px; /* Location of the box */
   left: 0;
   top: 0;
   width: 100%; /* Full width */
   height: 100%; /* Full height */
   overflow: auto; /* Enable scroll if needed */
   background-color: rgb(0,0,0); /* Fallback color */
   background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
   }
   /* Modal Content (image) */
   .modal-content {
   margin: auto;
   display: block;
   width: 80%;
   max-width: 700px;
   }
   /* Caption of Modal Image */
   #caption {
   margin: auto;
   display: block;
   width: 80%;
   max-width: 700px;
   text-align: center;
   color: #ccc;
   padding: 10px 0;
   height: 150px;
   }
   /* Add Animation */
   .modal-content, #caption {  
   -webkit-animation-name: zoom;
   -webkit-animation-duration: 0.6s;
   animation-name: zoom;
   animation-duration: 0.6s;
   }
   @-webkit-keyframes zoom {
   from {-webkit-transform:scale(0)} 
   to {-webkit-transform:scale(1)}
   }
   @keyframes zoom {
   from {transform:scale(0)} 
   to {transform:scale(1)}
   }
   /* The Close Button */
   .close {
   position: absolute;
   top: 73px;
   right: 25px;
   color: #f1f1f1;
   font-size: 40px;
   font-weight: bold;
   transition: 0.3s;
   }
   .close:hover,
   .close:focus {
   color: #bbb;
   text-decoration: none;
   cursor: pointer;
   }
   /* 100% Image Width on Smaller Screens */
   @media only screen and (max-width: 700px){
   .modal-content {
   width: 100%;
   }
   }
</style>
  <script type="text/javascript">
    $(document).ready(function(){
      $('#overlay2').hide();
    });
  var modal = document.getElementById("myModal");
  var span = document.getElementsByClassName("close")[0];
  var modalImg = document.getElementById("img01");
  var captionText = document.getElementById("caption");
  function openPopupImageBox(src)
   {
     modal.style.display = "block";
     modalImg.src = src;
     //captionText.innerHTML = tittle;
   }
   // When the user clicks on <span> (x), close the modal
    span.onclick = function() { 
    modal.style.display = "none";
   }
   function getuserkycrequest(value)
   {
      window.location.href = '<?php echo base_url(); ?>Kyc/userkycrequest/'+value;
   }

   function updateStatus(statusData)
   {
    swal({
              title: "Are you sure?",
              text: "",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                let req_id = statusData.split('|')[0];
                let clinic_code = statusData.split('|')[1];
                let status = statusData.split('|')[2];
                $.ajax({
                   type:'POST',
                   url:'<?php echo base_url(); ?>Kyc/updateStatusKyc',
                   data:{req_id: req_id,clinic_code: clinic_code,status: status},
                   success:function(res)
                   {
                       res = JSON.parse(res);
                       if(res.response_code == 200){
                          
                           swal("SUCCESS!", ''+res.msg+'', "success");
                           setTimeout(function(){ window.location.href='<?php echo base_url(); ?>Kyc/userkycrequest/'; }, 1000);
                      }
                       else
                       {
                         swal("ERROR!", ''+res.msg+'', "error");
                       }
                   }
                 });
              }
            });
      
   }
  </script>