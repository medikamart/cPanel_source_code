<?php
require APPPATH . 'libraries/REST_Controller.php';
     
class Payment extends REST_Controller {


    public function __construct() {
       parent::__construct();
       $this->load->model("Payment_model");
    }

    public function SavepaymentGatway_post()
    {
        if($this->input->post('razorpay_payment_id',true)=='')
        {
            $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'razorpay_payment_id fields are required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
        }if($this->input->post('razorpay_order_id',true)=='')
        {
            $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'razorpay_order_id fields are required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
        }if($this->input->post('razorpay_signature',true)=='')
        {
            $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'razorpay_signature fields are required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('user_id',true)=='')
        {
            $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'user_id fields are required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('clinic_code',true)=='')
        {
            $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'clinic_code fields are required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('amount',true)=='')
        {
            $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'amount fields are required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('status',true)=='')
        {
            $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'status fields are required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('ref_no',true)=='')
        {
            $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'ref_no fields are required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
        }else
        {
            $data = [];
            $data['razorpay_payment_id'] = $this->input->post('razorpay_payment_id',true);
            $data['razorpay_order_id'] = $this->input->post('razorpay_order_id',true);
            $data['razorpay_signature'] = $this->input->post('razorpay_signature',true);
            $data['ref_no'] = $this->input->post('ref_no',true);
            $data['user_id'] = $this->input->post('user_id',true);
            $data['clinic_code'] = $this->input->post('clinic_code',true);
            $data['amount'] = $this->input->post('amount',true);
            $data['curent_status'] = $this->input->post('status',true);
            $data['status'] = 1;
            $data['transaction_date'] = date('Y-m-d H:i:s');
            $this->Payment_model->save_payment_gateway_m($data);

            $current_subscription = $this->Payment_model->getSubscriptionData($this->input->post('ref_no',true),"",$this->input->post('clinic_code',true));
            $prev_subscription = $this->Payment_model->getSubscriptionData("","paid",$this->input->post('clinic_code',true));
            $days = $current_subscription[0]['days'];
            if(!empty($prev_subscription))
            {
                $end_date = $prev_subscription[0]['end_date'];
                $start_date = $end_date;
                $expiry_date = date('Y-m-d H:i:s',strtotime("+".$days." day", strtotime($start_date)));
                $this->Payment_model->update_subcription_data_m(['start_date'=>$start_date,'end_date'=>$expiry_date,'current_status'=>'paid'],['subscription_id'=>$this->input->post('ref_no',true)]);
                $this->Payment_model->update_clinic_data_m(['expiry_date'=>$expiry_date],['clinic_code'=>$this->input->post('clinic_code',true)]);

            }else
            {
                $start_date = date('Y-m-d H:i:s');
                $expiry_date = date('Y-m-d H:i:s',strtotime("+".$days." day", strtotime($start_date)));
                $this->Payment_model->update_subcription_data_m(['start_date'=>$start_date,'end_date'=>$expiry_date,'current_status'=>'paid'],['subscription_id'=>$this->input->post('ref_no',true)]);
                $this->Payment_model->update_clinic_data_m(['expiry_date'=>$expiry_date],['clinic_code'=>$this->input->post('clinic_code',true)]);
            }

            $this->response(['status'=>true, 'response_data'=>[], 'Message'=>'Successfully Saved', 'response_code'=>REST_Controller::HTTP_OK]);
        } 
    }

    public function getSubscriptionId_post()
    {
        if($this->input->post('clinic_code',true)=='')
        {
            $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'clinic_code fields are required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('plan_id',true)=='')
        {
            $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'plan_id fields are required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('amount',true)=='')
        {
            $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'amount fields are required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('days',true)=='')
        {
            $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'days fields are required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('user_id',true)=='')
        {
            $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'user_id fields are required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
        }else
        {
            $data = [];
            $data['subscription_id'] = $this->Payment_model->getSubscriptionNo();
            $data['clinic_code'] = $this->input->post('clinic_code',true);
            $data['plan_id'] = $this->input->post('plan_id',true);
            $data['amount'] = $this->input->post('amount',true);
            $data['days'] = $this->input->post('days',true);
            $data['user_id'] = $this->input->post('user_id',true);
            $data['current_status'] = 'pending';
            $data['status'] = 1;
            $this->Payment_model->save_subcription_data_m($data);

            $this->response(['status'=>true, 'response_data'=>['subscription_id'=>$data['subscription_id']], 'Message'=>'Successfully Generated', 'response_code'=>REST_Controller::HTTP_OK]);
        } 
    }

    public function getMySubscriptions_post()
    {
        if($this->input->post('clinic_code',true)=='')
        {
            $this->response(['status'=>false, 'response_data'=>[], 'Message'=>'clinic_code fields are required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
        }else
        {
            
            $result = $this->Payment_model->getSubscriptionDataList($this->input->post('clinic_code',true));

            $this->response(['status'=>true, 'response_data'=>$result, 'Message'=>'Successfully Generated', 'response_code'=>REST_Controller::HTTP_OK]);
        } 
    }




}

?>
