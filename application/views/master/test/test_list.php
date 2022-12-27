<div class="clearfix"></div>
  
  <div style="background: #F3FCFB!important;padding-top: 125px;" class="content-wrapper">
    <div class="container-fluid">
    <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
        <h4 class="page-title">Test</h4>
        
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
            <div class="card-header"><i class="fa fa-table"></i> Test List</div>
            <div class="card-body">
              <div  class="table-responsive">
              <table id="default-datatable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sl. No.</th>
                        <th>Category</th>
                        <th>Test</th>
                        <th>Rate</th>
                        <th>Action</th>
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
                        <td><?php echo $value['test_name'] ?></td>
                        <td><?php echo $value['rate'] ?></td>
                        <td>
                          
                          <i title="Create Sub Test" data-toggle="modal" data-target="#formemodalS" onclick="add_subtest_model(<?php echo $value['id'] ?>)" style="cursor: pointer;" class="fa fa-plus-square-o"></i>
                          <i title="View Sub Test" style="cursor: pointer;"data-toggle="modal" data-target="#formemodal3" onclick="open_sub_test('<?php echo $value['id'] ?>')" class="fa fa-angle-double-down"></i>
                        <i title="Modify Test" data-toggle="modal" data-target="#formemodalE"  style="cursor: pointer;" onclick="modify_category(<?php echo $value['id'] ?>)"  class="icon-pencil icons"></i>

                        <i title="Delete Test" onclick="delete_category(<?php echo $value['id'] ?>)" style="cursor: pointer;" class="icon-trash icons"></i></td>  
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

     <!-- Details Modal -->
                <div style="padding-top: 125px;" class="modal fade" id="formemodal3">
                  <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Sub Test List</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div id="sub_test_table" class="modal-body">
                          
                          
                                  
                               
                      </div>
                    </div>
                  </div>
                </div>
     <!-- Add Modal -->
                <div style="padding-top: 125px;" class="modal fade" id="formemodalS">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Create Sub Test</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          <form id="subtestForm">
                            <input type="hidden" name="action" value="C">
                             <div class="form-group">
                               <label for="input-1">Test</label>
                               <select name="test_id" id="test_id_subtest" class="form-control">
                                <?php
                                foreach($result as $key=>$value)
                                {
                                  ?>
                                  <option value="<?php echo $value['id'] ?>"><?php echo $value['test_name'] ?></option>
                                  <?php
                                }
                                ?>
                               </select>
                             </div>
                             <div class="form-group">
                               <label for="input-1">Sub Test Name</label>
                               <input type="text" name="sub_test_name" class="form-control"  placeholder="Enter Your Sub Test">
                             </div>
                             <div class="form-group">
                               <label for="input-1">Unit</label>
                                <select name="unit_id" class="form-control">
                                <?php 
                                  foreach($unit_list as $keyU=>$valU)
                                  {
                                    ?>
                                    <option value="<?php echo $valU['id']; ?>"><?php echo $valU['unit']; ?></option>
                                    <?php
                                  }
                                 ?>
                              </select>
                             </div>
                             <div class="form-group">
                               <label for="input-1">Reference</label>
                               <input type="text" name="test_reference_id" class="form-control"  placeholder="Enter Test Reference">
                             </div>
                             <div class="form-group">
                               <label for="input-1">Result Box</label>
                                <select name="result_box" class="form-control">
                                <?php 
                                  foreach($result_box_list as $keyR=>$valR)
                                  {
                                    ?>
                                    <option title="<?php echo $valR['box_details']; ?>" value="<?php echo $valR['id']; ?>"><?php echo $valR['input_box_name']; ?></option>
                                    <?php
                                  }
                                 ?>
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
     <!-- Add Modal -->
                <div style="padding-top: 125px;" class="modal fade" id="formemodal">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Create Test</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          <form id="categoryForm">
                            <input type="hidden" name="action" value="C">
                             <div class="form-group">
                               <label for="input-1">Category</label>
                               <select name="category_id" class="form-control">
                                <?php
                                foreach($category_list as $key=>$value)
                                {
                                  ?>
                                  <option value="<?php echo $value['id'] ?>"><?php echo $value['category_name'] ?></option>
                                  <?php
                                }
                                ?>
                               </select>
                             </div>
                             <div class="form-group">
                               <label for="input-1">Test</label>
                               <input type="text" name="test_name" class="form-control"  placeholder="Enter Your Test">
                             </div>
                             <div class="form-group">
                               <label for="input-1">Rate</label>
                               <input type="number" step="any" name="rate" class="form-control"  value="0.00" placeholder="Enter Test Rate">
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
                        <h5 class="modal-title">Modify Test</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          <form id="categoryFormE">
                            <input type="hidden" name="action" value="U">
                            <input type="hidden" name="test_id" id="test_id">
                             <div class="form-group">
                               <label for="input-1">Category</label>
                               <select name="category_id" class="form-control" id="category_id">
                                <?php
                                foreach($category_list as $key=>$value)
                                {
                                  ?>
                                  <option value="<?php echo $value['id'] ?>"><?php echo $value['category_name'] ?></option>
                                  <?php
                                }
                                ?>
                               </select>
                             </div>
                             <div class="form-group">
                               <label for="input-1">Test</label>
                               <input type="text" name="test_name" class="form-control" id="test_name" placeholder="Enter Your Test">
                             </div>
                             <div class="form-group">
                               <label for="input-1">Rate</label>
                               <input type="number" step="any" name="rate" class="form-control" id="rate" value="0.00" placeholder="Enter Test Rate">
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
            category_id: "required",
            test_name: "required",
            rate: "required",
        },
        messages: {
            category_id: "Please select category name",
            test_name: "Please enter test name",
            rate: "Please enter test rate",
        },
        submitHandler:function()
        {
          $('#overlay2').show();
          var data = $('#categoryForm').serializeArray();
          $.ajax({
                type: "POST",
                url:"<?php echo base_url();  ?>Master/test_master",
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
                        setTimeout(function(){ window.location.href='<?php echo base_url(); ?>Master/test'; }, 1000);
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
                        url:"<?php echo base_url();  ?>Master/test_master",
                              data:{action: 'D',test_id: id},
                              headers: {
                                     "x-api-key": "admin@123",
                                   },
                              success:function(res)
                              {
                                res = JSON.parse(res);
                                  if(res.response_code == 200){
                                     $('#overlay2').hide();
                                      swal("SUCCESS!", ''+res.Message+'', "success");
                                      setTimeout(function(){ window.location.href='<?php echo base_url(); ?>Master/test'; }, 1000);
                                      
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
          url:"<?php echo base_url();  ?>Master/test_master",
                data:{action: 'R',test_id: id},
                headers: {
                       "x-api-key": "admin@123",
                     },
                success:function(res)
                {
                  res = JSON.parse(res);
                    if(res.response_code == 200){
                       $('#overlay2').hide();
                        $('#category_id').val(res.response_data[0]['category_id']);
                        $('#test_name').val(res.response_data[0]['test_name']);
                        $('#rate').val(res.response_data[0]['rate']);
                        $('#test_id').val(res.response_data[0]['id']);
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
            category_id: "required",
            test_name: "required",
            rate: "required",
        },
        messages: {
            category_id: "Please select category name",
            test_name: "Please enter test name",
            rate: "Please enter test rate",
        },
        submitHandler:function()
        {
          $('#overlay2').show();
          var data = $('#categoryFormE').serializeArray();
          $.ajax({
                type: "POST",
                url:"<?php echo base_url();  ?>Master/test_master",
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
                        setTimeout(function(){ window.location.href='<?php echo base_url(); ?>Master/test'; }, 1000);
                        $('#formemodalE').modal('toggle');

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

    $('#subtestForm').submit(function(e){
      e.preventDefault();
      $("#subtestForm").validate({
        rules: {
            test_id: "required",
            sub_test_name: "required",
            unit_id: "required",
            result_box: "required",
        },
        messages: {
            test_id: "Please select category name",
            sub_test_name: "Please enter sub test name",
            unit_id: "Please select unit",
            result_box: "Please select result box",
        },
        submitHandler:function()
        {
          $('#overlay2').show();
          var data = $('#subtestForm').serializeArray();
          console.log(data);
          $.ajax({
                type: "POST",
                url:"<?php echo base_url();  ?>Master/create_sub_test",
                data:data,
                success:function(res)
                {
                    res = JSON.parse(res);
                    if(res.response_code == 200){
                       $('#overlay2').hide();
                        swal("SUCCESS!", ''+res.Message+'', "success");
                        setTimeout(function(){ window.location.href='<?php echo base_url(); ?>Master/test'; }, 1000);
                        $('#formemodalE').modal('toggle');

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
// gui functions
    function edit_btn_click(id)
    {
      var delete_btn = $('#delete_btn_'+id);
      var edit_btn = $('#edit_btn_'+id);
      var update_btn = $('#update_btn_'+id);
      var close_btn = $('#close_btn_'+id);
      var lbl_sub_test = $('#lbl_sub_test_'+id);
      var inp_sub_test = $('#inp_sub_test_'+id);
      var lbl_unit = $('#lbl_unit_'+id);
      var inp_unit = $('#inp_unit_'+id);
      var lbl_reference = $('#lbl_reference_'+id);
      var inp_reference = $('#inp_reference_'+id);
      var lbl_result_box = $('#lbl_result_box_'+id);
      var inp_result_box = $('#inp_result_box_'+id);
      edit_btn.hide();
      delete_btn.hide();
      lbl_sub_test.hide();
      lbl_unit.hide();
      lbl_reference.hide();
      lbl_result_box.hide();

      update_btn.show();
      close_btn.show();
      inp_sub_test.show();
      inp_unit.show();
      inp_reference.show();
      inp_result_box.show();
    }

    function close_btn_click(id)
    {
      swal({
              title: "Are you sure?",
              text: "To discard the changes!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                 
                var delete_btn = $('#delete_btn_'+id);
                var edit_btn = $('#edit_btn_'+id);
                var update_btn = $('#update_btn_'+id);
                var close_btn = $('#close_btn_'+id);
                var lbl_sub_test = $('#lbl_sub_test_'+id);
                var inp_sub_test = $('#inp_sub_test_'+id);
                var lbl_unit = $('#lbl_unit_'+id);
                var inp_unit = $('#inp_unit_'+id);
                var lbl_reference = $('#lbl_reference_'+id);
                var inp_reference = $('#inp_reference_'+id);
                var lbl_result_box = $('#lbl_result_box_'+id);
                var inp_result_box = $('#inp_result_box_'+id);
                edit_btn.show();
                delete_btn.show();
                lbl_sub_test.show();
                lbl_unit.show();
                lbl_reference.show();
                lbl_result_box.show();

                update_btn.hide();
                close_btn.hide();
                inp_sub_test.hide();
                inp_unit.hide();
                inp_reference.hide();
                inp_result_box.hide();
                setTimeout(function(){ window.location.href='<?php echo base_url(); ?>Master/test'; }, 1000);
                  $('#formemodal3').modal('toggle');

              } else {
                
              }
            });
      
    }

    function open_sub_test(id)
    {
      $.ajax({
        type:'POST',
        url:'<?php echo base_url() ?>Master/get_sub_test',
        data:{test_id: id},
        success:function(res)
        {
          $('#sub_test_table').html(res);
        }
      });
    }

    function update_sub_test(id)
    {
       $('#overlay2').show();
      var sub_test_id = $('#hdn_id_'+id).val();
      var sub_test_name = $('#inp_sub_test_'+id).val();
      var unit_id = $('#inp_unit_'+id).val();
      var test_reference_id = $('#inp_reference_'+id).val();
      var result_box = $('#inp_result_box_'+id).val();

      $.ajax({
        type:'POST',
        url:'<?php echo base_url(); ?>Master/update_sub_test',
        data:{
          sub_test_name: sub_test_name,
          unit_id: unit_id,
          test_reference_id: test_reference_id,
          result_box: result_box,
          id: sub_test_id,
        },
        success:function(res)
        {
           res = JSON.parse(res);
           if(res.response_code==200)
           {
              $('#overlay2').hide();
              swal("SUCCESS!", ''+res.Message+'', "success");
              setTimeout(function(){ window.location.href='<?php echo base_url(); ?>Master/test'; }, 1000);
              $('#formemodal3').modal('toggle');
           }else
           {
              $('#overlay2').hide();
              swal("ERROR!", ''+res.Message+'', "error");
           }
         
        }
      });

    }

    function delete_sub_test(id)
    {

      swal({
              title: "Are you sure?",
              text: "To delete the sub test !",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                 
                $('#overlay2').show();
                  var sub_test_id = $('#hdn_id_'+id).val();
                  $.ajax({
                    type:'POST',
                    url:'<?php echo base_url(); ?>Master/delete_sub_test',
                    data:{
                      id: sub_test_id,
                    },
                    success:function(res)
                    {
                       res = JSON.parse(res);
                       if(res.response_code==200)
                       {
                          $('#overlay2').hide();
                          swal("SUCCESS!", ''+res.Message+'', "success");
                          setTimeout(function(){ window.location.href='<?php echo base_url(); ?>Master/test'; }, 1000);
                          $('#formemodal3').modal('toggle');
                       }else
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
  function add_subtest_model(id)
  {
    // $('#test_id_subtest').prop('disabled',true);
    $('#test_id_subtest').val(id).trigger('change');
  }
  </script>