<div class="clearfix"></div>
  
  <div style="background: #F3FCFB!important;padding-top: 125px;" class="content-wrapper">
    <div class="container-fluid">
    <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-9">
        <h4 class="page-title">Role</h4>
        
     </div>
     <div class="col-sm-3">
       <div class="btn-group float-sm-right">
        <button type="button" class="btn btn-outline-primary waves-effect waves-light"><i class="fa fa-cog mr-1"></i> Create</button>
        <button type="button" class="btn btn-outline-primary dropdown-toggle dropdown-toggle-split waves-effect waves-light" data-toggle="dropdown">
        <span class="caret"></span>
        </button>
        <div class="dropdown-menu">
          <button data-toggle="modal" onclick="openCreate()"  data-target="#formemodal" class="dropdown-item">New</button>
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
            <div class="card-header"><i class="fa fa-table"></i> Role List</div>
            <div class="card-body">
              <div  class="table-responsive">
              <table id="default-datatable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sl. No.</th>
                        <th>Role</th>
                        <th>Permission</th>
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
                        <td><?php echo $value['role_name']; ?>
                          <input type="hidden" value="<?php echo json_encode($value['role_permission'],true);?>" id="per_<?php echo $value['id']; ?>" name="">
                        </td>
                          <?php if($value['global']==0){
                            ?>
                            <td><i title="Edit" data-toggle="modal" data-target="#formemodalE"  style="cursor: pointer;" id="<?php echo $value['id'] ?>" onclick="modify_role(this.id)"  class="icon-pencil icons"></i></td>
                            <td>
                            <i title="Delete" id="<?php echo $value['id'] ?>" onclick="delete_user(this.id)" style="cursor: pointer;" class="icon-trash icons"></i></td> 
                            <?php
                             }else{
                              ?>
                              <td><i title="Edit" data-toggle="modal" data-target="#formemodalE"  style="cursor: pointer;" id="<?php echo $value['id'] ?>" onclick="view_role(this.id)"  class="icon-eye icons"></i></td>
                              <td>
                                -
                              </td> 
                              <?php
                             } ?>
                           
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
                        <h5 class="modal-title">Create Role</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          <form id="PermissionFormC">
                           <ul>
                            <li>
                              <strong>Role Name</strong>
                              <hr>
                              <input type="text" class="form-control" name="role_namec">
                              <hr>
                            </li>
                             <li>
                                <strong>Dashboard</strong>
                                <hr>
                                <p><input type="checkbox" value="1" name="dashboard_7_days_reportc">
                                <span>7 Days Report</span></p>
                                <p><input type="checkbox" value="1" name="dashboard_most_selling_category_reportc">
                                <span>Most Selling Category Report</span></p>
                                <p><input type="checkbox" value="1" name="dashboard_last_30_days_sell_reportc">
                                <span>Last 30 Days Sell Report</span></p>
                                <p><input checked="checked" type="checkbox" value="1" name="dashboard_top_test_list_reportc">
                                <span>Top Test List Report</span></p>
                                <p><input  type="checkbox" value="1" name="dashboard_top_refered_by_reportc">
                                <span>Top Refered By Report</span></p>
                                <p><input type="checkbox" value="1" name="dashboard_total_earning_cardc">
                                <span>Total Earnings Card</span></p>
                                <p><input type="checkbox" value="1" name="dashboard_total_report_count_cardc">
                                <span>Total Reports Count Card</span></p>
                                <p><input checked="checked" type="checkbox" value="1" name="dashboard_total_dues_cardc">
                                <span>Total Dues Card</span></p>
                                <hr>
                             </li>
                             <li>
                                <strong>New Billing</strong>
                                <hr>
                                <input type="checkbox" value="1" name="new_billing_accessc">
                                <span>Accessible</span>
                                <hr>
                             </li>
                             <li>
                                <strong>Billing Invoice</strong>
                                <hr>
                                <p><input type="checkbox" value="1" name="digital_sign_accessc">
                                <span>Digital Sign</span></p>
                                <p><input type="checkbox" value="1" name="print_status_accessc">
                                <span>Print Status</span></p>
                                <p><input type="checkbox" value="1" name="recive_payment_accessc">
                                <span>Receive Payment</span></p>
                                <p><input type="checkbox" value="1" name="payment_statement_accessc">
                                <span>Payment Statement</span></p>
                                <p><input type="checkbox" value="1" name="print_invoice_accessc">
                                <span>Print Invoice</span></p>
                                <p><input type="checkbox" value="1" name="print_report_accessc">
                                <span>Print Report</span></p>
                                <p><input type="checkbox" value="1" name="make_report_accessc">
                                <span>Make Report</span></p>
                                <p><input type="checkbox" value="1" name="edit_report_accessc">
                                <span>Edit Report</span></p>
                                <p><input type="checkbox" value="1" name="delete_report_accessc">
                                <span>Delete Report</span></p>
                                <hr>
                             </li>
                             <li>
                                <strong>Due Report</strong>
                                <hr>
                                <input type="checkbox" value="1" name="due_report_accessc">
                                <span>Access</span>
                                <hr>
                             </li>
                             <li>
                                <strong>Pending Report</strong>
                                <hr>
                                <input type="checkbox" value="1" name="pending_report_accessc">
                                 <span>Access</span>
                                 <hr>
                             </li>
                             <li>
                                <strong>Test Report</strong>
                                <hr>
                                <input type="checkbox" value="1" name="test_report_accessc">
                                 <span>Access</span>
                                 <hr>
                             </li>
                             <li>
                                <strong>Category Master</strong>
                                <hr>
                                <input type="checkbox" value="1" name="category_readc">
                                 <span>Read</span>
                                  <input type="checkbox" value="1" name="category_writec">
                                 <span>Write</span>
                                  <input type="checkbox" value="1" name="category_deletec">
                                 <span>Delete</span>
                                 <hr>
                             </li>
                             <li>
                                <strong>Test Master</strong>
                                <hr>
                                <input type="checkbox" value="1" name="test_readc">
                                 <span>Read</span>
                                  <input type="checkbox" value="1" name="test_writec">
                                 <span>Write</span>
                                  <input type="checkbox" value="1" name="test_deletec">
                                 <span>Delete</span>
                                 <hr>
                             </li>
                             <li>
                                <strong>Vendor Master</strong>
                                <hr>
                                <input type="checkbox" value="1" name="vendor_readc">
                                 <span>Read</span>
                                  <input type="checkbox" value="1" name="vendor_writec">
                                 <span>Write</span>
                                  <input type="checkbox" value="1" name="vendor_deletec">
                                 <span>Delete</span>
                                 <hr>
                             </li>
                             <li>
                                <strong>Patient Master</strong>
                                <hr>
                                <input type="checkbox" value="1" name="patient_readc">
                                 <span>Read</span>
                                  <input type="checkbox" value="1" name="patient_writec">
                                 <span>Write</span>
                                  <input type="checkbox" value="1" name="patient_deletec">
                                 <span>Delete</span>
                                 <hr>
                             </li>
                           </ul>
                             <div class="form-group">
                              <button type="submit" class="btn btn-info shadow-info px-5"><i class="icon-doc"></i> Create</button>
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
                        <h5 class="modal-title">Modify Role</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          <form id="PermissionFormE">
                            <input type="hidden" name="action" value="U">
                            <input type="hidden" name="role_id" id="role_id" value="">
                           <ul>
                            <li>
                              <strong>Role Name</strong>
                              <hr>
                              <input type="text" class="form-control" name="role_name">
                              <hr>
                            </li>
                             <li>
                                <strong>Dashboard</strong>
                                <hr>
                                <p><input type="checkbox" value="1" name="dashboard_7_days_report">
                                <span>7 Days Report</span></p>
                                <p><input type="checkbox" value="1" name="dashboard_most_selling_category_report">
                                <span>Most Selling Category Report</span></p>
                                <p><input type="checkbox" value="1" name="dashboard_last_30_days_sell_report">
                                <span>Last 30 Days Sell Report</span></p>
                                <p><input type="checkbox" value="1" name="dashboard_top_test_list_report">
                                <span>Top Test List Report</span></p>
                                <p><input type="checkbox" value="1" name="dashboard_top_refered_by_report">
                                <span>Top Refered By Report</span></p>
                                <p><input type="checkbox" value="1" name="dashboard_total_earning_card">
                                <span>Total Earnings Card</span></p>
                                <p><input type="checkbox" value="1" name="dashboard_total_report_count_card">
                                <span>Total Reports Count Card</span></p>
                                <p><input type="checkbox" value="1" name="dashboard_total_dues_card">
                                <span>Total Dues Card</span></p>
                                <hr>
                             </li>
                             <li>
                                <strong>New Billing</strong>
                                <hr>
                                <input type="checkbox" value="1" name="new_billing_access">
                                <span>Accessible</span>
                                <hr>
                             </li>
                             <li>
                                <strong>Billing Invoice</strong>
                                <hr>
                                <p><input type="checkbox" value="1" name="digital_sign_access">
                                <span>Digital Sign</span></p>
                                <p><input type="checkbox" value="1" name="print_status_access">
                                <span>Print Status</span></p>
                                <p><input type="checkbox" value="1" name="recive_payment_access">
                                <span>Recive Payment</span></p>
                                <p><input type="checkbox" value="1" name="payment_statement_access">
                                <span>Payment Statement</span></p>
                                <p><input type="checkbox" value="1" name="print_invoice_access">
                                <span>Print Invoice</span></p>
                                <p><input type="checkbox" value="1" name="print_report_access">
                                <span>Print Report</span></p>
                                <p><input type="checkbox" value="1" name="make_report_access">
                                <span>Make Report</span></p>
                                <p><input type="checkbox" value="1" name="edit_report_access">
                                <span>Edit Report</span></p>
                                <p><input type="checkbox" value="1" name="delete_report_access">
                                <span>Delete Report</span></p>
                                <hr>
                             </li>
                             <li>
                                <strong>Due Report</strong>
                                <hr>
                                <input type="checkbox" value="1" name="due_report_access">
                                <span>Access</span>
                                <hr>
                             </li>
                             <li>
                                <strong>Pending Report</strong>
                                <hr>
                                <input type="checkbox" value="1" name="pending_report_access">
                                 <span>Access</span>
                                 <hr>
                             </li>
                             <li>
                                <strong>Test Report</strong>
                                <hr>
                                <input type="checkbox" value="1" name="test_report_access">
                                 <span>Access</span>
                                 <hr>
                             </li>
                             <li>
                                <strong>Category Master</strong>
                                <hr>
                                <input type="checkbox" value="1" name="category_read">
                                 <span>Read</span>
                                  <input type="checkbox" value="1" name="category_write">
                                 <span>Write</span>
                                  <input type="checkbox" value="1" name="category_delete">
                                 <span>Delete</span>
                                 <hr>
                             </li>
                             <li>
                                <strong>Test Master</strong>
                                <hr>
                                <input type="checkbox" value="1" name="test_read">
                                 <span>Read</span>
                                  <input type="checkbox" value="1" name="test_write">
                                 <span>Write</span>
                                  <input type="checkbox" value="1" name="test_delete">
                                 <span>Delete</span>
                                 <hr>
                             </li>
                             <li>
                                <strong>Vendor Master</strong>
                                <hr>
                                <input type="checkbox" value="1" name="vendor_read">
                                 <span>Read</span>
                                  <input type="checkbox" value="1" name="vendor_write">
                                 <span>Write</span>
                                  <input type="checkbox" value="1" name="vendor_delete">
                                 <span>Delete</span>
                                 <hr>
                             </li>
                             <li>
                                <strong>Patient Master</strong>
                                <hr>
                                <input type="checkbox" value="1" name="patient_read">
                                 <span>Read</span>
                                  <input type="checkbox" value="1" name="patient_write">
                                 <span>Write</span>
                                  <input type="checkbox" value="1" name="patient_delete">
                                 <span>Delete</span>
                                 <hr>
                             </li>
                           </ul>
                             <div class="form-group">
                              <button type="submit" id="updatebtn" class="btn btn-info shadow-info px-5"><i class="icon-doc"></i> Update</button>
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

    $('#subAccountForm').submit(function(e){
      e.preventDefault();
      $("#subAccountForm").validate({
        rules: {
            user_name: "required",
            password: "required",
        },
        messages: {
            user_name: "Please enter username",
            password: "Please enter password",
            
        },
        submitHandler:function(res)
        {
          $('#overlay2').show();
          var data = $('#subAccountForm').serializeArray();
          $.ajax({
                type: "POST",
                url:"<?php echo base_url();  ?>Master/sub_account_master",
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
                        setTimeout(function(){ window.location.href='<?php echo base_url(); ?>Master/sub_account/sub_account'; }, 1000);
                        $('#formemodal').modal('toggle');
                        $('#subAccountForm').clear();

                   }
                    else
                    {
                                $('#overlay2').hide();
                                swal("ERROR!", ''+res.Message+'', "error");
                                $('#subAccountForm').clear();
                    }
               }
            });
        }
    });

    });


    function openCreate()
    {
      $('input[type=checkbox]').prop('disabled',false);
      $('#updatebtn').prop('disabled',false);
    }

    function delete_user(role_id)
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
                        url:"<?php echo base_url();  ?>Master/role_master",
                              data:{action: 'D',role_id: role_id},
                              headers: {
                                     "x-api-key": "admin@123",
                                   },
                              success:function(res)
                              {
                                res = JSON.parse(res);
                                  if(res.response_code == 200){
                                     $('#overlay2').hide();
                                      swal("SUCCESS!", ''+res.Message+'', "success");
                                      setTimeout(function(){ window.location.href='<?php echo base_url(); ?>Master/role'; }, 1000);
                                      
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

    function modify_role(id)
    {
      $('#role_id').val(id);
      $('input[type=checkbox]').prop('disabled',false);
      $('#updatebtn').prop('disabled',false);
        $.ajax({
          type:'POST',
          url:"<?php echo base_url();  ?>Master/role_master",
                data:{action: 'RP',role_id: id},
                headers: {
                       "x-api-key": "admin@123",
                     },
                success:function(res)
                {
                  res = JSON.parse(res);
                    if(res.response_code == 200){
                       $('#overlay2').hide();
                       let resObj = JSON.parse(res.response_data[0].role_permission);
                        $('input[name=role_name]').val(res.response_data[0].role_name);
                        resObj.dashboard_7_days_report== 1?$("input[name=dashboard_7_days_report]").prop('checked',true):$("input[name=dashboard_7_days_report]").prop('checked',false);


                        resObj.dashboard_most_selling_category_report== 1?$("input[name=dashboard_most_selling_category_report]").prop('checked',true):$("input[name=dashboard_most_selling_category_report]").prop('checked',false);


                        resObj.dashboard_last_30_days_sell_report== 1?$("input[name=dashboard_last_30_days_sell_report]").prop('checked',true):$("input[name=dashboard_last_30_days_sell_report]").prop('checked',false);

                        resObj.dashboard_top_test_list_report== 1?$("input[name=dashboard_top_test_list_report]").prop('checked',true):$("input[name=dashboard_top_test_list_report]").prop('checked',false);


                        resObj.dashboard_top_refered_by_report== 1?$("input[name=dashboard_top_refered_by_report]").prop('checked',true):$("input[name=dashboard_top_refered_by_report]").prop('checked',false);


                        resObj.dashboard_total_earning_card== 1?$("input[name=dashboard_total_earning_card]").prop('checked',true):$("input[name=dashboard_total_earning_card]").prop('checked',false);


                        resObj.dashboard_total_report_count_card== 1?$("input[name=dashboard_total_report_count_card]").prop('checked',true):$("input[name=dashboard_total_report_count_card]").prop('checked',false);

                        resObj.dashboard_total_dues_card== 1?$("input[name=dashboard_total_dues_card]").prop('checked',true):$("input[name=dashboard_total_dues_card]").prop('checked',false);

                        resObj.new_billing_access== 1?$("input[name=new_billing_access]").prop('checked',true):$("input[name=new_billing_access]").prop('checked',false);

                        resObj.digital_sign_access== 1?$("input[name=digital_sign_access]").prop('checked',true):$("input[name=digital_sign_access]").prop('checked',false);

                        resObj.print_status_access== 1?$("input[name=print_status_access]").prop('checked',true):$("input[name=print_status_access]").prop('checked',false);

                        resObj.recive_payment_access== 1?$("input[name=recive_payment_access]").prop('checked',true):$("input[name=recive_payment_access]").prop('checked',false);

                        resObj.payment_statement_access== 1?$("input[name=payment_statement_access]").prop('checked',true):$("input[name=payment_statement_access]").prop('checked',false);

                        resObj.print_invoice_access== 1?$("input[name=print_invoice_access]").prop('checked',true):$("input[name=print_invoice_access]").prop('checked',false);

                         resObj.print_report_access== 1?$("input[name=print_report_access]").prop('checked',true):$("input[name=print_report_access]").prop('checked',false);

                        resObj.make_report_access== 1?$("input[name=make_report_access]").prop('checked',true):$("input[name=make_report_access]").prop('checked',false);


                        resObj.edit_report_access== 1?$("input[name=edit_report_access]").prop('checked',true):$("input[name=edit_report_access]").prop('checked',false);


                        resObj.delete_report_access== 1?$("input[name=delete_report_access]").prop('checked',true):$("input[name=delete_report_access]").prop('checked',false);


                        resObj.due_report_access== 1?$("input[name=due_report_access]").prop('checked',true):$("input[name=due_report_access]").prop('checked',false);

                        resObj.pending_report_access== 1?$("input[name=pending_report_access]").prop('checked',true):$("input[name=pending_report_access]").prop('checked',false);


                        resObj.test_report_access== 1?$("input[name=test_report_access]").prop('checked',true):$("input[name=test_report_access]").prop('checked',false);

                        resObj.category_read== 1?$("input[name=category_read]").prop('checked',true):$("input[name=category_read]").prop('checked',false);

                        resObj.category_write== 1?$("input[name=category_write]").prop('checked',true):$("input[name=category_write]").prop('checked',false);

                        resObj.category_delete== 1?$("input[name=category_delete]").prop('checked',true):$("input[name=category_delete]").prop('checked',false);

                        resObj.test_read== 1?$("input[name=test_read]").prop('checked',true):$("input[name=test_read]").prop('checked',false);

                        resObj.test_write== 1?$("input[name=test_write]").prop('checked',true):$("input[name=test_write]").prop('checked',false);

                        resObj.test_delete== 1?$("input[name=test_delete]").prop('checked',true):$("input[name=test_delete]").prop('checked',false);

                        resObj.vendor_read== 1?$("input[name=vendor_read]").prop('checked',true):$("input[name=vendor_read]").prop('checked',false);

                        resObj.vendor_write== 1?$("input[name=vendor_write]").prop('checked',true):$("input[name=vendor_write]").prop('checked',false);

                        resObj.vendor_delete== 1?$("input[name=vendor_delete]").prop('checked',true):$("input[name=vendor_delete]").prop('checked',false);

                        resObj.patient_read== 1?$("input[name=patient_read]").prop('checked',true):$("input[name=patient_read]").prop('checked',false);

                        resObj.patient_write== 1?$("input[name=patient_write]").prop('checked',true):$("input[name=patient_write]").prop('checked',false);

                        resObj.patient_delete== 1?$("input[name=patient_delete]").prop('checked',true):$("input[name=patient_delete]").prop('checked',false);
                       // console.log(JSON.parse(res.response_data[0].permission_status));

                     }
                      else
                      {
                            $('#overlay2').hide();
                            swal("ERROR!", ''+res.Message+'', "error");
                      }
                }
        });
    }

    function view_role(id)
    {
      $('#role_id').val(id);
      
        $.ajax({
          type:'POST',
          url:"<?php echo base_url();  ?>Master/role_master",
                data:{action: 'RP',role_id: id},
                headers: {
                       "x-api-key": "admin@123",
                     },
                success:function(res)
                {
                  res = JSON.parse(res);
                    if(res.response_code == 200){
                       $('#overlay2').hide();
                       let resObj = JSON.parse(res.response_data[0].role_permission);
                        $('input[name=role_name]').val(res.response_data[0].role_name);
                        resObj.dashboard_7_days_report== 1?$("input[name=dashboard_7_days_report]").prop('checked',true):$("input[name=dashboard_7_days_report]").prop('checked',false);


                        resObj.dashboard_most_selling_category_report== 1?$("input[name=dashboard_most_selling_category_report]").prop('checked',true):$("input[name=dashboard_most_selling_category_report]").prop('checked',false);


                        resObj.dashboard_last_30_days_sell_report== 1?$("input[name=dashboard_last_30_days_sell_report]").prop('checked',true):$("input[name=dashboard_last_30_days_sell_report]").prop('checked',false);

                        resObj.dashboard_top_test_list_report== 1?$("input[name=dashboard_top_test_list_report]").prop('checked',true):$("input[name=dashboard_top_test_list_report]").prop('checked',false);


                        resObj.dashboard_top_refered_by_report== 1?$("input[name=dashboard_top_refered_by_report]").prop('checked',true):$("input[name=dashboard_top_refered_by_report]").prop('checked',false);


                        resObj.dashboard_total_earning_card== 1?$("input[name=dashboard_total_earning_card]").prop('checked',true):$("input[name=dashboard_total_earning_card]").prop('checked',false);


                        resObj.dashboard_total_report_count_card== 1?$("input[name=dashboard_total_report_count_card]").prop('checked',true):$("input[name=dashboard_total_report_count_card]").prop('checked',false);

                        resObj.dashboard_total_dues_card== 1?$("input[name=dashboard_total_dues_card]").prop('checked',true):$("input[name=dashboard_total_dues_card]").prop('checked',false);

                        resObj.new_billing_access== 1?$("input[name=new_billing_access]").prop('checked',true):$("input[name=new_billing_access]").prop('checked',false);

                        resObj.digital_sign_access== 1?$("input[name=digital_sign_access]").prop('checked',true):$("input[name=digital_sign_access]").prop('checked',false);

                        resObj.print_status_access== 1?$("input[name=print_status_access]").prop('checked',true):$("input[name=print_status_access]").prop('checked',false);

                        resObj.recive_payment_access== 1?$("input[name=recive_payment_access]").prop('checked',true):$("input[name=recive_payment_access]").prop('checked',false);

                        resObj.payment_statement_access== 1?$("input[name=payment_statement_access]").prop('checked',true):$("input[name=payment_statement_access]").prop('checked',false);

                        resObj.print_invoice_access== 1?$("input[name=print_invoice_access]").prop('checked',true):$("input[name=print_invoice_access]").prop('checked',false);

                         resObj.print_report_access== 1?$("input[name=print_report_access]").prop('checked',true):$("input[name=print_report_access]").prop('checked',false);

                        resObj.make_report_access== 1?$("input[name=make_report_access]").prop('checked',true):$("input[name=make_report_access]").prop('checked',false);


                        resObj.edit_report_access== 1?$("input[name=edit_report_access]").prop('checked',true):$("input[name=edit_report_access]").prop('checked',false);


                        resObj.delete_report_access== 1?$("input[name=delete_report_access]").prop('checked',true):$("input[name=delete_report_access]").prop('checked',false);


                        resObj.due_report_access== 1?$("input[name=due_report_access]").prop('checked',true):$("input[name=due_report_access]").prop('checked',false);

                        resObj.pending_report_access== 1?$("input[name=pending_report_access]").prop('checked',true):$("input[name=pending_report_access]").prop('checked',false);


                        resObj.test_report_access== 1?$("input[name=test_report_access]").prop('checked',true):$("input[name=test_report_access]").prop('checked',false);

                        resObj.category_read== 1?$("input[name=category_read]").prop('checked',true):$("input[name=category_read]").prop('checked',false);

                        resObj.category_write== 1?$("input[name=category_write]").prop('checked',true):$("input[name=category_write]").prop('checked',false);

                        resObj.category_delete== 1?$("input[name=category_delete]").prop('checked',true):$("input[name=category_delete]").prop('checked',false);

                        resObj.test_read== 1?$("input[name=test_read]").prop('checked',true):$("input[name=test_read]").prop('checked',false);

                        resObj.test_write== 1?$("input[name=test_write]").prop('checked',true):$("input[name=test_write]").prop('checked',false);

                        resObj.test_delete== 1?$("input[name=test_delete]").prop('checked',true):$("input[name=test_delete]").prop('checked',false);

                        resObj.vendor_read== 1?$("input[name=vendor_read]").prop('checked',true):$("input[name=vendor_read]").prop('checked',false);

                        resObj.vendor_write== 1?$("input[name=vendor_write]").prop('checked',true):$("input[name=vendor_write]").prop('checked',false);

                        resObj.vendor_delete== 1?$("input[name=vendor_delete]").prop('checked',true):$("input[name=vendor_delete]").prop('checked',false);

                        resObj.patient_read== 1?$("input[name=patient_read]").prop('checked',true):$("input[name=patient_read]").prop('checked',false);

                        resObj.patient_write== 1?$("input[name=patient_write]").prop('checked',true):$("input[name=patient_write]").prop('checked',false);

                        resObj.patient_delete== 1?$("input[name=patient_delete]").prop('checked',true):$("input[name=patient_delete]").prop('checked',false);
                       // console.log(JSON.parse(res.response_data[0].permission_status));
                       $('input[type=checkbox]').prop('disabled',true);
                       $('#updatebtn').prop('disabled',true);
                     }
                      else
                      {
                            $('#overlay2').hide();
                            swal("ERROR!", ''+res.Message+'', "error");
                      }
                }
        });
    }
    $('#PermissionFormE').submit(function(e){
      e.preventDefault();
      let obj = {
                  dashboard_7_days_report:0,
                  dashboard_most_selling_category_report:0,
                  dashboard_last_30_days_sell_report:0,
                  dashboard_top_test_list_report:0,
                  dashboard_top_refered_by_report:0,
                  dashboard_total_earning_card:0,
                  dashboard_total_report_count_card:0,
                  dashboard_total_dues_card:0,
                  new_billing_access:0,
                  digital_sign_access:0,
                  print_status_access:0,
                  recive_payment_access:0,
                  payment_statement_access:0,
                  print_invoice_access:0,
                  print_report_access:0,
                  make_report_access:0,
                  edit_report_access:0,
                  delete_report_access:0,
                  due_report_access:0,
                  pending_report_access:0,
                  test_report_access:0,
                  category_read:0,
                  category_write:0,
                  category_delete:0,
                  test_read:0,
                  test_write:0,
                  test_delete:0,
                  vendor_read:0,
                  vendor_write:0,
                  vendor_delete:0,
                  patient_read:0,
                  patient_write:0,
                  patient_delete:0
              };

              $("input[name=dashboard_7_days_report]").prop('checked') == true?obj.dashboard_7_days_report = 1:obj.dashboard_7_days_report=0;
              $("input[name=dashboard_most_selling_category_report]").prop('checked') == true?obj.dashboard_most_selling_category_report = 1:obj.dashboard_most_selling_category_report=0;
              
              $("input[name=dashboard_last_30_days_sell_report]").prop('checked') == true?obj.dashboard_last_30_days_sell_report = 1:obj.dashboard_last_30_days_sell_report=0;
              $("input[name=dashboard_top_test_list_report]").prop('checked') == true?obj.dashboard_top_test_list_report = 1:obj.dashboard_top_test_list_report=0;
              $("input[name=dashboard_top_refered_by_report]").prop('checked') == true?obj.dashboard_top_refered_by_report = 1:obj.dashboard_top_refered_by_report=0;
              $("input[name=dashboard_total_earning_card]").prop('checked') == true?obj.dashboard_total_earning_card = 1:obj.dashboard_total_earning_card=0;
              $("input[name=dashboard_total_report_count_card]").prop('checked') == true?obj.dashboard_total_report_count_card = 1:obj.dashboard_total_report_count_card=0;
              $("input[name=dashboard_total_dues_card]").prop('checked') == true?obj.dashboard_total_dues_card = 1:obj.dashboard_total_dues_card=0;
              $("input[name=new_billing_access]").prop('checked') == true?obj.new_billing_access = 1:obj.new_billing_access=0;
              $("input[name=digital_sign_access]").prop('checked') == true?obj.digital_sign_access = 1:obj.digital_sign_access=0;
              $("input[name=print_status_access]").prop('checked') == true?obj.print_status_access = 1:obj.print_status_access=0;
              $("input[name=recive_payment_access]").prop('checked') == true?obj.recive_payment_access = 1:obj.recive_payment_access=0;
              $("input[name=payment_statement_access]").prop('checked') == true?obj.payment_statement_access = 1:obj.payment_statement_access=0;
              $("input[name=print_invoice_access]").prop('checked') == true?obj.print_invoice_access = 1:obj.print_invoice_access=0;
              $("input[name=print_report_access]").prop('checked') == true?obj.print_report_access = 1:obj.print_report_access=0;
              $("input[name=make_report_access]").prop('checked') == true?obj.make_report_access = 1:obj.make_report_access=0;
              $("input[name=edit_report_access]").prop('checked') == true?obj.edit_report_access = 1:obj.edit_report_access=0;
              $("input[name=delete_report_access]").prop('checked') == true?obj.delete_report_access = 1:obj.delete_report_access=0;
              $("input[name=due_report_access]").prop('checked') == true?obj.due_report_access = 1:obj.due_report_access=0;
              $("input[name=pending_report_access]").prop('checked') == true?obj.pending_report_access = 1:obj.pending_report_access=0;
              $("input[name=test_report_access]").prop('checked') == true?obj.test_report_access = 1:obj.test_report_access=0;
              $("input[name=category_read]").prop('checked') == true?obj.category_read = 1:obj.category_read=0;
              $("input[name=category_write]").prop('checked') == true?obj.category_write = 1:obj.category_write=0;
              $("input[name=category_delete]").prop('checked') == true?obj.category_delete = 1:obj.category_delete=0;
              $("input[name=test_read]").prop('checked') == true?obj.test_read = 1:obj.test_read=0;
              $("input[name=test_write]").prop('checked') == true?obj.test_write = 1:obj.test_write=0;
              $("input[name=test_delete]").prop('checked') == true?obj.test_delete = 1:obj.test_delete=0;
              $("input[name=vendor_read]").prop('checked') == true?obj.vendor_read = 1:obj.vendor_read=0;
              $("input[name=vendor_write]").prop('checked') == true?obj.vendor_write = 1:obj.vendor_write=0;
              $("input[name=vendor_delete]").prop('checked') == true?obj.vendor_delete = 1:obj.vendor_delete=0;
              $("input[name=patient_read]").prop('checked') == true?obj.patient_read = 1:obj.patient_read=0;
              $("input[name=patient_write]").prop('checked') == true?obj.patient_write = 1:obj.patient_write=0;
              $("input[name=patient_delete]").prop('checked') == true?obj.patient_delete = 1:obj.patient_delete=0;
              console.log(obj);
              $('#overlay2').show();
              var data = $('#PermissionFormE').serializeArray();
              $.ajax({
                    type: "POST",
                    url:"<?php echo base_url();  ?>Master/role_master",
                    data:{role_id: $('input[name=role_id]').val(),role_name: $('input[name=role_name]').val(),data:obj,action:'U'},
                    headers: {
                           "x-api-key": "admin@123",
                         },
                    success:function(res)
                    {
                        res = JSON.parse(res);
                        if(res.response_code == 200){
                           $('#overlay2').hide();
                            swal("SUCCESS!", ''+res.Message+'', "success");
                            setTimeout(function(){ window.location.href='<?php echo base_url(); ?>Master/role'; }, 1000);
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


  $('#PermissionFormC').submit(function(e){
      e.preventDefault();
      let obj = {
                  dashboard_7_days_report:0,
                  dashboard_most_selling_category_report:0,
                  dashboard_last_30_days_sell_report:0,
                  dashboard_top_test_list_report:0,
                  dashboard_top_refered_by_report:0,
                  dashboard_total_earning_card:0,
                  dashboard_total_report_count_card:0,
                  dashboard_total_dues_card:0,
                  new_billing_access:0,
                  digital_sign_access:0,
                  print_status_access:0,
                  recive_payment_access:0,
                  payment_statement_access:0,
                  print_invoice_access:0,
                  print_report_access:0,
                  make_report_access:0,
                  edit_report_access:0,
                  delete_report_access:0,
                  due_report_access:0,
                  pending_report_access:0,
                  test_report_access:0,
                  category_read:0,
                  category_write:0,
                  category_delete:0,
                  test_read:0,
                  test_write:0,
                  test_delete:0,
                  vendor_read:0,
                  vendor_write:0,
                  vendor_delete:0,
                  patient_read:0,
                  patient_write:0,
                  patient_delete:0
              };

              $("input[name=dashboard_7_days_reportc]").prop('checked') == true?obj.dashboard_7_days_report = 1:obj.dashboard_7_days_report=0;
              $("input[name=dashboard_most_selling_category_reportc]").prop('checked') == true?obj.dashboard_most_selling_category_report = 1:obj.dashboard_most_selling_category_report=0;
              $("input[name=dashboard_last_30_days_sell_reportc]").prop('checked') == true?obj.dashboard_last_30_days_sell_report = 1:obj.dashboard_last_30_days_sell_report=0;
              $("input[name=dashboard_top_test_list_reportc]").prop('checked') == true?obj.dashboard_top_test_list_report = 1:obj.dashboard_top_test_list_report=0;
              $("input[name=dashboard_top_refered_by_reportc]").prop('checked') == true?obj.dashboard_top_refered_by_report = 1:obj.dashboard_top_refered_by_report=0;
              $("input[name=dashboard_total_earning_cardc]").prop('checked') == true?obj.dashboard_total_earning_card = 1:obj.dashboard_total_earning_card=0;
              $("input[name=dashboard_total_report_count_cardc]").prop('checked') == true?obj.dashboard_total_report_count_card = 1:obj.dashboard_total_report_count_card=0;
              $("input[name=dashboard_total_dues_cardc]").prop('checked') == true?obj.dashboard_total_dues_card = 1:obj.dashboard_total_dues_card=0;
              $("input[name=new_billing_accessc]").prop('checked') == true?obj.new_billing_access = 1:obj.new_billing_access=0;
              $("input[name=digital_sign_accessc]").prop('checked') == true?obj.digital_sign_access = 1:obj.digital_sign_access=0;
              $("input[name=print_status_accessc]").prop('checked') == true?obj.print_status_access = 1:obj.print_status_access=0;
              $("input[name=recive_payment_accessc]").prop('checked') == true?obj.recive_payment_access = 1:obj.recive_payment_access=0;
              $("input[name=payment_statement_accessc]").prop('checked') == true?obj.payment_statement_access = 1:obj.payment_statement_access=0;
              $("input[name=print_invoice_accessc]").prop('checked') == true?obj.print_invoice_access = 1:obj.print_invoice_access=0;
              $("input[name=print_report_accessc]").prop('checked') == true?obj.print_report_access = 1:obj.print_report_access=0;
              $("input[name=make_report_accessc]").prop('checked') == true?obj.make_report_access = 1:obj.make_report_access=0;
              $("input[name=edit_report_accessc]").prop('checked') == true?obj.edit_report_access = 1:obj.edit_report_access=0;
              $("input[name=delete_report_accessc]").prop('checked') == true?obj.delete_report_access = 1:obj.delete_report_access=0;
              $("input[name=due_report_accessc]").prop('checked') == true?obj.due_report_access = 1:obj.due_report_access=0;
              $("input[name=pending_report_accessc]").prop('checked') == true?obj.pending_report_access = 1:obj.pending_report_access=0;
              $("input[name=test_report_accessc]").prop('checked') == true?obj.test_report_access = 1:obj.test_report_access=0;
              $("input[name=category_readc]").prop('checked') == true?obj.category_read = 1:obj.category_read=0;
              $("input[name=category_writec]").prop('checked') == true?obj.category_write = 1:obj.category_write=0;
              $("input[name=category_deletec]").prop('checked') == true?obj.category_delete = 1:obj.category_delete=0;
              $("input[name=test_readc]").prop('checked') == true?obj.test_read = 1:obj.test_read=0;
              $("input[name=test_writec]").prop('checked') == true?obj.test_write = 1:obj.test_write=0;
              $("input[name=test_deletec]").prop('checked') == true?obj.test_delete = 1:obj.test_delete=0;
              $("input[name=vendor_readc]").prop('checked') == true?obj.vendor_read = 1:obj.vendor_read=0;
              $("input[name=vendor_writec]").prop('checked') == true?obj.vendor_write = 1:obj.vendor_write=0;
              $("input[name=vendor_deletec]").prop('checked') == true?obj.vendor_delete = 1:obj.vendor_delete=0;
              $("input[name=patient_readc]").prop('checked') == true?obj.patient_read = 1:obj.patient_read=0;
              $("input[name=patient_writec]").prop('checked') == true?obj.patient_write = 1:obj.patient_write=0;
              $("input[name=patient_deletec]").prop('checked') == true?obj.patient_delete = 1:obj.patient_delete=0;
              console.log(obj);
              $('#overlay2').show();
          
              $.ajax({
                    type: "POST",
                    url:"<?php echo base_url();  ?>Master/role_master",
                    data:{role_name:$('input[name=role_namec]').val(),data:obj,action:'C'},
                    headers: {
                           "x-api-key": "admin@123",
                         },
                    success:function(res)
                    {
                        res = JSON.parse(res);
                        if(res.response_code == 200){
                           $('#overlay2').hide();
                            swal("SUCCESS!", ''+res.Message+'', "success");
                            setTimeout(function(){ window.location.href='<?php echo base_url(); ?>Master/role'; }, 1000);
                            $('#PatientFormC').clear();

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