<div class="clearfix"></div>
  
  <div style="background: #F3FCFB!important;padding-top: 125px;" class="content-wrapper">
    <div class="container-fluid">
    <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
        <h4 class="page-title">Category</h4>
        
     </div>
     <div class="col-sm-3">
       <div class="btn-group float-sm-right">
        <button type="button" class="btn btn-outline-primary waves-effect waves-light"><i class="fa fa-cog mr-1"></i> Create</button>
        <button type="button" class="btn btn-outline-primary dropdown-toggle dropdown-toggle-split waves-effect waves-light" data-toggle="dropdown">
        <span class="caret"></span>
        </button>
        <div class="dropdown-menu">
          <button data-toggle="modal" data-target="#formemodal" class="dropdown-item">New</button>
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
            <div class="card-header"><i class="fa fa-table"></i> Category List</div>
            <div class="card-body">
              <div  class="table-responsive">
              <table id="default-datatable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sl. No.</th>
                        <th>Category</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php

                      foreach($result as $key=>$value)
                      {
                        ?>
                        <tr>
                        <td><?php echo ($key+1);  ?></td>
                        <td><?php echo $value['category_name'] ?></td>
                        
                          <?php if($value['global']==0)
                          {
                            ?>
                            <td>
                             <i title="Edit" data-toggle="modal" data-target="#formemodalE"  style="cursor: pointer;" onclick="modify_category(<?php echo $value['id'] ?>)"  class="icon-pencil icons"></i>
                             </td>
                             <td><i title="Delete" onclick="delete_category(<?php echo $value['id'] ?>)" style="cursor: pointer;" class="icon-trash icons"></i></td> 
                            <?php
                          }else{
                           ?>
                           <td>-</td>
                           <td>-</td> 
                           <?php
                          } ?>
                         
                         
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

     <!-- Add Modal -->
                <div style="padding-top: 125px;" class="modal fade" id="formemodal">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Create Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          <form id="categoryForm">
                            <input type="hidden" name="action" value="C">
                             <div class="form-group">
                               <label for="input-1">Category</label>
                               <input type="text" name="category_name" class="form-control" id="input-1" placeholder="Enter Your Category">
                             </div>
                             <div class="form-group">
                              <button type="submit" class="btn btn-info shadow-info px-5"><i class="icon-doc"></i> Save</button>
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
  <!-- Edit Modal -->
                <div style="padding-top: 125px;" class="modal fade" id="formemodalE">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Modify Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          <form id="categoryFormE">
                            <input type="hidden" name="action" value="U">
                            <input type="hidden" name="category_id" id="category_id">
                             <div class="form-group">
                               <label for="input-1">Category</label>
                               <input type="text" name="category_name" class="form-control" id="category_name" placeholder="Enter Your Category">
                             </div>
                             <div class="form-group">
                              <button type="submit" class="btn btn-info shadow-info px-5"><i class="icon-doc"></i> Update</button>
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

    $('#categoryForm').submit(function(e){
      e.preventDefault();
      $("#categoryForm").validate({
        rules: {
            category_name: "required"
        },
        messages: {
            category_name: "Please enter category name"
        },
        success:function()
        {
          $('#overlay2').show();
          var data = $('#categoryForm').serializeArray();
          $.ajax({
                type: "POST",
                url:"<?php echo base_url();  ?>Master/category_master",
                data:data,
                headers: {
                       "x-api-key": "admin@123",
                     },
                success:function(res)
                {
                    res = JSON.parse(res);
                    if(res.response_code == 200){
                       $('#overlay2').hide();
                        swal("SUCCESS!", ''+res.Message+'', "success");
                        setTimeout(function(){ window.location.href='<?php echo base_url(); ?>Master/category'; }, 1000);
                        $('#formemodal').modal('toggle');
                        $('#categoryForm').clear();

                   }
                    else
                    {
                                $('#overlay2').hide();
                                swal("ERROR!", ''+res.Message+'', "error");
                                $('#categoryForm').clear();
                    }
               }
            });
        }
    });

    });


    function delete_category(id)
    {
        swal({
              title: "Are you sure?",
              text: "Once deleted, you will not be able to recover !",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                 $.ajax({
                        type:'POST',
                        url:"<?php echo base_url();  ?>Master/category_master",
                              data:{action: 'D',category_id: id},
                              headers: {
                                     "x-api-key": "admin@123",
                                   },
                              success:function(res)
                              {
                                res = JSON.parse(res);
                                  if(res.response_code == 200){
                                     $('#overlay2').hide();
                                      swal("SUCCESS!", ''+res.Message+'', "success");
                                      setTimeout(function(){ window.location.href='<?php echo base_url(); ?>Master/category'; }, 1000);
                                      
                                 }
                                  else
                                  {
                                        $('#overlay2').hide();
                                        swal("ERROR!", ''+res.Message+'', "error");
                                  }
                              }
                      });
              } else {
                
              }
            });


       
    }
    function modify_category(id)
    {
        $.ajax({
          type:'POST',
          url:"<?php echo base_url();  ?>Master/category_master",
                data:{action: 'R',category_id: id},
                headers: {
                       "x-api-key": "admin@123",
                     },
                success:function(res)
                {
                  res = JSON.parse(res);
                    if(res.response_code == 200){
                       $('#overlay2').hide();
                        $('#category_id').val(res.response_data[0]['id']);
                        $('#category_name').val(res.response_data[0]['category_name']);
                   }
                    else
                    {
                          $('#overlay2').hide();
                          swal("ERROR!", ''+res.Message+'', "error");
                    }
                }
        });
    }
    $('#categoryFormE').submit(function(e){
      e.preventDefault();
      $("#categoryFormE").validate({
        rules: {
            category_name: "required"
        },
        messages: {
            category_name: "Please enter category name"
        },
        success:function()
        {
          $('#overlay2').show();
          var data = $('#categoryFormE').serializeArray();
          $.ajax({
                type: "POST",
                url:"<?php echo base_url();  ?>Master/category_master",
                data:data,
                headers: {
                       "x-api-key": "admin@123",
                     },
                success:function(res)
                {
                    res = JSON.parse(res);
                    if(res.response_code == 200){
                       $('#overlay2').hide();
                        swal("SUCCESS!", ''+res.Message+'', "success");
                        setTimeout(function(){ window.location.href='<?php echo base_url(); ?>Master/category'; }, 1000);
                        $('#formemodalE').modal('toggle');
                        $('#categoryFormE').clear();

                   }
                    else
                    {
                                $('#overlay2').hide();
                                swal("ERROR!", ''+res.Message+'', "error");
                    }
               }
            });
        }
    });

    });
  </script>