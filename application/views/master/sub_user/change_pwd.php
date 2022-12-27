<div class="clearfix"></div>
  
  <div style="background: #F3FCFB!important;padding-top: 125px;" class="content-wrapper">
    <div class="container-fluid">
    <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
        <h4 class="page-title">Change Password</h4>
        
     </div>
     </div>
     </div>
    <!-- End Breadcrumb-->
      <div class="row">
          <div class="col-lg-12">
            <!-- End Breadcrumb-->
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Change Password</div>
            <form method="POST" action="<?php echo base_url(); ?>Master/update_password" >
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <input type="password" placeholder="Old Password" name="old_paassword" class="form-control">
                    </div>
                    <div class="col-md-6">
                      <input type="password" placeholder="New Password" name="new_paassword" class="form-control">
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-md-12">
                      <button type="submit" class="btn btn-md btn-info">Chnage Password</button>
                    </div>
                  </div>
                </div>
            </form>
          </div>
        </div>
      </div><!-- End Row-->
        </div>
      </div>

    </div>

    <div class="overlay"></div>
    
   </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
  <script type="text/javascript">
    $(document).ready(function(){
      $('#overlay2').hide();
    });


    function modify_blockStatus(dataStr)
    {
      let user_id = dataStr.id;
      let status = dataStr.value;
      
        $.ajax({
          type:'POST',
          url:"<?php echo base_url();  ?>Master/sub_user_block_status",
                data:{user_id: user_id,blocked_status: status},
                headers: {
                       "x-api-key": "admin@123",
                     },
                success:function(res)
                {
                   res = JSON.parse(res);
                    if(res.response_code == 200){
                        swal("SUCCESS!", ''+res.Message+'', "success");
                        setTimeout(function(){ window.location.href='<?php echo base_url(); ?>Master/sub_user'; }, 1000);

                   }
                    else
                    {
                        swal("ERROR!", ''+res.msg+'', "error");
                    }
              }
        });
    }
    function modify_roles(dataStr)
    {
      let user_id = dataStr.id;
      let status = dataStr.value;
      
        $.ajax({
          type:'POST',
          url:"<?php echo base_url();  ?>Master/sub_user_role_status",
                data:{user_id: user_id,role_id: status},
                headers: {
                       "x-api-key": "admin@123",
                     },
                success:function(res)
                {
                   res = JSON.parse(res);
                    if(res.response_code == 200){
                        swal("SUCCESS!", ''+res.Message+'', "success");
                        setTimeout(function(){ window.location.href='<?php echo base_url(); ?>Master/sub_user'; }, 1000);

                   }
                    else
                    {
                        swal("ERROR!", ''+res.msg+'', "error");
                    }
              }
        });
    }

    function resendInvitations(dataStr)
    {
      $('#overlay2').show();
      let user_id = dataStr.id;
        $.ajax({
          type:'POST',
          url:"<?php echo base_url();  ?>Master/resend_email_invitaions",
                data:{user_id: user_id},
                headers: {
                       "x-api-key": "admin@123",
                     },
                success:function(res)
                {
                   res = JSON.parse(res);
                    if(res.status == true){
                        swal("SUCCESS!", ''+res.msg+'', "success");
                        $('#overlay2').hide();
                        setTimeout(function(){ window.location.href='<?php echo base_url(); ?>Master/sub_user'; }, 1000);

                   }
                    else
                    {
                      $('#overlay2').hide();
                        swal("ERROR!", ''+res.msg+'', "error");
                    }
              }
        });
    }
    
    $('#CreateUserForm').submit(function(e){
      e.preventDefault();
      $('#submit_btn').prop('disabled',true);
      let data = $('#CreateUserForm').serializeArray();
      $.ajax({
            type: "POST",
            url:"<?php echo base_url();  ?>Master/sub_user_create",
            data:data,
            headers: {
                   "x-api-key": "admin@123",
                 },
            success:function(res)
            {
                res = JSON.parse(res);
                if(res.status == true){
                   $('#overlay2').hide();
                    swal("SUCCESS!", ''+res.msg+'', "success");
                    setTimeout(function(){ window.location.href='<?php echo base_url(); ?>Master/sub_user'; }, 1000);
                    $('#CreateUserForm').modal('toggle');
                    $('#CreateUserForm').clear();
                    $('#submit_btn').prop('disabled',false);

               }
                else
                {
                    $('#overlay2').hide();
                    swal("ERROR!", ''+res.msg+'', "error");
                    $('#submit_btn').prop('disabled',false);
                }
           }
        });

    });
  </script>