<?php
require APPPATH . 'libraries/REST_Controller.php';
     
class Billing extends REST_Controller {
    public function __construct() {
       parent::__construct();
       $this->load->model("Patient_model");
       $this->load->model("Billing_model");
       $this->load->model("Test_model");
       $this->load->model("Payment_model");
    }

    public function billing_master_post()
    {   
        
        $action = $this->input->post('action');
        // print_r($action);die;
        if($action=='C')
        {   
            
            $clinic_code = $this->input->post('clinic_code',true);
            $verifyFreePlanExist = $this->Billing_model->verifyClinicReportCountExistOrNot($clinic_code);
            if($verifyFreePlanExist==0)
            {
                $cFData = [];
                $cFData['clinic_code']= $clinic_code;
                $cFData['total_report']= 100;
                $cFData['status']= 1;
                $this->Billing_model->createClinicReportCount($cFData);
            }

            $verifyPlanExist = $this->Billing_model->verifyClinicReportPlanSubscribeExistOrNot($clinic_code);
            $freeStatus = true;
            if(!empty($verifyPlanExist))
            {
                //Plan Exist
                if(date('Y-m-d',strtotime($verifyPlanExist[0]['end_date']))<date('Y-m-d'))
                {
                    //Plan Expire
                    $freeStatus = true;
                }else
                {
                    //Plan Not Expire
                    $freeStatus = false;
                }

            }else
            {
                //Plan Not Exist
                $freeStatus = true;
            }

            if($freeStatus==true)
            {
                // Free Plan
                $freeCount = $this->Billing_model->getClinicReportCount($clinic_code);
                if($freeCount>0)
                {
                    if($this->input->post('c_by')=='')
                    {
                        $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'User id required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
                    }elseif($this->input->post('patient_type')=='')
                    {
                        $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'Patient type required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
                    }elseif($this->input->post('billing_date')=='')
                    {
                        $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'Billing date required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
                    }elseif($this->input->post('vendor_id')=='')
                    {
                        $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'Vendor id required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
                    }elseif($this->input->post('test_total_amount')=='')
                    {
                        $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'Test total required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
                    }elseif($this->input->post('discount_amount')=='')
                    {
                        $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'Discount at least 0 required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
                    }elseif($this->input->post('tax_type')=='')
                    {
                        $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'Tax type required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
                    }elseif($this->input->post('tax_rate')=='')
                    {
                        $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'Tax rate required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
                    }elseif($this->input->post('collection_charge')=='')
                    {
                        $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'Collection charges atleast 0 required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
                    }elseif($this->input->post('advance_amount')=='')
                    {
                        $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'Advance amount at least 0 required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
                    }elseif($this->input->post('payment_status')=='')
                    {
                        $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'Payment status required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
                    }elseif(empty($this->input->post('test_array')))
                    {
                        $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'Please add test required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
                    }elseif($this->input->post('payment_mode')=='')
                    {
                        $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'Payment mode required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
                    }elseif($this->input->post('patient_type')==1 && ($this->input->post('full_name')==''))
                    {
                                $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'Please enter patient name and phone required !!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
                    }elseif($this->input->post('patient_type')==0 && $this->input->post('patient_id')=='')
                    {
                                $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'Please select patient required !!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
                    }else
                    {   
                        if($this->input->post('patient_type')==1 && ($this->input->post('full_name')==''))
                        {
                                $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'Payment mode required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
                        }
                            $patient_id = $this->input->post('patient_id');
                            if($this->input->post('patient_type')==1)
                            {   
                                $data_array = array();
                                $data_array['title'] = $this->input->post('patient_title');
                                $data_array['full_name'] = $this->input->post('full_name');
                                $data_array['age'] = $this->input->post('patient_age');
                                $data_array['sex'] = $this->input->post('patient_sex');
                                $data_array['month'] = $this->input->post('patient_month');
                                $data_array['mobile'] = $this->input->post('patient_mobile');
                                $data_array['email'] = $this->input->post('patient_email');
                                $data_array['address'] = $this->input->post('patient_address');
                                $data_array['clinic_code'] = $this->input->post('clinic_code');
                                $data_array['c_by'] = $this->input->post('c_by');
                                $data_array['c_date'] = date('Y-m-d H:i:s');
                                $data_array['status'] = 1;
                                $patient_id = $this->Patient_model->create_get_patient_m($data_array);

                            }elseif($this->input->post('patient_type')==0)
                            {
                                $data_array = array();
                                $data_array['title'] = $this->input->post('patient_title');
                                $data_array['age'] = $this->input->post('patient_age');
                                $data_array['sex'] = $this->input->post('patient_sex');
                                $data_array['month'] = $this->input->post('patient_month');
                                $data_array['mobile'] = $this->input->post('patient_mobile');
                                $data_array['email'] = $this->input->post('patient_email');
                                $data_array['address'] = $this->input->post('patient_address');
                                $data_array['d_by'] = $this->input->post('d_by');
                                $data_array['d_date'] = date('Y-m-d H:i:s');
                                $data_array['status'] = 1;
                                $this->Patient_model->update_patient_m($data_array,$this->input->post('patient_id'),$this->input->post('clinic_code'));
                            }
                            $billing_master_array = array();
                            $billing_master_array['patient_id'] = $patient_id;
                            $billing_master_array['vendor_id'] = $this->input->post('vendor_id');
                            $billing_master_array['tax_type'] = $this->input->post('tax_type');
                            $billing_master_array['paid_unpaid'] = $this->input->post('payment_status');
                            $billing_master_array['clinic_code'] = $this->input->post('clinic_code');
                            $billing_master_array['billing_date'] = date('Y-m-d H:i:s',strtotime($this->input->post('billing_date')));
                            
                            if($this->input->post('tax_type')==1)
                            {
                                $total_amount = $this->input->post('test_total_amount');
                                $discount = $this->input->post('discount_amount');
                                $taxable_amount = $total_amount-$discount;
                                $tax_rate = $this->input->post('tax_rate');
                                $tax_amount = $taxable_amount*($tax_rate/100);

                                $billing_master_array['cgst'] = 0;
                                $billing_master_array['sgst'] = 0;
                                $billing_master_array['igst'] = round($tax_amount,2);

                            }else if($this->input->post('tax_type')==2)
                            {
                                $total_amount = $this->input->post('test_total_amount');
                                $discount = $this->input->post('discount_amount');
                                $taxable_amount = $total_amount-$discount;
                                $tax_rate = $this->input->post('tax_rate');
                                $tax_amount = $taxable_amount*($tax_rate/100);

                                $billing_master_array['cgst'] = round(($tax_amount/2),2);;
                                $billing_master_array['sgst'] = round(($tax_amount/2),2);;
                                $billing_master_array['igst'] = 0;
                            }
                            $billing_master_array['tax_rate'] = $this->input->post('tax_rate');
                            $billing_master_array['collection_charge'] = $this->input->post('collection_charge');
                            $billing_master_array['discount'] = $this->input->post('discount_amount');
                            $billing_master_array['total_amount'] = $this->input->post('test_total_amount');
                            $billing_master_array['grand_total_amount'] = $taxable_amount+$tax_amount+$this->input->post('collection_charge');
                            
                            $billing_master_array['c_by'] = $this->input->post('c_by');
                            $billing_master_array['c_date'] = date('Y-m-d H:i:s');
                            $billing_master_array['status'] = 1;
                            $ref_no = $this->Billing_model->create_billing_m($billing_master_array);
                            if($ref_no!=105)
                            {
                                $freeCount = $freeCount-1;
                                $this->Billing_model->updateClinicReportCount(['total_report'=>$freeCount],['clinic_code'=>$clinic_code,'status'=>1]);
                                $test_list = json_decode($this->input->post('test_array'),TRUE);
                                foreach($test_list as $key=>$value)
                                {
                                    $test_data = array();
                                    $test_data['ref_no'] = $ref_no;
                                    $test_data['test_id'] = $value;
                                    $data = $this->Test_model->get_test_details_id_m($value,$this->input->post('clinic_code'));
                                    $test_data['rate'] = $data['rate'];
                                    $test_data['category_id'] = $data['category_id'];
                                    $test_data['c_by'] = $this->input->post('c_by');
                                    $test_data['c_date'] = date('Y-m-d H:i:s');
                                    $test_data['status'] = 1;
                                    $result_test = $this->Billing_model->create_billing_test_m($test_data);
                                }
                            if($this->input->post('advance_amount')>0)
                            {
                                $payment_array = array();
                                $payment_array['ref_no'] = $ref_no;
                                $payment_array['patient_id'] = $patient_id;
                                $payment_array['mode'] = $this->input->post('payment_mode');
                                $payment_array['dr_amount'] = $this->input->post('advance_amount');
                                $payment_array['payment_date'] = date('Y-m-d H:i:s',strtotime($this->input->post('billing_date')));
                                
                                $payment_array['transaction_no'] = $this->input->post('transaction_id');
                                $payment_array['remarks'] = 'Invoice Generated';
                                $payment_array['c_by'] = $this->input->post('c_by');
                                $payment_array['c_date'] = date('Y-m-d H:i:s');
                                $payment_array['status'] = 1;
                                 $result = $this->Payment_model->create_payment_history_m($payment_array);
                                 if($result==200)
                                {
                                     $this->response(['status' => True, 'response_data'=>[], 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);
                                }else
                                {
                                    $this->response(['status' => FALSE, 'response_data'=>[], 'Message' =>'Failed'  , 'response_code'=>REST_Controller::HTTP_NOT_FOUND]);
                                } 
                            }else
                            {
                                if($result_test)
                                {
                                     $this->response(['status' => True, 'response_data'=>[], 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);
                                }else
                                {
                                    $this->response(['status' => FALSE, 'response_data'=>[], 'Message' =>'Failed'  , 'response_code'=>REST_Controller::HTTP_NOT_FOUND]);
                                } 
                            }
                            


                        }   
                    }
                }else
                {
                     $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'Your report limits are finished please upgrade your plan.', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]); 
                }

            }elseif($freeStatus==false)
            {
                //Upgrade Plan Not Expire
                    if($this->input->post('c_by')=='')
                    {
                        $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'User id required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
                    }elseif($this->input->post('patient_type')=='')
                    {
                        $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'Patient type required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
                    }elseif($this->input->post('billing_date')=='')
                    {
                        $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'Billing date required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
                    }elseif($this->input->post('vendor_id')=='')
                    {
                        $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'Vendor id required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
                    }elseif($this->input->post('test_total_amount')=='')
                    {
                        $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'Test total required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
                    }elseif($this->input->post('discount_amount')=='')
                    {
                        $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'Discount at least 0 required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
                    }elseif($this->input->post('tax_type')=='')
                    {
                        $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'Tax type required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
                    }elseif($this->input->post('tax_rate')=='')
                    {
                        $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'Tax rate required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
                    }elseif($this->input->post('collection_charge')=='')
                    {
                        $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'Collection charges atleast 0 required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
                    }elseif($this->input->post('advance_amount')=='')
                    {
                        $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'Advance amount at least 0 required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
                    }elseif($this->input->post('payment_status')=='')
                    {
                        $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'Payment status required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
                    }elseif(empty($this->input->post('test_array')))
                    {
                        $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'Please add test required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
                    }elseif($this->input->post('payment_mode')=='')
                    {
                        $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'Payment mode required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
                    }elseif($this->input->post('patient_type')==1 && ($this->input->post('full_name')==''))
                    {
                                $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'Please enter patient name and phone required !!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
                    }elseif($this->input->post('patient_type')==0 && $this->input->post('patient_id')=='')
                    {
                                $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'Please select patient required !!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
                    }else
                    {   
                        if($this->input->post('patient_type')==1 && ($this->input->post('full_name')==''))
                        {
                                $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'Payment mode required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
                        }
                            $patient_id = $this->input->post('patient_id');
                            if($this->input->post('patient_type')==1)
                            {   
                                $data_array = array();
                                $data_array['title'] = $this->input->post('patient_title');
                                $data_array['full_name'] = $this->input->post('full_name');
                                $data_array['age'] = $this->input->post('patient_age');
                                $data_array['sex'] = $this->input->post('patient_sex');
                                $data_array['month'] = $this->input->post('patient_month');
                                $data_array['mobile'] = $this->input->post('patient_mobile');
                                $data_array['email'] = $this->input->post('patient_email');
                                $data_array['address'] = $this->input->post('patient_address');
                                $data_array['clinic_code'] = $this->input->post('clinic_code');
                                $data_array['c_by'] = $this->input->post('c_by');
                                $data_array['c_date'] = date('Y-m-d H:i:s');
                                $data_array['status'] = 1;
                                $patient_id = $this->Patient_model->create_get_patient_m($data_array);

                            }elseif($this->input->post('patient_type')==0)
                            {
                                $data_array = array();
                                $data_array['title'] = $this->input->post('patient_title');
                                $data_array['age'] = $this->input->post('patient_age');
                                $data_array['sex'] = $this->input->post('patient_sex');
                                $data_array['month'] = $this->input->post('patient_month');
                                $data_array['mobile'] = $this->input->post('patient_mobile');
                                $data_array['email'] = $this->input->post('patient_email');
                                $data_array['address'] = $this->input->post('patient_address');
                                $data_array['d_by'] = $this->input->post('d_by');
                                $data_array['d_date'] = date('Y-m-d H:i:s');
                                $data_array['status'] = 1;
                                $this->Patient_model->update_patient_m($data_array,$this->input->post('patient_id'),$this->input->post('clinic_code'));
                            }
                            $billing_master_array = array();
                            $billing_master_array['patient_id'] = $patient_id;
                            $billing_master_array['vendor_id'] = $this->input->post('vendor_id');
                            $billing_master_array['tax_type'] = $this->input->post('tax_type');
                            $billing_master_array['paid_unpaid'] = $this->input->post('payment_status');
                            $billing_master_array['clinic_code'] = $this->input->post('clinic_code');
                            $billing_master_array['billing_date'] = date('Y-m-d H:i:s',strtotime($this->input->post('billing_date')));
                            
                            if($this->input->post('tax_type')==1)
                            {
                                $total_amount = $this->input->post('test_total_amount');
                                $discount = $this->input->post('discount_amount');
                                $taxable_amount = $total_amount-$discount;
                                $tax_rate = $this->input->post('tax_rate');
                                $tax_amount = $taxable_amount*($tax_rate/100);

                                $billing_master_array['cgst'] = 0;
                                $billing_master_array['sgst'] = 0;
                                $billing_master_array['igst'] = round($tax_amount,2);

                            }else if($this->input->post('tax_type')==2)
                            {
                                $total_amount = $this->input->post('test_total_amount');
                                $discount = $this->input->post('discount_amount');
                                $taxable_amount = $total_amount-$discount;
                                $tax_rate = $this->input->post('tax_rate');
                                $tax_amount = $taxable_amount*($tax_rate/100);

                                $billing_master_array['cgst'] = round(($tax_amount/2),2);;
                                $billing_master_array['sgst'] = round(($tax_amount/2),2);;
                                $billing_master_array['igst'] = 0;
                            }
                            $billing_master_array['tax_rate'] = $this->input->post('tax_rate');
                            $billing_master_array['collection_charge'] = $this->input->post('collection_charge');
                            $billing_master_array['discount'] = $this->input->post('discount_amount');
                            $billing_master_array['total_amount'] = $this->input->post('test_total_amount');
                            $billing_master_array['grand_total_amount'] = $taxable_amount+$tax_amount+$this->input->post('collection_charge');
                            
                            $billing_master_array['c_by'] = $this->input->post('c_by');
                            $billing_master_array['c_date'] = date('Y-m-d H:i:s');
                            $billing_master_array['status'] = 1;
                            $ref_no = $this->Billing_model->create_billing_m($billing_master_array);
                            if($ref_no!=105)
                            {
                                $test_list = json_decode($this->input->post('test_array'),TRUE);
                                foreach($test_list as $key=>$value)
                                {
                                    $test_data = array();
                                    $test_data['ref_no'] = $ref_no;
                                    $test_data['test_id'] = $value;
                                    $data = $this->Test_model->get_test_details_id_m($value,$this->input->post('clinic_code'));
                                    $test_data['rate'] = $data['rate'];
                                    $test_data['category_id'] = $data['category_id'];
                                    $test_data['c_by'] = $this->input->post('c_by');
                                    $test_data['c_date'] = date('Y-m-d H:i:s');
                                    $test_data['status'] = 1;
                                    $result_test = $this->Billing_model->create_billing_test_m($test_data);
                                }
                            if($this->input->post('advance_amount')>0)
                            {
                                $payment_array = array();
                                $payment_array['ref_no'] = $ref_no;
                                $payment_array['patient_id'] = $patient_id;
                                $payment_array['mode'] = $this->input->post('payment_mode');
                                $payment_array['dr_amount'] = $this->input->post('advance_amount');
                                $payment_array['payment_date'] = date('Y-m-d H:i:s',strtotime($this->input->post('billing_date')));
                                
                                $payment_array['transaction_no'] = $this->input->post('transaction_id');
                                $payment_array['remarks'] = 'Invoice Generated';
                                $payment_array['c_by'] = $this->input->post('c_by');
                                $payment_array['c_date'] = date('Y-m-d H:i:s');
                                $payment_array['status'] = 1;
                                 $result = $this->Payment_model->create_payment_history_m($payment_array);
                                 if($result==200)
                                {
                                     $this->response(['status' => True, 'response_data'=>[], 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);
                                }else
                                {
                                    $this->response(['status' => FALSE, 'response_data'=>[], 'Message' =>'Failed'  , 'response_code'=>REST_Controller::HTTP_NOT_FOUND]);
                                } 
                            }else
                            {
                                if($result_test)
                                {
                                     $this->response(['status' => True, 'response_data'=>[], 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);
                                }else
                                {
                                    $this->response(['status' => FALSE, 'response_data'=>[], 'Message' =>'Failed'  , 'response_code'=>REST_Controller::HTTP_NOT_FOUND]);
                                } 
                            }
                            


                        }   
                    }

            }
            

        }elseif($action=='R')
        {
           $clinic_code = $this->input->post('clinic_code',true)!=""?$this->input->post('clinic_code',true):"";
           $from_date = $this->input->post('from_date')!=""?$this->input->post('from_date'):date('Y-m-d');
           $to_date = $this->input->post('to_date')!=""?$this->input->post('to_date'):date('Y-m-d');
           $result = $this->Billing_model->get_billing_list_m($clinic_code,$from_date,$to_date);
           if($result!=105)
            {
                 $this->response(['status' => True, 'response_data'=>$result, 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);
            }else
            {
                $this->response(['status' => FALSE, 'response_data'=>[], 'Message' =>'Failed'  , 'response_code'=>REST_Controller::HTTP_NOT_FOUND]);
            }
            
        }elseif($action=='P')
        {
           $result = $this->Billing_model->get_pending_report_list_m();
           if($result!=105)
            {
                 $this->response(['status' => True, 'response_data'=>$result, 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);
            }else
            {
                $this->response(['status' => FALSE, 'response_data'=>[], 'Message' =>'Failed'  , 'response_code'=>REST_Controller::HTTP_NOT_FOUND]);
            }
            
        }elseif($action=='S')
        {
            $this->input->post('ref_no')!=""?$ref_no=$this->input->post('ref_no'):$ref_no="";
           $result = $this->Payment_model->getPaymentHistory($ref_no);
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
                $payment_array['cr_amount'] = $this->input->post('pay_amount');
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


public function get_billing_print_details_post()
{   
    if($this->input->post('ref_no')!='')
    {
        $ref_no = $this->input->post('ref_no');
        $basic = $this->Billing_model->getPatientDetails_m($ref_no);
        $result = $this->Billing_model->getBillingDetailsList_m($ref_no);
        $this->response(['status' => True, 'response_data'=>$result,'basic_data'=>$basic,'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);
    }else
    {
        $this->response(['status' => FALSE, 'response_data'=>[],'basic_data'=>[], 'Message' =>'Ref No required'  , 'response_code'=>REST_Controller::HTTP_NOT_FOUND]);
    }
}
  
public function update_print_status_post()
{
    $data['print_status'] = $this->input->post('print_status');
    $where['ref_no'] = $this->input->post('ref_no');
    $result = $this->Billing_model->update_billing_m($data,$where);
    if($result)
    {
         $this->response(['status' => True, 'response_data'=>[], 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);
    }else
    {
        $this->response(['status' => FALSE, 'response_data'=>[], 'Message' =>'Failed'  , 'response_code'=>REST_Controller::HTTP_NOT_FOUND]);
    } 
}


public function update_digital_sign_status_now_post()
{
    $data['digital_sign'] = $this->input->post('status');
    $where['ref_no'] = $this->input->post('ref_no');
    $result = $this->Billing_model->update_billing_m($data,$where);
    if($result)
    {
         $this->response(['status' => True, 'response_data'=>[], 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);
    }else
    {
        $this->response(['status' => FALSE, 'response_data'=>[], 'Message' =>'Failed'  , 'response_code'=>REST_Controller::HTTP_NOT_FOUND]);
    } 
}


public function getbillDetails_post()
{

    $bill_no = $this->input->post('bill_no');
    $total = $this->Billing_model->getTotalDataAmount($bill_no);
    if(!empty($total))
    {
        $paid = $this->Billing_model->getTotalPaymentCrAmount($bill_no);
        $rem = $total['grand_total_amount']-$paid;

        $this->response(['status' => True, 'response_data'=>['balance'=>$rem,'paid'=>$paid,'data'=>$total], 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);
    }else
    {
        $this->response(['status' => False, 'response_data'=>['balance'=>0], 'Message' =>'Invalid Bill No.' , 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
    }
    
}



public function getWallet_post()
{
    $clinic_code = $this->input->post('clinic_code');
    $bal = $this->Billing_model->getWalletBalances($clinic_code);
    $history = $this->Billing_model->getWalletHistory($clinic_code);
    $this->response(['status' => True, 'response_data'=>['balance'=>$bal,'history'=>$history], 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);
}



    public function payBillPayment_post()
    {
        if($this->input->post('shopping_order_id',true)=='')
        {
            $this->response(['status' => False, 'response_data'=>[], 'Message' =>'Bill No. Required !' , 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('amount',true)=='')
        {
            $this->response(['status' => False, 'response_data'=>[], 'Message' =>'amount Required !' , 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('clinic_code',true)=='')
        {
            $this->response(['status' => False, 'response_data'=>[], 'Message' =>'clinic_code Required !' , 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('razorpay_payment_id',true)=='')
        {
            $this->response(['status' => False, 'response_data'=>[], 'Message' =>'razorpay_payment_id Required !' , 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('razorpay_order_id',true)=='')
        {
            $this->response(['status' => False, 'response_data'=>[], 'Message' =>'razorpay_order_id Required !' , 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('razorpay_signature',true)=='')
        {
            $this->response(['status' => False, 'response_data'=>[], 'Message' =>'razorpay_signature Required !' , 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('curent_status',true)=='')
        {
            $this->response(['status' => False, 'response_data'=>[], 'Message' =>'curent_status Required !' , 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
        }elseif($this->input->post('patient_id',true)=='')
        {
            $this->response(['status' => False, 'response_data'=>[], 'Message' =>'patient_id Required !' , 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
        }else
        {
            $bill_no =  $this->input->post('shopping_order_id',true);
            $amount = $this->input->post('amount',true);
            $clinic_code  = $this->input->post('clinic_code',true);
            $razorpay_payment_id = $this->input->post('razorpay_payment_id',true);
            $razorpay_order_id = $this->input->post('razorpay_order_id',true);
            $razorpay_signature = $this->input->post('razorpay_signature',true);
            $curent_status = $this->input->post('curent_status',true);
            $patient_id = $this->input->post('patient_id',true);

            /*Store Payment Gatway Response*/
            $paymentGatwayLogData = [];
            $paymentGatwayLogData['razorpay_payment_id'] = $razorpay_payment_id;
            $paymentGatwayLogData['clinic_code'] = $clinic_code;
            $paymentGatwayLogData['transaction_date'] = date('Y-m-d H:i:s');
            $paymentGatwayLogData['curent_status'] = $curent_status;
            $paymentGatwayLogData['amount'] = $amount;
            $paymentGatwayLogData['razorpay_order_id'] = $razorpay_order_id;
            $paymentGatwayLogData['razorpay_signature'] = $razorpay_signature;
            $paymentGatwayLogData['ref_no'] = $bill_no;
            $paymentGatwayLogData['status'] = 1;
            $this->Billing_model->paymentGatwayBillLog($paymentGatwayLogData);

            if($curent_status=='success')
            {
                /*Verify & Create Wallet*/
                $verifyWalletExist = $this->Billing_model->verifyWalletExist($clinic_code);
                if($verifyWalletExist==0)
                {
                    $wcreateData = [];
                    $wcreateData['clinic_code'] = $clinic_code;
                    $wcreateData['bal_amount'] = 0;
                    $wcreateData['c_date'] = date('Y-m-d H:i:s');
                    $wcreateData['c_by'] = "AUTO";
                    $wcreateData['status'] = 1;
                    $wcreateData['w_amount'] = 0;
                    $this->Billing_model->createWallet($wcreateData);
                }

                /*Store Wallet Transaction Log*/
                $transactionData = [];
                $transactionData['clinic_code'] = $clinic_code;
                $transactionData['debit_amount'] = 0;
                $transactionData['credit_amount'] = $amount;
                $transactionData['t_date_time'] = date('Y-m-d H:i:s');
                $transactionData['c_date'] = date('Y-m-d H:i:s');
                $transactionData['c_by'] = "AUTO";
                $transactionData['ref_no'] = $bill_no;
                $transactionData['status'] = 1;
                $transactionData['descriptions'] = "RS_".$amount."_PAYMENT_RECIEVED_FOR_".$bill_no;
                $this->Billing_model->createWalletTransactionLog($transactionData);

                /*Update Wallet Balance*/
                $balance = $this->Billing_model->getWalletBalance($clinic_code);
                $balance += $amount;
                $this->Billing_model->updateWallet(['bal_amount'=>$balance,'d_date'=>date('Y-m-d H:i:s')],['clinic_code'=>$clinic_code,'status'=>1]);

                $paymentHistoryLogData = [];
                $paymentHistoryLogData['payment_date'] = date('Y-m-d H:i:s');
                $paymentHistoryLogData['ref_no'] = $bill_no;
                $paymentHistoryLogData['patient_id'] = $patient_id;
                $paymentHistoryLogData['mode'] = "online";
                $paymentHistoryLogData['dr_amount'] = 0;
                $paymentHistoryLogData['cr_amount'] = $amount;
                $paymentHistoryLogData['transaction_no'] = $razorpay_payment_id;
                $paymentHistoryLogData['remarks'] = "RS_".$amount."_PAYMENT_RECIEVED_FOR_".$bill_no;
                $paymentHistoryLogData['c_by'] = "AUTO";
                $paymentHistoryLogData['c_date'] = date('Y-m-d H:i:s');
                $this->Billing_model->paymentHistoryLog($paymentHistoryLogData);
                $this->Billing_model->updateBillPaidStatus(['paid_unpaid'=>1],['ref_no'=>$bill_no]);
            }

             $this->response(['status' => True, 'response_data'=>[], 'Message' =>'success !' , 'response_code'=>REST_Controller::HTTP_OK]);
            
        }
    }







}

?>
