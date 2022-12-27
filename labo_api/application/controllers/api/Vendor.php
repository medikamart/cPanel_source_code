<?php
require APPPATH . 'libraries/REST_Controller.php';
     
class Vendor extends REST_Controller {
    public function __construct() {
       parent::__construct();
       $this->load->model("Vendor_model");
        
    }

    public function vendor_master_post()
    {   
        $action = $this->input->post('action');
        // print_r($action);die;
        if($action=='C')
        {   
            if($this->input->post('vendor_name',true)==''|| $this->input->post('c_by',true)=='' || $this->input->post('clinic_code',true)=='')
            {
                $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'All fields are required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
            }else
            {   

                    $data_array = array();
                    $data_array['vendor_name'] = $this->input->post('vendor_name',true);
                    $data_array['vendor_firm'] = $this->input->post('vendor_firm',true);
                    $data_array['clinic_code'] = $this->input->post('clinic_code',true);
                    $data_array['vendor_phone'] = $this->input->post('vendor_phone',true);
                    $data_array['vendor_email'] = $this->input->post('vendor_email',true);
                    $data_array['vendor_telephone'] = $this->input->post('vendor_telephone',true);
                    $data_array['c_by'] = $this->input->post('c_by');
                    $data_array['c_date'] = date('Y-m-d H:i:s');
                    $data_array['status'] = 1;
                    $result = $this->Vendor_model->create_vendor_m($data_array);
                    if($result)
                    {
                         $this->response(['status' => True, 'response_data'=>[], 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);
                    }else
                    {
                        $this->response(['status' => FALSE, 'response_data'=>[], 'Message' =>'Failed'  , 'response_code'=>REST_Controller::HTTP_NOT_FOUND]);
                    } 
                
            }

        }elseif($action=='R')
        {
            // print_r($action);die;
           $this->input->post('id',true)!=''?$id = $this->input->post('id',true):$id='';
           $this->input->post('clinic_code',true)!=''?$clinic_code = $this->input->post('clinic_code',true):$clinic_code='';
           $result = $this->Vendor_model->get_vendor_list_m($id,$clinic_code);
           if($result!=105)
            {
                 $this->response(['status' => True, 'response_data'=>$result, 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);
            }else
            {
                $this->response(['status' => FALSE, 'response_data'=>[], 'Message' =>'Failed'  , 'response_code'=>REST_Controller::HTTP_NOT_FOUND]);
            }
            
        }elseif($action=='U')
        {
            // print_r($action);die;
           if($this->input->post('vendor_name',true)=='' || $this->input->post('d_by',true)=='' || $this->input->post('id',true)=='' || $this->input->post('clinic_code',true)=='')
            {
                $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'All fields are required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
            }else
            {
                
                    $data_array = array();
                    $data_array['vendor_name'] = $this->input->post('vendor_name');
                    $data_array['vendor_firm'] = $this->input->post('vendor_firm');
                    $data_array['vendor_phone'] = $this->input->post('vendor_phone');
                    $data_array['vendor_email'] = $this->input->post('vendor_email');
                    $data_array['vendor_telephone'] = $this->input->post('vendor_telephone');
                    $data_array['d_by'] = $this->input->post('d_by');
                    $data_array['d_date'] = date('Y-m-d H:i:s');
                    $data_array['status'] = 1;
                    $result = $this->Vendor_model->update_vendor_m($data_array,$this->input->post('id',true),$this->input->post('clinic_code',true));
                    if($result)
                    {
                         $this->response(['status' => True, 'response_data'=>[], 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);
                    }else
                    {
                        $this->response(['status' => FALSE, 'response_data'=>[], 'Message' =>'Failed'  , 'response_code'=>REST_Controller::HTTP_NOT_FOUND]);
                    }
                
            } 
            
        }elseif($action=='D')
        {
            // print_r($action);die;
            if($this->input->post('d_by',true)=='' || $this->input->post('id',true)=='' || $this->input->post('clinic_code',true)=='')
            {
                $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'All fields are required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
            }else
            {
                $data_array = array();
                $data_array['d_by'] = $this->input->post('d_by');
                $data_array['d_date'] = date('Y-m-d H:i:s');
                $data_array['status'] = 0;
                $result = $this->Vendor_model->update_vendor_m($data_array,$this->input->post('id',true),$this->input->post('clinic_code',true));
                if($result)
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

?>
