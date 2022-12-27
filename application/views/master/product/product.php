<div class="clearfix"></div>
  
  <div class="content-wrapper">
    <div class="container-fluid">
    <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
        <h4 class="page-title">Product</h4>
        
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
            <div class="card-header"><i class="fa fa-table"></i> Vendor List</div>
            <div class="card-body">
              <div  class="table-responsive">
              <table id="default-datatable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sl. No.</th>
                        <th>Product</th>
                        <th>Rate</th>
                        <th>HSN Code</th>
                        <th>Tax Rate</th>
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
                        <td><?php echo $value['product_name'] ?></td>
                        <td><?php echo $value['product_rate'] ?></td>
                        <td><?php echo $value['hsn_code'] ?></td>
                        <td><?php echo $value['tax_rate'] ?>%</td>
                        <td><i title="Edit" data-toggle="modal" data-target="#formemodalE"  style="cursor: pointer;" onclick="modify_product(<?php echo $value['id'] ?>)"  class="icon-pencil icons"></i></td>
                        <td><i title="Delete" onclick="delete_product(<?php echo $value['id'] ?>)" style="cursor: pointer;" class="icon-trash icons"></i></td>  
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
                <div class="modal fade" id="formemodal">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Create Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          <form id="productForm">
                            <input type="hidden" name="action" value="C">
                             <div class="form-group">
                               <label for="input-1">Product Name</label>
                               <input type="text" name="product_name" class="form-control" id="input-1" placeholder="Enter Product Name">
                             </div>

                             <div class="form-group">
                               <label for="input-1">Product Rate</label>
                               <input type="number" step="any" name="product_rate" class="form-control" id="input-1" placeholder="Enter Product Rate">
                             </div>

                             <div class="form-group">
                               <label for="input-1">HSN Code</label>
                               <input type="text" name="hsn_code" class="form-control" id="input-1" placeholder="Enter HSN Code">
                             </div>

                             <div class="form-group">
                               <label for="input-1">Tax Rate</label>
                               <select name="tax_rate" class="form-control select2" id="input-1">
                                <option value="0">0%</option>
                                <option value="5">5%</option>
                                <option value="12">12%</option>
                                <option value="18">18%</option>
                                <option value="27">27%</option>
                               </select>
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
                <div class="modal fade" id="formemodalE">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Modify Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          <form id="ProductFormE">
                            <input type="hidden" name="action" value="U">
                            <input type="hidden" name="id" id="id">
                             <div class="form-group">
                               <label for="input-1">Product Name</label>
                               <input type="text" name="product_name" class="form-control" id="product_name" placeholder="Enter Product Name">
                             </div>

                             <div class="form-group">
                               <label for="input-1">Product Rate</label>
                               <input type="number" step="any" name="product_rate" class="form-control" id="product_rate" placeholder="Enter Product Rate">
                             </div>

                             <div class="form-group">
                               <label for="input-1">HSN Code</label>
                               <input type="text" name="hsn_code" class="form-control" id="hsn_code" placeholder="Enter HSN Code">
                             </div>

                             <div class="form-group">
                               <label for="input-1">Tax Rate</label>
                               <select name="tax_rate" class="form-control select2" id="tax_rate">
                                <option value="0">0%</option>
                                <option value="5">5%</option>
                                <option value="12">12%</option>
                                <option value="18">18%</option>
                                <option value="27">27%</option>
                               </select>
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

    $('#productForm').submit(function(e){
      e.preventDefault();
    
          $('#overlay2').show();
          var data = $('#productForm').serializeArray();
          $.ajax({
                type: "POST",
                url:"<?php echo base_url();  ?>Master/product_master",
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
                        setTimeout(function(){ window.location.href='<?php echo base_url(); ?>Master/product'; }, 1000);
                        $('#formemodal').modal('toggle');
                        $('#productForm').clear();

                   }
                    else
                    {
                                $('#overlay2').hide();
                                swal("ERROR!", ''+res.Message+'', "error");
                                $('#productForm').clear();
                    }
               }
            });
          });


    function delete_product(id)
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
                        url:"<?php echo base_url();  ?>Master/product_master",
                              data:{action: 'D',id: id},
                              headers: {
                                     "x-api-key": "admin@123",
                                   },
                              success:function(res)
                              {
                                res = JSON.parse(res);
                                  if(res.response_code == 200){
                                     $('#overlay2').hide();
                                      swal("SUCCESS!", ''+res.Message+'', "success");
                                      setTimeout(function(){ window.location.href='<?php echo base_url(); ?>Master/product'; }, 1000);
                                      
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
    function modify_product(id)
    {
        $.ajax({
          type:'POST',
          url:"<?php echo base_url();  ?>Master/product_master",
                data:{action: 'R',id: id},
                headers: {
                       "x-api-key": "admin@123",
                     },
                success:function(res)
                {
                  res = JSON.parse(res);
                    if(res.response_code == 200){
                       $('#overlay2').hide();
                        $('#id').val(res.response_data[0]['id']);

                        $('#product_name').val(res.response_data[0]['product_name']);

                        $('#product_rate').val(res.response_data[0]['product_rate']);

                        $('#hsn_code').val(res.response_data[0]['hsn_code']);

                        $('#tax_rate').val(res.response_data[0]['tax_rate']);
                   }
                    else
                    {
                          $('#overlay2').hide();
                          swal("ERROR!", ''+res.Message+'', "error");
                    }
                }
        });
    }
    $('#ProductFormE').submit(function(e){
      e.preventDefault();
      
          $('#overlay2').show();
          var data = $('#ProductFormE').serializeArray();
          $.ajax({
                type: "POST",
                url:"<?php echo base_url();  ?>Master/product_master",
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
                        setTimeout(function(){ window.location.href='<?php echo base_url(); ?>Master/product'; }, 1000);
                        $('#formemodalE').modal('toggle');
                        $('#ProductFormE').clear();

                   }
                    else
                    {
                                $('#overlay2').hide();
                                swal("ERROR!", ''+res.Message+'', "error");
                    }
               }
            });
          });
  </script>