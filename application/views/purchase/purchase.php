<div class="clearfix"></div>
  
  <div class="content-wrapper">
    <div class="container-fluid">
    <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
        <h4 class="page-title">Purchase</h4>  
     </div>
     </div>
    <!-- End Breadcrumb-->
      <div class="row">
          <div class="col-lg-12">
            <!-- End Breadcrumb-->
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Purchase Order
            </div>
            <div class="card-body">
              <form id="billingForm" method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card card-body">
                        <h6>Vendor Information</h6>
                        <hr>
                          <input type="hidden" name="action" value="C">
                          <div class="row">
                            <div class="col-md-3">
                                 <div id="patient_id_area" class="form-group">
                                      <label for="input-1">Vendor</label>
                                       <select onchange="get_patient_details(this.value)" name="patient_id" class="form-control" >
                                        <option value="">Search Vendor</option>
                                        <?php
                                        foreach($vendor_list as $key=>$value)
                                        {
                                          ?>
                                          <option value="<?php echo $value['id'];  ?>"><?php echo $value['vendor_name'];
                                            if(!empty($value['vendor_firm']))
                                            {
                                              echo '['.$value['vendor_firm'].']';
                                            }
                                            ?></option>
                                          <?php
                                        }
                                        ?>
                                       </select>
                                  </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                 <label for="input-1">Invoice No.</label>
                                 <input type="text" name="qty" class="form-control">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                 <label for="input-1">Invoice Copy</label>
                                 <input type="file" name="qty" class="form-control">
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="form-group">
                                <label for="input-1">Purchase Date</label>
                                 <input type="text" value="<?php echo date('m/d/Y'); ?>" id="autoclose-datepicker" name="billing_date" class="form-control" >
                              </div>
                            </div>
                            <div class="col-md-1">
                              <div class="form-group text-right">
                                <label for="input-1">Add Item</label>
                                 <button type="button" class="btn btn-success btn-sm mt-0">+</button>
                              </div>
                            </div>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card card-body">
                        <h6>Item Information</h6>
                        <hr>
                          <div id="item_area">
                              <div class="row">
                                <div class="col-md-3">
                                  <div class="form-group">
                                     <label for="input-1">Item</label>
                                     <select onchange="getTest_listBy_category(this.value)" name="category_id" class="form-control" >
                                      <option value="">Select Category</option>
                                      <?php
                                            foreach($product_list as $key=>$value)
                                            {
                                              ?>
                                              <option value="<?php echo $value['id'];  ?>"><?php echo $value['product_name']; ?></option>
                                              <?php
                                            }
                                        ?>
                                     </select>
                                  </div>
                                </div>
                                <div class="col-md-2">
                                  <div class="form-group">
                                     <label for="input-1">Rate</label>
                                     <input type="number" name="rate" class="form-control">
                                  </div>
                                </div>
                                <div class="col-md-2">
                                  <div class="form-group">
                                     <label for="input-1">Qty</label>
                                     <input type="number" name="qty" class="form-control">
                                  </div>
                                </div>
                                <div class="col-md-1">
                                  <div class="form-group">
                                     <label for="input-1">Unit</label>
                                     <select onchange="calculateNow()" name="tax_rate" class="form-control" >
                                      <option value="pcs">Pcs</option>
                                      <option value="kg">Kg</option>
                                     </select>
                                   </div>
                                </div>
                                <div class="col-md-2">
                                  <div class="form-group">
                                     <label for="input-1">HSN</label>
                                     <input type="text" name="qty" class="form-control">
                                  </div>
                                </div>
                                <div class="col-md-1">
                                  <div class="form-group">
                                     <label for="input-1">Tax Rate</label>
                                     <select onchange="calculateNow()" name="tax_rate" class="form-control" >
                                      <option value="0">0%</option>
                                      <option value="5">5%</option>
                                      <option value="12">12%</option>
                                      <option value="18">18%</option>
                                      <option value="27">27%</option>
                                     </select>
                                   </div>
                                </div>
                                <div class="col-md-1">
                                  <div class="form-group">
                                    <label for="input-1">Remove</label>
                                     <button type="button" class="btn btn-danger btn-sm mt-0">x</button>
                                  </div>
                                </div>
                              </div>
                          </div>
                      </div>
                    </div>
                  </div>


                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card card-body">
                        <h6>Invoicing</h6>
                        <hr>
                          <div class="row">
                            <div class="col-md-3">
                                 <div class="form-group">
                                      <label for="input-1">Total Rs.</label>
                                       <input class="form-control" step="any" placeholder="Collection Charge" type="number" value="0.00" name="test_total">
                                       <input type="hidden" value="0.00" name="test_total_amount">
                                  </div>
                            </div>
                            <div class="col-md-3">
                                 <div class="form-group">
                                   <label for="input-1">Tax Type</label>
                                   <select name="tax_type" class="form-control" >
                                    <option value="1">IGST</option>
                                    <option value="2">CGST/SGST</option>
                                   </select>
                               </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                 <label for="input-1">CGST</label>
                                 <input onkeyup="calculateNow()" step="any" class="form-control" placeholder="Discount" value="0.00" type="number" name="discount_amount">
                              </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                   <label for="input-1">SGST</label>
                                   <input type="number" step="any" name="advance_amount" onkeyup="calculateNow()" class="form-control" value="0.00" placeholder="Advance Amount">
                                 </div>
                            </div>
                            <div class="col-md-3">
                                 <div class="form-group">
                                      <label for="input-1">IGST</label>
                                       <input onkeyup="calculateNow()" class="form-control" step="any" placeholder="Collection Charge" type="number" value="0.00" name="collection_charge">
                                  </div>
                            </div>

                            <div class="col-md-3">
                                 <div class="form-group">
                                      <label for="input-1">Transport Charge</label>
                                       <input onkeyup="calculateNow()" class="form-control" step="any" placeholder="Collection Charge" type="number" value="0.00" name="collection_charge">
                                  </div>
                            </div>

                            <div class="col-md-3">
                                 <div class="form-group">
                                      <label for="input-1">Cartage Charge</label>
                                       <input onkeyup="calculateNow()" class="form-control" step="any" placeholder="Collection Charge" type="number" value="0.00" name="collection_charge">
                                  </div>
                            </div>
                            <div class="col-md-3">
                                 <div class="form-group">
                                      <label for="input-1">Other</label>
                                       <input onkeyup="calculateNow()" class="form-control" step="any" placeholder="Collection Charge" type="number" value="0.00" name="collection_charge">
                                  </div>
                            </div>
                            
                            
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                   <label for="input-1">Grand Total Rs.</label>
                                   <input type="number" step="any" name="grand_total" class="form-control" value="0.00" placeholder="Grand Total">
                                 </div>
                            </div>
                            <div class="col-md-3">
                                 <div class="form-group">
                                   <label for="input-1">Cash/Credit</label>
                                   <select onchange="payment_mode_change(this.value)" name="payment_mode" class="form-control" >
                                    <option value="cash">Cash</option>
                                    <option value="online">Credit</option>
                                   </select>
                              </div>
                            </div>
                            <div id="transaction_id_area" class="col-md-3">
                                 <div class="form-group">
                                   <label for="input-1">Due Date</label>
                                   <input type="date" id="date-picker" name="transaction_id" class="form-control" >
                                  </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group">
                                   <label for="input-1"></label>
                                   <button type="submit" class="btn btn-md btn-primary mt-4 pull-right">Submit & Print</button>
                                 </div>
                            </div>
                          </div>
                          
                      </div>
                    </div>
                  </div>
              </form>


              
            </div>
          </div>
        </div>
      </div><!-- End Row-->
        </div>
      </div>

    </div>
    <!-- End container-fluid-->
                

    <div class="overlay"></div>
    
   </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
