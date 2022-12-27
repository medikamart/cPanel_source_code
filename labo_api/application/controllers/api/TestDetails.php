<?php
require APPPATH . 'libraries/REST_Controller.php';
     
class TestDetails extends REST_Controller {
    public function __construct() {
       parent::__construct();
       $this->load->model("TestDetails_model");
        
    }

    public function test_details_master_post()
    {   
        $action = $this->input->post('action');
        if($action=='C')
        {   
            if($this->input->post('test_id',true)=='' || $this->input->post('sub_test_name',true)=='' || $this->input->post('unit_id',true)=='' || $this->input->post('result_box',true)=='' || $this->input->post('c_by',true)=='' || $this->input->post('clinic_code',true)=='')
            {
                $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'All fields are required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
            }else
            {   
                
                    $data_array = array();
                    $data_array['test_id'] = $this->input->post('test_id',true);
                    $data_array['sub_test_name'] = $this->input->post('sub_test_name',true);
                    $data_array['clinic_code'] = $this->input->post('clinic_code',true);
                    $data_array['unit_id'] = $this->input->post('unit_id',true);
                    $data_array['test_reference_id'] = $this->input->post('test_reference_id',true);
                    $data_array['result_box'] = $this->input->post('result_box',true);
                    $data_array['c_by'] = $this->input->post('c_by',true);
                    $data_array['c_date'] = date('Y-m-d H:i:s');
                    $data_array['status'] = 1;
                    $result = $this->TestDetails_model->create_test_details_m($data_array);
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
           $this->input->post('test_id',true)!=''?$test_id = $this->input->post('test_id',true):$test_id='';
           $this->input->post('clinic_code',true)!=''?$clinic_code = $this->input->post('clinic_code',true):$clinic_code='';
           $result = $this->TestDetails_model->get_sub_test_list_m($test_id,$this->input->post('clinic_code',true));
           if($result!=105)
            {
                 $this->response(['status' => True, 'response_data'=>$result, 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);
            }else
            {
                $this->response(['status' => FALSE, 'response_data'=>[], 'Message' =>'Failed'  , 'response_code'=>REST_Controller::HTTP_NOT_FOUND]);
            }
            
        }elseif($action=='U')
        {
            if($this->input->post('d_by',true)=='' || $this->input->post('sub_test_id',true)=='' || $this->input->post('sub_test_name',true)=='' || $this->input->post('unit_id',true)=='' || $this->input->post('result_box',true)=='' || $this->input->post('clinic_code',true)=='')
            {
                $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'All fields are required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
            }else
            {
                $data_array = array();
                $data_array['d_by'] = $this->input->post('d_by');
                $data_array['d_date'] = date('Y-m-d H:i:s');
                $data_array['status'] = 1;
                $data_array['sub_test_name'] = $this->input->post('sub_test_name');
                $data_array['unit_id'] = $this->input->post('unit_id');
                $data_array['test_reference_id'] = $this->input->post('test_reference_id');
                $data_array['result_box'] = $this->input->post('result_box');

                $result = $this->TestDetails_model->update_sub_test_m($data_array,$this->input->post('sub_test_id',true),$this->input->post('clinic_code',true));
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
            if($this->input->post('d_by',true)=='' || $this->input->post('sub_test_id',true)=='' || $this->input->post('clinic_code',true)=='')
            {
                $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'All fields are required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
            }else
            {
                $data_array = array();
                $data_array['d_by'] = $this->input->post('d_by');
                $data_array['d_date'] = date('Y-m-d H:i:s');
                $data_array['status'] = 0;
                $result = $this->TestDetails_model->update_sub_test_m($data_array,$this->input->post('sub_test_id',true),$this->input->post('clinic_code',true));
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
