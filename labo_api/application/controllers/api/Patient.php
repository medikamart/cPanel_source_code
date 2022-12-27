<?php
require APPPATH . 'libraries/REST_Controller.php';
     
class Patient extends REST_Controller {
    public function __construct() {
       parent::__construct();
       $this->load->model("Patient_model");
        
    }

    public function patient_master_post()
    {   
        $action = $this->input->post('action');
        // print_r($action);die;
        if($action=='C')
        {   
            if($this->input->post('title',true)=='' || $this->input->post('full_name',true)=='' || $this->input->post('c_by',true)=='' || $this->input->post('clinic_code',true)=='')
            {
                $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'All fields are required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
            }else
            {   

                    $data_array = array();
                    $data_array['title'] = $this->input->post('title',true);
                    $data_array['full_name'] = $this->input->post('full_name',true);
                    $data_array['age'] = $this->input->post('age',true);
                    $data_array['clinic_code'] = $this->input->post('clinic_code',true);
                    $data_array['sex'] = $this->input->post('sex',true);
                    $data_array['month'] = $this->input->post('month',true);
                    $data_array['mobile'] = $this->input->post('mobile',true);
                    $data_array['email'] = $this->input->post('email',true);
                    $data_array['address'] = $this->input->post('address',true);
                    $data_array['c_by'] = $this->input->post('c_by',true);
                    $data_array['c_date'] = date('Y-m-d H:i:s');
                    $data_array['status'] = 1;
                    $result = $this->Patient_model->create_patient_m($data_array);
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
           $result = $this->Patient_model->get_patient_list_m($id,$clinic_code);
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
           if($this->input->post('title',true)=='' || $this->input->post('full_name',true)=='' || $this->input->post('sex',true)=='' || $this->input->post('d_by',true)=='' || $this->input->post('id',true)=='' || $this->input->post('clinic_code',true)=='')
            {
                $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'All fields are required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
            }else
            {
                
                    $data_array = array();
                    $data_array['title'] = $this->input->post('title');
                    $data_array['full_name'] = $this->input->post('full_name');
                    $data_array['age'] = $this->input->post('age');
                    $data_array['sex'] = $this->input->post('sex');
                    $data_array['month'] = $this->input->post('month');
                    $data_array['mobile'] = $this->input->post('mobile');
                    $data_array['email'] = $this->input->post('email');
                    $data_array['address'] = $this->input->post('address');
                    $data_array['d_by'] = $this->input->post('d_by');
                    $data_array['d_date'] = date('Y-m-d H:i:s');
                    $data_array['status'] = 1;
                    $result = $this->Patient_model->update_patient_m($data_array,$this->input->post('id',true),$this->input->post('clinic_code',true));
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
                $result = $this->Patient_model->update_patient_m($data_array,$this->input->post('id',true),$this->input->post('clinic_code',true));
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
