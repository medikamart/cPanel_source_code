<?php
require APPPATH . 'libraries/REST_Controller.php';
     
class Report extends REST_Controller {
    public function __construct() {
       parent::__construct();
       $this->load->model("Patient_model");
       $this->load->model("Report_model");
       $this->load->model("Test_model");
       $this->load->model("Billing_model");
       $this->load->model("Payment_model");
    }

    public function report_master_post()
    {   
        
        $action = $this->input->post('action');
        // print_r($action);die;
        if($action=='C')
        { 
            try{

                $data = json_decode(urldecode(base64_decode($_POST['data'])),TRUE);

                $this->Report_model->updateVendorId_m($data['ref_no'],$data['vendor_id']);

                // print_r($data['remarks']);die;

                if(isset($data['n_b_test_id']) && !empty($data['n_b_test_id']))
                {   
                    foreach($data['n_b_test_id'] as $key=>$value)
                    {
                        $data_array = array();
                        $data_array['test_name'] = $data['n_sub_test_name'][$key];
                        $data_array['unit'] = $data['n_test_unit'][$key];
                        $data_array['reference'] = $data['n_test_reference'][$key];
                        $data_array['b_test_id'] = $value;
                        $data_array['result'] = $data['n_test_result'][$key];
                        $data_array['b_sub_test_id'] = $data['n_b_sub_test_id'][$key];
                        $data_array['ref_no'] = $data['ref_no'];
                        $data_array['status'] = 1;
                        $this->Report_model->add_new_report_test_m($data_array);
                        $this->db->update('tbl_billing_master',['report_remarks'=>$data['remarks'],'report_date'=>date('Y-m-d',strtotime($data['report_date']))],['ref_no'=>$data['ref_no']]);
                     }
                }

                if(isset($data['w_b_test_id']) && !empty($data['w_b_test_id']))
                {   
                    foreach($data['w_b_test_id'] as $key=>$value)
                    {
                        $data_array = array();
                        $data_array['test_name'] = $data['w_sub_test_name'][$key];
                        $data_array['b_test_id'] = $value;
                        $data_array['b_sub_test_id'] = $data['w_b_sub_test_id'][$key];
                        $data_array['one_20'] = $data['w_test_result_20'][$key];
                        $data_array['one_40'] = $data['w_test_result_40'][$key];
                        $data_array['one_80'] = $data['w_test_result_80'][$key];
                        $data_array['one_160'] = $data['w_test_result_160'][$key];
                        $data_array['one_320'] = $data['w_test_result_320'][$key];
                        $data_array['ref_no'] = $data['ref_no'];
                        $this->Report_model->add_new_report_test_m($data_array);
                        $this->db->update('tbl_billing_master',['report_remarks'=>$data['remarks']],['ref_no'=>$data['ref_no']]);

                     }
                }


                $this->response(['status' => TRUE, 'response_data'=>[], 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);

            }catch(Exception $e)
            {
                $this->response(['status' => FALSE, 'response_data'=>[], 'Message' =>$e->getMessage(), 'response_code'=>REST_Controller::HTTP_NOT_FOUND]);
            }
            
        }elseif($action=='R')
        {
            
            if($this->input->post("ref_no")=='')
            {
                
                $this->response(['status' => FALSE, 'response_data'=>[], 'Message' =>'Ref no required !'  , 'response_code'=>REST_Controller::HTTP_NOT_FOUND]);
            }else
            {

               $this->input->post("ref_no")!=""?$ref_no=$this->input->post("ref_no"):$ref_no="";
               $this->input->post("use_type")!=""?$use_type=$this->input->post("use_type"):$use_type="";
               $test_array = $this->input->post('test_array');
               $basic = $this->Billing_model->getPatientDetails_m($ref_no);

               if($use_type=='print')
               {
                    $test_array = $this->Report_model->get_print_details($ref_no);
                    $result = $this->Report_model->get_reportDetails_m($ref_no,json_decode($test_array[0]['test_ids']));
               }else
               {
                    $test_array = $this->Report_model->get_billing_test_ids($ref_no);
                   // print_r($test_array);die;
                   
                   $result = $this->Report_model->get_reportDetails_m($ref_no,$test_array);
               }
               

               if(!empty($result))
                {
                     $this->response(['status' => True, 'response_data'=>$result,'basic_data'=>$basic, 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);
                }else
                {
                    $this->response(['status' => FALSE, 'response_data'=>[],'basic_date'=>$basic, 'Message' =>'Failed'  , 'response_code'=>REST_Controller::HTTP_NOT_FOUND]);
                }
            }
           
            
        }elseif($action=='S')
        {
            $this->input->post('ref_no')!=""?$ref_no=$this->input->post('ref_no'):$ref_no="";
           $result = $this->Payment_model->get_payment_history_m($ref_no);
           if($result!=105)
            {
                 $this->response(['status' => True, 'response_data'=>$result, 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);
            }else
            {
                $this->response(['status' => FALSE, 'response_data'=>[], 'Message' =>'Failed'  , 'response_code'=>REST_Controller::HTTP_NOT_FOUND]);
            }
            
        }elseif($action=='D')
        {
            // print_r($action);die;
            if($this->input->post('d_by')=='' || $this->input->post('ref_no')=='')
            {
                $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'All fields are required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
            }else
            {
                $data_array = array();
                $data_array['d_by'] = $this->input->post('d_by');
                $data_array['d_date'] = date('Y-m-d H:i:s');
                $data_array['status'] = 0;
                $result = $this->Billing_model->update_billing_m($data_array,['ref_no'=>$this->input->post('ref_no')]);
                $result = $this->Billing_model->update_billing_test_m($data_array,['ref_no'=>$this->input->post('ref_no')]);
                if($result)
                {       $this->Payment_model->update_payement_m($data_array,['ref_no'=>$this->input->post('ref_no')]);
                     $this->response(['status' => True, 'response_data'=>[], 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);
                }else
                {
                    $this->response(['status' => FALSE, 'response_data'=>[], 'Message' =>'Failed'  , 'response_code'=>REST_Controller::HTTP_NOT_FOUND]);
                }

            }
        }
        
    }

    public function get_due_details_post()
    {
        if($this->input->post('ref_no')=='')
        {
            $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'All fields are required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
        }else
        {   
            $total_bill =  $this->Billing_model->getTotalAmount($this->input->post('ref_no'));
            $paid = $this->Billing_model->getTotalPaymentAmount($this->input->post('ref_no'));
            $due = round($total_bill-$paid,2);
            $this->response(['status' => True, 'response_data'=>$due, 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);
        }
    }

    public function update_payment_post()
    {
        if($this->input->post('payment_date')=='')
        {
            $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'Payment date required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('pay_amount')=='')
        {
            $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'Payment amount required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('payment_status')=='')
        {
            $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'Payment status required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('payment_mode')=='')
        {
            $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'Payment mode required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('ref_no')=='')
        {
            $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'Ref no required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('patient_id')=='')
        {
            $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'Patient required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
        }else
        {   

            $total_bill =  $this->Billing_model->getTotalAmount($this->input->post('ref_no'));
            $paid = $this->Billing_model->getTotalPaymentAmount($this->input->post('ref_no'));
            $due = round($total_bill-$paid,2);
            $pay = $this->input->post('pay_amount');
            if($pay>$due)
            {
                $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'Invalid amount passed !', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
            }else
            {
                $payment_array = array();
                $payment_array['ref_no'] = $this->input->post('ref_no');
                $payment_array['patient_id'] = $this->input->post('patient_id');
                $payment_array['mode'] = $this->input->post('payment_mode');
                $payment_array['dr_amount'] = $this->input->post('pay_amount');
                $payment_array['payment_date'] = date('Y-m-d H:i:s',strtotime($this->input->post('payment_date')));
                
                $payment_array['transaction_no'] = $this->input->post('transaction_id');
                $payment_array['remarks'] = 'Paid On Invoice';
                $payment_array['c_by'] = $this->input->post('c_by');
                $payment_array['c_date'] = date('Y-m-d H:i:s');
                $payment_array['status'] = 1;
                 $result = $this->Payment_model->create_payment_history_m($payment_array);
                 if($result==200)
                {
                    $data_array = array();
                    $data_array['paid_unpaid'] = $this->input->post('payment_status');
                    $this->Billing_model->paid_unpaid_billing_m($data_array,['ref_no'=>$this->input->post('ref_no')]);
                     $this->response(['status' => True, 'response_data'=>[], 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);
                }else
                {
                    $this->response(['status' => FALSE, 'response_data'=>[], 'Message' =>'Failed'  , 'response_code'=>REST_Controller::HTTP_NOT_FOUND]);
                } 
            }
        }
    }


public function alertPendingReport_post()
{
    $result = $this->Report_model->alertPendingReport_m();
    $this->response(['status' => True, 'response_data'=>$result, 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);
}

public function dashboard_report_post()
{
    if($this->input->post('clinic_code',true)!="")
    {
        $clinic_code = $this->input->post('clinic_code',true);
        $main_array = array();
        $main_array['total_earning'] = $this->Report_model->total_earning_m($clinic_code);
        $main_array['total_due'] = $this->Report_model->total_earning_due_m($clinic_code);
        $main_array['total_report_done'] = $this->Report_model->total_report_done_m($clinic_code);
        // $main_array['outing_earning'] = $this->Report_model->total_outing_income_m();
        $this->response(['status' => True, 'response_data'=>$main_array, 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);
    }else{
        $this->response(['status' => False, 'response_data'=>[], 'Message' =>'Clinic code required' , 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
    }
    
}


public function get_dashboard_report_post()
{
    if($this->input->post('clinic_code',true)!='')
    {
        $clinic_code = $this->input->post('clinic_code',true);
        $main_array['category_report'] = $this->Report_model->get_category_wise_count_report($clinic_code);
        $main_array['sales_report'] = $this->Report_model->get_last_30_days_sales_report($clinic_code);
        $main_array['test_report'] = $this->Report_model->get_test_wise_count_report($clinic_code);
        $main_array['doctors_report'] = $this->Report_model->get_refered_by_doctors_report($clinic_code);
        $this->response(['status' => True, 'response_data'=>$main_array, 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);
    }else{
        $this->response(['status' => False, 'response_data'=>[], 'Message' =>'Clinic Code Required' , 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
    }
   
}

public function update_report_print_status_post()
{  
    $ref_no = $this->input->post('ref_no');
    $result = $this->Report_model->get_print_test_list($ref_no);
    $this->response(['status' => True, 'response_data'=>$result, 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);
}

public function store_print_details_post()
{  
    $ref_no = $this->input->post('ref_no');
    $test_ids = $this->input->post('test_ids');
    $result = $this->Report_model->store_print_details(['ref_no'=>$ref_no,'test_ids'=>$test_ids],$ref_no);
    if($result)
    {
        $this->response(['status' => True, 'response_data'=>$ref_no, 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);
    }else
    {
         $this->response(['status' => False, 'response_data'=>[], 'Message' =>'failed' , 'response_code'=>REST_Controller::HTTP_OK]);
    }
   
}

public function getDashboardearningGraphReport_post()
{
    if($this->input->post('clinic_code',true)!="")
    {
        $clinic_code = $this->input->post('clinic_code',true);
        $date1=date('Y-m-d',strtotime('-6 day'));
        $date2=date('Y-m-d'); 
        $format = 'd-m-Y';
        $result = $this->displayDates($date1, $date2,$clinic_code, $format = 'd-m-Y');
        $this->response(['status' => True, 'response_data'=>$result, 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);
    }else{
        $this->response(['status' => True, 'response_data'=>[], 'Message' =>'Clinic Code Required' , 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
    }
    
}
public function displayDates($date1, $date2,$clinic_code, $format = 'd-m-Y' ) {
      $dates = array();
      $current = strtotime($date1);
      $date2 = strtotime($date2);
      $stepVal = '+1 day';
      $i=0;
      while( $current <= $date2 ) {
         $dates[$i]['date'] = date($format, $current);
         $dates[$i]['lab_amt'] = $this->Report_model->get_lab_report_earning(date($format, $current),$clinic_code);
         $current = strtotime($stepVal, $current);
         $i++;
      }
      return $dates;
   }

public function getVendorDueReport_post()
{
    $vendor_id = $this->input->post('vendor_id')!=''?$this->input->post('vendor_id'):'';
    $pay_status = $this->input->post('pay_status')!=''?$this->input->post('pay_status'):'';
    $from_date = $this->input->post('from_date')!=''?date('Y-m-d',strtotime($this->input->post('from_date'))):date('Y-m-d');
    $to_date = $this->input->post('to_date')!=''?date('Y-m-d',strtotime($this->input->post('to_date'))):date('Y-m-d');

    $result = $this->Report_model->getVendorPaymentDueReport_m($vendor_id,$pay_status,$from_date,$to_date);

    $this->response(['status' => True, 'response_data'=>$result, 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);

}






  
}

?>
