
<div class="clearfix"></div>
<div style="background: #F3FCFB!important;padding-top: 125px;" class="content-wrapper">
   <div class="container-fluid">
      <!-- Breadcrumb-->
      <div class="row pt-2 pb-2">
         <div class="col-sm-9">
            <h4 class="page-title">Report Create</h4>
         </div>
      </div>
      <!-- End Breadcrumb-->
      
      <div class="row">
         <div class="col-lg-12">
            <!-- End Breadcrumb-->
            <div class="row">
               <div class="col-lg-12">
                  <div class="card">
                     <div class="card-header"><i class="fa fa-table"></i> Report
                     </div>
                     <div class="card-body">
                       <div class="row">
                         <div class="col-md-4">
                           <span>Patient : <?php echo $basic_data[0]['patient_name']; ?></span>
                         </div>
                         <div class="col-md-3">
                           <span>Age : <?php 

                            if(!empty($basic_data[0]['age']))
                            {
                              echo $basic_data[0]['age'].' Years ';
                            }
                            if(!empty($basic_data[0]['month']))
                            {
                              echo $basic_data[0]['month'].' Months ';
                            }
                            ?></span>
                         </div>
                         <div class="col-md-3">
                           <span>Sex : <?php echo $basic_data[0]['sex']; ?></span>
                         </div>
                         <div class="col-md-3">
                           <span>Mobile : <?php echo $basic_data[0]['mobile']; ?></span>
                         </div>
                         <div class="col-md-3">
                           <span>Billing Date : <?php echo date('d-m-Y',strtotime($basic_data[0]['billing_date'])); ?></span>
                         </div>
                         <div class="col-md-3">
                           <span>Refered By : <?php echo $basic_data[0]['vendor_name']; ?></span>
                         </div>
                         <div class="col-md-3">
                           <span>Billing No : <?php echo $this->uri->segment(3); ?></span>
                         </div>
                       </div>
                     </div>
                     <div class="card-body">
                        <form id="reportForm" method="post" enctype="multipart/form-data">
                          <input type="hidden" value="<?php echo $this->uri->segment(3); ?>" name="ref_no">
                          <div class="row">
                            <div class="col-sm-4">
                                 <div class="card card-body">
                                  <label>Report Date</label>
                                  <input type="date" name="report_date" class="form-control" value="<?php if(isset($basic_data[0]['report_date']) && $basic_data[0]['report_date']!=""){echo date('Y-m-d',strtotime($basic_data[0]['report_date']));}else{ echo date('Y-m-d');} ; ?>">
                                 </div>
                             </div>
                              <div class="col-md-4">
                              <div class="card card-body">
                               <span>Refered By : <?php echo $basic_data[0]['vendor_name']; ?></span>
                               <select name="vendor_id" class="select2">
                                 <?php  foreach ($vendor_list as $key => $value) {
                                   ?>
                                   <option <?php if($value['id']==$basic_data[0]['vendor_id']){echo 'selected="selected"';} ?>  value="<?php echo $value['id']; ?>"><?php echo $value['vendor_name']; ?></option>
                                   <?php
                                 }  ?>
                               </select>
                             </div>
                             </div>
                          </div>
                           <?php
                              foreach($test_details as $key=>$value)
                              {
                                ?>
                           <div class="row">
                              <div class="col-sm-12">
                                 <div class="card card-body">
                                    <h5><?php echo $value['category_name']; ?></h5>
                                    <hr>
                                    <?php
                                       foreach($value['test_list'] as $key2=>$value2)
                                       {

                                        if($value2['important']==1)
                                        {

                                          ?>
                                          <hr>
                                            <div class="row">
                                               <div class="col-sm-12 text-center">
                                                  <div class="form-group">
                                                     <h6><u><?php echo $value2['test_name']; ?></u></h6>
                                                     <p style="text-align: left;">Slide agglutination test for Salmonella group of organisms reveal following titers.</p>
                                                     <hr>
                                                  </div>
                                               </div>
                                            </div>
                                            <?php
                                           foreach($value2['sub_test'] as $key3=>$value3)
                                           {
                                                 ?>
                                                <div class="row">
                                                  <input type="hidden" name="w_b_test_id[]" value="<?php echo $value2['b_test_id']; ?>">
                                                   <div class="col-md-2">
                                                      <div class="form-group">
                                                         <label for="input-1">Sub Test</label>
                                                         <input type="text" value='<?php echo $value3['sub_test_name']; ?>' name="w_sub_test_name[]" class="form-control" >
                                                         <input type="hidden" name="w_b_sub_test_id[]" value="<?php echo $value3['sub_test_id']; ?>">
                                                      </div>
                                                   </div>
                                                   <div class="col-md-2">
                                                      <div class="form-group text-center">
                                                         <label for="input-1">1:20</label>
                                                         <input  type="text" value="<?php 
                                                         if(isset($value3['res_one_20']))
                                                         {
                                                          echo $value3['res_one_20'];
                                                         }else
                                                         {
                                                          echo '-';
                                                         }?>" name="w_test_result_20[]" class="form-control check_plus" >
                                                      </div>
                                                   </div>
                                                   <div class="col-md-2">
                                                      <div class="form-group text-center">
                                                         <label for="input-1">1:40</label>
                                                         <input type="text" value="<?php 
                                                         if(isset($value3['res_one_40']))
                                                         {
                                                          echo $value3['res_one_40'];
                                                         }else
                                                         {
                                                          echo '-';
                                                         }?>" name="w_test_result_40[]" class="form-control check_plus" >
                                                      </div>
                                                   </div>
                                                   <div class="col-md-2">
                                                      <div class="form-group text-center">
                                                         <label for="input-1">1:80</label>
                                                         <input type="text" value="<?php 
                                                         if(isset($value3['res_one_80']))
                                                         {
                                                          echo $value3['res_one_80'];
                                                         }else
                                                         {
                                                          echo '-';
                                                         }?>" name="w_test_result_80[]" class="form-control check_plus" >
                                                      </div>
                                                   </div>
                                                   <div class="col-md-2">
                                                      <div class="form-group text-center">
                                                         <label for="input-1">1:160</label>
                                                         <input type="text" value="<?php 
                                                         if(isset($value3['res_one_160']))
                                                         {
                                                          echo $value3['res_one_160'];
                                                         }else
                                                         {
                                                          echo '-';
                                                         }?>" name="w_test_result_160[]" class="form-control check_plus" >
                                                      </div>
                                                   </div>
                                                   <div class="col-md-2">
                                                      <div class="form-group text-center">
                                                         <label for="input-1">1:320</label>
                                                         <input type="text" value="<?php 
                                                         if(isset($value3['res_one_320']))
                                                         {
                                                          echo $value3['res_one_320'];
                                                         }else
                                                         {
                                                          echo '-';
                                                         }?>" name="w_test_result_320[]" class="form-control check_plus" >
                                                      </div>
                                                   </div>
                                                  
                                                </div>
                                                <?php
                                           }

                                        }else
                                        {
                                          // not important
                                        ?>
                                            <hr>
                                            <div class="row">
                                               <div class="col-sm-12 text-center">
                                                  <div class="form-group">
                                                     <h6><u><?php echo $value2['test_name']; ?></u></h6>
                                                     <hr>
                                                  </div>
                                               </div>
                                            </div>
                                            <?php
                                           foreach($value2['sub_test'] as $key3=>$value3)
                                           {
                                                 ?>
                                                <div class="row">
                                                  <input type="hidden" name="n_b_test_id[]" value="<?php echo $value2['b_test_id']; ?>">
                                                  <input type="hidden" name="n_b_sub_test_id[]" value="<?php echo $value3['sub_test_id']; ?>">
                                                   <div class="col-md-4">
                                                      <div class="form-group">
                                                         <label for="input-1">Sub Test</label>
                                                         <input type="text" value='<?php
                                                          if(isset($value3['res_test_name']))
                                                          {
                                                            echo $value3['res_test_name'];
                                                          }else
                                                          {
                                                            echo $value3['sub_test_name'];
                                                          }
                                                           ?>' name="n_sub_test_name[]" class="form-control" >
                                                      </div>
                                                   </div>
                                                   <div class="col-md-3">
                                                      <div class="form-group">
                                                         <label for="input-1">Result</label>
                                                         <?php
                                                            if($value3['input_type']==1)
                                                            {
                                                             ?>
                                                         <input type="text" name="n_test_result[]"
                                                         value="<?php 
                                                         if(isset($value3['res_result']))
                                                         {
                                                          echo $value3['res_result'];
                                                         }?>" 
                                                          class="form-control" >
                                                         <?php
                                                            }elseif($value3['input_type']==2)
                                                            {
                                                              ?>
                                                         <input type="number" name="n_test_result[]"
                                                         value="<?php 
                                                         if(isset($value3['res_result']))
                                                         {
                                                          echo $value3['res_result'];
                                                         }?>" 
                                                         class="form-control" >
                                                         <?php
                                                            }elseif($value3['input_type']==3)
                                                            {
                                                              $options = explode(',',$value3['box_details']);
                                                               ?>
                                                         <select name="n_test_result[]" class="form-control" >
                                                            <?php
                                                               foreach($options as $key4=>$value4)
                                                               {
                                                                 ?>
                                                            <option 
                                                            <?php
                                                            if(isset($value3['res_result']))
                                                             {
                                                              if($value3['res_result']==$value4)
                                                              {
                                                                echo 'selected="selected"';
                                                              }
                                                              
                                                             }

                                                            ?> value="<?php echo $value4;  ?>">
                                                               <?php
                                                                  echo $value4;
                                                                  ?>
                                                            </option>
                                                            <?php
                                                               }
                                                               ?>
                                                         </select>
                                                         <?php
                                                            }
                                                             ?>
                                                      </div>
                                                   </div>
                                                   <div class="col-md-2">
                                                      <div class="form-group">
                                                         <label for="input-1">Unit</label>
                                                         <select name="n_test_unit[]"   class="form-control" >
                                                            <option value="">No Unit</option>
                                                            <?php
                                                               foreach($unit_list as $key5=>$value5)
                                                               {
                                                                 ?>
                                                            <option

                                                            <?php

                                                            if(isset($value3['res_unit_id']))
                                                            {
                                                              if($value3['res_unit_id']==$value5['id'])
                                                              {
                                                                echo'selected="selected"';
                                                              }
                                                            }

                                                            ?>
                                                             value="<?php echo $value5['id'];  ?>">
                                                             <?php echo $value5['unit'];
                                                               ?></option>
                                                            <?php
                                                               }
                                                               ?>
                                                         </select>
                                                      </div>
                                                   </div>
                                                   <div class="col-md-3">
                                                      <div class="form-group">
                                                         <label for="input-1">Reference</label>
                                                         <input type="text" name="n_test_reference[]" class="form-control" value="<?php
                                                          if(isset($value3['res_reference']))
                                                          {
                                                            echo $value3['res_reference'];
                                                            }else
                                                            {
                                                              echo $value3['test_reference_id'];
                                                            }
                                                           ?>" placeholder="Enter Patient Age">
                                                      </div>
                                                   </div>
                                                </div>
                                                <?php
                                           }

                                        }
                                         ?>
                                    <?php
                                       }
                                       
                                       ?>
                                 </div>
                              </div>
                           </div>
                           <?php
                              }
                              ?>
                          <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                   <label for="input-1">Remarks</label>
                                   <textarea class="form-control" id="remarks" name="remarks"><?php echo $basic_data[0]['report_remarks']; ?></textarea>
                                </div>
                             </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12 text-right">
                              <button type="submit" class="btn btn-md btn-info" style="font-size:15px;">Save Report</button>
                              <a href="<?php echo base_url().'Dashboard'; ?>">
                                <button type="button" class="btn btn-md btn-warning ml-5" style="font-size:15px;">Go To Home</button>
                              </a>
                            </div>
                          </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
            <!-- End Row-->
         </div>
      </div>
   </div>
   <!-- End container-fluid-->
   <div class="overlay"></div>
</div>
<!--End content-wrapper-->
<!--Start Back To Top Button-->
<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
<!--End Back To Top Button-->
<input type="hidden" value="<?php echo date('dmYHis'); ?>" name="unique_no">
<script type="text/javascript">
   $(document).ready(function(){
     $('#overlay2').hide();
   });
 $('#reportForm').submit(function(e){
    e.preventDefault();
    var data = $('#reportForm').serializeArray();
    $.ajax({
      type:'POST',
      url:'<?php echo base_url(); ?>Report/create_report_now',
      data:data,
      success:function(res)
      {
        res = JSON.parse(res);
        if(res.response_code==200)
        {
          swal('success','Successfully Saved !','success');
        }else
        {
          swal('error','Something went wrong !','error');
        }
      }
    });
    // console.log(data);
 });

 $('.check_plus').keyup(function(){
    var plus =0;
    $('.check_plus').each(function(index,value){

        if(value.value==='+')
        {
          plus++;
        }
        
    });
    if(plus==0)
    {
      $('#remarks').val('No agglutination for Salmonella group of organisms.');
    }else
    {
      $('#remarks').val('');
    }
 });
</script>