<div class="clearfix"></div>
  
  <div style="background: #F3FCFB!important;padding-top: 125px;" class="content-wrapper">
    <div class="container-fluid">
    <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
        <h4 class="page-title">Pending Report</h4>
        
     </div>
     <!-- <div class="col-sm-3">
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
      </div> -->
     </div>
     <!-- </div> -->
    <!-- End Breadcrumb-->
      <div class="row">
          <div class="col-lg-12">
            <!-- End Breadcrumb-->
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Pending Report List</div>
            <div class="card-body">
              <div  class="table-responsive">
              <table id="default-datatable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sl. No.</th>
                        <th>Case No.</th>
                        <th>Billing Date</th>
                        <th>Patient</th>
                        <th>Refered By</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                      if($billing_list!=105)
                      {
                          foreach($billing_list as $key=>$value)
                          {
                            ?>
                            <tr>
                            <td><?php echo ($key+1);  ?></td>
                            <td><?php echo $value['ref_no']; ?></td>
                            <td><?php echo date('d-m-Y',strtotime($value['billing_date'])); ?></td>
                            <td><?php echo $value['title'].' '.$value['full_name']; ?></td>
                            <td><?php echo $value['vendor_name']; ?></td>
                           
                            <td style="font-size: 25px;">
                              <?php
                              if($value['report_status']==0)
                              {
                                ?>
                                <a style="color: white; font-size:10px;" title="Create Report" href="<?php echo base_url().'Report/apointment/'.$value['ref_no']; ?>" class="btn btn-md btn-warning">Report <i aria-hidden="true" class="zmdi zmdi-plus-circle-o"></i></a>
                                <?php
                              } ?>
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
            total += parseFloat(val.dr_amount);
            $('#table_statement').append('<tr>'+
                             '<td>'+(ind+1)+'</td>'+
                             '<td>'+val.payment_date+'</td>'+
                             '<td>'+val.payment_id+'</td>'+
                             '<td>'+val.mode+'</td>'+
                             '<td>'+val.transaction_no+'</td>'+
                             '<td>'+val.dr_amount+'</td>'+
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
   
  </script>