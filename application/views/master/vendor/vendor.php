<div class="clearfix"></div>
  
  <div style="background: #F3FCFB!important;padding-top: 125px;" class="content-wrapper">
    <div class="container-fluid">
    <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
        <h4 class="page-title">Vendor</h4>
        
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
                        <th>Name</th>
                        <th>Firm</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Telephone</th>
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
                        <td><?php echo $value['vendor_name'] ?></td>
                        <td><?php echo $value['vendor_firm'] ?></td>
                        <td><?php echo $value['vendor_phone'] ?></td>
                        <td><?php echo $value['vendor_email'] ?></td>
                        <td><?php echo $value['vendor_telephone'] ?></td>
                        <td><i title="Edit" data-toggle="modal" data-target="#formemodalE"  style="cursor: pointer;" onclick="modify_vendor(<?php echo $value['id'] ?>)"  class="icon-pencil icons"></i></td>
                        <td><i title="Delete" onclick="delete_vendor(<?php echo $value['id'] ?>)" style="cursor: pointer;" class="icon-trash icons"></i></td>  
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
                        <h5 class="modal-title">Create Vendor</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          <form id="vendorForm">
                            <input type="hidden" name="action" value="C">
                             <div class="form-group">
                               <label for="input-1">Name</label>
                               <input type="text" name="vendor_name" class="form-control" id="input-1" placeholder="Enter Vendor Name">
                             </div>

                             <div class="form-group">
                               <label for="input-1">Firm</label>
                               <input type="text" name="vendor_firm" class="form-control" id="input-1" placeholder="Enter Vendor Firm">
                             </div>

                             <div class="form-group">
                               <label for="input-1">Phone</label>
                               <input type="text" name="vendor_phone" class="form-control" id="input-1" placeholder="Enter Vendor Phone">
                             </div>

                             <div class="form-group">
                               <label for="input-1">Email</label>
                               <input type="text" name="vendor_email" class="form-control" id="input-1" placeholder="Enter Vendor Email">
                             </div>

                             <div class="form-group">
                               <label for="input-1">Telephone</label>
                               <input type="text" name="vendor_telephone" class="form-control" id="input-1" placeholder="Enter Vendor Telephone">
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
                        <h5 class="modal-title">Modify Vendor</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          <form id="VendorFormE">
                            <input type="hidden" name="action" value="U">
                            <input type="hidden" name="id" id="id">
                             <div class="form-group">
                               <label for="input-1">Name</label>
                               <input type="text" name="vendor_name" class="form-control" id="vendor_name" placeholder="Enter Vendor Name">
                             </div>

                             <div class="form-group">
                               <label for="input-1">Firm</label>
                               <input type="text" name="vendor_firm" class="form-control" id="vendor_firm" placeholder="Enter Vendor Firm">
                             </div>

                             <div class="form-group">
                               <label for="input-1">Phone</label>
                               <input type="text" name="vendor_phone" class="form-control" id="vendor_phone" placeholder="Enter Vendor Phone">
                             </div>

                             <div class="form-group">
                               <label for="input-1">Email</label>
                               <input type="text" name="vendor_email" class="form-control" id="vendor_email" placeholder="Enter Vendor Email">
                             </div>

                             <div class="form-group">
                               <label for="input-1">Telephone</label>
                               <input type="text" name="vendor_telephone" class="form-control" id="vendor_telephone" placeholder="Enter Vendor Telephone">
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

    $('#vendorForm').submit(function(e){
      e.preventDefault();
      $("#vendorForm").validate({
        rules: {
            vendor_name: "required"
        },
        messages: {
            vendor_name: "Please enter vendor name"
        },
        success:function()
        {
          $('#overlay2').show();
          var data = $('#vendorForm').serializeArray();
          $.ajax({
                type: "POST",
                url:"<?php echo base_url();  ?>Master/vendor_master",
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
                        setTimeout(function(){ window.location.href='<?php echo base_url(); ?>Master/vendor/vendor'; }, 1000);
                        $('#formemodal').modal('toggle');
                        $('#vendorForm').clear();

                   }
                    else
                    {
                                $('#overlay2').hide();
                                swal("ERROR!", ''+res.Message+'', "error");
                                $('#vendorForm').clear();
                    }
               }
            });
        }
    });

    });


    function delete_vendor(id)
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
                        url:"<?php echo base_url();  ?>Master/vendor_master",
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
                                      setTimeout(function(){ window.location.href='<?php echo base_url(); ?>Master/vendor/vendor'; }, 1000);
                                      
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
    function modify_vendor(id)
    {
        $.ajax({
          type:'POST',
          url:"<?php echo base_url();  ?>Master/vendor_master",
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

                        $('#vendor_name').val(res.response_data[0]['vendor_name']);

                        $('#vendor_firm').val(res.response_data[0]['vendor_firm']);

                        $('#vendor_phone').val(res.response_data[0]['vendor_phone']);

                        $('#vendor_email').val(res.response_data[0]['vendor_email']);

                        $('#vendor_telephone').val(res.response_data[0]['vendor_telephone']);
                   }
                    else
                    {
                          $('#overlay2').hide();
                          swal("ERROR!", ''+res.Message+'', "error");
                    }
                }
        });
    }
    $('#VendorFormE').submit(function(e){
      e.preventDefault();
      $("#VendorFormE").validate({
        rules: {
            vendor_name: "required"
        },
        messages: {
            vendor_name: "Please enter vendor name"
        },
        success:function()
        {
          $('#overlay2').show();
          var data = $('#VendorFormE').serializeArray();
          $.ajax({
                type: "POST",
                url:"<?php echo base_url();  ?>Master/vendor_master",
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
                        setTimeout(function(){ window.location.href='<?php echo base_url(); ?>Master/vendor/vendor'; }, 1000);
                        $('#formemodalE').modal('toggle');
                        $('#VendorFormE').clear();

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