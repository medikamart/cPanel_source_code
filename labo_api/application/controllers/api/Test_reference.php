<?php
require APPPATH . 'libraries/REST_Controller.php';
     
class Test_reference extends REST_Controller {
    public function __construct() {
       parent::__construct();
       $this->load->model("Test_reference_model");
        
    }

    public function test_reference_master_post()
    {   
        $action = $this->input->post('action');
        // print_r($action);die;
        if($action=='C')
        {   
            if($this->input->post('reference')=='' || $this->input->post('c_by')=='')
            {
                $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'All fields are required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
            }else
            {   
                $verify = $this->Test_reference_model->veryfy_create_reference_m($this->input->post('reference'));
                if($verify==200)
                {
                    $data_array = array();
                    $data_array['reference'] = $this->input->post('reference');
                    $data_array['c_by'] = $this->input->post('c_by');
                    $data_array['c_date'] = date('Y-m-d H:i:s');
                    $data_array['status'] = 1;
                    $result = $this->Test_reference_model->create_reference_m($data_array);
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
           $this->input->post('id')!=''?$id = $this->input->post('id'):$id='';
           $result = $this->Test_reference_model->get_reference_list_m($id);
           if($result!=105)
            {
                 $this->response(['status' => True, 'response_data'=>$result, 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);
            }else
            {
                $this->response(['status' => FALSE, 'response_data'=>[], 'Message' =>'Failed'  , 'response_code'=>REST_Controller::HTTP_NOT_FOUND]);
            }
            
        }elseif($action=='U')
        {
           if($this->input->post('reference')=='' || $this->input->post('d_by')=='' || $this->input->post('id')=='')
            {
                $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'All fields are required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
            }else
            {
                $verify = $this->Test_reference_model->veryfy_update_reference_m($this->input->post('reference'),$this->input->post('id'));
                if($verify==200)
                {
                    $data_array = array();
                    $data_array['reference'] = $this->input->post('reference');
                    $data_array['d_by'] = $this->input->post('d_by');
                    $data_array['d_date'] = date('Y-m-d H:i:s');
                    $data_array['status'] = 1;
                    $result = $this->Test_reference_model->update_reference_m($data_array,$this->input->post('id'));
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
            
        }elseif($action=='D')
        {
            if($this->input->post('d_by')=='' || $this->input->post('id')=='')
            {
                $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'All fields are required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
            }else
            {
                $data_array = array();
                $data_array['d_by'] = $this->input->post('d_by');
                $data_array['d_date'] = date('Y-m-d H:i:s');
                $data_array['status'] = 0;
                $result = $this->Test_reference_model->update_reference_m($data_array,$this->input->post('id'));
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
