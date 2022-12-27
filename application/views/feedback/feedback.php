<div class="clearfix"></div>
  
  <div style="background: #F3FCFB!important;padding-top: 125px;" class="content-wrapper">
    <div class="container-fluid">
    <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
        <h4 class="page-title">User Feedback</h4>
        
     </div>
     </div>
    <!-- End Breadcrumb-->
      <div class="row">
          <div class="col-lg-12">
            <!-- End Breadcrumb-->
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> User Feedback</div>
            <div class="card-body">
                <form style="margin:10px auto;" id="kyc_request_form" method="post" action="<?php echo base_url("Feedback/submitfeedback"); ?>" enctype="multipart/form-data">
                      <div style="padding: 10px;" class="row">
                         <div class="col-md-6">
                           
                            <textarea placeholder="Write feedback...." class="form-control" name="feedback" id="feedback"></textarea>
                         </div>
                     </div>

                      <div style="padding:5px;" class="row">
                         <div class="col-md-12" style="margin-top:10px;">
                           <button type="submit" name="submit_kyc" class="btn btn-md btn-success">Submit</button>
                         </div>
                      </div>
                </form>
            </div>
          </div>
        </div>
      </div><!-- End Row-->
        </div>
      </div>

    </div>
    <!-- End container-fluid-->

    <div class="overlay"></div>
    
   </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->

<style type="text/css">
   canvas{
      display: none;
      margin: 0px auto;
   }
   video:{
      display: none;
      margin: 0px auto;
   }
</style>
<script type="text/javascript">

$('#kyc_request_form').submit((e)=>{
   e.preventDefault();
   let data = $('#kyc_request_form').serializeArray();
  $.ajax({
     type:'POST',
     url:'<?php echo base_url(); ?>Feedback/submitfeedback',
     data:data,
     success:function(res)
     {
         res = JSON.parse(res);
         if(res.response_code == 200){
            
             swal("SUCCESS!", ''+res.Message+'', "success");
             setTimeout(function(){ window.location.href='<?php echo base_url(); ?>Feedback'; }, 1000);
        }
         else
         {
           swal("ERROR!", ''+res.Message+'', "error");
         }
     }
   });
   
})
</script>