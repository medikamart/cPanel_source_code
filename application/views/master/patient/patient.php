<div class="clearfix"></div>
  
  <div style="background: #F3FCFB!important;padding-top: 125px;" class="content-wrapper">
    <div class="container-fluid">
    <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
        <h4 class="page-title">Patient</h4>
        
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
            <div class="card-header"><i class="fa fa-table"></i> Patient List</div>
            <div class="card-body">
              <div  class="table-responsive">
              <table id="default-datatable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sl. No.</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
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
                        <td><?php echo $value['title'].' '.$value['full_name']; ?></td>
                        <td><?php 
                        if(!empty($value['age']))
                        {
                          echo $value['age'].' Years ';
                        };
                        if(!empty($value['month']))
                        {
                          echo $value['month'].' Months ';
                        }; ?></td>
                        <td><?php echo $value['sex']; ?></td>
                        <td><?php echo $value['mobile']; ?></td>
                        <td><?php echo $value['email']; ?></td>
                        <td><?php echo $value['address']; ?></td>
                        <td><i title="Edit" data-toggle="modal" data-target="#formemodalE"  style="cursor: pointer;" onclick="modify_patient(<?php echo $value['id'] ?>)"  class="icon-pencil icons"></i></td>
                        <td><i title="Delete" onclick="delete_patient(<?php echo $value['id'] ?>)" style="cursor: pointer;" class="icon-trash icons"></i></td>  
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
                        <h5 class="modal-title">Create Patient</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          <form id="patientForm">
                            <input type="hidden" name="action" value="C">

                            <div class="form-group">
                               <label for="input-1">Tittle</label>
                               <select onchange="change_gender(this.value)" name="title" class="form-control" >
                                <option value="Mr.">Mr.</option>
                                <option value="Mrs.">Mrs.</option>
                                <option value="Miss.">Miss.</option>
                                <option value="Dr.">Dr.</option>
                                <option value="Baby Of.">Baby Of.</option>
                                <option value="-">-</option>
                               </select>
                             </div>
                             <div class="form-group">
                               <label for="input-1">Name</label>
                               <input type="text" name="full_name" class="form-control" placeholder="Enter Patient Name">
                             </div>

                             <div class="form-group">
                               <label for="input-1">Year</label>
                               <input type="text" name="age" class="form-control" placeholder="Enter Patient Age Year">
                             </div>

                             <div class="form-group">
                               <label for="input-1">Month</label>
                               <input type="text" name="month" class="form-control" placeholder="Enter Patient Age Month ">
                             </div>

                             <div class="form-group">
                               <label for="input-1">Gender</label>
                               <select name="sex" class="form-control" >
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                               </select>
                             </div>

                             <div class="form-group">
                               <label for="input-1">Phone</label>
                               <input type="number" name="mobile" class="form-control" placeholder="Enter Patient Phone">
                             </div>

                             <div class="form-group">
                               <label for="input-1">Email</label>
                               <input type="text" name="email" class="form-control" placeholder="Enter Patient Email">
                             </div>

                             <div class="form-group">
                               <label for="input-1">Address</label>
                               <input name="address" class="form-control" placeholder="Enter Patient Address">
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
                        <h5 class="modal-title">Modify Patient</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          <form id="PatientFormE">
                            <input type="hidden" name="action" value="U">
                            <input type="hidden" name="id" id="id">
                             
                             <div class="form-group">
                               <label for="input-1">Tittle</label>
                               <select onchange="change_gender(this.value)" name="title" class="form-control" id="title">
                                <option value="Mr.">Mr.</option>
                                <option value="Mrs.">Mrs.</option>
                                <option value="Miss.">Miss.</option>
                                <option value="Dr.">Dr.</option>
                                <option value="Baby Of.">Baby Of.</option>
                                <option value="-">-</option>
                               </select>
                             </div>
                             <div class="form-group">
                               <label for="input-1">Name</label>
                               <input type="text" name="full_name" class="form-control" id="full_name" placeholder="Enter Patient Name">
                             </div>

                             <div class="form-group">
                               <label for="input-1">Year</label>
                               <input type="text" name="age" class="form-control" id="age" placeholder="Enter Patient Age">
                             </div>

                             <div class="form-group">
                               <label for="input-1">Month</label>
                               <input type="text" name="month" class="form-control" id="month" placeholder="Enter Patient Age">
                             </div>

                             <div class="form-group">
                               <label for="input-1">Gender</label>
                               <select name="sex" class="form-control" id="sex">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                               </select>
                             </div>

                             <div class="form-group">
                               <label for="input-1">Phone</label>
                               <input type="number" name="mobile" class="form-control" id="mobile" placeholder="Enter Patient Phone">
                             </div>

                             <div class="form-group">
                               <label for="input-1">Email</label>
                               <input type="text" name="email" class="form-control" id="email" placeholder="Enter Patient Email">
                             </div>

                             <div class="form-group">
                               <label for="input-1">Address</label>
                               <input name="address" class="form-control" id="address" placeholder="Enter Patient Address">
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

    $('#patientForm').submit(function(e){
      e.preventDefault();
      $("#patientForm").validate({
        rules: {
            title: "required",
            full_name: "required",
            sex: "required",
            
        },
        messages: {
            title: "Please select tittle",
            full_name: "Please enter patient name",
            sex: "Please select patient gender",
            
        },
        submitHandler:function(res)
        {
          $('#overlay2').show();
          var data = $('#patientForm').serializeArray();
          $.ajax({
                type: "POST",
                url:"<?php echo base_url();  ?>Master/patient_master",
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
                        setTimeout(function(){ window.location.href='<?php echo base_url(); ?>Master/patient/patient'; }, 1000);
                        $('#formemodal').modal('toggle');
                        $('#patientForm').clear();

                   }
                    else
                    {
                                $('#overlay2').hide();
                                swal("ERROR!", ''+res.Message+'', "error");
                                $('#patientForm').clear();
                    }
               }
            });
        }
    });

    });


    function delete_patient(id)
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
                        url:"<?php echo base_url();  ?>Master/patient_master",
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
                                      setTimeout(function(){ window.location.href='<?php echo base_url(); ?>Master/patient/patient'; }, 1000);
                                      
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
    function modify_patient(id)
    {
        $.ajax({
          type:'POST',
          url:"<?php echo base_url();  ?>Master/patient_master",
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

                        $('#full_name').val(res.response_data[0]['full_name']);

                        $('#age').val(res.response_data[0]['age']);
                        $('#month').val(res.response_data[0]['month']);

                        $('#sex').val(res.response_data[0]['sex']).trigger('change');

                        $('#mobile').val(res.response_data[0]['mobile']).trigger('change');

                        $('#email').val(res.response_data[0]['email']);
                        $('#address').val(res.response_data[0]['address']);
                        $('#title').val(res.response_data[0]['title']).trigger('change');
                   }
                    else
                    {
                          $('#overlay2').hide();
                          swal("ERROR!", ''+res.Message+'', "error");
                    }
                }
        });
    }
    $('#PatientFormE').submit(function(e){
      e.preventDefault();
      $("#PatientFormE").validate({
        rules: {
            title: "required",
            full_name: "required",
            sex: "required",
            
        },
        messages: {
            title: "Please select tittle",
            full_name: "Please enter patient name",
            sex: "Please select patient gender",
            
        },
        submitHandler:function(res)
        {
          $('#overlay2').show();
          var data = $('#PatientFormE').serializeArray();
          $.ajax({
                type: "POST",
                url:"<?php echo base_url();  ?>Master/patient_master",
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
                        setTimeout(function(){ window.location.href='<?php echo base_url(); ?>Master/patient/patient'; }, 1000);
                        $('#formemodalE').modal('toggle');
                        $('#PatientFormE').clear();

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