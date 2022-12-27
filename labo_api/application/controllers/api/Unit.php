<?php
require APPPATH . 'libraries/REST_Controller.php';
     
class Unit extends REST_Controller {
    public function __construct() {
       parent::__construct();
       $this->load->model("Unit_model");
        
    }

    public function unit_master_post()
    {   
        $action = $this->input->post('action');
        if($action=='C')
        {   
            if($this->input->post('unit',true)=='' || $this->input->post('c_by',true)=='' || $this->input->post('clinic_code',true)=='')
            {
                $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'All fields are required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
            }else
            {   
                $verify = $this->Unit_model->veryfy_create_unit_m($this->input->post('unit',true),$this->input->post('clinic_code',true));
                if($verify==200)
                {
                    $data_array = array();
                    $data_array['unit'] = $this->input->post('unit',true);
                    $data_array['clinic_code'] = $this->input->post('clinic_code',true);
                    $data_array['c_by'] = $this->input->post('c_by',true);
                    $data_array['c_date'] = date('Y-m-d H:i:s');
                    $data_array['status'] = 1;
                    $result = $this->Unit_model->create_unit_m($data_array);
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
           $this->input->post('id',true)!=''?$id = $this->input->post('id',true):$id='';
           $this->input->post('clinic_code',true)!=''?$clinic_code = $this->input->post('clinic_code',true):$clinic_code='';
           $result = $this->Unit_model->get_unit_list_m($id,$clinic_code);
           if($result!=105)
            {
                 $this->response(['status' => True, 'response_data'=>$result, 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);
            }else
            {
                $this->response(['status' => FALSE, 'response_data'=>[], 'Message' =>'Failed'  , 'response_code'=>REST_Controller::HTTP_NOT_FOUND]);
            }
            
        }elseif($action=='U')
        {
           if($this->input->post('unit',true)=='' || $this->input->post('d_by',true)=='' || $this->input->post('id',true)=='')
            {
                $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'All fields are required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
            }else
            {
                $verify = $this->Unit_model->veryfy_update_unit_m($this->input->post('unit',true),$this->input->post('id',true),$this->input->post('clinic_code',true));
                if($verify==200)
                {
                    $data_array = array();
                    $data_array['unit'] = $this->input->post('unit');
                    $data_array['d_by'] = $this->input->post('d_by');
                    $data_array['d_date'] = date('Y-m-d H:i:s');
                    $data_array['status'] = 1;
                    $result = $this->Unit_model->update_unit_m($data_array,$this->input->post('id',true),$this->input->post('clinic_code',true));
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
            if($this->input->post('d_by',true)=='' || $this->input->post('id',true)=='' || $this->input->post('clinic_code',true)=='')
            {
                $this->response(['status'=>false, 'response_data'=>'4', 'Message'=>'All fields are required!!', 'response_code'=>REST_Controller::HTTP_BAD_REQUEST]);
            }else
            {
                $data_array = array();
                $data_array['d_by'] = $this->input->post('d_by');
                $data_array['d_date'] = date('Y-m-d H:i:s');
                $data_array['status'] = 0;
                $result = $this->Unit_model->update_unit_m($data_array,$this->input->post('id',true),$this->input->post('clinic_code',true));
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


public function get_result_box_list_post()
{
    $clinic_code = $this->input->post('clinic_code')!=''?$this->input->post('clinic_code'):'';
    $result = $this->Unit_model->get_result_box_list_m($clinic_code);
    if($result!=105)
    {
         $this->response(['status' => True, 'response_data'=>$result, 'Message' =>'Success' , 'response_code'=>REST_Controller::HTTP_OK]);
    }else
    {
        $this->response(['status' => FALSE, 'response_data'=>[], 'Message' =>'Failed'  , 'response_code'=>REST_Controller::HTTP_NOT_FOUND]);
    }
}

  
}

?>
