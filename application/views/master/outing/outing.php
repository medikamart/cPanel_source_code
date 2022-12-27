<div class="clearfix"></div>
  
  <div style="background: #F3FCFB!important;padding-top: 125px;" class="content-wrapper">
    <div class="container-fluid">
    <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
        <h4 class="page-title">Outing Report</h4>
        
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
            <div class="card-header"><i class="fa fa-table"></i> Outing List</div>
            <div class="card-body">
              <div  class="table-responsive">
              <table id="default-datatable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sl. No.</th>
                        <th>Vendor</th>
                        <th>Firm</th>
                        <th>Patient</th>
                        <th>Amount</th>
                        <th>Outing Date</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                      if(!empty($outing_result))
                      {
                        foreach($outing_result as $key=>$value)
                          {
                            ?>
                            <tr>
                            <td><?php echo ($key+1);  ?></td>
                            <td><?php echo $value['vendor_name'] ?></td>
                            <td><?php echo $value['vendor_firm'] ?></td>
                            <td><?php echo $value['full_name'] ?></td>
                            <td><?php echo $value['amount'] ?></td>
                            <td><?php echo date('d-m-Y',strtotime($value['outing_date'])); ?></td>
                            <td><i title="Edit" data-toggle="modal" data-target="#formemodalE"  style="cursor: pointer;" onclick="modify_outing(<?php echo $value['id'] ?>)"  class="icon-pencil icons"></i></td>
                            <td><i title="Delete" onclick="delete_outing(<?php echo $value['id'] ?>)" style="cursor: pointer;" class="icon-trash icons"></i></td>  
                          </tr>
                            <?php
                          }
                      
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
      <div style="padding-top: 125px;"  class="modal fade" id="formemodal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Create Outing</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="outingForm">
                  <input type="hidden" name="action" value="C">
                   <div class="form-group">
                     <label for="input-1">Patient Name</label>
                     <select class="form-control" name="patient_id">
                      <?php 
                        foreach($patient_list as $key=>$value)
                        {
                          ?>
                          <option value="<?php echo $value['id']; ?>"><?php echo $value['title'].' '.$value['full_name'].' '.$value['mobile']; ?></option>
                          <?php
                        }
                       ?>
                     </select>
                   </div>

                   <div class="form-group">
                     <label for="input-1">Firm</label>
                     <select class="form-control" name="vendor_id">
                      <?php 
                        foreach($vendor_list as $key=>$value)
                        {
                          ?>
                          <option value="<?php echo $value['id']; ?>"><?php echo $value['vendor_firm'].' - '.$value['vendor_name']; ?></option>
                          <?php
                        }
                       ?>
                     </select>
                   </div>

                   <div class="form-group">
                     <label for="input-1">Amount</label>
                     <input type="number" step="any" name="amount" class="form-control" id="input-1" placeholder="Enter Amount">
                   </div>

                   <div class="form-group">
                     <label for="input-1">Outing Date</label>
                     <input type="date" value="<?php echo date('Y-m-d'); ?>" name="outing_date" class="form-control" id="input-1">
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
                <form id="OutingFormE">
                  <input type="hidden" name="action" value="U">
                  <input type="hidden" name="id" id="id">
                   <div class="form-group">
                     <label for="input-1">Patient Name</label>
                     <select class="form-control" id="patient_id" name="patient_id">
                      <?php 
                        foreach($patient_list as $key=>$value)
                        {
                          ?>
                          <option value="<?php echo $value['id']; ?>"><?php echo $value['title'].' '.$value['full_name'].' '.$value['mobile']; ?></option>
                          <?php
                        }
                       ?>
                     </select>
                   </div>

                   <div class="form-group">
                     <label for="input-1">Firm</label>
                     <select class="form-control" id="vendor_id" name="vendor_id">
                      <?php 
                        foreach($vendor_list as $key=>$value)
                        {
                          ?>
                          <option value="<?php echo $value['id']; ?>"><?php echo $value['vendor_firm'].' - '.$value['vendor_name']; ?></option>
                          <?php
                        }
                       ?>
                     </select>
                   </div>

                   <div class="form-group">
                     <label for="input-1">Amount</label>
                     <input type="number" step="any" name="amount" class="form-control" id="amount" placeholder="Enter Amount">
                   </div>

                   <div class="form-group">
                     <label for="input-1">Outing Date</label>
                     <input type="date" value="<?php echo date('Y-m-d'); ?>" name="outing_date" class="form-control" id="outing_date">
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

    $('#outingForm').submit(function(e){
      e.preventDefault();
      $("#outingForm").validate({
        rules: {
            patient_id: "required",
            vendor_id: "required",
            amount:"required",
            outing_date:"required",
        },
        messages: {
            patient_id: "Please select patient",
            vendor_id: "Please select vendor",
            amount:"Please enter amount",
            outing_date:"Please select outing date",
        },
        submitHandler:function()
        {
          $('#overlay2').show();
          var data = $('#outingForm').serializeArray();
          $.ajax({
                type: "POST",
                url:"<?php echo base_url();  ?>Master/outing_master",
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
                        setTimeout(function(){ window.location.href='<?php echo base_url(); ?>Master/outing'; }, 1000);
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


    function delete_outing(id)
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
                        url:"<?php echo base_url();  ?>Master/outing_master",
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
                                      setTimeout(function(){ window.location.href='<?php echo base_url(); ?>Master/outing'; }, 1000);
                                      
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
    function modify_outing(id)
    {
        $.ajax({
          type:'POST',
          url:"<?php echo base_url();  ?>Master/outing_master",
                data:{action: 'R',id: id},
                headers: {
                       "x-api-key": "admin@123",
                     },
                success:function(res)
                {
                  res = JSON.parse(res);
                  console.log(res.response_data[0]);
                    if(res.response_code == 200){
                       $('#overlay2').hide();
                        $('#id').val(res.response_data[0]['id']);

                        $('#vendor_id').val(res.response_data[0]['vendor_id']).trigger('change');

                        $('#patient_id').val(res.response_data[0]['patient_id']).trigger('change');

                        $('#amount').val(res.response_data[0]['amount']);
                        var date = new Date(res.response_data[0]['outing_date']);
                        var months = (date.getMonth()+1);
                        var days = date.getDay();
                        if((date.getMonth()+1)<10)
                                  months = '0'+(date.getMonth()+1);
                        if(date.getDay()<10)
                                  days = '0'+date.getDay();

                        var str = date.getFullYear()+'-'+months+'-'+days;
                        $('#outing_date').val(str);
                   }
                    else
                    {
                          $('#overlay2').hide();
                          swal("ERROR!", ''+res.Message+'', "error");
                    }
                }
        });
    }
    $('#OutingFormE').submit(function(e){
      e.preventDefault();
      $("#OutingFormE").validate({
        rules: {
            patient_id: "required",
            vendor_id: "required",
            amount:"required",
            outing_date:"required",
        },
        messages: {
            patient_id: "Please select patient",
            vendor_id: "Please select vendor",
            amount:"Please enter amount",
            outing_date:"Please select outing date",
        },
        success:function()
        {
          $('#overlay2').show();
          var data = $('#OutingFormE').serializeArray();
          $.ajax({
                type: "POST",
                url:"<?php echo base_url();  ?>Master/outing_master",
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
                        setTimeout(function(){ window.location.href='<?php echo base_url(); ?>Master/outing'; }, 1000);
                        $('#formemodalE').modal('toggle');
                        $('#OutingFormE').clear();

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