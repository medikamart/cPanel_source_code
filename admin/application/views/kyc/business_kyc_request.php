<div class="clearfix"></div>
  
  <div style="background: #F3FCFB!important;padding-top: 125px;" class="content-wrapper">
    <div class="container-fluid">
    <!-- Breadcrumb-->
     <div class="row pt-2 pb-2 mt-5">
        <div class="col-sm-9">
        <h4 class="page-title">Business KYC Request</h4>
        
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
              <div class="row">
                <div class="col-md-4">
                  <label>Business Type</label>
                  <select class="form-control" onchange="getData()" name="business_type" id="business_type">
                    <option value="1">Unregistered</option>
                    <option value="2">Proprietorship</option>
                    <option value="3">Partnership</option>
                    <option value="4">LLP</option>
                    <option value="5">Private Limited</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <label>Current Status</label>
                  <select class="form-control" onchange="getData()" name="current_status" id="current_status">
                    <option value="requested">Requested</option>
                    <option value="rejected">Rejected</option>
                    <option value="approved">Approved</option>
                  </select>
                </div>
              </div>

              <div class="unregistered-tab tab">
                <table style="width:100%;color: black;">
                  <thead>
                    <tr>
                      <th>Sl. No.</th>
                      <th>Business Name</th>
                      <th>Business Type</th>
                      <th>Business Contact</th>
                      <th>Business Email</th>
                      <th>Business Address</th>
                      <th>Details</th>
                    </tr>
                  </thead>
                  <tbody id="tbl_data">
                    
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

  .main-outer{
    width: 100%;
    background-color: lightcyan;
    clear: both;
  }
  .tab{
    display: none;
    float: left;
    width: 100%;
  }
  .unregistered-tab{
    display: block;
    height: 400px;
    overflow: scroll;
  }
  .inner-div{
    width: 20%;
    float: left;
    text-align: center;
    height: 25px;
    cursor: pointer;
    box-shadow: 2px 2px  10px 2px lightgrey;
    border: 1px solid grey;
  }
  th{
    font-size: 12px;
  }
  td{
    font-size: 10px;
  }

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
  getData();
  function getData()
  {
    $('#tbl_data').html('<tr><td style="text-align:center;" colspan="7">Proccessing Please wait...</td></tr>');
    $.ajax({
      type:'POST',
      url:'<?php echo base_url("BusinessKyc/getBusinessKycListData");  ?>',
      data:{current_status: $('#current_status').val(),business_type: $('#business_type').val()},
      success:function(res)
      {
        res = JSON.parse(res);
        if(res.response_data.length>0)
        {
          $('#tbl_data').html('');
          $.each(res.response_data,function(i,v){

            let business_type = '';
            if(v.business_type==1)
            {
              business_type = 'Unregistered';
            }else if(v.business_type==2)
            {
              business_type = 'Proprietorship';
            }else if(v.business_type==3)
            {
              business_type = 'Partnership';
            }else if(v.business_type==4)
            {
              business_type = 'LLP';
            }else if(v.business_type==5)
            {
              business_type = 'Private Limited';
            }
            $('#tbl_data').append('<tr>'+
                                  '<td>'+(i+1)+'</td>'+
                                  '<td>'+v.business_name+'</td>'+
                                  '<td>'+business_type+'</td>'+
                                  '<td>'+v.business_contact+'</td>'+
                                  '<td>'+v.business_email+'</td>'+
                                  '<td>'+v.business_address+'</td>'+
                                  '<td>'+
                                   '<a href="<?php echo base_url("BusinessKyc/businesskycdetails/"); ?>'+v.id+'" style="color:blue!important;">Details</a>'+
                                  '</td>'+
                                '</tr>');
          });
          
          }else
          {
            $('#tbl_data').html('<tr><td style="text-align:center;" colspan="7">No Record Found</td></tr>');
          }
        console.log(res.response_data);

      }
    });
  }
</script>