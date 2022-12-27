<div class="clearfix"></div>
  
  <div style="background: #F3FCFB!important;padding-top: 125px;" class="content-wrapper">
    <div class="container-fluid">
    <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
        <h4 class="page-title">Users</h4>
        
     </div>
     <div class="col-sm-3">
       <div class="btn-group float-sm-right">
        <button type="button" class="btn btn-outline-primary waves-effect waves-light"><i class="fa fa-cog mr-1"></i> Create</button>
        <button type="button" class="btn btn-outline-primary dropdown-toggle dropdown-toggle-split waves-effect waves-light" data-toggle="dropdown">
        <span class="caret"></span>
        </button>
        <div class="dropdown-menu">
          <button data-toggle="modal" onclick="openCreate()"  data-target="#formemodal" class="dropdown-item">New</button>
        </div>
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
            <div class="card-header"><i class="fa fa-table"></i> User List</div>
            <div class="card-body">
              <div  class="table-responsive">
              <table id="default-datatable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sl. No.</th>
                        <th>User Id</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Role</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Invitation</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                      if(!empty($user_result))
                      {
                        foreach ($user_result as $key => $value) 
                        {
                          ?>
                          <tr>
                              <td><?php echo ($key+1); ?></td>
                              <td><?php echo $value['user_id']; ?></td>
                              <td><?php echo $value['first_name']; ?></td>
                              <td><?php echo $value['last_name']; ?></td>
                              <td>
                                <select id="<?php echo $value['user_id']; ?>" onchange="modify_roles(this)">
                                  <?php
                                  foreach($role_result as $keys=>$values)
                                  {
                                    if($values['id']==$value['role'])
                                    {
                                      ?>
                                      <option class="form-control" selected="selected" value="<?php echo $values['id']; ?>"><?php echo $values['role_name']; ?></option>
                                      <?php
                                    }else
                                    {
                                      ?>
                                      <option class="form-control" value="<?php echo $values['id']; ?>"><?php echo $values['role_name']; ?></option>
                                      <?php
                                    }
                                  }
                                  ?></td>
                              <td><?php echo $value['email']; ?></td>
                              <td><?php echo $value['phone']; ?></td>
                              <td>
                              <select id="<?php echo $value['user_id']; ?> " onchange="modify_blockStatus(this)">>
                                <option class="form-control" <?php if($value['blocked']==1){echo "selected='selected'";} ?> value="1">Blocked</option>
                                <option <?php if($value['blocked']==0){echo"selected='selected'";} ?> value="0">Active</option>  
                              </select></td>
                              <td><?php if($value['link_status']==1){
                                ?>
                                <button id="<?php echo $value['user_id']; ?>" onclick="resendInvitations(this)" class="btn btn-sm btn-info">Resend Invitation</button>
                                <?php
                              }elseif($value['link_status']==0){echo 'Accepted';} ?></td>
                              <td>-</td>
                          </tr>
                          <?php
                        }
                        
                      }else
                      {

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

     <!-- Add Modal -->
                <div style="padding-top: 125px;" class="modal fade" id="formemodal">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Create User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          <form id="CreateUserForm">
                            <div class="row">
                              <div class="col-md-6">
                                   <strong>Email</strong>
                                    
                                    <input type="text" class="form-control" name="email">
                              </div>
                              <div class="col-md-6">
                                   <strong>Role</strong>
                                    
                                    <select class="form-control" name="role_id">
                                        <?php
                                          if(!empty($role_result))
                                          {
                                            foreach($role_result as $key=>$value)
                                            {
                                              ?>
                                              <option value="<?php echo $value['id']; ?>"><?php echo $value['role_name'];  ?></option>
                                              <?php  
                                            }
                                            
                                          }
                                         ?>
                                        
                                    </select>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                   <strong>First Name</strong>
                                    
                                    <input type="text" class="form-control" name="first_name">
                              </div>
                              <div class="col-md-6">
                                   <strong>Last Name</strong>
                                    
                                    <input type="text" class="form-control" name="last_name">
                              </div>
                            </div>
                            <hr>
                             <div class="row">
                              <div class="col-md-12">
                                  <button type="submit" id="submit_btn" style="color: white!important;padding-bottom:27px;"  class="btn btn-success form-control"> Send Invitation</button>
                                </div>
                            </div>
                        </form>

                      </div>
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