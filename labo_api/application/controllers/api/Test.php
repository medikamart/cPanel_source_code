<?php
require APPPATH . 'libraries/REST_Controller.php';
     
class Test extends REST_Controller {
    public function __construct() {
       parent::__construct();
       $this->load->model("Test_model");
        
    }

    public function test_master_post()
    {   
        $action = $this->input->post('action');
        if($action=='C')
        {   
            if($this->input->post('category_id',true)=='' || $this->input->post('test_name',true)=='' || $this->input->post('rate',true)=='' || $this->input->post('c_by',true)=='' || $this->input->post('clinic_code',true)=='')
            {
                $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'All fields are required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
            }else
            {   
                $verify = $this->Test_model->veryfy_create_test_m($this->input->post('test_name',true),$this->input->post('category_id',true),$this->input->post('clinic_code',true));
                if($verify==200)
                {
                    $data_array = array();
                    $data_array['category_id'] = $this->input->post('category_id',true);
                    $data_array['test_name'] = $this->input->post('test_name',true);
                    $data_array['clinic_code'] = $this->input->post('clinic_code',true);
                    $data_array['rate'] = $this->input->post('rate',true);
                    $data_array['c_by'] = $this->input->post('c_by',true);
                    $data_array['c_date'] = date('Y-m-d H:i:s');
                    $data_array['global'] = 0;
                    $data_array['status'] = 1;
                    $result = $this->Test_model->create_test_m($data_array);
                    if($result)
                    {
                         $this->response(['status' => True, 'response_data'=>[], 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);
                    }else
                    {
                        $this->response(['status' => FALSE, 'response_data'=>[], 'Message' =>'Failed'  , 'response_code'=>REST_Controller::HTTP_NOT_FOUND]);
                    } 
                }else
                {
                    $this->response(['status' => FALSE, 'response_data'=>[], 'Message' =>'already exist'  , 'response_code'=>REST_Controller::HTTP_NOT_FOUND]);
                }
                


            }

        }elseif($action=='R')
        {
           $this->input->post('test_id')!=''?$test_id = $this->input->post('test_id'):$test_id='';
           $this->input->post('category_id')!=''?$category_id = $this->input->post('category_id'):$category_id='';
           $this->input->post('clinic_code')!=''?$clinic_code = $this->input->post('clinic_code'):$clinic_code='';
           $result = $this->Test_model->get_test_list_m($test_id,$category_id,$clinic_code);
           if($result!=105)
            {
                 $this->response(['status' => True, 'response_data'=>$result, 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);
            }else
            {
                $this->response(['status' => FALSE, 'response_data'=>[], 'Message' =>'Failed'  , 'response_code'=>REST_Controller::HTTP_NOT_FOUND]);
            }
            
        }elseif($action=='RM')
        {
           $this->input->post('test_id')!=''?$test_id = $this->input->post('test_id'):$test_id='';
           $this->input->post('category_id')!=''?$category_id = $this->input->post('category_id'):$category_id='';
           $result = $this->Test_model->get_test_list_market_m($test_id,$category_id);
           if($result!=105)
            {
                 $this->response(['status' => True, 'response_data'=>$result, 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);
            }else
            {
                $this->response(['status' => FALSE, 'response_data'=>[], 'Message' =>'Failed'  , 'response_code'=>REST_Controller::HTTP_NOT_FOUND]);
            }
            
        }elseif($action=='U')
        {
           if($this->input->post('test_name',true)=='' || $this->input->post('category_id',true)=='' || $this->input->post('rate',true)=='' || $this->input->post('d_by',true)=='' || $this->input->post('test_id',true)=='' || $this->input->post('clinic_code',true)=='')
            {
                $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'All fields are required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
            }else
            {
                    $data_array = array();
                    $data_array['category_id'] = $this->input->post('category_id',true);
                    $data_array['test_name'] = $this->input->post('test_name',true);
                    $data_array['rate'] = $this->input->post('rate',true);
                    $data_array['d_by'] = $this->input->post('d_by',true);
                    $data_array['d_date'] = date('Y-m-d H:i:s');
                    $data_array['status'] = 1;
                    $result = $this->Test_model->update_test_m($data_array,$this->input->post('test_id',true),$this->input->post('clinic_code',true));
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
            if($this->input->post('d_by',true)=='' || $this->input->post('test_id',true)=='' || $this->input->post('clinic_code',true)=='')
            {
                $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'All fields are required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
            }else
            {
                $data_array = array();
                $data_array['d_by'] = $this->input->post('d_by');
                $data_array['d_date'] = date('Y-m-d H:i:s');
                $data_array['status'] = 0;
                $result = $this->Test_model->update_test_m($data_array,$this->input->post('test_id',true),$this->input->post('clinic_code',true));
                $this->Test_model->update_sub_test_m($this->input->post('test_id',true),$this->input->post('clinic_code',true));
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
