<div class="clearfix"></div>
  
  <div style="background: #F3FCFB!important;padding-top: 125px;" class="content-wrapper">
    <div class="container-fluid">
    <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
        <h4 class="page-title">Test Market</h4>
        
     </div>
     <!-- <div class="col-sm-3">
       <div class="btn-group float-sm-right">
        <button type="button" class="btn btn-outline-primary waves-effect waves-light"><i class="fa fa-cog mr-1"></i> Create</button>
        <button type="button" class="btn btn-outline-primary dropdown-toggle dropdown-toggle-split waves-effect waves-light" data-toggle="dropdown">
        <span class="caret"></span>
        </button>
        <div class="dropdown-menu">
          <button data-toggle="modal" data-target="#formemodal" class="dropdown-item">New</button>
        </div>
      </div>
     </div> -->
     </div>
    <!-- End Breadcrumb-->
      <div class="row">
          <div class="col-lg-12">
            <!-- End Breadcrumb-->
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Test Market</div>
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
                          <span onclick="import_now(<?php echo $value['id'] ?>)" class="btn btn-sm btn-success" style="cursor:pointer;">
                          <i title="Create Sub Test" style="cursor: pointer;" class="fa fa-plus-square-o"></i>
                          IMPORT
                          </span>
                          <span class="btn btn-sm btn-info" data-toggle="modal" data-target="#formemodal3" onclick="open_sub_test('<?php echo $value['id'] ?>')" style="cursor:pointer;">
                          <i title="View Sub Test" style="cursor: pointer;" class="fa fa-angle-double-down"></i>
                          DETAILS
                        </span>

                        </td>  
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
               
  

    <div class="overlay"></div>
    
   </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
  <script type="text/javascript">
    $(document).ready(function(){
      $('#overlay2').hide();
    });



    function open_sub_test(id)
    {
      $.ajax({
        type:'POST',
        url:'<?php echo base_url() ?>Master/get_sub_test_market',
        data:{test_id: id},
        success:function(res)
        {
          $('#sub_test_table').html(res);
        }
      });
    }

    function import_now(id)
    {
      $.ajax({
        type:'POST',
        url:'<?php echo base_url() ?>Master/import_test_market',
        data:{test_id: id},
        success:function(res)
        {
          res = JSON.parse(res);
          if(res.status==true)
          {
            swal("success","Successfully Imported To Your Account","success");
            setTimeout(()=>{location.href='<?php echo base_url();?>Master/test_market';})
          }else
          {
            swal("error","Failed To Import To Your Account","error");
          }
          console.log(res);
        }
      });
    }



  </script>