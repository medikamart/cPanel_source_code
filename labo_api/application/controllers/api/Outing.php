<?php
require APPPATH . 'libraries/REST_Controller.php';
     
class Outing extends REST_Controller {
    public function __construct() {
       parent::__construct();
       $this->load->model("Outing_model");
        
    }

    public function outing_master_post()
    {   
        $action = $this->input->post('action');
        // print_r($action);die;
        if($action=='C')
        {   
            if($this->input->post('vendor_id')==''|| $this->input->post('patient_id')=='' || $this->input->post('amount')=='' || $this->input->post('outing_date')=='' || $this->input->post('c_by')=='')
            {
                $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'All fields are required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
            }else
            {   

                    $data_array = array();
                    $data_array['patient_id'] = $this->input->post('patient_id');
                    $data_array['vendor_id'] = $this->input->post('vendor_id');
                    $data_array['amount'] = $this->input->post('amount');
                    $data_array['outing_date'] = date('Y-m-d',strtotime($this->input->post('outing_date')));

                    $data_array['c_by'] = $this->input->post('c_by');
                    $data_array['c_date'] = date('Y-m-d H:i:s');
                    $data_array['status'] = 1;
                    $result = $this->Outing_model->create_outing_m($data_array);
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
           $this->input->post('id')!=''?$id = $this->input->post('id'):$id='';
           $result = $this->Outing_model->get_outing_list_m($id);
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
           if($this->input->post('vendor_id')==''|| $this->input->post('patient_id')=='' || $this->input->post('amount')=='' || $this->input->post('outing_date')=='' ||  $this->input->post('d_by')=='' || $this->input->post('id')=='')
            {
                $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'All fields are required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
            }else
            {
                
                    $data_array = array();
                    $data_array['vendor_id'] = $this->input->post('vendor_id');
                    $data_array['patient_id'] = $this->input->post('patient_id');
                    $data_array['amount'] = $this->input->post('amount');
                    $data_array['outing_date'] = date('Y-m-d',strtotime($this->input->post('outing_date')));
                   
                    $data_array['d_by'] = $this->input->post('d_by');
                    $data_array['d_date'] = date('Y-m-d H:i:s');
                    $data_array['status'] = 1;
                    $result = $this->Outing_model->update_outing_m($data_array,$this->input->post('id'));
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
            if($this->input->post('d_by')=='' || $this->input->post('id')=='')
            {
                $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'All fields are required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
            }else
            {
                $data_array = array();
                $data_array['d_by'] = $this->input->post('d_by');
                $data_array['d_date'] = date('Y-m-d H:i:s');
                $data_array['status'] = 0;
                $result = $this->Outing_model->update_outing_m($data_array,$this->input->post('id'));
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
