<div class="clearfix"></div>
  
  <div style="background: #F3FCFB!important;padding-top: 125px;" class="content-wrapper">
    <div class="container-fluid">
    <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
        <h4 class="page-title">Billing & Test Report</h4>
        
     </div>
     <div class="col-sm-3">
       <div class="btn-group float-sm-right">
        <button type="button" class="btn btn-outline-primary waves-effect waves-light"><i class="fa fa-cog mr-1"></i> Create</button>
        <button type="button" class="btn btn-outline-primary dropdown-toggle dropdown-toggle-split waves-effect waves-light" data-toggle="dropdown">
        <span class="caret"></span>
        </button>
        <div class="dropdown-menu">
          <a href="<?php echo base_url().'Billing/billing';  ?>">
          <button class="dropdown-item">New</button>
          </a>
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
            <div class="card-header"><i class="fa fa-table"></i> Billing & Test Report List</div>
            <div class="card-body">
              <form method="POST" action="<?php base_url().'Billing/billing_list' ?>">
              <div class="row">

                  <div class="col-md-3">
                    <label>From Date</label>
                    <input type="date" value="<?php echo $from_date; ?>" class="form-control" name="from_date" id="from_date">
                  </div>
                  <div class="col-md-3">
                    <label>To Date</label>
                    <input type="date" value="<?php echo $to_date; ?>"  class="form-control" name="to_date" id="to_date">
                  </div>
                  <div class="col-md-3">
                    
                    <button type="submit" style="margin-top:11%;" class="btn btn-sm btn-info">Search</button>
                  </div>
              </div>
              </form>
              <hr>
              
              <div  class="table-responsive">
              <table id="default-datatable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sl. No.</th>
                        <th>Case No.</th>
                        <th>Billing Date</th>
                        <th>Patient</th>
                        <th>Refered By</th>
                        <th>Total</th>
                        <th>Paid</th>
                        
                        <th>Paid Status</th>
                        <th>Payment Link</th>
                        <th>Digital Sign</th>
                        <th>Print Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                      if($billing_list!=105)
                      {
                          foreach($billing_list as $key=>$value)
                          {

                            // print_r($value);die;
                            ?>
                            <tr>
                            <td><?php echo ($key+1);  ?></td>
                            <td><?php echo $value['ref_no']; ?></td>
                            <td><?php echo date('d-m-Y',strtotime($value['billing_date'])); ?></td>
                            <td><?php echo $value['title'].' '.$value['full_name']; ?></td>
                            <td><?php echo $value['vendor_name']; ?></td>
                            <td><?php echo $value['grand_total_amount']; ?></td>
                            <td><?php if(empty($value['paid_amount'])){ echo '0.00';}else{echo $value['paid_amount'];} ?></td>
                            <td><?php if($value['paid_unpaid']==1){echo '<span style="color:green;">Paid</span>';}else{echo '<span style="color:red;">Unpaid</span>';}; ?></td>
                            <td><a class="btn btn-sm btn-info" style="color: blue!important;float: left;" target="_blank" href="<?php echo base_url('Payment/PaymentNow/').$value['ref_no']; ?>">Pay Now</a>
                              <form style="display: none;" id="form_<?php echo $key; ?>"   method="POST" action="#">
                                <input type="hidden" value="<?php echo base_url('Payment/PaymentNow/').$value['ref_no']; ?>" name="payment_link">
                                <input type="hidden" value="<?php echo $value['ref_no']; ?>" name="bill_no">
                                <input type="hidden" value="<?php echo $value['grand_total_amount']; ?>" name="amount">
                                <input type="hidden" value="<?php echo $value['email']; ?>" name="email">
                                <input type="hidden" value="<?php echo $value['clinic_code']; ?>" name="clinic_code">
                              </form>
                              <a class="btn btn-sm btn-info" style="color: blue!important;float: left; margin-left: 2%;" href="#" onclick="emailNow('<?php echo $key; ?>')">Email Now</a>
                              <p style="float: left;"><?php echo base_url('Payment/PaymentNow/').$value['ref_no']; ?></p></td>
                              <td><input <?php if($value['digital_sign']==1){echo 'checked="checked"';}  ?> onchange="updateDigitalSignStatus(this)" name="digitalSign" type="checkbox" id="<?php echo $value['ref_no']; ?>"></td>
                            <td>
                              
                              <select id="<?php echo $value['ref_no']; ?>" onchange="updatePrintStatus(this)" class="form-control">
                                <option <?php if($value['print_status']==0){echo 'selected="selected"';} ?> value="0">Not Print</option>
                                <option <?php if($value['print_status']==1){echo 'selected="selected"';} ?> value="1">Already Print</option>
                              </select>
                            </td>
                            <td style="font-size: 25px;"><i style="font-size:25px;" title="Pay Now" data-toggle="modal" data-target="#formemodal" id="<?php echo $value['ref_no'].'|'.$value['patient_id']; ?>"  style="cursor: pointer;" onclick="update_payment(this.id)"  class="icon-credit-card icons "></i>
                              <i id="<?php echo $value['ref_no']; ?>" title="Payment Statement" onclick="statement_payment(this.id)" style="font-size:25px;" data-toggle="modal" data-target="#formemodal2" class="icon-doc icons" ></i>
                              <a  style="color: darkgreen!important;" target="_blank" href="<?php echo base_url().'Billing/print_bill/'.$value['ref_no']; ?>">
                              <i title="Print Invoice" style="font-size:25px;" class="zmdi zmdi-receipt" ></i>
                              
                              </a>
                              <?php
                              if($value['report_status']==0)
                              {
                                ?>
                                <a style="color: darkgreen!important;" title="Create Report" href="<?php echo base_url().'Report/apointment/'.$value['ref_no']; ?>"><i  aria-hidden="true" class="zmdi zmdi-plus-circle-o"></i></a>
                                <?php
                              }elseif($value['report_status']==1)
                              {
                                ?>
                              <a style="color: darkgreen!important;" href="#">
                              <i title="Print Report" data-toggle="modal" data-target="#formemodaltest" id="<?php echo $value['ref_no']; ?>" onclick="getTestList(this.id)" style="font-size:25px;" class="icon-printer icons" ></i>
                              </a>
                                <a style="color: darkgreen!important;" title="Edit Report" href="<?php echo base_url().'Report/apointment/'.$value['ref_no']; ?>"><i aria-hidden="true" class="zmdi zmdi-edit"></i></a>
                                <?php
                              }
                              ?>
                              <i title="Delete" onclick="delete_billing('<?php echo $value['ref_no'] ?>')" style="cursor: pointer;" style="font-size:25px;" class="icon-trash icons"></i>
                            </td> 
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
      <div style="padding-top: 125px;" class="modal fade" id="formemodal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Payment On <span id="payment_on">BILL002</span></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="paymentForm">
                  <input type="hidden" name="ref_no">
                  <input type="hidden" name="patient_id">
                  <div class="form-group">
                    <label for="input-1">Payment Date</label>
                     <input type="text" value="<?php echo date('m/d/Y'); ?>" id="autoclose-datepicker" name="payment_date" class="form-control" >
                  </div>
                  <div class="form-group">
                         <label for="input-1">Due Amount Rs.</label>
                         <input type="number" step="any" name="due_amount" class="form-control" value="0.00" placeholder="Due Amount">
                  </div>
                  <div class="form-group">
                         <label for="input-1">Pay Amount Rs.</label>
                         <input type="number" step="any" name="pay_amount"  class="form-control" value="0.00" placeholder="Pay Amount">
                  </div>
                  <div class="form-group">
                         <label for="input-1">Payment Mode</label>
                         <select onchange="payment_mode_change(this.value)" name="payment_mode" class="form-control" >
                          <option value="cash">Cash</option>
                          <option value="online">Online</option>
                         </select>
                  </div>
                  <div id="transaction_id_area" class="form-group">
                         <label for="input-1">Transaction Id</label>
                         <input type="text" name="transaction_id" class="form-control" >
                  </div>
                  <div class="form-group">
                       <label for="input-1">Paid/Unpaid</label>
                       <select name="payment_status" class="form-control" >
                        <option value="1">Paid</option>
                        <option value="0">Unpaid</option>
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
                <div style="padding-top: 125px;" class="modal fade" id="formemodal2">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Payment On <span id="payment_on_s">BILL002</span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                         <table class="table table-responsive table-bordered">
                           <tr>
                             <th>Sl. No.</th>
                             <th>Date Time</th>
                             <th>Payment Id</th>
                             <th>Payment Mode</th>
                             <th>Transaction Id</th>
                             <th>Amount</th>
                           </tr>
                           <tbody id="table_statement">
                             
                           </tbody>
                           
                         </table>
                      </div>
                    </div>
                  </div>
                </div>

     <div style="padding-top: 125px;" class="modal fade" id="formemodaltest">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Report Test List <span id="report_ref_no"></span></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="test_list_form" method="POST" action="#" enctype="multipart/form-data">
                  <input type="hidden" name="ref_no" id="ref_no_store">
                    <div class="form-group">
                     <ul id="test_list_area">

                     </ul>
                          <button type="submit" class="btn btn-info btn-md">Save & Preview</button>
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
    <style type="text/css">
      #test_list_form ul li{
        list-style-type: none;
        font-size: 13px;
        padding: 5px;
      }
      #test_list_form button{
        text-align: center;
        margin: 20px;
      }
    </style>
  <script type="text/javascript">
    $(document).ready(function(){
      $('#overlay2').hide();
      $('#transaction_id_area').hide();
    });
    function payment_mode_change(mode)
    {
        if(mode=='cash')
            $('#transaction_id_area').hide();
        else if(mode=='online')
            $('#transaction_id_area').show();
    }


    function update_payment(info)
    {
      info = info.split('|');
      $('#payment_on').html(info[0]);
      $('input[name=ref_no]').val(info[0]);
      $('input[name=patient_id]').val(info[1]);
      $.ajax({
        type:'POST',
        url:'<?php echo base_url();  ?>Billing/get_due_details',
        data:{ref_no: info[0]},
        success:function(res)
        {
          res = JSON.parse(res);
          due = res.response_data;
          $('input[name=due_amount]').prop('disabled',true);
          $('input[name=due_amount]').val(due);
          console.log(due);
        }
      });
    }

  function statement_payment(ref_no)
    {
      $('#payment_on_s').html(ref_no);
      $.ajax({
        type:'POST',
        url:'<?php echo base_url();  ?>Billing/getPaymentStatement',
        data:{ref_no: ref_no},
        success:function(res)
        {
          $('#table_statement').html('');
          res = JSON.parse(res);
          var total = 0;
          $.each(res.response_data,function(ind,val){
            var transaction_no = val.transaction_no;
            total += parseFloat(val.cr_amount);
            $('#table_statement').append('<tr>'+
                             '<td>'+(ind+1)+'</td>'+
                             '<td>'+val.payment_date+'</td>'+
                             '<td>'+val.payment_id+'</td>'+
                             '<td>'+val.mode+'</td>'+
                             '<td>'+val.transaction_no+'</td>'+
                             '<td>'+val.cr_amount+'</td>'+
                           '</tr>');
          });
          $('#table_statement').append('<tr>'+
                             '<td colspan="4"></td>'+
                             '<td>Total</td>'+
                             '<td>'+total+'</td>'+
                           '</tr>');
          console.log(res);
        }
      });
    }

  $('#paymentForm').submit(function(e){
    e.preventDefault();
    var data = $('#paymentForm').serializeArray();
    console.log(data);
    $.ajax({
      type:'POST',
      url:'<?php echo base_url(); ?>Billing/payment_upadate_on_bill',
      data:data,
      success:function(res)
      {
          res = JSON.parse(res);
          if(res.response_code == 200){
             $('#overlay2').hide();
              swal("SUCCESS!", ''+res.Message+'', "success");
              setTimeout(function(){ window.location.href='<?php echo base_url(); ?>Billing/billing_list'; }, 1000);
              $('#paymentForm').modal('toggle');
              $('#paymentForm').clear();

         }
          else
          {
                      $('#overlay2').hide();
                      swal("ERROR!", ''+res.Message+'', "error");
          }
      }
    });

  });
    function delete_billing(id)
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
                        url:"<?php echo base_url();  ?>Billing/deleteBilling",
                              data:{action: 'D',ref_no: id},
                              headers: {
                                     "x-api-key": "admin@123",
                                   },
                              success:function(res)
                              {
                                res = JSON.parse(res);
                                  if(res.response_code == 200){
                                     $('#overlay2').hide();
                                      swal("SUCCESS!", ''+res.Message+'', "success");
                                      setTimeout(function(){ window.location.href='<?php echo base_url(); ?>Billing/billing_list'; }, 1000);
                                      
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

    function getTestList(ref_no)
    {
      $('#test_list_area').html('');
      $('#ref_no_store').val(ref_no);
      $.ajax({
          type:'POST',
          url:'<?php echo base_url();  ?>Billing/get_test_list',
          data:{ref_no: ref_no},
          success:function(res)
          {
              res = JSON.parse(res);
              $.each(res.response_data,function(index,value){
                $('#test_list_area').append('<li>'+
                                 '<input type="checkbox" value="'+value.test_id+'" checked name="test_id[]">'+
                                 '<span>'+value.test_name+' ('+value.category_name+')</span>'+
                               '</li>');
              });
          }
      });
    }

    $('#test_list_form').submit(function(e){

      e.preventDefault();
      var data = $('#test_list_form').serializeArray();
      $.ajax({
        type:'POST',
        url:'<?php echo base_url();  ?>Billing/store_print_details',
        data:data,
        success:function(res)
        {
          res = JSON.parse(res);
          if(res.status==true)
          {
            window.open('<?php echo base_url(); ?>Report/test_report_download/'+res.response_data);
          }
        }
      });

    });
   function updatePrintStatus(ref)
   {
      console.log(ref.id);
      $.ajax({
        type:'POST',
        url:'<?php echo base_url(); ?>Billing/update_print_status_now',
        data:{ref_no: ref.id,print_status: ref.value},
        success:function(res)
        {
          res = JSON.parse(res);
          if(res.status==true)
          {
            swal('success','updated successfully','success');
          }else{
            swal('error','update failed','error');
          }
          console.log(res);

        }
      })
   }

    function updateDigitalSignStatus(ref)
   {
      var status = 0;
      if($(ref).prop('checked')==true)
      {
        status = 1;
      }else
      {
        status = 0;
      }
      $.ajax({
        type:'POST',
        url:'<?php echo base_url(); ?>Billing/update_digital_sign_status_now',
        data:{ref_no: ref.id,status: status},
        success:function(res)
        {
          res = JSON.parse(res);
          if(res.status==true)
          {
            swal('success','updated successfully','success');
          }else{
            swal('error','update failed','error');
          }
          console.log(res);

        }
      })
   }

   function emailNow(k)
   {
    
     let data = $('#form_'+k).serializeArray();
     swal({
            title: "Checking...",
            text: "Please wait",
            imageUrl: "images/ajaxloader.gif",
            showConfirmButton: false,
            allowOutsideClick: false
          });
      $.ajax({
        type:'POST',
        url:'<?php echo base_url(); ?>Billing/email_link_payment',
        data:data,
        success:function(res)
        {
          res = JSON.parse(res);
          if(res.status==true)
          {
            window.swal({
            title: "Finished!",
            showConfirmButton: false,
            timer: 1000
          });
            swal('success','link sent','success');
          }else{
            swal('error','sent failed','error');
          }
          console.log(res);

        }
      });
   }
  </script>