<input type="hidden" value="<?php echo date('dmYHis'); ?>" name="unique_no">
  <script type="text/javascript">
    var test_array = [];
    $(document).ready(function(){
      $('#overlay2').hide();

    });
    defaultRun();
    function defaultRun()
    {
      $('#patient_name_area').hide();
      $('#patient_id_area').show();
      $('#transaction_id_area').hide();
      $('input[name=test_total]').prop('disabled',true);
      $('input[name=taxable_amount]').prop('disabled',true);
      $('input[name=tax_amount]').prop('disabled',true);
      $('input[name=grand_total]').prop('disabled',true);

    }
    function get_patient_details(id)
    {
      if(id!='')
      {
          $.ajax({
              type:'POST',
              url:'<?php echo base_url(); ?>Billing/get_patient_details',
              data:{id: id},
              success:function(res)
              {
                res = JSON.parse(res);
                if(res.response_code==200)
                { 
                  console.log(res.response_data);
                  $('select[name=patient_title]').val(res.response_data[0]['title']).trigger('change');
                  // $('#patient_name').val();
                  $('input[name=patient_age]').val(res.response_data[0]['age']);
                  $('select[name=patient_sex]').val(res.response_data[0]['sex']).trigger('change');
                  $('input[name=patient_mobile]').val(res.response_data[0]['mobile']);
                  $('input[name=patient_email]').val(res.response_data[0]['email']);
                  $('input[name=patient_address]').val(res.response_data[0]['address']);
                }else
                {
                  $('select[name=patient_title]').val('Mr.').trigger('change');
                  // $('#patient_name').val();
                  $('input[name=patient_age]').val('');
                  $('select[name=patient_sex]').val('Male').trigger('change');
                  $('input[name=patient_mobile]').val('');
                  $('input[name=patient_email]').val('');
                  $('input[name=patient_address]').val('');
                }
                console.log(res);
              }
            });
      }
      
    }


    function patient_type_change(val)
    {
      if(val==0)
      {
        $('#patient_name_area').hide();
        $('#patient_id_area').show();
        $('select[name=patient_id]').val('').trigger('change');
      }else if(val==1)
      {
        $('#patient_name_area').show();
        $('#patient_id_area').hide();
        $('select[name=patient_title]').val('Mr.').trigger('change');
        $('input[name=patient_name]').val('');
        $('input[name=patient_age]').val('');
        $('select[name=patient_sex]').val('Male').trigger('change');
        $('input[name=patient_mobile]').val('');
        $('input[name=patient_email]').val('');
        $('input[name=patient_address]').val('');
      }
    }

    function setGenderByTitle(val)
    {
      if(val=='Miss.' || val=='Mrs.')
      {
        $('select[name=patient_sex]').val('Female').trigger('change');
      }else if(val=='Mr.')
      {
        $('select[name=patient_sex]').val('Male').trigger('change');
      }
    }

    function getTest_listBy_category(cat_id)
    {
      $('#show_test_area').html('');
      $.ajax({
        type:'POST',
        url:'<?php echo base_url(); ?>Billing/get_test_list_by_category',
        data:{category_id: cat_id},
        success:function(res)
        {
          res = JSON.parse(res);
          if(res.response_code==200)
          {
            $.each(res.response_data,function(ind,val){
              $('#show_test_area').append('<div id="'+val.test_name+'|'+val.id+'|'+val.rate+'" onclick="addToWishList(this.id)" class="btn btn-sm pt-3 btn-info m-1">'+
                '<strong>'+val.test_name+' [Rs.'+val.rate+']</strong>'+
              '</div>');
            })
          }
        }
      });
    }

    function payment_mode_change(mode)
    {
        if(mode=='cash')
            $('#transaction_id_area').hide();
        else if(mode=='online')
            $('#transaction_id_area').show();
    }
    var tc = 0;
    function addToWishList(id)
    {
      id = id.split('|');
      test_array[tc] = id[2];
        $('#cart_test_area').append('<div id="test_row_'+tc+'" class="btn btn-sm pt-3 btn-info m-1">'+
        '<strong>'+id[0]+'[Rs.'+id[2]+']</strong>'+
        '<span onclick="removeMe('+tc+')" class="close pl-2">X</span>'+
        '<input type="hidden" name="test_array[]" value="'+id[1]+'">'+
      '</div>');
      tc++;
      calculateTotalInvoice(test_array);
    }
    function removeMe(row)
    {
      $('#test_row_'+row).remove();
      test_array[row]=0;
      calculateTotalInvoice(test_array)
      
      
    }
    function calculateNow()
    {
      calculateTotalInvoice(test_array);
    }
    function calculateTotalInvoice(test_array)
    { 
      var tax_allow = 1;
      var principle_amount = 0;

      var discount_amount = parseFloat($('input[name=discount_amount]').val());
      var collection_charge = parseFloat($('input[name=collection_charge]').val());
      var tax_type = $('select[name=tax_type]').val();
      var tax_rate = $('select[name=tax_rate]').val();
      var advance_amount = parseFloat($('input[name=advance_amount]').val());
      console.log(tax_rate);
      console.log(discount_amount);
      if(isNaN(collection_charge))
            collection_charge = 0.00;
      if(isNaN(discount_amount))
            discount_amount = 0.00;
      if(isNaN(advance_amount))
            advance_amount = 0.00;
      if(isNaN(tax_rate))
            tax_rate = 0;

      $.each(test_array,function(ind,val){
          principle_amount += parseFloat(val);
      });
      $('input[name=test_total]').val(principle_amount);
      $('input[name=test_total_amount]').val(principle_amount);
      if(tax_allow==1)
      {
        var taxable_amount = principle_amount - discount_amount;
            $('input[name=taxable_amount]').val(taxable_amount);
            tax_amount = taxable_amount*(tax_rate/100);

            $('input[name=tax_amount]').val(parseFloat(tax_amount));
            grand_total = taxable_amount+tax_amount+collection_charge;
            $('input[name=grand_total]').val(grand_total);
      }else if(tax_allow==0)
      {
        
      }
      console.log(principle_amount);
    }

  $('#billingForm').submit(function(e){
    e.preventDefault();
    var data = $('#billingForm').serializeArray();
    console.log(data);
    $.ajax({
      type:'POST',
      url:'<?php echo base_url(); ?>Billing/create_billing',
      data:data,
      success:function(res)
      {
          res = JSON.parse(res);
          if(res.response_code == 200){
             $('#overlay2').hide();
              swal("SUCCESS!", ''+res.Message+'', "success");
              setTimeout(function(){ window.location.href='<?php echo base_url(); ?>Billing/billing'; }, 1000);
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

  });



  </script>