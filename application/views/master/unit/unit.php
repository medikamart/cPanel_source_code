<div class="clearfix"></div>
  
  <div style="background: #F3FCFB!important;padding-top: 125px;" class="content-wrapper">
    <div class="container-fluid">
    <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
        <h4 class="page-title">Unit</h4>
        
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
            <div class="card-header"><i class="fa fa-table"></i> Unit List</div>
            <div class="card-body">
              <div  class="table-responsive">
              <table id="default-datatable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sl. No.</th>
                        <th>Unit</th>
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
                        <td><?php echo $value['unit'] ?></td>
                        <td><i title="Edit" data-toggle="modal" data-target="#formemodalE"  style="cursor: pointer;" onclick="modify_unit(<?php echo $value['id'] ?>)"  class="icon-pencil icons"></i></td>
                        <td><i title="Delete" onclick="delete_unit(<?php echo $value['id'] ?>)" style="cursor: pointer;" class="icon-trash icons"></i></td>  
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
                        <h5 class="modal-title">Create Unit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          <form id="unitForm">
                            <input type="hidden" name="action" value="C">
                             <div class="form-group">
                               <label for="input-1">Unit</label>
                               <input type="text" name="unit" class="form-control" id="input-1" placeholder="Enter Unit Name">
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
                        <h5 class="modal-title">Modify Unit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          <form id="UnitFormE">
                            <input type="hidden" name="action" value="U">
                            <input type="hidden" name="id" id="id">
                             <div class="form-group">
                               <label for="input-1">Unit</label>
                               <input type="text" name="unit" class="form-control" id="unit" placeholder="Enter Unit Name">
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

    $('#unitForm').submit(function(e){
      e.preventDefault();
      $("#unitForm").validate({
        rules: {
            unit: "required"
        },
        messages: {
            vendor_name: "Please enter unit name"
        },
        success:function()
        {
          $('#overlay2').show();
          var data = $('#unitForm').serializeArray();
          $.ajax({
                type: "POST",
                url:"<?php echo base_url();  ?>Master/unit_master",
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
                        setTimeout(function(){ window.location.href='<?php echo base_url(); ?>Master/unit'; }, 1000);
                        $('#formemodal').modal('toggle');
                        $('#unit_master').clear();

                   }
                    else
                    {
                        $('#overlay2').hide();
                        swal("ERROR!", ''+res.Message+'', "error");
                        $('#unit_master').clear();
                    }
               }
            });
        }
    });

    });


    function delete_unit(id)
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
                        url:"<?php echo base_url();  ?>Master/unit_master",
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
                                      setTimeout(function(){ window.location.href='<?php echo base_url(); ?>Master/unit'; }, 1000);
                                      
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
    function modify_unit(id)
    {
        $.ajax({
          type:'POST',
          url:"<?php echo base_url();  ?>Master/unit_master",
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

                        $('#unit').val(res.response_data[0]['unit']);
                   }
                    else
                    {
                          $('#overlay2').hide();
                          swal("ERROR!", ''+res.Message+'', "error");
                    }
                }
        });
    }
    $('#UnitFormE').submit(function(e){
      e.preventDefault();
      $("#UnitFormE").validate({
        rules: {
            unit: "required"
        },
        messages: {
            unit: "Please enter unit name"
        },
        success:function()
        {
          $('#overlay2').show();
          var data = $('#UnitFormE').serializeArray();
          $.ajax({
                type: "POST",
                url:"<?php echo base_url();  ?>Master/unit_master",
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
                        setTimeout(function(){ window.location.href='<?php echo base_url(); ?>Master/unit'; }, 1000);
                        $('#UnitFormE').modal('toggle');
                        $('#UnitFormE').clear();

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